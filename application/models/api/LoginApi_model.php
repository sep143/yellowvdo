<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class LoginApi_model extends CI_Model{
    
    //login time check data and get value for advertiser table
    public function login_check($email, $password){
        $sql = "select * from advertiser where UserName=? and Pwd=? and Role=2";
        $data = $this->db->query($sql, array($email, md5($password)));
        if($data->num_rows()== 1){
            return $data->row();
        }else{
            return false;
        }
    }
    
    //api me fb or google se data ane pr email check kr lenge agr pehle se email he to insert nahi krwana h other wise advertser table me insert krwana he
    public function check_email($email){
        $sql = "select ID,UserName from advertiser where UserName=? and Role=2";
        $data = $this->db->query($sql, array($email));
        if($data->num_rows()== 1){
            return $data->row();
        }else{
            return false;
        }
    }
    
    //resend mail for verification then call this function
    public function check_email_senddata($email){
        $sql = "select * from advertiser where UserName=? and Role=2";
        $data = $this->db->query($sql, array($email));
        if($data->num_rows()== 1){
            return $data->row();
        }else{
            return false;
        }
    }

    public function check_emailMobile($email){
        $sql = "select ID,UserName from advertiser where UserName=? and Role=2";
        $data = $this->db->query($sql, array($email));
        if($data->num_rows()== 1){
            return $data->row();
        }else{
            return false;
        }
    }
    
    //agr email pehle se db me nahi he to register krwane ke bad details send krni he
    public function register_first_time($data){
        $this->db->insert('advertiser', $data);
        return $this->db->insert_id();
    }
    
    //fb or google se register hone ke bad ya alery hone pr is function se data get krke api me dikhana he
    public function get_advertiser($id){
        $sql = "select * from advertiser where ID=? and Role=2";
        $data = $this->db->query($sql, array($id));
        if($data->num_rows()== 1){
            return $data->row();
        }else{
            return false;
        }
    }
    
    public function get_user($email){
        $sql = "select * from advertiser where UserName='$email'";
        $data = $this->db->query($sql, array($email));
        return $data->row();
    }
}