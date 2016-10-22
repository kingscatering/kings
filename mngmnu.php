<!DOCTYPE html>
<html lang="en">

<head>

	<?php include_once'adds/scripts.php'; ?>
	
	<?php include_once'adds/javascripts.php'; ?>
	
</head>


<body>

    <?php include_once'adds/nav.php'; ?>
	
   <div class="container">
		<br>
        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
			<div class="col-md-12">
			<h3>Package Amenities List</h3>
	        </div>
			
			<div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Price per head includes the following Amenities:
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#app" data-toggle="tab">Party Package</a>
                                </li>
                                <li><a href="#ent" data-toggle="tab">Wedding Package</a>
                                </li>
                                <li><a href="#mai" data-toggle="tab">Debut Package</a>
                                </li>
                                <li><a href="#des" data-toggle="tab">Other Offered Package</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="app">
                                    <h4>Party Package [<a data-toggle="modal" data-target="#appm">Add</a>]</h4>
                            
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Amenities</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php echo $pard1; ?>
                                    </tbody>
                                </table>
                            </div>
							
                                </div>
                                <div class="tab-pane fade" id="ent">
                                    <h4>Wedding Package [<a data-toggle="modal" data-target="#appm1">Add</a>]</h4>
							
							<div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Amenities</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php echo $pard2; ?>
                                    </tbody>
                                </table>
                            </div>
							
                                </div>
                                <div class="tab-pane fade" id="mai">
                                    <h4>Debut Package [<a data-toggle="modal" data-target="#appm2">Add</a>]</h4>
                            
							<div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Amenities</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php echo $pard3; ?>
                                    </tbody>
                                </table>
                            </div>
							
                                </div>
                                <div class="tab-pane fade" id="des">
                                    <h4>Other Offered Package [<a data-toggle="modal" data-target="#appm3">Add</a>]</h4>
                            
								<?php echo $pard4; ?>
							
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
<!-- Modal -->
<div class="modal fade" id="appm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Party Package Additional Amenities</h4>
      </div>
      <div class="modal-body">
			<form method="post" action="action.php?act=addame&vid=1" enctype="multipart/form-data" role="form">
				<fieldset>
					<div class="form-group">
					<input class="form-control" placeholder="Amenities" name="amen" id="amen" required>
                    </div>
					<input type="submit" value="Add" class="btn btn-md btn-success btn-block" />
                </fieldset>
            </form>	
      </div>
      <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="appm1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Wedding Package Additional Amenities</h4>
      </div>
      <div class="modal-body">
			<form method="post" action="action.php?act=addame&vid=2" enctype="multipart/form-data" role="form">
				<fieldset>
					<div class="form-group">
					<input class="form-control" placeholder="Amenities" name="amen" id="amen" required>
                    </div>
					<input type="submit" value="Add" class="btn btn-md btn-success btn-block" />
                </fieldset>
            </form>	
      </div>
      <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="appm2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Debut  Package Additional Amenities</h4>
      </div>
      <div class="modal-body">
			<form method="post" action="action.php?act=addame&vid=3" enctype="multipart/form-data" role="form">
				<fieldset>
					<div class="form-group">
					<input class="form-control" placeholder="Amenities" name="amen" id="amen" required>
                    </div>
					<input type="submit" value="Add" class="btn btn-md btn-success btn-block" />
                </fieldset>
            </form>	
      </div>
      <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="appm3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Add New Other Offer</h4>
      </div>
      <div class="modal-body">
			<form method="post" action="action.php?act=addotof" enctype="multipart/form-data" role="form">
				<fieldset>
					<div class="form-group">
					<input class="form-control" placeholder="Offer for..." name="offfor" id="offfor" required>
                    </div>
					<div class="form-group">
					<input class="form-control" placeholder="Good for..." name="goofor" id="goofor" required>
                    </div>
					<input type="submit" value="Add" class="btn btn-md btn-success btn-block" />
                </fieldset>
            </form>	
      </div>
      <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
        <br />
        <br />
        <br />
        <br />

    </div>
    <!-- /.container -->

</body>

</html>