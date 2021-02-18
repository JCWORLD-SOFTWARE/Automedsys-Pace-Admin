<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function index() {

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

                if ($error_message == "" && $account_id > 0 && count($authToken) > 0) { // && isset($practice_info["PracticeReferenceNumber"])) {
                    $_SESSION["uid"] = $account_id;
                    $_SESSION["username"] = $username;
                    $_SESSION["user_info"] = $user_info;
                    $_SESSION["session"] = $authToken["SessionId"];

                    //print_r($account_id);
                    //print_r($username);
                    //print_r($user_info);
                    redirect('authuser');
                    /*$automedsys = new automedsys_api_oameye\Automedsys();
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
                        $_SESSION["session"] =  $authToken['SessionId'];
                        $_SESSION["practice_code"] = $practice_info["PracticeReferenceNumber"];
                        $_SESSION["server"] = $server;
                        header('Location: schedule.html');
                        redirect('authuser');
                        //exit();
                    } else {
                        $error_message = "Invalid Username/Password";
                    }//*/
                }else{
                    $data['error_message'] = "Invalid Username/Password";
                }
            } else {
                $data['error_message'] = "All fields required";
            }
        }


        $this->load->view('tmpl/header_authlogin', $data);
        $this->load->view('auth/view_authindex', $data);
        $this->load->view('tmpl/footer_authlogin', $data);
    }

    /*
     * THIS FUNCTION MOVED TO PRACTICE MODEL
      function get_practice($authToken, $recordId) {
      global $automedsys;
      $error_message = "";
      $organization = array();
      $url = $_SESSION["server"] . $automedsys->cfgReadChar("auxpro.practice_admin_endpoint");
      try {
      $client = new SoapClient($url, array("trace" => 1, "exception" => 0));
      $result = $client->__soapCall("GetOrganization", array(
      "GetOrganization" => array(
      "authToken" => $authToken,
      "RecordId" => $recordId
      )));
      // var_dump($client);exit();
      if ("" != (string) $result->GetOrganizationResult->RecordID && "0" != (string) $result->GetOrganizationResult->RecordID) {
      $organization = objectToArray($result->GetOrganizationResult);
      } else {
      $error_message = "GetOrganization failed: " . $result->GetOrganizationResult->ErrorMessage . "<br/>" . $result->GetOrganizationResult->Suggestion;
      }
      } catch (Exception $e) {
      //$error_message = "Failure: ".$e->getMessage();
      $error_message = "Service failure, please try again later";
      // var_dump($e);exit();
      }
      return array($error_message, $organization);
      }

     * 
     */

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

}
