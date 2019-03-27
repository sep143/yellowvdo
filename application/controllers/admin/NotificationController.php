<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class NotificationController extends MY_Controller{
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $data['tital'] = 'Notification View';
        $this->load->view('admin/layout/header_view', $data);
        $this->load->view('admin/notification/notification_show');
        $this->load->view('admin/layout/footer_view');
    }
}