<?php 
	$file   = $_POST['file'];
	$tipo   = $_POST['tipo'];

  require_once '../../../res/php/app_topHotel.php'; 

	$campos = "SELECT nombre_completo, direccion, email, telefono, fecha_nacimiento";
	$orden  = " ORDER BY day(fecha_nacimiento), apellido1";
	$tablas = " FROM huespedes ";
	
	switch ($tipo) {
		case 1:
			$filtro = " WHERE day(fecha_nacimiento) = $hoy AND month(fecha_nacimiento) = $mes ";
			break;
		case 2:
			$filtro = " WHERE month(fecha_nacimiento) = $mes ";
			break;
		case 3:
			$filtro = " WHERE fecha_nacimiento != '0000-00-00'";
			$orden  = " ORDER BY month(fecha_nacimiento), day(fecha_nacimiento), apellido1 ";
			break;
	}

	// $consulta = "SELECT $campos FROM $tablas WHERE $filtro  ORDER BY $orden" ;
	// $consulta = "SELECT $campos FROM $tablas WHERE $filtro  ORDER BY $orden" ;
	$huespedes = $hotel->creaConsulta($campos.$tablas.$filtro.$orden); 
	
	include_once '../../imprimir/imprimeListadoCumpleanios.php' ;

?>
