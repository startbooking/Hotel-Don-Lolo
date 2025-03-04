<?php
  require_once '../../../res/php/titles.php';
  require_once '../../../res/php/app_topHotel.php';

  $desde = $_POST['desde'];
  $hasta = $_POST['hasta'];

  $consulta = "SELECT
    @row_number := IF(@current_factura = a.factura_numero, @row_number + 1, 1) AS linea,
    @current_factura := a.factura_numero AS factura,
    sum(monto) as valor_cargo, 
    SUM(CASE WHEN tipo != 'cargo' THEN monto ELSE 0 END) AS cargodeb,   
    SUM(CASE WHEN tipo = 'cargo' THEN monto ELSE 0 END) AS cargocre,
	year(fecha_factura) as anio,
    a.*,
	CASE 
        WHEN tipo_factura = 1 THEN h.nombre1
        WHEN a.tipo_factura = 2 AND concecutivo_abono >0 THEN h.nombre1
        ELSE NULL
    END AS nombre1,
    CASE 
        WHEN a.tipo_factura = 1 THEN h.nombre2
        WHEN a.tipo_factura = 2 AND concecutivo_abono >0 THEN h.nombre2
        ELSE NULL
    END AS nombre2,
    CASE 
        WHEN a.tipo_factura = 1 THEN h.apellido1
        WHEN a.tipo_factura = 2 AND concecutivo_abono >0 THEN h.apellido1
        ELSE NULL
    END AS apellido1,
    CASE 
        WHEN a.tipo_factura = 1 THEN h.apellido2
        WHEN a.tipo_factura = 2 AND concecutivo_abono >0 THEN h.apellido2
        ELSE NULL
    END AS apellido2,
    CASE 
        WHEN a.tipo_factura = 2 AND concecutivo_abono = 0 THEN c.empresa
        ELSE NULL
    END AS razon_social,
    CASE 
        WHEN a.tipo_factura = 1 THEN h.identificacion
        WHEN a.tipo_factura = 2 AND concecutivo_abono >0 THEN h.identificacion
        WHEN a.tipo_factura = 2 AND concecutivo_abono =0 THEN c.nit
        ELSE NULL
    END AS nit,
    CASE 
        WHEN a.tipo_factura = 2 AND concecutivo_abono =0 THEN c.dv
        ELSE NULL
    END AS dv,
    CASE 
        WHEN a.tipo_factura = 1 THEN h.direccion
        WHEN a.tipo_factura = 2 AND concecutivo_abono >0 THEN h.direccion
        WHEN a.tipo_factura = 2 AND concecutivo_abono =0 THEN c.direccion
        ELSE NULL
    END AS direccion,
    CASE 
        WHEN a.tipo_factura = 1 THEN h.telefono
        WHEN a.tipo_factura = 2 AND concecutivo_abono >0 THEN h.telefono
        WHEN a.tipo_factura = 2 AND concecutivo_abono =0 THEN c.telefono
        ELSE NULL
    END AS telefono,
    CASE 
        WHEN a.tipo_factura = 1 THEN h.sexo
        WHEN a.tipo_factura = 2 AND concecutivo_abono >0 THEN h.sexo
        ELSE NULL
    END AS sexo,
    CASE 
        WHEN a.tipo_factura = 1 THEN ciudad_h.codigo
        WHEN a.tipo_factura = 2 AND concecutivo_abono >0 THEN ciudad_h.codigo
        WHEN a.tipo_factura = 2 AND concecutivo_abono =0 THEN ciudad_c.codigo
        ELSE NULL
    END AS ciudad,
    CASE 
        WHEN a.concecutivo_abono = 0 THEN factura_numero
        WHEN a.concecutivo_abono > 0 THEN concecutivo_abono
        ELSE NULL
    END AS numero_doc
