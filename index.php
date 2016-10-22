<!DOCTYPE html>
<html lang="en">

<head>

	<?php include_once'adds/scripts.php'; ?>
	
	<?php include_once'adds/javascripts.php'; ?>
	<style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 100%;
	  height: 450px;
      margin: auto;
  }
  </style>
</head>


<body>

    <?php include_once'adds/nav.php'; ?>
	
    <!-- Page Content -->
    <div class="container">
		<br>
        <!-- Page Heading/Breadcrumbs -->
        <div class="row">	
            <div class="col-md-12">
	<?php
    $type = isset($_SESSION['types']) ? $_SESSION['types'] : "notAdmin";
    if($type != "Admin") {
        if(isset($_SESSION['users'])){
            echo '<h3>Hello, '.$_SESSION['users'].'</h3><br>';
        }
  ?>
	<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="10000">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <!--<li data-target="#myCarousel" data-slide-to="3"></li>-->
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="images/slider1.jpg" alt="We now accept Venue Reservation" width="460" height="345">
		<div class="carousel-caption">
						<h2>We now accept Venue Reservation</h2>
					</div>		
      </div>

      <div class="item">
        <img src="images/slider2.jpg" alt="Try our spicy adobo "Certified Best Seller"" width="460" height="345">
		<div class="carousel-caption">
						<h2>Try our spicy adobo "Certified Best Seller"</h2>
					</div>
      </div>
    
      <div class="item">
        <img src="images/slider3.jpg" alt="We Cater all kinds of occasions" width="460" height="345">
		<div class="carousel-caption">
						<h2>We Cater all kinds of occasions</h2>
					</div>
      </div>

      <!--<div class="item">
        <img src="img_flower2.jpg" alt="Flower" width="460" height="345">
      </div>-->
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  
  <script>
    $('.carousel').carousel({
        interval: 8000 //changes the speed
    })
    </script>
	<hr>
	
	<section id="services" class="services bg-primary">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-10 col-md-offset-1">
                    <h2>Our Services</h2>
                    <hr class="small">
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <div class="service-item">
                            <a href="mens.php" target="_blank">
                            <span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x text-primary"></i>
                              <i class="fa fa-cutlery fa-stack-1x fa-inverse"></i>
                            </span></a>
                                <h4>
                                    <strong>Our Menu</strong>
                                </h4>
                                <p>List of our available Menu.</p>
                                
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="service-item">
                               <a href="contact.php" target="_blank"> <span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                <i class="fa fa-group fa-stack-1x fa-inverse"></i>
                            </span></a>
                                <h4>
                                    <strong>Contact Us</strong>
                                </h4>
                                <p>Drop as a mail and say "Hello!". We here to serve you.</p>
                                
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="service-item">
                                <a href="calendarv2.php" target="_blank"><span class="fa-stack fa-4x">
								  <i class="fa fa-circle fa-stack-2x text-primary"></i>
								  <i class="fa fa-database fa-stack-1x fa-inverse"></i>
							</span></a>
                                <h4>
                                    <strong>Events</strong>
                                </h4>
                                <p>View the events that we would serve.</p>
                                
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="service-item">
                                <a href="gallery.php" target="_blank"><<span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                <i class="fa fa-camera fa-stack-1x fa-inverse"></i>
                            </span></a>
                                <h4>
                                    <strong>Gallery</strong>
                                </h4>
                                <p>Actual image of your venue, food, events, etc.</p>
                                
                            </div>
                        </div>
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.col-md-10 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
  <?php } 
      else {
  ?>
      <section id="services" class="services bg-primary">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-10 col-md-offset-1">
                    <h2>Welcome Admin!</h2>
                    <hr class="small">
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <div class="service-item">
                            <a href="mngpck.php" target="_blank">
                            <span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x text-primary"></i>
                              <i class="fa fa-cutlery fa-stack-1x fa-inverse"></i>
                            </span></a>
                                <h4>
                                    <strong>Manage Menu</strong>
                                </h4>
                                <p></p>
                                
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="service-item">
                               <a href="mngacc.php" target="_blank"> <span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                <i class="fa fa-group fa-stack-1x fa-inverse"></i>
                            </span></a>
                                <h4>
                                    <strong>Manage Accounts</strong>
                                </h4>
                                <p></p>
                                
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="service-item">
                                <a href="mngset.php" target="_blank"><span class="fa-stack fa-4x">
                  <i class="fa fa-circle fa-stack-2x text-primary"></i>
                  <i class="fa fa-database fa-stack-1x fa-inverse"></i>
              </span></a>
                                <h4>
                                    <strong>Manage Fixed Packages</strong>
                                </h4>
                                <p></p>
                                
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="service-item">
                                <a href="gallery.php" target="_blank"><<span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                <i class="fa fa-camera fa-stack-1x fa-inverse"></i>
                            </span></a>
                                <h4>
                                    <strong>Manage Gallery</strong>
                                </h4>
                                <p></p>
                                
                            </div>
                        </div>
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.col-md-10 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>

<?php } ?>
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