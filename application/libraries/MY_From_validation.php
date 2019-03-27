<?php

class MY_Form_validation extends CI_Form_validation{
    
    function is_unique($str, $field) {
        if(substr_count($field, '.')==3){
            list($table,$field,$id_field,$id_val)= explode('.', $field);
            $query = $this->CI->db->limit(1)->where($field,$str)->where($id_field. ' !=',$id_val)->get($table);
        }else{
            list($table, $field) = explode('.', $field);
            $query =$this->CI->db->limit(1)->get_where($table, array($field=>$str));
        }
        return $query->num_rows()==0;
    }
    function edit_unique($value, $params){
        $this->set_message('edit_unique',"This %s is already in user");
        list($table,$field,$match_id,$current_id) = explode(".", $params);
        $result = $this->CI->db->where($field,$value)->get($table)->row();
        return ($result && $result->$match_id != $current_id) ? FALSE : TRUE;
    }
}
