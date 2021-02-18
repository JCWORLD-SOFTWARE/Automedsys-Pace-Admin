<?php

class Backend_model extends CI_Model {

    var $thisUser = 'oameye';
    var $USER = '';
    var $automedsys = NULL;
    
    function __construct() {
	global $automedsys;

        $this->USER = $_SERVER['SCRIPT_FILENAME'];
        $this->USER = str_replace('/home', '', $this->USER);
        $this->USER = strtok($this->USER, '/');
        if ($this->USER == 'opt') {
            $this->USER = 'root';
        }
        $this->thisUser = $this->USER;
        
        $this->USER = str_replace('/home', '', $this->thisUser);
        $this->USER = strtok($this->USER, '/');
       /// $automedsys_class = 'automedsys_api_' . $this->USER . '\\Automedsys';
       /// $automedsys = new $automedsys_class();
        
//            $automedsys = new automedsys_api_oameye\Automedsys();
        
    }

    public function automedsys_api($in, $out = array()) {
	global $automedsys;    
        // $this->$USER = $_SERVER['SCRIPT_FILENAME'];
        /*$this->USER = str_replace('/home', '', $this->thisUser);
        $this->USER = strtok($this->USER, '/');
        $automedsys_class = 'automedsys_api_' . $this->USER . '\\Automedsys';
	$automedsys = new $automedsys_class();*/
        $ret = $automedsys->automedsys_api($in, $out);
        return $ret;
    }
}
