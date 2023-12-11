<?php

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
  
  $desdeFe = $_POST['desdeFe']; 
  $hastaFe = $_POST['hastaFe'];
  $huesped = $_POST['huesped'];

  $sele = "SELECT huespedes.identificacion, huespedes.nombre_completo, huespedes.email, huespedes.celular, huespedes.fecha_nacimiento, historico_reservas_pms.dias_reservados, historico_reservas_pms.fecha_llegada, historico_reservas_pms.fecha_salida, historico_reservas_pms.num_reserva, historico_reservas_pms.num_registro, historico_reservas_pms.can_hombres, historico_reservas_pms.can_mujeres, historico_reservas_pms.can_ninos, historico_reservas_pms.tarifa, historico_reservas_pms.fuente_reserva, historico_reservas_pms.salida_checkout, historico_reservas_pms.num_habitacion, historico_reservas_pms.estado FROM huespedes, historico_reservas_pms  WHERE ";

  $filtro = "huespedes.id_huesped = historico_reservas_pms.id_huesped" ;
  $orden  = " ORDER BY historico_reservas_pms.num_reserva ASC";
 
  if($desdeFe!='' && $hastaFe!= ''){
    $filtro = $filtro." AND historico_reservas_pms.fecha_llegada >='$desdeFe' AND historico_reservas_pms.fecha_salida <= '$hastaFe'";
  }elseif($desdeFe=='' && $hastaFe!= ''){
    $filtro = $filtro." AND historico_reservas_pms.fecha_salida <= '$hastaFe'";
  }elseif($desdeFe!='' && $hastaFe== ''){
    $filtro = $filtro." AND historico_reservas_pms.fecha_llegada >= '$desdeFe'";
  }
  if($huesped!=''){
    $filtro = $filtro." AND nombre_completo LIKE '%$huesped%'";
  }
  
  $query    = $sele.$filtro.$orden;

  $facturas = $hotel->getTraeHistoricoReservas($query);

  $exportas = $facturas ;

?>

<div class="table-responsive" style="padding:0"> 
  <div class="row-fluid" style="padding:0">
    <table id="dataTable" class="table table-bordered">
      <thead>
        <tr class="warning">
          <td>Reserva Nro</td>
          <td>Huesped</td> 
          <td>Identificacion</td>
          <td>Fecha Llegada</td> 
          <td>Fecha Salida</td>
          <td>Nro Habitacion</td>
          <td>Noches</td>
          <td>Hom</td>
          <td>Muj</td>
          <td>Nin</td>
          <td>Estado</td>
          <td>Registro</td>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($facturas as $factura) { ?>
          <tr style='font-size:12px'>
            <td align="right"><?php echo $factura['num_reserva']; ?></td>
            <td><?php echo $factura['nombre_completo']; ?></td>
            <td><?php echo $factura['identificacion']; ?></td>
            <td><?php echo $factura['fecha_llegada']; ?></td>
            <td><?php echo $factura['fecha_salida']; ?></td>
            <td align="right"><?php echo $factura['num_habitacion']; ?></td>
            <td> <?=$factura['dias_reservados']; ?></td>
            <td><?=$factura['can_hombres']; ?></td>
            <td><?=$factura['can_mujeres']; ?></td>
            <td><?=$factura['can_ninos']; ?></td>
            <td align="center"><?php echo estadoReserva($factura['estado']); ?></td>
            <td align="center">
              <button 
                class         ="btn btn-warning btn-xs" 
                title         ="Imprimir Registro Hotelero"
                data-registro ="<?= $factura['num_registro']?>" 
                onclick       ="imprimeHistoricoRegistroHotelero('<?=str_pad($factura['num_registro'],5,'0',STR_PAD_LEFT)?>')"> 
                <i class="fa fa-building-o" aria-hidden="true"></i>
              </button>
            </td>
          </tr>
          <?php 
        } 
        ?>
      </tbody>
    </table>
    <table id="tablaReserva" class="table table-bordered" style="display:none;">
      <thead>
        <tr class="warning">
          <td>Reserva Nro</td>
          <td>Huesped</td> 
          <td>Identificacion</td>
          <td>Fecha Llegada</td> 
          <td>Fecha Salida</td>
          <td>Nro Habitacion</td>
          <td>Noches</td>
          <td>Hom</td>
          <td>Muj</td>
          <td>Nin</td>
          <td>Estado</td>
          <td>Correo</td>
          <td>Celular</td>
          <td>Fecha Nacimiento</td>
          <td>Reg Hotelero</td>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($facturas as $factura) { ?>
          <tr style='font-size:12px'>
            <td align="right"><?php echo $factura['num_reserva']; ?></td>
            <td><?php echo $factura['nombre_completo']; ?></td>
            <td><?php echo $factura['identificacion']; ?></td>
            <td><?php echo $factura['fecha_llegada']; ?></td>
            <td><?php echo $factura['fecha_salida']; ?></td>
            <td align="right"><?php echo $factura['num_habitacion']; ?></td>
            <td> <?=$factura['dias_reservados']; ?></td>
            <td><?=$factura['can_hombres']; ?></td>
            <td><?=$factura['can_mujeres']; ?></td>
            <td><?=$factura['can_ninos']; ?></td>
            <td align="center"><?php echo estadoReserva($factura['estado']); ?></td>
            <td align="center"><?php echo $factura['email']; ?></td>
            <td align="center"><?php echo $factura['celular']; ?></td>
            <td align="center"><?php echo $factura['fecha_nacimiento']; ?></td>
            <td align="center"><?php echo str_pad($factura['num_registro'],5,'0',STR_PAD_LEFT)?></td>
          </tr>
          <?php 
        } 
        ?>
      </tbody>
    </table>

    <div class="col-lg-6" style="padding:0"></div>
    <div class="col-lg-6" id="muestraFactura" style="padding :0">
      <object id="verFactura" width="100%" height="500" data=""></object> 
    </div>
  </div>
</div>
