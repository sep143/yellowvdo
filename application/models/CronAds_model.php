<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class CronAds_model extends CI_Model{
    
    //get ads 
    public function get_ads() {
        $sql = "select ExpiryDT,ID from advertisement where StatusID <>3 and ExpiryDT IS NOT NULL";
        $data = $this->db->query($sql);
        return $data->result();
    }
    
    //crop date match then update status id
    public function update_status($id, $data) {
        $this->db->where('ID', $id);
        $this->db->update('advertisement',$data);
        return true;
    }
    
    //for reminder mail send time work this function
    public function get_ads_mail() {
        $sql = "select a.*,b.UserName, b.FirstName, b.LastName from advertisement a inner join advertiser b on a.UserID=b.ID where a.StatusID <>3 and a.ExpiryDT IS NOT NULL";
        $data = $this->db->query($sql);
        return $data->result();
    }
    
}