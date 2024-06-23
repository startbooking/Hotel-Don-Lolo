<?php 
  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
  $reserva           =  $_POST['reserva'];
  $folio             =  $_POST['folio']; 
  $nrohabi           =  $_POST['nrohabi'];
  $_SESSION['folio'] = $folio;
	
  $folios1 = $hotel->getCargosReserva($reserva,$folio);

?>

<div class="table-responsive-lg">
  <table id="example1" class="table table-bordered" style="font-size:11px">
 	<thead class="warning">
 	  <tr>
  		<th>Detalle</th>
  		<th>Consumos</th>
  		<th>% Impto</th>
  		<th>Impuestos</th>
      <th>Total Cargo</th>
  		<th>Abonos</th>
  		<th>Fecha</th>
  		<th>Usuario</th>
  		<th>Accion</th>
    </tr>
 	</thead>
 	<tbody>
	  <?php
      $consumos = 0;
      $impto    = 0;
      $pagos    = 0;
		  foreach ($folios1 as $folio1):
        $consumos = $consumos + $folio1['monto_cargo'];
        $impto    = $impto + $folio1['impuesto'];
        $pagos    = $pagos + $folio1['pagos_cargos'];	
      		?>
          <tr style="text-align:right;">
     			  <td style="text-align:left;"><?=$folio1['descripcion_cargo']?></td>
    	 		  <td><?=number_format($folio1['monto_cargo'],2)?></td>
    	 		  <td>
    	 		    <?php
    	 		    if($folio1['porcentaje_impto']==0){
                 number_format(0,2);
    	 		    }else{
                 number_format($folio1['porcentaje_impto'],2);
    	 		    }
    	 		    ?>
    	 		  </td>
    	 		  <td><?=number_format($folio1['impuesto'],2)?></td>
            <td><?=number_format($folio1['monto_cargo']+$folio1['impuesto'],2)?></td>
    	 		  <td><?=number_format($folio1['pagos_cargos'],2)?></td>
    	 		  <td><?=date($folio1['fecha_cargo'])?></td>
    	 		  <td><?=$folio1['usuario']?></td>
    	 		  <td style="text-align:right;">
              <div class="btn-group" role="group" aria-label="Basic example">
              <?php 
                if($folio1['factura_numero']==0){
                  if($nrohabi !== '9500'){ ?>
                    <button 
                      style="display:block"
                      id="btnAnulaCargo"
                      type="button" class="btn btn-danger btn-xs" 
                      data-toggle  ="modal" 
                      data-target  ="#myModalAnulaCargo" 
                      data-id      ="<?php echo $folio1['id_cargo']?>" 
                      data-descrip ="<?php echo $folio1['descripcion_cargo']?>" 
                      data-monto   ="<?php echo $folio1['monto_cargo']?>" 
                      data-impto   ="<?php echo $folio1['impuesto']?>" 
                      data-info    ="<?php echo $folio1['informacion_cargo']?>" 
                      data-pagos   ="<?php echo $folio1['pagos_cargos']?>" 
                      data-refer   ="<?php echo $folio1['referencia_cargo']?>" 
                      data-fecha   ="<?php echo $folio1['fecha_cargo']?>" 
                      data-reserva ="<?php echo $folio1['numero_reserva']?>" 
                      data-huesped ="<?php echo $folio1['id_huesped']?>" 
                      data-room    ="<?php echo $folio1['habitacion_cargo']?>" 
                      data-cant    ="<?php echo $folio1['cantidad_cargo']?>" 
                      data-tipo    ="<?php echo $folio1['tipo_codigo']?>" 
                      title="Anula Cargo Actual" >
                      <i class='glyphicon glyphicon-remove-circle'></i>
                    </button>
                    <?php 
                  }
                  ?>
                  <button type="button" class="btn btn-info btn-xs" 
                    data-toggle  ="modal" 
                    data-target  ="#myModalMoverCargo" 
                    data-id      ="<?php echo $folio1['id_cargo']?>" 
                    data-descrip ="<?php echo $folio1['descripcion_cargo']?>" 
                    data-monto   ="<?php echo $folio1['monto_cargo']?>" 
                    data-impto   ="<?php echo $folio1['impuesto']?>" 
                    data-info    ="<?php echo $folio1['informacion_cargo']?>" 
                    data-refer   ="<?php echo $folio1['referencia_cargo']?>" 
                    data-fecha   ="<?php echo $folio1['fecha_cargo']?>" 
                    data-reserva ="<?php echo $folio1['numero_reserva']?>" 
                    data-huesped ="<?php echo $folio1['id_huesped']?>" 
                    data-room    ="<?php echo $folio1['habitacion_cargo']?>" 
                    data-cant    ="<?php echo $folio1['cantidad_cargo']?>" 
                    data-tipo    ="<?php echo $folio1['tipo_codigo']?>" 
                    title="Movel a Otro Folio el Cargo Actual" >
                    <i class='fa fa-share'></i>
                  </button>
                  <button type="button" class="btn btn-success btn-xs" 
                    data-toggle  ="modal" 
                    data-target  ="#myModalTrasladarCargo" 
                    data-id      ="<?php echo $folio1['id_cargo']?>" 
                    data-descrip ="<?php echo $folio1['descripcion_cargo']?>" 
                    data-monto   ="<?php echo $folio1['monto_cargo']?>" 
                    data-impto   ="<?php echo $folio1['impuesto']?>" 
                    data-info    ="<?php echo $folio1['informacion_cargo']?>" 
                    data-refer   ="<?php echo $folio1['referencia_cargo']?>" 
                    data-fecha   ="<?php echo $folio1['fecha_cargo']?>" 
                    data-reserva ="<?php echo $folio1['numero_reserva']?>" 
                    data-huesped ="<?php echo $folio1['id_huesped']?>" 
                    data-room    ="<?php echo $folio1['habitacion_cargo']?>" 
                    data-cant    ="<?php echo $folio1['cantidad_cargo']?>" 
                    data-tipo    ="<?php echo $folio1['tipo_codigo']?>" 
                    data-pagos    ="<?php echo $folio1['pagos_cargos']?>" 
                    title="Trasladar el Cargo Actual a Otra Habitacion" >
                    <i class='fa fa-reply-all'></i>
                  </button>
                  <?php 
                  /*
                  if($folio1['numero_factura_cargo']!=''){ ?>
                    <button type="button" class="btn btn-warning btn-xs" 
                      data-toggle  ="modal" 
                      data-target  ="#myVerChequeCenta" 
                      data-id      ="<?php echo $folio1['id_cargo']?>" 
                      data-cheque  ="<?php echo $folio1['numero_factura_cargo']?>" 
                      onclick      = "imprimechequeCuenta('<?php echo $folio1['numero_factura_cargo']?>')"
                      title="Var cheque Cuenta POS" >
                      <i class='fa fa-file'></i>
                    </button>
                  <?php 
                  }
                  */
                }
               ?>
              </div>
    	 		  </td>
  		    </tr>
	      <?php 
      endforeach 
    ?>
 	</tbody>
   </table>
