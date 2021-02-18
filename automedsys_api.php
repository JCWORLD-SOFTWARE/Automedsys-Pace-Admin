<?php
global $automedsys;
$raw_config = file_get_contents('./etc/automedsys_api.conf');
$data_config = explode("\n",$raw_config);
$parsed_config = [];
$section_config = true;
foreach ($data_config as $raw_str) {
    $str = trim($raw_str);
    if ($section_config && $str!="" && substr($str,0,1)!='#' && substr($str,-1)==':') {
        $section_config = false;
        $section = substr($str,0,strlen($str)-1);
        $parsed_config[$section] = [];
        continue;
    }
    if ($str!="" && substr($str,0,1)!='{' && substr($str,0,2)!='};') {
        $pos = strpos($str,'=');
        if ($pos!==false) {
            $key = trim(substr($str,0,$pos));
            $val = trim(substr($str,$pos+1));
            $pos = strpos($val,'"');
            if ($pos!==false) {
                $val = substr($val,$pos+1);
                $pos = strrpos($val,'"');
                $val = substr($val,0,$pos);
            } else {
                $pos = strrpos($val,';');
                if ($pos!==false) {
                    $val = substr($val,0,$pos);
                }
            }
            if (isset($section) && $section!="") {
                $parsed_config[$section][$key] = $val;
            } else {
                $parsed_config[$key] = $val;
            }
        }
    }
    if (substr($str,0,2)=='};') {
        $section_config = true;
    }
}
$automedsys = new class($parsed_config) {
    public $config;
    public function __construct($config) {
        $this->config = $config;
    }
    public function cfgReadChar($param) {
        if (!is_array($this->config)) return NULL;
        $pos = strpos($param,'.');
        if ($pos!==false) {
            $section = trim(substr($param,0,$pos));
            $key = trim(substr($param,$pos+1));
            if (array_key_exists($section,$this->config)) {
                $config = $this->config[$section];
                if (is_array($config) && array_key_exists($key,$config)) {
                    return $config[$key];
                }
            }
        }
        return NULL;
    }
    public function cfgReadLong($param) {
        return (int)$this->cfgReadChar($param);
    }
    public function automed_api($in) {
        return $this->automedsys_api($in);
    }
    public function automedsys_api($in) {
    	die('Not implemented!');
	/*$postdata = json_encode($in);
        $ch = curl_init($this->cfgReadChar('automedsys.url'));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_VERBOSE, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'content-type: application/json',
            'content-length: ' . strlen($postdata),
            'server-token: ' . $this->cfgReadChar('automedsys.token')
        ]);
        curl_setopt($ch, CURLOPT_HEADER, false); // Do not show the response headers
        curl_setopt($ch, CURLOPT_USERPWD, base64_decode($this->cfgReadChar('automedsys.key')));
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        $res = curl_exec($ch);
        //echo "DEBUG: ".$res."=====\n";
        curl_close($ch);
	return json_decode($res, true);
	//*/
    }
};
