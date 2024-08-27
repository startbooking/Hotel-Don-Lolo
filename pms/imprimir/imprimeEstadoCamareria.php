<?php 
  require '../../res/php/app_topHotel.php'; 
  require 'plantillaHK.php';


  $file = $_POST['file'];

  $pdf = new PDF();
  $pdf->AddPage();

  $habitaciones = $hotel->informeCamareria(FECHA_PMS);

  // echo print_r($habitaciones);

  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(195,4,strtoupper('Reporte Camareria Hotel'),0,1,'C');
  $pdf->Cell(195,4,'Fecha :'.FECHA_PMS,0,0,'C');
  $pdf->Ln(5);
  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(15,5,'Nro Hab.',1,0,'C');
  $pdf->Cell(25,5,'Tipo Habitacion',1,0,'C');
  $pdf->Cell(50,5,'Camarera',1,0,'C');
  $pdf->Cell(80,5,'Observaciones',1,0,'C');
  $pdf->Cell(20,5,'Hora',1,1,'C');
  $pdf->SetFont('Arial','',9);
  
  foreach ($habitaciones as $habitacion) {
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(15,4,$habitacion['numero_hab'],1,0,'C');
    $pdf->SetFont('Arial','',9);
    $pdf->Cell(25,4,trim(substr($habitacion['descripcion_habitacion'].' '.$habitacion['caracteristicas'],strpos(($habitacion['descripcion_habitacion'].' '.$habitacion['caracteristicas']),' '))),1,0,'L');
    $pdf->Cell(50,4,substr($habitacion['apellidosCamarera'].' '.$habitacion['nombresCamarera'],0,26),1,0,'L');
    if($habitacion['observaciones'] != ''){
      $pdf->Cell(80,4,substr($habitacion['observaciones'],0,35),1,0,'L');
    }else{
      $pdf->Cell(80,4,'',1,0,'L');
    }
    if($habitacion['fecha'] != ''){
      $pdf->Cell(20,4,substr($habitacion['fecha'],11,8),1,1,'R');
    }else{
      $pdf->Cell(20,4,'',1,1,'L');
    }
    

  }
  
  $pdfFile = $pdf->Output('', 'S');
  $base64String = chunk_split(base64_encode($pdfFile));

  echo $base64String;
  
?>
