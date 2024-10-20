<?php

require '../../../res/php/titles.php';
require '../../../res/php/app_topHotel.php';

$eToken = $hotel->datosTokenCia();
$facturador = $eToken[0]['facturador'];
extract($_POST);

if ($empresa != '') {
  $sele = "SELECT
	historico_cargos_pms.descripcion_cargo,
	historico_cargos_pms.tipo_factura,
	historico_cargos_pms.id_codigo_cargo,
	historico_cargos_pms.id_perfil_factura,
	historico_cargos_pms.perfil_factura,
	historico_cargos_pms.factura_numero,
	historico_cargos_pms.factura_anulada,
	historico_cargos_pms.total_consumos,
	historico_cargos_pms.total_impuesto,
	historico_cargos_pms.total_pagos,
	historico_cargos_pms.fecha_factura,
	month(historico_cargos_pms.fecha_factura) as mes,
	historico_cargos_pms.prefijo_factura,
	historico_cargos_pms.numero_reserva,
	historico_cargos_pms.numero_factura_cargo,
	historicoDatosFE.cufe,
	historicoDatosFE.estadoEnvio,
	huespedes.nombre_completo,
	companias.empresa
FROM
	historico_cargos_pms,
	historicoDatosFE,
	huespedes, 
	companias  
WHERE";

  $filtro = " historico_cargos_pms.fecha_factura BETWEEN '$desdeFe' 
	AND '$hastaFe' 
	AND historico_cargos_pms.factura = 1 
	AND historico_cargos_pms.tipo_factura < 3 
	AND historico_cargos_pms.factura_numero = historicoDatosFE.facturaNumero 
	AND historico_cargos_pms.id_huesped = huespedes.id_huesped
	AND historico_cargos_pms.id_perfil_factura = companias.id_compania
	AND companias.empresa LIKE '%$empresa%'";
} else {
  $sele = "SELECT
	historico_cargos_pms.descripcion_cargo,
	historico_cargos_pms.tipo_factura,
	historico_cargos_pms.id_codigo_cargo,
	historico_cargos_pms.id_perfil_factura,
	historico_cargos_pms.perfil_factura,
	historico_cargos_pms.factura_numero,
	historico_cargos_pms.factura_anulada,
	historico_cargos_pms.total_consumos,
	historico_cargos_pms.total_impuesto,
	historico_cargos_pms.total_pagos,
	historico_cargos_pms.fecha_factura,
	month(historico_cargos_pms.fecha_factura) as mes,
  historico_cargos_pms.prefijo_factura,
  historico_cargos_pms.numero_reserva,
  historico_cargos_pms.numero_factura_cargo,
	historicoDatosFE.cufe,
	historicoDatosFE.estadoEnvio,
	huespedes.nombre_completo
FROM
	historico_cargos_pms,
	historicoDatosFE,
	huespedes
WHERE ";
  $filtro = "historico_cargos_pms.fecha_factura BETWEEN '$desdeFe' 
	AND '$hastaFe' 
	AND historico_cargos_pms.factura = 1 
	AND historico_cargos_pms.tipo_factura < 3 
	AND historico_cargos_pms.factura_numero = historicoDatosFE.facturaNumero 
	and historico_cargos_pms.id_huesped = huespedes.id_huesped";
}

$orden = " ORDER BY historico_cargos_pms.factura_numero";

if ($desdeFe != '' && $hastaFe != '') {
  // $filtro = $filtro . " AND historico.fecha_factura >='$desdeFe' AND fecha_factura <= '$hastaFe'";
} elseif ($desdeFe == '' && $hastaFe != '') {
  $filtro = $filtro . " AND historico_cargos_pms.fecha_factura <= '$hastaFe'";
} elseif ($desdeFe != '' && $hastaFe == '') {
  $filtro = $filtro . " AND historico_cargos_pms.fecha_factura >= '$desdeFe'";
}

if ($desdeNu != '' && $hastaNu != '') {
  $filtro = $filtro . " AND historico_cargos_pms.factura_numero >='$desdeNu' AND historico_cargos_pms.factura_numero <= '$hastaNu'";
} elseif ($desdeNu == '' && $hastaNu != '') {
  $filtro = $filtro . " AND historico_cargos_pms.factura_numero <= '$hastaNu'";
} elseif ($desdeNu != '' && $hastaNu == '') {
  $filtro = $filtro . " AND historico_cargos_pms.factura_numero = '$desdeNu'";
}

if ($huesped != '') {
  $filtro = $filtro . " AND nombre_completo LIKE '%$huesped%'";
}

