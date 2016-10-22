<!DOCTYPE html>
<html lang="en">

<head>

	<?php include_once'adds/scripts.php'; ?>
	
	<?php include_once'adds/javascripts.php'; ?>
<style>
#calendar_wrap{
	width: 924px;
	margin-left: auto;
	margin-right: auto;
	overflow: hidden;
}
.title_bar{
	width: 100%;
	height: 30px;
}
.previous_month{
	float: left;
	width: 308px;
	height: 30px;
	text-align: left;
}
.show_month{
	float: left;
	width: 308px;
	height: 30px;
	text-align: center;
}
.next_month{
	float: left;
	width: 308px;
	height: 30px;
	text-align: right;
}
.week_days{
	width: 100%;
}
.days_of_week{
	float: left;
	width: 14%;
	text-align: center;
}
.cal_day{
	position: relative;
	float: left;
	margin-right: 4px;
	margin-bottom: 4px;
	width: 128px;
	height: 95px;
	background-color: #9c9;
}
.day_heading{
	position: relative;
	float: left;
	width: 40px;
	height: 16px;
	padding: 6px;
	color: #000;
	font-family: Arial;
	font-size: 14px;
}
.openings{
	width: 100%;
	clear: left;
	text-align: center;
}
.non_cal_day{
	position: relative;
	float: left;
	margin-right: 4px;
	margin-bottom: 4px;
	width: 128px;
	height: 95px;
	background-color: #CCC;
}
.clear{
	clear: both;
}
.openings{
	width: 100%;
	clear: left;
	text-align: center;
}
/* overlay*/

#overlay{
	display: none;
	position: absolute;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	z-index: 2000;
	background: #000;
	opacity: .9;
}
#events{
	display: none;
	width: 80%;
	border: 4px solid #9C9;
	padding: 15px;
	z-index: 3000;
	margin-top: 100px;
	margin-right: auto;
	margin-left: auto;
	background-color: #FFF;
	height: 400px;
	overflow: scroll;
}
#eventControl{
	display: none;
	width: 100%;
	height: 30px;
	z-index: 3000;
}
#eventBody{
	display: none;
	width: 100%;
	z-index: 3000;
}
</style>
</head>


<body onload="initialCalendar();">

    <?php include_once'adds/nav.php'; ?>
<script>
function initialCalendar(){
	var hr = new XMLHttpRequest();
	var url = "calendar_start.php";
	var currentTime = new Date();
	var month = currentTime.getMonth() + 1;
	var year = currentTime.getFullYear();
	showmonth = month;
	showyear = year;
	var vars = "showmonth="+showmonth+"&showyear="+showyear;
	hr.open("POST", url, true);
	hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	hr.onreadystatechange = function(){
		if(hr.readyState == 4 && hr.status == 200){
			var return_data = hr.responseText;
			document.getElementById("showCalendar").innerHTML = return_data;
		}
	}
	hr.send(vars);
	document.getElementById("showCalendar").innerHTML = "processing...";
}
</script>
<script>
function next_month(){
	var nextmonth = showmonth + 1;
	if(nextmonth > 12){
		nextmonth = 1;
		showyear = showyear + 1;
	}
	showmonth = nextmonth;
	var hr = new XMLHttpRequest();
	var url = "calendar_start.php";
	var vars = "showmonth="+showmonth+"&showyear="+showyear;
	hr.open("POST", url, true);
	hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	hr.onreadystatechange = function(){
		if(hr.readyState == 4 && hr.status == 200){
			var return_data = hr.responseText;
			document.getElementById("showCalendar").innerHTML = return_data;
		}
	}
	hr.send(vars);
	document.getElementById("showCalendar").innerHTML = "processing...";
}
</script>
<script>
function last_month(){
	var lastmonth = showmonth - 1;
	if(lastmonth < 1){
		lastmonth = 12;
		showyear = showyear - 1;
	}
	showmonth = lastmonth;
	var hr = new XMLHttpRequest();
	var url = "calendar_start.php";
	var vars = "showmonth="+showmonth+"&showyear="+showyear;
	hr.open("POST", url, true);
	hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	hr.onreadystatechange = function(){
		if(hr.readyState == 4 && hr.status == 200){
			var return_data = hr.responseText;
			document.getElementById("showCalendar").innerHTML = return_data;
		}
	}
	hr.send(vars);
	document.getElementById("showCalendar").innerHTML = "processing...";
}
</script>
<script>
function overlay(){
	el = document.getElementById("overlay");
	el.style.display = (el.style.display == "block") ? "none" : "block";
	el = document.getElementById("events");
	el.style.display = (el.style.display == "block") ? "none" : "block";
	el = document.getElementById("eventsBody");
	el.style.display = (el.style.display == "block") ? "none" : "block";
}
</script>
<script language="JavaScript" type="text/javascript">
function show_details(theId){
	var deets = (theId.id);
	el = document.getElementById("overlay");
	el.style.display = (el.style.display == "block") ? "none" : "block";
	el = document.getElementById("events");
	el.style.display = (el.style.display == "block") ? "none" : "block";
	var hr = new XMLHttpRequest();
	var url = "events.php";
	var vars = "deets="+deets;
	hr.open("POST", url, true);
	hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	hr.onreadystatechange = function(){
		if(hr.readyState == 4 && hr.status == 200){
			var return_data = hr.responseText;
			document.getElementById("events").innerHTML = return_data;
		}
	}
	hr.send(vars);
	document.getElementById("events").innerHTML = "processing...";
}
</script>
    <!-- Page Content -->
    <div class="container">
		<br>
		<br>
		<br>
        <!-- Page Heading/Breadcrumbs -->
        <div class="row">	
				<div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Events
                        </div>
                        <div class="panel-body">
<div id="showCalendar"></div>
<div id="overlay">
	<div id="events"></div>
</div>
                        </div>
                    </div>
                </div>
        </div>

		<br />
        <br />
        <br />
        <br />

    </div>
    <!-- /.container -->

</body>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    // $(document).ready(function() {
        // $('#dataTables-example').dataTable();
    // });
    </script>
</html>