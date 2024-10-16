<?php

$pdf = new PDF();
$pdf->AddPage('L', 'letter');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(260, 5, 'INFORME FUENTE DE RESERVAS ', 0, 1, 'C');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(260, 4, 'Fecha : ' . FECHA_PMS, 0, 1, 'C');
$pdf->Ln(4);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(70, 5, 'DESCRIPCION ', 0, 0, 'C');
$pdf->Cell(30, 5, 'CANT', 0, 0, 'C');
$pdf->Cell(30, 5, 'VALOR', 0, 0, 'C');
$pdf->Cell(30, 5, 'CANT MES', 0, 0, 'C');
$pdf->Cell(30, 5, 'VALOR MES', 0, 0, 'C');
$pdf->Cell(30, 5, ('CANT AÑO'), 0, 0, 'C');
$pdf->Cell(30, 5, ('VALOR AÑO'), 0, 1, 'C');
$codigos = $hotel->getMotivoGrupo('FRE');

// echo print_r($codigos);

$query = "SELECT
	a.*,
	b.*,
	c.*,
	d.*,
	e.*,
	f.* 
FROM
	(
	SELECT
  reservas_pms.fuente_reserva,
  grupos_cajas.descripcion_grupo AS fuente,
	COUNT( reservas_pms.num_reserva ) AS cant,
	SUM( reservas_pms.valor_diario ) AS valor 
FROM
	reservas_pms
	LEFT JOIN grupos_cajas ON reservas_pms.fuente_reserva = grupos_cajas.id_grupo
	LEFT JOIN tipo_habitaciones ON reservas_pms.tipo_habitacion = tipo_habitaciones.id 
WHERE
	reservas_pms.fecha_llegada = '20240820' 
	AND reservas_pms.estado = 'CA' 
	AND tipo_habitaciones.tipo_habitacion = 1 
GROUP BY
	reservas_pms.fuente_reserva 
ORDER BY
	grupos_cajas.descripcion_grupo 
	) AS a,
	(
	SELECT
reservas_pms.fuente_reserva,
grupos_cajas.descripcion_grupo AS fuente,
	COUNT( reservas_pms.num_reserva ) AS cant,
	SUM( reservas_pms.valor_diario ) AS valor 
FROM
	reservas_pms
	LEFT JOIN grupos_cajas ON reservas_pms.fuente_reserva = grupos_cajas.id_grupo
	LEFT JOIN tipo_habitaciones ON reservas_pms.tipo_habitacion = tipo_habitaciones.id 
WHERE
	MONTH ( reservas_pms.fecha_llegada ) = 8 
	AND YEAR ( reservas_pms.fecha_llegada ) = 2024 
	AND reservas_pms.estado = 'CA' 
	AND tipo_habitaciones.tipo_habitacion = 1 
GROUP BY
	reservas_pms.fuente_reserva 
ORDER BY
	grupos_cajas.descripcion_grupo
	) AS b,
	(
	SELECT
reservas_pms.fuente_reserva,
grupos_cajas.descripcion_grupo AS fuente,
	COUNT( reservas_pms.num_reserva ) AS cant,
	SUM( reservas_pms.valor_diario ) AS valor 
FROM
	reservas_pms
	LEFT JOIN grupos_cajas ON reservas_pms.fuente_reserva = grupos_cajas.id_grupo
	LEFT JOIN tipo_habitaciones ON reservas_pms.tipo_habitacion = tipo_habitaciones.id 
WHERE
	YEAR ( reservas_pms.fecha_llegada ) = 2024 
	AND reservas_pms.estado = 'CA' 
	AND tipo_habitaciones.tipo_habitacion = 1 
GROUP BY
	reservas_pms.fuente_reserva 
ORDER BY
	grupos_cajas.descripcion_grupo
	) AS c,
	(
	SELECT
historico_reservas_pms.fuente_reserva,
grupos_cajas.descripcion_grupo AS fuente,
	COUNT( historico_reservas_pms.num_reserva ) AS cantDia,
	SUM( historico_reservas_pms.valor_diario ) AS valorDia
FROM
	historico_reservas_pms
	LEFT JOIN grupos_cajas ON historico_reservas_pms.fuente_reserva = grupos_cajas.id_grupo
	LEFT JOIN tipo_habitaciones ON historico_reservas_pms.tipo_habitacion = tipo_habitaciones.id 
WHERE
	historico_reservas_pms.fecha_llegada = '20240820' 
	AND historico_reservas_pms.estado = 'SA' 
	AND tipo_habitaciones.tipo_habitacion = 1 
GROUP BY
	historico_reservas_pms.fuente_reserva 
ORDER BY
	grupos_cajas.descripcion_grupo
	) AS d,
	(
	SELECT
historico_reservas_pms.fuente_reserva,
grupos_cajas.descripcion_grupo AS fuente,
	COUNT( historico_reservas_pms.num_reserva ) AS cantMes,
	SUM( historico_reservas_pms.valor_diario ) AS valorMes
FROM
	historico_reservas_pms
	LEFT JOIN grupos_cajas ON historico_reservas_pms.fuente_reserva = grupos_cajas.id_grupo
	LEFT JOIN tipo_habitaciones ON historico_reservas_pms.tipo_habitacion = tipo_habitaciones.id 
WHERE
	MONTH ( historico_reservas_pms.fecha_llegada ) = 8 
	AND YEAR ( historico_reservas_pms.fecha_llegada ) = 2024 
	AND historico_reservas_pms.estado = 'SA' 
	AND tipo_habitaciones.tipo_habitacion = 1 
GROUP BY
	historico_reservas_pms.fuente_reserva 
ORDER BY
	grupos_cajas.descripcion_grupo
	) AS e,
	(
	SELECT
historico_reservas_pms.fuente_reserva,
grupos_cajas.descripcion_grupo AS fuente,
	COUNT( historico_reservas_pms.num_reserva ) AS cantAnio,
	SUM( historico_reservas_pms.valor_diario ) AS valorAnio
FROM
	historico_reservas_pms
	LEFT JOIN grupos_cajas ON historico_reservas_pms.fuente_reserva = grupos_cajas.id_grupo
	LEFT JOIN tipo_habitaciones ON historico_reservas_pms.tipo_habitacion = tipo_habitaciones.id 
WHERE
	YEAR ( historico_reservas_pms.fecha_llegada ) = 2024 
	AND historico_reservas_pms.estado = 'SA' 
	AND tipo_habitaciones.tipo_habitacion = 1 
GROUP BY
	historico_reservas_pms.fuente_reserva 
ORDER BY
	grupos_cajas.descripcion_grupo 
	) AS f 