if ($empresa != '') {
  $filtro = $filtro . " AND empresa LIKE '%$empresa%'";
}

if ($formaPa != '') {
  $filtro = $filtro . " AND id_codigo_cargo = '$formaPa'";
}

$query    = $sele . $filtro . $orden;
$facturas = $hotel->getFacturasPorRango($query);

?>

<div class="table-responsive" style="padding:0">
  <div class="row-fluid" style="padding:0">
    <table id="example1" class="table table-bordered">
      <thead>
        <tr class="warning centro b500">
          <td>Factura</td>
          <td>Facturado A</td>
          <td>Huesped</td>
          <td>Fecha Factura</td>
          <td>Forma de Pago</td>
          <td>Valor</td>
          <td>Impuesto</td>
          <td>Pago</td>
          <td>Estado</td>
          <?php
          if ($facturador == 1) { ?>
            <td>Estado DIAN</td>
          <?php
          }
          ?>
          <td>Accion</td>
        </tr>
      </thead>
      <tbody>
        <?php
        $totalFac = 0;
        $totalCon = 0;
        $totalImp = 0;
        foreach ($facturas as $factura) {
          if ($factura['tipo_factura'] == 2) {
            $cias = $hotel->getBuscaCia($factura['id_perfil_factura']);
            $nombrecia = $cias[0]['empresa'];
            $nitcia = $cias[0]['nit'] . '-' . $cias[0]['dv'];
          }
          if ($factura['factura_anulada'] == '0') {
            $totalFac = $totalFac + $factura['total_pagos'];
            $totalCon = $totalCon + $factura['total_consumos'];
            $totalImp = $totalImp + $factura['total_impuesto'];
          }
        ?>
          <tr style='font-size:11px'>
            <td style="padding:3px 5px"><?php echo $factura['factura_numero']; ?></td>
            <td style="padding:3px 5px;text-align: left;">
              <?php
              if ($factura['tipo_factura'] == 1) {
                echo $factura['nombre_completo'];
              } else {
                echo $nombrecia;
              } ?>
            </td>
            <td style="padding:3px 5px"><?php echo $factura['nombre_completo']; ?></td>
            <td style="padding:3px 5px"><?php echo $factura['fecha_factura']; ?></td>
            <td style="padding:3px 5px"><?php echo $factura['descripcion_cargo']; ?></td>
            <td style="text-align: right;"> <?= number_format($factura['total_consumos'], 2); ?></td>
            <td style="text-align: right;"><?= number_format($factura['total_impuesto'], 2); ?></td>
            <td style="text-align: right;"><?= number_format($factura['total_pagos'], 2); ?></td>
            <td style="padding:3px 5px;text-align:center;">
              <?php echo estadoFactura($factura['factura_anulada']); ?>
            </td>
            <?php
            if ($facturador == 1) { ?>
              <td style="padding:3px 5px">
                <?php
                echo estadoFacturaDIAN($factura['estadoEnvio']);
                ?>
              </td>
            <?php
            }
            ?>
            <td style="padding:3px 5px;width: 12%;text-align:center;">
              <button class="btn btn-info btn-xs" type="button" data-toggle="modal" data-tipo="0" data-facturador="<?php echo $facturador; ?>" data-fechafac="<?php echo $factura['fecha_factura']; ?>" data-numero="<?php echo $factura['factura_numero']; ?>" data-reserva="<?php echo $factura['numero_reserva']; ?>" href="#myModalVerFactura" title="Ver Factura">
                <i class="fa fa-file-pdf" aria-hidden="true"></i>
              </button>
              <?php
              if ($factura['factura_anulada'] == 0) {
                if ($factura['mes'] == intval($mes)  && $tipo <= 1) { ?>
                  <a class="btn btn-danger btn-xs btnAdiciona" data-toggle="modal" data-facturador="<?php echo $facturador; ?>" data-fechafac="<?php echo $factura['fecha_factura']; ?>" data-numero="<?php echo $factura['factura_numero']; ?>" data-reserva="<?php echo $factura['numero_reserva']; ?>" data-perfil="<?php echo $factura['perfil_factura']; ?>" data-idperfil="<?php echo $factura['id_perfil_factura']; ?>" data-prefijo="<?php echo $factura['prefijo_factura']; ?>" data-nombre="<?php echo $factura['nombre_completo']; ?>" href="#myModalAnulaFacturaHistorico" type="button" title="Anular Factura">
                    <i class="fa fa-window-close" aria-hidden="true"></i>
                  </a>
                <?php
                } else if ($tipo <= 1 && $contador == 1) { ?>
                  <a class="btn btn-danger btn-xs btnAdiciona" data-toggle="modal" data-facturador="<?php echo $facturador; ?>" data-fechafac="<?php echo $factura['fecha_factura']; ?>" data-numero="<?php echo $factura['factura_numero']; ?>" data-reserva="<?php echo $factura['numero_reserva']; ?>" data-perfil="<?php echo $factura['perfil_factura']; ?>" data-idperfil="<?php echo $factura['id_perfil_factura']; ?>" data-prefijo="<?php echo $factura['prefijo_factura']; ?>" data-nombre="<?php echo $factura['nombre_completo']; ?>" href="#myModalAnulaFacturaHistorico" type="button" title="Anular Factura">
                    <i class="fa fa-window-close" aria-hidden="true"></i>
                  </a>

                <?php
                }
              } else { ?>
                <button class="btn btn-success btn-xs" type="button" data-toggle="modal" data-tipo="1" data-facturador="<?php echo $facturador; ?>" data-numero="<?php echo $factura['numero_factura_cargo']; ?>" data-reserva="<?php echo $factura['numero_reserva']; ?>" href="#myModalVerFactura" title="Ver Nota Credito">
                  <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                </button>
              <?php
              }
              ?>
              <button class="btn btn-primary btn-xs" onclick="event.preventDefault();DonwloadFile('<?php echo $factura['prefijo_factura'] . $factura['factura_numero']; ?>','<?php echo NIT; ?>','zip');" type="button" title="Descarga ZIP Attached">
                <i class="fa-solid fa-file-zipper"></i>
              </button>
              <button class="btn btn-warning btn-xs" onclick="event.preventDefault();facturaDetalladaHistorico('<?php echo $factura['prefijo_factura'] ?>','<?php echo $factura['factura_numero']; ?>');" type="button" title="Imprimir Factura Detallada">
                <i class="fa-solid fa-bars"></i>
              </button>
            </td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
    <table id="tablaFacturas" class="table table-bordered" style="display:none">
      <thead>
        <tr class="warning">
          <td>Factura</td>
          <?php
          if ($empresa != '') { ?>
            <td>Empresa</td>
          <?php
          } else { ?>
          <?php
          }
          ?>
          <td>Huesped</td>
          <td>Fecha Factura</td>
          <td>Forma de Pago</td>
          <td>Valor</td>
          <td>Impuesto</td>
          <td>Pago</td>
          <td>Estado</td>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($facturas as $factura) { ?>
          <tr style='font-size:12px'>
            <td style="padding:3px 5px"><?php echo $factura['factura_numero']; ?></td>
            <?php
            if ($empresa != '') { ?>
              <td style="padding:3px 5px;text-align: left;"><?php echo $factura['empresa']; ?></td>
            <?php
            } else {
            ?>
            <?php
            }
            ?>
            <td style="padding:3px 5px;text-align: left;"><?php echo $factura['nombre_completo']; ?></td>
            <td style="padding:3px 5px"><?php echo $factura['fecha_factura']; ?></td>
            <td style="padding:3px 5px"><?php echo $factura['descripcion_cargo']; ?></td>
            <td style="text-align: right;"> <?= number_format($factura['total_consumos'], 2); ?></td>
            <td style="text-align: right;"><?= number_format($factura['total_impuesto'], 2); ?></td>
            <td style="text-align: right;"><?= number_format($factura['total_pagos'], 2); ?></td>
            <td style="padding:3px 5px"><?php echo estadoFactura($factura['factura_anulada']); ?></td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
    <!-- <div class="col-lg-6" style="padding:0">
    </div>
    <div class="col-lg-6" id="muestraFactura" style="padding :0">
      <object id="verFactura" width="100%" height="500" data=""></object>
    </div> -->
  </div>
  <div class="row-fluid" style="padding:0">
    <table id="dataTable" class="table table-bordered">
      <thead>
        <tr class="derecha">
          <td>Total Consumos</td>
          <td><?php echo number_format($totalCon, 2) ?></td>
          <td>Total Impuestos</td>
          <td><?php echo number_format($totalImp, 2) ?></td>
          <td>Total Facturas</td>
          <td><?php echo number_format($totalFac, 2) ?></td>
          <td></td>
          <td></td>
        </tr>
      </thead>
    </table>
  </div>

</div>

<script>
  $(function() {
    $('#example1').DataTable({
      "iDisplayLength": 50,
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "language": {
        "next": "Siguiente",
        "search": "Buscar:",
        "entries": "registros"
      },
    });
  });
</script>