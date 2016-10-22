<?php
session_start();
include 'connect.php';
$link = mysqli_connect($db_host,$db_username,$db_pass,$db_name) or die("Error " . mysqli_error($link));

$avty = $_GET['type']; 
$seco = $_GET['code']; 
$ida = $_SESSION['uids'];
	if($avty == 'sug'){
	$secm = $_GET['cm'];
	$sepa = $_GET['pak'];	
	$characters = '0123456789';
	$string = '';do{for ($i = 0; $i < 10; $i++){$string .= $characters[rand(0, strlen($characters) - 1)];}
	$ccode = $link->query("select id from tbl_reser where fcode = '$string' limit 1");
	$ccodec = $ccode->num_rows;
	} while($string == '' && $ccodec != 0);
	
	$pricelist = $link->query("SELECT * FROM tbl_menu INNER JOIN tbl_package ON tbl_menu.id=tbl_package.mid where tbl_package.pset = '$seco' and tbl_package.type = '$secm'");
	$pricelistc = $pricelist->num_rows;
	if($pricelistc>=1){while($row = $pricelist->fetch_object()){
	$link->query("insert into tbl_reser (tnsid, uid, fcode, fcourse, fname, fwala, fppserve, pak, pdate) values('$string', '$ida', '$row->code', '$row->course', '$row->name', '$row->wala', '$row->ppserve', '$sepa', now())");	
	}header("Location: trans.php?tnsid=$string");}
	}
	else if($avty == 'nor'){
	$secm = $_GET['cm'];
	$sepa = $_GET['pak'];	
	$characters = '0123456789';
	$string2 = '';do{for ($i = 0; $i < 10; $i++){$string2 .= $characters[rand(0, strlen($characters) - 1)];}
	$ccode = $link->query("select id from tbl_reser where fcode = '$string2' limit 1");
	$ccodec = $ccode->num_rows;
	} while($string2 == '' && $ccodec != 0);
	
	$pricelist = $link->query("SELECT * FROM tbl_menu INNER JOIN tbl_package ON tbl_menu.id=tbl_package.mid where tbl_package.pset = '$seco' and tbl_package.type = '$secm'");
	$pricelistc = $pricelist->num_rows;
	if($pricelistc>=1){while($row = $pricelist->fetch_object()){
	$link->query("insert into tbl_reser (tnsid, uid, fcode, fcourse, fname, fwala, fppserve, pak, pdate) values('$string2', '$ida', '$row->code', '$row->course', '$row->name', '$row->wala', '$row->ppserve', '$sepa', now())");	
	}header("Location: trans.php?tnsid=$string2");}
	}
	else if($avty == 'cuz'){	
	$sepa = $_GET['pak']; 
	$characters = '0123456789';
	$string3 = '';do{for ($i = 0; $i < 10; $i++){$string3 .= $characters[rand(0, strlen($characters) - 1)];}
	$ccode = $link->query("select id from tbl_reser where fcode = '$string3' limit 1");
	$ccodec = $ccode->num_rows;
	} while($string3 == '' && $ccodec != 0);
	
	$pricelist = $link->query("SELECT * FROM tbl_menu INNER JOIN tbl_custo ON tbl_menu.id=tbl_custo.mid where tbl_custo.code = '$seco' and tbl_custo.creator = '$ida'");
	$pricelistc = $pricelist->num_rows;
	if($pricelistc>=1){while($row = $pricelist->fetch_object()){
	$link->query("insert into tbl_reser (tnsid, uid, fcode, fcourse, fname, fwala, fppserve, pak, pdate) values('$string3', '$ida', '$row->code', '$row->course', '$row->name', '$row->wala', '$row->ppserve', '$sepa', now())");
	}header("Location: trans.php?tnsid=$string3");}
	}
	
?>