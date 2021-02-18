<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Practiceuser extends CI_Controller {

    public function index() {
        $data = array();
        $data['screen'] = '';
        $data['ident_key'] = '';
        $data['ident_val'] = '';

        // print_r( $_SESSION["practice_info"]);
        //$_SESSION["authToken"]["Username"] = 'Dummy value';
        // $_SESSION["session"] = 'dummy-dummy---';

        $this->load->view('tmpl/header_practicesecure', $data);
        $this->load->view('practice/view_practiceuser', $data);
        $this->load->view('tmpl/footer_practicesecure', $data);
    }

    public function schedule() {
        $data = array();
        $this->load->view('tmpl/header_practicesecure', $data);
        $this->load->view('securecommon/view_schedule', $data);
        $this->load->view('tmpl/footer_practicesecure', $data);
    }

    public function logout() {
        redirect('practice');
    }

    public function findpatient() {
        $data = array();
        $data['search_val'] = '';
        $data['search_key'] = '';
        $result = array();
        $data['result'] = $result;

        if ($_POST) {

            $search_key = $data['search_key'] = $this->input->post('search_key'); // '08174596144';
            $search_val = $data['search_val'] = $this->input->post('search_val'); //'7978'; 

            $this->load->model('Findpatient_model'); // call model
            $result = $this->Findpatient_model->find_patient($search_key, $search_val);

            //   print_r($result);
            $data['result'] = $result;
        }

        $search_by = array(
            "AutoMedSysChartNo" => "AutoMedSys Chart Number",
            "SocialSecurity" => "Social Security Number",
            "AutoMedSysRecordId" => "AutoMedSys Record ID",
            "MedicareNumber" => "Medicare Number",
            "MedicaidNumber" => "Medicaid Number",
            "AutoMedSysLastname" => "AutoMedSys Lastname",
        );

        $data['search_by'] = $search_by;

        $this->load->view('tmpl/header_practicesecure', $data);
        $this->load->view('securecommon/view_findpatient', $data);
        $this->load->view('tmpl/footer_practicesecure', $data);
    }

    public function manageschedule() {
        $data = array();

        $this->load->model('Manageschd_model'); // call model
        $res = $this->Manageschd_model->manage_schedule('2015-01-01', '2017-01-01');
        $data['res'] = $res;

        // print_r($res);

        $this->load->view('tmpl/header_practicesecure', $data);
        $this->load->view('securecommon/view_manageschedule', $data);
        $this->load->view('tmpl/footer_practicesecure', $data);
    }

    public function patientprofile() {
        // echo 'yes';

        echo $AutoMedSysChartNo = $data['AutoMedSysChartNo'] = $this->input->post('AutoMedSysChartNo'); // '08174596144';

        $data = array();
        $this->load->view('tmpl/header_practicesecure', $data);
        $this->load->view('securecommon/view_patientprofile', $data);
        $this->load->view('tmpl/footer_practicesecure', $data);
    }

    public function patientrecords() {
	global $automedsys;    
	echo $AutoMedSysChartNo = $data['AutoMedSysChartNo'] = $this->input->post('AutoMedSysChartNo'); // '08174596144';
        $data = array();
        $data['screen'] = '';
        $data['ident_key'] = '';
        $data['ident_val'] = '';

        //$automedsys = new automedsys_api_oameye\Automedsys();

        $error_message = "";
        $result = array();
        $medications = array();
        $encounters = array();
        $url = $_SESSION["server"] . $automedsys->cfgReadChar("auxpro.patient_dm_endpoint");

        $what = "AutoMedSysChartNo";
        $value = $this->input->post("AutoMedSysChartNo", "");
        $PatientId = $this->input->post("AutoMedSysRecordId", "");

        if ($PatientId != "") {
            $what = "AutoMedSysRecordId";
            $value = $PatientId;
        }

        $ident_key = $what;
        $ident_val = $value;
        
        
$what = "AutoMedSysChartNo";
        $value='TT000868';

        echo "#################-- what = $what-> whic is value-> $value --#########################";
// TODOL Get portrait
// https://staging.automedsys.net:4439/AUXPRO/AuxProPatientDMService/PDMService.asmx?op=GetPatientPortrait

        $result = $this->get_patient($what, $value);
        if (isset($result["AccountNumber"]) && $result["AccountNumber"] != "") {

            $this->load->model('Encounter_model'); // call model         
            $encounters = $this->Encounter_model->get_patientencounter($result["AccountNumber"]);

            $this->load->model('Medication_model'); // call model         
            $medications = $this->Medication_model->get_patientmedication($result["RecordId"]);           
        }
        
        $data["medications"] = $medications;
        $data["encounters"] = $encounters;
        $data["result"] = $result;
        
        print_r($result);

        $this->load->view('tmpl/header_practicesecure', $data);
        $this->load->view('securecommon/view_patientrecords', $data);
        $this->load->view('tmpl/footer_practicesecure', $data);
    }

    function get_patient($what, $value) {
        global $automedsys; // = new automedsys_api_oameye\Automedsys();
        global $error_message;
        $result = array();
        $url = $_SESSION["server"] . $automedsys->cfgReadChar("auxpro.patient_dm_endpoint");
        try {
            $client = new SoapClient($url, array("trace" => 1, "exception" => 0));
            $res = $client->__soapCall("GetPatient", array(
                "GetPatient" => array(
                    "AuthToken" => $_SESSION["authToken"],
                    "PatientId" => array(
                        $what => $value
                    )
            )));
            // if (0 == (int) $res->GetPatientResult->StatusCode && 0 == (int) $res->GetPatientResult->ErrorCode) {
            if (4 > 1) {
                $result = $this->objectToArray($res->GetPatientResult);
            }
        } catch (Exception $e) {
            //$error_message = "Failure: ".$e->getMessage();
            $error_message = "Service failure, please try again later";
        }
        return $result;
    }

    public function electronicrx() {
        echo 'yes';
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
