<?php 
  $entradas = $inven->getAjustesInventarios(4);
?>

<div class="content-wrapper"> 
  <section class="content">
    <div class="panel panel-success">
      <div class="panel-heading">
        <div class="row"> 
          <div class="col-lg-6">
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_INV?>">              
            <input type="hidden" name="ubicacion" id="ubicacion" value="ajustes">
            <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-calendar"></i> Ajustes de Inventario </h3>
          </div> 
          <div class="col-lg-6" align="right">
            <a 
              class="btn btn-success" 
              href="movimientoAjustes">
              <i class="fa fa-plus" aria-hidden="true"></i> Nuevo Ajuste 
            </a>
            <button class="btn btn-info" onclick="exportarJSONaExcel(<?php echo htmlspecialchars(json_encode($entradas)); ?>, 'tablaAjustes')"><i class="glyphicon glyphicon-th" aria-hidden="true"></i> Exportar Movimientos</button>
          </div> 
        </div>
      </div>
      <div class="panel-body">
        <div id="imprimeRegistroHotelero"></div>
        <div class='table-responsive'>
          <table id="example1" class="table modalTable table-condensed" >
            <thead>
              <tr class="warning">
                <td>Ajuste Nro</td>
                <td>Fecha</td>
                <td>Almacen</td>
                <td>Tipo Movimiento</td>
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
                  <td><?php echo $entrada['descripcion_bodega']; ?></td>
                  <td><?php echo $entrada['descripcion_tipo']; ?></td>                  
                  <td style="text-align:right;"><?php echo number_format($entrada['total'],2); ?></td>
                  <td>
                  <span
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
                  <td style="width: 11%"align="center">
                    <div class="btn-toolbar" role="toolbar">
                      <div class="btn-group" role="group">
                        <button 
                          type             = "button" 
                          class            = "btn btn-xs btn-warning" 
                          data-toggle      = "modal" 
                          data-target      = "#myModalMostrarProductos" 
                          data-numero      = "<?php echo $entrada['numero'];?>"
                          data-tipo        = "<?=$entrada['tipo']?>"
                          data-movimiento  = "<?php echo $entrada['movimiento']; ?>"
                          data-descripcion = "<?php echo $entrada['descripcion_tipo']; ?>"
                          data-bodega      = "<?php echo $entrada['id_bodega']; ?>"
                          title            = "Ver productos del Movimiento"
                          onclick          = 'btnMuestraProductos()'
                          >
                          <i class="fa fa-list-alt" aria-hidden="true"></i>
                        </button>
                        <button onclick="imprimeMovimiento(<?=$entrada['numero']?>,4)" title="Imprime Movimiento" class="btn btn-xs btn-info" type="button"><i class="fa fa-print" aria-hidden="true"></i></button>  
                      </div>
                      <div class="btn-group" role="group" aria-label="...">
                      <?php 
                        if($entrada['estado']==1){ ?>
                          <button 
                            onclick="anulaMovimiento(<?=$entrada['numero']?>,<?=$entrada['tipo']?>,<?= $entrada['id_bodega']; ?>)" 
                            title="Anula Movimiento" 
                            class="btn btn-xs btn-danger" 
                            type="button">
                            <i class="fa fa-times" aria-hidden="true"></i>
                          </button>  
                          <?php 
                        }
                      ?>
                      </div>
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
              <td>Ajuste Nro</td>
              <td>Fecha</td>
              <td>Almacen</td>
              <td>Tipo Movimiento</td>
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
                <td><?php echo $entrada['descripcion_bodega']; ?></td>
                <td><?php echo $entrada['descripcion_tipo']; ?></td>                  
                <td style="text-align:right;"><?php echo number_format($entrada['total'],2); ?></td>
                <td><?php echo estadoMovimiento($entrada['estado']); ?></td>
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
