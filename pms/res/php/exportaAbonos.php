<?php
require_once '../../../res/php/titles.php';
require_once '../../../res/php/app_topHotel.php';
$postBody = json_decode(file_get_contents('php://input'), true);
extract($postBody);

/* $query01 = "SELECT 1 as empresa, year(fecha_cargo) as anio, 50 as tipo,	historico_cargos_pms.concecutivo_abono, historico_cargos_pms.fecha_cargo, 'ANTICIPO CLIENTE' AS descripcion_cargo, if(historico_cargos_pms.cargo_anulado = 0,'N','S') as anulado, 'CONTABILIDAD' as aplicacion, 1 as codigoe, year(fecha_cargo) as anios, 50 as tipos, historico_cargos_pms.concecutivo_abono as numerod, codigos_vta.cuenta_cruce AS cuenta_puc, 2 AS conce, historico_cargos_pms.fecha_cargo as fechadoc, codigos_vta.centroCosto, huespedes.identificacion, '' as dv, huespedes.apellido1, huespedes.apellido2, huespedes.nombre1, huespedes.nombre2, '' as razon, '50' as depto, '001' as ciudad, huespedes.direccion, huespedes.telefono, huespedes.sexo, historico_cargos_pms.referencia_cargo, 'ANTICIPO CLIENTE' AS descripcion_contable, 0 AS pagosdeb, historico_cargos_pms.pagos_cargos AS pagoscre, historico_cargos_pms.concecutivo_abono as subtipo, '' as subnumero, '' as fechacon, historico_cargos_pms.pagos_cargos AS total FROM historico_cargos_pms, codigos_vta, huespedes WHERE historico_cargos_pms.id_huesped = huespedes.id_huesped AND historico_cargos_pms.perfil_factura = 1 AND codigos_vta.id_cargo = historico_cargos_pms.id_codigo_cargo AND historico_cargos_pms.fecha_cargo BETWEEN '$desde' AND '$hasta'  AND concecutivo_abono > 0 UNION SELECT 1 as empresa, year(fecha_cargo) as anio, 50 as tipo, historico_cargos_pms.concecutivo_abono, historico_cargos_pms.fecha_cargo, codigos_vta.descripcion_cargo, if(historico_cargos_pms.cargo_anulado = 0,'N','S') as anulado, 'CONTABILIDAD' as aplicacion, 1 as codigoe, year(fecha_cargo) as anios, 50 as tipos,	historico_cargos_pms.concecutivo_abono as numerod, codigos_vta.cuenta_puc AS cuenta_puc, 1 AS conce, historico_cargos_pms.fecha_cargo as fechadoc, codigos_vta.centroCosto, huespedes.identificacion, '' as dv, huespedes.apellido1, huespedes.apellido2, huespedes.nombre1, huespedes.nombre2, '' as razon, '50' as depto, '001' as ciudad, huespedes.direccion, huespedes.telefono, huespedes.sexo, historico_cargos_pms.referencia_cargo, codigos_vta.descripcion_contable, historico_cargos_pms.pagos_cargos AS pagosdeb, 0 AS pagoscre, historico_cargos_pms.concecutivo_abono as subtipo, '' as subnumero, '' as fechacon, historico_cargos_pms.pagos_cargos AS total FROM historico_cargos_pms, codigos_vta, huespedes WHERE historico_cargos_pms.id_huesped = huespedes.id_huesped  AND historico_cargos_pms.perfil_factura = 1 AND codigos_vta.id_cargo = historico_cargos_pms.id_codigo_cargo AND historico_cargos_pms.fecha_cargo BETWEEN '$desde' AND '$hasta'  AND concecutivo_abono > 0 ORDER BY concecutivo_abono ASC, conce ASC "; */

$query = "SELECT
    1 AS empresa,
    YEAR(hcp.fecha_cargo) AS anio,
    50 AS tipo,
    hcp.concecutivo_abono,
    hcp.fecha_cargo,
    'ANTICIPO CLIENTE' AS descripcion_cargo,
    IF(hcp.cargo_anulado = 0, 'N', 'S') AS anulado,
    'CONTABILIDAD' AS aplicacion,
    1 AS codigoe,
    YEAR(hcp.fecha_cargo) AS anios,
    50 AS tipos,
    hcp.concecutivo_abono AS numerod,
    cv.cuenta_cruce AS cuenta_puc, -- Cuenta de cruce para abonos
    2 AS conce, -- Concepto 2 para abonos (créditos)
    hcp.fecha_cargo AS fechadoc,
    cv.centroCosto,
    h.identificacion,
    '' AS dv,
    h.apellido1,
    h.apellido2,
    h.nombre1,
    h.nombre2,
    '' AS razon,
    '50' AS depto,
    '001' AS ciudad,
    h.direccion,
    h.telefono,
    h.sexo,
    hcp.referencia_cargo,
    'ANTICIPO CLIENTE' AS descripcion_contable,
    0 AS pagosdeb, -- Débitos 0 para abonos
    hcp.pagos_cargos AS pagoscre, -- Créditos con el valor del cargo
    hcp.concecutivo_abono AS subtipo,
    '' AS subnumero,
    '' AS fechacon,
    hcp.pagos_cargos AS total
