<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class TransitionsController extends UA_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('user/Common_model','Common');
        $this->load->helper('custom');
        $this->load->model('user/Transitions_model','Transitions');
    }
    
//    get all transitions
    public function get_transitions() {
        $id = $this->session->userdata['user_profile']['id'];
        $data['user_data'] = $this->Common->get_userData($id);
        $data['navbar_title'] = 'Transitions';
        
        /*Pagination Setup Start*/ 
        $base_url = "transitions";
        $total_rows = $this->Transitions->count_all_transactions($id);
        $per_page = 5;
        $uri_segment = 2;
        $config=$this->customlib->paginate($base_url,$total_rows,$per_page,$uri_segment);        
        $this->pagination->initialize($config);
        $page = ($this->uri->segment($config['uri_segment'],0) > 0)?$this->uri->segment($config['uri_segment'],0):0;
        /*Pagination Setup End*/ 

        $data['transitions'] = $this->Transitions->get_all_transitions($id,$config['per_page'],$page);
        $data['links'] = $this->pagination->create_links(); // Pagination Link
        $this->load->view('web/layout/header_web', $data);
        $this->load->view('web/layout/sidebar_web');
        $this->load->view('web/user/transitions_web',$data);
        $this->load->view('web/layout/footer_web');
    }
}