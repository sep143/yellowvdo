<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class OtherApi_model extends CI_Model{

 	public function send_msg($userid,$adsid,$message){
		$sql = "select * from chat where AdsID=?";
        $data = $this->db->query($sql, array($adsid));
        if($data->num_rows()<1){
           $chatData = array(
                  'AdsID'=>$adsid,
                  'NotifyAdmin'=>1,
                  'StatusID'=>1
        	);
           $this->db->insert('chat', $chatData);
           $msgData = array(
                  'ChatID'=>$this->db->insert_id(),
                  'UserID'=>$userid,
                  'Msg'=>$message,
                  'StatusID'=>1
        	);
           $this->db->insert('chat_message', $msgData);
           return $this->db->insert_id();
        }else{
			$this->db->update('chat', array('NotifyAdmin' =>1), array('AdsID' => $adsid));
			$msgData = array(
                  'ChatID'=>$data->row()->ID,
                  'UserID'=>$userid,
                  'Msg'=>$message,
                  'StatusID'=>1
        	);
           $this->db->insert('chat_message', $msgData);
           return $this->db->insert_id();
        }
	}

	public function get_msg($adsid){
		$sql = "select * from chat where AdsID=?";
        $data = $this->db->query($sql, array($adsid));
        if($data->num_rows()>=1){
        	$chatid = $data->row()->ID;
		$sql = "SELECT DISTINCT ChatID,UserID,Msg,chat_message.CreatedDT FROM chat_message LEFT JOIN chat ON $chatid = chat_message.ChatID WHERE chat_message.ChatID = $chatid order by chat_message.CreatedDT DESC" ;
		$data1 = $this->db->query($sql);
		//$data = $this->db->get_where('payment', array('UserID' => $userid),$limit,$offset);
		return $data1->result();
		}
		else{
			return false;
		}
	}

	public function chat_list($userid,$limit,$offset){
		$sql = "SELECT DISTINCT chat.*,chat_message.UserID,advertisement.BusinessName,(select Images from advertisement_image where AdsID=chat.AdsID and StatusID <>3 LIMIT 1) as image FROM chat LEFT JOIN chat_message ON chat.id = chat_message.ChatID LEFT JOIN advertisement ON chat.AdsID =advertisement.ID LEFT JOIN advertisement_image ON chat.AdsID = advertisement_image.AdsID WHERE chat_message.UserID = $userid order by chat.NotifyUser DESC LIMIT $limit OFFSET $offset";
		$data1 = $this->db->query($sql);
		return $data1->result();
	}

	public function notify($adsid){
		return $this->db->update('chat', array('NotifyUser' => 0 ), array('AdsID' => $adsid));
	}

	public function insert_review($data){
		$sql = "select * from review where DeviceID=? and AdsID=?";
		$d = $this->db->query($sql, array($data['DeviceID'],$data['AdsID']));
		if($d->num_rows()>=1){
			return  false;
		}
     	$this->db->insert('review', $data); 
     	$insert_id = $this->db->insert_id();
     	return  $insert_id;
     }

}
