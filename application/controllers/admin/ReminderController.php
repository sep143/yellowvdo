<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class ReminderController extends MY_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('admin/Reminder_model','Reminder');
        $this->load->model('admin/Advertisement_model','Advertisement');
    }
    
    //ads expired bofore 1 month can send mail for reminder-> Pending ads
    public function index(){
        $data['tital'] = 'Reminder Advertisement';
        $data['ads_list'] = $this->Advertisement->get_expired_before_Ads();
        $this->load->view('admin/layout/header_view', $data);
        $this->load->view('admin/reminder/reminder_table');
        $this->load->view('admin/layout/footer_view');
    }
    
    
    //ads renew ads table all expired then view data this use finction
    public function renew_ads(){
        $data['tital'] = 'Renew Advertisement';
        $data['ads_list'] = $this->Advertisement->get_expiredAds();
        $this->load->view('admin/layout/header_view', $data);
        $this->load->view('admin/reminder/renew_table');
        $this->load->view('admin/layout/footer_view');
    }
    
    //send mail via ajax to call on datatable use 
    // Send Reminder Email 
    public function send_reminder_mail() {
            $advertiser_id = $this->input->post('id');
            $result = $this->Advertisement->get_email_add($advertiser_id);

           $type = $this->input->post('type');
            
            if($type == 'reminder'){
                /** Email Content Start:**/
                $email_data['email'] = $result['UserName'];
                $email_data['name'] = $result['FirstName'] . " " . $result['LastName'];
                $email_data['business_name'] = $result['BusinessName'];
                $email_data['ads_title'] = $result['CaptionLine'];
                $email_data['business_add'] = $result['BusinessAddress']." ".$result['LandmarkAddress'];
                $email_data['created_date'] = date("l d,M Y", strtotime($result['CreatedDT']));
                $email_data['exp_date'] = date("l d,M Y", strtotime($result['ExpiryDT']));

                $email_data['msg_title'] = "Reminder for Advertisement";
                $email_data['msg'] = "With respect to state that, our records and review indicate that your Advertisement will need to be renewed on date <span style='color:red;font-size:14px; font-weight:bold;'>".$email_data['exp_date']."</span>, Advertisement date was expired <span style='color:red;font-size:14px; font-weight:bold;'>".$email_data['exp_date']."</span>.";
                $email_data['msg1'] = "Your Advertisement will be expire on ".$email_data['exp_date']." please make payment";
                $email_data['thanks_msg'] = "Thanks,<br>Yellow VDO Team.<br>Mob. +91 9309090909";
                $email_data['ignore_msg'] = "Please Ignore this message if your advertisemet is already Renew";
                /* Email Content End */
                $subject = " - Reminder yours Advertisement";
                $message = $this->load->view('admin/mail_msg/notification.php', $email_data, true);
                $this->customlib->send_exp_remider($email_data['email'], $message, $subject);
                $this->email->print_debugger();
                if ($this->email->send()) {
                    $data['status'] = 200;
                    $data['msg'] = "Remider mail Sent Successfully";
                    echo json_encode($data);
                } else {
                    $data['status'] = 401;
                    $data['msg'] = "Something went wrong";
                    echo json_encode($data);
                }
            }else if($type == 'renew'){
                /** Email Content Start:**/
                $email_data['email'] = $result['UserName'];
                $email_data['name'] = $result['FirstName'] . " " . $result['LastName'];
                $email_data['business_name'] = $result['BusinessName'];
                $email_data['ads_title'] = $result['CaptionLine'];
                $email_data['business_add'] = $result['BusinessAddress']." ".$result['LandmarkAddress'];
                $email_data['created_date'] = date("l d,M Y", strtotime($result['CreatedDT']));
                $email_data['exp_date'] = date("l d,M Y", strtotime($result['ExpiryDT']));

                $email_data['msg_title'] = "Renew for Advertisement";
                $email_data['msg'] = "With respect to state that, our records and review indicate that your Advertisement will need to be renewed on date <span style='color:red;font-size:14px; font-weight:bold;'>".$email_data['exp_date']."</span>, Advertisement date was expired <span style='color:red;font-size:14px; font-weight:bold;'>".$email_data['exp_date']."</span>.";
                $email_data['msg1'] = "Your Advertisement will be expire on ".$email_data['exp_date']." please make payment";
                $email_data['thanks_msg'] = "Thanks,<br>Yellow VDO Team.<br>Mob. +91 9309090909";
                $email_data['ignore_msg'] = "Please Ignore this message if your advertisemet is already Renew";
                /* Email Content End */
                $subject = " - Renew yours Advertisement";
                $message = $this->load->view('admin/mail_msg/notification.php', $email_data, true);
                $this->customlib->send_exp_remider($email_data['email'], $message, $subject);
                $this->email->print_debugger();
                if ($this->email->send()) {
                    $data['status'] = 200;
                    $data['msg'] = "Renew mail Sent Successfully";
                    echo json_encode($data);
                } else {
                    $data['status'] = 401;
                    $data['msg'] = "Something went wrong";
                    echo json_encode($data);
                }
            }
            
        }
    
}