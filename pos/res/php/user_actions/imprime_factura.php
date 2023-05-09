<?php

require '../../../../res/php/titles.php';
require '../../../../res/php/app_topPos.php';
require '../../../../res/fpdf/fpdf.php';

$logo = $_POST['logo'];

clearstatcache();
$nComa = $_SESSION['NUMERO_COMANDA'];
$nFact = $_SESSION['NUMERO_FACTURA'];
$amb = $_SESSION['AMBIENTE_ID'];
$nomamb = $_SESSION['NOMBRE_AMBIENTE'];

include_once 'encabezado_impresiones.php';

/* Resolucion de Facturacion Factura */
$pref = $pos->getPrefijoAmbiente($amb);

$reso = '';
$rfec = '';
$rpre = '';
$desd = 0;
$hast = 0;
$habi = '';
$tipo = '';

$totabo = 0;

$datosFac = $pos->getDatosFactura($amb, $nComa);
// $abonos   = $pos->getTotalAbonos($amb,$nComa);

// echo $amb, $nComa;

// echo print_r($datosFac);

$mes = $datosFac[0]['mesa'];
$pax = $datosFac[0]['pax'];
$coma = $datosFac[0]['comanda'];
$tot = $datosFac[0]['valor_total'];
$des = $datosFac[0]['descuento'];
$net = $datosFac[0]['valor_neto'];
$imp = $datosFac[0]['impuesto'];
$pro = $datosFac[0]['propina'];
$pag = $datosFac[0]['pagado'];
$cam = $datosFac[0]['cambio'];
$fec = $datosFac[0]['fecha'];
$usu = $datosFac[0]['usuario_factura'];
$cli = $datosFac[0]['id_cliente'];
$pms = $datosFac[0]['pms'];
$fpa = $datosFac[0]['forma_pago'];
// $abonos = $datosFac[0]['abonos'];

// echo $fpa.' Forma de Pago ';

$fpago = $pos->nombrePago($fpa);

if ($pms == '1') {
    $datosCliente = $pos->getDatosHuespedesenCasa($cli);
    $nrohabi = $datosCliente[0]['num_habitacion'];
    $nameImpr = 'ChequeCuenta_'.$pref.'_'.$nFact.'.pdf';
    $file = '../../../impresiones/ChequeCuenta_'.$pref.'_'.$nFact.'.pdf';
} else {
    $datosCliente = $pos->datosCliente($cli);
    $identif = $datosCliente[0]['identificacion'];
    $nameImpr = 'Factura_'.$pref.'-'.$nFact.'.pdf';
    $file = '../../../impresiones/Factura_'.$pref.'_'.$nFact.'.pdf';
}
$cliente = utf8_decode($datosCliente[0]['apellido1'].' '.$datosCliente[0]['apellido2'].' '.$datosCliente[0]['nombre1'].' '.$datosCliente[0]['nombre2']);

$productosventa = $pos->getProductosVendidosFactura($amb, $nComa);

$time = date('H:m:i');

$pdf = new FPDF('P', 'mm', [76, 350]);
$pdf->SetMargins(5, 5, 5);

