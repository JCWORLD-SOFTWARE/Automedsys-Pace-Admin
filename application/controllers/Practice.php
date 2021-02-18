<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Practice extends CI_Controller {

    public function index() {
        $this->showHomePage();
         }


    function objectToArray($d) {
        if (is_object($d)) {
            $d = get_object_vars($d);
        }
        if (is_array($d)) {
            return array_map(__FUNCTION__, $d);
        } else {
            return $d;
        }
    }

  public function register() {
            $this->showHomePage();
    }

      public function resetpass() {
            $this->showHomePage();
    }

    
    private function showHomePage()
    {
	global $automedsys;
        $data = array();
        $data['error_message'] = '';

        if ($_POST) {


            $username = $data['username'] = $this->input->post('username'); // '08174596144';
            $password = $data['password'] = $this->input->post('password'); //'7978'; 

            if ($username != '' AND $password != '') {

                $in = array();
                $out = array();

                $in["action"] = AUTOMEDSYS_PRACTICE_LOGIN;
                $in["online_username"] = $username;
                $in["password"] = $password;
                $in["loc"] = '192.168.2.100'; //get_client_ip();
                // load the user login model 
                $this->load->model('Userlogin_model'); // call model
                $this->load->model('Practice_model');

                list($error_message, $account_id, $authToken, $practice_info, $server, $user_info) = $this->Userlogin_model->user_login($in);

                if ($error_message == "" && $account_id > 0 && count($authToken) > 0 && isset($practice_info["PracticeReferenceNumber"])) {
                    //$automedsys = new automedsys_api_oameye\Automedsys();
                    $in["session"] = $authToken["SessionId"];
                    $in["account_id"] = $account_id;

                    $ret = $automedsys->automedsys_api($in, $out);

                    if ($ret == AUTOMEDSYS_VALID_LOGIN && $out["member_id"] > 0) {
                        $_SESSION["uid"] = $out["member_id"];
                        //$_SESSION["firstname"] = $out["firstname"];
                        //$_SESSION["lastname"]  = $out["lastname"];
                        //$_SESSION["email"]     = $out["email"];
                        $_SESSION["customer"] = $out;
                        $_SESSION["authToken"] = $authToken;
                        $_SESSION["practice_info"] = $practice_info;
                        $_SESSION['user_info'] = $user_info;
                        $_SESSION["session"] = $authToken['SessionId'];
                        $_SESSION["practice_code"] = $practice_info["PracticeReferenceNumber"];
                        $_SESSION["server"] = $server;
                        header('Location: schedule.html');
                        redirect('practiceuser');
                        //exit();
                    } else {
                        $error_message = "Invalid Username/Password";
                    }
                }
            } else {
                $data['error_message'] = "All fields required";
            }
        }


        $this->load->view('tmpl/header_practicelogin', $data);
        $this->load->view('practice/view_practiceindex', $data);
        $this->load->view('tmpl/footer_practicelogin', $data); 
    }
}
