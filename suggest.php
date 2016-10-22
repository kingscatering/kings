<!DOCTYPE html>
<html lang="en">

<head>

<?php 
    include_once 'dbcall.php';
    include_once'adds/scripts.php';
	include_once'adds/javascripts.php'; 
    
    define('PACKAGE_SEARCH', 5);
    $GLOBALS['search_threshold'] = 100;
    unset($_SESSION['budgetPack']);
?>

</head>


<body>

    <?php include_once'adds/nav.php'; ?>
	
    <!-- Page Content -->
    <div class="container">
		<br>
        <!-- Page Heading/Breadcrumbs -->
        <div class="row">	
            <div class="col-md-12">
			<form method="get" action="suggest.php" enctype="multipart/form-data" role="form">	
			<div class="col-md-6"> 
				<div class="form-group input-group">
				<span class="input-group-addon">₱</span>
				<input type="text" class="form-control" placeholder="Budget" name="budget" id="budg" onkeyup="restrict('budg')" value="<?php if(isset($_GET['budget'])){echo $_GET['budget'];} ?>" required>
				<span class="input-group-addon">.00</span>
				</div>
			</div>	
			<div class="col-md-6"> 
				<div class="form-group">
				<input class="form-control" placeholder="# of Pax (max of 1000)" name="pax" id="paks" onkeyup="restrict('paks')" maxlength="4" value="<?php if(isset($_GET['pax'])){echo $_GET['pax'];} ?>" required>
				</div>
			</div>
			<div class="col-md-6" align="left"> 
                <br><input type="submit" value="Find" class="btn btn-primary"> 
                <button onclick = reload() class="btn btn-primary">Refresh</button>
            </div>	
			
            </form>	
            </div>
			
		
			<div class="col-md-12">
			<hr>
				<div class="panel panel-primary">
                        <div class="panel-heading">
                            Suggested Menu set
                        </div>
                        <div class="panel-body">
                        <h4>*Inclusive of 10% Service Charge</h4><br>
                        <?php 
                            //ChromePhp::log($_GET);
                            if(isset($_GET['budget']) && isset($_GET['pax'])) {
                                if($_GET['pax'] > 1000) {
                                    echo "<script> alert('Number of Pax maximum of 1000!'); window.history.back(); </script>";
                                } else if($_GET['pax'] < 50) {
                                    echo "<script> alert('Number of Pax minimum of 50!'); window.history.back(); </script>";
                                }
                                $budget = intval($_GET['budget']);
                                $pax = intval($_GET['pax']);
                                for($i = 1; $i <= PACKAGE_SEARCH; $i++) {
                                    echo search($budget, $pax, $_dbCall, $i);
                                }
                            }
                            //if($des==null){$des ='<h3 align="center">No Available menu set for your budget.</h3>';}
                        ?>
                        </div>
                        <!-- <div class="panel-footer">
                            Panel Footer
                        </div> -->
                 </div>
			</div>
<?php 
    function resultScriptGenerator($budgetPack, $pax, $i) {
        $script = "";
        if(count($budgetPack > 0)) {
            $total = 0;
            $tableScript = '';
            foreach($budgetPack as $pack) {
                $tableScript .= "
                                <tr>
                                    <td>" . $pack["name"] . "</td>                        
                                </tr>
                ";
                $total +=  $pack["price"];
            }
            $total *= $pax;
            $total += ($total *0.1);
            $script .= '               
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Package '.$i.'
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive table-bordered">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            '.$tableScript.'
                                            
                                            <tr>
                                                <td colspan="3"><b>Total</b></td>
                                                <td>₱ '.number_format($total,2).'</td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="panel-footer" align="right">
                                <form action="addMenuv1.php" method="POST">
                                    <input type="hidden" value="budgetFit" name="origin_page"/>
                                    <input type="hidden" value='.$total.' name="amount"/>
                                    <input type="hidden" value='.$i.' name="budget_index"/>
                                    <input type="hidden" value='.$pax.' name="head_count"/>
                                    <input type="submit" class="btn btn-submit" value="Avail"/>
                                </form>
                            </div>
                        </div>
                        <hr>
            ';
        }
        return $script;
    }
    
    //Algorithm to do budget fit
    function search($budget, $pax, $_dbCall, $index) {
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

                $query = "SELECT name, price, id as dish_id FROM dish WHERE id = " . $randDish;
                $param = ["name", "price", "dish_id"];
                $tempArray = $_dbCall->getResult($query, $param);
                $tempParam = ["name" => 0, "price" => 1, "dish_id" => 2];

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
                $superScript .= resultScriptGenerator($budgetPack, $pax, $index);
                $_SESSION['budgetPack'][$index] = $budgetPack;
            }
            return $superScript;
        } catch (Exception $e) {
            echo $e;
        }
    }
?>
		
        </div>
        <!-- /.row -->

        <br />
        <br />
        <br />
        <br />

    </div>
    <!-- /.container -->

</body>

</html>