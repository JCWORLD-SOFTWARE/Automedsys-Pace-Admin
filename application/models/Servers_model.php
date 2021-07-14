<?php

include_once('Base_model.php');

class Servers_model extends Base_model {

    function __construct() {
        
    }

    public function create($in) {
        return $this->create_operation('automedsys_servers',$in);
    }

    public function update($in) {
        return $this->update_operation('automedsys_servers',$in);
    }

    public function retreive($id=NULL) {
        return $this->retreive_operation('automedsys_servers','name',$id);
    }

    public function delete($id) {
        return $this->delete_operation('automedsys_servers',$id);
    }

    public function ComboBox($name,$value){
        return $this->combo_box('automedsys_servers',$name,$value,'id','name');
    }

    public function ComboBoxData($name,$value,$data, $event = ''){
        return $this->combo_box_data($data,$name,$value,'id',['name','endpoint_address','host_address'], $event);
    }

    public function load_servers() {
        global $automedsys;
        // $automedsys = new automedsys_api_oameye\Automedsys();
        $data = "";
        $count = 0;
        $limit = 10;
        $offset = 0;
        $error_message = "";
        $url = $automedsys->cfgReadChar("auxpro.pace_endpoint");
        try {
            //setting the curl parameters.
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true );
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: text/xml; charset=utf-8',
                'SOAPAction: "http://automedsys.net/webservices/PracticeServerList"'
            ));
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch, CURLOPT_POSTFIELDS, "<?xml version=\"1.0\" encoding=\"utf-8\"?>
            <soap:Envelope xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" xmlns:soap=\"http://schemas.xmlsoap.org/soap/envelope/\">
              <soap:Body>
                <PracticeServerList xmlns=\"http://automedsys.net/webservices\">
                  <limit>${limit}</limit>
                  <offset>${offset}</offset>
                  <sessionid>".$_SESSION["session"]."</sessionid>
                </PracticeServerList>
              </soap:Body>
            </soap:Envelope>");

            $result = curl_exec($ch);
            curl_close($ch);

            // Massage SOAP envelope, so it is parseable by SimpleXMLElement class
            $result = str_replace(' xmlns="http://www.automedsys.com/messaging"','',$result);
            $result = str_replace(' xmlns="http://automedsys.net/webservices"','',$result);
            $result = str_replace('soap:','',$result);

            //var_dump($result);
            $xml = new SimpleXMLElement($result);

            if (is_object($xml) && property_exists($xml,'Body') 
             && is_object($xml->Body) && property_exists($xml->Body,'PracticeServerListResponse') 
             && is_object($xml->Body->PracticeServerListResponse) && property_exists($xml->Body->PracticeServerListResponse,'PracticeServerListResult')
             && is_object($xml->Body->PracticeServerListResponse->PracticeServerListResult)) {
                // Process response 
                $res = $xml->Body->PracticeServerListResponse->PracticeServerListResult;
                //var_dump($res);
                if (property_exists($res,'StatusCode') && (int)$res->StatusCode==0) {
                    // $res->Suggestion
                    // $res->MiscField2
                    // $res->MiscField1
                    $str = (string)$res->MiscField1;
                    $str = str_replace(' encoding="utf-16"', ' encoding="utf-8"', $str);
                    $str = str_replace(' msdata:',' ', $str);
                    $str = str_replace(' xmlns:',' ', $str);
                    $str = str_replace('xs:','', $str);
                    $str = str_replace('diffgr:','', $str);
                    $data = new SimpleXMLElement($str);
                    $json_str = json_encode($data);
                    $array_data = json_decode($json_str, true);
                    $raw_fields = $array_data["schema"]["element"]["complexType"]["choice"]["element"]["complexType"]["sequence"]["element"];
                    $fields = [];
                    foreach ($raw_fields as $field) {
                        $fields[] = $field["@attributes"]["name"]; // ...["type"] ...["minOccurs"]
                    }
                    $raw_data = $array_data["diffgram"]["mydata"]["PACEDataTable"];
                    $data = []; $i = 1; $count = 0;
                    if (is_array($raw_data) && array_key_exists("ID", $raw_data) && $raw_data["ID"]>0) {
                        $raw_data = [ $raw_data ];
                    }
                    foreach ($raw_data as $raw_item) {
                        if ($i>=$limit) break;
                        $item = [];
                        foreach ($fields as $field) {
                            $raw_value = array_key_exists($field,$raw_item) ? $raw_item[$field] : NULL;
                            $item[strtolower($field)] = (is_array($raw_value) && count($raw_value)<1) ? NULL : $raw_value;
                        }
                        $data[] = $item;
                        $count++;
                        $i++;
                    }
                    $error_message = "";
                    //var_dump($data);
                } else {
                    if (property_exists($res,'ErrorMessage') && ((string)$res->ErrorMessage)!="") {
                        $error_message = "Loading server list failed: " . $res->ErrorMessage . "<br/>" . $res->Suggestion;
                    } else {
                        $error_message = "Unknown error!";
                    } 
                }
             }
        } catch (Exception $e) {
            $error_message = "Failure: ".$e->getMessage().$e->getTraceAsString();
            //$error_message = "Service failure, please try again later";
        }
        //var_dump($error_message);
        return [$data, $count, $error_message];
    }
}
