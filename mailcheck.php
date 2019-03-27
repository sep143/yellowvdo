<?php
//phpinfo();

error_reporting(E_ALL);
ini_set('display_errors','On');
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
//require 'vendor/autoload.php';
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

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
    $mail->setFrom('info@yellowvdo.com', 'Mailer');
   // $mail->addAddress('ojal@fusionfirst.com', 'Joe User');     // Add a recipient
   // $mail->addAddress('ojal15@gmail.com');
	$mail->addAddress('satish.office2018@gmail.com');	// Name is optional
    $mail->addReplyTo('info@yellowvdo.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject '.date("Y-m-d H:i:s");
    $mail->Body    = 'This is the HTML message body <b>in bold!</b> '.date("Y-m-d H:i:s");
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients. '.date("Y-m-d H:i:s");

    echo $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
return;
/*
$from = "info@yellowvdo.com";
$to = "ojal@fusionfirst.com";
$subject = "Hi!";
$body = "Hi,\n\nHow are you?";

$headers = 'From:'.$from.
'CC: ojal15@gmail.com'.
  'To:'. $to.
  'Subject:'. $subject;

echo mail($to, $headers, $body);

  echo "<p>Message successfully sent!</p>" ;
return;



//$headers = "From: info@fusionfirst.com";
//echo mail("devsb3@fusionfirst.com","My subject","First line of text\nSecond line of text"," $headers");

//
// using SendGrid's PHP Library
// https://github.com/sendgrid/sendgrid-php
//require '../sendgrid-php/vendor/autoload.php'; // If you're using Composer (recommended)
// Comment out the above line if not using Composer
// require("./sendgrid-php.php");
// If not using Composer, uncomment the above line
/*
$email = new \SendGrid\Mail\Mail();
$email->setFrom("info@fusionfirst.com", "Example User");
$email->addTo("marketing@fusionfirst.com", "Example User");

$email->setSubject("Sending with SendGrid is Fun");
$email->addContent(
    "text/plain", "and easy to do anywhere, even with PHP"
);
$email->addContent(
    "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
);



$sendgrid = new \SendGrid('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');
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
return;


require 'class.phpmailer.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    //$mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'yellowvdo.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = false;                               // Enable SMTP authentication
    $mail->Username = 'info@yellowvdo.com';                 // SMTP username ashish.dwivedi@fusionoutsourcing.com
    //$mail->Password = '@@fusion2018';                           // SMTP password mypass123
    //$mail->SMTPSecure = 'false';                            // Enable TLS encryption, `ssl` also accepted
    //$mail->Port = 25;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('info@yellowvdo.com', 'Yellow VDO');
    $mail->addAddress('ojal15@gmail.com', 'Ojal');     // Add a recipient
    $mail->addReplyTo('info@yellowvdo.com', 'Yellow VDO');

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

  echo  $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
print_r($e);
}
*/
?>