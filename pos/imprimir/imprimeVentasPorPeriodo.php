<?php 

  $periodos = $pos->getVentasPeriodosDia($idamb);
  
  require_once '../../res/fpdf/fpdf.php';

  $pdf = new FPDF();
  $pdf->AddPage('P','letter');
  $pdf->Image('../../img/'.LOGO,10,10,22);
  $pdf->SetFont('Arial','B',11);
  $pdf->Cell(195,5,$_SESSION['NOMBRE_AMBIENTE'],0,1,'C');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(195,5,'NIT: '.NIT_EMPRESA,0,1,'C');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(195,5,'VENTAS POR PERIODOS DE SERVICIO ',0,1,'C');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(195,5,'Fecha : '.$fecha,0,1,'C');
  $pdf->Ln(2);

  $monto   = 0 ;
  $impto   = 0 ;
  $total   = 0 ;
  $valprod = 0;
  $canti   = 0;
  $descu   = 0;
  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(90,6,'Periodo',1,0,'C');
  $pdf->Cell(25,6,'Valor ',1,0,'C');
  $pdf->Cell(25,6,'Descuento ',1,0,'C');
  $pdf->Cell(25,6,'Impuesto ',1,0,'C');
  $pdf->Cell(25,6,'Total ',1,1,'C');
  $pdf->SetFont('Arial','',9);
  if(count($periodos)==0){
    $pdf->Cell(190,5,'SIN PRODUCTOS VENDIDOS EN EL DIA',1,1,'C');
  }else{
    foreach ($periodos as $comanda) {
      $pdf->Cell(90,4,utf8_decode($comanda['descripcion_periodo']),0,0,'L');
      $pdf->Cell(25,4,number_format($comanda['ventas'],2),0,0,'R');
      $pdf->Cell(25,4,number_format($comanda['descu'],2),0,0,'R');
      $pdf->Cell(25,4,number_format($comanda['imptos'],2),0,0,'R');
      $pdf->Cell(25,4,number_format($comanda['total'],2),0,1,'R');
      $valprod = $valprod+ $comanda['ventas'];
      $monto   = $monto+ $comanda['ventas'];
      $descu   = $descu+ $comanda['descu'];
      $impto   = $impto+ $comanda['imptos'];
      $total   = $total+ $comanda['total'];
    }
    $pdf->Ln(2);
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(90,6,'Total ',1,0,'L');
    $pdf->Cell(25,6,number_format($monto,2),1,0,'R');
    $pdf->Cell(25,6,number_format($descu,2),1,0,'R');
    $pdf->Cell(25,6,number_format($impto,2),1,0,'R');
    $pdf->Cell(25, 6, number_format($monto+$impto-$descu, 2), 1, 1, 'R');
  }
  $pdf->Ln(3);

  $pdfFile = $pdf->Output('', 'S');
  $base64String = chunk_split(base64_encode($pdfFile));
  echo $base64String;