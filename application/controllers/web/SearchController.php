<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class SearchController extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('web/Ads_model', 'Ads');
        $this->load->model('web/Homepage_model','Home');
        $this->load->model('user/Common_model','Common');
        $this->load->model('web/Category_model','Category');
        
        if(!empty($this->session->userdata['default_location']['location'])){
            $this->lat = $this->session->userdata['default_location']['lat'];
            $this->long = $this->session->userdata['default_location']['long'];
            $this->def_location = $this->session->userdata['default_location']['location'];
            $this->def_latlong = " ,6371 * 2 * ASIN(SQRT(
            POWER(SIN(($this->lat - abs(SUBSTRING_INDEX(advertisement.LatLong,',',1))) * pi()/180 / 2),
            2) + COS($this->lat * pi()/180 ) * COS(abs(SUBSTRING_INDEX(advertisement.LatLong,',',1)) *
            pi()/180) * POWER(SIN(($this->long - SUBSTRING_INDEX(advertisement.LatLong,',',-1)) *
            pi()/180 / 2), 2) )) AS distance ";
            $this->orderby = " ORDER BY distance asc ";
       }else{
           $this->lat = 25.2744;
           $this->long = 133.7751;
           $this->def_location = 'Australia';
           $this->def_latlong = " ,6371 * 2 * ASIN(SQRT(
            POWER(SIN(($this->lat - abs(SUBSTRING_INDEX(advertisement.LatLong,',',1))) * pi()/180 / 2),
            2) + COS($this->lat * pi()/180 ) * COS(abs(SUBSTRING_INDEX(advertisement.LatLong,',',1)) *
            pi()/180) * POWER(SIN(($this->long - SUBSTRING_INDEX(advertisement.LatLong,',',-1)) *
            pi()/180 / 2), 2) )) AS distance ";
            $this->orderby = " ORDER BY distance asc ";
       }
    }
    //almost using ajax and get function to call then provide data on web page
    //search keyword, address, category and location to search
    public function search(){
        //$limit = 4;
        $search = $this->input->get('search');
        $catid = $this->input->get('catid');
        $location = $this->input->get('location');
        $catname = $this->input->get('catname');
       
        $session = array(
            'search'=>$search,
            'catid'=> $catid,
            'location'=>$location,
            'category_name'=>$catname
        );
        $this->session->set_userdata('web',$session);
       
        $sql = 'select *,(select Images from advertisement_image where AdsID=advertisement.ID and StatusID <>3 limit 1) as image from advertisement where StatusID =1';
        //echo 'Search - '.$search.'<br> Category id -'.$catid.'<br>Location - '.$location;
        if($search !== ''){
           $sql = $sql." and ( Keyword like '%$search%' OR BusinessName like '%$search%' OR CaptionLine like '%$search%')";
        }
        if($catid !== ''){
            $sql .=" and (CategID IN (select ID from (select * from category order by ParentID, ID) category,
                        (select @pv := '$catid') initialisation where find_in_set(ParentID, @pv) > 0
                and @pv := concat(@pv, ',', ID)) or CategID = $catid) ";
        }
        if($location !== ''){
            $location = $this->db->escape($location);
//            $sql = $sql." and ( LandmarkAddress like '%$location%' or BusinessAddress like '%$location%' or City like '%$location%' or State like '%$location%' or Country like '%$location%')";
            $sql = $sql." and (( MATCH (City, State,Country, PostCode, BusinessAddress) AGAINST( $location IN BOOLEAN MODE)) and ( MATCH (Country) AGAINST( $location IN BOOLEAN MODE)))";
        }
