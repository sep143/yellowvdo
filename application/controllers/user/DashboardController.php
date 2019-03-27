<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class DashboardController extends UA_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('user/Common_model','Common');
        $this->load->helper('custom');
    }
    
//    public function index(){
//        //echo 'Hello dashboard';
//        $data['tital'] = 'Dashboard';
//        $this->load->view('web/user/layout/header_view', $data);
//        $this->load->view('web/user/layout/blank_view');
//        $this->load->view('web/user/layout/footer_view');
//    }
    
    public function profile() {
        $id = $this->session->userdata['user_profile']['id'];
        $data['user_data'] = $this->Common->get_userData($id);
        $data['navbar_title'] = 'Profile';
        $this->load->view('web/layout/header_web', $data);
        $this->load->view('web/layout/sidebar_web');
        $this->load->view('web/user/profile_web',$data);
        $this->load->view('web/layout/footer_web');
        
    }
    
    //update profile
    public function update_profile() {
        $id = $this->session->userdata['user_profile']['id'];
        $user_profile = $this->Common->get_userData($id);
        $this->form_validation->set_rules('first_name','First Name','required|trim|xss_clean');
        $this->form_validation->set_rules('last_name','Last Name','required|trim|xss_clean');
        $this->form_validation->set_rules('address','Address','required|trim|xss_clean');
        $this->form_validation->set_rules('postCode','Post Code','required|trim|xss_clean');
        if($this->form_validation->run()==FALSE){
            $this->profile();
        }else{
            //advertiser profile image upload
            if (!empty($_FILES['profile_image']['name'])) {
                    $path = './uploads/profile/';
                    unlink($path.$user_profile->Profile);
                $config['upload_path'] = './uploads/profile/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['profile_image']['name'];
                //$config['max_size'] = '100';
                $config['encrypt_name'] = true;
                $config['overwrite']     = FALSE; 
                //$config['max_width']  = '1024';
                //$config['max_height']  = '768';
                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('profile_image')) {
                    $uploadData = $this->upload->data();
                    $profile = $uploadData['file_name'];
                } else {
                    $profile = $user_profile->Profile;
                }
            } else {
                $profile = $user_profile->Profile;
            }
            $data = array(
                'FirstName'=>  $this->input->post('first_name'),
                'LastName'=>  $this->input->post('last_name'),
//                'UserName'=>  $this->input->post('email'),
//                'Pwd'=>  md5($this->input->post('password')),
                'LandmarkAddress'=> $this->input->post('LandmarkAddress'),
                'Address'=>  $this->input->post('address'),
                'Country'=>  $this->input->post('country'),
                'State'=>  $this->input->post('state'),
                'City'=>  $this->input->post('city'),
                'PostCode'=>  $this->input->post('postCode'),
                //'CountryCode'=>  $this->input->post('dial-code'),
                'Phone'=>  $this->input->post('phone'),
                'Profile'=> $profile,
                'LatLong'=> $this->input->post('lat').','.$this->input->post('lng'),
                //'CountryID'=> $this->input->post('country_id')
            );
           // print_r($data); exit();
            $result = $this->Common->update_user($id,$data);
            if($result){
                
                $this->session->set_flashdata('success_msg','Seccessfully updated your profile.');
                redirect(site_url('profile'));
            }
        }
    }
}