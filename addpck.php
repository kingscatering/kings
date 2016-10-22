<!DOCTYPE html>
<html lang="en">

<head>

	<?php include_once'adds/scripts.php'; ?>
	
	<?php include_once'adds/javascripts.php'; ?>
	
</head>


<body>

    <?php include_once'adds/nav.php'; ?>
	
    <!-- Page Content -->
    <div class="container">
		<br>
        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
			<div class="col-md-12">
			<h3>Create New Package</h3>
	        </div>
			
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
				<div>
                    <p>
                        <strong>Process</strong>
						<span class="pull-right text-muted"><?php echo $pers; ?> Complete</span>
                    </p>
                    <div class="progress progress-striped active">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $pers; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $pers; ?>">
                        <span class="sr-only"><?php echo $pers; ?> Complete</span>
                    </div>
                    </div>					
                </div>
					
				</div>
				<div class="col-md-2"></div>
				
				<div class="col-md-12">
					
					<div class="form-group">
                    <label>Select number of courses</label>
                        <select class="form-control">
                            <option>1 Course Meal</option>
                            <option>2 Course Meal</option>
                            <option>3 Course Meal</option>
                            <option>4 Course Meal</option>
                        </select>
                </div>
					
				</div>
				
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
</html>