<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class Transitions_model extends CI_Model{
    
    //get user open then transitions 
    public function get_all_transitions($id,$limit,$offset) {
        $sql = "select DISTINCT a.ID as transID,a.*, b.*,a.ID as PayID, a.StatusID as stID,a.CreatedDT as payDT, (select Images from advertisement_image where AdsID=a.AdsID and StatusID <>3 LIMIT 1) as image from payment a inner join advertisement b on a.AdsID=b.ID "
                . "LEFT JOIN advertisement_image ON a.AdsID = advertisement_image.AdsID"
                . " where a.UserID=? and b.StatusID <>3 and a.StatusID <>3 and a.Phone='Completed' ORDER BY a.CreatedDT desc LIMIT $limit OFFSET $offset";
        $data = $this->db->query($sql, array($id));
        return $data->result();
        
    }
    
    public function count_all_transactions($id) {
        $sql = "select DISTINCT a.*, b.*,a.ID as PayID, a.StatusID as stID, (select Images from advertisement_image where AdsID=a.AdsID and StatusID <>3 LIMIT 1) as image from payment a inner join advertisement b on a.AdsID=b.ID "
                . "LEFT JOIN advertisement_image ON a.AdsID = advertisement_image.AdsID"
                . " where a.UserID=? and b.StatusID <>3 and a.StatusID <>3 and a.Phone='Completed'";
        $data = $this->db->query($sql, array($id));
        return $data->num_rows();
        
    }
    
    //if transitions table then click refund request then payment tyable in change status and deactive button
    public function update_status($payID, $data) {
        $this->db->where('ID', $payID);
        $this->db->update('payment', $data);
    }
}