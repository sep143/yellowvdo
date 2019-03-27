<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class Homepage_model extends CI_Model{
    
    //get category
    public function get_category() {
        $sql = "select category.*,(select COUNT(CategID) from advertisement where advertisement.CategID=category.ID and advertisement.StatusID=1) as ad_count from category where StatusID =1 and ParentID=0 and Popular=1";
        $data = $this->db->query($sql);
        return $data->result();
    }
}