<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class Payment_model extends CI_Model{
    
    //after payment complete then call function and get data adverser email then send mail
    public function get_advertiser_mail($id) {
        $sql = "select a.ID,a.UserName,a.FirstName,a.LastName,b.TxtID,b.Amt,b.Encrypt,c.BusinessName,c.CaptionLine,c.Email,c.CellNo,c.BusinessAddress,c.PostCode from advertiser a inner join payment b on a.ID=b.UserID inner join advertisement c on c.ID=b.AdsID where a.ID=?";
        $data = $this->db->query($sql, array($id));
        return $data->row();
    }
    
    //if create free ad then send mail using to data get without payment table data match
    public function get_advertiser_withoutpay($id) {
        $sql = "select a.ID,a.UserName,a.FirstName,a.LastName,c.BusinessName,c.CaptionLine,c.Email,c.CellNo,c.BusinessAddress,c.PostCode from advertiser a inner join advertisement c on c.UserID=a.ID where c.ID=?";
        $data = $this->db->query($sql, array($id));
        return $data->row();
    }
    
    //default set value to get admin set value
    public function defaultSetUse($id) {
        $sql = "select * from setting_payment where ID=?";
        $data = $this->db->query($sql, array($id));
        return $data->row();
    }
}