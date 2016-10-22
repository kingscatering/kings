<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
session_start();
include_once 'lib/ChromePhp.php';
require 'PHPMailer_5.2.16/PHPMailerAutoload.php';

$mail = new PHPMailer;
$subjectc = "King Philippe's Catering - Event Reservation Summary";
$mail->IsSMTP();                                      
$mail->SMTPDebug = 4;
$mail->SMTPAuth = true;
$mail->SMTPSecure = "tls";
$mail->Host = "smtp.gmail.com";
$mail->Port = 587;
$mail->IsHTML(true);
$mail->Username = "text@gmail.com";
$mail->Password = "";
$mail->SetFrom("text@gmail.com", "King Philippe's Catering");
$mail->Subject = $subjectc;
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
ChromePhp::log($_SESSION);
if(isset($_SESSION['reservation_details']['htmlResult'])){
	 $mail->Body =  $_SESSION['reservation_details']['htmlResult'] ;
	 $mail->Body .=  '<b> Please pay 50% of the amount 3 days before the event or your reservation would be cancelled. </b> Thank you for choosing King Philippe\'s Catering!';
}
else echo 'error';

$mail->AddAddress($_POST['recipient']);
if(!$mail->Send()){
	echo "<script >alert ('Message not sent, please try again!'); 
</script>";
// echo 'Message could not be sent.';
// 	    echo 'Mailer Error: ' . $mail->ErrorInfo;
} 
else{
	echo "<script >alert ('Message sent.'); 
	location.href='calendarv2.php';
	</script>";
}
?>
</body>
</html>