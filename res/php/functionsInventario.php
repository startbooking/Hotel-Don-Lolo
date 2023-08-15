<?php

require_once 'init.php';
date_default_timezone_set('America/Bogota');
class Inventario_User
{
    public function actualizaValorReceta($receta, $costo)
    {
        global $database;

        $data = $database->query("UPDATE recetasEstandar SET valor_costo = '$costo', valor_costo_porcion = ('$costo' / cantidad) WHERE id_receta = '$receta' ");

        return $data->rowCount();
    }

    public function getValorPromedioProducto($bodega, $producto)
    {
        global $database;

        $data = $database->query("SELECT productos_inventario.id_producto, productos_inventario.nombre_producto, unidades.descripcion_unidad, movimientos_inventario.unidad_alm, movimientos_inventario.id_bodega, SUM(if(movimientos_inventario.movimiento=1,movimientos_inventario.cantidad,0)) AS entradas, SUM(if(movimientos_inventario.movimiento=2,movimientos_inventario.cantidad,0)) AS salidas, SUM(if(movimientos_inventario.movimiento=1,movimientos_inventario.cantidad,0) - if(movimientos_inventario.movimiento=2,movimientos_inventario.cantidad,0)) AS saldo, SUM(if(movimientos_inventario.movimiento=1,movimientos_inventario.valor_subtotal,0)) / SUM(if(movimientos_inventario.movimiento=1,movimientos_inventario.cantidad,0)) AS promedio FROM productos_inventario, movimientos_inventario, unidades WHERE movimientos_inventario.id_producto = productos_inventario.id_producto AND movimientos_inventario.estado = 1 AND productos_inventario.unidad_almacena = unidades.id_unidad AND movimientos_inventario.id_bodega = '$bodega' AND movimientos_inventario.id_producto = '$producto' GROUP BY productos_inventario.nombre_producto ORDER BY productos_inventario.nombre_producto ASC")->fetchAll();

        return $data;
    }

    public function valorCostoReceta($receta)
    {
        global $database;

        $data = $database->query("SELECT sum(productos_recetas.valor_promedio) as costo FROM productos_recetas WHERE productos_recetas.id_receta = '$receta' AND productos_recetas.deleted_at IS NULL")->fetchAll();

        return $data[0]['costo'];
    }

    public function valorCostoRecetaOld($receta)
    {
        global $database;

        $data = $database->query("SELECT Sum(productos_recetas.valor_promedio) AS costo FROM productos_recetas WHERE productos_recetas.id_receta = '$receta' AND productos_recetas.deleted_at is Null GROUP BY productos_recetas.id_receta")->fetchAll();

        return $data[0]['costo'];
    }

    public function traeRecetaProducto($producto)
    {
        global $database;

        $data = $database->select('productos_recetas', [
            'id_receta',
        ], [
            'id_producto' => $producto,
            'deleted_at' => null,
            'ORDER' => ['id_receta' => 'ASC'],
        ]);

        return $data;
    }

    public function medidaProduccion($prod)
    {
        global $database;

        $data = $database->query("SELECT conversiones.valor_conversion FROM productos_inventario, conversiones WHERE productos_inventario.id_producto = $prod AND productos_inventario.unidad_procesa = conversiones.id_conversion AND productos_inventario.unidad_almacena = conversiones.id_unidad")->fetchAll();

        return $data[0]['valor_conversion'];
    }

    public function actualizapromedioReceta($producto, $promedio)
    {
        global $database;

        $data = $database->query("UPDATE productos_recetas SET valor_unitario_promedio = '$promedio', valor_promedio = cantidad * '$promedio' WHERE id_producto = '$producto' ")->fetchAll();

        return $data;
    }

    public function buscaConversion($unidad, $unidadalm)
    {
        global $database;

        $data = $database->select('conversiones', [
            'valor_conversion',
        ], [
            'id_unidad' => $unidad,
            'id_conversion' => $unidadalm,
        ]);

        return $data;
    }

    public function ocupacionHotel($desde, $hasta)
    {
        global $database;

        $data = $database->query("SELECT sum(can_hombres+can_mujeres+can_ninos) AS pax FROM reservas_pms WHERE fecha_llegada>='$desde' AND fecha_salida <= '$hasta' ")->fetchAll();

        return $data[0]['pax'];
    }

    public function movimientoCierre()
    {
        global $database;

        $data = $database->insert('tipo_movimiento_inventario', [
            'descripcion_tipo' => 'SALDO INICIAL PERIODO',
            'tipo' => 1,
            'cierre' => 1,
        ]);
 
        return $database->id();
    }

    public function actualizaFechas($periodo, $anio)
    {
        global $database;

        $data = $database->update('parametros_inv', [
            'periodo_cerrado' => $periodo,
            'anio_actual' => $anio,
        ]);

        return $data->rowCount();
    }

    public function eliminaRequisicion($periodo)
    {
        global $database;

        $data = $database->query("DELETE FROM requisiciones WHERE month(fecha_req) = '$periodo'")->fetchAll();

        return $data;
    }

    public function enviaHistoricoRequisicion($periodo)
    {
        global $database;

        $data = $database->query("INSERT INTO historico_requisiciones SELECT * FROM requisiciones WHERE month(fecha_red)  = '$periodo'")->fetchAll();

        return $database->id();
    }

    public function eliminaPedidos($periodo)
    {
        global $database;

        $data = $database->query("DELETE FROM pedidos WHERE month(fecha_ped) = '$periodo'")->fetchAll();

        return $data;
    }

    public function enviaHistoricoPedidos($periodo)
    {
        global $database;

        $data = $database->query("INSERT INTO historico_pedidos SELECT * FROM pedidos WHERE month(fecha_ped)  = '$periodo'")->fetchAll();

        return $database->id();
    }

