<?php

$fecha = FECHA_PMS;

$inghab = $hotel->getIngresoDiarioGrupo($fecha, 'HA');
$habhu = $hotel->getCountHuespedesenCasa(CTA_MASTER, FECHA_PMS);
$habpm = $hotel->getCountCuentasMaestrasenCasa(CTA_MASTER, FECHA_PMS);
$conge = $hotel->getCuentasCongeladas();
$rooms = count($hotel->cantidadHabitaciones(1));
$pm = count($hotel->cantidadHabitaciones(5));
$huespedcasa = $habhu - $habpm;
$habitdis = $rooms;
$regis = count($inghab);

if ($regis == 0) {
    $ingdia = 0;
    $ingimp = 0;
} else {
    if ($inghab[0]['cargos'] == '') {
        $ingdia = 0;
        $ingimp = 0;
    } else {
        $ingdia = $inghab[0]['cargos'];
        $ingimp = $inghab[0]['impto'];
    }
}

$ingpromhab = round($ingdia / $habitdis, 2);

if ($huespedcasa == 0) {
    $ingpromocu = 0;
} else {
    $ingpromocu = round($ingdia / $huespedcasa, 2);
}

$canford = $hotel->getHabitacionsBloqueadas('FO');
$canfser = $hotel->getHabitacionsBloqueadas('FS');

$cancamas = $hotel->getCamasDisponibles();
$salidadia = $hotel->getSalidasHabitacionesDia(FECHA_PMS);
$salidaspm = $hotel->getSalidaspmDia(FECHA_PMS);
$salen = $hotel->getTotalHuespedeseSaliendo();

$llegadasdia = $hotel->getLlegadasHabitacionesDia(FECHA_PMS);
$llegadaspm = $hotel->getLlegadaspmDia(FECHA_PMS);
$llegan = $hotel->getTotalHuespedeseLlegando();
$huespedes = $hotel->getHuespedesenCasaCierre(CTA_MASTER);
$ingresocia = $hotel->getIngresoCia(FECHA_PMS);
// $ingresoage  = $hotel->getIngresoAgencia(FECHA_PMS);

$ingresogru = $hotel->getIngresoGrupo(FECHA_PMS);
$ingresoind = $hotel->getIngresoIndividual(FECHA_PMS);
$ingresohue = $hotel->getIngresoHuesped(FECHA_PMS);
$repetidos = $hotel->getHuespedesRepetitivos();
$nacionales = $hotel->getHuespedesNacionales(CTA_MASTER, ID_PAIS_EMPRESA);
$internal = $hotel->getHuespedesInterNal(CTA_MASTER, ID_PAIS_EMPRESA);
$usodia = $hotel->habitacionesUsoDia(FECHA_PMS);

$llegadasdia = $llegadasdia - $llegadaspm;
$salidadia = $salidadia - $salidaspm;

$creadashoy = $hotel->getReservasCreadasHoy(FECHA_PMS, 1);
$resehoy = count($creadashoy);
$noshowhoy = $hotel->getReservasDia(FECHA_PMS, 1, 'ES');
$noshow = count($noshowhoy);

$canceladashoy = $hotel->getHuespedesenSalida(1, 'CX');
$canceladas = count($canceladashoy);

$saleantes = $hotel->getSalidasAntes(FECHA_PMS);
$sinreserva = $hotel->getLlegadasSinReserva(FECHA_PMS);

$repite = count($repetidos);
$nuevos = $huespedcasa - $repite;

if (count($usodia) == 0) {
    $usodiaha = 0;
    $usodiaho = 0;
    $usodiamu = 0;
    $usodiani = 0;
} else {
    $usodiaha = $usodia[0]['habi'];
    $usodiaho = $usodia[0]['hom'];
    $usodiamu = $usodia[0]['muj'];
    $usodiani = $usodia[0]['nin'];
}

if (count($salen) == 0) {
    $saleho = 0;
    $salemu = 0;
    $saleni = 0;
} else {
    $saleho = $salen[0]['hom'];
    $salemu = $salen[0]['muj'];
    $saleni = $salen[0]['nin'];
}

