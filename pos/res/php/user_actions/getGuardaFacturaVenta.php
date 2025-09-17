<?php
require '../../../../res/php/app_topPos.php';

$data = json_decode(file_get_contents('php://input'), true);
extract($data);

$total = str_replace(',', '', $data['totalini']);
$impuesto = str_replace(',', '', $data['totalImp']);
$propina = str_replace(',', '', $data['propinaPag']);
$monto = str_replace(',', '', $data['montopago']);
$cambio = $data['cambio'];
$servicio = $data['servicio'];
$pagado = $monto + $cambio;

$totaldesc = 0;

$nombreambiente = $data['nombreAmbiente'];

$cliente = $data['clientes'];

$pax = 1;
$mesa = '00';
$numrows = 0;
$fechapos = $fecha;

$datosmesa = $pos->getDatosComanda($comandaPag, $ambientePag);

$pax = $datosmesa['pax'];
$mesa = $datosmesa['mesa'];
$motivoDes = $datosmesa['motivo_descuento'];

$ventasdia = $pos->getProductosVentaComanda($comandaPag, $ambientePag);

$numerofactura = $pos->getNumeroFactura($ambientePag);
$numFactura = $numerofactura['conc_factura'];
$numOrden = $numerofactura['conc_orden'];
$codigoVen = [];
$codigoPro = 0;
$codigoSer = 0;

if ($pms == 0) {
    $nFactura = $numFactura;
    $numero = $pos->updateNumeroFactura($ambientePag, $nFactura + 1);
} else {
    $nFactura = $numOrden;
    $numero = $pos->updateNumeroOrden($ambientePag, $nFactura + 1);
    $infoCargo = $pos->traeInfoCodigosPMS($ambientePag);
    $codigoPro = $infoCargo['codigo_propina'];
    $codigoSer = $infoCargo['codigo_servicio'];
}

$subtotal = 0;
$impuesto = 0;
$total = 0;
foreach ($ventasdia as $ventadia) {
    $idpr = $ventadia['producto_id'];
    $inom = $ventadia['nom'];
    $iven = $ventadia['venta'];
    $ican = $ventadia['cant'];
    $iimp = $ventadia['importe'];
    $iamb = $ventadia['ambiente'];
    $vdes = $ventadia['descuento'];
    $vpor = $ventadia['por_desc'];
    $vimp = $ventadia['impto'];
    $valimp = $ventadia['valorimpto'];
    $subtotal = $subtotal + $iven;
    $impuesto = $impuesto + $valimp;
    $total = $ventadia['importe'] + $total;
    $factura = $pos->insertProductoVentas($iamb, $inom, $iven, $ican, $iimp, $idpr, $vimp, $valimp, $nFactura, $usuario, $comandaPag, $vdes, $vpor, $pms);
}

$insFact = $pos->insertFacturaVentaPOS($nFactura, $comandaPag, $ambientePag, $mesa, $pax, $usuario, $total, $subtotal, $impuesto, $propina, $totaldesc, $pagado, $cambio, $fecha, $pms, 'A', $formapago, $cliente, $motivoDes, $servicio);

$actComanda = $pos->updateFacturaComanda($nFactura, 'P', $usuario, $fecha, $comandaPag, $ambientePag);
$actMesa = $pos->updateMesaPos($ambientePag, $mesa);

if ($pms == 1) {

    $totalventas = $pos->valorFacturaPorImpto($nFactura, $ambientePag, 1);

    foreach ($totalventas as $key => $venta) {
        $cargoPMS = $pos->cargosInterfasePOS($fechapos, $venta['total_venta'], $venta['total_impto'], $venta['id_cargo'], $venta['num_habitacion'], $venta['descripcion_cargo'], $venta['id_impto'], $venta['id_huesped'], $prefijo . '_' . $nFactura, $venta['num_reserva'], $comandaPag, $usuario, $idusuario,$nombreAmbiente); 
    }

    if ($propina != 0) {
        $descri = $pos->getDescripcionCargo($codigoPro);
        $descargo = $descri['descripcion_cargo'];
        $impcargo = $descri['id_impto'];
        $cargoPro = $pos->cargosInterfasePOS($fechapos, $propina, 0, $codigoPro, $totalventas[0]['num_habitacion'], $descri['descripcion_cargo'], $descri['id_impto'], $totalventas[0]['id_huesped'], $prefijo . '_' . $nFactura, $totalventas[0]['num_reserva'], $comandaPag, $usuario, $idusuario, $nombreAmbiente); 
    }
    if ($servicio != 0) {
        $descri = $pos->getDescripcionCargo($codigoSer);
        $cargoPro = $pos->cargosInterfasePOS($fechapos, $servicio, 0, $codigoSer, $totalventas[0]['num_habitacion'], $descri['descripcion_cargo'], $impcargo = $descri['id_impto'], $totalventas[0]['id_huesped'], $prefijo . '_' . $nFactura, $totalventas[0]['num_reserva'], $comandaPag, $usuario, $idusuario, $nombreAmbiente);
    } 
}

echo $nFactura;
