<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class CategoryController extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('user/Common_model','Common');
        $this->load->model('web/Category_model','Category');
        $this->load->model('web/Homepage_model','Home');
        $this->load->model('web/Ads_model','Ads');
    }
    
    //home page to view all button click then open all category box wise open
    public function category_open(){
        if(!empty($this->session->userdata['user_profile']['id'])){
            $id = $this->session->userdata['user_profile']['id'];
            $data['user_data'] = $this->Common->get_userData($id);
        }
        $sql = "select Name,ID,Icon from category where ParentID=0 and StatusID = 1 ";
        $data['category'] = $this->Category->get_result($sql);
        $this->load->view('web/layout/header_web',$data);
        $this->load->view('web/all_category_view_web');
        $this->load->view('web/layout/footer_web');
    }
            
    //categories in all sub category open in list view
    public function sub_category_all_category(){
        $catid = $this->input->post('catid');
        //        $sql = "select ID,Name,ParentID from "
//                . " category WHERE (ParentID=$catid) and Popular=1 and StatusID = 1 limit 3";
        $sql = "select *,(select COUNT(CategID) from advertisement where StatusID=1 and CategID IN (category.ID)) as ads_count
            from (select * from category order by ParentID, ID) category,
                        (select @pv := '$catid') initialisation where StatusID=1 and find_in_set(ParentID, @pv) > 0
                and @pv := concat(@pv, ',', ID) limit 7 ";
        
//sql2 use only count then show more button active
        $sq2 = "select ID from category WHERE ParentID=$catid and StatusID = 1 limit 8";
        
        $data['cat_id'] = $catid;
        $data['sub_category'] = $this->Ads->get_ads_search($sql);
        $data['sub_category_count'] = $this->Ads->get_ads_search($sq2);
                
        $this->load->view('web/ajax/all_category_in_subcategory',$data);
    }
    
     //click show more then get Sub category view
    public function sub_category_view($catid) {
        $data['category'] = $this->Home->get_category();
//        $data['all_ads'] = $this->Ads->get_all_ads();
        $data['category_list'] = $this->Ads->get_main_category();
        $data['sub_category'] = $this->Category->get_sub_category($catid);
                        
//        $sql2 = "select COUNT(CategID) as ads_count from advertisement where StatusID=1 and CategID IN (select ID from category WHERE ParentID=$catid and Popular=1 and StatusID = 1 )";
//        $data['ads_count'] = $this->Ads->get_search_row($sql2);
        
        $data['sub_cate_id'] = $catid;
        if(!empty($this->session->userdata['user_profile']['id'])){
            $id = $this->session->userdata['user_profile']['id'];
            $data['user_data'] = $this->Common->get_userData($id);
        }
        $this->load->view('web/layout/header_web',$data);
        $this->load->view('web/sub_category_view');
        $this->load->view('web/layout/footer_web');
    }
    
    //select category then get category child ads get and view
    public function category_wise_ads($catid = 0){
        /*Pagination Setup Start*/ 
        $base_url = "category-wise/ads/".$catid;
        $total_rows = $this->Ads->count_ads_search($catid);        
        $per_page = 10;
        $uri_segment = 4; 
        $config=$this->customlib->paginate($base_url,$total_rows,$per_page,$uri_segment);
        
        $this->pagination->initialize($config);
        $page = ($this->uri->segment($config['uri_segment'],0) > 0)?$this->uri->segment($config['uri_segment'],0):0;        
        /*Pagination Setup End*/ 

        $data['category_name'] = $this->Ads->get_category_byid($catid);
        $data['category_id'] = $catid;
        $this->session->unset_userdata('web');
        $cate = array(
            'category'=>$catid
        );
        $this->session->set_userdata('category_ses',$cate);
        
        $data['all_ads'] = $this->Ads->get_ads_search1($catid,$config['per_page'],$page);
        $data['category'] = $this->Home->get_category();
        $data['links'] = $this->pagination->create_links();
        $data['category_list'] = $this->Ads->get_main_category();
        if(!empty($this->session->userdata['user_profile']['id'])){
            $id = $this->session->userdata['user_profile']['id'];
            $data['user_data'] = $this->Common->get_userData($id);
        }
        //open sub category div if click ant category
        $data['open_sub_category'] = 1;
        $sql = "select ID,Name,ParentID from (select * from category order by ParentID, ID) category, (select @pv := $catid) initialisation where StatusID=1 and find_in_set(ParentID, @pv) > 0 and @pv := concat(@pv, ',', ID)";
        
        $data['sub_category'] = $this->Category->get_result($sql);
        $this->load->view('web/layout/header_web',$data);
        $this->load->view('web/all_ads_web',$data);
        $this->load->view('web/layout/footer_web');
    }
    
    //category select then set session and view select option 
    public function session_category() {
        $cat_id = $this->input->post('catid');
        $data = array(
            'select_cat'=>$cat_id
        );
        $this->session->set_userdata('cat_select',$data);
    }
    
    
}