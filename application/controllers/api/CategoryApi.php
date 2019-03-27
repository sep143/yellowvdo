<?php
ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//include Rest Controller library
require APPPATH . '/libraries/REST_Controller.php';

class CategoryApi extends REST_Controller {

    public function __construct($config = 'rest') {
        header('Access-Control-Allow-Origin: *');
        //header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        parent::__construct();
        //load user model
         $this->load->model('Payment_model','Payment2');
    }
    //remove html tag
    public function index_get(){
        $string = '<p>Big sale market for laptop and desktop <a href="https://sdfsdf">Hello</a></p>';
        $t = preg_replace('/<[^<|>]+?>/', '', htmlspecialchars_decode($string));
        $t = htmlentities($t, ENT_QUOTES, "UTF-8");
        $this->response([
            'status'=>true,
            'message'=>'Successfully Other page',
            'html'=> $t
        ],200);
    }
    
    //category json data call this function
    public function getCategory_get()
    {
        $defualt_payset = $this->Payment2->defaultSetUse(1); //1 = this table in ID = 1 pr fix value set rahegi 
        $payment = array(
            'amount'=>$defualt_payset->Amt,
            'tax_per'=>$defualt_payset->Tax,
            'tax'=> number_format((($defualt_payset->Amt * $defualt_payset->Tax)/100),2),
            'total_amt'=>$defualt_payset->Total
        );
          $data = [];
          $parent_key = "0";
          $row = $this->db->query('select * from category');
            
          if($row->num_rows() > 0)
          {
              $data = $this->membersTree($parent_key);
          }else{
              $data=["id"=>"0","name"=>"No Members presnt in list","text"=>"No Members is presnt in list","nodes"=>[]];
          }
          $this->response([
            'status'=>true,
            'category'=>$data,
            'payment'=>$payment
            
        ],200);
          //echo json_encode(array_values($data));
    }
    
    public function membersTree($parent_key)
    {
        $row1 = [];
        $row = $this->db->query('SELECT * from category WHERE ParentID="'.$parent_key.'"')->result_array();
    
        foreach($row as $key => $value)
        {
           $id = $value['ID'];
           $row1[$key]['id'] = $value['ID'];
           $row1[$key]['name'] = $value['Name'];
           $row1[$key]['text'] = $value['Name'];
           $row1[$key]['image'] = $value['Icon'];
           if(!empty($this->membersTree($value['ID']))){
               $row1[$key]['children'] = array_values($this->membersTree($value['ID']));
           }
        }
        return $row1;
    }
    
    //category api end function usinf recursive using function for api-^

    

}