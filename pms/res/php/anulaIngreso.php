<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
  
  $numero    = $_POST['numero'];
  $habita    = $_POST['habita'];
  $usuario   = $_POST['usuario'];
  $idusuario = $_POST['idusuario'];
  
  $saldo   = $hotel->getSaldoHabitacion($numero);

  if(count($saldo)==0){
    $cuenta = 0;
  }else{
    $cuenta = $saldo[0]['cargos']+$saldo[0]['imptos']-$saldo[0]['pagos'];
  }
   
  if($cuenta<>0){
    echo '-1';    
  }else{
    $anula   = $hotel->updateAnulaIngreso($numero, $usuario, $idusuario); 
    $estHabi = $hotel->cambiaEstadoHabitacion($habita,'SV');
    echo $anula;    
  }


  ?>
