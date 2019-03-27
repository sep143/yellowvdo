<?php
ob_start();
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

//include Rest Controller library
require APPPATH . '/libraries/REST_Controller.php';

class PaymentApi extends REST_Controller {

	public function __construct($config = 'rest') {
		header('Access-Control-Allow-Origin: *');
		//header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		parent::__construct();
		//load user model
		$this->load->model('api/PaymentApi_model', 'Payment');
                //other model use in api please dont't change in model
                $this->load->model('user/Myads_model','Myads');
                $this->load->library('paypal_lib');
                $this->load->library('customlib');
                $this->load->model('admin/Advertisement_model','Advertisement');
                $this->load->model('user/Common_model','Common');
                $this->load->model('Payment_model','Payment2');
                $this->admin_mail = 'satish.office2018@gmail.com';
                //end model
	}
	
	public function refundAll_get(){
            $refund = $this->Payment->get_refundAll($this->get('id'),$this->get('limit'),$this->get('offset'));
            $this->response([
                    'status'=>true,
                    'refund'=> $refund
                ],200);
	}
        
        public function refundrequest_post() {
            $data['UserID'] = $this->post('userid');
            $data['PayID'] = $this->post('payid');
            $data['TxtID'] = $this->post('txtid');
            $data['Amt'] = $this->post('amt');
            $data['UserMsg'] = $this->post('msg');
            $update_data = array(
                'StatusID'=>2
            );
            $this->Payment->send_refund_request_update_payment_table($data['PayID'],$update_data);
            $result = $this->Payment->send_refund_request($data);
             $this->response([
                            'status'=>true,
                            'message'=> 'Refund requested successfully sent',
                            
                    ],200);
        }
        
	public function transactionAll_get(){
            $payment = $this->Payment->get_transactionAll($this->get('id'),$this->get('limit'),$this->get('offset'));
            $final_data = array();
            foreach ($payment as $key):
                $expiryDT = date('Y-m-d', strtotime($key->CreatedDT.' + 30 days'));
                $current_dt = (new DateTime())->format('Y-m-d');
                if($current_dt <= $expiryDT){
                    $expiredStatus = 1;
                }else{
                    $expiredStatus = 0;
                }
                $data1 = array(
                    'ID'=>$key->ID,
                    'UserID'=>$key->UserID,
                    "AdsID"=> $key->AdsID,
                    "TxtID"=> $key->TxtID,
                    "Amt"=> $key->TotalAmt,
                    "Email"=> $key->Email,
                    "Phone"=> $key->Phone,
                    "Currency"=> $key->Currency,
                    "StatusID"=> $key->StatusID,
                    "CreatedBy"=> $key->CreatedBy,
                    "CreatedDT"=> $key->CreatedDT,
                    "LastModifiedBy"=> $key->LastModifiedBy,
                    "LastModifiedDT"=> $key->LastModifiedDT,
                    "DeletedBy"=> $key->DeletedBy,
                    "DeletedDT"=> $key->DeletedDT,
                    "CaptionLine"=> $key->CaptionLine,
                    'Expired'=>$expiredStatus
                );
            $final_data[] = $data1;
            endforeach;
            $this->response([
                    'status'=>true,
                    'payment'=> $final_data,
                    'Hint-status'=>'0=Refund Request available, 1=Refund Pay , 2= Refund Req., 3=Delete row'
                ],200);
	}
        //ads create and advertiser type = 0 it means free ads create
        public function freeNow_get($userID,$adid) {
            $advertiser_email = $this->Payment2->get_advertiser_withoutpay($adid);
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
                $this->response([
                    'status'=>true,
                    'message'=> 'Successfully ad create done.',
                    //'transition'=> $data
                ],200);
        }
        
        
        //paypal payment getway
        public function payNow_get($userID,$adid) {
//           echo $userID;
//            Set variables for paypal form
            $returnURL = base_url().'api/PaymentApi/success'; //payment success url
            $cancelURL = base_url().'api/PaymentApi/cancel'; //payment cancel url
            $notifyURL = base_url().'paypal/paypal/ipn'; //ipn url
//            $notifyURL = base_url().'api/PaymentApi/ipn'; //ipn url
            //$userID = $this->session->userdata['user_profile']['id'];; //current user id
            //get particular product data
            $product = $this->Myads->get_ads_byID($userID, $adid);
            $defualt_payset = $this->Payment2->defaultSetUse(1); //1 = this table in ID = 1 pr fix value set rahegi 
//            echo $product->BusinessName;
            $logo = base_url().'assets/logo.png';

            $this->paypal_lib->add_field('return', $returnURL);
            $this->paypal_lib->add_field('cancel_return', $cancelURL);
            $this->paypal_lib->add_field('notify_url', $notifyURL);
            $this->paypal_lib->add_field('item_name', "$product->BusinessName");
            $this->paypal_lib->add_field('custom', $userID);
            $this->paypal_lib->add_field('item_number',  $product->ID);
            $this->paypal_lib->add_field('amount',  $defualt_payset->Amt);        
//        $this->paypal_lib->add_field('tax',  '1');
            $this->paypal_lib->add_field('tax_rate',  $defualt_payset->Tax);        
            $this->paypal_lib->image($logo);

            // Render paypal form
            $this->paypal_lib->paypal_auto_form();
        }
        //paypal payment getway then cancel transition
        public function cancel_get() {
            $this->response([
                    'status'=>false,
                    'message'=> 'Sorry !!! Your transition failed. Please try again...'
            ],200);
        }
        
