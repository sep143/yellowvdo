<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class ProfileApi_model extends CI_Model{

 public function profile_get($id){
        $sql = "select * from advertiser where ID=?";
        $data = $this->db->query($sql, array($id));
        if($data->num_rows()== 1){
            return $data->row();
        }else{
            return false;
        }
    }

 public function profile_update($id,$data){
		$this->db->where('ID', $id);
		$result = $this->db->update('advertiser', $data); 
        return $result;
    }

     public function passowrdCHK($oldpass,$id){
		$result = $this->db->get_where('advertiser', array('ID'=>$id,'Pwd'=>$oldpass)); 
		if($result->num_rows()== 1)
		return $result->row();
			else
        return false;
    }
}