//        echo $sql;
        $sql .=' order by CreatedDT desc';
       // exit();
        /*Pagination Setup Start*/ 
        $base_url = "search";
        $total_rows = $this->Ads->get_ads_search_count($sql);
        $per_page = 10;
        if($this->input->get('per_page')!=""){
        $uri_segment = $this->input->get('per_page'); 
        }else{
        $uri_segment = 0;
        }

        $config=$this->customlib->paginate_search($base_url,$total_rows,$per_page,$uri_segment);
        $this->pagination->initialize($config);
        $page = $uri_segment;
        $sql .=' LIMIT '.$per_page.' OFFSET '.$page;
        /*Pagination Setup End*/
        $data['links'] = $this->pagination->create_links(); // Pagination Link
        $data['category'] = $this->Home->get_category();
        $data['category_list'] = $this->Ads->get_main_category();
        $data['all_ads'] = $this->Ads->get_ads_search($sql);
        $data['sort'] = 'Search ads';
        if(!empty($this->session->userdata['user_profile']['id'])){
            $id = $this->session->userdata['user_profile']['id'];
            $data['user_data'] = $this->Common->get_userData($id);
        }
        $this->load->view('web/layout/header_web',$data);
        $this->load->view('web/all_ads_web');
        $this->load->view('web/layout/footer_web');
    }
    
    //short by ad any momentum
    public function short_ads() {
        //popular => Star Rating, Recently => CreatedDT desc, Near by => location near
        $value = $this->input->get('sort');
        
        if($value == 'Popular'){
            $method = 1;
            $sort = 'Popular sort';
        }else if($value == 'Recently'){
            $method = 2;
            $sort = 'Recently sort';
        }else if($value == 'Nearby'){
            $method = 3;
            $sort = 'Nearby sort';
            $lat = $this->input->get('lat');
            $long = $this->input->get('long');
        }
        
        if(!empty($this->session->userdata['web']['search']) or !empty($this->session->userdata['web']['catid']) or !empty($this->session->userdata['web']['location'])){
            $search = $this->session->userdata['web']['search'];
            $catid = $this->session->userdata['web']['catid'];
            $location = $this->session->userdata['web']['location'];
            //$catname = $this->session->userdata['web']['category_name'];
            if($method == 1){
                $sql = 'select *,(select Images from advertisement_image where AdsID=advertisement.ID and StatusID <>3 limit 1) as image,'
                    . '(select AVG(Rating) from review where review.AdsID=advertisement.ID) as rating from advertisement where StatusID =1';
            }else if($method == 2){
                $sql = 'select *,(select Images from advertisement_image where AdsID=advertisement.ID and StatusID <>3 limit 1) as image'
                    . ' from advertisement where StatusID =1';
            }else if($method == 3){
//                $sql = 'select *,(select Images from advertisement_image where AdsID=advertisement.ID and StatusID <>3 limit 1) as image'
//                    . ' from advertisement where StatusID =1';
                $sql = "SELECT DISTINCT advertisement.*,(select Images from advertisement_image where AdsID=advertisement.ID and StatusID <>3 limit 1) as image , 6371 * 2 * ASIN(SQRT(
            POWER(SIN(($lat - abs(SUBSTRING_INDEX(advertisement.LatLong,',',1))) * pi()/180 / 2),
            2) + COS($lat * pi()/180 ) * COS(abs(SUBSTRING_INDEX(advertisement.LatLong,',',1)) *
            pi()/180) * POWER(SIN(($long - SUBSTRING_INDEX(advertisement.LatLong,',',-1)) *
            pi()/180 / 2), 2) )) AS distance
            FROM advertisement where StatusID=1 ";
            }
            
            //echo 'Search - '.$search.'<br> Category id -'.$catid.'<br>Location - '.$location;
                if($search !== ''){
                   $sql = $sql." and ( Keyword like '%$search%' OR BusinessName like '%$search%' OR CaptionLine like '%$search%' )";
                }
                if($catid !== ''){
                    $sql .=" and CategID IN (select ID from category where ParentID=$catid or ID=$catid) ";
                }
                if($location !== ''){
                    $location = $this->db->escape($location);
                    $sql = $sql." and (( MATCH (City, State,Country, PostCode, BusinessAddress) AGAINST( $location IN BOOLEAN MODE)) and ( MATCH (Country) AGAINST( $location IN BOOLEAN MODE)))";
                }
                if($method == 1){
                    $sql .=' order by rating desc';
                }else if($method == 2){
                    $sql .=' order by CreatedDT desc';
                }else if($method == 3){
                    $sql .=' order by distance ASC';
                }
