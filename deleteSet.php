<?php
	include_once 'adds/scripts.php';
	include_once 'dbCall.php';

	$id = isset($_POST['id']) ? $_POST['id'] : false;
	$type = isset($_SESSION['types']) ? $_SESSION['types'] : false;
	if(!$id || $type != "Admin") {
	echo '<script>
			alert("No access to this site");
			window.location.replace("index.php");
		</script>';
	} else {
		if($id && $_SESSION['types'] == "Admin") {
			$query = "DELETE FROM fixed_package WHERE package_id = $id";
			$isDeleted = false;
			try {
				$dbCall = $_dbCall->open();
				$dbCall->query($query) or trigger_error($dbCall->error."[$query]");
				$query = "DELETE FROM fixed_package_details WHERE package_id = $id";
				$dbCall->query($query) or trigger_error($dbCall->error."[$query]");
				$isDeleted = true;
			} catch(mysqli_sql_exception $e) {
				echo $e->$message;
			}
			$dbCall->close();
			if ($isDeleted) {
				echo '<script>
						alert("Package Deleted");
						window.location.replace("mngset.php");
					</script>';

			}
			else {
				echo '<script>
						alert("Error, tried to delete invalid package.");
						window.location.replace("mngset.php");
					</script>';
			}
		}
	}
?>