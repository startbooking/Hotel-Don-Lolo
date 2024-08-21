<?php 
  require_once 'plantillaHuespedes.php';

  $pdf = new PDF();
  $pdf->AddPage('L','letter');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(270,5,('LISTADO DE COMPANIAS'),0,1,'C');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(270,5,'Fecha: '.FECHA_PMS,0,1,'C');
  $pdf->Ln(3);

  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(70,5,'Empresa',0,0,'C');
  $pdf->Cell(30,5,'Nit',0,0,'C');
  $pdf->Cell(70,5,'Direccion',0,0,'C');
  $pdf->Cell(30,5,'Telefono',0,0,'C');
  $pdf->Cell(60,5,'Correo Electronico',0,1,'C');
  $pdf->SetFont('Arial','',9);
  foreach ($companias as $compania) {
    $pdf->Cell(70,4,substr(($compania['empresa']),0,35),0,0,'L');
    $pdf->Cell(30,4,$compania['nit'].'-'.$compania['dv'],0,0,'R');
    $pdf->Cell(70,4,substr(($compania['direccion']),0,35),0,0,'L');
    $pdf->Cell(30,4,substr($compania['telefono'],0,12),0,0,'L');
    $pdf->Cell(60,4,$compania['email'],0,1,'L');
  }    
/* 
  $fileOut = '../../imprimir/informes/'.$file.'.pdf'; 
  $pdf->Output($fileOut,'F'); */
  
  $pdfFile = $pdf->Output('', 'S');
  $base64String = chunk_split(base64_encode($pdfFile));
  echo $base64String;

?>
