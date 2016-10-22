<?php 
    include_once'adds/scripts.php'; 
    include_once'adds/javascripts.php'; 
    include_once'checkEvents.php'; 

    $id = isset($_SESSION['uids']) ? $_SESSION['uids'] : false;
    $type = isset($_SESSION['types']) ? $_SESSION['types'] : false;
    if(!$id || $type != "Admin") {
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
        // setting event notif
        elseif (isset($_POST['event_id'])) {
            $dbCall = $_dbCall->open();
            $query = "SELECT a.contact_number FROM accounts AS a, event_reservation AS e WHERE e.customer_id = a.id AND  e.id=".$_POST['event_id'];
            $param = ["contact_number"];
            $row = $_dbCall->getResult($query, $param);
            $number = $row[0];
            echo " <script>",
                " $(document).ready(function(){
                    $('#textForm').submit();
                });",
                "</script>";
            $_SESSION['event_id_toNotify'] = $_POST['event_id'];
            // unset($_POST['event_id']);
        }
        //for viewing the receipt
        elseif(isset($_POST['approve_view_id'])) {
            $event_id = $_POST['approve_view_id'];
            $query = "SELECT pa"."th, name FROM receipt WHERE event_id = $event_id";
            $param = ["path", "name"];
            $result = $_dbCall->getResult($query, $param);
            $imageSource = $result[0]."/".$result[1];
            echo "<script>".
            "$(document).ready(function(){
                $('#myModalApprove').modal('show');
            });
            </script>";
        }
        //for approving paid reservations
        elseif(isset($_POST['approve_id'])) {
            $dbCall = $_dbCall->open();
            $query = "UPDATE event_reservation SET status = 'accepted' WHERE id =".$_POST['approve_id'];
            $dbCall->query($query) or trigger_error($dbCall->error."[$query]");
            unset($_POST['approve_id']);
            echo '<script>
                    alert("Reservation has been approved.");
                    window.location.replace("adminView.php");
            </script>'; 
        }
        // for viewing
        elseif(isset($_POST['view_id'])){
            // $dbCall = $_dbCall->open();
            // $query = "SELECT a.first_name, a.last_name, a.email, a.contact_number AS contact_number, e.status, e.date, e.time_start, e.time_end, e.event_type, e.package_type, e.head_count, e.amount, c.contact_number AS venue_number, c.address, c.barangay, c.city, c.province, c.zip, c.land FROM catering_branches AS c, event_reservation AS e, accounts AS a WHERE c.event_id = e.id AND e.customer_id = a.id AND e.id= ".$_POST['view_id'];
            // $param = ["first_name", "last_name", "email", "contact_number", "status", "date", "time_start", "time_end", "event_type", "package_type", "head_count", "amount", "venue_number", "address", "barangay", "city", "province", "zip", "land"];
            // $row = $_dbCall->getResult($query, $param);
            //     var_dump($row);
            //     $first_name = $row[0];
            //     $last_name = $row[1];
            //     $email  = $row[2];
            //     $account_contact_number = $row[3];
            //     $event_status = $row[4];
            //     $event_date = $row[5]; 
            //     $time_start = $row[6];
            //     $time_end = $row[7];
            //     $event_type = $row[8];
            //     $package_type = $row[9];
            //     $head_count = $row[10];
            //     $amount = $row[11];
            //     $venue_contact = $row[12];
            //     $venue_address = $row[13];
            //     $venue_barangay = $row[14];
            //     $venue_city = $row[15];
            //     $venue_province = $row[16];
            //     $venue_zip = $row[17];
            //     $venue_landmark = $row[18];
            //     unset($row);
            //     unset($query);
            //     unset($row);
            //     unset($param);
            echo "<script>".
            "$(document).ready(function(){
                $('#myModalDetails').modal('show');
            });
            </script>";
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="js/tether.js"></script>
    <script type="text/javascript" src="fullcalendar/lib/jquery.min.js"></script>
    <!-- <script type="text/javascript" src="js/bootstrap.js"></script> -->
    <?php include_once'adds/javascripts.php'; ?>
    <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="Editor/js/dataTables.editor.js"></script>
    <script>
    var editor; 
    $(document).ready(function() {
        // for cancelling
        $('#myModal').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            // alert(id);
            // $("#derp").html(id);
            $("#delete_id").val(id);
        });
        // for approving
        // for sending sms
        $('#sendNotifModal').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            $("#derpy").html(id);
            $("#event_id").val(id);
        });
        // for viewing details
        $('#myModalDetails').on('show.bs.modal', function(e){
            var id = $(e.relatedTarget).data('id');


        });
        $('.img-thumbnail').on('click', function()
        {
            $(this).height(1000);
            $(this).width(1000);
        });
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
                        return '<form action="adminView.php" method="POST">' + 
                        '<input type = "hidden" name = "view_id" value = "' + full.id + '"</input>' +
                        '<button data-id=' + full.id +' type="submit" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModalDetails"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span></button>&nbsp'+
                        '</form>' +  
                                
                                '<button data-id=' + full.id +' type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>';
                    }
                }
            ],
            "processing": true,
            "serverSide": true,
            "ajax":{
                url: "pendingTblData.php",
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
                        return '<form action="adminView.php" method="POST">' + 
                                    '<input type = "hidden" name = "view_id" value = "' + full.id + '"</input>' +
                                    '<button data-id=' + full.id +' type="submit" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModalDetails"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span></button>'+
                                '</form>'+ 
                                '&nbsp'+
                                '<form action="adminView.php" method="POST">' +
                                    '<input type = "hidden" name = "approve_view_id" value = "' + full.id + '" />' +
                                    '<button data-id=' + full.id +' type="submit" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModalApprove"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>'+
                                '</form>'+
                                '&nbsp<button data-id=' + full.id +' type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>';
                    }
                }
            ],
            "processing": true,
            "serverSide": true,
            "ajax":{
                url: "paidTblData.php",
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
                        return '<form action="adminView.php" method="POST">' + 
                        '<input type = "hidden" name = "view_id" value = "' + full.id + '"</input>' +
                        '<button data-id=' + full.id +' type="submit" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModalDetails"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span></button>&nbsp'+
                        '</form>' + '&nbsp<button data-id=' + full.id +' type="button" data-toggle="modal" data-target="#sendNotifModal" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Send Notification</button>&nbsp<button data-id=' + full.id +' type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>';
                    }
                }
            ],
            "processing": true,
            "serverSide": true,
            "ajax":{
                url: "overdueTblData.php",
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
                url: "cancelTblData.php",
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
                url: "acceptTblData.php",
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
                        return '<form action="adminView.php" method="POST">' + 
                                    '<input type = "hidden" name = "view_id" value = "' + full.id + '"</input>' +
                                    '<button data-id=' + full.id +' type="submit" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModalDetails"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span></button>'+
                                '</form>';
                    }
                }
            ],
            "processing": true,
            "serverSide": true,
            "ajax":{
                url: "finishedTblData.php",
                type: "post",
            }
        });
    } );
    </script>
  <!--   <script type="text/javascript">
        window.onload = function submitForm(){
            document.forms['textForm'].submit();
        }
    </script> -->
    <title></title>