    public function eliminaMovimientos($periodo)
    {
        global $database;

        $data = $database->query("DELETE FROM movimientos_inventario WHERE month(fecha_movimiento) = '$periodo'")->fetchAll();

        return $data;
    }

    public function enviaHistoricoMovimientos($periodo)
    {
        global $database;

        $data = $database->query("INSERT INTO historico_movimientos_inventario SELECT * FROM movimientos_inventario WHERE month(fecha_movimiento)  = '$periodo'")->fetchAll();

        return $database->id();
    }

    public function getMovimientoCierre()
    {
        global $database;

        $data = $database->select('tipo_movimiento_inventario', [
            'id_tipomovi',
        ], [
            'cierre' => 1,
        ]);
        if (count($data) == 0) {
            return 0;
        } else {
            return $data[0]['id_tipomovi'];
        }
    }

    public function datosCerrados()
    {
        global $database;

        $data = $database->select('parametros_inv', [
            'periodo_cerrado',
            'anio_actual',
        ]);

        return $data;
    }

    public function mesCerrar()
    {
        global $database;

        $data = $database->query('SELECT DISTINCT month(fecha_movimiento) AS mes FROM movimientos_inventario LIMIT 1')->fetchAll();

        return $data[0]['mes'];
    }

    public function periodosActivos()
    {
        global $database;

        $data = $database->query('SELECT DISTINCT month(fecha_movimiento) AS mes FROM movimientos_inventario')->fetchAll();

        return $data;
    }

    public function updatePedido($numero, $codigo, $canti, $valcant)
    {
        global $database;

        $data = $database->update('pedidos', [
            'cantidad' => $canti,
            'valor_total' => $valcant,
        ], [
            'numero_ped' => $numero,
            'id_producto' => $codigo,
        ]);

        return $data->rowCount();
    }

    public function updateRequisicion($numero, $codigo, $canti, $valcant)
    {
        global $database;

        $data = $database->update('requisiciones', [
            'cantidad' => $canti,
            'valor_total' => $valcant,
        ], [
            'numero_req' => $numero,
            'id_producto' => $codigo,
        ]);

        return $data->rowCount();
    }

    public function buscaProductoRecetaReq($numero, $codigo)
    {
        global $database;

        $data = $database->select('pedidos', [
            'cantidad',
            'valor_unitario',
        ], [
            'numero_ped' => $numero,
            'id_producto' => $codigo,
        ]);

        return $data;
    }

    public function getProductosRecetas($receta, $cant, $porc)
    {
        global $database;

        $data = $database->query("SELECT productos_inventario.nombre_producto, productos_inventario.valor_costo, productos_inventario.valor_promedio, productos_inventario.unidad_compra, productos_inventario.unidad_almacena, productos_inventario.unidad_procesa,productos_recetas.id_producto, productos_recetas.id_unidad_procesa, productos_recetas.cantidad, '$cant' as cantPedida, '$porc' as porciones, conversiones.id, conversiones.valor_conversion FROM productos_inventario, productos_recetas, conversiones WHERE productos_inventario.id_producto = productos_recetas.id_producto AND productos_recetas.deleted_at IS NULL AND productos_recetas.id_receta = '$receta' AND productos_inventario.unidad_procesa = conversiones.id_conversion AND productos_inventario.unidad_almacena = conversiones.id_unidad ORDER BY productos_inventario.nombre_producto ASC")->fetchAll();

        return $data;
    }

    public function getBuscaReceta($id)
    {
        global $database;

        $data = $database->select('recetasEstandar', [
            'id_receta',
            'nombre_receta',
            'id_seccion',
            'subreceta',
            'cantidad',
            'valor_costo',
            'valor_costo_porcion',
            'valor_venta',
            'valor_impto',
            'valor_neto',
            'valor_porcion',
        ], [
            'id_receta' => $id,
        ]);

        return $data;
    }

    public function getRecetas()
    {
        global $database;

        $data = $database->select('recetasEstandar', [
            '[<]codigos_vta' => ['id_impuesto' => 'id_cargo'],
            '[<]secciones_pos' => ['id_seccion' => 'id_seccion'],
        ], [
            'codigos_vta.descripcion_cargo',
            'secciones_pos.nombre_seccion',
            'recetasEstandar.id_receta',
            'recetasEstandar.cantidad',
            'recetasEstandar.nombre_receta',
            'recetasEstandar.valor_costo',
            'recetasEstandar.valor_costo_porcion',
            'recetasEstandar.valor_venta',
            'recetasEstandar.valor_impto',
            'recetasEstandar.valor_neto',
            'recetasEstandar.valor_porcion',
            'recetasEstandar.foto',
            'recetasEstandar.id_impuesto',
            'recetasEstandar.por_costo_max',
            'recetasEstandar.por_costo_min',
            'recetasEstandar.por_costo',
            'recetasEstandar.estado',
            'recetasEstandar.id_seccion',
            'recetasEstandar.actived_at',
        ], [
            'recetasEstandar.estado' => 1,
            'recetasEstandar.deleted_at' => null,
            'ORDER' => [
                'recetasEstandar.nombre_receta' => 'ASC',
            ],
        ]);

        return $data;
    }

    public function getRequisicionDetallado($numeroReq)
    {
        global $database;

        $data = $database->query("SELECT requisiciones.numero_req, requisiciones.fecha_req, requisiciones.id_centrocosto, requisiciones.cantidad, requisiciones.valor_unitario, requisiciones.valor_total, productos_inventario.nombre_producto, bodegas.descripcion_bodega, centrocosto.descripcion_centro, unidades.descripcion_unidad FROM requisiciones , productos_inventario , bodegas , centrocosto , unidades WHERE requisiciones.id_producto = productos_inventario.id_producto AND requisiciones.id_bodega = bodegas.id_bodega AND requisiciones.id_centrocosto = centrocosto.id_centrocosto AND requisiciones.id_unidad = unidades.id_unidad AND requisiciones.numero_req = '$numeroReq' ORDER BY productos_inventario.nombre_producto ASC"
        )->fetchAll();

        return $data;
    }