//            echo $sql;
//            exit();
//            $data['category'] = $this->Home->get_category();
//            $data['category_list'] = $this->Ads->get_main_category();
            //$data['all_ads'] = $this->Ads->get_ads_search($sql);
            /*Pagination Setup Start*/ 
        $base_url = "sort";
        $total_rows = $this->Ads->get_ads_search_count($sql);
        $per_page = 10;
        if($this->input->get('per_page')!=""){
        $uri_segment = $this->input->get('per_page'); 
        }else{
        $uri_segment = 0;
        }

        $config=$this->customlib->paginate_search($base_url,$total_rows,$per_page,$uri_segment);
        $this->pagination->initialize($config);
        $page = $uri_segment;
        $sql .=' LIMIT '.$per_page.' OFFSET '.$page;
        /*Pagination Setup End*/
        $data['links'] = $this->pagination->create_links(); // Pagination Link
        $data['category'] = $this->Home->get_category();
        $data['category_list'] = $this->Ads->get_main_category();
        $data['all_ads'] = $this->Ads->get_ads_search($sql);
        $data['sort'] = $sort;
        if(!empty($this->session->userdata['user_profile']['id'])){
            $id = $this->session->userdata['user_profile']['id'];
            $data['user_data'] = $this->Common->get_userData($id);
        }
            $this->load->view('web/layout/header_web',$data);
            $this->load->view('web/all_ads_web');
            $this->load->view('web/layout/footer_web');
//            $this->load->view('web/layout/header_web',$data);
           // $this->load->view('web/sort_ads_ajax',$data);
//            $this->load->view('web/layout/footer_web');
        }else if(!empty ($this->session->userdata['category_ses']['category'])){
            
            $catid = $this->session->userdata['category_ses']['category'];
            
            if($method == 1){
                $sql = "select *,(select Images from advertisement_image where AdsID=advertisement.ID and StatusID <>3 limit 1) as image,"
                        . " (select AVG(Rating) from review where review.AdsID=advertisement.ID) as rating from advertisement where StatusID = 1 "
                        . " and (MATCH (City, State, Country, BusinessAddress, LandmarkAddress) AGAINST('$this->def_location' IN BOOLEAN MODE) ) "
                        . "and "
                        . "(CategID IN (select ID from (select * from category order by ParentID, ID) category,
                        (select @pv := '$catid') initialisation where find_in_set(ParentID, @pv) > 0
                    and @pv := concat(@pv, ',', ID)) or CategID = $catid)"
                        . " ";
            }else if($method == 2){
                $sql = "select *,(select Images from advertisement_image where AdsID=advertisement.ID and StatusID <>3 limit 1) as image"
                        . " from advertisement where StatusID = 1 "
                        . "and (MATCH (City, State, Country, BusinessAddress, LandmarkAddress) AGAINST('$this->def_location' IN BOOLEAN MODE) ) "
                        . "and "
                        . "(CategID IN (select ID from (select * from category order by ParentID, ID) category,
                        (select @pv := '$catid') initialisation where find_in_set(ParentID, @pv) > 0
                and @pv := concat(@pv, ',', ID)) or CategID = $catid) "
                        . " ";
            }else if($method == 3){
                    $sql = "SELECT DISTINCT advertisement.*,(select Images from advertisement_image where AdsID=advertisement.ID and StatusID <>3 limit 1) as image , 6371 * 2 * ASIN(SQRT(
            POWER(SIN(($lat - abs(SUBSTRING_INDEX(advertisement.LatLong,',',1))) * pi()/180 / 2),
            2) + COS($lat * pi()/180 ) * COS(abs(SUBSTRING_INDEX(advertisement.LatLong,',',1)) *
            pi()/180) * POWER(SIN(($long - SUBSTRING_INDEX(advertisement.LatLong,',',-1)) *
            pi()/180 / 2), 2) )) AS distance
            FROM advertisement where StatusID=1 and
                            (CategID IN (select ID from (select * from category order by ParentID, ID) category,
                        (select @pv := '$catid') initialisation where find_in_set(ParentID, @pv) > 0
                and @pv := concat(@pv, ',', ID)) or CategID = $catid) ";
            }
            if($method == 1){
                $sql .=' order by rating desc ';
            }else if($method == 2){
                $sql .=' order by CreatedDT desc ';
            }else if($method == 3){
                $sql .=' order by distance ASC ';
            }
                        
           // $data['all_ads'] = $this->Ads->get_ads_search($sql);
            /*Pagination Setup Start*/ 
        $base_url = "sort";
        $total_rows = $this->Ads->get_ads_search_count($sql);
        $per_page = 10;
        if($this->input->get('per_page')!=""){
        $uri_segment = $this->input->get('per_page'); 
        }else{
        $uri_segment = 0;
        }

        $config=$this->customlib->paginate_search($base_url,$total_rows,$per_page,$uri_segment);
        $this->pagination->initialize($config);
        $page = $uri_segment;
        $sql .=' LIMIT '.$per_page.' OFFSET '.$page;
        /*Pagination Setup End*/
        $data['links'] = $this->pagination->create_links(); // Pagination Link
        $data['category'] = $this->Home->get_category();
        $data['category_list'] = $this->Ads->get_main_category();
        $data['all_ads'] = $this->Ads->get_ads_search($sql);
        $data['sort'] = $sort;
        if(!empty($this->session->userdata['user_profile']['id'])){
            $id = $this->session->userdata['user_profile']['id'];
            $data['user_data'] = $this->Common->get_userData($id);
        }
