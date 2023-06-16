

<?php 
  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 

	$idreserva      = $_POST['idReservaAdiAco'];
	$nuevo          = $_POST['nuevoPax'];
	$idhues         = $_POST['idHuesAdi'];
	$apellido1      = strtoupper($_POST['apellido1AdiAco']);
	$apellido2      = strtoupper($_POST['apellido2AdiAco']);
	$nombre1        = strtoupper($_POST['nombre1AdiAco']);
	$nombre2        = strtoupper($_POST['nombre2AdiAco']);
	$identificacion = $_POST['identificaAdiAco'];
	$tipoiden       = $_POST['tipodocAdiAco'];
	$sexo           = $_POST['sexOptionAdiAco'];
	$fechanace      = $_POST['fechanaceAdiAco'];
	$nacion         = $_POST['paicesAdiAco']; 
	$ciudad         = $_POST['ciudadAdiAco']; 
	$usuario        = $_POST['usuario']; 
	$idusuario      = $_POST['usuario_id']; 
	
	if($nuevo==1){
		$creaHues = $hotel->creaHuespedAdicional($apellido1, $apellido2, $nombre1, $nombre2, $identificacion, $tipoiden, $sexo, $fechanace, $nacion, $ciudad, $idusuario);
		$idhues = $creaHues;
	}
 
	$adicional = $hotel->adicionaHuespedAdicional($idreserva,$idhues);
	
	echo $adicional;
	
?>
