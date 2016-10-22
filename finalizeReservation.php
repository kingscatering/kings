<?php
	include_once "adds/scripts.php";
	include_once "dbCall.php";
	$detailsArray = isset($_SESSION['reservation_details']) ? $_SESSION['reservation_details'] : false;

	$origin_page = isset($_SESSION['origin_page']) ? $_SESSION['origin_page'] : false;

	if($detailsArray) {
		if(strcmp($origin_page, "customize") == 0 || strcmp($origin_page, "budgetFit") == 0) {
			$query = "SELECT MAX(package_id) as package_id FROM fixed_package";
			$param = ['package_id'];
			$result = $_dbCall->getResult($query, $param);
			$package_id = intval($result[0]);
			$package_id += 1;
			$detailsArray['package_id'] = $package_id;
			try {
				foreach($detailsArray['customize_values'] as $customizeArray) {
					$query = "INSERT INTO fixed_package(package_type, package_id, dish_id, date_created) VALUES ('".$detailsArray['package_type']."', ".$package_id.", ".$customizeArray['dish_id'].", '".date("Y-m-d h:i:s")."')";
					//ChromePhp::log($query);
					$dbCall = $_dbCall->open();
					$dbCall->query($query) or trigger_error($dbCall->error."[$query]");
				}
			} catch(mysqli_sql_exception $e) {
				echo $e->$message;
			}
		}

		//$detailsArray['time_start'] = date("Y-m-d h:i:s");
		//$detailsArray['time_end'] = date("Y-m-d h:i:s");

		$dbArray = organizeArray($detailsArray);

		$param['event_reservation'] = normalizeReservationDetails($dbArray["event_reservation"]);
		$param['catering_branches'] = normalizeCateringDetails($dbArray['catering_branches']);
		try {
			reserveInDatabase("event_reservation", $dbArray["event_reservation"], $param['event_reservation'], $_dbCall);
			$query = "SELECT id FROM event_reservation ORDER BY id DESC LIMIT 1";
			$event_id = $_dbCall->getResult($query, ["id"]);
			$param['catering_branches']['event_id'] = 'event_id';
			$dbArray['catering_branches']['event_id'] = $event_id[0];
			reserveInDatabase("catering_branches", $dbArray["catering_branches"], $param["catering_branches"], $_dbCall);
		} catch(exception $e) {
			echo $e;
		}
		// unset($_SESSION['reservation_details']);
		unset($_SESSION['origin_page']);
		echo '<script>
				alert("Event reserved successfully!");
			</script>';
			// window.location.replace("calendarv2.php");
	}

	function organizeArray($detailsArray) {
		$organizedArray = [];
		$cateringArray = [];
		$reservationArray = [];

		//catering_branches column and values
		$cateringArray['contact_number'] = !isset($detailsArray['contact_number']) ? null : $detailsArray['contact_number'];
		//$cateringArray['time'] = !isset($detailsArray['time']) ? null : $detailsArray['time'];
		$cateringArray['vdate'] = !isset($detailsArray['time_start']) ? null : $detailsArray['date'];
		$cateringArray['stime'] = !isset($detailsArray['time_start']) ? null : $detailsArray['time_start'];
		$cateringArray['address'] = !isset($detailsArray['address']) ? null : $detailsArray['address'];
		$cateringArray['barangay'] = !isset($detailsArray['barangay']) ? null : $detailsArray['barangay'];
		$cateringArray['city'] = !isset($detailsArray['city']) ? null : $detailsArray['city'];
		$cateringArray['province'] = !isset($detailsArray['province']) ? null : $detailsArray['province'];
		//$cateringArray['zip'] = !isset($detailsArray['zip']) ? null : $detailsArray['zip'];
		$cateringArray['land'] = !isset($detailsArray['land']) ? null : $detailsArray['land'];

		//event_reservation column and values
		$reservationArray['customer_id'] = !isset($_SESSION['uids']) ? null : $_SESSION['uids'] ;
		$reservationArray['event_type'] = !isset($detailsArray['event_type']) ? null : $detailsArray["event_type"];
		$reservationArray['package_type'] = !isset($detailsArray['package_type']) ? null : $detailsArray["package_type"];
		$reservationArray['package_id'] = !isset($detailsArray['package_id']) ? null :  $detailsArray["package_id"];
		$reservationArray['amount'] = !isset($detailsArray['amount']) ? null : $detailsArray["amount"];
		$reservationArray['head_count'] = !isset($detailsArray['head_count']) ? null : $detailsArray["head_count"];
		$reservationArray['date'] = !isset($detailsArray['date']) ? null : $detailsArray["date"];
		$reservationArray['location'] = !isset($detailsArray['address']) ? null : $detailsArray['address'];
		$reservationArray['time_start'] = !isset($detailsArray['time_start']) ? null : $detailsArray['time_start'];
		$reservationArray['time_end'] = !isset($detailsArray['time_end']) ? null : $detailsArray['time_end'];
		
		$organizedArray["catering_branches"] = $cateringArray;
		$organizedArray["event_reservation"] = $reservationArray;
		return $organizedArray;
	}

	//get details ready for db insert, specifically for date
	function normalizeReservationDetails($detailsArray) {
		//code here
		$param = [];
		$param[] = !isset($_SESSION['uids']) ? null : "customer_id";
		$param[] = !isset($detailsArray['event_type']) ? null : "event_type";
		$param[] = !isset($detailsArray['package_type']) ? null : "package_type";
		$param[] = !isset($detailsArray['package_id']) ? null :  "package_id";
		$param[] = !isset($detailsArray['amount']) ? null : "amount";
		$param[] = !isset($detailsArray['head_count']) ? null : "head_count";
		$param[] = !isset($detailsArray['date']) ? null : "date";
		$param[] = !isset($detailsArray['location']) ? null : "location";
		$param[] = !isset($detailsArray['time_start']) ? null : "time_start";
		$param[] = !isset($detailsArray['time_end']) ? null : "time_end";

		return $param;
	}

	function normalizeCateringDetails($detailsArray) {
		$param = [];
		$param['contact_number'] = !isset($detailsArray['contact_number']) ? null : 'contact_number';
		//$param['time'] = !isset($detailsArray['time']) ? null : 'time';
		$param['vdate'] = !isset($detailsArray['vdate']) ? null : 'vdate';
		$param['stime'] = !isset($detailsArray['stime']) ? null : 'stime';
		$param['address'] = !isset($detailsArray['address']) ? null : 'address';
		$param['barangay'] = !isset($detailsArray['barangay']) ? null :'barangay';
		$param['city'] = !isset($detailsArray['city']) ? null : 'city';
		$param['province'] = !isset($detailsArray['province']) ? null :'province';
		//$param['zip'] = !isset($detailsArray['zip']) ? null : 'zip';
		$param['land'] = !isset($detailsArray['land']) ? null : 'land';
		//ChromePhp::log($param);
		return $param;
	}

	function reserveInDatabase($table, $detailsArray, $param, $_dbCall) {
		$_dbCall->insertReservation($table, $param, $detailsArray);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Finalize Reservation</title>
	<?php 
    	$query = "SELECT contact_number FROM accounts WHERE username='".$_SESSION['users']."'";
    	$param = ["contact_number"];
    	$row = $_dbCall->getResult($query, $param);
		$number = $row[0];
	?>
	<script type="text/javascript"> 
		window.onload = function(){
  			document.forms['textForm'].submit();

		}
	</script>
</head>
<body>

	 <form action="texting.php" method="POST" name="textForm">
        <input type="hidden" name="number" value="<?php echo $number;?>"/>
        <input id="messageType" type="hidden" name="messageType" value="reserve"/>
    </form>

</body>
</html>