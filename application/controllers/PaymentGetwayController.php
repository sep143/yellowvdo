<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class PaymentGetwayController extends UA_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->library('paypal_lib');
        $this->load->model('user/Myads_model','Myads');
        $this->load->model('admin/Advertisement_model','Advertisement');
        $this->load->model('user/Common_model','Common');
        $this->load->helper('custom');
        $this->load->model('Payment_model','Payment');
        $this->admin_mail = 'satish.office2018@gmail.com';
    }
    
    public function index($adid=0) {
        $id = $this->session->userdata['user_profile']['id'];
        $user_data = $this->Common->userData($id);
        if(!empty($user_data->AccountType == 1)){
            
            $data['ads'] = $this->Myads->get_ads_byID($id, $adid);
//            $this->load->view('web/payment/check_out',$data);
            $data['user_data'] = $this->Common->get_userData($id);
            $data['default_payment'] = $this->Payment->defaultSetUse(1); //1 = this table in ID = 1 pr fix value set rahegi 
            $data['navbar_title'] = 'Payment Getway';
            $this->load->view('web/layout/header_web', $data);
            $this->load->view('web/layout/sidebar_web');
            $this->load->view('web/payment/check_out',$data);
            $this->load->view('web/layout/footer_web');
        }else{
            $data = array(
                'StatusID'=>0,
            );
            $updateStatus = $this->Advertisement->updateAds($adid,$data);
            //advertiser send mail
                        $advertiser_email = $this->Payment->get_advertiser_withoutpay($adid);
                        $subject = "New ad create";
                        $mail_data_ad['msg_title'] = "New ad create";
                        $mail_data_ad['name'] = $advertiser_email->FirstName.' '.$advertiser_email->LastName;
                        $mail_data_ad['txt_id'] = ' - ';
                        $mail_data_ad['amount'] = ' 0.00 ';
                        $mail_data_ad['status'] = 'Free';
                        $mail_data_ad['b_name'] = $advertiser_email->BusinessName;
                        $mail_data_ad['b_title'] = $advertiser_email->CaptionLine;
                        $mail_data_ad['email'] = $advertiser_email->Email;//'dileeplohar@gmail.com';
                        $mail_data_ad['phone'] = $advertiser_email->CellNo;
                        $mail_data_ad['address'] = $advertiser_email->BusinessAddress;
                        $mail_data_ad['post_code'] = $advertiser_email->PostCode;
                        $mail_data_ad['msg'] = 'More information please open your account.';
                        $message = $this->load->view('web/user/mail_msg/create_ad_mail.php', $mail_data_ad, true);
                        $this->customlib->send_exp_remider($advertiser_email->UserName, $message, $subject);
                        //admin mail send
                        //$advertiser_email = $this->Payment->get_advertiser_mail($data['UserID']);
                        $subject = "New ad create";
                        $mail_data_ad['msg_title'] = "New ad create";
                        $mail_data_ad['name'] = $advertiser_email->FirstName.' '.$advertiser_email->LastName;
                        $mail_data_ad['txt_id'] = ' - ';
                        $mail_data_ad['amount'] = ' 0.00 ';
                        $mail_data_ad['status'] = 'Free';
                        $mail_data_ad['b_name'] = $advertiser_email->BusinessName;
                        $mail_data_ad['b_title'] = $advertiser_email->CaptionLine;
                        $mail_data_ad['email'] = $advertiser_email->Email;//'dileeplohar@gmail.com';
                        $mail_data_ad['phone'] = $advertiser_email->CellNo;
                        $mail_data_ad['address'] = $advertiser_email->BusinessAddress;
                        $mail_data_ad['post_code'] = $advertiser_email->PostCode;
                        $mail_data_ad['msg'] = 'More information please open your account.';
                        $message = $this->load->view('web/user/mail_msg/create_ad_mail.php', $mail_data_ad, true);
                        $this->customlib->send_exp_remider($this->admin_mail, $message, $subject);
            $this->session->set_flashdata('success_msg','Create New Ad successfully.');
            redirect('myads');
        }
    }
    
    public function buy($adid=0){
        //echo $id;
        //Set variables for paypal form
        $returnURL = base_url().'paypal/paypal/success'; //payment success url
        $cancelURL = base_url().'paypal/paypal/cancel'; //payment cancel url
        $notifyURL = base_url().'paypal/Paypal/ipn'; //ipn url
        $userID = $this->session->userdata['user_profile']['id']; //current user id
        //get particular product data
        $product = $this->Myads->get_ads_byID($userID, $adid);
        $defualt_payset = $this->Payment->defaultSetUse(1); //1 = this table in ID = 1 pr fix value set rahegi 
        $logo = base_url().'assets/logo.png';
        
        $this->paypal_lib->add_field('return', $returnURL);
        $this->paypal_lib->add_field('cancel_return', $cancelURL);
        $this->paypal_lib->add_field('notify_url', $notifyURL);
        $this->paypal_lib->add_field('item_name', $product->BusinessName);
        $this->paypal_lib->add_field('custom', $userID);
        $this->paypal_lib->add_field('item_number',  $product->ID);
        $this->paypal_lib->add_field('amount',  $defualt_payset->Amt);        
//        $this->paypal_lib->add_field('tax',  '1');
        $this->paypal_lib->add_field('tax_rate',  $defualt_payset->Tax);
//        $this->paypal_lib->add_field('on0',  '100');
//        $this->paypal_lib->add_field('on1',  '10');
        $this->paypal_lib->image($logo);
        
        // Render paypal form
        $this->paypal_lib->paypal_auto_form();
    }
}