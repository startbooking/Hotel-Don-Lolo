<?php

require_once '../../../res/php/titles.php';
require_once '../../../res/php/app_topHotel.php';

$huespedOK= "SELECT
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
    END AS apellidos,
    CASE 
      WHEN hc.tipo_factura = 2 THEN c.empresa
      ELSE NULL
    END AS razon_social,
    CASE 
      WHEN hc.tipo_factura = 1 THEN h.direccion
      WHEN hc.tipo_factura = 2 THEN c.direccion
      ELSE NULL
    END AS direccion
  FROM 
    historico_cargos_pms hc
  LEFT JOIN 
    huespedes h ON hc.id_perfil_factura = h.id_huesped AND hc.tipo_factura = 1
  LEFT JOIN 
    companias c ON hc.id_perfil_factura = c.id_compania AND hc.tipo_factura = 2
  WHERE 
    hc.tipo_factura IN (1, 2) AND
    hc.perfil_factura = 1 AND
    hc.factura = 1 AND
    hc.tipo_factura < 3 AND
    hc.fecha_factura BETWEEN '2024-11-01' AND '2024-11-30'
  ORDER BY 
    hc.factura_numero";


$huesped = "SELECT
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
  END AS apellidos,
  CASE 
    WHEN hc.tipo_factura = 2 THEN c.empresa
    ELSE NULL
  END AS razon_social,
  CASE 
    WHEN hc.tipo_factura = 1 THEN h.direccion
    WHEN hc.tipo_factura = 2 THEN c.direccion
    ELSE NULL
  END AS direccion
  FROM 
    historico_cargos_pms hc
  LEFT JOIN 
    huespedes h ON hc.id_perfil_factura = h.id_huesped AND hc.tipo_factura = 1
  LEFT JOIN 
    companias c ON hc.id_perfil_factura = c.id_compania AND hc.tipo_factura = 2
  WHERE 
    hc.tipo_factura IN (1, 2) AND
    hc.perfil_factura = 1 AND
    hc.factura = 1 AND
    hc.tipo_factura < 3 AND
    hc.fecha_factura BETWEEN '2024-11-01' AND '2024-11-30'
  ORDER BY 
    hc.factura_numero;";






   /* SELECT 
      if(concecutivo_abono = 0 , SUM(monto_cargo), SUM(pagos_cargos)) AS cargodeb, 
      if(concecutivo_abono = 0 , SUM(pagos_cargos),0) AS cargocre, 
      if(historico_cargos_pms.cargo_anulado = 0,'N','S') as anulado, 
      if(concecutivo_abono = 0 , cuenta_puc,cuenta_cruce) AS cuenta_puc, 
      codigos_vta.descripcion_cargo, 
      codigos_vta.tipo_codigo,
      descripcion_contable, 
      centroCosto, 
      factura_numero, 
      fecha_factura, 
      diasCredito, 
      referencia_cargo, 
      YEAR(fecha_factura) AS anio
      FROM 
        historico_cargos_pms 
      INNER JOIN 
        codigos_  FROM huespedes
    LEFT JOIN  
      codigos_vta ON codigos_vta.id_cargo = historico_cargos_pms.id_codigo_cargo 
      WHERE 
        historico_cargos_pms.perfil_factura = 1 AND 
        historico_cargos_pms.tipo_factura < 3 AND 
        historico_cargos_pms.fecha_factura BETWEEN '2024-11-01' AND '2024-11-30'
      GROUP BY 
        factura_numero, 
        descripcion_cargo  
      UNION ALL
        (SELECT
          0 AS cargodeb,
          SUM(historico_cargos_pms.impuesto) AS cargocre,
          if(historico_cargos_pms.cargo_anulado = 0,'N','S') as anulado,
          cuenta_puc,
          codigos_vta.descripcion_cargo,
          codigos_vta.tipo_codigo,
          descripcion_contable,
          centroCosto,
          factura_numero,
          fecha_factura,
          diasCredito,
          referencia_cargo,
          YEAR(fecha_factura) AS anio
        FROM
          historico_cargos_pms
        INNER JOIN  
          codigos_vta ON codigos_vta.id_cargo = historico_cargos_pms.codigo_impto
        WHERE
          historico_cargos_pms.perfil_factura = 1 AND
          historico_cargos_pms.tipo_factura < 3 AND
          historico_cargos_pms.fecha_factura BETWEEN '2024-11-01' AND '2024-11-30'
        GROUP BY
          factura_numero,
          descripcion_cargo)
      UNION ALL 
        (SELECT
          0 AS cargodeb,
          SUM(historico_cargos_pms.retefuente) AS cargocre,
          if(historico_cargos_pms.cargo_anulado = 0,'N','S') as anulado,
          retenciones.codigoPuc as cuenta_puc,
          retenciones.descripcionRetencion as descripcion_cargo,
          4 as tipo_codigo,
          retenciones.descripcionRetencion as descripcion_contable,
          '03' as centroCosto,
          factura_numero,
          fecha_factura,
          diasCredito,
          referencia_cargo,
          YEAR(fecha_factura) AS anio
        FROM
          historico_cargos_pms
        INNER JOIN 
          companias ON id_compania = historico_cargos_pms.id_perfil_factura
        INNER JOIN  
          codigos_vta ON codigos_vta.id_cargo = historico_cargos_pms.id_codigo_cargo
        INNER JOIN  
          retenciones ON retenciones.idRetencion = 1
          WHERE
            historico_cargos_pms.perfil_factura = 1 AND
            historico_cargos_pms.tipo_factura < 3 AND
            historico_cargos_pms.fecha_factura BETWEEN '2024-11-01' AND '2024-11-30'
            AND historico_cargos_pms.retefuente > 0
          GROUP BY
            factura_numero,
            descripcion_cargo)
      UNION ALL
        (SELECT
          0 AS cargodeb,
          SUM(historico_cargos_pms.reteiva) AS cargocre,
          if(historico_cargos_pms.cargo_anulado = 0,'N','S') as anulado,
          retenciones.codigoPuc as cuenta_puc,
          retenciones.descripcionRetencion as descripcion_cargo,
          4 as tipo_codigo,
          retenciones.descripcionRetencion as descripcion_contable,
          '03' as centroCosto,
          factura_numero,
          fecha_factura,
          diasCredito,
          referencia_cargo,
          YEAR(fecha_factura) AS anio
        FROM
          historico_cargos_pms
        INNER JOIN 
          companias ON id_compania = historico_cargos_pms.id_perfil_factura
        INNER JOIN  
          codigos_vta ON codigos_vta.id_cargo = historico_cargos_pms.id_codigo_cargo
        INNER JOIN  
          retenciones ON retenciones.idRetencion = 2
        WHERE
          historico_cargos_pms.perfil_factura = 1 AND
          historico_cargos_pms.tipo_factura < 3 AND
          historico_cargos_pms.fecha_factura BETWEEN '2024-11-01' AND '2024-11-30'
          AND historico_cargos_pms.reteiva > 0
        GROUP BY
          factura_numero,
          descripcion_cargo)
      UNION ALL
    (SELECT
      0 AS cargodeb,
      SUM(historico_cargos_pms.reteica) AS cargocre,
      if(historico_cargos_pms.cargo_anulado = 0,'N','S') as anulado,
      retenciones.codigoPuc as cuenta_puc,
      retenciones.descripcionRetencion as descripcion_cargo,
      4 as tipo_codigo,
      retenciones.descripcionRetencion as descripcion_contable,
      '03' as centroCosto,
      factura_numero,
      fecha_factura,
      diasCredito,
      referencia_cargo,
      YEAR(fecha_factura) AS anio
      FROM
        historico_cargos_pms
      INNER JOIN 
        companias ON id_compania = historico_cargos_pms.id_perfil_factura
      INNER JOIN  
        codigos_vta ON codigos_vta.id_cargo = historico_cargos_pms.id_codigo_cargo
      INNER JOIN  
        retenciones ON retenciones.idRetencion = 3
      WHERE
        historico_cargos_pms.perfil_factura = 1 AND
        historico_cargos_pms.tipo_factura < 3 AND
        historico_cargos_pms.fecha_factura BETWEEN '2024-11-01' AND '2024-11-30'
        AND historico_cargos_pms.reteiva > 0
      GROUP BY
        factura_numero,
        descripcion_cargo)
    ORDER BY 
    factura_numero ASC, 
    tipo_codigo ASC,
    descripcion_cargo ASC"; */
  

