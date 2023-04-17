<?php 

  require '../../res/php/titles.php';
  require '../../res/php/app_topPos.php'; 

  $idamb      = $_POST['idamb'];
  $nomamb     = $_POST['amb'];
  $user       = $_POST['user'];
  $iduser     = $_POST['iduser'];
  //// $impto = $_POST['impto'];
  /// $prop   = $_POST['prop'];
  $logo       = $_POST['logo'];
  $desdefe    = $_POST['desdeFe'];
  $hastafe    = $_POST['hastaFe'];
  $oldfile       = $_POST['file'];
 
  $periodos = $pos->getVentasPeriodosMes($idamb, $desdefe, $hastafe);
  
  require_once '../../res/fpdf/fpdf.php';

  $pdf = new FPDF();
  $pdf->AddPage('P','letter');
  $pdf->Image('../../img/'.$logo,10,10,15);
  $pdf->SetFont('Arial','B',12);
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
  $pdf->Cell(190,6,$nomamb,0,1,'C');

  $pdf->Ln(1);
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(195,6,'HISTORICO VENTAS POR PERIODOS DE SERVICIO ',0,1,'C');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(195,5,'Desde  Fecha '.$desdefe.' Hasta Fecha '.$hastafe ,0,1,'C');
  $pdf->Ln(2);

  $pdf->SetFont('Arial','',9);

  $monto   = 0 ;
  $impto   = 0 ;
  $total   = 0 ;
  $valprod = 0;
  $canti   = 0;
  $descu   = 0;
  if(count($periodos)==0){
    $pdf->Ln(2);
    $pdf->Cell(190,5,'SIN PRODUCTOS VENDIDOS EN EL DIA',0,0,'C');
    $pdf->Ln(2);
  }else{
    $pdf->Cell(90,6,'Periodo',1,0,'C');
    $pdf->Cell(25,6,'Valor',1,0,'C');
    $pdf->Cell(25,6,'Descuento',1,0,'C');
    $pdf->Cell(25,6,'Impuesto',1,0,'C');
    $pdf->Cell(25,6,'Total',1,1,'C');
    foreach ($periodos as $comanda) {
      $pdf->Cell(90,5,utf8_decode($comanda['descripcion_periodo']),0,0,'L');
      $pdf->Cell(25,5,number_format($comanda['ventas'],2),0,0,'R');
      $pdf->Cell(25,5,number_format($comanda['descu'],2),0,0,'R');
      $pdf->Cell(25,5,number_format($comanda['imptos'],2),0,0,'R');
      $pdf->Cell(25,5,number_format($comanda['total'],2),0,1,'R');
      $valprod = $valprod+ $comanda['ventas'];
      $monto   = $monto+ $comanda['ventas'];
      $descu   = $descu+ $comanda['descu'];
      $impto   = $impto+ $comanda['imptos'];
      $total   = $total+ $comanda['total'];
    }
    $pdf->Ln(2);
    $pdf->Cell(90,6,'Total ',1,0,'L');
    $pdf->Cell(25,6,number_format($monto,2),1,0,'R');
    $pdf->Cell(25,6,number_format($descu,2),1,0,'R');
    $pdf->Cell(25,6,number_format($impto,2),1,0,'R');
    $pdf->Cell(25,6,number_format($total,2),1,1,'R');
  }
  $pdf->Ln(3);

  $file = '../imprimir/informes/'.$oldfile.'.pdf';

  $pdf->Output($file,'F');

  echo $oldfile;
?>
