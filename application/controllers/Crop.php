<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * @package Crop :  CodeIgniter Crop *
 * @author TechArise Team
 *
 * @email  info@techarise.com
 *   
 * Description of Crop Controller
 */

class Crop extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //$this->load->library('upload');
        $this->load->helper(array('form', 'url'));
        $this->load->model('Site', 'site');
        $this->load->model('Cropper', 'cropper');
        $this->load->model('admin/Advertisement_model','Advertisement');
        $this->load->model('user/Myads_model','Myads');
       // $this->load->helper('directory');
    }
     // index page
    public function index() {
        $data['title'] = 'Image Crop | TechArise'; 
        $this->site->setUserID(1);  
        $data['userInfo'] = $this->site->getUserDetails();           
        $this->load->view('crop/index', $data);
    }
    // crop avtar
    public function upload() {
        $json = array();
        $avatar_src = $this->input->post('avatar_src');
        $avatar_data = $this->input->post('avatar_data');
        $avatar_file = $_FILES['avatar_file'];
        $ussid = $this->input->post('ussid');
        $upltype = $this->input->post('upltype');
        
        $originalPath = str_replace('\\', '/', getcwd()).('/uploads/ads/original/'); //original image path
        $thumbPath = str_replace('\\', '/', getcwd()).'/uploads/ads/'; //thumb image store path
        $thumb_view = str_replace('\\', '/', getcwd()).'/uploads/ads/_thumb/'; //thumb image store path
//        $originalPath = 'C:/xampp/htdocs/yellowvdo/uploads/ads/original/'; //original image path
//        $thumbPath = 'C:/xampp/htdocs/yellowvdo/uploads/ads/'; //thumb image store path
        $urlPath = base_url().'uploads/ads/'; //view on image page after select image
        
        $thumb = $this->cropper->setDst($thumbPath);
        $thumb_v = $this->cropper->setDst2($thumb_view);
        $this->cropper->setSrc($avatar_src);
        $data = $this->cropper->setData($avatar_data);
        // set file
        $avatar_path = $this->cropper->setFile($avatar_file, $originalPath); 
        // crop       
        $this->cropper->crop($avatar_path, $thumb, $data);
        $this->cropper->crop2($avatar_path, $thumb_v, $data);
        // response       
        $json = array(
          'state'  => 200,
          'message' => $this->cropper->getMsg(),
          'result' => $this->cropper->getResult(),
          'thumb' => $this->cropper->getThumbResult(),
          'ussid' => $ussid,
          'upltype' => $upltype,
          'urlPath' => $urlPath,
        );
        echo json_encode($json);
    }
    
    // upload ads avatar Crop Image
    public function uploadCropImg() {
        
        $type = $this->input->post('type');
        if($type == 'create'){
           $json = array();
        $image_url = $this->input->post('image_url');        
        $user_id = base64_decode($this->input->post('member_id')); //image view use code only member id
        $upltype = $this->input->post('upltype');
            $json['img'] = $image_url;
            $json['user_id'] = $user_id;
            $json['upl'] = $upltype;

            $img_path = $this->session->userdata['img'];
             array_push($img_path, $image_url);
             $this->session->set_userdata('img',$img_path);
             $json['img_path_v'] = $this->session->userdata('img');

            header('Content-Type: application/json');
            echo json_encode($json);
        }else if($type == 'edit'){
            //echo 'edit';
            $json = array();
            $ad_id = $this->input->post('ad_id');
            $image_url = $this->input->post('image_url');
            $user_id = base64_decode($this->input->post('member_id')); //image view use code only member id
            $json['img'] = $image_url;
            $json['user_id'] = $user_id;
            $json['id'] = $ad_id;
            $imageData = array(
                'AdsID'=>$ad_id,
                'Images'=>$image_url,
            );
            $json['return_img_id'] = $this->Myads->insert_image($imageData);
            header('Content-Type: application/json');
            echo json_encode($json);
        }
        
    }
    
    //image select then delete use this function
    public function delete_img_unlink() {
        //create ad time
        $img_name = $this->input->post('img_name');
        $type = $this->input->post('type');
        if($type == 'create'){
            echo 'create';
            $img_path_thumb = 'uploads/ads/'.$img_name;
            $img_path_thumb_view = 'uploads/ads/'.$img_name;
            
            $extension = image_type_to_extension($img_name);
            $img_path_original = 'uploads/ads/original/original-'.$img_name.$extension;
            
            unlink($img_path_original);
            //$img_path_original = base_url().'uploads/ads/_thumb/'.$img_name;
            unlink($img_path_thumb);
            unlink($img_path_thumb_view);

            $delete_path = $this->session->userdata['img'];
            $pos = array_search($img_name, $delete_path);
    //        if($delete_path.indexOf($img_name) !== -1){
                //unset($delete_path[array_search($img_name, $delete_path)]);
            unset($delete_path[$pos]);
                $this->session->set_userdata('img',$delete_path);
    //        }
        }else if($type == 'edit'){
            echo 'edit';
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
        
            
     //Edit ad then ad new pic and delete
       
    }
    
    
    
    //check session only
    public function check_session() {
        foreach ($this->session->userdata['img'] as $count=>$key):
            echo $this->session->userdata['img'][$count].'<br>';
         //echo $this->session->userdata['img'][1];
        endforeach;
    }

}