$data = "SELECT 
      if(concecutivo_abono = 0 , SUM(monto_cargo), SUM(pagos_cargos)) AS cargodeb, 
      if(concecutivo_abono = 0 , SUM(pagos_cargos),0) AS cargocre, 
      if(historico_cargos_pms.cargo_anulado = 0,'N','S') as anulado, 
      if(concecutivo_abono = 0 , cuenta_puc,cuenta_cruce) AS cuenta_puc, 
      codigos_vta.descripcion_cargo, 
      codigos_vta.tipo_codigo,
      descripcion_contable, 
      centroCosto, 
      factura_numero, 
      fecha_factura, 
      diasCredito, 
      referencia_cargo, 
      YEAR(fecha_factura) AS anio
      FROM 
        historico_cargos_pms 
      INNER JOIN 
        codigos_vta ON codigos_vta.id_cargo = historico_cargos_pms.id_codigo_cargo 
      WHERE 
        historico_cargos_pms.perfil_factura = 1 AND 
        historico_cargos_pms.tipo_factura < 3 AND 
        historico_cargos_pms.fecha_factura BETWEEN '2024-11-01' AND '2024-11-30'
      GROUP BY 
        factura_numero, 
        descripcion_cargo  
      UNION ALL
        (SELECT
          0 AS cargodeb,
          SUM(historico_cargos_pms.impuesto) AS cargocre,
          if(historico_cargos_pms.cargo_anulado = 0,'N','S') as anulado,
          cuenta_puc,
          codigos_vta.descripcion_cargo,
          codigos_vta.tipo_codigo,
          descripcion_contable,
          centroCosto,
          factura_numero,
          fecha_factura,
          diasCredito,
          referencia_cargo,
          YEAR(fecha_factura) AS anio
        FROM
          historico_cargos_pms
        INNER JOIN  
          codigos_vta ON codigos_vta.id_cargo = historico_cargos_pms.codigo_impto
        WHERE
          historico_cargos_pms.perfil_factura = 1 AND
          historico_cargos_pms.tipo_factura < 3 AND
          historico_cargos_pms.fecha_factura BETWEEN '2024-11-01' AND '2024-11-30'
        GROUP BY
          factura_numero,
          descripcion_cargo)
      UNION ALL 
        (SELECT
          0 AS cargodeb,
          SUM(historico_cargos_pms.retefuente) AS cargocre,
          if(historico_cargos_pms.cargo_anulado = 0,'N','S') as anulado,
          retenciones.codigoPuc as cuenta_puc,
          retenciones.descripcionRetencion as descripcion_cargo,
          4 as tipo_codigo,
          retenciones.descripcionRetencion as descripcion_contable,
          '03' as centroCosto,
          factura_numero,
          fecha_factura,
          diasCredito,
          referencia_cargo,
          YEAR(fecha_factura) AS anio
        FROM
          historico_cargos_pms
        INNER JOIN 
          companias ON id_compania = historico_cargos_pms.id_perfil_factura
        INNER JOIN  
          codigos_vta ON codigos_vta.id_cargo = historico_cargos_pms.id_codigo_cargo
        INNER JOIN  
          retenciones ON retenciones.idRetencion = 1
          WHERE
            historico_cargos_pms.perfil_factura = 1 AND
            historico_cargos_pms.tipo_factura < 3 AND
            historico_cargos_pms.fecha_factura BETWEEN '2024-11-01' AND '2024-11-30'
            AND historico_cargos_pms.retefuente > 0
          GROUP BY
            factura_numero,
            descripcion_cargo)
      UNION ALL
        (SELECT
          0 AS cargodeb,
          SUM(historico_cargos_pms.reteiva) AS cargocre,
          if(historico_cargos_pms.cargo_anulado = 0,'N','S') as anulado,
          retenciones.codigoPuc as cuenta_puc,
          retenciones.descripcionRetencion as descripcion_cargo,
          4 as tipo_codigo,
          retenciones.descripcionRetencion as descripcion_contable,
          '03' as centroCosto,
          factura_numero,
          fecha_factura,
          diasCredito,
          referencia_cargo,
          YEAR(fecha_factura) AS anio
        FROM
          historico_cargos_pms
        INNER JOIN 
          companias ON id_compania = historico_cargos_pms.id_perfil_factura
        INNER JOIN  
          codigos_vta ON codigos_vta.id_cargo = historico_cargos_pms.id_codigo_cargo
        INNER JOIN  
          retenciones ON retenciones.idRetencion = 2
        WHERE
          historico_cargos_pms.perfil_factura = 1 AND
          historico_cargos_pms.tipo_factura < 3 AND
          historico_cargos_pms.fecha_factura BETWEEN '2024-11-01' AND '2024-11-30'
          AND historico_cargos_pms.reteiva > 0
        GROUP BY
          factura_numero,
          descripcion_cargo)
      UNION ALL
    (SELECT
      0 AS cargodeb,
      SUM(historico_cargos_pms.reteica) AS cargocre,
      if(historico_cargos_pms.cargo_anulado = 0,'N','S') as anulado,
      retenciones.codigoPuc as cuenta_puc,
      retenciones.descripcionRetencion as descripcion_cargo,
      4 as tipo_codigo,
      retenciones.descripcionRetencion as descripcion_contable,
      '03' as centroCosto,
      factura_numero,
      fecha_factura,
      diasCredito,
      referencia_cargo,
      YEAR(fecha_factura) AS anio
      FROM
        historico_cargos_pms
      INNER JOIN 
        companias ON id_compania = historico_cargos_pms.id_perfil_factura
      INNER JOIN  
        codigos_vta ON codigos_vta.id_cargo = historico_cargos_pms.id_codigo_cargo
      INNER JOIN  
        retenciones ON retenciones.idRetencion = 3
      WHERE
        historico_cargos_pms.perfil_factura = 1 AND
        historico_cargos_pms.tipo_factura < 3 AND
        historico_cargos_pms.fecha_factura BETWEEN '2024-11-01' AND '2024-11-30'
        AND historico_cargos_pms.reteiva > 0
      GROUP BY
        factura_numero,
        descripcion_cargo)
    ORDER BY 
    factura_numero ASC, 
    tipo_codigo ASC,
    descripcion_cargo ASC";


