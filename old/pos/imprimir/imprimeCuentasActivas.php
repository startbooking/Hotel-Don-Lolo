<?php 

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
  /// $pdf->Cell(190,6,$_SESSION['NOMBRE_AMBIENTE'],0,1,'C');
  $pdf->Cell(195,6,$nomamb,0,1,'C');

  $pdf->Ln(1);
  $pdf->SetFont('Arial','B',11);
  $pdf->Cell(195,5,'COMANDAS ACTIVAS ',0,1,'C');
  $pdf->Cell(195,5,$fecha,0,1,'C');
  $pdf->Ln(2);
  $pdf->Ln(2);
  $pdf->Cell(20,6,'Comanda.',0,0,'C');
  $pdf->Cell(20,6,'Mesa ',0,0,'C');
  $pdf->Cell(20,6,'PAX. ',0,0,'C');
  $pdf->Cell(40,6,'Usuario',0,0,'C');
  $pdf->Cell(10,6,'Hora',0,1,'C');
  $pdf->SetFont('Arial','',9);

  $comandas = $pos->getComandasActivas($idamb,'A');

  $monto  = 0 ;
  $impto  = 0 ;
  $total  = 0 ;
  if(count($comandas)==0){
    $pdf->Ln(2);
    $pdf->Cell(190,5,'SIN COMANDAS ACTIVAS',0,0,'C');
    $pdf->Ln(2);

  }else{
    foreach ($comandas as $comanda) {
      $pdf->Cell(20,5,$comanda['comanda'],0,0,'C');
      $pdf->Cell(20,5,$comanda['mesa'],0,0,'C');
      $pdf->Cell(20,5,$comanda['pax'],0,0,'C');
      $pdf->Cell(40,5,$comanda['usuario'],0,0,'R');
      $pdf->Cell(10,5,substr($comanda['fecha'],11,5),0,1,'R');
    }
  }
  $pdf->Ln(3);

  $file = '../imprimir/informes/cuentasActivas_'.$file.'.pdf';

  $pdf->Output($file,'F');
?>
