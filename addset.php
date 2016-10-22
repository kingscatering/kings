<?php
	include_once'dbCall.php';
	include_once'adds/scripts.php';
	include_once'adds/javascripts.php';

	$id = isset($_SESSION['uids']) ? $_SESSION['uids'] : false;
	$type = isset($_SESSION['types']) ? $_SESSION['types'] : false;
	if(!$id && $type != "admin") {
		echo '<script>
				alert("No access to this site");
				window.history.back();
			</script>';
	}
	else if(isset($_POST["price"]) && isset($_POST["headCount"])) {
		$dishID = isset($_POST["dishID"]) ? $_POST["dishID"] : false;
		if($dishID) {
			$price = $_POST["price"];
			$headCount = $_POST["headCount"];
			if($headCount <50 || $headCount > 1000) {
				unset($_POST["headCount"]);
				echo '<script>
					alert("Invalid head count");
					location.reload();
				 </script>';
			}
			try {
				$success = true;
				$dishID = $_POST["dishID"];
				$query = "SELECT MAX(package_id) as maxID FROM fixed_package";
				$result = $_dbCall->getResult($query, ["maxID"]);
				$maxID = $result[0] + 1;
				$dbCall = $_dbCall->open();

				if(isset($_POST["dish_id"])) {
					$maxID = $_POST["dish_id"];
					$query = "DELETE FROM fixed_package WHERE package_id =".$maxID;
					$dbCall->query($query) or trigger_error($dbCall->error."[$query]");
					echo '<br> delete1'.$query;

					$query = "DELETE FROM fixed_package_details WHERE package_id =".$maxID;
					$dbCall->query($query) or trigger_error($dbCall->error."[$query]");
					echo '<br> delete2'.$query;
				}
				
				$query = "INSERT INTO fixed_package_details(package_id, price, pax) VALUES ($maxID, $price, $headCount)";
				$dbCall->query($query) or trigger_error($dbCall->error."[$query]");
				echo '<br>2 '.$query;
				foreach ($dishID as $dish) {
					$query = "INSERT INTO fixed_package(package_type, package_id, dish_id, date_created) VALUES ('Fixed', $maxID, $dish,'".date("Y-m-d")."')";
					$dbCall->query($query) or trigger_error($dbCall->error."[$query]");
					echo '<br>2 '.$query;
				}
			} catch(exception $e) {
				$success = false;
				echo $e;
			}
			unset($_POST["price"]);
			unset($_POST["headCount"]);
			echo '<script>
					alert("Dishes added successfully");
					window.location.replace("mngset.php");
				 </script>';
		} else {
			unset($_POST["price"]);
			unset($_POST["headCount"]);
			echo '<script>
					alert("No dishes selected");
					location.reload();
				 </script>';
		}
	}
	else {
?>

<!DOCTYPE html>
<html lang="en">
<head>

	<?php include_once'adds/nav.php'; ?>
	
	<script type="text/javascript" src="fullcalendar/lib/jquery.min.js"></script>
	<!-- <link rel='stylesheet' href="js/bootstrap.min.css"/>
  	<link rel='stylesheet' href="js/bootstrap.css"/> -->

	<script>
	$(document).ready(function() {

    // your users id to reference the services in the database query
    var businessID = "1" // replace this with the users id

    $("#maxNum").hide();
    $("#minNum").hide();

    $("#headCount").change(function() {
    	var paxNum = $('input[name=headCount]').val();
    	if(paxNum < 50) {
    		$('input[name=headCount]').val("");
    		$("#minNum").show();
    	} else if (paxNum > 1000) {
    		$('input[name=headCount]').val("");
    		$("#maxNum").show();
    	} else {
    		$("#maxNum").hide();
    		$("#minNum").hide();
    	}
    });

    // Do a basic post to and external php file
    $.post('post.api.php', {'api': 'getServices', 'business_id': businessID}, function(resp){

        // parse the response and check the boxes
        var obj = $.parseJSON(resp);
        // loop through the services returned as active (checked)
        $.each(obj, function(i, value){

            // Check the checkbox with the corresponding value
            $('input[type="checkbox"][value="'+value.service+'"]').attr('checked', true);

        });
    });

	});

	function verifyCount() {
		var paxNum = $('input[name=headCount]').val();
    	var price = $('input[name=price]').val();
    	var hasErrors = false;
		if(isNaN(paxNum)){

		}
		else if (paxNum < 50){
    		$('input[name=headCount]').val("");
    		$("#minNum").show();
    		hasErrors = true;
    	} else if (paxNum > 1000) {
    		$('input[name=headCount]').val("");
    		$("#maxNum").show();
    		hasErrors = true;
    	} else {
    		$("#maxNum").hide();
    		$("#minNum").hide();
    	}
    	if(isNaN(price) || price == "") {
    		alert("Enter a valid price");
    		hasErrors = true;
    	}
    	if(!hasErrors) {
    		$("#customizeMenu").submit();
    	}
	}
	</script>
</head>
<body>	
	<div class="container">
	<?php
	try{
		$query1 = "SELECT DISTINCT food_type from dish ORDER BY food_type";
		$param1	= ["food_type"];
		$resultSet1 = $_dbCall->getResult($query1, $param1);

		${'form1'} = '<form class="form-horizontal" name="customizeMenu" id="customizeMenu" action="addset.php" method="POST">
			<table class="table">
			<h3> Add Package </h3>
			<h5> Prices displayed are on a per person basis</h5>
			<tbody>';

		foreach ($resultSet1 as $row1)	 {
			${'form1'} .= '<th colspan="3">'.$row1.'</th>';
		$query = "SELECT id, name, price, food_type FROM dish WHERE food_type ='".$row1."'";
		$param = ["id", "name", "price", "food_type"];
		$resultSet = $_dbCall->getResultsArray($query, $param);
			// ${'form1'}.='<div class="form-group">';
			foreach($resultSet as $row) {				
				${'form1'} .= '<tr>
						<td> <input type="checkbox" name="dishID[]" value="'.$row['id'].'" class="CheckboxGroup_0" id='.$row['id'].' /> </td>
			  			<td> <input type="hidden" name="dishName" value="'.$row['name'].'"/>'.$row['name'].'</td>
			  			<td>Php '.$row['price'].'</td>
			  			</tr>';
			}
			${'form1'}.='</div>';
		}
		  
		${'form1'} .='</tbody>
					</table>
					<h5> <b> Drinks selected are botomless</b> </h5> 
					
					<label> Pax: <input type="text" name="headCount" id="headCount"/><br> </label> <br>' ;
		${'form1'} .='<label> Price: <input type="text" name="price"/></label>';
		${'form1'} .='<h4 id="maxNum">Maximum number of people is 1000</h4><br>';
		${'form1'} .='<h4 id="minNum">Minimum number of people is 50</h4><br>';  
		${'form1'} .='<div class="form-group"> <button class="btn btn-default" onclick="verifyCount()"> Avail </button> </div>' ;  
		${'form1'} .='</form>';
 		echo ${'form1'};
		exit();

	}catch(PDOException $e){
		echo $e->getMessage();
	}
	?>
	</div>
</body>
</html>

<?php
	}
?>