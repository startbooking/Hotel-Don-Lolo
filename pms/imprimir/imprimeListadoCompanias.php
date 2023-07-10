<?php 
  require_once 'plantillaHuespedes.php';

  $pdf = new PDF();
  $pdf->AddPage('L','letter');
  $pdf->SetFont('Arial','B',12);
  $pdf->Cell(270,5,utf8_decode('LISTADO DE COMPANIAS'),0,1,'C');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(270,5,'Fecha: '.FECHA_PMS,0,1,'C');
  $pdf->Ln(3);

  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(70,6,'Empresa',0,0,'C');
  $pdf->Cell(30,6,'Nit',0,0,'C');
  $pdf->Cell(70,6,'Direccion',0,0,'C');
  $pdf->Cell(30,6,'Telefono',0,0,'C');
  $pdf->Cell(60,6,'Correo Electronico',0,1,'C');
  $pdf->SetFont('Arial','',9);
  foreach ($companias as $compania) {
    $pdf->Cell(70,6,substr(utf8_decode($compania['empresa']),0,35),0,0,'L');
    $pdf->Cell(30,6,$compania['nit'].'-'.$compania['dv'],0,0,'R');
    $pdf->Cell(70,6,substr(utf8_decode($compania['direccion']),0,35),0,0,'L');
    $pdf->Cell(30,6,$compania['telefono'],0,0,'L');
    $pdf->Cell(60,6,$compania['email'],0,1,'L');
  }    

  $fileOut = '../../imprimir/informes/'.$file.'.pdf'; 

  $pdf->Output($fileOut,'F');

?>
