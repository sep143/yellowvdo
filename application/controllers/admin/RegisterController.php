<?php
defined('BASEPATH')OR exit('No direct script access allowed');

/*
 * Advertiser register via admin panel to new registration
 * 
 */

class RegisterController extends MY_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('admin/Advertiser_model','Advertiser');
        $this->load->model('admin/User_model','User');
        $this->load->model('admin/Common_model','Common');
        $this->load->helper('custom');
    }
    
    public function index() {
        $data['tital'] = $this->lang->line('advertiser');
        $data1['advertiser_list'] = $this->Advertiser->get_all_advertiser();
        $this->load->view('admin/layout/header_view', $data);
        $this->load->view('admin/advertiser/advertiser_show', $data1);
        $this->load->view('admin/layout/footer_view');
    }
    
    public function createUser(){
        $this->form_validation->set_rules('first_name','First Name','required|trim|xss_clean');
        $this->form_validation->set_rules('last_name','Last Name','required|trim|xss_clean');
        $this->form_validation->set_rules('email','Email ID','required|trim|xss_clean|valid_email|is_unique[advertiser.UserName]',array('is_unique' => 'Already register %s.'));
        $this->form_validation->set_rules('password','Password','required|trim|xss_clean');
        $this->form_validation->set_rules('password_confirmation','Password','required|trim|xss_clean|matches[password]');
        $this->form_validation->set_rules('address','Address','required|trim|xss_clean');
        $this->form_validation->set_rules('postCode','Post Code','required|trim|xss_clean');
        if($this->form_validation->run()==FALSE){
            $this->index();
        }else{
            //advertiser profile image upload
            if (!empty($_FILES['profile_image']['name'])) {
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
                    $profile = NULL;
                }
            } else {
                $profile = NULL;
            }
            $data = array(
                'FirstName'=>  $this->input->post('first_name'),
                'LastName'=>  $this->input->post('last_name'),
                'UserName'=>  $this->input->post('email'),
                'Pwd'=>  md5($this->input->post('password')),
                'LandmarkAddress'=> $this->input->post('LandmarkAddress'),
                'Address'=>  $this->input->post('address'),
                'Country'=>  $this->input->post('country'),
                'State'=>  $this->input->post('state'),
                'City'=>  $this->input->post('city'),
                'PostCode'=>  $this->input->post('postCode'),
                'Phone'=>  $this->input->post('phone'),
                'CountryCode'=>  $this->input->post('dial-code'),
                'Profile'=> $profile,
                'LatLong'=> $this->input->post('lat').','.$this->input->post('lng'),
                'CreatedBy'=> $this->session->userdata('log_id'),
                'AccountType'=> $this->input->post('typeAc'),
                'RegisterType'=> 3,
                //'CountryID'=> $this->input->post('country_id')
            );
           // print_r($data); exit();
            $result = $this->Advertiser->add_new_advertiser($data);
            if($result){
                $this->session->set_flashdata('success_msg','Seccessfully Add New Advertiser.');
                redirect(site_url('admin/advertiser/show'));
            }
        }
    }
    
    //ajax call to change status never reload page 
    public function advertiser_change_status(){
        $id = $this->input->post('id');
        $value = $this->input->post('value');
        if($id){
            if($value == 3){
                $data = array(
                    'StatusID'=> $value,
                    'DeletedBy'=> $this->session->userdata('log_id'),
                    'DeletedDT'=> date('Y-m-d H:i:s'),
                );
            }else{
                $data = array(
                    'StatusID'=> $value,
                    'LastModifiedBy'=> $this->session->userdata('log_id'),
                    'LastModifiedDT'=> date('Y-m-d H:i:s'),
                );
            }
            
            $result = $this->Advertiser->advertiser_change_status($id, $data);
        }
    }


    public function editUser($id=0) {
        $data['tital'] = 'Edit Advertiser';
        $data1['advertiser'] = $this->Advertiser->get_advertiser_byID($id);
        $this->load->view('admin/layout/header_view', $data);
        $this->load->view('admin/advertiser/advertiser_edit', $data1);
        $this->load->view('admin/layout/footer_view');
    }
    
    public function updateUser(){
        $id = $this->input->post('id');
        $user_profile = $this->Advertiser->get_advertiser_byID($id);
//        $this->form_validation->set_rules('first_name','First Name','required|trim|xss_clean');
//        $this->form_validation->set_rules('last_name','Last Name','required|trim|xss_clean');
//        $this->form_validation->set_rules('email','Email ID','required|trim|xss_clean|valid_email|is_unique[advertiser.UserName]');
//        $this->form_validation->set_rules('password','Password','required|trim|xss_clean');
//        $this->form_validation->set_rules('password_confirmation','Password','required|trim|xss_clean|matches[password]');
        $this->form_validation->set_rules('address','Address','required|trim|xss_clean');
        $this->form_validation->set_rules('postCode','Post Code','required|trim|xss_clean');
        if($this->form_validation->run()==FALSE){
            $this->editUser($id);
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
                    $profile = NULL;
                }
            } else {
                $profile = $user_profile->Profile;
            }

            $data = array(
//                'FirstName'=>  $this->input->post('first_name'),
//                'LastName'=>  $this->input->post('last_name'),
//                'UserName'=>  $this->input->post('email'),
//                'Pwd'=>  md5($this->input->post('password')),
                'LandmarkAddress'=> $this->input->post('LandmarkAddress'),
                'Address'=>  $this->input->post('address'),
                'Country'=>  $this->input->post('country'),
                'State'=>  $this->input->post('state'),
                'City'=>  $this->input->post('city'),
                'PostCode'=>  $this->input->post('postCode'),
                'CountryCode'=>  $this->input->post('dial-code'),
                'Phone'=>  $this->input->post('phone'),
                'Profile'=> $profile,
                'LatLong'=> $this->input->post('lat').','.$this->input->post('lng'),
                'AccountType'=> $this->input->post('typeAc'),
                'LastModifiedBy'=> $this->session->userdata('log_id'),
                'LastModifiedDT'=> date('Y-m-d H:i:s'),
            );
