<?php

class Practice_model extends Base_model {

    function __construct() {
        
    }

    function get_practice($authToken, $recordId) {
        global $automedsys;
        //$automedsys = new automedsys_api_oameye\Automedsys();
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

    /*
            ClinicData.ClinicName = PracticeName; // "PACE Test Clinic International";
            ClinicData.EIN = "737282828";
            ClinicData.Email = email;// "solomon@automedsys.com";
            ClinicData.NPI = "1239393993";
            ClinicData.Phone = new AuxFrmwrkXsd.PhoneType[1];
            ClinicData.Phone[0] = new AuxFrmwrkXsd.PhoneType();
            ClinicData.Phone[0].Number = "4047678989";
            ClinicData.Phone[0].Qualifier = "CP";
            ClinicData.Address = new AuxFrmwrkXsd.AddressType();
            ClinicData.Address.AddressLine1 = "1234 Health Express Way";
            ClinicData.Address.City = "Atlanta";
            ClinicData.Address.State = "GA";
            ClinicData.Address.ZipCode = "30303";
            ClinicData.ClinicContact = new AuxFrmwrkXsd.NameType();
            ClinicData.ClinicContact.FirstName = "Johnson";
            ClinicData.ClinicContact.LastName = "Koruma";
            ClinicData.ClinicContact.Suffix = "MD";
            ClinicData.ClinicContact.Prefix = "Dr";
            ClinicData.PromotionCode = "CHRISTMAS";
            ClinicData.username = "randomuser";
            ClinicData.password = "password";

    */

    function create_practice($in) {
        global $automedsys;
	    $data = [];
        $error_message = "";
        //$automedsys = new automedsys_api_oameye\Automedsys();
        $url = $automedsys->cfgReadChar("auxpro.pace_endpoint");
        try {
            //setting the curl parameters.
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true );
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: text/xml; charset=utf-8',
                'SOAPAction: "http://automedsys.net/webservices/CreatePractice"'
            ));
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            $raw_xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>
            <soap:Envelope xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" xmlns:soap=\"http://schemas.xmlsoap.org/soap/envelope/\">
              <soap:Body>
                <CreatePractice xmlns=\"http://automedsys.net/webservices\">
                    <ClinicData>
                        <PromotionCode xmlns=\"http://www.automedsys.com/messaging\">".$in['promocode']."</PromotionCode>
                        <ClinicPracticeCode xmlns=\"http://www.automedsys.com/messaging\">".$in['practicecode']."</ClinicPracticeCode>
                        <NPI xmlns=\"http://www.automedsys.com/messaging\">".$in['practicenpi']."</NPI>
                        <EIN xmlns=\"http://www.automedsys.com/messaging\">".$in['practiceein']."</EIN>
                        <ClinicID xmlns=\"http://www.automedsys.com/messaging\">".$in['clinicid']."</ClinicID>
                        <ClinicName xmlns=\"http://www.automedsys.com/messaging\">".$in['clinicname']."</ClinicName>
                        <Address xmlns=\"http://www.automedsys.com/messaging\">
                            <Country>".$in['country']."</Country>
                            <AddressLine1>".$in['street1']."</AddressLine1>
                            <AddressLine2>".$in['street2']."</AddressLine2>
                            <City>".$in['city']."</City>
                            <State>".$in['state']."</State>
                            <ZipCode>".$in['zipcode']."</ZipCode>
                        </Address>
                        <Phone xmlns=\"http://www.automedsys.com/messaging\">
                            <PhoneType>
                                <Number>".$in['phone']."</Number>
                                <Qualifier>CP</Qualifier>
                            </PhoneType>
                            <PhoneType>
                                <Number>".$in['fax']."</Number>
                                <Qualifier>FX</Qualifier>
                            </PhoneType>
                        </Phone>
                        <ClinicContact xmlns=\"http://www.automedsys.com/messaging\">
                            <LastName>".$in['contact_lastname']."</LastName>
                            <FirstName>".$in['contact_firstname']."</FirstName>
                            <MiddleName>".$in['contact_middlename']."</MiddleName>
                            <Suffix>".$in['contact_suffix']."</Suffix>
                            <Prefix>".$in['contact_prefix']."</Prefix>
                        </ClinicContact>
                        <Email xmlns=\"http://www.automedsys.com/messaging\">".$in['contact_email']."</Email>
                        <username xmlns=\"http://www.automedsys.com/messaging\">".$in['username']."</username>
                        <password xmlns=\"http://www.automedsys.com/messaging\">".$in['password']."</password>
                    </ClinicData>
                    <AccessControl>
                        <ChannelID xmlns=\"http://www.automedsys.com/messaging\">0</ChannelID>
                        <EndPointAddress xmlns=\"http://www.automedsys.com/messaging\"></EndPointAddress>
                        <PracticeID xmlns=\"http://www.automedsys.com/messaging\"></PracticeID>
                        <PracticeReferenceNumber xmlns=\"http://www.automedsys.com/messaging\"></PracticeReferenceNumber>
                        <PracticeCode xmlns=\"http://www.automedsys.com/messaging\"></PracticeCode>
                        <SessionId xmlns=\"http://www.automedsys.com/messaging\">".$_SESSION["session"]."</SessionId>
                        <Username xmlns=\"http://www.automedsys.com/messaging\"></Username>
                        <Password xmlns=\"http://www.automedsys.com/messaging\"></Password>
                        <MessageID xmlns=\"http://www.automedsys.com/messaging\"></MessageID>
                        <groupID xmlns=\"http://www.automedsys.com/messaging\"></groupID>
                        <Action xmlns=\"http://www.automedsys.com/messaging\">0</Action>
                    </AccessControl>
                </CreatePractice>
              </soap:Body>
            </soap:Envelope>";
            curl_setopt($ch, CURLOPT_POSTFIELDS, $raw_xml);

