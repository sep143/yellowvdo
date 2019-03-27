<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class Payment_model extends CI_Model{
    
    //get all payment transition
    public function get_payment_trans(){
        $sql = "select * from payment where StatusID <>3 order by CreatedDT desc";
        $data = $this->db->query($sql);
        return $data->result();
    }
    //all transition but todat transtion 
    public function get_payment_trans_today(){
//        $sql = "select * from payment where (CreatedDT = CURDATE()) and StatusID <>3";
        $sql = "SELECT *, DATE_FORMAT(payment.CreatedDT, '%Y-%m-%d') FROM payment WHERE DATE(CreatedDT) = CURDATE() and StatusID <>3";
        $data = $this->db->query($sql);
        return $data->result();
    }
    
    //refund payment show to data in table
    public function get_refund_trans(){
        $sql = "select a.*,d.FirstName,d.LastName,c.CaptionLine,c.BusinessName,c.ID as adid from refund a inner join payment b on a.PayID=b.ID"
                . " left join advertisement c on c.ID=b.AdsID "
                . " left join advertiser d on d.ID=c.UserID order by a.CreatedDT desc";
        $data = $this->db->query($sql);
        return $data->result();
    }
    public function get_refund_pending(){
        $sql = "select a.*,d.FirstName,d.LastName,c.CaptionLine,c.BusinessName,c.ID as adid from refund a inner join payment b on a.PayID=b.ID"
                . " left join advertisement c on c.ID=b.AdsID "
                . " left join advertiser d on d.ID=c.UserID where a.Status = 0";
        $data = $this->db->query($sql);
        return $data->result();
    }
    
    //refund request process
    public function payment_table_update($payid, $pay_table) {
        $this->db->where('ID', $payid);
        $this->db->update('payment', $pay_table);
    }
    
    public function refund_table_update($id, $refund_table) {
        $this->db->where('ID', $id);
        $this->db->update('refund', $refund_table);
        return true;
    }
    
    //after payment refund successfully done then this ad expired and date null
    public function get_ad_data($refundid) {
        $sql = "select * from refund a inner join payment b on a.PayID=b.ID where a.ID=?";
        $data = $this->db->query($sql, array($refundid));
        return $data->row();
    }
    //after success refund then update data
    public function update_advertisement($ad_id, $data) {
        $this->db->where('ID',$ad_id);
        $this->db->update('advertisement', $data);
        return true;
    }
}