</head>
<body>
    <?php include_once'adds/nav.php'; ?> 

    <!-- Send Notification Modal -->
    <div class="modal fade" id="sendNotifModal" tabindex="-1" role="dialog" aria-labelledby="event_idLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="sendNotifLabel">Send SMS and Email Notification</h4>
                </div>
                <div class="modal-body">
                <label id="derpy"> </label>
                <p> This will send an SMS and Email notification to the customer that the reservation will be cancelled. </p>
                </div>
                <div class="modal-footer">
                    <form action="adminView.php" method="POST">
                        <input type="submit" class="btn btn-danger" value="Send Notification"/>
                        <input type="hidden" id="event_id" name="event_id"/>
                    </form>
                <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>

                
                </div>
            </div>
        </div>
    </div>
    
    <!-- modal for viewing -->  
    <div class="modal fade" id="myModalDetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Event Reservation Details</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    Contact Person Details
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">First name:</div>
                            <div class="col-md-3">
                            <?php 
                            if(isset($_POST['view_id'])){
                                $dbCall = $_dbCall->open();
                                $query = "SELECT a.first_name FROM event_reservation AS e, accounts AS a WHERE e.customer_id = a.id AND e.id= ".$_POST['view_id'];
                                $param = ["first_name"];
                                $row = $_dbCall->getResult($query, $param);
                                $first_name = $row[0];
                            }?>
                            <?php echo $first_name; ?>
                                
                            </div>
                        <div class="col-md-6">Last name:</div>
                            <div class="col-md-3">
                            <?php 
                            if(isset($_POST['view_id'])){
                                $dbCall = $_dbCall->open();
                                $query = "SELECT a.last_name FROM event_reservation AS e, accounts AS a WHERE e.customer_id = a.id AND e.id= ".$_POST['view_id'];
                                $param = ["last_name"];
                                $row = $_dbCall->getResult($query, $param);
                                $last_name = $row[0];
                            }?>
                            <?php echo $last_name; ?>
                                
                            </div>
                        <div class="col-md-6">E-mail:</div>
                            <div class="col-md-3">
                            <?php 
                            if(isset($_POST['view_id'])){
                                $dbCall = $_dbCall->open();
                                $query = "SELECT a.email FROM event_reservation AS e, accounts AS a WHERE e.customer_id = a.id AND e.id= ".$_POST['view_id'];
                                $param = ["email"];
                                $row = $_dbCall->getResult($query, $param);
                                $email = $row[0];
                            }?>
                            <?php echo $email; ?>
                                
                            </div>
                        <div class="col-md-6">Mobile number:</div>
                            <div class="col-md-3">
                                <?php 
                                if(isset($_POST['view_id'])){
                                    $dbCall = $_dbCall->open();
                                    $query = "SELECT a.contact_number FROM event_reservation AS e, accounts AS a WHERE e.customer_id = a.id AND e.id= ".$_POST['view_id'];
                                    $param = ["contact_number"];
                                    $row = $_dbCall->getResult($query, $param);
                                    $account_contact_number = $row[0];
                                }?>
                                <?php echo $account_contact_number; ?>
                                    
                            </div>
                    </div>
                </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-4" >
             
          </div>
          <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    Event Details
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">Status:</div>
                            <div class="col-md-3">
                                <?php 
                                if(isset($_POST['view_id'])){
                                    $dbCall = $_dbCall->open();
                                    $query = "SELECT e.status FROM event_reservation AS e WHERE e.id =".$_POST['view_id'];
                                    $param = ["status"];
                                    $row = $_dbCall->getResult($query, $param);
                                    $event_status = $row[0];
                                }?>
                                <?php echo $event_status; ?>
                                
                            </div>
                        <div class="col-md-6">Pax:</div>
                            <div class="col-md-3">
                                <?php 
                                if(isset($_POST['view_id'])){
                                    $dbCall = $_dbCall->open();
                                    $query = "SELECT e.head_count FROM event_reservation AS e WHERE e.id =".$_POST['view_id'];
                                    $param = ["head_count"];
                                    $row = $_dbCall->getResult($query, $param);
                                    $head_count = $row[0];
                                }?>
                                <?php echo $head_count; ?>
                                
                            </div>
                        <div class="col-md-6">Amount:</div>
                            <div class="col-md-3">
                                <?php 
                                if(isset($_POST['view_id'])){
                                    $dbCall = $_dbCall->open();
                                    $query = "SELECT e.amount FROM event_reservation AS e WHERE e.id =".$_POST['view_id'];
                                    $param = ["amount"];
                                    $row = $_dbCall->getResult($query, $param);
                                    $amount = $row[0];
                                }?>
                                <?php echo $amount; ?>
                                    
                            </div>
                        <div class="col-md-6">Date:</div>
                            <div class="col-md-3">
                                <?php 
                                if(isset($_POST['view_id'])){
                                    $dbCall = $_dbCall->open();
                                    $query = "SELECT e.date FROM event_reservation AS e WHERE e.id =".$_POST['view_id'];
                                    $param = ["date"];
                                    $row = $_dbCall->getResult($query, $param);
                                    $event_date = $row[0];
                                }?>
                                <?php echo $event_date; ?>
                                
                            </div>
                        <div class="col-md-6">Start time:</div>
                            <div class="col-md-3">
                                <?php 
                                if(isset($_POST['view_id'])){
                                    $dbCall = $_dbCall->open();
                                    $query = "SELECT e.time_start FROM event_reservation AS e WHERE e.id =".$_POST['view_id'];
                                    $param = ["time_start"];
                                    $row = $_dbCall->getResult($query, $param);
                                    $time_start = $row[0];
                                }?>
                                <?php echo $time_start; ?>
                                
                            </div>
                        <div class="col-md-6">End time:</div>
                            <div class="col-md-3">
                                <?php 
                                if(isset($_POST['view_id'])){
                                    $dbCall = $_dbCall->open();
                                    $query = "SELECT e.time_end FROM event_reservation AS e WHERE e.id =".$_POST['view_id'];
                                    $param = ["time_end"];
                                    $row = $_dbCall->getResult($query, $param);
                                    $time_end = $row[0];
                                }?>
                                <?php echo $time_end; ?>
                                
                            </div>
                        <div class="col-md-6">Event Type:</div>
                            <div class="col-md-3">
                                <?php 
                                if(isset($_POST['view_id'])){
                                    $dbCall = $_dbCall->open();
                                    $query = "SELECT e.event_type FROM event_reservation AS e WHERE e.id =".$_POST['view_id'];
                                    $param = ["event_type"];
                                    $row = $_dbCall->getResult($query, $param);
                                    $event_type = $row[0];
                                }?>
                                <?php echo $event_type; ?>
                                
                            </div>
                        <!-- <div class="col-md-6"> <b> Menu List </b> </div> -->
                        <!-- <div class="col-md-12">
                        </div>     -->
                    </div>
                </div>
            </div>
          </div>
            <div class="col-sm-6 col-md-4" >
             
          </div>
          <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    Menu Details
                </div>
                <div class="panel-body">
                    <div class="row">
                    <div class="col-md-12">
                        <table class="table-bordered" style="width:100%;">
                            <thead>
                                <tr> 
                                    <th> Item  </th>
                                    <th> Course  </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                    if(isset($_POST['view_id'])){
                                    $query = "SELECT d.course, d.name FROM dish AS d, fixed_package f, event_reservation AS e WHERE e.package_id = f.package_id AND f.dish_id = d.id AND e.id =".$_POST['view_id']." ORDER BY d.course";
                                    $param = ["course", "name"];
                                    $result = $_dbCall->getResultsArray($query, $param);
                                    foreach ($result as $row) {

                                        echo "<tr> 
                                                <td>".$row['course']."</td>".
                                                "<td>".$row['name']."</td>".
                                             "</tr>";
                                    }
                                    unset($result);
                                    unset($query);
                                    unset($param);
                                }else{}
                            ?>
                            </tbody>
                        </table>
                    </div>    
                    </div>
                </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-4" >
             
          </div>
          <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    Venue Details
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">Contact Number:</div>
                            <div class="col-md-3">
                            <?php 
                                if(isset($_POST['view_id'])){
                                    $dbCall = $_dbCall->open();
                                    $query = "SELECT c.contact_number FROM catering_branches AS c, event_reservation AS e WHERE c.event_id = e.id AND e.id=".$_POST['view_id'];
                                    $param = ["contact_number"];
                                    $row = $_dbCall->getResult($query, $param);
                                    $venue_contact = $row[0];
                                    echo $venue_contact;
                            }?>
                            </div>
                        <div class="col-md-6">Address:</div>
                            <div class="col-md-3">
                            <?php 
                                if(isset($_POST['view_id'])){
                                    $dbCall = $_dbCall->open();
                                    $query = "SELECT c.address FROM catering_branches AS c, event_reservation AS e WHERE c.event_id = e.id AND e.id=".$_POST['view_id'];
                                    $param = ["address"];
                                    $row = $_dbCall->getResult($query, $param);
                                    $venue_address = $row[0];
                                    echo $venue_address;
                            }?>
                            </div>
                        <div class="col-md-6">Barangay:</div>
                            <div class="col-md-3">
                            <?php 
                                if(isset($_POST['view_id'])){
                                    $dbCall = $_dbCall->open();
                                    $query = "SELECT c.barangay FROM catering_branches AS c, event_reservation AS e WHERE c.event_id = e.id AND e.id=".$_POST['view_id'];
                                    $param = ["barangay"];
                                    $row = $_dbCall->getResult($query, $param);
                                    $venue_barangay = $row[0];
                                    echo $venue_barangay;
                            }?>
                            </div>
                        <div class="col-md-6">City:</div>
                            <div class="col-md-3">
                            <?php 
                                if(isset($_POST['view_id'])){
                                    $dbCall = $_dbCall->open();
                                    $query = "SELECT c.city FROM catering_branches AS c, event_reservation AS e WHERE c.event_id = e.id AND e.id=".$_POST['view_id'];
                                    $param = ["city"];
                                    $row = $_dbCall->getResult($query, $param);
                                    $venue_city = $row[0];
                                    echo $venue_city;
                            }?>
                                
                            </div>
                        <div class="col-md-6">Province:</div>
                            <div class="col-md-3">
                            <?php 
                                if(isset($_POST['view_id'])){
                                    $dbCall = $_dbCall->open();
                                    $query = "SELECT c.province FROM catering_branches AS c, event_reservation AS e WHERE c.event_id = e.id AND e.id=".$_POST['view_id'];
                                    $param = ["province"];
                                    $row = $_dbCall->getResult($query, $param);
                                    $venue_province = $row[0];
                                    echo $venue_province;
                            }?>
                            </div>
                        <div class="col-md-6">Landmark:</div>
                            <div class="col-md-3">
                            <?php 
                                if(isset($_POST['view_id'])){
                                    $dbCall = $_dbCall->open();
                                    $query = "SELECT c.land FROM catering_branches AS c, event_reservation AS e WHERE c.event_id = e.id AND e.id=".$_POST['view_id'];
                                    $param = ["land"];
                                    $row = $_dbCall->getResult($query, $param);
                                    $venue_landmark = $row[0];
                                    echo $venue_landmark;
                            }?>
                                
                            </div>    
                    </div>
                </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-4" >
             
          </div>
          <div class="col-md-12">
            <div class="thumbnail panel panel-default">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Uploaded Receipt
                    </div>
                </div>
                <div class="panel-body">
                    <?php
                    if(isset($_POST['view_id'])){
                        $dbCall = $_dbCall->open();
                        $query = "SELECT name FROM receipt WHERE event_id = ".$_POST['view_id'];
                        $param = ["name"];
                        $row = $_dbCall->getResult($query, $param);
                        if(!empty($row)){
                            echo '<img src="images/receipt/'.$row[0].'"height= "500" width="200" style="max-height: 200px; max-width: auto;" class="img-thumbnail"/>';
                        unset($_POST['view_id']);
                        }
                        else{
                            echo 'No receipt yet';
                        }
                    }
                    ?>
                    
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

    <!-- modal for cancelling -->
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

    <!-- modal for paid view details -->
    <div id="myModalPaidDetails" class="modal fade" role="dialog">
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

    <!-- modal for approving -->
    <div id="myModalApprove" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Approve</h4>
          </div>
          <div class="modal-body">
            <?php
                if(isset($imageSource)) {
                echo '<img src="'.$imageSource.'">';       
                } else {
            ?>
            <label> No receipt uploaded. </label>
            <?php } ?>
            <p>Are you sure you want to approve this reservation?</p>
          </div>
          <div class="modal-footer">
            <form action="adminView.php" method="POST">
            <?php echo '<input type="hidden" name="approve_id" value="'.$event_id.'"/>'; ?>
            <button type="submit" class="btn btn-default">Approve</button>
            </form>
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