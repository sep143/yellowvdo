<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class Ads_model extends CI_Model{
    public function __construct() {
        parent::__construct();
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
           $this->def_location = 'Austria';
           $this->def_latlong = " ,6371 * 2 * ASIN(SQRT(
            POWER(SIN(($this->lat - abs(SUBSTRING_INDEX(advertisement.LatLong,',',1))) * pi()/180 / 2),
            2) + COS($this->lat * pi()/180 ) * COS(abs(SUBSTRING_INDEX(advertisement.LatLong,',',1)) *
            pi()/180) * POWER(SIN(($this->long - SUBSTRING_INDEX(advertisement.LatLong,',',-1)) *
            pi()/180 / 2), 2) )) AS distance ";
            $this->orderby = " ORDER BY distance asc ";
       }
    }

        //get all ads
    public function get_all_ads($limit,$offset) {
//        $sql = "select *,(select Images from advertisement_image where AdsID=advertisement.ID and StatusID <>3 limit 1) as image from advertisement where StatusID = 1 and "
//                . "( MATCH (City, State, Country, PostCode, BusinessAddress) AGAINST( '$this->def_location' IN BOOLEAN MODE))"
//                . " order by CreatedDT desc LIMIT $limit OFFSET $offset";
        $sql = "select *,(select Images from advertisement_image where AdsID=advertisement.ID and StatusID <>3 limit 1) as image "
                . "$this->def_latlong"
                . "from advertisement where StatusID = 1 and "
                . "( MATCH (City, State, Country, PostCode, BusinessAddress) AGAINST( '$this->def_location' IN BOOLEAN MODE)) $this->orderby "
                . " LIMIT $limit OFFSET $offset";
        $data = $this->db->query($sql);
        return $data->result();
    }
    /*Count all ads*/ 
    public function count_all_ads() {
//        $sql = "select *,(select Images from advertisement_image where AdsID=advertisement.ID and StatusID <>3 limit 1) as image from advertisement where StatusID =1 order by CreatedDT desc";
        $sql = "select *,(select Images from advertisement_image where AdsID=advertisement.ID and StatusID <>3 limit 1) as image "
                . "$this->def_latlong"
                . "from advertisement where StatusID = 1 and "
                . "( MATCH (City, State, Country, PostCode, BusinessAddress) AGAINST( '$this->def_location' IN BOOLEAN MODE)) $this->orderby "
                . " ";
        $data = $this->db->query($sql);
        return $data->num_rows();
    }
    
    //search then
     public function get_ads_search($sql) {
         $data = $this->db->query($sql);
         return $data->result();
        
     }
    public function get_ads_search1($catid,$limit=0,$offset=0) {
        // $sql = "select *,(select Images from advertisement_image where AdsID=advertisement.ID and StatusID <>3 limit 1) as image from advertisement where StatusID = 1 and CategID IN (select ID from category where ParentID=$catid or ID=$catid) ";
        $sql = "select *,(select Images from advertisement_image where AdsID=advertisement.ID and StatusID <>3 limit 1) as image "
                . "$this->def_latlong "
                . "from advertisement where StatusID = 1 and "
                . "(CategID IN (select ID from (select * from category order by ParentID, ID) category,
                        (select @pv := '$catid') initialisation where find_in_set(ParentID, @pv) > 0
                and @pv := concat(@pv, ',', ID)) or CategID = $catid) and "
                . "( MATCH (City, State, Country, PostCode, BusinessAddress) AGAINST( '$this->def_location' IN BOOLEAN MODE)) "
                . " $this->orderby LIMIT $limit OFFSET $offset";
        $data = $this->db->query($sql,array($catid,$limit,$offset));
        return $data->result();        
    }

    /*Count Ads by ID*/ 
    public function count_ads_search($catid) {
//        $sql = "select *,(select Images from advertisement_image where AdsID=advertisement.ID and StatusID <>3 limit 1) as image from advertisement where StatusID = 1 and CategID IN (select ID from category where ParentID=$catid or ID=$catid)";
        $sql = "select *,(select Images from advertisement_image where AdsID=advertisement.ID and StatusID <>3 limit 1) as image "
                . "$this->def_latlong "
                . "from advertisement where StatusID = 1 and "
                . "(CategID IN (select ID from (select * from category order by ParentID, ID) category,
                        (select @pv := '$catid') initialisation where find_in_set(ParentID, @pv) > 0
                and @pv := concat(@pv, ',', ID)) or CategID = $catid) and "
                . "( MATCH (City, State, Country, PostCode, BusinessAddress) AGAINST( '$this->def_location' IN BOOLEAN MODE)) "
                . " $this->orderby ";
        $data = $this->db->query($sql);
        return $data->num_rows();
    }

    //search then row only
    public function get_search_row($sql) {
        $data = $this->db->query($sql);
        return $data->row();
        
    }
    
    //click ad then view ad
    public function get_adByid($id) {
        $sql = "select *,(select Images from advertisement_image where AdsID=advertisement.ID and StatusID <>3 limit 1) as image from advertisement where ID=? and StatusID = 1";
        $data = $this->db->query($sql, array($id));
        if($data->num_rows() == 1){
            return $data->row();
        }else{
            return false;
        }
    }
    
    //get this view ad to get images
    public function get_images_ad($adis) {
        $sql = "select * from advertisement_image where AdsID=? and StatusID = 1";
        $data = $this->db->query($sql, array($adis));
        return $data->result();
    }
    
    //all ads open then get category view on left side
    public function get_main_category() {
        $sql = "select ID,Name,Icon from category where ParentID=0 and StatusID = 1";
        $data = $this->db->query($sql);
        return $data->result();
    }
    //category name
    public function get_category_byid($catid){
        $sql = "select Name from category where ID=? and StatusID = 1";
        $data = $this->db->query($sql, array($catid));
        return $data->row();
    }
    
    //get review
    public function get_review($adid) {
        $sql = "select AVG(Rating) as review from review where StatusID =1 and AdsID=? group by (AdsID)";
        $data = $this->db->query($sql, array($adid));
        return $data->row();
    }
    
    //get ads id to get review
    public function get_review_all($adid) {
        $sql = "select * from review where StatusID =1 and AdsID=?";
        $data = $this->db->query($sql, array($adid));
        return $data->result();
    }
    
    //if alredy availble data in table then never insert data
    public function check_review($mac, $adid) {
        $sql = "select AdsID,DeviceID from review where DeviceID=? and AdsID=? and StatusID <>3";
        $data = $this->db->query($sql, array($mac, $adid));
        return $data->num_rows();
    }
    
    //insert review
    public function insert_review($data){
        $this->db->insert('review', $data);
        return true;
    }
    
    //get sub category
    public function get_sub_category($catid) {
        $sql = "select * from (select * from category order by ParentID, ID) category,
                        (select @pv := '$catid') initialisation where find_in_set(ParentID, @pv) > 0
                and @pv := concat(@pv, ',', ID); ";
        $data = $this->db->query($sql, array($catid));
        return $data->result();
    }
    
    //for use search time get count data
    // Get Ads Search Count
        public function get_ads_search_count($sql) {
            $data = $this->db->query($sql);
            return $data->num_rows();

        }
}