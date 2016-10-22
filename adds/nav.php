<?php
    include_once('dbcall.php');
?>
<title>King Philippe’s Catering</title>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

    <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only"><b style="font-family: Monotype Corsiva; font-size: 120%;">King Philippe’s Catering</b></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"> <b style="font-family: Monotype Corsiva; font-size: 120%; color: #336699;"> <img src="images/Kings.png" style="height: 120%;"/> King Philippe’s Catering</b> </a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
    					<?php if(isset($_SESSION['uids'])){ ?>
    					
    					<li class="dropdown <?php if(curPageName()=='index.php' || curPageName()=='about.php' || curPageName()=='contact.php'){ echo 'active';}?>">
                            <a class="dropdown-toggle" data-toggle="dropdown"> Home <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="index.php">Home</a>
                                </li>
                                <li>
                                    <a href="about.php">About Us</a>
                                </li>
    							<li>
                                    <a href="contact.php">Contact Us</a>
                                </li>
    							<li>
                                    <a href="gallery.php">Gallery</a>
                                </li>
                            </ul>
                        </li>
    					
    					<?php } ?>
    					<?php if(!isset($_SESSION['uids'])){ ?>
                        <li <?php if(curPageName()=='index.php'){ echo 'class="active"';}?>>
                            <a href="index.php">Home</a>
                        </li>
    					
    					<li <?php if(curPageName()=='about.php'){ echo 'class="active"';}?>>
                            <a href="about.php">About Us</a>
                        </li>
    					
    							<li>
                                    <a href="gallery.php">Gallery</a>
                                </li>
    					<?php } ?>
    					<li class="dropdown <?php if(curPageName()=='account.php' || curPageName()=='mngacc.php' || curPageName()=='mngpck.php' || curPageName()=='mngmnu.php'){ echo 'active';}?>" >
    					<?php if(isset($_SESSION['uids']) && $_SESSION['types'] == "Admin"){echo'
    						<a href="#.php" class="dropdown-toggle" data-toggle="dropdown"> Management <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="mngacc.php">Manage Account</a>
                                </li>							
    							<li>
                                    <a href="mngpck.php">Manage Menu</a>
                                </li>							
    							<li>
                                    <a href="mngmnu.php">Manage Packages Amenities</a>
                                </li>
    							<li>
                                    <a href="mngset.php">Manage Fixed Packages</a>
                                </li>
                                <li>
                                    <a href="adminView.php">Manage Reservations</a>
                                </li>
                            </ul>
    					
    					';}?>
    					</li>
    					<?php //if(isset($_SESSION['uids']) && $_SESSION['types'] == "Admin"){ ?>
    					<li <?php if(curPageName()=='calendarEvent.php'){ echo 'class="active"';}?>>
                            <a href="calendarv2.php">Events</a>
                        </li>
    					<?php //} ?>
    					
    					<?php if(isset($_SESSION['uids']) && $_SESSION['types'] == "Customer") {
    					?>
    					
    					<li class="dropdown <?php if(curPageName()=='mytran.php' || curPageName()=='pack.php' || curPageName()=='food.php' || curPageName()=='customized.php' || curPageName()=='sum.php'){ echo 'active';}?>">
                            <a class="dropdown-toggle" data-toggle="dropdown"> Transactions <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="mytran.php">My Transactions</a>
                                </li>
                                <li>
                                    <a href="pack.php?set=1">Party Packages</a>
                                </li>
                                <li>
                                    <a href="pack.php?set=2">Wedding Packages</a>
                                </li>
    							<li>
                                    <a href="pack.php?set=3">Debut Packages</a>
                                </li>						
    							<li>
                                    <a href="pack.php?set=4">Other Offered Packages</a>
                                </li>
    							<li class="divider"></li>
                        <?php
                            $query = "SELECT DISTINCT package_id FROM fixed_package where package_type = 'Fixed'";
                            $param = ["package_id"];
                            $packageIdList = $_dbCall->getResult($query, $param);
                            for ($i = 0; $i < count($packageIdList); $i++) {
                        ?>   
                                <li>
                                    <a href="food.php?pack=<?php echo $packageIdList[$i]; ?>" >Package <?php echo $packageIdList[$i]; ?></a>
                                </li>                                
                        <?php
                            }
                        ?>
    							<li>
                                    <a href="customizev1.php">Customize Package</a>
                                </li>
    							<li>
                                    <a href="suggest.php">Budget Fit Package</a>
                                </li>
                            </ul>
                        </li>
    					
    					<?php
    					} ?>
    					
    					<li <?php if(curPageName()=='mycus.php'){ echo 'class="active"';}?> >
    					<?php 
                            if (isset($_SESSION['uids']) && $_SESSION['types'] == "Customer") {
                                echo'<a href="mycus.php">My Customized Menu</a>';
                            } 
                        ?>
    					</li>
    					
    					<?php 
                            if(isset($_SESSION['uids']) && $_SESSION['types'] != "Customer") { 
                        ?>
                        <li class="dropdown <?php if(curPageName()=='pack.php'){ echo 'active';}?>">
                            <a class="dropdown-toggle" data-toggle="dropdown">Services<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="pack.php?set=1">Party Packages</a>
                                </li>
                                <li>
                                    <a href="pack.php?set=2">Wedding Packages</a>
                                </li>
    							<li>
                                    <a href="pack.php?set=3">Debut Packages</a>
                                </li>						
    							<li>
                                    <a href="pack.php?set=4">Other Offered Packages</a>
                                </li>
                            </ul>
                        </li>
    					
    					<li class="dropdown <?php if(curPageName()=='food.php' || curPageName()=='customized.php' || curPageName()=='sum.php'){ echo 'active';}?>">
                            <a class="dropdown-toggle" data-toggle="dropdown">Package<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                        <?php
                            $query = "SELECT DISTINCT package_id FROM fixed_package where package_type = 'Fixed'";
                            $param = ["package_id"];
                            $packageIdList = $_dbCall->getResult($query, $param);
                            for ($i = 0; $i < count($packageIdList); $i++) {
                        ?>   
                                <li>
                                    <a href="food.php?pack=<?php echo $packageIdList[$i]; ?>">Package <?php echo $packageIdList[$i]; ?></a>
                                </li>                                
                        <?php
                            }
                        ?>
                            	<li>
                                    <a href="customize.php">Customize Package</a>
                                </li>
    							<li>
                                    <a href="suggest.php">Budget Fit Package</a>
                                </li>
                            </ul>
                        </li>
    					<?php 
                            } 
                            if (!isset($_SESSION['uids'])) { 
                        ?>
    					<li <?php if(curPageName()=='contact.php'){ echo 'class="active"';}?>>
                            <a href="contact.php">Contact Us</a>
                        </li>
    					<?php } ?>
    					<li <?php if(curPageName()=='register.php'){ echo 'class="active"';}?>>
                            <?php if(isset($_SESSION['users'])){echo'						
    				<li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="account.php?auid='.$_SESSION['uids'].'">My Account</a></li>
                            <li class="divider"></li>
                            <li><a href="action.php?act=logout"> <i class="fa fa-sign-out fa-fw"></i> Log Out </a></li>
                        </ul>
                    </li>';}else{echo'<a data-toggle="modal" data-target="#log">Log In</a>';}?>
                        </li>
    			
                    </ul>

                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>

        <!-- Modal -->
    <div class="modal fade" id="log" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <div id="tit1" name="tit1"><h4 class="modal-title" id="myModalLabel">LOG IN</h4></div> <div id="tit2" name="tit2" style="display: none;"><h4 class="modal-title" id="myModalLabel">Forget Password</h4></div>
          </div>
          <div class="modal-body">
                <div id="collapseTwo" class="panel-collapse collapse">
                    <div class="panel-body">
                <form method="post" action="action.php?act=forgetp" enctype="multipart/form-data" role="form">
                    <fieldset>
                        <div class="form-group">
                        <input class="form-control" placeholder="E-mail" id="emailnv" name="emailnv" onkeyup="restrict('emailnv');" onblur="checkemailnv();"required>
                        <span id="emailLogstatusnv" class="status"></span>
                        </div>
                        
                        <input type="submit" value="Send Password" class="btn btn-md btn-success btn-block" />
                    </fieldset>
                </form>
                    </div>
                </div>
                
                <div id="lifm" name="lifm">         
                <form method="post" action="action.php?act=login" enctype="multipart/form-data" role="form">
                    <fieldset>
                        <div class="form-group">
                        <input class="form-control" placeholder="Username" name="user" required>
                        </div>
                        
                        <div class="form-group">
                        <input class="form-control" placeholder="Password" name="pass" type="password" required>
                        </div>
                        <input type="submit" value="Login" class="btn btn-md btn-success btn-block" />
                    </fieldset>
                </form>
                </div>
        
          </div>
          <div class="modal-footer">
            <p align="center">Not a member? <a href="register.php">Register</a> for FREE!</p>
            <p align="center"> <b id="tolost" name="tolost">Forget Password?</b> <b id="toshow" name="toshow" style="display: none;">Log In?</b> Click <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" onclick="lifmjs();">here</a>!</p>
          </div>
        </div>
      </div>
    </div>  