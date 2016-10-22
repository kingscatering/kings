<!DOCTYPE html>
<html>
<?php include_once'adds/scripts.php'; ?>
<?php include_once'adds/nav.php'; ?>
<head>
  <title></title>  
  <script type="text/javascript" src="fullcalendar/lib/jquery.min.js"></script>
  
<!--  <script type="text/javascript" src="js/tether.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script> -->
  <script type="text/javascript" src="fullcalendar/lib/moment.min.js"></script>
  <script type="text/javascript" src="fullcalendar/fullcalendar.min.js"></script>

  <link rel='stylesheet' href='fullcalendar/fullcalendar.css'/>
  <link rel='stylesheet' href='fullcalendar/fullcalendar.min.css'/>
    <script>
    $(document).ready(function(){
      $('#calendar').fullCalendar({
        slotMinutes: 10,
        axisFormat: "HH'h'mm",
        firstHour: 18,
        minTime: 8,
        maxTime: 24,
        defaultEventMinutes: 40,
        header: {
            left: 'prev,next',
            center: 'title',
            right: ''
          },
        selectable: true,
        selectHelper: true,
        events: "http://localhost/kings/eventsv1.php",
        eventClick: function(calEvent, jsEvent, view){
          
        },
        select: function(start, end, allDay) {
          var method = 'POST';
          var path = 'calendarController.php';
          var params = new Array();
          var start_datetime = String(start);
          // params['event_id'] = calEvent.id;
          // alert(start);
          // $.ajax({
          //   type: "POST",
          //   url: '../kings/eventReservationv1.php',
          //   data: {start_datetime: start_datetime},
          //   success:function(data){
          //     alert('hi');
          //   }

          // });
          // // window.location.href = "eventReservationv1.php?start=" + String(start);
          params['start_date'] = start_datetime;
          // params['event_end'] = calEvent.end;
          // params['event_user_id'] = calEvent.user_id;
          post_to_url(path, params, method);
        //   var date = new Date();
        //   var d = date.getDate();
        //   var m = date.getMonth();
        //   var y = date.getFullYear();
        //   var title = prompt('Event Title:');
        //   if (title) {
        //     $('#calendar').fullCalendar('renderEvent',
        //     {
        //       title: title,
        //       start: start,
        //       end: end,
        //       allDay: allDay
        //     },
        //     true // make the event "stick"
        //   );
        // }
        // $('#calendar').fullCalendar('unselect');
      },
      editable: true,
      });
    function post_to_url(path, params, method)
      {
        method = method || "post"; // Set method to post by default if not specified.

        // The rest of this code assumes you are not using a library.
        // It can be made less wordy if you use one.
        var form = document.createElement("form");
        form.setAttribute("method", method);
        form.setAttribute("action", path);

        for(var key in params)
        {
            if(params.hasOwnProperty(key)) 
            {
                var hiddenField = document.createElement("input");
                hiddenField.setAttribute("type", "hidden");
                hiddenField.setAttribute("name", key);
                hiddenField.setAttribute("value", params[key]);

                form.appendChild(hiddenField);
            }
         }

    document.body.appendChild(form);
    form.submit();
    }   
    });
    </script>
</head>
<body>
<div class="container">
    <div class="row">
      <div class="col-md-12">
       <div id='calendar'></div>
      </div>
    </div>
  </div>
</body>
</html>