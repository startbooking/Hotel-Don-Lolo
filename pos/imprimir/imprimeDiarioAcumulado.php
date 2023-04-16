<?php 
  require_once '../../../../res/fpdf/fpdf.php';

  $pdf = new FPDF();
  $pdf->AddPage('L','letter');
  $pdf->Image('../../../../img/'.$logo,10,10,15);
  $pdf->SetFont('Arial','B',13);
  $pdf->Cell(260,7,utf8_decode(NAME_EMPRESA),0,1,'C');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(260,5,'NIT: '.NIT_EMPRESA,0,1,'C');
  /*
  
  $pdf->Cell(260,5,TIPOEMPRESA,0,1,'C');
  $pdf->Cell(260,5,utf8_decode(ADRESS_EMPRESA),0,1,'C');
  $pdf->Cell(260,5,utf8_decode(CIUDAD_EMPRESA).' '.PAIS_EMPRESA,0,1,'C');
  $pdf->Cell(260,5,'Telefono '.TELEFONO_EMPRESA.' Movil '.CELULAR_EMPRESA,0,1,'C');
   */
  $pdf->SetFont('Arial','B',13);
  $pdf->Cell(260,6,$nomamb,0,1,'C');
  $pdf->SetFont('Arial','B',12);
  $pdf->Cell(260,5,'ACUMULADO DE PRODUCTOS  ',0,1,'C');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(260,6,'Fecha : '.$fecha,0,1,'C');
  $pdf->Ln(4);
  $pdf->SetFont('Arial','',9);
  $pdf->Cell(50,5,'PRODUCTO ',0,0,'C');
  $pdf->Cell(20,5,'CANT. ',0,0,'C');
  $pdf->Cell(20,5,'IMPUESTO',0,0,'C');
  $pdf->Cell(20,5,'VENTAS DIA',0,0,'C');
  $pdf->Cell(20,5,'CANT MES',0,0,'C');
  $pdf->Cell(25,5,'IMPUESTO',0,0,'C');
  $pdf->Cell(25,5,'VENTAS MES',0,0,'C');
  $pdf->Cell(20,5,utf8_decode('CANT AÑO'),0,0,'C');
  $pdf->Cell(30,5,'IMPUESTO',0,0,'C');
  $pdf->Cell(30,5,utf8_decode('VENTAS AÑO'),0,1,'C');

  $codigos = $pos->traeProductos($idamb);

  $totingdia = 0;
  $totimpdia = 0;
  $totvendia = 0;
  $totingmes = 0;
  $totimpmes = 0;
  $totvenmes = 0;
  $totingani = 0;
  $totimpani = 0;
  $totvenani = 0;

  foreach ($codigos as $codigo) { 
    $pdf->Cell(50,6,utf8_decode(substr($codigo['nom'],0,30)),0,0,'L');

    $diavta     = $pos->getVentasDiaProducto($fecha,$codigo['producto_id'], $idamb);

    $mesvtaact  = $pos->getVentasMesProducto($anio, $mes, $codigo['producto_id'], $idamb);
    $aniovtahis = $pos->getVentasAnioProducto($anio,$codigo['producto_id'], $idamb);

    if(count($diavta)==0){$can = 0 ;}else{$can = $diavta[0]['can']; }
    if(count($diavta)==0){$impto = 0;}else{ $impto = $diavta[0]['impto']; }
    if(count($diavta)==0){$venta = 0;}else{ $venta = $diavta[0]['total']-$diavta[0]['descu']; }

    if(count($mesvtaact)==0){$carmes=0;}else{$carmes= $mesvtaact[0]['canmes'];}
    if(count($mesvtaact)==0){$impmes=0;}else{$impmes= $mesvtaact[0]['imptomes'];}
    if(count($mesvtaact)==0){$venmes=0;}else{$venmes= $mesvtaact[0]['totalmes']-$mesvtaact[0]['descumes'];}

    if(count($aniovtahis)==0){$carani=0;}else{$carani= $aniovtahis[0]['cananio'];}
    if(count($aniovtahis)==0){$impani=0;}else{$impani= $aniovtahis[0]['imptoanio'];}
    if(count($aniovtahis)==0){$venani=0;}else{$venani= $aniovtahis[0]['totalanio']-$aniovtahis[0]['descuanio'] ;}
    $pdf->Cell(20,6,number_format($can,0),0,0,'R');
    $pdf->Cell(20,6,number_format($impto,2),0,0,'R');
    $pdf->Cell(20,6,number_format($venta,2),0,0,'R');
    $pdf->Cell(20,6,number_format($carmes,0),0,0,'R');
    $pdf->Cell(25,6,number_format($impmes,2),0,0,'R');
    $pdf->Cell(25,6,number_format($venmes,2),0,0,'R');
    $pdf->Cell(20,6,number_format($carani,0),0,0,'R');
    $pdf->Cell(30,6,number_format($impani,2),0,0,'R');
    $pdf->Cell(30,6,number_format($venani,2),0,1,'R');

    $totingdia = $totingdia + $can; 
    $totimpdia = $totimpdia + $impto; 
    $totvendia = $totvendia + $venta; 
    $totingmes = $totingmes + $carmes;
    $totimpmes = $totimpmes + $impmes;
    $totvenmes = $totvenmes + $venmes; 
    $totingani = $totingani + $carani; 
    $totimpani = $totimpani + $impani;
    $totvenani = $totvenani + $venani; 

  }

  $pdf->Ln(3);
  $pdf->SetFont('Arial','B',9);

  $pdf->Cell(50,6,utf8_decode(substr('TOTAL INGRESOS',0,30)),0,0,'L');
  $pdf->Cell(20,6,number_format($totingdia,0),0,0,'R');
  $pdf->Cell(20,6,number_format($totimpdia,2),0,0,'R');
  $pdf->Cell(20,6,number_format($totvendia,2),0,0,'R');
  $pdf->Cell(20,6,number_format($totingmes,0),0,0,'R');
  $pdf->Cell(25,6,number_format($totimpmes,2),0,0,'R');
  $pdf->Cell(25,6,number_format($totvenmes,2),0,0,'R');
  $pdf->Cell(20,6,number_format($totingani,0),0,0,'R');
  $pdf->Cell(30,6,number_format($totimpani,2),0,0,'R');
  $pdf->Cell(30,6,number_format($totvenani,2),0,1,'R');

  $pdf->Ln(3);

  $file = '../../../imprimir/auditorias/acumuladoDiario_'.$pref.'_'.$fecha.'.pdf';
  $pdf->Output($file,'F');
?>
