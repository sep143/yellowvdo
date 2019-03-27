<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Import Controller
 *
 * @author TechArise Team
 *
 * @email  info@techarise.com
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Import extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/Import_model', 'import');
        $this->load->helper('custom');
    }

    // upload xlsx|xls file
    public function index() {
//        $data['page'] = 'import';
//        $data['title'] = 'Import XLSX | TechArise';
//        $this->load->view('import/index', $data);
        $data['tital'] = 'Import Ads';
//       $data['image_limit'] = $this->Setting->get_image_limit(1);
//       $data['payment'] = $this->Setting->get_payment(1);
        $this->load->view('admin/layout/header_view', $data);
        $this->load->view('admin/import/import_ads');
        $this->load->view('admin/layout/footer_view');
    }
    public function display() {
        $data['page'] = 'import';
        $data['title'] = 'Import XLSX | TechArise';
        $data['employeeInfo'] = $this->import->employeeList();
        $this->load->view('import/display', $data);
    }    
    // import excel data
    public function save() {
        $this->load->library('excel');
        
        if ($this->input->post('importfile')) {
//            $path = ROOT_UPLOAD_IMPORT_PATH;
            $path = './uploads/import/';

            $config['upload_path'] = $path;
            $config['allowed_types'] = 'xlsx|xls|jpg|png';
            $config['remove_spaces'] = TRUE;
            $this->upload->initialize($config);
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('userfile')) {
                $error = array('error' => $this->upload->display_errors());
            } else {
                $data = array('upload_data' => $this->upload->data());
            }
            
            if (!empty($data['upload_data']['file_name'])) {
                $import_xls_file = $data['upload_data']['file_name'];
            } else {
                $import_xls_file = 0;
            }
            $inputFileName = $path . $import_xls_file;
            try {
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch (Exception $e) {
                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                        . '": ' . $e->getMessage());
            }
            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
            
            $arrayCount = count($allDataInSheet);
            $flag = 0;
            $createArray = array('Category_ID', 'User_ID', 'Business_Name', 'Caption_line', 'Keyword', 'Description', 'Landmark_address', 'Business_Address', 'Status');
            $makeArray = array('Category_ID' => 'Category_ID', 'User_ID' => 'User_ID', 'Business_Name' => 'Business_Name', 
                'Caption_line' => 'Caption_line', 
                'Keyword' => 'Keyword',
                'Description'=>'Description',
                'Landmark_address'=>'Landmark_address',
                'Business_Address'=>'Business_Address',
                'Status'=>'Status');
            $SheetDataKey = array();
            foreach ($allDataInSheet as $dataInSheet) {
                foreach ($dataInSheet as $key => $value) {
                    if (in_array(trim($value), $createArray)) {
                        $value = preg_replace('/\s+/', '', $value);
                        $SheetDataKey[trim($value)] = $key;
                    } else {
                        
                    }
                }
            }
            $data = array_diff_key($makeArray, $SheetDataKey);
           
            if (empty($data)) {
                $flag = 1;
            }
            if ($flag == 1) {
                for ($i = 2; $i <= $arrayCount; $i++) {
                    $addresses = array();
                    $category = $SheetDataKey['Category_ID'];
                    $user_id = $SheetDataKey['User_ID'];
                    $businessname = $SheetDataKey['Business_Name'];
                    $captionline = $SheetDataKey['Caption_line'];
                    $keyword = $SheetDataKey['Keyword'];
                    $discription = $SheetDataKey['Description'];
                    $land = $SheetDataKey['Landmark_address'];
                    $address = $SheetDataKey['Business_Address'];
                    $status = $SheetDataKey['Status'];
                    
                    $category_id = filter_var(trim($allDataInSheet[$i][$category]), FILTER_SANITIZE_STRING);
                    $user_id = filter_var(trim($allDataInSheet[$i][$user_id]), FILTER_SANITIZE_STRING);
                    $businessname = filter_var(trim($allDataInSheet[$i][$businessname]), FILTER_SANITIZE_EMAIL);
                    $captionline = filter_var(trim($allDataInSheet[$i][$captionline]), FILTER_SANITIZE_STRING);
                    $keyword = filter_var(trim($allDataInSheet[$i][$keyword]), FILTER_SANITIZE_STRING);
                    $discription = filter_var(trim($allDataInSheet[$i][$discription]), FILTER_SANITIZE_STRING);
                    $land = filter_var(trim($allDataInSheet[$i][$land]), FILTER_SANITIZE_STRING);
                    $address = filter_var(trim($allDataInSheet[$i][$address]), FILTER_SANITIZE_STRING);
                    $status = filter_var(trim($allDataInSheet[$i][$status]), FILTER_SANITIZE_STRING);
                    
                    if(!empty($user_id)){
                        $user_id = $user_id;
                    }else{
                        $user_id = null;
                    }
                    $fetchData[] = array(
                        'CategID' => $category_id, 
                        'UserID' => $user_id, 
                        'BusinessName' => $businessname, 
                        'CaptionLine' => $captionline, 
                        'Keyword' => $keyword,
                        'Description'=>$discription,
                        'LandmarkAddress'=>$land,
                        'BusinessAddress'=>$address,
                        'StatusID'=>$status);
                }              
                $data['employeeInfo'] = $fetchData;
                $this->import->setBatchImport($fetchData);
                $this->import->importData();
            } else {
                echo "Please import correct file";
            }
        }
//        $this->load->view('import/display', $data);
        $this->session->set_flashdata('success_msg','Successfully import data.');
        redirect('admin/advertisement/free-list');
    }

}
