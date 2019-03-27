<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class MessageController extends UA_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('user/Common_model','Common');
        $this->load->helper('custom');
        $this->load->model('user/Message_model','Message');
    }
    
    //get user all message 
    public function get_message(){
        $id = $this->session->userdata['user_profile']['id'];
        $data['user_data'] = $this->Common->get_userData($id);
        $data['navbar_title'] = 'Message';
        $data['chat_ads'] = $this->Message->get_chat_ads($id);
        $this->load->view('web/layout/header_web', $data);
        $this->load->view('web/layout/sidebar_web');
        $this->load->view('web/user/message_web');
        $this->load->view('web/layout/footer_web');
    }
    
    //ajax to call on message page
    public function chatting_user(){
        $lt = $this->input->post('chat');
        //for use to click on ads then get msg and view
        $chat_id = $this->input->post('chat_id');
        $name = $this->input->post('name');
        
        $user_id = $this->input->post('user_id');
        if($lt == 'chat'){
            $data['chat_ads'] = $this->Message->get_chat_ads($user_id);
            $data['name'] = $name;
            $this->load->view('admin/message/ajax/chat', $data);
        }else if($lt == 'msg'){
            $data_update=array(
                'NotifyUser'=>0,
                'LastModifiedBy'=>$user_id,
                'LastModifiedDT'=> date('Y-m-d H:i:s')
            );
            $this->Message->update_notify($chat_id,$data_update);
            $this->Message->read_msg($chat_id);
            $data['chat_msg'] = $this->Message->get_chat_msg($chat_id);
            $data['chat_id'] = $chat_id;
            $data['user_id'] = $user_id;
            $data['image'] = $this->input->post('image');
            $this->load->view('web/user/chat_msg_ajax', $data);
        }
        
        //chat div open and then msg
        else if($lt == 'send'){
            $data_update1=array(
                'NotifyAdmin'=>1,
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