            $result = curl_exec($ch);
            curl_close($ch);

            // Massage SOAP envelope, so it is parseable by SimpleXMLElement class
            $result = str_replace(' xmlns="http://www.automedsys.com/messaging"','',$result);
            $result = str_replace(' xmlns="http://automedsys.net/webservices"','',$result);
            $result = str_replace('soap:','',$result);

            //var_dump($result);
            $xml = new SimpleXMLElement($result);

            if (is_object($xml) && property_exists($xml,'Body') 
             && is_object($xml->Body) && property_exists($xml->Body,'CreatePracticeResponse') 
             && is_object($xml->Body->CreatePracticeResponse) && property_exists($xml->Body->CreatePracticeResponse,'CreatePracticeResult')
             && is_object($xml->Body->CreatePracticeResponse->CreatePracticeResult)) {
                // Process response 
                $res = $xml->Body->CreatePracticeResponse->CreatePracticeResult;
                //var_dump($res);

                if (property_exists($res,'ErrorCode') && (int)$res->ErrorCode==0) {
                    $error_message = (string)$res->Suggestion;
                    /*
                    <PracticeActivity xmlns="http://www.automedsys.com/messaging">
                        <LastLoginDate>string</LastLoginDate>
                        <PatientCount>string</PatientCount>
                        <ProviderCount>string</ProviderCount>
                    </PracticeActivity>
                    <PracticeInformation xmlns="http://www.automedsys.com/messaging">
                        <PromotionCode>string</PromotionCode>
                        <ClinicPracticeCode>string</ClinicPracticeCode>
                        <NPI>string</NPI>
                        <EIN>string</EIN>
                        <ClinicID>string</ClinicID>
                        <ClinicName>string</ClinicName>
                        <Address>
                            <Country>string</Country>
                            <AddressLine1>string</AddressLine1>
                            <AddressLine2>string</AddressLine2>
                            <City>string</City>
                            <State>string</State>
                            <ZipCode>string</ZipCode>
                        </Address>
                        <Phone>
                            <PhoneType xsi:nil="true" />
                            <PhoneType xsi:nil="true" />
                        </Phone>
                        <ClinicContact>
                            <LastName>string</LastName>
                            <FirstName>string</FirstName>
                            <MiddleName>string</MiddleName>
                            <Suffix>string</Suffix>
                            <Prefix>string</Prefix>
                        </ClinicContact>
                        <Email>string</Email>
                        <username>string</username>
                        <password>string</password>
                    </PracticeInformation>
                    <StatusCode xmlns="http://www.automedsys.com/messaging">string</StatusCode>
                    <PracticeReferenceNumber xmlns="http://www.automedsys.com/messaging">string</PracticeReferenceNumber>
                    <RawResponse xmlns="http://www.automedsys.com/messaging">string</RawResponse>
                    <MiscField1 xmlns="http://www.automedsys.com/messaging">string</MiscField1>
                    <MiscField2 xmlns="http://www.automedsys.com/messaging">string</MiscField2>
                    <SessionId xmlns="http://www.automedsys.com/messaging">string</SessionId>
                    <ErrorCode xmlns="http://www.automedsys.com/messaging">string</ErrorCode>
                    <ErrorMessage xmlns="http://www.automedsys.com/messaging">string</ErrorMessage>
                    <MessageID xmlns="http://www.automedsys.com/messaging">string</MessageID>
                    <Suggestion xmlns="http://www.automedsys.com/messaging">string</Suggestion>
                    */
                    $data["practicereferencenumber"] = (string)$res->PracticeReferenceNumber;
                    $data["suggestion"] = (string)$res->Suggestion;
                } else {
                    if (property_exists($res,'ErrorMessage') && ((string)$res->ErrorMessage)!="") {
                        $error_message = $res->ErrorMessage . "<br/>" . $res->Suggestion; // . "<br/>" . htmlentities($raw_xml);
                    } else {
                        $error_message = "Unknown error!";
                    } 
                }
            }

        } catch (Exception $e) {
            $error_message = "Failure: ".$e->getMessage().$e->getTraceAsString();
            //$error_message = "Service failure, please try again later";
        }
        return [$data, $error_message];
    }


    function approve_practice($in) {
        global $automedsys;
        $data = ["practiceconfig" => NULL];
        $code = -1;
        $error_message = "";
        //$automedsys = new automedsys_api_oameye\Automedsys();
        $url = $automedsys->cfgReadChar("auxpro.pace_endpoint");
        try {
            //setting the curl parameters.
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true );
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: text/xml; charset=utf-8',
                'SOAPAction: "http://automedsys.net/webservices/ApprovePractice"'
            ));
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            $raw_xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>
            <soap:Envelope xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" xmlns:soap=\"http://schemas.xmlsoap.org/soap/envelope/\">
              <soap:Body>
                <ApprovePractice xmlns=\"http://automedsys.net/webservices\">
                    <PracticeId>".$in["id"]."</PracticeId>
                    <ServerId>".$in["server"]."</ServerId>
                    <ParentTenantId>".$in["parent_tenant_id"]."</ParentTenantId>
                    <DatabaseServerId>".$in["database_id"]."</DatabaseServerId>
                    <DatabaseTemplateId>".$in["template_id"]."</DatabaseTemplateId>
                    <AccessControl>
                        <ChannelID xmlns=\"http://www.automedsys.com/messaging\">0</ChannelID>
                        <EndPointAddress xmlns=\"http://www.automedsys.com/messaging\"></EndPointAddress>
                        <PracticeID xmlns=\"http://www.automedsys.com/messaging\"></PracticeID>
                        <PracticeReferenceNumber xmlns=\"http://www.automedsys.com/messaging\"></PracticeReferenceNumber>
                        <PracticeCode xmlns=\"http://www.automedsys.com/messaging\"></PracticeCode>
                        <SessionId xmlns=\"http://www.automedsys.com/messaging\">".$_SESSION["session"]."</SessionId>
                        <Username xmlns=\"http://www.automedsys.com/messaging\"></Username>
                        <Password xmlns=\"http://www.automedsys.com/messaging\"></Password>
                        <MessageID xmlns=\"http://www.automedsys.com/messaging\"></MessageID>
                        <groupID xmlns=\"http://www.automedsys.com/messaging\"></groupID>
                        <Action xmlns=\"http://www.automedsys.com/messaging\">0</Action>
                    </AccessControl>
                </ApprovePractice>
              </soap:Body>
            </soap:Envelope>";
            curl_setopt($ch, CURLOPT_POSTFIELDS, $raw_xml);

            $result = curl_exec($ch);
            curl_close($ch);

            // Massage SOAP envelope, so it is parseable by SimpleXMLElement class
            $result = str_replace(' xmlns="http://www.automedsys.com/messaging"','',$result);
            $result = str_replace(' xmlns="http://automedsys.net/webservices"','',$result);
            $result = str_replace('soap:','',$result);

            //var_dump($result);
            $xml = new SimpleXMLElement($result);

            if (is_object($xml) && property_exists($xml,'Body') 
             && is_object($xml->Body) && property_exists($xml->Body,'ApprovePracticeResponse') 
             && is_object($xml->Body->ApprovePracticeResponse) && property_exists($xml->Body->ApprovePracticeResponse,'ApprovePracticeResult')
             && is_object($xml->Body->ApprovePracticeResponse->ApprovePracticeResult)) {
                // Process response 
                $res = $xml->Body->ApprovePracticeResponse->ApprovePracticeResult;
                //var_dump($res);

                if (property_exists($res,'ErrorCode') && (int)$res->ErrorCode==0) {
                    $code = 0;
                    $error_message = (string)$res->Suggestion;
                    $data["practicereferencenumber"] = (string)$res->PracticeReferenceNumber;
                    $data["suggestion"] = (string)$res->Suggestion;
                    $data["practiceconfig"] = json_decode((string)$res->MiscField1,true);
                } else {
                    if (property_exists($res,'ErrorMessage') && ((string)$res->ErrorMessage)!="") {
                        $error_message = $res->ErrorMessage . "<br/>" . $res->Suggestion; // . "<br/>" . htmlentities($raw_xml);
                    } else {
                        $error_message = "Unknown error!";
                    } 
                }
            }

        } catch (Exception $e) {
            $error_message = "Failure: ".$e->getMessage().$e->getTraceAsString();
            //$error_message = "Service failure, please try again later";
        }
        $data['code'] = $code;
        $data['message'] = $error_message;
        return $data;
    }

    function load_practices($compact = 0, $param = "", $limit = 0, $offset = 0) {
        global $automedsys;
        // $automedsys = new automedsys_api_oameye\Automedsys();
        $data = [];
        $error_message = "";
        $url = $automedsys->cfgReadChar("auxpro.pace_endpoint");
        try {
            //setting the curl parameters.
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true );
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: text/xml; charset=utf-8',
                'SOAPAction: "http://automedsys.net/webservices/PracticeDeployList"'
            ));
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch, CURLOPT_POSTFIELDS, "<?xml version=\"1.0\" encoding=\"utf-8\"?>
            <soap:Envelope xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" xmlns:soap=\"http://schemas.xmlsoap.org/soap/envelope/\">
              <soap:Body>
                <PracticeDeployList xmlns=\"http://automedsys.net/webservices\">
                  <compact>${compact}</compact>
                  <param>${limit}</param>
                  <limit>${limit}</limit>
                  <offset>${offset}</offset>
                  <sessionid>".$_SESSION["session"]."</sessionid>
                </PracticeDeployList>
              </soap:Body>
            </soap:Envelope>");

            $result = curl_exec($ch);
            /* ob_start();
            var_dump($result);
            echo str_replace(">",">\n",ob_get_clean()); // */
            curl_close($ch);

            // Massage SOAP envelope, so it is parseable by SimpleXMLElement class
            $result = str_replace(' xmlns="http://www.automedsys.com/messaging"','',$result);
            $result = str_replace(' xmlns="http://automedsys.net/webservices"','',$result);
            $result = str_replace('soap:','',$result);

            //var_dump($result);
            $xml = new SimpleXMLElement($result);

            if (is_object($xml) && property_exists($xml,'Body') 
             && is_object($xml->Body) && property_exists($xml->Body,'PracticeDeployListResponse') 
             && is_object($xml->Body->PracticeDeployListResponse) && property_exists($xml->Body->PracticeDeployListResponse,'PracticeDeployListResult')
             && is_object($xml->Body->PracticeDeployListResponse->PracticeDeployListResult)) {
                // Process response 
                $res = $xml->Body->PracticeDeployListResponse->PracticeDeployListResult;
                //var_dump($res);
                if (property_exists($res,'StatusCode') && (int)$res->StatusCode==0) {
                    // $res->Suggestion
                    // $res->MiscField2
                    // $res->MiscField1
                    $str1 = (string)$res->MiscField1;
                    $str2 = (string)$res->MiscField2;
                    $dat1 = json_decode($str1, true);
                    $dat2 = json_decode($str2, true);
                    $error_message = "";
                    // var_dump($data);
                } else {
                    if (property_exists($res,'ErrorMessage') && ((string)$res->ErrorMessage)!="") {
                        $error_message = "Loading practice list failed: " . $res->ErrorMessage . "<br/>" . $res->Suggestion;
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
        return [$dat1, $dat2, $error_message];
    }

    public function ComboBox($name,$value){
        return $this->combo_box('automedsys_practices',$name,$value,'id','name');
    }

    public function ComboBoxData($name,$value,$data,$event=''){
        return $this->combo_box_data($data,$name,$value,'id',['name','endpoint_address','host_address'],$event);
    }
}
