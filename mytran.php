<?php 
    include_once'adds/scripts.php';
    include_once'adds/javascripts.php'; 
    include_once 'checkEvents.php';

    $id = isset($_SESSION['uids']) ? $_SESSION['uids'] : false;
    if(!$id) {
        echo '<script>
                alert("No access to this site");
                window.location.replace("index.php");
            </script>';
    }
    else {
        if(isset($_POST['delete_id'])) {

            //mail reject code here

            $dbCall = $_dbCall->open();
            $query = "UPDATE event_reservation SET status = 'cancelled' WHERE id=".$_POST['delete_id'];
            $dbCall->query($query) or trigger_error($dbCall->error."[$query]");
            unset($_POST['delete_id']);
            echo '<script>
                    alert("Reservation has been cancelled.");
                    window.location.replace("adminView.php");
            </script>';
        }

        if(isset($_POST['upload_id'])) {
            $upload_id = $_POST['upload_id'];
            $absolutePath = "C:\\xampp\\htdocs\kings\\images";
            $path = "images";
            $cnt = 1;
            $ercnt = 0;
            $album = "receipt";
            if (!isset($_FILES)) {
                echo '<script>
                        alert("Please select a file when uploading!");
                        window.history.back();
                     </script>';
            }
            else {
                if(!file_exists($absolutePath."\\".$album)) {
                    mkdir($absolutePath."\\".$album);
                }
            }
            foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ) {       
                $allowedExts = array("gif", "jpeg", "jpg", "png", "JPEG", "JPG", "PNG");
                $temp = explode(".", $_FILES["files"]["name"][$key]);
                $extension = end($temp);

                if(in_array($extension, $allowedExts)) {
                    $name = $id."-".$upload_id.".".$extension;
                    $fileTmpLoc = $_FILES["files"]["tmp_name"][$key];
                    $moveResult = move_uploaded_file($fileTmpLoc, $path."/".$album."/".$name);
                    $query = "INSERT INTO receipt(customer_id, event_id, name, pa"."th) VALUES ($id, $upload_id, '$name', '".$path."/".$album."')";
                    $link->query($query) or trigger_error($link->error."$query");
                    $cnt++;
                } else {
                    $ercnt++;
                    continue;
                }       
            }   
            if ($cnt == 1) {
                echo "<script >alert('No new image uploaded due to invalid file type!'); location.href='mytran.php'; </script>";
            }
            else {
                if($ercnt == 0) {
                    $query = "UPDATE event_reservation SET status = 'paid' WHERE id = $upload_id";
                    $link->query($query) or trigger_error($link->error."$query");
                    echo "<script >alert('Images uploaded.'); location.href='mytran.php';</script>";
                }
                else {
                    echo "<script >alert('Images uploaded with $ercnt file not upload due to invalid file type.'); location.href='mytran.php';</script>";
                }
            }
        }

?>
<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="fullcalendar/lib/jquery.min.js"></script>
    <!--<script type="text/javascript" src="js/bootstrap.js"></script> -->
    <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="Editor/js/dataTables.editor.js"></script>
    <script>
    var editor; 
    $(document).ready(function() {
        $('#myModal').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            // console.log('idddddddddddd' + id);
            // alert(id);
            $("#derp").html(id);
            $("#delete_id").val(id);
        });

        $('#myModalDetails').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            $("#upload_id").val(id);
        });

        // $('#myModal').modal('show');
        $('#pendingTbl').DataTable({
            "columns": [
                {"data" : "id"},
                {"data" : "date"},
                {"data" : "event_type"},
                {"data" : "package_type"},
                {"data" : "time_start"},
                {"data" : "amount"},
                {
                    "data": null,
                    className: "center",
                    "render": function ( data, type, full, meta ) {
                        return '<button data-id=' + full.id +' type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModalDetails"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span></button>&nbsp';
                    }
                }
            ],
            "processing": true,
            "serverSide": true,
            "ajax":{
                url: "mypending.php",
                type: "POST"
            }
        });
        $('#paidTbl').DataTable({
            "columns": [
                {"data" : "id"},
                {"data" : "date"},
                {"data" : "event_type"},
                {"data" : "package_type"},
                {"data" : "time_start"},
                {"data" : "amount"},
                {
                    "data": null,
                    className: "center",
                    "render": function ( data, type, full, meta ) {
                        return 'Paid';
                    }
                }
            ],
            "processing": true,
            "serverSide": true,
            "ajax":{
                url: "mypaid.php",
                type: "POST",
            }
        });
        $('#overdueTbl').DataTable({
            "columns": [
                {"data" : "id"},
                {"data" : "date"},
                {"data" : "event_type"},
                {"data" : "package_type"},
                {"data" : "time_start"},
                {"data" : "amount"},
                {
                    "data": null,
                    className: "center",
                    "render": function ( data, type, full, meta ) {
                        return '<button data-id=' + full.id +' type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModalDetails"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span></button>&nbsp<button data-id=' + full.id +' type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModalSendDetails"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Send SMS</button>&nbsp';
                    }
                }
            ],
            "processing": true,
            "serverSide": true,
            "ajax":{
                url: "myoverdue.php",
                type: "post",
            }
        });
        $('#cancelTbl').DataTable({
            "columns": [
                {"data" : "id"},
                {"data" : "date"},
                {"data" : "event_type"},
                {"data" : "package_type"},
                {"data" : "time_start"},
                {"data" : "amount"},
                {
                    "data": null,
                    className: "center",
                    "render": function ( data, type, full, meta ) {
                        return '<form action="adminView.php" method="POST">' + 
                        '<input type = "hidden" name = "view_id" value = "' + full.id + '"</input>' +
                        '<button data-id=' + full.id +' type="submit" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModalDetails"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span></button>&nbsp'+
                        '</form>';
                    }
                }
            ],
            "processing": true,
            "serverSide": true,
            "ajax":{
                url: "mycancelled.php",
                type: "post",
            }
        });
        $('#acceptTbl').DataTable({
            "columns": [
                {"data" : "id"},
                {"data" : "date"},
                {"data" : "event_type"},
                {"data" : "package_type"},
                {"data" : "time_start"},
                {"data" : "amount"},
                {
                    "data": null,
                    className: "center",
                    "render": function ( data, type, full, meta ) {
                        return '<form action="adminView.php" method="POST">' + 
                        '<input type = "hidden" name = "view_id" value = "' + full.id + '"</input>' +
                        '<button data-id=' + full.id +' type="submit" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModalDetails"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span></button>&nbsp'+
                        '</form>';
                    }
                }
            ],
            "processing": true,
            "serverSide": true,
            "ajax":{
                url: "myaccepted.php",
                type: "post",
            }
        });
        $('#finishTbl').DataTable({
            "columns": [
                {"data" : "id"},
                {"data" : "date"},
                {"data" : "event_type"},
                {"data" : "package_type"},
                {"data" : "time_start"},
                {"data" : "amount"},
                {
                    "data": null,
                    className: "center",
                    "render": function ( data, type, full, meta ) {
                        return 'Finished';
                    }
                }
            ],
            "processing": true,
            "serverSide": true,
            "ajax":{
                url: "myfinished.php",
                type: "post",
            }
        });
    } );
    </script>
    <title></title>
