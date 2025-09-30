<?php

// require '../../../res/php/titles.php';
require '../../../res/php/app_topHotel.php';

$desdeFe = $_POST['desdeFe'];
$hastaFe = $_POST['hastaFe'];
$codigo = $_POST['codigo'];

$sele = "SELECT 
  codigos_vta.id_cargo, 
  codigos_vta.descripcion_cargo, 
  historico_reservas_pms.fecha_llegada,
  historico_reservas_pms.fecha_salida,
  historico_reservas_pms.num_reserva,
  historico_reservas_pms.num_habitacion,
  huespedes.nombre_completo,
  historico_cargos_pms.monto_cargo,
  historico_cargos_pms.base_impuesto,
  historico_cargos_pms.impuesto,
  historico_cargos_pms.fecha_cargo,
  historico_cargos_pms.valor_cargo,
  historico_cargos_pms.cargo_anulado,
  historico_cargos_pms.motivo_anulacion,
  historico_cargos_pms.fecha_anulacion,
  historico_cargos_pms.factura_numero,
  historico_cargos_pms.fecha_sistema_cargo FROM huespedes, historico_cargos_pms, historico_reservas_pms, codigos_vta WHERE ";

$filtro = "huespedes.id_huesped = historico_reservas_pms.id_huesped AND historico_cargos_pms.numero_reserva = historico_reservas_pms.num_reserva AND huespedes.id_huesped = historico_cargos_pms.id_huesped AND codigos_vta.id_cargo = historico_cargos_pms.id_codigo_cargo AND codigos_vta.tipo_codigo = 1";

$sele2 = " ORDER BY historico_cargos_pms.fecha_cargo";

if ($desdeFe != '' && $hastaFe != '') {
  $filtro = $filtro . " AND fecha_cargo >='$desdeFe' AND fecha_cargo <= '$hastaFe'";
} elseif ($desdeFe == '' && $hastaFe != '') {
  $filtro = $filtro . " AND fecha_cargo <= '$hastaFe'";
} elseif ($desdeFe != '' && $hastaFe == '') {
  $filtro = $filtro . " AND fecha_cargo = '$desdeFe'";
}

if ($codigo != '') {
  $filtro = $filtro . " AND id_codigo_cargo = '$codigo'";
}

$query    = $sele . $filtro . $sele2;

$facturas = $hotel->getFacturasPorRango($query);
$exportas = $facturas;
?>


        <?php
        foreach ($facturas as $factura) { ?>
          <tr style='font-size:12px'>
            <td style="padding:3px 5px"><?php echo $factura['fecha_cargo']; ?></td>
            <td style="padding:3px 5px;width:20%;"><?php echo $factura['descripcion_cargo']; ?></td>
            <td style="padding:3px 5px;text-align: right;"><?php echo number_format($factura['monto_cargo'], 2); ?></td>
            <td style="padding:3px 5px;text-align: right;"><?php echo number_format($factura['impuesto'], 2); ?></td>
            <td style="padding:3px 5px;text-align: right;"><?php echo number_format($factura['valor_cargo'], 2); ?></td>
            <td style="padding:3px 5px;text-align: right;width:7%;"><?php echo $factura['num_habitacion']; ?></td>
            <td style="text-align: left;width:25%;"> <?= substr($factura['nombre_completo'], 0, 30); ?></td>
            <td style="text-align: right;"> <?= ($factura['factura_numero']); ?></td>

          </tr>
        <?php
        }
        ?>
      