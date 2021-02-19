<?php

include_once('Base_model.php');

class Applications_model extends Base_model {
    public function create($in) {
        return $this->create_operation('application',$in);
    }

    public function update($in) {
        return $this->update_operation('application',$in);
    }

    public function retreive($id=NULL) {
        return $this->retreive_operation('application','practicename',$id);
    }

    public function delete($id) {
        return $this->delete_operation('application',$id);
    }

}
