<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class AdvertisementController extends MY_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('admin/Advertisement_model','Advertisement');
        $this->load->helper('custom');
        //this model use only ad view time
        $this->load->model('user/Myads_model','Myads');
        $this->load->model('user/Common_model','Common_model');
    }
    
    public function index(){
        $data['tital'] = $this->lang->line('advertisement');
        $data['ads_list'] = $this->Advertisement->get_all_ads();
       // $data['user_list'] = $this->Advertisement->get_all_user();
        $this->load->view('admin/layout/header_view', $data);
        $this->load->view('admin/advertisement/advertisement_list');
        $this->load->view('admin/layout/footer_view');
    }
    
    //user ad view admin view time
    public function view_ad_user($adid) {
        $data['ad_id'] = $adid;
//        $id = $this->session->userdata['user_profile']['id'];
//        $data['category'] = $this->Home->get_category();
        $data['ad_view'] = $this->Advertisement->get_ads_byID($adid);
//        $data['user_data'] = 'Hello';
        if(!empty($data['ad_view']->ID)){
            $data['images'] = $this->Myads->get_all_img_byID($data['ad_view']->ID);
            $data['review_count'] = $this->Myads->get_review($data['ad_view']->ID);
            $data['review'] = $this->Myads->get_review_all($data['ad_view']->ID);
        }
        if(!empty($this->session->userdata['user_profile']['id'])){
            $this->session->set_flashdata('danger_msg','Logout advertser account.');
            redirect('admin/advertisement/pending');
//            $id = $this->session->userdata['user_profile']['id'];
//            $data['user_data'] = $this->Common_model->userData($id);
        }
        $this->load->view('web/layout/header_web',$data);
        $this->load->view('web/ad_view_web');
        $this->load->view('web/layout/footer_web');
    }
    
    //advertisement add form open
    public function ads_add(){
        $this->session->set_userdata('img',array());
        
        $data['tital'] = $this->lang->line('advertisement');
        $data['user_list'] = $this->Advertisement->get_all_user();
        $this->load->view('admin/layout/header_view', $data);
        $this->load->view('admin/advertisement/advertisement_new');
        $this->load->view('admin/layout/footer_view');
    }


    public function createAds(){
        $advertiserid = $this->input->post('userid');
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
                        'AdsType'=>$adsType,
                        'StatusID'=>1,
                        'LatLong'=>$latLong,
                        'CreatedBy'=>  $this->session->userdata('log_id'),
		);
               // print_r($data); exit();
		$createdID = $this->Advertisement->insertAds($data);
                
                //create ad then ajax to insert photo then submit time insert database
                foreach ($this->session->userdata['img'] as $count=> $row):
                        $imageData = array(
                            'AdsID'=>$createdID,
                            'Images'=>  $this->session->userdata['img'][$count]
                        );
                        $this->Advertisement->insert_image($imageData);
                endforeach;
