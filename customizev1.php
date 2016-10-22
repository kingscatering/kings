<!DOCTYPE html>
<html lang="en">
<head>
	<?php include_once'adds/scripts.php'; ?>
	<?php include_once'adds/javascripts.php'; ?>
	<?php include_once'adds/nav.php'; ?>
	<?php include_once 'dbcall.php'; ?>
	
	<script type="text/javascript" src="fullcalendar/lib/jquery.min.js"></script>
  	<script type="text/javascript" src="js/tether.js"></script>
  	<script type="text/javascript" src="js/bootstrap.js"></script>
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
		var PaxNum = $('input[name=headCount]').val();
		if(paxNum < 50) {
    		$('input[name=headCount]').val("");
    		$("#minNum").show();
    	} else if (paxNum > 1000) {
    		$('input[name=headCount]').val("");
    		$("#maxNum").show();
    	} else {
    		$("#maxNum").hide();
    		$("#minNum").hide();
    		$("#customizeMenu").submit();
    	}
	}
	</script>
</head>
<body style="background-image: url('images/Kings.png'); background-repeat: no-repeat; background-attachment: fixed; background-position: right bottom;">	
	<div class="container">
	<?php
	try{
		$query1 = "SELECT DISTINCT food_type from dish ORDER BY food_type";
		$param1	= ["food_type"];
		$resultSet1 = $_dbCall->getResult($query1, $param1);

		${'form1'} = '<form class="form-horizontal" name="customizeMenu" id="customizeMenu" action="addMenuv1.php" method="POST">
			<table class="table">
			<h3> Customize Menu </h3>
			<h5> Prices displayed are on a per person basis</h5>
			<tbody>';

		foreach ($resultSet1 as $row1)	 {
			echo "<script>console.log('$row1');</script>";
			${'form1'} .= '<th colspan="3">'.$row1.'</th>';
		$query = "SELECT id, name, price, food_type FROM dish WHERE food_type ='".$row1."'";
		$param = ["id", "name", "price", "food_type"];
		$resultSet = $_dbCall->getResultsArray($query, $param);
			// ${'form1'}.='<div class="form-group">';
			foreach($resultSet as $row) {		
				echo '<script>console.log('.$row['id'].');</script>';  		
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
		${'form1'} .='<h4	 id="maxNum">Maximum number of people is 1000</h4><br>';
		${'form1'} .='<h4 id="minNum">Minimum number of people is 50</h4><br>';   
		${'form1'} .='<input type="hidden" name="origin_page" value="customize"/>';
		${'form1'} .='<div class="form-group"> <button class="btn btn-default" onclick="verifyCount()" type="submit"> Avail </button> </div>' ;  
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