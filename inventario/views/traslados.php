<?php 
$entradas = $inven->getMovimientosTraslados(1);

?>

<div class="content-wrapper"> 
  <section class="content">
    <div class="panel panel-success">
      <div class="panel-heading">
        <div class="row"> 
          <div class="col-lg-6">
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_INV?>">              
            <input type="hidden" name="ubicacion" id="ubicacion" value="traslados">
            <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-calendar"></i> Traslados de Inventario </h3>
          </div> 
          <div class="col-lg-6" align="right">
            <a 
              class="btn btn-success" 
              href="movimientoTraslado">
              <i class="fa fa-plus" aria-hidden="true"></i>
               Nuevo Traslado
            </a>
            <button class="btn btn-info" onclick="exportTableToExcel('tablaentradas')"><i class="glyphicon glyphicon-th" aria-hidden="true"></i> Exportar Movimientos</button>
          </div> 
        </div> 
      </div>
      <div class="panel-body">
        <div id="imprimeRegistroHotelero"></div>
        <div class='table-responsive'>
          <table id="example1" class="table modalTable table-condensed">
            <thead>
              <tr class="warning">
                <td>Traslado Nro</td>
                <td>Fecha</td>
                <td>Tipo Movimiento</td>
                <td>Desde Almacen</td>
                <td>Destino Almacen</td>
                <td>Total</td>
                <td>Estado</td>
                <td style="width: 9%" align="center">Accion</td>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($entradas as $entrada) { ?>
                <tr style='font-size:12px'>
                  <td><?php echo $entrada['numero'];?></td>
                  <td><?php echo $entrada['fecha_movimiento']; ?></td>
                  <td><?php echo $entrada['descripcion_tipo']; ?></td>
                  <td><?php echo $entrada['descripcion_bodega']; ?></td>
                  <td><?php echo $inven->buscaAlmacen($entrada['id_proveedor']); ?></td>
                  <td align="right"><?php echo number_format($entrada['total'],2); ?></td>
                  <td align="left"><span 
                    <?php 
                      if($entrada['estado']==0){ ?>
                        class="badge btn btn-danger" 
                        <?php 
                      }else{ ?>
                        class="badge btn btn-success" 
                        <?php 
                      }
                    ?>
                    ><?php echo estadoMovimiento($entrada['estado']); ?></span></td>
                  <td align="center">
                    <div class="btn-group">
                      <button 
                        type             = "button" 
                        class            = "btn btn-xs btn-warning" 
                        data-toggle      = "modal" 
                        data-target      = "#myModalMostrarProductos" 
                        data-numero      = "<?= $entrada['numero'];?>"
                        data-tipo        = "<?= $entrada['tipo']?>"
                        data-movimiento  = "<?= $entrada['movimiento']; ?>"
                        data-descripcion = "<?= $entrada['descripcion_tipo']; ?>"
                        data-bodega      = "<?= $entrada['id_bodega']; ?>"
                        title            = "Ver productos del Movimiento"
                        onclick          = 'btnMuestraProductos()'
                        >
                        <i class="fa fa-list-alt" aria-hidden="true"></i>
                      </button>
                      <button 
                        onclick="imprimeMovimiento('<?=$entrada['numero']?>',3)" 
                        title="Imprime Movimiento" 
                        class="btn btn-xs btn-info" 
                        type="button">
                        <i class="fa fa-print" aria-hidden="true"></i>
                      </button>  
                      <?php 
                        if($entrada['estado']==1){ ?>
                          <button onclick="anulaMovimiento(<?=$entrada['numero']?>,<?=$entrada['tipo']?>,<?= $entrada['id_bodega']; ?>)" title="Anula Movimiento" class="btn btn-xs btn-danger" type="button"><i class="fa fa-times" aria-hidden="true"></i></button>  
                          <?php 
                        }
                      ?>
                    </div>
                  </td>
                </tr>
                <?php 
              }
              ?>
            </tbody>
          </table>
        </div>
        <table id="tablaentradas" class="table modalTable table-condensed" style="display:none">
          <thead>
            <tr class="warning">
              <td>Traslado Nro</td>
              <td>Fecha</td>
              <td>Tipo Movimiento</td>
              <td>Desde Almacen</td>
              <td>Destino Almacen</td>
              <td>Total</td>
              <td>Estado</td>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach ($entradas as $entrada) { ?>
                <tr style='font-size:12px'>
                  <td><?php echo $entrada['numero'];?></td>
                  <td><?php echo $entrada['fecha_movimiento']; ?></td>
                  <td><?php echo $entrada['descripcion_tipo']; ?></td>
                  <td><?php echo $entrada['descripcion_bodega']; ?></td>
                  <td><?php echo $inven->buscaAlmacen($entrada['id_proveedor']); ?></td>
                  <td><?php echo number_format($entrada['total'],2); ?></td>
                  <td><span class="badge" 
                    <?php 
                    if($entrada['estado']==0){ ?>
                      style="background-color: brown"
                      <?php 
                    }else{ ?>
                      style="background-color: blue"                      
                      <?php 
                    }
                    ?>
                    ><?php echo estadoMovimiento($entrada['estado']); ?></span></td>
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
