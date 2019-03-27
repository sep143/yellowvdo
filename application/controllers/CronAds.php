<?php
defined('BASEPATH')OR exit('No script access allowed');

class CronAds extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('CronAds_model','Cron');
        $this->load->library('customlib');
    }
    
    //advertisement table in set cron job to exipry date
    public function index(){
        $ads_expiry = $this->Cron->get_ads();
        $current_dt = (new DateTime())->format('Y-m-d');
        foreach ($ads_expiry as $count=>$key):
        //    echo $key->ExpiryDT.'- Count ='.$count.'<br>';
            if($current_dt < $key->ExpiryDT){
               // echo $key->ExpiryDT.'Expiry not and ID'.$key->ID.' <br>';
                
            }else{
                //echo $key->ExpiryDT.'Exprity and ID'.$key->ID.'<br>';
                $update_data = array(
                    'StatusID'=>5
                );
                $result = $this->Cron->update_status($key->ID,$update_data);
            }
        endforeach;
        
        //original folder in image unlink
        $files = glob(str_replace('\\', '/', getcwd()).('/uploads/ads/original/*.*'));
        foreach($files as $file){
            if(is_file($file))
                unlink($file);
        }
    }
    
    //reminder mail send 24 hours in hit url
    public function reminder_mail() {
        $current_dt = (new DateTime())->format('Y-m-d');
        $ads_expiry = $this->Cron->get_ads_mail();
        foreach ($ads_expiry as $count=>$key):
            $expiry_dt30 = date('Y-m-d', strtotime($key->ExpiryDT.' - 30 days'));
            $expiry_dt15 = date('Y-m-d', strtotime($key->ExpiryDT.' - 15 days'));
            $expiry_dt = date('Y-m-d', strtotime($key->ExpiryDT));
//          echo $expiry_dt1 = date('Y-m-d', strtotime($key->ExpiryDT.' - 29 days')).' Expire date - '.$key->ExpiryDT.'<br>';
            if($expiry_dt30 == $current_dt){
//                echo $key->ExpiryDT.' 30days match -<br>';
                $subject = "Reminder ad - Your ads is going to expire in 30 days";
                        $mail_data_ad['name'] = $key->FirstName.' '.$key->LastName;
                        $mail_data_ad['b_name'] = $key->BusinessName;
                        $mail_data_ad['b_title'] = $key->CaptionLine;
                        $mail_data_ad['email'] = $key->Email;//'dileeplohar@gmail.com';
                        $mail_data_ad['phone'] = $key->CellNo;
                        $mail_data_ad['address'] = $key->BusinessAddress;
                        $mail_data_ad['post_code'] = $key->PostCode;
                        $mail_data_ad['ad_id'] = $key->ID;
                        $mail_data_ad['msg_title'] = "Your ads is going to expire in 30 days";
                        //$mail_data['verify_link'] = sha1(date('Y-m-d H:i:s'));
                        $mail_data_ad['msg'] = 'Your below advertisement is going to expire. Please login to your account and renew it from my ads section.';
                       // $this->load->view('admin/mail_msg/cron_reminder_mail', $mail_data_ad);
                        $message = $this->load->view('admin/mail_msg/cron_reminder_mail.php', $mail_data_ad, true);
                        $this->customlib->send_exp_remider($key->UserName, $message, $subject);
                
            }else if($expiry_dt15 == $current_dt){
//                echo $key->ExpiryDT.' 15days match -<br>';
                $subject = "Reminder ad - Your ads is going to expire in 15 days";
                        $mail_data_ad['name'] = $key->FirstName.' '.$key->LastName;
                        $mail_data_ad['b_name'] = $key->BusinessName;
                        $mail_data_ad['b_title'] = $key->CaptionLine;
                        $mail_data_ad['email'] = $key->Email;//'dileeplohar@gmail.com';
                        $mail_data_ad['phone'] = $key->CellNo;
                        $mail_data_ad['address'] = $key->BusinessAddress;
                        $mail_data_ad['post_code'] = $key->PostCode;
                        $mail_data_ad['ad_id'] = $key->ID;
                        $mail_data_ad['msg_title'] = "Your ads is going to expire in 15 days";
                        //$mail_data['verify_link'] = sha1(date('Y-m-d H:i:s'));
                        $mail_data_ad['msg'] = 'Your below advertisement is going to expire. Please login to your account and renew it from my ads section.';
                        // $this->load->view('admin/mail_msg/cron_reminder_mail', $mail_data_ad);
                        $message = $this->load->view('admin/mail_msg/cron_reminder_mail.php', $mail_data_ad, true);
                        $this->customlib->send_exp_remider($key->UserName, $message, $subject);
            }else if($expiry_dt == $current_dt){
                $subject = "Reminder ad - Your ads is going to expired";
                        $mail_data_ad['name'] = $key->FirstName.' '.$key->LastName;
                        $mail_data_ad['b_name'] = $key->BusinessName;
                        $mail_data_ad['b_title'] = $key->CaptionLine;
                        $mail_data_ad['email'] = $key->Email;//'dileeplohar@gmail.com';
                        $mail_data_ad['phone'] = $key->CellNo;
                        $mail_data_ad['address'] = $key->BusinessAddress;
                        $mail_data_ad['post_code'] = $key->PostCode;
                        $mail_data_ad['ad_id'] = $key->ID;
                        $mail_data_ad['msg_title'] = "Your ads is going to expired";
                        //$mail_data['verify_link'] = sha1(date('Y-m-d H:i:s'));
                        $mail_data_ad['msg'] = 'Your below advertisement has expired. Please login to your account and renew it from my ads section.';
                        // $this->load->view('admin/mail_msg/cron_reminder_mail', $mail_data_ad);
                        $message = $this->load->view('admin/mail_msg/cron_reminder_mail.php', $mail_data_ad, true);
                        $this->customlib->send_exp_remider($key->UserName, $message, $subject);
            }
        endforeach;
    }
    
    //this video process cron job
    function video_cron(){
        
    }
    function video_cron2(){
        
    }
    
  
}