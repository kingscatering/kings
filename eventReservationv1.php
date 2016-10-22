<?php 
    include_once'adds/scripts.php';
    include_once'dbcall.php';
    include_once'lib/ChromePhp.php';

    define("MAX_PAX", 3000);
    define("MAX_RES", 8);

    //following code validates the date selected in calendarv2.php
    $user = isset($_SESSION['uids']) ? $_SESSION['uids'] : false;
    if($user === false) {
      echo '<script>
              alert("Please log in.");
              window.location.replace("index.php");
          </script>';
    }
    $startDate = isset($_SESSION['start_date']) ? $_SESSION['start_date'] : false;
    if($startDate == false) {
      echo '<script>
                  alert("Please indicate a date");
                  window.location.replace("calendarv2.php");
                </script>';
    }
    else {
        //min date is the earliest possible date one can reserve
        $dateSelected = DateTime::createFromFormat('Y-m-d', date('Y-m-d', strtotime($startDate)));
        $minDate = DateTime::createFromFormat('Y-m-d', date("Y-m-d"));
        $minDate->add(new DateInterval('P2D'));
        ChromePhp::log($dateSelected);
      if ($dateSelected <= $minDate) {
        echo '<script>
                  alert("Reservations should be at least 3 days after the current date.");
                  window.history.back();
                </script>';
      }
      else {    
        $query="SELECT time_start, time_end, head_count FROM event_reservation where da"."te like '".date("Y-m-d", strtotime($startDate))."%'";
        $param = ["time_start", "time_end", "head_count"];
        try {
          $results = $_dbCall->getResultsArray($query, $param);
          $events = isset($results) ? $results : false;
          $head_count = 0;
          foreach($results as $row) {
            $head_count += $row["head_count"];
          }
          if($events && (count($events) > MAX_RES || $head_count > MAX_PAX)) {
            echo '<script>
                    alert("Sorry, day is already busy. Cannot reserve on this day."); 
                    window.history.back();
                  </script>';
          }
        } catch(Exception $e) {
            echo $e;
        }
      }
    }

    include_once'adds/nav.php';

?>


<!DOCTYPE html>
<html>
<head>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src='http://fullcalendar.io/js/fullcalendar-2.2.3/lib/moment.min.js'></script> -->
  <!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>   

  <script type="text/javascript" src="js/tether.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script-->
  <script type="text/javascript" src="fullcalendar/lib/jquery.min.js"></script>
  <script type="text/javascript" src="fullcalendar/lib/moment.min.js"></script>
  <title>Event Reservation</title>
  
  <script src="js/combodate.js"></script>
  <style> 
    .hide {
        display: none;
    }
  </style>
  <!-- javascript -->
  <script>
    function load_customize(){
            document.getElementById("customize").innerHTML='<object width="1000" height="500"  type="text/html" data="customizev1.php"></object>';
      }
      function load_budget(){
         document.getElementById("budget").innerHTML='<object width="1000" height="500" type="text/html" data="suggest.php" ></object>';
      }

    <?php
      $query = "SELECT DISTINCT package_id FROM fixed_package where package_type = 'Fixed' order by package_id ASC";
      $param = ["package_id"];
      $result = $_dbCall->getResult($query, $param);
      
      $packageCount = count($result);
      for($i = 1; $i <= $packageCount; $i++) {
        $innerHTML = '<object width="1000" height="500" type="text/html" data="food.php?pack='.$result[$i-1].'" ></object>';
        echo 'function load_package'.$i.'(){'; 
        echo    'document.getElementById("fixed'.$i.'").innerHTML='."'".$innerHTML."'".';
        }
        ';
      }
    ?>
  </script>
  <script type="text/javascript">
    function dateObj(d) {
      var parts = d.split(/:|\s/);
      var date  = new Date();
      if (parts.pop().toLowerCase() == 'pm')
        parts[0] = (+parts[0]) + 12;
        date.setHours(+parts.shift());
        date.setMinutes(+parts.shift());
      return date;
    }

    function validateForm(){
      var reserveStart = '09:00 am';
      var reserveStartMax = '08:00 pm';
      var reserveEnd = '10:00 am';
      var reserveEndMax = '11:59 pm';

      var convertedStart = dateObj(reserveStart);
      var convertedStartMax = dateObj(reserveStartMax);
      var convertedEnd = dateObj(reserveEnd);
      var convertedEndMax = dateObj(reserveEndMax);

      var tempStart = document.getElementById("start_time").value;
      var tempEnd = document.getElementById("end_time").value;

      var convertedTempStart = dateObj(tempStart);
      var convertedTempEnd = dateObj(tempEnd);
      var validStart = convertedStart <= convertedTempStart && 
                       convertedStartMax >= convertedTempStart && 
                       convertedTempStart < convertedTempEnd ? 'true' : 'false';
      var validEnd = convertedEnd <= convertedTempEnd && 
                     convertedEndMax >= convertedTempEnd && 
                     convertedTempEnd > convertedTempStart ? 'true' : 'false';

      
      if (validStart == 'true'){
        validStart = 1;
      }else{
        validStart = 0;
      }

      if (validEnd == 'true'){
        validEnd = 1;
      }else{
        validEnd = 0;
      }
      
      
      
      if((validEnd&&validStart) == 0){
        alert("Please select a valid time slot");
        return false;
      }else{
        return true;
      }
    }
  </script>
  <!-- jquery -->
