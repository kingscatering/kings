
<?php
include_once'adds/scripts.php';
include 'connect.php';
$link = mysqli_connect($db_host,$db_username,$db_pass,$db_name) or die("Error " . mysqli_error($link));

if(isset($_POST["usercheck"])){
	$usercheck = $_POST['usercheck'];
	$sql="select id from accounts where username = '$usercheck' limit 1";
	$result = $link->query($sql);
	$count = $result->num_rows;
	
	if (strlen($usercheck) < 5 || strlen($usercheck) >= 23) {
	    echo '<strong style="color:#F00;">Must 5 - 22 characters!</strong>';
	    exit();
    } else if ($count < 1) {
	    echo '<strong style="color:#009900;">' . $usercheck . ' is okay.</strong>';
	    exit();
    } else {
	    echo '<strong style="color:#F00;">' . $usercheck . ' is taken!</strong>';
	    exit();
    }
	
}

if(isset($_POST["emailLogcheck"])){
	$email = $_POST['emailLogcheck'];
	$sql="select id from accounts where email = '$email' limit 1";
	$result = $link->query($sql);
	$count = $result->num_rows;
    
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {		
		echo '<strong style="color:#F00;"> E-mail is not in valid format!</strong>';
		exit();
	} else if ($count < 1) {
	    echo '<strong style="color:#009900;">' . $email . ' is okay. </strong>';
	    exit();
    } else {
	    echo '<strong style="color:#F00;">' . $email . ' is taken. </strong>';
	    exit();
    }
}

if(isset($_POST["msg_telephonecheck"])){
	$msg_telephone = $_POST['msg_telephonecheck'];
    $suf = substr($msg_telephone, 0, 3);
	$sql="select id from service_provider where suf = '$suf' limit 1";
	$result = $link->query($sql);
	$count = $result->num_rows;
	
	if($count < 1 or strlen($msg_telephone) < 10) {
		echo '<strong style="color:#F00;"> Invalid Phone # format!</strong>';
		exit();
	} else {
		echo'';
		exit();
	}
}

if(isset($_POST["emailLogcheckc"])){
	$email = $_POST['emailLogcheckc'];
    
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {		
		echo '<strong style="color:#F00;"> E-mail is not in valid format!</strong>';
		exit();
	} else {
	    echo '';
	    exit();
    }
}

if(isset($_POST["msg_telephonecheckc"])){
	$msg_telephone = $_POST['msg_telephonecheckc'];
    $suf = substr($msg_telephone, 0, 3);
	$sql="select id from service_provider where suf = '$suf' limit 1";
	$result = $link->query($sql);
	$count = $result->num_rows;
	
	if($count < 1 or strlen($msg_telephone) < 10) {
		echo '<strong style="color:#F00;"> Invalid Phone # format!</strong>';
		exit();
	} else {
		echo'';
		exit();
	}
}

/*
	PROFILE ACCOUNT SCRIPT
*/

