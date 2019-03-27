<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class Setting_model extends CI_Model{
    
    //fully pass sql code then execute file
    public function get_data_result($sql){
        $data = $this->db->query($sql);
        return $data->result();
    }
    
    //admin panel in change password
    public function change_password($id, $password) {
        $this->db->where('ID', $id);
        $this->db->update('advertiser', $password);
        return true;
    }
    
    //password update before check old password then check condition
    public function get_data_advertiser($id) {
        $sql = "select Pwd from advertiser where ID=?";
        $data = $this->db->query($sql, array($id));
        return $data->row();
    }
    
    //common setting get image limit then set
    public function get_image_limit($id) {
        $sql = "select * from setting_image where ID=?";
        $data = $this->db->query($sql, array($id));
        return $data->row();
    }
    //common setting in update payment
    public function get_payment($id) {
        $sql = "select * from setting_payment where ID=?";
        $data = $this->db->query($sql, array($id));
        return $data->row();
    }
    
    //image limit update
    public function set_image_limit($image_id, $data) {
        $this->db->where('ID',$image_id);
        $this->db->update('setting_image',$data);
        return true;
    }
    //get user role list
    public function get_role_user() {
        $sql = "select * from advertiser where Role IN (3,4,5,6,7) and StatusID <>3";
        $data = $this->db->query($sql);
        return $data->result();
    }
    
    //create role user
    public function create_role_user($data) {
        $this->db->insert('advertiser', $data);
        return true;
    }
    
    //edit role chnage
    public function get_user_role_byid($id) {
        $sql = "select * from advertiser where ID=?";
        $data = $this->db->query($sql, array($id));
        return $data->row();
    }
    
    //update role
    public function update_edit_role($id,$data) {
        $this->db->where('ID', $id);
        $this->db->update('advertiser', $data);
        return true;
    }
    
    //payment update
    public function change_payment($id, $data) {
        $this->db->where('ID', $id);
        $this->db->update('setting_payment', $data);
        return true;
    }
}