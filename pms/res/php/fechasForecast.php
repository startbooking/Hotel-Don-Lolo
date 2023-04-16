<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 

  $hoy   = $hotel->getDatePms();
  $rooms = $hotel->getHabitaciones(CTA_MASTER);

?>
<div class="content" style="padding:15px">  
  <?php include_once("../../../bases/archivo_head.php") ;?>
  <link rel="stylesheet" type="text/css" href="../../css/stylepms.css">
  <div class="row-fluid">
    <div class="sectionDate">
      <?php 
        for ($i = 0; $i <= 30; $i++) {
          $fecha      = strtotime ( '+'.$i.'day' , strtotime ( $hoy ) ) ;
          ?>
          <button style="width: 3%" class="btn btn-sm" type="button"><?php echo date ('d' , $fecha ); ?></button>
          <?php 
        }
      ?>      
    </div> 
  </div>
</div>
