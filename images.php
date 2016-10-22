<?php
	include_once 'dbCall.php';

	$album = isset($_GET['album']) ? $_GET['album'] : false;
	$id = isset($_GET['id']) ? $_GET['id'] : false;

	if($album && $id) {
		$result = $_dbCall->getImage($id, $album);
		echo $result;
	}

?>