    public function getPedidoDetallado($numeroPed)
    {
        global $database;

        $data = $database->query("SELECT pedidos.numero_ped, pedidos.fecha_ped, pedidos.id_centrocosto, pedidos.cantidad, pedidos.valor_unitario, pedidos.valor_total, productos_inventario.nombre_producto, companias.empresa, companias.direccion, centrocosto.descripcion_centro, unidades.descripcion_unidad FROM pedidos, productos_inventario, companias, centrocosto, unidades WHERE pedidos.id_producto = productos_inventario.id_producto AND pedidos.id_proveedor = companias.id_compania AND pedidos.id_centrocosto = centrocosto.id_centrocosto AND pedidos.id_unidad = unidades.id_unidad AND pedidos.numero_ped = '$numeroPed' ORDER BY productos_inventario.nombre_producto ASC")->fetchAll();

        return $data;
    }

    public function insertaPedido($numero, $centro, $proveedor, $fecha, $cantidad, $codigo, $costo, $total, $unidadalm, $user)
    {
        global $database;

        $data = $database->insert('pedidos', [
            'numero_ped' => $numero,
            'id_centrocosto' => $centro,
            'id_proveedor' => $proveedor,
            'fecha_ped' => $fecha,
            'cantidad' => $cantidad,
            'id_producto' => $codigo,
            'valor_unitario' => $costo,
            'valor_total' => $total,
            'id_unidad' => $unidadalm,
            'estado' => 1,
            'usuario' => $user,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return $database->id();
    }

    public function getBuscaProductosPedido($numero)
    {
        global $database;

        $data = $database->select('pedidos', [
            '[>]productos_inventario' => ['id_producto' => 'id_producto'],
        ], [
            'productos_inventario.nombre_producto',
            'pedidos.numero_ped',
            'pedidos.cantidad',
            'pedidos.id_producto',
            'pedidos.id_unidad',
            'pedidos.valor_unitario',
            'pedidos.valor_total',
            'pedidos.id_pedido',
        ], [
            'pedidos.numero_ped' => $numero,
        ]);

        return $data;
    }

    public function anulaPedido($id, $usuario)
    {
        global $database;

        $data = $database->update('pedidos', [
            'estado' => 0,
            'usuario_anula' => $usuario,
            'fecha_anula' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ], [
            'numero_ped' => $id,
        ]);

        return $data->rowCount();
    }

    public function getPedidos()
    {
        global $database;

        $data = $database->query('
				SELECT pedidos.numero_ped, 
				pedidos.fecha_ped, 
				pedidos.id_centrocosto, 
				pedidos.id_proveedor, 
				Sum(pedidos.valor_total) as total, 
				centrocosto.descripcion_centro, 
				pedidos.estado 
				FROM pedidos, centrocosto 
				WHERE pedidos.id_centrocosto = centrocosto.id_centrocosto GROUP BY pedidos.numero_ped, pedidos.fecha_ped')->fetchAll();

        return $data;
    }

    public function getAlmacenPrincipal($almacen)
    {
        global $database;

        $data = $database->select('bodegas', [
            'tipo_bodega',
        ], [
            'id_bodega' => $almacen,
        ]);

        return $data[0]['tipo_bodega'];
    }

    public function calculaPromedioProd($prod, $bodega)
    {
        global $database;

        $data = $database->query("SELECT Sum(if(movimientos_inventario.movimiento=1,movimientos_inventario.cantidad,0)) AS entradas, Sum(if(movimientos_inventario.movimiento=2,movimientos_inventario.cantidad,0)) AS salidas, Sum(if(movimientos_inventario.movimiento=1,movimientos_inventario.cantidad,0) - if(movimientos_inventario.movimiento=2,movimientos_inventario.cantidad,0)) AS saldo, Sum(if(movimientos_inventario.movimiento=1,movimientos_inventario.valor_subtotal,0)) AS valorentradas, Sum(if(movimientos_inventario.movimiento=2,movimientos_inventario.valor_subtotal,0)) AS valorsalidas, Sum(if(movimientos_inventario.movimiento=1,movimientos_inventario.valor_subtotal,0) - if(movimientos_inventario.movimiento=2,movimientos_inventario.valor_subtotal,0)) AS valorsaldo, SUM(if(movimientos_inventario.movimiento=1,movimientos_inventario.valor_subtotal,0)) / SUM(if(movimientos_inventario.movimiento=1,movimientos_inventario.cantidad,0)) AS promedio FROM movimientos_inventario WHERE movimientos_inventario.estado = 1 AND movimientos_inventario.id_bodega = '$bodega' AND movimientos_inventario.id_producto = '$prod'")->fetchAll();

        return $data;
    }

    public function actualizaValorProd($prod, $entra, $sale, $saldo, $valentra, $valsale, $valsaldo, $promedio)
    {
        global $database;

        $data = $database->update('productos_inventario', [
            'entradas' => $entra,
            'salidas' => $sale,
            'saldo' => $saldo,
            'valor_entradas' => round($valentra, 4),
            'valor_salidas' => round($valsale, 4),
            'valor_saldo' => round($valsaldo, 4),
            'valor_promedio' => round($promedio, 4),
        ], [
            'id_producto' => $prod,
        ]);

        return $data->rowCount();
    }

    public function anulaRequisicion($id, $usuario)
    {
        global $database;

        $data = $database->update('requisiciones', [
            'estado' => 0,
            'usuario_anula' => $usuario,
            'fecha_anula' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ], [
            'numero_req' => $id,
        ]);

        return $data->rowCount();
    }

    public function getRequisiciones()
    {
        global $database;

        $data = $database->query('
				SELECT requisiciones.numero_req, 
				requisiciones.fecha_req, 
				requisiciones.id_bodega, 
				requisiciones.id_centrocosto, 
				Sum(requisiciones.valor_total) as total, 
				bodegas.descripcion_bodega, 
				requisiciones.estado 
				FROM requisiciones, bodegas 
				WHERE requisiciones.id_bodega = bodegas.id_bodega GROUP BY requisiciones.numero_req, requisiciones.fecha_req')->fetchAll();

        return $data;
    }

    public function insertaRequisicion($numero, $centro, $almacen, $fecha, $cantidad, $codigo, $costo, $total, $unidadalm, $user)
    {
        global $database;

        $data = $database->insert('requisiciones', [
            'numero_req' => $numero,
            'id_centrocosto' => $centro,
            'id_bodega' => $almacen,
            'fecha_req' => $fecha,
            'cantidad' => $cantidad,
            'id_producto' => $codigo,
            'valor_unitario' => $costo,
            'valor_total' => $total,
            'id_unidad' => $unidadalm,
            'estado' => 1,
            'usuario' => $user,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return $database->id();
    }

    public function getBuscaProductosRequisicion($numero)
    {
        global $database;

        $data = $database->select('requisiciones', [
            '[>]productos_inventario' => ['id_producto' => 'id_producto'],
        ], [
            'productos_inventario.nombre_producto',
            'requisiciones.numero_req',
            'requisiciones.cantidad',
            'requisiciones.id_producto',
            'requisiciones.id_unidad',
            'requisiciones.valor_unitario',
            'requisiciones.valor_total',
            'requisiciones.id_requisicion',
        ], [
            'requisiciones.numero_req' => $numero,
        ]);

        return $data;
    }

    public function getCantidadMovimientos($tipo)
    {
        global $database;

        $data = $database->count('movimientos_inventario.cantidad', [
        ], [
        ]);

        return $data;
    }

    public function getBuscaProductoMovimiento($id, $bodega)
    {
        global $database;

        $data = $database->select('movimientos_inventario', [
            '[>]tipo_movimiento_inventario' => ['tipo_movi' => 'id_tipomovi'],
        ], [
            'tipo_movimiento_inventario.descripcion_tipo',
            'movimientos_inventario.numero',
            'movimientos_inventario.tipo_movi',
            'movimientos_inventario.fecha_movimiento',
            'movimientos_inventario.cantidad',
            'movimientos_inventario.unidad_alm',
            'movimientos_inventario.valor_unitario',
            'movimientos_inventario.impuesto',
            'movimientos_inventario.valor_total',
        ], [
            'movimientos_inventario.id_producto' => $id,
            'movimientos_inventario.id_bodega' => $bodega,
            'movimientos_inventario.estado' => 1,
        ]);

        return $data;
    }

    public function getBuscaMovimiento($codigo)
    {
        global $database;

        $data = $database->select('tipo_movimiento_inventario', [
            'descripcion_tipo',
        ], [
            'id_tipomovi' => $codigo,
        ]);

        return trim($data[0]['descripcion_tipo']);
    }

    public function getBuscaTipoMovimiento($codigo)
    {
        global $database;

        $data = $database->select('tipo_movimiento_inventario', [
            'tipo',
        ], [
            'id_tipomovi' => $codigo,
        ]);

        return trim($data[0]['tipo']);
    }

    public function tipoMovimientoAjustes()
    {
        global $database;

        $data = $database->select('tipo_movimiento_inventario', [
            'id_tipomovi',
            'descripcion_tipo',
        ], [
            'ajuste' => 1,
        ]);

        return $data;
    }

    public function getProductosMovimiento($numero, $tipo)
    {
        global $database;

        $data = $database->select('movimientos_inventario', [
            'cantidad',
            'valor_unitario',
            'valor_subtotal',
            'impuesto',
            'valor_total',
            'usuario',
            'fecha',
            'fecha_ingreso',
            'id_proveedor',
            'documento',
        ], [
            'tipo' => $tipo,
            'numero' => $numero,
        ]);

        return $data;
    }

    public function buscaCentroCosto($id)
    {
        global $database;

        $data = $database->select('centrocosto', [
            'descripcion_centro',
        ], [
            'id_centrocosto' => $id,
        ]);

        return $data[0]['descripcion_centro'];
    }

    public function buscaProveedor($id)
    {
        global $database;

        $data = $database->select('companias', [
            'empresa',
        ], [
            'id_compania' => $id,
        ]);
        if (count($data) == 0) {
            return 'SIN PROVEEDOR';
        } else {
            return $data[0]['empresa'];
        }
    }

    public function buscaAlmacen($id)
    {
        global $database;

        $data = $database->select('bodegas', [
            'descripcion_bodega',
        ], [
            'id_bodega' => $id,
        ]);

        return $data[0]['descripcion_bodega'];
    }

    public function buscaUnidad($id)
    {
        global $database;

        $data = $database->select('unidades', [
            'descripcion_unidad',
        ], [
            'id_unidad' => $id,
        ]);

        return $data[0]['descripcion_unidad'];
    }

    public function insertaMovimientoTraslado($tipomovi, $tipo, $movimi, $numeroMov, $fecham, $fechaing, $provee, $producto, $cantidad, $unidadalm, $unit, $total, $almacen, $estado, $usuario)
    {
        global $database;

        $data = $database->insert('movimientos_inventario', [
            'tipo' => $tipomovi,
            'tipo_movi' => $movimi,
            'movimiento' => $tipo,
            'numero' => $numeroMov,
            'fecha_movimiento' => $fecham,
            'fecha_ingreso' => date('Y-m-d H:i:s'),
            'id_proveedor' => $provee,
            'id_producto' => $producto,
            'cantidad' => $cantidad,
            'unidad_alm' => $unidadalm,
            'valor_unitario' => $unit,
            'valor_subtotal' => $unit * $cantidad,
            'valor_total' => $total,
            'id_bodega' => $almacen,
            'estado' => $estado,
            'usuario' => $usuario,
            'traslado' => 1,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return $database->id();
    }

    public function tipoMovimientoTraslado($tipo)
    {
        global $database;

        $data = $database->select('tipo_movimiento_inventario', [
            'id_tipomovi',
            'descripcion_tipo',
        ], [
            'tipo' => $tipo,
            'ajuste' => '0',
            'traslado' => '1',
        ]);

        return $data;
    }

    public function getAjustesInventarios($tipo)
    {
        global $database;

        $data = $database->query("
				SELECT movimientos_inventario.numero, 
				tipo_movimiento_inventario.descripcion_tipo, 
				movimientos_inventario.documento, 
				movimientos_inventario.fecha_movimiento, 
				movimientos_inventario.id_proveedor, 
				movimientos_inventario.traslado, 
				movimientos_inventario.movimiento, 
				movimientos_inventario.tipo,
				movimientos_inventario.id_bodega,
				Sum(movimientos_inventario.valor_subtotal) as subtotal, 
				Sum(movimientos_inventario.impuesto) as impto, 
				Sum(movimientos_inventario.valor_total) as total, 
				bodegas.descripcion_bodega, 
				movimientos_inventario.estado 
				FROM movimientos_inventario, tipo_movimiento_inventario, bodegas 
				WHERE movimientos_inventario.tipo_movi = tipo_movimiento_inventario.id_tipomovi AND movimientos_inventario.tipo = '$tipo' AND movimientos_inventario.id_bodega = bodegas.id_bodega GROUP BY movimientos_inventario.numero, tipo_movimiento_inventario.descripcion_tipo, movimientos_inventario.documento, movimientos_inventario.fecha_movimiento")->fetchAll();

        return $data;
    }

    public function getSalidasInventarios($tipo)
    {
        global $database;

        $data = $database->query("SELECT movimientos_inventario.numero, tipo_movimiento_inventario.descripcion_tipo, movimientos_inventario.tipo, movimientos_inventario.documento, movimientos_inventario.fecha_movimiento, movimientos_inventario.id_bodega, movimientos_inventario.movimiento, Sum(movimientos_inventario.valor_total) as total, movimientos_inventario.estado, centrocosto.descripcion_centro, movimientos_inventario.id_proveedor, bodegas.descripcion_bodega FROM movimientos_inventario , tipo_movimiento_inventario , centrocosto, bodegas WHERE movimientos_inventario.tipo_movi = tipo_movimiento_inventario.id_tipomovi AND movimientos_inventario.tipo = '$tipo' AND movimientos_inventario.id_proveedor = centrocosto.id_centrocosto AND movimientos_inventario.id_bodega = bodegas.id_bodega GROUP BY movimientos_inventario.numero, tipo_movimiento_inventario.descripcion_tipo, movimientos_inventario.documento, movimientos_inventario.fecha_movimiento ORDER BY movimientos_inventario.numero")->fetchAll();

        return $data;
    }

    public function getMovimientosInventarios($tipo)
    {
        global $database;

        $data = $database->query("
				SELECT movimientos_inventario.numero, 
				tipo_movimiento_inventario.descripcion_tipo, 
				movimientos_inventario.documento, 
				movimientos_inventario.fecha_movimiento, 
				movimientos_inventario.id_proveedor, 
				movimientos_inventario.traslado, 
				movimientos_inventario.movimiento, 
				movimientos_inventario.tipo,
				movimientos_inventario.id_bodega,
				Sum(movimientos_inventario.valor_subtotal) as subtotal, 
				Sum(movimientos_inventario.impuesto) as impto, 
				Sum(movimientos_inventario.valor_total) as total, 
				bodegas.descripcion_bodega, 
				movimientos_inventario.estado 
				FROM movimientos_inventario, tipo_movimiento_inventario, bodegas 
				WHERE movimientos_inventario.tipo_movi = tipo_movimiento_inventario.id_tipomovi AND movimientos_inventario.tipo = '$tipo' AND movimientos_inventario.id_bodega = bodegas.id_bodega GROUP BY movimientos_inventario.numero, tipo_movimiento_inventario.descripcion_tipo, movimientos_inventario.documento, movimientos_inventario.fecha_movimiento")->fetchAll();

        return $data;
    }

    public function getMovimientosTraslados($tipo)
    {
        global $database;

        $data = $database->query("SELECT movimientos_inventario.numero, tipo_movimiento_inventario.descripcion_tipo, movimientos_inventario.documento, movimientos_inventario.fecha_movimiento, movimientos_inventario.tipo, movimientos_inventario.movimiento, Sum(movimientos_inventario.valor_subtotal) as subtotal, Sum(movimientos_inventario.impuesto) as impto, Sum(movimientos_inventario.valor_total) as total,  bodegas.descripcion_bodega, bodegas.id_bodega,  movimientos_inventario.estado, movimientos_inventario.id_proveedor FROM movimientos_inventario, tipo_movimiento_inventario, bodegas WHERE movimientos_inventario.movimiento = 1 AND movimientos_inventario.tipo_movi = tipo_movimiento_inventario.id_tipomovi AND movimientos_inventario.traslado = '$tipo' AND movimientos_inventario.estado = 1 AND movimientos_inventario.id_bodega = bodegas.id_bodega GROUP BY movimientos_inventario.numero, tipo_movimiento_inventario.descripcion_tipo, movimientos_inventario.documento, movimientos_inventario.fecha_movimiento")->fetchAll();

        return $data;
    }

    public function getTraeKardex($bodega)
    {
        global $database;

        $data = $database->query("SELECT productos_inventario.id_producto, productos_inventario.nombre_producto, unidades.descripcion_unidad, movimientos_inventario.unidad_alm, movimientos_inventario.id_bodega, SUM(if(movimientos_inventario.movimiento=1,movimientos_inventario.cantidad,0)) AS entradas, SUM(if(movimientos_inventario.movimiento=2,movimientos_inventario.cantidad,0)) AS salidas, SUM(if(movimientos_inventario.movimiento=1,movimientos_inventario.cantidad,0) - if(movimientos_inventario.movimiento=2,movimientos_inventario.cantidad,0)) AS saldo, SUM(if(movimientos_inventario.movimiento=1,movimientos_inventario.valor_subtotal,0)) / SUM(if(movimientos_inventario.movimiento=1,movimientos_inventario.cantidad,0)) AS promedio FROM productos_inventario, movimientos_inventario, unidades WHERE movimientos_inventario.id_producto = productos_inventario.id_producto AND movimientos_inventario.estado = 1 AND productos_inventario.unidad_almacena = unidades.id_unidad AND movimientos_inventario.id_bodega = '$bodega' GROUP BY productos_inventario.nombre_producto ORDER BY productos_inventario.nombre_producto ASC")->fetchAll();

        return $data;
    }

    public function anulaMovimiento($id, $tipo, $usuario)
    {
        global $database;

        $data = $database->update('movimientos_inventario', [
            'estado' => 0,
            'usuario_anula' => $usuario,
            'fecha_anula' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ], [
            'numero' => $id,
            'tipo' => $tipo,
        ]);

        return $data->rowCount();
    }

    public function updateProveedor($id, $empresa, $nit, $digito, $direccion, $telefono, $celular, $email, $web, $tipoemp, $tipodoc, $ciiu, $ciudad)
    {
        global $database;

        $data = $database->update('companias', [
            'empresa' => $empresa,
            'direccion' => $direccion,
            'nit' => $nit,
            'dv' => $digito,
            'tipo_documento' => $tipodoc,
            'tipo_empresa' => $tipoemp,
            'telefono' => $telefono,
            'celular' => $celular,
            'email' => $email,
            'web' => $web,
            'ciudad' => $ciudad,
            'id_codigo_ciiu' => $ciiu,
            'activo' => 1,
            'tipo_compania' => 1,
        ], [
            'id_compania' => $id,
        ]);

        return $data->rowCount();
    }

    public function traeCompania($id)
    {
        global $database;

        $data = $database->select('companias', [
            'id_compania',
            'empresa',
            'direccion',
            'nit',
            'dv',
            'tipo_documento',
            'telefono',
            'celular',
            'fax',
            'email',
            'web',
            'ciudad',
            'id_tarifa',
            'estado_credito',
            'tipo_empresa',
            'activo',
            'id_codigo_ciiu',
            'tipo_compania',
        ], [
            'id_compania' => $id,
        ]);

        return $data;
    }

    public function deleteProducto($id)
    {
        global $database;

        $data = $database->update('productos_inventario', [
            'deleted_at' => date('Y-m-d H:i:s'),
        ], [
            'id_producto' => $id,
        ]);

        return $data->rowCount();
    }

    public function updateProducto($producto, $familia, $grupo, $subgrupo, $compra, $almacena, $procesa, $costo, $promedio, $minimo, $maximo, $ubicacion, $idprod)
    {
        global $database;

        $data = $database->update('productos_inventario', [
            'nombre_producto' => $producto,
            'id_familia' => $familia,
            'id_grupo' => $grupo,
            'id_subgrupo' => $subgrupo,
            'unidad_compra' => $compra,
            'unidad_almacena' => $almacena,
            'unidad_procesa' => $procesa,
            'valor_costo' => $costo,
            'valor_promedio' => $promedio,
            'stock_minimo' => $minimo,
            'stock_maximo' => $maximo,
            'ubicacion' => $ubicacion,
        ], [
            'id_producto' => $idprod,
        ]);

        return $data->rowCount();
    }

    public function traeProducto($id)
    {
        global $database;

        $data = $database->select('productos_inventario', [
            'id_producto',
            'id_familia',
            'id_grupo',
            'id_subgrupo',
            'nombre_producto',
            'unidad_compra',
            'unidad_almacena',
            'unidad_procesa',
            'foto',
            'valor_costo',
            'valor_promedio',
            'stock_minimo',
            'stock_maximo',
            'ubicacion',
            'porcionar',
            'cantidad_porcion',
            'equivalencia_porcion',
        ], [
            'id_producto' => $id,
        ]);

        return $data;
    }

    public function getCentroCosto()
    {
        global $database;

        $data = $database->select('centrocosto', [
            'id_centrocosto',
            'descripcion_centro',
        ], [
            'ORDER' => 'descripcion_centro',
        ]);

        return $data;
    }

    public function getUnidadAlmacena($codigo)
    {
        global $database;

        $data = $database->select('unidades', [
            'descripcion_unidad',
        ], [
            'id_unidad' => $codigo,
        ]);

        return $data[0]['descripcion_unidad'];
    }

    public function getMovimientos($tipo, $numero, $bodega)
    {
        global $database;

        $data = $database->select('movimientos_inventario', [
            '[>]productos_inventario' => 'id_producto',
        ], [
            'productos_inventario.nombre_producto',
            'movimientos_inventario.tipo_movi',
            'movimientos_inventario.fecha_movimiento',
            'movimientos_inventario.numero',
            'movimientos_inventario.fecha_ingreso',
            'movimientos_inventario.id_proveedor',
            'movimientos_inventario.documento',
            'movimientos_inventario.id_producto',
            'movimientos_inventario.cantidad',
            'movimientos_inventario.unidad_alm',
            'movimientos_inventario.valor_unitario',
            'movimientos_inventario.valor_subtotal',
            'movimientos_inventario.impuesto',
            'movimientos_inventario.valor_total',
            'movimientos_inventario.porce_impto',
            'movimientos_inventario.cod_impto',
            'movimientos_inventario.id_bodega',
            'movimientos_inventario.estado',
            'movimientos_inventario.usuario',
            'movimientos_inventario.traslado',
        ], [
            'numero' => $numero,
            'tipo' => $tipo,
            'id_bodega' => $bodega,
            'ORDER' => [
                'movimientos_inventario.movimiento',
                'productos_inventario.nombre_producto',
            ],
        ]);

        return $data;
    }

    public function insertaMovimientoAju($tipomovi, $tipo, $movimi, $numeroMov, $fecham, $fechaing, $producto, $cantidad, $unidadalm, $unit, $subtotal, $costo, $almacen, $estado, $usuario)
    {
        global $database;

        $data = $database->insert('movimientos_inventario', [
            'tipo' => $tipo,
            'tipo_movi' => $tipomovi,
            'movimiento' => $movimi,
            'numero' => $numeroMov,
            'fecha_movimiento' => $fecham,
            'fecha_ingreso' => date('Y-m-d H:i:s'),
            'id_producto' => $producto,
            'cantidad' => $cantidad,
            'unidad_alm' => $unidadalm,
            'valor_unitario' => $unit,
            'valor_subtotal' => $subtotal,
            'valor_total' => $costo,
            'id_bodega' => $almacen,
            'estado' => $estado,
            'usuario' => $usuario,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return $database->id();
    }

    public function insertaMovimiento($tipomovi, $tipo, $movimi, $numeroMov, $fecham, $fechaing, $provee, $factur, $producto, $cantidad, $unidadalm, $unit, $subtotal, $costo, $porcentajeImpto, $impuesto, $impto, $almacen, $estado, $usuario)
    {
        global $database;

        $data = $database->insert('movimientos_inventario', [
            'tipo' => $tipomovi,
            'tipo_movi' => $movimi,
            'movimiento' => $tipo,
            'numero' => $numeroMov,
            'fecha_movimiento' => $fecham,
            'fecha_ingreso' => date('Y-m-d H:i:s'),
            'id_proveedor' => $provee,
            'documento' => $factur,
            'id_producto' => $producto,
            'cantidad' => $cantidad,
            'unidad_alm' => $unidadalm,
            'valor_unitario' => $unit,
            'valor_subtotal' => $subtotal,
            'impuesto' => $impto,
            'valor_total' => $costo,
            'porce_impto' => $porcentajeImpto,
            'cod_impto' => $impuesto,
            'id_bodega' => $almacen,
            'estado' => $estado,
            'usuario' => $usuario,
        ]);

        return $database->id();
    }

    public function incrementaNumeroMovimientoInv($tipo, $nume)
    {
        global $database;

        if ($tipo == 1) {
            $campo = 'c_entradas';
        } elseif ($tipo == 2) {
            $campo = 'c_salidas';
        } elseif ($tipo == 3) {
            $campo = 'c_traslados';
        } elseif ($tipo == 4) {
            $campo = 'c_ajustes';
        } elseif ($tipo == 5) {
            $campo = 'c_requisiciones';
        } elseif ($tipo == 6) {
            $campo = 'c_pedidos';
        }
        $data = $database->update('parametros_inv', [
            $campo => $nume,
        ]);

        return $data->rowCount();
    }

    public function getNumeroMovimientoInventario($tipo)
    {
        global $database;

        switch ($tipo) {
            case 1:
                $campo = 'c_entradas';
                break;
            case 2:
                $campo = 'c_salidas';
                break;
            case 3:
                $campo = 'c_traslados';
                break;
            case 4:
                $campo = 'c_ajustes';
                break;
            case 5:
            $campo = 'c_requisiciones';
            break;
            case 6:
                $campo = 'c_pedidos';
                break;
        }

        $data = $database->select('parametros_inv', [
            $campo,
        ]);

        return $data[0][$campo];
    }

    public function getBuscaProducto($id)
    {
        global $database;

        $data = $database->select('productos_inventario', [
            'id_producto',
            'nombre_producto',
            'id_familia',
            'id_grupo',
            'id_subgrupo',
            'unidad_compra',
            'unidad_almacena',
            'unidad_procesa',
            'valor_costo',
            'valor_promedio',
            'stock_minimo',
            'stock_maximo',
            'porcionar',
            'cantidad_porcion',
            'equivalencia_porcion',
        ], [
            'id_producto' => $id,
        ]);

        return $data;
    }

    public function getBuscaUnidadCompra($id)
    {
        global $database;

        $data = $database->select('productos_inventario', [
            'unidad_compra',
        ], [
            'id_producto' => $id,
        ]);

        return $data[0]['unidad_compra'];
    }

    public function getProveedores()
    {
        global $database;

        $data = $database->select('companias', [
            'id_compania',
            'empresa',
        ], [
            'tipo_compania[<=]' => 3,
            'ORDER' => 'empresa',
        ]);

        return $data;
    }

    public function tipoMovimiento($tipo)
    {
        global $database;

        $data = $database->select('tipo_movimiento_inventario', [
            'id_tipomovi',
            'descripcion_tipo',
        ], [
            'tipo' => $tipo,
            'ajuste' => '0',
            'traslado' => '0',
        ]);

        return $data;
    }

    public function getBodegas()
    {
        global $database;

        $data = $database->select('bodegas', [
            'id_bodega',
            'descripcion_bodega',
            'tipo_bodega',
        ]);

        return $data;
    }

    public function getBodegaPrinc()
    {
        global $database;

        $data = $database->select('bodegas', [
            'id_bodega',
            'descripcion_bodega',
            'tipo_bodega',
        ], [
            'tipo_bodega' => '1',
        ]);

        return $data;
    }

    public function insertProveedor($empresa, $nit, $direccion, $digito, $telefono, $celular, $email, $web, $tipoemp, $tipodoc, $ciiu, $ciudad, $usuario)
    {
        global $database;

        $data = $database->insert('companias', [
            'empresa' => $empresa,
            'direccion' => $direccion,
            'nit' => $nit,
            'dv' => $digito,
            'tipo_documento' => $tipodoc,
            'tipo_empresa' => $tipoemp,
            'telefono' => $telefono,
            'celular' => $celular,
            'email' => $email,
            'web' => $web,
            'ciudad' => $ciudad,
            'id_codigo_ciiu' => $ciiu,
            'activo' => 1,
            'estado_credito' => 1,
            'tipo_compania' => 1,
            'usuario' => $usuario,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return $database->id();
    }

    public function getCompanias()
    {
        global $database;

        $data = $database->select('companias', [
            'id_compania',
            'empresa',
            'direccion',
            'nit',
            'dv',
            'tipo_documento',
            'telefono',
            'celular',
            'fax',
            'email',
            'id_tarifa',
            'estado_credito',
            'activo',
            'tipo_compania',
        ], [
            'ORDER' => 'empresa',
        ]);

        return $data;
    }

    public function insertProducto($producto, $familia, $grupo, $subgrupo, $compra, $almacena, $procesa, $costo, $promedio, $minimo, $maximo, $ubicacion, $usuario)
    {
        global $database;

        $data = $database->insert('productos_inventario', [
            'nombre_producto' => $producto,
            'id_familia' => $familia,
            'id_grupo' => $grupo,
            'id_subgrupo' => $subgrupo,
            'unidad_compra' => $compra,
            'unidad_almacena' => $almacena,
            'unidad_procesa' => $procesa,
            'valor_costo' => $costo,
            'valor_promedio' => $promedio,
            'stock_minimo' => $minimo,
            'stock_maximo' => $maximo,
            'ubicacion' => $ubicacion,
            'usuario' => $usuario,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return $database->id();
    }

    public function getUnidadesMedida()
    {
        global $database;

        $data = $database->select('unidades', [
            'id_unidad',
            'descripcion_unidad',
        ]);

        return $data;
    }

    public function getSubGruposFamilia($id)
    {
        global $database;

        $data = $database->select('subgrupos_inventarios', [
            'id_subgrupo',
            'descripcion_subgrupo',
        ], [
            'id_grupo' => $id,
            'ORDER' => 'descripcion_subgrupo',
        ]);

        return $data;
    }

    public function getGruposFamilia($id)
    {
        global $database;

        $data = $database->select('grupos_inventarios', [
            'id_grupo',
            'descripcion_grupo',
        ], [
            'id_familia' => $id,
            'ORDER' => 'descripcion_grupo',
        ]);

        return $data;
    }

    public function getDescriptionUnidades($id)
    {
        global $database;

        $data = $database->select('unidades', [
            'descripcion_unidad',
        ], [
            'id_unidad' => $id,
        ]);
        if (count($data) == 0) {
            return '';
        } else {
            return $data[0]['descripcion_unidad'];
        }
    }

    public function getDescriptionFamilia($id)
    {
        global $database;

        $data = $database->select('familia_inventarios', [
            'descripcion_familia',
        ], [
            'id_familia' => $id,
        ]);
        if (count($data) == 0) {
            return '';
        } else {
            return $data[0]['descripcion_familia'];
        }
    }

    public function getDescriptionGrupo($id)
    {
        global $database;

        $data = $database->select('grupos_inventarios', [
            'descripcion_grupo',
        ], [
            'id_grupo' => $id,
        ]);
        if (count($data) == 0) {
            return '';
        } else {
            return $data[0]['descripcion_grupo'];
        }
    }

    public function getDescriptionSubGrupo($id)
    {
        global $database;

        $data = $database->select('subgrupos_inventarios', [
            'descripcion_subgrupo',
        ], [
            'id_subgrupo' => $id,
        ]);
        if (count($data) == 0) {
            return '';
        } else {
            return $data[0]['descripcion_subgrupo'];
        }
    }

    public function getProductos()
    {
        global $database;

        $data = $database->select('productos_inventario', [
            'id_producto',
            'id_familia',
            'id_grupo',
            'id_subgrupo',
            'nombre_producto',
            'unidad_compra',
            'unidad_almacena',
            'unidad_procesa',
            'foto',
            'stock_minimo',
            'stock_maximo',
            'ubicacion',
            'porcionar',
            'cantidad_porcion',
            'equivalencia_porcion',
        ], [
            'deleted_at' => null,
            'ORDER' => 'nombre_producto',
        ]);

        return $data;
    }

    public function getInfoCia()
    {
        global $database;

        $data = $database->select('empresas', [
            'conMod',
            'invMod',
            'comMod',
            'cxpMod',
            'cxcMod',
            'posMod',
            'tarMod',
            'pmsMod',
            'resMod',
            'empresa',
            'nit',
            'dv',
            'direccion',
            'pais',
            'ciudad',
            'celular',
            'telefonos',
            'web',
            'correo',
            'logo',
            'codigo_ciiu',
            'tipo_empresa',
        ]);

        return $data;
    }

    public function actualizaNumeroFolio($folio, $id)
    {
        global $database;

        $data = $database('cargos_pms', [
            'folio_cargo' => $folio,
        ], [
            'id_cargo' => $id,
        ]);

        return $data->rowCount();
    }

    public function getCityName($tipo)
    {
        global $database;

        $data = $database->select('ciudades', [
            'municipio',
            'depto',
        ], [
            'id_ciudad' => $tipo,
        ]);

        return $data[0]['municipio'].' '.$data[0]['depto'];
    }

    public function getLandName($tipo)
    {
        global $database;

        $data = $database->select('paices', [
            'descripcion',
        ], [
            'id_pais' => $tipo,
        ]);

        return $data[0]['descripcion'];
    }
}
