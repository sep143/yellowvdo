<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('custom');
        $this->load->library('customlib');
        $this->session->unset_userdata('cat_select');
        $this->load->model('web/Homepage_model','Home');
        $this->load->model('user/Common_model','Common');
        if(!empty($this->session->userdata['user_profile']['id'])){
            $id = $this->session->userdata['user_profile']['id'];
            $data['user_data'] = $this->Common->get_userData($id);
        }
    }

    //webApp index page  
    public function index() {
        $this->session->unset_userdata('web');
        $this->session->unset_userdata('category_ses');
        $this->session->unset_userdata('default_location');
        if(!empty($this->session->userdata['user_profile']['id'])){
            $id = $this->session->userdata['user_profile']['id'];
            $data['user_data'] = $this->Common->get_userData($id);
        }
                
        $data['category'] = $this->Home->get_category();
        $this->load->view('web/layout/header_web', $data);
        $this->load->view('web/home_web');
        $this->load->view('web/layout/footer_web');
        
    }
    
 //webApp Contact Us page
 public function contact(){
        $this->session->unset_userdata('web');
        $this->session->unset_userdata('category_ses');
        
        if(!empty($this->session->userdata['user_profile']['id'])){
            $id = $this->session->userdata['user_profile']['id'];
            $data['user_data'] = $this->Common->get_userData($id);
        }
        $data['category'] = $this->Home->get_category();
        $this->load->view('web/layout/header_web', $data);
        $this->load->view('web/contact_web');
        $this->load->view('web/layout/footer_web');
        
 }
 
 //privacy policy
 public function privacy_policy(){
     $this->session->unset_userdata('web');
        $this->session->unset_userdata('category_ses');
        
        if(!empty($this->session->userdata['user_profile']['id'])){
            $id = $this->session->userdata['user_profile']['id'];
            $data['user_data'] = $this->Common->get_userData($id);
        }
        $data['category'] = $this->Home->get_category();
        $this->load->view('web/layout/header_web', $data);
        $this->load->view('web/privacy_policy');
        $this->load->view('web/layout/footer_web');
 }


 //contact us to send mail admin
 public function contact_mail() {
     $name = $this->input->post('name');
     $email = $this->input->post('email');
     $mobile = $this->input->post('mobile');
     $subject = $this->input->post('subject');
     $msg = $this->input->post('message');
     $data = array(
         'name'=>$name,
         'email'=>$email,
         'mobile'=>$mobile,
         'subject'=>$subject,
         'msg'=>$msg
     );
    // print_r($data); exit();
     $subject = $subject;
     //$email_data['email'] = 'satish.office2018@gmail.com'; //admin mail to send then mail mail id insert
     $email_data['msg_title'] = 'Enquiry Contact';
     $email_data['name'] = $name;
     $email_data['phone'] = $mobile;
     $email_data['email'] = $email;
     $email_data['subject'] = $subject;
     $email_data['msg'] = $msg;
//     $this->load->view('web/user/mail_msg/contact_us.php', $email_data);
    $message = $this->load->view('web/user/mail_msg/contact_us.php', $email_data, true);
    $this->customlib->send_exp_remider('satish.office2018@gmail.com', $message, $subject);
    $this->email->print_debugger();
    $this->session->set_flashdata('success_msg','Thanks for connecting with us.');
    redirect('contact');
//    if ($this->email->send()) {
//        $data['status'] = 200;
//        $data['msg'] = "Remider mail Sent Successfully";
//        echo json_encode($data);
//    } else {
//        $data['status'] = 401;
//        $data['msg'] = "Something went wrong";
//        echo json_encode($data);
//    }
 }

    //geolocation 
    public function getLocation() {
        //$this->load->library('GMap');
       echo $lat = $this->input->post('lat').'<br>';
       echo $long = $this->input->post('long');

//        if (!empty($lat) && !empty($long)) {
//            //send request and receive json data by latitude and longitude
//            $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng=' . trim($lat) . ',' . trim($long) . '&sensor=false';
//            $json = @file_get_contents($url);
//            $data = json_decode($json);
//            $status = $data->status;
//
//            //if request status is successful
//            if ($status == "OK") {
//                //get address from json data
//                $location = $data->results[0]->formatted_address;
//            } else {
//                $location = '';
//            }
//
//            //return address to ajax 
//            echo $location;
//        }
    }
    
    //mobile view in category use mobile app
    public function mobile_view($id=0) {
        if($id == 2){
            //iphone
        $this->load->view('web/mobile_category_view');
        }else if($id == 1){
            //anroide
        $this->load->view('web/mobile_category_view_1');
        }
        
    }
    
    public function check_location(){
       // $this->load->view('web/home_web_1');
//        echo $this->session->userdata['cat_select']['select_cat'];
       
       if(!empty($this->session->userdata['default_location']['location'])){
           echo $location = $this->session->userdata['default_location']['location'].'<br>';
           echo $location = $this->session->userdata['default_location']['lat'].'<br>';
           echo $location = $this->session->userdata['default_location']['long'].'<br>';
       }else{
           echo $location = 'null';
       }
//        echo json_encode($location, true);
    }
    
    public function unset_loc() {
        $this->session->unset_userdata('default_location');
    }
    
    //web page open then set location
    public function set_location() {
        $location = $this->input->post('location');
        $lat = $this->input->post('lat');
        $long = $this->input->post('long');
        $data = array(
            'location'=>$location,
            'lat'=>$lat,
            'long'=>$long
        );
        $this->session->set_userdata('default_location', $data);
    }
      
}
