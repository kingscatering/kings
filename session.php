<?php
/***
Session variables:
/////'userId' - for primary id user
'userType' - customer/admin/guest
'username' - username

***/
	if (session_status() == PHP_SESSION_NONE) {
    	session_start();
	}
	class Session {
		function validateUser() {
			$isValid = false;
			if(!isset($_SESSION['username']) && !isset($_SESSION['userType'])) {
				$_SESSION['userType'] = "guest";
			}
			if(isset($_SESSION['username'])) {
				$isValid = true;
			}
			return $isValid;
		}

		function validateUserType() {
			include_once('dbcall.php');
		}
	}

	$session = new Session();

	$_SESSION['isValid'] = $session->validateUser();
?>