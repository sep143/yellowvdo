<?php

defined('BASEPATH')OR exit('No direct script access allowed');

class AdvertisementApi_model extends CI_Model {

    //all ads get for api call
    public function get_all_ads($limit, $offset) {
        $data = $this->db->get('advertisement', $limit, $offset);
        return $data->result();
        // $sql = "select * from advertisement";
        // $data = $this->db->query($sql);
        // return $data->result();
    }

    public function get_adsbyid($id, $limit, $offset) {
        $data = $this->db->get_where('advertisement', array('UserID' => $id, 'StatusID <>3'), $limit, $offset);
        return $data->result();
    }

    public function search_ads($catid, $query, $location, $latlong, $limit, $offset) {
        $sql = null;
        if ($latlong != '' && $location != '') {
            $lat = explode(',', $latlong);
            $sql = "SELECT DISTINCT advertisement.*,(select AVG(Rating) from review where 
							advertisement.ID = review.AdsID) as Rating , 6371 * 2 * ASIN(SQRT(
            POWER(SIN(($lat[0] - abs(SUBSTRING_INDEX(advertisement.LatLong,',',1))) * pi()/180 / 2),
            2) + COS($lat[0] * pi()/180 ) * COS(abs(SUBSTRING_INDEX(advertisement.LatLong,',',1)) *
            pi()/180) * POWER(SIN(($lat[1] - SUBSTRING_INDEX(advertisement.LatLong,',',-1)) *
            pi()/180 / 2), 2) )) AS distance
            FROM advertisement LEFT JOIN review ON advertisement.ID = review.AdsID";
        } else {
            $sql = "SELECT DISTINCT advertisement.*,(select AVG(Rating) from review where 
						advertisement.ID = review.AdsID) as Rating FROM advertisement LEFT JOIN review ON advertisement.ID = review.AdsID";
        }

        if ($query != '') {
			//$query = $this->db->escape_like_str($query);
            $sql = $sql . " WHERE (advertisement.BusinessName LIKE '%$query%' OR advertisement.CaptionLine LIKE '%$query%' OR advertisement.Keyword LIKE '%$query%')";
        }
        if ($location != '') {
	$location = $this->db->escape($location);
            if ($query != '')
                $sql = $sql . " AND MATCH (City, State, Country, PostCode, BusinessAddress) AGAINST ($location IN BOOLEAN MODE)";
            else
                $sql = $sql . " WHERE MATCH (City, State, Country, PostCode, BusinessAddress) AGAINST ($location IN BOOLEAN MODE)";
        }
        if ($catid != ''){
            if ($query != '' || $location != ''){
                $sql = $sql . " AND (CategID IN (select ID from (select * from category order by ParentID, ID) category,
                        (select @pv := '$catid') initialisation where find_in_set(ParentID, @pv) > 0
                and @pv := concat(@pv, ',', ID)) or CategID = $catid)";
            }
            else{
                $sql = $sql . " WHERE (CategID IN (select ID from (select * from category order by ParentID, ID) category,
                        (select @pv := '$catid') initialisation where find_in_set(ParentID, @pv) > 0
                and @pv := concat(@pv, ',', ID)) or CategID = $catid)";
            }
        }
            
            
        $sql = $sql . " AND advertisement.StatusID = 1";
        if ($location != '') {
            $sql = $sql . " order by distance ASC";
        }
        $sql = $sql . " LIMIT $limit offset $offset";
		//$this->db->escape($sql);
        $data = $this->db->query($sql, $limit, $offset);
        return $data->result();
    }

    public function searchORsort($catid, $query, $latlong, $limit, $offset, $popularity, $nearby, $recently) {
        $sql = null;
        if ($latlong != '' && $nearby == 1) {
            $lat = explode(',', $latlong);
            $sql = "SELECT DISTINCT advertisement.*,(select AVG(Rating) from review where 
							advertisement.ID = review.AdsID) as Rating , 6371 * 2 * ASIN(SQRT(
            POWER(SIN(($lat[0] - abs(SUBSTRING_INDEX(advertisement.LatLong,',',1))) * pi()/180 / 2),
            2) + COS($lat[0] * pi()/180 ) * COS(abs(SUBSTRING_INDEX(advertisement.LatLong,',',1)) *
            pi()/180) * POWER(SIN(($lat[1] - SUBSTRING_INDEX(advertisement.LatLong,',',-1)) *
            pi()/180 / 2), 2) )) AS distance
            FROM advertisement LEFT JOIN review ON advertisement.ID = review.AdsID";
        } else {
            $sql = "SELECT DISTINCT advertisement.*,(select AVG(Rating) from review where 
				advertisement.ID = review.AdsID) as Rating FROM advertisement LEFT JOIN review ON advertisement.ID = review.AdsID";
        }
        if ($query != '') {
            $sql = $sql . " WHERE (advertisement.BusinessName LIKE '%$query%' OR advertisement.CaptionLine LIKE '%$query%' OR advertisement.Keyword LIKE '%$query%')";
        }
        if ($catid != ''){
            if ($query != ''){
                $sql = $sql . " AND (CategID IN (select ID from (select * from category order by ParentID, ID) category,
                        (select @pv := '$catid') initialisation where find_in_set(ParentID, @pv) > 0
                and @pv := concat(@pv, ',', ID)) or CategID = $catid)";
            }
            else{
                $sql = $sql . " AND (CategID IN (select ID from (select * from category order by ParentID, ID) category,
                        (select @pv := '$catid') initialisation where find_in_set(ParentID, @pv) > 0
                and @pv := concat(@pv, ',', ID)) or CategID = $catid)";
            }
        }
            
        $sql = $sql . " AND (advertisement.StatusID = 1)";
        if ($recently == 1)
            $sql = $sql . " order by advertisement.CreatedDT DESC ";
        if ($popularity == 1) {
            if ($recently == 1)
                $sql = $sql . " ,Rating DESC";
            else
                $sql = $sql . " order by Rating DESC";
        }
        if ($nearby == 1) {
            if ($recently == 1 || $popularity == 1)
                $sql = $sql . " ,distance ASC";
            else
                $sql = $sql . " order by distance ASC";
        }
        $sql = $sql . " LIMIT $limit offset $offset";
        $data = $this->db->query($sql, $limit, $offset);
        return $data->result();
    }

    public function get_adsbycategory($catid, $limit, $offset) {
        $sql = "select * from advertisement where StatusID=1 and (CategID IN (select ID from (select * from category order by ParentID, ID) category,
                        (select @pv := '$catid') initialisation where find_in_set(ParentID, @pv) > 0
                and @pv := concat(@pv, ',', ID)) or CategID = $catid) LIMIT $limit OFFSET $offset";
       // $data = $this->db->get_where('advertisement', array('CategID' => $catid, 'StatusID' => 1), $limit, $offset);
        $data = $this->db->query($sql, array($catid, $limit, $offset));
        return $data->result();
    }

    public function insert_image($imageData) {
        $this->db->insert('advertisement_image', $imageData);
    }

    public function insert_video($id, $videoData) {
        $this->db->update('advertisement', array('Video' => $videoData), array('ID' => $id));
    }

    public function updateAds($id, $data) {
        return $this->db->update('advertisement', $data, array('ID' => $id));
    }

    public function insertAds($data) {
        $this->db->insert('advertisement', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    //useing to limit and offset set
    public function ads_get_value($limit, $offset) {
        $sql = "select * from advertisement LIMIT " . $limit . " OFFSET " . $offset . " ";
        $data = $this->db->query($sql, $limit, $offset);
        return $data->result();
    }

    //get advertisement then get images
    public function get_images_byID($id) {
        $sql = "select * from advertisement_image where AdsID=? and StatusID <>3";
        $data = $this->db->query($sql, array($id));
        return $data->result();
    }

    public function get_cat_byID($id) {
        $catname = null;
        $query = "SELECT c.* FROM (SELECT @r AS _id, (SELECT @r := ParentID FROM category WHERE ID = _id) AS ParentID, @l := @l + 1 AS level FROM (SELECT @r := ?, @l := 0) vars, category m
        WHERE @r <> 0) d JOIN category c ON d._id = c.ID order by c.ID asc";
        $data = $this->db->query($query, array($id));
        foreach ($data->result() as $count => $value):
            if ($count == count($data->result()) - 1)
                $catname = $catname . $value->Name;
            else
                $catname = $catname . $value->Name . ' -> ';
        endforeach;
        // $sql = "select Name from category where ID=? and StatusID <>3";
        //  $data = $this->db->query($sql, array($id));
        //  return $data->row()->Name;
        return $catname;
    }

    public function delete_image($img) {
//        $this->db->delete('advertisement_image', array('Images' => $img));
        $this->db->where('Images',$img);
        $this->db->update('advertisement_image',array('StatusID'=>3));
    }

    public function get_review($id, $limit, $offset) {
        $sql = "select Rating,Comment from review where (AdsID=? and StatusID <>3) LIMIT $limit offset $offset";
        $data = $this->db->query($sql, array($id));
        return $data->result();
    }

    public function get_rating($id) {
        $sql = "select AVG(Rating) as Rating from review where AdsID=?";
        $data = $this->db->query($sql, array($id));
        return $data->row()->Rating;
    }

    public function get_advertiser($id) {
        $sql = "select FirstName,LastName,Profile,City,State,Country from advertiser where ID=?";
        $data = $this->db->query($sql, array($id));
        return $data->row();
    }

    public function deleteAds($id) {
        return $this->db->update('advertisement', array('StatusID' => 3), array('ID' => $id));
    }
    
    //update ads then get data and check
     public function get_ads_byID($id, $adid){
         $sql = "select * from advertisement where UserID=? and ID=? and StatusID <>3";
         $data = $this->db->query($sql, array($id,$adid));
         return $data->row();
     }

     //get ad by id
     public function get_ad_byID($id) {
         $sql = "select * from advertisement where ID=? and StatusID <>3";
         $data = $this->db->query($sql, array($id));
         return $data->row();
     }
}