if(isset($_GET['auid'])) {
	$id = $_SESSION['uids'];
	include_once("dbCall.php");
	$auiddetail1 = "";
	$auiddetail2 = "";
	$auiddetail3 = "";
	$query = "SELECT username, first_name, last_name, gender, email, contact_number, birthdate, date_added, type, status FROM accounts where id = ".$id;
	$param = ["username", "first_name", "last_name", "gender", "email", "contact_number", "birthdate", "date_added", "type", "status"];
	try {
		$result = $_dbCall->getResultsArray($query, $param);
		if(count($result) > 0) {
			foreach ($result as $row){	
			
				$auiddetail1 .='
							<div class="col-md-2">Name</div><div class="col-md-9">'.$row["first_name"].' '.$row["last_name"].'</div>
							<div class="col-md-2">Gender</div><div class="col-md-9">'.$row["gender"].'</div>
							<div class="col-md-2">E-mail</div><div class="col-md-9">'.$row["email"].'</div>
							<div class="col-md-2">Mobile #</div><div class="col-md-9">'.$row["contact_number"].'</div>
							<div class="col-md-2">Birthday</div><div class="col-md-9">'.$row["birthdate"].'</div>
				';
				$auiddetail2 .='
							<div class="col-md-2">Username</div><div class="col-md-9">'.$row["username"].'</div>
							<div class="col-md-2">Date Join</div><div class="col-md-9">'.$row["date_added"].'</div>
							<div class="col-md-2">Type</div><div class="col-md-9">'.$row["type"].'</div>
							<div class="col-md-2">Status</div><div class="col-md-9">'.$row["status"].'</div>
				';
				$auiddetail3 .='
						<form method="post" action="action.php?act=accpiact" enctype="multipart/form-data" role="form">
							<div class="col-md-2">First Name</div><div class="form-group col-md-9"><input type="text" class="form-control" id="fname" name="fname" placeholder="First name" onkeyup="restrict(\'fname\')" value="'.$row["first_name"].'"required></div>
							<div class="col-md-2">Last Name</div><div class="form-group col-md-9"><input type="text" class="form-control" id="lname" name="lname" placeholder="Last name" onkeyup="restrict(\'lname\')" value="'.$row["last_name"].'"required></div>
							<div class="col-md-2">Last Name</div><div class="col-md-9"><div class="form-group input-group"><span class="input-group-addon"><img src="images/ph.jpg" style="height:10px;"/>+63</span><input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile number" onkeyup="restrict(\'mobile\')" onblur="checkmobile()" maxlength="10" value="'.$row["contact_number"].'"required></div><span id="msg_telephonestatus" class="status"></span></div>
							<div class="form-group col-md-12" align="right"><input type="submit" type="button" class="btn btn-primary" value="Save"></div>	
						</form>
				';
			}
		}
	} catch(Exception $e) {
		echo $e;
	}
}

if(isset($_POST["acecheck"])){
	$email = $_POST['acecheck'];
	$uid = $_SESSION['uids'];
	$sql="select id from accounts where email = '$email' && id != '$uid' limit 1";
	$result = $link->query($sql) or trigger_error($link->error."[$query]");
	$count = $result->num_rows;
    
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {		
		echo '<strong style="color:#F00;"> E-mail is not in valid format!</strong>';
		exit();
	} else if ($count < 1) {
	    echo '<strong style="color:#009900;">' . $email . ' is okay. </strong>';
	    exit();
    } else {
	    echo '<strong style="color:#F00;">' . $email . ' is taken. </strong>';
	    exit();
    }
}

if(curPageName()=='mngacc.php') { 
	$auid = $_SESSION['uids'];
	$alusde = ''; $c = 1;
	$ausinfo = $link->query("select id, first_name, last_name, username, email, contact_number, last_log_date, status, type, gender, birthdate, date_added, image from accounts where id != '$auid'");
	$ausinfoc = $ausinfo->num_rows;
	if ($ausinfoc>=1) {
		while ($row = $ausinfo->fetch_object()) {		
			$alusde .='
						<tr>
                            <td>'.$c.'</td>
                            <td>'.$row->first_name.'</td>
                            <td>'.$row->last_name.'</td>
                            <td>'.$row->username.'</td>
                            <td>'.$row->email.'</td>
                            <td>'.$row->contact_number.'</td>
                            <td>'.$row->last_log_date.'</td>
                            <td>'.$row->type.'</td>
							<td align="center"><div class="tooltip-demo"><a data-toggle="modal" data-target="#detmol'.$row->id.'"><i class="fa fa-list" data-toggle="tooltip" data-placement="top" title="Details"></i></a> &nbsp <a data-toggle="modal" data-target="#delmol'.$row->id.'"><i class="fa fa-times" data-toggle="tooltip" data-placement="top" title="Delete"></i></a></div></td>
                        </tr>
<!-- Modal -->
<div class="modal fade" id="detmol'.$row->id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">'.$row->first_name.' '.$row->last_name.'</h4>
      </div>
      <div class="modal-body">
		<div class="row">
	  
		  <div class="col-sm-6 col-md-4" >
			<div class="thumbnail panel panel-default">
			  <div class="panel-heading"><img src="images/users/'.$row->image.'" alt="'.$row->username.'" height= "200" width="200" style="max-height: 180px; max-width: 130px;" class="img-thumbnail"></div>
			</div>
		  </div>
		  
		  <div class="col-md-8">
			<div class="panel panel-info">
                <div class="panel-heading">
                    Profile Information
                </div>
                <div class="panel-body">
                    <div class="row">
						<div class="col-md-3">Name</div><div class="col-md-9">'.$row->first_name.' '.$row->last_name.'</div>
						<div class="col-md-3">Gender</div><div class="col-md-9">'.$row->gender.'</div>
						<div class="col-md-3">E-mail</div><div class="col-md-9">'.$row->email.'</div>
						<div class="col-md-3">Mobile #</div><div class="col-md-9">'.$row->contact_number.'</div>
						<div class="col-md-3">Birthday</div><div class="col-md-9">'.$row->birthdate.'</div>
					</div>
				</div>
			</div>
		  </div>
		  <div class="col-sm-6 col-md-4" >
			 
		  </div>
		  <div class="col-md-8">
			<div class="panel panel-info">
                <div class="panel-heading">
                    Account Information
                </div>
                <div class="panel-body">
                    <div class="row">
						<div class="col-md-3">Username</div><div class="col-md-9">'.$row->username.'</div>
						<div class="col-md-3">Date Join</div><div class="col-md-9">'.$row->date_added.'</div>
						<div class="col-md-3">Status</div><div class="col-md-9">'.$row->status.'</div>
					</div>
				</div>
			</div>
		  </div>
		</div>	  
      </div>
      <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="delmol'.$row->id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Delete</h4>
      </div>
      <div class="modal-body">
		
			Are you sure you want to delete this account?
		
      </div>
      <div class="modal-footer">
		<a href="action.php?act=del&idtd='.$row->id.'" class="btn btn-danger">Delete</a>
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>					
			'; $c++;
		}
	}

}

if(isset($_POST["emailLogchecknv"])){
	$email = $_POST['emailLogchecknv'];
    
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {		
		echo '<strong style="color:#F00;"> E-mail is not in valid format!</strong>';
		exit();
	} else {
	    echo '';
	    exit();
    }
}

if(isset($_POST["mnnamecheck"])){
	$mnname = $_POST['mnnamecheck'];
    $result = $link->query("select id from dish where name = '$mnname' limit 1");
	$count = $result->num_rows;
	if ($count != 1) {		
		echo '';
		exit();
	} else {
	    echo '<strong style="color:#F00;">This name is already existed!</strong>';
	    exit();
    }
}



if(curPageName()=='mngpck.php'){
	$appid1 = '';
	$appi = $link->query("select * from dish where course = 'Appetizer'");
	$appic = $appi->num_rows;
	// echo '<script type="text/javascript">alert("'.$appic.'");</script>';
	if ($appic==0){
		$e=1;
	}
	else if($appic>=1){$e=1;
		while ($row = $appi->fetch_object()){	
		$ppser = explode(".", $row->price);
		$ppser1 = $ppser[0];
			$appid1 .='
						<tr>
							<td>'.$e.'</td>
                            <td>'.$row->name.'</td>
                            <td>'.$row->food_type.'</td>
                            <td>'.$row->price.'</td>
                            <td align="center"><div class="tooltip-demo"><a data-toggle="modal" data-target="#detmol'.$row->id.'"><i class="fa fa-list" data-toggle="tooltip" data-placement="top" title="Edit"></i></a> &nbsp <a data-toggle="modal" data-target="#delmol'.$row->id.'"><i class="fa fa-times" data-toggle="tooltip" data-placement="top" title="Delete"></i></a></div></td>
						</tr>
<!-- Modal -->
<div class="modal fade" id="detmol'.$row->id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">'.$row->name.'</h4>
      </div>
      <div class="modal-body">
		<div class="row">
	  
		  <div class="col-sm-6 col-md-4" >
			<div class="thumbnail panel panel-default">
			  <div class="panel-heading"><img src="images/gal/menu/'.$row->image.'" alt="'.$row->name.'" style="max-height: 180px; max-width: 130px;" class="img-thumbnail"></div>
			  <div class="caption">
				[<a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$e.'" onclick="menimg'.$e.'();">Change Image</a>]				
			  </div>
			</div>
		  </div>
				
		  <div class="col-md-8">
			<div class="panel panel-info">
                <div class="panel-heading">
                    Edit Details
                </div>
		
                <div class="panel-body" name="tldiv'.$e.'" id="tldiv'.$e.'">
                    <div class="row">
					<div class="col-md-12">
			<form method="post" action="action.php?act=edmedy&maxe='.$e.'&mid='.$row->id.'" enctype="multipart/form-data" role="form">
				<fieldset>
					<div class="form-group">
					<input class="form-control" placeholder="Name" name="mnname'.$e.'" id="mnname'.$e.'" onblur="checkmnnamea'.$e.'();" value="'.$row->name.'" required>
					<input type="hidden" name="1mnname'.$e.'" id="1mnname'.$e.'" value="'.$row->id.'">
					<span id="mnnamestatus'.$e.'" class="status"></span>
                    </div>
					
                    <div class="form-group">
                        <label>Variety</label>
                        <select class="form-control" name="mnvar'.$e.'" id="mnvar'.$e.'" required>
                            <option value="'.$row->course.'">'.$row->course.'</option>
                            <option value="Dips">Dips</option>
                            <option value="Vegetable and Fruit Trays">Vegetable and Fruit Trays</option>
                            <option value="Meal and Cheese Trays">Meal and Cheese Trays</option>
                            <option value="Hot Appetizers">Hot Appetizers</option>
                        </select>
                    </div>
					
					<div class="form-group input-group">
                    <span class="input-group-addon">₱</span>
                    <input type="text" class="form-control" name="mnpps'.$e.'" id="mnpps'.$e.'" onkeyup="restrict(\'mnpps'.$e.'\')" maxlength="4" value="'.$ppser1.'" required>
                    <span class="input-group-addon">.00</span>
                    </div>
					<input type="hidden" name="e" id="e" value="'.$e.'">
					<input type="submit" value="Edit" class="btn btn-md btn-success btn-block" />
                </fieldset>
            </form>	
					</div>
					</div>
				</div>
				
				<div class="panel-body"><div class="row"><div class="col-md-8"><div id="collapse'.$e.'" class="panel-collapse collapse">                    
            <form method="post" action="action.php?act=edmedyp&maxe='.$e.'&mid='.$row->id.'" enctype="multipart/form-data" role="form">
				<input type="file" name="mpic'.$e.'" id="mpic'.$e.'" required>
				<div align="right"><input type="submit" value="Upload" class="btn btn-md btn-success" /></div>
			</form>
      </div></div></div></div>
	  
			</div>
		  </div>		  
		</div>	  
      </div>
	  
	  
      <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
	
<!-- Modal -->
<div class="modal fade" id="delmol'.$row->id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Delete</h4>
      </div>
      <div class="modal-body">
		
			Are you sure you want to delete this?
		
      </div>
      <div class="modal-footer">
		<a href="action.php?act=delmenu&idtd='.$row->id.'" class="btn btn-danger">Delete</a>
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>	
			';
echo'
<script>
	function checkmnnamea'.$e.'(){
			var mnname1 = document.getElementById(\'1mnname'.$e.'\').value
			var mnname2 = _("mnname'.$e.'").value;
			var mnname = mnname2+"-"+mnname1;
			if(mnname != ""){
				_("mnnamestatus'.$e.'").innerHTML = \'checking ...\';
					var ajax = ajaxObj("POST", "mngpck.php" );
					ajax.onreadystatechange = function() {
						if(ajaxReturn(ajax) == true) {
							_("mnnamestatus'.$e.'").innerHTML = ajax.responseText;
						}
					}
					ajax.send("mnnamecheck'.$e.'="+mnname);
			}
		}
	function menimg'.$e.'(){
			if(tldiv'.$e.'.style.display == \'none\'){tldiv'.$e.'.style.display = \'block\';} 
			else {tldiv'.$e.'.style.display = \'none\';}
		}
</script>
	';
if(isset($_POST["mnnamecheck$e"])){
	$mnname = $_POST['mnnamecheck'.$e.''];
		$divn = explode("-", $mnname);
		$namec = $divn[0];
		$idc = $divn[1];
    $result = $link->query("select id from dish where name = '$namec' && id != '$idc' limit 1");
	$count = $result->num_rows;
	if ($count != 1) {		
		echo '';
		exit();
	} else {
	    echo '<strong style="color:#F00;">This name is already existed!</strong>';
	    exit();
    }
}			$e++;
		}	
	}
	
	$appid2 = '';
	$appi2 = $link->query("select * from dish where course = 'Entree'");
	$appic2 = $appi2->num_rows;
	if ($appic2==0){
		$e=1;
	}
	if($appic2>=1){$e2=1;
		while ($row = $appi2->fetch_object()){	
		$ppser2 = explode(".", $row->price);
		$ppser12 = $ppser2[0];
			$appid2 .='
						<tr>
							<td>'.$e2.'</td>
                            <td>'.$row->name.'</td>
                            <td>'.$row->food_type.'</td>
                            <td>'.$row->price.'</td>
                            <td align="center"><div class="tooltip-demo"><a data-toggle="modal" data-target="#detmol'.$row->id.'"><i class="fa fa-list" data-toggle="tooltip" data-placement="top" title="Edit"></i></a> &nbsp <a data-toggle="modal" data-target="#delmol'.$row->id.'"><i class="fa fa-times" data-toggle="tooltip" data-placement="top" title="Delete"></i></a></div></td>
						</tr>
<!-- Modal -->
<div class="modal fade" id="detmol'.$row->id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">'.$row->name.'</h4>
      </div>
      <div class="modal-body">
		<div class="row">
	  
		  <div class="col-sm-6 col-md-4" >
			<div class="thumbnail panel panel-default">
			  <div class="panel-heading"><img src="images/gal/menu/'.$row->image.'" alt="'.$row->name.'" style="max-height: 180px; max-width: 130px;" class="img-thumbnail"></div>
			  <div class="caption">
				[<a data-toggle="collapse" data-parent="#accordion" href="#collapse2'.$e2.'" onclick="menimg2'.$e2.'();">Change Image</a>]				
			  </div>
			</div>
		  </div>
				
		  <div class="col-md-8">
			<div class="panel panel-info">
                <div class="panel-heading">
                    Edit Details
                </div>
		
                <div class="panel-body" name="tldiv2'.$e2.'" id="tldiv2'.$e2.'">
                    <div class="row">
					<div class="col-md-12">
			<form method="post" action="action.php?act=edmedy2&maxe='.$e2.'&mid='.$row->id.'" enctype="multipart/form-data" role="form">
				<fieldset>
					<div class="form-group">
					<input class="form-control" placeholder="Name" name="mnname2'.$e2.'" id="mnname2'.$e2.'" onblur="checkmnnamea2'.$e2.'();" value="'.$row->name.'" required>
					<input type="hidden" name="1mnname2'.$e2.'" id="1mnname2'.$e2.'" value="'.$row->id.'">
					<span id="mnnamestatus2'.$e2.'" class="status"></span>
                    </div>
					
                    <div class="form-group">
                        <label>Variety</label>
                        <select class="form-control" name="mnvar2'.$e2.'" id="mnvar2'.$e2.'" required>
                            <option value="'.$row->food_type.'">'.$row->food_type.'</option>
                            <option value="Chicken">Chicken</option>
                            <option value="Beef">Beef</option>
                            <option value="Pork">Pork</option>
                            <option value="Vegetable">Vegetable</option>
                        </select>
                    </div>
					
					<div class="form-group input-group">
                    <span class="input-group-addon">₱</span>
                    <input type="text" class="form-control" name="mnpps2'.$e2.'" id="mnpps2'.$e2.'" onkeyup="restrict(\'mnpps2'.$e2.'\')" maxlength="4" value="'.$ppser12.'" required>
                    <span class="input-group-addon">.00</span>
                    </div>
					<input type="hidden" name="e2" id="e2" value="'.$e2.'">
					<input type="submit" value="Edit" class="btn btn-md btn-success btn-block" />
                </fieldset>
            </form>	
					</div>
					</div>
				</div>
				
	  <div class="panel-body"><div class="row"><div class="col-md-8"><div id="collapse2'.$e2.'" class="panel-collapse collapse">                    
            <form method="post" action="action.php?act=edmedyp&maxe='.$e2.'&mid='.$row->id.'" enctype="multipart/form-data" role="form">
				<input type="file" name="mpic'.$e2.'" id="mpic'.$e2.'" required>
				<div align="right"><input type="submit" value="Upload" class="btn btn-md btn-success" /></div>
			</form>
      </div></div></div></div>
	  
			</div>
		  </div>		  
		</div>	  
      </div>
	  
	  
      <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
	
<!-- Modal -->
<div class="modal fade" id="delmol'.$row->id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Delete</h4>
      </div>
      <div class="modal-body">
		
			Are you sure you want to delete this?
		
      </div>
      <div class="modal-footer">
		<a href="action.php?act=delmenu&idtd='.$row->id.'" class="btn btn-danger">Delete</a>
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>	
			';
echo'
<script>
	function checkmnnamea2'.$e2.'(){
			var mnname1 = document.getElementById(\'1mnname2'.$e2.'\').value
			var mnname2 = _("mnname2'.$e2.'").value;
			var mnname = mnname2+"-"+mnname1;
			if(mnname != ""){
				_("mnnamestatus2'.$e2.'").innerHTML = \'checking ...\';
					var ajax = ajaxObj("POST", "mngpck.php" );
					ajax.onreadystatechange = function() {
						if(ajaxReturn(ajax) == true) {
							_("mnnamestatus2'.$e2.'").innerHTML = ajax.responseText;
						}
					}
					ajax.send("mnnamecheck2'.$e2.'="+mnname);
			}
		}
	function menimg2'.$e2.'(){
			if(tldiv2'.$e2.'.style.display == \'none\'){tldiv2'.$e2.'.style.display = \'block\';} 
			else {tldiv2'.$e2.'.style.display = \'none\';}
		}
</script>
	';
if(isset($_POST["mnnamecheck2$e2"])){
	$mnname = $_POST['mnnamecheck2'.$e2.''];
		$divn = explode("-", $mnname);
		$namec = $divn[0];
		$idc = $divn[1];
    $result = $link->query("select id from dish where name = '$namec' && id != '$idc' limit 1");
	$count = $result->num_rows;
	if ($count != 1) {		
		echo '';
		exit();
	} else {
	    echo '<strong style="color:#F00;">This name is already existed!</strong>';
	    exit();
    }
}			$e2++;
		}	
	}

	$appid3 = '';
	$appi3 = $link->query("select * from dish where course = 'Main Course'");
	$appic3 = $appi3->num_rows;
	if($appic3>=1){$e3=1;
		while ($row = $appi3->fetch_object()){	
		$ppser3 = explode(".", $row->price);
		$ppser13 = $ppser3[0];
			$appid3 .='
						<tr>
							<td>'.$e3.'</td>
                            <td>'.$row->name.'</td>
                            <td>'.$row->food_type.'</td>
                            <td>'.$row->price.'</td>
                            <td align="center"><div class="tooltip-demo"><a data-toggle="modal" data-target="#detmol'.$row->id.'"><i class="fa fa-list" data-toggle="tooltip" data-placement="top" title="Edit"></i></a> &nbsp <a data-toggle="modal" data-target="#delmol'.$row->id.'"><i class="fa fa-times" data-toggle="tooltip" data-placement="top" title="Delete"></i></a></div></td>
						</tr>
<!-- Modal -->
<div class="modal fade" id="detmol'.$row->id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">'.$row->name.'</h4>
      </div>
      <div class="modal-body">
		<div class="row">
	  
		  <div class="col-sm-6 col-md-4" >
			<div class="thumbnail panel panel-default">
			  <div class="panel-heading"><img src="images/gal/menu/'.$row->image.'" alt="'.$row->name.'" style="max-height: 180px; max-width: 130px;" class="img-thumbnail"></div>
			  <div class="caption">
				[<a data-toggle="collapse" data-parent="#accordion" href="#collapse3'.$e3.'" onclick="menimg3'.$e3.'();">Change Image</a>]				
			  </div>
			</div>
		  </div>
				
		  <div class="col-md-8">
			<div class="panel panel-info">
                <div class="panel-heading">
                    Edit Details
                </div>
		
                <div class="panel-body" name="tldiv3'.$e3.'" id="tldiv3'.$e3.'">
                    <div class="row">
					<div class="col-md-13">
			<form method="post" action="action.php?act=edmedy3&maxe='.$e3.'&mid='.$row->id.'" enctype="multipart/form-data" role="form">
				<fieldset>
					<div class="form-group">
					<input class="form-control" placeholder="Name" name="mnname3'.$e3.'" id="mnname3'.$e3.'" onblur="checkmnnamea3'.$e3.'();" value="'.$row->name.'" required>
					<input type="hidden" name="1mnname3'.$e3.'" id="1mnname3'.$e3.'" value="'.$row->id.'">
					<span id="mnnamestatus3'.$e3.'" class="status"></span>
                    </div>
					
                    <div class="form-group">
                        <label>Variety</label>
                        <select class="form-control" name="mnvar3'.$e3.'" id="mnvar3'.$e3.'" required>
                            <option value="'.$row->course.'">'.$row->course.'</option>
                            <option value="Pasta">Pasta</option>
                            <option value="Pork">Pork</option>
                            <option value="Beef">Beef</option>
                            <option value="Chicken">Chicken</option>
                            <option value="Vegetable">Vegetable</option>
                        </select>
                    </div>
					
					<div class="form-group input-group">
                    <span class="input-group-addon">₱</span>
                    <input type="text" class="form-control" name="mnpps3'.$e3.'" id="mnpps3'.$e3.'" onkeyup="restrict(\'mnpps3'.$e3.'\')" maxlength="4" value="'.$ppser13.'" required>
                    <span class="input-group-addon">.00</span>
                    </div>
					<input type="hidden" name="e3" id="e3" value="'.$e3.'">
					<input type="submit" value="Edit" class="btn btn-md btn-success btn-block" />
                </fieldset>
            </form>	
					</div>
					</div>
				</div>
				
	  <div class="panel-body"><div class="row"><div class="col-md-8"><div id="collapse3'.$e3.'" class="panel-collapse collapse">                    
            <form method="post" action="action.php?act=edmedyp&maxe='.$e3.'&mid='.$row->id.'" enctype="multipart/form-data" role="form">
				<input type="file" name="mpic'.$e3.'" id="mpic'.$e3.'" required>
				<div align="right"><input type="submit" value="Upload" class="btn btn-md btn-success" /></div>
			</form>
      </div></div></div></div>
	  
			</div>
		  </div>		  
		</div>	  
      </div>
	  
	  
      <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
	
<!-- Modal -->
<div class="modal fade" id="delmol'.$row->id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Delete</h4>
      </div>
      <div class="modal-body">
		
			Are you sure you want to delete this?
		
      </div>
      <div class="modal-footer">
		<a href="action.php?act=delmenu&idtd='.$row->id.'" class="btn btn-danger">Delete</a>
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>	
			';
echo'
<script>
	function checkmnnamea3'.$e3.'(){
			var mnname1 = document.getElementById(\'1mnname3'.$e3.'\').value
			var mnname3 = _("mnname3'.$e3.'").value;
			var mnname = mnname3+"-"+mnname1;
			if(mnname != ""){
				_("mnnamestatus3'.$e3.'").innerHTML = \'checking ...\';
					var ajax = ajaxObj("POST", "mngpck.php" );
					ajax.onreadystatechange = function() {
						if(ajaxReturn(ajax) == true) {
							_("mnnamestatus3'.$e3.'").innerHTML = ajax.responseText;
						}
					}
					ajax.send("mnnamecheck3'.$e3.'="+mnname);
			}
		}
	function menimg3'.$e3.'(){
			if(tldiv3'.$e3.'.style.display == \'none\'){tldiv3'.$e3.'.style.display = \'block\';} 
			else {tldiv3'.$e3.'.style.display = \'none\';}
		}
</script>
	';
if(isset($_POST["mnnamecheck3$e3"])){
	$mnname = $_POST['mnnamecheck3'.$e3.''];
		$divn = explode("-", $mnname);
		$namec = $divn[0];
		$idc = $divn[1];
    $result = $link->query("select id from dish where name = '$namec' && id != '$idc' limit 1");
	$count = $result->num_rows;
	if ($count != 1) {		
		echo '';
		exit();
	} else {
	    echo '<strong style="color:#F00;">This name is already existed!</strong>';
	    exit();
    }
}			$e3++;
		}	
	}

	$appid4 = '';
	$appi4 = $link->query("select * from dish where course = 'Dessert'");
	$appic4 = $appi4->num_rows;
	if($appic4>=1){$e4=1;
		while ($row = $appi4->fetch_object()){	
		$ppser4 = explode(".", $row->price);
		$ppser14 = $ppser4[0];
			$appid4 .='
						<tr>
							<td>'.$e4.'</td>
                            <td>'.$row->name.'</td>
                            <td>'.$row->food_type.'</td>
                            <td>'.$row->price.'</td>
                            <td align="center"><div class="tooltip-demo"><a data-toggle="modal" data-target="#detmol'.$row->id.'"><i class="fa fa-list" data-toggle="tooltip" data-placement="top" title="Edit"></i></a> &nbsp <a data-toggle="modal" data-target="#delmol'.$row->id.'"><i class="fa fa-times" data-toggle="tooltip" data-placement="top" title="Delete"></i></a></div></td>
						</tr>
<!-- Modal -->
<div class="modal fade" id="detmol'.$row->id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">'.$row->name.'</h4>
      </div>
      <div class="modal-body">
		<div class="row">
	  
		  <div class="col-sm-6 col-md-4" >
			<div class="thumbnail panel panel-default">
			  <div class="panel-heading"><img src="images/gal/menu/'.$row->image.'" alt="'.$row->name.'" style="max-height: 180px; max-width: 130px;" class="img-thumbnail"></div>
			  <div class="caption">
				[<a data-toggle="collapse" data-parent="#accordion" href="#collapse4'.$e4.'" onclick="menimg4'.$e4.'();">Change Image</a>]				
			  </div>
			</div>
		  </div>
				
		  <div class="col-md-8">
			<div class="panel panel-info">
                <div class="panel-heading">
                    Edit Details
                </div>
		
                <div class="panel-body" name="tldiv4'.$e4.'" id="tldiv4'.$e4.'">
                    <div class="row">
					<div class="col-md-14">
			<form method="post" action="action.php?act=edmedy4&maxe='.$e4.'&mid='.$row->id.'" enctype="multipart/form-data" role="form">
				<fieldset>
					<div class="form-group">
					<input class="form-control" placeholder="Name" name="mnname4'.$e4.'" id="mnname4'.$e4.'" onblur="checkmnnamea4'.$e4.'();" value="'.$row->name.'" required>
					<input type="hidden" name="1mnname4'.$e4.'" id="1mnname4'.$e4.'" value="'.$row->id.'">
					<span id="mnnamestatus4'.$e4.'" class="status"></span>
                    </div>
					
                    <div class="form-group">
                        <label>Variety</label>
                        <select class="form-control" name="mnvar4'.$e4.'" id="mnvar4'.$e4.'" required>
                            <option value="'.$row->course.'">'.$row->course.'</option>
                            <option value="Custards and Puddings">Custards and Puddings</option>
                            <option value="Frozen Desserts">Frozen Desserts</option>
                            <option value="Cakes">Cakes</option>
                            <option value="Pies">Pies</option>
                            <option value="Cookies">Cookies</option>
                            <option value="Chocolates and Candies">Chocolates and Candies</option>
                            <option value="Pastries">Pastries</option>
                            <option value="Miscellaneous Desserts">Miscellaneous Desserts</option>
                        </select>
                    </div>
					
					<div class="form-group input-group">
                    <span class="input-group-addon">₱</span>
                    <input type="text" class="form-control" name="mnpps4'.$e4.'" id="mnpps4'.$e4.'" onkeyup="restrict(\'mnpps4'.$e4.'\')" maxlength="4" value="'.$ppser14.'" required>
                    <span class="input-group-addon">.00</span>
                    </div>
					<input type="hidden" name="e4" id="e4" value="'.$e4.'">
					<input type="submit" value="Edit" class="btn btn-md btn-success btn-block" />
                </fieldset>
            </form>	
					</div>
					</div>
				</div>
				
	  <div class="panel-body"><div class="row"><div class="col-md-8"><div id="collapse4'.$e4.'" class="panel-collapse collapse">                    
            <form method="post" action="action.php?act=edmedyp&maxe='.$e4.'&mid='.$row->id.'" enctype="multipart/form-data" role="form">
				<input type="file" name="mpic'.$e4.'" id="mpic'.$e4.'" required>
				<div align="right"><input type="submit" value="Upload" class="btn btn-md btn-success" /></div>
			</form>
      </div></div></div></div>
	  
			</div>
		  </div>		  
		</div>	  
      </div>
	  
	  
      <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
	
<!-- Modal -->
<div class="modal fade" id="delmol'.$row->id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Delete</h4>
      </div>
      <div class="modal-body">
		
			Are you sure you want to delete this?
		
      </div>
      <div class="modal-footer">
		<a href="action.php?act=delmenu&idtd='.$row->id.'" class="btn btn-danger">Delete</a>
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>	
			';
echo'
<script>
	function checkmnnamea4'.$e4.'(){
			var mnname1 = document.getElementById(\'1mnname4'.$e4.'\').value
			var mnname4 = _("mnname4'.$e4.'").value;
			var mnname = mnname4+"-"+mnname1;
			if(mnname != ""){
				_("mnnamestatus4'.$e4.'").innerHTML = \'checking ...\';
					var ajax = ajaxObj("POST", "mngpck.php" );
					ajax.onreadystatechange = function() {
						if(ajaxReturn(ajax) == true) {
							_("mnnamestatus4'.$e4.'").innerHTML = ajax.responseText;
						}
					}
					ajax.send("mnnamecheck4'.$e4.'="+mnname);
			}
		}
	function menimg4'.$e4.'(){
		if(tldiv4'.$e4.'.style.display == \'none\'){tldiv4'.$e4.'.style.display = \'block\';} 
		else {tldiv4'.$e4.'.style.display = \'none\';}
	}
</script>
	';
if(isset($_POST["mnnamecheck4$e4"])){
	$mnname = $_POST['mnnamecheck4'.$e4.''];
		$divn = explode("-", $mnname);
		$namec = $divn[0];
		$idc = $divn[1];
    $result = $link->query("select id from dish where name = '$namec' && id != '$idc' limit 1");
	$count = $result->num_rows;
	if ($count != 1) {		
		echo '';
		exit();
	} else {
	    echo '<strong style="color:#F00;">This name is already existed!</strong>';
	    exit();
    }
}			$e4++;
		}	
	}
	
}

if(curPageName()=='mngmnu.php'){

$pard1 = '';
$pardq1 = $link->query("select id, offer from amenities where type ='Party'");
$pardqc1 = $pardq1->num_rows;
	if($pardqc1>=1){$a1=1;
		while ($row = $pardq1->fetch_object()){
			$pard1 .='
			<tr>
                <td>'.$row->offer.'</td>
                <td align="center" width="8%"><div class="tooltip-demo"><a data-toggle="modal" data-target="#detmol'.$row->id.'"><i class="fa fa-list" data-toggle="tooltip" data-placement="top" title="Edit"></i></a> &nbsp <a data-toggle="modal" data-target="#delmol'.$row->id.'"><i class="fa fa-times" data-toggle="tooltip" data-placement="top" title="Delete"></i></a></div></td>
            </tr>
<!-- Modal -->
<div class="modal fade" id="detmol'.$row->id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Party Package Amenity</h4>
      </div>
      <div class="modal-body">
		<div class="row">
		<div class="col-md-12">		
			<form method="post" action="action.php?act=edame1&maxe='.$a1.'&mid='.$row->id.'" enctype="multipart/form-data" role="form">
				<fieldset>
					<div class="form-group">
					<input class="form-control" placeholder="Amenities" name="amen1'.$a1.'" id="amen1'.$a1.'" value="'.$row->offer.'" required>
                    </div>
					<input type="submit" value="Update" class="btn btn-md btn-success btn-block" />
                </fieldset>
            </form>			
		</div>	  
		</div>	  
      </div>  
      <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
			
<!-- Modal -->
<div class="modal fade" id="delmol'.$row->id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Delete</h4>
      </div>
      <div class="modal-body">
		
			Are you sure you want to delete this Amenities?
		
      </div>
      <div class="modal-footer">
		<a href="action.php?act=deloff&idtd='.$row->id.'" class="btn btn-danger">Delete</a>
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>	
			';$a1++;
		}
	}
	
$pard2 = '';
$pardq2 = $link->query("select id, offer from amenities where type ='Wedding'");
$pardqc2 = $pardq2->num_rows;
	if($pardqc2>=1){$a2=1;
		while ($row = $pardq2->fetch_object()){
			$pard2 .='
			<tr>
                <td>'.$row->offer.'</td>
                <td align="center" width="8%"><div class="tooltip-demo"><a data-toggle="modal" data-target="#detmol'.$row->id.'"><i class="fa fa-list" data-toggle="tooltip" data-placement="top" title="Edit"></i></a> &nbsp <a data-toggle="modal" data-target="#delmol'.$row->id.'"><i class="fa fa-times" data-toggle="tooltip" data-placement="top" title="Delete"></i></a></div></td>
            </tr>
<!-- Modal -->
<div class="modal fade" id="detmol'.$row->id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Wedding Package Amenity</h4>
      </div>
      <div class="modal-body">
		<div class="row">
		<div class="col-md-12">		
			<form method="post" action="action.php?act=edame2&maxe='.$a2.'&mid='.$row->id.'" enctype="multipart/form-data" role="form">
				<fieldset>
					<div class="form-group">
					<input class="form-control" placeholder="Amenities" name="amen2'.$a2.'" id="amen2'.$a2.'" value="'.$row->offer.'" required>
                    </div>
					<input type="submit" value="Update" class="btn btn-md btn-success btn-block" />
                </fieldset>
            </form>			
		</div>	  
		</div>	  
      </div>  
      <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
			
<!-- Modal -->
<div class="modal fade" id="delmol'.$row->id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Delete</h4>
      </div>
      <div class="modal-body">
		
			Are you sure you want to delete this Amenities?
		
      </div>
      <div class="modal-footer">
		<a href="action.php?act=deloff&idtd='.$row->id.'" class="btn btn-danger">Delete</a>
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>	
			';$a2++;
		}
	}
	
$pard3 = '';
$pardq3 = $link->query("select id, offer from amenities	 where type ='Debut'");
$pardqc3 = $pardq3->num_rows;
	if($pardqc3>=1){$a3=1;
		while ($row = $pardq3->fetch_object()){
			$pard3 .='
			<tr>
                <td>'.$row->offer.'</td>
                <td align="center" width="8%"><div class="tooltip-demo"><a data-toggle="modal" data-target="#detmol'.$row->id.'"><i class="fa fa-list" data-toggle="tooltip" data-placement="top" title="Edit"></i></a> &nbsp <a data-toggle="modal" data-target="#delmol'.$row->id.'"><i class="fa fa-times" data-toggle="tooltip" data-placement="top" title="Delete"></i></a></div></td>
            </tr>
<!-- Modal -->
<div class="modal fade" id="detmol'.$row->id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Debut Package Amenity</h4>
      </div>
      <div class="modal-body">
		<div class="row">
		<div class="col-md-12">		
			<form method="post" action="action.php?act=edame3&maxe='.$a3.'&mid='.$row->id.'" enctype="multipart/form-data" role="form">
				<fieldset>
					<div class="form-group">
					<input class="form-control" placeholder="Amenities" name="amen3'.$a3.'" id="amen3'.$a3.'" value="'.$row->offer.'" required>
                    </div>
					<input type="submit" value="Update" class="btn btn-md btn-success btn-block" />
                </fieldset>
            </form>			
		</div>	  
		</div>	  
      </div>  
      <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
			
<!-- Modal -->
<div class="modal fade" id="delmol'.$row->id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Delete</h4>
      </div>
      <div class="modal-body">
		
			Are you sure you want to delete this Amenities?
		
      </div>
      <div class="modal-footer">
		<a href="action.php?act=deloff&idtd='.$row->id.'" class="btn btn-danger">Delete</a>
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>	
			';$a3++;
		}
	}
	
$pard4 = '';
$pardq4 = $link->query("select id, title, offer from amenities where type = 'Other Offered'");
$pardqc4 = $pardq4->num_rows;
	if($pardqc4>=1){$a4=1;
		while ($row = $pardq4->fetch_object()){
			$pard4 .='
			
				<div class="col-md-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            '.$row->title.' [<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo'.$a4.'" onclick="toto'.$a4.'();">Edit</a>] <button type="button" class="close" data-toggle="modal" data-target="#dell'.$a4.'" aria-hidden="true">×</button>
							
                        </div>
                        <div class="panel-body">
                            <div id="tolos'.$a4.'" name="tolos'.$a4.'">
                                <div class="panel-body">
									<p>'.$row->offer.'</p>
								</div>
							</div>
							
						<div id="collapseTwo'.$a4.'" class="panel-collapse collapse">
						
                            <div class="panel-body">
						<form method="post" action="action.php?act=edotof&otofid='.$row->id.'" enctype="multipart/form-data" role="form">
							<fieldset>
								<div class="form-group">
                                    <input class="form-control" placeholder="Offer for..." name="offfor" id="offfor" value="'.$row->title.'" required>
                                </div>
								<div class="form-group">
                                    <input class="form-control" placeholder="Good for..." name="goofor" id="goofor" value="'.$row->offer.'" required>
                                </div>
								<input type="submit" value="Update" class="btn btn-md btn-success btn-block" />
							</fieldset>
						</form>
							</div>
							
                            
                        </div>
						
                        </div>
                    </div>
                </div>
					
<!-- Modal -->
<div class="modal fade" id="dell'.$a4.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Delete</h4>
      </div>
      <div class="modal-body">
			Are you sure you want to delete this?
      </div>
      <div class="modal-footer">
		<a href="action.php?act=deloo&idoo='.$row->id.'" class="btn btn-danger">Delete</a>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
					
			';
echo'
	<script>
	function toto'.$a4.'(){
		if(tolos'.$a4.'.style.display == \'none\'){tolos'.$a4.'.style.display = \'block\';} 
		else {tolos'.$a4.'.style.display = \'none\';}
	}
	</script>
';
			$a4++;
		}
	}

}

if(curPageName()=='pack.php'){

	$set = $_GET['set'];
	$detailsof='';
	// $setavli='';	
		// $setav = $link->query("select distinct pset from tbl_package");
		// $setavc = $setav->num_rows;
		// if($setavc>=1){
			// while ($row = $setav->fetch_object()){
				// $setavli .= '<div style="margin-left: 50px;"><a> Set '.$row->pset.'</a></div>';
			// }
		// }
		
	if($set == 1 || $set == 2 || $set == 3){
		if($set == 1){$pk='Party';} else if($set == 2){$pk='Wedding';} else if($set == 3){$pk='Debut';}
		$veriton = $link->query("select offer from amenities where type = '$pk'");
		$veritonc = $veriton->num_rows;
		if($veritonc>=1){
			while ($row = $veriton->fetch_object()){
				$detailsof .= '<li>'.$row->offer.'</li>';
			}
		}
		
	} else if($set == 4){	
		$veriton = $link->query("select title, offer from amenities where type = 'Other Offered'");
		$veritonc = $veriton->num_rows;
		if($veritonc>=1){
			while ($row = $veriton->fetch_object()){
		$detailsof .= '
					<div class="panel panel-primary">
                        <div class="panel-heading">
                            '.$row->title.'
                        </div>
                        <div class="panel-body">
                            <p>'.$row->offer.'</p>
                        </div>
                    </div>	
		';
			}
		}
		if($set == 4){$pk='Other Offered Package';}
		
	} else {
		$detailsof .= '<div class="col-md-12"> Service not available. </div>';
	}

}

if(curPageName()=='food.php'){

	$cm = $_GET['pack'];
	$totalPrice = 0;
	if(isset($_SESSION['types'])) {
		$types = $_SESSION['types'];
		if($types == 'Customer') {
			$availbtn='';//'<a data-toggle="modal" data-target="#avs">Avail</a>';
		} 
		else {
			$availbtn='';
		}
	} else {
		$availbtn='';//'<a data-toggle="modal" data-target="#avs">Avail</a>';
	}
	$setsd ='';
	$query = "SELECT dish.name as name, dish.course as course, dish.price as price FROM dish
				INNER JOIN fixed_package on dish.id=fixed_package.dish_id
				where fixed_package.package_id =".$cm;
	$param = ["name", "course", "price"];
	try {
		$packageSet = $_dbCall->getResultsArray($query, $param);
	} catch (mysql_sql_exception $e) {
		echo $e->$message;
	}
	if (count($packageSet) >= 1) {
		$listoffoods='';
		foreach($packageSet as $row) {
			$name = $row["name"];
			$course = $row["course"];			
			$price = $row["price"];			
			$totalPrice += $price;
			$listoffoods .='
				<tr>
		            <td>'.$name.'</td>
		            <td>'.$course.'</td>
		        </tr>
				';
						
			}
			if(isset($_GET['set'])) {
				$ses = $_GET['set'];
			}
			else { 
				$ses = 0;
			} 
			$setsd .='
			
					<div class="col-md-12">
	                    <div class="panel panel-primary">
	                        <div class="panel-heading">
	                            Set '.$cm.'
	                        </div>
	                        <div class="panel-body">
	                            
								<table class="table table-striped table-bordered table-hover">
	                                    <thead>
	                                        <tr>
	                                            <th>Name</th>
	                                            <th>Course</th>
	                                        </tr>
	                                    </thead>
	                                    <tbody>
	                                        '.$listoffoods.'
	                                    </tbody>
	                                </table>
								
	                        </div>
	                    </div>
	                </div>
					<!-- Modal -->
					<div class="modal fade" id="avs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
						    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					        <h4 class="modal-title" id="myModalLabel"># of Pax</h4>
					      </div>
						  <form method="post" action="action.php?act=adpa&type=nor&cm='.$cm.'" enctype="multipart/form-data" role="form">
					      <div class="modal-body">
								<div class="form-group">
								<input class="form-control" placeholder="# of Pax (max of 1000)" name="pak" id="pak" onkeyup="restrict(\'pak\')" maxlength="4" required>	
								</div>
					      </div>
					      <div class="modal-footer">
							<input type="submit" value="Next" class="btn btn-primary">
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					      </div>
						  </form>
					    </div>
					  </div>
					</div>
							';
		}
}


if(curPageName()=='mens.php'){
	$appid1 = '';
	$appi = $link->query("select * from dish where course = 'Appetizer'");
	$appic = $appi->num_rows;
	if($appic>=1){
		$e=1;
		while ($row = $appi->fetch_object()){	
			$ppser = explode(".", $row->price);
			$ppser1 = $ppser[0];
			$appid1 .='
						<tr>
							<td>'.$e.'</td>
                            <td>'.$row->name.'</td>
                            <td>'.$row->food_type.'</td>
                            <td>'.$row->price.'</td>
						</tr>	
			';
			$e++;
	}}

	$appid2 = '';
	$appi2 = $link->query("select * from dish where course = 'Entree'");
	$appic2 = $appi2->num_rows;
	if($appic2>=1){
		$e2=1;
		while ($row = $appi2->fetch_object()){	
			$ppser2 = explode(".", $row->price);
			$ppser12 = $ppser2[0];
			$appid2 .='
						<tr>
							<td>'.$e2.'</td>
                            <td>'.$row->name.'</td>
                            <td>'.$row->food_type.'</td>
                            <td>'.$row->price.'</td>
						</tr>
			';
			$e2++;
		}
	}
			
	$appid3 = '';
	$appi3 = $link->query("select * from dish where course = 'Main Course'");
	$appic3 = $appi3->num_rows;
	if($appic3>=1){
		$e3=1;
		while ($row = $appi3->fetch_object()){	
			$ppser3 = explode(".", $row->price);
			$ppser13 = $ppser3[0];
			$appid3 .='
						<tr>
							<td>'.$e3.'</td>
                            <td>'.$row->name.'</td>
                            <td>'.$row->food_type.'</td>
                            <td>'.$row->price.'</td>
						</tr>
			';
			$e3++;					
		}
	}
	$appid4 = '';
	$appi4 = $link->query("select * from dish where course = 'Dessert'");
	$appic4 = $appi4->num_rows;
	if($appic4>=1){
		$e4=1;
		while ($row = $appi4->fetch_object()){	
			$ppser4 = explode(".", $row->price);
			$ppser14 = $ppser4[0];
			$appid4 .='
						<tr>
							<td>'.$e4.'</td>
                            <td>'.$row->name.'</td>
                            <td>'.$row->food_type.'</td>
                            <td>'.$row->price.'</td>
						</tr>
			';
			$e4++;
		}
	}
}

// $tp = $totalp * $_GET['paks']; echo '₱ '.number_format($tp,2);
if(curPageName()=='mycus.php') {
	include_once "dbCall.php";
	$id = $_SESSION['uids'];
	$query = "SELECT DISTINCT package_id FROM event_reservation where customer_id = ".$id." AND package_type = 'Customize' ";
	$param = ["package_id"];
	$pResult = $_dbCall->getResult($query, $param);
	$cuz='';
	if(count($pResult) > 0) {
		foreach($pResult as $package){
			$cuz1='';
			$query = "SELECT name, course, food_type, date_created FROM dish 
				INNER JOIN fixed_package ON dish.id=fixed_package.dish_id where fixed_package.package_id = ". $package[0];
			$param = ["name", "course", "food_type", "date_created"];
			$packResult = $_dbCall->getResultsArray($query, $param);
			foreach($packResult as $row) {
				$datec = $row["date_created"];	
				$cuz1.='
												<tr>
		                                            <td>'.$row["name"].'</td>
		                                            <td>'.$row["course"].'</td>
		                                            <td>'.$row["food_type"].'</td>
		                                        </tr>
				';
			}
			$cuz.='<div class="panel panel-primary">
						<div class="panel-heading">
	                        Created last '.$datec.'
	                    </div>
						<div class="panel-body">
									<table class="table table-striped table-bordered table-hover">
	                                    <thead>
	                                        <tr>
	                                            <th>Name</th>
	                                            <th>Course</th>
	                                            <th>Variety</th>
	                                        </tr>
	                                    </thead>
	                                    <tbody>
	                                        '.$cuz1.'
	                                    </tbody>
	                                </table>
						</div>
						<div class="panel-footer" align="right">
	                            <!--<button class="btn btn-primary" data-toggle="modal" data-target="#myModal">
	                                Avail
	                            </button>-->
	                    </div>
								<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	                                <div class="modal-dialog">
	                                    <div class="modal-content">
	                                        <div class="modal-header">
	                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                                            <h4 class="modal-title" id="myModalLabel"># of Pax(Max of 1000)</h4>
	                                        </div>
	                                        <div class="modal-body">
	                                            <form method="post" action="mycus.php" enctype="multipart/form-data" role="form">
												<input type="text" class="form-control" name="paxs" id="paxs">
	                                        </div>
	                                        <div class="modal-footer">
	                                            <input type="submit" name="paxt" id="paxt" class="btn btn-primary" value="Avail Now">
	                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												</form>
											</div>
	                                    </div>
	                                    <!-- /.modal-content -->
	                                </div>
	                                <!-- /.modal-dialog -->
	                            </div>
					</div>
			';//&cm='.$cm.'
		}
	}
	if ($cuz==null) {
		$cuz ='<h3 align="center">No Customized Menu Set.</h3>';
	}
}

?>	
	<script>
	
		function restrict(elem){
			var tf = _(elem);
			var rx = new RegExp;
			if(elem == "fname" || elem == "lname" || elem == "fnamec" || elem == "lnamec" || elem == "city" || elem == "prov"){
			rx = /[^a-z ñ.]/gi;
			} else if(elem == "user"){
			rx = /[^a-z0-9._]/gi;
			} else if(elem == "email" || elem == "emailc" || elem == "emailace" || elem == "emailnv"){
			rx = /[' ",]/gi;
			} else if(elem == "mobile" || elem == "mobilec" || elem == "mnpps" || elem == "mnppsz" || elem == "mnppsx" || elem == "mnppsc" || elem == "zipc" || elem == "paks" || elem == "pak" || elem == "budg"){
			rx = /[^0-9]/gi;
			} else if(elem == "addr"){
			rx = /[^a-z0-9.,# ñ]/gi;
			} else if(elem == "bara"){
			rx = /[^a-z0-9 ]/gi;
			}

			tf.value = tf.value.replace(rx, "");
		}
		
// function populate(s1,s2){
// var s1 = document.getElementById(s1);
// var s2 = document.getElementById(s2);
// var ppsv = document.getElementById('mc').value
// s2.innerHTML = "";
// if(s1.value == "50-100"){
// var res = ppsv.split("-");
// var p = res[1];
// var a = (50 * p) * .99 / 60;
// var b = (75 * p) * .95 / 80;
// var c = (100 * p) * .91 / 100;
// var a2 = a.toFixed(2);
// var b2 = b.toFixed(2);
// var c2 = c.toFixed(2);
// var optionArray = ["|",a2+"|"+a2,b2+"|"+b2,c2+"|"+c2];
// } else if(s1.value == "101-150"){
// var res = ppsv.split("-");
// var p = res[1];
// var a = (101 * p) * .94 / 110;
// var b = (125 * p) * .91 / 130;
// var c = (150 * p) * .89 / 150;
// var a2 = a.toFixed(2);
// var b2 = b.toFixed(2);
// var c2 = c.toFixed(2);
// var optionArray = ["|",a2+"|"+a2,b2+"|"+b2,c2+"|"+c2];
// } else if(s1.value == "151-200"){
// var res = ppsv.split("-");
// var p = res[1];
// var a = (151 * p) * .89 / 160;
// var b = (175 * p) * .86 / 180;
// var c = (200 * p) * .83 / 200;
// var a2 = a.toFixed(2);
// var b2 = b.toFixed(2);
// var c2 = c.toFixed(2);
// var optionArray = ["|",a2+"|"+a2,b2+"|"+b2,c2+"|"+c2];
// }
// for(var option in optionArray){
// var pair = optionArray[option].split("|");
// var newOption = document.createElement("option");
// newOption.value = pair[0];
// newOption.innerHTML = pair[1];
// s2.options.add(newOption);
// }
// }

		function checkusera(){
			var username = _("user").value;
			if(username != ""){
				_("userstatus").innerHTML = 'checking ...';
					var ajax = ajaxObj("POST", "mngacc.php" );
					ajax.onreadystatechange = function() {
						if(ajaxReturn(ajax) == true) {
							_("userstatus").innerHTML = ajax.responseText;
						}
					}
					ajax.send("usercheck="+username);
			}
		}
		
		function checkuser(){
			var username = _("user").value;
			if(username != ""){
				_("userstatus").innerHTML = 'checking ...';
					var ajax = ajaxObj("POST", "register.php");
					ajax.onreadystatechange = function() {
						if(ajaxReturn(ajax) == true) {
							_("userstatus").innerHTML = ajax.responseText;
						}
					}
					ajax.send("usercheck="+username);
			}
		}
		
		function checkpass(){
			var pass1 = _("pass1").value;
			if(pass1.length <= 5 || pass1.length >= 23 && pass1 != ""){
				_("PassLogstatus").innerHTML = '';
					var ajax = ajaxObj("POST", "register.php");
					ajax.onreadystatechange = function() {
						if(ajaxReturn(ajax) == true) {
							_("PassLogstatus").innerHTML = '<strong style="color:#F00;">Password must be 6 - 22 characters!</strong>';
							document.getElementById("pass2").value = '';
							document.getElementById("pass2").disabled = true;
							document.getElementById("PassLog2status").value = '';
						}
					}
				ajax.send("PassLogcheck="+pass1);
			} else {
				document.getElementById("pass2").disabled = false;
				document.getElementById("pass2").value = ''; 
				document.getElementById("PassLogstatus").innerHTML = ' ';
				document.getElementById("PassLog2status").innerHTML = ' ';
			}
		}
		
		function checkpassa(){
			var pass1 = _("pass1").value;
			if(pass1.length <= 5 || pass1.length >= 23 && pass1 != ""){
				_("PassLogstatus").innerHTML = '';
					var ajax = ajaxObj("POST", "mngacc.php");
					ajax.onreadystatechange = function() {
						if(ajaxReturn(ajax) == true) {
							_("PassLogstatus").innerHTML = '<strong style="color:#F00;">Password must be 6 - 22 characters!</strong>';
							document.getElementById("pass2").value = '';
							document.getElementById("pass2").disabled = true;
							document.getElementById("PassLog2status").value = '';
						}
					}
				ajax.send("PassLogcheck="+pass1);
			} else {
				document.getElementById("pass2").disabled = false;
				document.getElementById("pass2").value = ''; 
				document.getElementById("PassLogstatus").innerHTML = ' ';
				document.getElementById("PassLog2status").innerHTML = ' ';
			}
		}

		function checkpass2(){
			var pass1 = document.getElementById('pass1').value
			var pass2 = _("pass2").value;
			if(pass2 == "" || pass1.length <= 5 || pass1.length >= 23 || pass1 == "") {
				_("PassLog2status").innerHTML = '';
					var ajax = ajaxObj("POST", "register.php");
					ajax.onreadystatechange = function() {
						if(ajaxReturn(ajax) == true) {
							_("PassLog2status").innerHTML = '';
						}
					}
				ajax.send("PassLog2check="+pass1);
			} else if(pass1 == pass2){
				_("PassLog2status").innerHTML = '<strong style="color:#009900;">Password match.</strong>';
			} else {
				_("PassLog2status").innerHTML = 'checking...';
					var ajax = ajaxObj("POST", "register.php");
					ajax.onreadystatechange = function() {
						if(ajaxReturn(ajax) == true) {
							_("PassLog2status").innerHTML = '<strong style="color:#F00;">Password doesn\'t match!</strong>';
						}
					}
				ajax.send("PassLog2check="+pass1);
			}
		}
		
		function checkpass2a(){
			var pass1 = document.getElementById('pass1').value
			var pass2 = _("pass2").value;
			if(pass2 == "" || pass1.length <= 5 || pass1.length >= 23 || pass1 == "") {
				_("PassLog2status").innerHTML = '';
					var ajax = ajaxObj("POST", "mngacc.php");
					ajax.onreadystatechange = function() {
						if(ajaxReturn(ajax) == true) {
							_("PassLog2status").innerHTML = '';
						}
					}
				ajax.send("PassLog2check="+pass1);
			} else if(pass1 == pass2){
				_("PassLog2status").innerHTML = '<strong style="color:#009900;">Password match.</strong>';
			} else {
				_("PassLog2status").innerHTML = 'checking...';
					var ajax = ajaxObj("POST", "mngacc.php");
					ajax.onreadystatechange = function() {
						if(ajaxReturn(ajax) == true) {
							_("PassLog2status").innerHTML = '<strong style="color:#F00;">Password doesn\'t match!</strong>';
						}
					}
				ajax.send("PassLog2check="+pass1);
			}
		}
		
		function checkemail(){

			var email = _("email").value;
			if(email != ""){
				_("emailLogstatus").innerHTML = 'checking ...';
				var ajax = ajaxObj("POST", "register.php");
				ajax.onreadystatechange = function() {
				if(ajaxReturn(ajax) == true) {
					_("emailLogstatus").innerHTML = ajax.responseText;
				}
				}
				ajax.send("emailLogcheck="+email);
			}	
		}
		
		function checkemailnv(){

			var email = _("emailnv").value;
			if(email != ""){
				_("emailLogstatusnv").innerHTML = 'checking ...';
				var ajax = ajaxObj("POST", "<?php echo curPageName(); ?>");
				ajax.onreadystatechange = function() {
				if(ajaxReturn(ajax) == true) {
					_("emailLogstatusnv").innerHTML = ajax.responseText;
				}
				}
				ajax.send("emailLogchecknv="+email);
			}	
		}
		
		function checkemaila(){

			var email = _("email").value;
			if(email != ""){
				_("emailLogstatus").innerHTML = 'checking ...';
				var ajax = ajaxObj("POST", "mngacc.php");
				ajax.onreadystatechange = function() {
				if(ajaxReturn(ajax) == true) {
					_("emailLogstatus").innerHTML = ajax.responseText;
				}
				}
				ajax.send("emailLogcheck="+email);
			}	
		}
		
		function checkmobile(){

			var msg_telephone = _("mobile").value;
			if(msg_telephone.length >= 3){
				_("msg_telephonestatus").innerHTML = 'checking ...';
				var ajax = ajaxObj("POST", "<?php echo curPageName(); ?>");
				ajax.onreadystatechange = function() {
				if(ajaxReturn(ajax) == true) {
					_("msg_telephonestatus").innerHTML = ajax.responseText;
				}
				}
				ajax.send("msg_telephonecheck="+msg_telephone);
			}
		}
		
		function checkmobilea(){

			var msg_telephone = _("mobile").value;
			if(msg_telephone.length >= 3){
				_("msg_telephonestatus").innerHTML = 'checking ...';
				var ajax = ajaxObj("POST", "mngacc.php");
				ajax.onreadystatechange = function() {
				if(ajaxReturn(ajax) == true) {
					_("msg_telephonestatus").innerHTML = ajax.responseText;
				}
				}
				ajax.send("msg_telephonecheck="+msg_telephone);
			}
		}
		
		function checkemailc(){

			var email = _("emailc").value;
			if(email != ""){
				_("emailLogstatusc").innerHTML = 'checking ...';
				var ajax = ajaxObj("POST", "contact.php");
				ajax.onreadystatechange = function() {
				if(ajaxReturn(ajax) == true) {
					_("emailLogstatusc").innerHTML = ajax.responseText;
				}
				}
				ajax.send("emailLogcheckc="+email);
			}	
		}
		
		function checkmobilec(){

			var msg_telephone = _("mobilec").value;
			if(msg_telephone.length >= 3){
				_("msg_telephonestatusc").innerHTML = 'checking ...';
				var ajax = ajaxObj("POST", "contact.php");
				ajax.onreadystatechange = function() {
				if(ajaxReturn(ajax) == true) {
					_("msg_telephonestatusc").innerHTML = ajax.responseText;
				}
				}
				ajax.send("msg_telephonecheckc="+msg_telephone);
			}
		}
		
		function checkemailace(){

			var email = _("emailace").value;
			if(email != ""){
				_("acestatus").innerHTML = 'checking ...';
				var ajax = ajaxObj("POST", "account.php<?php if(isset($_SESSION['uids'])){echo'?auid='.$_SESSION['uids'].'';}?>");
				ajax.onreadystatechange = function() {
				if(ajaxReturn(ajax) == true) {
					_("acestatus").innerHTML = ajax.responseText;
				}
				}
				ajax.send("acecheck="+email);
			}	
		}
		
		function checkpassacp(){
			var pass1 = _("npacp1").value;
			if(pass1.length <= 5 || pass1.length >= 23 && pass1 != ""){
				_("PassLogstatusacp").innerHTML = '';
					var ajax = ajaxObj("POST", "account.php<?php if(isset($_SESSION['uids'])){echo'?auid='.$_SESSION['uids'].'';}?>");
					ajax.onreadystatechange = function() {
						if(ajaxReturn(ajax) == true) {
							_("PassLogstatusacp").innerHTML = '<strong style="color:#F00;">Password must be 6 - 22 characters!</strong>';
							document.getElementById("npacp2").value = '';
							document.getElementById("npacp2").disabled = true;
							document.getElementById("PassLog2statusacp").value = '';
						}
					}
				ajax.send("PassLogcheck="+pass1);
			} else {
				document.getElementById("npacp2").disabled = false;
				document.getElementById("npacp2").value = ''; 
				document.getElementById("PassLogstatusacp").innerHTML = ' ';
				document.getElementById("PassLog2statusacp").innerHTML = ' ';
			}
		}

		function checkpass2acp(){
			var pass1 = document.getElementById('npacp1').value
			var pass2 = _("npacp2").value;
			if(pass2 == "" || pass1.length <= 5 || pass1.length >= 23 || pass1 == "") {
				_("PassLog2statusacp").innerHTML = '';
					var ajax = ajaxObj("POST", "account.php<?php if(isset($_SESSION['uids'])){echo'?auid='.$_SESSION['uids'].'';}?>");
					ajax.onreadystatechange = function() {
						if(ajaxReturn(ajax) == true) {
							_("PassLog2statusacp").innerHTML = '';
						}
					}
				ajax.send("PassLog2check="+pass1);
			} else if(pass1 == pass2){
				_("PassLog2statusacp").innerHTML = '<strong style="color:#009900;">Password match.</strong>';
			} else {
				_("PassLog2statusacp").innerHTML = 'checking...';
					var ajax = ajaxObj("POST", "account.php<?php if(isset($_SESSION['uids'])){echo'?auid='.$_SESSION['uids'].'';}?>");
					ajax.onreadystatechange = function() {
						if(ajaxReturn(ajax) == true) {
							_("PassLog2statusacp").innerHTML = '<strong style="color:#F00;">Password doesn\'t match!</strong>';
						}
					}
				ajax.send("PassLog2check="+pass1);
			}
		}		
		
		function cloppi(){
			if(toclop.style.display == 'none'){toclop.style.display = 'block';} 
			else {toclop.style.display = 'none';}
		}
		
		
		function lifmjs(){
			if(lifm.style.display == 'none'){lifm.style.display = 'block'; tit1.style.display = 'block'; tit2.style.display = 'none'; tolost.style.display = 'block'; toshow.style.display = 'none';} 
			else {lifm.style.display = 'none'; tit2.style.display = 'block'; tit1.style.display = 'none'; tolost.style.display = 'none'; toshow.style.display = 'block';}
		}
		
		function checkmnname(){
			var mnname = _("mnname").value;
			if(mnname != ""){
				_("mnnamestatus").innerHTML = 'checking ...';
					var ajax = ajaxObj("POST", "mngpck.php" );
					ajax.onreadystatechange = function() {
						if(ajaxReturn(ajax) == true) {
							_("mnnamestatus").innerHTML = ajax.responseText;
						}
					}
					ajax.send("mnnamecheck="+mnname);
			}
		}
		
		function checkpass2b(){
			var pass1 = document.getElementById('pass1').value
			var pass2 = _("pass2").value;
			if(pass2 == "" || pass1.length <= 5 || pass1.length >= 23 || pass1 == "") {
				_("PassLog2status").innerHTML = '';
					var ajax = ajaxObj("POST", "resetp.php");
					ajax.onreadystatechange = function() {
						if(ajaxReturn(ajax) == true) {
							_("PassLog2status").innerHTML = '';
						}
					}
				ajax.send("PassLog2check="+pass1);
			} else if(pass1 == pass2){
				_("PassLog2status").innerHTML = '<strong style="color:#009900;">Password match.</strong>';
			} else {
				_("PassLog2status").innerHTML = 'checking...';
					var ajax = ajaxObj("POST", "resetp.php");
					ajax.onreadystatechange = function() {
						if(ajaxReturn(ajax) == true) {
							_("PassLog2status").innerHTML = '<strong style="color:#F00;">Password doesn\'t match!</strong>';
						}
					}
				ajax.send("PassLog2check="+pass1);
			}
		}
		
		function checkpassb(){
			var pass1 = _("pass1").value;
			if(pass1.length <= 5 || pass1.length >= 23 && pass1 != ""){
				_("PassLogstatus").innerHTML = '';
					var ajax = ajaxObj("POST", "resetp.php");
					ajax.onreadystatechange = function() {
						if(ajaxReturn(ajax) == true) {
							_("PassLogstatus").innerHTML = '<strong style="color:#F00;">Password must be 6 - 22 characters!</strong>';
							document.getElementById("pass2").value = '';
							document.getElementById("pass2").disabled = true;
							document.getElementById("PassLog2status").value = '';
						}
					}
				ajax.send("PassLogcheck="+pass1);
			} else {
				document.getElementById("pass2").disabled = false;
				document.getElementById("pass2").value = ''; 
				document.getElementById("PassLogstatus").innerHTML = ' ';
				document.getElementById("PassLog2status").innerHTML = ' ';
			}
		}


	</script>