<script>
    $(document).on('change', '.div-toggle', function() {
        var target = $(this).data('target');
        var show = $("option:selected", this).data('show');
        $(target).children().addClass('hide');
        $(show).removeClass('hide');
    });
    $(document).ready(function(){  
      $('.div-toggle').trigger('change');
      $('#start_time').combodate({
              firstItem: 'empty',
              minuteStep: 30
      }); 
      $('#end_time').combodate({
              firstItem: 'empty',
              minuteStep: 30
      }); 
    });

    /*
    function submitButton() {
      if(!("fixed1".localeCompare(document.getElementById("sel2").value))) {

      }
    }
    */
  </script>
</head>
<body>
  <div class="container">
  <?php //echo $_POST['start_datetime'];?>
  <h2> Reserve Event </h2>
  <form action="addMenuv1.php" method="POST" onsubmit="return validateForm();">
    <input type="hidden" name="origin_page" value="event_res"/>
    <input type="hidden" name="date" value="<?php echo $_SESSION['start_date'];?>"/>
    <div class="form-group">
        <h3> Event Details </h3>
        <div class="form-group">
          <label for ="start_time"> Start Time: </label><br>
          Available only from 9AM to 8PM <br/>
          <input class="form-control" id="start_time" data-format="hh:mm a" data-template="hh : mm a" name="start_datetime" type="text"/>
        </div>
        <div class="form-group">
          <label for ="end_time"> End Time: </label><br>
          Available only until 12AM <br/>
          <input class="form-control" id="end_time" data-format="hh:mm a" data-template="hh : mm a" name="end_datetime" type="text"/>
        </div>
      </div>
    <div class="form-group">
        <label for="eventType">Event Type:</label>
          <select name="eventType" class="form-control div-toggle" id="sel1" data-target=".eventTypeAdds">
          <?php
            $query = "SELECT DISTINCT type FROM amenities WHERE type NOT LIKE 'Other Offered'";
            $param = ["type"];
            $types = $_dbCall->getResult($query, $param);
            foreach($types as $type) {
              echo '<option value="'.$type.'" data-show=".'.$type.'">'.$type.'</option>';
            }
          ?>
          </select>
      </div>
      <div class="eventTypeAdds" style="padding-top:2px; padding-bottom: 2px;" >
          <?php
            foreach ($types as $type) {
              echo '<div class="'.$type.' hide">';
              $query = "SELECT offer FROM amenities WHERE type='$type'";  
              $param = ["offer"];
              $offers = $_dbCall->getResultsArray($query, $param);
              foreach ($offers as $offer) {
                echo $offer["offer"]."<br>";
              }
              echo '</div>';
            }
          ?>
