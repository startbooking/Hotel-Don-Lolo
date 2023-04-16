<?php 

	require '../../../res/php/rutas.php';
	require '../../../res/php/funcionPDF.php';
	$archivo =  'Factura_108.pdf';
	PlaceWatermark($archivo, "Factura Anulada", 30, 120, 100,TRUE);
 ?>	