</div>
<div class="container-fluid" style="padding:5px;background-color:#dff0d8;margin-top:-15px">
	<div class="form-group">
    <label for="consumo" class="col-sm-2 control-label">Consumos</label>
    <div class="col-sm-2">
      <input type="text" style="text-align: right;" class="form-control" id="consumo<?=$folio?>" value="<?php echo number_format($consumos,2) ?>" readonly>
    </div>
    <label for="impto" class="col-sm-2 control-label">Impuesto</label>
    <div class="col-sm-2">
      <input type="text" style="text-align: right;" class="form-control" id="impto<?=$folio?>" placeholder="" value="<?php echo number_format($impto,2)  ?>" readonly>
    </div>
    <label for="abonos" class="col-sm-2 control-label">Abonos / Pagos</label>
    <div class="col-sm-2">
      <input type="text" style="text-align: right;" class="form-control" id="abonos<?=$folio?>" placeholder="" value="<?php echo number_format($pagos,2) ?>" readonly>
    </div>
  </div>
	<div class="form-group">
    <label for="total" class="col-sm-2 col-sm-offset-7 control-label" style="font-size:14px;">Total Folio</label>
    <div class="col-sm-3">
      <input type="text" style="font-size:14px;text-align: right;font-weight: 600" class="form-control" id="total<?=$folio?>" placeholder="" value="<?php echo number_format(($consumos+ $impto)-$pagos,2)?>" readonly>
      <input type="hidden" name="txtConsumoCta" id="txtConsumoCta" value="<?=$consumos?>">
      <input type="hidden" name="txtImptoCta" id="txtImptoCta" value="<?=$impto?>">
      <input type="hidden" name="txtAbonosCta" id="txtAbonosCta" value="<?=$pagos?>">
      <input type="hidden" name="txtSaldoCta" id="txtSaldoCta" value="<?=($consumos+ $impto)-$pagos?>">            
    </div>
  </div>
</div>