//            $this->load->view('web/sort_ads_ajax',$data);
            $this->load->view('web/layout/header_web',$data);
            $this->load->view('web/all_ads_web');
            $this->load->view('web/layout/footer_web');
            
        }else{
            //1= popular, 2= recently, 3=nearby
            if($method == 1){
//                $sql = 'select *,(select Images from advertisement_image where AdsID=advertisement.ID and StatusID <>3 limit 1) as image,'
//                        . ' (select AVG(Rating) from review where review.AdsID=advertisement.ID) as rating from advertisement where StatusID =1 order by rating desc';
                $sql = "select *,(select Images from advertisement_image where AdsID=advertisement.ID and StatusID <>3 limit 1) as image,"
                        . " (select AVG(Rating) from review where review.AdsID=advertisement.ID) as rating from advertisement where StatusID = 1"
                        . " and (MATCH (City, State, Country, BusinessAddress, LandmarkAddress) AGAINST('$this->def_location' IN BOOLEAN MODE) )"
                        . "  order by rating desc ";
            }else if($method == 2){
                $sql = 'select *,(select Images from advertisement_image where AdsID=advertisement.ID and StatusID <>3 limit 1) as image '
                        . ' from advertisement where StatusID = 1 '
                        . " and (MATCH (City, State, Country, BusinessAddress, LandmarkAddress) AGAINST('$this->def_location' IN BOOLEAN MODE) )"
                        . 'order by CreatedDT desc';
            }else if($method == 3){
//                $sql = 'select *,(select Images from advertisement_image where AdsID=advertisement.ID and StatusID <>3 limit 1) as image '
//                        . ' from advertisement where StatusID =1 ';
                $sql = "SELECT DISTINCT advertisement.*,(select Images from advertisement_image where AdsID=advertisement.ID and StatusID <>3 limit 1) as image , 6371 * 2 * ASIN(SQRT(
            POWER(SIN(($lat - abs(SUBSTRING_INDEX(advertisement.LatLong,',',1))) * pi()/180 / 2),
            2) + COS($lat * pi()/180 ) * COS(abs(SUBSTRING_INDEX(advertisement.LatLong,',',1)) *
            pi()/180) * POWER(SIN(($long - SUBSTRING_INDEX(advertisement.LatLong,',',-1)) *
            pi()/180 / 2), 2) )) AS distance
            FROM advertisement where StatusID=1 order by distance ASC";
            }
