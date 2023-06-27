<?php 
  require '../../res/php/titles.php';
  require '../../res/php/app_topHotel.php'; 

	$fecha               = FECHA_PMS;
	$usuario             = $_SESSION['usuario'];
	$reserva             = $_POST['reserva']; 
	
	$_SESSION['reserva'] = $reserva;
	
	include '../imprimir/imprimeDepositoReserva.php';
  $filepdf = BASE_PMS.'/imprimir/registros/Registro_Hotelero_'.$reserva.'.pdf';

?> 

<script>
	var ventana = window.open('<?=$filepdf;?>', 'PRINT', 'height=600,width=600');
</script>


<?php 
include("../../res/shared/archivo_script.php") 
?>
