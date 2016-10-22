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
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Reset Password</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="action.php?act=resetpass&pid=<?php echo $_GET['rpid']; ?>" enctype="multipart/form-data" role="form">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="New Password" name="pass1" id="pass1" type="password" onblur="checkpassb();" required><span id="PassLogstatus" class="status"></span>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Confirm Password" name="pass2" id="pass2" type="password" onblur="checkpass2b();" required><span id="PassLog2status" class="status"></span>
                                </div>
                                <input type="submit" value="Change" class="btn btn-md btn-success btn-block">
                            </fieldset>
                        </form>
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