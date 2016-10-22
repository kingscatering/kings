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
			<h3>Account Management</h3>
	        </div>
			<div class="col-md-12" align="right">
			
			<div class="tooltip-demo"><a data-toggle="modal" data-target="#create"><button type="button" class="btn btn-link" data-toggle="tooltip" data-placement="top" title="Create New Administrator Account">Add Account</button></a></div>
	        </div>
			<div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Accounts
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>First name</th>
                                            <th>Last name</th>
                                            <th>Username</th>
                                            <th>E-mail</th>
                                            <th>Mobile # (<img src="images/ph.jpg" style="height:10px;"/>+63)</th>
                                            <th>Last log date</th>
                                            <th>Account Type</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php echo $alusde; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-md-12 -->
            </div>
        </div>
        <!-- /.row -->
<!-- Modal -->
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Create Account</h4>
      </div>
      <div class="modal-body">		
			<table width="100%" border="0" cellpadding="3" cellspacing="4">
			<form method="post" action="action.php?act=addadm" enctype="multipart/form-data" role="form">
			<tr>			 
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
			</tr>			
			<tr>			 
			<td>
			<div class="form-group col-md-4">
            <input type="text" class="form-control" id="user" name="user" placeholder="Username" onblur="checkusera();" required>
			<span id="userstatus" class="status"></span>
            </div>
			<div class="form-group col-md-4">
            <input type="Password" class="form-control" id="pass1" name="pass1" placeholder="Password" onblur="checkpassa();" required>
			<span id="PassLogstatus" class="status"></span>
            </div>
			<div class="form-group col-md-4">
            <input type="Password" class="form-control" id="pass2" name="pass2" placeholder="Confirm Password" onblur="checkpass2a();" required>
			<span id="PassLog2status" class="status"></span>
            </div>
			</td>			 
			</tr>			
			<tr>			 
			<td>
			<div class="form-group col-md-12">
            <input type="text" class="form-control" id="email" name="email" placeholder="E-mail" onkeyup="restrict('email')" onblur="checkemaila()" required>
			<span id="emailLogstatus" class="status"></span>
            </div>
			</td>			 
			</tr>			
			<tr>			 
			<td>
			<div class="col-md-12">
			<div class="form-group input-group">
			<span class="input-group-addon"><img src="images/ph.jpg" style="height:10px;"/>+63</span>
            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile number" onkeyup="restrict('mobile')" onblur="checkmobilea()" maxlength="10" required>
            </div>
			<span id="msg_telephonestatus" class="status"></span>
            </div>
			</td>			 
			</tr>			
			<tr>			 
			<td>
			<div class="col-md-12">
			<div class="form-group input-group">
			<span class="input-group-addon">Birthday</span>
            <input type="date" class="form-control" id="bday" name="bday"  required>
            </div>
            </div>
			</td>			 
			</tr>
            <tr>             
            <td>
            <div class="col-md-12">
            <div class="form-group input-group">
            <span class="input-group-addon">Type</span>
            <select class="form-control" name="type">
                <option value="Customer" selected required>Customer</option>
                <option value="Admin" selected required>Admin</option>
            </select>
            </div>
            </div>
            </td>            
            </tr>			
			<tr>
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
			</tr>
			</table>		
      </div>
      <div class="modal-footer">
	    <input type="submit" type="button" class="btn btn-primary" value="Create Account">
		</form>
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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