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


// echo $consumos;

$facturas = "WITH factura_info AS (
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
        hc.fecha_factura BETWEEN '20250201' AND '20250228'
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
      d.descripcion_cargo ASC";


// echo $facturas;

$clientes = "SELECT DISTINCT
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
        hc.fecha_factura BETWEEN '20250201' AND '20250228'";

// echo $clientes;

$cargos = "SELECT
	fecha_factura,
	factura_numero,
  IF
	( pagos_cargos = 0, monto_cargo, pagos_cargos ) AS monto,
  IF
	( pagos_cargos = 0, 'cargo', 'pago' ) AS tipo,
  IF
	( cargo_anulado = 0, 'N', 'S' ) AS anulado,
  IF
	( concecutivo_abono = 0, cuenta_puc, cuenta_cruce ) AS cuenta_puc,
  IF
	( concecutivo_abono = 0, 2, 1) AS tipo_fac,
	id_perfil_factura,
	cv.descripcion_cargo,
	cv.tipo_codigo,
	descripcion_contable,
	centroCosto,
concecutivo_abono		
FROM
	historico_cargos_pms hc
	INNER JOIN codigos_vta cv ON cv.id_cargo = hc.id_codigo_cargo
WHERE fecha_factura BETWEEN '20250201' AND '20250228'
ORDER BY factura_numero, tipo";

// echo $cargos ;




$respData = $hotel->creaConsulta($cargos);


echo print_r($respData);
