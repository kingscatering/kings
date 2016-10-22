<?php
$showmonth = $_POST['showmonth'];
$showyear = $_POST['showyear'];
$showmonth = preg_replace('#[^0-9]#i', '', $showmonth);
$showyear = preg_replace('#[^0-9]#i', '', $showyear);

$day_count = cal_days_in_month(CAL_GREGORIAN, $showmonth, $showyear);
$pre_days = date('w', mktime(0, 0, 0, $showmonth, 1, $showyear));
$post_days = (6 - (date('w', mktime(0, 0, 0, $showmonth, $day_count, $showyear))));

echo '<div id="calendar_wrap">';
echo '<div class="title_bar">';
echo '<div class="previous_month"> <input name="myBtm" type="submit" value="Previous Month" onclick="last_month();"> </div>';
echo '<div class="show_month">'.date('F', mktime(0, 0, 0, $showmonth, 10)).' '.$showyear.'</div>';
echo '<div class="next_month"> <input name="myBtm" type="submit" value="Next Month" onclick="next_month();"> </div>';
echo '</div>';
echo '<div class="week_days">';
echo '<div class="days_of_week">Sun</div>';
echo '<div class="days_of_week">Mon</div>';
echo '<div class="days_of_week">Tue</div>';
echo '<div class="days_of_week">Wed</div>';
echo '<div class="days_of_week">Thur</div>';
echo '<div class="days_of_week">Fri</div>';
echo '<div class="days_of_week">Sat</div>';
echo '<div class="clear"></div>';
echo '</div>';

//previous month filler days
if($pre_days != 0){
	for($i=1; $i<=$pre_days; $i++){
		echo '<div class="non_cal_day"></div>';
	}
}
//current month
//connection
include("connect.php");
mysql_connect($db_host, $db_username, $db_pass);
mysql_select_db("$db_name");
for($i =1; $i<=$day_count; $i++){
	//get events logic
	// $date = $showmonth.'/'.$i.'/'.$showyear;
	$date = $showyear.'-'.$showmonth.'-'.$i;
	// $query = mysql_query('select id from eventss where evdate = "'.$date.'"');
	$query = mysql_query('select id from tbl_reser where pdate = "'.$date.'"');
	$num_rows = mysql_num_rows($query);
	if($num_rows > 0){
		$event = "<input name='$date' type='submit' value='Details' id='$date' onclick='show_details(this);'>";
	}
	
	echo '<div class="cal_day">';
	echo '<div class="day_heading">'.$i.'</div>';
	//show event button
	if($num_rows != 0){
		echo "<div class='openings'><br>".$event."</div>";
	}
	// if($num_rows == 0){
		// echo "<div class='openings'><br>".$event."</div>";
		// echo "<input name='$date' type='submit' value='Add event' id='$date'>";
	// }
	echo '</div>';
}
//next month filler days
if($post_days != 0){
	for($i=1; $i<=$post_days; $i++){
		echo '<div class="non_cal_day"></div>';
	}
}
echo '</div>';
?>