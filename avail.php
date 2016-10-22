<!DOCTYPE html>
<html lang="en">

<head>

	<?php include_once'adds/scripts.php'; ?>
	<?php if(!isset($_SESSION['uids'])){echo'<script>alert("Please log in first!"); window.history.back();</script>';} ?>	
	<?php include_once'adds/javascripts.php'; ?>
	
</head>
<?php if(isset($_SESSION['uids'])) { ?>
<body>

    <?php include_once'adds/nav.php'; ?>
	
    <!-- Page Content -->
    <div class="container">
		<br>
        <!-- Page Heading/Breadcrumbs -->
        <div class="row">	
            <div class="col-md-12">
				
<?php 		
	$avty = $_GET['type']; 
	$seco = $_GET['code']; 
	
	$pp_checkout_btn='';
	$product_id_array='';
	if($avty == 'sug') {
		$secm = $_GET['cm']; 
		$sepa = $_GET['pak']; 
		$pricelist = $link->query("SELECT * FROM tbl_menu INNER JOIN tbl_package ON tbl_menu.id=tbl_package.mid where tbl_package.pset = '$seco' and tbl_package.type = '$secm'");
		$pricelistc = $pricelist->num_rows; $totalp='';$total1=0;$des1='';
		if ($pricelistc>=1) {
			$ced=1;
			$pp_checkout_btn .= '<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
				<input type="hidden" name="cmd" value="_cart">
				<input type="hidden" name="upload" value="1">
				<input type="hidden" name="business" value="kingphilippe032313-facilitator@gmail.com">
			';
			while ($row = $pricelist->fetch_object()) {
		
				$pp_checkout_btn .= '<input type="hidden" name="item_name_'.$ced.'" value="'.$row->wala.' - '.$row->name.'">
			        <input type="hidden" name="amount_'.$ced.'" value="'.$row->ppserve.'">
			        <input type="hidden" name="quantity_'.$ced.'" value="'.$sepa.'">
				';
				$product_id_array .= $row->id."-".$sepa.","; 
				$pps = $row->ppserve;	
				$totalp = $pps + $total1;
				$total1 = $totalp;
				$des1 .='
													<tr>
			                                            <td>'.$row->code.'</td>							
			                                            <td>'.$row->course.'</td>
			                                            <td>'.$row->name.'</td>
			                                            <td>'.$row->wala.'</td>							
			                                        </tr>
				';
				$ced++;
			}
		}
		$ab = $totalp * $sepa;
		$pp_checkout_btn .= '
		<input type="hidden" name="custom" value="'.$product_id_array.'">
		<input type="hidden" name="notify_url" value="http://localhost/Kings/my_ipn2.php">
		<input type="hidden" name="return" value="http://localhost/Kings/my_ipn.php?type='.$avty.'&code='.$seco.'&cm='.$secm.'&pak='.$sepa.'">
		<input type="hidden" name="rm" value="2">
		<input type="hidden" name="cbt" value="Return to The Store">
		<input type="hidden" name="cancel_return" value="http://localhost/Kings/avail.php?type='.$avty.'&code='.$seco.'&cm='.$secm.'&pak='.$sepa.'">
		<input type="hidden" name="lc" value="PH">
		<input type="hidden" name="currency_code" value="PHP">
		<input type="image" src="http://www.paypal.com/en_US/i/btn/x-click-but06.gif" name="submit" alt="Make payments with PayPal - its fast, free and secure!" style="width: 70px">
		</form>'
	;
?>
					<div class="panel panel-primary">
                        <div class="panel-heading">
							Reservation Menu for <?php echo $sepa; ?> Pax
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
                                            <td>₱ <?php echo number_format($ab,2); ?></td>
                                        </tr>
										
                                    </tbody>
                                </table>
                            </div>
                    </div>
					
		<div class="col-md-12" align="right"><?php echo $pp_checkout_btn; ?></div>
		
<?php
	} 
	else if($avty == 'nor') {

		$secm = $_GET['cm']; 
		$sepa = $_GET['pak']; 
		$pricelist = $link->query("SELECT * FROM tbl_menu INNER JOIN tbl_package ON tbl_menu.id=tbl_package.mid where tbl_package.pset = '$seco' and tbl_package.type = '$secm'");
		$pricelistc = $pricelist->num_rows; 
		$totalp='';
		$total1=0;
		$des1='';
		if ($pricelistc>=1) {
			$ced=1;
			$pp_checkout_btn .= '<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
				<input type="hidden" name="cmd" value="_cart">
				<input type="hidden" name="upload" value="1">
				<input type="hidden" name="business" value="kingphilippe032313-facilitator@gmail.com">
			';
			while($row = $pricelist->fetch_object()) {
			
				$pp_checkout_btn .= '<input type="hidden" name="item_name_'.$ced.'" value="'.$row->wala.' - '.$row->name.'">
			        <input type="hidden" name="amount_'.$ced.'" value="'.$row->ppserve.'">
			        <input type="hidden" name="quantity_'.$ced.'" value="'.$sepa.'">
				';
				$product_id_array .= $row->id."-".$sepa.","; 
				$pps = $row->ppserve;	
				$totalp = $pps + $total1;
				$total1 = $totalp;
				$des1 .='
													<tr>
			                                            <td>'.$row->code.'</td>							
			                                            <td>'.$row->course.'</td>
			                                            <td>'.$row->name.'</td>
			                                            <td>'.$row->wala.'</td>							
			                                        </tr>
				';
				$ced++;
			}
		}
		$ab = $totalp * $sepa;
		$pp_checkout_btn .= '
		<input type="hidden" name="custom" value="'.$product_id_array.'">
		<input type="hidden" name="notify_url" value="http://localhost/Kings/my_ipn2.php">
		<input type="hidden" name="return" value="http://localhost/Kings/my_ipn.php?type='.$avty.'&code='.$seco.'&cm='.$secm.'&pak='.$sepa.'">
		<input type="hidden" name="rm" value="2">
		<input type="hidden" name="cbt" value="Return to The Store">
		<input type="hidden" name="cancel_return" value="http://localhost/Kings/avail.php?type='.$avty.'&code='.$seco.'&cm='.$secm.'&pak='.$sepa.'">
		<input type="hidden" name="lc" value="PH">
		<input type="hidden" name="currency_code" value="PHP">
		<input type="image" src="http://www.paypal.com/en_US/i/btn/x-click-but06.gif" name="submit" alt="Make payments with PayPal - its fast, free and secure!" style="width: 70px">
		</form>'
	;
?>
					<div class="panel panel-primary">
                        <div class="panel-heading">
							Reservation Menu for <?php echo $sepa; ?> Pax
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
                                            <td>₱ <?php echo number_format($ab,2); ?></td>
                                        </tr>
										
                                    </tbody>
                                </table>
                            </div>
                    </div>
					
		<div class="col-md-12" align="right"><?php echo $pp_checkout_btn; ?></div>	
	
<?php
	} 
	else if ($avty == 'cuz') {
		$ida = $_SESSION['uids'];
		$sepa = $_GET['pak']; 
		$pricelist = $link->query("SELECT * FROM tbl_menu INNER JOIN tbl_custo ON tbl_menu.id=tbl_custo.mid where tbl_custo.code = '$seco' and tbl_custo.creator = '$ida'");
		$pricelistc = $pricelist->num_rows; 
		$totalp='';
		$total1=0;
		$des1='';
		if ($pricelistc>=1) {
			$ced=1;
		$pp_checkout_btn .= '<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
			<input type="hidden" name="cmd" value="_cart">
			<input type="hidden" name="upload" value="1">
			<input type="hidden" name="business" value="kingphilippe032313-facilitator@gmail.com">
		';
			while ($row = $pricelist->fetch_object()) {
			
				$pp_checkout_btn .= '<input type="hidden" name="item_name_'.$ced.'" value="'.$row->wala.' - '.$row->name.'">
			        <input type="hidden" name="amount_'.$ced.'" value="'.$row->ppserve.'">
			        <input type="hidden" name="quantity_'.$ced.'" value="'.$sepa.'">
				';
				$product_id_array .= $row->id."-".$sepa.","; 
				$pps = $row->ppserve;	
				$totalp = $pps + $total1;
				$total1 = $totalp;
				$des1 .='
													<tr>
			                                            <td>'.$row->code.'</td>							
			                                            <td>'.$row->course.'</td>
			                                            <td>'.$row->name.'</td>
			                                            <td>'.$row->wala.'</td>							
			                                        </tr>
				';
				$ced++;
			}
		}
		$ab = $totalp * $sepa;
		$pp_checkout_btn .= '
			<input type="hidden" name="custom" value="'.$product_id_array.'">
			<input type="hidden" name="notify_url" value="http://localhost/Kings/my_ipn2.php">
			<input type="hidden" name="return" value="http://localhost/Kings/my_ipn.php?type='.$avty.'&code='.$seco.'&pak='.$sepa.'">
			<input type="hidden" name="rm" value="2">
			<input type="hidden" name="cbt" value="Return to The Store">
			<input type="hidden" name="cancel_return" value="http://localhost/Kings/avail.php?type='.$avty.'&code='.$seco.'&pak='.$sepa.'">
			<input type="hidden" name="lc" value="PH">
			<input type="hidden" name="currency_code" value="PHP">
			<input type="image" src="http://www.paypal.com/en_US/i/btn/x-click-but06.gif" name="submit" alt="Make payments with PayPal - its fast, free and secure!" style="width: 70px">
			</form>'
				;
?>
					<div class="panel panel-primary">
                        <div class="panel-heading">
							Reservation Menu for <?php echo $sepa; ?> Pax
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
                                            <td>₱ <?php echo number_format($ab,2); ?></td>
                                        </tr>
										
                                    </tbody>
                                </table>
                            </div>
                    </div>

		<div class="col-md-12" align="right"><?php echo $pp_checkout_btn; ?></div>	
	
<?php
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
<?php } ?>
</html>