        public function success_get(){
            $paypalInfo = $this->input->get();
            $data['item_name']      = $paypalInfo['item_name'];
            $data['item_number'] = $paypalInfo['item_number']; 
            $data['txn_id'] = $paypalInfo["tx"];
            $data['payment_amt'] = $paypalInfo["amt"];
            $data['currency_code'] = $paypalInfo["cc"];
            $data['status'] = $paypalInfo["st"];
            
            //data and send mail 
            $defualt_payset = $this->Payment2->defaultSetUse(1); //1 = this table in ID = 1 pr fix value set rahegi 
           //pass the transaction data to view
            $data1['UserID'] = $paypalInfo["cm"];
            $data1['AdsID'] = $paypalInfo["item_number"];
            $data1['TxtID'] = $paypalInfo["tx"];
            $data1['TotalAmt']  = $paypalInfo["amt"];
            $data1['Currency']  = $paypalInfo["cc"];
            $data1['Tax'] = $defualt_payset->Tax;
            $data1['Amt'] = $defualt_payset->Amt;
//            $data1['Email'] = $paypalInfo["payer_email"];
            $data1['Phone'] = $paypalInfo["st"];
            $payment_table = $this->Common->insertTransaction_check($data1['TxtID']);
            $payment_id = 0;
            if(!empty($payment_table)){
                $payment_id = $this->Common->insertTransaction($data1);
            }
           if(!empty($payment_id) && $data1['Phone'] == 'Completed'){
               $email_to_download_invoice = sha1($data1['TxtID'].$data1['Amt'].'AppspunditInfotech123');
                $update_data = array(
                    'Encrypt'=>$email_to_download_invoice,
                );
                $this->Common->insertTransaction_update($payment_id,$update_data);
                //set expiry date
                    $ads_data = $this->Advertisement->get_ads_byID($data1['AdsID']);

                    if(!empty($ads_data->ExpiryDT)){
                        $ex_dt = $ads_data->ExpiryDT;
                        $current_dt = (new DateTime())->format('Y-m-d');
                        if($current_dt <= $ex_dt){
                            $set_dt = $ex_dt;
                        }else{
                            $set_dt = $current_dt;
                        }
                        $expiry_dt = date('Y-m-d', strtotime($set_dt.' + 365 days'));
                    }else{
                        $expiry_dt = date('Y-m-d', strtotime('+ 365 days'));
                    }
                    $data2 = array(
                        'StatusID'=>0,
                        'PayStatus'=>1,
                        'ExpiryDT'=> $expiry_dt,
                    );
                    $updateStatus = $this->Advertisement->updateAds($data1['AdsID'],$data2);
                    
                    //mail sent
                    //advertiser send mail
                        $advertiser_email = $this->Payment2->get_advertiser_mail($data1['UserID']);
                        $subject = "Yellow Vdo";
                        $mail_data_ad['msg_title'] = "New ad create";
                        $mail_data_ad['name'] = $advertiser_email->FirstName.' '.$advertiser_email->LastName;
                        $mail_data_ad['txt_id'] = $advertiser_email->TxtID;
                        $mail_data_ad['amount'] = $advertiser_email->Amt;
                        $mail_data_ad['status'] = 'Successfully';
                        $mail_data_ad['b_name'] = $advertiser_email->BusinessName;
                        $mail_data_ad['b_title'] = $advertiser_email->CaptionLine;
                        $mail_data_ad['email'] = $advertiser_email->Email;//'dileeplohar@gmail.com';
                        $mail_data_ad['phone'] = $advertiser_email->CellNo;
                        $mail_data_ad['address'] = $advertiser_email->BusinessAddress;
                        $mail_data_ad['post_code'] = $advertiser_email->PostCode;
                        $mail_data_ad['download_invoice'] = $advertiser_email->Encrypt;
                        $mail_data_ad['msg'] = 'More information please open your account.';
                        $message = $this->load->view('web/user/mail_msg/create_ad_mail.php', $mail_data_ad, true);
                        $this->customlib->send_exp_remider($advertiser_email->UserName, $message, $subject);
                        //admin mail send
                        $advertiser_email = $this->Payment2->get_advertiser_mail($data1['UserID']);
                        $subject = "New ad create";
                        $mail_data_ad['msg_title'] = "New ad create";
                        $mail_data_ad['name'] = $advertiser_email->FirstName.' '.$advertiser_email->LastName;
                        $mail_data_ad['txt_id'] = $advertiser_email->TxtID;
                        $mail_data_ad['amount'] = $advertiser_email->Amt;
                        $mail_data_ad['status'] = 'Successfully';
                        $mail_data_ad['b_name'] = $advertiser_email->BusinessName;
                        $mail_data_ad['b_title'] = $advertiser_email->CaptionLine;
                        $mail_data_ad['email'] = $advertiser_email->Email;//'dileeplohar@gmail.com';
                        $mail_data_ad['phone'] = $advertiser_email->CellNo;
                        $mail_data_ad['address'] = $advertiser_email->BusinessAddress;
                        $mail_data_ad['post_code'] = $advertiser_email->PostCode;
                        $mail_data_ad['download_invoice'] = $advertiser_email->Encrypt;
                        $mail_data_ad['msg'] = 'More information please open your account.';
                        $message = $this->load->view('web/user/mail_msg/create_ad_mail.php', $mail_data_ad, true);
                        $this->customlib->send_exp_remider($this->admin_mail, $message, $subject);
           }
            
            $this->response([
                    'status'=>true,
                    'message'=> 'Successfully transaction done.',
                    'transition'=> $data
            ],200);
        }
        
//        public function ipn(){
//                // Paypal posts the transaction data
//            $paypalInfo = $this->input->post();
//
//            if(!empty($paypalInfo)){
//                // Validate and get the ipn response
//                $ipnCheck = $this->paypal_lib->validate_ipn($paypalInfo);
//
//                // Check whether the transaction is valid
//                    if($ipnCheck){
//                        // Insert the transaction data in the database
//                        $data['UserID']        = $paypalInfo["custom"];
//                        $data['AdsID']        = $paypalInfo["item_number"];
//                        $data['TxtID']            = $paypalInfo["txn_id"];
//                        $data['Amt']    = $paypalInfo["mc_gross"];
//                        $data['Currency']    = $paypalInfo["mc_currency"];
//                        $data['Email']    = $paypalInfo["payer_email"];
//                        $data['Phone'] = $paypalInfo["payment_status"];
//                        $this->Common->insertTransaction($data);
//                        //after payment then update row in stattsu id =0 then view pending
//                        if($data['Phone'] == 'Completed'){
//                            //set expiry date
//                                $ads_data = $this->Advertisement->get_ads_byID($data['AdsID']);
//
//                                if(!empty($ads_data->ExpiryDT)){
//                                    $ex_dt = $ads_data->ExpiryDT;
//                                    $current_dt = (new DateTime())->format('Y-m-d');
//                                    if($current_dt <= $ex_dt){
//                                        $set_dt = $ex_dt;
//                                    }else{
//                                        $set_dt = $current_dt;
//                                    }
//                                    $expiry_dt = date('Y-m-d', strtotime($set_dt.' + 365 days'));
//                                }else{
//                                    $expiry_dt = date('Y-m-d', strtotime('+ 365 days'));
//                                }
//                                $data2 = array(
//                                    'StatusID'=>0,
//                                    'PayStatus'=>1,
//                                    'ExpiryDT'=> $expiry_dt,
//                                );
//                                $updateStatus = $this->Advertisement->updateAds($data['AdsID'],$data2);
//
//                                //advertiser send mail
//                                $advertiser_email = $this->Payment->get_advertiser_mail($data['UserID']);
//                                $subject = "New ad create";
//                                $mail_data_ad['msg_title'] = "New ad create";
//                                $mail_data_ad['name'] = $advertiser_email->FirstName.' '.$advertiser_email->LastName;
//                                $mail_data_ad['txt_id'] = $advertiser_email->TxtID;
//                                $mail_data_ad['amount'] = $advertiser_email->Amt;
//                                $mail_data_ad['status'] = 'Successfully';
//                                $mail_data_ad['b_name'] = $advertiser_email->BusinessName;
//                                $mail_data_ad['b_title'] = $advertiser_email->CaptionLine;
//                                $mail_data_ad['email'] = $advertiser_email->Email;//'dileeplohar@gmail.com';
//                                $mail_data_ad['phone'] = $advertiser_email->CellNo;
//                                $mail_data_ad['address'] = $advertiser_email->BusinessAddress;
//                                $mail_data_ad['post_code'] = $advertiser_email->PostCode;
//                                $mail_data_ad['msg'] = 'More information please open your account.';
//                                $message = $this->load->view('web/user/mail_msg/create_ad_mail.php', $mail_data_ad, true);
//                                $this->customlib->send_exp_remider($advertiser_email->UserName, $message, $subject);
//                                //admin mail send
//                                $advertiser_email = $this->Payment->get_advertiser_mail($data['UserID']);
//                                $subject = "New ad create";
//                                $mail_data_ad['msg_title'] = "New ad create";
//                                $mail_data_ad['name'] = $advertiser_email->FirstName.' '.$advertiser_email->LastName;
//                                $mail_data_ad['txt_id'] = $advertiser_email->TxtID;
//                                $mail_data_ad['amount'] = $advertiser_email->Amt;
//                                $mail_data_ad['status'] = 'Successfully';
//                                $mail_data_ad['b_name'] = $advertiser_email->BusinessName;
//                                $mail_data_ad['b_title'] = $advertiser_email->CaptionLine;
//                                $mail_data_ad['email'] = $advertiser_email->Email;//'dileeplohar@gmail.com';
//                                $mail_data_ad['phone'] = $advertiser_email->CellNo;
//                                $mail_data_ad['address'] = $advertiser_email->BusinessAddress;
//                                $mail_data_ad['post_code'] = $advertiser_email->PostCode;
//                                $mail_data_ad['msg'] = 'More information please open your account.';
//                                $message = $this->load->view('web/user/mail_msg/create_ad_mail.php', $mail_data_ad, true);
//                                $this->customlib->send_exp_remider($this->admin_mail, $message, $subject);
//                            
////                            $data2 = array(
////                                'StatusID'=>0,
////                            );
////                            $this->Advertisement->updateAds($data['AdsID'],$data2);
//                        }
//
//                    }
//                }
//        }
	

}
