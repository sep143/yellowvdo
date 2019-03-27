<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class Common_model extends CI_Model{
    
    //notifiy for advertiser creator
    public function notification_user() {
        $sql = "select * from advertiser where Notification=1 and Role=2 and StatusID <>3";
        $data = $this->db->query($sql);
        return $data->num_rows();
    }
    //user table use in notification
    public function update_user_notify($notify) {
        $data = array(
            'Notification'=>0
        );
        $this->db->where_in('Notification', $notify);
        $this->db->update('advertiser', $data);
        return true;
    }
    
    //notify for ads creactor
    public function notification_ads(){
        $sql = "select * from advertisement where Notification=1 and StatusID <>3 and UserID IS NOT NULL";
        $data = $this->db->query($sql);
        return $data->num_rows();
    }
    //notify for ads edit
    public function notification_ads_edit(){
        $sql = "select * from advertisement where Notification=2 and StatusID <>3 and UserID IS NOT NULL";
        $data = $this->db->query($sql);
        return $data->num_rows();
    }
    
    //ads notification change and update
    public function update_ads_notify($notify) {
        $id = $notify;
        $data = array(
            'Notification'=>0
        );
        $this->db->where_in('Notification', $id);
        $this->db->update('advertisement', $data);
        return true;
    }
    
    //notify for refund 
    public function notification_refund(){
        $sql = "select * from refund where Notification=1 and StatusID <>3";
        $data = $this->db->query($sql);
        return $data->num_rows();
    }
    //ads notification change and update
    public function update_refund_notify($notify) {
        $data = array(
            'Notification'=>0
        );
        $this->db->where_in('Notification', $notify);
        $this->db->update('refund', $data);
        return true;
    }
    
    //notify message on header top
    public function notification_msg() {
        $sql = "select * from chat where NotifyAdmin=1 and StatusID <>3";
        $data = $this->db->query($sql);
        return $data->num_rows();
    }
    
    public function update_msg_notify($notify) {
        $data = array(
            'NotifyAdmin'=>0
        );
        $this->db->where_in('NotifyAdmin', $notify);
        $this->db->update('chat', $data);
        return true;
        
    }
    
    //advertiser table use to get filetr data
    public function get_advertier($sql) {
        
        $data = $this->db->query($sql);
        return $data->result();
    }
    
    //on dashboard get count only
    public function get_count_advertiser() {
        $sql = "select * from advertiser where StatusID <>3 and Role = 2";
        $data = $this->db->query($sql);
        return $data->num_rows();
    }
    
    public function get_count_ads() {
        $sql = "select * from advertisement where StatusID NOT IN (3,6) and UserID IS NOT NULL";
        $data = $this->db->query($sql);
        return $data->num_rows();
    }
    public function get_count_pending_ads() {
        $sql = "select * from advertisement where StatusID=0 and UserID IS NOT NULL";
        $data = $this->db->query($sql);
        return $data->num_rows();
    }
    public function get_count_expired_ads() {
        $sql = "select * from advertisement where StatusID=5 and UserID IS NOT NULL";
        $data = $this->db->query($sql);
        return $data->num_rows();
    }
    
    //use for graph only
    public function last_record_advertiser()
    {
        $query = $this->db->query("SELECT DATE_FORMAT(CreatedDT,'%Y-%m-%d') as last_date FROM advertiser ORDER BY ID DESC LIMIT 1");
        $result = $query->row();
        return $result;
    }

    public function last_record_ad()
    {
        $query = $this->db->query("SELECT DATE_FORMAT(CreatedDT,'%Y-%m-%d') as last_date FROM advertisement ORDER BY ID DESC LIMIT 1");
        $result = $query->row();
        return $result;
    }

    public function get_count_monthly_advertiser_bydate($startDate,$endDate) {    
        // print_r($endDate);exit();
        $sql = "SELECT COUNT(CreatedDT) AS eachDt, CreatedDT FROM advertiser WHERE CreatedDT >= ('$startDate' - INTERVAL 1 DAY)  AND CreatedDT <= ('$endDate' + INTERVAL 1 DAY) GROUP BY DATE(CreatedDT) ";
        $data = $this->db->query($sql, array($startDate,$endDate));
       return $data1 = $data->result();

//        $monthly = array();
//        $dates = array();
//        $count = array();
//        foreach($data1 as $value){ 
//           array_push($count, $value->eachDt);
//             array_push($dates, $value->dt);
//        }
//          array_push($monthly, $count,$dates);
//        return $monthly;
    }
    
    
//    public function get_count_monthly_advertiser_bydate($startDate,$endDate) {    
//        // print_r($endDate);exit();
//        $sql = "SELECT COUNT(CreatedDT) AS eachDt, DATE_FORMAT(CreatedDT, '%d') AS dt FROM advertiser WHERE CreatedDT >= '$startDate' AND CreatedDT <= '$endDate' GROUP BY DATE(CreatedDT)";
//        $data = $this->db->query($sql);
//        $data1 = $data->result();
//
//        $monthly = array();
//        $dates = array();
//        $count = array();
//        foreach($data1 as $value){ 
//           array_push($count, $value->eachDt);
//             array_push($dates, $value->dt);
//        }
//          array_push($monthly, $count,$dates);
//        return $monthly;
//    }

//    public function get_count_monthly_ad_bydate($startAdDate,$endAdDate) {        
//        
//        $sql = "SELECT COUNT(CreatedDT) AS eachAdDt, DATE_FORMAT(CreatedDT,'%d') AS AdDT FROM advertisement WHERE CreatedDT >= '$startAdDate' AND CreatedDT <= '$endAdDate' GROUP BY DATE(CreatedDT)";
//        $data = $this->db->query($sql);
//        $myadsdata = $data->result();
//        $monthlyads = array();
//        $monthlyadsDate = array();
//        $monthlyadsCount = array();
//        foreach($myadsdata as $value){ 
//           array_push($monthlyadsCount, $value->eachAdDt);
//           array_push($monthlyadsDate, $value->AdDT);
//        }
//        array_push($monthlyads, $monthlyadsCount,$monthlyadsDate);
//        // print_r($monthlyads);exit();
//        return $monthlyads;
//    }
    
    public function get_count_monthly_ad_bydate($startAdDate,$endAdDate) {        
        $sql = "SELECT COUNT(CreatedDT) AS eachDt, CreatedDT FROM advertisement WHERE CreatedDT >= ('$startAdDate' - INTERVAL 1 DAY)  AND CreatedDT <= ('$endAdDate' + INTERVAL 1 DAY) GROUP BY DATE(CreatedDT)";
        //$sql = "SELECT COUNT(CreatedDT) AS eachAdDt, DATE_FORMAT(CreatedDT,'%d') AS AdDT FROM advertisement WHERE CreatedDT >= '$startAdDate' AND CreatedDT <= '$endAdDate' GROUP BY DATE(CreatedDT)";
        $data = $this->db->query($sql);
       return $myadsdata = $data->result();
        
    }
    
    //agar advertiser to free se paid krte he to expiry null wale ads to statusid me expired kr denge
    public function set_expired_ads($id, $data) {
        $this->db->where('UserID', $id);
        $this->db->where('ExpiryDT IS NULL');
        $this->db->update('advertisement', $data);
        return true;
    }
    
}