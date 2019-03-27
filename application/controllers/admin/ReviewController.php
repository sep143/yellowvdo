<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class ReviewController extends MY_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('admin/Review_model', 'Review');
    }
    
    public function index(){
        $data['tital'] = 'Review List';//$this->lang->line('advertisement');
        
        $data['review_list'] = $this->Review->get_reviews();
        $this->load->view('admin/layout/header_view', $data);
        $this->load->view('admin/review/review_table');
        $this->load->view('admin/layout/footer_view');
    }
    
    //review table me Advertiser name dikhane ke liye ads id se advertiser ka name get krne ke liye ajax call ki h
    public function get_advertiser(){
        $adsID = $this->input->post('adsID');
        if($adsID){
            //pehle advertiserment table se advertiser ki id get krunga
            $advertiser = $this->Review->get_advertiserID($adsID);
            if($advertiser){
                $user = $this->Review->get_advertiser($advertiser->UserID);
                echo $user->FirstName.' '.$user->LastName;
            }
        }
    }
    
    //datatable me hi statas change krne ke liye function call for ajax
    public function change_review_status(){
        $id = $this->input->post('id');
        $value = $this->input->post('value');
        if($id){
            $data = array(
                'StatusID'=>$value,
                'LastModifiedBy'=> $this->session->userdata('log_id'),
                'LastModifiedDT'=> date('Y-m-d H:i:s'),
            );
            $result = $this->Review->change_review_status($id, $data);
            //change status
        }
    }
    
    //datatable to edit button click then open edit page and value
    public function edit_review($id){
        if($this->input->post('submit')){
            $this->form_validation->set_rules('comment','Comment','required');
            if($this->form_validation->run()==FALSE){
                $this->index();
            }else{
                $data_db=array(
                    'StatusID'=>  $this->input->post('status'),
                    'Comment'=> $this->input->post('comment'),
                    'LastModifiedBy'=> $this->session->userdata('log_id'),
                    'LastModifiedDT'=> date('Y-m-d H:i:s'),
                );
               // print_r($data_db); exit();
                $result = $this->Review->update_review($id, $data_db);
               // print_r($result); exit();
                if($result){
                    redirect(site_url('admin/review'));
                }
            }
        }else{
            $data['tital'] = 'Review Edit';//$this->lang->line('advertisement');
            
            $data1['review'] = $this->Review->get_reviews_byID($id);
            $data1['advertiser'] = $this->Review->get_advertiser($data1['review']->UserID);
            $this->load->view('admin/layout/header_view', $data);
            $this->load->view('admin/review/review_edit', $data1);
            $this->load->view('admin/layout/footer_view');
        }
    }
   
    
    //datatable to click view only then visible data
    public function view_review($id=0){
        $data['tital'] = 'Review View';//$this->lang->line('advertisement');
        $data1['review'] = $this->Review->get_reviews_byID($id);
        $data1['advertiser'] = $this->Review->get_advertiser($data1['review']->UserID);
        $this->load->view('admin/layout/header_view', $data);
        $this->load->view('admin/review/review_show', $data1);
        $this->load->view('admin/layout/footer_view');
    }
}