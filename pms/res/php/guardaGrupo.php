<?php

require '../../../res/php/app_topHotel.php';

echo print_r($_POST) ;

$empresaGrupo = $_REQUES['empresaGrupo'];
$nombreGrupo = $_POST['nombreGrupo'];
$llegada = $_POST['llegada'];
$noches = $_POST['noches'];
$salida = $_POST['salida'];
$hombres = $_POST['hombres'];
$mujeres = $_POST['mujeres'];
$ninos = $_POST['ninos'];
$cantHabi = $_POST['cantHabi'];
$tarifahab = $_POST['tarifahab'];
$valortar = $_POST['valortar'];
$origen = $_POST['origen'];
$destino = $_POST['destino'];
$motivo = $_POST['motivo'];
$fuente = $_POST['fuente'];
$segmento = $_POST['segmento'];
$formapago = $_POST['formapago'];
$observaciones = $_POST['observaciones'];
$usuario = $_POST['usuario'];
$idusuario = $_POST['idusuario'];


list($empresaGrupo, $nombreGrupo, $llegada, $noches, $salida, $hombres, $mujeres, $ninos, $cantHabi, $tarifahab, $valortar, $origen, $destino, $motivo, $fuente, $segmento, $formapago, $observaciones, $usuario, $idusuario) = $_POST; 

echo $empresaGrupo, $nombreGrupo, $llegada, $noches, $salida, $hombres, $mujeres, $ninos, $cantHabi, $tarifahab, $valortar, $origen, $destino, $motivo, $fuente, $segmento, $formapago, $observaciones, $usuario, $idusuario;

$regis = $hotel->creaGrupo($empresaGrupo, $nombreGrupo, $llegada, $noches, $salida, $hombres, $mujeres, $ninos, $cantHabi, $tarifahab, $valortar, $origen, $destino, $motivo, $fuente, $segmento, $formapago, $observaciones, $usuario, $idusuario);

echo $regis;

/* 

$arr_of_keys   = array_keys($_POST);
$arr_of_values = array_values($_POST);

echo $arr_of_keys ;
echo $arr_of_values ; */

// require '../../../res/php/titles.php';

/* $forma = $_POST['formadePago'];
$textoforma = $_POST['textforma'];
$valor = $_POST['txtValorDeposito'];
$detalle = strtoupper($_POST['txtDetalleDeposito']);
$numero = $_POST['txtIdReservaDep'];
$idhues = $_POST['id'];
$usuario = $_POST['usuario'];
$idusuario = $_POST['idusuario'];
$ctadeposito = CTA_DEPOSITO;
$fecha = FECHA_PMS;
$folio = 1;

$directorio = '../../uploads/';

$dir = opendir($directorio);
// Abrimos el directorio de destino  $dir  = opendir($directorio); //Abrimos el directorio de destino

$encasa = $hotel->getNumeroPMDeposito($ctadeposito);
// Numero de reserva de la cuenta maestra
$regis = $encasa;

if ($regis == 0) {
    echo '-1';
} else {
    $numdeposito = $hotel->getNumeroAbono(); // Numero Actual del Abono
    $nuevo = $numdeposito + 1;
    $nuevonumero = $hotel->updateNumeroAbonos($nuevo); // Actualiza Consecutivo del Abono

    $deposito = $hotel->insertDepositoReserva($fecha, $forma, $valor, $detalle, $numero, $idhues, $idusuario, $usuario, $ctadeposito, $folio, $numdeposito, $encasa, $textoforma);
}

if (is_array($_FILES)) {
    if (count($_FILES) != 0) {
        foreach ($_FILES['images']['name'] as $name => $value) {
            $up = 0;
            $file_name = $_FILES['images']['name'][$name];
            $source = $_FILES['images']['tmp_name'][$name];
            $target_path = $directorio.$file_name;

            if ($file_name != '') {
                $up = crearThumbJPEG($source, $target_path, 600, 480, 90);
            }

            if ($up == 1) {
                $img = $hotel->insertImagenPerfil(3, $numdeposito, $file_name, $numero, $idusuario);
            }
        }
    }
}


$_SESSION['abono'] = $numdeposito;
$_SESSION['reserva'] = $numero;
$_SESSION['idperfil'] = $idhues;

include '../../imprimir/imprimeAbonoEstadia.php';

$filepdf = BASE_PMS.'imprimir/notas/Deposito_'.$numdeposito.'.pdf';
 */