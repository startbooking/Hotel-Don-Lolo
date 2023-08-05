<?php

require '../../../../res/php/titles.php';
require '../../../../res/php/app_topPos.php';
require '../../../../res/fpdf/fpdf.php';

$nComa = $_POST['cuenta'];
$amb = $_POST['idamb'];
$nomamb = $_POST['amb'];

include_once 'encabezado_impresiones.php';

$numerocomanda = $nComa;
$datosmesa = $pos->getDatosComanda($numerocomanda, $amb);
$pref = $pos->getPrefijoAmbiente($amb);

$pax = $datosmesa[0]['pax'];
$mesa = $datosmesa[0]['mesa'];
$fec = $datosmesa[0]['fecha'];
$pro = $datosmesa[0]['propina'];

$ventasdia = $pos->getProductosVentaComanda($numerocomanda, $amb);

$pdf = new FPDF('P', 'mm', [76, 250]);
$pdf->SetMargins(10, 10, 10);
$pdf->AddPage();
// $pdf->Image('../../../../img/'.$logo,2,3,20);
/* $pdf->SetFont('Arial','B',14);
*/
$pdf->Cell(100, 5, utf8_decode(NAME_EMPRESA), 0, 1, 'C');
$pdf->Cell(100, 5, utf8_decode(NAME_EMPRESA), 0, 1, 'C');

$pdf->Cell(100, 5, $nomamb, 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(76, 5, 'NIT: '.NIT_EMPRESA, 0, 1, 'C');
$pdf->Cell(76, 5, REGIMEN, 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(76, 5, utf8_decode(ADRESS_EMPRESA), 0, 1, 'C');
$pdf->Cell(76, 5, utf8_decode(CIUDAD_EMPRESA.' '.PAIS_EMPRESA), 0, 1, 'C');
$pdf->Cell(76, 5, 'Telefono '.TELEFONO_EMPRESA.' Movil '.CELULAR_EMPRESA, 0, 1, 'C');

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(76, 4, 'Fecha '.$fec.' Mesa '.$mesa, 0, 1, 'L');
$pdf->Cell(76, 4, 'Usuario: '.$_SESSION['usuario'], 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Ln(2);
$pdf->Cell(76, 4, 'ESTADO DE CUENTA', 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Ln(2);
$subt = 0;
$impt = 0;
$sub = 0;
$na = 0;
$val = 0;
$des = 0;
$imp = 0;
$tot = 0;
$pdf->Cell(50, 4, 'PRODUCTO', 0, 0, 'C');
$pdf->Cell(10, 4, 'CANT.', 0, 0, 'C');
$pdf->Cell(16, 4, 'VALOR', 0, 1, 'C');
$pdf->Ln(2);
$pdf->SetFont('Arial', '', 12);

foreach ($ventasdia as $producto) {
    $pdf->Cell(60, 4, utf8_decode($producto['nom']), 0, 0, 'L');

    // / $pdf->Cell(60,6,utf8_decode(substr($producto['nom'],0,20)),0,0,'L');
    $pdf->Cell(20, 4, $producto['cant'], 0, 0, 'R');
    $pdf->Cell(20, 4, number_format($producto['importe'], 2), 0, 1, 'R');

    $na = $na + $producto['cant'];
    $val = $val + $producto['importe'];
    $des = $des + $producto['descuento'];
    $sub = $sub + $producto['venta'];
    $imp = $imp + $producto['valorimpto'];
    $tot = ($sub + $imp + $des);
}
$pdf->Ln(3);
$pdf->Cell(50, 4, 'Subtotal', 0, 0, 'R');
$pdf->Cell(20, 4, number_format($sub, 2), 0, 1, 'R');
$pdf->Cell(50, 4, 'Descuento', 0, 0, 'R');
$pdf->Cell(20, 4, number_format($des, 2), 0, 1, 'R');
// / $pdf->Cell(20,4,number_format($imp,2),0,1,'R');
$pdf->Ln(2);
$pdf->Cell(50, 5, 'Total Cuenta:', 0, 0, 'L');
$pdf->Cell(40, 5, number_format($tot, 2), 0, 1, 'R');
/*
$pdf->Ln(5);
  $pdf->Cell(30,5,'Propina Sugerida',0,0,'R');
  $pdf->Cell(50,4,str_repeat('_', 20),0,1,'L');
  */
$pdf->Ln(5);
$pdf->SetFont('Arial', '', 12);
$pdf->MultiCell(45, 5, 'Son :'.numtoletras($tot), 0, 'L');
$pdf->Ln(3);
/*
  $fp = fopen("../../../text/propina.txt", "r");
  while(!feof($fp)) {
      $linea = fgets($fp);
    $pdf->MultiCell(90,4,$linea,0,'C');
  }
  fclose($fp);
  */
$pdf->Cell(100, 5, str_repeat('_', 100), 0, 1, 'L');

$pdf->Ln(10);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(25, 4, WEB_EMPRESA, 0, 0, 'L');
$pdf->Cell(25, 4, CORREO_EMPRESA, 0, 1, 'R');

$file = '../../../impresiones/Comanda_'.$pref.'_'.$numerocomanda.'.pdf';
$pdf->Output($file, 'F');
$pdf->Output();
?>
 