<!DOCTYPE html>
<html lang="en">

<head>

	<?php include_once'adds/scripts.php'; ?>
	
	<?php include_once'adds/javascripts.php'; ?>
	
</head>


<body>

    <?php include_once'adds/nav.php'; ?>

<?php
$cons = '';
$modals='';
$scrpts1='';
$seev = $link->query("select * from tbl_resdes where status = 'serving'");
$seevc = $seev->num_rows; $cuz='';
if($seevc>=1){while($row = $seev->fetch_object()){
$retns = $row->retns;
$reuid = $row->reuid;
$vdate = $row->vdate;
$stime = $row->stime;
$city = $row->city;
$address = $row->address;
$barangay = $row->barangay;
$province = $row->province;
$zip = $row->zip;
if($row->land == ''){$land = 'Not set';}else{$land = $row->land;}
$secl = $link->query("select fname, lname from tbl_user where id = '$reuid'");
$seclc = $secl->num_rows;
if($seclc>=1){while($row = $secl->fetch_object()){
$fname = $row->fname;
$lname = $row->lname;
}}

$cons .='
	<tr>
        <td>'.$retns.'</td>
        <td>'.$fname.' '.$lname.'</td>
        <td>'.$vdate.'</td>
        <td>'.$stime.'</td>
        <td>'.$city.'</td>
        <td>'.$land.'</td>
        <td>
		<a data-toggle="modal" data-target="#wide-'.$retns.'"><span class="glyphicon glyphicon-fullscreen"></span></a>
		<a data-toggle="modal" data-target="#served-'.$retns.'"><span class="glyphicon glyphicon-ok"></span></a></td>
    </tr>
	';
$seco = $link->query("select * from tbl_reser where tnsid = '$retns'");
$secoc = $seco->num_rows;$des1='';$tp=0;$tp1=0;
if($secoc>=1){while($row = $seco->fetch_object()){
$pak = $row->pak;
$pr = $row->fppserve * $row->pak;
$tp = $pr + $tp1;
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
$modals .='
<!-- Modal -->
<div class="modal fade" id="wide-'.$retns.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h4 class="modal-title" id="myModalLabel">Transaction '.$retns.'</h4>
      </div>
      <div class="modal-body">
		<div id="div'.$retns.'" name="div'.$retns.'">

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
							
							<table border="0" cellpadding="2" cellspcing="3" width="100%">
							<tr>
							<td><b>Event Date:</b></td>
							<td>'.$vdate.'</td>
							</tr>
							
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

							
							<!-- <div class="col-md-12"><b>Event Date:</b></div>
							<div class="col-md-2"></div> <div class="col-md-10">'.$vdate.'</div>
							
							<div class="col-md-12"><b>Time Start:</b></div>
							<div class="col-md-2"></div> <div class="col-md-10">'.$stime.'</div>
							<div class="col-md-12"><b>Venue:</b></div>
							
							<div class="col-md-2">Address</div> <div class="col-md-10">'.$address.'</div>
							<div class="col-md-2">Barangay</div> <div class="col-md-10">'.$barangay.'</div>
							<div class="col-md-2">City</div> <div class="col-md-10">'.$city.'</div>
							<div class="col-md-2">Province</div> <div class="col-md-10">'.$province.'</div>
							<div class="col-md-2">Zip Code</div> <div class="col-md-10">'.$zip.'</div>
							<div class="col-md-2">Landmark</div> <div class="col-md-10">'.$land.'</div> -->
                        </div>
                    </div>
		
		
		</div>
      </div>
      <div class="modal-footer">
		<button type="button" class="btn btn-primary" onclick="PrintElem(\'#div'.$retns.'\')">Print</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>	

<div class="modal fade" id="served-'.$retns.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Transaction Complete</h4>
		</div>
		<div class="modal-body">
			Are you sure you want to set this transaction with Transaction ID of '.$retns.' completed(Reservation Rendered)?
		</div>
		<div class="modal-footer">
			<form method="post" action="action.php?act=render" enctype="multipart/form-data" role="form">
			<input type="hidden" value="'.$vdate.'" name="dat" id="dat">
			<input type="hidden" value="'.$retns.'" name="tns" id="tns">
			<input type="submit" value="Yes" class="btn btn-primary">
			<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
			</form>
			
		</div>
	</div>
	</div>
</div>
';

}}

?>	
<script type="text/javascript" src="js/jquery.js" > </script> 
<script type="text/javascript">

    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data) 
    {
        var mywindow = window.open('', 'my div', 'height=800,width=1200');
        mywindow.document.write('<html><head><title></title>');
        mywindow.document.write(' <link href="css/bootstrap.min.css" rel="stylesheet">');
        mywindow.document.write('<link href="css/modern-business.css" rel="stylesheet">');
        mywindow.document.write('<link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10

        mywindow.print();
        mywindow.close();

        return true;
    }

</script>


<style>	

div#printhead {
position: fixed; top: 0; left: 0; width: 100%; height: 2em;
padding-bottom: 1em;
border-bottom: 1px solid;
margin-bottom: 10px;
}
div#printfoot {
position: fixed; top: 0; left: 0; width: 100%; height: 2em;
padding-bottom: 1em;
border-bottom: 1px solid;
margin-bottom: 10px;
}

@media screen {
	
  div#printhead {
  display: none;
  }
  div#printfoot {
  display: none;
  }

}

@media print {

  div#printhead {
  display: block;
  }
  div#printfoot {
  display: block;
  }

}

</style> 

    <!-- Page Content -->
    <div class="container">
		<br>
        <!-- Page Heading/Breadcrumbs -->
        <div class="row">	
				<div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Events
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Transaction ID</th>
                                            <th>Client</th>
                                            <th>Event Date</th>
                                            <th>Start Time</th>
                                            <th>Location</th>
                                            <th>Landmark</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php echo $cons; ?>
                                    </tbody>
                                </table>
								<?php echo $modals; ?>
								<?php echo $scrpts1; ?>
                            </div>
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
    </script>
</html>