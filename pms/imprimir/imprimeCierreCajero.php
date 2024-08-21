<?php 

  require_once 'plantillaCierreCajero.php';

  $user     = $usuario;
  $datosUsr = $hotel->getDataUser($user);
  
  $pdf      = new PDF();
  $pdf->AddPage('P','letter');
  $pdf->SetFont('Arial','B',13);
  $pdf->Cell(195,5,'CIERRE CAJERO '.$user.' '.FECHA_PMS,0,1,'C');
  $pdf->Ln(2);

  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(30,6,'Usuario ',0,0,'L');
  $pdf->Cell(50,6,$datosUsr[0]['apellidos'].' '.$datosUsr[0]['nombres'],0,1,'C');
  $pdf->Ln(1);
  $pdf->Cell(195,5,'CARGOS DEL DIA '.FECHA_PMS,0,1,'C');
  $pdf->Cell(10,6,'Hab.',0,0,'C');
  $pdf->Cell(50,6,'Huesped',0,0,'C');
  $pdf->Cell(40,6,'Descripcion ',0,0,'C');
  $pdf->Cell(10,6,'Cant. ',0,0,'C');
  $pdf->Cell(25,6,'Monto',0,0,'C');
  $pdf->Cell(25,6,'Impuesto',0,0,'C');
  $pdf->Cell(25,6,'Total',0,0,'C');
  $pdf->Cell(10,6,'Hora',0,1,'C');
  $pdf->SetFont('Arial','',9);
  $cargos = $hotel->getCargosdelDiaporcajero(FECHA_PMS,$user,1,0); 
  $monto  = 0 ;
  $impto  = 0 ;
  $total  = 0 ;
  foreach ($cargos as $cargo) {
    $pdf->Cell(10,6,$cargo['habitacion_cargo'],0,0,'L');
    $pdf->Cell(50,6,substr(($cargo['apellido1'].' '.$cargo['apellido2'].' '.$cargo['nombre1'].' '.$cargo['nombre2']),0,24),0,0,'L');
    $pdf->Cell(40,6,substr(($cargo['descripcion_cargo']),0,19),0,0,'L');
    $pdf->Cell(10,6,$cargo['cantidad_cargo'],0,0,'C');
    $pdf->Cell(25,6,number_format($cargo['monto_cargo'],2),0,0,'R');
    $pdf->Cell(25,6,number_format($cargo['impuesto'],2),0,0,'R');
    $pdf->Cell(25,6,number_format($cargo['monto_cargo']+$cargo['impuesto'],2),0,0,'R');
    $pdf->Cell(10,6,substr($cargo['fecha_sistema_cargo'],11,5),0,1,'R'); 
    $monto  = $monto + $cargo['monto_cargo'];
    $impto  = $impto + $cargo['impuesto'];
    $total  = $total + $cargo['monto_cargo'] + $cargo['impuesto'];        
  }
  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(110,6,'Total cargos Por Cajero ',0,0,'L');
  $pdf->Cell(25,6,number_format($monto,2),0,0,'R');
  $pdf->Cell(25,6,number_format($impto,2),0,0,'R');
  $pdf->Cell(25,6,number_format($total,2),0,1,'R');
  $pdf->Ln(3);
  $pdf->Cell(195,5,'CARGOS ANULADOS DEL DIA '.FECHA_PMS,0,1,'C');
  $pdf->Ln(2);
  $pdf->Cell(10,6,'Hab.',0,0,'C');
  $pdf->Cell(40,6,'Descripcion ',0,0,'C');
  $pdf->Cell(10,6,'Cant. ',0,0,'C');
  $pdf->Cell(25,6,'Monto',0,0,'C');
  $pdf->Cell(25,6,'Impuesto',0,0,'C');
  $pdf->Cell(25,6,'Total',0,0,'C');
  $pdf->Cell(50,6,'Motivo An',0,0,'C');
  $pdf->Cell(10,6,'Hora',0,1,'C');
  $pdf->SetFont('Arial','',9);
  $cargos = $hotel->getCargosAnuladosdelDiaporcajero(FECHA_PMS,$user,1,1); 
  $monto  = 0 ;
  $impto  = 0 ;
  $total  = 0 ;
  foreach ($cargos as $cargo) {
    $pdf->Cell(10,6,$cargo['habitacion_cargo'],0,0,'L');
    $pdf->Cell(40,6,substr(($cargo['descripcion_cargo']),0,19),0,0,'L');
    $pdf->Cell(10,6,$cargo['cantidad_cargo'],0,0,'C');
    $pdf->Cell(25,6,number_format($cargo['monto_cargo'],2),0,0,'R');
    $pdf->Cell(25,6,number_format($cargo['impuesto'],2),0,0,'R');
    $pdf->Cell(25,6,number_format($cargo['monto_cargo']+$cargo['impuesto'],2),0,0,'R');
    $pdf->Cell(50,6,$cargo['motivo_anulacion'],0,0,'L');
    $pdf->Cell(10,6,substr($cargo['fecha_sistema_cargo'],11,5),0,1,'R'); 
    $monto  = $monto + $cargo['monto_cargo'];
    $impto  = $impto + $cargo['impuesto'];
    $total  = $total + $cargo['monto_cargo'] + $cargo['impuesto'];        
  }
  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(110,6,'Total Cargos Anulados Cajero ',0,0,'L');
  $pdf->Cell(25,6,number_format($monto,2),0,0,'R');
  $pdf->Cell(25,6,number_format($impto,2),0,0,'R');
  $pdf->Cell(25,6,number_format($total,2),0,1,'R');
  $pdf->Ln(3);

  $pdf->Cell(195,5,'PAGOS DEL DIA '.FECHA_PMS,0,1,'C');
  $pdf->Cell(10,6,'Hab.',0,0,'C');
  $pdf->Cell(50,6,'Huesped',0,0,'C');
  $pdf->Cell(40,6,'Descripcion ',0,0,'C');
  $pdf->Cell(25,6,'Valor',0,0,'C');
  $pdf->Cell(10,6,'Cons.',0,0,'C');
  $pdf->Cell(10,6,'Hora',0,1,'C');
  $pdf->SetFont('Arial','',9);
  $cargos = $hotel->getCargosdelDiaporcajero(FECHA_PMS,$user,3,0); 
  $pagos  = 0 ;
  foreach ($cargos as $cargo) {
    $pdf->Cell(10,6,$cargo['habitacion_cargo'],0,0,'L');
    $pdf->Cell(50,6,substr($cargo['apellido1'].' '.$cargo['apellido2'].' '.$cargo['nombre1'].' '.$cargo['nombre2'],0,24),0,0,'L');
    $pdf->Cell(40,6,substr(($cargo['descripcion_cargo']),0,19),0,0,'L');
    $pdf->Cell(25,6,number_format($cargo['pagos_cargos'],2),0,0,'R');
    $pdf->Cell(10,6,$cargo['concecutivo_abono'],0,0,'R'); 
    $pdf->Cell(10,6,substr($cargo['fecha_sistema_cargo'],11,5),0,1,'R'); 
    $pagos  = $pagos + $cargo['pagos_cargos'];

  }
  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(100,6,'Total Pagos Por Cajero ',0,0,'L');
  $pdf->Cell(25,6,number_format($pagos,2),0,1,'R');
  $pdf->Ln(5);
  $pdf->Cell(195,5,'PAGOS ANULADOS DEL DIA '.FECHA_PMS,0,1,'C');
  $pdf->Cell(10,6,'Hab.',0,0,'C');
  $pdf->Cell(50,6,'Huesped',0,0,'C');
  $pdf->Cell(40,6,'Descripcion ',0,0,'C');
  $pdf->Cell(25,6,'Valor',0,0,'C');
  $pdf->Cell(50,6,'Motivo Anulacion',0,1,'C');
  $pdf->SetFont('Arial','',9);
  $cargos = $hotel->getCargosAnuladosdelDiaporcajero(FECHA_PMS,$user,3,1); 
  $pagosanu = 0 ;
  $impto    = 0 ;
  $total    = 0 ;
  foreach ($cargos as $cargo) {
    $pdf->Cell(10,6,$cargo['habitacion_cargo'],0,0,'L');
    $pdf->Cell(50,6,substr($cargo['apellido1'].' '.$cargo['apellido2'].' '.$cargo['nombre1'].' '.$cargo['nombre2'],0,24),0,0,'L');
    $pdf->Cell(40,6,substr(($cargo['descripcion_cargo']),0,19),0,0,'L');
    $pdf->Cell(25,6,number_format($cargo['pagos_cargos'],2),0,0,'R');
    $pdf->Cell(50,6,$cargo['motivo_anulacion'],0,1,'L');
    $pagosanu  = $pagosanu + $cargo['pagos_cargos'];
  }
  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(100,6,'Total Pagos Anulados Cajero ',0,0,'L'); 
  $pdf->Cell(25,6,number_format($pagosanu,2),0,1,'R');
  $pdf->Ln(5);

  $pdf->Cell(195,5,'DEPOSITOS DEL DIA ',0,1,'C');
  $pdf->Ln(2);
  $pdf->Cell(10,6,'Hab.',0,0,'C');
  $pdf->Cell(10,6,'Nro.',0,0,'C');
  $pdf->Cell(70,6,'Huesped',0,0,'C');
  $pdf->Cell(50,6,'Descripcion ',0,0,'C');
  $pdf->Cell(25,6,'Valor',0,0,'C');
  $pdf->Cell(10,6,'Hora',0,1,'C');
  $pdf->SetFont('Arial','',9);
  $cargos = $hotel->getDepositosdelDiaporcajero(FECHA_PMS,$user,3,0); 

  $pagos  = 0 ;
  foreach ($cargos as $cargo) {
    $pdf->Cell(10,6,$cargo['habitacion_cargo'],0,0,'L');
    $pdf->Cell(10,6,$cargo['concecutivo_deposito'],0,0,'L');
    $pdf->Cell(70,6,substr(($cargo['apellido1'].' '.$cargo['apellido2'].' '.$cargo['nombre1'].' '.$cargo['nombre2']),0,35),0,0,'L');
    $pdf->Cell(50,6,($cargo['descripcion_cargo']),0,0,'L');
    $pdf->Cell(25,6,number_format($cargo['pagos_cargos'],2),0,0,'R');
    $pdf->Cell(10,6,substr($cargo['fecha_sistema_cargo'],11,5),0,1,'R'); 
    $pagos  = $pagos + $cargo['pagos_cargos'];
  }
  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(130,6,'Total Pagos Por Cajero ',0,0,'L');
  $pdf->Cell(25,6,number_format($pagos,2),0,1,'R');

  $pdf->AddPage('P','letter');
  $pdf->Ln(15);

  $pdf->Cell(195,5,'ARQUEO CIERRE DE CAJA ',0,1,'C');
  $pdf->Ln(5);
  $pdf->Cell(100,5,'EFECTIVO',0,0,'L');
  $pdf->Cell(95,5,'$ ',0,1,'C');
  $pdf->Ln(5);

  $pdf->Cell(80,5,'BILLETES',1,0,'C');
  $pdf->Cell(35,5,'',0,0,'L');
  $pdf->Cell(80,5,'MONEDAS',1,1,'C');
  $pdf->Cell(30,5,'Valor',1,0,'C');
  $pdf->Cell(20,5,'Cantidad',1,0,'C');
  $pdf->Cell(30,5,'Valor',1,0,'C');
  $pdf->Cell(35,5,'',0,0,'L');
  $pdf->Cell(30,5,'Valor',1,0,'C');
  $pdf->Cell(20,5,'Cantidad',1,0,'C');
  $pdf->Cell(30,5,'Valor',1,1,'C');
  $pdf->Cell(30,6,'100.000.oo',1,0,'C');
  $pdf->Cell(20,6,'',1,0,'C');
  $pdf->Cell(30,6,'',1,0,'C');
  $pdf->Cell(35,6,'',0,0,'C');
  $pdf->Cell(30,6,'1.000.oo',1,0,'C');
  $pdf->Cell(20,6,'',1,0,'C');
  $pdf->Cell(30,6,'',1,1,'C');
  $pdf->Cell(30,6,'50.000.oo',1,0,'C');
  $pdf->Cell(20,6,'',1,0,'C');
  $pdf->Cell(30,6,'',1,0,'C');
  $pdf->Cell(35,6,'',0,0,'C');
  $pdf->Cell(30,6,'500.oo',1,0,'C');
  $pdf->Cell(20,6,'',1,0,'C');
  $pdf->Cell(30,6,'',1,1,'C');
  $pdf->Cell(30,6,'20.000.oo',1,0,'C');
  $pdf->Cell(20,6,'',1,0,'C');
  $pdf->Cell(30,6,'',1,0,'C');
  $pdf->Cell(35,6,'',0,0,'C');
  $pdf->Cell(30,6,'200.oo',1,0,'C');
  $pdf->Cell(20,6,'',1,0,'C');
  $pdf->Cell(30,6,'',1,1,'C');
  $pdf->Cell(30,6,'10.000.oo',1,0,'C');
  $pdf->Cell(20,6,'',1,0,'C');
  $pdf->Cell(30,6,'',1,0,'C');
  $pdf->Cell(35,6,'',0,0,'C');
  $pdf->Cell(30,6,'100.oo',1,0,'C');
  $pdf->Cell(20,6,'',1,0,'C');
  $pdf->Cell(30,6,'',1,1,'C');
  $pdf->Cell(30,6,'5.000.oo',1,0,'C');
  $pdf->Cell(20,6,'',1,0,'C');
  $pdf->Cell(30,6,'',1,0,'C');
  $pdf->Cell(35,6,'',0,0,'C');
  $pdf->Cell(30,6,'50.oo',1,0,'C');
  $pdf->Cell(20,6,'',1,0,'C');
  $pdf->Cell(30,6,'',1,1,'C');
  $pdf->Cell(30,6,'2.000.oo',1,0,'C');
  $pdf->Cell(20,6,'',1,0,'C');
  $pdf->Cell(30,6,'',1,0,'C');
  $pdf->Cell(35,6,'',0,1,'C');
  $pdf->Cell(30,6,'1.000.oo',1,0,'C');
  $pdf->Cell(20,6,'',1,0,'C');
  $pdf->Cell(30,6,'',1,0,'C');
  $pdf->Cell(35,6,'',0,1,'C');
  $pdf->ln(2);
  $pdf->Cell(50,5,'TOTAL BILLETES',1,0,'L');
  $pdf->Cell(30,5,'',1,0,'L');
  $pdf->Cell(35,5,'',0,0,'L');
  $pdf->Cell(50,5,'TOTAL MONEDAS',1,0,'L');
  $pdf->Cell(30,5,'',1,1,'L');

  $pdf->Ln(40);
  $pdf->line(80, 178, 140, 178);
  $pdf->Cell(195,6,$datosUsr[0]['apellidos'].' '.$datosUsr[0]['nombres'],0,1,'C');  
  $pdf->Cell(195,6,'Firma Usuario',0,1,'C');  

  $file = '../../imprimir/cajeros/cierre_Cajero_'.$user.'_'.FECHA_PMS.'.pdf';

  $pdf->Output($file,'F'); 

?>
