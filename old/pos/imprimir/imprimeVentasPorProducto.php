<?php 

  $ventas   = $pos->getTotalProductosVendidos($idamb);
  $cantidad = $pos->getCantidadProductosVendidos($idamb);

  if(count($cantidad)==0){
    $canProd = 0;
    $valProd = 0;
    $perProd = 0;
  }else{    
    $canProd = $cantidad[0]['cant'];
    $valProd = $cantidad[0]['ventas'];
    $perProd = $cantidad[0]['pers'];
  }

  require_once '../../res/fpdf/fpdf.php';

  $pdf = new FPDF();
  $pdf->AddPage('P','letter');
  $pdf->Image('../../img/'.$logo,10,10,15);
  $pdf->SetFont('Arial','B',13);
  
  $pdf->Cell(190,7,utf8_decode(NAME_EMPRESA),0,1,'C');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(190,5,'NIT: '.NIT_EMPRESA,0,1,'C');
  /*
  $pdf->Cell(190,5,TIPOEMPRESA,0,1,'C');
  $pdf->Cell(190,5,utf8_decode(ADRESS_EMPRESA),0,1,'C');
  $pdf->Cell(190,5,utf8_decode(CIUDAD_EMPRESA).' '.PAIS_EMPRESA,0,1,'C');
  $pdf->Cell(40,5,'',0,0,'C');
  $pdf->Cell(110,5,'Telefono '.TELEFONO_EMPRESA.' Movil '.CELULAR_EMPRESA,0,1,'C');
  */
  $pdf->SetFont('Arial','B',11);
  /// $pdf->Cell(190,6,$_SESSION['NOMBRE_AMBIENTE'],0,1,'C');
  $pdf->Cell(190,6,$nomamb,0,1,'C');

  $pdf->Ln(1);
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(195,6,'VENTAS POPULARIDAD DE PRODUCTOS '.$fecha,0,1,'C');
  $pdf->Ln(2);

  $pdf->SetFont('Arial','',9);

  $monto   = 0 ;
  $impto   = 0 ;
  $total   = 0 ;
  $valprod = 0;
  $descuen = 0;
  $canti   = 0;
  if(count($ventas)==0){
    $pdf->Ln(2);
    $pdf->Cell(190,5,'SIN PRODUCTOS VENDIDOS EN EL DIA',0,0,'C');
    $pdf->Ln(2);
  }else{
    $pdf->Cell(60,6,'Producto.',1,0,'C');
    $pdf->Cell(20,6,'Cantidad ',1,0,'C');
    $pdf->Cell(20,6,'Valor. ',1,0,'C');
    $pdf->Cell(20,6,'Descuento. ',1,0,'C');
    $pdf->Cell(20,6,'Impuesto. ',1,0,'C');
    $pdf->Cell(20,6,'Total. ',1,0,'C');
    $pdf->Cell(20,6,'% Cant. ',1,0,'C');
    $pdf->Cell(20,6,'% Valor. ',1,1,'C');
    foreach ($ventas as $comanda) {
      $pdf->Cell(60,5,substr(utf8_decode($comanda['nom']),0,32),0,0,'L');
      $pdf->Cell(20,5,$comanda['cant'],0,0,'C');
      $pdf->Cell(20,5,number_format($comanda['ventas'],2),0,0,'R');
      $pdf->Cell(20,5,number_format($comanda['descuento'],2),0,0,'R');
      $pdf->Cell(20,5,number_format($comanda['imptos'],2),0,0,'R');
      $pdf->Cell(20,5,number_format($comanda['total'],2),0,0,'R');
      $pdf->Cell(20,5,number_format(($comanda['cant']/$canProd)*100,2),0,0,'R');
      $pdf->Cell(20,5,number_format(($comanda['ventas']/$valProd)*100,2),0,1,'R');
      $valprod = $valprod+ $comanda['ventas'];
      $descuen = $descuen+ $comanda['descuento'];
      $canti   = $canti+ $comanda['cant'];
      $monto   = $monto+ $comanda['ventas'];
      $impto   = $impto+ $comanda['imptos'];
      $total   = $total+ $comanda['total'];
    }
    $pdf->Ln(2);
    $pdf->Cell(60,6,'Total ',1,0,'L');
    $pdf->Cell(20,6,number_format($canti,0),1,0,'R');
    $pdf->Cell(20,6,number_format($monto,2),1,0,'R');
    $pdf->Cell(20,6,number_format($descuen,2),1,0,'R');
    $pdf->Cell(20,6,number_format($impto,2),1,0,'R');
    $pdf->Cell(20,6,number_format($total-$descuen,2),1,1,'R');
  }
  $pdf->Ln(3);

  $file = '../imprimir/informes/ventasProductos_'.$file.'.pdf';

  $pdf->Output($file,'F');
?>
