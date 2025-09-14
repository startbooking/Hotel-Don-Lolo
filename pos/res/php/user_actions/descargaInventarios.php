<?php
require '../../../../res/php/app_topPos.php';
require '../../../../res/fpdf/fpdf.php';

$data = json_decode(file_get_contents('php://input'), true);
extract($data);

$docu = $prefijo.$factura;
$tipo = 2;

$tipoMovi = $pos->traeDatosMovimiento();

$movimiento = $tipoMovi['tipo'];
$tipoMov    = $tipoMovi['id_tipomovi'];

$productosVenta = $pos->getDescargaInventario($id_ambiente, $comanda, 1);
$recetasVenta = $pos->getProductosRecetasVenta($id_ambiente, $comanda, 2);
$subRecetas =  $pos->getProductosSubRecetas($id_ambiente, $comanda, 2);

print_r($productosVenta);
print_r($recetasVenta);
print_r($subRecetas);

if (count($productosVenta) == 0 && count($recetasVenta) == 0) {
    $numeroMov = 0;
} else {
    $numeroMov = $pos->getNumeroMovimientoInventario(2);
    $increment = $pos->incrementaNumeroMovimientoInv(2, $numeroMov + 1);

    if (count($productosVenta) > 0) {
        foreach ($productosVenta as $key => $prodSale) {
            $producto = $prodSale['id_producto'];
            $cantidad = $prodSale['cant'];
            $unidadalm = $prodSale['unidad_almacena'];
            $unit = $prodSale['valor_promedio'];
            $subtotal = $unit * $cantidad;
            $costo = $subtotal;

            $adiPro = $pos->insertaMovimiento($tipoMov, $tipo, $movimiento, $numeroMov, $fecha_auditoria, $id_centrocosto, $docu, $producto, $cantidad, $unidadalm, $unit, $subtotal, $costo, $id_bodega, 1, $usuario);
        }
    }

    if (count($recetasVenta) > 0) {
        foreach ($recetasVenta as $key => $receta) {
            $producto = $receta['id_producto'];
            $cantidad = $receta['cant'] * $receta['cantidad'];
            $unidadalm = $receta['unidad_almacena'];
            $unit = $receta['valor_promedio'];
            $subtotal = $unit * $cantidad;
            $costo = $subtotal;

            $adiRec = $pos->insertaMovimiento($tipoMov, $tipo, $movimiento, $numeroMov, $fecha_auditoria, $id_centrocosto, $docu, $producto, $cantidad, $unidadalm, $unit, $subtotal, $costo, $id_bodega, 1, $usuario);
        }
    }

    if (count($subRecetas) > 0) {
        foreach ($subRecetas as $key => $receta) {
            $producto = $receta['id_producto'];
            $cantidad = $receta['cant'] * $receta['cantidad'];
            $unidadalm = $receta['unidad_almacena'];
            $unit = $receta['valor_promedio'];
            $subtotal = $unit * $cantidad;
            $costo = $subtotal;

            $adiRec = $pos->insertaMovimiento($tipoMov, $tipo, $movimiento, $numeroMov, $fecha_auditoria, $id_centrocosto, $docu, $producto, $cantidad, $unidadalm, $unit, $subtotal, $costo, $id_bodega, 1, $usuario);
        }
    }

    $asignaMov = $pos->numeroSalida($factura, $id_ambiente, $numeroMov);

    echo $numeroMov;

    include_once 'imprimeSalidasPos.php';
}

?>
 