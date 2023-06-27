<?php

require '../../../../res/php/titles.php';
require '../../../../res/php/app_topPos.php';
require '../../../../res/fpdf/fpdf.php';

$nComa = $_SESSION['NUMERO_COMANDA'];
$nFact = $_SESSION['NUMERO_FACTURA'];
$nomamb = $_SESSION['NOMBRE_AMBIENTE'];
 
$amb = $_POST['idamb'];
$almacen = $_POST['idbod'];
$fecha = $_POST['fecha'];
$centroCosto = $_POST['centr'];
$usuario = $_POST['usuario'];

$pref = $pos->getPrefijoAmbiente($amb);
$docu = $pref.$nFact;
$tipo = 2;

$tipoMovi = $pos->traeDatosMovimiento();

$movimiento = $tipoMovi[0]['tipo'];
$tipoMov    = $tipoMovi[0]['id_tipomovi'];

$productosVenta = $pos->getDescargaInventario($amb, $nComa, 1);
$recetasVenta = $pos->getProductosRecetasVenta($amb, $nComa, 2);

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

            $adiPro = $pos->insertaMovimiento($tipoMov, $tipo, $movimiento, $numeroMov, $fecha, $centroCosto, $docu, $producto, $cantidad, $unidadalm, $unit, $subtotal, $costo, $almacen, 1, $usuario);
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

            $adiRec = $pos->insertaMovimiento($tipoMov, $tipo, $movimiento, $numeroMov, $fecha, $centroCosto, $docu, $producto, $cantidad, $unidadalm, $unit, $subtotal, $costo, $almacen, 1, $usuario);
        }
    }

    $asignaMov = $pos->numeroSalida($nFact, $amb, $numeroMov);

    echo $numeroMov;

    include_once 'imprimeSalidasPos.php';
}

?>
 