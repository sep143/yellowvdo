<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class PromotionController extends MY_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('admin/Promotion_model','Promotion');
    }
    
    public function index(){
        $data['tital'] = $this->lang->line('advertisement');
        $data['videos'] = $this->Promotion->get_videos();
        $this->load->view('admin/layout/header_view', $data);
        $this->load->view('admin/promotion/video_promotion');
        $this->load->view('admin/layout/footer_view');
    }
}