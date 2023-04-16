<?php
  require '../../../res/php/app_topInventario.php'; 
	$numero    = $_POST['numero'];
	$bodega    = $_POST['bodega'];
	$productos = $inven->getBuscaProductosRequisicion($numero);

?> 

<table id="example1" class="table table-condensed">
  <thead>
    <tr class="active" style="font-weight: bold">
      <td>Producto</td>
      <td>Unidad</td>
      <td>Cantidad</td>
      <td>Valor Unitario</td>
      <td>Valor Total</td>
    </tr>
  </thead>
  <tbody >
    <?php 
    foreach ($productos as $producto) { ?>
	    <tr style='font-size:12px'>
        <td><?php echo $producto['nombre_producto']; ?></td> 
        <td><?php echo $inven->buscaUnidad($producto['id_unidad']); ?></td> 
        <td align="right"><?php echo number_format($producto['cantidad'],2); ?></td>
        <td align="right"><?php echo number_format($producto['valor_unitario'],2); ?></td>
        <td align="right"><?php echo number_format($producto['valor_total'],2);?></td>
      </tr>
      <?php 
    }
    ?>
  </tbody>                  
</table>
