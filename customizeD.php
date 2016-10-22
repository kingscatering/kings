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
						<div class="panel-body">
<?php
if(isset($_POST['cust'])){
	$asd = false;
		$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$string = '';
		do{for ($i = 0; $i < 10; $i++){$string .= $characters[rand(0, strlen($characters) - 1)];}
		$ccode = $link->query("select id from tbl_custo where code = '$string' limit 1");
		$ccodec = $ccode->num_rows;
		} while($string == '' && $ccodec != 0);
		$id = $_SESSION['uids'];
		$walaarray='';
		$value2='value';
	$meu2 = $link->query("select distinct wala from tbl_menu");
	$meuc2 = $meu2->num_rows;
	if($meuc2>=1){while($row = $meu2->fetch_object()){
	$wala2 = $row->wala;
	$cleanwala2 = str_replace(' ', '', $wala2);
	$walaarray .= "$cleanwala2,"; 
		// if(isset($_POST[$cleanwala2])){
			// if ($_POST[$cleanwala2] != ''){$cleanwala2 = $_POST[$cleanwala2]}
		// }		
	}}
	$walaarray = rtrim($walaarray, ",");
	$id_str_array = explode(",", $walaarray);
	foreach ($id_str_array as $key => $value) {		
		// echo '<script>alert("'.$id_str_array[$key].'");</script>';
		if(isset($_POST[$id_str_array[$key]])){$id_str_array[$key] = $_POST[$id_str_array[$key]];}else{$id_str_array[$key] = '';}
		if($id_str_array[$key] != ''){
			// echo '<script>alert("'.$id_str_array[$key].'");</script>';
			
			$asd = $link->query("insert into tbl_custo(code, mid, creator, datec) values('$string', '$id_str_array[$key]', '$id', now())");
			}		
	}
			if($asd){echo "<script >alert('Customized package created.'); location.href='customized.php';</script>";} 
	// foreach($_POST['chos'] as $selected){
		// $link->query("insert into tbl_custo(code, mid, creator, datec) values('$string', '$selected', '$id', now())");
		// echo "<script >alert('Customized package created.'); location.href='customized.php';</script>";
		// echo '<script>alert("'.$selected.'");</script>';
	// }
	
}	
?>

<?php
	$display='';
	$meu = $link->query("select distinct wala from tbl_menu");
	$meuc = $meu->num_rows;
	if($meuc>=1){while($row = $meu->fetch_object()){
	$wala = $row->wala;
	$cleanwala = str_replace(' ', '', $wala);
		$meulist = $link->query("select * from tbl_menu where wala = '$wala'");
		$meulistc = $meulist->num_rows; $opts='';
		if($meulistc>=1){while($row = $meulist->fetch_object()){
		$id = $row->id;
		$code = $row->code;
		$name = $row->name;
		$course = $row->course;
		$ppserve = $row->ppserve;
		$image = $row->image;
		
		$opts .="<div class='checkbox'><input type='radio' value='$id' name='$cleanwala'>$name</div>";
		}}
		
		$display .="
		<div class='form-group'>
		<label>$wala</label>
		$opts
		</div>
		";
	}}
	echo '<form method="post" action="customizeD.php" enctype="multipart/form-data" role="form">';
	echo '<div class="col-md-12">';
	echo $display;
	echo '</div>';
	// echo'
	// <div class="form-group">
        // <label># of Pax</label>
	// <input class="form-control" placeholder="# of Pax (max of 1000)" name="paks" id="paks" onkeyup="restrict(\'paks\')" maxlength="4" required>	
    // </div>
	// ';
	echo '<input type="submit" class="btn btn-primary" value="Create" name="cust">';
	echo '</form>';
?>
                    </div>
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