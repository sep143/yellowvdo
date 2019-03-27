<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Paypal extends CI_Controller 
    {
         function  __construct(){
            parent::__construct();
            $this->load->library('paypal_lib');
            //$this->load->model('product');
            $this->load->model('user/Myads_model','Myads');
            $this->load->model('admin/Advertisement_model','Advertisement');
            $this->load->model('user/Common_model','Common');
            $this->load->model('Payment_model','Payment');
            //$this->load->model('user/Common_model','Common');
            $this->load->helper('custom');
            $this->admin_mail = 'satish.office2018@gmail.com';
         }
         
         function success(){
           //get the transaction data
           $paypalInfo = $this->input->get();
              
           $data['item_name']      = $paypalInfo['item_name'];
           $data['item_number'] = $paypalInfo['item_number']; 
           $data['txn_id'] = $paypalInfo["tx"];
           $data['payment_amt'] = $paypalInfo["amt"];
           $data['currency_code'] = $paypalInfo["cc"];
           $data['status'] = $paypalInfo["st"];
           //payment success then send email user
           
           $defualt_payset = $this->Payment->defaultSetUse(1); //1 = this table in ID = 1 pr fix value set rahegi 
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
            if(!empty($payment_table)){
                $payment_id = $this->Common->insertTransaction($data1);
            }
           if($payment_id && ($data1['Phone'] == 'Completed')){
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
                        $advertiser_email = $this->Payment->get_advertiser_mail($data1['UserID']);
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
                        $advertiser_email = $this->Payment->get_advertiser_mail($data1['UserID']);
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
           
//         $this->load->view('paypal/success_v', $data);
           $id = $this->session->userdata['user_profile']['id'];
             $data['user_data'] = $this->Common->get_userData($id);
           $data['navbar_title'] = 'Successfully pay ad';
           $this->load->view('web/layout/header_web', $data);
           $this->load->view('web/layout/sidebar_web');
           $this->load->view('paypal/success_v');
           $this->load->view('web/layout/footer_web');
         }
         
         function cancel(){
//            $this->load->view('paypal/cancel_v');
            $id = $this->session->userdata['user_profile']['id'];
            //$data['ads'] = $this->Myads->get_ads_byID($id, $adid);
//            $this->load->view('web/payment/check_out',$data);
            $data['user_data'] = $this->Common->get_userData($id);
            $data['navbar_title'] = 'Faild pay transection';
            $this->load->view('web/layout/header_web', $data);
            $this->load->view('web/layout/sidebar_web');
            $this->load->view('paypal/cancel_v');
            $this->load->view('web/layout/footer_web');
         }
         
//         public function ipn(){
//            $paypalInfo    = $this->input->post();
//             
//            $data['UserID'] = $paypalInfo["custom"];
//            $data['AdsID'] = $paypalInfo["item_number"];
//            $data['TxtID'] = $paypalInfo["txn_id"];
//            $data['Amt']  = $paypalInfo["mc_gross"];
//            $data['Currency']  = $paypalInfo["mc_currency"];
//            $data['Email'] = $paypalInfo["payer_email"];
//            $data['Phone'] = $paypalInfo["payment_status"];
//            $paypalURL = $this->paypal_lib->paypal_url;        
//            $result    = $this->paypal_lib->curlPost($paypalURL,$paypalInfo);
//            if(preg_match("/VERIFIED/i",$result)){
//                //insert the transaction data into the database
//                $payment_id = $this->Common->insertTransaction($data);
//                if($data['Phone'] == 'Completed'){
//                        $email_to_download_invoice = sha1($data['TxtID'].$data['Amt'].'AppspunditInfotech123');
//                        $update_data = array(
//                            'Encrypt'=>$email_to_download_invoice,
//                        );
//                        $this->Common->insertTransaction_update($payment_id,$email_to_download_invoice);
//                        //set expiry date
//                        $ads_data = $this->Advertisement->get_ads_byID($data['AdsID']);
//                        
//                        if(!empty($ads_data->ExpiryDT)){
//                            $ex_dt = $ads_data->ExpiryDT;
//                            $current_dt = (new DateTime())->format('Y-m-d');
//                            if($current_dt <= $ex_dt){
//                                $set_dt = $ex_dt;
//                            }else{
//                                $set_dt = $current_dt;
//                            }
//                            $expiry_dt = date('Y-m-d', strtotime($set_dt.' + 365 days'));
//                        }else{
//                            $expiry_dt = date('Y-m-d', strtotime('+ 365 days'));
//                        }
//                        $data2 = array(
//                            'StatusID'=>0,
//                            'PayStatus'=>1,
//                            'ExpiryDT'=> $expiry_dt,
//                        );
//                        $updateStatus = $this->Advertisement->updateAds($data['AdsID'],$data2);
//                        
//                        //advertiser send mail
//                        $advertiser_email = $this->Payment->get_advertiser_mail($data['UserID']);
//                        $subject = "Yellow Vdo";
//                        $mail_data_ad['msg_title'] = "New ad create";
//                        $mail_data_ad['name'] = $advertiser_email->FirstName.' '.$advertiser_email->LastName;
//                        $mail_data_ad['txt_id'] = $advertiser_email->TxtID;
//                        $mail_data_ad['amount'] = $advertiser_email->Amt;
//                        $mail_data_ad['status'] = 'Successfully';
//                        $mail_data_ad['b_name'] = $advertiser_email->BusinessName;
//                        $mail_data_ad['b_title'] = $advertiser_email->CaptionLine;
//                        $mail_data_ad['email'] = $advertiser_email->Email;//'dileeplohar@gmail.com';
//                        $mail_data_ad['phone'] = $advertiser_email->CellNo;
//                        $mail_data_ad['address'] = $advertiser_email->BusinessAddress;
//                        $mail_data_ad['post_code'] = $advertiser_email->PostCode;
//                        $mail_data_ad['download_invoice'] = $advertiser_email->Encrypt;
//                        $mail_data_ad['msg'] = 'More information please open your account.';
//                        $message = $this->load->view('web/user/mail_msg/create_ad_mail.php', $mail_data_ad, true);
//                        $this->customlib->send_exp_remider($advertiser_email->UserName, $message, $subject);
//                        //admin mail send
//                        $advertiser_email = $this->Payment->get_advertiser_mail($data['UserID']);
//                        $subject = "New ad create";
//                        $mail_data_ad['msg_title'] = "New ad create";
//                        $mail_data_ad['name'] = $advertiser_email->FirstName.' '.$advertiser_email->LastName;
//                        $mail_data_ad['txt_id'] = $advertiser_email->TxtID;
//                        $mail_data_ad['amount'] = $advertiser_email->Amt;
//                        $mail_data_ad['status'] = 'Successfully';
//                        $mail_data_ad['b_name'] = $advertiser_email->BusinessName;
//                        $mail_data_ad['b_title'] = $advertiser_email->CaptionLine;
//                        $mail_data_ad['email'] = $advertiser_email->Email;//'dileeplohar@gmail.com';
//                        $mail_data_ad['phone'] = $advertiser_email->CellNo;
//                        $mail_data_ad['address'] = $advertiser_email->BusinessAddress;
//                        $mail_data_ad['post_code'] = $advertiser_email->PostCode;
//                        $mail_data_ad['download_invoice'] = $advertiser_email->Encrypt;
//                        $mail_data_ad['msg'] = 'More information please open your account.';
//                        $message = $this->load->view('web/user/mail_msg/create_ad_mail.php', $mail_data_ad, true);
//                        $this->customlib->send_exp_remider($this->admin_mail, $message, $subject);
//                    } //payment complete then run if condition
//            }
//         }


    }