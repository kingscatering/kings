<?php
session_start();
include 'connect.php';
include_once("dbCall.php");
$link = mysqli_connect($db_host,$db_username,$db_pass,$db_name) or die("Error " . mysqli_error($link));


$act = $_GET['act'];
if(isset($_GET['rpid'])){$rpid = $_GET['rpid'];}else{$rpid=1;}
if(isset($_GET['maxe']) && isset($_GET['mid'])){$maxe = $_GET['maxe'];$mid = $_GET['mid'];}else{$maxe=1; $mid=1;}
switch ($act)
{

	case 'login':
	
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	$sql="select id, status, type, image from accounts where username = '$user' && password = '$pass' limit 1";
	$result = $link->query($sql);
	$count = $result->num_rows;
	if($count>=1){
		while ($row = $result->fetch_object()){
		//if($row->status == "on"){echo "<script > alert('Multiple login is not allowed!'); window.history.back();; </script>";}
		//else if($row->status != "off"){echo "<script > alert('Something is wrong with your account please contact our team!'); window.history.back();; </script>";}
		//else{
			$_SESSION['uids'] = $row->id;
			$_SESSION['users'] = $user;
			//$_SESSION['passs'] = $pass;
			$_SESSION['types'] = $row->type;
			$_SESSION['images'] = $row->image;
			$upstat = $link->query("update accounts set status = 'on', lastLogDate = now() where id = '$row->id'");
			if (isset($_SESSION['uids'])&&$_SESSION['types']=="Admin"){header("Location: index.php");}
			else if (isset($_SESSION['uids'])&&$_SESSION['types']=="Customer"){header("Location: index.php");}
		//}
		}
	} else {echo "<script > alert('Wrong Username/Password!'); window.history.back(); </script>";}
	
	break;
	
	case 'register':
	
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$user = $_POST['user'];
	$pass1 = $_POST['pass1'];
	$pass2 = $_POST['pass2'];
	$email = $_POST['email'];
	$mobile = $_POST['mobile'];
	$bday = $_POST['bday'];
	$gender = $_POST['gender'];
	$users = $link->query("select id from accounts where username = '$user' limit 1");
	$usersc = $users->num_rows;
	$emails = $link->query("select id from accounts where email = '$email' limit 1");
	$emailsc = $emails->num_rows;
	$suf = substr($mobile, 0, 3);
	$mobiles = $link->query("select id from service_provider where suf = '$suf' limit 1");
	$mobilesc = $mobiles->num_rows;
	if($usersc != 0){echo "<script>alert ('Username already exist!'); window.history.back();</script>";}
	else if(strlen($user) <= 5 || strlen($user) >= 23){echo "<script >alert ('Username must be 5 - 22 characters!'); window.history.back();</script>";}
	else if(strlen($pass1) <= 5 || strlen($pass1) >= 23){echo "<script >alert ('Password must be 5 - 22 characters!'); window.history.back();</script>";}
	else if($pass1 != $pass2){echo "<script >alert ('Password doesn\'t match!'); window.history.back();</script>";}
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){echo "<script >alert ('Invalid format of E-mail!'); window.history.back();</script>";}
	else if($emailsc != 0){echo "<script >alert ('E-mail already exist!'); window.history.back();</script>";}
	else if($mobilesc < 1 or strlen($mobile) < 10){echo "<script >alert ('Invalid format of mobile number!'); window.history.back();</script>";}
	else{$link->query("insert into accounts(first_name	, last_name	, username, password, email, contact_number, birthdate, gender, date_added, last_edit_date) values('$fname', '$lname', '$user', '$pass1', '$email', '$mobile', '$bday', '$gender', now(), now())"); echo'<script>alert("Successfully registered."); location.href="index.php";</script>';}
	
	break;

	case 'contact':
	require 'PHPMailer_5.2.16/PHPMailerAutoload.php';
	
	$fnamec = $_POST['fnamec'];	
	$lnamec = $_POST['lnamec'];	
	$subjectc = $_POST['subjectc'];	
	// $companyc = $_POST['companyc'];	
	$emailc = $_POST['emailc'];	
	$mobilec = $_POST['mobilec'];	
	$contentc = $_POST['contentc'];	
	$suf = substr($mobilec, 0, 3);
	$mobiles = $link->query("select id from service_provider where suf = '$suf' limit 1");
	$mobilesc = $mobiles->num_rows;
	if(!filter_var($emailc, FILTER_VALIDATE_EMAIL)){echo "<script>alert ('Invalid format of E-mail!'); window.history.back();</script>";}
	else if($mobilesc < 1 or strlen($mobilec) < 10){echo "<script>alert ('Invalid format of mobile number!'); window.history.back();</script>";}
	else{

$mail = new PHPMailer;
$mail->IsSMTP();                                      
$mail->SMTPDebug = 4;
$mail->SMTPAuth = true;
$mail->SMTPSecure = "tls";
$mail->Host = "smtp.gmail.com";
$mail->Port = 587;
$mail->IsHTML(true);
$mail->Username = "darwinperez691@gmail.com";
$mail->Password = "tobiasperez";
$mail->SetFrom("darwinperez691@gmail.com", "King Philippe's Catering");
$mail->Subject = $subjectc;
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
$mail->Body = '
<html>

	<head></head>
	
	<body>

From: '.$fnamec.' '.$lnamec.'<br>
Email: '.$emailc.'<br>
Mobile #: '.$mobilec.'<br>
Subject: '.$subjectc.'<br>
<br>

Dear King Philippe\'s Management,<br>
<br>
'.$contentc.'<br>
<br>
Kind regards,<br>
'.$lnamec.'<br>
	
	</body>

</html>
';
$mail->AddAddress("darwinperez691@gmail.com");
if(!$mail->Send()){
	echo "<script >alert ('Message not set, please try again!'); 
</script>";
// echo 'Message could not be sent.';
// 	    echo 'Mailer Error: ' . $mail->ErrorInfo;
} 
else{echo "<script >alert ('Message sent.'); location.href='contact.php';</script>";}
	}
	
	break;
	
	case 'logout':
	
	if($_SESSION['uids']){
	$uids = $_SESSION['uids'];
	$link->query("update accounts set status = 'off' where id='$uids'");
	session_destroy(); header("location:index.php");
	} else {session_destroy(); header("location:index.php");}
		
	break;
	
	case 'upuimage':
	
	$allowedExts = array("gif", "jpeg", "jpg", "png", "JPEG", "JPG");
	$temp = explode(".", $_FILES["uimgage"]["name"]);
	$extension = end($temp);
	if( in_array($extension, $allowedExts)){
		$uids = $_SESSION['uids'];
		$fileTmpLoc = $_FILES["uimgage"]["tmp_name"];
		$fileName = $_SESSION['users'].'.'.$extension;			
		$moveResult = move_uploaded_file($fileTmpLoc, "images/users/$fileName");
		$_SESSION['images'] = $fileName;
		$link->query("update tbl_user set image = '$fileName', lastEditDate = now() where id = '$uids'");
		echo'<script>alert("Image uploaded."); location.href="account.php?auid='.$uids.'"; </script>';
	} else {
		echo'<script>alert("The type of file is not allowed!"); window.history.back(); </script>';
	}
	
	break;
	
	case 'aceact':

	$uid = $_SESSION['uids'];
	$emailace = $_POST['emailace'];
	$passace = $_POST['passace'];

	$emailResult = $link->query("select id from accounts where email = '$emailace' && id != '$uid' limit 1");
	$emailCount = $emailResult->num_rows;

	$query = "SELECT password FROM accounts WHERE id=".$uid;
	$param = ["password"];
	$result = $_dbCall->getResult($query, $param);
	if(!filter_var($emailace, FILTER_VALIDATE_EMAIL)) {
		echo'<script>alert("Invalid E-mail format!"); window.history.back(); </script>';
	}
	else if ($emailCount != 0) {
		echo'<script>alert("E-mail already exist!"); window.history.back(); </script>';
	}
	else if (strcmp($result[0], $passace)) {
		echo'<script>alert("Incorrect password!"); window.history.back(); </script>';
	}
	else { 
		$link->query("update accounts set email = '$emailace', last_edit_date = now() where id = '$uid'")  or trigger_error($link->error."[$query]"); 
		echo'<script>alert("Successfully change."); location.href="account.php?auid='.$uid.'"; </script>';
	}
	
	break;
	
	case 'acpact':
	$uid = $_SESSION['uids']; 
	$opacp = $_POST['opacp'];
	$npacp1 = $_POST['npacp1'];
	$npacp2 = $_POST['npacp2'];

	$result = $_dbCall->getResult("SELECT password FROM accounts WHERE id =". $uid, ["password"]);
	$currPass = $result[0];

	if (strlen($npacp1) <= 5 || strlen($npacp1) >= 23) {
		echo'<script>alert("Password must be 6 - 22 characters!"); window.history.back(); </script>';
	}
	else if ($opacp != $currPass) {
		echo'<script>alert("Incorrect old password!"); window.history.back(); </script>';
	}
	else if ($npacp1 != $npacp2) {
		echo'<script>alert("Password doesn\'t match!"); window.history.back(); </script>';
	}
	else {
		$query = "update accounts set password = '$npacp1', last_edit_date = now() where id = '$uid'";
		$link->query($query) or trigger_error($link->error."[$query]");
		echo'<script>alert("Successfully change."); location.href="account.php?auid='.$uid.'"; </script>';
	}
	
	break;
	
	case 'addadm':
	
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$user = $_POST['user'];
	$pass1 = $_POST['pass1'];
	$pass2 = $_POST['pass2'];
	$email = $_POST['email'];
	$mobile = $_POST['mobile'];
	$bday = $_POST['bday'];
	$gender = $_POST['gender'];
	$type = $_POST['type'];
	$users = $link->query("select id from accounts where username = '$user' limit 1");
	$usersc = $users->num_rows;
	$emails = $link->query("select id from accounts where email = '$email' limit 1");
	$emailsc = $emails->num_rows;
	$suf = substr($mobile, 0, 3);
	$mobiles = $link->query("select id from service_provider where suf = '$suf' limit 1");
	$mobilesc = $mobiles->num_rows;
	if ($usersc != 0) {
		echo "<script>alert ('Username already exist!'); window.history.back();</script>";
	}
	else if (strlen($user) <= 5 || strlen($user) >= 23) {
		echo "<script >alert ('Username must be 5 - 22 characters!'); window.history.back();</script>";
	}
	else if (strlen($pass1) <= 5 || strlen($pass1) >= 23) {
		echo "<script >alert ('Password must be 5 - 22 characters!'); window.history.back();</script>";
	}
	else if ($pass1 != $pass2) {
		echo "<script >alert ('Password doesn\'t match!'); window.history.back();</script>";
	}
	else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo "<script >alert ('Invalid format of E-mail!'); window.history.back();</script>";
	}
	else if ($emailsc != 0) {
		echo "<script >alert ('E-mail already exist!'); window.history.back();</script>";
	}
	else if ($mobilesc < 1 or strlen($mobile) < 10) {
		echo "<script >alert ('Invalid format of mobile number!'); window.history.back();</script>";
	}
	else {
		$link->query("insert into accounts(first_name, last_name, username, password, email, contact_number, birthdate, gender, date_added, last_edit_date, last_log_date, type) values('$fname', '$lname', '$user', '$pass1', '$email', '$mobile', '$bday', '$gender', now(), now(), now(), '$type')"); 
		echo '<script>alert("Successfully registered."); location.href="mngacc.php";</script>';
	}
	
	break;
	
	case 'del':
	
	$idtd = $_GET['idtd'];
	$chesta = $link->query("select status from accounts where id = '$idtd' limit 1");
	$chestac = $chesta->num_rows;
	if ($chestac>=1) {
		while ($row = $chesta->fetch_object()) {
			if($row->status == 'on') {
				echo "<script >alert('You can\'t delete an account which is currently in use!'); window.history.back();</script>";
			}
			else {
				$link->query("delete from accounts where id = '$idtd' LIMIT 1"); echo "<script >alert('Successfully delete the account.'); location.href='mngacc.php'; </script>";
			}
		}
	}	
	
	break;
	
	case 'forgetp':
	
	$emailmis = $_POST['emailnv'];
	$emailmisq = $link->query("select id, fname, lname, lastLogDate from tbl_user where email = '$emailmis' limit 1");
	$emailmisqc = $emailmisq->num_rows;
	if(!filter_var($emailmis, FILTER_VALIDATE_EMAIL)){echo "<script >alert('Invalid format of E-mail!'); window.history.back(); </script>";}
	else if($emailmisqc != 1){echo "<script >alert('E-mail entered is not registered!'); window.history.back(); </script>";}
	else{
	if($emailmisqc>=1){
		while ($row = $emailmisq->fetch_object()){
	
require 'PHPMailer_5.2.4/class.phpmailer.php';
$mail = new PHPMailer;
$mail->IsSMTP();                                      
$mail->SMTPDebug = 1;
$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";
$mail->Host = "smtp.gmail.com";
$mail->Port = 465;
$mail->IsHTML(true);
$mail->Username = "kingphilippe032313@gmail.com";
$mail->Password = "okaylang";
$mail->SetFrom("kingphilippe032313@gmail.com");
$mail->Subject = "Forget Password";
$mail->Body = '
<html>

	<head></head>
	
	<body>
	
		<h2>Forget Password?</h2>
		<hr>
		Dear '.$row->fname.' '.$row->lname.', '.$row->id.'<br><br>
		
		<p>Someone recently requested a password change for your King Philippe’s Catering account. If this was you, you can set a new password <a href="http://localhost/Kings/resetp.php?rpid='.$row->id.'">here</a>:</p>
		
		<br>
		
		<p><a href="http://localhost/Kings/resetp.php?rpid='.$row->id.'" target="_blank" class="btn btn-outline btn-primary btn-md btn-block">Reset Password</a></p>
		
		<br>
		
		<p>If you don\'t want to change your password or didn\'t request this, just ignore and delete this message.</p>
		
		<br>
		
		<p>To keep you account secure please don\'t forward this email to anyone.</p>
		
		<br>
		Kind regards,<br>
		King Philippe\'s Team <br>
	
	</body>

</html>
';
$mail->AddAddress($emailmis);
if(!$mail->Send()){echo "<script >alert ('Message not set, please try again!'); window.history.back();</script>";} 
else{echo "<script >alert ('Please check your E-mail for your password.'); location.href='index.php';</script>";}
	}
	
		}
	}
	
	break;
		
	case 'accpiact':
	
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$mobile = $_POST['mobile'];
	$id = $_SESSION['uids'];
	$suf = substr($mobile, 0, 3);
	$mobiles = $link->query("select id from service_provider where suf = '$suf' limit 1");
	$mobilesc = $mobiles->num_rows;
	if($mobilesc < 1 or strlen($mobile) < 10){
		echo "<script >alert ('Invalid format of mobile number!'); window.history.back();</script>";
	}
	else {
		$link->query("update accounts set first_name = '$fname', last_name = '$lname', contact_number = '$mobile' where id = '$id'") or trigger_error($link->error."[$query]"); 
		echo "<script >alert('Changes saved.'); location.href='account.php?auid=$id';</script>";
	}
	
	break;
	
	case 'addapp':
	$wla = '';
	if($_GET['vid'] == '1'){$wla = 'Appetizer';}
	else if($_GET['vid'] == '2'){$wla = 'Entree';}
	else if($_GET['vid'] == '3'){$wla = 'Main course';}
	else if($_GET['vid'] == '4'){$wla = 'Dessert';}
	$mnname = $_POST['mnname'];
	$mnvar = $_POST['mnvar'];
	if(isset($_POST['mnpps'])){$mnpps = $_POST['mnpps'].'.00';}
	else if(isset($_POST['mnppsz'])){$mnpps = $_POST['mnppsz'].'.00';}
	else if(isset($_POST['mnppsx'])){$mnpps = $_POST['mnppsx'].'.00';}
	else if(isset($_POST['mnppsc'])){$mnpps = $_POST['mnppsc'].'.00';}
	
	$result = $link->query("select id from dish where name = '$mnname' limit 1");
	$count = $result->num_rows;
	if($count != 0){echo"<script >alert('This name is already existed!'); window.history.back();</script>";}
	else{$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$string = '';
	// do{for ($i = 0; $i < 10; $i++){$string .= $characters[rand(0, strlen($characters) - 1)];}
	// $ccode = $link->query("select id from dish where code = '$string' limit 1");
	// $ccodec = $ccode->num_rows;
	// } while($string == '' 
	// 	// && $ccodec != 0
	// 	);
	$link->query("insert into dish(name, course, food_type, price) values('$mnname', '$wla', '$mnvar', '$mnpps')"); echo "<script >alert('New $wla added.'); location.href='mngpck.php';</script>";}
	
	break;

	case 'delmenu':
	
	$idtd = $_GET['idtd'];
	$link->query("delete from dish where id = '$idtd' LIMIT 1"); echo "<script >alert('Successfully delete from the menu.'); location.href='mngpck.php'; </script>";
	
	break;
		
	case 'resetpass':
	
	$pass1 = $_POST['pass1'];
	$pass2 = $_POST['pass2'];
	
	if(strlen($pass1) <= 5 || strlen($pass1) >= 23){echo "<script >alert ('Password must be 5 - 22 characters!'); window.history.back();</script>";}
	else if($pass1 != $pass2){echo "<script >alert ('Password doesn\'t match!'); window.history.back();</script>";}
	else{$link->query("update tbl_user set pass = '$pass1' where id = '$rpid'"); echo "<script >alert('Successfully change password.'); location.href='index.php';</script>";}
	
	break;
	
	case 'edmedy':
	
	$mname = $_POST['mnname'.$maxe.''];
	$vari = $_POST['mnvar'.$maxe.''];
	$ppse = $_POST['mnpps'.$maxe.''].'.00';
	$result = $link->query("select id from dish where name = '$mname' && id != '$mid' limit 1");
	$count = $result->num_rows;
	if($count != 0){echo'<script>alert("This name is already existed!"); window.history.back(); </script>';}
	else{$link->query("update dish set name = '$mname', food_type = '$vari', price = '$ppse' where id = '$mid'"); echo'<script>alert("Changes saved."); location.href="mngpck.php"; </script>';}
	
	break;
	
	case 'edmedy2':
	
	$mname = $_POST['mnname2'.$maxe.''];
	$vari = $_POST['mnvar2'.$maxe.''];
	$ppse = $_POST['mnpps2'.$maxe.''].'.00';
	$result = $link->query("select id from dish where name = '$mname' && id != '$mid' limit 1");
	$count = $result->num_rows;
	if($count != 0){echo'<script>alert("This name is already existed!"); window.history.back(); </script>';}
	else{$link->query("update dish set name = '$mname', food_type = '$vari', price = '$ppse' where id = '$mid'"); echo'<script>alert("Changes saved."); location.href="mngpck.php"; </script>';}
	
	break;
	
	case 'edmedy3':
	
	$mname = $_POST['mnname3'.$maxe.''];
	$vari = $_POST['mnvar3'.$maxe.''];
	$ppse = $_POST['mnpps3'.$maxe.''].'.00';
	$result = $link->query("select id from tbl_menu where name = '$mname' && id != '$mid' limit 1");
	$count = $result->num_rows;
	if($count != 0){echo'<script>alert("This name is already existed!"); window.history.back(); </script>';}
	else{$link->query("update dish set name = '$mname', food_type = '$vari', price = '$ppse' where id = '$mid'"); echo'<script>alert("Changes saved."); location.href="mngpck.php"; </script>';}
	
	break;
	
	case 'edmedy4':
	
	$mname = $_POST['mnname4'.$maxe.''];
	$vari = $_POST['mnvar4'.$maxe.''];
	$ppse = $_POST['mnpps4'.$maxe.''].'.00';
	$result = $link->query("select id from dish where name = '$mname' && id != '$mid' limit 1");
	$count = $result->num_rows;
	if($count != 0){echo'<script>alert("This name is already existed!"); window.history.back(); </script>';}
	else{$link->query("update dish set name = '$mname', food_type = '$vari', price = '$ppse' where id = '$mid'"); echo'<script>alert("Changes saved."); location.href="mngpck.php"; </script>';}
	
	break;
	
	case 'edmedyp':
	
	$allowedExts = array("gif", "jpeg", "jpg", "png", "PNG", "JPEG", "JPG");
	$temp = explode(".", $_FILES["mpic$maxe"]["name"]);
	$extension = end($temp);
	if( in_array($extension, $allowedExts)){
		$fileTmpLoc = $_FILES["mpic$maxe"]["tmp_name"];
		$query = "SELECT name, food_type FROM dish WHERE id = '$mid'";
		$param = ["name", "food_type"];

		$result = $_dbCall->getResult($query, $param);		
		$name = $result[0];
		$food_type = $result[1];

		$query = "SELECT name FROM gallery_menu WHERE name = '$name'";
		$inGallery = count($_dbCall->getResult($query, ["name"]));
		$fileName = $name.'.'.$extension;			
		$path = "images/gal";
		$albumName = "Menu";
		$moveResult = move_uploaded_file($fileTmpLoc, $path."/".$albumName."/".$fileName);

		$query = "update dish set image = '$fileName' where id = '$mid'";
		$link->query($query) or trigger_error($link->error."[$query]");
		
		if($inGallery == 0) {
			$query = "INSERT INTO gallery(title, name, source) VALUES ('Menu', '$fileName', '$path')";
			$link->query($query) or trigger_error($link->error."[$query]");
			$query = "INSERT INTO gallery_menu(name, food_type) VALUES ('$fileName', '$food_type')";
			$link->query($query) or trigger_error($link->error."[$query]");
		}
		echo'<script>alert("Image uploaded."); location.href="mngpck.php"; </script>';
	} else {
		echo'<script>alert("The type of file is not allowed!"); window.history.back(); </script>';
	}
	
	break;
	
	case 'deloff':
	
	$idtd = $_GET['idtd'];
	$link->query("delete from amenities where id = '$idtd' LIMIT 1"); echo "<script >alert('Successfully delete from the menu.'); location.href='mngmnu.php'; </script>";
	
	break;
	
	case 'addame':
	
	$wla = '';
	if($_GET['vid'] == '1') {$type = 'Party';}
	else if($_GET['vid'] == '2'){$type = 'Wedding';}
	else if($_GET['vid'] == '3'){$type = 'Debut';}
	$amen = $_POST['amen'];	
	$link->query("insert into amenities(type, offer) values('$type', '$amen')"); echo "<script >alert('New Amenities for $type Package added.'); location.href='mngmnu.php';</script>";
	
	break;
	
	case 'offfor':
	
	$link->query("insert into amenities(type, offer) values('$wla', '$amen')"); echo "<script >alert('New Amenities for $wla Package added.'); location.href='mngmnu.php';</script>";
	
	break;
	
	case 'edame1':
	
	$amen1 = $_POST['amen1'.$maxe.''];
	$link->query("update amenities set offer = '$amen1' where id = '$mid'"); echo'<script>alert("Changes saved."); location.href="mngmnu.php"; </script>';
	
	break;
	
	case 'edame2':
	
	$amen2 = $_POST['amen2'.$maxe.''];
	$link->query("update amenities set offer = '$amen2' where id = '$mid'"); echo'<script>alert("Changes saved."); location.href="mngmnu.php"; </script>';
	
	break;
	
	case 'edame3':
	
	$amen3 = $_POST['amen3'.$maxe.''];
	$link->query("update amenities set offer = '$amen3' where id = '$mid'"); echo'<script>alert("Changes saved."); location.href="mngmnu.php"; </script>';
	
	break;
	
	case 'addotof':
	
	$offfor = $_POST['offfor'];	
	$goofor = $_POST['goofor'];	
	$link->query("insert into amenities(title, type, offer) values('$offfor', 'Other Offered', '$goofor')"); echo "<script >alert('New Other Offered Package added.'); location.href='mngmnu.php';</script>";
	
	break;
	
	case 'deloo':
	
	$idoo = $_GET['idoo'];
	$link->query("delete from amenities where id = '$idoo'"); echo "<script >alert('Successfully deleted.'); location.href='mngmnu.php';</script>";
	
	break;
	
	case 'edotof':
	
	$offfor = $_POST['offfor'];
	$goofor = $_POST['goofor'];
	$otofid = $_GET['otofid'];
	$link->query("update amenities set title = '$offfor', offer = '$goofor' where id = '$otofid'"); echo "<script >alert('Changes saved.'); location.href='mngmnu.php';</script>";
	
	break;
	
	case 'adse1':
	
	$mc = $_POST['mc'];
	$lsstnu = $link->query("select pset from tbl_package where type = 'cm1'");$lsstnuc = $lsstnu->num_rows;if($lsstnuc>=1){while($row = $lsstnu->fetch_object()){$pps = $row->pset;}$pset = $pps + 1;} else {$pset = 1;}
	$link->query("insert into tbl_package(type, pset, mid) values('cm1', '$pset', '$mc')"); echo "<script >alert('New 1 Course meal saved.'); location.href='pset.php';</script>";
	
	break;
	
	case 'adse2':
	
	$mc = $_POST['mc'];
	$de = $_POST['de'];
	$lsstnu = $link->query("select pset from tbl_package where type = 'cm2'");$lsstnuc = $lsstnu->num_rows;if($lsstnuc>=1){while($row = $lsstnu->fetch_object()){$pps = $row->pset;}$pset = $pps + 1;} else {$pset = 1;}
	$link->query("insert into tbl_package(type, pset, mid) values('cm2', '$pset', '$mc'),('cm2', '$pset', '$de')"); echo "<script >alert('New 2 Course meal saved.'); location.href='pset.php';</script>";
	
	break;
	
	case 'adse3':
	
	$ap = $_POST['ap'];
	$mc = $_POST['mc'];
	$de = $_POST['de'];
	$lsstnu = $link->query("select pset from tbl_package where type = 'cm3'");$lsstnuc = $lsstnu->num_rows;if($lsstnuc>=1){while($row = $lsstnu->fetch_object()){$pps = $row->pset;}$pset = $pps + 1;} else {$pset = 1;}
	$link->query("insert into tbl_package(type, pset, mid) values('cm3', '$pset', '$ap'), ('cm3', '$pset', '$mc'),('cm3', '$pset', '$de')"); echo "<script >alert('New 3 Course meal saved.'); location.href='pset.php';</script>";
	
	break;
	
	case 'adse4':
	
	$ap = $_POST['ap'];
	$en = $_POST['en'];
	$mc = $_POST['mc'];
	$de = $_POST['de'];
	$lsstnu = $link->query("select pset from tbl_package where type = 'cm4'");$lsstnuc = $lsstnu->num_rows;if($lsstnuc>=1){while($row = $lsstnu->fetch_object()){$pps = $row->pset;}$pset = $pps + 1;} else {$pset = 1;}
	$link->query("insert into tbl_package(type, pset, mid) values('cm4', '$pset', '$ap'), ('cm4', '$pset', '$en'), ('cm4', '$pset', '$mc'),('cm4', '$pset', '$de')"); echo "<script >alert('New 4 Course meal saved.'); location.href='pset.php';</script>";
	
	break;
	
	case 'cm2':
	
	$maxc = $_GET['maxc'];
	$curc = $_GET['curc'] + 1;
	$mc = $_POST['mc'];
	echo '<script>location.href="pset.php?maxc='.$maxc.'&curc='.$curc.'&a='.$mc.'";</script>';
	
	break;
	
	case 'cm3':
	
	if(!isset($_GET['a']) && !isset($_GET['b'])){
	$maxc = $_GET['maxc'];
	$curc = $_GET['curc'] + 1;
	$ap = $_POST['ap'];
	echo '<script>location.href="pset.php?maxc='.$maxc.'&curc='.$curc.'&a='.$ap.'";</script>';
	} else if(isset($_GET['a']) && !isset($_GET['b'])){
	$maxc = $_GET['maxc'];
	$curc = $_GET['curc'] + 1;
	$a = $_GET['a'];
	$mc = $_POST['mc'];
	echo '<script>location.href="pset.php?maxc='.$maxc.'&curc='.$curc.'&a='.$a.'&b='.$mc.'";</script>';
	}	
	
	break;
	
	case 'cm4':
	
	if(!isset($_GET['a']) && !isset($_GET['b']) && !isset($_GET['c'])){
	$maxc = $_GET['maxc'];
	$curc = $_GET['curc'] + 1;
	$ap = $_POST['ap'];
	echo '<script>location.href="pset.php?maxc='.$maxc.'&curc='.$curc.'&a='.$ap.'";</script>';
	} else if(isset($_GET['a']) && !isset($_GET['b']) && !isset($_GET['c'])){
	$maxc = $_GET['maxc'];
	$curc = $_GET['curc'] + 1;
	$a = $_GET['a'];
	$en = $_POST['en'];
	echo '<script>location.href="pset.php?maxc='.$maxc.'&curc='.$curc.'&a='.$a.'&b='.$en.'";</script>';
	} else if(isset($_GET['a']) && isset($_GET['b']) && !isset($_GET['c'])){
	$maxc = $_GET['maxc'];
	$curc = $_GET['curc'] + 1;
	$a = $_GET['a'];
	$b = $_GET['b'];
	$mc = $_POST['mc'];
	echo '<script>location.href="pset.php?maxc='.$maxc.'&curc='.$curc.'&a='.$a.'&b='.$b.'&c='.$mc.'";</script>';
	}	
	
	break;
	
	case 'custo':
	
	$cm = $_POST['cm'];
	echo '<script>location.href="customize.php?max='.$cm.'&cur=1";</script>';
	
	break;
	
	case 'sum1':
	$mc = $_POST['mc'];
	$paks = $_POST['paks'];
	if($paks > 1000){echo "<script > alert('Number of Pax maximum of 1000!'); window.history.back(); </script>";}
	else {
		echo "<script > alert('Wrong Username/Password!'); window.history.back(); </script>";
	}
	
	echo '<script>location.href="sum.php?type=1&mc='.$mc.'&paks='.$paks.'";</script>';
	
	break;
	
	case 'custo1':
	
	if(!isset($_SESSION['uids'])){echo"<script >alert('Please log in first!'); window.history.back();</script>";}
	else {
	$mc = $_GET['mc'];
	$paks = $_GET['paks'];
	$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$string = '';do{for ($i = 0; $i < 10; $i++){$string .= $characters[rand(0, strlen($characters) - 1)];}
	$ccode = $link->query("select id from tbl_custo where code = '$string' limit 1");
	$ccodec = $ccode->num_rows;
	} while($string == '' && $ccodec != 0);
	$id = $_SESSION['uids'];
	$link->query("insert into tbl_custo(code, type, mid, paks, creator, datec) values('$string', 'cm1', '$mc', '$paks', '$id', now())"); echo "<script >alert('New 1 Course meal saved.'); location.href='customize.php';</script>";
	}
	
	break;
	
	case 'sum2':
	
	$mc = $_POST['mc'];
	$de = $_POST['de'];
	$paks = $_POST['paks'];
	if($paks > 1000){echo "<script > alert('Number of Pax maximum of 1000!'); window.history.back(); </script>";}
	else {
	echo '<script>location.href="sum.php?type=2&mc='.$mc.'&de='.$de.'&paks='.$paks.'";</script>';
	}
	
	break;
	
	case 'custo2':
	
	if(!isset($_SESSION['uids'])){echo"<script >alert('Please log in first!'); window.history.back();</script>";}
	else {
	$mc = $_GET['mc'];
	$de = $_GET['de'];
	$paks = $_GET['paks'];
	$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$string = '';do{for ($i = 0; $i < 10; $i++){$string .= $characters[rand(0, strlen($characters) - 1)];}
	$ccode = $link->query("select id from tbl_custo where code = '$string' limit 1");
	$ccodec = $ccode->num_rows;
	} while($string == '' && $ccodec != 0);
	$id = $_SESSION['uids'];
	$link->query("insert into tbl_custo(code, type, mid, paks, creator, datec) values('$string', 'cm2', '$mc', '$paks', '$id', now()),('$string', 'cm2', '$de', '$paks', '$id', now())"); echo "<script >alert('New 2 Course meal saved.'); location.href='customize.php';</script>";
	}
	
	break;
	
	case 'sum3':
	
	$mc = $_POST['mc'];
	$de = $_POST['de'];
	$ap = $_POST['ap'];
	$paks = $_POST['paks'];
	if($paks > 1000){echo "<script > alert('Number of Pax maximum of 1000!'); window.history.back(); </script>";}
	else {
	echo '<script>location.href="sum.php?type=3&mc='.$mc.'&de='.$de.'&ap='.$ap.'&paks='.$paks.'";</script>';
	}
	
	break;
	
	case 'custo3':
	
	if(!isset($_SESSION['uids'])){echo"<script >alert('Please log in first!'); window.history.back();</script>";}
	else {
	$mc = $_GET['mc'];
	$de = $_GET['de'];
	$ap = $_GET['ap'];
	$paks = $_GET['paks'];
	$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$string = '';do{for ($i = 0; $i < 10; $i++){$string .= $characters[rand(0, strlen($characters) - 1)];}
	$ccode = $link->query("select id from tbl_custo where code = '$string' limit 1");
	$ccodec = $ccode->num_rows;
	} while($string == '' && $ccodec != 0);
	$id = $_SESSION['uids'];
	$link->query("insert into tbl_custo(code, type, mid, paks, creator, datec) values('$string', 'cm3', '$mc', '$paks', '$id', now()),('$string', 'cm3', '$de', '$paks', '$id', now()),('$string', 'cm3', '$ap', '$paks', '$id', now())"); echo "<script >alert('New 3 Course meal saved.'); location.href='customize.php';</script>";
	}
	
	break;
	
	case 'sum4':
	
	$mc = $_POST['mc'];
	$de = $_POST['de'];
	$ap = $_POST['ap'];
	$en = $_POST['en'];
	$paks = $_POST['paks'];
	if($paks > 1000){echo "<script > alert('Number of Pax maximum of 1000!'); window.history.back(); </script>";}
	else {
	echo '<script>location.href="sum.php?type=4&mc='.$mc.'&de='.$de.'&ap='.$ap.'&en='.$en.'&paks='.$paks.'";</script>';
	}
	
	break;
	
	case 'custo4':
	
	if(!isset($_SESSION['uids'])){echo"<script >alert('Please log in first!'); window.history.back();</script>";}
	else {
	$mc = $_GET['mc'];
	$de = $_GET['de'];
	$ap = $_GET['ap'];
	$en = $_GET['en'];
	$paks = $_GET['paks'];
	$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$string = '';do{for ($i = 0; $i < 10; $i++){$string .= $characters[rand(0, strlen($characters) - 1)];}
	$ccode = $link->query("select id from tbl_custo where code = '$string' limit 1");
	$ccodec = $ccode->num_rows;
	} while($string == '' && $ccodec != 0);
	$id = $_SESSION['uids'];
	$link->query("insert into tbl_custo(code, type, mid, paks, creator, datec) values('$string', 'cm4', '$mc', '$paks', '$id', now()),('$string', 'cm4', '$de', '$paks', '$id', now()),('$string', 'cm4', '$ap', '$paks', '$id', now()),('$string', 'cm4', '$en', '$paks', '$id', now())"); echo "<script >alert('New 4 Course meal saved.'); location.href='customize.php';</script>";
	}
	
	break;
		
	case 'daw':
	
	$bud = $_POST['budg'];
	$pak = $_POST['paks'];
	if($pak > 1000){echo "<script > alert('Number of Pax maximum of 1000!'); window.history.back(); </script>";}
	else {
	echo '<script>location.href="suggest.php?budget='.$bud.'&pax='.$pak.'";</script>';
	}
	
	break;
	
	case 'adpa':
	
	$type = $_GET['type'];
	$code = $_GET['code'];
	$cm = $_GET['cm'];
	$pak = $_POST['pak'];
	if($pak > 1000){echo "<script > alert('Number of Pax maximum of 1000!'); window.history.back(); </script>";}
	else {
	echo '<script>location.href="avail.php?type='.$type.'&code='.$code.'&cm='.$cm.'&pak='.$pak.'";</script>';
	}
	
	break;

	case 'fina':
	
	$dateE = $_POST['dateE'];
	$timeS = $_POST['timeS'];
	$addr = $_POST['addr'];
	$bara = $_POST['bara'];
	$city = $_POST['city'];
	$prov = $_POST['prov'];
	$zipc = $_POST['zipc'];
	$code = $_GET['code'];	
	if(isset($_POST['land'])){$land = $_POST['land'];}else{$land='';}
	$uids = $_SESSION['uids'];
