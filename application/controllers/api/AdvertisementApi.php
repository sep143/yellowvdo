<?php

ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//include Rest Controller library
require APPPATH . '/libraries/REST_Controller.php';

class AdvertisementApi extends REST_Controller {

    public function __construct($config = 'rest') {
        header('Access-Control-Allow-Origin: *');
        //header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        parent::__construct();
        //load user model
        $this->load->library('customlib');
        $this->load->library('youtubeapi');
        $this->load->model('api/AdvertisementApi_model', 'Advertisement');
        $this->load->model('Payment_model','Payment2');
        $this->admin_mail = 'satish.office2018@gmail.com';
    }

    public function review_get() {
        $review = $this->Advertisement->get_review($this->get('id'), $this->get('limit'), $this->get('offset'));
        if ($review) {
            $this->response([
                'status' => true,
                'review' => $review
                    ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => "server error please try again later"
                    ], 200);
        }
    }

    public function deleteAdvertisement_post() {
        $id = $this->post('id');
        $status = $this->Advertisement->deleteAds($id);
        if ($status) {
            $this->response([
                'status' => true,
                'message' => "Deleted successfully"
                    ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => "server error please try again later"
                    ], 200);
        }
    }

    public function updateAdvertisement_post() {
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
        //$countryCode = $this->input->post('countryCode');
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
        $cellNo = $this->input->post('cellNo');
        $cellNoShow = $this->input->post('cellNoShow');
        $whatsappNo = $this->input->post('whatsappNo');
        $whatsappNoShow = $this->input->post('whatsappNoShow');
        $payStatus = $this->input->post('payStatus');
        $adsType = $this->input->post('adsType');
        $removeImages = $this->input->post('removeImages');
        $latlong = $this->input->post('latlong');
        $landmark = $this->input->post('landmark');
        $landmarkShow = $this->input->post('landmarkShow');
        
        $ads_data = $this->Advertisement->get_ads_byID($advertiserid, $id);
        $status = 2;
        if($ads_data->StatusID == 6){
            $status = 6;
        }
        
        $data = array(
            'UserID' => $advertiserid,
            'CategID' => $categoryid,
            'BusinessName' => $businessname,
            'CaptionLine' => $captionLine,
            'Keyword' => $keyword,
            'Description' => $description,
            'LatLong' => $latlong,
            'Url1' => $url1,
            'Url1Show' => $url1Show,
            'Url2' => $url2,
            'Url2Show' => $url2Show,
            'Url3' => $url3,
            'Url3Show' => $url3Show,
            'Url4' => $url4,
            'Url4Show' => $url4Show,
            'Url5' => $url5,
            'Url5Show' => $url5Show,
            //'CountryCode'=>$countryCode,
            'BusinessAddress' => $businessAddress,
            'LandmarkAddress' => $landmark,
            'LandmarkAddressShow' => $landmarkShow,
            'BusinessAddressShow' => $businessAddressShow,
            'City' => $city,
            'CityShow' => $cityShow,
            'State' => $state,
            'StateShow' => $stateShow,
            'Country' => $country,
            'CountryShow' => $countryShow,
            'PostCode' => $postCode,
            'PostCodeShow' => $postCodeShow,
            'Email' => $email,
            'EmailShow' => $emailShow,
            'LandLine' => $landLine,
            'LandLineShow' => $landLineShow,
            'CellNo' => $cellNo,
            'CellNoShow' => $cellNoShow,
            'WhatsAppNo' => $whatsappNo,
            'WhatsAppNoShow' => $whatsappNoShow,
            'PayStatus' => $payStatus,
            'AdsType' => $adsType,
            'StatusID' => $status,
            'LastModifiedDT'=> date('Y-d-m H:i:s'),
            'LastModifiedBy'=>$advertiserid
        );
        $updateStatus = $this->Advertisement->updateAds($id, $data);
        $imagestatus = "init";
        if ($updateStatus && isset($_FILES['images']['name'])) {
            $imagestatus = "enter method";
            $this->load->library('upload');
            $dataInfo = array();
            $files = $_FILES;
            $cpt = count($_FILES['images']['name']);
            $config = array();
            $config['upload_path'] = './uploads/ads/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = '0';
            $config['overwrite'] = FALSE;
            $config['encrypt_name'] = true;
            for ($i = 0; $i < $cpt; $i++) {
                $_FILES['images']['name'] = $files['images']['name'][$i];
                $_FILES['images']['type'] = $files['images']['type'][$i];
                $_FILES['images']['tmp_name'] = $files['images']['tmp_name'][$i];
                $_FILES['images']['error'] = $files['images']['error'][$i];
                $_FILES['images']['size'] = $files['images']['size'][$i];
                $config['file_name'] = $_FILES['images']['name'][$i];

                $this->upload->initialize($config);
                if (!$this->upload->do_upload('images')) {
                    $imagestatus = $this->upload->display_errors();
                    
                } else {
                    $data = array('upload_data' => $this->upload->data());
                    $this->resizeImage($data);
                    $imagestatus = "upload complete";
                }
                $dataInfo[] = $this->upload->data();
            }
            for ($i = 0; $i < count($dataInfo); $i++) {
                $img = $dataInfo[$i]['file_name'];
                $imageData = array(
                    'AdsID' => $id,
                    'Images' => $img,
                    'StatusID' => 1,
                );
                $this->Advertisement->insert_image($imageData);
            }
        }
        //$removeimg=false;
        if ($updateStatus && $this->input->post('removeImages')) {

            $cpt = count($removeImages);
            for ($i = 0; $i < $cpt; $i++) {
                $removeimg = $removeImages[$i];
                $removeimg = explode("/", $removeimg);
                $this->Advertisement->delete_image($removeimg[sizeof($removeimg) - 1]);
            }
        }
        $videostatus = "init";
        if ($updateStatus && isset($_FILES['video']['name'])) {
            $videostatus = "enter method";
            $config['upload_path'] = './uploads/video/';
            $config['allowed_types'] = 'wmv|mp4|avi|mov';
            $config['max_size'] = '0';
            $config['max_filename'] = '255';
            $config['encrypt_name'] = true;
            $video_data = array();
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('video')) {
                $videostatus = $this->upload->display_errors();
            } else {
                //store the video file info
                $videostatus = "upload complete";
                $video_data = $this->upload->data();
                $videoData = $video_data['file_name'];
                $this->Advertisement->insert_video($id, $videoData);
            }
        }else if(!empty($this->input->post('youtube_video'))){
            $videostatus = "upload complete";
            $videoData = $this->input->post('youtube_video');
            $this->Advertisement->insert_video($updateStatus, $videoData);
        }
        if ($updateStatus) {
            $this->response([
                'status' => true,
                'message' => 'Profile updated successfully',
                'videostatus' => $videostatus,
                'imagestatus' => $imagestatus,
                    ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'server error please try again later',
                    ], 200);
        }
    }
    
    /**
    * Manage uploadImage
    *
    * @return Response
   */
   public function resizeImage($filename)
   {
      $path=$filename['upload_data']['full_path'];
      $q['name']=$filename['upload_data']['file_name'];
      $target_path = './uploads/ads/_thumb/';
//      $source_path = $_SERVER['DOCUMENT_ROOT'] .'./uploads/ads/' . $filename;
//      $target_path = $_SERVER['DOCUMENT_ROOT'] .'./uploads/ads/_thumb/';
      $config_manip = array(
          'image_library' => 'gd2',
          'source_image' => $path,
          'new_image' => $target_path,
          'maintain_ratio' => TRUE,
         // 'create_thumb' => TRUE,
         // 'thumb_marker' => '_thumb',
          'width' => 220,
          'height' => 220
      );

      $this->load->library('image_lib', $config_manip);
      $this->image_lib->initialize($config_manip);
      if (!$this->image_lib->resize()) {
          echo $this->image_lib->display_errors();
      }
      $this->image_lib->clear();
   }
   

    public function createAdvertisement_post() {
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
        //$countryCode = $this->input->post('countryCode');
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
        $cellNo = $this->input->post('cellNo');
        $cellNoShow = $this->input->post('cellNoShow');
        $whatsappNo = $this->input->post('whatsappNo');
        $whatsappNoShow = $this->input->post('whatsappNoShow');
        $payStatus = $this->input->post('payStatus');
        $adsType = $this->input->post('adsType');
        $latlong = $this->input->post('latlong');
        $landmark = $this->input->post('landmark');
        $landmarkShow = $this->input->post('landmarkShow');
        $accountType = $this->input->post('account_type');
        $status = 6;
        if($accountType == 0){
            $status = 0;
        }
        $data = array(
            'UserID' => $advertiserid,
            'CategID' => $categoryid,
            'BusinessName' => $businessname,
            'CaptionLine' => $captionLine,
            'Keyword' => $keyword,
            'Description' => $description,
            'LatLong' => $latlong,
            'Url1' => $url1,
            'Url1Show' => $url1Show,
            'Url2' => $url2,
            'Url2Show' => $url2Show,
            'Url3' => $url3,
            'Url3Show' => $url3Show,
            'Url4' => $url4,
            'Url4Show' => $url4Show,
            'Url5' => $url5,
            'Url5Show' => $url5Show,
            //'CountryCode'=>$countryCode,
            'BusinessAddress' => $businessAddress,
            'LandmarkAddress' => $landmark,
            'LandmarkAddressShow' => $landmarkShow,
            'BusinessAddressShow' => $businessAddressShow,
            'City' => $city,
            'CityShow' => $cityShow,
            'State' => $state,
            'StateShow' => $stateShow,
            'Country' => $country,
            'CountryShow' => $countryShow,
            'PostCode' => $postCode,
            'PostCodeShow' => $postCodeShow,
            'Email' => $email,
            'EmailShow' => $emailShow,
            'LandLine' => $landLine,
            'LandLineShow' => $landLineShow,
            'CellNo' => $cellNo,
            'CellNoShow' => $cellNoShow,
            'WhatsAppNo' => $whatsappNo,
            'WhatsAppNoShow' => $whatsappNoShow,
            'PayStatus' => $payStatus,
            'AdsType' => $adsType,
            'StatusID' => $status,
            'CreatedBy'=>$advertiserid
        );

        $createdID = $this->Advertisement->insertAds($data);
        $imagestatus = "init";
        if ($createdID && isset($_FILES['images']['name'])) {
            $imagestatus = "enter method";
            $this->load->library('upload');
            $dataInfo = array();
            $files = $_FILES;
            $cpt = count($_FILES['images']['name']);
            $config = array();
            $config['upload_path'] = './uploads/ads/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = '0';
            $config['overwrite'] = FALSE;
            $config['encrypt_name'] = true;
            for ($i = 0; $i < $cpt; $i++) {
                $_FILES['images']['name'] = $files['images']['name'][$i];
                $_FILES['images']['type'] = $files['images']['type'][$i];
                $_FILES['images']['tmp_name'] = $files['images']['tmp_name'][$i];
                $_FILES['images']['error'] = $files['images']['error'][$i];
                $_FILES['images']['size'] = $files['images']['size'][$i];
                $config['file_name'] = $_FILES['images']['name'][$i];

                $this->upload->initialize($config);
                if (!$this->upload->do_upload('images')) {
                    $imagestatus = $this->upload->display_errors();
                    ;
                } else {
                    $data = array('upload_data' => $this->upload->data());
                    $this->resizeImage($data);
                    $imagestatus = "upload complete";
                }
                $dataInfo[] = $this->upload->data();
            }
            for ($i = 0; $i < count($dataInfo); $i++) {
                $img = $dataInfo[$i]['file_name'];
                $imageData = array(
                    'AdsID' => $createdID,
                    'Images' => $img,
                    'StatusID' => 1,
                );
                $this->Advertisement->insert_image($imageData);
            }
        }
        $videostatus = "init";
        if ($createdID && isset($_FILES['video']['name'])) {
            $videostatus = "enter method";
            $config['upload_path'] = './uploads/video/';
            $config['allowed_types'] = 'wmv|mp4|avi|mov';
            $config['max_size'] = '0';
            $config['max_filename'] = '255';
            $config['encrypt_name'] = true;
            $video_data = array();
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('video')) {
                $videostatus = $this->upload->display_errors();
            } else {
                //store the video file info
                $videostatus = "upload complete";
                $video_data = $this->upload->data();
                $videoData = $video_data['file_name'];
                $this->Advertisement->insert_video($createdID, $videoData);
            }
        }else{
            $videostatus = "upload complete";
            $videoData = $this->input->post('youtube_video');
            $this->Advertisement->insert_video($createdID, $videoData);
        }
                       
        if ($createdID) {
            $this->response([
                'status' => true,
                'message' => 'Profile created successfully',
                'videostatus' => $videostatus,
                'imagestatus' => $imagestatus,
                'ad_id' => $createdID
                    ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'server error please try again later',
                    ], 200);
        }
    }

    public function advertisement_get() {
        $ads = null;
        $method = null;
        if ($this->get('id') !== NULL) {
            $method = 1;
            $ads = $this->Advertisement->get_adsbyid($this->get('id'), $this->get('limit'), $this->get('offset'));
        } else if ($this->get('search') !== NULL && $this->get('catid') !== NULL && $this->get('latlong') !== NULL && $this->get('popularity') !== NULL && $this->get('nearby') !== NULL && $this->get('recently') !== NULL) {
            $method = 5;
            $ads = $this->Advertisement->searchORsort($this->get('catid'), $this->get('search'), $this->get('latlong'), $this->get('limit'), $this->get('offset'), $this->get('popularity'), $this->get('nearby'), $this->get('recently'));
        } else if ($this->get('search') !== NULL && $this->get('catid') !== NULL && $this->get('location') !== NULL && $this->get('latlong') !== NULL) {
            $method = 2;
            $ads = $this->Advertisement->search_ads($this->get('catid'), $this->get('search'), $this->get('location'), $this->get('latlong'), $this->get('limit'), $this->get('offset'));
        } else if ($this->get('catid') !== NULL) {
            $method = 3;
            $ads = $this->Advertisement->get_adsbycategory($this->get('catid'), $this->get('limit'), $this->get('offset'));
        } else {
            $method = 4;
            $ads = $this->Advertisement->get_all_ads($this->get('limit'), $this->get('offset'));
        }
        $hint = array(
            'any show' => '0=Hide, 1=Show',
            'caption_line' => 'Ad Title ',
            'country_code' => '2 Digit Code ex. IN, US, AU etc.',
            'pay_status' => 'This ads payment successfully then 1 other wise 0=pending amount',
            'ads_type' => '0=Free ad, 1=Paid Ad',
            'statusID'=>'0= Pandding approve, 1= Admin aproved Active, 2= admin to Inactive, 3= Delete, 4= Disprove , 5=Expiry ads using cron, 6=Pending payment',
            'method' => $method
        );
        
        $defualt_payset = $this->Payment2->defaultSetUse(1); //1 = this table in ID = 1 pr fix value set rahegi 
        $payment = array(
            'amount'=>$defualt_payset->Amt,
            'tax_per'=>$defualt_payset->Tax,
            'tax'=> number_format((($defualt_payset->Amt * $defualt_payset->Tax)/100),2),
            'total_amt'=>$defualt_payset->Total
        );

        $data = array();
        foreach ($ads as $count => $value):
            $id = $value->ID;
            $image = $this->Advertisement->get_images_byID($id);
            $images = array();
            foreach ($image as $count2 => $value2) {
                $value2->Images = base_url() . 'uploads/ads/' . $value2->Images;
                $thumb_img = base_url() . 'uploads/ads/_thumb/' . $value2->Images;
                //$img = array('source' => array('uri'=>$value2->Images));
                $images[] = $value2->Images;
//                $images = array(
//                    $img = array(
//                        'img'=>$value2->Images,
//                    ),
//                    'thumb_img'=>$thumb_img,
//                    'img_id'=>$value2->ID
//                );
            }
            $review = $this->Advertisement->get_review($id, 3, 0);
            $reviews = array();
            foreach ($review as $i => $rev) {
                $reviews[] = $rev;
            }
            $adveriser = null;
            if ($value->UserID != NULL) {
                $adveriser = $this->Advertisement->get_advertiser($value->UserID);
                if ($adveriser->Profile != null && strpos($adveriser->Profile, 'http') === false){
                    $adveriser->Profile = base_url() . 'uploads/profile/' . $adveriser->Profile;
                }
                    
            }
            if ($value->Video != NULL && strpos($value->Video, 'http') === false) {
                $value->Video = base_url() . 'uploads/video/' . $value->Video;
            }
            
            if(strpos($value->Video, 'youtube') || strpos($value->Video, 'youtu.be')){
                $youtube = $this->youtubeapi->youtube_link($value->Video);
//                $json_youtube = json_decode($youtube);
                $youtube_get = json_decode($youtube);
                $value->Video = $youtube_get[0]->url;
            }
            //remove html tag in description
            $string_html = $value->Description;
            $description_without = preg_replace('/<[^<|>]+?>/', '', htmlspecialchars_decode($string_html));
            $description_without = htmlentities($description_without, ENT_QUOTES, "UTF-8");

            $obj = array(
                'id' => $value->ID,
                'advertiser_id' => $value->UserID,
                'category_id' => $value->CategID,
                'category_name' => $this->Advertisement->get_cat_byID($value->CategID),
                'business_name' => $value->BusinessName,
                'caption_line' => $value->CaptionLine,
                'keyword' => $value->Keyword,
                'description' => $description_without,
                'latlong' => $value->LatLong,
                'url1' => $value->Url1,
                'url1_show' => $value->Url1Show,
                'url2' => $value->Url2,
                'url2_show' => $value->Url2Show,
                'url3' => $value->Url3,
                'url3_show' => $value->Url3Show,
                'url4' => $value->Url4,
                'url4_show' => $value->Url4Show,
                'url5' => $value->Url5,
                'url5_show' => $value->Url5Show,
                //'country_code' => $value->CountryCode,
                'business_address' => $value->BusinessAddress,
                'landmark' => $value->LandmarkAddress,
                'landmark_show' => $value->LandmarkAddressShow,
                'business_address_show' => $value->BusinessAddressShow,
                'city' => $value->City,
                'city_show' => $value->CityShow,
                'state' => $value->State,
                'state_show' => $value->StateShow,
                'country' => $value->Country,
                'country_show' => $value->CountryShow,
                'post_code' => $value->PostCode,
                'post_code_show' => $value->PostCodeShow,
                'email_id' => $value->Email,
                'email_id_show' => $value->EmailShow,
                'land_line' => $value->LandLine,
                'land_line_show' => $value->LandLineShow,
                'cell_no' => $value->CellNo,
                'cell_no_show' => $value->CellNoShow,
                'whatsApp_no' => $value->WhatsAppNo,
                'whatsApp_no_show' => $value->WhatsAppNoShow,
                'video' => $value->Video,
                'pay_status' => $value->PayStatus,
                'ads_type' => $value->AdsType,
                'status_id' => $value->StatusID,
                'created_by' => $value->CreatedBy,
                'created_date' => $value->CreatedDT,
                'expiry_date' => $value->ExpiryDT,
                'last_modified_by' => $value->LastModifiedBy,
                'last_modified_date' => $value->LastModifiedDT,
                'deleted_by' => $value->DeletedBy,
                'deleted_date' => $value->DeletedDT,
                'images' => $images,
                'reviews' => $reviews,
                'starRating' => $this->Advertisement->get_rating($id),
                'advertiser' => $adveriser
            );
            $data[] = $obj;
        endforeach;

        $this->response([
            'status' => true,
            'Hint' => $hint,
            'ads' => $data,
            'payment'=>$payment
                ], 200);
    }

    //ads get by limit and order then
    public function adsfn_get($limit, $offset) {
        //this query use to limit and order to get
        $ads = $this->Advertisement->ads_get_value($limit, $offset);
        $data = array();
        foreach ($ads as $count => $value):
            $id = $value->ID;
            $image = $this->Advertisement->get_images_byID($id);
            $images = array();
            foreach ($image as $count2 => $value2) {
//                $img = array(
//                    'img'=> $value2->Images,
//                );
                $images[] = $value2->Images;
            }
            $hint = array(
                'any show' => '0=Hide, 1=Show',
                'caption_line' => 'Ad Title ',
                'country_code' => '2 Digit Code ex. IN, US, AU etc.',
                'pay_status' => 'This ads payment successfully then 1 other wise 0=pending amount',
                'ads_type' => '0=Free ad, 1=Paid Ad'
            );
            
            //remove html tag in description
            $string_html = $value->Description;
            $description_without = preg_replace('/<[^<|>]+?>/', '', htmlspecialchars_decode($value->Description));
            $description_without = htmlentities($description_without, ENT_QUOTES, "utf8_general_ci");
            //video link
            if ($value->Video != NULL && strpos($value->Video, 'http') === false) {
                $value->Video = base_url() . 'uploads/video/' . $value->Video;
            }
            
            if(strpos($value->Video, 'youtube') || strpos($value->Video, 'youtu.be')){
                $youtube = $this->youtubeapi->youtube_link($value->Video);
//                $json_youtube = json_decode($youtube);
                $youtube_get = json_decode($youtube);
                $value->Video = $youtube_get[0]->url;
            }
            $obj = array(
                'id' => $value->ID,
                'advertiser_id' => $value->UserID,
                'category_id' => $value->CategID,
                'business_name' => $value->BusinessName,
                'caption_line' => $value->CaptionLine,
                'keyword' => $value->Keyword,
                'description' => $description_without,
                'url1' => $value->Url1,
                'url1_show' => $value->Url1Show,
                'url2' => $value->Url2,
                'url2_show' => $value->Url2Show,
                'url3' => $value->Url3,
                'url3_show' => $value->Url3Show,
                'url4' => $value->Url4,
                'url4_show' => $value->Url4Show,
                'url5' => $value->Url5,
                'url5_show' => $value->Url5Show,
                //'country_code' => $value->CountryCode,
                'business_address' => $value->BusinessAddress,
                'business_address_show' => $value->BusinessAddressShow,
                'landmark' => $value->LandmarkAddress,
                'landmark_show' => $value->LandmarkAddressShow,
                'city' => $value->City,
                'city_show' => $value->CityShow,
                'state' => $value->State,
                'state_show' => $value->StateShow,
                'country' => $value->Country,
                'country_show' => $value->CountryShow,
                'post_code' => $value->PostCode,
                'post_code_show' => $value->PostCodeShow,
                'email_id' => $value->Email,
                'email_id_show' => $value->EmailShow,
                'land_line' => $value->LandLine,
                'land_line_show' => $value->LandLineShow,
                'cell_no' => $value->CellNo,
                'cell_no_show' => $value->CellNoShow,
                'whatsApp_no' => $value->WhatsAppNo,
                'whatsApp_no_show' => $value->WhatsAppNoShow,
                'video' => $value->Video,
                'pay_status' => $value->PayStatus,
                'ads_type' => $value->AdsType,
                'status_id' => $value->StatusID,
                'created_by' => $value->CreatedBy,
                'created_date' => $value->CreatedDT,
                'last_modified_by' => $value->LastModifiedBy,
                'last_modified_date' => $value->LastModifiedDT,
                'deleted_by' => $value->DeletedBy,
                'deleted_date' => $value->DeletedDT,
                'images' => $images,
                'Hint' => $hint
            );
            $data[] = $obj;
        endforeach;
//        $data=array(
//            'limit'=> $limit,
//            'order'=> $offset
//        );

        $this->response([
            'status' => true,
            'ads' => $data,
                ], 200);
    }
    
    //only get id 
    public function adget_get($adid) {
        $value = $this->Advertisement->get_ad_byID($adid);
        
        $id = $value->ID;
            $image = $this->Advertisement->get_images_byID($id);
            $images = array();
            foreach ($image as $count2 => $value2) {
                $value2->Images = base_url() . 'uploads/ads/' . $value2->Images;
                $thumb_img = base_url() . 'uploads/ads/_thumb/' . $value2->Images;
                //$img = array('source' => array('uri'=>$value2->Images));
                $images[] = $value2->Images;
//                $images = array(
//                    $img = array(
//                        'img'=>$value2->Images,
//                    ),
//                    'thumb_img'=>$thumb_img,
//                    'img_id'=>$value2->ID
//                );
            }
            
            $review = $this->Advertisement->get_review($id, 3, 0);
            $reviews = array();
            foreach ($review as $i => $rev) {
                $reviews[] = $rev;
            }
            
            $adveriser = null;
            if ($value->UserID != NULL) {
                $adveriser = $this->Advertisement->get_advertiser($value->UserID);
                if ($adveriser->Profile != null && strpos($adveriser->Profile, 'http') === false)
                    $adveriser->Profile = base_url() . 'uploads/profile/' . $adveriser->Profile;
            }
            
            if ($value->Video != NULL && strpos($value->Video, 'http') === false) {
                $value->Video = base_url() . 'uploads/video/' . $value->Video;
            }
            
            if(strpos($value->Video, 'youtube') || strpos($value->Video, 'youtu.be')){
                $youtube = $this->youtubeapi->youtube_link($value->Video);
//                $json_youtube = json_decode($youtube);
                $youtube_get = json_decode($youtube);
                $value->Video = $youtube_get[0]->url;
            }
            
            //remove html tag in description
            $string_html = $value->Description;
            $description_without = preg_replace('/<[^<|>]+?>/', '', htmlspecialchars_decode($value->Description));
            $description_without = htmlentities($description_without, ENT_QUOTES, "UTF-8");
        $data = array(
                'id' => $value->ID,
                'advertiser_id' => $value->UserID,
                'category_id' => $value->CategID,
                'category_name' => $this->Advertisement->get_cat_byID($value->CategID),
                'business_name' => $value->BusinessName,
                'caption_line' => $value->CaptionLine,
                'keyword' => $value->Keyword,
                'description' => $description_without,
                'latlong' => $value->LatLong,
                'url1' => $value->Url1,
                'url1_show' => $value->Url1Show,
                'url2' => $value->Url2,
                'url2_show' => $value->Url2Show,
                'url3' => $value->Url3,
                'url3_show' => $value->Url3Show,
                'url4' => $value->Url4,
                'url4_show' => $value->Url4Show,
                'url5' => $value->Url5,
                'url5_show' => $value->Url5Show,
                //'country_code' => $value->CountryCode,
                'business_address' => $value->BusinessAddress,
                'landmark' => $value->LandmarkAddress,
                'landmark_show' => $value->LandmarkAddressShow,
                'business_address_show' => $value->BusinessAddressShow,
                'city' => $value->City,
                'city_show' => $value->CityShow,
                'state' => $value->State,
                'state_show' => $value->StateShow,
                'country' => $value->Country,
                'country_show' => $value->CountryShow,
                'post_code' => $value->PostCode,
                'post_code_show' => $value->PostCodeShow,
                'email_id' => $value->Email,
                'email_id_show' => $value->EmailShow,
                'land_line' => $value->LandLine,
                'land_line_show' => $value->LandLineShow,
                'cell_no' => $value->CellNo,
                'cell_no_show' => $value->CellNoShow,
                'whatsApp_no' => $value->WhatsAppNo,
                'whatsApp_no_show' => $value->WhatsAppNoShow,
                'video' => $value->Video,
                'pay_status' => $value->PayStatus,
                'ads_type' => $value->AdsType,
                'status_id' => $value->StatusID,
                'created_by' => $value->CreatedBy,
                'created_date' => $value->CreatedDT,
                'expiry_date' => $value->ExpiryDT,
                'last_modified_by' => $value->LastModifiedBy,
                'last_modified_date' => $value->LastModifiedDT,
                'deleted_by' => $value->DeletedBy,
                'deleted_date' => $value->DeletedDT,
                'images' => $images,
                'reviews' => $reviews,
                'starRating' => $this->Advertisement->get_rating($id),
                'advertiser' => $adveriser
        );
        $this->response([
            'status' => true,
            'ads' => $data,
                ], 200);
    }

}
