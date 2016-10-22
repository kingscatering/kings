<!DOCTYPE html>
<html lang="en">

<head>

	<?php include_once'adds/scripts.php'; ?>
	
	<?php include_once'adds/javascripts.php'; ?>

	<script>
	function testcheck()
	{
	    if (!jQuery("#checkbox").is(":checked")) {
	        alert("You have not agreed to the terms and conditions");
	        return false;
	    }
	    return true;
	}
	</script>
		
</head>


<body>

    <?php include_once'adds/nav.php'; ?>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">Registration Form</h1>
			</div>
		</div>
		
		<div class="row">
            <table width="100%" border="0" cellpadding="3" cellspacing="4">
			<form method="post" action="action.php?act=register" enctype="multipart/form-data" role="form">
			<tr>
			<td width="20%"></td>
			<td>
			<div class="form-group col-md-6">
            <input type="text" class="form-control" id="fname" name="fname" placeholder="First name" onkeyup="restrict('fname')" required>
            </div>
			<!-- <div class="form-group col-md-1">
            </div>
			<div class="form-group col-md-2">
            <input type="text" class="form-control" id="mname" placeholder="M.I."onkeyup="restrict('mname')">
            </div>
			<div class="form-group col-md-1">
            </div> -->
			<div class="form-group col-md-6">
            <input type="text" class="form-control" id="lname" name="lname" placeholder="Last name" onkeyup="restrict('lname')" required>
            </div>
			</td>
			<td width="20%"></td>
			</tr>
			
			<tr>
			<td width="20%"></td>
			<td>
			<div class="form-group col-md-4">
            <input type="text" class="form-control" id="user" name="user" placeholder="Username" onblur="checkuser();" onkeyup="restrict('user')" required>
			<span id="userstatus" class="status"></span> <!-- status alert-danger -->
            </div>
			<div class="form-group col-md-4">
            <input type="Password" class="form-control" id="pass1" name="pass1" placeholder="Password" onblur="checkpass();" required>
			<span id="PassLogstatus" class="status"></span>
            </div>
			<div class="form-group col-md-4">
            <input type="Password" class="form-control" id="pass2" name="pass2" placeholder="Confirm Password" onblur="checkpass2();" required>
			<span id="PassLog2status" class="status"></span>
            </div>
			</td>
			<td width="20%"></td>
			</tr>
			
			<tr>
			<td width="20%"></td>
			<td>
			<div class="form-group col-md-12">
            <input type="text" class="form-control" id="email" name="email" placeholder="E-mail" onkeyup="restrict('email')" onblur="checkemail()" required>
			<span id="emailLogstatus" class="status"></span>
            </div>
			</td>
			<td width="20%"></td>
			</tr>
			
			<tr>
			<td width="20%"></td>
			<td>
			<div class="col-md-12">
			<div class="form-group input-group">
			<span class="input-group-addon"><img src="images/ph.jpg" style="height:10px;"/>+63</span>
            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile number" onkeyup="restrict('mobile')" onblur="checkmobile()" maxlength="10" required>
            </div>
			<span id="msg_telephonestatus" class="status"></span>
            </div>
			</td>
			<td width="20%"></td>
			</tr>
			
			<tr>
			<td width="20%"></td>
			<td>
			<div class="col-md-12">
			<div class="form-group input-group">
			<span class="input-group-addon">Birthday</span>
            <input type="date" class="form-control" id="bday" name="bday"  required>
            </div>
            </div>
			</td>
			<td width="20%"></td>
			</tr>
			
			<tr>
			<td width="20%"></td>
			<td>
			<div class="form-group col-md-12">
            <label>Gender</label>
            <label class="radio-inline">
            <input type="radio" name="gender" id="Male" value="Male" checked>Male
			</label>
			<label class="radio-inline">
			<input type="radio" name="gender" id="Female" value="Female">Female
			</label>
			</div>			
			</td>
			<td width="20%"></td>
			</tr>
			
			<tr>
			<td width="20%"></td>
			<td>
			<div class="form-group col-md-12">
            <input type ="checkbox" id="checkbox" name ="checkbox"> I agree to the <a href="terms.html" target="_blank">King Philippe’s Catering Terms and Conditions</a>.
			</div>			
			</td>
			<td width="20%"></td>
			</tr>
			
			<tr>
			<td width="20%"></td>
			<td>
			<div class="form-group col-md-12">
            <input type="submit" type="button" class="btn btn-primary" value="Create Account" onclick= "return testcheck()">
			</div>			
			</td>
			<td width="20%"></td>
			</tr>
			
			</form>
			</table>
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