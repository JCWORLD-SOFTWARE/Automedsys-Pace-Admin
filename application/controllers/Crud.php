<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends CI_Controller {

    public function index() {
        $data = array();
        $data['screen'] = '';
        $data['ident_key'] = '';
        $data['ident_val'] = '';

        // print_r( $_SESSION["practice_info"]);
        //$_SESSION["authToken"]["Username"] = 'Dummy value';
        // $_SESSION["session"] = 'dummy-dummy---';

        $this->load->view('tmpl/header_authsecure', $data);
        $this->load->view('crud/view_authuser', $data);
        $this->load->view('tmpl/footer_authsecure', $data);
    }

    public function checkSession (){
        if(!$this->session->userdata('sessionId')){
            redirect("auth");
        }
    }
    public function servers() {
        $this->checkSession();
        $data = array();

        $this->load->model('Servers_model'); // call model

        //$res = $this->Servers_model->retreive();
        //$data['res'] = $res;

        $res = $this->Servers_model->load_servers();
        $data['res'] = $res[0];

        $this->load->model('Templates_model'); // call model

        $res = $this->Templates_model->load_templates();
        $data['templates'] = $res[0];

        $this->load->view('/tmpl/header_authsecure', $data);
        $this->load->view('/crud/view_servers', $data);
        $this->load->view('/tmpl/footer_authsecure', $data);
    }

    public function servercreate() {
        $this->checkSession();
        $data = array();
        $data['server'] = '';
        $data['name'] = '';
        $data['port'] = '';
        $data['practice_code'] = '';
        $data['status'] = 1;
        $data['message'] = ''; 

        $this->load->model('Servers_model'); // call model

        if ($_POST) {
            $in = array();
            $in['server'] = trim($this->input->post('server'));
            $in['name'] = trim($this->input->post('name'));
            $in['port'] = trim($this->input->post('port'));
            $in['practice_code'] = trim($this->input->post('practice_code'));
            $in['status'] = $this->input->post('status'); 
            
            if ($in['server']!='' && $in['name']!='' && $in['port']>0 && $in['practice_code']!='') {
                $id = $this->Servers_model->create($in);
                if ($id>0) {
                    redirect(base_url().'/crud/serverupdate?id='.$id);
                    return;
                } else {
                    $data['message'] = 'Failed to create record';
                }
            } else {
                $data['message'] = 'Invalid input';
            }
            $data = array_merge($data, $in);
        }

        $this->load->view('/tmpl/header_authsecure', $data);
        $this->load->view('/crud/view_servers_create', $data);
        $this->load->view('/tmpl/footer_authsecure', $data);
    }

    public function serverupdate() {
        $this->checkSession();
        $data = array();

        $data['server'] = '';
        $data['name'] = '';
        $data['port'] = '';
        $data['practice_code'] = '';
        $data['status'] = 0; 
        $data['message'] = '';  

        $this->load->model('Servers_model'); // call model

        $id = $this->input->get('id');
        $data["id"] = $id;
        if ($_POST) {
            $in = array();
            $in['id'] = $id;
            $in['server'] = trim($this->input->post('server'));
            $in['name'] = trim($this->input->post('name'));
            $in['port'] = trim($this->input->post('port'));
            $in['practice_code'] = trim($this->input->post('practice_code'));
            $in['status'] = $this->input->post('status'); 

            if ($id>0 && $in['server']!='' && $in['name']!='' && $in['port']>0 && $in['practice_code']!='') {
                $id = $this->Servers_model->update($in);
                if ($id>0) {
                    $data['message'] = 'Record updated';
                } else {
                    $data['message'] = 'Failed to update record';
                }
            } else {
                $data['message'] = 'Invalid input';
            }
            $data = array_merge($data, $in);
        }
        
        $res = $this->Servers_model->retreive($id);
        if (is_array($res) && count($res)>0) {
            $item = $res[0];
            $data['server'] = $item['server'];
            $data['name'] = $item['name'];
            $data['port'] = $item['port'];
            $data['practice_code'] = $item['practice_code'];
            $data['status'] = $item['status'];
        }        

        $this->load->view('/tmpl/header_authsecure', $data);
        $this->load->view('/crud/view_servers_update', $data);
        $this->load->view('/tmpl/footer_authsecure', $data);
    }

    public function serverdelete() {
        $this->checkSession();
        $id = $this->input->get('id');
        if ($id>0) {
            $this->load->model('Servers_model'); // call model
            $this->Servers_model->delete($id);
        }
        redirect(base_url().'crud/servers');
    }

    public function practiceregistration() {
        $this->checkSession();
        $data = array();

        $this->load->model('Practiceregistration_model'); // call model
        $res = $this->Practiceregistration_model->retreive();
        $data['res'] = $res;

        $this->load->view('tmpl/header_authsecure', $data);
        $this->load->view('crud/view_practiceregistration', $data);
        $this->load->view('tmpl/footer_authsecure', $data);
    }

    public function practiceregistrationcreate() {
        $this->checkSession();
        $data = array();
        $data['firstname'] = '';
        $data['lastname'] = '';
        $data['username'] = '';
        $data['online_username'] = '';
        $data['practice_code'] = '';
        $data['country'] = 'US';
        $data['status'] = 1;
        $data['message'] = ''; 

        $this->load->model('Practiceregistration_model'); // call model

        if ($_POST) {
            $in = array();
            $in['firstname'] = trim($this->input->post('firstname'));
            $in['lastname'] = trim($this->input->post('lastname'));
            $in['username'] = trim($this->input->post('username'));
            $in['online_username'] = trim($this->input->post('online_username'));
            $in['practice_code'] = trim($this->input->post('practice_code'));
            $in['country'] = trim($this->input->post('country'));
            $in['status'] = (int)$this->input->post('status'); 
            
            if ($in['username']!='' && $in['online_username']!='' && $in['practice_code']!=''
                    && $in['firstname']!='' && $in['lastname']!='' && $in['country']!='') {
                $id = $this->Practiceregistration_model->create($in);
                if ($id>0) {
                    redirect(base_url().'/crud/practiceregistrationupdate?id='.$id);
                    return;
                } else {
                    $data['message'] = 'Failed to create record';
                }
            } else {
                $data['message'] = 'Invalid input';
            }
            $data = array_merge($data, $in);
        }

        $this->load->view('tmpl/header_authsecure', $data);
        $this->load->view('crud/view_practiceregistration_create', $data);
        $this->load->view('tmpl/footer_authsecure', $data);
    }

    public function practiceregistrationupdate() {
        $this->checkSession();
        $data = array();
        $data['firstname'] = '';
        $data['lastname'] = '';
        $data['username'] = '';
        $data['online_username'] = '';
        $data['practice_code'] = '';
        $data['country'] = 'US';
        $data['status'] = 1;
        $data['completed'] = date('Y-m-d H:i:s');
        $data['message'] = '';  

        $this->load->model('Practiceregistration_model'); // call model

        $id = $this->input->get('id');
        $data["id"] = $id;
        if ($_POST) {
            $in = array();
            $in['id'] = $id;
            $in['firstname'] = trim($this->input->post('firstname'));
            $in['lastname'] = trim($this->input->post('lastname'));
            $in['username'] = trim($this->input->post('username'));
            $in['online_username'] = trim($this->input->post('online_username'));
            $in['practice_code'] = trim($this->input->post('practice_code'));
            $in['country'] = trim($this->input->post('country'));
            $in['completed'] = trim($this->input->post('completed'));
            $in['status'] = (int)$this->input->post('status'); 

            if ($id>0 && $in['username']!='' && $in['online_username']!='' && $in['practice_code']!=''
                    && $in['firstname']!='' && $in['lastname']!='' && $in['country']!='') {
                $id = $this->Practiceregistration_model->update($in);
                if ($id>0) {
                    $data['message'] = 'Record updated';
                } else {
                    $data['message'] = 'Failed to update record';
                }
            } else {
                $data['message'] = 'Invalid input';
            }
            $data = array_merge($data, $in);
        }
        
        $res = $this->Practiceregistration_model->retreive($id);
        if (is_array($res) && count($res)>0) {
            $item = $res[0];
            $data['firstname'] = $item['firstname'];
            $data['lastname'] = $item['lastname'];
            $data['username'] = $item['username'];
            $data['online_username'] = $item['online_username'];
            $data['practice_code'] = $item['practice_code'];
            $data['country'] = $item['country'];
            $data['completed'] = $item['completed'];
            $data['status'] = $item['status'];
        }

        $this->load->view('tmpl/header_authsecure', $data);
        $this->load->view('crud/view_practiceregistration_update', $data);
        $this->load->view('tmpl/footer_authsecure', $data);
    }

    public function practiceregistrationdelete() {
        $this->checkSession();
        $id = $this->input->get('id');
        if ($id>0) {
            $this->load->model('Practiceregistration_model'); // call model
            $this->Practiceregistration_model->delete($id);
        }
        redirect(base_url().'/crud/practiceregistration');
    }

    public function applicationcreate() {
        $this->checkSession();
        $data = array();
        $data['promocode'] = '';
        $data['practicecode'] = '';
        $data['practicenpi'] = '';
        $data['practiceein'] = '';
        $data['clinicid'] = '';
        $data['clinicname'] = '';

        $data['contact_prefix'] = '';
        $data['contact_firstname'] = '';
        $data['contact_middlename'] = '';
        $data['contact_lastname'] = '';
        $data['contact_suffix'] = '';

        $data['street1'] = '';
        $data['street2'] = '';
        $data['city'] = '';
        $data['state'] = '';
        $data['zipcode'] = '';
        $data['country'] = 'US';
        
        $data['contact_email'] = '';
        $data['username'] = '';
        $data['password'] = '';
        $data['fax'] = '';
        $data['phone'] = '';

        $data['message'] = ''; 
      
        $this->load->model('Applications_model'); // call model
        $this->load->model('Practice_model'); // call model
        $this->load->model('Specialty_model');

        if ($_POST) {
            $in = array();
            $in['promocode'] = trim($this->input->post('promocode'));
            $in['practicecode'] = trim($this->input->post('practicecode'));
            $in['practicenpi'] = trim($this->input->post('practicenpi'));
            $in['practiceein'] = trim($this->input->post('practiceein'));
            $in['clinicid'] = trim($this->input->post('clinicid'));
            $in['clinicname'] = trim($this->input->post('clinicname'));
            
            $in['contact_prefix'] = trim($this->input->post('contact_prefix'));
            $in['contact_firstname'] = trim($this->input->post('contact_firstname'));
            $in['contact_middlename'] = trim($this->input->post('contact_middlename'));
            $in['contact_lastname'] = trim($this->input->post('contact_lastname'));
            $in['contact_suffix'] = trim($this->input->post('contact_suffix'));

            $in['street1'] = trim($this->input->post('street1'));
            $in['street2'] = trim($this->input->post('street2'));
            $in['city'] = trim($this->input->post('city'));
            $in['state'] = trim($this->input->post('state'));
            $in['zipcode'] = trim($this->input->post('zipcode'));
            $in['country'] = trim($this->input->post('country'));
            
            $in['contact_email'] = trim($this->input->post('contact_email')); 
            $in['username'] = trim($this->input->post('username'));
            $in['password'] = trim($this->input->post('password'));
            $in['fax'] = trim($this->input->post('fax'));
            $in['phone'] = trim($this->input->post('phone'));
            
            if ($in['practicenpi']!='' && $in['username']!='' && $in['password']!=''
                    && $in['clinicname']!='' && $in['contact_email']!='' && $in['country']!='') {
                list($data, $error_message) = $this->Practice_model->create_practice($in);
                if (is_array($data) && count($data)>0 && array_key_exists('practicereferencenumber',$data)) {
                    //redirect('/crud/applicationupdate?session='.$_SESSION["session"].'&practicereferencenumber='.$practicereferencenumber);
                    //return;
                    //var_dump($data);
                    $data["message"] = $error_message;
                } else {
                    $data['message'] = 'Failed to create record: <pre>'.$error_message.'</pre>';
                }
            } else {
                $data['message'] = 'Invalid input';
            }
            $data = array_merge($data, $in);
        }
        //$data['practicetype_combobox'] = $this->Specialty_model->ComboBox('practicetype',$data['practicetype']);
        
        $this->load->view('/tmpl/header_authsecure', $data);
        $this->load->view('/crud/view_applications_create', $data);
        $this->load->view('/tmpl/footer_authsecure', $data);
    }

    public function applicationupdate() {
        $this->checkSession();
        $data = array();
        $data['practicename'] = '';
        $data['street1'] = '';
        $data['street2'] = '';
        $data['city'] = '';
        $data['state'] = '';
        $data['zipcode'] = '';
        $data['country'] = 'US';
        $data['taxid'] = '';
        $data['practicenpi'] = '';
        $data['practicetype'] = '';
        $data['fax'] = '';
        $data['phone'] = '';
        $data['contact_email'] = '';
        $data['contact_firstname'] = '';
        $data['contact_lastname'] = '';
        $data['username'] = '';
        $data['password'] = '';
        $data['verification_link'] = '';
        $data['status'] = 1;
        $data['verify_date'] = '';
        $data['start_date'] = '';
        $data['practicereferencenumber'] = '';
        $data['statuscode'] = 0;
        $data['port_number'] = 0;
        $data['message'] = '';  

        $this->load->model('Applications_model'); // call model
        $this->load->model('Specialty_model');

        $id = $this->input->get('id');
        $data["id"] = $id;
        
        if ($_POST) {
            $in = array();
            $in['id'] = $id;
            $in['practicename'] = trim($this->input->post('practicename'));
            $in['street1'] = trim($this->input->post('street1'));
            $in['street2'] = trim($this->input->post('street2'));
            $in['city'] = trim($this->input->post('city'));
            $in['state'] = trim($this->input->post('state'));
            $in['zipcode'] = trim($this->input->post('zipcode'));
            $in['country'] = trim($this->input->post('country'));
            $in['taxid'] = trim($this->input->post('taxid'));
            $in['practicenpi'] = trim($this->input->post('practicenpi'));
            $in['practicetype'] = trim($this->input->post('practicetype'));
            $in['fax'] = trim($this->input->post('fax'));
            $in['phone'] = trim($this->input->post('phone'));
            $in['contact_email'] = trim($this->input->post('contact_email'));
            $in['contact_firstname'] = trim($this->input->post('contact_firstname'));
            $in['contact_lastname'] = trim($this->input->post('contact_lastname'));
            $in['username'] = trim($this->input->post('username'));
            $in['password'] = trim($this->input->post('password'));
            $in['verification_link'] = trim($this->input->post('verification_link'));
            $in['status'] = (int)$this->input->post('status'); 
            $in['verify_date'] = trim($this->input->post('verify_date'));;
            $in['start_date'] = trim($this->input->post('start_date'));;
            $in['practicereferencenumber'] = trim($this->input->post('practicereferencenumber'));
            $in['statuscode'] = (int)$this->input->post('statuscode');
            $in['port_number'] = (int)$this->input->post('port_number');

            if ($in['practicename']!='' && $in['username']!='' && $in['password']!=''
                    && $in['practicetype']!='' && $in['contact_email']!='' && $in['country']!='') {

                $savedModelId = $this->Applications_model->update($in);
                if ($savedModelId > 0) {
                    $data['message'] = 'Record updated';
                } else {
                    $data['message'] = 'Failed to update record';
                }
            } else {
                $data['message'] = 'Invalid input';
            }
            $data = array_merge($data, $in);
        }
        
        $res = $this->Applications_model->retreive($id);
        
        if (is_array($res) && count($res)>0) {
            $item = $res[0];
            $data['practicename'] = $item['practicename'];
            $data['street1'] = $item['street1'];
            $data['street2'] = $item['street2'];
            $data['city'] = $item['city'];
            $data['state'] = $item['state'];
            $data['zipcode'] = $item['zipcode'];
            $data['country'] = $item['country'];
            $data['taxid'] = $item['taxid'];
            $data['practicenpi'] = $item['practicenpi'];
            $data['practicetype'] = (int) $item['practicetype'];
            $data['fax'] = $item['fax'];
            $data['phone'] = $item['phone'];
            $data['contact_email'] = $item['contact_email'];
            $data['contact_firstname'] = $item['contact_firstname'];
            $data['contact_lastname'] = $item['contact_lastname'];
            $data['username'] = $item['username'];
            $data['password'] = $item['password'];
            $data['verification_link'] = $item['verification_link'];
            $data['status'] = $item['status'];
            $data['verify_date'] = $item['verify_date'];
            $data['start_date'] = $item['start_date'];
            $data['practicereferencenumber'] = $item['practicereferencenumber'];
            $data['statuscode'] = $item['statuscode'];
            $data['port_number'] = $item['port_number'];
        }

        $data['practicetype_combobox'] = $this->Specialty_model->ComboBox('practicetype',$data['practicetype']);
        
        $this->load->view('/tmpl/header_authsecure', $data);
        $this->load->view('/crud/view_applications_update', $data);
        $this->load->view('/tmpl/footer_authsecure', $data);
    }

    public function applicationdelete() {
        $this->checkSession();
        $id = $this->input->get('id');
        if ($id>0) {
            $this->load->model('Applications_model'); // call model
            $this->Applications_model->delete($id);
        }
        redirect(base_url().'/crud/applications?session='.$_SESSION["session"]);
    }
}