WHERE
	a.fuente_reserva = b.fuente_reserva 
	AND b.fuente_reserva = c.fuente_reserva 
	AND c.fuente_reserva = d.fuente_reserva 
	AND d.fuente_reserva = e.fuente_reserva 
	AND e.fuente_reserva = f.fuente_reserva 
ORDER BY
	a.fuente";

// echo $query;

$fuentes = $hotel->creaConsulta($query);

echo print_r($fuentes);

$totcandia = 0;
$totvaldia = 0;
$totcanmes = 0;
$totvalmes = 0;
$totcanani = 0;
$totvalani = 0;

foreach ($codigos as $codigo) {
  $pdf->Cell(70, 6, (substr($codigo['descripcion_grupo'], 0, 30)), 0, 0, 'L');
  $diafuen     = $hotel->getDiaFuenteReserva(FECHA_PMS, $codigo['id_grupo']);
  $mesfuen     = $hotel->getMesFuenteReserva(FECHA_PMS, $mes, $anio, $codigo['id_grupo']);
  $anifuen     = $hotel->getAniFuenteReserva(FECHA_PMS, $anio, $codigo['id_grupo']);
  /// echo json_decode($mesfuen);
  if (count($diafuen) == 0) {
    $cant = 0;
  } else {
    $cant = $diafuen[0]['nro'];
  }
  if (count($diafuen) == 0) {
    $valo = 0;
  } else {
    $valo = $diafuen[0]['val'];
  }
  if (count($mesfuen) == 0) {
    $canmes = 0;
  } else {
    $canmes = $mesfuen[0]['nro'];
  }
  if (count($mesfuen) == 0) {
    $valmes = 0;
  } else {
    $valmes = $mesfuen[0]['val'];
  }
  if (count($anifuen) == 0) {
    $canani = 0;
  } else {
    $canani = $anifuen[0]['nro'];
  }
  if (count($anifuen) == 0) {
    $valani = 0;
  } else {
    $valani = $anifuen[0]['val'];
  }
  /*
    $mesvtaact  = $hotel->getVentasMesCodigo($mes, $anio, $codigo['id_cargo']);
    $mesvtahis  = $hotel->getVentasMesCodigoHistorico($mes, $anio, $codigo['id_cargo']);
    $aniovtaact = $hotel->getVentasAnioCodigo($anio,$codigo['id_cargo']);
    $aniovtahis = $hotel->getVentasAnioCodigoHistorico($anio,$codigo['id_cargo']);
    if(count($diavta)==0){$impto = 0;}else{ $impto = $diavta[0]['imptos']; }
    if(count($mesvtaact)==0){$carmes=0;}else{$carmes= $mesvtaact[0]['cargos'];}
    if(count($mesvtahis)==0){$caracu=0;}else{$caracu= $mesvtahis[0]['cargos'];}
    if(count($mesvtaact)==0){$impmes=0;}else{$impmes= $mesvtaact[0]['imptos'];}
    if(count($mesvtahis)==0){
      $impacu=0;
    }else{
      $impacu= $mesvtahis[0]['imptos'];
    }
    if(count($aniovtaact)==0){$carani=0;}else{$carani= $aniovtaact[0]['cargos'];}
    if(count($aniovtahis)==0){$caracuani=0;}else{$caracuani= $aniovtahis[0]['cargos'];}
    if(count($aniovtaact)==0){$impani=0;}else{$impani= $aniovtaact[0]['imptos'];}
    if(count($aniovtahis)==0){$impacuani=0;}else{$impacuani= $aniovtahis[0]['imptos'];}
    */
  $pdf->Cell(30, 6, number_format($cant, 0), 0, 0, 'R');
  $pdf->Cell(30, 6, number_format($valo, 2), 0, 0, 'R');
  $pdf->Cell(30, 6, number_format($canmes, 0), 0, 0, 'R');
  $pdf->Cell(30, 6, number_format($valmes, 2), 0, 0, 'R');
  $pdf->Cell(30, 6, number_format($canani, 0), 0, 0, 'R');
  $pdf->Cell(30, 6, number_format($valani, 2), 0, 1, 'R');

  /*
    $pdf->Cell(30,6,number_format($carani+$caracuani,2),0,0,'R');
    $pdf->Cell(30,6,number_format($impani+$impacuani,2),0,1,'R');
    */

  $totcandia = $totcandia + $cant;
  $totvaldia = $totvaldia + $valo;
  $totcanmes = $totcanmes + $canmes;
  $totvalmes = $totvalmes + $valmes;
  $totcanani = $totcanani + $canani;
  $totvalani = $totvalani + $valani;
  /*
    */
}

