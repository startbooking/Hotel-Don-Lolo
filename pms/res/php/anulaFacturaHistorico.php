<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
  
  $factura     = $_POST['factura'];
  $motivo      = strtoupper($_POST['motivo']);
  $reserva     = $_POST['reserva'];
  $usuario     = $_POST['usuario'];
  $idusuario   = $_POST['usuario_id'];    
  $fecha       = FECHA_PMS;


  
  include_once('../../imprimir/imprimeFacturaAnuladaHistorico.php');

  $inse        = $hotel->insertaHistoricoCongela($reserva); 
  
  $numcongela  = $hotel->getNumeroCongela(); // Numero Actual del Abono
  $nuevonumero = $hotel->updateNumeroCongela($numcongela + 1); // Actualiza Consecutivo del Abono
  $congela     = $hotel->updateReservaHuespedCongela($reserva,$usuario,$idusuario,$fecha, $numcongela);
  
  $delconge    = $hotel->borraHistoricoCongela($reserva);  
  $pasacargos  = $hotel->insertCargosHistorico($factura,$reserva);
  $cambia      = $hotel->cambioValorFacturaHistorico($factura,$reserva,$fecha,$usuario,$idusuario);
  $cargos      = $hotel->buscaFacturaNumero($factura,$reserva);

  foreach ($cargos as $cargo) { 
    $desCode = $hotel->getDescripcionIva($cargo['codigo_ajuste']);
    $codCarg = $cargo['id_cargo'];
    $newCode = $cargo['codigo_ajuste'];
    $upda    = $hotel->cambiaCodigoFacturaHistorico($codCarg,$newCode,$desCode);

  }
  $anulafac    = $hotel->anulafacturaHistoricoXCongelada($factura,$reserva, $motivo, $usuario, $idusuario);

