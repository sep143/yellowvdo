<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class CategoryController extends MY_Controller{
    public function __construct() {
        parent::__construct();
        //load model
        $this->load->model('admin/Category_model', 'Category');
        $this->load->helper('custom');
        
        $this->lang->load('category', $this->language);
        
        $this->data['category_add'] = $this->lang->line('category_add');
        $this->data['category_category'] = $this->lang->line('category_category');
        $this->data['category_sub_category'] = $this->lang->line('category_sub_category');
        //form use
        $this->data['category_add_category'] = $this->lang->line('category_add_category');
        $this->data['category_add_placeholder_name'] = $this->lang->line('category_add_placeholder_name');
        $this->data['category_add_checkbox'] = $this->lang->line('category_add_checkbox');
        $this->data['category_image'] = $this->lang->line('category_image');
        $this->data['category_add_required_field'] = $this->lang->line('category_add_required_field');
        $this->data['subcategory_add_name'] = $this->lang->line('subcategory_add_name');
        $this->data['subcategory_add_placeholder_name'] = $this->lang->line('subcategory_add_placeholder_name');
        $this->data['category_selectImage'] = $this->lang->line('category_selectImage');
        $this->data['category_submit'] = $this->lang->line('category_submit');
        //category Table use
        $this->data['category_column_1'] = $this->lang->line('category_1');
        $this->data['category_column_2'] = $this->lang->line('category_2');
        $this->data['category_column_3'] = $this->lang->line('category_3');
        $this->data['category_column_4'] = $this->lang->line('category_4');
        $this->data['category_column_5'] = $this->lang->line('category_5');
        $this->data['category_column_6'] = $this->lang->line('category_6');
        $this->data['category_column_7'] = $this->lang->line('category_7');
        //sub category table use
    }
    
    public function index(){
       // require_once(APPPATH.'admin/ItemCategoryController.php');
       // $test = new ItemCategoryController();
        $data['tital'] = $this->lang->line('category'); //this string use to main sidebar file to get value
        $data1 = $this->data;
        $data1['category_list'] = $this->Category->get_category();
        $data1['json'] = $this->Category->getItem();
       // $data1['json'] = $test->getItem();
        $this->load->view('admin/layout/header_view', $data);
        $this->load->view('admin/category/category_view', $data1);
        $this->load->view('admin/layout/footer_view');
    }
    
    //Add category
    public function addCategory(){
        $this->form_validation->set_rules('category','Category','required|trim|xss_clean');
        if($this->form_validation->run()==FALSE){
            $this->index();
        }else{
            //Category image upload
                if(!empty($_FILES['category_image']['name'])){
                $config['upload_path'] = './uploads/category/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['category_image']['name'];
                //$config['max_size'] = '100';
                $config['encrypt_name'] = true;
                //$config['max_width']  = '1024';
                //$config['max_height']  = '768';
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('category_image')){
                    $uploadData = $this->upload->data();
                    $category = $uploadData['file_name'];
                }else{
                    $category = NULL;
                }
            }
            else{
            $category = NULL;
            }
            
            //agr category select nahi krega to null value DB me jaegi
            if(!empty($this->input->post('category_id'))){
                $parent_id = $this->input->post('category_id');
            }else{
                $parent_id = 0;
            }
            //popular category
            if(!empty($this->input->post('popular'))){
                $popular = $this->input->post('popular');
            }else{
                $popular = 0;
            }
            
            $data = array(
                'Name'=> $this->input->post('category'),
                'ParentID'=> $parent_id,
                'Popular' => $popular,
                'Icon'=> $category,
                'CreatedBy' => $this->session->userdata('log_id'),
            );
           // print_r($data); exit();
            $result = $this->Category->add_category($data);
            if($result){
                $this->session->set_flashdata('success_msg','Seccessfully Add New Category.');
                redirect(site_url('admin/category'));
            }
        }
    }
    
    //using ajax call then status update
    public function category_status_change(){
        $id = $this->input->post('id');
        $value = $this->input->post('value');
        if($id){
            $data = array(
                'StatusID'=> $value,
                'LastModifiedBy'=> $this->session->userdata('log_id'),
                'LastModifiedDT'=> date('Y-m-d H:i:s'),
            );
            $result = $this->Category->category_status_change($id, $data);
            echo $st;
        }
    }
    
    //Category Edit function
    public function edit_category($id=0){
        if($this->input->post('submit')){
            $edit_category = $this->Category->edit_category($id);
            $this->form_validation->set_rules('category','Category','required|trim|xss_clean');
        if($this->form_validation->run()==FALSE){
            $this->index();
        }else{
            //Category image upload
                if(!empty($_FILES['category_image']['name'])){
                    $path = './uploads/category/';
                    unlink($path.$edit_category->Icon);
                $config['upload_path'] = './uploads/category/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['category_image']['name'];
                //$config['max_size'] = '100';
                $config['encrypt_name'] = true;
                //$config['max_width']  = '1024';
                //$config['max_height']  = '768';
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('category_image')){
                    $uploadData = $this->upload->data();
                    $category = $uploadData['file_name'];
                }else{
                    $category = $edit_category->Icon;;
                }
            }
            else{
            $category = $edit_category->Icon;
            }
                                    
            $data = array(
                'Name'=> $this->input->post('category'),
               // 'ParentID'=> $parent_id,
                'Popular' => $this->input->post('popular'),
                'Icon'=> $category,
                'LastModifiedBy' => $this->session->userdata('log_id'),
                'LastModifiedDT' => date('Y-m-d H:i:s'),
            );
           // print_r($data); exit();
            $result = $this->Category->update_category($data, $id);
            if($result){
                $this->session->set_flashdata('success_msg','Seccessfully updated category.');
                redirect(site_url('admin/category'));
            }
        }
        }else{
            $data['tital'] = $this->lang->line('category'); //this string use to main sidebar file to get value
            $data1 = $this->data;
            $data1['category_list'] = $this->Category->get_category();
            $data1['edit_category'] = $this->Category->edit_category($id);
            $data1['brend_kram'] = $this->Category->brend_kram($id);
            $this->load->view('admin/layout/header_view', $data);
            $this->load->view('admin/category/category_edit', $data1);
            $this->load->view('admin/layout/footer_view');
        }
        
    }


    //Sub category
    public function addSubcategory(){
        $this->form_validation->set_rules('sub-category','Sub Category','required|trim|xss_clean');
        if($this->form_validation->run()==FALSE){
            $this->index();
        }else{
            $data = array(
                'Name'=> $this->input->post('sub-category'),
                'ParentID'=> $this->input->post('category_id')
            );
            print_r($data); exit();
        }
    }
}