<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class RoleController extends MY_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->helper('custom');
        $this->load->model('admin/Setting_model','Setting');
        if($this->session->userdata('log_role') != 1){
            //echo 'Sorry';
            redirect(site_url('error_page'));
        }
    }
    
    //user role defined >> list open
    public function user_role_list() {
        $data['tital'] = $this->setting_role;
        $data['user_role'] = $this->Setting->get_role_user();
        $this->load->view('admin/layout/header_view', $data);
        $this->load->view('admin/setting/role_user_list');
        $this->load->view('admin/layout/footer_view');
        
    }
    
    //add role user
    public function add_role_user() {
        $data['tital'] = $this->setting;
        
        $this->load->view('admin/layout/header_view', $data);
        $this->load->view('admin/setting/role_user_add');
        $this->load->view('admin/layout/footer_view');
    }
    
    //create role user
    public function create_role_user() {
        $this->form_validation->set_rules('fname','First Name','required|trim|xss_clean');
        $this->form_validation->set_rules('lname','Last Name','required|trim|xss_clean');
        $this->form_validation->set_rules('email','Email ID','required|trim|xss_clean|valid_email|is_unique[advertiser.UserName]',array('is_unique' => 'Already register %s.'));
        $this->form_validation->set_rules('phone','Phone No.','required|trim|xss_clean');
        $this->form_validation->set_rules('password','Password','required|trim|xss_clean');
        $this->form_validation->set_rules('cpassword','Confirm Password','required|trim|xss_clean|matches[password]');
        if($this->form_validation->run()==FALSE){
            $this->add_role_user();
        }else{
            $data=array(
               'FirstName'=> $this->input->post('fname'),
               'LastName'=>  $this->input->post('lname'),
                'UserName'=>  $this->input->post('email'),
                'Phone'=>  $this->input->post('phone'),
                'Pwd'=> md5($this->input->post('password')),
                'CreatedBy'=>  $this->session->userdata('log_in'),
                'Role'=> $this->input->post('role'),
            );
//            print_r($data); exit();
            $result = $this->Setting->create_role_user($data);
            if($result){
                $this->session->set_flashdata('success_msg','Successfully new user create.');
                redirect('admin/setting/user_role');
            }
        }
    }
    
    //edit role user
    public function edit_role_user($id=0) {
        $data['tital'] = 'Edit Role User';
        $data['user_role'] = $this->Setting->get_user_role_byid($id);
        $this->load->view('admin/layout/header_view', $data);
        $this->load->view('admin/setting/role_user_edit');
        $this->load->view('admin/layout/footer_view');
    }
    
    //update edit role
    public function update_edit_role($id=0){
        $this->form_validation->set_rules('fname','First Name','required|trim|xss_clean');
        $this->form_validation->set_rules('lname','Last Name','required|trim|xss_clean');
        $this->form_validation->set_rules('phone','Phone No.','required|trim|xss_clean');
        if($this->input->post('password') && $this->input->post('cpassword')){
            $this->form_validation->set_rules('password','Password','required|trim|xss_clean');
            $this->form_validation->set_rules('cpassword','Confirm Password','required|trim|xss_clean|matches[password]');
        }
        if($this->form_validation->run()==FALSE){
            $this->add_role_user();
        }else{
            if($this->input->post('password') && $this->input->post('cpassword')){
                    $data=array(
                        'FirstName'=> $this->input->post('fname'),
                        'LastName'=>  $this->input->post('lname'),
                        'Phone'=>  $this->input->post('phone'),
                        'Pwd'=> md5($this->input->post('password')),
                        'Role'=> $this->input->post('role'),
                        'LastModifiedBy'=>  $this->session->userdata('log_in'),
                        'LastModifiedDT'=>  date('Y-m-d H:i:s'),
                         
                     );
            }else{
                $data=array(
                    'FirstName'=> $this->input->post('fname'),
                    'LastName'=>  $this->input->post('lname'),
                    'Phone'=>  $this->input->post('phone'),
//                     'Pwd'=> md5($this->input->post('password')),
                    'Role'=> $this->input->post('role'),
                    'LastModifiedBy'=>  $this->session->userdata('log_in'),
                    'LastModifiedDT'=>  date('Y-m-d H:i:s'),
                 );
            }
            
//            print_r($data); exit();
            $result = $this->Setting->update_edit_role($id,$data);
            if($result){
                $this->session->set_flashdata('success_msg','Successfully update user.');
                redirect('admin/setting/user_role');
            }
        }
    }
    
    //role user table on filter set use
    public function role_filter() {
        $id_search = $this->input->post('id');
        $location = $this->input->post('location');
        $st = $this->input->post('status');
        $status = '';
        $from = '';
        $to = '';
        $category = $this->input->post('category');
        
        if(!empty($this->input->post('from'))){
             $from = date('Y-m-d', strtotime($this->input->post('from')));
        }
       
        if(!empty($this->input->post('to'))){
             $to = date('Y-m-d', strtotime($this->input->post('to')));
        }
        
        $use = $this->input->post('use');
        if($use == 'role_user'){
            $sql = "select * from advertiser where StatusID <>3 and Role IN (3,4,5,6,7)";
            if(!empty($id_search)){
                $sql = $sql." and ID like $id_search";
            }
            if(!empty($location)){
                $sql = $sql." and (LandmarkAddress like '%$location%' or Address like '%$location%') ";
            }
            if(!empty($st)){
                if($st == 2){
                    $sql = $sql." and StatusID=2";
                }else{
                    $sql = $sql." and StatusID=$st";
                }
            }
            if(!empty($from) && !empty($to)){
                $sql = $sql." and CreatedDT >= '".$from."' and CreatedDT < ('".$to."' + INTERVAL 1 DAY)";
            }
//            echo $sql;
            $data['user_role'] = $this->Setting->get_data_result($sql);
            $this->load->view('admin/setting/ajax/filter_data', $data);
            //echo 'Data Check - '.$id_search.' -From '.$from.' -To'.$to.'-Loc '.$location.' St '.$status;
        }
    }
}