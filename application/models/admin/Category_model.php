<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class Category_model extends CI_Model{
    
    
    //category add
    public function add_category($data){
        $this->db->insert('category', $data);
        return true;
    }
    
    //if select edit then call function and set data
    public function edit_category($id){
        $sql = "select * from category where ID=?";
        $data = $this->db->query($sql, array($id));
        return $data->row();
    }
    
    //update category
    public function update_category($data, $id){
        $this->db->where('ID', $id);
        $this->db->update('category', $data);
        return true;
    }


    //get data and view in table
    public function get_category() {
        $sql = "select * from category where StatusID <>3";
        $data = $this->db->query($sql);
        return $data->result();
    }
    
    //using ajax then update status function call
    public function category_status_change($id, $data) {
        $this->db->where('ID', $id);
        $this->db->update('category', $data);
        return TRUE;
    }
    
    //sub category table in use
    public function getItem()
    {
          $data = [];
          $parent_key = "0";
          $row = $this->db->query('select * from category');
            
          if($row->num_rows() > 0)
          {
              $data = $this->membersTree($parent_key);
          }else{
              $data=["id"=>"0","name"=>"No Members presnt in list","text"=>"No Members is presnt in list","nodes"=>[]];
          }
          
          //echo json_encode(array_values($data));
          return json_encode(array_values($data));
    }
    
    public function membersTree($parent_key)
    {
        $row1 = [];
        $row = $this->db->query('SELECT * from category WHERE ParentID="'.$parent_key.'"')->result_array();
    
        foreach($row as $key => $value)
        {
           $id = $value['ID'];
           $row1[$key]['id'] = $value['ID'];
           $row1[$key]['name'] = $value['Name'];
           $row1[$key]['text'] = $value['Name'];
           $row1[$key]['Popular'] = $value['Popular'];
           $row1[$key]['Icon'] = $value['Icon'];
           $row1[$key]['StatusID'] = $value['StatusID'];
           $row1[$key]['CreatedDT'] = $value['CreatedDT'];
           if(!empty($this->membersTree($value['ID']))){
               $row1[$key]['nodes'] = array_values($this->membersTree($value['ID']));
           }
           
        }
  
        return $row1;
    }
    
    //if click edit then brend kram category
    public function brend_kram($catid) {
        $sql = "SELECT c.* FROM (SELECT  @r AS _id,
            (SELECT @r := ParentID FROM category WHERE ID = _id) AS ParentID,
            @l := @l + 1 AS level FROM
            (SELECT @r := $catid, @l := 0) vars, category m WHERE @r <> 0) d
            JOIN category c
            ON d._id = c.ID order by ParentID";
        $data = $this->db->query($sql, array($catid));
        return $data->result();
    }
}