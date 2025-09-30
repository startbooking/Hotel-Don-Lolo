<?php

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
  
  $desdeFe = $_POST['desdeFe']; 
  $hastaFe = $_POST['hastaFe'];
  $desdeNu = $_POST['desdeNu'];
  $hastaNu = $_POST['hastaNu'];
  $huesped = $_POST['huesped'];
  $formaPa = $_POST['formaPa'];

  $sele = "SELECT 
  codigos_vta.id_cargo, 
  codigos_vta.descripcion_cargo, 
  historico_reservas_pms.fecha_llegada,
  historico_reservas_pms.fecha_salida,
  historico_reservas_pms.num_reserva,
  historico_reservas_pms.num_habitacion,
  huespedes.nombre_completo,
  historico_cargos_pms.prefijo_factura,
  historico_cargos_pms.factura_numero,
  historico_cargos_pms.concecutivo_abono,
  historico_cargos_pms.pagos_cargos,
  historico_cargos_pms.id_usuario_factura,
  historico_cargos_pms.total_consumos,
  historico_cargos_pms.total_impuesto,
  historico_cargos_pms.total_pagos,
  historico_cargos_pms.fecha_cargo,
  historico_cargos_pms.factura_anulada,
  historico_cargos_pms.perfil_factura,
  historico_cargos_pms.id_perfil_factura,
  historico_cargos_pms.fecha_sistema_cargo FROM huespedes, historico_cargos_pms, historico_reservas_pms, codigos_vta WHERE ";

  $filtro = "huespedes.id_huesped = historico_reservas_pms.id_huesped AND historico_cargos_pms.numero_reserva = historico_reservas_pms.num_reserva AND huespedes.id_huesped = historico_cargos_pms.id_huesped AND codigos_vta.id_cargo = historico_cargos_pms.id_codigo_cargo AND factura = 0 AND concecutivo_abono >0 ";

  $sele2 = " ORDER BY historico_cargos_pms.concecutivo_abono";

  if($desdeFe!='' && $hastaFe!= ''){
    $filtro = $filtro." AND fecha_cargo >='$desdeFe' AND fecha_cargo <= '$hastaFe'";
  }elseif($desdeFe=='' && $hastaFe!= ''){
    $filtro = $filtro." AND fecha_cargo <= '$hastaFe'";
  }elseif($desdeFe!='' && $hastaFe== ''){
    $filtro = $filtro." AND fecha_cargo = '$desdeFe'";
  }

  if($desdeNu!='' && $hastaNu!= ''){
    $filtro = $filtro." AND concecutivo_abono >='$desdeNu' AND concecutivo_abono <= '$hastaNu'";
  }elseif($desdeNu=='' && $hastaNu!= ''){
    $filtro = $filtro." AND concecutivo_abono <= '$hastaNu'";
  }elseif($desdeNu!='' && $hastaNu== ''){
    $filtro = $filtro." AND concecutivo_abono = '$desdeNu'";
  }

  if($huesped!=''){
    $filtro = $filtro." AND nombre_completo LIKE '%$huesped%'";
  }

  if($formaPa!=''){
    $filtro = $filtro." AND id_codigo_cargo = '$formaPa'";
  }
  
  $query    = $sele.$filtro.$sele2;

  $facturas = $hotel->getFacturasPorRango($query);
  $exportas = $facturas ;

?>

<div class="table-responsive" style="padding:0"> 
  <div class="row-fluid" style="padding:0">
    <table id="dataTable" class="table table-bordered">
      <thead>
        <tr class="warning">
          <td>Recibo Nro</td>
          <td style="text-align:center;">Huesped</td> 
          <td>Fecha Recibo</td>
          <td>Forma de Pago</td>
          <td>Factura</td>
          <td>Valor</td>
          <td>Accion</td>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($facturas as $factura) { ?>
          <tr style='font-size:12px'>
            <td style="padding:3px 5px"><?php echo $factura['concecutivo_abono']; ?></td>
            <td style="padding:3px 5px;text-align: left;"><?php echo substr($factura['nombre_completo'],0,45); ?></td>
            <td style="padding:3px 5px"><?php echo $factura['fecha_cargo']; ?></td>
            <td style="padding:3px 5px"><?php echo $factura['descripcion_cargo']; ?></td>
            <td style="text-align: right;"> <?=($factura['factura_numero']); ?></td>
            <td style="text-align: right;"> <?=number_format($factura['pagos_cargos'],2); ?></td>
            <td style="padding:3px 5px;text-align:center;">
              <div class="btn-group" role="group" aria-label="Basic example" style="text-align:center;">
                <button 
                  class="btn btn-info btn-xs" 
                  type="button"
                  data-toggle    ="modal" 
                  data-huesped   ="<?= $factura['nombre_completo']?>" 
                  data-fechafac  ="<?= $factura['fecha_cargo']?>" 
                  data-numero    ="<?= $factura['concecutivo_abono']?>" 
                  data-reserva   ="<?= $factura['num_reserva']?>" 
                  href="#myModalVerReciboCaja"
                  title="Ver Factura"
                  >
                  <i class="fa fa-file-pdf-o" aria-hidden="true" ></i>
                </button>
              </div>
            </td>
          </tr>
          <?php 
        }
        ?>
      </tbody>
    </table>
    <!-- <table id="tablaFacturas" class="table table-bordered" style="display:none">
      <thead>
        <tr class="warning">
          <td>Recibo de Caja</td>
          <td>Huesped</td> 
          <td>Fecha Factura</td>
          <td>Forma de Pago</td>
          <td>Valor</td>
          <td>Estado</td>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($facturas as $factura) { ?>
          <tr style='font-size:12px'>
            <td style="padding:3px 5px"><?php echo $factura['concecutivo_abono']; ?></td>
            <td style="padding:3px 5px;text-align: left;"><?php echo $factura['nombre_completo'] ?></td>
            <td style="padding:3px 5px"><?php echo $factura['fecha_cargo']; ?></td>
            <td style="padding:3px 5px"><?php echo $factura['descripcion_cargo']; ?></td>
            <td style="text-align: right;"> <?=number_format($factura['total_pagos'],2); ?></td>
          </tr>
          <?php 
        }
        ?>
      </tbody>
    </table> -->
    <div class="col-lg-6" style="padding:0">
    </div>
    <div class="col-lg-6" id="muestraFactura" style="padding :0">
      <object id="verFactura" width="100%" height="500" data=""></object> 
    </div>
  </div>
</div>
