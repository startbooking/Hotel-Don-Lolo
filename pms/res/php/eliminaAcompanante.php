<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
  $id  =  $_POST['id'];

  $anula   = $hotel->eliminaAcompanante($id); 

  ?>
  <!-- <h4 align="center" class="bg-red" style="padding:10px"><span style="font-size:24px;font-weight: 700;font-family: 'ubuntu';">Acompañante Eliminado con Exito</span></h4>
 -->