</head>
<body>
    <?php include_once'adds/nav.php'; ?>
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Cancel</h4>
          </div>
          <div class="modal-body">
            <label id="derp"> </label>
            <p>Are you sure you want to cancel this reservation?</p>
          </div>
          <div class="modal-footer">
            <form action="adminView.php" method="POST">
                <input type="submit" class="btn btn-danger" value="Cancel"/>
                <input type="hidden" id="delete_id" name="delete_id"/>
            </form>
            <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
          </div>
        </div>

      </div>
    </div>

    <div id="myModalDetails" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
        <form action="mytran.php" enctype="multipart/form-data" method="POST">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Upload Receipt</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
                <label>Upload</label>
                <input type="file" name="files[]" multiple required/>
            </div>
          </div>
          <div class="modal-footer">
            <input type = "submit" class="btn btn-default" value="Upload"/>
            <input type = "hidden" id= "upload_id" name= "upload_id"/>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </div>
          </form>
        </div>
      </div>
    </div>    
    
    <div id="myModalApprove" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Cancel</h4>
          </div>
          <div class="modal-body">
            <label id="derp"> </label>
            <?php

            ?>
            <p>Are you sure you want to approve this reservation?</p>
          </div>
          <div class="modal-footer">
            <a href="" class="btn btn-danger">Delete</a>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
        <br>
        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-md-12">
            <h3>Event Reservations</h3>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">                        
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a href="#pend" data-toggle="tab" class="active">Pending Reservations</a>
                                </li>
                                <li class="nav-item"><a href="#paid" data-toggle="tab">Paid Reservations</a>
                                </li>
                                <li class="nav-item"><a href="#overdue" data-toggle="tab">Overdue Reservations</a>
                                </li>
                                <li class="nav-item"><a href="#accept" data-toggle="tab">Accepted Reservations</a>
                                </li>
                                <li class="nav-item"><a href="#cancel" data-toggle="tab">Cancelled Reservations</a>
                                </li>
                                <li class="nav-item"><a href="#finish" data-toggle="tab">Finished Reservations</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="pend">
                                    <h4>Pending Reservations</h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="pendingTbl">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Date</th>
                                            <th>Event Type</th>
                                            <th>Package Type</th>
                                            <th>Time Start</th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                                </div>
                                <div class="tab-pane fade" id="paid">
                                    <h4>Paid Reservations</h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="paidTbl">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Date</th>
                                            <th>Event Type</th>
                                            <th>Package Type</th>
                                            <th>Time Start</th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                                </div>
                                <div class="tab-pane fade" id="overdue">
                                    <h4>Overdue Reservations</h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="overdueTbl">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Date</th>
                                            <th>Event Type</th>
                                            <th>Package Type</th>
                                            <th>Time Start</th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                                </div>
                                <div class="tab-pane fade" id="accept">
                                    <h4>Accepted Reservations</h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="acceptTbl">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Date</th>
                                            <th>Event Type</th>
                                            <th>Package Type</th>
                                            <th>Time Start</th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                                </div>
                                <div class="tab-pane fade" id="cancel">
                                    <h4>Cancelled Reservations</h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="cancelTbl">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Date</th>
                                            <th>Event Type</th>
                                            <th>Package Type</th>
                                            <th>Time Start</th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                                </div>
                                <div class="tab-pane fade" id="finish">
                                    <h4>Finished Reservations</h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="finishTbl">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Date</th>
                                            <th>Event Type</th>
                                            <th>Package Type</th>
                                            <th>Time Start</th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
            </div>
        </div>

</body>
</html>

<?php
    }
?>