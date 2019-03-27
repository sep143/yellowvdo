<?php

defined('BASEPATH')OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('customlib');
        $this->load->model('admin/User_model', 'user_model');
        $this->load->model('user/Login_model','Login_x');
        $this->load->helper('custom');
        $this->admin_mail = 'satish.office2018@gmail.com';
    }

    public function index() {
        if(!empty($this->session->userdata('web_login'))){
            redirect('');
        }else{
            $this->load->view('web/layout/header_web');
            $this->load->view('web/user/auth/login');
            $this->load->view('web/layout/footer_web');
        }
    }

    //user panel to login then user data check and login 
    public function login() {
        $this->form_validation->set_rules('user_name','User Name','required|trim|xss_clean|valid_email');
        $this->form_validation->set_rules('password','Password','required|trim|xss_clean|callback_check');
        if($this->form_validation->run()==FALSE){
            $this->index();
        }else{
            redirect('');
        }
    }
    
    public function check($password){
        $userName = $this->input->post('user_name');
        $result = $this->user_model->check($userName, $password);
        if ($result) {
            if ($result->Role == 2) {
                if($result->EmailVerify == 1){
                    if ($result->StatusID == 1) {
                        if ($result) {
                            $this->session->set_userdata('web_login', true);
                            $data = array(
                                'id' => $result->ID,
                                'first_name' => $result->FirstName,
                                'user_name' => $result->UserName,
                                'profile' => $result->Profile,
                                'type' => $result->RegisterType,
                                'accountType'=> $result->AccountType,
                                    //'login'=> true,
                            );
                            $this->session->set_userdata('user_profile', $data);
                            return TRUE;
                        } else {
                            $this->form_validation->set_message('check', 'Invalid email id or password');
                            return FALSE;
                        }
                    }//statusID check
                    else {
                        $this->form_validation->set_message('check', 'Inactive Account. Please Contact Admin.');
                        return FALSE;
                    }
                }else{
                    $this->form_validation->set_message('check', 'Email not verify <u><a href="'.  base_url().'resend_email?email='.$userName.'">Resend</a></u> email');
                    return FALSE;
                }
            }//role check then session set
            else {
                $this->form_validation->set_message('check', 'No authorise user...');
                return FALSE;
            }
        } else {
            $this->form_validation->set_message('check', 'Invalid email id or password');
            return FALSE;
        }
    }
    
    //resend verify link send mail
    public function resend_link_mail() {
        $email = $this->input->get('email');
       // echo $email;
        $data = $this->user_model->get_user($email);
       if($data){
        // Welcome mail sent to user start
            $subject = "Welcome to YellowVOD";
            $mail_data['name'] = $data->FirstName." ". $data->LastName;
            $mail_data['email'] = $data->UserName;
            $mail_data['phone'] = $data->Phone;
            $mail_data['msg_title'] = "Welcome to YellowVOD";
            $mail_data['verify_link'] = $data->EmailVerify;
            $mail_data['msg'] = "Your new<span style='color:#5121ad;font-weight:bold!important;'> YellowVOD</span> Account has been created. Welcome to the<span style='color:#5121ad;font-weight:bold!important;'> YellowVOD!</span>
            <br><br> From now on, please login to your account using your email address<span style='color:#5121ad;font-weight:bold!important;'> ".$mail_data['email']."</span> To add more details in your profile.";

            $mail_data['msg_title_af'] = "<span style='color:#000;font-weight:bold!important;'>Manage Your New Account:</span><br><br> With your new <span style='color:#5121ad;font-weight:bold!important;'> YellowVOD</span> Account. you can <br><br><ul><li>Manage your profile</li><li>Manage your advertisements</ul>";
            $message = $this->load->view('web/user/mail_msg/welcome_mail.php', $mail_data, true);
           // $this->load->view('web/user/mail_msg/welcome_mail', $mail_data);
            $this->customlib->send_exp_remider($mail_data['email'], $message, $subject);
            // Welcome mail sent to user end
            
                $this->session->set_flashdata('resend_msg','Create account successfully.');
                redirect('login');
            }
    }

    //
    public function register(){
        $this->load->view('web/layout/header_web');
        $this->load->view('web/user/auth/register_view');
        $this->load->view('web/layout/footer_web');
    }
    
    //add register
    public function add_register(){
            $this->form_validation->set_rules('fname','First Name','required|trim|xss_Clean');
            $this->form_validation->set_rules('lname','Last Name','required|trim|xss_Clean');
//            $this->form_validation->set_rules('mobile','Mobile No.','required|trim|xss_Clean|is_unique[advertiser.Phone]');
            $this->form_validation->set_rules('email','Email ID.','required|trim|xss_Clean|valid_email|is_unique[advertiser.UserName]',
                    array('is_unique' => 'Already register %s.'));
            $this->form_validation->set_rules('password','Password','required|trim|xss_Clean|min_length[8]');
            $this->form_validation->set_rules('cpassword','Confirm Password','required|trim|xss_Clean|matches[password]');
            if($this->form_validation->run()==false){
                $this->register();
            }else{
                $lat = null;
                if($this->input->post('lat') && $this->input->post('lng')){
                    $lat = $this->input->post('lat').','.$this->input->post('lng');
                }
                $key = 'AppsInfotech@123';
                $email_verify_link = sha1($this->input->post('email').md5($this->input->post('password')).$key.date('Y-m-d'));
                $data = array(
                    'FirstName'=> $this->input->post('fname'),
                    'LastName'=> $this->input->post('lname'),
                    'Phone'=> $this->input->post('mobile'),
                    'UserName'=>  $this->input->post('email'),
                    'Pwd'=> md5($this->input->post('password')),
                    'Address'=> $this->input->post('full_address'),
                    'City'=> $this->input->post('city'),
                    'State'=> $this->input->post('state'),
                    'Country'=>  $this->input->post('country'),
                    'PostCode'=> $this->input->post('postCode'),
                    'LatLong'=> $lat,
                    'RegisterType'=> 3,
                    'EmailVerify'=> $email_verify_link
                );
              //  print_r($data); exit();
                $result = $this->user_model->add_user($data);
                // Welcome mail sent to user start
                $subject = "Welcome to YellowVOD";
                $mail_data['name'] = $data['FirstName']." ". $data['LastName'];
                $mail_data['email'] = $data['UserName'];
                $mail_data['phone'] = $data['Phone'];
                $mail_data['msg_title'] = "Welcome to YellowVod";
                $mail_data['verify_link'] = $email_verify_link;
                $mail_data['msg'] = "Your new<span style='color:#5121ad;font-weight:bold!important;'> YellowVOD</span> Account has been created. Welcome to the<span style='color:#5121ad;font-weight:bold!important;'> YellowVOD!</span>
                <br><br> From now on, please login to your account using your email address<span style='color:#5121ad;font-weight:bold!important;'> ".$mail_data['email']."</span> To add more details in your profile.";

                $mail_data['msg_title_af'] = "<span style='color:#000;font-weight:bold!important;'>Manage Your New Account:</span><br><br> With your new <span style='color:#5121ad;font-weight:bold!important;'> YellowVOD</span> Account. you can <br><br><ul><li>Manage your profile</li><li>Manage your advertisements</ul>";
                $message = $this->load->view('web/user/mail_msg/welcome_mail.php', $mail_data, true);
                $this->customlib->send_exp_remider($mail_data['email'], $message, $subject);
                // Welcome mail sent to user end
                if($result){
                    //send admin mail
                    $subject = "New advertiser register";
                    $mail_data_admin['name'] = $data['FirstName']." ". $data['LastName'];
                    $mail_data_admin['email'] = $data['UserName'];
                    $mail_data_admin['phone'] = $data['Phone'];
                    $mail_data_admin['address'] = $data['Address'];
                    $mail_data_admin['post_code'] = $data['PostCode'];
                    $mail_data_admin['msg_title'] = "New advertiser register";
                    //$mail_data['verify_link'] = sha1(date('Y-m-d H:i:s'));
                    $mail_data_admin['msg'] = 'More information please open admin panel and advertiser list check.';
                    $message = $this->load->view('web/user/mail_msg/new_advertiser_admin_mail.php', $mail_data_admin, true);
                    $this->customlib->send_exp_remider($this->admin_mail, $message, $subject);
                    
                    $this->session->set_flashdata('register_msg','Create account successfully.');
                    redirect('login');
                }
            }
    }
    
     //verify link
    public function verify_link($key) {
       // echo $key;
        if($key){
            $result = $this->Login_x->check_verify_link($key);
            if($result){
                $data = array(
                    'EmailVerify'=>1
                );
                $ok = $this->Login_x->confirm_verify_email($result->ID, $data);
                if($ok){
                   // Welcome mail sent to user start
                    $Email['name'] = $result->FirstName.' '.$result->LastName;
                    $Email['msg_title'] = 'Email verified';
                    $message = $this->load->view('web/user/mail_msg/confirm_verify.php', $Email, true);
                    $subject = 'Email verified successfully.';
                    $this->customlib->send_exp_remider($result->UserName, $message, $subject);
                    
                   $this->session->set_flashdata('verify_msg','Create account successfully.');
                    redirect('login');
                }
            }else{
                 $this->session->set_flashdata('already_verify_msg','Create account successfully.');
                    redirect('login');
            }
        }
       
    }
    
    public function chek_mail_signup(){
        $Email['name'] = 'First name';
        $Email['msg_title'] = 'Forgot password link';
                    $Email['temp_pass'] = sha1('satish.office2018@gmail.com');
                    $Email['temp_key'] = sha1('AppsInfotech@123');
                   // $message = $this->load->view('web/user/mail_msg/reset_password.php', $Email, true);
                    $subject = 'New Generate Password';
                   // $this->customlib->send_exp_remider($email, $message, $subject);
                       // $this->load->view('admin/mail_msg/cron_reminder_mail', $mail_data_ad);
//                        $message = $this->load->view('admin/mail_msg/active_deactive_ads_mail.php', $mail_data_ad, true);
//                        $this->customlib->send_exp_remider($key->UserName, $message, $subject);
               // $mail_data['msg'] = "Your new<span style='color:#5121ad;font-weight:bold!important;'> YellowVOD</span> Account has been created. Welcome to the<span style='color:#5121ad;font-weight:bold!important;'> YellowVOD!</span>
              //  <br><br> From now on, please login to your account using your email address<span style='color:#5121ad;font-weight:bold!important;'> ".$mail_data['email']."</span> To add more details in your profile.";

               // $mail_data['msg_title_af'] = "<span style='color:#000;font-weight:bold!important;'>Manage Your New Account:</span><br><br> With your new <span style='color:#5121ad;font-weight:bold!important;'> YellowVOD</span> Account. you can <br><br><ul><li>Manage your profile</li><li>Manage your advertisements</li></ul>";
                 $this->load->view('web/user/mail_msg/reset_password', $Email);
//                $message = $this->load->view('web/user/mail_msg/welcome_mail.php', $mail_data, true);
//                $this->customlib->send_exp_remider($mail_data['email'], $message, $subject);
    }
   

    //logout function
    public function logout() {
        //$this->session->sess_destroy();
        $this->session->unset_userdata('web_login');
        $this->session->unset_userdata('user_profile');
        $this->session->set_flashdata('danger_msg','Successfully Logout.');
       // redirect('login','refresh');
       redirect(site_url('login'));
    }

    //forgot password

    public function forgate_password() {
        $this->load->view('web/layout/header_web');
        $this->load->view('web/user/auth/forgot_view');
        $this->load->view('web/layout/footer_web');
    }
    
    //user enter mail then send mail
    public function submit_forgot(){
        $this->form_validation->set_rules('email','Email ID','required|trim|xss_clean|valid_email');
        if($this->form_validation->run()==FALSE){
            $this->forgate_password();
        }else{
            $email = $this->input->post('email');
            //before mail check then send msg
            $result = $this->user_model->get_user($email);
            if  ($result) {
                if ($result->RegisterType == 3) {
                    $Email['name'] = $result->FirstName;
                    $Email['msg_title'] = 'Reset password';
                    $Email['temp_pass'] = sha1($result->UserName);
                    $Email['temp_key'] = sha1('AppsInfotech@123');
                    $message = $this->load->view('web/user/mail_msg/reset_password.php', $Email, true);
                    $subject = 'New Generate Password';
                    $this->customlib->send_exp_remider($email, $message, $subject);

                    $this->session->set_flashdata('success_msg', 'Reset password link send.');
                    redirect(site_url('forgot'));
                } else if ($result->RegisterType == 2) {
                    $this->session->set_flashdata('danger_msg', 'Please login google');
                    redirect(site_url('forgot'));
                } else if ($result->RegisterType == 1) {
                    $this->session->set_flashdata('danger_msg', 'Please login facebook');
                    redirect(site_url('forgot'));
                }
            } else {
                $this->session->set_flashdata('danger_msg', 'Enter Valid Email.');
                redirect(site_url('forgot'));
            }
        }
    }

    public function reset_password($temp_pass) {
        //$valid = $this->auth_model->temp_pass_valid($temp_pass);
        if ($temp_pass) {
            $data['temp_email'] = $temp_pass;
            $this->load->view('web/layout/header_web');
            $this->load->view('web/user/auth/reset_password', $data);
            $this->load->view('web/layout/footer_web');
        } else {
           echo "<script>alert('The Key is Not Valid')</script>";
          
        }
    }

    public function update_password() {
        $temp_email = $this->input->post('key');
        $email = $this->input->post('email');
        $this->form_validation->set_rules('email', 'Email', 'required|xss_clean|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|min_length[8]|matches[password]');
        if ($this->form_validation->run() == FALSE) {
            $this->reset_password($temp_email);
        } else {
            $result = $this->user_model->get_user($email);
            $id = $result->ID;
            $email_key = sha1($result->UserName);
            $key = sha1('AppsInfotech@123');
            $db_key = $email_key.$key;
            if($db_key == $temp_email){
                $data = array(
                    'Pwd'=> md5($this->input->post('password')),
                  //  'ID'=>$id
                );
                //print_r($data); exit();
                $rl = $this->user_model->update_user($id, $data);
                if($rl){
                   $this->session->set_flashdata('success_msg','Password update successfully.');
                    redirect(site_url('login')); 
                }
            }else{
               // echo "<script>alert('The Key is Not Valid')</script>";
               $this->session->set_flashdata('danger_msg', 're-open link to email id.');
               redirect(site_url('reset_password/'.$temp_email));
            }
        }
    }

}