$chdt = $link->query("select id from tbl_resdes where vdate = '$dateE'");
$chdtc = $chdt->num_rows;	
	$boom = explode("-", $dateE);
	$yr = $boom[0];
	$mn = $boom[1];
	$dy = $boom[2];
	$pyr = date('o');
	$pmn = date('m');
	$pdy = date('j');
	
	if($chdtc >= 8){
		echo "<script >alert ('King\'s Philippe have fully booked for this day.'); window.history.back();</script>";
	} else if($yr < $pyr || $mn < $pmn || $dy < $pdy){
		echo "<script >alert ('Please set a proper date.'); window.history.back();</script>";
	} else {
	
$secl = $link->query("select fname, lname, email from tbl_user where id = '$uids'");
$seclc = $secl->num_rows;
if($seclc>=1){while($row = $secl->fetch_object()){
$fname = $row->fname;
$lname = $row->lname;
$email = $row->email;
}}

$seco = $link->query("select * from tbl_reser where tnsid = '$code'");
$secoc = $seco->num_rows;$des1='';$tp=0;$tp1=0;
if($secoc>=1){while($row = $seco->fetch_object()){
$pak = $row->pak;
$pr = $row->fppserve * $row->pak;
$tp = $pr + $tp1;
$tp1 = $tp;
$des1 .='
	<tr>
		<td align="center">'.$row->fcode.'</td>							
		<td align="center">'.$row->fcourse.'</td>
		<td align="center">'.$row->fname.'</td>
		<td align="center">'.$row->fwala.'</td>							
    </tr>
';
}}
	
require 'PHPMailer_5.2.4/class.phpmailer.php';
$mail = new PHPMailer;
$mail->IsSMTP();                                      
$mail->SMTPDebug = 1;
$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";
$mail->Host = "smtp.gmail.com";
$mail->Port = 465;
$mail->IsHTML(true);
$mail->Username = "kingphilippe032313@gmail.com";
$mail->Password = "okaylang";
$mail->SetFrom("kingphilippe032313@gmail.com");
$mail->Subject = "Reservation Confirmed";
$mail->Body = '
<html>

	<head></head>
	
	<body>

		<h2>King\'s Philippe Reservation Confirmed</h2>
		<hr>
		Dear '.$fname.' '.$lname.', <br><br>
		
		<center> Order Summary </center>
							<div class="table-responsive table-bordered">
                                <table class="table" style="width:100%" cellpadding="2" cellspacing="3" border="1">
                                    <thead>
                                        <tr>
                                            <th align="center">Code</th>
                                            <th align="center">Course</th>
                                            <th align="center">Name</th>
                                            <th align="center">Variety</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        '.$des1.'
										
										<tr>
                                            <td colspan="3"><b>Total</b></td>
                                            <td align="center">₱ '.number_format($tp,2).'</td>
                                        </tr>
										
                                    </tbody>
                                </table>								
                            </div>
							
							<h4>More Details:</h4>
							
							<table border="0" cellpadding="2" cellspcing="3" width="100%">
							<tr>
							<td><b>Event Date:</b></td>
							<td>'.$dateE.'</td>
							</tr>
							
							<tr>
							<td><b>Time Start:</b></td>
							<td>'.$timeS.'</td>
							</tr>
							
							<tr>
							<td><b>Venue:</b></td>
							<td></td>
							</tr>
							
							<tr>
							<td>Address</td>
							<td>'.$addr.'</td>
							</tr>
							
							<tr>
							<td>Barangay</td>
							<td>'.$bara.'</td>
							</tr>
							
							<tr>
							<td>City</td>
							<td>'.$city.'</td>
							</tr>
							
							<tr>
							<td>Province</td>
							<td>'.$prov.'</td>
							</tr>
							
							<tr>
							<td>Zip Code</td>
							<td>'.$zipc.'</td>
							</tr>
							
							<tr>
							<td>Landmark</td>
							<td>'.$land.'</td>
							</tr>
							
							</table>			
		<br>
		
		<p>This Email servers your E-invoice for your reservation, please keep this E-invoice until the event ends. King\'s Philippe team will arrive one hour before the time of event for preparation of the event.</p>
		<br>
		<br>
		Kind regards,<br>
		King\'s Philippe Team <br>
	
	</body>

</html>
';
$mail->AddAddress($email);
// $mail->AddAddress("kingphilippe032313@gmail.com");
if(!$mail->Send()){echo "<script >alert ('Message not set, please try again!'); window.history.back();</script>";} 
else{
	$link->query("update tbl_reser set status = 'final' where tnsid = '$code'");
	$link->query("insert into tbl_resdes(retns, reuid, vdate, stime, address, barangay, city, province, zip, land) values('$code', '$uids', '$dateE', '$timeS', '$addr', '$bara', '$city', '$prov', '$zipc', '$land')");
	echo "<script >alert('Information saved.'); location.href='mytran.php?auid=$uids';</script>";
}

}

	break;
	
	case 'render':
	
	$tns = $_POST['tns'];
	$dat = $_POST['dat'];
	$pday = date('o-m-j');
	// if($dat != $pday){echo"<script >alert('Today is not the day of this Event.'); window.history.back();</script>";}
	// else{
		$link->query("update tbl_resdes set status = 'served' where retns = '$tns'");echo "<script >alert('Reservation Rendered.'); location.href='area.php';</script>";
		// }
		
	break;
	
	case 'upload':
	$fromAlbum = true;
	
	case 'addupload':
	
	$album = isset($_POST['alb']) ? $_POST['alb'] : false;
	$absolutePath = "C:\\xampp\\htdocs\kings\\images\\gal";
	$path = "images/gal";
	$cnt = 1;
	$ercnt = 0;
	if($album == false) {
		echo '<script>
				alert("Please enter an album name!");
				window.history.back();
			 </script>';
	}
	else if (!isset($_FILES)) {
		echo '<script>
				alert("Please select a file when uploading!");
				window.history.back();
			 </script>';
	}
	else {
		if(isset($fromAlbum)) {
			if(!file_exists($absolutePath."\\".$album)) {
				mkdir($absolutePath."\\".$album);
			}
		}
		foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ) {		
			$allowedExts = array("gif", "jpeg", "jpg", "png", "JPEG", "JPG", "PNG");
			$temp = explode(".", $_FILES["files"]["name"][$key]);
			
			$name = $_FILES["files"]["name"][$key];
			$extension = end($temp);
			if(in_array($extension, $allowedExts)) {
				$fileTmpLoc = $_FILES["files"]["tmp_name"][$key];
				$moveResult = move_uploaded_file($fileTmpLoc, $path."/".$album."/".$name);
				$query = "INSERT INTO gallery(name, title, source) VALUES ('$name', '$album', '$path')";
				$link->query($query) or trigger_error($link->error."$query");
				$cnt++;
			} else {
				$ercnt++;
				continue;
			}		
	    }	
		if ($cnt == 1) {
			echo "<script >alert('No new image uploaded due to invalid file type!'); location.href='gallery.php?album=$album';</script>";
		}
		else {
			if($ercnt == 0) {
				echo "<script >alert('Images uploaded.'); location.href='gallery.php?album=$album';</script>";
			}
			else {
				echo "<script >alert('Images uploaded with $ercnt file not upload due to invalid file type.'); location.href='gallery.php?album=$album';</script>";
			}
		}
	}
		
	break;
	
}


?>