<!DOCTYPE html>
<html lang="en">

<head>

	<?php include_once'adds/scripts.php'; ?>
	
	<?php include_once'adds/javascripts.php'; ?>
	
</head>

<body>
	<script>
	// $(document).ready(function() {
        // reset();
			// alertify.success("Success log message");
    // });
	</script>
	
    <?php include_once'adds/nav.php'; ?>
	
    <!-- Page Content -->
    <div class="container">
		<br>
        <!-- Page Heading/Breadcrumbs -->
        <div class="row">	
            <div class="col-md-12">
								<div>
                                    <p>
                                        <strong>Creating a set</strong>
                                        <span class="pull-right text-muted"><?php if(!isset($_GET['maxc']) && !isset($_GET['curc'])){echo'0%';} else {$perce = ($_GET['curc']/$_GET['maxc'])*100; echo number_format($perce, 2, '.', '').'%';}?></span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php if(!isset($_GET['maxc']) && !isset($_GET['curc'])){echo'0%';} else {$perce = ($_GET['curc']/$_GET['maxc'])*100; echo $perce.'%';}?>">
                                        </div>
                                    </div>
                                </div>
            </div>
			
			<div class="col-md-12">
<?php
if(!isset($_GET['maxc']) && !isset($_GET['curc'])){
?>
<div class="col-md-12">Select the # of course:</div>	
<div class="col-md-1"></div>
<div class="col-md-9">
<div class="dropdown">
  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
    Course Meal
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
    <li role="presentation"><a role="menuitem" tabindex="-1" href="pset.php?maxc=1&curc=1">1 Course Meal</a></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="pset.php?maxc=2&curc=1">2 Course Meal</a></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="pset.php?maxc=3&curc=1">3 Course Meal</a></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="pset.php?maxc=4&curc=1">4 Course Meal</a></li>
    <!--<li role="presentation"><a role="menuitem" tabindex="-1" href="pset.php?maxc=5&curc=1">5 Course Meal</a></li>-->
  </ul>
</div>
</div>
				<!-- <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Default Panel
                        </div>
                        <div class="panel-body">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                        </div>
                        <div class="panel-footer">
                            Panel Footer
                        </div>
                    </div>
                </div> -->
<?php 
} else if(isset($_GET['maxc']) && isset($_GET['curc'])){
	
	$maxc = $_GET['maxc'];
	$curc = $_GET['curc'];
	
	if($maxc == 1){
?>
	<div class="col-md-12">
	<form method="post" action="action.php?act=adse1" enctype="multipart/form-data" role="form">
	<div class="form-group">
	<label>Please Select Main course:</label>
	<?php $main1 = $link->query("select id, name, wala, ppserve from tbl_menu where course = 'Main course'"); $main1c = $main1->num_rows;
	$ops='';if($main1c>=1){while ($row = $main1->fetch_object()){ $ops .='<option value="'.$row->id.'">'.$row->name.' ('.$row->wala.')</option>'; } echo '<select class="form-control" name="mc" id="mc" required>'.$ops.'</select>';} else {echo'No Available Main course from database.';}?>
    </div>
	<!--<div class="col-md-6">
	<div class="form-group">
		<label># of Paks</label>
		<select class="form-control" name="np" id="np" onChange="populate(this.id,'srp')" required>
			<option></option>
			<option value="50-100">50-100</option>
			<option value="101-150">101-150</option>
			<option value="151-200">151-200</option>
		</select>
	</div>
	</div>
	
	<div class="col-md-6">
	<div class="form-group">
		<label>SRP per head</label>
		<select class="form-control" name="srp" id="srp" required>
		</select>
	</div>
	</div> -->
	<div align="right"><input type="submit" value="Finish" class="btn btn-primary"></div>
	</form>
	</div>
	
<?php
	} if($maxc == 2){
		if($curc == 1){
?>
	<form method="post" action="action.php?act=cm2&maxc=<?php echo $maxc; ?>&curc=<?php echo $curc; ?>" enctype="multipart/form-data" role="form">
	<div class="col-md-12">
	<div class="form-group">
	<label>Please Select Main course:</label>
	<?php $main1 = $link->query("select id, name, wala, ppserve from tbl_menu where course = 'Main course'"); $main1c = $main1->num_rows;
	$ops='';if($main1c>=1){while ($row = $main1->fetch_object()){ $ops .='<option value="'.$row->id.'">'.$row->name.' ('.$row->wala.')</option>'; } echo '<select class="form-control" name="mc" id="mc" required>'.$ops.'</select>';} else {echo'No Available Main course from database.';}?>
    </div>
	<div align="right"><input type="submit" value="Next" class="btn btn-primary"></div>
	</div>
	</form>
<?php
		} else if ($curc == 2){
?>
	<form method="post" action="action.php?act=adse2" enctype="multipart/form-data" role="form">
	<div class="col-md-12">
	<div class="form-group">
	<label>Please Select Dessert:</label>
	<?php $main1 = $link->query("select id, name, wala, ppserve from tbl_menu where course = 'Dessert'"); $main1c = $main1->num_rows;
	$ops='';if($main1c>=1){while ($row = $main1->fetch_object()){ $ops .='<option value="'.$row->id.'">'.$row->name.' ('.$row->wala.')</option>'; } echo '<select class="form-control" name="de" id="de" required>'.$ops.'</select>';} else {echo'No Available Main course from database.';}?>
    </div>
	<div align="right"><input type="hidden" name="mc" id="mc" value="<?php echo $_GET['a'];?>"><input type="submit" value="Finish" class="btn btn-primary"></div>
	</div>
	</form>
<?php
		} else {echo'Invalid Page Source';}
?>
	
	<!-- Main course
	Dessert (fruit salad) -->
<?php
	} if($maxc == 3){
		if($curc == 1){
?>
	<form method="post" action="action.php?act=cm3&maxc=<?php echo $maxc; ?>&curc=<?php echo $curc; ?>" enctype="multipart/form-data" role="form">
	<div class="col-md-12">
	<div class="form-group">
	<label>Please Select Appetizer:</label>
	<?php $main1 = $link->query("select id, name, wala, ppserve from tbl_menu where course = 'Appetizer'"); $main1c = $main1->num_rows;
	$ops='';if($main1c>=1){while ($row = $main1->fetch_object()){ $ops .='<option value="'.$row->id.'">'.$row->name.' ('.$row->wala.')</option>'; } echo '<select class="form-control" name="ap" id="ap" required>'.$ops.'</select>';} else {echo'No Available Main course from database.';}?>
    </div>
	<div align="right"><input type="submit" value="Next" class="btn btn-primary"></div>
	</div>
	</form>
<?php		
		} else if($curc == 2){
?>
	<form method="post" action="action.php?act=cm3&maxc=<?php echo $maxc; ?>&curc=<?php echo $curc; ?>&a=<?php echo $_GET['a'];?>" enctype="multipart/form-data" role="form">
	<div class="col-md-12">
	<div class="form-group">
	<label>Please Select Main course:</label>
	<?php $main1 = $link->query("select id, name, wala, ppserve from tbl_menu where course = 'Main course'"); $main1c = $main1->num_rows;
	$ops='';if($main1c>=1){while ($row = $main1->fetch_object()){ $ops .='<option value="'.$row->id.'">'.$row->name.' ('.$row->wala.')</option>'; } echo '<select class="form-control" name="mc" id="mc" required>'.$ops.'</select>';} else {echo'No Available Main course from database.';}?>
    </div>
	<div align="right"><input type="submit" value="Next" class="btn btn-primary"></div>
	</div>
	</form>
<?php		
		} else if($curc == 3){
?>
	<form method="post" action="action.php?act=adse3" enctype="multipart/form-data" role="form">
	<div class="col-md-12">
	<div class="form-group">
	<label>Please Select Dessert:</label>
	<?php $main1 = $link->query("select id, name, wala, ppserve from tbl_menu where course = 'Dessert'"); $main1c = $main1->num_rows;
	$ops='';if($main1c>=1){while ($row = $main1->fetch_object()){ $ops .='<option value="'.$row->id.'">'.$row->name.' ('.$row->wala.')</option>'; } echo '<select class="form-control" name="de" id="de" required>'.$ops.'</select>';} else {echo'No Available Main course from database.';}?>
    </div>
	<div align="right"><input type="hidden" name="ap" id="ap" value="<?php echo $_GET['a'];?>"><input type="hidden" name="mc" id="mc" value="<?php echo $_GET['b'];?>"><input type="submit" value="Finish" class="btn btn-primary"></div>
	</div>
	</form>
<?php		
		} else {echo'Invalid Page Source';}
?>
	<!-- Appetizer(soup)/Entrée/Salad
	Main course
	Dessert/Pudding -->
<?php	
	} if($maxc == 4){
		if($curc == 1){
?>
	<form method="post" action="action.php?act=cm4&maxc=<?php echo $maxc; ?>&curc=<?php echo $curc; ?>" enctype="multipart/form-data" role="form">
	<div class="col-md-12">
	<div class="form-group">
	<label>Please Select Appetizer:</label>
	<?php 
		$main1 = $link->query("select id, name, wala, ppserve from tbl_menu where course = 'Appetizer'"); 
		$main1c = $main1->num_rows;
		$ops='';
		if ($main1c>=1) {
			while ($row = $main1->fetch_object()) { 
				$ops .='<option value="'.$row->id.'">'.$row->name.' ('.$row->wala.')</option>'; 
			} 
			echo '<select class="form-control" name="ap" id="ap" required>'.$ops.'</select>';
		} else {
			echo'No Available Main course from database.';
		}
	?>
    </div>
	<div align="right"><input type="submit" value="Next" class="btn btn-primary"></div>
	</div>
	</form>
<?php		
		} else if($curc == 2){
?>
	<form method="post" action="action.php?act=cm4&maxc=<?php echo $maxc; ?>&curc=<?php echo $curc; ?>&a=<?php echo $_GET['a'];?>" enctype="multipart/form-data" role="form">
	<div class="col-md-12">
	<div class="form-group">
	<label>Please Select Entree:</label>
	<?php $main1 = $link->query("select id, name, wala, ppserve from tbl_menu where course = 'Entree'"); $main1c = $main1->num_rows;
	$ops='';if($main1c>=1){while ($row = $main1->fetch_object()){ $ops .='<option value="'.$row->id.'">'.$row->name.' ('.$row->wala.')</option>'; } echo '<select class="form-control" name="en" id="en" required>'.$ops.'</select>';} else {echo'No Available Main course from database.';}?>
    </div>
	<div align="right"><input type="submit" value="Next" class="btn btn-primary"></div>
	</div>
	</form>
<?php		
		} else if($curc == 3){
?>
	<form method="post" action="action.php?act=cm4&maxc=<?php echo $maxc; ?>&curc=<?php echo $curc; ?>&a=<?php echo $_GET['a'];?>&b=<?php echo $_GET['b'];?>" enctype="multipart/form-data" role="form">
	<div class="col-md-12">
	<div class="form-group">
	<label>Please Select Main course:</label>
	<?php $main1 = $link->query("select id, name, wala, ppserve from tbl_menu where course = 'Main course'"); $main1c = $main1->num_rows;
	$ops='';if($main1c>=1){while ($row = $main1->fetch_object()){ $ops .='<option value="'.$row->id.'">'.$row->name.' ('.$row->wala.')</option>'; } echo '<select class="form-control" name="mc" id="mc" required>'.$ops.'</select>';} else {echo'No Available Main course from database.';}?>
    </div>
	<div align="right"><input type="submit" value="Next" class="btn btn-primary"></div>
	</div>
	</form>
<?php		
		} else if($curc == 4){
?>
	<form method="post" action="action.php?act=adse4" enctype="multipart/form-data" role="form">
	<div class="col-md-12">
	<div class="form-group">
	<label>Please Select Dessert:</label>
	<?php $main1 = $link->query("select id, name, wala, ppserve from tbl_menu where course = 'Dessert'"); $main1c = $main1->num_rows;
	$ops='';if($main1c>=1){while ($row = $main1->fetch_object()){ $ops .='<option value="'.$row->id.'">'.$row->name.' ('.$row->wala.')</option>'; } echo '<select class="form-control" name="de" id="de" required>'.$ops.'</select>';} else {echo'No Available Main course from database.';}?>
    </div>
	<div align="right"><input type="hidden" name="ap" id="ap" value="<?php echo $_GET['a'];?>"><input type="hidden" name="en" id="en" value="<?php echo $_GET['b'];?>"><input type="hidden" name="mc" id="mc" value="<?php echo $_GET['c'];?>"><input type="submit" value="Finish" class="btn btn-primary"></div>
	</div>
	</form>
<?php		
		} else {echo'Invalid Page Source';}
?>
	<!-- Appetizer (soup)
	Entrée/Salad
	Main course
	Dessert/Pudding -->
<?php
	}
	
}
?>			
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