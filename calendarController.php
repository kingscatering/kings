<?php
    session_start();

    $startDate = isset($_POST['start_date']) ? $_POST['start_date'] : false;
    if($startDate == false) {
      echo '<script>
                  alert("Please indicate a date");
                  window.location.replace("calendarv2.php");
                </script>';
    }
    else {
    	$_SESSION['start_date'] = $_POST['start_date'];    	
      echo '<script>
              window.location.replace("eventReservationv1.php");
           </script>';
    }
?>