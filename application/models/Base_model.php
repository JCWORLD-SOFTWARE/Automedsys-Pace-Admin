<?php

class Base_model extends CI_Model {

    public function load_table_schema($table) {
        $q = "SELECT column_name,column_default,is_nullable,data_type,character_maximum_length,is_updatable FROM information_schema.COLUMNS WHERE TABLE_NAME = '${table}'";
        $r = pg_query($q);
        if ($r && pg_num_rows($r)) {
            $result = array();
            while ($f=pg_fetch_assoc($r)) {
                $result[$f['column_name']] = $f;
            }
            return $result;
        }
        return NULL;
    }
    /*
    automedsys_test=> SELECT column_name,column_default,is_nullable,data_type,character_maximum_length,is_updatable FROM information_schema.COLUMNS WHERE TABLE_NAME = 'bko_users';
    column_name |            column_default             | is_nullable |          data_type          | character_maximum_length | is_updatable
    -------------+---------------------------------------+-------------+-----------------------------+--------------------------+--------------
    id          | nextval('bko_users_id_seq'::regclass) | NO          | integer                     |                          | YES
    username    |                                       | NO          | character varying           |                       15 | YES
    name        | ''::character varying                 | YES         | character varying           |                      100 | YES
    pass        |                                       | NO          | character varying           |                      100 | YES
    status      | 1                                     | YES         | integer                     |                          | YES
    added       | now()                                 | YES         | timestamp without time zone |                          | YES
    (6 rows)
    */

    public function create_operation($table, $in) {
        $schema = $this->load_table_schema($table);
        $keys = array();
        $vals = array();
        foreach ($in as $key=>$val) {
            if (!array_key_exists($key,$schema)) continue;
            $type = substr($schema[$key]["data_type"],0,4);
            if ($type=="char" || $type=="text") {
                $keys[] = $key;
                $vals[] = "'".pg_escape_string($val)."'"; // Do we handle nulls?
            }
            if ($type=="time" || $type=="date") {
                $keys[] = $key;
                $vals[] = $val==""?"NULL":"'".pg_escape_string($val)."'";
            }
            if ($type=="inte") {
                $keys[] = $key;
                $vals[] = ((int)$val); // Do we handle nulls?
            }
        }
        $q = "INSERT INTO ${table} (".implode(",",$keys).") VALUES(".implode(",",$vals).") RETURNING id";
        $r = pg_query($q);
        if ($r && pg_num_rows($r) && $f=pg_fetch_assoc($r)) {
            return $f["id"];
        }
        return NULL;
    }

    public function update_operation($table, $in) {
        $schema = $this->load_table_schema($table);
        $pairs = array();
        foreach ($in as $key=>$val) {
            if (!array_key_exists($key,$schema)) continue;
            if ($schema[$key]["is_updatable"]!='YES') continue;
            $type = substr($schema[$key]["data_type"],0,4);
            if ($type=="char" || $type=="text") {
                $pairs[] = $key."='".pg_escape_string($val)."'"; // Do we handle nulls?
            }
            if ($type=="time" || $type=="date") {
                $pairs[] = $key."=".($val==""?"NULL":"'".pg_escape_string($val)."'");
            }
            if ($type=="inte") {
                $pairs[] = $key."=".((int)$val); // Do we handle nulls?
            }
        }
        $q = "UPDATE ${table} SET ".implode(",",$pairs)." WHERE id=".((int)$in["id"])." RETURNING id";
        $r = pg_query($q);
        if ($r && pg_num_rows($r) && $f=pg_fetch_assoc($r)) {
            return $f["id"];
        }
        return NULL;
    }

    public function retreive_operation($table,$order,$id=NULL) {
        $res = array();
        $q = "SELECT * FROM ${table} ".($id>0?"WHERE id=${id}":"")." ORDER BY ${order}";
        $r = pg_query($q);
        if ($r && pg_num_rows($r)) {
            while ($f=pg_fetch_assoc($r)) {
                $res[] = $f;
            }
        }
        return $res;
    }

    public function delete_operation($table, $id) {
        $q = "DELETE FROM ${table} WHERE id=".((int)$id);
        $r = pg_query($q);
        if ($r && pg_affected_rows($r)) {
            return true;
        }
        return false;
    }

    public function objectToArray($d) {
        if (is_object($d)) {
            $d = get_object_vars($d);
        }
        if (is_array($d)) {
            return array_map(null, $d);
              //return array_map(__FUNCTION__, $d);
        } else {
            return $d;
        }
    }

    public function combo_box($table,$name,$value,$key,$title) {
        $res = "<select class=\"form-control\" name=\"${name}\">\n";
        $q = "SELECT ${key},${title} FROM ${table} ORDER BY ${title}";
        $r = pg_query($q);
        if ($r && pg_affected_rows($r)) {
            while ($f=pg_fetch_row($r)) {
                $res.= "<option value=\"".$f[0]."\"";
                if ($f[0]==$value) {
                    $res.= " selected";
                }
                $res.= ">".$f[1]."</option>\n";
            }
        }
        $res .= "</select>\n";
        return $res;
    }

    public function combo_box_data($data,$name,$value,$key,$title,$event='') {
        $res = "<select class=\"form-control\" name=\"${name}\"";
        if ($event != '') {
            $res.= " onChange=\"return ${event}\"";
        }
        $res.= ">\n";
        if (is_array($data) && count($data)>0) {
            foreach ($data as $f) {
                $res.= "<option value=\"".$f[$key]."\"";
                if ($f[$key]==$value) {
                    $res.= " selected";
                }
                if (is_array($title)) {
                    $res.= ">";
                    foreach ($title as $t) {
                        $res.= $f[$t]." => ";
                    }
                    $res = rtrim($res, " => ");
                    $res.= "</option>\n";
                } else {
                    $res.= ">".$f[$title]."</option>\n";
                }
            }
        }
        $res .= "</select>\n";
        return $res;
    }

}
