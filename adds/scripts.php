<?php session_start(); ?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">


<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="css/modern-business.css" rel="stylesheet">

<!-- Custom Fonts -->
<link href="fonts/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<link rel="shortcut icon" type="image/x-icon" href="images/Kings.ico">

<!-- jQuery -->
<script src="js/jquery.js"></script>


<script src="js/ajax.js"></script>
<script src="js/main.js"></script>
<script type="text/JavaScript" src="js/slimbox2.js"></script>
<script type='text/javascript' src='js/logging.js'></script>

<style>

#red{
color:red;
font-family:corbel;
}

#corbelblack{
color:black;
font-family:corbel;
font-size: 20px;
}

form {
	display: inline;
}

span.status{
font-size: 11px;
}

.alertify-log-custom {
	background: blue;
}

</style>

    <!-- <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="css/plugins/dataTables.bootstrap.css" rel="stylesheet">
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>
    <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script> -->

<link href="css/plugins/social-buttons.css" rel="stylesheet">

<?php
function curPageName() {
	return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
}
// echo "The current page name is ".curPageName();
?>

<link rel="stylesheet" href="themes/alertify.core.css" />
<link rel="stylesheet" href="themes/alertify.default.css" id="toggleCSS" />
<script src="js/jquery.js"></script>
<script src="lib/alertify.min.js"></script>
<script>	
		function reset () {
			$("#toggleCSS").attr("href", "themes/alertify.default.css");
			alertify.set({
				labels : {
					ok     : "OK",
					cancel : "Cancel"
				},
				delay : 5000,
				buttonReverse : false,
				buttonFocus   : "ok"
			});
		}	
</script>