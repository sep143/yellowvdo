<?php
ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//include Rest Controller library
require APPPATH . '/libraries/REST_Controller.php';

class ProfileApi extends REST_Controller {

    public function __construct($config = 'rest') {
        header('Access-Control-Allow-Origin: *');
    //    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        parent::__construct();
        $this->load->model('api/ProfileApi_model', 'Profile');
    }

    public function profile_post(){
      $id =  $this->post('id');
      $data = $this->Profile->profile_get($id);

      if($data){
       unset($data->Pwd);
       if($data->Profile!=null && strpos($data->Profile, 'http') === false)
                    $data->Profile = base_url().'uploads/profile/'.$data->Profile;
       $this->response([
                'status' => true,
                'data' => $data,
                    ], 200);
        }
        else {
            $this->response([
                'status' => false,
                'message' => 'Invalid user id',
                    ], 200);
        }
    }

        public function getData_post(){
                $id = $this->input->post('id');
                echo $id;
        }


    public function updateProfile_post(){
    	if(!empty($this->input->post('oldpass'))){
				if(!$this->Profile->passowrdCHK(md5($this->input->post('oldpass')),$this->input->post('id'))){
					$this->response([
                        'status'=>false,
                        'message'=>'password not match',
                    ],200);
                    return;
				}
    	}
    	$pic=null;
         if(isset($_FILES['profile_image']['name'])){
                $config['upload_path'] = './uploads/profile/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['profile_image']['name'];
                //$config['max_size'] = '100';
                $config['encrypt_name'] = true;
                //$config['max_width']  = '1024';
                //$config['max_height']  = '768';
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('profile_image')){
                    $uploadData = $this->upload->data();
                    $pic = $uploadData['file_name'];
                    $this->load->helper('file');
                    $this->load->library('image_lib');
                    $config['image_library'] = 'gd2';
                    $config['source_image']	= 'uploads/profile/'.$pic;
                   // $config['new_image']	= 'uploads/category/'.$pic;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']	= 200;
                    $config['height']	= 200;

                    $this->image_lib->clear();
                    $this->image_lib->initialize($config);

                    $this->image_lib->resize();
                }else{
                    
                }
            }
            	$id = $this->input->post('id');
            	$fname = $this->input->post('fname');
            	$lname = $this->input->post('lname');
            	$username = $this->input->post('email');
            	$landmark = $this->input->post('address');
            	$location = $this->input->post('location');
            	$latlong = $this->input->post('latlong');
            	$city = $this->input->post('city');
            	$state = $this->input->post('state');
            	$country = $this->input->post('country');
            	$postcode = $this->input->post('postcode');
            	$phone = $this->input->post('phone');

  				$data = array(
                  'FirstName'=>$fname,
                  'LastName'=>$lname,
                  'UserName'=>$username,
                  'Address'=>$location,
                  'LandmarkAddress'=>$landmark,
                  'LatLong'=>$latlong,
                  'City'=>$city,
                  'State'=>$state,
                  'Country'=>$country,
                  'PostCode'=>$postcode,
                  'Phone'=>$phone
               );
  				if($this->input->post('password'))
  					$data['Pwd'] = md5($this->input->post('password'));
            	//	array_push($data, array('Pwd'=> $this->input->post('password')));
            	if($pic!=null)
            		$data['Profile'] = $pic;
            	//	array_push($data, array('Profile'=> $pic));
            	//echo $data;

            	if($this->Profile->profile_update($id,$data)){
            		   $this->response([
                        'status'=>true,
                        'message'=>'profile updated successfully',
                    ],200);
            	}
            	else{
            		$this->response([
                        'status'=>false,
                        'message'=>'Server error please try again later',
                    ],200);
            	}

    }
    
}
