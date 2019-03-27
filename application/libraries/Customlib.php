<?php 
	if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once dirname(__FILE__) . '/PHPMailer/PHPMailer.php';
//require_once dirname(__FILE__) . '/PHPMailer/Exception.php';
	/**
	 * 
	 */
	class Customlib
	{
		var $IC;
		function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->library('session');
        $this->CI->load->library('pagination');
        $this->CI->load->library('email');
               
    }
    
    //mail
//    function send_exp_remider($email,$message,$subject) {
//        $config = Array(
//        'protocol' => 'smtp',
//        'smtp_host' => 'smtp.gmail.com',
//        'smtp_port' => 465,
//        'smtp_user' => 'satish.office2018@gmail.com', // change it to yours
//        'smtp_pass' => 'Satish#143', // change it to yours
//        'mailtype' => 'html',
//        'charset' => 'iso-8859-1',
//        'priority' => '1',
//        'wordwrap' => TRUE
//        );
//        $this->CI->load->library('email',$config);
//        $this->CI->email->set_newline("\r\n");
//        $this->CI->email->from('satish.office2018@gmail.com', "Advertisement Information");
//        $this->CI->email->to($email);
//        $this->CI->email->subject($subject);
//        $this->CI->email->message($message);
//        $this->CI->email->set_header('MIME-Version', '1.0; charset=utf-8');
//        $this->CI->email->set_header('Content-type', 'text/html');
//         $this->CI->email->send();
//    }
    
    //core mail function
function send_exp_remider($email,$message,$subject){
        // Import PHPMailer classes into the global namespace
        // These must be at the top of your script, not inside a function
        //use PHPMailer\PHPMailer\PHPMailer;
        //use PHPMailer\PHPMailer\Exception;

        // Load Composer's autoloader
        //require 'vendor/autoload.php';
        //require 'PHPMailer/Exception.php';
        //require 'PHPMailer/PHPMailer.php';
        //require 'PHPMailer/SMTP.php';
        error_reporting(E_ALL);
        ini_set('display_errors','On');


        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 2;                                       // Enable verbose debug output
            $mail->isSMTP();                                            // Set mailer to use SMTP
            $mail->Host       = 'localhost';  // Specify main and backup SMTP servers
            $mail->SMTPAuth   = false;                                   // Enable SMTP authentication
            $mail->Username   = 'info@yellowvdo.com';                     // SMTP username
            //$mail->Password   = 'secret';                               // SMTP password
            //$mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
            //$mail->Port       = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('info@yellowvdo.com', 'YellowVDO');
           // $mail->addAddress('ojal@fusionfirst.com', 'Joe User');     // Add a recipient
           // $mail->addAddress('ojal15@gmail.com');
            $mail->addAddress($email);	// Name is optional
            $mail->addReplyTo('info@yellowvdo.com', 'YellowVDO');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            // Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = $subject;
                $mail->Body = $message;
            //$mail->Subject = 'Here is the subject '.date("Y-m-d H:i:s");
            //$mail->Body    = 'This is the HTML message body <b>in bold!</b> '.date("Y-m-d H:i:s");
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients. '.date("Y-m-d H:i:s");

            echo $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        return;
    }
    //for get url then call function
    function paginate_search($base_url,$total_rows,$per_page,$uri_segment) {

$config['base_url'] = base_url().$base_url;
$config['total_rows']=$total_rows;
$config['per_page'] = $per_page;
$config['uri_segment'] = $uri_segment;
$config['use_page_numbber'] = TRUE;
$config['page_query_string'] = TRUE;
$config['reuse_query_string'] = TRUE; 

$choice = $config['total_rows']/$config['per_page'];

$config['first_link'] = 'First';
$config['first_tag_open'] = '<li>';
$config['first_tag_close'] = '</li>';

$config['last_link'] = 'Last »';
$config['last_tag_open'] = '<li class="next page">';
$config['last_tag_close'] = '</li>';

$config['next_link'] = '>>'; 
$config['next_tag_open'] = '<li>';
$config['next_tag_close'] = '';

$config['prev_link'] = '<<';
$config['prev_tag_open'] = '<li>';
$config['prev_tag_close'] = '</li>';

$config['cur_tag_open'] = '<li class="active"><a href="">';
$config['cur_tag_close'] = '</a></li>';

$config['num_tag_open'] = '<li>';
$config['num_tag_close'] = '</li>';
$config['num_links'] = round($choice);

return $config;
}

	function paginate($base_url,$total_rows,$per_page,$uri_segment) {
    	
    	$config['base_url'] = base_url().$base_url;
    	$config['total_rows']=$total_rows;
    	$config['per_page'] = $per_page;
        $config['uri_segment'] = $uri_segment;
        $config['use_page_numbber'] =  TRUE;
        $config['page_query_string'] = FALSE;
        $choice = $config['total_rows']/$config['per_page'];
        
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        
        $config['last_link'] = 'Last »';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '>>';       
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '';

        $config['prev_link'] = '<<';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['num_links'] = round($choice);

        return $config;
    }

	}
?>