FROM
	(SELECT
		factura_numero,
		fecha_factura,
	    IF	( pagos_cargos = 0, monto_cargo, pagos_cargos ) AS monto,
	    IF	( pagos_cargos = 0, 'cargo', 'pago' ) AS tipo,
	    IF	( cargo_anulado = 0, 'N', 'S' ) AS anulado,
	    IF	( concecutivo_abono = 0, cuenta_puc, cuenta_cruce ) AS cuenta_puc,
	    IF	( concecutivo_abono = 0, 0, 1 ) AS abono,
		id_perfil_factura,
		id_huesped,
		concecutivo_abono,
		tipo_factura,
		cv.descripcion_cargo,
		cv.tipo_codigo,
		descripcion_contable,
        referencia_cargo,
		centroCosto 
	FROM
		historico_cargos_pms hc
		INNER JOIN codigos_vta cv ON cv.id_cargo = hc.id_codigo_cargo 
	UNION ALL
	SELECT
		factura_numero,
		fecha_factura,
		hc.impuesto AS monto,
		'cargo' AS tipo,
	IF	( cargo_anulado = 0, 'N', 'S' ) AS anulado,
		cuenta_puc,
	IF	( concecutivo_abono = 0, 0, 1 ) AS abono,
		id_perfil_factura,
		id_huesped,
		concecutivo_abono,
		tipo_factura,
		cv.descripcion_cargo,
		cv.tipo_codigo,
		descripcion_contable,
        referencia_cargo,
		centroCosto 
	FROM
		historico_cargos_pms hc
		INNER JOIN codigos_vta cv ON cv.id_cargo = hc.codigo_impto 
	UNION ALL
	SELECT
		hc.factura_numero,
		hc.fecha_factura,
		hc.retefuente AS monto,
		'retefuente' AS tipo,
	IF	( hc.cargo_anulado = 0, 'N', 'S' ) AS anulado,
		r.codigoPuc AS cuenta_puc,
	IF	( concecutivo_abono = 0, 0, 1 ) AS abono,
		hc.id_perfil_factura,
		id_huesped,
		concecutivo_abono,
		tipo_factura,
		r.descripcionRetencion AS descripcion_cargo,
		4 AS tipo_codigo,
		r.descripcionRetencion AS descripcion_contable,
        '' AS referencia_cargo,
		'03' AS centroCosto
	FROM
		historico_cargos_pms hc
		INNER JOIN companias c ON c.id_compania = hc.id_perfil_factura
		INNER JOIN retenciones r ON r.idRetencion = 1 
	WHERE
		hc.retefuente > 0 
		UNION ALL
	SELECT
		hc.factura_numero,
		hc.fecha_factura,
		hc.reteiva AS monto,
		'reteiva' AS tipo,
	IF	( hc.cargo_anulado = 0, 'N', 'S' ) AS anulado,
		r.codigoPuc AS cuenta_puc,
	IF	( concecutivo_abono = 0, 0, 1 ) AS abono,
		hc.id_perfil_factura,
		id_huesped,
		concecutivo_abono,
		tipo_factura,
		r.descripcionRetencion AS descripcion_cargo,
		4 AS tipo_codigo,
		r.descripcionRetencion AS descripcion_contable,
        '' AS referencia_cargo,
		'03' AS centroCosto
	FROM
		historico_cargos_pms hc
		INNER JOIN companias c ON c.id_compania = hc.id_perfil_factura
		INNER JOIN retenciones r ON r.idRetencion = 2 
	WHERE
		hc.reteiva > 0 
		UNION ALL
	SELECT
		hc.factura_numero,
		hc.fecha_factura,
		hc.reteica AS monto,
		'reteica' AS tipo,
	IF	( hc.cargo_anulado = 0, 'N', 'S' ) AS anulado,
		r.codigoPuc AS cuenta_puc,
	IF	( concecutivo_abono = 0, 0, 1 ) AS abono,
		hc.id_perfil_factura,
		id_huesped,
		concecutivo_abono,
		tipo_factura,
		r.descripcionRetencion AS descripcion_cargo,
		4 AS tipo_codigo,
		r.descripcionRetencion AS descripcion_contable,
        '' AS referencia_cargo,
		'03' AS centroCosto
	FROM
		historico_cargos_pms hc
		INNER JOIN companias c ON c.id_compania = hc.id_perfil_factura
		INNER JOIN retenciones r ON r.idRetencion = 3 
	WHERE
		hc.reteica > 0 
	ORDER BY
		factura_numero 
	) AS a
	  LEFT JOIN 
        huespedes h ON a.id_huesped = h.id_huesped
    LEFT JOIN 
        companias c ON a.id_perfil_factura = c.id_compania
		LEFT JOIN
        ciudades ciudad_h ON h.ciudad = ciudad_h.id_ciudad
    LEFT JOIN
        ciudades ciudad_c ON c.ciudad = ciudad_c.id_ciudad
