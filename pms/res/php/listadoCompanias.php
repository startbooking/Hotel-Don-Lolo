<?php 
  require_once '../../../res/php/app_topHotel.php'; 

  extract($_POST);
  
  $query = "SELECT tarifas.descripcion_tarifa, companias.id_compania, companias.empresa, companias.direccion, companias.nit, companias.dv, companias.tipo_documento, companias.telefono, companias.celular, companias.fax, companias.email, companias.id_tarifa, companias.estado_credito, companias.activo FROM companias, tarifas " ;
  $filtro = " WHERE companias.id_tarifa = tarifas.id_tarifa";   
  $orden = " ORDER BY companias.empresa ";
   
  
  if($desde == ''){
    $filtro = $filtro." AND companias.empresa != '' ";
  }else{
    $filtro = $filtro." AND companias.empresa LIKE '$desde%'";
  }
    
  // echo $query.$filtro.$orden;
  
	// $regcias   = $hotel->getCantidadCompanias();
	$companias = $hotel->creaConsulta($query.$filtro.$orden); 
	
	// echo print_r($companias);

  include_once '../../imprimir/imprimeListadoCompanias.php' ;

?>

