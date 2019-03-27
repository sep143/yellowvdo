<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class Review_model extends CI_Model{
    
    //get all reviews get data for DB
    public function get_reviews(){
        $sql = "select a.*,c.FirstName,c.LastName from review a left join advertisement b on a.AdsID=b.ID Left join advertiser c on c.ID=b.UserID where a.StatusID <>3 order by a.CreatedDT desc ";
        $data = $this->db->query($sql);
        return $data->result();
    }
    
    //datatable me advertiser ka name ke liye muje advertisement table se advertiser ki id get krni he
    public function get_advertiserID($adsID){
        $sql = "select UserID from advertisement where ID=?";
        $data = $this->db->query($sql, array($adsID));
        return $data->row();
    }
    
    //get_advertiserID se advertiser ki id nikalne ke bad advertiser ki details ko nikalne ka function
    public function get_advertiser($userID){
        $sql = "select * from advertiser where ID=?";
        $data = $this->db->query($sql, array($userID));
        return $data->row();
    }
    
    //datatbale in change status then Approve and Disapprove click button
    public function change_review_status($id, $data){
        $this->db->where('ID', $id);
        $this->db->update('review', $data);
        return true;
    }
    
    //edit review
    public function get_reviews_byID($id) {
        $sql = "select *, a.StatusID as stID,a.ID from review a inner join advertisement b on a.AdsID=b.ID where a.ID=?";
        $data = $this->db->query($sql, array($id));
        return $data->row();
    }
    
    //if update review 
    public function update_review($id, $data){
//        return $data;
        $this->db->where('ID', $id);
        $this->db->update('review', $data);
        return true;
    }
}
