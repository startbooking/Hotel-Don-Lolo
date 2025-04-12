<?php
require_once '../../../res/php/titles.php';
require_once '../../../res/php/app_topHotel.php';
$postBody = json_decode(file_get_contents('php://input'), true);
extract($postBody);

$query = "SELECT 1 as empresa, year(fecha_cargo) as anio, 50 as tipo,	historico_cargos_pms.concecutivo_abono, historico_cargos_pms.fecha_cargo, 'ANTICIPO CLIENTE' AS descripcion_cargo, if(historico_cargos_pms.cargo_anulado = 0,'N','S') as anulado, 'CONTABILIDAD' as aplicacion, 1 as codigoe, year(fecha_cargo) as anios, 50 as tipos, historico_cargos_pms.concecutivo_abono as numerod, codigos_vta.cuenta_cruce AS cuenta_puc, 2 AS conce, historico_cargos_pms.fecha_cargo as fechadoc, codigos_vta.centroCosto, huespedes.identificacion, '' as dv, huespedes.apellido1, huespedes.apellido2, huespedes.nombre1, huespedes.nombre2, '' as razon, '50' as depto, '001' as ciudad, huespedes.direccion, huespedes.telefono, huespedes.sexo, historico_cargos_pms.referencia_cargo, 'ANTICIPO CLIENTE' AS descripcion_contable, 0 AS pagosdeb, historico_cargos_pms.pagos_cargos AS pagoscre, historico_cargos_pms.concecutivo_abono as subtipo, '' as subnumero, '' as fechacon, historico_cargos_pms.pagos_cargos AS total FROM historico_cargos_pms, codigos_vta, huespedes WHERE historico_cargos_pms.id_huesped = huespedes.id_huesped AND historico_cargos_pms.perfil_factura = 1 AND codigos_vta.id_cargo = historico_cargos_pms.id_codigo_cargo AND historico_cargos_pms.fecha_cargo BETWEEN '$desde' AND '$hasta'  AND concecutivo_abono > 0 UNION SELECT 1 as empresa, year(fecha_cargo) as anio, 50 as tipo, historico_cargos_pms.concecutivo_abono, historico_cargos_pms.fecha_cargo, codigos_vta.descripcion_cargo, if(historico_cargos_pms.cargo_anulado = 0,'N','S') as anulado, 'CONTABILIDAD' as aplicacion, 1 as codigoe, year(fecha_cargo) as anios, 50 as tipos,	historico_cargos_pms.concecutivo_abono as numerod, codigos_vta.cuenta_puc AS cuenta_puc, 1 AS conce, historico_cargos_pms.fecha_cargo as fechadoc, codigos_vta.centroCosto, huespedes.identificacion, '' as dv, huespedes.apellido1, huespedes.apellido2, huespedes.nombre1, huespedes.nombre2, '' as razon, '50' as depto, '001' as ciudad, huespedes.direccion, huespedes.telefono, huespedes.sexo, historico_cargos_pms.referencia_cargo, codigos_vta.descripcion_contable, historico_cargos_pms.pagos_cargos AS pagosdeb, 0 AS pagoscre, historico_cargos_pms.concecutivo_abono as subtipo, '' as subnumero, '' as fechacon, historico_cargos_pms.pagos_cargos AS total FROM historico_cargos_pms, codigos_vta, huespedes WHERE historico_cargos_pms.id_huesped = huespedes.id_huesped  AND historico_cargos_pms.perfil_factura = 1  AND codigos_vta.id_cargo = historico_cargos_pms.id_codigo_cargo AND historico_cargos_pms.fecha_cargo BETWEEN '$desde' AND '$hasta'  AND concecutivo_abono > 0 ORDER BY concecutivo_abono ASC, conce ASC ";

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