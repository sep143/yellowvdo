<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class Advertisement_model extends CI_Model{
    
    //free ads submit then call function and submit data value in database
    public function add_advertisement_free($data){
        $this->db->insert('advertisement', $data);
        return true;
    }
    
    //free ads get details if AdsType=0
    public function get_free_ads(){
        $sql = "select * from advertisement where AdsType=0 and UserID IS NULL and StatusID <>3 order by CreatedDT desc";
        $data = $this->db->query($sql);
        return $data->result();
    }
    
    //free ads in change status 
    public function free_ads_change_status($id, $data){
        $this->db->where('ID', $id);
        $this->db->update('advertisement', $data);
        return TRUE;
    }
    
    //in case free ads post table to edit then get id to data and edit view file on show data
    public function get_free_ad_byID($id){
        $sql = "select * from advertisement where ID=? and UserID IS NULL";
        $data = $this->db->query($sql, array($id));
        return $data->row();
    }
    
    //free ads list in edit button click then edit information
    public function get_category_byID($id){
//        $sql = "select Name from category where ID=?";
        $sql = "SELECT c.* FROM (SELECT  @r AS _id,
            (SELECT @r := ParentID FROM category WHERE ID = _id) AS ParentID,
            @l := @l + 1 AS level FROM
            (SELECT @r := $id, @l := 0) vars, category m WHERE @r <> 0) d
            JOIN category c
            ON d._id = c.ID order by ParentID";
        $data = $this->db->query($sql, array($id));
        return $data->result();
    }
    
    //advertisement list click then new ads click and all ads show in datatable and get all user create ads time show
    public function get_all_ads(){
        $sql = "select a.*,b.FirstName,b.LastName,(select Images from advertisement_image where AdsID=a.ID and StatusID <>3 LIMIT 1) as image from advertisement a LEFT JOIN advertiser b on a.UserID=b.ID where a.StatusID NOT IN (3,6) and b.StatusID <>3 order by a.CreatedDT desc";
        $data = $this->db->query($sql);
        return $data->result();
    }
    
    public function get_all_user(){
        $sql = "select * from advertiser where StatusID <>3 and Role = 2";
        $data = $this->db->query($sql);
        return $data->result();
    }
    
    //insert add
    public function insertAds($data){
     	$this->db->insert('advertisement', $data); 
     	$insert_id = $this->db->insert_id();
     	return  $insert_id;
     }
     
     //insert image
     public function insert_image($imageData){
     	$this->db->insert('advertisement_image', $imageData); 
     }
     
     //video insert
     public function insert_video($id, $videoData){
         $data = array(
             'Video'=> $videoData
         );
         $this->db->where('ID', $id);
     	$this->db->update('advertisement', $data);
     }
     
     //datatable to edit ads then view edit page
     public function get_ads_byID($id){
         $sql = "select * from advertisement where ID=? and StatusID <>3";
         $data = $this->db->query($sql, array($id));
         return $data->row();
     }
     
     //edit time this ads all images get and view in div
     public function get_all_img_byID($id) {
         $sql = "select * from advertisement_image where AdsID=? and StatusID <>3";
         $data = $this->db->query($sql, array($id));
         return $data->result();
     }
     
     //update ads
     public function updateAds($id, $data){
     	return $this->db->update('advertisement', $data, array('ID' => $id));
     }
     
     //image deleted by edit time then call ajax function to deleted image use only status change
     public function image_deleted($id, $data) {
         $this->db->where('ID', $id);
         $this->db->update('advertisement_image', $data);
     }
     
     //pending datattable in view if create advertser ads then admin to approve
     public function get_pendingAds() {
         $sql = "select a.*,b.FirstName,b.LastName,(select Images from advertisement_image where AdsID=a.ID and StatusID <>3 LIMIT 1) as image from advertisement a LEFT JOIN advertiser b on a.UserID=b.ID where a.StatusID=0 and b.StatusID <>3 order by CreatedDT desc ";
         $data = $this->db->query($sql);
         return $data->result();
     }
     //pending datattable in view if create advertser ads then admin to approve
     public function get_editAds() {
         $sql = "select a.*,b.FirstName,b.LastName,(select Images from advertisement_image where AdsID=a.ID and StatusID <>3 LIMIT 1) as image from advertisement a LEFT JOIN advertiser b on a.UserID=b.ID where a.StatusID=2 and b.StatusID <>3 order by CreatedDT desc ";
         $data = $this->db->query($sql);
         return $data->result();
     }
     public function get_expiredAds() {
         $sql = "select a.*,b.FirstName,b.LastName,(select Images from advertisement_image where AdsID=a.ID and StatusID <>3 LIMIT 1) as image from advertisement a INNER JOIN advertiser b on a.UserID=b.ID where a.StatusID=5 and b.StatusID <>3 order by CreatedDT desc";
         $data = $this->db->query($sql);
         return $data->result();
     }
     
     //expired date se 1 month before data get krna he
     public function get_expired_before_Ads(){
         $sql = "select a.*,b.FirstName,b.LastName,(select Images from advertisement_image where AdsID=a.ID and StatusID <>3 LIMIT 1) as image from advertisement a INNER JOIN advertiser b on a.UserID=b.ID where a.ExpiryDT BETWEEN CURRENT_DATE() AND (CURRENT_DATE() + INTERVAL 1 MONTH) and b.StatusID <>3 order by CreatedDT desc";
         $data = $this->db->query($sql);
         return $data->result();
     }
     
     //via get id input in function then use status id then 
     public function get_disapproveAds($stID){
         $sql = "select a.*,b.FirstName,b.LastName,(select Images from advertisement_image where AdsID=a.ID and StatusID <>3 LIMIT 1) as image from advertisement a INNER JOIN advertiser b on a.UserID=b.ID where a.StatusID=$stID and b.StatusID <>3 order by CreatedDT desc ";
         $data = $this->db->query($sql,array($stID));
         return $data->result();
     }
     
     //for use account list to datatable to send mail advertisement mail
     //Get Advertiser Mail address
    public function get_email_add($advertiser_id) {
            $sql = "SELECT adv.UserName,adv.FirstName,adv.LastName,ads.BusinessName,ads.CaptionLine,ads.BusinessAddress,ads.LandmarkAddress,ads.CreatedDT,ads.ExpiryDT FROM advertiser as adv JOIN advertisement as ads ON ads.UserID=adv.ID WHERE ads.ID = $advertiser_id";
            $data = $this->db->query($sql);
            return $data->row_array();
        }
        
        //send mail in case ads active and disaprrove time
    public function get_ads_mail_via_id($id) {
        $sql = "select a.*,b.UserName, b.FirstName, b.LastName from advertisement a inner join advertiser b on a.UserID=b.ID where a.ID=? and a.StatusID <>3";
        $data = $this->db->query($sql, array($id));
        return $data->row();
    }

}