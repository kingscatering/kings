<?php 
	include_once 'dbcall.php'; 

	$id = isset($_POST['id']) ? $_POST['id'] : false;
	$album = isset($_POST['album']) ? $_POST['album'] : false;

	if($id && $album) {
		$query = "SELECT name, source FROM gallery WHERE id= '$id'";
		$param = ["name", "source"];
		$result = $_dbCall->getResult($query, $param);
		$filepath = $result[1]."/".$album."/".$result[0];

		try{
			$db = $_dbCall->open();
			$query = "UPDATE gallery SET is_deleted = true WHERE id = '$id' AND title = '$album'";
			$db->query($query) or trigger_error($db->error."[$query]");
			echo '<script>
						alert("'.$result[0].' deleted successfully");
						window.history.back();
					</script>';
		} catch(mysqli_sql_exception $e) {
			echo $e->$message;
		}

		// dangerous code tho
		if(file_exists($filepath)) {
			/*
			if(unlink($filepath)) {
				echo '<script>
						alert("'.$result[0].' deleted successfully");
						window.history.back();
					</script>';
			}
			else {
				header("Location: gallery.php");
			}
			*/
		}
	}

?>