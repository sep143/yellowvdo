<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class PaymentController extends MY_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->library('Paypal_refund','refund_api');
        $this->load->model('admin/Payment_model','Payment');
        $this->load->helper('custom');
        if($this->session->userdata('log_role') != 1){
            //echo 'Sorry';
            redirect(site_url('error_page'));
        }
    }
    //payment transition table datatable
    public function index(){
        $data['tital'] = $this->lang->line('payment_history');
        $data['transition'] = $this->Payment->get_payment_trans();
        $this->load->view('admin/layout/header_view', $data);
        $this->load->view('admin/payment/payment_transition');
        $this->load->view('admin/layout/footer_view');
    }
    
    //refund option
    public function refund(){
        $data['tital'] = $this->lang->line('refund_request');
        $data['done'] = 1;
        $data['refund'] = $this->Payment->get_refund_pending();
        $this->load->view('admin/layout/header_view', $data);
        $this->load->view('admin/payment/refund_request');
        $this->load->view('admin/layout/footer_view');
    }
    //all -refund option
    public function all_refund(){
        $data['tital'] = $this->lang->line('refund_request');
        $data['done'] = 0;
        $data['refund'] = $this->Payment->get_refund_trans();
        $this->load->view('admin/layout/header_view', $data);
        $this->load->view('admin/payment/refund_request_all');
        $this->load->view('admin/layout/footer_view');
    }
    
    //return refund request then action to use function by model use
    public function refund_action() {
        $id = $this->input->post('id'); //refund table ID
        $payid = $this->input->post('payid'); //payment table in update status in case admin any action then
        $msg = $this->input->post('msg');
        $status = $this->input->post('status');
        $txtid = $this->input->post('txtid');
            if($status == 1){
                $ad_id = $this->Payment->get_ad_data($id);
                $ad_data = array(
                    'StatusID'=>5,
                    'ExpiryDT'=>null
                );
                //update advertisement ad in 
                $this->Payment->update_advertisement($ad_id->AdsID, $ad_data);
                
             //Vai usar o Sandbox, ou produção?
                $sandbox = true;
                 //Campos da requisição da operação RefundTransaction.
                $requestNvp = array(
                    'USER' => 'sandeepgavankar-facilitator_api1.yahoo.co.in',
                    'PWD' => '9C5GE7LAFZ7NFH7Y',
                    'SIGNATURE' => 'AFcWxV21C7fd0v3bYYYRCpSSRl31AFSupxZasoUk6uH7.w-6BwLfOTZI',

                    'VERSION' => '92.0',
                    'METHOD'=> 'RefundTransaction',

                    'TRANSACTIONID' => $txtid,
                    'REFUNDTYPE' => 'Full'
                );

                //Envia a requisição e obtém a resposta da PayPal
                $responseNvp = $this->sendNvpRequest($requestNvp, $sandbox);

                //Verifica se a operação foi bem sucedida
                if (isset($responseNvp['ACK']) && $responseNvp['ACK'] == 'Success') {
                    echo "<html><body><h3>A transação " . $txtid . " foi estonada com sucesso. O transactionId do estorno é: " . $responseNvp['REFUNDTRANSACTIONID'] . "</h3></body></html>";
                }   
               //exit();

                /*
                    * ///Vai usar o Sandbox, ou produção?
                    $sandbox = true;

                    //Incluindo o arquivo que contém a função sendNvpRequest
                    require './sendNvpRequest.php';

                    //Incluindo o arquivo que contem as credenciais
                    require './credentials.php';

                    //Campos da requisição da operação RefundTransaction.
                    $requestNvp = array(
                        'USER' => $user,
                        'PWD' => $pswd,
                        'SIGNATURE' => $signature,

                        'VERSION' => $version,
                        'METHOD'=> 'RefundTransaction',

                        'TRANSACTIONID' => $_POST["transactionId"],
                        'REFUNDTYPE' => 'Partial',
                        'AMT' => str_replace(",", ".", str_replace(".", "", $_POST["vAmount"])),
                        'CURRENCYCODE' => 'BRL'
                    );

                    //Envia a requisição e obtém a resposta da PayPal
                    $responseNvp = sendNvpRequest($requestNvp, $sandbox);

                    //Verifica se a operação foi bem sucedida
                    if (isset($responseNvp['ACK']) && $responseNvp['ACK'] == 'Success') {
                        echo "<html><body><h3>A transação " . $_POST["transactionId"] . " foi estonada com sucesso. O transactionId do estorno é: " . $responseNvp['REFUNDTRANSACTIONID'] . "</h3></body></html>";
                    } 
             */
        }
	
        if($status == 1){
            $pay_table = array(
                'StatusID'=> $status
            );
        }else if($status == 2){
            $pay_table = array(
                'StatusID'=> 4
            );
        }
        
        $this->Payment->payment_table_update($payid, $pay_table);
        $refund_table = array(
            'AdminMsg'=> $msg,
            'Status'=>$status
        );
        $result = $this->Payment->refund_table_update($id, $refund_table);
        if($result){
            $this->session->set_flashdata('success_msg','Refund request process successfully.');
            redirect('admin/payment/refund');
        }
        
    }
    
    //refund api for paypal account to check only
    public function refund_check_api() {
        //Vai usar o Sandbox, ou produção?
                $sandbox = true;

                 //Campos da requisição da operação RefundTransaction.
                $requestNvp = array(
                    'USER' => 'sandeepgavankar-facilitator_api1.yahoo.co.in',
                    'PWD' => '9C5GE7LAFZ7NFH7Y',
                    'SIGNATURE' => 'AFcWxV21C7fd0v3bYYYRCpSSRl31AFSupxZasoUk6uH7.w-6BwLfOTZI',

                    'VERSION' => '92.0',
                    'METHOD'=> 'RefundTransaction',

                    'TRANSACTIONID' => '8VB60419NJ068321L',
//                    'TRANSACTIONID' => '10X7235620753511P',
                    'REFUNDTYPE' => 'Full'
                );

                //Envia a requisição e obtém a resposta da PayPal
                $responseNvp = $this->sendNvpRequest($requestNvp, $sandbox);

                //Verifica se a operação foi bem sucedida
                if (isset($responseNvp['ACK']) && $responseNvp['ACK'] == 'Success') {
                    echo "<html><body><h3>A transação " . $requestNvp["TRANSACTIONID"] . " foi estonada com sucesso. O transactionId do estorno é: " . $responseNvp['REFUNDTRANSACTIONID'] . "</h3></body></html>";
                } 
    }
    
    public function sendNvpRequest(array $requestNvp, $sandbox = false)
{
    //Endpoint da API
    $apiEndpoint  = 'https://api-3t.' . ($sandbox? 'sandbox.': null);
    $apiEndpoint .= 'paypal.com/nvp';
 
    //Executando a operação
    $curl = curl_init();
 
    curl_setopt($curl, CURLOPT_URL, $apiEndpoint);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($requestNvp));
 
    $response = urldecode(curl_exec($curl));
 
    curl_close($curl);
 
    //Tratando a resposta
    $responseNvp = array();
 
    if (preg_match_all('/(?<name>[^\=]+)\=(?<value>[^&]+)&?/', $response, $matches)) {
        foreach ($matches['name'] as $offset => $name) {
            $responseNvp[$name] = $matches['value'][$offset];
        }
    }
    
    //Verificando se deu tudo certo e, caso algum erro tenha ocorrido,
    //gravamos um log para depuração.
    if (isset($responseNvp['ACK']) && $responseNvp['ACK'] != 'Success') {
        if ($sandbox)   {
            echo "<html><body><h1>Houve um erro</h1><pre>" . print_r($responseNvp, true) . "</pre></body></html>";
        }
        
        for ($i = 0; isset($responseNvp['L_ERRORCODE' . $i]); ++$i) {
            $message = sprintf("PayPal NVP %s[%d]: %s\n",
                               $responseNvp['L_SEVERITYCODE' . $i],
                               $responseNvp['L_ERRORCODE' . $i],
                               $responseNvp['L_LONGMESSAGE' . $i]);

            error_log($message);
        }
    }
    return $responseNvp;
}
    
    
    //ajax call to get data Payment History Page in use
    public function allTransitions() {
        $data = $this->input->post('file');
        if($data == 'all'){
            $tlt['done'] = 0;
            $tlt['table_name'] = 'All Transitions';
            $tlt['transition'] = $this->Payment->get_payment_trans();
            $this->load->view('admin/payment/ajax_transition/transitions', $tlt);
        }else if($data == 'today'){
            $tlt['done'] = 1;
            $tlt['table_name'] = 'Today Transitions';
            $tlt['transition'] = $this->Payment->get_payment_trans_today();
            $this->load->view('admin/payment/ajax_transition/transitions', $tlt);
        }
        
    }
    
    //ajax to call refund request page in use
    public function refundTransition() {
        $rf = $this->input->post('file');
        if($rf == 'refund'){
            $tlt['done'] = 1;
            $tlt['table_name'] = 'Refund Panding List';
            $tlt['refund'] = $this->Payment->get_refund_pending();
            $this->load->view('admin/payment/ajax_transition/refunds', $tlt);
        }else if($rf == 'all_refund'){
            $tlt['done'] = 0;
            $tlt['table_name'] = 'All Refund List';
            $tlt['refund'] = $this->Payment->get_refund_trans();
            $this->load->view('admin/payment/ajax_transition/refunds', $tlt);
        }
    }
    
}