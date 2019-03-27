<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class SettingController extends MY_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->helper('custom');
        $this->load->model('admin/Setting_model','Setting');
        if($this->session->userdata('log_role') != 1){
            //echo 'Sorry';
            redirect(site_url('error_page'));
        }
    }
        
    //common setting change
    public function common_setting() {
        $data['tital'] = $this->setting;
       $data['image_limit'] = $this->Setting->get_image_limit(1);
       $data['payment'] = $this->Setting->get_payment(1);
        $this->load->view('admin/layout/header_view', $data);
        $this->load->view('admin/setting/common_setting');
        $this->load->view('admin/layout/footer_view');
    }
    
    //image set priority
    public function set_image_limit() {
        $image_id = 1;
       $data = array(
           'Config'=>  $this->input->post('image_limit'),
           'LastModifiedBy'=> $this->session->userdata('log_id'),
           'LastModifiedDT'=> date('Y-m-d H:i:s'),
       ); 
       $result = $this->Setting->set_image_limit($image_id, $data);
       if($result){
           $this->session->set_flashdata('success_msg','Successfully change image limit');
           redirect('admin/setting/common_setting'); 
       }
    }
    
    //change password
    public function change_password() {
        $id = $this->session->userdata('log_id');
        $data = $this->Setting->get_data_advertiser($id);
        $old_pwd = md5($this->input->post('old_password'));
        if($data->Pwd == $old_pwd){
            $this->form_validation->set_rules('password','Password','required|trim|xss_clean');
            $this->form_validation->set_rules('cpassword','Confirm Password','required|trim|xss_clean|matches[password]');
            if($this->form_validation->run()==false){
                $this->common_setting();
            }else{
                $data = array(
                    'Pwd'=>md5($this->input->post('password'))
                );
                //print_r($data); exit();
                $result = $this->Setting->change_password($id, $data);
                if($result){
                   $this->session->set_flashdata('success_msg','Successfully change password');
                    redirect('admin/setting/common_setting'); 
                }
            }
        }else{
            $this->session->set_flashdata('danger_msg','Old password dose not match');
            redirect('admin/setting/common_setting');
        }
    }
    
    //change payment for ads
    public function change_payment() {
       $id = 1; 
       $amt = $this->input->post('amt');
       $tax = $this->input->post('tax');
       $total = $this->input->post('total');
       $data = array(
           'Amt'=>$amt,
           'Tax'=>$tax,
           'Total'=>$total,
           'LastModifiedBy'=> $this->session->userdata('log_id'),
           'LastModifiedDT'=> date('Y-m-d H:i:s'),
       );
       $result = $this->Setting->change_payment($id,$data);
       if($result){
            $this->session->set_flashdata('success_msg','Ads payment updated');
             redirect('admin/setting/common_setting'); 
         }
    }
    
    //payment calculation
    public function calculation() {
        $amt = $this->input->post('amt');
        $tax = $this->input->post('tax');
        if($amt && $tax){
            
            $total = (($amt * $tax)/100);
            echo $d = $total + $amt;
        }
        
    }
    
    
}