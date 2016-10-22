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
			
			
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h4><?php echo $pk; ?> Package</h4>
                        </div>
                        <div class="panel-body">
						<?php $ewn = $_GET["set"];
		$avdes = $link->query("select description from description where id = '$ewn' limit 1");
		$avdesc = $avdes->num_rows;
		if($avdesc>=1){
			while ($row = $avdes->fetch_object()){
				echo $row->description;
				echo '<br>';
				echo '<br>';
				echo 'Price per head includes the following Amenities:';
				echo '<ul><li>Food (Set of your choice:)</li></ul>';
				echo '<div style="margin-left: 50px;">';
				echo '<p><a href="food.php?pack=1">Package One</a></p>';
				echo '<p><a href="food.php?pack=2">Package Two</a></p>';
				echo '<p><a href="food.php?pack=3">Package Three</a></p>';
				echo '<p><a href="food.php?pack=4">Package Four</a></p>';
				echo '</div>';
			}
		}
		
						?>
                <?php if($_GET['set'] != 4){echo '<ul>';}?>
				<?php echo $detailsof; ?>
				<?php if($_GET['set'] != 4){echo '</ul>';}?>
                        </div>
                        <div class="panel-footer">
                            <p>Note:</p>
							<ul>
							<li>King Philippe’s Catering also offers Off-Premise Food Catering Services – full and complete catering set-up at any of your desired venue (Clubhouses, Ballroom/Function Halls, Residences, etc.)</li>
							<li>For Off-premise Catering Service, we offer all amenities enumerated above and apply the same prices per head. No additional cost.</li>
							<li>Venue and Sound System are not included in the price per head for Off-{Premise Catering Services.</li>
							</ul>
							
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