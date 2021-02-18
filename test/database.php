<pre>
<?php

$url = "http://stgmw.automedsys.net/AuxPaceService.asmx";

//setting the curl parameters.
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true );
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: text/xml; charset=utf-8',
    'SOAPAction: "http://automedsys.net/webservices/TestPaceAgent"'
));
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            
$raw_xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>
            <soap:Envelope xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" xmlns:soap=\"http://schemas.xmlsoap.org/soap/envelope/\">
              <soap:Body>
                <TestPaceAgent xmlns=\"http://automedsys.net/webservices\" />
              </soap:Body>
            </soap:Envelope>";

curl_setopt($ch, CURLOPT_POSTFIELDS, $raw_xml);

$result = curl_exec($ch);
var_dump($result);
curl_close($ch);