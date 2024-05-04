<?php 
  require '../../../res/php/app_topInventario.php'; 

  $numero = $_POST['numero'];
  $tipo   = $_POST['tipo'];
  $bodega = $_POST['bodega'];

  $movimientos = $inven->getMovimientos($tipo,$numero, $bodega);

?>
<div class="container-fluid">
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
        $totalMov = 0;
        foreach ($movimientos as $salida) { 
          $totalMov = $totalMov + $salida['valor_total'];
          ?>
          <tr style='font-size:12px'>
            <td align="left"><?php echo $inven->buscaAlmacen($salida['id_bodega']); ?></td>
            <td><?php echo $salida['nombre_producto'];?></td>
            <td><?php echo $inven->buscaUnidad($salida['unidad_alm']); ?></td> 
            <td align="right"><?php echo number_format($salida['cantidad'],0); ?></td>
            <td align="right"><?php echo number_format($salida['valor_unitario'],2); ?></td>
            <td align="right"><?php 
            if($salida['impuesto']==''){
              echo number_format(0,2); 
            }else{
              echo number_format($salida['impuesto'],2); 
            }
            ?></td>
            <td align="right"><?php echo number_format($salida['valor_total'],2); ?></td>
          </tr>
          <?php 
        }
        ?>
      </tbody>
    </table>
  </div>
  <table style="font-size:2rem;">
    <tr class="derecha">
      <td>Total Movimiento</td>
      <td><?php echo number_format($totalMov,2)?></td>
    </tr>
  </table>
</div>
  
