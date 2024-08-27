<?php 

  $ventas   = $pos->getVentasPorCliente($idamb);
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
  $pdf->SetFont('Arial','B',12);
  $pdf->Cell(190,6,$nomamb,0,1,'C');

  $pdf->Ln(1);
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(195,5,'VENTAS DEL DIA POR CLIENTE '.$fecha,0,1,'C');
  $pdf->Ln(2);

  $pdf->SetFont('Arial','B',10);

  $monto   = 0 ;
  $impto   = 0 ;
  $total   = 0 ;
  $valprod = 0 ;
  $canti   = 0 ;
  $descu   = 0 ;
  $propina = 0 ;
  if(count($ventas)==0){
    $pdf->Ln(2);
    $pdf->Cell(190,5,'SIN PRODUCTOS VENDIDOS EN EL DIA',0,0,'C');
    $pdf->Ln(2);

  }else{
    $pdf->Cell(70,6,'Cliente',1,0,'C');
    $pdf->Cell(10,6,'Cant. ',1,0,'C');
    $pdf->Cell(25,6,'Valor ',1,0,'C');
    $pdf->Cell(20,6,'Desc. ',1,0,'C');
    $pdf->Cell(20,6,'Impuesto ',1,0,'C');
    $pdf->Cell(25,6,'Propina ',1,0,'C');
    $pdf->Cell(25,6,'Total. ',1,1,'C');
    $pdf->SetFont('Arial','',9);
    foreach ($ventas as $comanda) {
      $pdf->Cell(70,5,substr(utf8_decode($comanda['apellido1'].' '.$comanda['apellido2'].' '.$comanda['nombre1'].' '.$comanda['nombre2']),0,35),0,0,'L');
      $pdf->Cell(10,5,$comanda['cant'],0,0,'R');
      $pdf->Cell(25,5,number_format($comanda['neto'],2),0,0,'R');
      $pdf->Cell(20,5,number_format($comanda['descto'],2),0,0,'R');
      $pdf->Cell(20,5,number_format($comanda['imptos'],2),0,0,'R');
      $pdf->Cell(25,5,number_format($comanda['propina'],2),0,0,'R');
      $pdf->Cell(25,5,number_format($comanda['total'],2),0,1,'R');
      $canti   = $canti+ $comanda['cant'];
      $monto   = $monto+ $comanda['neto'];
      $descu   = $descu+ $comanda['descto'];
      $impto   = $impto+ $comanda['imptos'];
      $propina = $propina+ $comanda['propina'];
      $total   = $total+ $comanda['total'];

    }
    $pdf->Ln(2);
    $pdf->Cell(70,6,'Total ',1,0,'L');
    $pdf->Cell(10,6,number_format($canti,0),1,0,'R');
    $pdf->Cell(25,6,number_format($monto,2),1,0,'R');
    $pdf->Cell(20,6,number_format($descu,2),1,0,'R');
    $pdf->Cell(20,6,number_format($impto,2),1,0,'R');
    $pdf->Cell(25,6,number_format($propina,2),1,0,'R');
    $pdf->Cell(25,6,number_format($total,2),1,1,'R');
  }
  $pdf->Ln(3);

  $file = '../imprimir/informes/'.$file.'.pdf';

  $pdf->Output($file,'F');
?>
