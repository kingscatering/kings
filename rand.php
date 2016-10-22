<?php
$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$string = '';do{for ($i = 0; $i < 10; $i++){$string .= $characters[rand(0, strlen($characters) - 1)];}
	$ccode = $link->query("select id from tbl_menu where code = '$string' limit 1");
	$ccodec = $ccode->num_rows;
	} while($string == '' && $ccodec != 0);
?>