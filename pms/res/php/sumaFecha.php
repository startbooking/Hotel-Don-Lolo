<?php 

  $fecha    = $_POST['fecha'];
  /// echo $fecha;
  $newFecha = date("d-m-Y", strtotime($fecha));
  $dias     = $_POST['dias'];

  $sale = strtotime($fecha."+ ".$dias." days");
  echo date ('Y-m-d' , $sale );

  ?>
