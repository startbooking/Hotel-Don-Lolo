<?php
$pedidos = $inven->getPedidos();

?>
 
<div class="content-wrapper"> 
  <section class="content">
    <div class="panel panel-success">
      <div class="panel-heading">
        <div class="row"> 
          <div class="col-lg-6">
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?php echo BASE_INV; ?>">              
            <input type="hidden" name="ubicacion" id="ubicacion" value="pedidos">
            <input type="hidden" name="titulo" id="titulo" value="Pedidos">
            <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-calendar"></i> Pedidos </h3>
          </div> 
          <div class="col-lg-6" align="right">
            <a 
              class="btn btn-success" 
              href="productoPedido">
              <i class="fa fa-plus" aria-hidden="true"></i>
               Nueva Pedido
            </a>
          </div> 
        </div>
      </div>
      <div class="panel-body">
        <div id="imprimeRegistroHotelero"></div>
        <div class='table-responsive'>
          <table id="example1" class="table modalTable table-condensed" >
            <thead>
              <tr class="warning">
                <td>Numero</td>
                <td>Fecha</td>
                <!-- <td>Almacen</td> -->
                <td>Proveedor</td>
                <td>Valor</td>
                <td>Estado</td>
                <td style="width: 9%" align="center">Accion</td>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($pedidos as $pedido) { ?>
                <tr style='font-size:12px'>
                  <td><?php echo $pedido['numero_ped']; ?></td>
                  <td><?php echo $pedido['fecha_ped']; ?></td>
                  <!-- <td><?php echo $inven->buscaAlmacen($pedido['id_centrocosto']); ?></td>                   -->
                  <td><?php echo $pedido['empresa']; ?></td>
                  <td><?php echo number_format($pedido['total'], 2); ?></td>
                  <td><span
                    <?php
                    if ($pedido['estado'] == 0) { ?>
                      class="badge btn btn-danger" 
                      <?php
                    } else { ?>
                      class="badge btn btn-success" 
                      <?php
                    }
                  ?>
                    ><?php echo estadoPedido($pedido['estado']); ?></span></td>
                  <td>
                        <button 
                          type             = "button" 
                          class            = "btn btn-xs btn-warning" 
                          data-toggle      = "modal" 
                          data-target      = "#myModalMostrarProductosRequisicion" 
                          data-numero      = "<?php echo $pedido['numero_ped']; ?>"
                          data-proveedor   = "<?php echo $pedido['id_proveedor']; ?>"                      
                          title            = "Ver productos del Pedido"
                          onclick          = 'muestraProductosPedido()'
                          >
                          <i class="fa fa-list-alt" aria-hidden="true"></i>
                        </button>
                        <button onclick="imprimeMovimiento(<?php echo $pedido['numero_ped']; ?>,6)" title="Imprime Pedidos" class="btn btn-xs btn-info" type="button"><i class="fa fa-print" aria-hidden="true"></i></button>  
                      <?php
                      if ($pedido['estado'] == 1) { ?>
                          <button 
                            onclick = "anulaPedido(<?php echo $pedido['numero_ped']; ?>)" 
                            class   = "btn btn-xs btn-danger" 
                            type    = "button"
                            title   = 'Anular Presente Pedido'
                            >
                            <i class="fa fa-times" aria-hidden="true"></i>
                          </button>  
                          <?php
                      }
                  ?>
                    <!-- <div class="btn-toolbar" role="toolbar">
                      <div class="btn-group" role="group">
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
        <table id="tablaentradas" class="table modalTable table-condensed" style="display:none">
          <thead>
            <tr class="warning">
                <td>Entrada Nro</td>
                <td>Fecha</td>
                <td>Almacen</td>
                <td>Tipo Movimiento</td>
                <td>Proveedor</td>
                <td>Subtotal</td>
                <td>Impuesto</td>
                <td>Total</td>
              <td>Estado</td>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($pedidos as $pedido) { ?>
              <tr style='font-size:12px'>
                  <td><?php echo $pedido['numero_ped']; ?></td>
                  <td><?php echo $pedido['fecha_ped']; ?></td>
                  <td><?php echo $inven->buscaCentroCosto($pedido['id_centrocosto']); ?></td>
                  <td><?php echo $inven->buscaAlmacen($pedido['id_centrocosto']); ?></td>                  
                  <td align="right"><?php echo number_format($pedido['total'], 2); ?></td>
                  <td><?php echo estadoPedido($pedido['estado']); ?></td>
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
