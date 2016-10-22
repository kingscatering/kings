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
		<p align="center"><img src="images/contactpic.png" style="height: 250px;" class="img-thumbnail"/></p>
        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-md-7">
			<p><i style="font-family: Monotype Corsiva; font-size: 25px;">Leave us a message</i></p>
			<fieldset>
			<form method="post" action="action.php?act=contact" enctype="multipart/form-data" role="form">
			
			<input type="text" class="form-control" id="fnamec" name="fnamec" placeholder="First name*" onkeyup="restrict('fnamec')" required>
			<br>
			<input type="text" class="form-control" id="lnamec" name="lnamec" placeholder="Last name*" onkeyup="restrict('lnamec')" required>
			<br>
            <select class="form-control" id="subjectc" name="subjectc" required>
			<option value="Personal Message">Personal Message</option>
			<option value="Inquiry">Inquiries</option>
			<option value="Suggestion">Suggestion</option>
			<option value="Complain">Complain</option>
			<option value="Other">Other</option>
            </select>
			<br>
			<!-- <input type="text" class="form-control" id="companyc" name="companyc" placeholder="Affiliation*" onkeyup="restrict('companyc')" required> -->
			<br>
			<input type="text" class="form-control" id="emailc" name="emailc" placeholder="E-mail*" onkeyup="restrict('emailc')" onblur="checkemailc()" required><span id="emailLogstatusc" class="status"></span>
			<br>
			<div class="form-group input-group">
			<span class="input-group-addon"><img src="images/ph.jpg" style="height:10px;"/>+63</span>
			<input type="text" class="form-control" id="mobilec" name="mobilec" placeholder="Mobile number*" onkeyup="restrict('mobilec')" onblur="checkmobilec()" maxlength="10" required>
			</div>
			<span id="msg_telephonestatusc" class="status"></span>
			<br>
			<textarea class="form-control" rows="4" placeholder="Hello! How can we help you?" id="contentc" name="contentc" required></textarea>
			<br>
			<input type="submit" class="btn btn-primary" value="Send">
			
			</form>
			
			
			</fieldset>
            </div>
			
			<div class="col-md-5">
			
            </div>
			
        </div>
        <!-- /.row -->

        <hr>

        <?php include_once'adds/footer.php'; ?>

    </div>
    <!-- /.container -->

</body>

</html>