<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class EnquiryController extends MY_Controller{
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        //$this->load->view('admin/enquiry/enquiry_list');
        $data['tital'] = $this->lang->line('enquiry');
        $this->load->view('admin/layout/header_view', $data);
        $this->load->view('admin/enquiry/enquiry_list');
        $this->load->view('admin/layout/footer_view');
    }
}