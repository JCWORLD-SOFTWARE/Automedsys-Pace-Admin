<?php

include_once('Base_model.php');

class Specialty_model extends Base_model {

    function __construct() {
        
    }

    public function create($in) {
        return $this->create_operation('specialty',$in);
    }

    public function update($in) {
        return $this->update_operation('specialty',$in);
    }

    public function retreive($id=NULL) {
        return $this->retreive_operation('specialty','feature',$id);
    }

    public function delete($id) {
        return $this->delete_operation('specialty',$id);
    }

    public function ComboBox($name,$value){
        return $this->combo_box('specialty',$name,$value,'id','code');
    }

}
