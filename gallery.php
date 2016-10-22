<!DOCTYPE html>
<html lang="en">

<head>
	
	<?php include_once'adds/scripts.php'; ?>
	<?php include_once'dbCall.php' ;?>
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
			
<?php 
if(!isset($_GET['album'])) {
?>
			
<?php 
	if(isset($_SESSION['uids']) && $_SESSION['types'] == 'Admin') {
		if(isset($_SESSION['delete'])) {
			unlink($_SESSION['delete']);
		}
?>			
				<div class="col-md-12">
				
				<p  align="right"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#folder">Create an Album</button></p>
<!-- Modal -->
<div class="modal fade" id="folder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Creating an Album</h4>
      </div>
	  <form method="post" action="action.php?act=upload" enctype="multipart/form-data" role="form">
      <div class="modal-body">
		
				<div class="form-group">
					<input type="text" placeholder="Album name" name="alb" id="alb" required class="form-control">
				</div>
				
				<div class="form-group">
					<label>Upload</label>
					<input type="file" name="files[]" multiple required>
				</div>
			
      </div>
      <div class="modal-footer">
		<input type="submit" class="btn btn-primary" value="Upload">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
	  </form>
    </div>
  </div>
</div>
				</div>
<?php
	}
?>

<?php
	$albs='';
	$query = "SELECT DISTINCT title from gallery";
	$param = ["title"];
	try {
		$result = $_dbCall->getResult($query, $param);
	} catch(Exception $e) {
		echo $e;
	}		
	if(isset($result)) { 
		foreach ($result as $row) {
			$query = "SELECT name, source FROM gallery WHERE title = '".$row."' and is_deleted = false LIMIT 1";
			$param = ["name", "source"];
			try {
				$image = $_dbCall->getResult($query, $param);
			} catch (Exception $e) {
				echo $e;
			}
			if(count($image)) {
				$albs .='
					<div class="col-md-3">
		                        <div class="panel-body" align="center">
								
									<a href="gallery.php?album='.$row.'"> <img src="'.$image[1].'/'.$row.'/'.$image[0].'" style="height: 200px; width: auto;" class="img-thumbnail"> <br> '.$row.' </a>
									
		                        </div>		
					</div>
				';
			}
		}
	}
	else {
		echo'<h3 align="center">No Albums Yet.</h3>'; 
	}

	
	echo $albs;
?>

<?php
} 
else {
?>

<?php 
	if(isset($_SESSION['uids']) && $_SESSION['types'] == 'Admin') {
?>			
				<div class="col-md-12">
				
				<p  align="right"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addphoto">Add Photo</button></p>
<!-- Modal -->
<div class="modal fade" id="addphoto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Creating an Album</h4>
      </div>
	  <form method="post" action="action.php?act=addupload" enctype="multipart/form-data" role="form">
      <div class="modal-body">
				<input type="hidden" name="alb" id="alb" value="<?php echo $_GET['album']; ?>">
				<div class="form-group">
					<label>Upload</label>
					<input type="file" name="files[]" multiple required>
				</div>
			
      </div>
      <div class="modal-footer">
		<input type="submit" class="btn btn-primary" value="Upload">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
	  </form>
    </div>
  </div>
</div>
				</div>
<?php
	}

	$albumname = $_GET['album'];
	$query = "SELECT id, name, source FROM gallery WHERE title = '$albumname' and is_deleted = false";
	$param = ["id", "name", "source"];
	$galleryHtml = '';
	try {
		$images = $_dbCall->getResultsArray($query, $param); 		
	} catch (Exception $e) {
		echo $e;
	}
	
	if(!isset($images)) { 
		echo'<h3 align="center">No Images Yet.</h3>'; 
	} else { 
		if($albumname == "Menu") {
			$query = "SELECT name, food_type FROM gallery_menu";
			$param = ["name", "food_type"];
			$galleryTypes = $_dbCall->getResultsArray($query, $param);
			foreach ($galleryTypes as $row) {
				$menus[] = $row["name"];
				$types[] = $row["food_type"];
			}

			foreach($images as $image) {
				$inArray = array_search($image["name"], $menus);
				if($inArray){
					$imageTypeArray[$types[$inArray]][] = $image;
				}
			}

			foreach ($imageTypeArray as $key => $imageType) {
				$ce = 1;
				$counter = 0;
				echo '<div class="container">';
				echo " <h2>$key</h2>";
				foreach ($imageType as $key => $value) {
					$image = $value;
					$name = explode(".", $image["name"]);
					 if(file_exists($image["source"]."/".$albumname."/".$image["name"]))	{
						$galleryHtml = '
										<div class="col-md-3">
												<div class="panel">
							                        <div class="panel-body" align="center">
							                            <a data-toggle="modal" data-target="#'.$ce.'"> <img src="'.$image["source"]."/".$albumname."/".$image["name"].'" style="height: 200px; width: auto;" class="img-thumbnail"> </a> <br>'.$name[0];
						if(isset($_SESSION['uids']) && $_SESSION['types'] == 'Admin') {
					    }
						$galleryHtml .=	           '</div>
							                    </div>				
										</div>';
						$galleryHtml .='<!-- Modal -->
										<div class="modal fade" id="'.$ce.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										  <div class="modal-dialog">
										    <div class="modal-content">

										      <div class="modal-body" align="center">
														
														<img src="'.$image["source"]."/".$albumname."/".$image["name"].'" style="max-height: 500x; max-width: 500x;" class="img-thumbnail">
													
										      </div>
										    </div>
										  </div>
										</div>
												';
					}
					$ce++;
					echo $galleryHtml;
				}
				echo '<br></div>';
			}
		}
		else {
			$ce = 1;
			foreach($images as $image) {
				$name = explode(".", $image["name"]);
				 if(file_exists($image["source"]."/".$albumname."/".$image["name"]))	{
					$galleryHtml = '
									<div class="col-md-3">
											<div class="panel">
						                        <div class="panel-body" align="center">
						                            <a data-toggle="modal" data-target="#'.$ce.'"> <img src="'.$image["source"]."/".$albumname."/".$image["name"].'" style="height: 200px; width: auto;" class="img-thumbnail"> </a> <br>'.$name[0];
					if(isset($_SESSION['uids']) && $_SESSION['types'] == 'Admin') {
						$galleryHtml .= 				'<form action="deleteImage.php" method="POST">
							                         		<input type=hidden value="'.$image["id"].'" name="id"/>
							                         		<input type=hidden value="'.$albumname.'" name="album"/>
							                            		<input type="submit" value="Delete"/>
							                            </form>';
				    }
					$galleryHtml .=	           '</div>
						                    </div>				
									</div>';
					$galleryHtml .='<!-- Modal -->
									<div class="modal fade" id="'.$ce.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									  <div class="modal-dialog">
									    <div class="modal-content">

									      <div class="modal-body" align="center">
													
													<img src="'.$image["source"]."/".$albumname."/".$image["name"].'" style="max-height: 500x; max-width: 500x;" class="img-thumbnail">
												
									      </div>
									    </div>
									  </div>
									</div>
											';
			}
				$ce++;
				echo $galleryHtml;
			}
		}
	}
	echo '<div class="col-md-12"><p align="right"><a href="gallery.php?" class="btn btn-primary">Back</a></p></div>';
}

?>
				
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