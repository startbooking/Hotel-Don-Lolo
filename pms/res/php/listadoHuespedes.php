<?php 
	
  extract($_POST);
  
  $query = "SELECT nombre_completo, identificacion, direccion, telefono, email, tipo_identifica, tipo_huesped, fecha_nacimiento, edad, sexo, celular, id_compania, idCentroCia, estado_credito FROM huespedes " ;
   
  $orden = " ORDER BY apellido1 ";
  $filtro = ""; 
   
  if($desde == ''){
    $filtro = " WHERE apellido1 != '' ";
  }else{
    $filtro = " WHERE apellido1 LIKE '$desde%'";
  }
  
  
  require_once '../../../res/php/app_topHotel.php'; 

	// $reghues   = $hotel->getCantidadPerfiles();
  $huespedes = $hotel->creaConsulta($query.$filtro.$orden); 
  
  include_once '../../imprimir/imprimeListadoHuespedes.php' ;

?>
