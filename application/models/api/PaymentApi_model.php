<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class PaymentApi_model extends CI_Model{

 	public function get_refundAll($userid,$limit,$offset){
		$sql = "select refund.*, payment.TxtID as transactionID, advertisement.captionLine from refund left join payment on refund.PayID = payment.ID left join advertisement on payment.AdsID = advertisement.ID WHERE refund.UserID = $userid and payment.StatusID <>3 and advertisement.StatusID <>3 ORDER BY payment.CreatedDT desc limit $limit offset $offset";
		$data = $this->db->query($sql, array($userid,$limit,$offset));
		return $data->result();
	}
	public function get_transactionAll($userid,$limit,$offset){
		$sql = "SELECT DISTINCT payment.*,advertisement.CaptionLine FROM payment LEFT JOIN advertisement ON advertisement.ID = payment.AdsID WHERE payment.UserID = $userid and payment.StatusID <>3 ORDER BY payment.CreatedDT desc LIMIT $limit offset $offset" ;
		$data = $this->db->query($sql, array($userid,$limit,$offset));
		//$data = $this->db->get_where('payment', array('UserID' => $userid),$limit,$offset);
		return $data->result();
	}
        //refund request send via mobile api
        public function send_refund_request($data) {
            $this->db->insert('refund', $data);
            return true;
        }
        //after refund request then payment table update
        public function send_refund_request_update_payment_table($id, $data) {
            $this->db->where('ID', $id);
            $this->db->update('payment', $data);
            return true;
        }

}
