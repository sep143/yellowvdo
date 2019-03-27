<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class Promotion_model extends CI_Model{
    
    //promotion videos
    public function get_videos(){
        $sql = "select Video,CaptionLine,BusinessName,UserID from advertisement";
        $data = $this->db->query($sql);
        return $data->result();
    }
}