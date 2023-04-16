<?php 
	$usuario = $_SESSION['usuario'];
	$fecha   = FECHA_PMS;
	include '../../../imprimir/imprimeNoShows.php';

?>

<!-- 
<script>
	var webpage        = $('#webPage').val();
	var ventana = window.open(webpage+'imprimir/imprimeNoShows.php', 'PRINT', 'height=600,width=600');
  // ventana.print();  //Imprimimos la ventana
  // ventana.close();  //cerramos la ventana
</script>
-->