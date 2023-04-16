<?php 

  $fecha = $_POST['fecha'];
  $sale  = $_POST['sale'];
 
  $dias = strtotime($sale) - strtotime($fecha);
  echo ($dias/(24*60*60));

  ?>
