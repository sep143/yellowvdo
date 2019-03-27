<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class SessionController extends MY_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('admin/Common_model','Common');
    }
    
    //language session set
    public function languageSession(){
        $lang = $this->input->post('lang');
        $data = array(
            'language'=> $lang
        );
        $this->session->set_userdata('lang_set',$data);
    }
    
    
    
    //this function use to notification change
    public function change_notification_after_view(){
        $status = $this->input->post('status');
        if($status == 1){
            $notify = 1;
           echo $result = $this->Common->update_user_notify($notify);
        }else if($status == 2 or $status == 3){
            if($status == 2){
                $notify = 1;
            }else if($status == 3){
                $notify = 2;
            }
           echo $result = $this->Common->update_ads_notify($notify);
        }else if($status == 4){
            $notify = 1;
            echo $result = $this->Common->update_refund_notify($notify);
        }else if($status == 5){
            $notify = 1;
            echo $result = $this->Common->update_msg_notify($notify);
        }
    }
    
    //filter use function
    public function filter(){
        $id_search = $this->input->post('id');
        $location = $this->input->post('location');
        $st = $this->input->post('status');
        $status = '';
        $from = '';
        $to = '';
        $category = $this->input->post('category');
        
        if(!empty($this->input->post('from'))){
             $from = date('Y-m-d', strtotime($this->input->post('from')));
        }
       
        if(!empty($this->input->post('to'))){
             $to = date('Y-m-d', strtotime($this->input->post('to')));
        }
        
        $use = $this->input->post('use');
        if($use == 'user'){
            $sql = "select * from advertiser where StatusID <>3 and Role = 2 ";
            if(!empty($id_search)){
            $sql = $sql." and ID like $id_search";
            }
            if(!empty($location)){
                $sql = $sql." and (LandmarkAddress like '%$location%' or Address like '%$location%') ";
            }
            if(!empty($st)){
                if($st == 2){
                    $sql = $sql." and StatusID=0";
                }else{
                    $sql = $sql." and StatusID=$st";
                }
            }
            if(!empty($from) && !empty($to)){
                $sql = $sql." and CreatedDT >= '".$from."' and CreatedDT < ('".$to."' + INTERVAL 1 DAY)";
            }
            $sql = $sql." order by CreatedDT desc "; 
           // echo $sql;
            $data['advertiser_list'] = $this->Common->get_advertier($sql);
            $this->load->view('admin/advertiser/ajax/filter_data', $data);
            //echo 'Data Check - '.$id_search.' -From '.$from.' -To'.$to.'-Loc '.$location.' St '.$status;
        }
        else if($use == 'ads'){
            
            $sql = "select a.*,b.FirstName,b.LastName,(select Images from advertisement_image where AdsID=a.ID and StatusID <>3 LIMIT 1) as image "
                    . " from advertisement a LEFT JOIN advertiser b on a.UserID=b.ID LEFT JOIN category c ON a.CategID=c.ID where a.StatusID NOT IN (3,6) and b.StatusID <>3 ";
            if(!empty($id_search)){
            $sql = $sql." and a.ID like $id_search";
            }
            if(!empty($location)){
                $sql = $sql." and (a.LandmarkAddress like '%$location%' or a.BusinessAddress like '%$location%') ";
            }
            if(!empty($category)){
                $sql = $sql." and c.Name like '%$category%' ";
            }
            if(!empty($st)){
                if($st == 6){
                    $sql = $sql." and a.StatusID=0";
                }else{
                    $sql = $sql." and a.StatusID=$st";
                }
            }
            if(!empty($from) && !empty($to)){
                $sql = $sql." and a.CreatedDT >= '".$from."' and a.CreatedDT < ('".$to."' + INTERVAL 1 DAY)";
            }
            $sql = $sql.' and a.UserID IS NOT NULL order by a.CreatedDT desc';
//            echo $sql;
            $data['ads_list'] = $this->Common->get_advertier($sql);
            $this->load->view('admin/advertisement/ajax/filter_data', $data);
        }
        else if($use == 'free_ads'){
            $sql = "select a.*,b.FirstName,b.LastName from advertisement a LEFT JOIN advertiser b on a.UserID=b.ID where a.StatusID <>3 ";
            if(!empty($id_search)){
                $sql = $sql." and a.ID like $id_search";
            }
            if(!empty($location)){
                $sql = $sql." and (a.LandmarkAddress like '%$location%' or a.BusinessAddress like '%$location%') ";
            }
            if(!empty($st)){
                if($st == 6){
                    $sql = $sql." and a.StatusID=0";
                }else{
                    $sql = $sql." and a.StatusID=$st";
                }
            }
            if(!empty($from) && !empty($to)){
                $sql = $sql." and a.CreatedDT >= '".$from."' and a.CreatedDT < ('".$to."' + INTERVAL 1 DAY)";
            }
            $sql = $sql.' and a.UserID IS NULL order by a.CreatedDT desc';
//            echo $sql;
            $data['free_ads_list'] = $this->Common->get_advertier($sql);
            $this->load->view('admin/advertisement/free/ajax/filter_data', $data);
        }
        else if($use == 'pending'){
            $sql = "select a.*,b.FirstName,b.LastName,(select Images from advertisement_image where AdsID=a.ID and StatusID <>3 LIMIT 1) as image"
                    . " from advertisement a LEFT JOIN advertiser b on a.UserID=b.ID where a.StatusID=0 ";
            if(!empty($id_search)){
                $sql = $sql." and a.ID like $id_search";
            }
            if(!empty($location)){
                $sql = $sql." and (a.LandmarkAddress like '%$location%' or a.BusinessAddress like '%$location%') ";
            }
            if(!empty($st)){
                if($st == 6){
                    $sql = $sql." and a.StatusID=0";
                }else{
                    $sql = $sql." and a.StatusID=$st";
                }
            }
            if(!empty($from) && !empty($to)){
                $sql = $sql." and a.CreatedDT >= '".$from."' and a.CreatedDT < ('".$to."' + INTERVAL 1 DAY)";
            }
            $sql = $sql.' and a.UserID IS NOT NULL order by a.CreatedDT desc';
//            echo $sql;
            $data['ads_list'] = $this->Common->get_advertier($sql);
            $this->load->view('admin/advertisement/ajax/filter_pending_data', $data);
        }
        else if($use == 'editads'){
            $sql = "select a.*,b.FirstName,b.LastName,(select Images from advertisement_image where AdsID=a.ID and StatusID <>3 LIMIT 1) as image"
                    . " from advertisement a LEFT JOIN advertiser b on a.UserID=b.ID where a.StatusID=2 ";
            if(!empty($id_search)){
                $sql = $sql." and a.ID like $id_search";
            }
            if(!empty($location)){
                $sql = $sql." and (a.LandmarkAddress like '%$location%' or a.BusinessAddress like '%$location%') ";
            }
            if(!empty($st)){
                if($st == 6){
                    $sql = $sql." and a.StatusID=2";
                }else{
                    $sql = $sql." and a.StatusID=$st";
                }
            }
            if(!empty($from) && !empty($to)){
                $sql = $sql." and a.CreatedDT >= '".$from."' and a.CreatedDT < ('".$to."' + INTERVAL 1 DAY)";
            }
            $sql = $sql.' and a.UserID IS NOT NULL order by a.CreatedDT desc';
//            echo $sql;
            $data['ads_list'] = $this->Common->get_advertier($sql);
            $this->load->view('admin/advertisement/ajax/filter_pending_data', $data);
        }
        else if($use == 'disApprove'){
            $sql = "select a.*,b.FirstName,b.LastName,(select Images from advertisement_image where AdsID=a.ID and StatusID <>3 LIMIT 1) as image"
                    . " from advertisement a LEFT JOIN advertiser b on a.UserID=b.ID where a.StatusID=4 ";
            if(!empty($id_search)){
                $sql = $sql." and a.ID like $id_search";
            }
            if(!empty($location)){
                $sql = $sql." and (a.LandmarkAddress like '%$location%' or a.BusinessAddress like '%$location%') ";
            }
            if(!empty($st)){
                if($st == 6){
                    $sql = $sql." and a.StatusID=0";
                }else{
                    $sql = $sql." and a.StatusID=$st";
                }
            }
            if(!empty($from) && !empty($to)){
                $sql = $sql." and a.CreatedDT >= '".$from."' and a.CreatedDT < ('".$to."' + INTERVAL 1 DAY)";
            }
            $sql = $sql.' and a.UserID IS NOT NULL order by a.CreatedDT desc';
//            echo $sql;
            $data['ads_list'] = $this->Common->get_advertier($sql);
            $this->load->view('admin/advertisement/ajax/filter_disapprove_data', $data);
        }
        else if($use == 'expired'){
            $sql = "select a.*,b.FirstName,b.LastName,(select Images from advertisement_image where AdsID=a.ID and StatusID <>3 LIMIT 1) as image"
                    . " from advertisement a LEFT JOIN advertiser b on a.UserID=b.ID where a.StatusID = 5 ";
            if(!empty($id_search)){
                $sql = $sql." and a.ID like $id_search";
            }
            if(!empty($location)){
                $sql = $sql." and (a.LandmarkAddress like '%$location%' or a.BusinessAddress like '%$location%') ";
            }
            if(!empty($st)){
                if($st == 6){
                    $sql = $sql." and a.StatusID=0";
                }else{
                    $sql = $sql." and a.StatusID=$st";
                }
            }
            if(!empty($from) && !empty($to)){
                $sql = $sql." and a.CreatedDT >= '".$from."' and a.CreatedDT < ('".$to."' + INTERVAL 1 DAY)";
            }
            $sql = $sql.' and a.UserID IS NOT NULL order by a.CreatedDT desc';
//            echo $sql;
            $data['ads_list'] = $this->Common->get_advertier($sql);
            $this->load->view('admin/advertisement/ajax/filter_expired_data', $data);
        }
        
        //account slider in all transition table
        else if($use == 'allTransition'){
            $sql = "select a.* from payment a LEFT JOIN advertisement b ON a.AdsID=b.ID LEFT JOIN advertiser c ON a.UserID=c.ID where a.StatusID <>3 ";
            if(!empty($id_search)){
                $sql = $sql." and (b.ID like $id_search or c.ID like $id_search ) ";
            }
            if(!empty($location)){
                $sql = $sql." and (b.LandmarkAddress like '%$location%' or b.BusinessAddress like '%$location%' or c.LandmarkAddress like '%$location%' or c.Address like '%$location%') ";
            }
            if(!empty($from) && !empty($to)){
                $sql = $sql." and a.CreatedDT >= '".$from."' and a.CreatedDT < ('".$to."' + INTERVAL 1 DAY) ";
            }
            
            $sql = $sql.' order by a.CreatedDT desc';
            $data['transition'] = $this->Common->get_advertier($sql);
            $this->load->view('admin/payment/ajax_transition/transition_filter', $data);
        }
        //account in refund request
        else if($use == 'refund_req'){
            $q = $this->input->post('type');
            if($q == 'request'){
                $sql = "select *,d.FirstName,d.LastName,c.ID as adid from refund a left join payment b on a.PayID=b.ID left join advertisement c on c.ID=b.AdsID left join advertiser d on c.UserID=d.ID where a.StatusID <>3 and a.Status=0 ";
                $data['done'] = 1;
            }else if($q == 'refund_all'){
                $sql = "select *,d.FirstName,d.LastName,c.ID as adid from refund a left join payment b on a.PayID=b.ID left join advertisement c on c.ID=b.AdsID left join advertiser d on c.UserID=d.ID where a.StatusID <>3 ";
                $data['done'] = 0;
            }
            
            if(!empty($id_search)){
                $sql = $sql." and (a.UserID like $id_search or b.AdsID like $id_search)";
            }
            if(!empty($location)){
                $sql = $sql." and (c.LandmarkAddress like '%$location%' or c.BusinessAddress like '%$location%') ";
            }
            if(!empty($from) && !empty($to)){
                $sql = $sql." and a.CreatedDT >= '".$from."' and a.CreatedDT < ('".$to."' + INTERVAL 1 DAY) ";
            }
            $sql = $sql." order by a.CreatedDT desc";
            $data['refund'] = $this->Common->get_advertier($sql);
            
            $this->load->view('admin/payment/ajax_transition/refund_filter_data', $data);
        }
        
        //message in filter use
        else if($use == 'message'){
            $sql = "select a.*,c.*,a.ID as chatID,c.Country as Country,c.StatusID as stID,c.ID as user_id from chat a left join advertisement b on a.AdsID=b.ID left join advertiser c on b.UserID=c.ID where a.StatusID <>3 ";
            if(!empty($id_search)){
                $sql = $sql." and c.ID like $id_search ";
            }
            if(!empty($location)){
                $sql = $sql." and (c.LandmarkAddress like '%$location%' or c.Address like '%$location%') ";
            }
            if(!empty($from) && !empty($to)){
                $sql = $sql." and a.CreatedDT >= '".$from."' and a.CreatedDT < ('".$to."' + INTERVAL 1 DAY) ";
            }
            if(!empty($st)){
                if($st == 2){
                    //click unread
                    $sql = $sql." and a.NotifyAdmin=1";
                }else{
                    $sql = $sql." and a.NotifyAdmin=0";
                }
            }
            
             $sql = $sql." group by (c.ID)";
            $data['chat'] = $this->Common->get_advertier($sql);
            $this->load->view('admin/message/ajax/filter_data', $data);
        }
        //review table
        else if($use == 'review'){
            $sql = "select a.*,c.FirstName,c.LastName from review a left join advertisement b on a.AdsID=b.ID left join advertiser c on b.UserID=c.ID where a.StatusID <>3 ";
            if(!empty($id_search)){
                $sql = $sql." and (b.ID like $id_search) ";
            }
            if(!empty($location)){
                $sql = $sql." and (b.LandmarkAddress like '%$location%' or b.BusinessAddress like '%$location%') ";
            }
            if(!empty($from) && !empty($to)){
                $sql = $sql." and a.CreatedDT >= '".$from."' and a.CreatedDT < ('".$to."' + INTERVAL 1 DAY) ";
            }
            if(!empty($st)){
                if($st == 2){
                    //click unread
                    $sql = $sql." and a.StatusID=0";
                }else{
                    $sql = $sql." and a.StatusID=1";
                }
            }
            
            $sql = $sql." order by a.CreatedDT desc ";
            $data['review_list'] = $this->Common->get_advertier($sql);
            $this->load->view('admin/review/ajax/filter_data', $data);
        }
        //Reminder slide in Renew button on filter
        else if($use == 'renew'){
            $sql = "select a.*,b.FirstName,b.LastName from advertisement a LEFT JOIN advertiser b on a.UserID=b.ID where a.StatusID = 5 ";
            if(!empty($id_search)){
                $sql = $sql." and a.ID like $id_search";
            }
            if(!empty($location)){
                $sql = $sql." and (a.LandmarkAddress like '%$location%' or a.BusinessAddress like '%$location%') ";
            }
            if(!empty($st)){
                if($st == 6){
                    $sql = $sql." and a.StatusID=0";
                }else{
                    $sql = $sql." and a.StatusID=$st";
                }
            }
            if(!empty($from) && !empty($to)){
                $sql = $sql." and a.CreatedDT >= '".$from."' and a.CreatedDT < ('".$to."' + INTERVAL 1 DAY)";
            }
            $sql = $sql.' and a.UserID IS NOT NULL order by a.CreatedDT desc';
//            echo $sql;
            $data['ads_list'] = $this->Common->get_advertier($sql);
            $this->load->view('admin/reminder/ajax/renew_filter_data', $data);
        }
        //Reminder slide in Pending Ads
        else if($use == 'reminder'){
            $sql = "select a.*,b.FirstName,b.LastName from advertisement a INNER JOIN advertiser b on a.UserID=b.ID where a.ExpiryDT BETWEEN CURRENT_DATE() AND (CURRENT_DATE() + INTERVAL 1 MONTH) and a.StatusID <>3 ";
            if(!empty($id_search)){
                $sql = $sql." and a.ID like $id_search";
            }
            if(!empty($location)){
                $sql = $sql." and (a.LandmarkAddress like '%$location%' or a.BusinessAddress like '%$location%') ";
            }
            if(!empty(!empty($from) && !empty($to))){
                $sql = $sql." and a.CreatedDT >= '".$from."' and a.CreatedDT < ('".$to."' + INTERVAL 1 DAY)";
            }
            if(!empty($st)){
                if($st == 6){
                    $sql = $sql." and a.StatusID=0";
                }else{
                    $sql = $sql." and a.StatusID=$st";
                }
            }
            $sql = $sql.' and a.UserID IS NOT NULL order by a.CreatedDT desc';
            $data['ads_list'] = $this->Common->get_advertier($sql);
            $this->load->view('admin/reminder/ajax/reminder_filter_data', $data);
        }
        
    }
}