<?php
// clearstatcache();
require '../../../../res/php/app_topPos.php';
require '../../../../res/fpdf/fpdf.php';

$data = json_decode(file_get_contents('php://input'), true);
extract($data);

include_once 'encabezado_impresiones.php';

$datosFac = $pos->getDatosFactura($id_ambiente, $factura);

$reso = '';
$rfec = '';
$rpre = '';
$desd = 0;
$hast = 0;
$habi = '';
$tipo = '';
$totabo = 0;

$mes = $datosFac['mesa'];
$pax = $datosFac['pax'];
$comanda = $datosFac['comanda'];
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

$productosventa = $pos->productosFacturaVenta($id_ambiente, $comanda);
$imptos = $pos->sumaImptosFactura($id_ambiente, $comanda);

$time = date('H:m:i');

$pdf = new FPDF('P', 'mm', [76, 350]);
$pdf->SetMargins(5, 5, 5);

$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(65, 4, (NAME_EMPRESA), 0, 1, 'C');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(65, 4, 'NIT: '.NIT_EMPRESA, 0, 1, 'C');
$pdf->Cell(65, 4, 'Iva Regimen Comun', 0, 1, 'C');
$pdf->Cell(65, 4, (ADRESS_EMPRESA), 0, 1, 'C');
$pdf->Cell(65, 4, (CIUDAD_EMPRESA.' '.PAIS_EMPRESA), 0, 1, 'C');
$pdf->Cell(65, 4, 'Telefono '.TELEFONO_EMPRESA, 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->MultiCell(65, 5, $nomamb, 0, 'C');
$pdf->Ln(1);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(65, 4, 'Fecha '.$fec.' '.$time.' Mesa '.$mes, 0, 1, 'L');
$pdf->Cell(65, 4, 'Mesero: '.$usu, 0, 1, 'L');
$pdf->Cell(65, 4, 'Forma de Pago: '.substr($fpago, 0, 18), 0, 1, 'L');
if ($pms == 0) {
    $pdf->Cell(65, 4, 'Tiquete POS Nro:  '.str_pad($nFact, 5, '0', STR_PAD_LEFT), 0, 1, 'L');
    $pdf->Cell(65, 4, 'Cliente '.substr($cliente, 0, 22), 0, 1, 'L');
    $pdf->Cell(65, 4, 'Iden. '.$identif, 0, 1, 'L');
} else {
    $pdf->Cell(65, 4, 'Cuenta Huesped Nro: '.str_pad($nFact, 5, '0', STR_PAD_LEFT), 0, 1, 'L');
    $pdf->Cell(65, 4, 'Huesped '.substr($cliente, 0, 25), 0, 1, 'L');
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

$pdf->Cell(65, 4, 'PRODUCTO', 0, 1, 'L');
$pdf->Cell(35, 4, '', 0, 0, 'R');
$pdf->Cell(10, 4, 'CANT.', 0, 0, 'R');
$pdf->Cell(20, 4, 'VALOR', 0, 1, 'R');
$pdf->Ln(1);
$pdf->SetFont('Arial', '', 9);

foreach ($productosventa as $producto) {
    $na = $na + $producto['can'];
    $val = $val + $producto['total'];
    $pdf->Cell(65, 4, '['.$producto['id'].']'.substr(($producto['nom']), 0, 28) , 0, 1, 'L');
    $pdf->Cell(35, 4, '', 0, 0, 'R');
    $pdf->Cell(10, 4, $producto['can'], 0, 0, 'R');
    $pdf->Cell(20, 4, number_format($producto['total'], 2, ',', '.'), 0, 1, 'R');

    $imp = $imp + $producto['impto'];
    $sub = $sub + $producto['total'];
    $tot = $sub + $imp;
}

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
  $pdf->Cell(10, 4, '['.$impto['id'].'] '.$impto['tipoImp'] , 0, 0, 'L');
  // $pdf->Cell(30, 4, $impto['descripcion_cargo'] , 0, 0, 'L');
  $pdf->Cell(10, 4, $impto['porcentaje_impto'] , 0, 0, 'R');
  $pdf->Cell(25, 4, number_format($impto['base'],2) , 0, 0, 'R');
  $pdf->Cell(20, 4, number_format($impto['imptos'],2) , 0, 1, 'R');
  $totImpto = $totImpto + $impto['imptos'];
  # code...
}
$pdf->Ln(2);

$pdf->Cell(40, 4, 'Subtotal', 0, 0, 'R');
$pdf->Cell(25, 4, number_format($sub, 2, ',', '.'), 0, 1, 'R');
$pdf->Cell(40, 4, 'Impuesto', 0, 0, 'R');
$pdf->Cell(25, 4, number_format($totImpto, 2, ',', '.'), 0, 1, 'R');
$pdf->Cell(40, 4, 'Propina', 0, 0, 'R');
$pdf->Cell(25, 4, number_format($pro, 2, ',', '.'), 0, 1, 'R');
$pdf->Cell(40, 4, 'Room Service', 0, 0, 'R');
$pdf->Cell(25, 4, number_format($ser, 2, ',', '.'), 0, 1, 'R');
$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40, 4, 'Total Cuenta:', 0, 0, 'L');
$pdf->Cell(25, 4, number_format($sub + $pro + $totImpto + $ser, 2, ',', '.'), 0, 1, 'R');
$pdf->Ln(1);
$pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(65, 4, 'Son : '.numtoletras($sub + $pro + $totImpto + $ser), 0, 'J');
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
 