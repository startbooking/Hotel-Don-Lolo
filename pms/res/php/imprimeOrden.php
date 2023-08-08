<?php 
  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
  
	$fecha             = FECHA_PMS;
	$usuario           = $_SESSION['usuario'];
	$orden             = $_POST['orden']; 
	// $_SESSION['orden'] = $orden;

  $filepdf = BASE_PMS.'imprimir/informes/order_Mantenimiento_'.$orden.'.pdf';
  
?> 

<script>
	var ventana = window.open('<?=$filepdf;?>', 'PRINT', 'height=600,width=600');
</script>




<?php 

include("../../../res/shared/archivo_script.php") 

?>
