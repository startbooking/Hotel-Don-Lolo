<?php 
  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
  
	$numregis             = $_POST['registro']; 
	
  $filepdf = BASE_PMS.'imprimir/registros/Registro_Hotelero_'.str_pad($numregis,5,'0',STR_PAD_LEFT).'.pdf';
  
?> 

<script>
	var ventana = window.open('<?=$filepdf;?>', 'PRINT', 'height=600,width=600');
</script>

<?php 

	include("../../../res/shared/archivo_script.php") 

?>
