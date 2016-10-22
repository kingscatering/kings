<?php 
//generate json
include_once("dbcall.php");

try{
	$query = "SELECT id, customer_id, event_type, head_count, da"."te, time_start, time_end, status FROM event_reservation ORDER BY id";
	$param = ["id", "customer_id", "event_type", "head_count", "date", "time_start", "time_end", "status"];

	$resultSet = $_dbCall->getResultsArray($query, $param);
	$events = [];
	foreach($resultSet as $row) {
		$e = array();
        // $e['id'] = $row['id'];
        $e['id'] = $row['id'];
        $e['title'] = $row['event_type'];
        $e['allDay'] = false;
        $e['start'] = $row['time_start'];
        $e['end'] = $row['time_end'];

        // Merge the event array into the return array
        array_push($events, $e);
	}

	// include("connect.php");
	// $dsn = 'mysql:dbname=kings;host=127.0.0.1';
	// $connection = new PDO($dsn, $db_username, $db_pass);
	// mysql_select_db("$db_name");


	// $query = "SELECT * FROM event_reservation ORDER BY id";
	// $sth = $connection->prepare($query);
	// $sth->execute();

	// $events = array();
	//   while($row = $sth->fetch(PDO::FETCH_ASSOC)){
	//         $e = array();
	//         // $e['id'] = $row['id'];
	//         $e['id'] = $row['id'];
	//         $e['title'] = $row['course_type'];
	//         $e['allDay'] = false;
	//         $e['start'] = $row['time_start'];
	//         $e['end'] = $row['time_end'];

	//         // Merge the event array into the return array
	//         array_push($events, $e);

	//     }
	    echo json_encode($events);
	    exit();
}

	catch(PDOException $e){
		echo $e->getMessage();
	}



?>