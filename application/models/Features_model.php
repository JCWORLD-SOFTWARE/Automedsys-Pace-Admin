<?php

include_once('Base_model.php');

class Features_model extends Base_model {

    function __construct() {
        
    }

    public function create($in) {
        return $this->create_operation('features',$in);
    }

    public function update($in) {
        return $this->update_operation('features',$in);
    }

    public function retreive($id=NULL) {
        return $this->retreive_operation('features','feature',$id);
    }

    public function delete($id) {
        return $this->delete_operation('features',$id);
    }

}
