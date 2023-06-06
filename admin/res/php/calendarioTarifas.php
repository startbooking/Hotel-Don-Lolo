<?php 
  require '../../../res/php/app_topAdmin.php'; 

  $idtarifa = $_POST['tarifa'];
  $descri   = $_POST['descri'];
  $dia      = date("Y-m-d H:i:s");
  
  $ahora    = strtotime($dia);
  $day      = date("Y-m-d");
  $month    = date("m");
  $year     = date("Y");

  // echo $idtarifa;

 ?>
  <!-- fullCalendar -->
  <link rel="stylesheet" href="<?php echo BASE_JS?>fullcalendar.min.css">
  <link rel="stylesheet" href="<?php echo BASE_JS?>fullcalendar.print.min.css" media="print">
  <input type="hidden" value="<?=$idtarifa?>" id='idsubtarifa'>
  <h3 align="center"><?=$descri?></h3>
  <div id="calendar"></div>
  <!-- 
  <script src="<?php echo BASE_JS?>fullcalendar.min.js"></script>
  -->

  <script>
    $(function () {
      idtarifa = $("#idsubtarifa").val();
      /* initialize the external events
       -----------------------------------------------------------------*/
      function ini_events(ele) {
        ele.each(function () {
          // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
          // it doesn't need to have a start or end
          var eventObject = {
            title: $.trim($(this).text()) // use the element's text as the event title
          };
          // store the Event Object in the DOM element so we can get to it later
          $(this).data('eventObject', eventObject);
          // make the event draggable using jQuery UI
          $(this).draggable({
            zIndex: 1070,
            revert: true, // will cause the event to go back to its
            revertDuration: 0  //  original position after the drag
          });
        });
      }

      ini_events($('#external-events div.external-event'));

      /* initialize the calendar
       -----------------------------------------------------------------*/
      //Date for the calendar events (dummy data)
      var date = new Date();
      var d = date.getDate(),
          m = date.getMonth(),
          y = date.getFullYear();
      $('#calendar').fullCalendar({
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'agendaDay,agendaWeek,month listDay,listWeek,listMonth,listYear'
        },

        buttonText: {
          today: 'hoy',
          month: 'mes',
          week: 'semana',
          day: 'dia'
        },
        firstDay:0,
        defaultView: 'month',
        defaultDate: new Date(),
        editable: true,
        eventLimit: true,          
        type: 'POST',

        /*
        
         */
        eventSources: [
          {
            url: 'res/php/valorTarifasDiarias.php', // use the `url` property
            color: 'green',    // an option!
            textColor: 'white',  // an option!
            allDay:false,
            data: {
              tarifa:idtarifa
            }
          }
          // 'common/tarifas_diarias.php'
        ],
        color: 'yellow',   // an option!
        // textColor: 'blue',// an option!
        backgroundColor: "#f56954", //red
        borderColor: "#f56954", //red
        eventClick: function(event, element) {
          starttime = $.fullCalendar.moment(event.start).format('DD-MM-YYYY');
          //starttime = $.fullCalendar.moment(event.start);
          var mywhen = starttime;
          // alert(mywhen);
          $('#modalTitle').val(event.title);
          $('#modalWhen').val(mywhen);
          $('#eventID').val(event.id);
          $('#calendarModal').modal();  
          // $('#calendar').fullCalendar('updateEvent', event);
        }
      });
      
      $('#updateButton').on('click', function(e){ 
          // delete event clicked
          // We don't want this to act as a link so cancel the link action
          e.preventDefault();
          doUpdate(); // send data to delete function
      }); 
      /*
      */
       
      function doUpdate(){  // delete event 
        var eventID    = $('#eventID').val();
        var newrate    = $('#modalTitle').val();
        var desdefecha = $('#modalWhen').val();
        var hastafecha = $('#fecha-hasta').val();
        var tiporoom   = $('#tipohabitacion').val();
        var idhotel    = $('#hotel').val();
        var disponi    = $('#disponibles').val();
        var estadia    = $('#estadiamin').val();
        var maxpax     = $('#maxocu').val();
        var minpax     = $('#minocu').val();
        if(disponi==""){
          $("#disponibles").focus(); 
          abort();
        }
        if(estadia==""){
          $("#estadiamin").focus(); 
          abort();
        }
        if(maxpax==""){
          $("#maxocu").focus();
          abort();
        }
        if(minpax==""){
          $("#minocu").focus();
          abort();
        }
        if(hastafecha==""){
          $("#fecha-hasta").focus();
          abort();
        }

        $("#calendarModal").modal('hide');
        $.ajax({
          url: 'res/php/user_actions/update_rate.php',
          data: 'id='+eventID+'&newval='+newrate+'&desde='+desdefecha+'&hasta='+hastafecha+'&room='+tiporoom+'&inven='+disponi+'&max='+maxpax+'&min='+minpax+'&estadia='+estadia,
          type: "POST",
          success: function(json) {
            if(json == 1){
              $("#imagen").html('');
              $(location).attr('href','roomrates'); 

              // room_rates(idhotel)
              ///$("#calendar").fullCalendar('updateEvents',eventID);
            }else{
              return false;         
            }
          }
        });
      }
    });
  </script>

<script src="<?php echo BASE_JS?>jquery.min.js"></script>
<script src="<?php echo BASE_JS?>moment.js"></script>
<script src="<?php echo BASE_JS?>fullcalendar.min.js"></script>

  <!-- 
  <script type="text/javascript" src="<?php echo BASE_JS?>moment.min.js"></script>
  <link rel="stylesheet" href="<?php echo BASE_JS?>bootstrap-datepicker.css">
  <script type="text/javascript" src="<?php echo BASE_JS?>bootstrap-datepicker.js"></script>
  <script>
    $(function () {
      $("#date-value").datepicker({
        language: "es",
        format: "dd-mm-yyyy",
        autoclose: true
        
      });
    })
  </script>
  -->