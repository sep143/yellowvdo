<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class GoogleplusController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/User_model','User');
        $this->load->model('user/Common_model','Common');
        
    }

    public function index() {
        if(!empty($this->session->userdata['user_profile']['id'])){
            $id = $this->session->userdata['user_profile']['id'];
            $data['user_data'] = $this->Common->get_userData($id);
        }
        if ($this->session->userdata('web_login') == true) {
            redirect('google_profile');
        }
        if (isset($_GET['code'])) {

            $this->googleplus->getAuthenticate();
            $this->session->set_userdata('web_login', true);
            $userData = $this->googleplus->getUserInfo();
            //$this->session->set_userdata('user_profile', $this->googleplus->getUserInfo());
            $check = $this->User->get_user($userData['email']);
            $checkCount = $this->User->get_user_count($userData['email']);
            
            $session_data = array(
                    'id'=> $check->ID,
                    'first_name'=> $userData['given_name'],
                    'user_name' => $userData['email'],
                    'profile'=> $userData['picture'],
                    'accountType'=> $check->AccountType,
                    'type' => 2
                );
                $this->session->set_userdata('user_profile', $session_data);
            //if database in not avaliable data then insert data
            if($checkCount <= 0){
                $data=array(
                    'SocialID'=> $userData['id'],
                    'FirstName'=> $userData['given_name'],
                    'LastName'=> $userData['family_name'],
                    'UserName'=> $userData['email'],
                    'Profile'=>$userData['picture'],
                    'Token'=>  $this->googleplus->getAccessToken(),
                    //'link'=>$userData['link'],
                    'RegisterType'=>2,
                );
                $data = $this->User->add_user($data);
                $r_data = $this->User->get_user_id($data);
                $session_data = array(
                    'id'=> $r_data->ID,
                    'first_name'=> $userData['given_name'],
                    'user_name' => $userData['email'],
                    'profile'=> $userData['picture'],
                    'accountType'=> $r_data->AccountType,
                    'type' => 2
                );
                $this->session->set_userdata('user_profile', $session_data);
                //print_r($check); exit();
                if($data){
                    redirect('google_profile');
                }
            }else{
                redirect('google_profile');
            }
            
            
        }

        $contents['login_url'] = $this->googleplus->loginURL();
        //$this->load->view('welcome_message', $contents);
        $this->load->view('admin/auth/login', $contents);
    }

    public function profile() {
        if(!empty($this->session->userdata['user_profile']['id'])){
            $id = $this->session->userdata['user_profile']['id'];
            $data['user_data'] = $this->Common->get_userData($id);
        }
        if ($this->session->userdata('web_login') != true) {
            redirect('login');
        }

        $contents['user_profile'] = $this->session->userdata('user_profile');
        //$this->load->view('profile', $contents);
        redirect('');
//        $this->load->view('web/layout/header_web',$data);
//        $this->load->view('web/home_web');
//        $this->load->view('web/layout/footer_web');
    }

//    public function logout() {
//
//        $this->session->sess_destroy();
//        $this->googleplus->revokeToken();
//        redirect('login');
//    }

}
