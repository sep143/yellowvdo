<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class DashboardController extends MY_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('admin/Common_model','Common');
    }
    
    public function index(){
        //echo 'Hello dashboard';
        $data['tital'] = $this->lang->line('dashboard');
       // $data['head_tital'] = $this->lang->line('head_title');
        $data['advertiser'] = $this->Common->get_count_advertiser();
        $data['ads'] = $this->Common->get_count_ads();
        $data['pending_ads'] = $this->Common->get_count_pending_ads();
        $data['expired_ads'] = $this->Common->get_count_expired_ads();
        
        $data['last_advertiser'] = $this->Common->last_record_advertiser();
        $endDate = $data['last_advertiser']->last_date;
        $startDate = date('Y-m-d', strtotime('-30 days', strtotime($endDate)));        
        
        $data['monthly_advertiser'] = $this->Common->get_count_monthly_advertiser_bydate($startDate,$endDate);
        $data['last_ad'] = $this->Common->last_record_ad();
        if(!empty($data['last_ad'])){
            $endAdDate = $data['last_ad']->last_date;
            $startAdDate = date('Y-m-d', strtotime('-30 days', strtotime($endAdDate)));        
            $data['monthly_ads'] = $this->Common->get_count_monthly_ad_bydate($startAdDate,$endAdDate);
        }
        
        $this->load->view('admin/layout/header_view', $data);
        $this->load->view('admin/dashboard_view');
        $this->load->view('admin/layout/footer_view');
    }
    
    public function blank(){
        $data['tital'] = 'Blank Page';
        $this->load->view('admin/layout/header_view', $data);
        $this->load->view('admin/layout/blank_view');
        $this->load->view('admin/layout/footer_view');
    }
    
    //incase not authorise url and this page not open
    public function error_page() {
        $data['tital'] = 'Not authorised this page';
       
        $this->load->view('admin/layout/header_view', $data);
        $this->load->view('admin/error_page_view');
        $this->load->view('admin/layout/footer_view');
    }
    
//    public function category(){
//        $data['tital'] = 'Category';
//        $this->load->view('admin/layout/header_view', $data);
//        $this->load->view('admin/category_view');
//        $this->load->view('admin/layout/footer_view');
//    }
}