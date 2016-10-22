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
				
<?php
$des1='';
$tnsid = $_GET['tnsid'];
$uids = $_SESSION['uids'];
$kwentomo = $link->query("select * from tbl_reser where tnsid = '$tnsid' && uid = '$uids'");
$kwentomoc = $kwentomo->num_rows;$tp=0;$tp1=0;
if($kwentomoc>=1){while($row = $kwentomo->fetch_object()){
	$p = $row->fppserve;
	$pak = $row->pak;
	$pdate = $row->pdate;
	$tp = $p + $tp1;
	$tp1 = $tp;
	$des1 .='
										<tr>
                                            <td>'.$row->fcode.'</td>							
                                            <td>'.$row->fcourse.'</td>
                                            <td>'.$row->fname.'</td>
                                            <td>'.$row->fwala.'</td>							
                                        </tr>
	';
	
}}
?>

					<div class="panel panel-primary">
                        <div class="panel-heading">
							Status: Paid (<?php echo $pdate; ?>)
                        </div>
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Code</th>
                                            <th>Course</th>
                                            <th>Name</th>
                                            <th>Variety</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php echo $des1; ?>
										
										<tr>
                                            <td colspan="3"><b>Total</b></td>
                                            <td>₱ <?php echo number_format($tp*$pak,2); ?></td>
                                        </tr>
										
                                    </tbody>
                                </table>
                            </div>
                    </div>

<?php

?>						
		<h4>More Details (Finalizing)</h4>
		
				<div class="col-md-12">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            Notes*
                        </div>
                        <div class="panel-body">
                            <ul>
								<li>Event date should be 3 days onwards after reservation.</li>
								<li>Venue Preparation will be one(1) hour before the start time and have maximum of six(6) hours services.</li>
							</ul>
                        </div>
                        <!-- <div class="panel-footer">
                            Panel Footer
                        </div> -->
                    </div>
                </div>
		
		<form method="post" action="action.php?act=fina&code=<?php echo $tnsid; ?>" enctype="multipart/form-data" role="form">	
		<div class="col-md-3">Date</div> <div class="col-md-8"><div class="form-group"><input type="date" class="form-control" placeholder="Date of Event" name="dateE" id="dateE" required></div></div>
		<div class="col-md-3">Start Time</div> <div class="col-md-8"><div class="form-group"><input type="time" class="form-control" placeholder="Event Start Time" name="timeS" id="timeS" required></div></div>
		<!-- <div class="col-md-3">End Time</div> <div class="col-md-8"><div class="form-group"><input type="time" class="form-control" placeholder="Event End Time" name="timeE" id="timeE" required></div></div> -->
		<div class="col-md-3">Location/Venue</div> <div class="col-md-8"><div class="form-group"><input type="text" class="form-control" placeholder="House number or Lot/Blk/Phase, Street name" name="addr" id="addr" onkeyup="restrict('addr')" required></div></div>
		<!-- <div class="col-md-3"></div> <div class="col-md-8"><div class="form-group"><input type="text" class="form-control" placeholder="Subdivision name" name="subd" id="subd" required></div></div> -->
		<div class="col-md-3"></div> <div class="col-md-8"><div class="form-group"><input type="text" class="form-control" placeholder="Barangay name" name="bara" id="bara" onkeyup="restrict('bara')" required></div></div>
		<div class="col-md-3"></div> <div class="col-md-8"><div class="form-group"><input type="text" class="form-control" placeholder="City name" name="city" id="city" onkeyup="restrict('city')" required></div></div>
		<div class="col-md-3"></div> <div class="col-md-8"><div class="form-group"><input type="text" class="form-control" placeholder="Province" name="prov" id="prov" onkeyup="restrict('prov')" required></div></div>
		<div class="col-md-3"></div> <div class="col-md-8"><div class="form-group"><input type="text" class="form-control" placeholder="Zip code" name="zipc" id="zipc" onkeyup="restrict('zipc')" maxlength="4" required></div></div>
		<div class="col-md-3"></div> <div class="col-md-8"><div class="form-group"><input type="text" class="form-control" placeholder="Landmark(Optional)" name="land" id="land"></div></div>
		<div class="col-md-3"></div> <div class="col-md-8" align="right"><input type="submit" class="btn btn-primary" value="Finalized"></div>
		</form>
				
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