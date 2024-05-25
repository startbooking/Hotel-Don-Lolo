<?php 
  require_once 'plantillaHuespedes.php';

  $pdf = new PDF();
  $pdf->AddPage('L','letter');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(270,5,utf8_decode('LISTADO DE HUESPEDES'),0,1,'C');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(270,5,'Fecha: '.FECHA_PMS,0,1,'C');
  $pdf->Ln(1);

  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(70,5,'Huesped',0,0,'C');
  $pdf->Cell(70,5,'Direccion',0,0,'C');
  $pdf->Cell(30,5,'Telefono',0,0,'C');
  $pdf->Cell(60,5,'Correo Electronico',0,0,'C');
  $pdf->Cell(30,5,'identificacion',0,1,'C');
  $pdf->SetFont('Arial','',9);
  foreach ($huespedes as $huesped) {
    $pdf->Cell(70,4,substr(utf8_decode($huesped['nombre_completo']),0,35),0,0,'L');
    $pdf->Cell(70,4,substr(utf8_decode($huesped['direccion']),0,35),0,0,'L');
    $pdf->Cell(30,4,$huesped['telefono'],0,0,'L');
    $pdf->Cell(60,4,$huesped['email'],0,0,'L');
    $pdf->Cell(30,4,$huesped['identificacion'],0,1,'R');
  }    

  /*   
  $fileOut = '../../imprimir/informes/'.$file.'.pdf'; 
  $pdf->Output($fileOut,'F');

  */
 
  $pdfFile = $pdf->Output('', 'S');
  $base64String = chunk_split(base64_encode($pdfFile));

  echo $base64String;

 
 
?>
