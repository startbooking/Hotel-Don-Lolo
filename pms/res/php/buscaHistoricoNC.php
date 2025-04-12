<?php 

  require '../../../res/php/app_topHotel.php'; 

  $desdeFe    =  $_POST['desdef'];
  $hastaFe    =  $_POST['hastaf'];
  $desdeNu    =  $_POST['desden'];
  $hastaNu    =  $_POST['hastan'];

  $sele = "SELECT notasCredito.numeroNC, 
	notasCredito.motivoAnulacion, 
	notasCredito.facturaAnulada, 
	notasCredito.fechaNC, 
	notasCredito.usuarioNC, 
	historicoDatosFE.statusMess, 
	historicoDatosFE.estadoEnvio";

  $from = " FROM notasCredito, historicoDatosFE";

  $filtro = " WHERE notasCredito.numeroNC = historicoDatosFE.facturaNumero";
  
  $orden = " ORDER BY notasCredito.numeroNC";
  

  if($desdeFe!='' && $hastaFe!= ''){
    $filtro = $filtro." AND fechaNC >='$desdeFe' AND fechaNC <= '$hastaFe'";
  }elseif($desdeFe=='' && $hastaFe!= ''){
    $filtro = $filtro." AND fechaNC <= '$hastaFe'";
  }elseif($desdeFe!='' && $hastaFe== ''){
    $filtro = $filtro." AND fechaNC = '$desdeFe'";
  }

  if($desdeNu!='' && $hastaNu!= ''){
    $filtro = $filtro." AND numeroNC >='$desdeNu' AND factura_numero <= '$hastaNu'";
  }elseif($desdeNu=='' && $hastaNu!= ''){
    $filtro = $filtro." AND numeroNC <= '$hastaNu'";
  }elseif($desdeNu!='' && $hastaNu== ''){
    $filtro = $filtro." AND numeroNC = '$desdeNu'";
  }

  $query = $sele.$from.$filtro.$orden;
  $notas = $hotel->lanzaQuery($query);

  echo json_encode($notas);