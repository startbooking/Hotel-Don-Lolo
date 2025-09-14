<?php

require '../../../../res/php/app_topPos.php';
require '../../../../res/fpdf/fpdf.php';
extract($_POST);

include_once 'encabezado_impresiones.php';

/* Resolucion de Facturacion Factura */
$pref = $pos->getPrefijoAmbiente($id_ambiente);

/* Encabezado de la Factura */
/* Numero de Mesa A Imprimir */

$datosFac = $pos->getDatosComanda($comanda, $id_ambiente);

$mesa = $datosFac['mesa'];
$pax = $datosFac['pax'];
$abonos = $datosFac['abonos'];

/* Datos del Cliente */
$file = '../../../impresiones/estadoCuenta_'.$pref.'_'.$comanda.'.pdf';
$nameImpr = 'estadoCuenta_'.$pref.'_'.$comanda.'.pdf';

$productosventa = $pos->getProductosEstadoCuenta($id_ambiente, $comanda);
$imptos = $pos->sumaImptosComanda($id_ambiente, $comanda);
// print_r($imptos);


$na = 0;
$val = 0;
$desto = 0;
$subt = 0;
$impt = 0;
$time = time();
$sub = 0;

$pdf = new FPDF('P', 'mm', [76, 350]);
$pdf->SetMargins(5, 10, 5);

$pdf->AddPage();
// $pdf->Image('../../../../img/'.$logo, 2, 5, 9);
$pdf->SetFont('Arial', 'B', 9);

$pdf->Cell(65, 3, (NAME_EMPRESA), 0, 1, 'C');
// $pdf->Cell(65, 4, $nomamb, 0, 1, 'C');
$pdf->MultiCell(65, 3, $nombre, 0, 'C');

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(65, 4, 'NIT: '.NIT_EMPRESA, 0, 1, 'C');
/*   $pdf->Cell(50,5,'Iva Regimen Comun',0,1,'C');
  $pdf->Cell(50,5,'NO SOMOS GRANDES CONTRIBUYENTES',0,1,'C');
  $pdf->Cell(50,5,'NI AGENTES RETENEDORES',0,1,'C');
 */
$pdf->Cell(65, 4, (ADRESS_EMPRESA), 0, 1, 'C');
$pdf->Cell(65, 4, (CIUDAD_EMPRESA.' '.PAIS_EMPRESA), 0, 1, 'C');
$pdf->Cell(65, 4, 'Movil '.CELULAR_EMPRESA, 0, 1, 'C');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(65, 4, 'Fecha '.$fecha_auditoria.' Mesa '.$mesa, 0, 1, 'L');
$pdf->Cell(65, 4, 'Mesero: '.$usuario, 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 9);
$pdf->Ln(1);
$pdf->Cell(65, 4, 'ESTADO DE CUENTA', 0, 1, 'C');
$pdf->SetFont('Arial', '', 9);
$pdf->Ln(1);

$subt = 0;
$impt = 0;
$sub = 0;
$na = 0;
$val = 0;
$des = 0;
$imp = 0;
$pro = 0;

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(65, 4, 'PRODUCTO', 0, 1, 'L');
$pdf->Cell(35, 4, '', 0, 0, 'R');
$pdf->Cell(10, 4, 'CANT.', 0, 0, 'R');
$pdf->Cell(20, 4, 'VALOR', 0, 1, 'R');
$pdf->Ln(1);
$pdf->SetFont('Arial', '', 9);

foreach ($productosventa as $producto) {
    $na = $na + $producto['cant'];
    $val = $val + $producto['venta'];
    $pdf->Cell(65, 4, '['.$producto['id'].']'.substr(($producto['nom']), 0, 28) , 0, 1, 'L');
    $pdf->Cell(35, 4, '', 0, 0, 'R');
    $pdf->Cell(10, 4, $producto['cant'], 0, 0, 'R');
    $pdf->Cell(20, 4, number_format($producto['venta'], 2, ',', '.'), 0, 1, 'R');

    $imp = $imp + $producto['valorimpto'];
    $des = $des + $producto['descuento'];
    $sub = $sub + $producto['venta'];
    $tot = $sub + $imp - $des;
}

$tot = $tot - $abonos;
$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(65, 4, 'IMPUESTOS', 0, 1, 'C');
$pdf->Cell(10, 4, 'ID', 0, 0, 'C');
$pdf->Cell(10, 4, '%', 0, 0, 'R');
$pdf->Cell(25, 4, 'BASE', 0, 0, 'R');
$pdf->Cell(20, 4, 'IMPTO', 0, 1, 'R');
$totImpto = 0;
$pdf->SetFont('Arial', '', 8);
foreach ($imptos as $key => $impto) {
  $pdf->Cell(10, 4, '['.$impto['id'].'] '.$impto['name'] , 0, 0, 'L');
  // $pdf->Cell(30, 4, $impto['descripcion_cargo'] , 0, 0, 'L');
  $pdf->Cell(10, 4, $impto['porcentaje_impto'] , 0, 0, 'R');
  $pdf->Cell(25, 4, number_format($impto['base'],2) , 0, 0, 'R');
  $pdf->Cell(20, 4, number_format($impto['imptos'],2) , 0, 1, 'R');
  $totImpto = $totImpto + $impto['imptos'];
  # code...
}
$pdf->Ln(2);

$pdf->SetFont('Arial', '', 9);

$pdf->Cell(40, 4, 'Subtotal', 0, 0, 'R');
$pdf->Cell(25, 4, number_format($sub, 2, ',', '.'), 0, 1, 'R');
/* $pdf->Cell(40, 4, 'Descuento', 0, 0, 'R');
$pdf->Cell(25, 4, number_format($des, 2, ',', '.'), 0, 1, 'R'); */
$pdf->Cell(40, 5, 'IMPUESTOS', 0, 0, 'R');
$pdf->Cell(25, 5, number_format($totImpto, 2, ',', '.'), 0, 1, 'R');

$pdf->Cell(40, 4, 'Propina', 0, 0, 'R');
$pdf->Cell(25, 4, number_format($pro, 2, ',', '.'), 0, 1, 'R');
// $pdf->Ln(1);
/* $pdf->Cell(25, 4, 'Abonos', 0, 0, 'R');
$pdf->Cell(20, 4, number_format($abonos, 2, ',', '.'), 0, 1, 'R'); */
// $pdf->Ln(1);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(40, 4, 'Total Cuenta:', 0, 0, 'R');
$pdf->Cell(25, 4, number_format($tot, 2, ',', '.'), 0, 1, 'R');
$pdf->Ln(2);
$pdf->SetFont('Arial', '', 9);
$pdf->MultiCell(65, 4, 'Son :'.numtoletras($tot), 0, 'J');
/*
$pdf->Cell(45,5,'Son : '.numtoletras($tot),0,1,'L');

$pdf->SetFont('Arial','',10);
  $fp = fopen("../../../text/propina.txt", "r");
  while(!feof($fp)) {
      $linea = fgets($fp);
    $pdf->MultiCell(90,4,$linea,0,'C');
  }
  fclose($fp);
 */
$pdf->Ln(3);

$pdf->SetFont('Arial', '', 8);
// $pdf->Cell(24,4,WEB_EMPRESA,0,0,'L');
// $pdf->Cell(24,4,CORREO_EMPRESA,0,1,'R');

$pdf->Output($file, 'F');
echo $nameImpr;

?>
 