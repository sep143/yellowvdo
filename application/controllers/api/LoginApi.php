<?php
ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//include Rest Controller library
require APPPATH . '/libraries/REST_Controller.php';

class LoginApi extends REST_Controller {

    public function __construct($config = 'rest') {
        header('Access-Control-Allow-Origin: *');
        //header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        parent::__construct();
        //load user model
        $this->load->model('api/LoginApi_model', 'Login');
        $this->load->library('customlib');
        //image limit send login time
        $image_id = 1;
        $sql = "select Config from setting_image where ID=$image_id";
        $data = $this->db->query($sql,$image_id);
        $use = $data->row();
        $this->image_limit = $use->Config;
        $this->admin_mail = 'satish.office2018@gmail.com';
    }
 
    public function signup_post(){
        $email = $this->post('email');
        $password = $this->post('password');
        $mobile = $this->post('mobile');
        $fname = $this->post('fname');
        $lname = $this->post('lname');
        $check_email = $this->Login->check_emailMobile($email);
            if(!$check_email){

             $lat = null;
                if($this->post('lat') && $this->post('lng')){
                    $lat = $this->post('lat').','.$this->post('lng');
                }
                $key = 'AppsInfotech@123';
                $email_verify_link = sha1($email.md5($password).$key.date('Y-m-d'));
                $data = array(
                    'FirstName'=> $fname,
                    'LastName'=> $lname,
                    'Phone'=> $mobile,
                    'UserName'=>  $email,
                    'Pwd'=> md5($password),
                    'Address'=> $this->post('full_address'),
                    'City'=> $this->post('city'),
                    'State'=> $this->post('state'),
                    'Country'=>  $this->post('country'),
                    'PostCode'=> $this->post('postCode'),
                    'LatLong'=> $lat,
                    'RegisterType'=> 3,
                    'EmailVerify'=> $email_verify_link
                );
              //  print_r($data); exit();
                //$result = $this->Login->register_first_time($data);
                // Welcome mail sent to user start
                $subject = "Welcome to YellowVOD";
                $mail_data['name'] = $data['FirstName']." ". $data['LastName'];
                $mail_data['email'] = $data['UserName'];
                $mail_data['phone'] = $data['Phone'];
                $mail_data['msg_title'] = "Welcome to YellowVOD";
                $mail_data['verify_link'] = $email_verify_link;
                $mail_data['msg'] = "Your new<span style='color:#5121ad;font-weight:bold!important;'> YellowVOD</span> Account has been created. Welcome to the<span style='color:#5121ad;font-weight:bold!important;'> YellowVOD!</span>
                <br><br> From now on, please login to your account using your email address<span style='color:#5121ad;font-weight:bold!important;'> ".$mail_data['email']."</span> To add more details in your profile.";

                $mail_data['msg_title_af'] = "<span style='color:#000;font-weight:bold!important;'>Manage Your New Account:</span><br><br> With your new <span style='color:#5121ad;font-weight:bold!important;'> YellowVOD</span> Account. you can <br><br><ul><li>Manage your profile</li><li>Manage your advertisements</ul>";
                $message = $this->load->view('web/user/mail_msg/welcome_mail.php', $mail_data, true);
                $this->customlib->send_exp_remider($mail_data['email'], $message, $subject);
            
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
                $register_id = $this->Login->register_first_time($data);

            if($register_id){
            $this->response([
                'status'=>true,
                'message'=>"Welcome to Yellow VDO. Signup successfully! \n Email address verification needed. Before you can login, check your email to activate your user account. if you dont't receive  an email within a few seconds, please check your spam folder.",
                              ],200);
            }
            else{
                $this->response([
                'status'=>false,
                'message'=>'Registration error . please try again later',
                              ],200);
            }
        }else{
             $this->response([
                'status'=>false,
                'message'=>'Email already exist',
                              ],200);
        }
       
    }
    