//            print_r($data); exit();
            $result = $this->User->update_user($id,$data);
            if($result){
                //if change account type then change ads status
                if($this->input->post('typeAc') == 1){
                    //advertiser agr paid banate he tb null expiry wale ads to expired kr denge
                    $ads_data = array(
                        'StatusID'=>5
                    );
                    $this->Common->set_expired_ads($id, $ads_data);
                }else if($this->input->post('typeAc') == 0){
                    
                }
                $this->session->set_flashdata('success_msg','Seccessfully Updated Advertiser.');
                redirect(site_url('admin/advertiser/edit/'.$id));
            }
        }
    }

        //advertiser datatable in view panel
    public function advertiser_list(){
        
    }
    
    //datatable to click view then open advertiser details show and paerticular advertser details show
    public function viewUser($id=0){
        $data['tital'] = 'View Advertiser';
        $data1['advertiser'] = $this->Advertiser->get_advertiser_byID($id);
        $data1['advertiser_ads'] = $this->Advertiser->get_all_ads_byID($data1['advertiser']->ID);
        $this->load->view('admin/layout/header_view', $data);
        $this->load->view('admin/advertiser/advertiser_view', $data1);
        $this->load->view('admin/layout/footer_view');
    }
    
    //advertiser view panel then get all adverisement this particular ads
    public function getByid_advertisement(){
         $id = $this->input->post('id');
         $type = $this->input->post('type');
        if($type == 'ads'){
            $data1['duepay'] = 1; //due pay ads not show
           $data1['advertiser_ads'] = $this->Advertiser->get_all_ads_byID($id);
           $this->load->view('admin/advertiser/ajax/advertiser_ads', $data1);
        }else if($type == 'dua_pay'){
            $data1['duepay'] = 0; //due pay ads not show
            $data1['advertiser_ads'] = $this->Advertiser->get_all_ads_byID($id);
           $this->load->view('admin/advertiser/ajax/advertiser_ads', $data1);
        }
        else if($type == 'transitions'){
            $data1['advertiser_trans'] = $this->Advertiser->get_all_transitions_byID($id);
            $this->load->view('admin/advertiser/ajax/advertiser_transitions', $data1);
        }
    }
}