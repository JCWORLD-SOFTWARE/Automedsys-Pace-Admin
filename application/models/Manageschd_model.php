<?php

class Manageschd_model extends CI_Model {

    function __construct() {
        
    }

    public function manage_schedule($startDate, $endDate) {
        global $automedsys;
        //$automedsys = new automedsys_api_oameye\Automedsys();

        $res = array();

     //   $startDate = date("Y-m-d");
      //  $endDate = date("Y-m-d", strtotime("+30 days"));

        $server = $_SESSION["server"];
        $url = $server . $automedsys->cfgReadChar("auxpro.practice_admin_appointment_endpoint");
        try {
            $client = new SoapClient($url, array("trace" => 1, "exception" => 0));
            $result = $client->__soapCall("GetAppointmentList", array(
                "GetAppointmentList" => array(
                    "startDate" => $startDate,
                    "endDate" => $endDate,
                    "authToken" => $_SESSION["authToken"]
            )));
            //  print_r($result);
            
         //   if (0 == (int) $result->GetAppointmentListResult->StatusCode && 0 == (int) $result->GetAppointmentListResult->ErrorCode) {
                // if (0 == (int) $result->GetAppointmentListResult->StatusCode ) {
                    if (0<5 ) {   
                     
                $data = @json_decode((string) $result->GetAppointmentListResult);
                foreach (@$data->Table as $item) {
                    $r = $this->objectToArray($item);
                    $t = strtotime(date("Y-m-d", strtotime($r["app_date"])) . " " . $r["app_time"]);
                    $res[] = array(
                        "title" => "\n" . $r["firstname"] . " " . $r["lastname"] . "\n" . $r["phone"],
                        "start" => date("Y-m-d H:i", $t),
                        "end" => date("Y-m-d H:i", strtotime("+ " . $r["app_duration"] . " minutes", $t)),
                        "url" => "javascript:alert('TEST')",
                        "AccountNumber" => $r["id"],
                        "AppDate" => $r["app_date"],
                        "FullName" => $r["firstname"] . " " . $r["lastname"],
                        "Gender" => $r["gender"],
                        "MaritalStatus" => $r["status"],
                        "Profile" => $r["patient_id"],
                        "Phone" => $r["phone"],
                        "Records" => "What is it?"
                    );
                    //$r["note"]
                }
            } else {
                //$error_message = "Login failed: ".$result->GetAppointmentListResult->ErrorMessage."<br/>".$result->GetAppointmentListResult->Suggestion;
            }
        } catch (Exception $e) {
            //$error_message = "Failure: ".$e->getMessage();
        }

        return $res;
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