$cursor2 = "SELECT
    0 AS cargodeb,
    SUM(historico_cargos_pms.reteica) AS cargocre,
    if(historico_cargos_pms.cargo_anulado = 0,'N','S') as anulado,
    retenciones.codigoPuc as cuenta_puc,
    retenciones.descripcionRetencion as descripcion_cargo,
    4 as tipo_codigo,
    retenciones.descripcionRetencion as descripcion_contable,
    '03' as centroCosto,
    factura_numero,
    fecha_factura,
    diasCredito,
    referencia_cargo,
    YEAR(fecha_factura) AS anio
  FROM
    historico_cargos_pms
  INNER JOIN 
    companias ON id_compania = historico_cargos_pms.id_perfil_factura
  INNER JOIN  
    codigos_vta ON codigos_vta.id_cargo = historico_cargos_pms.id_codigo_cargo
  INNER JOIN  
    retenciones ON retenciones.idRetencion = 3
  WHERE
    historico_cargos_pms.perfil_factura = 1 AND
    historico_cargos_pms.tipo_factura < 3 AND
    historico_cargos_pms.fecha_factura BETWEEN '2024-11-01' AND '2024-11-30'
    AND historico_cargos_pms.reteiva > 0
  GROUP BY
    factura_numero,
    descripcion_cargo
  ORDER BY 
    factura_numero ASC, 
    descripcion_cargo ASC";


