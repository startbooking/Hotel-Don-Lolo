<?php

  require_once '../../res/php/app_topPos.php';

  $fecha = $_POST['fecha'];
  $idamb = $_POST['idamb'];
  $nomamb = $_POST['nomamb'];
  $user = $_POST['user'];
  $iduser = $_POST['iduser'];
  $logo = $_POST['logo'];
  $pref = $_POST['prefijo'];

  $anio = substr($fecha, 0, 4);
  $mes = substr($fecha, 5, 2);
  $dia = substr($fecha, 8, 2);

  $facturas = $pos->getFacturasDiaAmbiente('A', $idamb);
  $anuladas = $pos->getFacturasDiaAmbiente('X', $idamb);
  $comandaAnuladas = $pos->getComandasActivas($idamb, 'X');

  $mesasDis = $pos->getMesasDisponibles($idamb);

  $mesasVen = 0;
  $netoVen = 0;
  $mesasAnu = 0;
  $imptVen = 0;
  $propVen = 0;
  $servVen = 0;
  $descVen = 0;
  $totaVen = 0;
  $clieVen = 0;
  $factVen = 0;
  if (count($facturas) != 0) {
      $factVen = $facturas[0]['facturas'];
      $mesasVen = $facturas[0]['facturas'];
      $netoVen = $facturas[0]['neto'];
      $imptVen = $facturas[0]['impto'];
      $propVen = $facturas[0]['propina'];
      $descVen = $facturas[0]['descuento'];
      $servVen = $facturas[0]['servicio'];
      $totaVen = $facturas[0]['total'];
      $clieVen = $facturas[0]['pax'];
  }
  if (count($anuladas) != 0) {
      $mesasAnu = $anuladas[0]['facturas'];
  }
  $comanAnu = count($comandaAnuladas);

  $ingDia = $pos->ingresaDatosAuditoria($fecha, $mesasDis, $mesasVen, $mesasAnu, $comanAnu, $factVen, $netoVen, $imptVen, $propVen, $servVen, $totaVen, $clieVen, $idamb, $user, $iduser, $descVen);

  $ventasDia  = $pos->getVentasDiaPos($idamb, $fecha);
  $ventasMes  = $pos->getVentasMesPos($idamb, $mes, $anio);
  $ventasAnio = $pos->getVentasAnioPos($idamb, $anio);

  require_once '../imprimir/imprimeGerenciaDiariaAuditoria.php';
