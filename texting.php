<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript" src="fullcalendar/lib/jquery.min.js"></script>
<!-- 	<script type="text/javascript">
		// alert('Sending Text Message');
	</script> -->
	<?php 
		include_once 'dbcall.php';
		session_start();

		if($_POST['messageType'] == 'reserve'){
			$query = "SELECT email FROM accounts WHERE username='".$_SESSION['users']."'";
    		$param = ["email"];
    		$row = $_dbCall->getResult($query, $param);
			$recipient = $row[0];
			echo " <script>",
                " $(document).ready(function(){
                    $('#emailNotif').submit();
                });",
                "</script>";
		}
		elseif ($_POST['messageType'] == 'cancel') {
			$dbCall = $_dbCall->open();
            $query = "SELECT a.email FROM accounts AS a, event_reservation AS e WHERE e.customer_id = a.id AND  e.id=".$_SESSION['event_id_toNotify'];
            $param = ["email"];
            $row = $_dbCall->getResult($query, $param);
            $recipient = $row[0];
            echo " <script>",
                " $(document).ready(function(){
                    $('#emailFormNotif').submit();
                });",
                "</script>";

		}
    	
	?>
	<script type="text/javascript"> 
		window.onload = function(){
  			// document.forms['emailForm'].submit();

		}
	</script>
</head>
<body>
<?php
//##########################################################################
// ITEXMO SEND SMS API - PHP - CURL-LESS METHOD
// Visit www.itexmo.com/developers.php for more info about this API
//##########################################################################


function itexmo($number,$message,$apicode){
	$url = 'https://www.itexmo.com/php_api/api.php';
	$itexmo = array('1' => $number, '2' => $message, '3' => $apicode);
	$param = array(
	    'http' => array(
	        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
	        'method'  => 'POST',
	        'content' => http_build_query($itexmo),
	    ),
	    "ssl"=>array(
	        "verify_peer"=>false,
	        "verify_peer_name"=>false,
	    ),
	);
	$context  = stream_context_create($param);
	return file_get_contents($url, false, $context);
}
//##########################################################################
	
	$toSend = "0";
	$toSend.=$_POST['number'];
	// echo $toSend;
	if($_POST['messageType'] =='reserve'){

		$message = "Reservation confirmed. Pls pay 50% of the amount 3 days before event date-King Philippe's Catering";
	}
	elseif ($_POST['messageType'] =='cancel') {
		$message = "Your reservation was cancelled due to failure to pay 50% of the amount due.-King Philippe's Catering";
	}
	$apicode = "PATRI396178_RTPQI";
	
	// Commented as to prevent spamming of texts

	// $result = itexmo($toSend,$message,$apicode);
	

	if ($result == ""){
	echo "iTexMo: No response from server!!! <br>
	Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.	
	Please <a href=\"https://www.itexmo.com/contactus.php\">CONTACT US</a> for help. ";	

	}else if ($result == 0){
		echo "<script> alert('Message Sent!'); </script>";
		if($_POST['messageType'] =='reserve'){
		echo "<script>",
				"$(document).ready(function(){
					$('#emailForm').submit();
				});",
			"</script>";
		}
		elseif ($_POST['messageType'] =='cancel') {
		echo "<script>",
				"$(document).ready(function(){
					$('#emailFormNotif').submit();
				});",
			"</script>";	
		}
	}
	else{	
	echo "Error Num ". $result . " was encountered!";
	}
			
?>
	<form action="emailing.php" method="POST" name="emailForm" id="emailForm">	
		<input type="hidden" name="recipient" value="<?php echo $recipient;?>"/>
    </form>
    <form action="emailingNotif.php" method="POST" name="emailFormNotif" id="emailFormNotif">
		<input type="hidden" name="recipient" value="<?php echo $recipient;?>"/>
    </form>
</body>
</html>
