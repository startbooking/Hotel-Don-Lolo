<?php 
	$usuario = $_SESSION['usuario'];
	$fecha   = FECHA_PMS;

?>
<script>
	var webpage = $('#webPage').val();
	var ventana = window.open(webpage+'imprimir/imprimeSalidasDelDia.php', 'PRINT', 'height=600,width=600');
  // ventana.print();  //imprimimos la ventana
  // ventana.close();  //cerramos la ventana
</script>

