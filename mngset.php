<?php
	include_once'adds/scripts.php';
	include_once'adds/javascripts.php';

	$id = isset($_SESSION['uids']) ? $_SESSION['uids'] : false;
	$type = isset($_SESSION['types']) ? $_SESSION['types'] : false;
	if(!$id || $type != "Admin") {
		echo '<script>
				alert("No access to this site");
				window.location.replace("index.php");
			</script>';
	}
	else {
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<?php include_once'adds/nav.php'; ?>
	<?php include_once 'dbcall.php'; ?>
	
	<script type="text/javascript" src="fullcalendar/lib/jquery.min.js"></script>
  	<script type="text/javascript" src="js/tether.js"></script>
	<!-- <link rel='stylesheet' href="js/bootstrap.min.css"/>
  	<link rel='stylesheet' href="js/bootstrap.css"/> -->
  	<script>
    $(document).on('change', '.div-toggle', function() {
        var target = $(this).data('target');
        var show = $("option:selected", this).data('show');
        $(target).children().addClass('hide');
        $(show).removeClass('hide');
        $('#edit_id').val($(this).val());
        $('#delete_id').val($(this).val());
    });
    $(document).ready(function(){  
      $('.div-toggle').trigger('change');
  	});

  	<?php
      $query = "SELECT DISTINCT package_id FROM fixed_package where package_type = 'Fixed' ORDER BY package_id";
      $param = ["package_id"];
      $result = $_dbCall->getResult($query, $param);
      
      $packageCount = count($result);
      foreach($result as $i) {
        $innerHTML = '<object width="1000" height="500" type="text/html" data="food.php?pack='.$i.'" ></object>';
        echo 'function load_package'.$i.'(){'; 
        echo    'document.getElementById("fixed'.$i.'").innerHTML='."'".$innerHTML."'".';
        }
        ';
      }
    ?>
  	</script>

</head>
<body>	
	<div class="container">
      <h3>[<a href="addset.php">ADD</a>]</h3>
      <div class="form-group" style="padding-top: 20px;  width: 500px; ">
        <label for="foodPackage">Food Package: </label>
        <select name="foodPackage" class="form-control div-toggle" id="sel2" data-target=".foodTypeAdds">
        <?php
          foreach($result as $i) {
          echo '<option id="'.$i.'" value="'.$i.'"data-show=".fixed'.$i.'">Package '.$i.'</option>';
          }
        ?>
        </select>
        <form id="edit" action="editSet.php" method="POST">
          <input type="hidden" id="edit_id" name="id">
          <input type="submit" value="EDIT">
        </form>
        <form id="delete" action="deleteSet.php" method="POST">
          <input type="hidden" id="delete_id" name="id">
          <input type="submit" value="DELETE">
        </form>
      </div>
      <div class="container foodTypeAdds" style="padding-top:2px; padding-bottom: 2px;" >
	      <?php
	        foreach($result as $i) {
	        echo '<div id="fixed'.$i.'" class = "fixed'.$i.' hide">
	              <script type="text/javascript">
	                load_package'.$i.'();
	              </script>
	              </div>';
	        }
	      ?>
      </div>
	</div>
</body>
</html>

<?php
	}
?>