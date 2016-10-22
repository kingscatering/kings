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

			<div class="col-md-2"></div>
			<div class="col-md-8">
					<div class="panel panel-primary">
                        <div class="panel-heading">
                            Summary
                        </div>

                        <div class="panel-body">
						<h4 align="center"><?php if($_GET['type'] == 1){echo'1 Course Meal';} else if($_GET['type'] == 2){echo'2 Course Meal';} else if($_GET['type'] == 3){echo'3 Course Meal';} else if($_GET['type'] == 4){echo'4 Course Meal';}?> (<?php if($_GET['paks'] == 100){echo'50-100';} else if($_GET['paks'] == 150){echo'101-150';} else if($_GET['paks'] == 200){echo'151-200';}?> Pax) </h4>
						
						<?php
						$dede = '';
						$totalp = 0; $totalp1 = 0;
						if($_GET['type'] == 1){
						$mc = $_GET['mc'];
						$des = $link->query("select * from tbl_menu where id ='$mc'");
						$descs = $des->num_rows;
						if($descs>=1){while($row = $des->fetch_object()){						
						$dede .='
										<tr>
                                            <td>'.$row->code.'</td>
                                            <td>'.$row->name.'</td>
                                            <td>'.$row->course.'</td>
                                            <td>'.$row->wala.'</td>
                                        </tr>
						';
						$totalp = $row->ppserve + $totalp1;
						$totalp1 = $totalp;
						}}
						} else if($_GET['type'] == 2){
						$mc = $_GET['mc'];
						$de = $_GET['de'];
						$des = $link->query("select * from tbl_menu where id ='$mc' or id ='$de'");
						$descs = $des->num_rows;
						if($descs>=1){while($row = $des->fetch_object()){
						$dede .='
										<tr>
                                            <td>'.$row->code.'</td>
                                            <td>'.$row->name.'</td>
                                            <td>'.$row->course.'</td>
                                            <td>'.$row->wala.'</td>
                                        </tr>
						';
						$totalp = $row->ppserve + $totalp1;
						$totalp1 = $totalp;
						}}
						} else if($_GET['type'] == 3){
						$mc = $_GET['mc'];
						$de = $_GET['de'];
						$ap = $_GET['ap'];
						$des = $link->query("select * from tbl_menu where id ='$mc' or id ='$de' or id = '$ap'");
						$descs = $des->num_rows;
						if($descs>=1){while($row = $des->fetch_object()){
						$dede .='
										<tr>
                                            <td>'.$row->code.'</td>
                                            <td>'.$row->name.'</td>
                                            <td>'.$row->course.'</td>
                                            <td>'.$row->wala.'</td>
                                        </tr>
						';
						$totalp = $row->ppserve + $totalp1;
						$totalp1 = $totalp;
						}}
						} else if($_GET['type'] == 4){
						$mc = $_GET['mc'];
						$de = $_GET['de'];
						$ap = $_GET['ap'];
						$en = $_GET['en'];
						$des = $link->query("select * from tbl_menu where id = '$mc' or id = '$de' or id = '$ap' or id = '$en'");
						$descs = $des->num_rows;
						if($descs>=1){while($row = $des->fetch_object()){
						$dede .='
										<tr>
                                            <td>'.$row->code.'</td>
                                            <td>'.$row->name.'</td>
                                            <td>'.$row->course.'</td>
                                            <td>'.$row->wala.'</td>
                                        </tr>
						';
						$totalp = $row->ppserve + $totalp1;
						$totalp1 = $totalp;
						}}
						}
	
						?>
								<table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Code</th>
                                            <th>Name</th>
                                            <th>Course</th>
                                            <th>Variety</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php echo $dede; ?>
										<tr>
                                            <td colspan="3"><b>Total</b></td>
                                            <td><?php $tp = $totalp * $_GET['paks']; echo '₱ '.number_format($tp,2);?></td>
                                        </tr>
                                    </tbody>
                                </table>
								
                        </div>
                        <div class="panel-footer" align="right">
                            <form method="post" action="action.php?act=<?php if($_GET['type'] == 1){echo'custo1&mc=';echo $_GET['mc'];echo'&paks=';echo $_GET['paks'];}else if($_GET['type'] == 2){echo'custo2&mc=';echo $_GET['mc'];echo'&de=';echo $_GET['de'];echo'&paks=';echo $_GET['paks'];}else if($_GET['type'] == 3){echo'custo3&mc=';echo $_GET['mc'];echo'&de=';echo $_GET['de'];echo'&ap=';echo $_GET['ap'];echo'&paks=';echo $_GET['paks'];}else if($_GET['type'] == 4){echo'custo4&mc=';echo $_GET['mc'];echo'&de=';echo $_GET['de'];echo'&ap=';echo $_GET['ap'];echo'&en=';echo $_GET['en'];echo'&paks=';echo $_GET['paks'];} ?>" enctype="multipart/form-data" role="form"><input type="submit" value="Finish" class="btn btn-primary"></form>
                        </div>
                    </div>
			</div>
			<div class="col-md-2"></div>
			
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