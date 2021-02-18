<?php

include_once('Base_model.php');

class Practiceregistration_model extends Base_model {

    function __construct() {
        
    }

    public function create($in) {
        return $this->create_operation('practice_registration',$in);
    }

    public function update($in) {
        return $this->update_operation('practice_registration',$in);
    }

    public function retreive($id=NULL) {
        return $this->retreive_operation('practice_registration','username',$id);
    }

    public function delete($id) {
        return $this->delete_operation('practice_registration',$id);
    }

}
