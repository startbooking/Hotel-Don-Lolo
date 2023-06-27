<?php 

  require '../../../../res/php/titles.php';
  require '../../../../res/php/app_topHotel.php'; 

  $usuario = $_SESSION['usuario'];
  $fecha   = FECHA_PMS;

  include_once '../../../imprimir/imprimeCierreCajero.php';

  $filepdf = BASE_PMS.'/imprimir/cajeros/cierre_Cajero_'.$_SESSION['usuario'].'.pdf';

?>

<script>
	var ventana = window.open('<?=$filepdf;?>', 'PRINT', 'height=600,width=600');
</script>