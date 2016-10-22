<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<?php include_once'adds/scripts.php'; ?>
	<?php include_once'adds/javascripts.php'; ?>
	<?php include_once 'adds/nav.php';?>
	<div class="container">
    <div class="page-header">
        <h2>My Transactions</h2>
    </div>
    	<div class="col-md-12">
            <div class="panel with-nav-tabs panel-default">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1default" data-toggle="tab">New Transactions</a></li>
                            <li><a data-toggle="tab">Paid Transactions</a></li>
                            <li><a data-toggle="tab">Reserved Transactions</a></li>
                            <li><a href="#tab3default" data-toggle="tab">Denied Transactions</a></li>
                        </ul>
                </div>
            </div>
        </div>
<br/>
</body>
</html>