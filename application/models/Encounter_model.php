<?php

class Encounter_model extends CI_Model {

    function __construct() {
        
    }

    public function get_patientencounter($accountNumber) {
        global $automedsys;
        //$automedsys = new automedsys_api_oameye\Automedsys();
        global  $error_message;
        $encounters = array();
        $url = $_SESSION["server"] . $automedsys->cfgReadChar("auxpro.patient_dm_care_endpoint");
        try {
            $client = new SoapClient($url, array("trace" => 1, "exception" => 0));
            $res = $client->__soapCall("GetEncounterList", array(
                "GetEncounterList" => array(
                    "encounterFilter" => array(
                        "AutoMedSysChartNo" => $accountNumber,
                        "ProviderID" => 1
                    ),
                    "authToken" => $_SESSION["authToken"]
                )
            ));
            if (is_object($res->GetEncounterListResult)) {
                if (is_array($res->GetEncounterListResult->EncounterHdrType)) {
                    $encounters = $this->objectToArray($res->GetEncounterListResult->EncounterHdrType);
                } else {
                    $encounters = array($this->objectToArray($res->GetEncounterListResult->EncounterHdrType));
                }
            }
        } catch (Exception $e) {
            //$error_message = "Failure: ".$e->getMessage();
            $error_message = "Service failure, please try again later";
        }
        return $encounters;
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
