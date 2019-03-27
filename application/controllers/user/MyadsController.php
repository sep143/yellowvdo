<?php
defined('BASEPATH')OR exit('No direct script access allowed');

/*
 * this controller as final testing use and single page to use ads create
 * 
 */
class MyadsController extends UA_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('user/Common_model','Common');
        $this->load->model('user/Myads_model','Myads');
        $this->load->model('admin/Advertisement_model','Advertisement');
        $this->load->helper('custom');
        $this->load->model('web/Homepage_model','Home');
    }
    
    //check video upload via ajax
//    public function ajaxUpload() {
//        if (!empty($_FILES['video']['name'])) {
//			$videostatus="enter method";
//			$config['upload_path'] ='./temp/output/';
////			$config['upload_path'] ='./uploads/video/';
//			$config['allowed_types'] = 'wmv|mp4|avi|mov';
//			$config['max_size'] = '0';
////			$config['max_filename'] = '255';
//			$config['encrypt_name'] = true;
//			$video_data = array();
//			$this->load->library('upload', $config);
//			$this->upload->initialize($config);
//			if ($this->upload->do_upload('video')) {
//                                $uploadData = $this->upload->data();
//                                $video = $uploadData['file_name'];
//                               
//                            } else {
//                                $video = NULL;
//                            }
//            //store the video file info
////                    $this->Advertisement->insert_video($createdID,$video);
//                }else{
////                    $video = $this->input->post('youtube_link');
////                    $this->Advertisement->insert_video($createdID,$video);
//                }
//    }
    
    //all ads get user id
    public function get_all_ads() {
        $id = $this->session->userdata['user_profile']['id'];
        $data['user_data'] = $this->Common->get_userData($id);
        $data['navbar_title'] = 'My Ads';

        /*Pagination Setup Start*/ 
        $base_url = "myads";
        $total_rows = $this->Myads->count_myads($id);
        $per_page = 5;
        $uri_segment = 2;
        $config=$this->customlib->paginate($base_url,$total_rows,$per_page,$uri_segment);        
        $this->pagination->initialize($config);
        $page = ($this->uri->segment($config['uri_segment'],0) > 0)?$this->uri->segment($config['uri_segment'],0):0;
        /*Pagination Setup End*/ 

        $data['ads'] = $this->Myads->get_myads($id,$config['per_page'],$page);
        $data['links'] = $this->pagination->create_links(); // Pagination Link
        $this->load->view('web/layout/header_web', $data);
        $this->load->view('web/layout/sidebar_web');
        $this->load->view('web/user/myAds_web',$data);
        $this->load->view('web/layout/footer_web');
    }
    
     // use only deleted ads
    public function change_status(){
        $id = $this->input->post('id');
        $value = $this->input->post('value');
        if($id){
            if($value == 3){
                $data=array(
                    'StatusID'=> $value,
                    'DeletedBy'=> $this->session->userdata['user_profile']['id'],
                    'DeletedDT'=> date('Y-m-d H:i:s')
                );
            }else{
                $data=array(
                    'StatusID'=> $value,
                    'LastModifiedBy'=> $this->session->userdata['user_profile']['id'],
                    'LastModifiedDT'=> date('Y-m-d H:i:s')
                );
            }
            
            $result = $this->Advertisement->free_ads_change_status($id, $data);
            if($result){
                echo $result;
            }
        }
    }
    
    //if view image delete then ajax call to delete image
    public function delete_ads_image() {
        $id = $this->input->post('id');
        if($id){
            $data = array(
                'StatusID'=> 3,
                'DeletedBy'=> $this->session->userdata('log_id'),
                'DeletedDT'=> date('Y-m-d H:i:s')
            );
            $this->Advertisement->image_deleted($id, $data);
        }
    }
    
    //myads list to send msg then work
    public function send_msg() {
        $id = $this->input->post('id');
        $msg = $this->input->post('msg');
        //chat table in check alredy adsid then only change notification other wise insert row
        $result = $this->Myads->check_row($id);
        if($result > 0){
            $chat_id = $this->Myads->get_chat_row($id);
            $data = array(
                'NotifyAdmin'=>1
            );
            //update chat table in 
            $this->Myads->update_notify($chat_id->ID, $data);
            $msg_data = array(
                'ChatID'=>$chat_id->ID,
                'UserID'=>  $this->session->userdata['user_profile']['id'],
                'Msg'=> $msg
            );
            $rt = $this->Myads->msg_save($msg_data);
            if($rt){
                $this->session->set_flashdata('success_msg','Successfully send message.');
                redirect('myads');
            }
        }else{
            $data = array(
                'AdsID'=>$id,
                'NotifyAdmin'=>1
            );
            $reID = $this->Myads->insert_chat_table($data);
            $msg_data = array(
                'ChatID'=>$reID,
                'UserID'=>  $this->session->userdata['user_profile']['id'],
                'Msg'=> $msg
            );
            $rt = $this->Myads->msg_save($msg_data);
            if($rt){
                $this->session->set_flashdata('success_msg','Successfully send message.');
                redirect('myads');
            }
        }
    }
    
    //user loginthen ad view only
    public function view_ad_user($adid) {
        $data['ad_id'] = $adid;
        $id = $this->session->userdata['user_profile']['id'];
        $data['category'] = $this->Home->get_category();
        $data['ad_view'] = $this->Myads->get_ads_byID($id, $adid);
        if(!empty($data['ad_view']->ID)){
            $data['images'] = $this->Myads->get_all_img_byID($data['ad_view']->ID);
            $data['review_count'] = $this->Myads->get_review($data['ad_view']->ID);
            $data['review'] = $this->Myads->get_review_all($data['ad_view']->ID);
        }
        if(!empty($this->session->userdata['user_profile']['id'])){
            $id = $this->session->userdata['user_profile']['id'];
            $data['user_data'] = $this->Common->get_userData($id);
        }
        $this->load->view('web/layout/header_web',$data);
        $this->load->view('web/ad_view_web');
        $this->load->view('web/layout/footer_web');
    }
    
    //create ad
    public function create_ad() {
        $this->session->set_userdata('img',array());
        
        $id = $this->session->userdata['user_profile']['id'];
        $data['user_data'] = $this->Common->get_userData($id);
        $data['navbar_title'] = 'Create My Ads';
        $data['ads'] = 1;//$this->Myads->get_myads($id);
        $this->load->view('web/layout/header_web', $data);
        $this->load->view('web/layout/sidebar_web');
        $this->load->view('web/user/create_ad_web');
        $this->load->view('web/layout/footer_web'); 
    }
    
    //create ad 
    public function create_ads(){
        $userid = $this->session->userdata['user_profile']['id'];
        $user_data = $this->Common->get_userData($userid);
        $status = 6;
        if($user_data->AccountType == 0){
            $status = 0;
        }
        $advertiserid = $this->session->userdata['user_profile']['id'];
        $categoryid = $this->input->post('catid');
        $businessname = $this->input->post('businessname');
        $captionLine = $this->input->post('captionline');
        $keyword = $this->input->post('keyword');
            $description = $this->input->post('description');
            $url1 = $this->input->post('url1');
            $url1Show = $this->input->post('url1Show');
            $url2 = $this->input->post('url2');
            $url2Show = $this->input->post('url2Show');
            $url3 = $this->input->post('url3');
            $url3Show = $this->input->post('url3Show');
            $url4 = $this->input->post('url4');
            $url4Show = $this->input->post('url4Show');
            $url5 = $this->input->post('url5');
            $url5Show = $this->input->post('url5Show');
            $landmark = $this->input->post('LandmarkAddress');
            $landmarkShow = $this->input->post('LandmarkAddressShow');
        $businessAddress = $this->input->post('businessAddress');
        $businessAddressShow = $this->input->post('businessAddressShow');
        $city = $this->input->post('city');
        $cityShow = $this->input->post('cityShow');
        $state = $this->input->post('state');
        $stateShow = $this->input->post('stateShow');
        $country = $this->input->post('country');
        $countryShow = $this->input->post('countryShow');
        $postCode = $this->input->post('postCode');
        $postCodeShow = $this->input->post('postCodeShow');
        $email = $this->input->post('email');
        $emailShow = $this->input->post('emailShow');
        $landLine = $this->input->post('landLine');
        $landLineShow = $this->input->post('landLineShow');
//        $dial_cell_code = $this->input->post('dial-code-cell').$this->input->post('cellNo');
        $dial_cell_code = $this->input->post('cellNo');
        $cellNo = $dial_cell_code;
        $cellNoShow = $this->input->post('cellNoShow');
        $dial_cell_code = $this->input->post('dial-code-cell');
//        $dial_wt_code = $this->input->post('dial-code-wt').$this->input->post('whatsappNo');
        $dial_wt_code = $this->input->post('whatsappNo');
        $whatsappNo = $dial_wt_code;
        $whatsappNoShow = $this->input->post('whatsappNoShow');
		$payStatus = $this->input->post('payStatus');
		$adsType = $this->input->post('adsType');
                $latLong = $this->input->post('lat').','.  $this->input->post('lng');
		$data = array(
                        'UserID'=>$advertiserid,
                        'CategID'=>$categoryid,
                        'BusinessName'=>$businessname,
                        'CaptionLine'=>$captionLine,
                        'Keyword'=>$keyword,
                        'Description'=>$description,
                        'Url1'=>$url1,
                        'Url1Show'=>$url1Show,
                        'Url2'=>$url2,
                        'Url2Show'=>$url2Show,
                        'Url3'=>$url3,
                        'Url3Show'=>$url3Show,
                        'Url4'=>$url4,
                        'Url4Show'=>$url4Show,
                        'Url5'=>$url5,
                        'Url5Show'=>$url5Show,
                        'LandmarkAddress'=>$landmark,
                        'LandmarkAddressShow'=>$landmarkShow,
                        'BusinessAddress'=>$businessAddress,
                        'BusinessAddressShow'=>$businessAddressShow,
                        'City'=>$city,
                        'CityShow'=>$cityShow,
                        'State'=>$state,
                        'StateShow'=>$stateShow,
                        'Country'=>$country,
                        'CountryShow'=>$countryShow,
                        'PostCode'=>$postCode,
                        'PostCodeShow'=>$postCodeShow,
                        'Email'=>$email,
                        'EmailShow'=>$emailShow,
                        'LandLine'=>$landLine,
                        'LandLineShow'=>$landLineShow,
                        'CellNo'=>$cellNo,
                        'CellNoShow'=>$cellNoShow,
                        'WhatsAppNo'=>$whatsappNo,
                        'WhatsAppNoShow'=>$whatsappNoShow,
                        //'PayStatus'=>$payStatus,
                        'AdsType'=>1,
                        'StatusID'=>$status,
                        'LatLong'=>$latLong,
                        'CreatedBy'=> $userid,
		);
               // print_r($data); exit();
		$createdID = $this->Advertisement->insertAds($data);
                //create ad then ajax to insert photo then submit time insert database
                foreach ($this->session->userdata['img'] as $count=> $row):
                        $imageData = array(
                            'AdsID'=>$createdID,
                            'Images'=>  $this->session->userdata['img'][$count]
                        );
                        $this->Myads->insert_image($imageData);
                endforeach;

		$videostatus="init";
		if (!empty($_FILES['video']['name'])) {
			$videostatus="enter method";
			$config['upload_path'] ='./uploads/video/';
//			$config['upload_path'] ='./uploads/video/';
			$config['allowed_types'] = 'wmv|mp4|avi|mov';
			$config['max_size'] = '0';
//			$config['max_filename'] = '255';
			$config['encrypt_name'] = true;
			$video_data = array();
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ($this->upload->do_upload('video')) {
                                $uploadData = $this->upload->data();
                                $video = $uploadData['file_name'];
//                                $s_time= $this->input->post('start_video_time');
//                                $d_time= $this->input->post('end_video_time');
//                                $v_name=$video;
                            } else {
                                $video = NULL;
                            }
            //store the video file info
                    $this->Advertisement->insert_video($createdID,$video);
                }else{
                    $video = $this->input->post('youtube_link');
                    $this->Advertisement->insert_video($createdID,$video);
                }
//		$this->session->set_flashdata('success_msg','Create New Ad successfully.');
                $this->session->unset_userdata('img');
                redirect('payment/'.$createdID);
    }
    
    //video trim function
     public function videoEdit($s_time,$v_time,$v_name) {
       echo $data['s_time'] = $s_time;
        $data['v_time'] = $v_time;
        $data['v_name'] = $v_name;
        $duration_time =  $data['v_time']-$data['s_time'];
        $s_time = $data['s_time'];
        $d_time = $data['v_time'];
//        $s_time = gmdate("H:i:s",$data['s_time']);
//        $d_time = gmdate("H:i:s", $data['v_time']);
        /**Video Triming Process**/ 
        $this->config1 = array_merge(array(
            'authentication' => true,
            'ffmpeg_path' => str_replace('\\', '/', getcwd()).('c:/ffmpeg/bin/ffmpeg'),
            'ffprobe_path' => str_replace('\\', '/', getcwd()).('/ffmpeg/bin/ffprobe'),
            'base_url' => '/',
            'root_path' => '',
            'input_dir_name' => str_replace('\\','/', getcwd()).('/temp/input'),
            'input_dir' => str_replace('\\','/', getcwd()).('/temp/input/'.$data['v_name']),
            'output_dir' => str_replace('\\','/', getcwd()).('/temp/output/'.$data['v_name']),
            'tmp_dir' => 'userfiles/tmp/',
            'log_filename' => 'log.txt',
            'database_dir' => 'database/',
            'ffmpeg_string_arr' => array(),
            'users_restrictions' => array(),
            'watermark_text' => '',
            'watermark_text_font_name' => 'libel-suit-rg.tt',
            'queue_size' => 10,
            'debug' => false
        ));
        $content = shell_exec('ffmpeg -y -i '.$this->config1['input_dir'].' -ss '.$s_time.' -to '.$d_time.' -async 1 -strict -2 '.$this->config1['output_dir']);
            
            if (file_exists($this->config1['input_dir'])) unlink($this->config1['input_dir']);
            
//            echo json_encode(array("status" => "200","status_msg" => "Success","S_time" => $s_time, "D_time" => $d_time));    
    }
    
    //edit ad
    public function edit_ad($adid=0) {
       $id = $this->session->userdata['user_profile']['id'];
        $data['user_data'] = $this->Common->get_userData($id);
        $data['navbar_title'] = 'Edit My Ads';
        $data['ads'] = $this->Myads->get_ads_byID($id, $adid);
        if(!empty($data['ads'])){
            $data['category'] = $this->Myads->get_category_byID($data['ads']->CategID);
            $data['images'] = $this->Myads->get_all_img_byID($data['ads']->ID);
            $data['brand_kram'] = $this->Myads->brand_kram($data['ads']->CategID);
        }
        $this->load->view('web/layout/header_web', $data);
        $this->load->view('web/layout/sidebar_web');
        $this->load->view('web/user/edit_ad_web');
        $this->load->view('web/layout/footer_web'); 
    }
    
    //update ads
    //update advertisement
    public function edit_updateAds($id=0){
        $userid = $this->session->userdata['user_profile']['id'];
        $ads_data = $this->Myads->get_ads_byID($userid, $id);
        $status = 2;
        if($ads_data->StatusID == 6){
            $status = 6;
        }else if($ads_data->StatusID == 5){
            $status = 5;
        }else if($ads_data->StatusID == 0){
            $status = 0;
        }
        //$advertiserid = $this->input->post('userid');
        $categoryid = $this->input->post('catid');
        $businessname = $this->input->post('businessname');
        $captionLine = $this->input->post('captionline');
        $keyword = $this->input->post('keyword');
            $description = $this->input->post('description');
            $url1 = $this->input->post('url1');
            $url1Show = $this->input->post('url1Show');
            $url2 = $this->input->post('url2');
            $url2Show = $this->input->post('url2Show');
            $url3 = $this->input->post('url3');
            $url3Show = $this->input->post('url3Show');
            $url4 = $this->input->post('url4');
            $url4Show = $this->input->post('url4Show');
            $url5 = $this->input->post('url5');
            $url5Show = $this->input->post('url5Show');
		
        $LandmarkAddress = $this->input->post('LandmarkAddress');
        $LandmarkAddressShow = $this->input->post('LandmarkAddressShow');
        $businessAddress = $this->input->post('businessAddress');
        $businessAddressShow = $this->input->post('businessAddressShow');
        $city = $this->input->post('city');
        $cityShow = $this->input->post('cityShow');
        $state = $this->input->post('state');
        $stateShow = $this->input->post('stateShow');
        $country = $this->input->post('country');
        $countryShow = $this->input->post('countryShow');
        $postCode = $this->input->post('postCode');
        $postCodeShow = $this->input->post('postCodeShow');
        $email = $this->input->post('email');
        $emailShow = $this->input->post('emailShow');
        $landLine = $this->input->post('landLine');
        $landLineShow = $this->input->post('landLineShow');
//        $dial_cell_code = $this->input->post('dial-code-cell').$this->input->post('cellNo');
        $dial_cell_code = $this->input->post('cellNo');
        $cellNo = $dial_cell_code;
        $cellNoShow = $this->input->post('cellNoShow');
        
        $dial_cell_code = $this->input->post('dial-code-cell');
//        $dial_wt_code = $this->input->post('dial-code-wt').$this->input->post('whatsappNo');
        $dial_wt_code = $this->input->post('whatsappNo');
        $whatsappNo = $dial_wt_code;
        $whatsappNoShow = $this->input->post('whatsappNoShow');
		$payStatus = $this->input->post('payStatus');
		$adsType = $this->input->post('adsType');
		$latLong = $this->input->post('lat').','.  $this->input->post('lng');
		$data = array(
                    //'UserID'=>$advertiserid,
                    'CategID'=>$categoryid,
                    'BusinessName'=>$businessname,
                    'CaptionLine'=>$captionLine,
                    'Keyword'=>$keyword,
                    'Description'=>$description,
                    'Url1'=>$url1,
                    'Url1Show'=>$url1Show,
                    'Url2'=>$url2,
                    'Url2Show'=>$url2Show,
                    'Url3'=>$url3,
                    'Url3Show'=>$url3Show,
                    'Url4'=>$url4,
                    'Url4Show'=>$url4Show,
                    'Url5'=>$url5,
                    'Url5Show'=>$url5Show,
                    'LandmarkAddress'=>$LandmarkAddress,
                    'LandmarkAddressShow'=>$LandmarkAddressShow,
                    'BusinessAddress'=>$businessAddress,
                    'BusinessAddressShow'=>$businessAddressShow,
                    'City'=>$city,
                    'CityShow'=>$cityShow,
                    'State'=>$state,
                    'StateShow'=>$stateShow,
                    'Country'=>$country,
                    'CountryShow'=>$countryShow,
                    'PostCode'=>$postCode,
                    'PostCodeShow'=>$postCodeShow,
                    'Email'=>$email,
                    'EmailShow'=>$emailShow,
                    'LandLine'=>$landLine,
                    'LandLineShow'=>$landLineShow,
                    'CellNo'=>$cellNo,
                    'CellNoShow'=>$cellNoShow,
                    'WhatsAppNo'=>$whatsappNo,
                    'WhatsAppNoShow'=>$whatsappNoShow,
                    //'PayStatus'=>$payStatus,
                    'AdsType'=>1,
                    'StatusID'=>$status,
                    'LatLong'=>$latLong,
                    'LastModifiedBy'=> $userid,
                    'LastModifiedDT'=>  date('Y-m-d h:i:s'),
                    'Notification'=>2
		);
              //  print_r($data); exit();
		$updateStatus = $this->Advertisement->updateAds($id,$data);
	  
//		$videostatus="init";
		if (!empty($_FILES['video']['name'])) {
                    //if change video then overright
                    $ads_data = $this->Advertisement->get_ads_byID($id);
                        $path = './uploads/video/';
                        unlink($path.$ads_data->Video);
			$config['upload_path'] ='./uploads/video/';
			$config['allowed_types'] = 'wmv|mp4|avi|mov';
			//$config['max_size'] = '0';
			$config['max_filename'] = '255';
			$config['encrypt_name'] = true;
                        $config['overwrite']     = FALSE;  
			$video_data = array();
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
                            if ($this->upload->do_upload('video')) {
                                $uploadData = $this->upload->data();
                                $video = $uploadData['file_name'];
                            } else {
                                $video = NULL;
                            }

            //store the video file info
                    $this->Advertisement->insert_video($id,$video);
		}
                //if youtube link insert data then
                if(!empty($this->input->post('youtube_link'))){
                    $video = $this->input->post('youtube_link');
                    $this->Advertisement->insert_video($id,$video);
                }
                
                //send mail admin
                $key = $this->Advertisement->get_ads_mail_via_id($id);
                if($key->StatusID != 5 || $key->StatusID != 6){
                    $subject = "Yellow Vdo";
                    $mail_data_ad['name'] = $key->FirstName.' '.$key->LastName;
                    $mail_data_ad['b_name'] = $key->BusinessName;
                    $mail_data_ad['b_title'] = $key->CaptionLine;
                    $mail_data_ad['email'] = $key->Email;//'dileeplohar@gmail.com';
                    $mail_data_ad['phone'] = $key->CellNo;
                    $mail_data_ad['address'] = $key->BusinessAddress;
                    $mail_data_ad['post_code'] = $key->PostCode;
                    $mail_data_ad['ad_id'] = $key->ID;
                    $mail_data_ad['msg_title'] = "This ad edit";
                    $mail_data_ad['msg'] = 'Advertiser <b>'.$key->FirstName.' '.$key->LastName.'</b><br> Please active ad then publish on site this ad.';
                   // $this->load->view('admin/mail_msg/cron_reminder_mail', $mail_data_ad);
                    $message = $this->load->view('admin/mail_msg/active_deactive_ads_mail.php', $mail_data_ad, true);
                    $this->customlib->send_exp_remider($key->UserName, $message, $subject);
                }
                //send admin mail then redirect page
		$this->session->set_flashdata('success_msg','Update Ad successfully.');
                redirect('myads');
    }
    
}