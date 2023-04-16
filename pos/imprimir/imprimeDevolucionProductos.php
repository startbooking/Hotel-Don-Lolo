<?php 

  $productos   = $pos->getDevolucionProductos($idamb);

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
  $pdf->SetFont('Arial','B',13);
  $pdf->Cell(195,6,$nomamb,0,1,'C');
  /// $pdf->Cell(190,6,$_SESSION['NOMBRE_AMBIENTE'],0,1,'C');

  $pdf->Ln(1);
  $pdf->SetFont('Arial','',13);
  $pdf->Cell(195,8,'DEVOLUCION PRODUCTOS '.$fecha,0,1,'C');
  $pdf->Ln(2);

  $pdf->SetFont('Arial','',9);

  $monto   = 0 ;
  $impto   = 0 ;
  $total   = 0 ;
  $valprod = 0;
  $canti   = 0;
  if(count($productos)==0){
    $pdf->Ln(2);
    $pdf->Cell(190,5,'SIN PRODUCTOS DEVUELTOS EN EL DIA',0,0,'C');
    $pdf->Ln(2);
  }else{
    $pdf->Cell(20,6,'Comanda.',0,0,'C');
    $pdf->Cell(60,6,'Producto.',0,0,'C');
    $pdf->Cell(20,6,'Cantidad ',0,0,'C');
    $pdf->Cell(70,6,'Motivo Devolucion ',0,0,'C');
    $pdf->Cell(25,6,'Usuario ',0,1,'C');
   
    foreach ($productos as $comanda) {
      $pdf->Cell(20,5,$comanda['comanda'],0,0,'R');
      $pdf->Cell(60,5,utf8_decode($comanda['nom']),0,0,'L');
      $pdf->Cell(20,5,$comanda['cant'],0,0,'C');
      $pdf->Cell(70,5,$comanda['motivo_devo'],0,0,'L');
      $pdf->Cell(25,5,$comanda['usuario_devo'],0,1,'L');
    }
  }
  $pdf->Ln(3);

  $files = '../imprimir/informes/devolucionProductos_'.$file.'.pdf';

  $pdf->Output($files,'F');
?>
