<?php
/* include_once '../../res/php/app_topHotel.php';
$usuario ='BARAHONA';
$idusuario = 2;
 */
$fecha = FECHA_PMS;

$habhot = $hotel->habitacionesHotel(); // Total Habitaciones del Hotel 
$estaHab = $hotel->estadoHabitacionesHotel(); //Habitaciones Disponibles 
$ocupaci = $hotel->ocupacionHotel($fecha);
$inghab = $hotel->ingresoDiarioAgrupacion($fecha, 'HA'); // Ingreso Diario Alojamiento
$huespedes = $hotel->estadoHuespedesHotel();

// echo print_r($habhot);

$habocu = $ocupaci[0]['encasa'];
$ctaocu = $ocupaci[0]['ctamaster'];
$conocu = $ocupaci[0]['congela'];

$huecas = $ocupaci[0]['huecas'];
$mujcas = $ocupaci[0]['mujcas'];
$homcas = $ocupaci[0]['homcas'];
$nincas = $ocupaci[0]['nincas'];

$habtot = $habhot[0]['nrohab'];
$habdis = $estaHab[0]['dispo'];
$habmmt = $estaHab[0]['mmto'];
$camadi = $estaHab[0]['camas'];

$carhab = $inghab[0]['cargos'];
$ingimp = $inghab[0]['impto'];
$ingtot = $inghab[0]['total'];

$comhab = $inghab[0]['carcomp'];
$comimp = $inghab[0]['impcomp'];
$comtot = $inghab[0]['totcomp'];

$indhab = $inghab[0]['carindi'];
$indimp = $inghab[0]['impindi'];
$indtot = $inghab[0]['totindi'];

$ingage = 0 ; // campo e Desuso
$inggru = 0 ;// Campo no implementado

$ingprodis = $carhab / $habdis;
$ingproocu = $carhab / $habocu;
$ingprohue = $carhab / $huecas;

$llegadas = $ocupaci[0]['llegadas'];
$homlle = $ocupaci[0]['homlle'];
$mujlle = $ocupaci[0]['mujlle'];
$ninlle = $ocupaci[0]['ninlle'];

$salidas = $ocupaci[0]['salidas'];
$mujsal = $ocupaci[0]['mujsal'];
$homsal = $ocupaci[0]['homsal'];
$ninsal = $ocupaci[0]['ninsal'];

$cancela = $ocupaci[0]['cancela'];
$mujcan = $ocupaci[0]['mujcan'];
$homcan = $ocupaci[0]['homcan'];
$nincan = $ocupaci[0]['nincan'];

$noshow = $ocupaci[0]['noshow'];
$mujnsh = $ocupaci[0]['mujnsh'];
$homnsh = $ocupaci[0]['homnsh'];
$ninnsh = $ocupaci[0]['ninnsh'];

$creadashoy = $ocupaci[0]['creadashoy'];
$mujhoy = $ocupaci[0]['mujhoy'];
$homhoy = $ocupaci[0]['homhoy'];
$ninhoy = $ocupaci[0]['ninhoy'];

$saleantes = $ocupaci[0]['saleantes'];
$mujant = $ocupaci[0]['mujant'];
$homant = $ocupaci[0]['homant'];
$ninant = $ocupaci[0]['ninant'];

$sinreserva = $ocupaci[0]['sinreserva'];
$mujsin = $ocupaci[0]['mujsin'];
$homsin = $ocupaci[0]['homsin'];
$ninsin = $ocupaci[0]['ninsin'];

$usodia = $ocupaci[0]['usodia'];
$mujuso = $ocupaci[0]['mujuso'];
$homuso = $ocupaci[0]['homuso'];
$ninuso = $ocupaci[0]['ninuso'];


$huerep = $huespedes[0]['repetidos'];
$huenue = $huespedes[0]['nuehues'];
$hueext = $huespedes[0]['extcas'];
$huenal = $huespedes[0]['nalcas'];

$audi = $hotel->insertDiaAuditoria($fecha, $habtot, $carhab, $ingimp, $ingprodis, $ingproocu, $habdis, $ingprohue, $habocu, $salidas, $llegadas, $homcas, $mujcas, $nincas, $camadi, $usuario, $idusuario, $comhab, $ingage, $inggru, $indhab, $huerep, $huenue, $huenal, $hueext, $creadashoy, $noshow, $cancela, $saleantes, $sinreserva, $homlle, $mujlle, $ninlle, $usodia, $homuso, $mujuso, $ninuso, $conocu, $habmmt, $homsal, $mujsal, $ninsal);

$cancelados = $hotel->enviaHistoricoCanceladas('CX');
$salidasfac = $hotel->getSalidasDia(FECHA_PMS, 2, 'SA');

$pasacargos = $hotel->enviaHistoricoCargos();
sleep(2);
$borracargo = $hotel->borraHistoricoCargos();
sleep(2);
$pasaFE = $hotel->enviaHistoricoFE();
sleep(2); 
$borraFE = $hotel->borraHistoricoFE();
sleep(2);
// $envEspera = $hotel->enviaHistoricoEstadias($fecha, 'ES');
// sleep(2);

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
