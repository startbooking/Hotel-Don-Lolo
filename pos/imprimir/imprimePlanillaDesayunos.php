<?php 
  require_once '../../res/php/app_topPos.php';
  require_once '../../res/fpdf/fpdf.php';

  $postBody = json_decode(file_get_contents('php://input'), true);
  extract($postBody);

  $pdf = new FPDF(); 
  $pdf->AddPage('P', 'letter');
  $pdf->Image('../../img/'.$logo, 10, 10, 22);
  $pdf->SetFont('Arial', 'B', 11);
  $pdf->Cell(195, 5, $nombre, 0, 1, 'C');
  $pdf->SetFont('Arial', '', 10);
  // $pdf->Ln(2);
  $pdf->Cell(190,5,'PLANILLA DESAYUNOS',0,1,'C');
  // $pdf->SetFont('Arial','',11);
  $pdf->Cell(190,5,'Fecha : '.$fecha_auditoria,0,1,'C');
  $pdf->Cell(190,5,'Usuario : '.$usuario,0,1,'C');
  $pdf->Ln(3);

  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(15,5,'Hab.',1,0,'C');
  $pdf->Cell(100,5,'Huesped',1,0,'C');
  $pdf->Cell(25,5,'Llegada',1,0,'C');
  $pdf->Cell(25,5,'Salida',1,0,'C');
  $pdf->Cell(25,5,'Estado',1,1,'C');
  $pdf->SetFont('Arial','',9);
  $des = 0;
  $nod = 0;
  $hue = 0;

  if(count($huespedes)==0){
      $pdf->Cell(190,5,'SIN DATOS DE HUESPEDES DESAYUNANDO ',0,0,'C');    
  }else{
    foreach ($huespedes as $reserva) {
      $pdf->Cell(15,4,$reserva['num_habitacion'],0,0,'C'); 
      $pdf->Cell(100,4,substr(($reserva['nombre_completo']),0,50),0,0,'L');
      $pdf->Cell(25,4,$reserva['fecha_llegada'],0,0,'L');
      $pdf->Cell(25,4,$reserva['fecha_salida'],0,0,'L');
      $pdf->Cell(25,4,estadoDesayunos($reserva['estado']),0,1,'L');
      $hue = $hue +1 ;
      if($reserva['estado']=='0'){
        $nod = $nod +1 ;
      }else{
        $des = $des +1;
      }
    }
  }

  $pdf->Ln(3);

  $pdf->Cell(30,5,'Total Huespedes',1,0,'L');
  $pdf->Cell(20,5,$hue,1,0,'C');
  $pdf->Cell(30,5,'Desayunaron ',1,0,'L');
  $pdf->Cell(20,5,$des,1,0,'C');
  $pdf->Cell(30,5,'No Desayunaron ',1,0,'L');
  $pdf->Cell(20,5,$nod,1,0,'C');

  $file = '../impresiones/planillaDesayunos_'.$prefijo.'-'.$fecha_auditoria.'.pdf';

  $pdf->Output($file,'F');
  echo $file;
?>
