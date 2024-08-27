<?php

  include_once '../../../../res/php/titles.php';
  include_once '../../../../res/php/app_topPos.php';  

  $idamb   = $_POST['idamb']; 
  $prefijo = $_POST['prefijo']; 
  $desdeFe = $_POST['desdeFe']; 
  $hastaFe = $_POST['hastaFe'];
  $huesped = $_POST['huesped'];

  $rpre = '';

  $sele = "SELECT huespedes.nombre_completo, historico_facturas_pos.factura, historico_facturas_pos.comanda, historico_facturas_pos.ambiente, historico_facturas_pos.mesa, historico_facturas_pos.pax, historico_facturas_pos.usuario, historico_facturas_pos.valor_total, historico_facturas_pos.valor_neto, historico_facturas_pos.impuesto, historico_facturas_pos.propina, historico_facturas_pos.descuento,  historico_facturas_pos.pagado, historico_facturas_pos.cambio, historico_facturas_pos.fecha, historico_facturas_pos.pms, historico_facturas_pos.estado FROM huespedes, historico_facturas_pos WHERE ";
  
  $filtro = "huespedes.id_huesped = historico_facturas_pos.id_cliente AND historico_facturas_pos.ambiente='$idamb'";

  $sele2 = " ORDER BY huespedes.nombre_completo, historico_facturas_pos.factura";

  if($desdeFe!='' && $hastaFe!=''){
    $filtro = $filtro." AND fecha >='$desdeFe' AND fecha <= '$hastaFe'";
  }elseif($desdeFe=='' && $hastaFe!= ''){
    $filtro = $filtro." AND fecha <= '$hastaFe'";
  }elseif($desdeFe!='' && $hastaFe== ''){
    $filtro = $filtro." AND fecha = '$desdeFe'";
  }
 
  if($huesped!=''){
    $filtro = $filtro." AND huespedes.id_huesped = '$huesped'";
  }
  
  $query    = $sele.$filtro.$sele2;

  $facturas = $pos->getCursor($query);

?>

<div class="table-responsive" style="padding:0"> 
  <div class="row-fluid" style="padding:0">
    <table id="facturasClientes" class="table table-bordered">
      <thead>
        <tr class="warning">
          <td>Factura</td>
          <td>Cliente</td> 
          <td>Fecha Factura</td>
          <td>Valor</td>
          <td>Impuesto</td>
          <td>Propina</td>
          <td>Pago</td>
          <td>Estado</td>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($facturas as $factura) { ?>
          <tr style='font-size:12px'>
            <td style="padding:3px 5px"><?php echo $factura['factura']; ?></td>
            <td style="padding:3px 5px;text-align: left;"><?php echo $factura['nombre_completo']; ?></td>
            <td style="padding:3px 5px"><?php echo $factura['fecha']; ?></td>
            <td style="text-align: right;"> <?=number_format($factura['valor_neto'],2); ?></td>
            <td style="text-align: right;"><?=number_format( $factura['impuesto'],2); ?></td>
            <td style="text-align: right;"><?=number_format( $factura['propina'],2); ?></td>
            <td style="text-align: right;"><?=number_format( $factura['valor_total'],2); ?></td>
            <td style="padding:3px 5px;text-align: center"><?php echo estadoFactura($factura['estado']); ?></td>
            <!--
            <td style="padding:3px 5px;text-align: center">
              <div class="btn-group" role="group" aria-label="Basic example">
                <button 
                  class          ="btn btn-info btn-xs" 
                  type           ="button"
                  data-toggle    ="modal" 
                  data-apellidos ="<?= $factura['apellido1'].' '.$factura['apellido2']?>" 
                  data-nombres   ="<?= $factura['nombre1'].' '.$factura['nombre2']?>" 
                  data-fechafac  ="<?= $factura['fecha']?>" 
                  data-factura   ="Factura_<?=$prefijo?>_<?=$rpre?>-<?= $factura['factura']?>" 
                  data-numero    ="<?= $factura['factura']?>" 
                  data-pms       ="<?= $factura['pms']?>"                   
                  onclick        = "verfacturaHis('<?= $factura['factura']?>','Factura_<?=$prefijo?>_<?=$rpre?>-<?= $factura['factura']?>.pdf')"
                  title          ="Ver Factura"
                  >
                  <i class="fa fa-file-pdf-o" aria-hidden="true" ></i>
                </button>
              </div>
            </td>
          -->
          </tr>
          <?php 
        }
        ?>
      </tbody>
    </table>
  </div>
</div>
