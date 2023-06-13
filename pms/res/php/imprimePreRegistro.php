<?php 
  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
  
	$fecha               = FECHA_PMS;
	$usuario             = $_POST['usuario'];
	$reserva             = $_POST['reserva']; 
	
	$_SESSION['reserva'] = $reserva;

	include '../../imprimir/imprimePreRegistroHotelero.php';		
  $filepdf = BASE_PMS.'imprimir/registros/preRegistro_Hotelero_'.str_pad($reserva,5,'0',STR_PAD_LEFT).'.pdf';
  
?> 

<script>
	var ventana = window.open('<?=$filepdf;?>', 'PRINT', 'height=600,width=600');
</script>




<?php 

	include("../../../res/shared/archivo_script.php") 

?>
