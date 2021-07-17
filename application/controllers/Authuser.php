<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Authuser extends CI_Controller {

    public function index() {
        $data = array();
        $data['screen'] = '';
        $data['ident_key'] = '';
        $data['ident_val'] = '';

        $this->load->library('session');

        $this->checkSession();

        $this->load->view('tmpl/header_authsecure', $data);
        $this->load->view('auth/view_authuser', $data);
        $this->load->view('tmpl/footer_authsecure', $data);
    }

    public function checkSession (){
        if(!$this->session->userdata('sessionId')){
            redirect("auth");
        }
    }
    
    public function findapplication() {
        $this->checkSession();
        
        $data = array();

        $offset = 0;
        $limit = 10;

        $data['search_key'] = $this->input->get('search_key');
        $data['search_val'] = $this->input->get('search_val');
        $data['page'] = ( $this->uri->segment(3) ) ? $this->uri->segment(3) : 0;
        $data['offset'] = is_numeric($data['page']) ? $data['page'] : $offset;
        $data['limit'] = $limit;

        if ($data['limit']<$limit) $data['limit'] = $limit;
        if ($data['offset']<0) $data['offset'] = 0;

        $this->load->model('Findapplication_model'); // call model

        list($data['data'],$data['count'],$data['message']) = 
            $this->Findapplication_model->load_practice_request($data['offset'],$data['limit']);

        if ($data['count']>$data['limit']) {
            // Pagination
            $params = [
                'search_key' => $data['search_key'],
                'search_val' => $data['search_val'],
            ];

            $this->load->library('pagination');

            $config = [
                'total_rows' => $data['count'],
                'base_url' => base_url().'authuser/findapplication',
                'per_page' => $data['limit'],
                'uri_segment' => 3,
                'num_links' => 5,
                'suffix' => '?' . http_build_query($params),
                'first_url' => base_url().'authuser/findapplication/0?' . http_build_query($params),
                'full_tag_open' => "<ul class='pagination'>",
                'full_tag_close' => "</ul>",
                'num_tag_open' => '<li>',
                'num_tag_close' => '</li>',
                'cur_tag_open' => "<li class='disabled'><li class='active'><a href='#'>",
                'cur_tag_close' => "<span class='sr-only'></span></a></li>",
                'next_tag_open' => "<li>",
                'next_tagl_close' => "</li>",
                'prev_tag_open' => "<li>",
                'prev_tagl_close' => "</li>",
                'first_tag_open' => "<li>",
                'first_tagl_close' => "</li>",
                'last_tag_open' => "<li>",
                'last_tagl_close' => "</li>"
            ];
            $this->pagination->initialize($config);
            $data['links'] = $this->pagination->create_links();
        } else {
            $data['links'] = "";
        }

        $data['search_by'] = $this->Findapplication_model->get_search_by();
        if ($_POST) {
            $data['search_key'] = $this->input->post('search_key');
            $data['search_val'] = $this->input->post('search_val');
        }
        
        $data["result"] = $data['data']; //$result;

        $this->load->view('tmpl/header_authsecure', $data);
        $this->load->view('auth/view_findapplication', $data);
        $this->load->view('tmpl/footer_authsecure', $data);
    }

    public function myprofile() {
        $this->checkSession();
        
        $this->load->view('tmpl/header_authsecure' );
        $this->load->view('auth/view_userprofile');
        $this->load->view('tmpl/footer_authsecure' );
    }

    public function selectapplication() {
        $this->checkSession();
        
        $data = array();

        $data['message'] = '';
        $data['server'] = 0;
        $data['range'] = 0;
        $data['practice'] = 0;
        $data['template'] = 0;
        $data['npi_validation'] = NULL;
        $data['provider_npi_validation'] = NULL;
        $data['practice_name'] = '';
        $data['search_key'] = $this->input->get('search_key');
        $data['search_val'] = $this->input->get('search_val');
        $data['validate_npi'] = $this->input->get('validate_npi');

        $practicecode = $this->input->get('practicecode');

        $this->load->model('Applications_model'); // call model
        $this->load->model('Findapplication_model');
        $this->load->model('Practice_model');
        $this->load->model('Servers_model');
        $this->load->model('Templates_model');

        list($data['data'],$data['count'],$data['message']) = 
            $this->Findapplication_model->load_practice_request(0,1,$practicecode);
        
        foreach ($data['data'] as $app) {
            if ($app["PracticeCode"]==$practicecode) {
                $data["application"] = $app;
                if ($data['validate_npi']==1) {
                    // Run NPI validation
                    ob_start();
                    $_GET['npi'] = $app["NPI"];
                    $this->VerifyNPI();
                    $data["npi_validation"] = json_decode(ob_get_clean(),true);
                    ob_start();
                    $_GET['npi'] = $app["provider_NPI"];
                    $this->VerifyNPI();
                    $data["provider_npi_validation"] = json_decode(ob_get_clean(),true);
                } else {
                    $data["npi_validation"] = new stdClass();
                    $data["provider_npi_validation"] = new stdClass();
                }
            }
        }

        $res = $this->Servers_model->load_servers();
        $data['servers'] = $res[0];

        $res = $this->Practice_model->load_practices(2,"",0,0);
        $data['practices'] = $res[0];
        $data['ranges'] = $res[1];
        //var_dump($res);

        $res = $this->Templates_model->load_templates();
        $data['templates'] = $res[0];

        $data['server_id'] = 0;
        if ($_POST) {
            $data["id"] = $this->input->post('id');

            $data["range"] = $this->input->post('range');
            $data["practice"] = $this->input->post('practice');
            $data["practice_name"] = $this->input->post('practice_name');
            if ($data["range"] > 0) {
                // We will attach to a parrent tenant
                $data["parent_tenant_id"] = $data["practice"];
                $data["database_id"] = '0';
                $data["template_id"] = '0';
                $data["download_file"] = '';
            } else {
                $data["server"] = $this->input->post('server');
                $data["template"] = $this->input->post('template');
            }

            // TODO:
            if ($data["id"]>0 && ($data["practice"] > 0 || ($data["server"]>0 && $data["template"]>0))) {
                if ($data["server"] == PHP_INT_MAX) {
                    $data["server"] = 0;
                }
                foreach ($data['templates'] as $f) {
                    if ($f["ID"]==$data["template"]) {
                        $data["database_id"] = $f["server_id"];
                        $data["template_id"] = $f["template_id"];
                        $data["download_file"] = $f["download_file"];
                        $data["parent_tenant_id"] = '0';
                        break;
                    }
                }
                $err = "Approve practice call failed";
                $practice = $this->Practice_model->approve_practice($data);
                if ($practice != null && array_key_exists('code',$practice) && $practice['code'] === 0) {
                    // success
                    if (!array_key_exists('practiceconfig',$practice) || !is_array($practice["practiceconfig"])) {
                        $practice["practiceconfig"] = [
                            [
                                "prefix"     => "",
                                "firstname"  => "valued",
                                "middlename" => "",
                                "lastname"   => "customer",
                                "suffix"     => "" 
                            ]
                        ];
                    }
                    $practice["practiceconfig"][0]['email'] = $practice["practiceconfig"][0]['contact_email'];
                    $practice["practiceconfig"][0]['download_file'] = $data["download_file"];
                    list($err,$msg,$body) = $this->GenerateDeploymentEmail($practice["practiceconfig"][0]);
                    if ($err) {
                        $data["message"].= "Failed to send message:\n<br/>\n".$msg;
                    } else {
                        $data["message"] = "Message:<br/>\n".$body;
                    }
                } else if ($practice != null && array_key_exists('message',$practice) && $practice['message'] != "") {
                    $data["message"] = $practice['message'];
                } else {
                    $data["message"] = "Unknwon error!";
                }
                $this->SendAdminEmail($data, $err);
            }
        }

        $servers = []; // Do not show inactive and multiple targets
        $servers[] = [
            'id' => 0,
            'name' => 'Please select...',
            'endpoint_address' => '',
            'host_address' => ''
        ];
        $servers[] = [
            'id' => PHP_INT_MAX,
            'name' => 'MULTIPLE SERVERS',
            'endpoint_address' => 'All instances',
            'host_address' => 'With multiple port pools'
        ];
        foreach ($data['servers'] as $server) {
            if ($server['status'] == 1) {
                $servers[$server['id']] = $server;
            }
        }
        $ranges = [];
        if (is_array($data['ranges'])) {
            $range_sources = [];
            foreach ($data['ranges'] as $range) {
                /*
                ["Deployments"]=>int(1)
                ["PracticeServer_ID"]=>int(1)
                ["Stamp"]=>string(7) "2021-03"
                ["name"]=>string(12) "EMR / ERX #1"
                ["binding"]=>string(14) "AUXCORSVRVM01D"
                ["endpoint_address"]=>string(58) "net.tcp://10.10.20.53:14202/PACEAgentAppServer/MainService"
                */
                if (!array_key_exists($range['Stamp'], $range_sources)
                 || !is_array($range_sources[$range['Stamp']])) {
                    $range_sources[$range['Stamp']] = array();
                }
                if (!array_key_exists('deployments', $range_sources[$range['Stamp']])
                 || !isset($range_sources[$range['Stamp']]['deployments'])) {
                    $range_sources[$range['Stamp']]['deployments'] = 0;
                }
                $range_sources[$range['Stamp']]['deployments'] += $range['Deployments'];
                if (!array_key_exists('name', $range_sources[$range['Stamp']])
                 || !is_array($range_sources[$range['Stamp']]['name'])) {
                    $range_sources[$range['Stamp']]['name'] = array();
                }
                $range_sources[$range['Stamp']]['name'][] = $range['name'];
                if (!array_key_exists('endpoint_address', $range_sources[$range['Stamp']])
                 || !is_array($range_sources[$range['Stamp']]['endpoint_address'])) {
                    $range_sources[$range['Stamp']]['endpoint_address'] = array();
                }
                $range_sources[$range['Stamp']]['endpoint_address'][] = $range['endpoint_address'];
            }
            if (count($range_sources) > 0) {
                foreach ($range_sources as $key=>$range_source) {
                    $endpoint_address = " (Deployments: " . $range_source['deployments'] . ")";
                    $host_address = " (" . implode(",", $range_source['name']) . ")";
                    $ranges[$key] = array(
                        'id' => $key,
                        'name' => $key,
                        'endpoint_address' => $endpoint_address,
                        'host_address' => $host_address
                    );
                }
            }
            arsort($ranges);
        }
        array_unshift($ranges, [
            'id' => '',
            'name' => 'No parent tenant (must select Server)',
            'endpoint_address' => '',
            'host_address' => ''
        ]);

        $practices = []; 
        $practices[] = [
            'id' => 0,
            'name' => 'No parent tenant (set primary, must select Server)',
            'endpoint_address' => '',
            'host_address' => ''
        ];
        $practices = $this->getParentPractices($data, $practices, $servers);

        //var_dump($practices);
        $data["servers_combobox"] = $this->Servers_model->ComboBoxData('server',$data['server'],$servers,'serverChanged(this.value)');
        $data["ranges_combobox"] = $this->Practice_model->ComboBoxData('range',$data['range'],$ranges,'rangeChanged(this.value)');
        $data["practices_combobox"] = $this->Practice_model->ComboBoxData('practice',$data['practice'],$practices,'practiceChanged(this.value)');
        $data["templates_combobox"] = $this->Templates_model->ComboBoxData('template',$data['template'],$data['templates']);

        $data["footer_js"] = '
        practiceChanged($(\'select[name="practice"]\').val()); serverChanged($(\'select[name="server"]\').val());
        // AJAX call for autocomplete 
        $(document).ready(function(){
            $("#search-box").keyup(function(){
                $.ajax({
                type: "POST",
                url: "searchDeploymentsByPracticeName",
                data:\'search_key=&search_val=\'+$(this).val(),
                beforeSend: function(){
                    $("#search-box").css("background","#FFF url(/images/loadericon.gif) no-repeat 165px");
                },
                success: function(data){
                    $("#suggesstion-box").show();
                    $("#suggesstion-box").html(data);
                    $("#search-box").css("background","#FFF");
                }
                });
            });
        });
        ';
        
        $this->load->view('tmpl/header_authsecure', $data);
        $this->load->view('auth/view_selectapplication', $data);
        $this->load->view('tmpl/footer_authsecure', $data);
    }

    public function searchDeployments() {
        $data = [];
        $data['search_key'] = $this->input->post('search_key');
        $data['search_val'] = $this->input->post('search_val');

        $this->load->model('Servers_model');
        $this->load->model('Practice_model');

        $res = $this->Servers_model->load_servers();
        $data['servers'] = $res[0];
        $servers = [];
        foreach ($data['servers'] as $server) {
            if ($server['status'] == 1) {
                $servers[$server['id']] = $server;
            }
        }

        $res = $this->Practice_model->load_practices(2,$data['search_val'],0,0);
        $data['practices'] = $res[0];
        $data['ranges'] = $res[1];

        $practices = []; 
        $practices[] = [
            'id' => 0,
            'name' => 'No parent tenant (set primary, must select Server)',
            'endpoint_address' => '',
            'host_address' => ''
        ];
        $practices = $this->getParentPractices($data, $practices, $servers);
        header('Content-Type: application/json');
        echo json_encode($practices);
    }

    public function searchDeploymentsByPracticeName() {
        $data = [];
        $data['search_key'] = $this->input->post('search_key');
        $data['search_val'] = $this->input->post('search_val');

        $this->load->model('Servers_model');
        $this->load->model('Practice_model');

        $res = $this->Servers_model->load_servers();
        $data['servers'] = $res[0];
        $servers = [];
        foreach ($data['servers'] as $server) {
            if ($server['status'] == 1) {
                $servers[$server['id']] = $server;
            }
        }

        $res = $this->Practice_model->load_practices(3,$data['search_val'],10,0);
        $data['practices'] = $res[0];
        $data['ranges'] = $res[1];

        $practices = []; 
        $practices = $this->getParentPractices($data, $practices, $servers);

        echo '<ul id="practice-list">';
        foreach ($practices as $practice) {
            echo '<li onclick="selectPracticeName(\'';
            echo $practice['practice']['Stamp'].'_'.$practice['practice']['ID'];
            /*
            {"ID":15,"PracticeConfig_ID":40079,"PracticeServer_ID":3,
                "name":"EMR \/ ERX #2","binding":"AUXCORSVRVM02D",
                "endpoint_address":"net.tcp:\/\/10.10.20.58:14202\/PACEAgentAppServer\/MainService",
                "PracticeName":"BLUE CAMPBELL AND ASSOCIATES LLC","Stamp":"2021-07"}
            */
            echo '\',\''.$practice['practice']['PracticeName'].'\');">';
            echo $practice['practice']['PracticeName'].' => '.$practice['name'].'</li>';
        }
        echo '</ul>';
    }

    private function getParentPractices($data, $practices, $servers) {
        if (is_array($data['practices'])) {
            foreach ($data['practices'] as $practice) {
                //var_dump($practice);
                /*
                    ["ID"]=>int(1)
                    ["PracticeConfig_ID"]=>int(30030)
                    ["PracticeServer_ID"]=>int(1)
                    ["name"]=>string(12) "EMR / ERX #1"
                    ["binding"]=>string(14) "AUXCORSVRVM01D"
                    ["endpoint_address"]=>string(58) "net.tcp://10.10.20.53:14202/PACEAgentAppServer/MainService"
                */
                // var_dump($servers);
                /*
                array(13) {
                    ["id"]=>string(1) "1"
                    ["name"]=>string(12) "EMR / ERX #1"
                    ["status"]=>string(1) "1"
                    ["created_dt"]=>string(29) "2020-01-02T08:54:04.947-08:00"
                    ["host_address"]=>string(11) "10.10.20.53"
                    ["port_no"]=>string(5) "15999"
                    ["binding"]=>string(14) "AUXCORSVRVM01D"
                    ["modified_dt"]=>NULL
                    ["endpoint_address"]=>string(58) "net.tcp://10.10.20.53:14202/PACEAgentAppServer/MainService"
                    ["application_package"]=>string(46) "C:\AutoMedSys\deployment\EMRSVR-deployment.zip"
                    ["application_deployment"]=>string(24) "C:\AutoMedSys\deployment"
                    ["port_range"]=>string(37) "[{"min_port":16001,"max_port":16050}]"
                    ["legacy_port_range"]=>string(37) "[{"min_port":15001,"max_port":15050}]"
                }
                */
                if ($practice['PracticeServer_ID'] > 0) {
                    $names = array();
                    $host_addresses = array();
                    $practiceserverlist = is_array($servers[$practice["PracticeServer_ID"]]) ?
                          array(array("name" => $servers[$practice["PracticeServer_ID"]]["name"], "host_address" => $servers[$practice["PracticeServer_ID"]]["endpoint_address"]))
                        : array(array("name" => "root", "host_address" => $practice["endpoint_address"]));
                    // $practiceserverlist = json_decode(json_decode($practice["PracticeServerList"], true)[0], true);
                    foreach ($practiceserverlist as $practiceserver) {
                        $names[] = $practiceserver["name"];
                        $host_addresses[] = $practiceserver["host_address"];
                    }
                    $name = $practice["PracticeConfig_ID"] . " (" . implode(",", $names) . ")";
                    $host_address = " (" . implode(",", $host_addresses) . ")";
                    $practices[] = array(
                        'id' => $practice['ID'],
                        'name' => $name,
                        'endpoint_address' => $practice["endpoint_address"],
                        'host_address' => $host_address,
                        'practice' => $practice
                    );
                }
            }
        }
        return $practices;
    }

    public function logout() {
        $this->session->unset_userdata('sessionId'); 

        redirect('auth');
    }

    public function test() {
        $practice = [
            "practiceconfig" => [
                [
                    "email" => "acidumirae@gmail.com",
                    "contact_prefix" => "Dr.",
                    "contact_firstname" => "Anatolii",
                    "contact_middlename" => "S",
                    "contact_lastname" => "Okhotnikov",
                    "contact_suffix" => "MD",
                    "provider_prefix" => "Dr.",
                    "provider_firstname" => "Anatolii",
                    "provider_middlename" => "S",
                    "provider_lastname" => "Okhotnikov",
                    "provider_suffix" => "MD",
                    "username" => "autoadmin",
                    "PracticeName" => "Cool Practice",
                    "PracticeCode" => "AAD20201001",
                    "channel_no" => "15999",
                    "download_file" => "https://securerelease.automedsys.net/AUTO/pm/publish.htm"
                ]
            ]
        ];
        list($err,$msg,$body) = $this->GenerateDeploymentEmail($practice["practiceconfig"][0]);
        
        $data = ["message" => ""];

        if ($err) {
            $data["message"].= "\n<br/>\n".$msg;
        } else {
            $data["message"] = "Message:<br/>\n".$body;
        }
        $this->load->view('tmpl/header_authsecure', $data);
        $this->load->view('auth/view_test', $data);
        $this->load->view('tmpl/footer_authsecure', $data);
    }

    private function getName(&$data) {
        if ($data["contact"]!="") {
            $p = $data["contact"];
            $data["prefix"]     = $data["${p}_prefix"];
            $data["firstname"]  = $data["${p}_firstname"];
            $data["middlename"] = $data["${p}_middlename"];
            $data["lastname"]   = $data["${p}_lastname"];
            $data["suffix"]     = $data["${p}_suffix"];
        }
        $name = $data['prefix']." ".$data["firstname"]." ".$data["middlename"]." ".$data["lastname"]." ".$data["suffix"];
        $name = preg_replace('/\s+/', ' ', $name);
        return trim($name);
    }

    private function GenerateDeploymentEmail($data) {
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
        $genLink = "";
        
        if (strpos($actual_link, 'dev-pace') !== false) {
            $genLink =  'http://dev-practice.automedsys.net/';
        } else {
            $genLink =  'http://qa-practice.automedsys.net/';
        }

        $this->load->helper('gmail');

        $data["contact"] = "provider";
        
        if ((array_key_exists('firstname',$data) && $data['firstname']!='') || 
            (array_key_exists('lastname',$data) && $data['lastname']!='')) {
            $data["contact"] = "";
        } else if ((array_key_exists('contact_firstname',$data) && $data['contact_firstname']!='') || 
                   (array_key_exists('contact_lastname',$data) && $data['contact_lastname']!='')) {
            $data["contact"] = "contact";
        }
        
        // Generate body
        $name = trim($this->getName($data));
        $provider_name = $data['provider_prefix']." ".$data["provider_firstname"]." ".$data["provider_middlename"]." ".$data["provider_lastname"]." ".$data["provider_suffix"];
        $provider_name = trim(preg_replace('/\s+/', ' ', $provider_name));
        
        $email_data = [
            "AUX_FULLNAME" => $name,
            "AUX_FIRSTNAME" => $data["firstname"],
            "AUX_MIDDLENAME" => $data["middlename"],
            "AUX_LASTNAME" => $data["lastname"],
            "AUX_PREFIX" => $data["prefix"],
            "AUX_SUFFIX" => $data["suffix"],
            "AUX_PROVIDER_FULLNAME" => $provider_name,
            "AUX_PROVIDER_FIRSTNAME" => $data["provider_firstname"],
            "AUX_PROVIDER_MIDDLENAME" => $data["provider_middlename"],
            "AUX_PROVIDER_LASTNAME" => $data["provider_lastname"],
            "AUX_PROVIDER_PREFIX" => $data["provider_prefix"],
            "AUX_PROVIDER_SUFFIX" => $data["provider_suffix"],
            "AUX_USERNAME" => $data["username"],
            "AUX_PRACTICENAME" => $data["PracticeName"],
            "AUX_PRACTICEID" => $data["PracticeCode"],
            "AUX_PORT" => $data["channel_no"],
            "AUX_DOWNLOAD_LINK" => $genLink,// this needs to be dynamic, based on the environment
            "AUX_DOCUMENTATION_LINK" => "https://www.automedsys.net",
        ];
        
        $data['html'] = $this->load->view('email/deployed', $email_data, TRUE); 
        
        $subject = Gmail::ExtractTitle($data['html'],"Congratulations and Welcome to AutoMedsys!");

        // Send email
        list($err,$msg,$body) = Gmail::SendMail($data,$name,$subject);
        // $err = false; $msg = "*** MSG ***"; $body = $data['html'];
        return [$err,$msg,$body];
    }

    private function SendAdminEmail($data, $err) {
        $this->load->helper('gmail');
        
        // Generate body
        ob_start();
        var_dump($data);
        
        $data_dump = "<pre>".ob_get_clean()."</pre>";
        
        $email_data = [
            "data" => $data_dump,
            "error" => $err
        ];
        
        $adminData = [
            "email" => "acidumirae@gmail.com",
            "contact" => 1,
            "prefix" => "", "1_prefix" => "",
            "firstname" => "AutoMedSys", "1_firstname" => "AutoMedSys",
            "middlename" => "", "1_middlename" => "",
            "lastname" => "Admin", "1_lastname" => "Admin",
            "suffix" => "", "1_suffix" => ""
        ];
        
        $name = trim($this->getName($adminData));
        $adminData['html'] = $this->load->view('email/admin', $email_data, TRUE); 
        list($err,$msg,$body) = Gmail::SendMail($adminData,$name,"Practice deployment");
    }

    public function VerifyNPI() {
        global $automedsys;
        set_time_limit(0);

        $this->load->helper('ClientAuthenticator');
        
        $data = [];
        $npi = $this->input->get('npi');
        
        try {
            $devApiBaseUrl = $automedsys->cfgReadChar("auxpro.dev_api_base_url");
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $devApiBaseUrl . "/emrapi/v1/npiregisry/providers/{$npi}");
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: Bearer ' . ClientAuthenticator::getToken(),
            ]);
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            $result = curl_exec($ch);
            curl_close($ch);

            $data = json_decode($result, true);
        } catch (Exception $e) {
            $data["error"] = "Failure: ".$e->getMessage().$e->getTraceAsString();
        }

        $data["npi"] = $npi;
        
        echo json_encode($data);
    }
}
