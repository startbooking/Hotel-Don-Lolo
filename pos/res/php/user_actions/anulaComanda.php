<?php 

  require '../../../../res/php/app_topPos.php'; 

	$comanda = $_POST['comanda'];
	$fecha   = $_POST['fecha'];
	$motivo  = strtoupper($_POST['motivo']);
	$usu     = $_POST['iduser'];
	$user    = $_POST['user'];
	$idamb   = $_POST['idamb'];
	
	$mesa    = $pos->buscaComanda($comanda,$idamb);
	$anu     = $pos->anulaComanda($comanda,$motivo,$usu,$user,$idamb,$fecha);
	
	$camMsa  = $pos->updateMesaPos($idamb,$mesa);

  echo $camMsa;  

 ?>
