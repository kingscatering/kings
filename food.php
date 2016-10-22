<!DOCTYPE html>
<html lang="en">

<head>

    <?php  include_once 'dbcall.php'; ?>
	<?php include_once'adds/scripts.php'; ?>
	<?php include_once'adds/javascripts.php'; ?>
	
</head>


<body>

	
    <!-- Page Content -->
    <div class="container">
		<br>
        <!-- Page Heading/Breadcrumbs -->
        <div class="row">	
            <div class="col-md-12">
    			<div align="center">
                    <h1>
                        Package 
                        <?php 
                            if (isset($_GET['pack'])) {
                                echo $_GET['pack'];
                            } 
                        ?>
                    </h1>
                     <?php 
                        $query = "SELECT price, pax FROM fixed_package_details WHERE package_id =".$_GET['pack'];
                        $param = ["price", "pax"];
                        $row = $_dbCall->getResult($query, $param);
                        $tempStorage = array();

                        $tempStorage['price'] = $row[0];
                        $tempStorage['pax'] = $row[1];
                    ?>
                    <div id="pack1" style="display: block; font-size: 25px;">
                        Good for <?php echo $tempStorage['pax']?> persons for only Php <?php echo $tempStorage['price']?> + 10% Service Charge
                        <br>
                    </div>
                </div>
			<?php echo $setsd; ?>
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