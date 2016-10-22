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
			<h3>Menu List</h3>
	        </div>
			
			<div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Course Meal
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a href="#app" data-toggle="tab" class="active">Appetizer</a>
                                </li>
                                <li class="nav-item"><a href="#ent" data-toggle="tab">Entrée</a>
                                </li>
                                <li class="nav-item"><a href="#mai" data-toggle="tab">Main course</a>
                                </li>
                                <li class="nav-item"><a href="#des" data-toggle="tab">Dessert</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="app">
                                    <h4>Appetizer</h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Variety</th>
                                            <th>Price/Serve</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php echo $appid1; ?>
                                    </tbody>
                                </table>
                            </div>
                                </div>
                                <div class="tab-pane fade" id="ent">
                                    <h4>Entrée</h4>
							<div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example1">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Variety</th>
                                            <th>Price/Serve</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php echo $appid2; ?>
                                    </tbody>
                                </table>
                            </div>
                                </div>
                                <div class="tab-pane fade" id="mai">
                                    <h4>Main course</h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example2">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Variety</th>
                                            <th>Price/Serve</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php echo $appid3; ?>
                                    </tbody>
                                </table>
                            </div>
                                </div>
                                <div class="tab-pane fade" id="des">
                                    <h4>Dessert</h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example3">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Variety</th>
                                            <th>Price/Serve</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php echo $appid4; ?>
                                    </tbody>
                                </table>
                            </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
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

    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
    });
	$(document).ready(function() {
        $('#dataTables-example1').dataTable();
    });
	$(document).ready(function() {
        $('#dataTables-example2').dataTable();
    });
	$(document).ready(function() {
        $('#dataTables-example3').dataTable();
    });
    </script>
</html>