<?php 

  $dUser    = $pos->getDatosUsuario($_SESSION['usuario_id']) ;
  $ventas   = $pos->getTotalProductosVendidos($_SESSION['AMBIENTE_ID']);
  $cantidad = $pos->getCantidadProductosVendidos($_SESSION['AMBIENTE_ID']);
  
  $canProd = $cantidad[0]['cant'];
  $valProd = $cantidad[0]['ventas'];
  $perProd = $cantidad[0]['pers'];

  require_once '../../res/fpdf/fpdf.php';

  $dUser = $pos->getDatosUsuario($_SESSION['usuario_id']) ;
  $logo = $_SESSION['LOGO_POS'] ;

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
  */
  $pdf->SetFont('Arial','B',13);
  /// $pdf->Cell(190,6,$_SESSION['NOMBRE_AMBIENTE'],0,1,'C');
  $pdf->Cell(195,6,$nomamb,0,1,'C');

  $pdf->Ln(1);
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(195,5,'VENTAS POPULARIDAD DE PRODUCTOS '.FECHA_POS,0,1,'C');
  $pdf->Ln(2);

  $pdf->SetFont('Arial','',10);

  $monto  = 0 ;
  $impto  = 0 ;
  $total  = 0 ;
  $valprod = 0;
  $canti = 0;
  if(count($ventas)==0){
    $pdf->Ln(2);
    $pdf->Cell(190,5,'SIN PRODUCTOS VENDIDOS EN EL DIA',0,0,'C');
    $pdf->Ln(2);

  }else{
    $pdf->Cell(60,6,'Producto.',0,0,'C');
    $pdf->Cell(20,6,'Cantidad ',0,0,'C');
    $pdf->Cell(25,6,'Valor. ',0,0,'C');
    $pdf->Cell(25,6,'Impuesto. ',0,0,'C');
    $pdf->Cell(25,6,'Total. ',0,0,'C');
    $pdf->Cell(20,6,'% Cant. ',0,0,'C');
    $pdf->Cell(20,6,'% Valor. ',0,1,'C');
    foreach ($ventas as $comanda) {
      $pdf->Cell(60,5,utf8_decode($comanda['nom']),0,0,'L');
      $pdf->Cell(20,5,$comanda['cant'],0,0,'C');
      $pdf->Cell(25,5,money_format('%.2n', $comanda['ventas']),0,0,'R');
      $pdf->Cell(25,5,money_format('%.2n', $comanda['imptos']),0,0,'R');
      $pdf->Cell(25,5,money_format('%.2n', $comanda['total']),0,0,'R');
      $pdf->Cell(20,5,number_format(($comanda['cant']/$canProd)*100,2),0,0,'R');
      $pdf->Cell(20,5,number_format(($comanda['ventas']/$valProd)*100,2),0,1,'R');
      $valprod = $valprod+ $comanda['ventas'];
      $canti = $canti+ $comanda['cant'];
      $monto = $monto+ $comanda['ventas'];
      $impto = $impto+ $comanda['imptos'];
      $total = $total+ $comanda['total'];

    }
    $pdf->Ln(2);
    $pdf->Cell(60,6,'Total ',1,0,'L');
    $pdf->Cell(20,6,number_format($canti,0),1,0,'R');
    $pdf->Cell(25,6,money_format('%.2n', $monto),1,0,'R');
    $pdf->Cell(25,6,money_format('%.2n', $impto),1,0,'R');
    $pdf->Cell(25,6,money_format('%.2n', $total),1,1,'R');
  }
  $pdf->Ln(3);

  $file = '../imprimir/informes/ventasProductos_'.$_SESSION['usuario'].'.pdf';

  $pdf->Output($file,'F');
?>
