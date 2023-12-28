<?php 
  $file      = $_POST['file'];
  $usuario   = $_POST['usuario'];
  $apellidos = $_POST['apellidos'];
  $nombres   = $_POST['nombres'];

  require_once '../../res/php/app_topHotel.php';
  require_once '../imprimir/plantillaFpdfFinanc.php';

  $pdf = new PDF();
  $pdf->AddPage('L','letter');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(260,5,'CARGOS DEL DIA POR USUARIO',0,1,'C');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(260,5,'Fecha : '.FECHA_PMS,0,1,'C');
  $pdf->Ln(2);

  $pdf->SetFont('Arial','B',10);
  $usuarios = $hotel->getUsuariosCargos(FECHA_PMS,1,0); 

  $mon   = 0;
  $imp   = 0;
  $tot   = 0;
  $monto = 0 ;
  $impto = 0 ;
  $total = 0 ;

  foreach ($usuarios as $usuario) {
    $pdf->Cell(20,5,'Usuario ',0,0,'L');
    $pdf->Cell(50,5,utf8_decode($usuario['usuario']),0,1,'L');
      
    $cargos = $hotel->getCargosdelDiaporcajero(FECHA_PMS,$usuario['usuario'],1,0);
    
    $pdf->Cell(10,5,'',0,0,'R');  
    $pdf->Cell(50,5,'Descripcion.',0,0,'C');
    $pdf->Cell(10,5,'Hab.',0,0,'R');
    $pdf->Cell(70,5,'Huesped',0,0,'C');
    $pdf->Cell(10,5,'Cant. ',0,0,'C');
    $pdf->Cell(25,5,'Monto',0,0,'C');
    $pdf->Cell(25,5,'Impuesto',0,0,'C');
    $pdf->Cell(25,5,'Total',0,0,'C');
    $pdf->Cell(15,5,'Hora',0,1,'C');
    $pdf->SetFont('Arial','',9);
    $monto  = 0 ;
    $impto  = 0 ;
    $total  = 0 ;
    foreach ($cargos as $cargo) {    
      $pdf->Cell(10,6,'',0,0,'L');
      $pdf->Cell(50,6,utf8_decode($cargo['descripcion_cargo']),0,0,'');
      $pdf->Cell(10,6,$cargo['habitacion_cargo'],0,0,'R');
      $pdf->Cell(70,6,substr(utf8_decode($cargo['apellido1'].' '.$cargo['apellido2'].' '.$cargo['nombre1'].' '.$cargo['nombre2']),0,22),0,0,'L');
      $pdf->Cell(10,6,$cargo['cantidad_cargo'],0,0,'C');
      $pdf->Cell(25,6,number_format($cargo['monto_cargo'],2),0,0,'R');
      $pdf->Cell(25,6,number_format($cargo['impuesto'],2),0,0,'R');
      $pdf->Cell(25,6,number_format($cargo['monto_cargo']+$cargo['impuesto'],2),0,0,'R');
      $pdf->Cell(10,6,substr($cargo['fecha_sistema_cargo'],11,5),0,1,'R'); 
      $monto  = $monto + $cargo['monto_cargo'];
      $impto  = $impto + $cargo['impuesto'];
      $total  = $total + $cargo['monto_cargo'] + $cargo['impuesto'];        
    }
    $mon  = $mon + $monto;
    $imp  = $imp + $impto;
    $tot  = $tot + $total;        

    $pdf->Ln(2);
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(40,6,'Total Cargos Cajero',0,0,'L');
    $pdf->Cell(110,6,utf8_decode($usuario['usuario']),0,0,'L');
    $pdf->Cell(25,6,number_format($monto,2),0,0,'R');
    $pdf->Cell(25,6,number_format($impto,2),0,0,'R');
    $pdf->Cell(25,6,number_format($total,2),0,1,'R');
    $pdf->Ln(3);
  }
  $pdf->Ln(2);
  $pdf->SetFont('Arial','B',9); 
  $pdf->Cell(150,6,'Total Cargos Del Dia',0,0,'L');
  $pdf->Cell(25,6,number_format($mon,2),0,0,'R');
  $pdf->Cell(25,6,number_format($imp,2),0,0,'R');
  $pdf->Cell(25,6,number_format($tot,2),0,1,'R');
  $pdf->Ln(3);


  $fileOut = '../imprimir/informes/'.$file.'.pdf'; 
  $pdf->Output($fileOut,'F');
  echo $file.'.pdf';
?>
