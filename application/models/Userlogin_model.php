<?php

class Userlogin_model extends CI_Model {

    function __construct() {
        
    }

    public function user_login($in) {
        global $automedsys;
        //$automedsys = new automedsys_api_oameye\Automedsys();

        $error_message = "";
        $account_id = 0;
        $authToken = array();
        $practice_info = array();
	    $user_info = array();
        $server = "";
        $q = "SELECT id, id AS member_id, username, status, added FROM bko_users WHERE status=1 AND username = '" . pg_escape_string($in["online_username"]) . "'";
        $r = pg_query($q);
        if ($r && pg_num_rows($r) && $y = pg_fetch_assoc($r)) {
            $url = $automedsys->cfgReadChar("auxpro.pace_endpoint");
            //echo $url."\n";
            try {
                $client = new SoapClient($url, array("trace" => 1, "exception" => 0));
                $result = $client->__soapCall("LoginPracticeAdmin", array(
                    "LoginPracticeAdmin" => array(
                        "username" => $y["username"],
                        "userpwd" => $in["password"]
                )));
                print_r($result); // LoginPracticeAdminResult
                //echo '>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>88888888888888888>>>>>>>>>>>>>>>>>>>>>>>>>>>>>';
                if (is_object($result) && property_exists($result,'LoginPracticeAdminResult') 
                    && is_object($result->LoginPracticeAdminResult) && 0 == (int)$result->LoginPracticeAdminResult->ErrorCode) {
                        $error_message = "";
                        $account_id = $y["id"];
                        $authToken = ["SessionId"=>(string)$result->LoginPracticeAdminResult->MiscField1];
                        $practice_info = $this->objectToArray($result->LoginPracticeAdminResult);
                        $server = $url;
                        $user_info = $y;
                } else {
                    if (is_object($result) && property_exists($result,'LoginPracticeAdminResult') && is_object($result->LoginPracticeAdminResult)) {
                        // $error_message = "Login failed: " . $result->LoginPracticeAdminResult->ErrorMessage . "<br/>" . $result->LoginPracticeAdminResult->Suggestion;
                        $error_message = "Login failed: " ;

                    } else {
                        $error_message = "Unknown error!";
                    }
                }
            } catch (Exception $e) {
                $error_message = "Failure: ".$e->getMessage().$e->getTraceAsString();
                //$error_message = "Service failure, please try again later";
            }
        } else {
            $error_message = "Invalid Username/Password";
        }
        return array($error_message, $account_id, $authToken, $practice_info, $server,$user_info);
    }

    function objectToArray($d) {
        if (is_object($d)) {
            $d = get_object_vars($d);
        }
        if (is_array($d)) {
            return array_map(null, $d);
              //return array_map(__FUNCTION__, $d);
        } else {
            return $d;
        }
    }

}
