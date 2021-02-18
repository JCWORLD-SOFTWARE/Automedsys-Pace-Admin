<?php
$url         = "https://staging.automedsys.net:4439/AUXPRO/AuxProPracticeAdmin/PAdminService.asmx?WSDL";
$client     = new SoapClient($url, array("trace" => 1, "exception" => 0));

var_dump($client); 