// echo $cursor;


$consulta = "WITH factura_info AS (
  SELECT DISTINCT
      hc.factura_numero,
      hc.tipo_factura,
      hc.fecha_factura,
      hc.diasCredito,
      hc.referencia_cargo,
    	ciudades.codigo,
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
          WHEN hc.tipo_factura = 1 THEN h.direccion
          WHEN hc.tipo_factura = 2 THEN c.direccion
          ELSE NULL
      END AS direccion
  FROM 
      historico_cargos_pms hc
  LEFT JOIN 
      huespedes h ON hc.id_perfil_factura = h.id_huesped AND hc.tipo_factura = 1
  LEFT JOIN 
      companias c ON hc.id_perfil_factura = c.id_compania AND hc.tipo_factura = 2
  INNER JOIN
	  ciudades ON h.ciudad = ciudades.id_ciudad
  WHERE 
      hc.perfil_factura = 1 AND
      hc.factura = 1 AND
      hc.tipo_factura < 3 AND
      hc.fecha_factura BETWEEN '2024-11-01' AND '2024-11-30'
)
SELECT 
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
      SUM(CASE WHEN tipo = 'cargo' THEN monto ELSE 0 END) AS cargodeb,
      SUM(CASE WHEN tipo != 'cargo' THEN monto ELSE 0 END) AS cargocre,
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
          'cargo' AS tipo,
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
            'impuesto' AS tipo,
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
    d.tipo_codigo ASC,
    d.descripcion_cargo ASC;";




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





$respData = $hotel->creaConsulta($sub);


echo print_r($respData);
