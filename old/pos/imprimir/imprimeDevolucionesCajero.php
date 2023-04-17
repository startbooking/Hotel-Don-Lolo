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
  $pdf->SetFont('Arial','B',13);
   */
  $pdf->Cell(190,6,$nomamb,0,1,'C');
  $pdf->SetFont('Arial','B',11);
  $pdf->Cell(190,6,'DEVOLUCION DE PRODUCTOS ',0,1,'C');
  $pdf->Cell(190,6,'USUARIO '.$user.' FECHA '.$fecha,0,1,'C');
  $devoluciones = $pos->getDevolucionUsuario($idamb,$user);

  $monto  = 0 ;
  $impto  = 0 ;
  $total  = 0 ;

  if(count($devoluciones)==0){
    $pdf->Ln(2);
    $pdf->Cell(190,5,'SIN DEVOLUCION DE PRODUCTOS ',0,0,'C');
 
    $pdf->Ln(2);

  }else{
    $pdf->Ln(2);
    $pdf->Cell(20,6,'Comanda.',1,0,'C');
    $pdf->Cell(20,6,'Mesa ',1,0,'C');
    $pdf->Cell(70,6,'Producto. ',1,0,'C');
    $pdf->Cell(20,6,'Cantidad',1,0,'C');
    $pdf->Cell(65,6,'Motivo Devolucion',1,1,'C');
    $pdf->SetFont('Arial','',9);
    foreach ($devoluciones as $comanda) {
      $pdf->Cell(20,5,$comanda['comanda'],1,0,'C');
      $pdf->Cell(20,5,$comanda['mesa'],1,0,'C');
      $pdf->Cell(70,5,$comanda['nom'],1,0,'L');
      $pdf->Cell(20,5,$comanda['cant'],1,0,'C');
      $pdf->Cell(65,5,$comanda['motivo_devo'],1,1,'L');
    }
  }
  $pdf->Ln(3);

  $file = '../imprimir/informes/'.$file.'.pdf';
  $pdf->Output($file,'F');