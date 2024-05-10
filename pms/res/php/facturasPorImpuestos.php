<?php

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
  
  $desdeFe = $_POST['desdeFe']; 
  $hastaFe = $_POST['hastaFe'];
  $desdeNu = $_POST['desdeNu'];
  $hastaNu = $_POST['hastaNu'];

  $sele = "SELECT historico_cargos_pms.factura_numero, historico_cargos_pms.fecha_factura, Sum(if(codigo_impto=18,historico_cargos_pms.monto_cargo,0)) AS cargo08, Sum(if(codigo_impto=18,historico_cargos_pms.impuesto,0)) AS impto08, Sum(if(codigo_impto= 23, historico_cargos_pms.monto_cargo,0)) AS cargo19, Sum(if(codigo_impto=23,historico_cargos_pms.impuesto,0)) AS impto19, historico_cargos_pms.numero_reserva, codigos_vta.descripcion_cargo AS descripcion FROM codigos_vta, historico_cargos_pms WHERE ";

  $filtro = "codigos_vta.id_cargo = historico_cargos_pms.codigo_impto";
  $order  = " ORDER BY historico_cargos_pms.factura_numero";
  $group  = "GROUP BY historico_cargos_pms.factura_numero, historico_cargos_pms.fecha_factura, codigos_vta.descripcion_cargo"; 


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

  $query    = $sele.$filtro.$group.$order;

  $facturas = $hotel->getFacturasPorRango($query);
  $exportas = $facturas ;

?>

<div class="table-responsive" style="padding:0"> 
  <div class="row-fluid" style="padding:0">
    <table id="dataTable" class="table table-bordered">
      <thead>
        <tr class="warning">
          <td>Factura</td>
          <td>Fecha Factura</td>
          <td>Base 8% </td>
          <td>Impuesto 8%</td>
          <td>Base 19% </td>
          <td>Impuesto 19%</td>
          <td>Accion</td>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($facturas as $factura) { ?>
          <tr style='font-size:12px'>
            <td style="padding:3px 5px"><?php echo $factura['factura_numero']; ?></td>
            <td style="padding:3px 5px"><?php echo $factura['fecha_factura']; ?></td>
            <td style="text-align: right;"> 
              <?php 
              if($factura['cargo08']!=0){
                echo money_format('%(#16.2n',$factura['cargo08']); 
              }
              ?>  
            </td>
            <td style="text-align: right;">
              <?php  
              if($factura['impto08']!=0){
                echo money_format('%(#16.2n', $factura['impto08']);
              }
              ?>
            </td>
            <td style="text-align: right;"> 
              <?php  
              if($factura['cargo19']!=0){
                echo money_format('%(#16.2n',$factura['cargo19']);
              }
              ?>                
            </td>
            <td style="text-align: right;">
              <?php  
              if($factura['impto19']!=0){
                echo money_format('%(#16.2n', $factura['impto19']);
              }
              ?>
            </td>
            <td style="padding:3px 5px;">
              <div class="btn-group" role="group" aria-label="Basic example">
                <a class="btn btn-info btn-xs" 
                  data-toggle    ="modal" 
                  data-fechafac  ="<?= $factura['fecha_factura']?>" 
                  data-numero    ="<?= $factura['factura_numero']?>" 
                  data-reserva   ="<?= $factura['numero_reserva']?>" 
                  href="#myModalVerFactura"
                  type="button"
                  title="Anular Factura"
                  >
                  <i class="fa fa-file-pdf-o" aria-hidden="true" ></i>
                </a>
                <a class="btn btn-success btn-xs" 
                  data-toggle    ="modal" 
                  data-fechafac  ="<?= $factura['fecha_factura']?>" 
                  data-numero    ="<?= $factura['factura_numero']?>" 
                  data-reserva   ="<?= $factura['numero_reserva']?>" 
                  href="#myModalVerCargosFactura"
                  type="button"
                  title="Ver Cargos de la factura"
                  >
                  <i class="fa fa-file-pdf-o" aria-hidden="true" ></i>
                </a>
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
          <td>Fecha Factura</td>
          <td>Base 8% </td>
          <td>Impuesto 8%</td>
          <td>Base 19% </td>
          <td>Impuesto 19%</td>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($facturas as $factura) { ?>
          <tr style='font-size:12px'>
            <td style="padding:3px 5px"><?php echo $factura['factura_numero']; ?></td>
            <td style="padding:3px 5px"><?php echo $factura['fecha_factura']; ?></td>
            <td style="text-align: right;"> 
              <?php 
              if($factura['cargo08']!=0){
                echo money_format('%(#16.2n',$factura['cargo08']); 
              }
              ?>  
            </td>
            <td style="text-align: right;">
              <?php  
              if($factura['impto08']!=0){
                echo money_format('%(#16.2n', $factura['impto08']);
              }
              ?>
            </td>
            <td style="text-align: right;"> 
              <?php  
              if($factura['cargo19']!=0){
                echo money_format('%(#16.2n',$factura['cargo19']);
              }
              ?>                
            </td>
            <td style="text-align: right;">
              <?php  
              if($factura['impto19']!=0){
                echo money_format('%(#16.2n', $factura['impto19']);
              }
              ?>
            </td>
          </tr>
          <?php 
        }
        ?>
      </tbody>
    </table>
  </div>
</div>
