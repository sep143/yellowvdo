<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class Message_model extends CI_Model{
    
    //get chat table in get data on datatable on show
    public function get_chat() {
        $sql = "select DISTINCT a.*,c.*,a.ID as chatID,c.Country as Country,c.StatusID as stID,c.ID as user_id from chat a "
                . "left join advertisement b on a.AdsID=b.ID "
                . "left join advertiser c on b.UserID=c.ID "
                . "left join chat_message d on d.UserID=c.ID where a.StatusID <>3 group by (user_id)";
        $data = $this->db->query($sql);
        return $data->result();
    }
    
    //get chat ads get all
    public function get_chat_ads($user_id) {
//        $sql = "select DISTINCT a.ID as chat_id, b.* from "
//                . "chat a left join advertisement b on a.AdsID=b.ID "
//                . "left join advertiser c on b.UserID=c.ID "
//                . "left join chat_message d on d.UserID=c.ID where a.StatusID <>3 and d.UserID=$user_id";
        $sql = "SELECT DISTINCT chat.*,chat_message.UserID,chat_message.CreatedDT as msg_dt,advertisement.BusinessName,advertisement.CaptionLine,"
                . " (select Images from advertisement_image where AdsID=chat.AdsID and StatusID <>3 LIMIT 1) as image FROM"
                . " chat LEFT JOIN chat_message ON chat.id = chat_message.ChatID "
                . "LEFT JOIN advertisement ON chat.AdsID =advertisement.ID "
                . "LEFT JOIN advertiser ON advertisement.UserID=advertiser.ID "
                . "LEFT JOIN advertisement_image ON chat.AdsID = advertisement_image.AdsID WHERE chat_message.UserID=$user_id and chat.StatusID <>3 group by (chat_message.ChatID) order by chat.NotifyUser DESC";
        $data = $this->db->query($sql, array($user_id));
        return $data->result();
    }
    
    //all ads open then get chat msg and view
    public function get_chat_msg($chat_id) {
        $sql = "select chat_message.* from chat inner join chat_message on chat.ID=chat_message.ChatID where chat_message.ChatID=$chat_id";
        $data = $this->db->query($sql, array($chat_id));
        return $data->result();
    }
    //click any ads then notify view of admin
    public function read_msg($chat_id) {
        $data = array(
            'NotifyAdmin'=>0,
            'LastModifiedBy'=> $this->session->userdata('log_id'),
            'LastModifiedDT'=> date('Y-m-d H:i:s'),
        );
        $this->db->where('ID', $chat_id);
        $this->db->update('chat', $data);
    }
    
    //if add msg for admin
    public function add_msg($data) {
        $this->db->insert('chat_message', $data);
        return true;
    }
    
    //message open then update notify
    public function update_notify($id, $data) {
        $this->db->where('ID', $id);
        $this->db->update('chat', $data);
        return true;
    }
    
    
}