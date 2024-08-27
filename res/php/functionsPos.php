<?php

require_once 'init.php';
date_default_timezone_set('America/Bogota');

class Pos_Actions
{

    public function guardaPlanillaDesayunos($fec, $res, $idh, $est){
		global $database;

		$data = $database->insert('planillaDesayunos',[
			'fecha' => $fec,
			'num_reserva' => $res, 
			'id_huesped' => $idh,
			'estado' => $est
		]);
		return $database->id();
	}

    public function totalDesayunos($fecha){
        global $database;
        $data = $database->count('planillaDesayunos',[
            'fecha' => $fecha
        ]);
        return $data;
    }


	public function huespedesEnCasaDesayunos(){
		global $database;

		$data = $database->query("SELECT *, 0 as 'estado'
			FROM (
			( SELECT
				huespedes.id_huesped, 
				huespedes.nombre_completo, 
				reservas_pms.fecha_llegada, 
				reservas_pms.fecha_salida, 
				reservas_pms.num_habitacion,
				reservas_pms.num_reserva
			FROM
				huespedes
				LEFT JOIN
				reservas_pms
				ON 
					huespedes.id_huesped = reservas_pms.id_huesped
			WHERE
				reservas_pms.estado = 'CA' AND 
                reservas_pms.tipo_habitacion > 1
			ORDER BY
				reservas_pms.num_habitacion ASC, 
				huespedes.nombre_completo ASC
			) UNION (SELECT
				huespedes.id_huesped, 
				huespedes.nombre_completo, 
				reservas_pms.fecha_llegada, 
				reservas_pms.fecha_salida, 
				reservas_pms.num_habitacion,
				reservas_pms.num_reserva
				FROM
				acompanantes
				INNER JOIN
				reservas_pms
				ON 
					acompanantes.id_reserva = reservas_pms.num_reserva
				INNER JOIN
				huespedes
				ON 
					acompanantes.id_huesped = huespedes.id_huesped
			WHERE
				reservas_pms.estado = 'CA' AND 
                reservas_pms.tipo_habitacion > 1
			ORDER BY
				reservas_pms.num_habitacion)
				) HUES ORDER BY num_habitacion, nombre_completo")->fetchAll(PDO::FETCH_ASSOC);
		return $data;

	}

    public function getSubRecetasProducto($id)
    {
        global $database;

        $data = $database->select('productos_recetas', [
            '[>]recetasEstandar' => ['id_producto' => 'id_receta'],
            '[>]unidades' => ['id_unidad_procesa' => 'id_unidad'],
        ], [
            'recetasEstandar.nombre_receta(nombre_producto)',
            'productos_recetas.id_unidad_procesa',
            'unidades.descripcion_unidad',
            'productos_recetas.id',
            'productos_recetas.tipoProducto',
            'productos_recetas.id_producto',
            'productos_recetas.id_receta',
            'productos_recetas.valor_unitario_promedio',
            'productos_recetas.valor_unitario_compra',
            'productos_recetas.cantidad',
            'productos_recetas.valor_promedio',
            'productos_recetas.valor_compra',
        ], [
            'productos_recetas.id_receta' => $id,
            'productos_recetas.tipoProducto' => 1,
            'productos_recetas.deleted_at' => null,            
            'ORDER' => ['recetasEstandar.nombre_receta' => 'ASC'],
        ]);

        return $data;
    }


    public function guardaSubReceta($subreceta,$idReceta,$costoSubR,$cantidad, $usr, $tipo){
        global $database;

        $data = $database->insert('productos_recetas',[
            'id_receta' => $idReceta,
            'id_producto' => $subreceta,
            'tipoProducto' => $tipo,
            'cantidad' => $cantidad,
            'valor_unitario_promedio' => $costoSubR,
            'valor_promedio' => $costoSubR * $cantidad,
            'id_unidad_procesa' => 55,
            'id_usuario' => $usr,
            'created_at' => date('Y-m-d H:i:s'),

        ]);
        return $database->id();
    }

    public function getSubRecetas($receta){
        global $database;

        $data = $database->select('recetasEstandar',[
            'id_receta',
            'nombre_receta',
            'valor_costo',
        ],[
            'estado' => 1,
            'subreceta' => 1,
            'ORDER' => ['nombre_receta' => 'ASC']
        ]);
        return $data;
    }

    public function getSubRecetasAsignada($receta){
        global $database;

        $data = $database->query("SELECT recetasEstandar.id_receta, recetasEstandar.nombre_receta, recetasEstandar.valor_costo, recetasEstandar.subreceta FROM recetasEstandar, productos_recetas WHERE recetasEstandar.subreceta = 1 AND productos_recetas.tipoProducto = 1 AND productos_recetas.id_receta = $receta AND recetasEstandar.id_receta <> productos_recetas.id_producto ORDER BY recetasEstandar.nombre_receta ASC")->fetchAll();
        return $data;
    }

    
    public function traeProductosVentaTotal($comanda, $ambiente){
      global $database;

      $data = $database->query("SELECT nom, venta, cant, importe, impto, valorimpto, sum(importe * cant) as total, sum(round((importe * cant ) / (1+(impto /100)),2)) as baseimpto, sum(round((importe * cant ) / (1+(impto /100)),2) * round((impto /100),2)) as valimpto FROM ventas_dia_pos WHERE ambiente = $ambiente AND comanda = $comanda GROUP BY impto, comanda  ORDER BY comanda")->fetchAll();
    return $data;
    }
    public function getTotalProductosVendidosMes($amb, $desdefe, $hastafe)
    {
        global $database;

        $data = $database->query("SELECT historico_detalle_facturas_pos.producto_id, historico_detalle_facturas_pos.nom,historico_detalle_facturas_pos.importe as unitario,  Sum( historico_detalle_facturas_pos.venta ) AS ventas, Sum( historico_detalle_facturas_pos.descuento ) AS descuento, Sum( historico_detalle_facturas_pos.valorimpto ) AS imptos, Sum( historico_detalle_facturas_pos.venta + historico_detalle_facturas_pos.valorimpto ) AS total, Sum( historico_detalle_facturas_pos.cant ) AS cant, Sum( historico_facturas_pos.pax ) AS pers, ambientes.nombre, producto.id_receta, producto.tipo_producto FROM historico_detalle_facturas_pos, historico_facturas_pos, ambientes, producto WHERE historico_facturas_pos.comanda = historico_detalle_facturas_pos.comanda AND historico_facturas_pos.ambiente = ambientes.id_ambiente AND historico_facturas_pos.estado = 'A' AND ambientes.id_ambiente = '$amb' AND historico_detalle_facturas_pos.producto_id = producto.producto_id AND historico_facturas_pos.fecha BETWEEN '$desdefe' AND '$hastafe' GROUP BY ambientes.nombre, historico_detalle_facturas_pos.nom ORDER BY historico_detalle_facturas_pos.nom ASC")->fetchAll();

        return $data;
    }

    public function buscaIdentificacion($iden)
    {
        global $database;

        $data = $database->count('clientes', [
            'identificacion' => $iden,
        ]);

        return $data;
    }

    public function getCantidadFormasPagoVendidos($amb)
    {
        global $database;

        $data = $database->query("SELECT
		formas_pago.descripcion,
		ambientes.nombre,
		sum(facturas_pos.valor_total) AS ventas,
		count(formas_pago.id_pago) AS cant,
		sum(facturas_pos.pax) AS pers,
		sum(facturas_pos.valor_neto) AS neto,
		sum(facturas_pos.impuesto) AS impto,
		sum(facturas_pos.propina) AS propina,
		sum(facturas_pos.descuento) AS descuento
		FROM
		facturas_pos ,
		ambientes ,
		formas_pago
		WHERE
		facturas_pos.ambiente = ambientes.id_ambiente AND
		facturas_pos.estado = 'A' AND
		ambientes.id_ambiente = $amb AND
		facturas_pos.forma_pago = formas_pago.id_pago
		GROUP BY
		ambientes.nombre
		ORDER BY
		ambientes.nombre ASC
		")->fetchAll();

        return $data;
    }

    public function eliminaAbonos($idamb)
    {
        global $database;

        $data = $database->delete('abonos', [
            'AND' => [
                'ambiente' => $idamb,
            ],
        ]);

        return $data->rowCount();
    }

    public function eliminaCaja($idamb)
    {
        global $database;

        $data = $database->delete('baseCaja', [
            'AND' => [
                'idAmbiente' => $idamb,
            ],
        ]);

        return $data->rowCount();
    }

    public function acumuladoMesProductosVendidos($amb, $anio, $mes)
    {
        global $database;

        $data = $database->query("SELECT Sum(historico_detalle_facturas_pos.cant) as cantmes, Sum(historico_detalle_facturas_pos.venta) as ventasmes, Sum(historico_detalle_facturas_pos.descuento) AS descuentomes, Sum(historico_detalle_facturas_pos.valorimpto) AS imptosmes, historico_detalle_facturas_pos.nom, historico_detalle_facturas_pos.producto_id, historico_facturas_pos.ambiente, historico_facturas_pos.factura, historico_facturas_pos.comanda, historico_facturas_pos.fecha, historico_facturas_pos.estado FROM historico_facturas_pos, historico_detalle_facturas_pos WHERE historico_facturas_pos.ambiente = '$amb' AND YEAR(historico_facturas_pos.fecha) = '$anio' AND MONTH(historico_facturas_pos.fecha) = '$mes' AND historico_facturas_pos.estado = 'A' AND historico_facturas_pos.ambiente =  historico_detalle_facturas_pos.ambiente AND historico_facturas_pos.comanda = historico_detalle_facturas_pos.comanda GROUP BY historico_detalle_facturas_pos.nom ORDER BY historico_detalle_facturas_pos.nom ASC")->fetchAll();

        return $data;
    }

    public function acumuladoDiarioProductosVendidos($amb, $fecha)
    {
        global $database;

        $data = $database->query("SELECT Sum(historico_detalle_facturas_pos.cant) as cant, Sum(historico_detalle_facturas_pos.venta) as ventas, Sum(historico_detalle_facturas_pos.descuento) AS descuento, Sum(historico_detalle_facturas_pos.valorimpto) AS imptos, historico_detalle_facturas_pos.nom, historico_detalle_facturas_pos.producto_id, historico_facturas_pos.ambiente, historico_facturas_pos.factura, historico_facturas_pos.comanda, historico_facturas_pos.fecha, historico_facturas_pos.estado FROM historico_facturas_pos, historico_detalle_facturas_pos WHERE historico_facturas_pos.ambiente = '$amb' AND historico_facturas_pos.fecha = '$fecha' AND historico_facturas_pos.estado = 'A' AND historico_facturas_pos.ambiente =  historico_detalle_facturas_pos.ambiente AND historico_facturas_pos.comanda = historico_detalle_facturas_pos.comanda GROUP BY historico_detalle_facturas_pos.nom ORDER BY historico_detalle_facturas_pos.nom ASC")->fetchAll();

        return $data;
    }

    public function getCajerosActivos($idamb)
    {
        global $database;

        $data = $database->select('usuarios', [
            'usuario_id',
            'usuario',
            'nombres',
            'apellidos',
            'estado_usuario_pos',
        ], [
            'estado' => 'A',
        ]);

        return $data;
    }

    /* Actualiza Numero del Abono */
    public function updateNumeroAbono($amb, $nro)
    {
        global $database;

        $data = $database->update('ambientes', [
            'conc_abono' => $nro,
        ], [
            'id_ambiente' => $amb,
        ]);

        return $data->rowCount();
    }

        public function getNumeroAbono($amb)
        {
            global $database;

            $data = $database->select('ambientes', [
                'conc_abono',
            ], [
                'id_ambiente' => $amb,
            ]);

            return $data[0]['conc_abono'];
        }

        public function getTotalFormaPagoVendidos($amb)
        {
            global $database;

            $data = $database->query("SELECT
		formas_pago.descripcion,
		facturas_pos.pax AS pers,
		ambientes.nombre,
		Count(facturas_pos.factura) AS cant,
		Sum(facturas_pos.valor_total) AS ventas,
		Sum(facturas_pos.valor_neto) AS neto,
		Sum(facturas_pos.impuesto) AS imptos,
		Sum(facturas_pos.propina) AS propina,
		Sum(facturas_pos.descuento) AS descuento,
		Sum(facturas_pos.pagado) AS pagado,
		Sum(facturas_pos.cambio) AS cambio,
		Sum(facturas_pos.abonos) AS abonos,
		Sum(facturas_pos.valor_neto + facturas_pos.impuesto + facturas_pos.propina - facturas_pos.descuento) AS total
		FROM
		facturas_pos ,
		ambientes ,
		formas_pago
		WHERE
		facturas_pos.ambiente = ambientes.id_ambiente AND
		facturas_pos.estado = 'A' AND
		ambientes.id_ambiente = '$amb' AND
		facturas_pos.forma_pago = formas_pago.id_pago
		GROUP BY
		formas_pago.descripcion,
		facturas_pos.pax,
		ambientes.nombre
		ORDER BY
		ambientes.id_ambiente ASC,
		formas_pago.descripcion ASC")->fetchAll();

            return $data;
        }

        public function getDetalleAbonosFormasdePagoCajero($usu, $amb)
        {
            global $database;

            $data = $database->query("SELECT Sum(abonos.valor) AS total, count(abonos.formaPago) as cant, abonos.formaPago, formas_pago.descripcion, ambientes.nombre FROM abonos , formas_pago , ambientes WHERE  abonos.formaPago = formas_pago.id_pago AND abonos.id_usuario = '$usu' AND abonos.ambiente = ambientes.id_ambiente AND abonos.ambiente = $amb GROUP BY abonos.formaPago, ambientes.nombre")->fetchAll();

            return $data;
        }

        public function getDetalleAbonosFormasdePago($amb)
        {
            global $database;

            $data = $database->query("SELECT Sum(abonos.valor) AS total, count(abonos.formaPago) as cant, abonos.formaPago, formas_pago.descripcion, ambientes.nombre FROM abonos , formas_pago , ambientes WHERE  abonos.formaPago = formas_pago.id_pago AND abonos.ambiente = ambientes.id_ambiente AND abonos.ambiente = $amb GROUP BY abonos.formaPago, ambientes.nombre")->fetchAll();

            return $data;
        }

        public function getDetalleAbonosFormasdePagoMes($desdefecha, $hastafecha, $amb)
        {
            global $database;

            $data = $database->query("SELECT Sum(historicAbonos.valor) AS total, count(historicoAbonos.formaPago) as cant, historicoAbonos.formaPago, formas_pago.descripcion, ambientes.nombre FROM historicoAbonos , formas_pago , ambientes WHERE  historicoAbonos.formaPago = formas_pago.id_pago AND historicoAbonos.ambiente = ambientes.id_ambiente AND historicoAbonos.ambiente = $amb GROUP BY historicoAbonos.formaPago, ambientes.nombre")->fetchAll();

            return $data;
        }

        public function traeAbonosTotal($idamb)
        {
            global $database;

            $data = $database->query("SELECT
		abonos.abono_numero,
		abonos.comanda,
		abonos.valor,
		abonos.formaPago,
		abonos.comentarios,
		abonos.created_at,
		formas_pago.descripcion,
		usuarios.usuario_id,
		usuarios.usuario
		FROM
		abonos ,
		formas_pago ,
		usuarios
		WHERE
		abonos.formaPago = formas_pago.id_pago AND
		abonos.id_usuario = usuarios.usuario_id AND
		abonos.ambiente = $idamb
		ORDER BY
		abonos.abono_numero ASC
		")->fetchAll();

            return $data;
        }

        public function getVentasCredito($idamb, $usr)
        {
            global $database;

            $data = $database->query("SELECT clientes.id_cliente, clientes.identificacion, clientes.apellido1, clientes.apellido2, clientes.nombre1, clientes.nombre2, clientes.direccion, facturas_pos.factura, facturas_pos.valor_total FROM clientes , facturas_pos WHERE clientes.id_cliente = facturas_pos.id_cliente AND facturas_pos.forma_pago = 11 AND facturas_pos.ambiente = '$idamb' AND facturas_pos.usuario = '$usr'")->fetchAll();

            return $data;
        }

        public function traeClientesCartera()
        {
            global $database;

            $data = $database->query("SELECT clientes.id_cliente, clientes.identificacion, clientes.apellido1, clientes.apellido2, clientes.nombre1, clientes.nombre2, clientes.direccion, Sum(historico_facturas_pos.valor_total) as total FROM clientes , historico_facturas_pos WHERE clientes.id_cliente = historico_facturas_pos.id_cliente AND historico_facturas_pos.forma_pago = 11 AND historico_facturas_pos.cartera = 0 AND historico_facturas_pos.estado = 'A' GROUP BY clientes.id_cliente ORDER BY clientes.id_cliente")->fetchAll();

            return $data;
        }

        public function traeCarteraCliente($idusr)
        {
            global $database;

            $data = $database->query("SELECT clientes.id_cliente, clientes.identificacion, clientes.apellido1, clientes.apellido2, clientes.nombre1, clientes.nombre2, clientes.direccion, Sum(historico_facturas_pos.valor_total) as total FROM clientes , historico_facturas_pos WHERE clientes.id_cliente = $idusr AND clientes.id_cliente = historico_facturas_pos.id_cliente AND historico_facturas_pos.forma_pago = 11 AND historico_facturas_pos.cartera = 0 AND historico_facturas_pos.estado = 'A' GROUP BY clientes.id_cliente ORDER BY clientes.id_cliente")->fetchAll();

            return $data;
        }

        public function traeClienteCartera($id)
        {
            global $database;

            $data = $database->select('clientes', [
                'apellido1',
                'apellido2',
                'nombre1',
                'nombre2',
            ], [
                'id_cliente' => $id,
            ]);

            return $data[0]['apellido1'].' '.$data[0]['apellido2'].' '.$data[0]['nombre1'].' '.$data[0]['nombre2'];
        }

        public function traeMovimientosCaja($fecha, $iduser, $tipo)
        {
            global $database;

            $data = $database->select('baseCaja', [
                'id',
                'nroDocumento',
                'idUsuario',
                'idAmbiente',
                'monto',
                'documento',
                'naturaleza',
                'fecha',
                'concepto',
                'proveedor',
                'facturasPagadas',
            ], [
                'fecha' => $fecha,
                'idUsuario' => $iduser,
                'tipo' => $tipo,
            ]);

            return $data;
        }

        public function traeCarteraCaja($fecha, $iduser, $tipo)
        {
            global $database;

            $data = $database->select('baseCaja', [
                '[>]formas_pago' => ['idFormaPago' => 'id_pago'],
            ], [
                'formas_pago.descripcion',
                'formas_pago.id_pago',
                'baseCaja.id',
                'baseCaja.nroDocumento',
                'baseCaja.idUsuario',
                'baseCaja.idAmbiente',
                'baseCaja.monto',
                'baseCaja.documento',
                'baseCaja.naturaleza',
                'baseCaja.fecha',
                'baseCaja.concepto',
                'baseCaja.proveedor',
                'baseCaja.facturasPagadas',
            ], [
                'baseCaja.idUsuario' => $iduser,
                'baseCaja.fecha' => $fecha,
                'baseCaja.tipo' => $tipo,
            ]);

            return $data;
        }

        public function traeRecaudosCarteraMes($desdefe, $hastafe, $amb, $tipo)
        {
            global $database;

            $data = $database->query("SELECT
		usuarios.nombres,
		usuarios.apellidos,
		usuarios.usuario,
		historicoBaseCaja.id,
		historicoBaseCaja.nroDocumento,
		historicoBaseCaja.monto,
		historicoBaseCaja.documento,
		historicoBaseCaja.naturaleza,
		historicoBaseCaja.fecha,
		historicoBaseCaja.concepto,
		historicoBaseCaja.proveedor,
		historicoBaseCaja.facturasPagadas,
		formas_pago.id_pago,
		formas_pago.descripcion,
		ambientes.nombre
		FROM
		usuarios ,
		historicoBaseCaja ,
		ambientes,
		formas_pago
		WHERE
		historicoBaseCaja.idAmbiente = '$amb' AND
		usuarios.usuario_id = historicoBaseCaja.idUsuario AND
		historicoBaseCaja.idAmbiente = ambientes.id_ambiente AND
		historicoBaseCaja.fecha BETWEEN '$desdefe' AND '$hastafe' AND
		historicoBaseCaja.idFormaPago = formas_pago.id_pago AND
		historicoBaseCaja.tipo = $tipo
		ORDER BY
		historicoBaseCaja.idAmbiente ASC,
		historicoBaseCaja.fecha ASC,
		usuarios.usuario ASC")->fetchAll();

            return $data;
        }

        public function traeMovimientosBalanceCajaMes($desdefe, $hastafe, $tipo, $amb)
        {
            global $database;

            $data = $database->query("SELECT
		usuarios.nombres,
		usuarios.apellidos,
		usuarios.usuario,
		historicoBaseCaja.id,
		historicoBaseCaja.nroDocumento,
		historicoBaseCaja.monto,
		historicoBaseCaja.documento,
		historicoBaseCaja.naturaleza,
		historicoBaseCaja.fecha,
		historicoBaseCaja.concepto,
		historicoBaseCaja.proveedor,
		historicoBaseCaja.facturasPagadas,
		ambientes.nombre
		FROM
		usuarios ,
		historicoBaseCaja ,
		ambientes
		WHERE
		historicoBaseCaja.idAmbiente = '$amb' AND
		usuarios.usuario_id = historicoBaseCaja.idUsuario AND
		historicoBaseCaja.idAmbiente = ambientes.id_ambiente AND
		historicoBaseCaja.fecha BETWEEN '$desdefe' AND '$hastafe' AND
		historicoBaseCaja.tipo = '$tipo'
		ORDER BY
		historicoBaseCaja.idAmbiente ASC,
		historicoBaseCaja.fecha ASC,
		usuarios.usuario ASC")->fetchAll();

            return $data;
        }

        public function getDetalleFormasdePagoBalanceCaja($estado, $amb)
        {
            global $database;

            $data = $database->query("SELECT Sum(facturas_pos.valor_total) AS total, Sum(facturas_pos.pagado) AS pagado, Sum(facturas_pos.cambio) AS cambio, count(facturas_pos.forma_pago) as cant, Sum(facturas_pos.valor_neto) AS neto, Sum(facturas_pos.impuesto) AS impto, Sum(facturas_pos.propina) AS prop, Sum(facturas_pos.descuento) AS `desc`, formas_pago.id_pago, formas_pago.descripcion, ambientes.nombre FROM facturas_pos , formas_pago , ambientes WHERE facturas_pos.estado = '$estado' AND facturas_pos.forma_pago = formas_pago.id_pago AND facturas_pos.ambiente = ambientes.id_ambiente AND facturas_pos.ambiente = $amb GROUP BY facturas_pos.forma_pago, ambientes.nombre")->fetchAll();

            return $data;
        }

        public function getDetalleFormasdePagoBalanceCajaMes($estado, $desdefe, $hastafe, $amb)
        {
            global $database;

            $data = $database->query("SELECT 
		Sum(historico_facturas_pos.valor_total) AS valortotal, 
		Sum(historico_facturas_pos.pagado) AS pagado, 
		Sum(historico_facturas_pos.cambio) AS cambio, 
		count(historico_facturas_pos.forma_pago) as cant, 
		Sum(historico_facturas_pos.valor_neto) AS total, 
		Sum(historico_facturas_pos.impuesto) AS impto, 
		Sum(historico_facturas_pos.propina) AS propina, 
		Sum(historico_facturas_pos.servicio) AS servicio, 
		Sum(historico_facturas_pos.descuento) AS descuento, 
		formas_pago.id_pago,
		formas_pago.descripcion,
		ambientes.nombre,
		historico_facturas_pos.usuario
		FROM
		historico_facturas_pos , formas_pago , ambientes
		WHERE
		historico_facturas_pos.estado = '$estado' AND
		historico_facturas_pos.forma_pago = formas_pago.id_pago AND
		historico_facturas_pos.ambiente = ambientes.id_ambiente AND
		historico_facturas_pos.ambiente = '$amb' AND
		historico_facturas_pos.fecha BETWEEN '$desdefe' AND '$hastafe'
		GROUP BY
		ambientes.nombre, historico_facturas_pos.forma_pago, historico_facturas_pos.usuario_factura
		ORDER BY 
		ambientes.nombre, historico_facturas_pos.usuario_factura, historico_facturas_pos.forma_pago")->fetchAll();

            return $data;
        }

        public function traeMovimientosBalanceCaja($fecha, $tipo)
        {
            global $database;

            $data = $database->select('baseCaja', [
                'id',
                'nroDocumento',
                'idUsuario',
                'idAmbiente',
                'monto',
                'documento',
                'naturaleza',
                'fecha',
                'concepto',
                'proveedor',
                'facturasPagadas',
            ], [
                'fecha' => $fecha,
                'tipo' => $tipo,
                'ORDER' => [
                    'idUsuario' => 'ASC',
                ],
            ]);

            return $data;
        }

        public function traeCarteraBalanceCaja($fecha, $tipo)
        {
            global $database;

            $data = $database->select('baseCaja', [
                '[>]formas_pago' => ['idFormaPago' => 'id_pago'],
            ], [
                'formas_pago.descripcion',
                'formas_pago.id_pago',
                'baseCaja.id',
                'baseCaja.nroDocumento',
                'baseCaja.idUsuario',
                'baseCaja.idAmbiente',
                'baseCaja.monto',
                'baseCaja.documento',
                'baseCaja.naturaleza',
                'baseCaja.fecha',
                'baseCaja.concepto',
                'baseCaja.proveedor',
                'baseCaja.facturasPagadas',
            ], [
                'baseCaja.fecha' => $fecha,
                'baseCaja.tipo' => $tipo,
                'ORDER' => [
                    'baseCaja.idUsuario' => 'ASC',
                ],
            ]);

            return $data;
        }

        public function cambiaEstadoCartera($numero, $ambi)
        {
            global $database;

            $data = $database->update('historico_facturas_pos', [
                'cartera' => 1,
            ], [
                'factura' => $numero,
                'ambiente' => $ambi,
            ]);

            return $data;
        }

        public function getFacturasCliente($idcliente, $idambi)
        {
            global $database;

            $data = $database->select('historico_facturas_pos', [
                '[>]formas_pago' => ['forma_pago' => 'id_pago'],
                '[>]clientes' => ['id_cliente' => 'id_cliente'],
            ], [
                'historico_facturas_pos.id',
                'historico_facturas_pos.factura',
                'historico_facturas_pos.comanda',
                'historico_facturas_pos.mesa',
                'historico_facturas_pos.pax',
                'historico_facturas_pos.valor_total',
                'historico_facturas_pos.valor_neto',
                'historico_facturas_pos.pagado',
                'historico_facturas_pos.cambio',
                'historico_facturas_pos.impuesto',
                'historico_facturas_pos.propina',
                'historico_facturas_pos.descuento',
                'historico_facturas_pos.pagado',
                'historico_facturas_pos.cambio',
                'historico_facturas_pos.fecha',
                'historico_facturas_pos.fecha_factura',
                'historico_facturas_pos.usuario_factura',
                'historico_facturas_pos.estado',
                'historico_facturas_pos.pms',
                'historico_facturas_pos.forma_pago',
                'historico_facturas_pos.usuario',
                'historico_facturas_pos.num_movimiento_inv',
                'formas_pago.descripcion',
                'clientes.apellido1',
                'clientes.apellido2',
                'clientes.nombre1',
                'clientes.nombre2',
            ], [
                'historico_facturas_pos.id_cliente' => $idcliente,
                'historico_facturas_pos.ambiente' => $idambi,
                'historico_facturas_pos.estado' => 'A',
                'historico_facturas_pos.forma_pago' => '11',
                'historico_facturas_pos.cartera' => 0,
            ]);

            return $data;
        }

        public function getVentasCreditodelDia($amb)
        {
            global $database;

            $data = $database->select('facturas_pos', [
                '[>]formas_pago' => ['forma_pago' => 'id_pago'],
                '[>]clientes' => ['id_cliente' => 'id_cliente'],
            ], [
                'facturas_pos.id',
                'facturas_pos.factura',
                'facturas_pos.comanda',
                'facturas_pos.mesa',
                'facturas_pos.pax',
                'facturas_pos.valor_total',
                'facturas_pos.valor_neto',
                'facturas_pos.pagado',
                'facturas_pos.cambio',
                'facturas_pos.impuesto',
                'facturas_pos.propina',
                'facturas_pos.descuento',
                'facturas_pos.pagado',
                'facturas_pos.cambio',
                'facturas_pos.fecha',
                'facturas_pos.fecha_factura',
                'facturas_pos.usuario_factura',
                'facturas_pos.estado',
                'facturas_pos.pms',
                'facturas_pos.forma_pago',
                'facturas_pos.usuario',
                'facturas_pos.num_movimiento_inv',
                'formas_pago.descripcion',
                'clientes.apellido1',
                'clientes.apellido2',
                'clientes.nombre1',
                'clientes.nombre2',
            ], [
                'facturas_pos.ambiente' => $amb,
                'facturas_pos.estado' => 'A',
                'facturas_pos.forma_pago' => '11',
            ]);

            return $data;
        }

        public function ingresoAbonoTotal($comanda, $totabo, $idamb)
        {
            global $database;

            $data = $database->query("UPDATE comandas SET abonos = abonos + '$totabo' WHERE comanda = '$comanda' AND ambiente = '$idamb'")->fetchAll();

            return $data;
        }

    public function ingresoAbono($iduser, $idamb, $fecha, $comanda, $totabo, $comenta, $numabo, $fpago)
    {
        global $database;

        $data = $database->insert('abonos', [
            'id_usuario' => $iduser,
            'ambiente' => $idamb,
            'fecha' => $fecha,
            'comanda' => $comanda,
            'valor' => $totabo,
            'comentarios' => $comenta,
            'formaPago' => $fpago,
            'abono_numero' => $numabo,
            'estado' => '1',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return $database->id();
    }

    public function getTotalAbonos($amb, $nComa)
    {
        global $database;

        $data = $database->query("SELECT sum(valor) as abonos FROM abonos WHERE id_ambiente = '$amb' AND comanda = '$nComa' AND estado = '1'")->fetchAll();

        return $data[0]['abonos'];
    }

        public function traeAbonosCaja($iduser, $idamb)
        {
            global $database;

            $data = $database->select('abonos', [
                '[>]formas_pago' => ['formaPago' => 'id_pago'],
                '[>]usuarios' => ['id_usuario' => 'usuario_id'],
            ], [
                'formas_pago.descripcion',
                'abonos.abono_numero',
                'abonos.comanda',
                'abonos.valor',
                'abonos.formaPago',
                'abonos.comentarios',
                'abonos.created_at',
                'usuarios.usuario',
            ], [
                'abonos.ambiente' => $idamb,
                'abonos.id_usuario' => $iduser,
                'abonos.estado' => '1',
                'ORDER' => ['abonos.abono_numero' => 'ASC'],
            ]);

            return $data;
        }

        public function devolucionParcialProducto($comanda, $devol, $saldo, $idprod, $valventa, $montoimpto, $motivo, $user, $idamb, $fecha, $estado)
        {
            global $database;

            $data = $database->update('ventas_dia_pos', [
                'estado' => $estado,
                'motivo_devo' => $motivo,
                'usuario_devo' => $user,
                'fecha_devo' => $fecha,
                'cantidad_devo' => $devol,
                'cant' => $saldo,
                'venta' => $valventa,
                'valorimpto' => $montoimpto,
            ], [
                'ambiente' => $idamb,
                'comanda' => $comanda,
                'id' => $idprod,
            ]);

            return $data->rowCount();
        }

        public function getTipoReceta($id)
        {
            global $database;

            $data = $database->select('secciones_pos', [
                'nombre_seccion',
            ], [
                'id_seccion' => $id,
            ]);

            return $data[0]['nombre_seccion'];
        }

        public function getDetalleReceta()
        {
            global $database;

            $data = $database->select('recetasEstandar', [
                '[>]secciones_pos' => ['id_seccion' => 'id_seccion'],
            ], [
                'secciones_pos.nombre_seccion',
                'recetasEstandar.id_receta',
                'recetasEstandar.nombre_receta',
                'recetasEstandar.id_seccion',
                'recetasEstandar.cantidad',
                'recetasEstandar.valor_costo',
                'recetasEstandar.valor_costo_porcion',
                'recetasEstandar.valor_venta',
                'recetasEstandar.valor_impto',
                'recetasEstandar.valor_neto',
                'recetasEstandar.valor_porcion',
                'recetasEstandar.preparacion',
                'recetasEstandar.montaje',
                'recetasEstandar.foto',
                'recetasEstandar.duracion_prep',
                'recetasEstandar.por_costo',
                'recetasEstandar.margen_error',
            ], [
                'recetasEstandar.actived_at' => 1,
                'recetasEstandar.deleted_at' => null,
                'ORDER' => [
                    'secciones_pos.nombre_seccion' => 'ASC',
                    'recetasEstandar.nombre_receta' => 'ASC',
                    ],
            ]);

            return $data;
        }

        public function getDetalleRecetaTipo($tipo)
        {
            global $database;

            $data = $database->select('recetasEstandar', [
                '[>]secciones_pos' => ['id_seccion' => 'id_seccion'],
            ], [
                'secciones_pos.nombre_seccion',
                'recetasEstandar.id_receta',
                'recetasEstandar.nombre_receta',
                'recetasEstandar.id_seccion',
                'recetasEstandar.cantidad',
                'recetasEstandar.valor_costo',
                'recetasEstandar.valor_costo_porcion',
                'recetasEstandar.valor_venta',
                'recetasEstandar.valor_impto',
                'recetasEstandar.valor_neto',
                'recetasEstandar.valor_porcion',
                'recetasEstandar.preparacion',
                'recetasEstandar.montaje',
                'recetasEstandar.foto',
                'recetasEstandar.duracion_prep',
                'recetasEstandar.por_costo',
                'recetasEstandar.margen_error',
            ], [
                'recetasEstandar.id_seccion' => $tipo,
                'recetasEstandar.deleted_at' => null,
                'recetasEstandar.actived_at' => 1,
                'ORDER' => [
                    'secciones_pos.nombre_seccion' => 'ASC',
                    'recetasEstandar.nombre_receta' => 'ASC',
                    ],
            ]);

            return $data;
        }

        public function getVentasPorCliente($amb)
        {
            global $database;

            $data = $database->query("SELECT clientes.nombre1, clientes.nombre2, clientes.apellido1, clientes.apellido2, count(facturas_pos.factura) as cant, Sum(facturas_pos.valor_total) as total, Sum(facturas_pos.valor_neto) as neto, Sum(facturas_pos.impuesto) as imptos, Sum(facturas_pos.propina) as propina, Sum(facturas_pos.descuento) as descto, Sum(facturas_pos.pagado) as pagado, Sum(facturas_pos.cambio) as cambio FROM facturas_pos , clientes WHERE facturas_pos.estado = 'A' AND facturas_pos.id_cliente = clientes.id_cliente AND facturas_pos.ambiente = '$amb' GROUP BY clientes.id_cliente ORDER BY clientes.apellido1 ASC")->fetchAll();

            return $data;
        }

        public function getCursor($consulta)
        {
            global $database;

            $data = $database->query($consulta)->fetchAll();

            return $data;
        }

        public function getVentasPeriodosMes($idamb, $desdefe, $hastafe)
        {
            global $database;

            $data = $database->query("SELECT periodosServicio.descripcion_periodo, Sum(historico_facturas_pos.valor_total) AS total, Sum(historico_facturas_pos.valor_neto) AS ventas, Sum(historico_facturas_pos.impuesto) AS imptos, Sum(historico_facturas_pos.propina) AS prop, Sum(historico_facturas_pos.pax) AS pax, Sum(historico_facturas_pos.descuento) AS descu, periodosServicio.id_ambiente, periodosServicio.id_periodo FROM periodosServicio, historico_facturas_pos WHERE periodosServicio.id_ambiente = '$idamb' AND historico_facturas_pos.fecha >= '$desdefe' AND historico_facturas_pos.fecha <= '$hastafe' AND substr(historico_facturas_pos.fecha_factura,12,5) <= periodosServicio.hasta_hora AND substr(historico_facturas_pos.fecha_factura,12,5) >= periodosServicio.desde_hora AND historico_facturas_pos.estado = 'A' AND historico_facturas_pos.ambiente = '$idamb' GROUP BY periodosServicio.id_periodo ORDER BY periodosServicio.descripcion_periodo ASC ")->fetchAll();

            return $data;
        }

        public function getVentasPeriodosDia($idamb)
        {
            global $database;

            $data = $database->query("SELECT periodosServicio.descripcion_periodo, Sum(facturas_pos.pagado) AS total, Sum(facturas_pos.servicio) AS servicio, Sum(facturas_pos.valor_neto) AS neto, Sum(facturas_pos.impuesto) AS imptos, Sum(facturas_pos.propina) AS prop, Sum(facturas_pos.pax) AS pax, Sum(facturas_pos.descuento) AS descu, periodosServicio.id_ambiente, periodosServicio.id_periodo FROM periodosServicio, facturas_pos WHERE periodosServicio.id_ambiente = '$idamb' AND substr(facturas_pos.fecha_factura,12,5) <= periodosServicio.hasta_hora AND substr(facturas_pos.fecha_factura,12,5) >= periodosServicio.desde_hora AND facturas_pos.estado = 'A' AND facturas_pos.ambiente = '$idamb' GROUP BY periodosServicio.id_periodo ORDER BY periodosServicio.descripcion_periodo ASC ")->fetchAll();

            return $data;
        }

        public function getDevolucionesDia($ambi)
        {
            global $database;

            $data = $database->select('comandas', [
                '[>]ventas_dia_pos' => ['comanda' => 'comanda'],
            ], [
                'comandas.comanda',
                'comandas.mesa',
                'comandas.pax',
                'ventas_dia_pos.nom',
                'ventas_dia_pos.cant',
                'ventas_dia_pos.motivo_devo',
                'ventas_dia_pos.usuario_devo',
                'ventas_dia_pos.fecha_devo',
                'ventas_dia_pos.cantidad_devo',
                'ventas_dia_pos.estado',
            ], [
                'comandas.ambiente' => $ambi,
                'ventas_dia_pos.cantidad_devo[>=]' => 1,
                'ORDER' => [
                    'comandas.comanda' => 'ASC',
                    'ventas_dia_pos.nom' => 'ASC',
                ],
            ]);

            return $data;
        }

        public function getDevolucionUsuario($ambi, $user)
        {
            global $database;

            $data = $database->select('comandas', [
                '[>]ventas_dia_pos' => ['comanda' => 'comanda'],
            ], [
                'comandas.comanda',
                'comandas.mesa',
                'comandas.pax',
                'ventas_dia_pos.nom',
                'ventas_dia_pos.cant',
                'ventas_dia_pos.cantidad_devo',
                'ventas_dia_pos.motivo_devo',
                'ventas_dia_pos.usuario_devo',
                'ventas_dia_pos.fecha_devo',
            ], [
                'comandas.ambiente' => $ambi,
                'ventas_dia_pos.usuario_devo' => $user,
                'ventas_dia_pos.estado' => 1,
                'ORDER' => [
                    'comandas.comanda' => 'ASC',
                    'ventas_dia_pos.nom' => 'ASC',
                ],
            ]);

            return $data;
        }

        public function traeRecetas()
        {
            global $database;

            $data = $database->select('recetasEstandar', [
                'id_receta',
                'nombre_receta',
            ], [
                'estado' => 1,
                'ORDER' => ['nombre_receta' => 'ASC'],
            ]);

            return $data;
        }

        public function getDevolucionProductos($ambi)
        {
            global $database;

            $data = $database->select('comandas', [
                '[>]ventas_dia_pos' => ['comanda' => 'comanda'],
            ], [
                'comandas.comanda',
                'comandas.mesa',
                'comandas.pax',
                'ventas_dia_pos.nom',
                'ventas_dia_pos.cant',
                'ventas_dia_pos.motivo_devo',
                'ventas_dia_pos.usuario_devo',
                'ventas_dia_pos.cantidad_devo',
                'ventas_dia_pos.fecha_devo',
            ], [
                'comandas.ambiente' => $ambi,
                'ventas_dia_pos.cantidad_devo[>=]' => 1,
                'ORDER' => [
                    'comandas.comanda' => 'ASC',
                    'ventas_dia_pos.nom' => 'ASC',
                ],
            ]);

            return $data;
        }

        public function devolucionProducto($comanda, $idprod, $motivo, $user, $idamb, $fecha)
        {
            global $database;

            $data = $database->update('ventas_dia_pos', [
                'estado' => 1,
                'motivo_devo' => $motivo,
                'usuario_devo' => $user,
                'fecha_devo' => $fecha,
            ], [
                'ambiente' => $idamb,
                'comanda' => $comanda,
                'producto_id' => $idprod,
            ]);

            return $data->rowCount();
        }

        public function getProductosEstadoCuenta($amb, $coma)
        {
            global $database;

            $data = $database->select('ventas_dia_pos', [
                'nom',
                'venta',
                'cant',
                'valorimpto',
                'descuento',
                'importe',
            ], [
                'ambiente' => $amb,
                'comanda' => $coma,
                'estado' => 0,
                'ORDER' => ['nom' => 'ASC'],
            ]);

            return $data;
        }

        

        public function numeroSalida($nFact, $idamb, $numeroMov)
        {
            global $database;

            $data = $database->update('facturas_pos', [
                'num_movimiento_inv' => $numeroMov,
            ], [
                'factura' => $nFact,
                'ambiente' => $idamb,
            ]);

            return $data->rowCount();
        }

        public function facturasDia($amb)
        {
            global $database;

            $data = $database->select('facturas_pos', [
                '[>]formas_pago' => ['forma_pago' => 'id_pago'],
            ], [
                'facturas_pos.id',
                'facturas_pos.factura',
                'facturas_pos.comanda',
                'facturas_pos.mesa',
                'facturas_pos.pax',
                'facturas_pos.usuario_factura',
                'facturas_pos.fecha',
                'facturas_pos.fecha_factura',
                'facturas_pos.valor_total',
                'facturas_pos.valor_neto',
                'facturas_pos.impuesto',
                'facturas_pos.propina',
                'facturas_pos.descuento',
                'facturas_pos.estado',
                'facturas_pos.pms',
                'facturas_pos.forma_pago',
                'facturas_pos.usuario',
                'formas_pago.descripcion',
            ], [
                'facturas_pos.ambiente' => $amb,
            ]);

            return $data;
        }

        public function updateFotoReceta($file, $id)
        {
            global $database;

            $data = $database->update('recetasEstandar', [
                'foto' => $file,
            ], [
                'id_receta' => $id,
            ]);

            return $data->rowCount();
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
                'movimientos_inventario.documento',
            ], [
                'movimientos_inventario.id_producto' => $id,
                'movimientos_inventario.id_bodega' => $bodega,
                'movimientos_inventario.estado' => 1,
            ]);

            return $data;
        }

        public function getTraeKardex($bodega)
        {
            global $database;

            $data = $database->query("SELECT productos_inventario.id_producto, productos_inventario.nombre_producto, unidades.descripcion_unidad, SUM(if(movimientos_inventario.movimiento=1,movimientos_inventario.cantidad,0)) AS entradas, SUM(if(movimientos_inventario.movimiento=2,movimientos_inventario.cantidad,0)) AS salidas, SUM(if(movimientos_inventario.movimiento=1,movimientos_inventario.cantidad,0) - if(movimientos_inventario.movimiento=2,movimientos_inventario.cantidad,0)) AS saldo, SUM(if(movimientos_inventario.movimiento=1,movimientos_inventario.valor_subtotal,0)) / SUM(if(movimientos_inventario.movimiento=1,movimientos_inventario.cantidad,0)) AS promedio FROM productos_inventario, movimientos_inventario, unidades WHERE movimientos_inventario.id_producto = productos_inventario.id_producto AND movimientos_inventario.estado = 1 AND productos_inventario.unidad_almacena = unidades.id_unidad AND movimientos_inventario.id_bodega = '$bodega' GROUP BY productos_inventario.nombre_producto ORDER BY productos_inventario.nombre_producto ASC")->fetchAll();

            return $data;
        }

        public function actualizaReceta($receta, $porcion, $tipoReceta, $impto, $subreceta, $vlrVenta, $vlrNeto, $vlrImpt, $vlrPorc, $margen, $tiempo, $preparacion, $montaje, $idrec)
        {
            global $database;

            $data = $database->update('recetasEstandar', [
                'nombre_receta' => $receta,
                'id_seccion' => $tipoReceta,
                'subreceta' => $subreceta,
                'cantidad' => $porcion,
                'id_impuesto' => $impto,
                'valor_venta' => $vlrVenta,
                'valor_impto' => $vlrImpt,
                'valor_neto' => $vlrNeto,
                'valor_porcion' => $vlrPorc,
                'preparacion' => $preparacion,
                'montaje' => $montaje,
                'margen_error' => $margen,
                'duracion_prep' => $tiempo,
                'updated_at' => date('Y-m-d H:i:s'),
            ], [
                'id_receta' => $idrec,
            ]);

            return $data->rowCount();
        }

        public function treaReceta($id)
        {
            global $database;

            $data = $database->select('recetasEstandar', [
                'id_receta',
                'nombre_receta',
                'id_seccion',
                'subreceta',
                'cantidad',
                'valor_venta',
                'id_impuesto',
                'margen_error',
                'preparacion',
                'montaje',
                'foto',
                'duracion_prep',
            ], [
                'id_receta' => $id,
            ]);

            return $data;
        }

        public function buscaAcompanantes($reserva)
        {
            global $database;

            $data = $database->select('acompanantes', [
                '[<]huespedes' => ['id_huesped'],
            ], [
                'nombre_completo',
            ], [
                'id_reserva' => $reserva,
            ]);

            return $data;
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

        public function getProductosMovimiento($numero)
        {
            global $database;

            $data = $database->select('movimientos_inventario', [
                '[>]productos_inventario' => 'id_producto',
            ], [
                'productos_inventario.nombre_producto',
                'movimientos_inventario.numero',
                'movimientos_inventario.fecha_movimiento',
                'movimientos_inventario.documento',
                'movimientos_inventario.valor_unitario',
                'movimientos_inventario.valor_total',
                'movimientos_inventario.cantidad',
                'movimientos_inventario.unidad_alm',
                'movimientos_inventario.id_proveedor',
                'movimientos_inventario.id_bodega',
                'movimientos_inventario.tipo_movi',
            ], [
                'movimientos_inventario.numero' => $numero,
                'movimientos_inventario.tipo' => 2,
                'movimientos_inventario.movimiento' => 2,
                'ORDER' => ['productos_inventario.nombre_producto' => 'ASC'],
            ]);

            return $data;
        }

        
        

        public function getProductosRecetasVenta($idamb, $nComa, $tipo)
        {
            global $database;

            $data = $database->query("SELECT detalle_facturas_pos.cant, detalle_facturas_pos.producto_id, producto.id_receta, producto.nom, producto.venta, productos_recetas.cantidad, productos_recetas.valor_promedio, productos_recetas.id_producto, productos_inventario.unidad_almacena, productos_inventario.valor_promedio, productos_inventario.nombre_producto, productos_inventario.id_producto FROM detalle_facturas_pos, producto, productos_recetas, productos_inventario WHERE detalle_facturas_pos.comanda = '$nComa' AND detalle_facturas_pos.ambiente = '$idamb' AND detalle_facturas_pos.producto_id = producto.producto_id AND producto.id_receta = productos_recetas.id_receta AND producto.tipo_producto = '$tipo' AND productos_recetas.deleted_at IS NULL AND productos_recetas.tipoProducto = 0 AND productos_recetas.id_producto = productos_inventario.id_producto ORDER BY nombre_producto")->fetchAll();
            return $data;
        }

        public function getProductosSubRecetasVenta($idamb, $nComa, $tipo)
        {
            global $database;

            $data = $database->query("SELECT detalle_facturas_pos.nom, detalle_facturas_pos.cant, recetasEstandar.nombre_receta, recetasEstandar.cantidad as cantRece, subReceta.id_producto as idSubReceta, receta.nombre_receta as subReceta, subReceta.cantidad as cantProd, productos_recetas.cantidad, productos_inventario.nombre_producto, productos_inventario.unidad_almacena, productos_inventario.valor_promedio, productos_inventario.id_producto FROM detalle_facturas_pos, producto, recetasEstandar, productos_recetas as subReceta, recetasEstandar as receta, productos_recetas, productos_inventario WHERE detalle_facturas_pos.comanda = '$nComa' AND detalle_facturas_pos.ambiente = '$idamb' AND detalle_facturas_pos.producto_id = producto.producto_id and producto.id_receta = recetasEstandar.id_receta AND recetasEstandar.id_receta = subReceta.id_receta and subReceta.tipoProducto = 1 AND subReceta.deleted_at IS NULL AND subReceta.id_producto = receta.id_receta and receta.id_receta = productos_recetas.id_receta and productos_recetas.id_producto = productos_inventario.id_producto and productos_recetas.deleted_at is Null order by subReceta,nombre_producto")->fetchAll();
            return $data;
        }
        

        public function traeDatosMovimiento()
        {
            global $database;

            $data = $database->select('tipo_movimiento_inventario', [
                'tipo',
                'id_tipomovi',
            ], [
                'venta' => 1,
            ]);

            return $data;
        }

        public function insertaMovimiento($tipomovi, $tipo, $movimi, $numeroMov, $fecham, $provee, $factur, $producto, $cantidad, $unidadalm, $unit, $subtotal, $costo, $almacen, $estado, $usuario)
        {
            global $database;

            $data = $database->insert('movimientos_inventario', [
                'tipo' => $movimi,
                'tipo_movi' => $tipomovi,
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
                'valor_total' => $costo,
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
            $data = $database->select('parametros_inv', [
                $campo,
            ]);

            return $data[0][$campo];
        }

        public function buscaProductoReceta($prod, $cant)
        {
            global $database;

            $data = $database->select('productos_inventario', [
                'id_producto',
                'unidad_almacena',
                'valor_promedio',
            ], [
                'id_producto' => $prod,
            ]);

            return $data;
        }

        public function traeProductoVta($prod)
        {
            global $database;

            $data = $database->select('productos_inventario', [
                'id_producto',
                'unidad_almacena',
                'valor_promedio',
            ], [
                'id_producto' => $prod,
            ]);

            return $data;
        }

        public function traeRecetaVta($rece)
        {
            global $database;

            $data = $database->select('productos_recetas', [
                'id_producto',
                'cantidad',
                'id_unidad_procesa',
            ], [
                'id_receta' => $rece,
                'deleted_at' => null,
            ]);

            return $data;
        }

        public function getDescargaInventario($amb, $coma, $tipo)
        {
            global $database;

            $data = $database->query("SELECT productos_inventario.unidad_almacena, productos_inventario.valor_promedio, producto.nom, productos_inventario.id_producto, detalle_facturas_pos.cant FROM productos_inventario, producto, detalle_facturas_pos WHERE detalle_facturas_pos.producto_id = producto.producto_id AND producto.id_receta = productos_inventario.id_producto AND producto.tipo_producto = '$tipo' AND detalle_facturas_pos.ambiente = '$amb' AND detalle_facturas_pos.comanda = '$coma'")->fetchAll();

            return $data;
        }

        public function traePorcentajeImpto($id)
        {
            global $database;

            $data = $database->select('codigos_vta', [
                'porcentaje_impto',
            ], [
                'id_cargo' => $id,
            ]);

            return $data[0]['porcentaje_impto'];
        }

        public function eliminaMateriaPrima($produc)
        {
            global $database;

            $data = $database->update('productos_recetas', [
                'deleted_at' => date('Y-m-d H:i:s'),
            ], [
                'id' => $produc,
            ]);
        }

        public function actualizaCosto($receta, $porCosto, $valorCosto, $valorPorci)
        {
            global $database;

            $data = $database->update('recetasEstandar', [
                'valor_costo' => $valorCosto,
                'valor_costo_porcion' => $valorPorci,
                'por_costo' => $porCosto,
            ], [
                'id_receta' => $receta,
            ]);

            return $data;
        }

        public function traeVenta($id)
        {
            global $database;

            $data = $database->select('recetasEstandar', [
                '[<]codigos_vta' => ['id_impuesto' => 'id_cargo'],
            ], [
                'codigos_vta.porcentaje_impto',
                'recetasEstandar.cantidad',
                'recetasEstandar.valor_venta',
                'recetasEstandar.valor_neto',
                'recetasEstandar.valor_impto',
                'recetasEstandar.valor_porcion',
            ], [
                'id_receta' => $id,
            ]);

            return $data;
        }

        public function traeCosto($id)
        {
            global $database;

            $data = $database->sum('productos_recetas', [
                'valor_promedio',
            ], [
                'deleted_at' => null,
                'id_receta' => $id,
            ]);

            return $data;
        }

        public function adicionaReceta($receta, $porcion, $tipoReceta, $impto, $subreceta, $vlrVenta, $vlrNeto, $vlrImpt, $vlrPorc, $margen, $tiempo, $preparacion, $montaje, $usuario)
        {
            global $database;

            $data = $database->insert('recetasEstandar', [
                'nombre_receta' => $receta,
                'id_seccion' => $tipoReceta,
                'subreceta' => $subreceta,
                'cantidad' => $porcion,
                'id_impuesto' => $impto,
                'valor_venta' => $vlrVenta,
                'valor_impto' => $vlrImpt,
                'valor_neto' => $vlrNeto,
                'valor_porcion' => $vlrPorc,
                'preparacion' => $preparacion,
                'montaje' => $montaje,
                'margen_error' => $margen,
                'duracion_prep' => $tiempo,
                'usuario' => $usuario,
                'estado' => 1,
                'actived_at' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            return $database->id();
        }

        public function eliminaReceta($id)
        {
            global $database;

            $data = $database->update('recetasEstandar', [
                'deleted_at' => date('Y-m-d H:i:s'),
            ], [
                'id_receta' => $id,
            ]);

            return $data->rowCount();
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
                'recetasEstandar.subreceta',
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

        public function getPagosDia($fecha, $amb)
        {
            global $database;

            $data = $database->query("SELECT 
            SUM(historico_facturas_pos.valor_total) as total, 
            SUM(historico_facturas_pos.valor_neto) as neto, 
            SUM(historico_facturas_pos.servicio) as servicio, 
            SUM(historico_facturas_pos.pagado) as pago, 
            SUM(historico_facturas_pos.cambio) as cambio, 
            SUM(historico_facturas_pos.impuesto) as impto, 
            formas_pago.id_pago,  
            formas_pago.descripcion  
            FROM 
            historico_facturas_pos, 
            formas_pago 
            WHERE 
            historico_facturas_pos.forma_pago = formas_pago.id_pago AND 
            historico_facturas_pos.ambiente = '$amb' AND 
            historico_facturas_pos.estado = 'A' AND 
            historico_facturas_pos.fecha = '$fecha'
            GROUP BY
            formas_pago.descripcion 
            ORDER BY
            formas_pago.descripcion ASC")->fetchAll();

            return $data;
        }

        

        public function acumuladoAnioProductosVendidos($amb, $anio)
        {
            global $database;

            $data = $database->query("SELECT Sum(historico_detalle_facturas_pos.cant) as cantanio, Sum(historico_detalle_facturas_pos.venta) as ventasanio, Sum(historico_detalle_facturas_pos.descuento) AS descuentoanio, Sum(historico_detalle_facturas_pos.valorimpto) AS imptosanio, historico_detalle_facturas_pos.nom, historico_detalle_facturas_pos.producto_id, historico_facturas_pos.ambiente, historico_facturas_pos.factura, historico_facturas_pos.comanda, historico_facturas_pos.fecha, historico_facturas_pos.estado FROM historico_facturas_pos, historico_detalle_facturas_pos WHERE historico_facturas_pos.ambiente = '$amb' AND YEAR(historico_facturas_pos.fecha) = '$anio' AND historico_facturas_pos.estado = 'A' AND historico_facturas_pos.ambiente =  historico_detalle_facturas_pos.ambiente AND historico_facturas_pos.comanda = historico_detalle_facturas_pos.comanda GROUP BY historico_detalle_facturas_pos.nom ORDER BY historico_detalle_facturas_pos.nom ASC")->fetchAll();

            return $data;
        }

        public function getPagosMes($anio, $mes, $amb)
        {
            global $database;

            $data = $database->query("SELECT 
            SUM(historico_facturas_pos.valor_total) as totalmes, 
            SUM(historico_facturas_pos.valor_neto) as netomes, 
            SUM(historico_facturas_pos.servicio) as servimes, 
            SUM(historico_facturas_pos.pagado) as pagomes, 
            SUM(historico_facturas_pos.cambio) as cambiomes, 
            SUM(historico_facturas_pos.impuesto) as imptomes, 
            formas_pago.id_pago,  
            formas_pago.descripcion  
            FROM 
            historico_facturas_pos, 
            formas_pago 
            WHERE 
            historico_facturas_pos.forma_pago = formas_pago.id_pago AND 
            historico_facturas_pos.ambiente = '$amb' AND 
            historico_facturas_pos.estado = 'A' AND 
            YEAR(historico_facturas_pos.fecha) = '$anio' AND
            MONTH(historico_facturas_pos.fecha) = '$mes'
            GROUP BY
            formas_pago.descripcion 
            ORDER BY
            formas_pago.descripcion ASC")->fetchAll();

            return $data;
        }

        public function getPagosAnio($anio, $amb)
        {
            global $database;

            $data = $database->query("SELECT 
            SUM(historico_facturas_pos.valor_total) as totalanio, 
            SUM(historico_facturas_pos.valor_neto) as netoanio, 
            SUM(historico_facturas_pos.servicio) as servanio, 
            SUM(historico_facturas_pos.pagado) as pagoanio, 
            SUM(historico_facturas_pos.cambio) as cambioanio, 
            SUM(historico_facturas_pos.impuesto) as imptoanio, 
            formas_pago.id_pago,  
            formas_pago.descripcion  
            FROM 
            historico_facturas_pos, 
            formas_pago 
            WHERE 
            historico_facturas_pos.forma_pago = formas_pago.id_pago AND 
            historico_facturas_pos.ambiente = '$amb' AND 
            historico_facturas_pos.estado = 'A' AND 
            YEAR(historico_facturas_pos.fecha) = '$anio'
            GROUP BY
            formas_pago.descripcion 
            ORDER BY
            formas_pago.descripcion ASC")->fetchAll();

            return $data;
        }

        public function traeGrupos($amb)
        {
            global $database;

            $data = $database->select('secciones_pos', [
                'id_seccion',
                'nombre_seccion',
            ], [
                'id_ambiente' => $amb,
                'deleted_at' => null,
                'ORDER' => ['nombre_seccion' => 'ASC'],
            ]);

            return $data;
        }


        public function getVentasDiaGrupos($fecha, $amb)
        {
            global $database;

            $data = $database->query("SELECT
            SUM(historico_detalle_facturas_pos.venta) AS ventas, 
            SUM(historico_detalle_facturas_pos.cant) AS cant, 
            SUM(historico_detalle_facturas_pos.valorimpto) AS imptos, 
            historico_detalle_facturas_pos.ambiente, 
            secciones_pos.nombre_seccion,
            secciones_pos.id_seccion
            FROM
                historico_detalle_facturas_pos, 
                historico_facturas_pos,
                producto,
                secciones_pos
            WHERE
                historico_detalle_facturas_pos.comanda = historico_facturas_pos.comanda AND
                historico_detalle_facturas_pos.producto_id = producto.producto_id AND
                producto.seccion = secciones_pos.id_seccion AND
                historico_facturas_pos.fecha = '$fecha' AND
                historico_facturas_pos.estado = 'A' AND
                historico_facturas_pos.ambiente = '$amb' AND
                historico_detalle_facturas_pos.ambiente = '$amb'
            GROUP BY 
                secciones_pos.nombre_seccion 
            ORDER BY 
            secciones_pos.nombre_seccion")->fetchAll();

            return $data;
        }

        public function getVentasMesGrupos($anio, $mes, $amb)
        {
            global $database;

            $data = $database->query("SELECT
                SUM(historico_detalle_facturas_pos.venta) AS ventasmes, 
                SUM(historico_detalle_facturas_pos.cant) AS cantmes, 
                SUM(historico_detalle_facturas_pos.valorimpto) AS imptosmes, 
                historico_detalle_facturas_pos.ambiente, 
                secciones_pos.nombre_seccion,
                secciones_pos.id_seccion
            FROM
                historico_detalle_facturas_pos, 
                historico_facturas_pos,
                producto,
                secciones_pos
            WHERE
                historico_detalle_facturas_pos.comanda = historico_facturas_pos.comanda AND
                historico_detalle_facturas_pos.producto_id = producto.producto_id AND
                producto.seccion = secciones_pos.id_seccion AND
                YEAR(historico_facturas_pos.fecha) = '$anio' AND
                MONTH(historico_facturas_pos.fecha) = '$mes' AND
                historico_facturas_pos.estado = 'A' AND
                historico_facturas_pos.ambiente = '$amb' AND
                historico_detalle_facturas_pos.ambiente = '$amb'
            GROUP BY 
                secciones_pos.nombre_seccion 
            ORDER BY 
                secciones_pos.nombre_seccion")->fetchAll();

            return $data;
        }

        public function getVentasAnioGrupos($anio, $amb)
        {
            global $database;

            $data = $database->query("SELECT
                SUM(historico_detalle_facturas_pos.venta) AS ventasanio, 
                SUM(historico_detalle_facturas_pos.cant) AS cantanio, 
                SUM(historico_detalle_facturas_pos.valorimpto) AS imptosanio, 
                historico_detalle_facturas_pos.ambiente, 
                secciones_pos.nombre_seccion,
                secciones_pos.id_seccion
            FROM
                historico_detalle_facturas_pos, 
                historico_facturas_pos,
                producto,
                secciones_pos
            WHERE
                historico_detalle_facturas_pos.comanda = historico_facturas_pos.comanda AND
                historico_detalle_facturas_pos.producto_id = producto.producto_id AND
                producto.seccion = secciones_pos.id_seccion AND
                YEAR(historico_facturas_pos.fecha) = '$anio' AND
                historico_facturas_pos.estado = 'A' AND
                historico_facturas_pos.ambiente = '$amb' AND
                historico_detalle_facturas_pos.ambiente = '$amb'
            GROUP BY 
                secciones_pos.nombre_seccion 
            ORDER BY 
                secciones_pos.nombre_seccion")->fetchAll();

            return $data;

        }

        public function getVentasDiaProducto($fecha, $codi, $amb)
        {
            global $database;

            $data = $database->query("SELECT Sum(historico_detalle_facturas_pos.cant) as can, Sum(historico_detalle_facturas_pos.importe) as valuni, Sum(historico_detalle_facturas_pos.descuento) as descu, Sum(historico_detalle_facturas_pos.valorimpto) as impto, Sum(historico_detalle_facturas_pos.venta) as total  FROM historico_facturas_pos, historico_detalle_facturas_pos WHERE historico_facturas_pos.comanda = historico_detalle_facturas_pos.comanda AND historico_facturas_pos.ambiente = historico_detalle_facturas_pos.ambiente AND historico_facturas_pos.ambiente = '$amb' AND historico_facturas_pos.estado = 'A' AND historico_facturas_pos.fecha = '$fecha' AND historico_detalle_facturas_pos.producto_id = '$codi' GROUP BY historico_detalle_facturas_pos.producto_id")->fetchAll();

            return $data;
        }

        public function getVentasMesProducto($anio, $mes, $codi, $amb)
        {
            global $database;

            $data = $database->query("SELECT Sum(historico_detalle_facturas_pos.cant) as canmes, Sum(historico_detalle_facturas_pos.importe) as valunimes, Sum(historico_detalle_facturas_pos.descuento) as descumes, Sum(historico_detalle_facturas_pos.valorimpto) as imptomes, Sum(historico_detalle_facturas_pos.venta) as totalmes  FROM historico_facturas_pos, historico_detalle_facturas_pos WHERE historico_facturas_pos.comanda = historico_detalle_facturas_pos.comanda AND historico_facturas_pos.ambiente = historico_detalle_facturas_pos.ambiente AND historico_facturas_pos.ambiente = '$amb' AND historico_facturas_pos.estado = 'A' AND month(historico_facturas_pos.fecha) = '$mes' AND year(historico_facturas_pos.fecha) = '$anio'  AND historico_detalle_facturas_pos.producto_id = '$codi' GROUP BY historico_detalle_facturas_pos.producto_id")->fetchAll();

            return $data;
        }

        public function getVentasAnioProducto($anio, $codi, $amb)
        {
            global $database;

            $data = $database->query("SELECT Sum(historico_detalle_facturas_pos.cant) as cananio, Sum(historico_detalle_facturas_pos.importe) as valunianio, Sum(historico_detalle_facturas_pos.descuento) as descuanio, Sum(historico_detalle_facturas_pos.valorimpto) as imptoanio, Sum(historico_detalle_facturas_pos.venta) as totalanio  FROM historico_facturas_pos, historico_detalle_facturas_pos WHERE historico_facturas_pos.comanda = historico_detalle_facturas_pos.comanda AND historico_facturas_pos.ambiente = historico_detalle_facturas_pos.ambiente AND historico_facturas_pos.ambiente = '$amb' AND historico_facturas_pos.estado = 'A' AND year(historico_facturas_pos.fecha) = '$anio'  AND historico_detalle_facturas_pos.producto_id = '$codi' GROUP BY historico_detalle_facturas_pos.producto_id")->fetchAll();

            return $data;
        }

        public function traeProductos($amb)
        {
            global $database;

            $data = $database->select('producto', [
                'producto_id',
                'nom',
            ], [
                'ambiente' => $amb,
                'active_at' => 1,
                'deleted_at' => null,
                'ORDER' => ['nom' => 'ASC'],
            ]);

            return $data;
        }

        public function eliminaProductoReceta($id)
        {
            global $database;

            $data = $database->update('productos_recetas', [
                'deleted_at' => date('Y-m-d H:m:s'),
            ], [
                'id' => $id,
            ]);

            return $data->rowCount();
        }

        public function adicionaMateriaPrima($produc, $receta, $unidad, $cantid, $valuni, $valtot, $usuario)
        {
            global $database;

            $data = $database->insert('productos_recetas', [
                'id_producto' => $produc,
                'id_receta' => $receta,
                'id_unidad_procesa' => $unidad,
                'cantidad' => $cantid,
                'valor_unitario_promedio' => $valuni,
                'valor_promedio' => $valtot,
                'usuario' => $usuario,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            return $database->id();
        }

        public function getInformacionProductosRecetas($id)
        {
            global $database;

            $data = $database->select('productos_inventario', [
                'unidad_procesa',
                'valor_costo',
                'valor_promedio',
            ], [
                'id_producto' => $id,
            ]);

            return $data[0];
        }

        public function getProductosInventario()
        {
            global $database;

            $data = $database->select('productos_inventario', [
                'id_producto',
                'nombre_producto',
                'unidad_procesa',
            ], [
                'deleted_at' => null,
                'ORDER' => 'nombre_producto',
            ]);

            return $data;
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

        public function getProductosRecetas($id)
        {
            global $database;

            $data = $database->select('productos_recetas', [
                '[>]productos_inventario' => ['id_producto' => 'id_producto'],
                '[>]unidades' => ['id_unidad_procesa' => 'id_unidad'],
            ], [
                'productos_inventario.nombre_producto',
                'productos_inventario.unidad_procesa',
                'unidades.descripcion_unidad',
                'productos_recetas.id',
                'productos_recetas.id_producto',
                'productos_recetas.tipoProducto',
                'productos_recetas.id_receta',
                'productos_recetas.valor_unitario_promedio',
                'productos_recetas.valor_unitario_compra',
                'productos_recetas.cantidad',
                'productos_recetas.valor_promedio',
                'productos_recetas.valor_compra',
            ], [
                'productos_recetas.id_receta' => $id,
                'productos_recetas.tipoProducto' => 0,
                'productos_recetas.deleted_at' => null,
                
                'ORDER' => ['productos_inventario.nombre_producto' => 'ASC'],
            ]);

            return $data;
        }

        public function actualizaCliente($id, $nombre1, $nombre2, $apellido1, $apellido2, $identificacion, $direccion, $telefono, $celular, $correo, $tipodoc)
        {
            global $database;

            $data = $database->update('clientes', [
                'identificacion' => $identificacion,
                'apellido1' => $apellido1,
                'apellido2' => $apellido2,
                'nombre1' => $nombre1,
                'nombre2' => $nombre2,
                'direccion' => $direccion,
                'telefono' => $telefono,
                'celular' => $celular,
                'email' => $correo,
                'id_tipo_doc' => $tipodoc,
            ], [
                'id_cliente' => $id,
            ]);

            return $database->id();
        }

        public function traeCliente($id)
        {
            global $database;

            $data = $database->select('clientes', [
                'id_cliente',
                'identificacion',
                'apellido1',
                'apellido2',
                'nombre1',
                'nombre2',
                'direccion',
                'telefono',
                'email',
                'celular',
                'estado',
                'id_tipo_doc',
            ], [
                'id_cliente' => $id,
            ]);

            return $data;
        }

            // actualizaProducto($id, $producto, $codigo, $seccion, $venta, $impto, $tipo, $receta)

        public function actualizaProducto($id, $producto, $codigo, $seccion, $venta, $impto, $tipo, $receta)
        {
            global $database;

            $data = $database->update('producto', [
                'nom' => $producto,
                'venta' => $venta,
                'impto' => $impto,
                            'cod' => $codigo,
                'seccion' => $seccion,
                'tipo_producto' => $tipo,
                'id_receta' => $receta,
            ], [
                'producto_id' => $id,
            ]);

            return $database->id();
        }

        public function traeProducto($id)
        {
            global $database;

            $data = $database->select('producto', [
                'producto_id',
                'id_receta',
                'cod',
                'nom',
                'venta',
                'impto',
                'seccion',
                'estado',
                'tipo_producto',
                'ambiente',
                'active_at',
            ], [
                'producto_id' => $id,
            ]);

            return $data;
        }

        public function getHistoricoProductosVendidosFactura($amb, $coma)
        {
            global $database;

            $data = $database->select('historico_detalle_facturas_pos', [
                'nom',
                'venta',
                'cant',
                'valorimpto',
                'descuento',
                'importe',
            ], [
                'ambiente' => $amb,
                'comanda' => $coma,
            ]);

            return $data;
        }

        public function getDatosHistoricoFactura($amb, $comanda)
        {
            global $database;

            $data = $database->select('historico_facturas_pos', [
                'mesa',
                'pax',
                'factura',
                'comanda',
                'valor_total',
                'valor_neto',
                'impuesto',
                'propina',
                'descuento',
                'pagado',
                'cambio',
                'fecha',
                'fecha_factura',
                'usuario_factura',
                'id_cliente',
                'pms',
                'estado',
                'forma_pago',
                'nro_reserva_pms',
            ], [
                'ambiente' => $amb,
                'comanda' => $comanda,
            ]);

            return $data;
        }

        public function buscaComandaHistorico($nFact, $amb)
        {
            global $database;

            $data = $database->select('historico_facturas_pos', [
                'comanda',
            ], [
                'ambiente' => $amb,
                'factura' => $nFact,
            ]);

            return $data[0]['comanda'];
        }

        public function getFacturasPorRango($sele)
        {
            global $database;

            $data = $database->query($sele)->fetchAll();

            return $data;
        }

        public function cambiaEstadoTodosCajero($estado)
        {
            global $database;

            $data = $database->update('usuarios', [
                'estado_usuario_pos' => $estado,
            ]);

            return $data->rowCount();
        }

        public function cambiaEstadoCajero($idusr, $estado)
        {
            global $database;

            $data = $database->update('usuarios', [
                'estado_usuario_pos' => $estado,
            ], [
                'usuario_id' => $idusr,
            ]);

            return $data->rowCount();
        }

        public function productosComanda($amb, $id)
        {
            global $database;

            $data = $database->select('ventas_dia_pos', [
                'id',
                'producto_id',
                'cod',
                'nom',
                'venta',
                'cant',
                'importe',
                'usu',
                'ambiente',
                'comanda',
                'descuento',
                'por_desc',
                'impto',
                'valorimpto',
            ], [
                'ambiente' => $amb,
                'comanda' => $id,
                'ORDER' => ['nom' => 'ASC'],
            ]);

            return $data;
        }

        public function datosComanda($amb, $id)
        {
            global $database;

            $data = $database->select('comandas', [
                'comanda',
                'mesa',
                'pax',
                'usuario',
                'fecha',
                'fecha_comanda',
                'estado',
            ], [
                'comanda' => $id,
                'ambiente' => $amb,
            ]);

            return $data;
        }

        public function getLogoAmbiente($amb)
        {
            global $database;

            $data = $database->select('ambientes', [
                'logo',
            ], [
                'id_ambiente' => $amb,
            ]);

            return $data[0]['logo'];
        }

        public function getFechaAmbiente($amb)
        {
            global $database;

            $data = $database->select('ambientes', [
                'fecha_auditoria',
            ], [
                'id_ambiente' => $amb,
            ]);

            return $data[0]['fecha_auditoria'];
        }

        public function getPrefijoAmbiente($amb)
        {
            global $database;

            $data = $database->select('ambientes', [
                'prefijo',
            ], [
                'id_ambiente' => $amb,
            ]);

            return $data[0]['prefijo'];
        }

        public function getAmbienteSeleccionadoUsuario($ambiente)
        {
            global $database;

            $data = $database->select('ambientes', [
                'codigo',
                'id_ambiente',
                'nombre',
                'id_centrocosto',
                'prefijo',
                'servicio',
                'propina',
                'propina_incluida',
                'impuesto',
                'id_bodega',
                'codigo_venta',
                'codigo_propina',
                'codigo_servicio',
                'fecha_auditoria',
                'encuesta',
                'plano',
                'logo',
            ], [
                'id_ambiente' => $ambiente,
            ]);

            return $data;
        }

        public function getBuscaFacturasFecha($fecha, $amb)
        {
            global $database;

            $data = $database->select('historico_facturas_pos', [
                '[>]formas_pago' => ['forma_pago' => 'id_pago'],
            ], [
                'historico_facturas_pos.id',
                'historico_facturas_pos.factura',
                'historico_facturas_pos.comanda',
                'historico_facturas_pos.mesa',
                'historico_facturas_pos.pax',
                'historico_facturas_pos.usuario_factura',
                'historico_facturas_pos.fecha',
                'historico_facturas_pos.fecha_factura',
                'historico_facturas_pos.valor_total',
                'historico_facturas_pos.valor_neto',
                'historico_facturas_pos.impuesto',
                'historico_facturas_pos.propina',
                'historico_facturas_pos.descuento',
                'historico_facturas_pos.estado',
                'historico_facturas_pos.pms',
                'historico_facturas_pos.forma_pago',
                'historico_facturas_pos.usuario',
                'historico_facturas_pos.ambiente',
                'formas_pago.descripcion',
            ], [
                'historico_facturas_pos.ambiente' => $amb,
                'historico_facturas_pos.fecha' => $fecha,
            ]);

            return $data;
        }

        public function getCantidadProductosVendidos($amb)
        {
            global $database;

            $data = $database->query("SELECT
        ambientes.nombre, 
        sum(detalle_facturas_pos.venta) AS ventas, 
        sum(detalle_facturas_pos.cant) AS cant, 
        sum(facturas_pos.pax) AS pers	
    FROM
        detalle_facturas_pos,
        facturas_pos,
        ambientes
    WHERE
        facturas_pos.comanda = detalle_facturas_pos.comanda AND
        facturas_pos.ambiente = ambientes.id_ambiente AND
        facturas_pos.estado = 'A' AND
        ambientes.id_ambiente = '$amb'
        GROUP BY 
        ambientes.nombre ")->fetchAll();

            return $data;
        }

        public function getCantidadGruposVendidos($amb)
        {
            global $database;

            $data = $database->query("SELECT detalle_facturas_pos.nom, Sum(detalle_facturas_pos.venta) AS ventas, Sum(detalle_facturas_pos.cant) AS cant, Sum(facturas_pos.pax) AS pers, ambientes.nombre FROM detalle_facturas_pos , facturas_pos , ambientes WHERE facturas_pos.factura = detalle_facturas_pos.factura AND facturas_pos.ambiente = ambientes.id_ambiente AND facturas_pos.estado = 'A' AND ambientes.id_ambiente = '$amb' GROUP BY ambientes.nombre ORDER BY cant DESC")->fetchAll();

            return $data;
        }

        public function getTotalGruposVendidos($amb)
        {
            global $database;

            $data = $database->query("SELECT secciones_pos.nombre_seccion, sum(detalle_facturas_pos.venta) AS ventas, sum(detalle_facturas_pos.valorimpto) AS imptos, sum(detalle_facturas_pos.venta+detalle_facturas_pos.valorimpto) AS total, sum(detalle_facturas_pos.cant) AS cant, facturas_pos.pax AS pers, ambientes.nombre FROM detalle_facturas_pos , facturas_pos , ambientes , secciones_pos , producto WHERE facturas_pos.ambiente = ambientes.id_ambiente AND facturas_pos.estado = 'A' AND ambientes.id_ambiente = '$amb' AND producto.seccion = secciones_pos.id_seccion AND detalle_facturas_pos.producto_id = producto.producto_id AND detalle_facturas_pos.comanda = facturas_pos.comanda GROUP BY secciones_pos.nombre_seccion, ambientes.id_ambiente")->fetchAll();

            return $data;
        }

        public function getTotalProductosVendidos($amb)
        {
            global $database;

            $data = $database->query("SELECT detalle_facturas_pos.nom, Sum(detalle_facturas_pos.venta) AS ventas, Sum(detalle_facturas_pos.descuento) AS descuento, Sum(detalle_facturas_pos.valorimpto) AS imptos,  Sum(detalle_facturas_pos.venta+detalle_facturas_pos.valorimpto) AS total, Sum(detalle_facturas_pos.cant) AS cant, Sum(facturas_pos.pax) AS pers, ambientes.nombre FROM detalle_facturas_pos , facturas_pos , ambientes WHERE facturas_pos.comanda = detalle_facturas_pos.comanda AND facturas_pos.ambiente = ambientes.id_ambiente AND facturas_pos.estado = 'A' AND ambientes.id_ambiente = '$amb' GROUP BY ambientes.nombre, detalle_facturas_pos.nom ORDER BY nom ASC ")->fetchAll();

            return $data;
        }

        public function getDatosUsuario($id)
        {
            global $database;

            $data = $database->select('usuarios', [
                'apellidos',
                'nombres',
                'usuario',
            ], [
                'usuario_id' => $id,
            ]);

            return $data;
        }

        public function getTipoDocumento()
        {
            global $database;

            $data = $database->select('tipo_documento', [
                'id_doc',
                'descripcion_documento',
            ], [
                'ORDER' => 'descripcion_documento',
            ]);

            return $data;
        }

        public function buscaComanda($comanda, $amb)
        {
            global $database;

            $data = $database->select('comandas', [
                'mesa',
            ], [
                'comanda' => $comanda,
                'ambiente' => $amb,
            ]);

            return $data[0]['mesa'];
        }

        public function getUsuarios()
        {
            global $database;

            $data = $database->select('usuarios', [
                'nombres',
                'apellidos',
                'usuario',
            ], [
                'estado' => 'A',
                'ORDER' => ['apellidos' => 'ASC'],
            ]);

            return $data;
        }

        public function getDetalleFacturaCajerosDia($estado, $usu, $amb)
        {
            global $database;

            $data = $database->query("SELECT facturas_pos.*, ambientes.nombre  FROM facturas_pos, ambientes WHERE estado = '$estado' AND facturas_pos.ambiente = ambientes.id_ambiente AND facturas_pos.usuario = '$usu' AND facturas_pos.ambiente = $amb ORDER BY ambiente, factura")->fetchAll();

            return $data;
        }

        public function getFacturasDiaCajero($estado, $usu)
        {
            global $database;

            $data = $database->query("SELECT count(facturas_pos.factura) as facturas, sum(valor_total) as total, ambientes.nombre  from facturas_pos, ambientes where estado = '$estado' and facturas_pos.ambiente = ambientes.id_ambiente AND facturas_pos.usuario = '$usu' group by ambiente")->fetchAll();

            return $data;
        }

        public function cambiaFechaAuditoria($amb, $fecha)
        {
            global $database;

            $data = $database->update('ambientes', [
                'fecha_auditoria' => $fecha,
            ], [
                'id_ambiente' => $amb,
            ]);

            return $data->rowCount();
        }

        public function eliminaDetelleFacturas($idamb)
        {
            global $database;

            $data = $database->delete('detalle_facturas_pos', [
                'AND' => [
                    'id[>]' => 0,
                    'ambiente' => $idamb,
                ],
            ]);

            return $data->rowCount();
        }

        public function eliminaFacturas($idamb)
        {
            global $database;

            $data = $database->delete('facturas_pos', [
                'AND' => [
                    'id[>]' => 0,
                    'ambiente' => $idamb,
                ],
            ]);

            return $data->rowCount();
        }

        public function eliminaDetelleComandas($idamb)
        {
            global $database;

            $data = $database->delete('ventas_dia_pos', [
                'AND' => [
                    'id[>]' => 0,
                    'ambiente' => $idamb,
                ],
            ]);

            return $data->rowCount();
        }

        public function eliminaComandas($idamb)
        {
            global $database;

            $data = $database->delete('comandas', [
                'AND' => [
                    'id[>]' => 0,
                    'ambiente' => $idamb,
                ],
            ]);

            return $data->rowCount();
        }

        public function enviaHistoricoDetalleFacturas($idamb)
        {
            global $database;

            $data = $database->query("INSERT INTO historico_detalle_facturas_pos SELECT * FROM detalle_facturas_pos WHERE ambiente = '$idamb'")->fetchAll();

            return $database->id();
        }

        public function enviaHistoricoFacturas($idamb)
        {
            global $database;

            $data = $database->query("INSERT INTO historico_facturas_pos SELECT * FROM facturas_pos WHERE ambiente = '$idamb'")->fetchAll();

            return $database->id();
        }

        public function enviaHistoricoDetalleComandas($idamb)
        {
            global $database;

            $data = $database->query("INSERT INTO historico_ventas_dia_pos SELECT * FROM ventas_dia_pos WHERE ambiente = '$idamb'")->fetchAll();

            return $database->id();
        }

        public function enviaHistoricoCaja($idamb)
        {
            global $database;

            $data = $database->query("INSERT INTO historicoBaseCaja SELECT * FROM baseCaja WHERE idAmbiente = '$idamb'")->fetchAll();

            return $database->id();
        }

        public function enviaHistoricoAbonos($idamb)
        {
            global $database;

            $data = $database->query("INSERT INTO historicoAbonos SELECT * FROM abonos WHERE ambiente = '$idamb'")->fetchAll();

            return $database->id();
        }

        public function enviaHistoricoComandas($idamb)
        {
            global $database;

            $data = $database->query("INSERT INTO historico_comandas SELECT * FROM comandas WHERE ambiente = '$idamb'")->fetchAll();

            return $database->id();
        }

        public function productoPOS($amb)
        {
            global $database;

            $data = $database->select('producto', [
                'producto_id',
                'nom',
            ], [
                'deleted_at' => null,
                'estado[<=]' => 2,
                'ambiente' => $amb,
                'active_at' => 1,
                'ORDER' => ['nom' => 'ASC'],
            ]);

            return $data;
        }

        public function getVentasAnioPos($idamb, $anio)
        {
            global $database;

            $data = $database->query("SELECT 
				sum(ingreso_ventas) as anioVta, 
				sum(ingreso_impto) as anioImp, 
				sum(ingreso_propina) as anioPro, 
				sum(ingreso_servicio) as anioSer, 
				sum(ingreso_descuentos) as descSer, 
				sum(ingreso_promedio_mesa) as  anioIpm, 
				sum(ingreso_promedio_cliente) as anioIpc,
				sum(mesas_disponibles) as anioDis,
				sum(mesas_ocupadas) as anioOcu,
				sum(ventas_anuladas) as anioVan,
				sum(imptos_anulados) as anioIan,
				sum(mesas_anuladas) as anioMan,
				sum(cuentas_anuladas) as anioCan,
				sum(clientes_vendidos) as anioCve,
				sum(clientes_anulados) as anioCla,
				sum(clientes_comandas_anuladas) as anioCca
				FROM reporte_gerencia_pos
				WHERE year(fecha_auditoria) = '$anio' AND id_ambiente = '$idamb' ")->fetchAll();

            return $data;
        }

        public function getVentasMesPos($idamb, $mes, $anio)
        {
            global $database;

            $data = $database->query("SELECT 
				sum(ingreso_ventas) as mesVta, 
				sum(ingreso_impto) as mesImp, 
				sum(ingreso_propina) as mesPro, 
				sum(ingreso_servicio) as mesSer, 
				sum(ingreso_descuentos) as mesDes, 
				sum(ingreso_promedio_mesa) as mesIpm, 
				sum(ingreso_promedio_cliente) as mesIpc,
				sum(mesas_disponibles) as mesDis,
				sum(mesas_ocupadas) as mesOcu,
				sum(ventas_anuladas) as mesVan,
				sum(imptos_anulados) as mesIan,
				sum(mesas_anuladas) as mesMan,
				sum(cuentas_anuladas) as mesCan,
				sum(clientes_vendidos) as mesCve,
				sum(clientes_anulados) as mesCla,
				sum(clientes_comandas_anuladas) as mesCca
				FROM reporte_gerencia_pos 
				WHERE month(fecha_auditoria) = '$mes' AND year(fecha_auditoria) = '$anio' AND id_ambiente = '$idamb'")->fetchAll();

            return $data;
        }

        public function getVentasDiaPos($idamb, $dia)
        {
            global $database;

            $data = $database->select('reporte_gerencia_pos', [
                'ingreso_ventas',
                'ingreso_impto',
                'ingreso_propina',
                'ingreso_servicio',
                'ingreso_descuentos',
                'ingreso_promedio_mesa',
                'ingreso_promedio_cliente',
                'mesas_disponibles',
                'mesas_ocupadas',
                'ventas_anuladas',
                'imptos_anulados',
                'mesas_anuladas',
                'cuentas_anuladas',
                'clientes_vendidos',
                'clientes_anulados',
                'clientes_comandas_anuladas',
            ], [
                'fecha_auditoria' => $dia,
                'id_ambiente' => $idamb,
            ]);

            return $data;
        }

        public function ingresaDatosAuditoria($fecha, $mesasDis, $mesasVen, $mesasAnu, $comanAnu, $factVen, $netoVen, $imptVen, $propVen, $servVen, $totaVen, $clieVen, $idamb, $user, $iduser, $descVen)
        {
            global $database;
            $ingrpromes = 0;
            $ingrprocli = 0;
            $data = $database->insert('reporte_gerencia_pos', [
                'fecha_auditoria' => $fecha,
                'id_ambiente' => $idamb,
                'mesas_disponibles' => $mesasDis,
                'mesas_ocupadas' => $mesasVen,
                'mesas_anuladas' => $mesasAnu,
                'cuentas_anuladas' => $comanAnu,
                'ingreso_ventas' => $netoVen,
                'ingreso_impto' => $imptVen,
                'ingreso_propina' => $propVen,
                'ingreso_servicio' => $servVen,
                'ingreso_descuentos' => $descVen,
                'ingreso_promedio_mesa' => $ingrpromes,
                'ingreso_promedio_cliente' => round($netoVen / $clieVen, 0),
                'clientes_vendidos' => $clieVen,
                'usuario_auditoria' => $user,
                'id_usuario_auditoria' => $iduser,
                'fecha_proceso_auditoria' => date('Y-m-d H:i:s'),
            ]);

            return $database->id();
        }

        public function getMesasDisponibles($amb)
        {
            global $database;

            $data = $database->count('mesas', [
                'id',
            ], [
                'ambiente' => $amb,
            ]);

            return $data;
        }

        public function getPopularidadProductosAmbiente($estado, $idamb)
        {
            global $database;

            $data = $database->query("SELECT Sum(detalle_facturas_pos.venta) AS venta, Sum(detalle_facturas_pos.cant) AS cant, detalle_facturas_pos.nom FROM facturas_pos , detalle_facturas_pos WHERE facturas_pos.comanda = detalle_facturas_pos.comanda AND facturas_pos.ambiente = '$idamb' AND facturas_pos.estado = '$estado' GROUP BY detalle_facturas_pos.nom ORDER BY cant DESC")->fetchAll();

            return $data;
        }

        public function getPopularidadProductos($estado)
        {
            global $database;

            $data = $database->query("SELECT Sum(detalle_facturas_pos.venta) AS venta, Sum(detalle_facturas_pos.cant) AS cant, detalle_facturas_pos.nom FROM facturas_pos , detalle_facturas_pos WHERE facturas_pos.comanda = detalle_facturas_pos.comanda AND facturas_pos.ambiente = 1 AND facturas_pos.estado = '$estado' GROUP BY detalle_facturas_pos.nom ORDER BY cant DESC")->fetchAll();

            return $data;
        }

        public function nombrePago($code)
        {
            global $database;

            $data = $database->select('formas_pago', [
                'descripcion',
            ], [
                'id_pago' => $code,
            ]);

            return $data[0]['descripcion'];
        }

        public function anulaFactura($factura, $motivo, $usu, $idamb, $fecha)
        {
            global $database;

            $data = $database->update('facturas_pos', [
                'estado' => 'X',
                'usuario_anulada' => $usu,
                'motivo_anulada' => $motivo,
                'fecha_anulada' => $fecha,
                'fecha_factura' => $fecha,
            ], [
                'factura' => $factura,
                'ambiente' => $idamb,
            ]);

            return $data->rowCount();
        }

        public function mesasActivas($fecha, $amb)
        {
            global $database;

            $data = $database->count('comandas', [
                'id',
            ], [
                'fecha' => $fecha,
                'estado' => 'A',
                'ambiente' => $amb,
            ]);

            return $data;
        }

        public function getTotalGruposVendidosMes($amb, $desdefe, $hastafe)
        {
            global $database;

            $data = $database->query("SELECT secciones_pos.nombre_seccion, sum(historico_detalle_facturas_pos.venta) AS ventas, sum(historico_detalle_facturas_pos.valorimpto) AS imptos, sum(historico_detalle_facturas_pos.venta+historico_detalle_facturas_pos.valorimpto) AS total, sum(historico_detalle_facturas_pos.cant) AS cant, historico_facturas_pos.pax AS pers, ambientes.nombre FROM historico_detalle_facturas_pos , historico_facturas_pos , ambientes , secciones_pos , producto WHERE historico_facturas_pos.ambiente = ambientes.id_ambiente AND historico_facturas_pos.estado = 'A' AND ambientes.id_ambiente = '$amb' AND producto.seccion = secciones_pos.id_seccion AND historico_detalle_facturas_pos.producto_id = producto.producto_id AND historico_detalle_facturas_pos.factura = historico_facturas_pos.factura AND historico_facturas_pos.fecha BETWEEN '$desdefe' AND '$hastafe' GROUP BY ambientes.id_ambiente, secciones_pos.nombre_seccion ")->fetchAll();

            return $data;
        }

        public function getCantidadPeriodosVendidosMes($amb, $desdefe, $hastafe)
        {
            global $database;

            $data = $database->query("SELECT historico_detalle_facturas_pos.nom, Sum(historico_detalle_facturas_pos.venta) AS ventas, Sum(historico_detalle_facturas_pos.cant) AS cant, Sum(historico_facturas_pos.pax) AS pers, ambientes.nombre, periodosServicio.descripcion_periodo FROM historico_detalle_facturas_pos, historico_facturas_pos, ambientes, periodosServicio WHERE historico_facturas_pos.factura = historico_detalle_facturas_pos.factura AND historico_facturas_pos.ambiente = ambientes.id_ambiente AND historico_facturas_pos.estado = 'A' AND ambientes.id_ambiente = '$amb' AND historico_facturas_pos.fecha BETWEEN '$desdefe' AND '$hastafe' AND substr(historico_facturas_pos.fecha_factura,12,5) <= periodosServicio.hasta_hora AND substr(historico_facturas_pos.fecha_factura,12,5) >= periodosServicio.desde_hora GROUP BY ambientes.nombre ORDER BY cant DESC ")->fetchAll();

            return $data;
        }

        public function getCantidadGruposVendidosMes($amb, $desdefe, $hastafe)
        {
            global $database;

            $data = $database->query("SELECT historico_detalle_facturas_pos.nom, Sum(historico_detalle_facturas_pos.venta) AS ventas, Sum(historico_detalle_facturas_pos.cant) AS cant, Sum(historico_facturas_pos.pax) AS pers, ambientes.nombre FROM historico_detalle_facturas_pos , historico_facturas_pos , ambientes WHERE historico_facturas_pos.factura = historico_detalle_facturas_pos.factura AND historico_facturas_pos.ambiente = ambientes.id_ambiente AND historico_facturas_pos.estado = 'A' AND ambientes.id_ambiente = '$amb' AND historico_facturas_pos.fecha BETWEEN '$desdefe' AND '$hastafe' GROUP BY ambientes.nombre ORDER BY cant DESC")->fetchAll();

            return $data;
        }

        public function getTotalFormaPagoVendidosMes($amb, $desdefe, $hastafe)
        {
            global $database;

            $data = $database->query("SELECT
            formas_pago.descripcion,
            historico_facturas_pos.pax AS pers,
            ambientes.nombre,
            Count(historico_facturas_pos.factura) AS cant,
            Sum(historico_facturas_pos.valor_total) AS ventastotal,
            Sum(historico_facturas_pos.valor_neto) AS ventas,
            Sum(historico_facturas_pos.impuesto) AS imptos,
            Sum(historico_facturas_pos.propina) AS propina,
            Sum(historico_facturas_pos.descuento) AS descuento,
            Sum(historico_facturas_pos.valor_neto + historico_facturas_pos.impuesto + historico_facturas_pos.propina - historico_facturas_pos.descuento) AS total
            FROM
            historico_facturas_pos ,
            ambientes ,
            formas_pago
            WHERE
            historico_facturas_pos.ambiente = ambientes.id_ambiente AND
            historico_facturas_pos.estado = 'A' AND
            ambientes.id_ambiente = '$amb' AND
            historico_facturas_pos.forma_pago = formas_pago.id_pago AND
            historico_facturas_pos.forma_pago = formas_pago.id_pago AND
            historico_facturas_pos.fecha BETWEEN '$desdefe' AND '$hastafe' 
            GROUP BY
            formas_pago.descripcion,
            historico_facturas_pos.pax,
            ambientes.nombre
            ORDER BY
            ambientes.id_ambiente ASC,
            formas_pago.descripcion ASC
            
            ")->fetchAll();

            return $data;
        }

        public function getCantidadFormasPagoVendidosMes($amb, $desdefe, $hastafe)
        {
            global $database;

            $data = $database->query("SELECT
            formas_pago.descripcion,
            historico_facturas_pos.pax AS pers,
            ambientes.nombre,
            Count(historico_facturas_pos.factura) AS cant,
            Sum(historico_facturas_pos.valor_total) AS totalventas,
            Sum(historico_facturas_pos.valor_neto) AS ventas,
            Sum(historico_facturas_pos.impuesto) AS imptos,
            Sum(historico_facturas_pos.propina) AS propina,
            Sum(historico_facturas_pos.descuento) AS descuento,
            Sum(historico_facturas_pos.valor_neto + historico_facturas_pos.impuesto + historico_facturas_pos.propina - historico_facturas_pos.descuento) AS total 
            FROM
            historico_facturas_pos ,
            ambientes ,
            formas_pago
            WHERE
            historico_facturas_pos.ambiente = ambientes.id_ambiente AND
            historico_facturas_pos.estado = 'A' AND
            ambientes.id_ambiente = '$amb' AND
            historico_facturas_pos.forma_pago = formas_pago.id_pago AND
            historico_facturas_pos.fecha BETWEEN '$desdefe' AND '$hastafe' 
            GROUP BY
            ambientes.nombre
            ORDER BY
            ambientes.id_ambiente ASC
            ")->fetchAll();

            return $data;
        }

        public function getProcesoAuditoria()
        {
            global $database;

            $data = $database->select('auditoria', [
                'id_proceso',
                'titulo_proceso',
                'estado_proceso',
                'nombre_proceso',
                'tipo_proceso',
                'reporte',
                'modulo',
            ], [
                'modulo' => 2,
                'actived_at' => 1,
                'ORDER' => ['orden_proceso' => 'ASC'],
            ]);

            return $data;
        }

        public function cargosInterfasePOS($fecha, $subtotal, $impuesto, $codigo, $nrohabi, $descri, $impt, $idhues, $nfact, $nrores, $coma, $usuario, $idusuario)
        {
            global $database;

            $data = $database->insert('cargos_pms', [
                'fecha_cargo' => $fecha,
                'monto_cargo' => $subtotal,
                'base_impuesto' => $subtotal,
                'impuesto' => $impuesto,
                'id_codigo_cargo' => $codigo,
                'habitacion_cargo' => $nrohabi,
                'descripcion_cargo' => $descri,
                'usuario' => $usuario,
                'id_usuario' => $idusuario,
                'id_huesped' => $idhues,
                'codigo_impto' => $impt,
                'cantidad_cargo' => 1,
                'numero_factura_cargo' => $nfact,
                'informacion_cargo' => 'Cargo Interfase POS '.$_SESSION['NOMBRE_AMBIENTE'],
                'valor_cargo' => $subtotal + $impuesto,
                'folio_cargo' => 1,
                'referencia_cargo' => 'Cheque Cuenta Nro '.$nfact.' '.$_SESSION['NOMBRE_AMBIENTE'],
                'numero_reserva' => $nrores,
                'fecha_sistema_cargo' => date('Y-m-d H:i:s'),
            ]);

            return $database->id();
        }

        public function traeInfoCodigosPMS($amb)
        {
            global $database;

            $data = $database->select('ambientes', [
                'codigo_propina',
                'codigo_servicio',
                'codigo_venta',
            ], [
                'id_ambiente' => $amb,
            ]);

            return $data;
        }

        public function getDescripcionCargo($id)
        {
            global $database;

            $data = $database->select('codigos_vta', [
                'descripcion_cargo',
                'id_impto',
            ], [
                'id_cargo' => $id,
            ]);

            return $data;
        }

        public function getDatosHuespedesenCasa($rese)
        {
            global $database;

            $data = $database->select('reservas_pms', [
                '[>]huespedes' => 'id_huesped',
            ], [
                'reservas_pms.num_habitacion',
                'reservas_pms.num_reserva',
                'huespedes.id_huesped',
                'huespedes.nombre1',
                'huespedes.nombre2',
                'huespedes.apellido1',
                'huespedes.apellido2',
                'huespedes.id_huesped',
            ], [
                'reservas_pms.num_reserva' => $rese,
                'reservas_pms.estado' => 'CA',
                'ORDER' => 'reservas_pms.num_habitacion',
            ]);

            return $data;
        }

        public function datosCliente($id)
        {
            global $database;

            $data = $database->select('clientes', [
                'apellido1',
                'apellido2',
                'nombre1',
                'nombre2',
                'identificacion',
            ], [
                'id_cliente' => $id,
            ]);

            return $data;
        }

        public function nombreUsuario($id)
        {
            global $database;

            $data = $database->select('usuarios', [
                'usuario',
            ], [
                'usuario_id' => $id,
            ]);

            return $data[0]['usuario'];
        }

        public function getTypeCia($tipo)
        {
            global $database;

            $data = $database->select('tipo_cia', [
                'descripcion',
            ], [
                'id_tipo_cia' => $tipo,
            ]);

            return $data[0]['descripcion'];
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
            if (count($data) == 0) {
                return '';
            } else {
                return $data[0]['municipio'].' - '.$data[0]['depto'];
            }
        }

        public function getLandName($tipo)
        {
            global $database;

            $data = $database->select('paices', [
                'descripcion',
            ], [
                'id_pais' => $tipo,
            ]);
            if (count($data) == 0) {
                return '';
            } else {
                return $data[0]['descripcion'];
            }
        }

        public function anulaComanda($comanda, $motivo, $usu, $user, $idamb, $fecha)
        {
            global $database;

            $data = $database->update('comandas', [
                'estado' => 'X',
                'id_usuario_anula' => $usu,
                'usuario_anula' => $user,
                'motivo_anulada' => $motivo,
                'fecha_anulada' => $fecha,
            ], [
                'comanda' => $comanda,
                'ambiente' => $idamb,
            ]);

            return $data->rowCount();
        }

        public function actualizaInterfase($codigo, $propina, $servicio, $id)
        {
            global $database;

            $data = $database->update('ambientes', [
                'codigo_venta' => $codigo,
                'codigo_propina' => $propina,
                'codigo_servicio' => $servicio,
            ], [
                'id_ambiente' => $id,
            ]);
        }

        public function getCodigosVentas($tipo)
        {
            global $database;

            $data = $database->select('codigos_vta', [
                'id_cargo',
                'descripcion_cargo',
            ], [
                'tipo_codigo' => $tipo,
                'ORDER' => 'descripcion_cargo',
            ]);

            return $data;
        }

        public function getKardex($id)
        {
            global $database;

            $data = $database->select('movimientos_inventario', [
            ], [
                'estado' => 1,
                'id_bodega' => $id,
            ]);

            return $data;
        }

        public function getHuespedesenCasa()
        {
            global $database;

            $data = $database->select('reservas_pms', [
                '[>]huespedes' => 'id_huesped',
            ], [
                'reservas_pms.id',
                'reservas_pms.cantidad',
                'reservas_pms.fecha_llegada',
                'reservas_pms.fecha_salida',
                'reservas_pms.dias_reservados',
                'reservas_pms.tipo_reserva',
                'reservas_pms.tipo_habitacion',
                'reservas_pms.num_habitacion',
                'reservas_pms.num_reserva',
                'reservas_pms.can_hombres',
                'reservas_pms.can_mujeres',
                'reservas_pms.can_ninos',
                'reservas_pms.id_compania',
                'reservas_pms.tipo_ocupacion',
                'reservas_pms.tarifa',
                'reservas_pms.valor_reserva',
                'reservas_pms.valor_diario',
                'reservas_pms.estado',
                'reservas_pms.salida_checkout',
                'reservas_pms.observaciones',
                'reservas_pms.causar_impuesto',
                'huespedes.nombre_completo',
                'huespedes.id_huesped',
            ], [
                'reservas_pms.tipo_reserva' => 2,
                'reservas_pms.estado' => 'CA',
                'ORDER' => 'reservas_pms.num_habitacion',
            ]);

            return $data;
        }

        public function getDetalleFormasdePagoCajero($estado, $usu, $amb)
        {
            global $database;

            $data = $database->query("SELECT Sum(facturas_pos.valor_total) AS total, Sum(facturas_pos.pagado) AS pagado, Sum(facturas_pos.cambio) AS cambio, count(facturas_pos.forma_pago) as cant, Sum(facturas_pos.valor_neto) AS neto, Sum(facturas_pos.impuesto) AS impto, Sum(facturas_pos.propina) AS prop, Sum(facturas_pos.servicio) AS `servicio`, formas_pago.id_pago, formas_pago.descripcion, ambientes.nombre FROM facturas_pos , formas_pago , ambientes WHERE facturas_pos.estado = '$estado' AND facturas_pos.forma_pago = formas_pago.id_pago AND facturas_pos.usuario_factura = '$usu' AND facturas_pos.ambiente = ambientes.id_ambiente AND facturas_pos.ambiente = $amb GROUP BY facturas_pos.forma_pago, ambientes.nombre")->fetchAll();

            return $data;
        }

        public function getDetalleFormasdePagoAmbiente($estado, $idamb)
        {
            global $database;

            $data = $database->query("SELECT Sum(facturas_pos.valor_total) AS total, Sum(facturas_pos.pagado) AS pagado, Sum(facturas_pos.cambio) AS cambio, facturas_pos.id, count(facturas_pos.forma_pago) as cant, Sum(facturas_pos.valor_neto) AS neto, Sum(facturas_pos.impuesto) AS impto, Sum(facturas_pos.propina) AS prop, Sum(facturas_pos.servicio) AS `servicio`, formas_pago.descripcion, ambientes.nombre FROM facturas_pos , formas_pago , ambientes WHERE facturas_pos.estado = '$estado' AND facturas_pos.forma_pago = formas_pago.id_pago AND facturas_pos.ambiente = '$idamb' AND facturas_pos.ambiente = ambientes.id_ambiente GROUP BY facturas_pos.forma_pago, ambientes.nombre")->fetchAll();

            return $data;
        }

        public function getDetalleFormasdePago($estado)
        {
            global $database;

            $data = $database->query("SELECT Sum(facturas_pos.valor_total) AS total, facturas_pos.id, count(facturas_pos.forma_pago) as cant, Sum(facturas_pos.valor_neto) AS neto, Sum(facturas_pos.impuesto) AS impto, Sum(facturas_pos.propina) AS prop, Sum(facturas_pos.descuento) AS `desc`, formas_pago.descripcion, ambientes.nombre FROM facturas_pos , formas_pago , ambientes WHERE facturas_pos.estado = '$estado' AND facturas_pos.forma_pago = formas_pago.id_pago AND facturas_pos.ambiente = ambientes.id_ambiente GROUP BY facturas_pos.forma_pago, ambientes.nombre")->fetchAll();

            return $data;
        }

        public function getDetalleFormasdePagoAnuladasCajero($estado, $usu, $amb)
        {
            global $database;

            $data = $database->query("SELECT Sum(facturas_pos.valor_total) AS total, Sum(facturas_pos.pagado) AS pagado, Sum(facturas_pos.cambio) AS cambio, facturas_pos.id, count(facturas_pos.forma_pago) as cant, Sum(facturas_pos.valor_neto) AS neto, Sum(facturas_pos.impuesto) AS impto, Sum(facturas_pos.propina) AS prop, Sum(facturas_pos.servicio) AS `servicio`, formas_pago.descripcion, ambientes.nombre FROM facturas_pos , formas_pago , ambientes WHERE facturas_pos.estado = '$estado' AND facturas_pos.forma_pago = formas_pago.id_pago AND facturas_pos.usuario_anulada = '$usu' AND facturas_pos.ambiente = ambientes.id_ambiente AND facturas_pos.ambiente = $amb GROUP BY facturas_pos.forma_pago, ambientes.nombre")->fetchAll();

            return $data;
        }

        public function getDetalleFormasdePagoAnuladasAmbiente($estado, $idamb)
        {
            global $database;

            $data = $database->query("SELECT Sum(facturas_pos.valor_total) AS total, facturas_pos.id, count(facturas_pos.forma_pago) as cant, Sum(facturas_pos.valor_neto) AS neto, Sum(facturas_pos.impuesto) AS impto, Sum(facturas_pos.propina) AS prop, Sum(facturas_pos.descuento) AS `desc`, formas_pago.descripcion, ambientes.nombre FROM facturas_pos , formas_pago , ambientes WHERE facturas_pos.estado = '$estado' AND facturas_pos.forma_pago = formas_pago.id_pago AND facturas_pos.ambiente = '$idamb' AND facturas_pos.ambiente = ambientes.id_ambiente GROUP BY facturas_pos.forma_pago, ambientes.nombre")->fetchAll();

            return $data;
        }

        public function getDetalleFacturaCajeroDia($estado, $usu, $idamb)
        {
            global $database;

            $data = $database->query("SELECT facturas_pos.*, ambientes.nombre  FROM facturas_pos, ambientes WHERE estado = '$estado' AND facturas_pos.ambiente = ambientes.id_ambiente AND facturas_pos.usuario_factura = '$usu' AND facturas_pos.ambiente = '$idamb' ORDER BY ambiente, factura")->fetchAll();

            return $data;
        }

        public function getDetalleFacturaDiaAmbiente($estado, $idamb)
        {
            global $database;

            $data = $database->query("SELECT facturas_pos.*, ambientes.nombre from facturas_pos, ambientes where estado = '$estado' and facturas_pos.id_ambiente = '$idamb' and facturas_pos.ambiente = ambientes.id_ambiente order by ambiente, factura")->fetchAll();

            return $data;
        }

        public function getDetalleFacturaDia($estado)
        {
            global $database;

            $data = $database->query("SELECT facturas_pos.*, ambientes.nombre  from facturas_pos, ambientes where estado = '$estado' and facturas_pos.ambiente = ambientes.id_ambiente order by ambiente, factura")->fetchAll();

            return $data;
        }

        public function getDetalleFacturaAnuladaCajeroDia($estado, $usu, $amb)
        {
            global $database;

            $data = $database->query("SELECT facturas_pos.*, ambientes.nombre  FROM facturas_pos, ambientes WHERE estado = '$estado' AND facturas_pos.ambiente = ambientes.id_ambiente AND facturas_pos.usuario_anulada = '$usu' AND facturas_pos.ambiente = $amb ORDER BY ambiente, factura")->fetchAll();

            return $data;
        }

        public function getDetalleFacturaAnuladaDiaAmbiente($estado, $idamb)
        {
            global $database;

            $data = $database->query("SELECT facturas_pos.*, ambientes.nombre  from facturas_pos, ambientes where estado = '$estado' and facturas_pos.ambiente = '$idamb' and facturas_pos.ambiente = ambientes.id_ambiente order by ambiente, factura")->fetchAll();

            return $data;
        }

        public function getFacturasDiaAmbiente($estado, $idamb)
        {
            global $database;

            $data = $database->query("SELECT count(facturas_pos.factura) as facturas, sum(facturas_pos.pax) as pax, sum(facturas_pos.valor_total) as total, sum(facturas_pos.valor_neto) as neto, sum(facturas_pos.impuesto) as impto, sum(facturas_pos.propina) as propina, sum(facturas_pos.servicio) as servicio, sum(facturas_pos.descuento) as descuento, sum(facturas_pos.pagado) as pago, sum(facturas_pos.abonos) as abono, ambientes.nombre from facturas_pos, ambientes where estado = '$estado' and facturas_pos.ambiente = '$idamb' and facturas_pos.ambiente = ambientes.id_ambiente group by ambiente")->fetchAll();

            return $data;
        }

        public function getFacturasDia($estado)
        {
            global $database;

            $data = $database->query("SELECT count(facturas_pos.factura) as facturas, sum(valor_total) as total, ambientes.nombre  from facturas_pos, ambientes where estado = '$estado' and facturas_pos.ambiente = ambientes.id_ambiente group by ambiente")->fetchAll();

            return $data;
        }

        public function eliminaProducto($id)
        {
            global $database;

            $data = $database->update('producto', [
                'deleted_at' => date('Y-m-d H:i:s'),
            ], [
                'producto_id' => $id,
            ]);

            return $data->rowCount();
        }

        /* public function adicionaProducto($producto, $seccion, $venta, $impto, $tipo, $receta, $ambi) */

        public function adicionaProducto($producto, $codigo, $seccion, $venta, $impto, $tipo, $receta, $idamb)
        {
            global $database;

            $data = $database->insert('producto', [
                'nom' => $producto,
                'venta' => $venta,
                'impto' => $impto,
                            'cod' => $codigo,
                'seccion' => $seccion,
                'estado' => 1,
                'active_at' => 1,
                'tipo_producto' => $tipo,
                'id_receta' => $receta,
                'ambiente' => $idamb,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            return $database->id();
        }

        public function getImpuestos()
        {
            global $database;

            $data = $database->select('codigos_vta', [
                'id_cargo',
                'descripcion_cargo',
            ], [
                'tipo_codigo' => 2,
                'ORDER' => 'descripcion_cargo',
            ]);

            return $data;
        }

        public function getTipoPlatos($idamb)
        {
            global $database;

            $data = $database->select('secciones_pos', [
                'id_seccion',
                'nombre_seccion',
            ], [
                'estado_seccion' => 1,
                'id_ambiente' => $idamb,
                'deleted_at' => null,
                'ORDER' => ['nombre_seccion' => 'ASC'],
            ]);

            return $data;
        }

        public function getProductos($id)
        {
            global $database;

            $data = $database->select('producto', [
                '[<]codigos_vta' => ['impto' => 'id_cargo'],
                '[<]secciones_pos' => ['seccion' => 'id_seccion'],
            ], [
                'codigos_vta.descripcion_cargo',
                'secciones_pos.nombre_seccion',
                'producto.producto_id',
                'producto.id_receta',
                'producto.cod',
                'producto.nom',
                'producto.venta',
                'producto.impto',
                'producto.seccion',
                'producto.estado',
                'producto.tipo_producto',
                'producto.ambiente',
                'producto.active_at',
            ], [
                'producto.ambiente' => $id,
                'producto.deleted_at' => null,
                'secciones_pos.deleted_at' => null,
                'secciones_pos.estado_seccion' => 1,
                'ORDER' => [
                    'producto.nom' => 'ASC',
                ],
            ]);

            return $data;
        }

        public function adicionaCliente($nombre1, $nombre2, $apellido1, $apellido2, $identificacion, $direccion, $telefono, $celular, $correo, $estado, $tipodoc, $idusr, $empleado)
        {
            global $database;

            $data = $database->insert('clientes', [
                'identificacion' => $identificacion,
                'apellido1' => $apellido1,
                'apellido2' => $apellido2,
                'nombre1' => $nombre1,
                'nombre2' => $nombre2,
                'direccion' => $direccion,
                'telefono' => $telefono,
                'celular' => $celular,
                'email' => $correo,
                'id_tipo_doc' => $tipodoc,
                'id_usuario' => $idusr,
                'empleado' => $empleado,
                'created_at' => date('Y-m-d H:i:s'),
                'estado' => $estado,
            ]);

            return $database->id();
        }

        public function updateDescuentoProducto($id, $valor, $porce, $valimpto)
        {
            global $database;

            $data = $database->update('ventas_dia_pos', [
                'descuento' => $valor,
                'por_desc' => $porce,
                'valorimpto' => $valimpto,
            ], [
                'id' => $id,
            ]);

            return $data->rowCount();
        }

        public function updateValorComanda($comanda, $amb, $subtotal, $imptos, $total)
        {
            global $database;

            $data = $database->update('comandas', [
                'impuesto' => $imptos,
                'subtotal' => $subtotal,
                'total' => $total,
            ], [
                'comanda' => $comanda,
                'ambiente' => $amb,
            ]);

            return $data->rowCount();
        }

        public function updateDescuentos($coma, $ambi, $desc, $tipo, $porce, $valor, $moti, $idusr)
        {
            global $database;

            $data = $database->update('comandas', [
                'id_descuento' => $desc,
                'porcentaje_descuento' => $porce,
                'valor_descuento' => $valor,
                'tipo_descuento' => $tipo,
                'motivo_descuento' => $moti,
                'id_usuario_descuento' => $idusr,
                'fecha_descuento' => date('Y-m-d H:i:s'),
            ], [
                'comanda' => $coma,
                'ambiente' => $ambi,
            ]);

            return $data->rowCount();
        }

        public function getMontoDescuento($amb, $dia, $iddes)
        {
            global $database;

            $data = $database->select('descuentos_pos', [
                'valor',
                'porcentaje',
            ], [
                'actived_at' => 1,
                'id_ambiente' => $amb,
                'id_descuento' => $iddes,
            ]);

            return $data;
        }

        public function eliminaCliente($id)
        {
            global $database;

            $data = $database->update('clientes', [
                'deleted_at' => date('Y-m-d H:i:s'),
            ], [
                'id_cliente' => $id,
            ]);

            return $data->rowCount();
        }

        public function getClientes()
        {
            global $database;

            $data = $database->select('clientes', [
                'id_cliente',
                'identificacion',
                'apellido1',
                'apellido2',
                'nombre1',
                'nombre2',
                'direccion',
                'telefono',
                'email',
                'celular',
                'estado',
            ], [
                'deleted_at' => null,
                'ORDER' => ['apellido1' => 'ASC'],
            ]);

            return $data;
        }

        public function getFormasdePago()
        {
            global $database;

            $data = $database->select('formas_pago', [
                'id_pago',
                'codigo',
                'descripcion',
                'cuenta_puc',
                'pms',
            ], [
                'ORDER' => ['descripcion' => 'ASC'],
            ]);

            return $data;
        }

        public function getInfoAmbiente($code)
        {
            global $database;

            $data = $database->select('ambientes', [
                'codigo',
                'nombre',
                'prefijo',
                'id_bodega',
                'servicio',
                'propina',
                'texto_propina',
                'texto_servicio',
                'impuesto',
                'logo',
            ], [
                'id_ambiente' => $code,
            ]);

            return $data;
        }

        public function getProductosComandaVenta($coma, $idamb)
        {
            global $database;

            $data = $database->select('ventas_dia_pos', [
                'id',
                'nom',
                'cant',
                'venta',
                'producto_id',
                'valorimpto',
                'impto',
                'importe',
                'descuento',
                'por_desc',
            ], [
                'comanda' => $coma,
                'ambiente' => $idamb,
                'estado' => 0,
            ]);

            return $data;
        }

        public function getVentasdelDia($amb)
        {
            global $database;

            $data = $database->select('facturas_pos', [
                '[>]formas_pago' => ['forma_pago' => 'id_pago'],
            ], [
                'facturas_pos.id',
                'facturas_pos.factura',
                'facturas_pos.comanda',
                'facturas_pos.mesa',
                'facturas_pos.pax',
                'facturas_pos.valor_total',
                'facturas_pos.valor_neto',
                'facturas_pos.pagado',
                'facturas_pos.cambio',
                'facturas_pos.impuesto',
                'facturas_pos.propina',
                'facturas_pos.servicio',
                'facturas_pos.pagado',
                'facturas_pos.cambio',
                'facturas_pos.fecha',
                'facturas_pos.fecha_factura',
                'facturas_pos.usuario_factura',
                'facturas_pos.estado',
                'facturas_pos.pms',
                'facturas_pos.forma_pago',
                'facturas_pos.usuario',
                'facturas_pos.num_movimiento_inv',
                'formas_pago.descripcion',
            ], [
                'facturas_pos.ambiente' => $amb,
                'ORDER' => [
                    'facturas_pos.pms' => 'ASC',
                    'facturas_pos.factura' => 'ASC',
                ],
            ]);

            return $data;
        }

        public function getVentasdelDiaUsuario($amb, $user)
        {
            global $database;

            $data = $database->select('facturas_pos', [
                '[>]formas_pago' => ['forma_pago' => 'id_pago'],
            ], [
                'facturas_pos.id',
                'facturas_pos.factura',
                'facturas_pos.comanda',
                'facturas_pos.mesa',
                'facturas_pos.pax',
                'facturas_pos.usuario_factura',
                'facturas_pos.fecha',
                'facturas_pos.fecha_factura',
                'facturas_pos.valor_total',
                'facturas_pos.valor_neto',
                'facturas_pos.impuesto',
                'facturas_pos.propina',
                'facturas_pos.descuento',
                'facturas_pos.estado',
                'facturas_pos.pms',
                'facturas_pos.forma_pago',
                'facturas_pos.usuario',
                'formas_pago.descripcion',
            ], [
                'facturas_pos.ambiente' => $amb,
                'facturas_pos.usuario_factura' => $user,
            ]);

            return $data;
        }

        public function getProductosVendidosOrden($amb, $coma)
        {
            global $database;

            $data = $database->select('detalle_facturas_pos', [
                'nom',
                'venta',
                'cant',
                'valorimpto',
                'descuento',
                'importe',
            ], [
                'ambiente' => $amb,
                'comanda' => $coma,
            ]);

            return $data;
        }

        public function getProductosVendidosFactura($amb, $coma)
        {
            global $database;

            $data = $database->select('detalle_facturas_pos', [
                'nom',
                'venta',
                'cant',
                'valorimpto',
                'descuento',
                'importe',
            ], [
                'ambiente' => $amb,
                'comanda' => $coma,
                'ORDER' => ['nom' => 'ASC'],
            ]);

            return $data;
        }

        public function getDatosFactura($amb, $comanda)
        {
            global $database;

            $data = $database->select('facturas_pos', [
                'mesa',
                'pax',
                'comanda',
                'valor_total',
                'forma_pago',
                'factura',
                'valor_neto',
                'impuesto',
                'propina',
                'descuento',
                'pagado',
                'cambio',
                'fecha',
                'fecha_factura',
                'usuario_factura',
                'id_cliente',
                'pms',
                'estado',
                'nro_reserva_pms',
            ], [
                'ambiente' => $amb,
                'comanda' => $comanda,
            ]);

            return $data;
        }

        public function prefijoResolucion($amb)
        {
            global $database;

            $data = $database->select('resoluciones', [
                'prefijo',
            ], [
                'id_ambiente' => $amb,
                'estado' => 1,
            ]);

            return $data[0]['prefijo'];
        }

        public function getResolucionFacturacion($amb)
        {
            global $database;

            $data = $database->select('resoluciones', [
                'resolucion',
                'fecha',
                'prefijo',
                'desde',
                'hasta',
                'tipo',
            ], [
                'id_ambiente' => $amb,
                'estado' => 1,
            ]);

            return $data;
        }

        public function getPosInfo()
        {
            global $database;

            $data = $database->select('parametros_pos', [
                'fecha_auditoria',
            ]);

            return $data;
        }

        public function insertFacturaVentaPOS($nFactura, $com, $ambiente, $mesa, $pax, $usuario, $total, $subtotal, $impuesto, $propina, $descuento, $pagado, $cambio, $fecha, $pms, $estado, $fpago, $cliente, $motivoDes, $servicio)
        {
            global $database;

            $data = $database->insert('facturas_pos', [
                'factura' => $nFactura,
                'comanda' => $com,
                'ambiente' => $ambiente,
                'mesa' => $mesa,
                'pax' => $pax,
                'usuario' => $usuario,
                'valor_total' => $total,
                'valor_neto' => $subtotal,
                'impuesto' => $impuesto,
                'propina' => $propina,
                'descuento' => $descuento,
                'pagado' => $pagado,
                'cambio' => $cambio,
                'fecha' => $fecha,
                'fecha_factura' => date('Y-m-d H:i:s'),
                'usuario_factura' => $usuario,
                'motivo_descuento' => $motivoDes,
                'pms' => $pms,
                'estado' => $estado,
                'forma_pago' => $fpago,
                'id_cliente' => $cliente,
                'servicio' => $servicio,
            ]);

            return $database->id();
        }

        public function updateFacturaComanda($factura, $estado, $usuario, $fecha, $com, $ambiente)
        {
            global $database;

            $data = $database->update('comandas', [
                'estado' => $estado,
                'factura' => $factura,
                'usuario_factura' => $usuario,
                'fecha_factura' => $fecha,
            ], [
                'comanda' => $com,
                'ambiente' => $ambiente,
            ]);

            return $data->rowCount();
        }

        public function updateMesaPos($amb, $mesa)
        {
            global $database;

            $data = $database->update('mesas', [
                'estado' => 'L',
            ], [
                'ambiente' => $amb,
                'numero_mesa' => $mesa,
            ]);

            return $data->rowCount();
        }

        public function insertProductoVentas($iamb, $inom, $iven, $ican, $iimp, $idpr, $vimp, $valimp, $numero, $usuario, $com, $vdes, $vpor, $pms)
        {
            global $database;

            if ($pms == 0) {
                $numfac = $numero;
                $numord = 0;
            } else {
                $numfac = 0;
                $numord = $numero;
            }

            $data = $database->insert('detalle_facturas_pos', [
                'producto_id' => $idpr,
                'nom' => $inom,
                'venta' => $iven,
                'cant' => $ican,
                'importe' => $iimp,
                'usu' => $usuario,
                'ambiente' => $iamb,
                'comanda' => $com,
                'factura' => $numfac,
                'descuento' => $vdes,
                'por_desc' => $vpor,
                'orden' => $numord,
                'impto' => $vimp,
                'created_at' => date('Y-m-d H:i:s'),
                'valorimpto' => $valimp,
                'pms' => $pms,
            ]);

            return $database->id();
        }
 
        public function getProductosVentaComanda($comanda, $ambiente)
        {
            global $database;

            $data = $database->select('ventas_dia_pos', [
                'producto_id',
                'cod',
                'nom',
                'venta',
                'cant',
                'importe',
                'usu',
                'ambiente',
                'comanda',
                'descuento',
                'por_desc',
                'impto',
                'valorimpto',
            ], [
                'ambiente' => $ambiente,
                'comanda' => $comanda,
                'estado' => 0,
            ]);

            return $data;
        }

        /* Actualiza Numero de la Orden [Interface con PMS] */
        public function updateNumeroOrden($amb, $nro)
        {
            global $database;

            $data = $database->update('ambientes', [
                'conc_orden' => $nro,
            ], [
                'id_ambiente' => $amb,
            ]);

            return $data->rowCount();
        }

        /* Actualiza Numero de la factura */
        public function updateNumeroFactura($amb, $nro)
        {
            global $database;

            $data = $database->update('ambientes', [
                'conc_factura' => $nro,
            ], [
                'id_ambiente' => $amb,
            ]);

            return $data->rowCount();
        }

        /* Devuelve Numero de Factura Actual */
        public function getNumeroFactura($amb)
        {
            global $database;

            $data = $database->select('ambientes', [
                'conc_factura',
                'conc_orden',
            ], [
                'id_ambiente' => $amb,
            ]);

            return $data;
        }

        public function getDatosComandaXX($comanda, $ambiente)
        {
            global $database;

            $data = $database->select('comandas', [
                'pax',
                'mesa',
                'fecha',
                'propina',
            ], [
                'comanda' => $comanda,
                'ambiente' => $ambiente,
            ]);

            return $data;
        }

        public function getDatosComanda($comanda, $ambiente)
        {
            global $database;

            $data = $database->select('comandas', [
                'pax',
                'mesa',
                'fecha',
                'propina',
                'cliente',
                'motivo_descuento',
                'abonos',
            ], [
                'comanda' => $comanda,
                'ambiente' => $ambiente,
            ]);

            return $data;
        }

        public function getComandaPOS($ambiente)
        {
            global $database;

            $data = $database->select('ambientes', [
                'conc_comanda',
            ], [
                'id_ambiente' => $ambiente,
            ]);

            return $data[0]['conc_comanda'];
        }

        public function getProductosVendidos($usuario, $ambiente)
        {
            global $database;

            $data = $database->count('caja_tmp', [
                'producto_id',
            ], [
                'usu' => $usuario,
                'ambiente' => $ambiente,
            ]);

            return $data;
        }

        public function getHuespedesAlojadosPOS()
        {
            global $database;

            $data = $database->select('reservas_pms', [
                '[>]huespedes' => 'id_huesped',
            ], [
                'reservas_pms.cantidad',
                'reservas_pms.dias_reservados',
                'reservas_pms.fecha_llegada',
                'reservas_pms.fecha_salida',
                'reservas_pms.tipo_habitacion',
                'reservas_pms.id',

                'reservas_pms.num_habitacion',
                'reservas_pms.num_reserva',
                /*
                'reservas_pms.can_hombres',
                'reservas_pms.can_mujeres',
                'reservas_pms.can_ninos',
                'reservas_pms.id_compania',
                'reservas_pms.tipo_ocupacion',
                'reservas_pms.tarifa',
                'reservas_pms.valor_reserva',
                'reservas_pms.valor_diario',
                'reservas_pms.estado',
                'reservas_pms.observaciones',
                */
                'huespedes.nombre_completo',
                'huespedes.nombre1',
                'huespedes.nombre2',
                'huespedes.apellido1',
                'huespedes.apellido2',
                'huespedes.id_huesped',
            ], [
                'reservas_pms.tipo_reserva' => 2,
                'reservas_pms.estado' => 'CA',
                'ORDER' => 'reservas_pms.num_habitacion',
            ]);

            return $data;
        }

        public function getPagoPMS($fpago)
        {
            global $database;

            $data = $database->select('formas_pago', [
                'pms',
            ], [
                'id_pago' => $fpago,
            ]);

            return $data[0]['pms'];
        }

        public function getAmbienteSeleccionado($ambiente)
        {
            global $database;

            $data = $database->select('ambientes', [
                'codigo',
                'id_ambiente',
                'id_centrocosto',
                'nombre',
                'prefijo',
                'servicio',
                'propina',
                'propina_incluida',
                'impuesto',
                'id_bodega',
                'codigo_venta',
                'codigo_propina',
                'codigo_servicio',
                'fecha_auditoria',
                'encuesta',
                'plano',
                'logo',
            ], [
                'id_ambiente' => $ambiente,
            ]);

            return $data;
        }

        public function getComandasAmbiente($ambiente)
        {
            global $database;

            $data = $database->count('comandas', [
                'mesa',
            ], [
                'ambiente' => $ambiente,
                'estado' => 'A',
            ]);

            return $data;
        }

        public function getComandaGuardada($comanda, $amb)
        {
            global $database;

            $data = $database->select('ventas_dia_pos', [
                'producto_id',
                'cod',
                'nom',
                'venta',
                'cant',
                'importe',
                'usu',
                'ambiente',
                'comanda',
                'descuento',
                'por_desc',
                'impto',
                'valorimpto',
            ], [
                'comanda' => $comanda,
                'ambiente' => $amb,
            ]);

            return $data;
        }

        public function getComandasActivasCajero($amb, $est, $usu)
        {
            global $database;

            $data = $database->select('comandas', [
                'id',
                'fecha',
                'fecha_comanda',
                'comanda',
                'ambiente',
                'mesa',
                'pax',
                'usuario',
                'factura',
                'usuario_anula',
                'motivo_anulada',
                'fecha_anulada',
            ], [
                'usuario' => $usu,
                'ambiente' => $amb,
                'estado' => $est,
            ]);

            return $data;
        }

        public function getComandasAnuladasCajero($amb, $est, $usu)
        {
            global $database;

            $data = $database->select('comandas', [
                'id',
                'fecha',
                'comanda',
                'ambiente',
                'mesa',
                'pax',
                'usuario',
                'factura',
                'id_usuario_anula',
                'motivo_anulada',
                'fecha_anulada',
                'fecha_comanda_anulada',
            ], [
                'id_usuario_anula' => $usu,
                'ambiente' => $amb,
                'estado' => $est,
            ]);

            return $data;
        }

        public function getComandaResumen($amb, $comanda)
        {
            global $database;

            $data = $database->select('comandas', [
                'id',
                'fecha',
                'fecha_comanda',
                'comanda',
                'ambiente',
                'mesa',
                'pax',
                'usuario',
                'factura',
                'propina',
                'valor_descuento',
                'subtotal',
                'impuesto',
                'total',
                'id_usuario_anula',
                'usuario_anula',
                'motivo_anulada',
                'fecha_anulada',
                'fecha_comanda_anulada',
            ], [
                'ambiente' => $amb,
                'comanda' => $comanda,
            ]);

            return $data;
        }

        public function getComandasActivas($amb, $est)
        {
            global $database;

            $data = $database->select('comandas', [
                'id',
                'fecha',
                'fecha_comanda',
                'comanda',
                'ambiente',
                'mesa',
                'pax',
                'usuario',
                'factura',
                'propina',
                'subtotal',
                'impuesto',
                'total',
                'id_usuario_anula',
                'usuario_anula',
                'motivo_anulada',
                'fecha_anulada',
                'fecha_comanda_anulada',
            ], [
                'ambiente' => $amb,
                'estado' => $est,
            ]);

            return $data;
        }

        /* Actualiza el Estado de las Mesas */
        public function actualizaEstadoMesa($mesa, $amb, $estado)
        {
            global $database;

            $data = $database->update('mesas', [
                'estado' => $estado,
            ], [
                'numero_mesa' => $mesa,
                'ambiente' => $amb,
            ]);

            return $data->rowCount();
        }

        /* Ingesa Nuevas Comandas */
        public function ingresoNuevaComanda($nrocomanda, $amb, $mesa, $pax, $usu, $fecha, $estado)
        {
            global $database;

            $data = $database->insert('comandas', [
                'comanda' => $nrocomanda,
                'ambiente' => $amb,
                'mesa' => $mesa,
                'pax' => $pax,
                'usuario' => $usu,
                'fecha' => $fecha,
                'fecha_comanda' => date('Y-m-d H:i:s'),
                'estado' => $estado,
            ]);

            return $database->id();
        }

        /* listado Productos Comanda Actual */
        public function ingresoProductosComanda($amb, $usu, $nom, $venta, $cant, $importe, $producto_id, $nrocomanda, $impto, $valorimpto)
        {
            global $database;

            $data = $database->insert('ventas_dia_pos', [
                'producto_id' => $producto_id,
                'nom' => $nom,
                'venta' => $venta,
                'cant' => $cant,
                'importe' => $importe,
                'usu' => $usu,
                'ambiente' => $amb,
                'comanda' => $nrocomanda,
                'impto' => $impto,
                'valorimpto' => $valorimpto,
            ]);

            return $database->id();
        }

        /* Actualiza Numero de la Comanda */
        public function updateNumeroComanda($amb, $nro)
        {
            global $database;

            $data = $database->update('ambientes', [
                'conc_comanda' => $nro,
            ], [
                'id_ambiente' => $amb,
            ]);

            return $data->rowCount();
        }

        /* Devuelve Numero de Comanda Actual */
        public function getNumeroComanda($amb)
        {
            global $database;

            $data = $database->select('ambientes', [
                'conc_comanda',
            ], [
                'id_ambiente' => $amb,
            ]);

            return $data[0]['conc_comanda'];
        }

        /* Productos en la Comanda */
        public function getProductosComanda($xusu, $amb)
        {
            global $database;

            $data = $database->count('caja_tmp', [
                'cant',
            ], [
                'usu' => $xusu,
                'ambiente' => $amb,
            ]);

            return $data;
        }

        /* Eliminar Producto de la Comanda */
        public function EliminaComanda($xusu, $amb)
        {
            global $database;
            $data = $database->delete('caja_tmp', [
                'AND' => [
                    'usu' => $xusu,
                    'ambiente' => $amb,
                ],
            ]);

            return $data->rowCount();
        }

        /* Eliminar Producto de la Comanda */
        public function ElminaProductoComanda($codigo, $xusu, $amb)
        {
            global $database;
            $data = $database->delete('caja_tmp', [
                'AND' => [
                    'producto_id' => $codigo,
                    'usu' => $xusu,
                    'ambiente' => $amb,
                ],
            ]);

            return $data;
        }

        /* Actualiza Resta Cantidad de Productos en la Comanda */
        public function actualizaRestaProductosVenta($codigo, $xusu, $amb, $subtot, $subimpt)
        {
            global $database;
            $data = $database->query("UPDATE caja_tmp SET cant = cant -1, venta = venta - '$subtot', valorimpto = valorimpto - '$subimpt' WHERE producto_id='$codigo' and usu = '$xusu'  and ambiente = '$amb'")->fetchAll();
        }

        /* Cantidad de Productos en la Comanda */
        public function getCantidadProductosComanda($codigo, $xusu, $amb)
        {
            global $database;

            $data = $database->select('caja_tmp', [
                'cant',
            ], [
                'producto_id' => $codigo,
                'usu' => $xusu,
                'ambiente' => $amb,
            ]);

            return $data[0]['cant'];
        }

        /* Actualiza Suma Cantidad de Productos en la Comanda */
        public function actualizaSumaProductosVenta($codigo, $xusu, $amb, $subtot, $subimpt)
        {
            global $database;
            $data = $database->query("UPDATE caja_tmp SET cant = cant +1, venta = venta + '$subtot', valorimpto = valorimpto + '$subimpt' WHERE producto_id='$codigo' and usu = '$xusu'  and ambiente = '$amb'")->fetchAll();
        }

        /* Adiciona Productos a la Comanda */
        public function adicionaProductosComanda($codi, $nom, $venta, $canti, $existencia, $xusu, $amb, $impto, $impt, $idprod, $parinve)
        {
            global $database;

            if ($parinve == 1) {
            } else {
            }
            $data = $database->insert('caja_tmp', [
                'cod' => $codi,
                'nom' => $nom,
                'venta' => $venta,
                'cant' => $canti,
                'importe' => $venta,
                'existencia' => $existencia,
                'usu' => $xusu,
                'ambiente' => $amb,
                'valorimpto' => $impt,
                'impto' => $impto,
                'producto_id' => $idprod,
            ]);

            return $database->id();
        }

        /* Busca Productos vendidos en la Coamnda Actual */
        public function buscaProductoVenta($codigo, $xusu, $amb)
        {
            global $database;

            $data = $database->count('caja_tmp', [
                'producto_id',
            ], [
                'producto_id' => $codigo,
                'usu' => $xusu,
                'ambiente' => $amb,
            ]);

            return $data;
        }

        /* Ambientes Activos en el Sistema */
        public function getAmbientes()
        {
            global $database;

            $data = $database->select('ambientes', [
                'id_ambiente',
                'codigo',
                'nombre',
                'id_centrocosto',
                'servicio',
                'propina',
                'impuesto',
                'propina_incluida',
                'id_bodega',
                'codigo_venta',
                'codigo_propina',
                'codigo_servicio',
                'encuesta',
                'plano',
                'logo',
            ], [
                'active_at' => 1,
            ]);

            return $data;
        }

        /* Fecha Actual del Sistema */
        public function getDatePos()
        {
            global $database;

            $data = $database->select('parametros_pos', [
                'fecha_auditoria',
            ]);

            return $data[0]['fecha_auditoria'];
        }

        /* Ventas del Dia Por Ambiente */
        public function sumSalesDay($code)
        {
            global $database;

            $data = $database->sum('ventas_dia_pos', [
                'importe',
            ], [
                'ambiente' => $code,
            ]);

            return $data;
        }

        /* Comandas Activas en el Sistema [Pendientes por Facturar] */
        public function countComandasPos($code, $estado)
        {
            global $database;

            $data = $database->count('comandas', [
                'comanda',
            ], [
                'ambiente' => $code,
                'estado' => $estado,
            ]);

            return $data;
        }

        /* Facturas Generadas en el Sistema */
        public function countFacturasPos($code)
        {
            global $database;

            $data = $database->count('facturas_pos', [
                'factura',
            ], [
                'ambiente' => $code,
            ]);

            return $data;
        }

        /* Productos activos en la Comamda [Sin Enviar o Facturar] */
        public function getProductosTmp($usu, $amb)
        {
            global $database;

            $data = $database->select('caja_tmp', [
                'id',
                'producto_id',
                'cod',
                'nom',
                'venta',
                'valorimpto',
                'cant',
                'importe',
                'existencia',
                'usu',
                'ambiente',
                'descuento',
                'por_desc',
                'impto',
            ], [
                'usu' => $usu,
                'ambiente' => $amb,
            ]);

            return $data;
        }

        /* Mesas Libres por Ambiente */
        public function getMesasAmbi($amb)
        {
            global $database;

            $data = $database->select('mesas', [
                'numero_mesa',
            ], [
                'ambiente' => $amb,
                'estado' => 'L',
            ]);

            return $data;
        }

        /* Formas de Pago POS */
        public function getFormasPago()
        {
            global $database;

            $data = $database->select('formas_pago', [
                'id_pago',
                'descripcion',
            ], [
                'ORDER' => ['descripcion' => 'ASC'],
            ]);

            return $data;
        }

        /* Descuentos */
        public function getDescuentosPos($amb)
        {
            global $database;

            $data = $database->select('descuentos_pos', [
                'id_descuento',
                'descripcion_descuento',
                'valor',
                'porcentaje',
                'hora_inicio',
                'hora_final',
                'lunes',
                'martes',
                'miercoles',
                'jueves',
                'viernes',
                'sabado',
                'domingo',
                'codigo',
            ], [
                'id_ambiente' => $amb,
                'actived_at' => 1,
            ]);

            return $data;
        }

        
        /* Tipos de Platos */
        public function getSeccionesPos($idamb)
        {
            global $database;

            $data = $database->select('secciones_pos', [
                'id_seccion',
                'codigo_seccion',
                'nombre_seccion',
            ], [
                'estado_seccion' => 1,
                'id_ambiente' => $idamb,
                'deleted_at' => null,
                'ORDER' => ['nombre_seccion' => 'ASC'],
            ]);

            return $data;
        }

        public function getBuscaProducto($codigo, $amb)
        {
            global $database;

            $data = $database->select('producto', [
                '[>]recetasEstandar' => ['id_receta' => 'id_receta'],
                '[>]codigos_vta' => ['impto' => 'id_cargo'],
            ], [
                'codigos_vta.porcentaje_impto',
                'recetasEstandar.foto',
                'producto.producto_id',
                'producto.cod',
                'producto.nom',
                'producto.costo',
                'producto.venta',
                'producto.impto',
                'producto.estado',
            ], [
                'producto.ambiente' => $amb,
                'producto.active_at' => 1,
                'producto.nom[~]' => $codigo,
                'producto.deleted_at' => null,
                'ORDER' => ['nom' => 'ASC'],
            ]);

            return $data;
        }

        /* Productos por Tipo de Plato */
        public function getProductosTipo($codigo, $amb)
        {
            global $database;

            $data = $database->select('producto', [
                '[>]recetasEstandar' => ['id_receta' => 'id_receta'],
                '[>]codigos_vta' => ['impto' => 'id_cargo'],
            ], [
                'codigos_vta.porcentaje_impto',
                'recetasEstandar.foto',
                'producto.producto_id',
                'producto.cod',
                'producto.nom',
                'producto.costo',
                'producto.venta',
                'producto.impto',
                'producto.estado',
            ], [
                'producto.ambiente' => $amb,
                'producto.seccion' => $codigo,
                'producto.active_at' => 1,
                'producto.deleted_at' => null,
                'ORDER' => ['nom' => 'ASC'],
            ]);

            return $data;
        }

        /* Valor Producto en Venta */
        public function getProductoVenta($codigo, $amb)
        {
            global $database;

            $data = $database->select('producto', [
                '[>]codigos_vta' => ['impto' => 'id_cargo'],
            ], [
                'cod',
                'nom',
                'venta',
                'producto_id',
                'impto',
                'codigos_vta.porcentaje_impto',
            ], [
                'ambiente' => $amb,
                'producto_id' => $codigo,
                'active_at' => 1,
            ]);

            return $data;
        }

        /* Envia Monto Impuesto Produto [sin uso] */
        public function getMontoImpto($codigo)
        {
            global $database;

            $data = $database->select('impuestos', [
                'mpo_impu',
            ], [
                'cod_impu' => $codigo,
            ]);

            return $data[0]['mpo_impu'];
        }
}
