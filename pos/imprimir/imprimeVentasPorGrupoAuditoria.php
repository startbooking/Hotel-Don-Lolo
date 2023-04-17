<?php 
  require_once '../../res/fpdf/fpdf.php';

  $ventas   = $pos->getTotalGruposVendidos($idamb);
  $cantidad = $pos->getCantidadProductosVendidos($idamb);

  if(count($cantidad)!=0){
    $canProd = $cantidad[0]['cant'];
    $valProd = $cantidad[0]['ventas'];
    $perProd = $cantidad[0]['pers'];
  }else{
    $canProd = 0;
    $valProd = 0;
    $perProd = 0;
  }

  $pdf = new FPDF();
  $pdf->AddPage('P','letter');
  $pdf->Image('../../img/'.LOGO,10,10,15);
  $pdf->SetFont('Arial','B',12);
  $pdf->Cell(190,6,$nomamb,0,1,'C');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(190,5,'NIT: '.NIT_EMPRESA,0,1,'C');
  
  $pdf->Ln(1);
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(195,5,'VENTAS GRUPOS DE PRODUCTOS '.$fecha,0,1,'C');
  $pdf->Ln(2);

  $monto  = 0 ;
  $impto  = 0 ;
  $total  = 0 ;
  $valprod = 0;
  $canti = 0;
  if(count($ventas)==0){
    $pdf->Ln(2);
    $pdf->Cell(190,6,'SIN PRODUCTOS VENDIDOS EN EL DIA',1,1,'C');
    $pdf->Ln(2);

  }else{
    $pdf->Cell(60,6,'Grupo Productos',1,0,'C');
    $pdf->Cell(20,6,'Cantidad ',1,0,'C');
    $pdf->Cell(25,6,'Valor. ',1,0,'C');
    $pdf->Cell(25,6,'Impuesto. ',1,0,'C');
    $pdf->Cell(25,6,'Total. ',1,0,'C');
    $pdf->Cell(20,6,'% Cant. ',1,0,'C');
    $pdf->Cell(20,6,'% Valor. ',1,1,'C');
    $pdf->SetFont('Arial','',10);
    foreach ($ventas as $comanda) {
      $pdf->Cell(60,5,utf8_decode($comanda['nombre_seccion']),0,0,'L');
      $pdf->Cell(20,5,$comanda['cant'],0,0,'C');
      $pdf->Cell(25,5,number_format($comanda['ventas'],2),0,0,'R');
      $pdf->Cell(25,5,number_format($comanda['imptos'],2),0,0,'R');
      $pdf->Cell(25,5,number_format($comanda['total'],2),0,0,'R');
      $pdf->Cell(20,5,number_format(($comanda['cant']/$canProd)*100,2),0,0,'R');
      $pdf->Cell(20,5,number_format(($comanda['ventas']/$valProd)*100,2),0,1,'R');
      $valprod = $valprod+ $comanda['ventas'];
      $canti   = $canti+ $comanda['cant'];
      $monto   = $monto+ $comanda['ventas'];
      $impto   = $impto+ $comanda['imptos'];
      $total   = $total+ $comanda['total'];

    }
    $pdf->Ln(2);
    $pdf->Cell(60,6,'Total ',1,0,'L');
    $pdf->Cell(20,6,number_format($canti,0),1,0,'R');
    $pdf->Cell(25,6,number_format($monto,2),1,0,'R');
    $pdf->Cell(25,6,number_format($impto,2),1,0,'R');
    $pdf->Cell(25,6,number_format($total,2),1,1,'R');
  }
  $pdf->Ln(3);

  $file = '../imprimir/auditorias/ventasGrupos_'.$pref.'_'.$fecha.'.pdf';

  $pdf->Output($file,'F');
?>
