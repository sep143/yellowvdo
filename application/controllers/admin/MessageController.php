<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class MessageController extends MY_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('admin/Message_model','Message');
        $this->load->helper('custom');
    }
    
    public function index() {
        $data['tital'] = $this->lang->line('message');
        $data['chat'] = $this->Message->get_chat();
        $this->load->view('admin/layout/header_view', $data);
        $this->load->view('admin/message/message_show');
        $this->load->view('admin/layout/footer_view');
    }
    
    //ajax to call on message page
    public function chatting(){
        $lt = $this->input->post('chat');
        //for use to click on ads then get msg and view
        $chat_id = $this->input->post('chat_id');
        $name = $this->input->post('name');
        
        $user_id = $this->input->post('user_id');
        if($lt == 'chat'){
            $data['chat_ads'] = $this->Message->get_chat_ads($user_id);
            $data['name'] = $name;
            $data['image'] = $this->input->post('image');
            $this->load->view('admin/message/ajax/chat', $data);
        }else if($lt == 'msg'){
            $data_update=array(
                'NotifyAdmin'=>0,
                'LastModifiedBy'=>$this->session->userdata('log_id'),
                'LastModifiedDT'=> date('Y-m-d H:i:s')
            );
            $this->Message->update_notify($chat_id,$data_update);
            $this->Message->read_msg($chat_id);
            $data['chat_msg'] = $this->Message->get_chat_msg($chat_id);
            $data['chat_id'] = $chat_id;
            $data['user_id'] = $user_id;
            $data['image'] = $this->input->post('image');
            $this->load->view('admin/message/ajax/all_msg', $data);
        }
        
        //chat div open and then msg
        else if($lt == 'send'){
            $data_update1=array(
                'NotifyUser'=>1,
                'LastModifiedBy'=>$user_id,
                'LastModifiedDT'=> date('Y-m-d H:i:s')
            );
            $this->Message->update_notify($this->input->post('ch_id'),$data_update1);
            $data = array(
                'ChatID'=> $this->input->post('ch_id'),
                'UserID'=> $this->input->post('us_id'),
                'Msg'=> $this->input->post('msg'),
            );
            $result = $this->Message->add_msg($data);
        }
        
    }
}