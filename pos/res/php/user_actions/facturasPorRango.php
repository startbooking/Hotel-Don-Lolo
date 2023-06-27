<?php

  include_once '../../../../res/php/titles.php';
  include_once '../../../../res/php/app_topPos.php';  

  $idamb   = $_POST['idamb']; 
  $prefijo = $_POST['prefijo']; 
  $desdeFe = $_POST['desdeFe']; 
  $hastaFe = $_POST['hastaFe'];
  $desdeNu = $_POST['desdeNu'];
  $hastaNu = $_POST['hastaNu'];
  $formaPa = $_POST['formaPa'];
  
  $rpre = '';

  $sele = "SELECT formas_pago.descripcion, clientes.apellido1, clientes.apellido2, clientes.nombre1, clientes.nombre2, historico_facturas_pos.factura, historico_facturas_pos.comanda, historico_facturas_pos.ambiente, historico_facturas_pos.mesa, historico_facturas_pos.pax, historico_facturas_pos.usuario, historico_facturas_pos.valor_total, historico_facturas_pos.valor_neto, historico_facturas_pos.impuesto, historico_facturas_pos.propina, historico_facturas_pos.descuento, historico_facturas_pos.fecha, historico_facturas_pos.pms, historico_facturas_pos.estado FROM clientes, historico_facturas_pos, formas_pago WHERE ";
      $filtro = "clientes.id_cliente = historico_facturas_pos.id_cliente AND formas_pago.id_pago = historico_facturas_pos.forma_pago AND historico_facturas_pos.ambiente='$idamb'";

  $sele2 = " ORDER BY historico_facturas_pos.factura";

  if($desdeFe!='' && $hastaFe!= ''){
    $filtro = $filtro." AND fecha >='$desdeFe' AND fecha <= '$hastaFe'";
  }elseif($desdeFe=='' && $hastaFe!= ''){
    $filtro = $filtro." AND fecha <= '$hastaFe'";
  }elseif($desdeFe!='' && $hastaFe== ''){
    $filtro = $filtro." AND fecha = '$desdeFe'";
  }

  if($desdeNu!='' && $hastaNu!= ''){
    $filtro = $filtro." AND factura >='$desdeNu' AND factura <= '$hastaNu'";
  }elseif($desdeNu=='' && $hastaNu!= ''){
    $filtro = $filtro." AND factura <= '$hastaNu'";
  }elseif($desdeNu!='' && $hastaNu== ''){
    $filtro = $filtro." AND factura = '$desdeNu'";
  }
 
  if($formaPa!=''){
    $filtro = $filtro." AND id_pago = '$formaPa'";
  }
  
  $query    = $sele.$filtro.$sele2;

  $facturas = $pos->getFacturasPorRango($query);
  $exportas = $facturas ;

?>

<div class="table-responsive" style="padding:0"> 
  <div class="row-fluid" style="padding:0">
    <table id="dataTable" class="table table-bordered">
      <thead>
        <tr class="warning">
          <td>Factura</td>
          <td>Cliente</td> 
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
            <td style="padding:3px 5px"><?php echo $factura['factura']; ?></td>
            <td style="padding:3px 5px;text-align: left;"><?php echo $factura['apellido1'].' '.$factura['apellido2'].' '.$factura['nombre1'].' '.$factura['nombre2']; ?></td>
            <td style="padding:3px 5px"><?php echo $factura['fecha']; ?></td>
            <td style="padding:3px 5px"><?php echo $factura['descripcion']; ?></td>
            <td style="text-align: right;"> <?=number_format($factura['valor_neto'],2); ?></td>
            <td style="text-align: right;"><?=number_format( $factura['impuesto'],2); ?></td>
            <td style="text-align: right;"><?=number_format( $factura['valor_total'],2); ?></td>
            <td style="padding:3px 5px;text-align: center"><?php echo estadoFactura($factura['estado']); ?></td>
            <td style="padding:3px 5px;text-align: center">
              <button 
                class          ="btn btn-danger btn-xs" 
                type           ="button"
                data-toggle    ="modal" 
                data-apellidos ="<?= $factura['apellido1'].' '.$factura['apellido2']?>" 
                data-nombres   ="<?= $factura['nombre1'].' '.$factura['nombre2']?>" 
                data-fechafac  ="<?= $factura['fecha']?>" 
                data-factura   ="ChequeCuenta_<?=$prefijo?>_<?= $factura['factura']?>" 
                data-numero    ="<?= $factura['factura']?>" 
                data-pms       ="<?= $factura['pms']?>"                   
                onclick        = "verfacturaHis('<?= $factura['factura']?>','ChequeCuenta_<?=$prefijo?>_<?=$rpre?>-<?= $factura['factura']?>.pdf')"
                title          ="Ver Factura"
                >
                <i class="fa fa-file-pdf-o" aria-hidden="true" ></i>
              </button>
              <!-- <div class="btn-group" role="group" aria-label="Basic example">
              </div> -->
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
          <td>Cliente</td> 
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
            <td style="padding:3px 5px"><?php echo $factura['factura']; ?></td>
            <td style="padding:3px 5px;text-align: left;"><?php echo $factura['apellido1'].' '.$factura['apellido2'].' '.$factura['nombre1'].' '.$factura['nombre2']; ?></td>
            <td style="padding:3px 5px"><?php echo $factura['fecha']; ?></td>
            <td style="padding:3px 5px"><?php echo $factura['descripcion']; ?></td>
            <td style="text-align: right;"> <?=number_format($factura['valor_neto'],2); ?></td>
            <td style="text-align: right;"><?=number_format( $factura['impuesto'],2); ?></td>
            <td style="text-align: right;"><?=number_format( $factura['valor_total'],2); ?></td>
            <td style="padding:3px 5px"><?php echo estadoFactura($factura['estado']); ?></td>
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