$pdf->Ln(3);
$pdf->SetFont('Arial', 'b', 10);

$pdf->Cell(70, 6, (substr('TOTAL RESERVAS', 0, 30)), 0, 0, 'L');
$pdf->Cell(30, 6, number_format($totcandia, 0), 0, 0, 'R');
$pdf->Cell(30, 6, number_format($totvaldia, 2), 0, 0, 'R');
$pdf->Cell(30, 6, number_format($totcanmes, 0), 0, 0, 'R');
$pdf->Cell(30, 6, number_format($totvalmes, 2), 0, 0, 'R');
$pdf->Cell(30, 6, number_format($totcanani, 0), 0, 0, 'R');
$pdf->Cell(30, 6, number_format($totvalani, 2), 0, 1, 'R');
/*

  $pdf->Ln(3);
  $pdf->SetFont('Arial','',9);

  $pagos = $hotel->getCodigosConsumos(3);
  $totingdia = 0;
  $totimpdia = 0;
  $totingmes = 0;
  $totimpmes = 0;
  $totingani = 0;
  $totimpani = 0;

  foreach ($pagos as $pago) { 
    $pdf->Cell(70,6,(substr($pago['descripcion_cargo'],0,30)),0,0,'L');
    $diavta     = $hotel->getVentasDiaCodigo(FECHA_PMS,$pago['id_cargo']);
    $mesvtaact  = $hotel->getVentasMesCodigo($mes,$anio,$pago['id_cargo']);
    $mesvtahis  = $hotel->getVentasMesCodigoHistorico($mes,$anio,$pago['id_cargo']);
    $aniovtaact = $hotel->getVentasAnioCodigo($anio,$pago['id_cargo']);
    $aniovtahis = $hotel->getVentasAnioCodigoHistorico($anio,$pago['id_cargo']);
    if(count($diavta)==0){$cargos = 0 ;}else{$cargos = $diavta[0]['pagos']; }
    if(count($mesvtaact)==0){$carmes=0;}else{$carmes = $mesvtaact[0]['pagos'];}
    if(count($mesvtahis)==0){$caracu=0;}else{$caracu = $mesvtahis[0]['pagos'];}
    if(count($aniovtaact)==0){$carani=0;}else{$carani = $aniovtaact[0]['pagos'];}
    if(count($aniovtahis)==0){$caracuani=0;}else{$caracuani = $aniovtahis[0]['pagos'];}
    $pdf->Cell(30,6,number_format($cargos,2),0,0,'R');
    $pdf->Cell(30,6,number_format(0,2),0,0,'R');
    $pdf->Cell(30,6,number_format($carmes+$caracu,2),0,0,'R');
    $pdf->Cell(30,6,number_format(0,2),0,0,'R');
    $pdf->Cell(30,6,number_format($carani+$caracuani,2),0,0,'R');
    $pdf->Cell(30,6,number_format(0,2),0,1,'R');
    $totingdia = $totingdia + $cargos; 
    $totimpdia = $totimpdia + $impto; 
    $totingmes = $totingmes + $carmes + $caracu ;
    $totimpmes = $totimpmes + $impmes + $impacu ;
    $totingani = $totingani + $carani + $caracuani ; 
    $totimpani = $totimpani + $impani + $impacuani ;
  }
  $pdf->Ln(3);
  $pdf->SetFont('Arial','b',10);

  $pdf->Cell(70,6,(substr('TOTAL PAGOS RECIBIDOS',0,30)),0,0,'L');
  $pdf->Cell(30,6,number_format($totingdia,2),0,0,'R');
  $pdf->Cell(30,6,number_format($totimpdia,2),0,0,'R');
  $pdf->Cell(30,6,number_format($totingmes,2),0,0,'R');
  $pdf->Cell(30,6,number_format($totimpmes,2),0,0,'R');
  $pdf->Cell(30,6,number_format($totingani,2),0,0,'R');
  $pdf->Cell(30,6,number_format($totimpani,2),0,1,'R');

  $pdf->Ln(3);
  $pdf->SetFont('Arial','',9);
*/

$file = '../../imprimir/auditorias/acumuladoFuenteReserva_' . FECHA_PMS . '.pdf';
$pdf->Output($file, 'F');