FROM
    historico_cargos_pms AS hcp
JOIN
    codigos_vta AS cv ON cv.id_cargo = hcp.id_codigo_cargo
JOIN
    huespedes AS h ON hcp.id_huesped = h.id_huesped
WHERE
    hcp.perfil_factura = 1
    AND hcp.fecha_cargo BETWEEN '$desde' AND '$hasta'
    AND hcp.concecutivo_abono > 0

UNION ALL

SELECT
    1 AS empresa,
    YEAR(hcp.fecha_cargo) AS anio,
    50 AS tipo,
    hcp.concecutivo_abono,
    hcp.fecha_cargo,
    cv.descripcion_cargo,
    IF(hcp.cargo_anulado = 0, 'N', 'S') AS anulado,
    'CONTABILIDAD' AS aplicacion,
    1 AS codigoe,
    YEAR(hcp.fecha_cargo) AS anios,
    50 AS tipos,
    hcp.concecutivo_abono AS numerod,
    cv.cuenta_puc AS cuenta_puc, -- Cuenta PUC para cargos
    1 AS conce, -- Concepto 1 para cargos (débitos)
    hcp.fecha_cargo AS fechadoc,
    cv.centroCosto,
    h.identificacion,
    '' AS dv,
    h.apellido1,
    h.apellido2,
    h.nombre1,
    h.nombre2,
    '' AS razon,
    '50' AS depto,
    '001' AS ciudad,
    h.direccion,
    h.telefono,
    h.sexo,
    hcp.referencia_cargo,
    cv.descripcion_contable,
    hcp.pagos_cargos AS pagosdeb, -- Débitos con el valor del cargo
    0 AS pagoscre, -- Créditos 0 para cargos
    hcp.concecutivo_abono AS subtipo,
    '' AS subnumero,
    '' AS fechacon,
    hcp.pagos_cargos AS total
FROM
    historico_cargos_pms AS hcp
JOIN
    codigos_vta AS cv ON cv.id_cargo = hcp.id_codigo_cargo
JOIN
    huespedes AS h ON hcp.id_huesped = h.id_huesped
WHERE
    hcp.perfil_factura = 1
    AND hcp.fecha_cargo BETWEEN '$desde' AND '$hasta'
    AND hcp.concecutivo_abono > 0

UNION ALL

SELECT
    1 AS empresa,
    YEAR(cp.fecha_cargo) AS anio,
    50 AS tipo,
    cp.concecutivo_abono,
    cp.fecha_cargo,
    'ANTICIPO CLIENTE' AS descripcion_cargo,
    IF(cp.cargo_anulado = 0, 'N', 'S') AS anulado,
    'CONTABILIDAD' AS aplicacion,
    1 AS codigoe,
    YEAR(cp.fecha_cargo) AS anios,
    50 AS tipos,
    cp.concecutivo_abono AS numerod,
    cv.cuenta_cruce AS cuenta_puc, -- Cuenta de cruce para abonos
    2 AS conce, -- Concepto 2 para abonos (créditos)
    cp.fecha_cargo AS fechadoc,
    cv.centroCosto,
    h.identificacion,
    '' AS dv,
    h.apellido1,
    h.apellido2,
    h.nombre1,
    h.nombre2,
    '' AS razon,
    '50' AS depto,
    '001' AS ciudad,
    h.direccion,
    h.telefono,
    h.sexo,
    cp.referencia_cargo,
    'ANTICIPO CLIENTE' AS descripcion_contable,
    0 AS pagosdeb, -- Débitos 0 para abonos
    cp.pagos_cargos AS pagoscre, -- Créditos con el valor del cargo
    cp.concecutivo_abono AS subtipo,
    '' AS subnumero,
    '' AS fechacon,
    cp.pagos_cargos AS total
FROM
    cargos_pms AS cp
JOIN
    codigos_vta AS cv ON cv.id_cargo = cp.id_codigo_cargo
JOIN
    huespedes AS h ON cp.id_huesped = h.id_huesped
WHERE
    cp.fecha_cargo BETWEEN '$desde' AND '$hasta'
    AND cp.concecutivo_abono > 0

