<?php 
  require_once '../../res/fpdf/fpdf.php';

  $pdf = new FPDF();
  $pdf->AddPage('P','letter');
  $pdf->Image('../../img/'.LOGO,10,10,15);
  $pdf->SetFont('Arial','B',11);
  $pdf->Cell(195,6,$nomamb,0,1,'C');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(195,5,'NIT: '.NIT_EMPRESA,0,1,'C');
  $pdf->SetFont('Arial','B',11);
  $pdf->Cell(195,5,'ACUMULADO FORMAS DE PAGO  ',0,1,'C');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(195,4,'Fecha : '.$fecha,0,1,'C');
  $pdf->SetFont('Arial','B',10);
  $pdf->Ln(4);
  $pdf->Cell(60,5,'FORMA DE PAGO ',1,0,'C');
  $pdf->Cell(30,5,'VENTAS DIA',1,0,'C');
  $pdf->Cell(30,5,'VENTAS MES',1,0,'C');
  $pdf->Cell(30,5,utf8_decode('VENTAS AÑO'),1,1,'C');
  
  $pdf->SetFont('Arial','',9);
  $codigos = $pos->getFormasdePago();

  $sdia  = 0;
  $smes  = 0;
  $sanio = 0;
  foreach ($codigos as $codigo) { 
    $pdf->Cell(60,6,utf8_decode(substr($codigo['descripcion'],0,30)),0,0,'L');
    $pagodia  = $pos->getPagosDia($fecha,$codigo['id_pago'], $idamb);
    $pagomes  = $pos->getPagosMes($anio, $mes, $codigo['id_pago'], $idamb);
    $pagoanio = $pos->getPagosAnio($anio,$codigo['id_pago'], $idamb);

    if(count($pagodia)==0){$pdia = 0 ;}else{ $pdia = $pagodia[0]['total']; }
    if(count($pagomes)==0){$pmes = 0 ;}else{ $pmes = $pagomes[0]['total']; }
    if(count($pagoanio)==0){$panio = 0;}else{ $panio = $pagoanio[0]['total']; }
    
    $pdf->Cell(30,6,number_format($pdia,2),0,0,'R');
    $pdf->Cell(30,6,number_format($pmes,2),0,0,'R');
    $pdf->Cell(30,6,number_format($panio,2),0,1,'R');
    $sdia  = $sdia + $pdia; 
    $smes  = $smes + $pmes; 
    $sanio = $sanio + $panio; 
  }

  $pdf->Ln(3);
  $pdf->SetFont('Arial','B',10);

  $pdf->Cell(60,6,utf8_decode(substr('TOTAL PAGOS',0,30)),0,0,'L');
  $pdf->Cell(30,6,number_format($sdia,2),0,0,'R');
  $pdf->Cell(30,6,number_format($smes,2),0,0,'R');
  $pdf->Cell(30,6,number_format($sanio,2),0,1,'R');
  $pdf->Ln(3);
  $pdf->SetFont('Arial','',9);
  $file = '../imprimir/auditorias/acumuladoDiarioPagos_'.$pref.'_'.$fecha.'.pdf';
  $pdf->Output($file,'F');
?>
