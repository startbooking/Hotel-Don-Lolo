<?php

require_once '../../../res/php/titles.php';
require_once '../../../res/php/app_topHotel.php';

$sub = "SELECT 
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
            IF(concecutivo_abono = 0, monto_cargo, pagos_cargos) AS monto,
            IF(concecutivo_abono = 0, 'cargo', 'pago') AS tipo,
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
       SELECT 
            factura_numero,
            IF(concecutivo_abono = 0, monto_cargo, pagos_cargos) AS monto,
            IF(concecutivo_abono = 0, 'cargo', 'pago') AS tipo,
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
              codigos_vta cv ON cv.id_cargo = hc.id_codigo_cargo        retenciones r ON r.idRetencion = 2
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
      ) AS subquery";





$consumos = "SELECT 
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
          where 
            hc.fecha_factura BETWEEN '2024-02-01' AND '2024-02-28'
              ";


echo $consumos;

$respData = $hotel->creaConsulta($consumos);


echo print_r($respData);
