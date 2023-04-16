<?php 

  require_once '../../res/fpdf/fpdf.php';

  $ventas   = $pos->getVentasdelDia($user);
  
  $pdf = new FPDF();
  $pdf->AddPage('L','letter');
  $pdf->Image('../../img/'.$logo,10,10,15);
  
  $pdf->SetFont('Arial','B',13);
  $pdf->Cell(260,7,utf8_decode(NAME_EMPRESA),0,1,'C');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(260,5,'NIT: '.NIT_EMPRESA,0,1,'C');
  $pdf->Cell(260,5,TIPOEMPRESA,0,1,'C');
  $pdf->Cell(260,5,utf8_decode(ADRESS_EMPRESA),0,1,'C');
  $pdf->Cell(260,5,utf8_decode(CIUDAD_EMPRESA).' '.PAIS_EMPRESA,0,1,'C');
  /// $pdf->Cell(40,5,'',0,0,'C');
  $pdf->Cell(260,5,'Telefono '.TELEFONO_EMPRESA.' Movil '.CELULAR_EMPRESA,0,1,'C');
  $pdf->SetFont('Arial','B',11);
  /// $pdf->Cell(260,6,$_SESSION['NOMBRE_AMBIENTE'],0,1,'C');
  $pdf->Cell(190,6,$nomamb,0,1,'C');

  $pdf->Ln(1);
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(260,5,'VENTAS DEL DIA '.$fecha.' USUARIO '. $_SESSION['usuario'],0,1,'C');
  $pdf->Ln(2);

  $pdf->SetFont('Arial','',10);

  $pers    = 0 ;
  $neto    = 0 ;
  $impto   = 0 ;
  $total   = 0 ;
  $valprod = 0;
  if(count($ventas)==0){
    $pdf->Ln(2);
    $pdf->Cell(260,5,'SIN VENTAS EN EL DIA',0,0,'C');
    $pdf->Ln(2);

  }else{
    $pdf->Cell(20,6,'Factura.',0,0,'C');
    $pdf->Cell(20,6,'Comanda ',0,0,'C');
    $pdf->Cell(10,6,'Mesa ',0,0,'C');
    $pdf->Cell(10,6,'Pers. ',0,0,'C');
    $pdf->Cell(30,6,'Val Neto ',0,0,'C');
    $pdf->Cell(30,6,'Impuesto',0,0,'C');
    $pdf->Cell(30,6,'Val Total ',0,0,'C');
    $pdf->Cell(40,6,'Forma de Pago. ',0,0,'C');
    $pdf->Cell(20,6,'Estado ',0,0,'C');
    $pdf->Cell(25,6,'Usuario ',0,0,'C');
    $pdf->Cell(20,6,'Hora ',0,1,'C');
    foreach ($ventas as $comanda) {
      $pdf->Cell(20,5,$comanda['factura'],0,0,'L');
      $pdf->Cell(20,5,$comanda['comanda'],0,0,'C');
      $pdf->Cell(10,5,$comanda['mesa'],0,0,'C');
      $pdf->Cell(10,5,$comanda['pax'],0,0,'C');
      $pdf->Cell(30,5,number_format($comanda['valor_neto'],2),0,0,'R');
      $pdf->Cell(30,5,number_format($comanda['impuesto'],2),0,0,'R');
      $pdf->Cell(30,5,number_format($comanda['valor_total'],2),0,0,'R');
      $pdf->Cell(40,5,$comanda['descripcion'],0,0,'L');
      $pdf->Cell(20,5,estadoFacturaInf($comanda['estado']),0,0,'R');
      $pdf->Cell(25,5,$comanda['usuario_factura'],0,0,'L');
      $pdf->Cell(20,5,substr($comanda['fecha'],11,9),0,1,'R');
      if($comanda['estado']=='A'){
        $pers  = $pers+ $comanda['pax'];
        $neto  = $neto+ $comanda['valor_neto'];
        $impto = $impto+ $comanda['impuesto'];
        $total = $total+ $comanda['valor_total'];
      }
    }
    $pdf->Ln(2);
    $pdf->Cell(40,6,'Total ',1,0,'L');
    $pdf->Cell(20,6,number_format($pers,0),1,0,'R');
    $pdf->Cell(30,6,number_format($neto,2),1,0,'R');
    $pdf->Cell(30,6,number_format($impto,2),1,0,'R');
    $pdf->Cell(30,6,number_format($total,2),1,1,'R');
  }
  $pdf->Ln(3);

  $file = '../imprimir/informes/ventasdelDiaUsuario_'.$_SESSION['usuario'].'.pdf';

  $pdf->Output($file,'F');
?>
