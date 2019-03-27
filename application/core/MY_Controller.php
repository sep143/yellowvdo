<?php


//for use admin Panel
class MY_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->set_timezone();
        $this->img_limit_fix = $this->image_limit();
        if(!empty($this->img_limit_fix)){
            $this->img_limit_fix = $this->img_limit_fix;
        }else{
            $this->img_limit_fix = 0;
        }
        if(!empty($this->session->userdata['lang_set']['language'])){
            $this->language = $this->session->userdata['lang_set']['language'];
        }else{
            $this->language = 'english';
        }
        $this->lang->load('sidebar', $this->language);
        //sidebar string set then any page call to commen string but page wise on controller to seet string
        $this->head_tital = $this->lang->line('head_title');
        $this->admin_name = $this->lang->line('admin_name');
        $this->dashboard = $this->lang->line('dashboard');
        
        $this->category = $this->lang->line('category');
        
        $this->advertiser = $this->lang->line('advertiser');
        
        $this->advertisement = $this->lang->line('advertisement');
        $this->advertisement_head = $this->lang->line('advertisement_head');
        $this->advertisement_pending = $this->lang->line('advertisement_pending');
        $this->advertisement_payment_ads = $this->lang->line('advertisement_payment_ads');
        $this->advertisement_disapprove = $this->lang->line('advertisement_disapprove');
        $this->advertisement_expired = $this->lang->line('advertisement_expired');
        $this->advertisement_free_ad_list = $this->lang->line('advertisement_free_ad_list');
        
        $this->reminder_head = $this->lang->line('reminder_head');
        $this->reminder_renew = $this->lang->line('reminder_renew');
        $this->reminder_pending_ads = $this->lang->line('reminder_pending_ads');
        
        $this->payment_head = $this->lang->line('payment_head');
        $this->payment_history = $this->lang->line('payment_history');
        $this->refund_request = $this->lang->line('refund_request');
        $this->message = $this->lang->line('message');
        $this->enquiry = $this->lang->line('enquiry');
        $this->promotion = $this->lang->line('promotion');
        $this->review = $this->lang->line('review');
        $this->setting = $this->lang->line('setting');
        $this->setting_common = $this->lang->line('setting_common');
        $this->setting_role = $this->lang->line('setting_role');
        //admin panel in footer 
        $this->about_us = $this->lang->line('about_us');
        $this->blog = $this->lang->line('blog');
        $this->licenses = $this->lang->line('licenses');
        $this->footer_content = $this->lang->line('footer_content');
        //admin panel in top site name
        $this->site_name = $this->lang->line('site_name');
        $this->short_name = $this->lang->line('short_name');
        
        //header part in count notification and show 
        $this->load->model('admin/Common_model','Common');
        $new_user = $this->Common->notification_user();
        $this->user_count = $new_user;
        $new_ads = $this->Common->notification_ads();
        $this->ads_count = $new_ads;
        $new_ads_edit = $this->Common->notification_ads_edit();
        $this->edit_ads_count = $new_ads_edit;
        $refund = $this->Common->notification_refund();
        $this->refund_count = $refund;
        $msg = $this->Common->notification_msg();
        $this->msg_count = $msg;
        
        //header notification
        if (!$this->session->has_userdata('login')) {
            redirect('admin');
        }
        
        //acount role set >> super admin is 1 and normal user is 2
        $this->admin = 3;
        $this->accountant = 4;
    }
    //image limit 
    public function image_limit() {
        $image_id = 1;
        $sql = "select Config from setting_image where ID=$image_id";
        $data = $this->db->query($sql,$image_id);
        $use = $data->row();
        return $use->Config;
    }

    public function set_timezone() {
        if ($this->session->userdata('user_id')) {
            $this->db->select('timezone');
            $this->db->from($this->db->dbprefix . 'user');
            $this->db->where('user_id', $this->session->userdata('user_id'));
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                date_default_timezone_set($query->row()->timezone);
            } else {
                return false;
            }
        }
    }

}

//For use user panel
class UA_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->set_timezone();
        
        $this->img_limit_fix = $this->image_limit();
        if(!empty($this->img_limit_fix)){
            $this->img_limit_fix = $this->img_limit_fix;
        }else{
            $this->img_limit_fix = 0;
        }
        
        if (!$this->session->has_userdata('web_login')) {
            redirect('');
        }
    }
    
     //image limit 
    public function image_limit() {
        $image_id = 1;
        $sql = "select Config from setting_image where ID=$image_id";
        $data = $this->db->query($sql,$image_id);
        $use = $data->row();
        return $use->Config;
    }

    public function set_timezone() {
        if ($this->session->userdata('user_id')) {
            $this->db->select('timezone');
            $this->db->from($this->db->dbprefix . 'user');
            $this->db->where('user_id', $this->session->userdata('user_id'));
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                date_default_timezone_set($query->row()->timezone);
            } else {
                return false;
            }
        }
    }

}