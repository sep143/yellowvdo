<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class All_ads_Controller extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->session->unset_userdata('cat_select');
        $this->load->library('pagination');
        $this->load->model('web/Homepage_model','Home');
        $this->load->model('web/Ads_model','Ads');
        $this->load->model('user/Common_model','Common');
        if(!empty($this->session->userdata['user_profile']['id'])){
            $id = $this->session->userdata['user_profile']['id'];
            $data['user_data'] = $this->Common->get_userData($id);
        }
    }
    
    //get all ads url(ads)
    public function get_all_ads(){
        
        /*Pagination Setup Start*/ 
        $base_url = "ads";
        $total_rows = $this->Ads->count_all_ads();
        $per_page = 10;
        $uri_segment = 2;
        $config=$this->customlib->paginate($base_url,$total_rows,$per_page,$uri_segment);
        
        $this->pagination->initialize($config);
        $page = ($this->uri->segment($config['uri_segment'],0) > 0)?$this->uri->segment($config['uri_segment'],0):0;
        
        /*Pagination Setup End*/ 
        $data['category'] = $this->Home->get_category();
        $data['all_ads'] = $this->Ads->get_all_ads($config['per_page'],$page);
        
        $data['links'] = $this->pagination->create_links(); // Pagination Link
        $data['category_list'] = $this->Ads->get_main_category();
        if(!empty($this->session->userdata['user_profile']['id'])){
            $id = $this->session->userdata['user_profile']['id'];
            $data['user_data'] = $this->Common->get_userData($id);
        }
        $this->session->unset_userdata('web');
        $this->session->unset_userdata('category_ses');
        
        $this->load->view('web/layout/header_web',$data);
        $this->load->view('web/all_ads_web',$data);
        $this->load->view('web/layout/footer_web');
    }
    
    //click particular ad then open single ad
    public function view_ad($adid){
       $data['ad_id'] = $adid;
       
        $data['category'] = $this->Home->get_category();
        $data['ad_view'] = $this->Ads->get_adByid($adid);
        if(!empty($data['ad_view']->ID)){
            $data['images'] = $this->Ads->get_images_ad($data['ad_view']->ID);
            $data['review_count'] = $this->Ads->get_review($data['ad_view']->ID);
            $data['review'] = $this->Ads->get_review_all($data['ad_view']->ID);
        }
        if(!empty($this->session->userdata['user_profile']['id'])){
            $id = $this->session->userdata['user_profile']['id'];
            $data['user_data'] = $this->Common->get_userData($id);
        }
        $this->load->view('web/layout/header_web',$data);
        $this->load->view('web/ad_view_web');
        $this->load->view('web/layout/footer_web');
    }
    
    //submit review
    public function submit_review(){
        $this->load->library('user_agent');
         $adid = $this->input->post('adid');
         $lat = $this->input->post('lat');
         $long = $this->input->post('long');
         $rating = $this->input->post('rating');
         $comment = $this->input->post('comment');
//         $ip = $this->input->ip_address();
        
         ob_start(); // Turn on output buffering
        system('ipconfig /all'); //Execute external program to display output
        $mycom=ob_get_contents(); // Capture the output into a variable
        ob_clean(); // Clean (erase) the output buffer
        //echo $mycom;
        $findme = "Physical";
        $pmac = strpos($mycom, $findme); // Find the position of Physical text
        $mac=substr($mycom,($pmac+36),17); // Get Physical Address
        $m_store = trim($mac);
                 
        $browser = $this->agent->browser().', Version- '.$this->agent->version();
        $platform = $this->agent->platform();
        
        //if alredy store mac address then never insert
        $check = $this->Ads->check_review($m_store,$adid);
        if($check == 0){
//            echo 'Data insert';
            $data = array(
                'AdsID'=>$adid,
                'DeviceID'=>$m_store,
                'Lat'=>$lat,
                'Long'=>$long,
                'Rating'=>$rating,
                'Comment'=>$comment,
                'Browser'=>$browser,
                'Platform'=>$platform
            );
            $rt = $this->Ads->insert_review($data);
            if($rt){
                echo $status = 1;
//                echo "<script>
//                window.location.href='view/".$adid."';
//                alert('Thank you review submit.');
//                </script>";
            }
        }else{
            echo $status = 0;
//            echo "<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js'></script>
//                <script>
//            window.location.href='view/".$adid."';
//            alert('Already this ad review submit.');
//            </script>";
        }
    }
    
   
}