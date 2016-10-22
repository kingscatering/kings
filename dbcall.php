<?php
	//config
	//include_once 'lib/ChromePHP.php';
	class dbCall {

		public function dbCall() {
			$this->open();
		}

		public function open() {
			$db_host = "localhost";
			$db_username = "root"; 
			$db_pass = "";
			$db_name = "kings";
			$dbCall = new mysqli($db_host, $db_username, $db_pass, $db_name);
			if ($dbCall->connect_errno) {
			    echo "Failed to connect to MySQL: (" . $dbCall->connect_errno . ") " . $dbCall->connect_error;
			}
			$_SESSION['db'] = $dbCall;
			//echo $dbCall->host_info;
			return $dbCall;
		}

		public function close() {

			if(isset($_SESSION["db"])) {
				mysqli_close($_SESSION["db"]);
			}
		}

		public function dbLogin($username, $password) {
			include 'session.php';
			try {
				$dbCall = $this->open();
				$success = false;
				if ($dbCall->connect_error) {
		 		   die("Connection failed: " . $dbCall->connect_error);
				}
				else {
					$pstatement = $dbCall->prepare("SELECT * FROM accounts WHERE username= ? AND password = ?");
					$pstatement->bind_param("ss", $username, $password);
					$pstatement->execute();
					$result = $pstatement->get_result();
					while($row = $result->fetch_array(MYSQLI_ASSOC)) {
						$_SESSION["userId"] = $row["id"];
						$_SESSION["username"] = $row["username"];
						$_SESSION["userType"] = $row["type"];
						$success = true;
					}
				}
				$this->close();
				return $success;
			} catch(mysqli_sql_exception $exception) {
				print $exception->$message;
			}
		}

		public function register($parameters) {
			try {
				$success = false;
				$dbCall = $this->open();
				$query = "INSERT INTO accounts (";
				$i = 0;
				foreach ($parameters as $key => $value) {
					if($i != 0) {
						$query .= ", ";
					}
					$query .= $key;
					$i++;
				}
				$i = 0;
				$query .= ") VALUES ('";
				foreach ($parameters as $key => $value) {
					if($i != 0) {
						$query .= "', '";
					}
					$query .= $parameters[$key];
					$i++;
				}
				$query .= "');";
				ChromePHP::log($query);
				if($dbCall->query($query) === true) {
					$success = true;
				}
				else {
					trigger_error($dbCall->error."[$query]");
				}
				return $success;
			} catch(mysqli_sql_exception $exception) {
				print $exception->$message;
			}
		}

		//for single row or column
		public function getResult($query, $parameters) {
			try {
				$dbCall = $this->open();
				$result = $dbCall->query($query) or trigger_error($dbCall->error."[$query]");
				$resultArray =[];
				while($row = $result->fetch_array(MYSQLI_ASSOC)) {
					//ChromePhp::log($row);
					foreach($parameters as $param) {
						$resultArray[] = $row[$param];
					}
				}
				//ChromePhp::log($resultArray);
				$this->close();
				return $resultArray;
			} catch(mysqli_sql_exception $exception) {
				echo $exception->$message;
			}
		}		

		//for multiple row
		public function getResultsArray($query, $parameters) {
			try {
				$dbCall = $this->open();
				$result = $dbCall->query($query) or trigger_error($dbCall->error."[$query]");
				$resultArray = [];
				while($row = $result->fetch_array(MYSQLI_ASSOC)) {
					foreach($parameters as $param) {
						$rowArray[$param] = $row[$param];
					}
					$resultArray[] = $rowArray;
				}
				$this->close();
				return $resultArray;
			} catch(mysqli_sql_exception $exception) {
				echo $exception->$message;
			}
		}

		public function insertReservation($table, $parameters, $values) {
			$query = "INSERT INTO ".$table."(";
			$paramCount = count($parameters);
			$vQuery = " VALUES (";
			$i = 1;
			foreach ($parameters as $param) {
				if($param == null) {
					$i++;
					continue;
				}
				$query .= $param;
				switch($param) {
					//insert all int values
					case 'customer_id':
					case 'package_id':
					case 'head_count':
					case 'time':
					
						$vQuery .= $values[$param];
					break;
					default:
						$vQuery .= "'" . $values[$param] . "'";
					break;
				}
				if($i < $paramCount) {
					$query .= ", ";
					$vQuery .= ", ";
				}
				else {
					$query .= ")";
					$vQuery .= ")";
				}
				$i++;
			}
			$query .= $vQuery;
			//ChromePhp::log($query);
			try {
				$dbCall = $this->open();
				$dbCall->query($query) or trigger_error($dbCall->error."[$query]");
			} catch (mysqli_sql_exception $e) {
				echo $e->$message;
			}
		}
	}

	//So that those who include dbcall will have to use $_dbCall as the "object" and call functions through it
	$_dbCall = new dbCall();
?>