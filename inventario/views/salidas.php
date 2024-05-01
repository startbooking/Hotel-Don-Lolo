<?php
$salidas = $inven->getSalidasInventarios(2);

?>

<div class="content-wrapper"> 
  <section class="content">
    <div class="panel panel-success">
      <div class="panel-heading">
        <div class="row"> 
          <div class="col-lg-6 col-xs-12">
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?php echo BASE_INV; ?>">              
            <input type="hidden" name="ubicacion" id="ubicacion" value="salidas">
            <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-calendar"></i> Salidas de Inventario </h3>
          </div> 
          <div class="col-lg-6 col-xs-12" align="right">
            <a 
              class="btn btn-success" 
              href="movimientoSalidas">
              <i class="fa fa-plus" aria-hidden="true"></i>
               Nueva Salida
            </a>
            <button class="btn btn-info" onclick="exportTableToExcel('tablasalidas')"><i class="glyphicon glyphicon-th" aria-hidden="true"></i> Exportar Movimientos</button>
          </div> 
        </div>
      </div>
      <div class="panel-body">
        <div id="imprimeRegistroHotelero"></div>
        <div class='table-responsive'>
          <table id="example1" class="table modalTable table-condensed" style="width:100%;">
            <thead>
              <tr class="warning">
                <td>Salida Nro</td>
                <td>Fecha</td>
                <td>Almacen</td>
                <td>Tipo Movimiento</td>
                <td>Centro de Costo</td>
                <td>Total</td>
                <td>Estado</td>
                <td style="width: 11%" align="center">Accion</td>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($salidas as $salida) { ?>
                <tr style='font-size:12px'>
                  <td><?php echo $salida['numero']; ?></td>
                  <td><?php echo $salida['fecha_movimiento']; ?></td>
                  <td><?php echo $salida['descripcion_bodega']; ?></td>
                  <td><?php echo $salida['descripcion_tipo']; ?></td>
                  <td><?php echo $salida['descripcion_centro']; ?></td>
                  <td class="derecha"><?php echo number_format($salida['total'], 2); ?></td>
                  <td><span 
                    <?php
                      if ($salida['estado'] == 0) { ?>
                        class="badge btn btn-danger" 
                        <?php
                      } else { ?>
                        class="badge btn btn-success" 
                        <?php
                      }
                  ?>
                    ><?php echo estadoMovimiento($salida['estado']); ?></span></td>
                  <td class="centro">
                    <button 
                      type             = "button" 
                      class            = "btn btn-xs btn-warning" 
                      data-toggle      = "modal" 
                      data-target      = "#myModalMostrarProductos" 
                      data-numero      = "<?php echo $salida['numero']; ?>"
                      data-tipo        = "<?php echo $salida['tipo']; ?>"
                      data-movimiento  = "<?php echo $salida['movimiento']; ?>"
                      data-descripcion = "<?php echo $salida['descripcion_tipo']; ?>"
                      data-bodega      = "<?php echo $salida['id_bodega']; ?>"
                      title            = "Ver productos del Movimiento"
                      onclick          = 'btnMuestraProductos()'
                      >
                      <i class="fa fa-list-alt" aria-hidden="true"></i>
                    </button>
                    <button onclick="imprimeMovimiento('<?php echo $salida['numero']; ?>',2)" title="Imprime Movimiento" class="btn btn-xs btn-info" type="button"><i class="fa fa-print" aria-hidden="true"></i></button>  
                    <?php
                    if ($salida['estado'] == 1) { ?>
                      <button 
                        onclick="anulaMovimiento(<?php echo $salida['numero']; ?>,<?php echo $salida['tipo']; ?>,<?php echo $salida['id_bodega']; ?>)" 
                        title="Anula Movimiento" 
                        class="btn btn-xs btn-danger" 
                        type="button">
                        <i class="fa fa-times" aria-hidden="true"></i>
                      </button>  
                      <?php
                    }
                  ?>
                    <!-- <div class="btn-toolbar" role="toolbar">
                      <div class="btn-group" role="group">
                      </div>
                      <div class="btn-group" role="group" aria-label="...">
                      </div>
                    </div> -->
                  </td>
                </tr>
                <?php
              }
?>
            </tbody>
          </table>
        </div>
        <table id="tablasalidas" class="table modalTable table-condensed" style="display:none">
          <thead>
            <tr class="warning">
              <td>Salida Nro</td>
              <td>Fecha</td>
              <td>Almacen</td>
              <td>Tipo Movimiento</td>
              <td>Proveedor</td>
              <td>Total</td>
              <td>Estado</td>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($salidas as $salida) { ?>
              <tr style='font-size:12px'>
                <td><?php echo $salida['numero']; ?></td>
                <td><?php echo $salida['fecha_movimiento']; ?></td>
                <td><?php echo $salida['descripcion_tipo']; ?></td>
                <td><?php echo $salida['descripcion_centro']; ?></td>
                <td><?php echo number_format($salida['total'], 2); ?></td>
                <td><?php echo estadoMovimiento($salida['estado']); ?></td>
              </tr>
              <?php
            }
?>
          </tbody>
        </table>
      </div>
    </div> 
  </section>
</div>
