<?php
//if "email" variable is filled out, send email
require 'PHPMailer_5.2.16/PHPMailerAutoload.php';

  if (isset($_REQUEST['email']))  {
  
  //Email information
  $mail = new PHPMailer();
  $mail->isSMTP();

  $mail->SMTPSecure = 'tls';
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Port = 587;
  $mail->SMTPDebug = 4;
  $mail->Username = 'pag.eugenio@gmail.com';
  $mail->Password = 'password_test';
  $mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

  // $mail->setFrom('potato@yahoo.com', 'Patatas');
  $mail->addAddress('paige.eugenio@gmail.com');

  $mail->isHTML(true);

  $mail->Subject = 'Here is the subject';
  $mail->Body = 'This is the HTML message body <b>in bold!</b>';
  $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	
	if(!$mail->send()) {
	    echo 'Message could not be sent.';
	    echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
   		echo 'Message has been sent';
	}
  }
  
  //if "email" variable is not filled out, display the form
  else  {
?>

 <form method="post">
  Email: <input name="email" type="text" /><br />
  Subject: <input name="subject" type="text" /><br />
  Message:<br />
  <textarea name="comment" rows="15" cols="40"></textarea><br />
  <input type="submit" value="Submit" />
  </form>
  
<?php
  }
?>