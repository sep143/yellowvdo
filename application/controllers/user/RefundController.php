<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class RefundController extends UA_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('user/Common_model','Common');
        $this->load->helper('custom');
        $this->load->model('user/Refund_model','Refund');
        $this->load->model('user/Transitions_model','Transitions');
    }
    
    //get refund request then data
    public function refund_request(){
        $id = $this->session->userdata['user_profile']['id'];
        $data['user_data'] = $this->Common->get_userData($id);
        $data['navbar_title'] = 'Refund';
        
        /*Pagination Setup Start*/ 
        $base_url = "refund";
        $total_rows = $this->Refund->count_refund_data($id);
        $per_page = 5;
        $uri_segment = 2;
        $config=$this->customlib->paginate($base_url,$total_rows,$per_page,$uri_segment);        
        $this->pagination->initialize($config);
        $page = ($this->uri->segment($config['uri_segment'],0) > 0)?$this->uri->segment($config['uri_segment'],0):0;
        /*Pagination Setup End*/ 
        $data['refund'] = $this->Refund->get_refund_data($id,$config['per_page'],$page);
        $data['links'] = $this->pagination->create_links(); // Pagination Link
        $this->load->view('web/layout/header_web', $data);
        $this->load->view('web/layout/sidebar_web');
        $this->load->view('web/user/refund_web',$data);
        $this->load->view('web/layout/footer_web');
    }
    
    //payment transition table to submit then data put
    public function refund_request_submit() {
        $payID = $this->input->post('Payid');
        $data = array(
            'StatusID'=>2
        );
        $this->Transitions->update_status($payID, $data);
        $data = array(
            'UserID'=> $this->session->userdata['user_profile']['id'],
            'PayID'=> $this->input->post('Payid'),
            'TxtID'=> $this->input->post('Txtid'),
            'Amt'=> $this->input->post('Amt'),
            'UserMsg'=> $this->input->post('msg'),
        );
        //print_r($data); exit();
        $result = $this->Refund->refund_request($data);
        if($result){
            $this->session->set_flashdata('success_msg','Successfully refund request.');
            redirect('transitions');
        }
    }
}