<?php 
  require '../../../../res/php/app_topPos.php'; 

  $numero = $_POST['numero'];
  $tipo   = $_POST['tipo'];
  $bodega = $_POST['bodega'];

  $movimientos = $inven->getMovimientos($tipo,$numero, $bodega);

?>
</div>
  <div class='table-responsive'>
    <table id="example1" class="table modalTable table-striped table-condensed">
      <thead>
        <tr class="warning">
          <td>Almacen</td>
          <td>Producto</td>
          <td>Unidad</td>
          <td>Cantidad</td>
          <td>Valor Unitario</td>
          <td>Impuesto</td>
          <td>Valor Total</td>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($movimientos as $salida) { ?>
          <tr style='font-size:12px'>
            <td align="left"><?php echo $inven->buscaAlmacen($salida['id_bodega']); ?></td>
            <td><?php echo $salida['nombre_producto'];?></td>
            <td><?php echo $inven->buscaUnidad($salida['unidad_alm']); ?></td> 
            <td align="right"><?php echo number_format($salida['cantidad'],0); ?></td>
            <td align="right"><?php echo number_format($salida['valor_unitario'],2); ?></td>
            <td align="right"><?php echo number_format($salida['impuesto'],2); ?></td>
            <td align="right"><?php echo number_format($salida['valor_total'],2); ?></td>
          </tr>
          <?php 
        }
        ?>
      </tbody>
    </table>
  </div>
<div class="container">
  
