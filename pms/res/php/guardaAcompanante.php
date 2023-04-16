

<?php 
  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
	
	$idreserva      = $_POST['idReservaAdiAco'];
	$nuevo          = $_POST['nuevoPax'];
	$idhues         = $_POST['idHuesAdi'];
	$apellido1      = strtoupper($_POST['apellido1']);
	$apellido2      = strtoupper($_POST['apellido2']);
	$nombre1        = strtoupper($_POST['nombre1']);
	$nombre2        = strtoupper($_POST['nombre2']);
	$identificacion = $_POST['identifica'];
	$tipoiden       = $_POST['tipodoc'];
	$sexo           = $_POST['sexOption'];
	$fechanace      = $_POST['fechanace'];
	$nacion         = $_POST['paices']; 
	$usuario        = $_POST['usuario']; 
	$idusuario      = $_POST['idusuario']; 
	$ciudad         = '';

	if($nuevo==1){
		$creaHues = $hotel->creaHuespedAdicional($apellido1, $apellido2, $nombre1, $nombre2, $identificacion, $tipoiden, $sexo, $fechanace, $nacion, $ciudad, $idusuario);
		$idhues = $creaHues;
	}

	$adicional = $hotel->adicionaHuespedAdicional($idreserva,$idhues);

?>
	<h4 align="center" class="bg-green" style="padding:10px"><span style="font-size:24px;font-weight: 700;font-family: 'ubuntu';">Acompañante Adicionado con Exito</span></h4>
