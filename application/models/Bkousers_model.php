<?php

include_once('Base_model.php');

class Bkousers_model extends Base_model {

    function __construct() {
        
    }

    public function create($in) {
        return $this->create_operation('bko_users',$in);
    }

    public function update($in) {
        return $this->update_operation('bko_users',$in);
    }

    public function retreive($id=NULL) {
        return $this->retreive_operation('bko_users','username',$id);
    }

    public function delete($id) {
        return $this->delete_operation('bko_users',$id);
    }

}
