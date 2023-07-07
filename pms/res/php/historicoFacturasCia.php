<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 

  $id       = $_POST['id'];
  $facturas = $hotel->getFacturasPorcompania($id);
  $regis    = count($facturas);

  if($regis==0){ ?>
    <h4 class="bg-red-gradient" style="padding:10px">Sin Facturas Generadas Para esta Empresa <span style="font-size:16px;font-weight: 600;font-family: 'ubuntu'"></span></h4>         
		<?php 
  }else{ ?> 
    <div class="container-fluid">
      <div class="table-responsive"> 
        <div class="row-fluid">
          <div class="col-lg-6" style="padding:0">
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
                      <button class="btn btn-info btn-xs" onclick="verfacturaHistorico(<?=$factura['factura_numero']?>)" type="button"><i class="fa fa-file-pdf-o" aria-hidden="true" title="Ver Factura"></i></button>
                      <button class="btn btn-success btn-xs" onclick="verCargosFacturaHistorico(<?=$factura['factura_numero']?>,<?=$factura['numero_reserva']?>)" type="button"><i class="fa fa-file-pdf-o" aria-hidden="true" title="Ver Factura"></i></button>
                    </td>
                  </tr>
                  <?php 
                }
                ?>
              </tbody>
            </table>
          </div>
          <div class="col-lg-6" id="muestraFactura">
            <object id="verFactura" width="100%" height="500" data=""></object> 
          </div>
        </div>
      </div>
    </div>
		<?php 
  }
?>