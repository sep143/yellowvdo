<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class Login_model extends CI_Model{
    
    //verify mail then check link
    public function check_verify_link($link) {
        $sql = "select * from advertiser where EmailVerify=?";
        $data = $this->db->query($sql, array($link));
        if($data->num_rows() == 1){
            return $data->row();
        }else{
            return false;
        }
    }
    
    //check link and match then verify link ok and update
    public function confirm_verify_email($id, $data) {
        $this->db->where('ID',$id);
        $this->db->update('advertiser', $data);
        return true;
    }
}