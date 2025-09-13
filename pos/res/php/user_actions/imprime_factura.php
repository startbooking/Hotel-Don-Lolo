<?php
clearstatcache();
require '../../../../res/php/app_topPos.php';
require '../../../../res/fpdf/fpdf.php';

extract($_POST);

include_once 'encabezado_impresiones.php';

$datosFac = $pos->getDatosFactura($id_ambiente, $comanda);
$reso = '';
$rfec = '';
$rpre = '';
$desd = 0;
$hast = 0;
$habi = '';
$tipo = '';
$totabo = 0;


// print_r($datosFac);

$mes = $datosFac['mesa'];
$pax = $datosFac['pax'];
$coma = $datosFac['comanda'];
$tot = $datosFac['valor_total'];
$des = $datosFac['descuento'];
$net = $datosFac['valor_neto'];
$imp = $datosFac['impuesto'];
$pro = $datosFac['propina'];
$ser = $datosFac['servicio'];
$pag = $datosFac['pagado'];
$cam = $datosFac['cambio'];
$fec = $datosFac['fecha'];
$usu = $datosFac['usuario_factura'];
$cli = $datosFac['id_cliente'];
$pms = $datosFac['pms'];
$fpa = $datosFac['forma_pago'];
$fpa = $datosFac['nombre'];
$fpago = $datosFac['descripcion'];
$nFact = $datosFac['factura'];
$nomamb = $datosFac['nombre'];

if ($pms == '1') {
    $datosCliente = $pos->getDatosHuespedesenCasa($cli);
    $nrohabi = $datosCliente['num_habitacion'];
    $nameImpr = 'ChequeCuenta_'.$prefijo.'_'.$nFact.'.pdf';
    $file = '../../../impresiones/ChequeCuenta_'.$prefijo.'_'.$nFact.'.pdf';
} else {
    $datosCliente = $pos->datosCliente($cli);
    $identif = $datosCliente['identificacion'];
    $nameImpr = 'Factura_'.$prefijo.'_'.$nFact.'.pdf';
    $file = '../../../impresiones/Factura_'.$prefijo.'_'.$nFact.'.pdf';
}
$cliente = ($datosCliente['apellido1'].' '.$datosCliente['apellido2'].' '.$datosCliente['nombre1'].' '.$datosCliente['nombre2']);

$productosventa = $pos->getProductosVendidosFactura($id_ambiente, $comanda);
print_r($productosventa);


$time = date('H:m:i');

$pdf = new FPDF('P', 'mm', [76, 350]);
$pdf->SetMargins(5, 5, 5);

$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(65, 4, (NAME_EMPRESA), 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(65, 4, 'NIT: '.NIT_EMPRESA, 0, 1, 'C');
$pdf->Cell(65, 4, 'Iva Regimen Comun', 0, 1, 'C');
$pdf->Cell(65, 4, (ADRESS_EMPRESA), 0, 1, 'C');
$pdf->Cell(65, 4, (CIUDAD_EMPRESA.' '.PAIS_EMPRESA), 0, 1, 'C');
$pdf->Cell(65, 4, 'Telefono '.TELEFONO_EMPRESA, 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->MultiCell(65, 6, $nomamb, 0, 'C');
$pdf->Ln(1);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(65, 4, 'Fecha '.$fec.' '.$time.' Mesa '.$mes, 0, 1, 'L');
$pdf->Cell(65, 4, 'Mesero: '.$usu, 0, 1, 'L');
$pdf->Cell(65, 4, 'Forma de Pago: '.substr($fpago, 0, 18), 0, 1, 'L');
if ($pms == 0) {
    $pdf->Cell(65, 4, 'Tiquete POS Nro:  '.str_pad($nFact, 5, '0', STR_PAD_LEFT), 0, 1, 'L');
    $pdf->Cell(65, 4, 'Cliente '.substr($cliente, 0, 22), 0, 1, 'L');
    $pdf->Cell(65, 4, 'Iden. '.$identif, 0, 1, 'L');
} else {
    $pdf->Cell(65, 4, 'Cuenta Huesped Nro: '.str_pad($nFact, 5, '0', STR_PAD_LEFT), 0, 1, 'L');
    $pdf->Cell(65, 4, 'Huesped '.substr($cliente, 0, 22), 0, 1, 'L');
    $pdf->Cell(65, 4, 'Habitacion. '.$nrohabi, 0, 1, 'L');
}
$pdf->Ln(1);

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
    $pdf->Cell(35, 4, substr(($producto['nom']), 0, 17), 0, 0, 'L');
    $pdf->Cell(10, 4, $producto['cant'], 0, 0, 'R');
    $pdf->Cell(20, 4, number_format($producto['venta'], 2, ',', '.'), 0, 1, 'R');
}

$pdf->Ln(3);
$pdf->Cell(40, 4, 'Subtotal', 0, 0, 'R');
$pdf->Cell(25, 4, number_format($sub, 2, ',', '.'), 0, 1, 'R');
$pdf->Cell(40, 4, 'Impuesto', 0, 0, 'R');
$pdf->Cell(25, 4, number_format($imp, 2, ',', '.'), 0, 1, 'R');
$pdf->Cell(40, 4, 'Propina', 0, 0, 'R');
$pdf->Cell(25, 4, number_format($pro, 2, ',', '.'), 0, 1, 'R');
$pdf->Cell(40, 4, 'Room Service', 0, 0, 'R');
$pdf->Cell(25, 4, number_format($ser, 2, ',', '.'), 0, 1, 'R');
$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40, 4, 'Total Cuenta:', 0, 0, 'L');
$pdf->Cell(25, 4, number_format($sub - $des + $pro + $imp + $ser, 2, ',', '.'), 0, 1, 'R');
$pdf->Ln(1);
$pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(65, 4, 'Son : '.numtoletras($sub - $des + $pro + $imp + $ser), 0, 'L');
$pdf->Ln(20);
$pdf->Cell(65, 5, str_repeat('_', 40), 0, 1, 'L');
if ($pms == 1) {
    $pdf->MultiCell(65, 4, 'Acepto se incluya en mi cuenta de Alojamiento el Presente Consumo', 0, 'C');
    $pdf->Cell(65, 4, 'Firma Huesped', 0, 1, 'C');
} else {
    $pdf->MultiCell(65, 4, 'Acepto el Presente Consumo', 0, 'C');
    $pdf->Cell(65, 4, 'Firma Empleado', 0, 1, 'C');
}

$pdf->Ln(3);
$posY = $pdf->GetY();

$pdf->SetFont('Arial', '', 6);

$pdf->MultiCell(65, 4, 'Gracias por su compra ', 0, 'C');

$pdf->Output($file, 'F');
echo $nameImpr;

?>
 