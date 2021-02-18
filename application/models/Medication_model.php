<?php

class Medication_model extends CI_Model {

    function __construct() {
        
    }

    public function get_patientmedication($recordId) {
        global $automedsys;
        //$automedsys = new automedsys_api_oameye\Automedsys();
        
        global $error_message;
	$medications = array();
	$url = $_SESSION["server"] . $automedsys->cfgReadChar("auxpro.patient_dm_medication_endpoint");
	try {
		$client = new SoapClient($url, array("trace" => 1, "exception" => 0));
		$res = $client->__soapCall("GetMedicationList", array(
      "GetMedicationList" => array(
        "patientRecordId" => $recordId,
        "authToken" => $_SESSION["authToken"]
      )
    ));
		if (is_object($res->GetMedicationListResult)) {
      if (is_array($res->GetMedicationListResult->PatientMedicationType)) {
        $medications = $this->objectToArray($res->GetMedicationListResult->PatientMedicationType);
      } else {
        $medications = array($this->objectToArray($res->GetMedicationListResult->PatientMedicationType));
      }
    }
	} catch(Exception $e) {
		//$error_message = "Failure: ".$e->getMessage();
		$error_message = "Service failure, please try again later";
	}
	return $medications;
        

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
