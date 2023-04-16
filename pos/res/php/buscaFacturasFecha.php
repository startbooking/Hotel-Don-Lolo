<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topPos.php'; 

  $fecha    =  $_POST['fechafac'];
  $idamb    =  $_POST['idamb'];
  
  $facturas = $pos->getBuscaFacturasFecha($fecha, $idamb);
  $pref     = $pos->getPrefijoAmbiente($idamb);
  $resol    = $pos->getResolucionFacturacion($idamb);
  $rpre     = $resol[0]['prefijo'];

  $regis = count($facturas);

  if($regis==0){ ?>
    <h4 class="bg-red-gradient" style="padding:10px">Sin Facturas Generadas Para la Fecha: <span style="font-size:16px;font-weight: 600;font-family: 'ubuntu'"> <?=$fecha?></span></h4>         
		<?php 
  }else{ ?> 
    <div class="table-responsive"> 
      <table id="example1" class="table table-bordered">
        <thead>
          <tr class="warning" style="font-weight: bold;text-align: center">
            <td>Factura</td>
            <td>Neto</td>
            <td>Impuesto</td>
            <td>Total</td>
            <td>Accion</td>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($facturas as $factura) { ?>
            <tr style='font-size:12px'>
              <td style="padding:2px 5px"><?php echo $factura['factura']; ?></td>
              <td style="padding:2px 5px;text-align: right;"><?php echo money_format('%.2n', $factura['valor_neto']); ?></td>
              <td style="padding:2px 5px;text-align: right;"><?php echo money_format('%.2n', $factura['impuesto']); ?></td>
              <td style="padding:2px 5px;text-align: right;"><?php echo money_format('%.2n', $factura['valor_total']); ?></td>
              <td style="padding:2px 5px;text-align: center">
                <div class="btn-group">
                  <?php 
                  if($factura['pms']==1){
                    ?>
                    <button class="btn btn-info btn-xs" title="Ver Factura "onclick="verfactura('ChequeCuenta_<?=$pref?>_<?=$factura['factura']?>')" type="button"><i class="fa fa-money" aria-hidden="true" ></i></button>
                    <?php 
                  }else{
                    ?>
                    <button class="btn btn-info btn-xs" title="Ver Factura "onclick="verfactura('Factura_<?=$pref?>_<?=$rpre?>-<?=$factura['factura']?>')" type="button"><i class="fa fa-money" aria-hidden="true" ></i></button>
                    <?php 
                  }
                  ?>
                  <!--
                    <button class="btn btn-success btn-xs" title="Ver Comanda "onclick="verComanda(<?=$factura['comanda']?>,<?=$factura['ambiente']?>)" type="button"><i class="fa fa-bars" aria-hidden="true" ></i></button>
                  -->
                </div>
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

