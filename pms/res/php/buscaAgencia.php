<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
  
	$iden    =  $_POST['iden'];
	$agencia = $hotel->getBuscaAgencia($iden);

  echo $agencia;

