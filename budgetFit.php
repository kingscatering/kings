<?php
	include 'session.php';
	include_once 'dbcall.php';
	
	define('PACKAGE_SEARCH', 5);
	$GLOBALS['search_threshold'] = 100;
?>


<html>
<head>
	<title>Budget Fit</title>
</head>
<body>
	<h2>Budget Fit</h2> <br>

	<form action='budgetFit.php' method="get">
		Budget: <input type="text" name="budget"/> <br>
		Pax (Max of 1000) <input type ="text" name="pax"/> <br>
		<input type="submit" text="Search"/><br><br>
	</form>
	<button onclick=reload()>Refresh</button>
</body>
<script type="text/javascript">
	function reload() {
		location.reload();
	}
</script>
</html>

<?php
	if(isset($_GET['budget']) && isset($_GET['pax'])) {
		$budget = intval($_GET['budget']);
		$pax = intval($_GET['pax']);
		for($i = 0; $i < PACKAGE_SEARCH; $i++) {
			echo search($budget, $pax, $_dbCall);
		}
	}

	function resultScriptGenerator($budgetPack, $pax) {
		$script = "";
		if(count($budgetPack > 0)) {
			$total = 0;
			$script = "<br><br><br>PACKAGE<br>";
			foreach($budgetPack as $pack) {
				$script .= $pack["name"] . "<br>";
				$total +=  $pack["price"];
			}
			ChromePhp::log($pax);
			$total *= $pax;
			$script .= "Total price: Php" . $total;
			//ChromePhp::log($script);
		}
		return $script;
	}

	function search($budget, $pax, $_dbCall) {
		try {
			$query = "SELECT course_description FROM course_description;";
			$param = ["course_description"];
			$foodTypes = $_dbCall->getResult($query, $param);
			for($i = 0; $i < count($foodTypes); $i++) {
				$isTakenType[$i] = false;
			}
			$superScript = ''; //used to make the html script for the search
			$individualBudget = $budget / $pax;
			$individualBudget = intval($individualBudget);
			$initBudget = $individualBudget;
			$budgetAllowance = ($budget * .05) / $pax;

			$randThreshold = $GLOBALS['search_threshold'];

			/* How it works
				gets a random dish type
				checks if budget can afford a dish in dish type
				gets a random dish and "buys" it if it's within budget
				Iterate until budget can't afford
			*/
			 do {
			 	$randTypeCounter = $GLOBALS["search_threshold"];
			 	do {
					$randType = mt_rand(0, count($foodTypes) - 1);
					$randTypeCounter--;
				} while($isTakenType[$randType] && $randTypeCounter > 0);
				if($randTypeCounter == 0) {
					break;
				}
				$query = "SELECT AVG(price) as ave, MAX(price) as max, MIN(id) as min_id, COUNT(*) as _count 
							FROM dish WHERE food_type = '" . $foodTypes[$randType] . "'";
				$param = ["ave", "max", "min_id", "_count"];

				$statParam = ["ave" => 0, "max" => 1, "min_id" => 2, "_count" => 3];
				$dishTypeStat = $_dbCall->getResult($query, $param);
				$randDish = mt_rand(0, $dishTypeStat[$statParam["_count"]] - 1);
				$randDish += $dishTypeStat[$statParam["min_id"]];

				$query = "SELECT name, price FROM dish WHERE id = " . $randDish;
				$param = ["name", "price"];
				$tempArray = $_dbCall->getResult($query, $param);
				$tempParam = ["name" => 0, "price" => 1];

				if ($individualBudget + $budgetAllowance >= $tempArray[$tempParam["price"]]) {
					$individualBudget -= $tempArray[$tempParam["price"]];
					foreach ($tempParam as $key => $value) {
						$mapArray[$key] = $tempArray[$value];	
					}
					$budgetPack[] = $mapArray;
					$randThreshold = $GLOBALS['search_threshold'];
					$isTakenType[$randType] = true;
				}
				else {
					$randThreshold--;
				}
			} while (($individualBudget + $budgetAllowance >= $dishTypeStat[$statParam["max"]] ||
				$individualBudget + $budgetAllowance >= $dishTypeStat[$statParam["ave"]]) && 
				$randThreshold > 0);
			if(isset($budgetPack)) {
				$superScript .= resultScriptGenerator($budgetPack, $pax);
			}
			return $superScript;
		} catch (Exception $e) {
			echo $e;
		}
	}
 
?>