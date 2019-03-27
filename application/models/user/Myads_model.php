<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class Myads_model extends CI_Model{
    
    //get user login then view ads
    public function get_myads($id,$limit,$offset) {
        $sql = "select *,(select Images from advertisement_image where AdsID=advertisement.ID and StatusID <>3 LIMIT 1) as image from advertisement where UserID=? and StatusID <>3 ORDER BY CreatedDT desc LIMIT $limit OFFSET $offset";
        $data = $this->db->query($sql, array($id));
        return $data->result();
    }

    public function count_myads($id) {
        $sql = "select *,(select Images from advertisement_image where AdsID=advertisement.ID and StatusID <>3 LIMIT 1) as image from advertisement where UserID=? and StatusID <>3";
        $data = $this->db->query($sql, array($id));
        return $data->num_rows();
    }
    
    //msg send krte time AdsID attr ko check data insert krwaenge agr hoga to sify notify jayega other wise row insert karwayenge
    public function check_row($id) {
        $sql = "select * from chat where AdsID=?";
        $data = $this->db->query($sql, array($id));
        return $data->num_rows();
    }
    
    //get chat row data agr if condition me raha to 
    public function get_chat_row($id) {
        $sql = "select * from chat where AdsID=?";
        $data = $this->db->query($sql, array($id));
        return $data->row();
    }
    
    //update only notify
    public function update_notify($id, $data) {
        $this->db->where('ID', $id);
        $this->db->update('chat', $data);
    }
    
    //chat message insert data
    public function msg_save($data) {
        $this->db->insert('chat_message', $data);
        return true;
    }
    
    //chat table me data nahi hone pr new row insert hogi else condition se
    public function insert_chat_table($data) {
        $this->db->insert('chat', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    
     //datatable to edit ads then view edit page
     public function get_ads_byID($id, $adid){
         $sql = "select *,(select Images from advertisement_image where AdsID=advertisement.ID and StatusID <>3 limit 1) as image from advertisement where UserID=? and ID=? and StatusID <>3";
         $data = $this->db->query($sql, array($id,$adid));
         return $data->row();
     }
     public function get_category_byID($id){
        $sql = "select Name from category where ID=?";
        $data = $this->db->query($sql, array($id));
        return $data->row();
    }
    //edit time this ads all images get and view in div
     public function get_all_img_byID($id) {
         $sql = "select * from advertisement_image where AdsID=? and StatusID <>3";
         $data = $this->db->query($sql, array($id));
         return $data->result();
     }
     //get review
    public function get_review($adid) {
        $sql = "select AVG(Rating) as review from review where StatusID =1 and AdsID=? group by (AdsID)";
        $data = $this->db->query($sql, array($adid));
        return $data->row();
    }
    //get ads id to get review
    public function get_review_all($adid) {
        $sql = "select * from review where StatusID =1 and AdsID=?";
        $data = $this->db->query($sql, array($adid));
        return $data->result();
    }
    
    //brad kram category view
    public function brand_kram($catid){
        $sql = "SELECT c.* FROM (SELECT  @r AS _id,
            (SELECT @r := ParentID FROM category WHERE ID = _id) AS ParentID,
            @l := @l + 1 AS level FROM
            (SELECT @r := $catid, @l := 0) vars, category m WHERE @r <> 0) d
            JOIN category c
            ON d._id = c.ID order by ParentID";
        $data = $this->db->query($sql, array($catid));
        return $data->result();
    }
    
    //create ad then insert img in table
    function insert_image($imageData) {
        $this->db->insert('advertisement_image', $imageData);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
}