<?php
  require_once '../../../res/php/titles.php';
  require_once '../../../res/php/app_topHotel.php';

  $desde = $_POST['desde'];
  $hasta = $_POST['hasta'];

  $consulta = "WITH factura_info AS (
    SELECT DISTINCT
        hc.factura_numero,
        hc.tipo_factura,
        hc.fecha_factura,
        hc.diasCredito,
        hc.referencia_cargo,
        CASE 
            WHEN hc.tipo_factura = 1 THEN h.nombre1
            ELSE NULL
        END AS nombre1,
        CASE 
            WHEN hc.tipo_factura = 1 THEN h.nombre2
            ELSE NULL
        END AS nombre2,
        CASE 
            WHEN hc.tipo_factura = 1 THEN h.apellido1
            ELSE NULL
        END AS apellido1,
        CASE 
            WHEN hc.tipo_factura = 1 THEN h.apellido2
            ELSE NULL
        END AS apellido2,
        CASE 
            WHEN hc.tipo_factura = 2 THEN c.empresa
            ELSE NULL
        END AS razon_social,
        CASE 
            WHEN hc.tipo_factura = 1 THEN h.identificacion
            WHEN hc.tipo_factura = 2 THEN c.nit
            ELSE NULL
        END AS nit,
        CASE 
            WHEN hc.tipo_factura = 2 THEN c.dv
            ELSE NULL
        END AS dv,
        CASE 
            WHEN hc.tipo_factura = 1 THEN h.direccion
            WHEN hc.tipo_factura = 2 THEN c.direccion
            ELSE NULL
        END AS direccion,
        CASE 
            WHEN hc.tipo_factura = 1 THEN h.telefono
            WHEN hc.tipo_factura = 2 THEN c.telefono
            ELSE NULL
        END AS telefono,
        CASE 
            WHEN hc.tipo_factura = 1 THEN h.sexo
            ELSE NULL
        END AS sexo,
        CASE 
            WHEN hc.tipo_factura = 1 THEN ciudad_h.codigo
            WHEN hc.tipo_factura = 2 THEN ciudad_c.codigo
            ELSE NULL
        END AS ciudad
    FROM 
        historico_cargos_pms hc
    LEFT JOIN 
        huespedes h ON hc.id_perfil_factura = h.id_huesped AND hc.tipo_factura = 1
    LEFT JOIN 
        companias c ON hc.id_perfil_factura = c.id_compania AND hc.tipo_factura = 2
    LEFT JOIN
        ciudades ciudad_h ON h.ciudad = ciudad_h.id_ciudad
    LEFT JOIN
        ciudades ciudad_c ON c.ciudad = ciudad_c.id_ciudad
    WHERE 
        hc.perfil_factura = 1 AND
        hc.factura = 1 AND
        hc.tipo_factura < 3 AND
        hc.fecha_factura BETWEEN '$desde' AND '$hasta'
  )
  SELECT
    @row_number := IF(@current_factura = fi.factura_numero, @row_number + 1, 1) AS linea,
    @current_factura := fi.factura_numero AS factura_numero,
    fi.factura_numero,
    fi.tipo_factura,
    fi.fecha_factura,
    fi.diasCredito,
    fi.referencia_cargo,
    fi.nombre1,
    fi.nombre2,
    fi.apellido1,
    fi.apellido2,
    fi.razon_social,
    fi.direccion,
    fi.nit,
    fi.dv,
    fi.sexo,
    fi.ciudad,
    fi.telefono,
    d.cargodeb,
    d.cargocre,
    d.anulado,
    d.cuenta_puc,
    d.descripcion_cargo,
    d.tipo_codigo,
    d.descripcion_contable,
    d.centroCosto,
    d.anio
  FROM 
    factura_info fi
  JOIN (
      SELECT 
        factura_numero,
        SUM(CASE WHEN tipo != 'cargo' THEN monto ELSE 0 END) AS cargodeb,
        SUM(CASE WHEN tipo = 'cargo' THEN monto ELSE 0 END) AS cargocre,
        MAX(anulado) AS anulado,
        cuenta_puc,
        descripcion_cargo,
        tipo_codigo,
        descripcion_contable,
        centroCosto,
          MAX(anio) AS anio
      FROM (
          SELECT 
            factura_numero,
            IF(pagos_cargos = 0, monto_cargo, pagos_cargos ) AS monto,
            IF(pagos_cargos = 0, 'cargo', 'pago' ) AS tipo,
            IF(cargo_anulado = 0, 'N', 'S') AS anulado,
            IF(concecutivo_abono = 0, cuenta_puc, cuenta_cruce) AS cuenta_puc,
            cv.descripcion_cargo,
            cv.tipo_codigo,
            descripcion_contable,
            centroCosto,
            YEAR(fecha_factura) AS anio
          FROM 
            historico_cargos_pms hc
          INNER JOIN 
              codigos_vta cv ON cv.id_cargo = hc.id_codigo_cargo 
  
          UNION ALL
  
          SELECT 
              factura_numero,
              hc.impuesto AS monto,
              'cargo' AS tipo,
              IF(cargo_anulado = 0, 'N', 'S') AS anulado,
              cuenta_puc,
              cv.descripcion_cargo,
              cv.tipo_codigo,
              descripcion_contable,
              centroCosto,
              YEAR(fecha_factura) AS anio
          FROM 
              historico_cargos_pms hc
          INNER JOIN  
              codigos_vta cv ON cv.id_cargo = hc.codigo_impto
          
          UNION ALL
  
          SELECT 
              hc.factura_numero,
              hc.retefuente AS monto,
              'retefuente' AS tipo,
              IF(hc.cargo_anulado = 0, 'N', 'S') AS anulado,
              r.codigoPuc AS cuenta_puc,
              r.descripcionRetencion AS descripcion_cargo,
              4 AS tipo_codigo,
              r.descripcionRetencion AS descripcion_contable,
              '03' AS centroCosto,
              YEAR(hc.fecha_factura) AS anio
          FROM 
              historico_cargos_pms hc
          INNER JOIN 
              companias c ON c.id_compania = hc.id_perfil_factura
          INNER JOIN  
              retenciones r ON r.idRetencion = 1
          WHERE 
              hc.retefuente > 0
  
          UNION ALL
  
          SELECT 
              hc.factura_numero,
              hc.reteiva AS monto,
              'reteiva' AS tipo,
              IF(hc.cargo_anulado = 0, 'N', 'S') AS anulado,
              r.codigoPuc AS cuenta_puc,
              r.descripcionRetencion AS descripcion_cargo,
              4 AS tipo_codigo,
              r.descripcionRetencion AS descripcion_contable,
              '03' AS centroCosto,
              YEAR(hc.fecha_factura) AS anio
          FROM 
              historico_cargos_pms hc
          INNER JOIN 
              companias c ON c.id_compania = hc.id_perfil_factura
          INNER JOIN  
              retenciones r ON r.idRetencion = 2
          WHERE 
              hc.reteiva > 0
  
          UNION ALL
  
          SELECT 
              hc.factura_numero,
              hc.reteica AS monto,
              'reteica' AS tipo,
              IF(hc.cargo_anulado = 0, 'N', 'S') AS anulado,
              r.codigoPuc AS cuenta_puc,
              r.descripcionRetencion AS descripcion_cargo,
              4 AS tipo_codigo,
              r.descripcionRetencion AS descripcion_contable,
              '03' AS centroCosto,
              YEAR(hc.fecha_factura) AS anio
          FROM 
              historico_cargos_pms hc
          INNER JOIN 
              companias c ON c.id_compania = hc.id_perfil_factura
          INNER JOIN  
              retenciones r ON r.idRetencion = 3
          WHERE 
              hc.reteica > 0
      ) AS subquery
      GROUP BY 
          factura_numero, 
          cuenta_puc,
          descripcion_cargo,
          tipo_codigo,
          descripcion_contable,
          centroCosto
  ) d ON fi.factura_numero = d.factura_numero
  ORDER BY 
      fi.factura_numero ASC,
      linea ASC, 
      d.tipo_codigo ASC,
      d.descripcion_cargo ASC;";
  


  $facturas = $hotel->creaConsulta($consulta);

//   echo print_r($facturas);

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
                <td><?php echo $factura['linea']; ?></td>
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
                <td> <?php echo $factura['factura_numero']; ?></td>
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




