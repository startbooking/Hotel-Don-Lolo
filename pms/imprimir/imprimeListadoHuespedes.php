<?php 
  require_once 'plantillaHuespedes.php';

  $pdf = new PDF();
  $pdf->AddPage('L','letter');
  $pdf->SetFont('Arial','B',12);
  $pdf->Cell(270,5,utf8_decode('LISTADO DE HUESPEDES'),0,1,'C');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(270,5,'Fecha: '.FECHA_PMS,0,1,'C');
  $pdf->Ln(3);

  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(70,6,'Huesped',0,0,'C');
  $pdf->Cell(70,6,'Direccion',0,0,'C');
  $pdf->Cell(30,6,'Telefono',0,0,'C');
  $pdf->Cell(60,6,'Correo Electronico',0,0,'C');
  $pdf->Cell(30,6,'identificacion',0,1,'C');
  $pdf->SetFont('Arial','',9);
  foreach ($huespedes as $huesped) {
    $pdf->Cell(70,6,substr(utf8_decode($huesped['nombre_completo']),0,35),0,0,'L');
    $pdf->Cell(70,6,substr(utf8_decode($huesped['direccion']),0,40),0,0,'L');
    $pdf->Cell(30,6,$huesped['telefono'],0,0,'L');
    $pdf->Cell(60,6,$huesped['email'],0,0,'L');
    $pdf->Cell(30,6,$huesped['identificacion'],0,1,'R');
  }    

  $fileOut = '../../imprimir/informes/'.$file.'.pdf'; 

  $pdf->Output($fileOut,'F');

?>
