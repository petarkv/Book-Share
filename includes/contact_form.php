<input type="hidden" name="news"
value="<?php 
require_once 'core/init.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$result="";
if(isset($_POST['Submit'])){
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
        $mail->setFrom($_POST['youremail'], 'Contact Message');
        $mail->addAddress("bookshareonline@gmail.com");     // Add a recipient
        $mail->addReplyTo($_POST['youremail']);
        
        $mail->Subject = 'Message';
        // Attachments
        //$mail->addAttachment('C:\Users\Petar\Desktop\bs.jpeg');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        
        $body = '<p>From: '.$_POST['firstname'].' '.$_POST['lastname'].':'.' '.$_POST['message'].'</p>';
                
        
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        
        $mail->Body    = $body;
        $mail->AltBody = strip_tags($body);
        
        $mail->send();
        $result = 'Thanks Mr/Ms '.$_POST['firstname'].' '.$_POST['lastname'].' for contacting us. We will get back to you soon!';        
    } catch (Exception $e) {
        $result = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    
    
    try {
        
        $user = new User();
        $user->contact(array(
            'first_name'=>Input::get('firstname'),
            'last_name'=>Input::get('lastname'),
            'email'=>Input::get('youremail'),
            'message'=>Input::get('message')
        ));
        
    } catch (Exception $e) {
        die();
    }  
    
}
?>">

<div style="text-align:center">
    <h2>Contact Us</h2>
    <p>Share books, or leave us a message:</p>
</div>

<div class="rowcon">
	<div class="column">
		<img src="img/map.jpg" style="width:100%">
	</div>
	<div class="column">
		<form action="contact.php" method="post">
			<label for="fname">First Name</label>
			<input type="text" id="fname" name="firstname" placeholder="Your name..">
			<label for="lname">Last Name</label>
			<input type="text" id="lname" name="lastname" placeholder="Your last name..">
			<label for="email">Your e-mail</label>
			<input type="email" id="email" name="youremail" placeholder="Your email address..">
			<label for="message">Subject</label>
			<textarea id="message" name="message" placeholder="Write something.." style="height:170px"></textarea>
			<h4><?=$result ?></h4>
			<input type="submit" name="Submit" value="Submit">
		</form>
	</div>
</div>





<style>

/* Style inputs */
input[type=text], input[type=email], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}

input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}


/* Create two columns that float next to eachother */
.column {
  float: left;
  width: 50%;
  margin-top: 6px;
  padding: 20px;
  box-sizing: border-box;
}

/* Clear floats after the columns */
.rowcon:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .column, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}
</style>





