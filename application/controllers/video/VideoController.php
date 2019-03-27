<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class VideoController extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->session->unset_userdata('cat_select');

        $this->load->model('user/Common_model','Common');
        $this->load->model('user/Myads_model','Myads');
        $this->load->model('admin/Advertisement_model','Advertisement');
        $this->load->helper('custom');
        $this->load->model('web/Homepage_model','Home');

        if(!empty($this->session->userdata['user_profile']['id'])){
            $id = $this->session->userdata['user_profile']['id'];
            $data['user_data'] = $this->Common->get_userData($id);
        }
        
    }

    public function video() {
       $this->session->unset_userdata('web');
        $this->session->unset_userdata('category_ses');
        if(!empty($this->session->userdata['user_profile']['id'])){
            $id = $this->session->userdata['user_profile']['id'];
            $data['user_data'] = $this->Common->get_userData($id);
        } 
        $this->load->view('web/layout/header_web.php',$data);
            // $this->load->view('web/layout/sidebar_web.php');
        $this->load->view('web/video.php');
        $this->load->view('web/layout/footer_web.php');
    }

    public function videoInput() {
//        echo 'Hello';
        if (!empty($_FILES['video']['name'])) {
            echo 'Hello';
            $videostatus="enter method";
            $config['upload_path'] ='./temp/input/';
            $config['allowed_types'] = 'wmv|mp4|avi|mov';
            $config['max_size'] = '0';
            $config['overwrite']     = FALSE; 
            //$config['max_size'] = '204800'; //200 MB
           // $config['max_filename'] = '255';
            $config['encrypt_name'] = true;
            $video_data = array();
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
                if ($this->upload->do_upload('video')) {
                        $uploadData = $this->upload->data();
                        $video = $uploadData['file_name'];
                        echo json_encode(array('status' => 'success', 'video_name' => $video));
                        return;
                } else {
                    // $video = $this->upload->display_errors();
                    $video = "Video File so large";
                    echo json_encode(array('status' => 'error', 'video_name' => $video));
                    return;
                }
            }
//
//            $this->load->view('web/layout/header_web.php');
//            // $this->load->view('web/layout/sidebar_web.php');
//            $this->load->view('web/video.php');
//            $this->load->view('web/layout/footer_web.php');

    }

     public function videoCutRotate() {
        $data['s_time'] = $this->input->post('stime');
        $data['v_time'] = $this->input->post('vtime');
        $data['v_name'] = $this->input->post('vname');
        $duration_time =  $data['v_time']-$data['s_time'];
        $s_time = gmdate("H:i:s",$data['s_time']);
        $d_time = gmdate("H:i:s", $data['v_time']);
        /**Video Triming Process**/ 
        $this->config1 = array_merge(array(
            'authentication' => true,
            'ffmpeg_path' => str_replace('\\', '/', getcwd()).('/ffmpeg/bin/ffmpeg'),
            'ffprobe_path' => str_replace('\\', '/', getcwd()).('/ffmpeg/bin/ffprobe'),
            'base_url' => '/',
            'root_path' => '',
            'input_dir_name' => str_replace('\\','/', getcwd()).('/ffmpeg/input'),
            'input_dir' => str_replace('\\','/', getcwd()).('/ffmpeg/input/'.$data['v_name']),
            'output_dir' => str_replace('\\','/', getcwd()).('/uploads/video/output/'.$data['v_name']),
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
        $content = shell_exec('ffmpeg -y -i '.$this->config1['input_dir'].' -threads 4 -q:v 1 -ss '.$s_time.' -t '.$d_time.' -vf "transpose=2,transpose=2,transpose=2,transpose=2" -metadata:s:v:0 rotate=0 -async 1 -strict -2 '.$this->config1['output_dir']);
            
            if (file_exists($this->config1['input_dir'])) unlink($this->config1['input_dir']);
            
            echo json_encode(array("status" => "200","status_msg" => "Success","S_time" => $s_time, "D_time" => $d_time));    
    }
    
    public function videoEdit() {
        $data['s_time'] = $this->input->post('stime');
        $data['v_time'] = $this->input->post('vtime');
        $data['v_name'] = $this->input->post('vname');
        $duration_time =  $data['v_time']-$data['s_time'];
        $s_time = gmdate("H:i:s",$data['s_time']);
        $d_time = gmdate("H:i:s", $data['v_time']);
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
        $content = shell_exec('ffmpeg -y -i '.$this->config1['input_dir'].' -ss '.$s_time.' -t '.$d_time.' -async 1 -strict -2 '.$this->config1['output_dir']);
            
            if (file_exists($this->config1['input_dir'])) unlink($this->config1['input_dir']);
            
            echo json_encode(array("status" => "200","status_msg" => "Success","S_time" => $s_time, "D_time" => $d_time));    
    }
    
    public function videoRotate() {
        // $data['s_time'] = $this->input->post('rotateVal');
        $data['degree'] = $this->input->post('degree');
        $data['v_name'] = $this->input->post('vname');
        /**Video Triming Process**/ 
        $this->config1 = array_merge(array(
            'authentication' => true,
            'ffmpeg_path' => str_replace('\\', '/', getcwd()).('/ffmpeg/bin/ffmpeg'),
            'ffprobe_path' => str_replace('\\', '/', getcwd()).('/ffmpeg/bin/ffprobe'),
            'base_url' => '/',
            'root_path' => '',
            'input_dir_name' => str_replace('\\','/', getcwd()).('/ffmpeg/input'),
            'input_dir' => str_replace('\\','/', getcwd()).('/ffmpeg/input/'.$data['v_name']),
            'output_dir' => str_replace('\\','/', getcwd()).('/uploads/video/output/'.$data['v_name']),
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
        
        
        $content = shell_exec('ffmpeg -i '.$this->config1['input_dir'].' -c copy -metadata:s:v:0 rotate="'.$data['degree'].'" '.$this->config1['output_dir']);
            
            // if (file_exists($this->config1['input_dir'])) unlink($this->config1['input_dir']);
            
            echo json_encode(array("status" => "200","status_msg" => "Success", "Rotation" => $data['degree']));    
    }
    

    function compressVideoSize($videoFile,$outfile) {
        // shell_exec('ffmpeg -i '.$videoFile.' -vf "scale=iw/2:ih/2" '.$outfile); // 50% Compress
        shell_exec('ffmpeg -i '.$videoFile.' -vcodec h264 -acodec aac '.$outfile); // 29% compress
    }

    function getVideoLengthSeconds($videoFile){
        // $videoFile = $this->input->post();
        $confg = array('input_dir' => str_replace('\\','/', getcwd()).('/ffmpeg/input/'.$videoFile));
        $dur = shell_exec("ffmpeg -i ".$confg['input_dir']." 2>&1");
        if(preg_match("/: Invalid /", $dur)){
            return false;
        }
        preg_match("/Duration: (.{2}):(.{2}):(.{2})/", $dur, $duration);
        if(!isset($duration[1])){
            return false;
        }
        $hours = $duration[1];
        $minutes = $duration[2];
        $seconds = $duration[3];
        // $sec = $seconds + ($minutes*60) + ($hours*60*60);
        echo json_encode(array('seconds' => $seconds + ($minutes*60) + ($hours*60*60)));
        return; 
    }



    // public function videoEdit_bkp() {
    //     $this->session->unset_userdata('web');
    //     $this->session->unset_userdata('category_ses');
    //     if(!empty($this->session->userdata['user_profile']['id'])){
    //         $id = $this->session->userdata['user_profile']['id'];
    //         $data['user_data'] = $this->Common->get_userData($id);
    //     }
    //     if (!empty($_FILES['video']['name'])) {
    //         $videostatus="enter method";
    //         $config['upload_path'] ='./ffmpeg/input/';
    //         $config['allowed_types'] = 'wmv|mp4|avi|mov';
    //         $config['max_size'] = '0';
    //         $config['max_filename'] = '255';
    //         $config['encrypt_name'] = true;
    //         $video_data = array();
    //         $this->load->library('upload', $config);
    //         $this->upload->initialize($config);
    //             if ($this->upload->do_upload('video')) {
    //                     $uploadData = $this->upload->data();
    //                     $video = $uploadData['file_name'];
    //                     if(!is_null($_POST['startTime']||$_POST['videoTime'])) {
    //                         $ss = $_POST['startTime'];
    //                         $t = $_POST['videoTime'];
    //                     }    
    //                 /**Video Triming Process**/ 
    //                 $this->config1 = array_merge(array(
    //                     'authentication' => true,
    //                     'ffmpeg_path' => str_replace('\\', '/', getcwd()).('/ffmpeg/bin/ffmpeg'),
    //                     'ffprobe_path' => str_replace('\\', '/', getcwd()).('/ffmpeg/bin/ffprobe'),
    //                     'base_url' => '/',
    //                     'root_path' => '',
    //                     'input_dir' => str_replace('\\','/', getcwd()).('/ffmpeg/input/'.$video),
    //                     'output_dir' => str_replace('\\','/', getcwd()).('/uploads/video/output/'.$video),
    //                     'tmp_dir' => 'userfiles/tmp/',
    //                     'log_filename' => 'log.txt',
    //                     'database_dir' => 'database/',
    //                     'ffmpeg_string_arr' => array(),
    //                     'users_restrictions' => array(),
    //                     'watermark_text' => '',
    //                     'watermark_text_font_name' => 'libel-suit-rg.tt',
    //                     'queue_size' => 10,
    //                     'debug' => false
    //                 ));
    //                 $result = $this->getVideoLengthSeconds($this->config1['input_dir']);
    //                 $data['vidStartTime'] = gmdate("H:i:s",0);
    //                 $data['vidStart'] = 0;
    //                 $data['vidEndTime'] = gmdate("H:i:s", $result);
    //                 $data['vidEnd'] = $result;
    //                 $content = shell_exec('ffmpeg -i '.$this->config1['input_dir'].' -ss 00:02:30 -t 00:00:36 -async 1 -strict -2 '.$this->config1['output_dir']);
    //                 $this->compressVideoSize($this->config1['input_dir'],$this->config1['output_dir']);
    //                 // $content = shell_exec('ffmpeg -i '.$this->config1['input_dir'].' -ss 00:00:30 -t 00:00:15 -async 1 -strict -2 '.$this->config1['output_dir']);

    //             } else {
    //                 // $video = NULL;
    //                 echo "Something Went Wrong";
    //             }
    //         }
    //         $this->load->view('web/layout/header_web.php',$data);
    //         // $this->load->view('web/layout/sidebar_web.php');
    //         $this->load->view('web/video.php',$data);
    //         $this->load->view('web/layout/footer_web.php');

    // }

}