if (count($llegan) == 0) {
    $llegaho = 0;
    $llegamu = 0;
    $llegani = 0;
} else {
    $llegaho = $llegan[0]['hom'];
    $llegamu = $llegan[0]['muj'];
    $llegani = $llegan[0]['nin'];
}

if (count($cancamas) == 0) {
    $camas = 0;
} else {
    $camas = $cancamas[0]['camas'];
}

if ($ingresocia[0]['cargos'] == '') {
    $ingcia = 0;
} else {
    $ingcia = $ingresocia[0]['cargos'];
}

$ingage = 0;

if ($ingresogru[0]['cargos'] == '') {
    $inggru = 0;
} else {
    $inggru = $ingresogru[0]['cargos'];
}

if ($ingresoind[0]['cargos'] == '') {
    $ingind = 0;
} else {
    $ingind = $ingresoind[0]['cargos'];
}

if ($ingresohue[0]['cargos'] == '') {
    $inghue = 0;
} else {
    $inghue = $ingresohue[0]['cargos'];
}

if (count($huespedes) == 0) {
    $hom = 0;
    $muj = 0;
    $nin = 0;
    $ingpromhues = 0;
} else {
    if (($huespedes[0]['hombres'] + $huespedes[0]['mujeres']) == 0) {
        $hom = 0;
        $muj = 0;
        $nin = 0;
        $ingpromhues = 0;
    } else {
        $hom = $huespedes[0]['hombres'];
        $muj = $huespedes[0]['mujeres'];
        $nin = $huespedes[0]['ninos'];
        $ingpromhues = round($ingdia / ($hom + $muj), 2);
    }
}

$audi = $hotel->insertDiaAuditoria($fecha, $ingdia, $ingimp, $ingpromhab, $ingpromocu, $habitdis, $ingpromhues, $canford, $canfser, $huespedcasa, $salidadia, $llegadasdia, $hom, $muj, $nin, $camas, $usuario, $idusuario, $ingcia, $ingage, $inggru, $ingind, $inghue, $repite, $nuevos, $nacionales, $internal, $resehoy, $noshow, $canceladas, $saleantes, $sinreserva, $llegaho, $llegamu, $llegani, $usodiaha, $usodiaho, $usodiamu, $usodiani, $conge);

$cancelados = $hotel->enviaHistoricoCanceladas('CX');
// $borracan   = $hotel->borraCanceladasHistorico('CX');

$salidasfac = $hotel->getSalidasDia(FECHA_PMS, 2, 'SA');
// $ctascongel = $hotel->getSalidasDia(FECHA_PMS,2,'CO');
    //

$pasacargos = $hotel->enviaHistoricoCargos();
sleep(2);
$borracargo = $hotel->borraHistoricoCargos();
sleep(2);

/*
    foreach ($salidasfac as $salidafac) {
        /// echo $salidafac['num_reserva'];
    }
*/
/*
if(count($salidasfac)<> 0){
}

if(count($ctascongel)<> 0){
    foreach ($ctascongel as $ctacongel) {
        $pasacargos = $hotel->enviaHistoricoCargos($ctacongel['num_reserva']);
        // $borracargo = $hotel->borraHistoricoCargos($ctacongel['num_reserva']);
        // echo print_r($pasacargos);
        // echo print_r($borracargo);
    }
}
*/

$envEspera = $hotel->enviaHistoricoEstadias($fecha, 'ES');
sleep(2);

$envnoShow = $hotel->cambiaNoShow($fecha, 'ES');
sleep(2);
$envSalida = $hotel->enviaHistoricoSalidas($fecha, 'SA');
sleep(2);
$envCancel = $hotel->enviaHistoricoSalidas($fecha, 'CX');
sleep(2);

/*
$borraesp   = $hotel->borraEnviadasaHistorico($fecha,'ES');
$cambiaest  = $hotel->borraEnviadasaHistorico($fecha,'ES');
$borracan   = $hotel->borraHistoricoSalidas($fecha,'SA');
*/
