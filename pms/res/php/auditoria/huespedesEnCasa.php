<?php 
	$usuario = $_SESSION['usuario'];
	$fecha = FECHA_PMS;

?>
<script>
	var webpage = $('#webPage').val();
	var ventana = window.open(webpage+'imprimir/imprimeHuespedesenCasa.php', 'PRINT', 'height=600,width=600');
</script>
