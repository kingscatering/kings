<<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<?php
    //include_once'adds/scripts.php';
    //include_once'dbcall.php';
    //include_once 'lib/ChromePhp.php';
	$time1 = DateTime::createFromFormat('Y-m-d H:i:s', "2016-11-21 05:00:00");
	$time2 = DateTime::createFromFormat('Y-m-d H:i:s', "3 days later");

	echo date_diff($time1, $time2)->format('%h hours');
  //   $startDate = isset($_POST['start_datetime']) ? $_POST['start_datetime'] : false;
  //   if($startDate) {
  //     $query="SELECT time_start, time_end, head_count FROM event_reservation where da"."te like '".date("Y-m-d", strtotime($startDate))."%'";
  //     $param = ["time_start", "time_end", "head_count"];
  //     try {
  //       $results = $_dbCall->getResultsArray($query, $param);
  //       $events = isset($results) ? $results : false;
  //      	ChromePhp::log($results);
  //       if($events && count($events) > 8) {
  //         echo '<script>
  //                 alert("Sorry, day is already busy. Cannot reserve on this day."); 
  //                 window.history.back();
  //               </script>';
  //       }
  //       else {
  //         $head_count = 0;
  //         foreach($results as $row) {
  //           $interval = date_diff(strtotime(date("Y-m")))
  //         }
  //       }
  //     } catch(Exception $e) {
  //         echo $e;
  //     }
  // }
?>


</body>
</html>>