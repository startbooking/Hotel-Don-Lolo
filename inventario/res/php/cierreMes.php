<?php

require '../../../res/php/configdb.php';
require '../../../res/php/app_topInventario.php';
require '../../../res/shared/BackupMySQL.php';
$postBody = json_decode(file_get_contents('php://input'), true);
extract($postBody);

$fechaing = date('Y-m-d');
$datosCierre = $inven->datosCerrados();
$bodegas = $inven->getBodegas();

$anioAct = $datosCierre[0]['anio_actual'];
if($anioAct== null){
    $anioAct = $anio;
}
$mesCer = $datosCierre[0]['periodo_cerrado'];

if($mesCer==null){
    $mesCer= $mes-1; 
}
$mesAct = $mesCer + 1;
$mesPro = $mesAct + 1 ;

if($mesAct == 12){
    $mesPro = 1 ;
    $anioAct = $anioAct + 1 ;
}
if ($mesCer == 12) {
    $mesCer = 1;
    $mesAct = $mesCer;
    $mesPro = $mesAct + 1 ;
} else {
    $mesCer = $mesCer + 1;
}

// $mesCer = str_pad($mesCer, 2, '0', STR_PAD_LEFT);
$tipo = 1;
$movimiento = 1;
$tipomovi = $inven->getMovimientoCierre();

$fecha = $anioAct . str_pad($mesPro, 2, '0', STR_PAD_LEFT) . '01';

echo $fecha;

foreach ($bodegas as $key => $bodega) {
    $saldos = $inven->traeKardexCierre($bodega['id_bodega'], $mes, $anio );
    if (count($saldos) > 0) {
        $numeroMov = $inven->getNumeroMovimientoInventario($tipo);
        $increment = $inven->incrementaNumeroMovimientoInv($tipo, $numeroMov + 1);

        foreach ($saldos as $key => $saldo) {
            $producto = $saldo['id_producto'];
            $almacen = $saldo['id_bodega'];
            $unidadalm = $saldo['unidad_alm'];
            $cantidad = $saldo['saldo'];
            if($saldo['promedio']==null){
                $unit = 0;
            }else{
                $unit = $saldo['promedio'];
            }
            $subtotal = $unit * $cantidad;
            $total = $subtotal;

            if ($cantidad != 0) {
                $insertMovi = $inven->insertaMovimiento($tipo, $movimiento, $tipomovi, $numeroMov, $fecha, $fechaing, 0, 0, $producto, $cantidad, $unidadalm, $unit, $subtotal, $total, 0, 0, 0, $almacen, 1, $usuario);
            }
        }
        require '../../views/prints/imprimeEntradas.php';
    }
}

$envioMov = $inven->enviaHistoricoMovimientos($mes,$anio);
$envioPed = $inven->enviaHistoricoPedidos($mes,$anio);
$envioReq = $inven->enviaHistoricoRequisicion($mes,$anio);

$actPar = $inven->actualizaFechas($mesCer, $anioAct);

$borraMov = $inven->eliminaMovimientos($mes,$anio);
$borraPed = $inven->eliminaPedidos($mes,$anio);
$borraReq = $inven->eliminaRequisicion($mes,$anio);

echo '1';