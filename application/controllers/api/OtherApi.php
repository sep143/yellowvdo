<?php
ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//include Rest Controller library
require APPPATH . '/libraries/REST_Controller.php';

class OtherApi extends REST_Controller {

    public function __construct($config = 'rest') {
        header('Access-Control-Allow-Origin: *');
        //header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        parent::__construct();
        //load user model
        $this->load->model('api/OtherApi_model','Other');
//        $this->load->model('admin/User_model', 'User_model');
//        $this->load->model('admin/API_model', 'API_model');
    }
    
    public function sendMessage_post(){
    	$userid = $this->post('userid');
    	$adsid = $this->post('adsid');
    	$msg = $this->post('msg');
    	$status = $this->Other->send_msg($userid,$adsid,$msg);
    	if($status){
				$this->response([
						'status'=>true,
						'message'=> "message send successfully"
					],200);
			}
			else{
				$this->response([
						'status'=>false,
						'message'=> "server error please try again later"
					],200);
			}
    }

    public function getMessage_post(){	
    	$adsid = $this->post('adsid');
    	$data = $this->Other->get_msg($adsid);
    	$notify = $this->Other->notify($adsid);
    	if($data){
				$this->response([
						'status'=>true,
						'message'=> $data
					],200);
			}
			else{
				$this->response([
						'status'=>false,
						'message'=> "server error please try again later"
					],200);
			}
    }

    public function chatList_post(){	
    	$userid = $this->post('userid');
    	$limit = $this->post('limit');
    	$offset = $this->post('offset');
    	$data = $this->Other->chat_list($userid,$limit,$offset);
    	if($data){
				$this->response([
						'status'=>true,
						'imagebaseurl'=> base_url().'uploads/ads/',
						'message'=> $data
					],200);
			}
			else{
				$this->response([
						'status'=>false,
						'imagebaseurl'=> base_url().'uploads/ads/',
						'message'=> $data
					],200);
			}
    }
    public function notify_get(){
		$adsid = $this->get('adsid');
		$data = $this->Other->notify($adsid);
    }

    public function sendReview_post(){	
    	$adsid = $this->post('adsid');
    	$deviceid = $this->post('deviceid');
    	$rating = $this->post('rating');
    	$comment = $this->post('comment');
    	$platform = $this->post('platform');
    	$obj = array(
			'AdsID' => $adsid,
			'DeviceID' => $deviceid,
			'Rating' => $rating,
			'Comment' => $comment,
			'Platform' => $platform
    	);
    	$data = $this->Other->insert_review($obj);
    	if($data){
				$this->response([
						'status'=>true,
						'message'=> "Review submitted successfully"
					],200);
			}
			else{
				$this->response([
						'status'=>false,
						'message'=> "You are already submitted a review on this Ad"
					],200);
			}
	}
}
