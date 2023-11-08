<?php

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 

  $eToken = $hotel->datosTokenCia();
  $facturador = $eToken[0]['facturador'];

  $desdeFe = $_POST['desdeFe']; 
  $hastaFe = $_POST['hastaFe'];
  $desdeNu = $_POST['desdeNu'];
  $hastaNu = $_POST['hastaNu'];
  $huesped = $_POST['huesped'];
  $empresa = $_POST['empresa'];
  $formaPa = $_POST['formaPa'];

  if($empresa!=''){
    $sele = "SELECT companias.empresa, codigos_vta.descripcion_cargo, huespedes.apellido1, huespedes.apellido2, huespedes.nombre1, huespedes.nombre2, huespedes.nombre_completo, historico_cargos_pms.habitacion_cargo, historico_cargos_pms.tipo_factura, historico_cargos_pms.id_codigo_cargo, historico_cargos_pms.perfil_factura, historico_cargos_pms.id_perfil_factura, historico_cargos_pms.perfil_factura, historico_cargos_pms.factura_numero, historico_cargos_pms.numero_reserva, historico_cargos_pms.factura_anulada, historico_cargos_pms.id_usuario_factura, historico_cargos_pms.prefijo_factura, historico_cargos_pms.total_consumos, historico_cargos_pms.total_impuesto, historico_cargos_pms.total_pagos, historico_cargos_pms.fecha_factura, historico_cargos_pms.fecha_sistema_cargo, historico_cargos_pms.numero_factura_cargo, historico_reservas_pms.fecha_llegada, historico_reservas_pms.num_reserva,  historico_reservas_pms.fecha_salida FROM huespedes, historico_cargos_pms, codigos_vta, companias, historico_reservas_pms WHERE ";
    $filtro = "huespedes.id_huesped = historico_cargos_pms.id_huesped AND codigos_vta.id_cargo = historico_cargos_pms.id_codigo_cargo AND factura=1 and tipo_factura = 2 AND companias.id_compania = historico_cargos_pms.id_perfil_factura AND historico_cargos_pms.numero_reserva = historico_reservas_pms.num_reserva";
  }else{
    $sele = "SELECT codigos_vta.descripcion_cargo, huespedes.apellido1, huespedes.apellido2, huespedes.nombre1, huespedes.nombre2, huespedes.nombre_completo, historico_cargos_pms.habitacion_cargo, historico_cargos_pms.tipo_factura, historico_cargos_pms.id_codigo_cargo, historico_cargos_pms.perfil_factura, historico_cargos_pms.id_perfil_factura,  historico_cargos_pms.prefijo_factura, historico_cargos_pms.numero_factura_cargo,historico_cargos_pms.perfil_factura, historico_cargos_pms.factura_numero, historico_cargos_pms.numero_reserva, historico_cargos_pms.factura_anulada, historico_cargos_pms.id_usuario_factura, historico_cargos_pms.total_consumos, historico_cargos_pms.total_impuesto, historico_cargos_pms.total_pagos, historico_cargos_pms.fecha_factura, historico_cargos_pms.fecha_sistema_cargo, historico_reservas_pms.fecha_llegada,  historico_reservas_pms.fecha_salida, historico_reservas_pms.num_reserva  FROM huespedes, historico_cargos_pms, codigos_vta, historico_reservas_pms WHERE ";
    $filtro = "huespedes.id_huesped = historico_cargos_pms.id_huesped AND codigos_vta.id_cargo = historico_cargos_pms.id_codigo_cargo AND factura=1 AND historico_cargos_pms.numero_reserva = historico_reservas_pms.num_reserva";
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
    <table id="example1" class="table table-bordered">
      <thead>
        <tr class="warning centro" >
          <td>Factura</td>          
          <td>Facturado A</td> 
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
        $totalFac = 0 ;
        $totalCon = 0;
        $totalImp = 0;
        foreach ($facturas as $factura) { 
        
          /* 
          echo $factura['tipo_factura'].'<br>';
          echo $factura['id_perfil_factura'].'<br>'; 
          echo $factura['nombre_completo'].'<br>'; 
           */
          
          if ($factura['tipo_factura'] == 2) {          
            $cias = $hotel->getBuscaCia($factura['id_perfil_factura']);
            $nombrecia = $cias[0]['empresa'];
            $nitcia = $cias[0]['nit'] . '-' . $cias[0]['dv'];
          }
          if($factura['factura_anulada']=='0'){
            $totalFac = $totalFac + $factura['total_pagos'];
            $totalCon = $totalCon + $factura['total_consumos'];
            $totalImp = $totalImp + $factura['total_impuesto'];
          }
          ?>
          <tr style='font-size:12px'>
            <td style="padding:3px 5px"><?php echo $factura['factura_numero']; ?></td>            
            <td style="padding:3px 5px;text-align: left;"><?php 
            if($factura['tipo_factura'] == 1){
              echo $factura['nombre_completo'];
            }else{
              echo $nombrecia; 
            }
            ?></td>
            <td style="padding:3px 5px"><?php echo $factura['nombre_completo']; ?></td>
            <td style="padding:3px 5px"><?php echo $factura['fecha_factura']; ?></td>
            <td style="padding:3px 5px"><?php echo $factura['descripcion_cargo']; ?></td>
            <td style="text-align: right;"> <?=number_format($factura['total_consumos'],2); ?></td>
            <td style="text-align: right;"><?=number_format($factura['total_impuesto'],2); ?></td>
            <td style="text-align: right;"><?=number_format($factura['total_pagos'],2); ?></td>
            <td style="padding:3px 5px"><?php echo estadoFactura($factura['factura_anulada']); ?></td>
            <td style="padding:3px 5px;width: 10%;text-align:center;">
              <button 
                class="btn btn-info btn-xs" 
                type="button" 
                data-toggle="modal" 
                data-tipo="0"
                data-facturador="<?php echo $facturador; ?>" 
                data-apellidos="<?php echo $factura['apellido1'] . ' ' . $factura['apellido2']; ?>" 
                data-nombres="<?php echo $factura['nombre1'] . ' ' . $factura['nombre2']; ?>" 
                data-fechafac="<?php echo $factura['fecha_factura']; ?>" 
                data-numero="<?php echo $factura['factura_numero']; ?>" 
                data-reserva="<?php echo $factura['num_reserva']; ?>" 
                href="#myModalVerFactura" title="Ver Factura">
                <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
              </button>
              <?php
              if ($factura['factura_anulada'] == 0) { ?>
                <a class="btn btn-danger btn-xs" data-toggle="modal" 
                data-facturador="<?php echo $facturador; ?>" data-apellidos="<?php echo $factura['apellido1'] . ' ' . $factura['apellido2']; ?>" data-nombres="<?php echo $factura['nombre1'] . ' ' . $factura['nombre2']; ?>" data-llegada="<?php echo $factura['fecha_llegada']; ?>" data-salida="<?php echo $factura['fecha_salida']; ?>" data-fechafac="<?php echo $factura['fecha_factura']; ?>" data-numero="<?php echo $factura['factura_numero']; ?>" data-reserva="<?php echo $factura['num_reserva']; ?>" data-perfil="<?php echo $factura['perfil_factura']; ?>" data-idperfil="<?php echo $factura['id_perfil_factura']; ?>" data-prefijo="<?php echo $factura['prefijo_factura']; ?>" href="#myModalAnulaFacturaHistorico" type="button" title="Anular Factura">
                  <i class="fa fa-window-close" aria-hidden="true"></i></a>
                <?php
                  if($facturador == 1){
                    ?>
                    <button class="btn btn-default btn-xs" onclick="donwloadFile('<?php echo $factura['factura_numero']; ?>.xml','<?php echo NIT; ?>','xml','false');" type="button" title="Descarga ZIP Attached">
                      <i class="fa-solid fa-download"></i>
                    </button>
                    <?php
                  }
              }else{ ?>
                <button 
                  class="btn btn-success btn-xs" 
                  type="button" 
                  data-toggle="modal"
                  data-tipo="1"
                  data-facturador="<?php echo $facturador; ?>" 
                  data-apellidos="<?php echo $factura['apellido1'] . ' ' . $factura['apellido2']; ?>" 
                  data-nombres="<?php echo $factura['nombre1'] . ' ' . $factura['nombre2']; ?>" 
                  data-fechafac="<?php echo $factura['fecha_factura']; ?>" 
                  data-numero="<?php echo $factura['numero_factura_cargo']; ?>" data-reserva="<?php echo $factura['num_reserva']; ?>" href="#myModalVerFactura" title="Ver Nota Credito">
                <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
              </button>
              <?php
              }              
              ?>
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
  <div class="row-fluid" style="padding:0">
  <table id="dataTable" class="table table-bordered">
    <thead>
      <tr class="derecha">
        <td>Total Consumos</td>
        <td><?php echo number_format($totalCon,2)?></td>
        <td>Total Impuestos</td>
        <td><?php echo number_format($totalImp,2)?></td>
        <td>Total Facturas</td>
        <td><?php echo number_format($totalFac,2)?></td>
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
          "iDisplayLength": 100,
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