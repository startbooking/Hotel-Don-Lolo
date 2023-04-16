<?php 
	$file= $_POST['file'];

  require_once '../../../res/php/app_topHotel.php'; 

	$regcias   = $hotel->getCantidadCompanias();
	$companias = $hotel->getPerfilCompanias(0,$regcias); 

  include_once '../../imprimir/imprimeListadoCompanias.php' ;

?>
<?php foreach ($companias as $key => $compania): ?>
	<tr>
	  <td><?=$compania['empresa']?></td>
	  <td><?=$compania['nit'].'-'.$compania['nit']?></td>
	  <td><?=str_replace('#','Nro',utf8_decode($compania['direccion']))?></td>
	  <td><?=$compania['telefono']?></td>
	  <td><?=$compania['email']?></td>
	</tr>	
<?php endforeach ?>
