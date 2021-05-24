<?php

class Findapplication_model extends CI_Model {

    function __construct() {
        
    }

    public $search_bys = array(
        "practicename" => "Practice Name",
        "practicenpi" => "Practice NPI",
        "practicereferencenumber" => "Practice Reference Number",
        "username" => "Username",
        "Phone" => "Phone",
        "contact_email" => "Contact E-mail",
        "city" => "City",
        "zipcode" => "Zip Code"
    );

    public function get_search_by() {
        return $this->search_bys;
    }

    public function find_application($search_key, $search_val) {
        $res = array();
        if ($search_key=="" || !array_key_exists($search_key,$this->search_bys)) {
            return $res;
        }
        $q = "SELECT * FROM application ";
        $q.= " WHERE ${search_key} ILIKE '%".pg_escape_string($search_val)."%'";
        $q.= " ORDER BY practicename";
        $r = pg_query($q);
        if ($r && pg_num_rows($r)) {
            while ($f=pg_fetch_assoc($r)) {
                $res[] = $f;
            }
        }
        return $res;
    }

    public function find_patient($search_key, $search_val) {
        global $automedsys;
        //$automedsys = new automedsys_api_oameye\Automedsys();

        $error_message = "";
        $result = array();
        $url = $_SESSION["server"] . $automedsys->cfgReadChar("auxpro.patient_dm_endpoint");

        $search_by = $this->search_bys;

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

    public function load_practice_request($offset=0,$limit=10,$practicecode="") {
        global $automedsys;
        //$automedsys = new automedsys_api_oameye\Automedsys();
        $data = NULL;
        $count = 0;
        $error_message = "";
        $url = $automedsys->cfgReadChar("auxpro.pace_endpoint");
        try {
            //setting the curl parameters.
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true );
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: text/xml; charset=utf-8',
                'SOAPAction: "http://automedsys.net/webservices/PracticeRequestList"'
            ));
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch, CURLOPT_POSTFIELDS, "<?xml version=\"1.0\" encoding=\"utf-8\"?>
            <soap:Envelope xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" xmlns:soap=\"http://schemas.xmlsoap.org/soap/envelope/\">
              <soap:Body>
                <PracticeRequestList xmlns=\"http://automedsys.net/webservices\">
                  <limit>${limit}</limit>
                  <offset>${offset}</offset>
                  <PracticeCode>${practicecode}</PracticeCode>
                  <sessionid>".$_SESSION["session"]."</sessionid>
                </PracticeRequestList>
              </soap:Body>
            </soap:Envelope>");

            $result = curl_exec($ch);
            curl_close($ch);

            // Massage SOAP envelope, so it is parseable by SimpleXMLElement class
            $result = str_replace(' xmlns="http://www.automedsys.com/messaging"','',$result);
            $result = str_replace(' xmlns="http://automedsys.net/webservices"','',$result);
            $result = str_replace('soap:','',$result);

            $xml = new SimpleXMLElement($result);

