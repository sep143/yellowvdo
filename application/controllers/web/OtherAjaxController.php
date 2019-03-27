<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class OtherAjaxController extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('web/Ads_model', 'Ads');
        $this->load->model('web/Homepage_model','Home');
        $this->load->model('user/Common_model','Common');
        if(!empty($this->session->userdata['user_profile']['id'])){
            $id = $this->session->userdata['user_profile']['id'];
            $data['user_data'] = $this->Common->get_userData($id);
        }
    }
    
    //get category id to set bread searl set
    public function bread_kram(){
        $catid = $this->input->post('catid');
        
        $sql = "SELECT c.* FROM (SELECT  @r AS _id,
            (SELECT @r := ParentID FROM category WHERE ID = _id) AS ParentID,
            @l := @l + 1 AS level FROM
            (SELECT @r := $catid, @l := 0) vars, category m WHERE @r <> 0) d
            JOIN category c
            ON d._id = c.ID order by ParentID";
        
        $data = $this->Ads->get_ads_search($sql);
        
        foreach ($data as $count=> $row):
            if($count == sizeof($data) - 1){
                   echo $row->Name;   
            }else{
                echo $row->Name.' -> ';
            }
        endforeach;
    }
    //get category id to set bread searl set ads list view in top
    public function bread_kram2(){
        $catid = $this->input->post('catid');
        
        $sql = "SELECT c.* FROM (SELECT  @r AS _id,
            (SELECT @r := ParentID FROM category WHERE ID = _id) AS ParentID,
            @l := @l + 1 AS level FROM
            (SELECT @r := $catid, @l := 0) vars, category m WHERE @r <> 0) d
            JOIN category c
            ON d._id = c.ID order by ParentID";
        
        $data = $this->Ads->get_ads_search($sql);
        
        foreach ($data as $count=> $row):
            if($count == sizeof($data) - 1){
                  // echo $row->Name;   
                echo '<a href="'.  site_url('category-wise/ads/'.$row->ID).'">'.$row->Name.'</a>';
            }else{
                echo '<a href="'.  site_url('category-wise/ads/'.$row->ID).'">'.$row->Name.'</a>'.' -> ';
            }
        endforeach;
    }
}