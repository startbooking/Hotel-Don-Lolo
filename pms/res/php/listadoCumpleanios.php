<?php 
	$file   = $_POST['file'];
	$tipo   = $_POST['tipo'];

  require_once '../../../res/php/app_topHotel.php'; 

	$dia    = intval(substr(FECHA_PMS,8,2));
	$mes    = intval(substr(FECHA_PMS,5,2));
	
	$campos = "nombre_completo, direccion, email, telefono, fecha_nacimiento";
	$orden  = "day(fecha_nacimiento)";
	$tablas = 'huespedes';
	
	switch ($tipo) {
		case 1:
			$filtro = "day(fecha_nacimiento) = $dia AND month(fecha_nacimiento) = $mes ";
			break;
		case 2:
			$filtro = "month(fecha_nacimiento) = $mes ";
			break;
		case 3:
			$filtro = "fecha_nacimiento != '0000-00-00'";
			$orden  = "month(fecha_nacimiento), day(fecha_nacimiento) ";
			break;
	}

	$consulta = "SELECT $campos FROM $tablas WHERE $filtro  ORDER BY $orden" ;
	$huespedes = $hotel->getlistadoCumpleanios($consulta); 
	include_once '../../imprimir/imprimeListadoCumpleanios.php' ;

?>

<?php foreach ($huespedes as $key => $huesped): ?>
	<tr>
	  <td><?=$huesped['nombre_completo']?></td>
	  <td><?=str_replace('#','Nro',utf8_decode($huesped['direccion']))?></td>
	  <td><?=$huesped['telefono']?></td>
	  <td><?=$huesped['email']?></td>
	  <td><?=$huesped['fecha_nacimiento']?></td>
	</tr>	
<?php endforeach ?>
