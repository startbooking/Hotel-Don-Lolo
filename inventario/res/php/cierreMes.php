<?php

require '../../../res/php/configdb.php';
require '../../../res/php/app_topInventario.php';
require '../../../res/shared/BackupMySQL.php';
$postBody = json_decode(file_get_contents('php://input'), true);
extract($postBody);

$fechaing = date('Y-m-d');
$datosCierre = $inven->datosCerrados();
$bodegas = $inven->getBodegas();

$anioCer = $datosCierre[0]['anio_actual'];
if($anioCer== null){
    $anioCer = $anio;
}
$mesCer = $datosCierre[0]['periodo_cerrado'];

if($mesCer==null){
    $mesCer= $mes; 
}

if ($mesCer == 13) {
    $mesCer = 1;
    $anioCer = $anioCer + 1;
} else {
    $mesCer = $mesCer + 1;
}

$mesCer = str_pad($mesCer, 2, '0', STR_PAD_LEFT);
$tipo = 1;
$movimiento = 1;
$tipomovi = $inven->getMovimientoCierre();

$fecha = $anioCer . $mesCer . '01';

foreach ($bodegas as $key => $bodega) {
    $saldos = $inven->traeKardexCierre($bodega['id_bodega'], $mes, $anio );
    echo print_r($saldos);
    echo $bodega['id_bodega'];
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
                $insertMovi = $inven->insertaMovimiento($tipo, $movimiento, $tipomovi, $numeroMov, $fecha, $fechaing, 0, 0, $producto, $cantidad, $unidadalm, $unit, $subtotal, $total, 0, 0, 0, $almacen, 1, $usuario);
            }
        }
        require '../../views/prints/imprimeEntradas.php';
    }
}


echo 1;
/* 

$envioMov = $inven->enviaHistoricoMovimientos($mes,$anio);
$envioPed = $inven->enviaHistoricoPedidos($mes,$anio);
$envioReq = $inven->enviaHistoricoRequisicion($mes,$anio);
$borraMov = $inven->eliminaMovimientos($periodo,$anio);
$borraPed = $inven->eliminaPedidos($periodo,$anio);
$borraReq = $inven->eliminaRequisicion($periodo,$anio);

$actPar = $inven->actualizaFechas($periodo, $anio); */
