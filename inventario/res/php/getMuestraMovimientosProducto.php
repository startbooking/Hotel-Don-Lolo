<?php
  require_once '../../../res/php/app_topInventario.php'; 
  $id        = $_POST['id'];
  $bodega    = $_POST['bodega'];
  $productos = $inven->getBuscaProductoMovimiento($id,$bodega);

?> 

 <table id="example1" class="table table-bordered">
    <thead>
      <tr class="warning">
        <td>Numero</td>
        <td>Fecha</td>
        <td>Movimiento</td>
        <td>Unidad</td>
        <td>Cantidad</td>
        <td>Valor Unitario</td>
        <td>Impuesto</td>
        <td>Valor Total</td>
      </tr>
    </thead>
    <tbody >
    	<?php 
		  foreach ($productos as $producto) { ?>
			    <tr style='font-size:12px'>
            <td align="right"><?php echo $producto['numero']; ?></td> 
            <td><?php echo $producto['fecha_movimiento']; ?></td> 
            <td><?php echo $producto['descripcion_tipo']; ?></td> 
            <td><?php echo $inven->buscaUnidad($producto['unidad_alm']); ?></td> 
            <td align="right"><?php echo number_format($producto['cantidad'],2); ?></td>
            <td align="right"><?php echo number_format($producto['valor_unitario'],2); ?></td>
            <td align="right"><?php echo number_format($producto['impuesto'],2); ?></td>
            <td align="right"><?php echo number_format($producto['valor_total'],2); ?></td>
			    </tr>
			    <?php 
			  }
    	 ?>
    </tbody>                  
  </table>
