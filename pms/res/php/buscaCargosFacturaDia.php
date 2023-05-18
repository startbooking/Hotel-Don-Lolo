<?php

require '../../../res/php/titles.php';
require '../../../res/php/app_topHotel.php';

$factura = $_POST['factura'];
$reserva = $_POST['reserva'];
$perfil = $_POST['perfil'];

$cargos = $hotel->getBuscaCargosFacturaDia($factura, $reserva, $perfil);
?>

<div class="container-fluid" style="padding:0">
	<div class="table-responsive-lg" style="height: 340px;overflow: auto;">
	  <table id="example1" class="table table-bordered" style="font-size:9px">
	 	<thead class="warning">
	 	  <tr>
	  		<th>Detalle</th>
	  		<th>Consumos</th>
	  		<th>Impuestos</th>
	      <th>Total Cargo</th>
	  		<th>Abonos</th>
	  		<th>Fecha</th>
	  		<th>Usuario</th>
	  		<th>DOC</th>
	    </tr>
	 	</thead>
	 	<tbody>
		  <?php
          $consumos = 0;
$impto = 0;
$pagos = 0;
foreach ($cargos as $folio1) {
    $consumos = $consumos + $folio1['monto_cargo'];
    $impto = $impto + $folio1['impuesto'];
    $pagos = $pagos + $folio1['pagos_cargos'];
    $folio = $folio1['folio_cargo'];
    ?>
	          <tr align="right">
	     			  <td align="left"><?php echo $folio1['descripcion_cargo']; ?></td>
	    	 		  <td><?php echo number_format($folio1['monto_cargo'], 2); ?></td>
	    	 		  <td><?php echo number_format($folio1['impuesto'], 2); ?></td>
	            <td><?php echo number_format($folio1['monto_cargo'] + $folio1['impuesto'], 2); ?></td>
	    	 		  <td><?php echo number_format($folio1['pagos_cargos'], 2); ?></td>
	    	 		  <td><?php echo date($folio1['fecha_cargo']); ?></td>
	    	 		  <td><?php echo $folio1['usuario']; ?></td>
	    	 		  <td>
	    	 		  	<?php
    if ($folio1['numero_factura_cargo'] != 0) { ?>
                  <button type="button" class="btn btn-warning btn-xs" 
                    data-toggle  ="modal" 
                    data-target  ="#verCargosFacturaDia" 
                    data-cheque  ="<?php echo $folio1['numero_factura_cargo']; ?>" 
                    onclick      = "imprimechequeCuenta(<?php echo $folio1['numero_factura_cargo']; ?>)"
                    title="Var cheque Cuenta POS" >
                    <i class='fa fa-file'></i>
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
	</div>
	<div class="container-fluid" style="padding:5px;background-color:#dff0d8;margin-top:-15px;font-size:11px">
		<div class="form-group">
	    <label for="consumo" class="col-sm-2 control-label">Consumos</label>
	    <div class="col-sm-4">
	      <input type="text" style="text-align: right;" class="form-control" id="consumo<?php echo $folio; ?>" value="<?php echo number_format($consumos, 2); ?>" readonly>
	    </div>
	    <label for="impto" class="col-sm-2 control-label">Impuesto</label>
	    <div class="col-sm-4">
	      <input type="text" style="text-align: right;" class="form-control" id="impto<?php echo $folio; ?>" placeholder="" value="<?php echo number_format($impto, 2); ?>" readonly>
	    </div>
	  </div>    			
		<div class="form-group">
	    <label for="abonos" class="col-sm-2 control-label">Abonos / Pagos</label>
	    <div class="col-sm-4">
	      <input type="text" style="text-align: right;" class="form-control" id="abonos<?php echo $folio; ?>" placeholder="" value="<?php echo number_format($pagos, 2); ?>" readonly>
	    </div>
	    <label for="total" class="col-sm-2 control-label" style="font-size:11px;">Total Folio</label>
	    <div class="col-sm-4">
	      <input type="text" style="font-size:14px;text-align: right;font-weight: 600" class="form-control" id="total<?php echo $folio; ?>" placeholder="" value="<?php echo number_format(($consumos + $impto) - $pagos, 2); ?>" readonly>
	    </div>
	  </div>
	</div>
</div>
