<?php

defined('BASEPATH') or exit('No direct script access allowed');

class OAuth extends CI_Controller
{

    public function index()
    {
        // $this->load->library('session');

        $data = array();
        $data['error_message'] = '';

        try{
        $url = parse_url($_SERVER['REQUEST_URI']);
        $data = $this->uri->uri_to_assoc();
        $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $decoded = urldecode($actual_link);
        $rr = explode("&", $decoded);

        $AuthorizationCode = str_replace("code=", "", $rr[1]);
        //echo 'Authorization Code' . $AuthorizationCode;

        //echo 'All'. $rr[0];
        $splited =  explode("?", $rr[0]);
        if(!$splited){
            $this->load->view('errprs/404page' );
            return;
        }


        $splittwo = explode("=", $splited[1]);
        if(!$splittwo){
            $this->load->view('errprs/404page' );
            return;
        }

        $splitthree =  explode("|", $splittwo[1]);
        if(!(isset($splitthree[1]) && isset($splitthree[0]))){
            $this->load->view('errors/404page');
            return;
        }
        //echo 'ProviderId=' . $splitthree[0]; // providerid
        //echo 'ClientId=' . $splitthree[1]; // client id
        $ProviderId = $splitthree[0];
        $ClientId = $splitthree[1];
        $data = array(
            'AuthorizationCode' => $AuthorizationCode,
            'ClientId' => $ClientId,
            'IdentityProvider' => $ProviderId,
            'TokenRequestType' => '0',
            'RedirectUrl' => $this->getUrl()
        );

        //  print_r($data);
        $data_string = json_encode($data);

        $url = $this->gettokenUrl();
        $ch = $curl = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data_string,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
            ),
        ));

        $result = curl_exec($curl);
        if($result === false) {
            echo 'Curl error: ' . curl_error($curl);
        } else {
            // echo 'Operation completed without any errors';
            $data = json_decode($result);
            // print_r($data);
            
            $_SESSION["uid"] = $data->ResponseData->UserInformation->Role;
            $_SESSION["username"] = $data->ResponseData->UserInformation->LastName;
            $_SESSION["user_info"] = $data->ResponseData->UserInformation;
            $_SESSION["session"] = $data->ResponseData->UserInformation->MiscField1;
            $this->session->set_userdata('FirstName', $data->ResponseData->UserInformation->FirstName);
            $this->session->set_userdata('LastName', $data->ResponseData->UserInformation->LastName);
            $this->session->set_userdata('sessionId', $data->ResponseData->UserInformation->MiscField1);
            $this->session->set_userdata('Email', $data->ResponseData->UserInformation->Email);
            $this->session->set_userdata('Picture', $data->ResponseData->UserInformation->Picture);
            $this->session->set_userdata('Role', $data->ResponseData->UserInformation->Role);
    
            $_SESSION["FirstName"] = $data->ResponseData->UserInformation->FirstName;
            $_SESSION["LastName"] = $data->ResponseData->UserInformation->LastName;
            //  print_r($data);
    
            redirect('authuser');
        }
        curl_close($curl);

    }catch (Exception $e) {
       echo "Failure: ".$e->getMessage();
    }
    }


    function objectToArray($d)
    {
        if (is_object($d)) {
            $d = get_object_vars($d);
        }
        if (is_array($d)) {
            return array_map(__FUNCTION__, $d);
        } else {
            return $d;
        }
    }

    function getUrl()
    {
        $url = "";
        if ($_SERVER['HTTP_HOST'] == "localhost:8888") {
            $url = 'http://localhost:8888/automedsys-pace-admin/oauth';
        } else if ($_SERVER['HTTP_HOST'] == "qa-pace.automedsys.net") {
            $url = 'https://qa-pace.automedsys.net/oauth';
        } else if ($_SERVER['HTTP_HOST'] == "dev-pace.automedsys.net") {
            $url = 'https://dev-pace.automedsys.net/oauth';
        }
        return $url;
    }

    function gettokenUrl()
    {
        $url = "";
        if ($_SERVER['HTTP_HOST'] == "localhost:8888") {
            $url = 'https://dev-api.automedsys.net/emrapi/v1/identity/oauthx/token';
        } else if ($_SERVER['HTTP_HOST'] == "qa-pace.automedsys.net") {
            $url = 'https://qa-api.automedsys.net/emrapi/v1/identity/oauthx/token';
        } else if ($_SERVER['HTTP_HOST'] == "dev-pace.automedsys.net") {
            $url = 'https://dev-api.automedsys.net/emrapi/v1/identity/oauthx/token';
        }
        return $url;
    }
}
