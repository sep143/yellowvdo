<?php

defined('BASEPATH')OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/User_model', 'user_model');
    }

    public function index() {
        //$this->load->view('admin/auth/login');
        $this->load->view('admin/auth/login_view');
    }

    public function login() {
        $this->form_validation->set_rules('user_name','User Name','required|trim|xss_clean');
        $this->form_validation->set_rules('password','Password','required|trim|xss_clean|callback_check');
        if($this->form_validation->run()==FALSE){
            $this->index();
        }  else {
            redirect(site_url('admin/dashboard'));
        }
    }
    
     function check($password){
        $userName=  $this->input->post('user_name');
        $result=  $this->user_model->check($userName,$password);
        if ($result) {
            if ($result->Role != 2) { //advertiser user ko chhod kr baki pr login kr dega
                $data = array(
                    'log_id' => $result->ID,
                    'log_fname' => $result->FirstName,
                    'log_lname' => $result->LastName,
                    'log_user_name' => $result->UserName,
                    'log_role' => $result->Role,
                    'login' => true,
                );
                $this->session->set_userdata($data);
                return TRUE;
            }//role check condition
            else {
                $this->form_validation->set_message('check', 'No Authorised.');
                return FALSE;
            }
        } else {
            $this->form_validation->set_message('check', 'Invalid email id or password');
            return FALSE;
        }
    }

        //
    public function register(){
        if($this->input->post('submit')){
            
        }else{
            $this->load->view('admin/auth/register_view');
        }
    }

    //logout function
    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url('admin'), 'refresh');
    }

    //forgot password

    public function forgate_password() {
        if ($this->input->post('submit')) {
            $email = $this->input->post('email');
            $this->form_validation->set_rules('email', 'Email', 'required|xss_clean|trim|valid_email');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('admin/auth/forgot_view');
            } else {
                $findEmail_1 = $this->auth_model->forgate_password($email);
                
                if ($findEmail_1) {

                    $findEmail['name'] = $findEmail_1['first_name'];
                    $findEmail['temp_pass'] = sha1($findEmail_1['email']);
                    $findEmail['temp_key'] = sha1('AppsInfotech@123');
                    $message = $this->load->view('admin/forgot_password.php', $findEmail, true);
                    $config = Array(
                        'protocol' => 'smtp',
                        'smtp_host' => $this->port['smtp_host'],
                        'smtp_port' => $this->port['port'],
                        'smtp_user' => $this->mail['emailID'], //'info@appspunditinfotech.com', // change it to yours
                        'smtp_pass' => $this->pwd['password'], //'appspundit16*', // change it to yours
                        'mailtype' => 'html',
                        'charset' => 'iso-8859-1',
                        //'priority' => '1',
                        'wordwrap' => TRUE
                    );
                    $this->load->library('email', $config);
                    $this->email->set_newline("\r\n");
                    $this->email->from($this->mail['emailID'], "Forgot Password");
                    $this->email->to($email);
                    $this->email->subject(" - New Generate Password");
                    $this->email->message($message);
                    $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
                    $this->email->set_header('Content-type', 'text/html');

                    $this->email->send();

                    // echo $this->email->print_debugger();
                    //echo "<script> alert('Please check your email. You'll receive a link to reset your password.') </script>";
                    //echo "<script> $.alert({title: 'Reset Password !', content: 'Please check your email. You'll receive a link to reset your password.',}); </script>";
                    $this->session->set_flashdata('msg', 'Send Mail... Please Check Mail.');
                    redirect(base_url() . 'admin//LoginController/login', 'refresh');
                } else {
                    //echo "<script> $.alert({title: 'Reset Password !', content: 'Please enter correct email', }); </script>";
                    echo "<script>alert(' $email not found, please enter correct email id')</script>";
                    redirect(base_url() . 'admin/LoginController/forgate_password', 'refresh');
                }
            }
        } else {
            $this->load->view('admin/auth/forgot_view');
        }
    }

    public function reset_password($temp_pass) {
        $valid = $this->auth_model->temp_pass_valid($temp_pass);
        if ($temp_pass) {
            $data['temp_email'] = $temp_pass;
            $this->load->view('admin/reset_password', $data);
        } else {
            echo "<script>alert('The Key is Not Valid')</script>";
        }
    }

    public function update_password() {
        $temp_email = $this->input->post('temp_email');
        $email = $this->input->post('email');
        $this->form_validation->set_rules('email', 'Email', 'required|xss_clean|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]');
        if ($this->form_validation->run() == FALSE) {
            redirect(site_url('admin/LoginController/forgate_password'));
        } else {
            $findEmail_1 = $this->auth_model->forgate_password($email);
            
            if (!empty($findEmail_1)) {
                $key_email = sha1($findEmail_1['email']);
                $key_temp = sha1('AppsInfotech@123');
                $key = $key_email . $key_temp;
                if ($key == $temp_email) {

                    $data = array(
                        'password' => sha1($this->input->post('password')),
                    );
                    $result = $this->auth_model->update_pass($email, $data);
                    if ($result == true) {
                        echo "<script>alert('Password change successfully!')</script>";
                        redirect(base_url() . 'admin//LoginController/login', 'refresh');
                    } else {
                        echo "<script>alert('Key miss match admin!')</script>";
                        redirect(base_url() . 'admin//LoginController/forgate_password', 'refresh');
                    }
                } else {
                    echo "<script>alert('Key miss match!')</script>";
                    redirect(base_url() . 'admin//LoginController/forgate_password', 'refresh');
                }
            }
        }
    }

}
