<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class PdfGenerate_model extends CI_Model{
    
//this function user panel  
    //pdf generate data then get transtion table to check condition only
    public function get_tranaction_data_check_only($trns) {
        $sql = "select UserID from payment where ID=? and Phone='Completed' and StatusID <>3";
        $data = $this->db->query($sql, array($trns));
        return $data->row();
    }
    //pdf generate data then get transtion table to get data
    public function get_tranaction_data($userid, $trns) {
        $sql = "select * from payment where UserID=? and ID=? and Phone='Completed' and StatusID <>3";
        $data = $this->db->query($sql, array($userid, $trns));
        return $data->row();
    }
    //advertiser data
    public function get_advertiser_data($id){
        $sql = "select ID,FirstName,LastName,UserName,Phone,LandmarkAddress,Address from advertiser where ID=?";
        $data = $this->db->query($sql, array($id));
        return $data->row();
    }
    //advertisement data
    public function get_ads_data($adid){
        $sql = "select ID,BusinessName,CaptionLine,LandmarkAddress,BusinessAddress from advertisement where ID=?";
        $data = $this->db->query($sql, array($adid));
        return $data->row();
    }
    
 //this function only use to admin panel
    
    //pdf generate data then get transtion table to get data
    public function get_tranaction_data_admin($trns) {
        $sql = "select * from payment where ID=? and Phone='Completed' and StatusID <>3";
        $data = $this->db->query($sql, array($trns));
        return $data->row();
    }
    //advertiser data
    public function get_advertiser_data_admin($id){
        $sql = "select ID,FirstName,LastName,UserName,Phone,LandmarkAddress,Address from advertiser where ID=?";
        $data = $this->db->query($sql, array($id));
        return $data->row();
    }
    //advertisement data
    public function get_ads_data_admin($adid){
        $sql = "select ID,BusinessName,CaptionLine,LandmarkAddress,BusinessAddress from advertisement where ID=?";
        $data = $this->db->query($sql, array($adid));
        return $data->row();
    }
    
    //pdf generate send mail then send token and match to database then get data and download pdf
    public function download_invoice_email($token) {
        $sql = "select * from payment where Encrypt=? and Phone='Completed' and StatusID <>3";
        $data = $this->db->query($sql, array($token));
        return $data->row();
    }
}