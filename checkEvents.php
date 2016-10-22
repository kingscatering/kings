<?php
	include_once ('dbCall.php');

	try {
		$query = "SELECT id, da"."te, status FROM event_reservation";
		$param = ["id", "date", "status"];
		$events = $_dbCall->getResultsArray($query, $param);

		foreach ($events as $event) {
			$dateToday = DateTime::createFromFormat('Y-m-d', date('Y-m-d'));
			$minDate = $dateToday;
			$eventDate = DateTime::createFromFormat('Y-m-d', date('Y-m-d', strtotime($event["date"])));
			$minDate->add(new DateInterval('P2D'));
			if($minDate >= $eventDate && $event["status"] == "pending") {
				$dbCall = $_dbCall->open();
				$query = "UPDATE event_reservation SET status = 'overdue' WHERE id = ".$event['id'];
				$dbCall->query($query) or trigger_error($dbCall->error."[$query]");
			}
			else if ($dateToday > $eventDate && ($event["status"] == "paid" || $event["status"] == "accepted")) {
				$dbCall = $_dbCall->open();
				$query = "UPDATE event_reservation SET status = 'finished' WHERE id = ".$event['id'];
				$dbCall->query($query) or trigger_error($dbCall->error."[$query]");	
			}
			else if ($dateToday > $eventDate && $event["status"] == "overdue") {
				$dbCall = $_dbCall->open();
				$query = "UPDATE event_reservation SET status = 'cancelled' WHERE id = ".$event['id'];
				$dbCall->query($query) or trigger_error($dbCall->error."[$query]");	
			}
		}
	} catch(exception $e) {
		echo $e;
	}
?>