<input type="hidden" name="news"
value="<?php
require_once 'core/init.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$result="";
if(isset($_POST['subscribe'])){
// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = "smtp.gmail.com";                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = "bookshareonline@gmail.com";                                     // SMTP username
    $mail->Password   = "bureksasirom";                                     // SMTP password
    $mail->SMTPSecure = "tls";//PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to
    
    //Recipients;
    $mail->setFrom($_POST['youremail'], 'BookShare Newsletter');
    $mail->addAddress($_POST['youremail']);     // Add a recipient
    //$mail->addReplyTo('petar.stankovic@gmail.com');
    
    $mail->Subject = 'Subscribe';
    // Attachments
    //$mail->addAttachment('C:\Users\Petar\Desktop\bs.jpeg');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    
    $body = '<p>Dear Mr/Ms '.$_POST['yourname'].', Wellcome to our Newsletter list.</p>';
    
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    
    $mail->Body    = $body;
    $mail->AltBody = strip_tags($body);
    
    $mail->send();
    $result = 'Thanks Mr/Ms '.$_POST['yourname'].' for subscribing on our newsletter list';
    //header('location: '.'index.php');
} catch (Exception $e) {
    $result = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

try {    

$user = new User();
$user->newsletter(array(
            'name'=>Input::get('yourname'),
            'email'=>Input::get('youremail')
));

} catch (Exception $e) {
    die();
}

}
?>">



<div id="newsletter">
<h4><?=$result ?></h4>
	<div class="containernews">		
		<h1>Our Newsletter</h1>
		<form action="index.php" method="post">			
		    <label for="Name" style="font-size: 20px;">Name: </label>
			<input type="text" name="yourname" placeholder="Enter Name..." autocomplete="off">
			<label for="youremail" style="font-size: 20px;">Your E-Mail: </label>
			<input type="email" name="youremail" placeholder="Enter Your E-Mail..." autocomplete="off">
			<button type="Submit" name="subscribe" class="button_1">Subscribe Now</button>
		</form>		
	</div>
</div>


<style>

.containernews {
	width: 90%;
	margin: auto;	
	overflow: hidden;
}

.button_1 {
	height: 38px;
	font-size: 16px;
	font-style: bold;
	background: #e8491d;
	border: 0;
	padding-left: 25px;
	padding-right: 25px;
	color: #ffffff;
}

#newsletter {
	padding: 20px;
	color: #ffffff;
	background: #35424a;
}

#newsletter h1 {
	float: left;
	margin-top: 25px;	
}

#newsletter form {
	float: right;
	margin-top: 35px;
}

#newsletter input[type="text"] {
	padding: 4px;
	height: 30px;
	width: 250px;
}

#newsletter input[type="email"] {
	padding: 4px;
	height: 30px;
	width: 250px;
}
</style>

