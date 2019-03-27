<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class ItemCategoryController extends CI_Controller {
  
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function __construct() {
       parent::__construct();
       $this->load->database();
    }
  
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function index()
    {
        $this->load->view('items');
    }
   
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
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
          
          echo json_encode(array_values($data));
    }
   
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function membersTree($parent_key)
    {
        $row1 = [];
        $row = $this->db->query('SELECT * from category WHERE ParentID="'.$parent_key.'" order by Name asc')->result_array();
    
        foreach($row as $key => $value)
        {
           $id = $value['ID'];
           $row1[$key]['id'] = $value['ID'];
           $row1[$key]['name'] = $value['Name'];
           $row1[$key]['text'] = $value['Name'].'<i data-id='.$id.'></i>';
           if(!empty($this->membersTree($value['ID']))){
               $row1[$key]['nodes'] = array_values($this->membersTree($value['ID']));
           }
        }
        return $row1;
    }
      
}