$pdf->AddPage();
// $pdf->Image('../../../../img/'.$logo, 2, 5, 10);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(65, 4, utf8_decode(NAME_EMPRESA), 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(65, 4, 'NIT: '.NIT_EMPRESA, 0, 1, 'C');
$pdf->Cell(65, 4, 'Iva Regimen Comun', 0, 1, 'C');
$pdf->Cell(65, 4, utf8_decode(ADRESS_EMPRESA), 0, 1, 'C');
$pdf->Cell(65, 4, utf8_decode(CIUDAD_EMPRESA.' '.PAIS_EMPRESA), 0, 1, 'C');
$pdf->Cell(65, 4, 'Telefono '.TELEFONO_EMPRESA, 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(65, 4, $nomamb, 0, 1, 'C');
$pdf->Ln(1);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(65, 4, 'Fecha '.$fec.' '.$time.' Mesa '.$mes, 0, 1, 'L');
$pdf->Cell(65, 4, 'Mesero: '.$_SESSION['usuario'], 0, 1, 'L');
$pdf->Cell(65, 4, 'Forma de Pago: '.substr($fpago, 0, 18), 0, 1, 'L');
if ($pms == 0) {
    $pdf->Cell(65, 5, 'Tiquete POS Nro:  '.str_pad($nFact, 5, '0', STR_PAD_LEFT), 0, 1, 'L');
    $pdf->Cell(65, 5, 'Cliente '.substr($cliente, 0, 22), 0, 1, 'L');
    $pdf->Cell(65, 5, 'Iden. '.$identif, 0, 1, 'L');
} else {
    $pdf->Cell(65, 5, 'Cuenta Huesped Nro: '.str_pad($nFact, 5, '0', STR_PAD_LEFT), 0, 1, 'L');
    $pdf->Cell(65, 5, 'Huesped '.substr($cliente, 0, 22), 0, 1, 'L');
    $pdf->Cell(65, 5, 'Habitacion. '.$nrohabi, 0, 1, 'L');
}
$pdf->Ln(2);

$subt = 0;
$impt = 0;
$sub = 0;
$na = 0;
$val = 0;
$descu = 0;
$imp = 0;
$pdf->SetFont('Arial', 'B', 10);

$pdf->Cell(40, 4, 'PRODUCTO', 0, 0, 'C');
$pdf->Cell(10, 4, 'CANT.', 0, 0, 'C');
$pdf->Cell(15, 4, 'VALOR', 0, 1, 'C');
$pdf->Ln(1);
$pdf->SetFont('Arial', '', 9);

foreach ($productosventa as $producto) {
    $na = $na + $producto['cant'];
    $val = $val + $producto['venta'];
    $descu = $descu - $producto['descuento'];
    $sub = $sub + $producto['venta'];
    $imp = $imp + $producto['valorimpto'];
    $pdf->Cell(35, 4, substr(utf8_decode($producto['nom']), 0, 17), 0, 0, 'L');
    $pdf->Cell(10, 4, $producto['cant'], 0, 0, 'R');
    $pdf->Cell(20, 4, number_format($producto['venta'], 2, ',', '.'), 0, 1, 'R');
}

$pdf->Ln(3);
$pdf->Cell(40, 4, 'Subtotal', 0, 0, 'R');
$pdf->Cell(25, 4, number_format($sub, 2, ',', '.'), 0, 1, 'R');
$pdf->Cell(40, 4, 'Impuesto', 0, 0, 'R');
$pdf->Cell(25, 4, number_format($imp, 2, ',', '.'), 0, 1, 'R');
/* $pdf->Cell(40, 4, 'Descuento', 0, 0, 'R');
$pdf->Cell(25, 4, number_format($des, 2, ',', '.'), 0, 1, 'R'); */
$pdf->Cell(40, 4, 'Propina', 0, 0, 'R');
$pdf->Cell(25, 4, number_format($pro, 2, ',', '.'), 0, 1, 'R');
$pdf->Ln(2);
/* $pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(40, 4, 'Abonos:', 0, 0, 'L');
$pdf->Cell(25, 4, number_format($abonos, 2, ',', '.'), 0, 1, 'R');
$pdf->Ln(2); */
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40, 4, 'Total Cuenta:', 0, 0, 'L');
$pdf->Cell(25, 4, number_format($sub - $des + $pro + $imp, 2, ',', '.'), 0, 1, 'R');
$pdf->Ln(2);
$pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(65, 4, 'Son : '.numtoletras($sub - $des + $pro + $imp), 0, 'L');
// $pdf->SetFont('Arial', '', 10);

if ($pms == 1) {
    $pdf->Ln(20);
    $pdf->Cell(65, 5, str_repeat('_', 40), 0, 1, 'L');
    $pdf->MultiCell(65, 4, 'Acepto se incluya en mi cuenta de Alojamiento el Presente Consumo', 0, 'C');
    $pdf->Cell(65, 4, 'Firma Huesped', 0, 1, 'C');
}

$pdf->Ln(3);
$posY = $pdf->GetY();

$pdf->SetFont('Arial', '', 6);

$pdf->MultiCell(65, 4, 'Gracias por su compra ', 0, 'C');

$pdf->Output($file, 'F');
echo $nameImpr;

?>
 