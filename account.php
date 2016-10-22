<!DOCTYPE html>
<html lang="en">

<head>

	<?php include_once'adds/scripts.php'; 
        include_once("lib/ChromePhp.php");
        include_once'adds/javascripts.php'; 
        ?>
	
</head>


<body>

    <?php include_once'adds/nav.php'; ?>
	
    <!-- Page Content -->
    <div class="container">
		<br>
        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
			<div class="col-md-12">
			<h3>Welcome <?php echo $_SESSION['users']; ?>!</h3>
            </div>
  <div class="col-sm-6 col-md-3" >
    <div class="thumbnail panel panel-default">
      <div class="panel-heading"><a data-toggle="modal" data-target="#pic"><img src="images/users/<?php echo $_SESSION['images']; ?>" alt="<?php echo $_SESSION['users']; ?>" style="max-height: 242px; max-width: 200px;" class="img-thumbnail"></a></div>
    </div>
  </div>
<!-- Modal -->
<div class="modal fade" id="pic" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel"> Change Image </h4>
      </div>
      <div class="modal-body" align="center">		
			<img src="images/users/<?php echo $_SESSION['images']; ?>" alt="<?php echo $_SESSION['users']; ?>" style="width: 90%;" class="img-thumbnail"><br>	  		
      </div>
      <div class="modal-footer">
	  <form method="post" action="action.php?act=upuimage" enctype="multipart/form-data" role="form">
        <div class="row"><div class="col-md-6"><input type="file" name="uimgage" id="uimgage" required/></div>
		<div class="col-md-4"><input type="submit" value="Upload" class="btn btn-primary"/></div></div>
	  </form>
      </div>
    </div>
  </div>
</div>	
			<div class="col-md-8">
			
			<div class="panel-group" id="accordion">
			
			<div class="panel panel-info">
                <div class="panel-heading">
                    Profile Information [<a data-toggle="collapse" data-parent="#accordion" href="#editpi" onclick="cloppi();">Edit</a>]
                </div>
				<div id="editpi" class="panel-collapse collapse">
                    <div class="panel-body">
						<?php echo $auiddetail3; ?>
                    </div>
                </div>
									
                <div class="panel-body" id="toclop" name="toclop">
                    <div class="row">
						<?php echo $auiddetail1; ?>
					</div>
				</div>
			</div>
			
			<div class="panel panel-info">
                <div class="panel-heading">
                    Account Information
                </div>
                <div class="panel-body">
                    <div class="row">
						<?php echo $auiddetail2; ?>
					</div>
				</div>
			</div>	
			
			<div class="panel panel-primary">
                <div class="panel-heading">
                    Sign-In and Security
                </div>
                <div class="panel-body">
                    <div class="row">
						<div class="col-md-11"><a data-toggle="modal" data-target="#ace">Change E-mail</a></div>
						<div class="col-md-11"><a data-toggle="modal" data-target="#acp">Change Password</a></div>
					</div>
				</div>
			</div>
			
            </div>

            </div>
<!-- Modal -->
<div class="modal fade" id="ace" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Change E-mail</h4>
      </div>
      <div class="modal-body">
		
			<form method="post" action="action.php?act=aceact" enctype="multipart/form-data" role="form">
				<fieldset>
					<div class="form-group">
					<input class="form-control" placeholder="New E-mail" name="emailace" id="emailace" onkeyup="restrict('emailace')" onblur="checkemailace()" required>
					<span id="acestatus" class="status"></span>
                    </div>
					<div class="form-group">
					<input type="password" class="form-control" placeholder="Password" name="passace" id="passace" required>
                    </div>
					<input type="submit" value="Change E-mail" class="btn btn-md btn-success btn-block" />
                </fieldset>
            </form>
		
      </div>
      <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="acp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Change Password</h4>
      </div>
      <div class="modal-body">
		
			<form method="post" action="action.php?act=acpact" enctype="multipart/form-data" role="form">
				<fieldset>
					<div class="form-group">
					<input type="password" class="form-control" placeholder="Old Password" name="opacp" required>
                    </div>					
                    <div class="form-group">
					<input type="password" class="form-control" placeholder="New Password" name="npacp1" id="npacp1" onblur="checkpassacp();" required>
					<span id="PassLogstatusacp" class="status"></span>
                    </div>
					<div class="form-group">
					<input type="password" class="form-control" placeholder="Confirm Password" name="npacp2" id="npacp2" onblur="checkpass2acp();" required>
					<span id="PassLog2statusacp" class="status"></span>
                    </div>
					<input type="submit" value="Change Password" class="btn btn-md btn-success btn-block" />
                </fieldset>
            </form>
		
      </div>
      <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
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