<!--         <div class="baptism hide">
          Free Chocolate Fountain<br>
          Free Set-up <b> (around San Pedro, Laguna)</b><br>
          Service of Uniformed and Trained Waiters<br>
          Elegant Buffet Set-up complete with Buffet Skirting and Centerpiece<br>
          Round Tables with Floor Length Tablecloth and Toppings following your color motif<br>
          Chairs with Floor-length Seat Covers<br>
          Simple Fresh Floral Arrangement or Art Balloon Décor for every Guest Table<br>
          Purified Drinking Water<br>
          Ice for the Beverage and Water<br>
          Free Food Tasting good for 2 Persons<br>
        </div>
        <div class="party hide">
          Free balloons, party hats<br>
          Free Set-up <b> (around San Pedro, Laguna)</b><br>
          Service of Uniformed and Trained Waiters<br>
          Elegant Buffet Set-up complete with Buffet Skirting and Centerpiece<br>
          Round Tables with Floor Length Tablecloth and Toppings following your color motif<br>
          Chairs with Floor-length Seat Covers<br>
          Simple Fresh Floral Arrangement or Art Balloon Décor for every Guest Table<br>
          Purified Drinking Water<br>
          Ice for the Beverage and Water<br>
          Free Food Tasting good for 2 Persons<br>
        </div>
        <div class="wedding hide">
         Free cake, chocolate fountain, love birds (Dove) <br>
         Free Set-up <b> (around San Pedro, Laguna)</b><br>
         Service of Uniformed and Trained Waiters<br>
         Elegant Buffet Set-up complete with Buffet Skirting and Centerpiece<br>
         Round Tables with Floor Length Tablecloth and Toppings following your color motif<br>
         Chairs with Floor-length Seat Covers<br>
         Simple Fresh Floral Arrangement or Art Balloon Décor for every Guest Table<br>
         Purified Drinking Water<br>
         Ice for the Beverage and Water<br>
          Free Food Tasting good for 2 Persons<br>

        </div> -->
      </div>
      <div class="form-group" style="padding-top: 20px;">
        <label for="foodPackage">Food Package: </label>
        <select name="foodPackage" class="form-control div-toggle" id="sel2" data-target=".foodTypeAdds">
        <?php
          for($i = 1; $i <= $packageCount; $i++) {
          echo '<option id="'.$i.'" value="fixed'.$result[$i-1].'"data-show=".fixed'.$i.'">Package '.$i.'</option>';
          }
        ?>
            <option value= "BudgetFit" data-show=".budget">Budget Fit</option>
            <option value= "Customize" data-show=".customize">Customize</option>
        </select>
      </div>
      <div class="container foodTypeAdds" style="padding-top:2px; padding-bottom: 2px;" >

      <?php
        for($i = 1; $i <= $packageCount; $i++) {
        echo '<div id="fixed'.$i.'" class = "fixed'.$i.' hide">
              <script type="text/javascript">
                load_package'.$i.'();
              </script>
              </div>';
        }
      ?>
<!--        <div id="budget" class = "container budget hide">
          <script type="text/javascript">
              load_budget();
          </script>
        </div> -->
 <!--       <div id="customize" class = "customize hide">
          <script type="text/javascript">
            load_customize();
          </script>
        </div> -->
      </div>
       <div class="form-group">  
        <h3> Venue Details </h3>
        <label for="venue_address"> Address: </label>
        <input id= "venue_address" name="venue_address" type="text" class="form-control" id="venue_address" onkeyup="restrict('fname')" required/>
      </div>
      <div class="form-group">  
        <label for="venue_barangay"> Barangay: </label>
        <input id="vBarangay" name="vBarangay" type="text" class="form-control" id="venue_barangay" onkeyup="restrict('fname')" required/>
      </div>
      <div class="form-group">  
        <label for="venue_city"> City: </label>
        <input name="vCity" id="vCity" type="text" class="form-control" id="venue_city" onkeyup="restrict('fname')" required/>
      </div>
      <div class="form-group">  
        <label for="venue_province"> Province: </label>
        <input name="vProvince" id="vProvince" type="text" class="form-control" id="venue_province" onkeyup="restrict('fname')" required/>
      </div>
      <div class="form-group">  
        <label for="venue_landmark"> Nearest Landmark: </label>
        <input name="vLandmark" id="vLandmark" type="text" class="form-control" id="venue_landmark" onkeyup="restrict('fname')" required/>
      </div>
      <div class="form-group">  
        <label for="venue_contactPerson"> Contact Person: </label>
        <input name="vContactPerson" id="vContactPerson" type="text" class="form-control" id="venue_contactPerson" onkeyup="restrict('fname')" required/>
      </div>
      <div class="form-group">  
        <label for="venue_contactNumber"> Contact Number: </label>
        <input name="vContactNumber" type="text" class="form-control" id="venue_contactNumber" onkeyup="restrict('mobile')" onblur="checkmobile()" maxlength="10" required/>
      </div>

      <button type="submit" class="btn btn-default" value="return verify()">Submit</button>
  </form>
  </div>
</body>
</html>
