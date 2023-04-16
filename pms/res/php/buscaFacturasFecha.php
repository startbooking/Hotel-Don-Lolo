<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
	$fact    =  $_POST['fechafac'];

	$facturas = $hotel->getBuscaFacturasFecha($fact,'historico_reservas_pms','historico_cargos_pms');

  $regis = count($facturas);

  if($regis==0){ ?>
    <h4 class="bg-red-gradient" style="padding:10px">Sin Facturas Generadas Para la Fecha: <span style="font-size:16px;font-weight: 600;font-family: 'ubuntu'"> <?=$fact?></span></h4>         
		<?php 
  }else{ ?> 
    <div class="table-responsive"> 
      <table id="example1" class="table table-bordered">
        <thead>
          <tr class="warning">
            <td>Factura</td>
            <td>Huesped</td>
            <td>Fecha Llegada</td>
            <td>Fecha Factura</td>
            <td>Accion</td>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($facturas as $factura) { ?>
            <tr style='font-size:12px'>
              <td style="padding:3px 5px"><?php echo $factura['factura_numero']; ?></td>
              <td style="padding:3px 5px"><?php echo $factura['apellido1'].' '.$factura['apellido2'].' '.$factura['nombre1'].' '.$factura['nombre2']; ?></td>
              <td style="padding:3px 5px"><?php echo $factura['fecha_llegada']; ?></td>
              <td style="padding:3px 5px"><?php echo $factura['fecha_factura']; ?></td>
              <td style="padding:3px 5px">
              	<button class="btn btn-info btn-xs" onclick="verfactura(<?=$factura['factura_numero']?>)" type="button"><i class="fa fa-file-pdf-o" aria-hidden="true" ></i></button>
              </td>
            </tr>
            <?php 
          }
          ?>
        </tbody>
      </table>
    </div>
		<?php 
  }

