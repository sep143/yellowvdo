<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class Refund_model extends CI_Model{
    
    //send refund request then submit data
    public function refund_request($data) {
        $this->db->insert('refund', $data);
        return true;
    }
    
    //get user id to refund request 
    public function get_refund_data($id,$limit,$offset) {
        $sql = " select c.*,a.*,a.CreatedDT as refundDT,c.ID as Ad_id, (select Images from advertisement_image where AdsID=b.AdsID and StatusID <>3 LIMIT 1) as image from "
                . " refund a inner join payment b on a.PayID=b.ID "
                . " inner join advertisement c on c.ID=b.AdsID where a.UserID=? and c.StatusID <>3 and a.StatusID <>3 ORDER BY a.CreatedDT desc LIMIT $limit OFFSET $offset";
        $data = $this->db->query($sql, array($id));
        return $data->result();
    }

    public function count_refund_data($id) {
        $sql = " select c.*,a.*, (select Images from advertisement_image where AdsID=b.AdsID and StatusID <>3 LIMIT 1) as image from "
                . " refund a inner join payment b on a.PayID=b.ID "
                . " inner join advertisement c on c.ID=b.AdsID where a.UserID=? and c.StatusID <>3 and a.StatusID <>3";
        $data = $this->db->query($sql, array($id));
        return $data->num_rows();
    }
}