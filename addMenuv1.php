<?php 
	include_once 'lib/ChromePhp.php';
	include_once 'adds/scripts.php'; 
 	include_once 'dbcall.php';
 	//session_start();
 	
 	define("SERVICE_CHARGE", 0.1);
 	define("MINIMUM_CUSTOMIZE", 4);
 	$originPage = isset($_POST['origin_page']) ? $_POST['origin_page'] : false;
 	$originSession = isset($_SESSION['origin_page']) ? $_SESSION['origin_page'] : false;
	if ($originPage && isset($_SESSION['uids'])) {

		$htmlResult = getDetails($_dbCall, $originPage);
		//ChromePhp::log("test");
	}
	else if ($originSession && isset($_SESSION['uids'])) {
		$htmlResult = getDetails($_dbCall, $originSession);	
	}
	else {
		include_once 'adds/nav.php'; 

		if(isset($_POST['dishID']) && is_array($_POST['dishID'])  )
		{
			echo '<div class="container"> <table class="table" align = "center" style="width:100%">';
					        echo '<tr> 
					        		<th> Name </th>
					        		<th> Price per Head </th>
					        		<th> Total Amount for Dish </th>	
					        </tr>';
			$totalAmount = 0;
			foreach($_POST['dishID'] as $dishID) {
	        // eg. "I have a grapefruit!"
				   // echo "I have a {$dishID}!";

					$query = "SELECT name, price FROM dish WHERE id=".$dishID;
					$param = ["name", "price"];
					$row = $_dbCall->getResult($query, $param);
					$events = array();
				  	# code...
					$e = array();
			        // $e['id'] = $row['id'];
			        $e['name'] = $row[0];
			        $e['price'] = $row[1];
			        echo '<tr > <td>'.$e['name'].'</td>';
			        echo '<td>'.$e['price'].'</td>';
			        echo '<td>'.$_POST['headCount'] * $e['price'].'</td></tr>';
			        $totalAmount += $_POST['headCount'] * $e['price'];
				    
			// -- insert into database call might go here
	   		}
	   		echo '<tr> <td colspan = "3"> <b> Total Amount to Pay: </b> PHP'.$totalAmount.'</tr>';
	   		echo '</table> </div>';
	   		exit();
	   	}
    }

 	function getDetails($_dbCall, $originPage) {

 		switch($originPage) {
 			case 'budgetFit':
 			if($_POST['head_count'] < 50 || $_POST['head_count'] > 1000) {
 				echo '<script>
 						alert("Invalid head count!");
 						window.history.back();
 				</script>';
 				
 			}
 			$_SESSION['origin_page'] = $_POST['origin_page'];
 			if(isset($_SESSION['budgetPack'])) {
 				$index = $_POST['budget_index'];
 				$_SESSION['reservation_details']['amount'] = $_POST['amount'];
 				$_SESSION['reservation_details']['head_count'] = $_POST['head_count'];
 				$_SESSION['reservation_details']['package_type'] = 'BudgetFit';
 				$_SESSION['reservation_details']['customize_values'] = $_SESSION['budgetPack'][$index];
 				return htmlGenerator($_SESSION['reservation_details']['customize_values']);
 			}

 			break;

 			case 'customize':
 			if($_POST['headCount'] < 50 || $_POST['headCount'] >1000) {
 				echo '<script>
 						alert("Invalid head count!");
 						window.history.back();
 				</script>';
 				
 			}
 			else {
 				$_SESSION['origin_page'] = $_POST['origin_page'];
		 		if(isset($_POST['dishID']) && isset($_POST['headCount'])) {
		 			$query = "SELECT DISTINCT food_type FROM dish";
		 			$param =["food_type"];
		 			$food_types = $_dbCall->getResult($query, $param);
		 			$typeCount = 0;

		 			$_SESSION['reservation_details']['head_count'] = $_POST['headCount'];
		 			$customizeArray = [];
		 			$totalAmount = 0;
		 			ChromePhp::log($_SESSION);
			 		foreach($_POST['dishID'] as $dishID) {
						$query = "SELECT name, price, food_type FROM dish WHERE id=".$dishID;
						$param = ["name", "price", "food_type"];
						$row = $_dbCall->getResult($query, $param);
						$rowArray['name'] = $row[0];
							$rowArray['price'] = $row[1];
							$rowArray['dish_id'] = $dishID;
							$customizeArray[] = $rowArray;
							$totalAmount += $row[1] * $_POST['headCount'];
							$index = array_search($row[2], $food_types);
							if($index) {
								$typeCount++;
								unset($food_types[$index]);
							}
					}
					if($typeCount >= MINIMUM_CUSTOMIZE) {
						$_SESSION['reservation_details']['amount'] = $totalAmount + ($totalAmount * SERVICE_CHARGE);
						$_SESSION['reservation_details']['package_type'] = 'Customize';
						$_SESSION['reservation_details']['customize_values'] = $customizeArray;
							
						return htmlGenerator($customizeArray);
					}
					else {
						echo '<script>
								alert("Please select at least 4 types of Food to continue");
								window.history.back();
								</script>';
						
					}

				}
				else {
					echo '<script>
						alert("Please make sure you provided the necessary details");
						window.history.back();
						</script>';
					
				}
			}
			break;

			case 'event_res':
				$headCount = 1; //placeholder

				$mobile = $_POST['vContactNumber'];
				$suf = substr($mobile, 0, 3);
				$query = "select id from service_provider where suf = '$suf' limit 1";
				$mobiles = $_dbCall->getResult($query, ["id"]);
				$mobilesc = count($mobiles);
				
				if($mobilesc < 1 or strlen($mobile) < 10) {
					echo "<script> 
								alert ('Invalid format of mobile number!'); 
								window.history.back();
						</script>";
					
				}

				$reservationArray = [];
				$reservationArray['customer_id'] = $_SESSION['uids'];
				$reservationArray['event_type'] = $_POST['eventType'];
				$foodPackage = $_POST['foodPackage'];
				$reservationArray['package_type'] = $_POST['foodPackage'];

				/*
				//depending on post value of date
				

					Convert time to datetime here, adding the date to the time
				*/
				$reservationArray['date'] = date("Y-m-d", strtotime($_SESSION['start_date']));
				$reservationArray['time_start'] = date("Y-m-d H:i:s", strtotime($reservationArray['date'] ." ". $_POST['start_datetime']));
				$reservationArray['time_end'] = date("Y-m-d H:i:s", strtotime($reservationArray['date'] ." ". $_POST['end_datetime']));
				// ChromePhp::log(date("Y-m-d h:i:s", strtotime($reservationArray['date'] ." ". $_POST['start_datetime'])));
				$reservationArray['address'] = $_POST['venue_address'];
				$reservationArray['barangay'] = $_POST['vBarangay'];
				$reservationArray['city'] = $_POST['vCity'];
				$reservationArray['province'] = $_POST['vProvince'];
				$reservationArray['land'] = $_POST['vLandmark'];
				$reservationArray['contact_person'] = $_POST['vContactPerson'];
				$reservationArray['contact_number'] = $_POST['vContactNumber'];

				$query = "SELECT offer FROM amenities WHERE type='".$reservationArray['event_type']."'";
				$param = ['offer'];
				$result = $_dbCall->getResultsArray($query, $param);
				$amenityArray = array();
				foreach ($result as $row) {
					array_push($amenityArray, $row["offer"]);
				}
				$reservationArray['amenity'] = $amenityArray;
				$_SESSION['reservation_details'] = $reservationArray;

				$htmlResult = '';
				
				if (strcmp($foodPackage , "BudgetFit") == 0) {
					header("Location: suggest.php");
				} 
				else if (strcmp($foodPackage, "Customize") == 0) {
					header("Location: customizev1.php");
				}
				//for fixed package
				else {
					if (strpos($foodPackage, 'fixed') !== false) {
						$reservationArray['package_id'] = str_replace('fixed', '', $foodPackage);
						$reservationArray['package_type'] = 'Fixed';
						try {
							$query = "SELECT dish.name as name, dish.price as price FROM dish INNER JOIN fixed_package ON dish.id = fixed_package.dish_id where fixed_package.package_id =" . $reservationArray['package_id'];
							$param = ["name", "price"];
							$result = $_dbCall->getResultsArray($query, $param);

							$query = "SELECT price, pax FROM fixed_package_details where id =" . $reservationArray['package_id'];
							$param = ["price", "pax"];
							$detailsResult = $_dbCall->getResult($query, $param);

							$detailsResult[0] += SERVICE_CHARGE * $detailsResult[0];
							$reservationArray["amount"] =  $detailsResult[0];
							$reservationArray["head_count"] = $detailsResult[1];
							$_SESSION['reservation_details'] = $reservationArray;
							// ChromePhp::log($_SESSION['reservation_details']);
							$htmlResult = htmlGenerator($result);
							return $htmlResult;
						} 
						catch(Exception $e) {
							echo $e;
						}
					}
				}
			break;
		}
 	} 	

    function htmlGenerator($dishResult) {
 		$htmlResult = '<div class="container"> 
 						<h1 text-align="center">Event Summary</h1>';
        $htmlResult .= '<h3> 
				        		Event Menu
				        </h3>';
		$htmlResult.=  '<table class="table" align = "center">';
		$htmlResult.=  '<tr> 
 							<td> Food Package:</td>
 							<td>'.$_SESSION['reservation_details']['package_type'];
 								if ($_SESSION['reservation_details']['package_type'] == "Fixed"){
 									$htmlResult .= ' ' .$_SESSION['reservation_details']['package_id'];
 								}	
 			$htmlResult.= '</td>
 						</tr>';
		foreach($dishResult as $row) {
			$htmlResult .= '<tr > <td colspan="2">'.$row['name'].'</td></tr>';
		}
		$htmlResult .= '</table>';
		$htmlResult .= '<h3> Amenities </h3>';
		$htmlResult .= '<table class="table" align="center"';
		foreach ($_SESSION['reservation_details']['amenity'] as $row) {
			$htmlResult .= '<tr> <td colspan="2">'.$row.'</td></tr>';
		}
			
		$htmlResult .= '</table>';
		$htmlResult .= '<h3> Venue Details </h3>';
		$htmlResult .= '<table class="table" align="center"';
		$htmlResult .= '<tr> <td> <b> Start Time: </b></td><td> '.$_SESSION['reservation_details']['time_start'].'</td></tr>';
		$htmlResult .= '<tr> <td> <b> [Approx.] End Time: </b> </td><td>'.$_SESSION['reservation_details']['time_end'].'</td></tr>';
		$htmlResult .= '<tr> <td> <b> Address: </b> </td><td>'.$_SESSION['reservation_details']['address'].'</td></tr>';
		$htmlResult .= '<tr> <td> <b> Barangay: </b> </td><td>'.$_SESSION['reservation_details']['barangay'].'</td></tr>';
		$htmlResult .= '<tr> <td> <b> City: </b> </td><td>'.$_SESSION['reservation_details']['city'].'</td></tr>';
		$htmlResult .= '<tr> <td> <b> Landmark: </b> </td><td>'.$_SESSION['reservation_details']['land'].'</td> </tr>';
		$htmlResult .= '<tr> <td> <b> Contact Person: </b> </td><td>'.$_SESSION['reservation_details']['contact_person'].'</td></tr>';
		$htmlResult .= '<tr> <td> <b> Contact Number: </b> </td><td>'.$_SESSION['reservation_details']['contact_number'].'</td></tr>';
		$htmlResult .='</table>';
		$htmlResult .= '<h3> Payment Details </h3>';
		$htmlResult .= '<table class="table" align="center">';
		$htmlResult .= '<tr> <td> <b> Pax: </b></td><td>'.$_SESSION['reservation_details']['head_count'].'</td></tr>';
		$htmlResult .= '<tr> <td> <b> Total Amount: </b></td><td>PHP '.$_SESSION['reservation_details']['amount'].'.00 *inclusive of 10% service charge</td></tr>';
		$htmlResult .= '</table> </div>';
		
		$_SESSION['reservation_details']['htmlResult'] = $htmlResult;
		return $htmlResult;
 	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->
	<script type="text/javascript" src="fullcalendar/lib/jquery.min.js"></script>
  	<script type="text/javascript" src="js/tether.min.js"></script>
  	<script type="text/javascript" src="js/bootstrap.js"></script>
	<title>Event Summary</title>
	<?php 
		if(isset($htmlResult)) { 
			echo $htmlResult; 
			} 
	?>
	<style>
	td{
		width:50%;
	}
	</style>
	<div class="container">
		<form action = "finalizeReservation.php" method="POST">
			<input type="submit" class="btn btn-submit" value="Next"/>
		</form>
		<button onclick="window.history.back()" class="btn btn-submit">Back</button>
	</div>
</head>
<body>

</body>
</html>

