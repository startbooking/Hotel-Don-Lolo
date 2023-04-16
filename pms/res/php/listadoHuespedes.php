<?php 
	$file= $_POST['file'];

  require_once '../../../res/php/app_topHotel.php'; 

	$reghues   = $hotel->getCantidadPerfiles();
  $huespedes = $hotel->getPerfilHuespedes(0,$reghues); 
  include_once '../../imprimir/imprimeListadoHuespedes.php' ;

?>
<?php foreach ($huespedes as $key => $huesped): ?>
	<tr>
	  <td><?=$huesped['nombre_completo']?></td>
	  <td><?=str_replace('#','Nro',utf8_decode($huesped['direccion']))?></td>
	  <td><?=$huesped['telefono']?></td>
	  <td><?=$huesped['email']?></td>
	  <td><?=$huesped['identificacion']?></td>
	</tr>	
<?php endforeach ?>