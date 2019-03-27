<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class User_model extends CI_Model{
    
    //google api call then insert data
    public function add_user($data){
        $this->db->insert('advertiser', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    
    //get user id
    public function get_user_id($id) {
        $sql = "select * from advertiser where ID=? and StatusID=1 and Role=2";
        $data = $this->db->query($sql, array($id));
        return $data->row();
    }
    
    //get user and soccial to check data insert db then insert
    public function get_user($email){
        $sql = "select * from advertiser where UserName=?";
        $data = $this->db->query($sql, array($email));
        return $data->row();
    }
    
    public function get_user_count($email){
        $sql = "select * from advertiser where UserName=?";
        $data = $this->db->query($sql, array($email));
        return $data->num_rows();
    }
    
    //login time email and password check then login to dashboard panel
    public function check($userName,$password){
        $sql = 'select * from advertiser where UserName=? and Pwd=? and StatusID <>3';
        $data = $this->db->query($sql, array($userName, md5($password)));
        if($data->num_rows()== 1){
            return $data->row();
        }else{
            return false;
        }
    }
    
    //if password reset then update password then update data
    public function update_user($id, $data){
        $this->db->where('ID', $id);
        $this->db->update('advertiser', $data);
        return true;
    }
}