//            echo $sql;
          //  $data['all_ads'] = $this->Ads->get_ads_search($sql);
            /*Pagination Setup Start*/ 
        $base_url = "sort";
        $total_rows = $this->Ads->get_ads_search_count($sql);
        $per_page = 10;
        if($this->input->get('per_page')!=""){
        $uri_segment = $this->input->get('per_page'); 
        }else{
        $uri_segment = 0;
        }

        $config=$this->customlib->paginate_search($base_url,$total_rows,$per_page,$uri_segment);
        $this->pagination->initialize($config);
        $page = $uri_segment;
        $sql .=' LIMIT '.$per_page.' OFFSET '.$page;
        /*Pagination Setup End*/
        $data['links'] = $this->pagination->create_links(); // Pagination Link
        $data['category'] = $this->Home->get_category();
        $data['category_list'] = $this->Ads->get_main_category();
        $data['all_ads'] = $this->Ads->get_ads_search($sql);
        $data['sort'] = $sort;
        if(!empty($this->session->userdata['user_profile']['id'])){
            $id = $this->session->userdata['user_profile']['id'];
            $data['user_data'] = $this->Common->get_userData($id);
        }
//            $this->load->view('web/sort_ads_ajax',$data);
            $this->load->view('web/layout/header_web',$data);
            $this->load->view('web/all_ads_web');
            $this->load->view('web/layout/footer_web');
        }
    }
    
    
    //Home page on category show direct but category in sub-category show then use function by ajax call on category div
    public function sub_category() {
        $catid = $this->input->post('catid');
//        $sql = "select ID,Name,ParentID from "
//                . " category WHERE (ParentID=$catid) and Popular=1 and StatusID = 1 limit 3";
        $sql = "select *,(select COUNT(CategID) from advertisement where StatusID=1 and CategID IN (category.ID)) as ads_count
            from (select * from category order by ParentID, ID) category,
                        (select @pv := '$catid') initialisation where StatusID=1 and find_in_set(ParentID, @pv) > 0
                and @pv := concat(@pv, ',', ID) limit 3 ";
        
//sql2 use only count then show more button active
        $sq2 = "select ID from category WHERE ParentID=$catid and StatusID = 1 limit 4";
        
        
        $data['cat_id'] = $catid;
        $data['sub_category'] = $this->Ads->get_ads_search($sql);
        $data['sub_category_count'] = $this->Ads->get_ads_search($sq2);
//        foreach ($data['sub_category'] as $row){
//            $sql2 = "select COUNT(CategID) as ads_count from advertisement where advertisement.CategID='$row->ID' and advertisement.StatusID=1";
//            $data['ads_count'] = $this->Ads->get_search_row($sql2);
//        }
                
        $this->load->view('web/ajax/home_page_subcategory',$data);
    }
    
    //main category and sub category in total ads count view then call ajax to call this function and count view
    public function ads_count(){
        $id = $this->input->post('id');
//        $sql = "select COUNT(ID) as ad_counts from advertisement where StatusID=1 and CategID IN 
//                (select ID from category,
//                    (select @pv := $id) initialisation where StatusID=1 and find_in_set(ParentID, @pv) > 0
//                and @pv := concat(@pv, ',', ID)) or (CategID IN ($id) ) and StatusID=1";
        $sql = "select COUNT(ID) as ad_counts from advertisement where StatusID=1 and CategID IN 
                (select ID from category,
                    (select @pv := $id) initialisation where StatusID=1 and find_in_set(ParentID, @pv) > 0
                and @pv := concat(@pv, ',', ID)) or (CategID IN ($id) ) and StatusID=1";
        $result_count = $this->Category->get_row($sql);
        if($result_count->ad_counts <= 1){
            echo $result_count->ad_counts.' Ad';
        }else{
            echo $result_count->ad_counts.' Ads';
        }
        
    }
}