<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class Advertiser_model extends CI_Model{
    
    //get all advertiser view datatable
    public function get_all_advertiser(){
        $sql="select * from advertiser where StatusID <>3 and Role <>1 order by CreatedDT desc";
        $data = $this->db->query($sql);
        return $data->result();
    }
    
    //add new advertiser
    public function add_new_advertiser($data){
        $this->db->insert('advertiser', $data);
        return true;
    }
    
    //datatable in change status the click to ajax call and change status
    public function advertiser_change_status($id, $data) {
        $this->db->where('ID', $id);
        $this->db->update('advertiser', $data);
        return true;
    }
    
    //datatable to edit button click then get advertiser detail;s to edit page on view then update details
    public function get_advertiser_byID($id){
        $sql = "select * from advertiser where ID=? and Role <>1";
        $data = $this->db->query($sql, array($id));
        if($data->num_rows()==1){
            return $data->row();
        }else{
            return false;
        }
    }
    //advertiser ID to get all ads in perticular a/c
    public function get_all_ads_byID($id){
        $sql = "select *,(select Images from advertisement_image where AdsID=advertisement.ID and StatusID <>3 LIMIT 1) as image from advertisement where UserID=? and StatusID <>3 order by CreatedDT desc ";
        $data= $this->db->query($sql, array($id));
        return $data->result();
    }
    
    //advertiser all transitions
    public function get_all_transitions_byID($id){
        $sql = "select b.*,a.TxtID,a.Amt,a.CreatedDT as date,a.Phone,a.ID as transID from payment a inner join advertisement b on a.AdsID=b.ID where a.UserID=? order by CreatedDT desc ";
        $data = $this->db->query($sql, array($id));
        return $data->result();
    }
}