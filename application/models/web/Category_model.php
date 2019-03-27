<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class Category_model extends CI_Model{
    
    //result data get then use function
    public function get_result($sql){
        $data = $this->db->query($sql);
        return $data->result();
    }
    
    //get row wise data find then call function
    public function get_row($sql){
        $data = $this->db->query($sql);
        return $data->row();
    }
    
    //get sub category
    public function get_sub_category($catid) {
        $sql = "select *,(select COUNT(CategID) from advertisement where CategID IN (category.ID)) as ads_count
            from (select * from category order by ParentID, ID) category,
                        (select @pv := '$catid') initialisation where StatusID=1 and find_in_set(ParentID, @pv) > 0
                and @pv := concat(@pv, ',', ID); ";
        $data = $this->db->query($sql, array($catid));
        return $data->result();
    }
}