            if (is_object($xml) && property_exists($xml,'Body') 
             && is_object($xml->Body) && property_exists($xml->Body,'PracticeRequestListResponse') 
             && is_object($xml->Body->PracticeRequestListResponse) && property_exists($xml->Body->PracticeRequestListResponse,'PracticeRequestListResult')
             && is_object($xml->Body->PracticeRequestListResponse->PracticeRequestListResult)) {
                // Process response 
                $res = $xml->Body->PracticeRequestListResponse->PracticeRequestListResult;
                //var_dump($res);
                if (property_exists($res,'StatusCode') && (int)$res->StatusCode===0) {
                    // $res->Suggestion
                    // $res->MiscField2
                    // $res->MiscField1
                    $error_message = "";
                    $data = [];
                    $count = 0;
                    try {
                       $binaryStr = base64_decode((string)$res->MiscField1);
                       if ($binaryStr=="") {
                           throw new Exception("Empty binary string received - no application records found?");
                       }
                       $str = gzdecode($binaryStr);
                       $data = json_decode($str, true);
                       $count = (string)$res->MiscField2;
                    } catch (Exception $e) {
                       $error_message = $e->getMessage();
                    }
                    //var_dump($data);
                } else {
                    if (property_exists($res,'ErrorMessage') && ((string)$res->ErrorMessage)!="") {
                        $error_message = "Loading practice request list failed: " . $res->ErrorMessage . "<br/>" . $res->Suggestion;
                    } else {
                        $error_message = "Unknown error!";
                    } 
                }
             }
             /*
                    "ID": "1",
                    "PracticeName": "PACE Test Clinic International",
                    "promotion_code": "CHRISTMAS",
                    "username": "randomuser",
                    "userpwd": "password",
                    "Street1": "1234 Health Express Way",
                    "Street2": {},
                    "City": "Atlanta",
                    "State": "GA",
                    "ZipCode": "30303",
                    "Country": {},
                    "TaxID": "737282828",
                    "PracticeType": {},
                    "Admin": {},
                    "Password": {},
                    "DataPath": {},
                    "extCode": "PTC",
                    "Server": "AUXLABSVR002\\CPTSQLSVR2019",
                    "DBName": "PCEPTC20191001PTC",
                    "Driver": "{SQL Server}",
                    "status": "0",
                    "NPI": "1239393993",
                    "created_dt": "2019-12-05T23:46:00-05:00",
                    "PracticeCode": "PTC20191001",
                    "CLIANO": {},
                    "phone": "4047678989",
                    "fax": {},
                    "contact_email": "solomon@automedsys.com",
                    "contact_firstname": "Johnson",
                    "contact_lastname": "Koruma",
                    "contact_prefix": {},
                    "contact_suffix": {},
                    "ProvCount": "1",
                    "channel_no": "15124",
                    "ref_id": "0"
             */
        } catch (Exception $e) {
            $error_message = "Failure: ".$e->getMessage().$e->getTraceAsString();
        }

        return [$data, $count, $error_message];
    }
    
    public function getValidateNPI($npi) {
        $q = "SELECT a.*,b.* FROM npi_validation a LEFT JOIN npi_data b ON (b.npi_validation_id=a.id)";
        $q.= " WHERE a.npi='".pg_escape_string($npi)."'";
        $r = pg_query($q);
        if ($r && pg_num_rows($r) && $f=pg_fetch_assoc($r)) {
            return $f;
        }
        return NULL;
    }

    public function createValidateNPI($npi) {
        $q = "SELECT id FROM npi_validation WHERE npi='".pg_escape_string($npi)."'";
        $r = pg_query($q);
        if ($r && pg_num_rows($r) && $f=pg_fetch_row($r)) {
            return $f[0];
        }
        $q = "INSERT INTO npi_validation (npi) VALUES ('".pg_escape_string($npi)."') RETURNING id";
        $r = pg_query($q);
        if ($r && pg_num_rows($r) && $f=pg_fetch_row($r)) {
            return $f[0];
        }
        return NULL;
    }

    public function updateValidateNPI($npi,$valid) {
        $q = "UPDATE npi_validation SET valid='".($valid ? 't' : 'f')."' WHERE npi='".pg_escape_string($npi)."' RETURNING *";
        $r = pg_query($q);
        if ($r && pg_num_rows($r) && $f=pg_fetch_assoc($r)) {
            return $f;
        }
        return NULL;
    }

    public function saveValidateNPI($id, $data) {
        $db_id = (int)$id;
        if ($db_id<1 || !is_array($data)) {
            return false;
        }
        $q = "INSERT INTO npi_data (npi_validation_id,data) VALUES (${db_id},'".pg_escape_string(json_encode($data))."')";
        $r = pg_query($q);
        if ($r && pg_affected_rows($r)) {
            return true;
        }
        return false;
    }
}
