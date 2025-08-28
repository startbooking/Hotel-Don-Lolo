<?php 
  // require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
	
  $reserva  = $_POST['reserva'];
  $facturas = $hotel->getFacturasReserva($reserva);

?>

<div class="col-lg-6" style="padding:0">
  <div class="table-responsive" style="padding:0"> 
    <div class="row-fluid" style="padding:0">
      <table id="example1" class="table table-bordered">
        <thead>
          <tr class="warning">
            <td>Factura</td>
            <td>Huesped</td> 
            <td>Nro Res.</td>
            <td>Fecha Factura</td>
            <td>Estado</td>
            <td>Accion</td>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($facturas as $factura) { ?>
            <tr style='font-size:12px'>
              <td style="padding:3px 5px"><?php echo $factura['factura_numero']; ?></td>
              <td style="padding:3px 5px;text-align: left;"><?php echo $factura['apellido1'].' '.$factura['apellido2'].' '.$factura['nombre1'].' '.$factura['nombre2']; ?></td>
              <td style="padding:3px 5px"><?php echo $factura['numero_reserva']; ?></td>
              <td style="padding:3px 5px"><?php echo $factura['fecha_factura']; ?></td>
              <td style="padding:3px 5px"><?php echo estadoFactura($factura['factura_anulada']); ?></td>
              <td style="padding:3px 5px;width: 20%">
                <div class="btn-group" role="group" aria-label="Basic example">
                  <button class="btn btn-info btn-xs" onclick="verfacturaHistorico(<?=$factura['factura_numero']?>)" type="button"><i class="fa fa-file-pdf-o" aria-hidden="true" title="Ver Factura"></i></button>
                  <!-- <?php 
                    if($factura['factura_anulada']==0){?>
                      <a class="btn btn-danger btn-xs" 
                        data-toggle    ="modal" 
                        data-apellidos ="<?= $factura['apellido1'].' '.$factura['apellido2']?>" 
                        data-nombres   ="<?= $factura['nombre1'].' '.$factura['nombre2']?>" 
                        data-llegada   ="<?= $factura['fecha_llegada']?>" 
                        data-salida    ="<?= $factura['salida_checkout']?>" 
                        data-fechafac  ="<?= $factura['fecha_factura']?>" 
                        data-numero    ="<?= $factura['factura_numero']?>" 
                        data-reserva   ="<?= $factura['numero_reserva']?>" 
                        href="#myModalAnulaFacturaHistorico"
                        type="button"
                        title="Anular Factura"
                        >
                        <i class="fa fa-window-close" aria-hidden="true" ></i></a>
                      <?php 
                    }
                  ?> -->
                  <button class="btn btn-success btn-xs" onclick="verCargosFacturaHistorico(<?=$factura['factura_numero']?>,<?=$factura['numero_reserva']?>)" type="button"><i class="fa fa-file-pdf-o" aria-hidden="true" title="Ver Detalle Consumos Factura"></i></button>
                </div>
              </td>
            </tr>
            <?php 
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<div class="col-lg-6" style="padding :0">
  <div class="row-fluid" id="muestraFactura"></div>
  <object id="verFactura" width="100%" height="500" data=""></object> 
</div>