//		$imagestatus = "init";
//		if($createdID && isset($_FILES['images']['name'])){
//			$imagestatus="enter method";
//			$this->load->library('upload');
//    		$dataInfo = array();
//    		$files = $_FILES;
//    		$cpt = count($_FILES['images']['name']);
//    		$config = array();
//    		$config['upload_path'] = './uploads/ads/';
//    		$config['allowed_types'] = 'jpg|jpeg|png|gif';
//    		$config['max_size']      = '0';
//    		$config['overwrite']     = FALSE;  
//    		$config['encrypt_name'] = true;
//    		for($i=0; $i<$cpt; $i++)
//                    {          
//                        $_FILES['images']['name']= $files['images']['name'][$i];
//                        $_FILES['images']['type']= $files['images']['type'][$i];
//                        $_FILES['images']['tmp_name']= $files['images']['tmp_name'][$i];
//                        $_FILES['images']['error']= $files['images']['error'][$i];
//                        $_FILES['images']['size']= $files['images']['size'][$i];
//                        $config['file_name'] = $_FILES['images']['name'][$i];  
//
//                        $this->upload->initialize($config);
//                        if(!$this->upload->do_upload('images')){
//                                $imagestatus=$this->upload->display_errors();;
//                        }
//                        else{
//                                $imagestatus="upload complete";
//                        }
//                        $dataInfo[] = $this->upload->data();
//                    }
//    		for($i=0; $i<count($dataInfo); $i++)
//                    {
//                        $img = $dataInfo[$i]['file_name'];
//                        $imageData = array(
//                                'AdsID'=>$createdID,
//                                'Images'=>$img,
//                                'StatusID'=>1,
//                        );
//                        $this->Advertisement->insert_image($imageData);
//                    }
//		}
		$videostatus="init";
		if (!empty($_FILES['video']['name'])) {
			$videostatus="enter method";
			$config['upload_path'] ='./uploads/video/';
			$config['allowed_types'] = 'wmv|mp4|avi|mov';
			$config['max_size'] = '0';
			$config['max_filename'] = '255';
			$config['encrypt_name'] = true;
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
                    $this->Advertisement->insert_video($createdID,$video);
		}
                
                //if youtube link insert data then
                if(!empty($this->input->post('youtube_link'))){
                    $video = $this->input->post('youtube_link');
                    $this->Advertisement->insert_video($id,$video);
                }
                $this->session->unset_userdata('img');
		$this->session->set_flashdata('success_msg','Create New Ad successfully.');
                 redirect('admin/advertisement/add');
        
    }
    
    public function editAds($id=0){
        $data['tital'] = 'Edit Advertisement';
        $data['user_list'] = $this->Advertisement->get_all_user();
        $data['ads'] = $this->Advertisement->get_ads_byID($id);
        if(!empty($data['ads'])){
        $data['category'] = $this->Advertisement->get_category_byID($data['ads']->CategID);
        $data['images'] = $this->Advertisement->get_all_img_byID($data['ads']->ID);
        }
        $this->load->view('admin/layout/header_view', $data);
        $this->load->view('admin/advertisement/advertisement_edit');
        $this->load->view('admin/layout/footer_view');
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
    
    //update advertisement
    public function updateAds(){
        $id = $this->input->post('id');
        $advertiserid = $this->input->post('userid');
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
//        $dial_cell_code = '+'.$this->input->post('dial-code-cell').$this->input->post('cellNo');
        $dial_cell_code = $this->input->post('cellNo');
        $cellNo = $dial_cell_code;
        $cellNoShow = $this->input->post('cellNoShow');
        
        $dial_cell_code = $this->input->post('dial-code-cell');
//        $dial_wt_code = '+'.$this->input->post('dial-code-wt').$this->input->post('whatsappNo');
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
                        'AdsType'=>$adsType,
                        //'StatusID'=>1,
                        'LatLong'=>$latLong,
                        'LastModifiedBy'=> $this->session->userdata('log_id'),
                        'LastModifiedDT'=>  date('Y-m-d H:i:s')
		);
              //  print_r($data); exit();
		$updateStatus = $this->Advertisement->updateAds($id,$data);
//		$imagestatus="init";
//		if(!empty($_FILES['images']['name'])){
//			$imagestatus="enter method";
//			$this->load->library('upload');
//    		$dataInfo = array();
//    		$files = $_FILES;
//    		$cpt = count($_FILES['images']['name']);
//    		$config = array();
//    		$config['upload_path'] 	 = './uploads/ads/';
//    		$config['allowed_types'] = 'jpg|jpeg|png|gif';
//    		//$config['max_size']      = '0';
//    		$config['overwrite']     = FALSE;  
//    		$config['encrypt_name']  = true;
//               
//    		for($i=0; $i<$cpt; $i++){
//                    $_FILES['images']['name']= $files['images']['name'][$i];
//                    $_FILES['images']['type']= $files['images']['type'][$i];
//                    $_FILES['images']['tmp_name']= $files['images']['tmp_name'][$i];
//                    $_FILES['images']['error']= $files['images']['error'][$i];
//                    $_FILES['images']['size']= $files['images']['size'][$i];
//                    $config['file_name'] = $_FILES['images']['name'][$i];  
//
//                    $this->upload->initialize($config);
//                    if(!$this->upload->do_upload('images')){
//                           $imagestatus=$this->upload->display_errors();;
//                    }
//                    else{
//                            $imagestatus="upload complete";
//                    }
//                    $dataInfo[] = $this->upload->data();
//                }
//                for($i=0; $i<count($dataInfo); $i++)
//                            {
//                                $img = $dataInfo[$i]['file_name'];
//                                if(!empty($img)){
//                                $imageData = array(
//                                        'AdsID'=>$id,
//                                        'Images'=>$img,
//                                        'StatusID'=>1,
//                                );
//                                    $this->Advertisement->insert_image($imageData);
//                                }
//                            }
//                    
//		}
  
//		$videostatus="init";
		if (!empty($_FILES['video_link']['name'])) {
                    //if change video then overright
                    $ads_data = $this->Advertisement->get_ads_byID($id);
                        $path = './uploads/video/';
                        unlink($path.$ads_data->Video);
			$config['upload_path'] ='./uploads/video/';
			$config['allowed_types'] = 'wmv|mp4|avi|mov';
			$config['max_size'] = '0';
			$config['max_filename'] = '255';
			$config['encrypt_name'] = true;
                        $config['overwrite']     = FALSE;  
			$video_data = array();
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
                            if ($this->upload->do_upload('video_link')) {
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
		$this->session->set_flashdata('success_msg','Update Ad successfully.');
                redirect('admin/advertisement/edit/'.$id);
    }


    //panding ads
    public function pendingAds(){
        $data['tital'] = 'Pending Advertisement';
        $data['ads_list'] = $this->Advertisement->get_pendingAds();
        $this->load->view('admin/layout/header_view', $data);
        $this->load->view('admin/advertisement/advertisement_pending');
        $this->load->view('admin/layout/footer_view');
    }
    public function editAdsList(){
        $data['tital'] = 'Edit Advertisement';
        $data['table_name'] = 'Edit Advertisement';
        $data['ads_list'] = $this->Advertisement->get_editAds();
        $this->load->view('admin/layout/header_view', $data);
        $this->load->view('admin/advertisement/advertisement_edit_table');
        $this->load->view('admin/layout/footer_view');
    }
    //panding ads
    public function due_paymentAds(){
        $data['tital'] = 'Pending Payment Advertisement';
        $data['ads_list'] = $this->Advertisement->get_disapproveAds(6);
        $this->load->view('admin/layout/header_view', $data);
        $this->load->view('admin/advertisement/advertisement_pending_payment');
        $this->load->view('admin/layout/footer_view');
    }
    //expired ads
    public function expiredAds(){
        $data['tital'] = 'Expired Advertisement';
        $data['table_name'] = 'Expired Advertisement';
        $data['ads_list'] = $this->Advertisement->get_expiredAds();
        $this->load->view('admin/layout/header_view', $data);
        $this->load->view('admin/advertisement/advertisement_expired');
        $this->load->view('admin/layout/footer_view');
    }
    //disapprove ads
    public function disapproveAds(){
        $data['tital'] = 'Disapprove Advertisement';
        $data['table_name'] = 'Disapproved Advertisement';
        $data['ads_list'] = $this->Advertisement->get_disapproveAds(4);
        $this->load->view('admin/layout/header_view', $data);
        $this->load->view('admin/advertisement/advertisement_disapprove');
        $this->load->view('admin/layout/footer_view');
    }
    
    //free ads table view in sidebar ads list
    public function free_ads_list(){
        $data['tital'] = 'Free Advertisement Post';
        $data['free_ads_list'] = $this->Advertisement->get_free_ads();
        $this->load->view('admin/layout/header_view', $data);
        $this->load->view('admin/advertisement/free/free_advertisement_list', $data);
        $this->load->view('admin/layout/footer_view');
    }
    
        
    //admin panel in top right side to click free ads then call function and open free ads page
    public function free_ads(){
        $this->session->set_userdata('img',array());
        
        $data['tital'] = 'Free Advertisement Post';
        $this->load->view('admin/layout/header_view', $data);
        $this->load->view('admin/advertisement/free/free_advertisement');
        $this->load->view('admin/layout/footer_view');
    }
    
    public function free_ads_create() {
       // $advertiserid = $this->input->post('userid');
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
                        //'AdsType'=>$adsType,
                        'StatusID'=>1,
                        'LatLong'=>$latLong,
		);
               // print_r($data); exit();
		$createdID = $this->Advertisement->insertAds($data);
                //create ad then ajax to insert photo then submit time insert database
                foreach ($this->session->userdata['img'] as $count=> $row):
                    $imageData = array(
                        'AdsID'=>$createdID,
                        'Images'=>  $this->session->userdata['img'][$count]
                    );
                    $this->Advertisement->insert_image($imageData);
                endforeach;
//		$imagestatus = "init";
//		if($createdID && isset($_FILES['images']['name'])){
//			$imagestatus="enter method";
//			$this->load->library('upload');
//    		$dataInfo = array();
//    		$files = $_FILES;
//    		$cpt = count($_FILES['images']['name']);
//    		$config = array();
//    		$config['upload_path'] = './uploads/ads/';
//    		$config['allowed_types'] = 'jpg|jpeg|png|gif';
//    		$config['max_size']      = '0';
//    		$config['overwrite']     = FALSE;  
//    		$config['encrypt_name'] = true;
//    		for($i=0; $i<$cpt; $i++)
//    			{           
//        			$_FILES['images']['name']= $files['images']['name'][$i];
//        			$_FILES['images']['type']= $files['images']['type'][$i];
//        			$_FILES['images']['tmp_name']= $files['images']['tmp_name'][$i];
//        			$_FILES['images']['error']= $files['images']['error'][$i];
//        			$_FILES['images']['size']= $files['images']['size'][$i];
//        			$config['file_name'] = $_FILES['images']['name'][$i];  
//
//        			$this->upload->initialize($config);
//        			if(!$this->upload->do_upload('images')){
//					$imagestatus=$this->upload->display_errors();;
//        			}
//        			else{
//        				$imagestatus="upload complete";
//        			}
//        			$dataInfo[] = $this->upload->data();
//    			}
//    		for($i=0; $i<count($dataInfo); $i++)
//    			{
//                            $img = $dataInfo[$i]['file_name'];
//                            if(!empty($img)){
//                                $imageData = array(
//                                    'AdsID'=>$createdID,
//                                    'Images'=>$img,
//                                    'StatusID'=>1,
//                                );
//                                $this->Advertisement->insert_image($imageData);
//                            }
//    			}
//		}
		$videostatus="init";
		if (!empty($_FILES['video_link']['name'])) {
			$videostatus="enter method";
			$config['upload_path'] ='./uploads/video/';
			$config['allowed_types'] = 'wmv|mp4|avi|mov';
			$config['max_size'] = '0';
			$config['max_filename'] = '255';
			$config['encrypt_name'] = true;
			$video_data = array();
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			 if ($this->upload->do_upload('video_link')) {
                                $uploadData = $this->upload->data();
                                $video = $uploadData['file_name'];
                            } else {
                                $video = NULL;
                            }
            //store the video file info
                    $this->Advertisement->insert_video($createdID,$video);
                }else{
                    $video = $this->input->post('youtube_link');
                    $this->Advertisement->insert_video($id,$video);
                }
                //if youtube link insert data then
//                if(!empty($this->input->post('youtube_link'))){
//                    $video = $this->input->post('youtube_link');
//                    $this->Advertisement->insert_video($id,$video);
//                }
                $this->session->unset_userdata('img');
		$this->session->set_flashdata('success_msg','Create New Ad successfully.');
                 redirect('admin/free_ad');
    }
    
    //free ads Edit function then click butoon edit then 
    public function edit_free_ad($id=0){
        $data['tital'] = 'Free Advertisement Post Edit';
        $data['free_ad'] = $this->Advertisement->get_free_ad_byID($id);
        if(!empty($data['free_ad'])){
        $data['category'] = $this->Advertisement->get_category_byID($data['free_ad']->CategID);
        $data['images'] = $this->Advertisement->get_all_img_byID($data['free_ad']->ID);
        }
        $this->load->view('admin/layout/header_view', $data);
        $this->load->view('admin/advertisement/free/free_advertisement_edit', $data);
        $this->load->view('admin/layout/footer_view');
    }
    
    public function edit_free_ad_update() {
        $id = $this->input->post('id');
       // $advertiserid = $this->input->post('userid');
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
        $dial_cell_code = $this->input->post('dial-code-cell').$this->input->post('cellNo');
        $cellNo = $dial_cell_code;
        $cellNoShow = $this->input->post('cellNoShow');
        
        $dial_cell_code = $this->input->post('dial-code-cell');
        $dial_wt_code = $this->input->post('dial-code-wt').$this->input->post('whatsappNo');
        $whatsappNo = $dial_wt_code;
        $whatsappNoShow = $this->input->post('whatsappNoShow');
		//$payStatus = $this->input->post('payStatus');
		//$adsType = $this->input->post('adsType');
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
                        //'AdsType'=>$adsType,
                        //'StatusID'=>1,
                        'LatLong'=>$latLong,
                        'LastModifiedBy'=> $this->session->userdata('log_id'),
                        'LastModifiedDT'=>  date('Y-m-d H:i:s')
		);
                //print_r($data); exit();
		$updateStatus = $this->Advertisement->updateAds($id,$data);
//		$imagestatus="init";
//		if(!empty($_FILES['images']['name'])){
//			$imagestatus="enter method";
//			$this->load->library('upload');
//    		$dataInfo = array();
//    		$files = $_FILES;
//    		$cpt = count($_FILES['images']['name']);
//    		$config = array();
//    		$config['upload_path'] 	 = './uploads/ads/';
//    		$config['allowed_types'] = 'jpg|jpeg|png|gif';
//    		//$config['max_size']      = '0';
//    		$config['overwrite']     = FALSE;  
//    		$config['encrypt_name']  = true;
//               
//    		for($i=0; $i<$cpt; $i++){
//                    $_FILES['images']['name']= $files['images']['name'][$i];
//                    $_FILES['images']['type']= $files['images']['type'][$i];
//                    $_FILES['images']['tmp_name']= $files['images']['tmp_name'][$i];
//                    $_FILES['images']['error']= $files['images']['error'][$i];
//                    $_FILES['images']['size']= $files['images']['size'][$i];
//                    $config['file_name'] = $_FILES['images']['name'][$i];  
//
//                    $this->upload->initialize($config);
//                    if(!$this->upload->do_upload('images')){
//                           $imagestatus=$this->upload->display_errors();;
//                    }
//                    else{
//                            $imagestatus="upload complete";
//                    }
//                    $dataInfo[] = $this->upload->data();
//                }
//                for($i=0; $i<count($dataInfo); $i++)
//                            {
//                                $img = $dataInfo[$i]['file_name'];
//                                if(!empty($img)){
//                                $imageData = array(
//                                        'AdsID'=>$id,
//                                        'Images'=>$img,
//                                        'StatusID'=>1,
//                                    );
//                                    $this->Advertisement->insert_image($imageData);
//                                }
//                            }
//                    
//		}
  
//		$videostatus="init";
		if (!empty($_FILES['video_link']['name'])) {
                    //if change video then overright
                    $ads_data = $this->Advertisement->get_ads_byID($id);
                        $path = './uploads/video/';
                        unlink($path.$ads_data->Video);
			$config['upload_path'] ='./uploads/video/';
			$config['allowed_types'] = 'wmv|mp4|avi|mov';
			$config['max_size'] = '0';
			$config['max_filename'] = '255';
			$config['encrypt_name'] = true;
                        $config['overwrite']     = FALSE;  
			$video_data = array();
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
                            if ($this->upload->do_upload('video_link')) {
                                $uploadData = $this->upload->data();
                                $video = $uploadData['file_name'];
                            } else {
                                $video = NULL;
                            }
            //store the video file info
                    $this->Advertisement->insert_video($id,$video);
                }else{
                    $video = $this->input->post('youtube_link');
                    $this->Advertisement->insert_video($id,$video);
                }
                //if youtube link insert data then
//                if(!empty($this->input->post('youtube_link'))){
//                    $video = $this->input->post('youtube_link');
//                    $this->Advertisement->insert_video($id,$video);
//                }
		$this->session->set_flashdata('success_msg','Update Ad successfully.');
                redirect('admin/advertisement/free-ad-edit/'.$id);
    }
    
    //this function to if edit button to click free ads list in then cateig store in Advertisement table but Name get to Category table then ajax call and name show
    public function get_category(){
        $id = $this->input->post('id');
        if($id){
            $data = $this->Advertisement->get_category_byID($id);
            echo $data->Name;
        }
    }
    
    //free ad change status and Paid ads datatable use
    public function change_status(){
        $id = $this->input->post('id');
        $value = $this->input->post('value');
        
        if($id){
            //send mail pending ads to approve and disapprove
            if($value == 1){ //approve ads
                $key = $this->Advertisement->get_ads_mail_via_id($id);
                        $subject = "Your ad is activated";
                        $mail_data_ad['name'] = $key->FirstName.' '.$key->LastName;
                        $mail_data_ad['b_name'] = $key->BusinessName;
                        $mail_data_ad['b_title'] = $key->CaptionLine;
                        $mail_data_ad['email'] = $key->Email;//'dileeplohar@gmail.com';
                        $mail_data_ad['phone'] = $key->CellNo;
                        $mail_data_ad['address'] = $key->BusinessAddress;
                        $mail_data_ad['post_code'] = $key->PostCode;
                        $mail_data_ad['ad_id'] = $key->ID;
                        $mail_data_ad['msg_title'] = "Your ad is activated";
                        $mail_data_ad['msg'] = 'Your advertisement is activated. Please open url and check.';
                       // $this->load->view('admin/mail_msg/cron_reminder_mail', $mail_data_ad);
                        $message = $this->load->view('admin/mail_msg/active_deactive_ads_mail.php', $mail_data_ad, true);
                        $this->customlib->send_exp_remider($key->UserName, $message, $subject);
                //change status
                $data=array(
                    'StatusID'=> $value,
                    'LastModifiedBy'=> $this->session->userdata('log_id'),
                    'LastModifiedDT'=> date('Y-m-d H:i:s')
                );
            }else if($value == 4){ //disapprove ads
                $key = $this->Advertisement->get_ads_mail_via_id($id);
                    $subject = "Your ad is disapprove";
                    $mail_data_ad['name'] = $key->FirstName.' '.$key->LastName;
                    $mail_data_ad['b_name'] = $key->BusinessName;
                    $mail_data_ad['b_title'] = $key->CaptionLine;
                    $mail_data_ad['email'] = $key->Email;//'dileeplohar@gmail.com';
                    $mail_data_ad['phone'] = $key->CellNo;
                    $mail_data_ad['address'] = $key->BusinessAddress;
                    $mail_data_ad['post_code'] = $key->PostCode;
                    $mail_data_ad['ad_id'] = $key->ID;
                    $mail_data_ad['msg_title'] = "Your ad is disapprove";
                    $mail_data_ad['msg'] = 'Your advertisement is disapprove.';
                   // $this->load->view('admin/mail_msg/cron_reminder_mail', $mail_data_ad);
                    $message = $this->load->view('admin/mail_msg/active_deactive_ads_mail.php', $mail_data_ad, true);
                    $this->customlib->send_exp_remider($key->UserName, $message, $subject);
            
                //change status
                $data=array(
                    'StatusID'=> $value,
                    'LastModifiedBy'=> $this->session->userdata('log_id'),
                    'LastModifiedDT'=> date('Y-m-d H:i:s')
                );
            }else if($value == 3){
                //change status
                $data=array(
                    'StatusID'=> $value,
                    'DeletedBy'=> $this->session->userdata('log_id'),
                    'DeletedDT'=> date('Y-m-d H:i:s')
                );
            }else{
                //change status
                $data=array(
                    'StatusID'=> $value,
                    'LastModifiedBy'=> $this->session->userdata('log_id'),
                    'LastModifiedDT'=> date('Y-m-d H:i:s')
                );
            }
            
            $result = $this->Advertisement->free_ads_change_status($id, $data);
            if($result){
                echo $result;
            }
        }
    }
}