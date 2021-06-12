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
        $data['practice'] = 0;
        $data['template'] = 0;
        $data['npi_validation'] = NULL;
        $data['provider_npi_validation'] = NULL;
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
                    // Load NPI validation
                    $f = $this->Findapplication_model->getValidateNPI($app["NPI"]);
                    if($f && $f !== null){
                    $data["npi_validation"] = json_decode($f["data"], true);
                    $f = $this->Findapplication_model->getValidateNPI($app["provider_NPI"]);
                    $data["provider_npi_validation"] = json_decode($f["data"], true);
                    }else{
                        $data["npi_validation"] = new stdClass();
                        $data["provider_npi_validation"] = new stdClass();
                    }
                }
            }
        }

        $res = $this->Servers_model->load_servers();
        $data['servers'] = $res[0];

        $res = $this->Practice_model->load_practices();
        $data['practices'] = $res[0];

        $res = $this->Templates_model->load_templates();
        $data['templates'] = $res[0];

        $data['server_id'] = 0;
        if ($_POST) {
            $data["id"] = $this->input->post('id');

            $data["practice"] = $this->input->post('practice');
            if ($data["practice"] > 0) {
                // We will attach to a parrent tenant
                $data["parent_tenant_id"] = $data["practice"];
                $data["database_id"] = '';
                $data["template_id"] = '';
                $data["download_file"] = '';
            } else {
                $data["server"] = $this->input->post('server');
                $data["template"] = $this->input->post('template');
            }

            if ($data["id"]>0 && ($data["practice"] > 0 || ($data["server"]>0 && $data["template"]>0))) {
                if ($data["server"] == PHP_INT_MAX) {
                    $data["server"] = 0;
                }
                foreach ($data['templates'] as $f) {
                    if ($f["ID"]==$data["template"]) {
                        $data["database_id"] = $f["server_id"];
                        $data["template_id"] = $f["template_id"];
                        $data["download_file"] = $f["download_file"];
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
                        $data["message"].= "\n<br/>\n".$msg;
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
                $servers[] = $server;
            }
        }
        $practices = []; 
        $practices[] = [
            'id' => 0,
            'name' => 'No parent tenant (set primary, must select Server)',
            'endpoint_address' => '',
            'host_address' => ''
        ];
        foreach ($data['practices'] as $practice) {
            //var_dump($practice);
            if ($practice['status'] === '0') {     
                $names = array(); 
                $host_addresses = array();
                $practiceserverlist = json_decode(json_decode($practice["practiceserverlist"], true)[0], true);
                foreach ($practiceserverlist as $practiceserver) {
                    $names[] = $practiceserver["name"];
                    $host_addresses[] = $practiceserver["host_address"];
                }
                $name = $practice["practiceconfig_id"] . " (" . implode(",", $names) . ")";
                $host_address = " (" . implode(",", $host_addresses) . ")";
                $practices[] = array(
                    'id' => $practice['id'],
                    'name' => $name,
                    'endpoint_address' => $practice["endpoint_address"],
                    'host_address' => $host_address,
                    'practice' => $practice
                );
            }
        }
        //var_dump($practices);
        $data["servers_combobox"] = $this->Servers_model->ComboBoxData('server',$data['server'],$servers);
        $data["practices_combobox"] = $this->Practice_model->ComboBoxData('practice',$data['practice'],$practices,'practiceChanged(this.value)');
        $data["templates_combobox"] = $this->Templates_model->ComboBoxData('template',$data['template'],$data['templates']);

        $data["footer_js"] = 'practiceChanged($(\'select[name="practice"]\').val());';

        $this->load->view('tmpl/header_authsecure', $data);
        $this->load->view('auth/view_selectapplication', $data);
        $this->load->view('tmpl/footer_authsecure', $data);
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
        
        if (strpos($actual_link, 'dev-practice') !== false) {
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
        
        $data = [];
        $npi = $this->input->get('npi');
        
        if ($npi=='') {
            return;
        }
        
        $this->load->model('Findapplication_model'); // call model
        
        $validation = $this->Findapplication_model->getValidateNPI($npi);
        
        if (is_array($validation) && array_key_exists('id',$validation) && $validation['id']>0) {
            // We have already validated this NPI
            echo $validation['data'];
            return;
        }

        try {
            $url = $automedsys->cfgReadChar("auxpro.pace_endpoint");
			$url = str_replace("?WSDL", "", $url);

            //setting the curl parameters.
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true );
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: text/xml; charset=utf-8',
                'SOAPAction: "http://automedsys.net/webservices/VerifyNPI"'
            ));
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
                        
            $raw_xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>
                        <soap:Envelope xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" xmlns:soap=\"http://schemas.xmlsoap.org/soap/envelope/\">
                        <soap:Body>
                            <VerifyNPI xmlns=\"http://automedsys.net/webservices\">
                                <NPI>${npi}</NPI>
                                <sessionid>string</sessionid>
                            </VerifyNPI>
                        </soap:Body>
                        </soap:Envelope>";

            curl_setopt($ch, CURLOPT_POSTFIELDS, $raw_xml);

            $result = curl_exec($ch);
            //var_dump($result);
            curl_close($ch);

            // Massage SOAP envelope, so it is parseable by SimpleXMLElement class
            $result = str_replace(' xmlns="http://www.automedsys.com/messaging"','',$result);
            $result = str_replace(' xmlns="http://automedsys.net/webservices"','',$result);
            $result = str_replace('soap:','',$result);

            $xml = new SimpleXMLElement($result);
            if (is_object($xml) && property_exists($xml,'Body') 
             && is_object($xml->Body) && property_exists($xml->Body,'VerifyNPIResponse') 
             && is_object($xml->Body->VerifyNPIResponse) && property_exists($xml->Body->VerifyNPIResponse,'VerifyNPIResult')
             && is_object($xml->Body->VerifyNPIResponse->VerifyNPIResult)) {
                // Process response 
                $res = $xml->Body->VerifyNPIResponse->VerifyNPIResult;
                //var_dump($res);

                if (property_exists($res,'ErrorCode') && (int)$res->ErrorCode==0) {
                    $data = json_decode((string)$res->Suggestion, true);
                } else if (property_exists($res,'ErrorMessage') && ((string)$res->ErrorMessage)!="") {
                    $data["error"] = $res->ErrorMessage . "<br/>" . $res->Suggestion; // . "<br/>" . htmlentities($raw_xml);
                }
            }
            if (!is_array($data) || count($data)<1) {
                $data["error"] = "Unknown error!";
            }
            
        } catch (Exception $e) {
            $data["error"] = "Failure: ".$e->getMessage().$e->getTraceAsString();
        }
        
        // Save validation result
        $id = $this->Findapplication_model->createValidateNPI($npi);
        
        if ($id>0) {
            $validation = $this->Findapplication_model->saveValidateNPI($id, $data);
            if (is_array($data) && array_key_exists("result_count",$data) && $data["result_count"]>0 
             && is_array($data["results"]) && count($data["results"])>0 && $data["results"][0]["number"]!='')  {
                // Refine the condition
                $this->Findapplication_model->updateValidateNPI($npi,true);
            }
        }

        $data["npi"] = $npi;
        
        echo json_encode($data);
    }
}
