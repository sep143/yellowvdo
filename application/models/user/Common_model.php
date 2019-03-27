<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common_model extends CI_Model{
    
    public function get_userData($id) {
        $sql = "select * from advertiser where ID=?";
        $data = $this->db->query($sql, array($id));
        return $data->row();
    }
    //use admin panel in ad view
    public function userData($id) {
        $sql = "select * from advertiser where ID=?";
        $data = $this->db->query($sql, array($id));
        return $data->row();
    }
    
    //update profile 
    public function update_user($id,$data) {
        $this->db->where('ID', $id);
        $this->db->update('advertiser', $data);
        return true;
    }
    
    //check txtid then insert data
    public function insertTransaction_check($txid) {
        $sql = "select * from payment where TxtID=?";
        $data = $this->db->query($sql, array($txid));
        if($data->num_rows() == 0){
            return true;
        }else{
            return false;
        }
    }
    
    //insert transaction data
        public function insertTransaction($data){
                        
            $insert = $this->db->insert('payment',$data);
//            return $insert?true:false;
            $insert_id = $this->db->insert_id();
            return  $insert_id;
        }
    //insert transaction data after complete then update 
        public function insertTransaction_update($id,$data){
            $this->db->where('ID', $id);
            $this->db->update('payment', $data);
            return true;
        }
}