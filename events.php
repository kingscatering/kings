<?php
$deets = $_POST['deets'];
$deets = preg_replace('#[^0-9-]#i', '', $deets);

include ("connect.php");
mysql_connect("$db_host", "$db_username", "$db_pass");
mysql_select_db("$db_name");
// $link = mysqli_connect($db_host,$db_username,$db_pass,$db_name) or die("Error " . mysqli_error($link));

$events = '';
$cons = '';
$modals = '';
$query = mysql_query('select distinct tnsid from tbl_reser where pdate = "'.$deets.'"');
$num_rows = mysql_num_rows($query);
if($num_rows > 0){
	$events .= '<div id="eventsControl"><button onmousedown="overlay()">Close</button><br><b>'.$deets.'</b><br></div>';
	while($row = mysql_fetch_array($query)){
		$tnsid = $row['tnsid'];
		
		$queryuid = mysql_query('select uid from tbl_reser where tnsid = "'.$tnsid.'" limit 1');
		$queryuidc = mysql_num_rows($queryuid);
		if($queryuidc > 0){
		while($row = mysql_fetch_array($queryuid)){
			$uid = $row['uid'];
				$queryuinfo = mysql_query('select fname, lname from tbl_user where id = "'.$uid.'" limit 1');
				$queryuinfoc = mysql_num_rows($queryuinfo);
				if($queryuinfoc > 0){
				while($row = mysql_fetch_array($queryuinfo)){
					$fname = $row['fname'];
					$lname = $row['lname'];
				}}
		}}
	$cons .='
	<tr>
        <td>'.$tnsid.'</td>
        <td>'.$fname.' '.$lname.'</td>
        <td>
		<a data-toggle="modal" data-target="#wide-'.$tnsid.'"><span class="glyphicon glyphicon-fullscreen"></span></a>
		<a data-toggle="modal" data-target="#served-'.$tnsid.'"><span class="glyphicon glyphicon-ok"></span></a>
		</td>
    </tr>
	';
		
		$queryfood = mysql_query('select fcode, fcourse, fname, fwala, fppserve, pak from tbl_reser where tnsid = "'.$tnsid.'" limit 1');
		$queryfoodc = mysql_num_rows($queryfood);$des1='';$tp=0;$tp1=0;
		if($queryfoodc > 0){
		while($row = mysql_fetch_array($queryfood)){
			$fcode = $row['fcode'];
			$fcourse = $row['fcourse'];
			$fname2 = $row['fname'];
			$fwala = $row['fwala'];
			$fppserve = $row['fppserve'];
			$pak = $row['pak'];
$pr = $fppserve * $pak;
$tp = $pr + $tp1;
$tp1 = $tp;
$des1 .='
	<tr>
		<td>'.$fcode.'</td>							
		<td>'.$fcourse.'</td>
		<td>'.$fname2.'</td>
		<td>'.$fwala.'</td>							
    </tr>
';
		}}
		$moredetails='';
		$querymoredets = mysql_query('select * from tbl_resdes where retns = "'.$tnsid.'" limit 1');
		$querymoredetsc = mysql_num_rows($querymoredets);
		if($querymoredetsc > 0){
		while($row = mysql_fetch_array($querymoredets)){
			$stime = $row['stime'];
			$address = $row['address'];
			$barangay = $row['barangay'];
			$city = $row['city'];
			$province = $row['province'];
			$zip = $row['zip'];
			if($row['land'] == ''){$land = 'Not set';}else{$land = $row['land'];}
			// $land = $row['land'];
$moredetails='
							<table border="0" cellpadding="2" cellspcing="3" width="100%">
							
							<tr>
							<td><b>Time Start:</b></td>
							<td>'.$stime.'</td>
							</tr>
							
							<tr>
							<td><b>Venue:</b></td>
							<td></td>
							<td></td>
							</tr>
							
							<tr>
							<td width="10%"></td>
							<td>Address</td>
							<td>'.$address.'</td>
							</tr>
							
							<tr>
							<td width="10%"></td>
							<td>Barangay</td>
							<td>'.$barangay.'</td>
							</tr>
							
							<tr>
							<td width="10%"></td>
							<td>City</td>
							<td>'.$city.'</td>
							</tr>
							
							<tr>
							<td width="10%"></td>
							<td>Province</td>
							<td>'.$province.'</td>
							</tr>
							
							<tr>
							<td width="10%"></td>
							<td>Zip Code</td>
							<td>'.$zip.'</td>
							</tr>
							
							<tr>
							<td width="10%"></td>
							<td width="20%">Landmark</td>
							<td>'.$land.'</td>
							</tr>
							
							</table>
';
		}} else {$moredetails='Not Yet Set by the Client!';}
		
$modals .='
<!-- Modal -->
<div class="modal fade" id="wide-'.$tnsid.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h4 class="modal-title" id="myModalLabel">Transaction '.$tnsid.'</h4>
      </div>
      <div class="modal-body">
		<div id="div'.$tnsid.'" name="div'.$tnsid.'">

<div id="printhead">
	<p>
	<div class="col-md-12" align="center"> <b style="font-family: Monotype Corsiva; font-size: 50px; color: #336699;"> <img src="images/Kings.png" style="height: 50px;"/> King Philippe’s Catering</b> </div>
	</p>
</div>
		
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            Menu ('.$pak.' Pax)
                        </div>
                        <div class="panel-body">
						
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
                                        '.$des1.'
										
										<tr>
                                            <td colspan="3"><b>Total</b></td>
                                            <td>₱ '.number_format($tp,2).'</td>
                                        </tr>
										
                                    </tbody>
                                </table>								
                            </div>
							
							<div class="col-md-12"><h4>More Details:</h4></div>
							'.$moredetails.'
                        </div>
                    </div>
		
		
		</div>
      </div>
      <div class="modal-footer">
		<!-- <button type="button" class="btn btn-primary" onclick="PrintElem(\'#div'.$tnsid.'\')">Print</button> -->
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>	

<div class="modal fade" id="served-'.$tnsid.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Transaction Complete</h4>
		</div>
		<div class="modal-body">
			Are you sure you want to set this transaction with Transaction ID of '.$tnsid.' completed(Reservation Rendered)?
		</div>
		<div class="modal-footer">
			<form method="post" action="action.php?act=render" enctype="multipart/form-data" role="form">
			<input type="hidden" value="'.$deets.'" name="dat" id="dat">
			<input type="hidden" value="'.$tnsid.'" name="tns" id="tns">
			<input type="submit" value="Yes" class="btn btn-primary">
			<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
			</form>
			
		</div>
	</div>
	</div>
</div>
';
		
	}
	$events .= '<div id="eventsBody">
						<div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Transaction ID</th>
                                            <th>Client</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
									'.$cons.'
                                    </tbody>
                                </table>
								'.$modals.'
                            </div>
                        </div>
	</div>';
}
echo $events;
?>