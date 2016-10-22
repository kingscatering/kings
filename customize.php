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
			
					<div class="panel panel-primary">
                        <div class="panel-heading">
                            Customize Course Meal
                        </div>
<?php
if(!isset($_GET['max']) && !isset($_GET['cur'])){
?>
					<form method="post" action="action.php?act=custo" enctype="multipart/form-data" role="form">
                        <div class="panel-body">
										<div class="form-group">
                                            <label># of Course Meal</label>
                                            <select class="form-control" name="cm" id="cm">
                                                <option value="1">1 Course Meal</option>
                                                <option value="2">2 Course Meal</option>
                                                <option value="3">3 Course Meal</option>
                                                <option value="4">4 Course Meal</option>
                                            </select>
                                        </div>
                        </div>
                        <div class="panel-footer" align="right">
                            <input type="submit" value="Next" class="btn btn-primary">
                        </div>
					</form>
<?php
} else if(isset($_GET['max']) && isset($_GET['cur'])){
	$max = $_GET['max'];
	$cur = $_GET['cur'];
	if($max == 1){
?>
	<form method="post" action="action.php?act=sum1" enctype="multipart/form-data" role="form">
	<div class="panel-body">
	<div class="form-group">
	<label>Please Select Main course:</label>
	<?php $main1 = $link->query("select id, name, wala, ppserve from tbl_menu where course = 'Main course'"); $main1c = $main1->num_rows;
	$ops='';if($main1c>=1){while ($row = $main1->fetch_object()){ $ops .='<option value="'.$row->id.'">'.$row->name.' ('.$row->wala.')</option>'; } echo '<select class="form-control" name="mc" id="mc" required>'.$ops.'</select>';} else {echo'No Available Main course from database.';}?>
    </div>
	<div class="form-group">
        <label># of Pax</label>
    <input class="form-control" placeholder="# of Pax (max of 1000)" name="paks" id="paks" onkeyup="restrict('paks')" maxlength="4" required>	
    </div>
	</div>
    <div class="panel-footer" align="right">
        <input type="submit" value="Next" class="btn btn-primary">
    </div>
	</form>
<?php	
	} else if($max == 2){
?>	
	<form method="post" action="action.php?act=sum2" enctype="multipart/form-data" role="form">
	<div class="panel-body">
	<div class="form-group">
	<label>Please Select Main course:</label>
	<?php $main1 = $link->query("select id, name, wala, ppserve from tbl_menu where course = 'Main course'"); $main1c = $main1->num_rows;
	$ops='';if($main1c>=1){while ($row = $main1->fetch_object()){ $ops .='<option value="'.$row->id.'">'.$row->name.' ('.$row->wala.')</option>'; } echo '<select class="form-control" name="mc" id="mc" required>'.$ops.'</select>';} else {echo'No Available Main course from database.';}?>
    </div>
	<div class="form-group">
	<label>Please Select Dessert:</label>
	<?php $main1 = $link->query("select id, name, wala, ppserve from tbl_menu where course = 'Dessert'"); $main1c = $main1->num_rows;
	$ops='';if($main1c>=1){while ($row = $main1->fetch_object()){ $ops .='<option value="'.$row->id.'">'.$row->name.' ('.$row->wala.')</option>'; } echo '<select class="form-control" name="de" id="de" required>'.$ops.'</select>';} else {echo'No Available Main course from database.';}?>
    </div>
	<div class="form-group">
        <label># of Pax</label>
	<input class="form-control" placeholder="# of Pax (max of 1000)" name="paks" id="paks" onkeyup="restrict('paks')" maxlength="4" required>	
    </div>
	</div>
    <div class="panel-footer" align="right">
        <input type="submit" value="Next" class="btn btn-primary">
    </div>
	</form>
<?php
	} else if($max == 3){
?>
	<form method="post" action="action.php?act=sum3" enctype="multipart/form-data" role="form">
	<div class="panel-body">
	<div class="form-group">
	<label>Please Select Appetizer:</label>
	<?php $main1 = $link->query("select id, name, wala, ppserve from tbl_menu where course = 'Appetizer'"); $main1c = $main1->num_rows;
	$ops='';if($main1c>=1){while ($row = $main1->fetch_object()){ $ops .='<option value="'.$row->id.'">'.$row->name.' ('.$row->wala.')</option>'; } echo '<select class="form-control" name="ap" id="ap" required>'.$ops.'</select>';} else {echo'No Available Main course from database.';}?>
    </div>
	<div class="form-group">
	<label>Please Select Main course:</label>
	<?php $main1 = $link->query("select id, name, wala, ppserve from tbl_menu where course = 'Main course'"); $main1c = $main1->num_rows;
	$ops='';if($main1c>=1){while ($row = $main1->fetch_object()){ $ops .='<option value="'.$row->id.'">'.$row->name.' ('.$row->wala.')</option>'; } echo '<select class="form-control" name="mc" id="mc" required>'.$ops.'</select>';} else {echo'No Available Main course from database.';}?>
    </div>
	<div class="form-group">
	<label>Please Select Dessert:</label>
	<?php $main1 = $link->query("select id, name, wala, ppserve from tbl_menu where course = 'Dessert'"); $main1c = $main1->num_rows;
	$ops='';if($main1c>=1){while ($row = $main1->fetch_object()){ $ops .='<option value="'.$row->id.'">'.$row->name.' ('.$row->wala.')</option>'; } echo '<select class="form-control" name="de" id="de" required>'.$ops.'</select>';} else {echo'No Available Main course from database.';}?>
    </div>
	<div class="form-group">
        <label># of Pax</label>
	<input class="form-control" placeholder="# of Pax (max of 1000)" name="paks" id="paks" onkeyup="restrict('paks')" maxlength="4" required>	
    </div>
	</div>
    <div class="panel-footer" align="right">
        <input type="submit" value="Next" class="btn btn-primary">
    </div>
	</form>
<?php
	} else if($max == 4){
?>
	<form method="post" action="action.php?act=sum4" enctype="multipart/form-data" role="form">
	<div class="panel-body">
	<div class="form-group">
	<label>Please Select Appetizer:</label>
	<?php $main1 = $link->query("select id, name, wala, ppserve from tbl_menu where course = 'Appetizer'"); $main1c = $main1->num_rows;
	$ops='';if($main1c>=1){while ($row = $main1->fetch_object()){ $ops .='<option value="'.$row->id.'">'.$row->name.' ('.$row->wala.')</option>'; } echo '<select class="form-control" name="ap" id="ap" required>'.$ops.'</select>';} else {echo'No Available Main course from database.';}?>
    </div>
	<div class="form-group">
	<label>Please Select Entree:</label>
	<?php $main1 = $link->query("select id, name, wala, ppserve from tbl_menu where course = 'Entree'"); $main1c = $main1->num_rows;
	$ops='';if($main1c>=1){while ($row = $main1->fetch_object()){ $ops .='<option value="'.$row->id.'">'.$row->name.' ('.$row->wala.')</option>'; } echo '<select class="form-control" name="en" id="en" required>'.$ops.'</select>';} else {echo'No Available Main course from database.';}?>
    </div>
	<div class="form-group">
	<label>Please Select Main course:</label>
	<?php $main1 = $link->query("select id, name, wala, ppserve from tbl_menu where course = 'Main course'"); $main1c = $main1->num_rows;
	$ops='';if($main1c>=1){while ($row = $main1->fetch_object()){ $ops .='<option value="'.$row->id.'">'.$row->name.' ('.$row->wala.')</option>'; } echo '<select class="form-control" name="mc" id="mc" required>'.$ops.'</select>';} else {echo'No Available Main course from database.';}?>
    </div>
	<div class="form-group">
	<label>Please Select Dessert:</label>
	<?php $main1 = $link->query("select id, name, wala, ppserve from tbl_menu where course = 'Dessert'"); $main1c = $main1->num_rows;
	$ops='';if($main1c>=1){while ($row = $main1->fetch_object()){ $ops .='<option value="'.$row->id.'">'.$row->name.' ('.$row->wala.')</option>'; } echo '<select class="form-control" name="de" id="de" required>'.$ops.'</select>';} else {echo'No Available Main course from database.';}?>
    </div>
	<div class="form-group">
        <label># of Pax</label>
	<input class="form-control" placeholder="# of Pax (max of 1000)" name="paks" id="paks" onkeyup="restrict('paks')" maxlength="4" required>	
    </div>
	</div>
    <div class="panel-footer" align="right">
        <input type="submit" value="Next" class="btn btn-primary">
    </div>
	</form>
<?php
	}
?>

<?php
}
?>
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