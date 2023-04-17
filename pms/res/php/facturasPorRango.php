<?php

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
  
  $desdeFe = $_POST['desdeFe']; 
  $hastaFe = $_POST['hastaFe'];
  $desdeNu = $_POST['desdeNu'];
  $hastaNu = $_POST['hastaNu'];
  $huesped = $_POST['huesped'];
  $empresa = $_POST['empresa'];
  $formaPa = $_POST['formaPa'];

  if($empresa!=''){
    $sele = "SELECT companias.empresa, codigos_vta.descripcion_cargo, huespedes.apellido1, huespedes.apellido2, huespedes.nombre1, huespedes.nombre2, huespedes.nombre_completo, historico_cargos_pms.habitacion_cargo, historico_cargos_pms.tipo_factura, historico_cargos_pms.id_codigo_cargo, historico_cargos_pms.id_perfil_factura, historico_cargos_pms.factura_numero, historico_cargos_pms.numero_reserva, historico_cargos_pms.factura_anulada, historico_cargos_pms.id_usuario_factura, historico_cargos_pms.total_consumos, historico_cargos_pms.total_impuesto, historico_cargos_pms.total_pagos, historico_cargos_pms.fecha_factura, historico_cargos_pms.fecha_sistema_cargo FROM huespedes, historico_cargos_pms, codigos_vta, companias WHERE ";
      $filtro = "huespedes.id_huesped = historico_cargos_pms.id_huesped AND codigos_vta.id_cargo = historico_cargos_pms.id_codigo_cargo AND factura=1 and tipo_factura = 2 AND companias.id_compania = historico_cargos_pms.id_perfil_factura";
  }else{
    $sele = "SELECT codigos_vta.descripcion_cargo, huespedes.apellido1, huespedes.apellido2, huespedes.nombre1, huespedes.nombre2, huespedes.nombre_completo, historico_cargos_pms.habitacion_cargo, historico_cargos_pms.tipo_factura, historico_cargos_pms.id_codigo_cargo, historico_cargos_pms.id_perfil_factura, historico_cargos_pms.factura_numero, historico_cargos_pms.numero_reserva, historico_cargos_pms.factura_anulada, historico_cargos_pms.id_usuario_factura, historico_cargos_pms.total_consumos, historico_cargos_pms.total_impuesto, historico_cargos_pms.total_pagos, historico_cargos_pms.fecha_factura, historico_cargos_pms.fecha_sistema_cargo FROM huespedes, historico_cargos_pms, codigos_vta WHERE ";
      $filtro = "huespedes.id_huesped = historico_cargos_pms.id_huesped AND codigos_vta.id_cargo = historico_cargos_pms.id_codigo_cargo AND factura=1";
  }


  $sele2 = " ORDER BY historico_cargos_pms.factura_numero";

  if($desdeFe!='' && $hastaFe!= ''){
    $filtro = $filtro." AND fecha_factura >='$desdeFe' AND fecha_factura <= '$hastaFe'";
  }elseif($desdeFe=='' && $hastaFe!= ''){
    $filtro = $filtro." AND fecha_factura <= '$hastaFe'";
  }elseif($desdeFe!='' && $hastaFe== ''){
    $filtro = $filtro." AND fecha_factura = '$desdeFe'";
  }

  if($desdeNu!='' && $hastaNu!= ''){
    $filtro = $filtro." AND factura_numero >='$desdeNu' AND factura_numero <= '$hastaNu'";
  }elseif($desdeNu=='' && $hastaNu!= ''){
    $filtro = $filtro." AND factura_numero <= '$hastaNu'";
  }elseif($desdeNu!='' && $hastaNu== ''){
    $filtro = $filtro." AND factura_numero = '$desdeNu'";
  }

  if($huesped!=''){
    $filtro = $filtro." AND nombre_completo LIKE '%$huesped%'";
  }

  if($empresa!=''){
    $filtro = $filtro." AND empresa LIKE '%$empresa%'";
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
          <td>Factura</td>
          <?php 
            if($empresa!=''){ ?>
              <td>Empresa</td> 
            <?php 
            }else{ ?>
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
          <td>Accion</td>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($facturas as $factura) { ?>
          <tr style='font-size:12px'>
            <td style="padding:3px 5px"><?php echo $factura['factura_numero']; ?></td>
            <?php 
              if($empresa!=''){ ?>
                <td style="padding:3px 5px;text-align: left;"><?php echo $factura['empresa']; ?></td>
                <?php 
              }else{
                ?>
                <?php 
              }
            ?>
            <td style="padding:3px 5px;text-align: left;"><?php echo $factura['nombre_completo']; ?></td>
            <td style="padding:3px 5px"><?php echo $factura['fecha_factura']; ?></td>
            <td style="padding:3px 5px"><?php echo $factura['descripcion_cargo']; ?></td>
            <td style="text-align: right;"> <?=number_format($factura['total_consumos']); ?></td>
            <td style="text-align: right;"><?=number_format($factura['total_impuesto']); ?></td>
            <td style="text-align: right;"><?=number_format($factura['total_pagos']); ?></td>
            <td style="padding:3px 5px"><?php echo estadoFactura($factura['factura_anulada']); ?></td>
            <td style="padding:3px 5px;">
              <div class="btn-group" role="group" aria-label="Basic example">
                <button class="btn btn-info btn-xs" 
                  type="button"
                  data-toggle    ="modal" 
                  data-apellidos ="<?= $factura['apellido1'].' '.$factura['apellido2']?>" 
                  data-nombres   ="<?= $factura['nombre1'].' '.$factura['nombre2']?>" 
                  data-fechafac  ="<?= $factura['fecha_factura']?>" 
                  data-numero    ="<?= $factura['factura_numero']?>" 
                  data-reserva   ="<?= $factura['numero_reserva']?>" 
                  href="#myModalVerFactura"
                  title="Ver Factura"
                  >
                  <i class="fa fa-file-pdf-o" aria-hidden="true" ></i>
                </button>
                <button class="btn btn-success btn-xs" 
                  type="button"
                  data-toggle    ="modal" 
                  data-apellidos ="<?= $factura['apellido1'].' '.$factura['apellido2']?>" 
                  data-nombres   ="<?= $factura['nombre1'].' '.$factura['nombre2']?>" 
                  data-fechafac  ="<?= $factura['fecha_factura']?>" 
                  data-numero    ="<?= $factura['factura_numero']?>" 
                  data-reserva   ="<?= $factura['numero_reserva']?>" 
                  href="#myModalVerCargosFactura"
                  title="Ver Cargos de la factura"
                  >
                  <i class="fa fa-bars" aria-hidden="true" ></i>
                </button>
              </div>
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
            if($empresa!=''){ ?>
              <td>Empresa</td> 
            <?php 
            }else{ ?>
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
              if($empresa!=''){ ?>
                <td style="padding:3px 5px;text-align: left;"><?php echo $factura['empresa']; ?></td>
                <?php 
              }else{
                ?>
                <?php 
              }
            ?>
            <td style="padding:3px 5px;text-align: left;"><?php echo $factura['apellido1'].' '.$factura['apellido2'].' '.$factura['nombre1'].' '.$factura['nombre2']; ?></td>
            <td style="padding:3px 5px"><?php echo $factura['fecha_factura']; ?></td>
            <td style="padding:3px 5px"><?php echo $factura['descripcion_cargo']; ?></td>
            <td style="text-align: right;"> <?=number_format($factura['total_consumos'],2); ?></td>
            <td style="text-align: right;"><?=number_format($factura['total_impuesto'],2); ?></td>
            <td style="text-align: right;"><?=number_format($factura['total_pagos'],2); ?></td>
            <td style="padding:3px 5px"><?php echo estadoFactura($factura['factura_anulada']); ?></td>
          </tr>
          <?php 
        }
        ?>
      </tbody>
    </table>
    <div class="col-lg-6" style="padding:0">
    </div>
    <div class="col-lg-6" id="muestraFactura" style="padding :0">
      <object id="verFactura" width="100%" height="500" data=""></object> 
    </div>
  </div>
</div>
