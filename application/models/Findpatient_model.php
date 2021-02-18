<?php

class Findpatient_model extends CI_Model {

    function __construct() {
        
    }

    public function find_patient($search_key, $search_val) {
        global $automedsys;
        //$automedsys = new automedsys_api_oameye\Automedsys();

        $error_message = "";
        $result = array();
        $url = $_SESSION["server"] . $automedsys->cfgReadChar("auxpro.patient_dm_endpoint");

        $search_by = array(
            "AutoMedSysChartNo" => "AutoMedSys Chart Number",
            "SocialSecurity" => "Social Security Number",
            "AutoMedSysRecordId" => "AutoMedSys Record ID",
            "MedicareNumber" => "Medicare Number",
            "MedicaidNumber" => "Medicaid Number",
            "AutoMedSysLastname" => "AutoMedSys Lastname",
        );

        // $search_key = GetPostVar("search_key", "AutoMedSysLastname");
        // $search_val = GetPostVar("search_val", "ameye");

        if ($search_key == "" && $search_val == "" && isset($_SESSION["search_key"])) {
            $search_key = $_SESSION["search_key"];
            $search_val = $_SESSION["search_val"];
            unset($_SESSION["search_key"]);
            unset($_SESSION["search_val"]);
        }

        if (!isset($search_by[$search_key])) {
            $search_key = "AutoMedSysLastname";
        }

        try {
            $client = new SoapClient($url, array("trace" => 1, "exception" => 0));
            $result = $client->__soapCall("GetPatientList", array(
                "GetPatientList" => array(
                    "AccessControl" => $_SESSION["authToken"],
                    "PatientIDList" => array(
                        "PatientIDType" => array($search_key => $search_val)
                    )
            )));

         // StatusCode   if (0 == (int) $result->GetPatientListResult->StatusCode && 0 == (int) $result->GetPatientListResult->ErrorCode) {
                 if (0 == (int) $result->GetPatientListResult->ErrorCode) {
                if (is_array($result->GetPatientListResult->PatientList->PatientType)) {
                    $result = $this->objectToArray($result->GetPatientListResult->PatientList->PatientType);
                } else {
                    $result = array($this->objectToArray($result->GetPatientListResult->PatientList->PatientType));
                }
            }
//var_dump($client);
        } catch (Exception $e) {
            //$error_message = "Failure: ".$e->getMessage();
            $error_message = "Service failure, please try again later";
        }

        return $result;
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