    public function login_post(){
        $email = $this->post('email');
        $password = $this->post('password');
        $type = $this->post('type');
        //type check 1=FB, 2=Google, 3=Only login via Email and password
      if($type == 1){
          $email_id = $this->post('email');
          $fname = $this->post('fname');
          $lname = $this->post('lname');
          $token = $this->post('token');
          $profile = $this->post('profile');
          //$countryID = $this->post('country_id');
          $check_email = $this->Login->check_email($email_id);
          if(!empty($check_email)){
              //alredy register hone pr advertiser data get kaega
                    $result = $this->Login->get_advertiser($check_email->ID);
                        if($result){
                            //fb function start by after registration
                            $hint=array(
                          'register_type'=>'1=FB, 2=Google, 3=Admin',
                          'account_type'=>'0=Free account, 1=Paid Account using to Ads',
                          'status_id'=>'0=Inactive, 1= Active'
                      );
                      //account inactive
                      if($result->StatusID==0){
                          $this->response([
                              'status'=>false,
                              'message'=>'Your Account Inactive... Please Contact Admin.',
                          ],200);
                      }//account active
                      else if($result->StatusID==1){
                      	 if($result->Profile!=null && strpos($result->Profile, 'http') === false)
       				$result->Profile = base_url().'uploads/profile/'.$result->Profile;
                          $this->response([
                              'status'=>true,
                              'message'=>'User Login Successfully.',
                              'id'=> $result->ID,
                              'email_id'=> $result->UserName,
                              'fname'=> $result->FirstName,
                              'lname'=> $result->LastName,
                              'address'=> $result->Address,
                              'city'=> $result->City,
                              'country'=> $result->Country,
                              'post_code'=> $result->PostCode,
                              'phone_code'=> $result->CountryCode,
                              'phone_no'=> $result->Phone,
                              'register_type'=>$result->RegisterType,
                              'profile'=>$result->Profile,
                              'account_type'=>$result->AccountType,
                              'status_id'=>$result->StatusID,
                              'join_date'=>$result->CreatedDT,
                              'image_limit'=>  $this->image_limit,
                              'Hint'=> $hint
                          ],200);
                      }else if($result->StatusID==3){
                          $this->response([
                              'status'=>false,
                              'message'=>'Your Account is Deleted... Please Contact Admin.',
                          ],200);
                      }
                      //fb function start by after registration
                  }
          }else{
              //database me email nahi h or insert karwani he
              $data = array(
                  'UserName'=>$email_id,
                  'FirstName'=>$fname,
                  'LastName'=>$lname,
                  'RegisterType'=>1,
                  'Token'=>$token,
                  'Profile'=>$profile,
                 // 'CountryID'=>$countryID,
                  'StatusID'=>1,
              );
              $register_id = $this->Login->register_first_time($data);
              if($register_id){
                  //after register then get advertiser data via ID
                        $result = $this->Login->get_advertiser($register_id);
                        if($result){
                            //fb function start by after registration
                            $hint=array(
                          'register_type'=>'1=FB, 2=Google, 3=Admin',
                          'account_type'=>'0=Free account, 1=Paid Account using to Ads',
                          'status_id'=>'0=Inactive, 1= Active'
                      );
                      //account inactive
                      if($result->StatusID==0){
                          $this->response([
                              'status'=>false,
                              'message'=>'Your Account Inactive... Please Contact Admin.',
                          ],200);
                      }//account active
                      else if($result->StatusID==1){
                            if($result->Profile!=null && strpos($result->Profile, 'http') === false)
       				$result->Profile = base_url().'uploads/profile/'.$result->Profile;
                          $this->response([
                              'status'=>true,
                              'message'=>'User Login Successfully.',
                              'id'=> $result->ID,
                              'email_id'=> $result->UserName,
                              'fname'=> $result->FirstName,
                              'lname'=> $result->LastName,
                              'address'=> $result->Address,
                              'city'=> $result->City,
                              'country'=> $result->Country,
                              'post_code'=> $result->PostCode,
                              'phone_code'=> $result->CountryCode,
                              'phone_no'=> $result->Phone,
                              'register_type'=>$result->RegisterType,
                              'profile'=>$result->Profile,
                              'account_type'=>$result->AccountType,
                              'status_id'=>$result->StatusID,
                              'join_date'=>$result->CreatedDT,
                              'image_limit'=>$this->image_limit,
                              'Hint'=> $hint
                          ],200);
                      }else if($result->StatusID==3){
                          $this->response([
                              'status'=>false,
                              'message'=>'Your Account is Deleted... Please Contact Admin.',
                          ],200);
                      }
                      //fb function start by after registration
                  }
              }
          }
         //fb function end 
          
      }else if($type == 2){
         //google function start   
          $email_id = $this->post('email');
          $fname = $this->post('fname');
          $lname = $this->post('lname');
          $token = $this->post('token');
          $profile = $this->post('profile');
         // $countryID = $this->post('country_id');
          $check_email = $this->Login->check_email($email_id);
          if(!empty($check_email)){
              //alredy register hone pr advertiser data get kaega
                    $result = $this->Login->get_advertiser($check_email->ID);
                        if($result){
                            //google function start by after registration
                            $hint=array(
                          'register_type'=>'1=FB, 2=Google, 3=Admin',
                          'account_type'=>'0=Free account, 1=Paid Account using to Ads',
                          'status_id'=>'0=Inactive, 1= Active'
                      );
                      //account inactive
                      if($result->StatusID==0){
                          $this->response([
                              'status'=>false,
                              'message'=>'Your Account Inactive... Please Contact Admin.',
                          ],200);
                      }//account active
                      else if($result->StatusID==1){
                            if($result->Profile!=null && strpos($result->Profile, 'http') === false)
       				$result->Profile = base_url().'uploads/profile/'.$result->Profile;
       			
                          $this->response([
                              'status'=>true,
                              'message'=>'User Login Successfully.',
                              'id'=> $result->ID,
                              'email_id'=> $result->UserName,
                              'fname'=> $result->FirstName,
                              'lname'=> $result->LastName,
                              'address'=> $result->Address,
                              'city'=> $result->City,
                              'country'=> $result->Country,
                              'post_code'=> $result->PostCode,
                              'phone_code'=> $result->CountryCode,
                              'phone_no'=> $result->Phone,
                              'register_type'=>$result->RegisterType,
                              'profile'=>$result->Profile,
                              'account_type'=>$result->AccountType,
                              'status_id'=>$result->StatusID,
                              'join_date'=>$result->CreatedDT,
                              'image_limit'=>$this->image_limit,
                              'Hint'=> $hint
                          ],200);
                      }else if($result->StatusID==3){
                          $this->response([
                              'status'=>false,
                              'message'=>'Your Account is Deleted... Please Contact Admin.',
                          ],200);
                      }
                      //google function start by after registration
                  }
          }else{
              //database me email nahi h or insert karwani he
              $data = array(
                  'UserName'=>$email_id,
                  'FirstName'=>$fname,
                  'LastName'=>$lname,
                  'RegisterType'=>2,
                  'Token'=>$token,
                  'Profile'=>$profile,
                 // 'CountryID'=>$countryID,
                  'StatusID'=>1,
              );
              $register_id = $this->Login->register_first_time($data);
              if($register_id){
                  //after register then get advertiser data via ID
                        $result = $this->Login->get_advertiser($register_id);
                        if($result){
                            //google function start by after registration
                            $hint=array(
                          'register_type'=>'1=FB, 2=Google, 3=Admin',
                          'account_type'=>'0=Free account, 1=Paid Account using to Ads',
                          'status_id'=>'0=Inactive, 1= Active'
                      );
                      //account inactive
                      if($result->StatusID==0){
                          $this->response([
                              'status'=>false,
                              'message'=>'Your Account Inactive... Please Contact Admin.',
                          ],200);
                      }//account active
                      else if($result->StatusID==1){
//                      	if($result->Profile!=null && strpos($result->Profile, 'http')==false)
//       				$result->Profile = base_url().'uploads/profile/'.$result->Profile;
                          $this->response([
                              'status'=>true,
                              'message'=>'User Login Successfully.',
                              'id'=> $result->ID,
                              'email_id'=> $result->UserName,
                              'fname'=> $result->FirstName,
                              'lname'=> $result->LastName,
                              'address'=> $result->Address,
                              'city'=> $result->City,
                              'country'=> $result->Country,
                              'post_code'=> $result->PostCode,
                              'phone_code'=> $result->CountryCode,
                              'phone_no'=> $result->Phone,
                              'register_type'=>$result->RegisterType,
                              'profile'=>$result->Profile,
                              'account_type'=>$result->AccountType,
                              'status_id'=>$result->StatusID,
                              'join_date'=>$result->CreatedDT,
                              'image_limit'=>$this->image_limit,
                              'Hint'=> $hint
                          ],200);
                      }else if($result->StatusID==3){
                          $this->response([
                              'status'=>false,
                              'message'=>'Your Account is Deleted... Please Contact Admin.',
                          ],200);
                      }
                      //google function start by after registration
                  }
              }
          }
         //google function end 
          
          
      }else if($type == 3){
          if(!empty($email) && !empty($password)){
            $result = $this->Login->login_check($email, $password);
            if($result){
                if($result->EmailVerify == 1){
                $hint=array(
                    'register_type'=>'1=FB, 2=Google, 3=Admin',
                    'account_type'=>'0=Free account, 1=Paid Account using to Ads',
                    'status_id'=>'0=Inactive, 1= Active'
                );
                    //account inactive
                    if($result->StatusID==0){
                        $this->response([
                            'status'=>false,
                            'message'=>'Your Account Inactive... Please Contact Admin.',
                        ],200);
                    }//account active
                    else if($result->StatusID==1){
                            if($result->Profile!=null && strpos($result->Profile, 'http') === false)
                                    $result->Profile = base_url().'uploads/profile/'.$result->Profile;
                        $this->response([
                            'status'=>true,
                            'message'=>'User Login Successfully.',
                            'id'=> $result->ID,
                            'email_id'=> $result->UserName,
                            'fname'=> $result->FirstName,
                            'lname'=> $result->LastName,
                            'address'=> $result->Address,
                            'city'=> $result->City,
                            'country'=> $result->Country,
                            'post_code'=> $result->PostCode,
                            'phone_code'=> $result->CountryCode,
                            'phone_no'=> $result->Phone,
                            'register_type'=>$result->RegisterType,
                            'profile'=> $result->Profile,
                            'account_type'=>$result->AccountType,
                            'status_id'=>$result->StatusID,
                            'join_date'=>$result->CreatedDT,
                            'image_limit'=>$this->image_limit,
                            'Hint'=> $hint
                        ],200);
                    }else if($result->StatusID==3){
                        $this->response([
                            'status'=>false,
                            'message'=>'Your Account is Deleted... Please Contact Admin.',
                            'verified'=>1
                        ],200);
                    }
                
                }//email verify check condition
                else{
                    $this->response([
                        'status'=>FALSE,
                        'message'=>'Email not verified. Please verify your email to login',
                        'verified'=>0
                    ],200);
                }
            }else{
                $this->response([
                'status'=>FALSE,
                'message'=>'Invalid Email ID and Password',
                'verified'=>1
            ],200);
            }
        }else{
            $this->response([
                'status'=>FALSE,
                'message'=>'Please Enter Email ID and Password',
                'verified'=>1
            ],200);
        }
      }else{
          $this->response([
                'status'=>FALSE,
                'message'=>'Please Send Type',
                'verified'=>1
            ],200);
      }
        
    }
    
   
     //resend verify link send mail
    public function resendEmail_post() {
        $email = $this->post('email');
       // echo $email;
        $data = $this->Login->check_email_senddata($email);
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
                $this->response([
                    'status'=>true,
                    'message'=>'Verification mail sent. Sign into your email and verify your account.',
                ],200);
            }else{
                $this->response([
                    'status'=>false,
                    'message'=>'try again !!!',
                ],200);
            }
    }
    
    //forgate api 
    //user enter mail then send mail
    public function forgot_post(){
        $email = $this->post('email');
            //before mail check then send msg
            $result = $this->Login->get_user($email);
            if  ($result) {
                if ($result->RegisterType == 3) {
                    $Email['name'] = $result->FirstName;
                    $Email['msg_title'] = 'Reset password';
                    $Email['temp_pass'] = sha1($result->UserName);
                    $Email['temp_key'] = sha1('AppsInfotech@123');
                    $message = $this->load->view('web/user/mail_msg/reset_password.php', $Email, true);
                    $subject = 'Forgot password';
                    $this->customlib->send_exp_remider($email, $message, $subject);
                    $this->response([
                        'status' => true,
                        'message' => 'Password reset link has been Sent to your mail.',
                            ], 200);
                } else if ($result->RegisterType == 2) {
                    //$this->session->set_flashdata('danger_msg', 'Please Login Google');
                    $this->response([
                        'status' => true,
                        'message' => 'Please login using google'
                            ], 200);
                } else if ($result->RegisterType == 1) {
//                    $this->session->set_flashdata('danger_msg', 'Please login facebook');
                     $this->response([
                        'status' => true,
                        'message' => 'Please login facebook'
                            ], 200);
                }
            } else {
                 $this->response([
                        'status' => FALSE,
                        'message' => 'Enter Registered Email.'
                            ], 200);
            }
      
    }

    

}
