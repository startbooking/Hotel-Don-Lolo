<?php

require '../../../res/php/configdb.php';
require '../../../res/php/app_topInventario.php';
require '../../../res/shared/BackupMySQL.php';

extract($_POST);

$fechaing = date('Y-m-d');
$datosCierre = $inven->datosCerrados();
$bodegas = $inven->getBodegas();

$anio = $datosCierre[0]['anio_actual'];
$mes = $datosCierre[0]['periodo_cerrado'];

if ($periodo == 13) {
    $mes = 1;
    $anio = $anio + 1;
} else {
    $mes = $periodo + 1;
}

$mes = str_pad($mes, 2, '0', STR_PAD_LEFT);
$tipo = 1;
$movimiento = 1;
$tipomovi = $inven->getMovimientoCierre();

$fecha = $anio.$mes.'01';

/* foreach ($bodegas as $key => $bodega) {
    $saldos = $inven->getTraeKardex($bodega['id_bodega']);
    if (count($saldos) > 0) {
        $numeroMov = $inven->getNumeroMovimientoInventario($tipo);
        $increment = $inven->incrementaNumeroMovimientoInv($tipo, $numeroMov + 1);

        foreach ($saldos as $key => $saldo) {
            $producto = $saldo['id_producto'];
            $almacen = $saldo['id_bodega'];
            $unidadalm = $saldo['unidad_alm'];
            $cantidad = $saldo['saldo'];
            $unit = $saldo['promedio'];
            $subtotal = $unit * $cantidad;
            $total = $subtotal;

            if ($cantidad != 0) {
                $insertMovi = $inven->insertaMovimiento($tipo, $movimiento, $tipomovi, $numeroMov, $fecha, $fechaing, 0, 0, $producto, $cantidad, $unidadalm, $unit, $subtotal, $total, 0, 0, 0, $almacen, 1, $user);
            }
        }
        require '../../views/prints/imprimeEntradas.php';
    }
}

$envioMov = $inven->enviaHistoricoMovimientos($periodo,$anio);
$envioPed = $inven->enviaHistoricoPedidos($periodo,$anio);
$envioReq = $inven->enviaHistoricoRequisicion($periodo,$anio);

$borraMov = $inven->eliminaMovimientos($periodo,$anio);
$borraPed = $inven->eliminaPedidos($periodo,$anio);
$borraReq = $inven->eliminaRequisicion($periodo,$anio);

$actPar = $inven->actualizaFechas($periodo, $anio); */

?>