WHERE
    a.fecha_factura BETWEEN '$desde' AND '$hasta' AND tipo_factura < 3
group by factura_numero, descripcion_cargo
ORDER BY
	a.factura_numero ASC,
	a.tipo_codigo ASC,
	a.concecutivo_abono ASC";
  $facturas = $hotel->creaConsulta($consulta);

  if (count($facturas) == 0) {
    echo '1';
  } else { 
    ?>
    <tbody>
        <?php
        $numero = 0;
        $total = 0;
        foreach ($facturas as $factura) { 
            if($factura['cargodeb']==0){
                $total = $factura['cargocre'];
            }else{
                $total = $factura['cargodeb'];
            }
            if ($numero == $factura['factura_numero']) {
                ++$i;
            } else {
                $i = 1;
                $numero = $factura['factura_numero'];
            }
            ?>
            <tr>
                <td>1</td>
                <td><?php echo $factura['anio']; ?></td>
                <td>3</td>
                <td><?php echo $factura['factura_numero']; ?></td>
                <td><?php echo substr($factura['fecha_factura'], 8, 2).'/'.substr($factura['fecha_factura'], 5, 2).'/'.substr($factura['fecha_factura'], 0, 4); ?></td>
                <td><?php echo $factura['descripcion_cargo']; ?></td>
                <td><?php echo $factura['anulado']; ?></td>
                <td>CONTABILIDAD</td>
                <td>1</td>
                <td><?php echo $factura['anio']; ?></td>
                <td>3</td>
                <td><?php echo $factura['factura_numero']; ?></td>
                <td><?php echo $factura['cuenta_puc']; ?></td>
                <td><?php echo $i; ?></td>
                <td><?php echo substr($factura['fecha_factura'], 8, 2).'/'.substr($factura['fecha_factura'], 5, 2).'/'.substr($factura['fecha_factura'], 0, 4); ?></td>
                <td><?php echo "'".$factura['centroCosto']; ?></td>
                <td><?php echo $factura['nit']; ?></td>
                <td><?php echo $factura['dv']; ?></td>
                <td><?php echo $factura['apellido1']; ?></td>
                <td><?php echo $factura['apellido2']; ?></td>
                <td><?php echo $factura['nombre1']; ?></td>
                <td><?php echo $factura['nombre2']; ?></td>
                <td><?php echo $factura['razon_social']; ?></td>
                <td><?php if($factura['ciudad']==''){
                    echo '';
                }else {
                    echo substr($factura['ciudad'],0,2);
                }
                ?>
                </td>
                <td>
                    <?php if($factura['ciudad']==''){
                    echo '';
                }else {
                    echo substr($factura['ciudad'],2,3); 
                }?></td>
                <td><?php echo $factura['direccion']; ?></td>
                <td><?php echo $factura['telefono']; ?></td>
                <td><?php echo $factura['sexo']; ?></td>
                <td><?php echo $factura['referencia_cargo']; ?></td>
                <td><?php echo $factura['descripcion_contable']; ?></td>
                <td style="text-align:right;"><?php echo round($factura['cargodeb'],0); ?></td>
                <td style="text-align:right;"><?php echo round($factura['cargocre'],0); ?></td>
                <td> <?php echo $factura['numero_doc']; ?></td>
                <td> <?php echo ''; ?></td>
                <td><?php echo ''; ?></td>
                <td style="text-align:right;">
                <?php echo round($total,0);?>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
    <?php
    } 
  ?>