UNION ALL

SELECT
    1 AS empresa,
    YEAR(cp.fecha_cargo) AS anio,
    50 AS tipo,
    cp.concecutivo_abono,
    cp.fecha_cargo,
    cv.descripcion_cargo,
    IF(cp.cargo_anulado = 0, 'N', 'S') AS anulado,
    'CONTABILIDAD' AS aplicacion,
    1 AS codigoe,
    YEAR(cp.fecha_cargo) AS anios,
    50 AS tipos,
    cp.concecutivo_abono AS numerod,
    cv.cuenta_puc AS cuenta_puc, -- Cuenta PUC para cargos
    1 AS conce, -- Concepto 1 para cargos (débitos)
    cp.fecha_cargo AS fechadoc,
    cv.centroCosto,
    h.identificacion,
    '' AS dv,
    h.apellido1,
    h.apellido2,
    h.nombre1,
    h.nombre2,
    '' AS razon,
    '50' AS depto,
    '001' AS ciudad,
    h.direccion,
    h.telefono,
    h.sexo,
    cp.referencia_cargo,
    cv.descripcion_contable,
    cp.pagos_cargos AS pagosdeb, -- Débitos con el valor del cargo
    0 AS pagoscre, -- Créditos 0 para cargos
    cp.concecutivo_abono AS subtipo,
    '' AS subnumero,
    '' AS fechacon,
    cp.pagos_cargos AS total
FROM
    cargos_pms AS cp
JOIN
    codigos_vta AS cv ON cv.id_cargo = cp.id_codigo_cargo
JOIN
    huespedes AS h ON cp.id_huesped = h.id_huesped
WHERE
cp.fecha_cargo BETWEEN '$desde' AND '$hasta'
    AND cp.concecutivo_abono > 0" ;

$facturas = $hotel->getFacturasPorRango($query);
$vacio = '';

if (count($facturas) == 0) {
  echo '1';
} else {
  ?>
  <tbody>
    <?php
    $numero = 0;
    foreach ($facturas as $factura) {
    ?>
      <tr>
        <td><?php echo $factura['empresa']; ?></td>
        <td><?php echo $factura['anio']; ?></td>
        <td><?php echo $factura['tipo']; ?></td>
        <td><?php echo $factura['concecutivo_abono']; ?></td>
        <td><?php echo substr($factura['fecha_cargo'], 8, 2) . '/' . substr($factura['fecha_cargo'], 5, 2) . '/' . substr($factura['fecha_cargo'], 0, 4); ?></td>
        <td><?php echo $factura['descripcion_cargo']; ?></td>
        <td><?php echo $factura['anulado']; ?></td>
        <td><?php echo $factura['aplicacion']; ?></td>
        <td><?php echo $factura['codigoe']; ?></td>
        <td><?php echo $factura['anios']; ?></td>
        <td><?php echo $factura['tipos']; ?></td>
        <td><?php echo $factura['numerod']; ?></td>
        <td><?php echo $factura['cuenta_puc']; ?></td>
        <td><?php echo $factura['conce']; ?></td>
        <td><?php echo substr($factura['fecha_cargo'], 8, 2) . '/' . substr($factura['fecha_cargo'], 5, 2) . '/' . substr($factura['fecha_cargo'], 0, 4); ?></td>
        <td><?php echo $factura['centroCosto']; ?></td>
        <td><?php echo $factura['identificacion']; ?></td>
        <td><?php echo $factura['dv']; ?></td>
        <td><?php echo $factura['apellido1']; ?></td>
        <td><?php echo $factura['apellido2']; ?></td>
        <td><?php echo $factura['nombre1']; ?></td>
        <td><?php echo $factura['nombre2']; ?></td>
        <td><?php echo $factura['razon']; ?></td>
        <td><?php echo $factura['depto']; ?></td>
        <td><?php echo $factura['ciudad']; ?></td>
        <td><?php echo $factura['direccion']; ?></td>
        <td><?php echo $factura['telefono']; ?></td>
        <td><?php echo $factura['sexo']; ?></td>
        <td><?php echo $factura['referencia_cargo']; ?></td>
        <td><?php echo $factura['descripcion_contable']; ?></td>
        <td style="text-align:right;">
          <?php echo round($factura['pagosdeb'], 0); ?>
        </td>
        <td style="text-align:right;">
          <?php echo $factura['pagoscre']; ?>
        </td>
        <td><?php echo $factura['subtipo']; ?></td>
        <td><?php echo $factura['subnumero']; ?></td>
        <td><?php echo $factura['fechacon']; ?></td>
        <td style="text-align:right;">
          <?php echo round($factura['total'], 0); ?>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
<?php
}
?>