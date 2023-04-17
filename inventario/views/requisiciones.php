<?php
$entradas = $inven->getRequisiciones();

?>

<div class="content-wrapper"> 
  <section class="content">
    <div class="panel panel-success">
      <div class="panel-heading">
        <div class="row"> 
          <div class="col-lg-6"> 
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?php echo BASE_INV; ?>">              
            <input type="hidden" name="ubicacion" id="ubicacion" value="requisiciones">
            <input type="hidden" name="titulo" id="titulo" value="Requisiciones">
            <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-calendar"></i> Requisiciones </h3>
          </div> 
          <div class="col-lg-6" align="right">
            <a 
              class="btn btn-success" 
              href="productoRequisicion">
              <i class="fa fa-plus" aria-hidden="true"></i>
               Nueva Requisicion
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
                <td>Centro de Costo</td>
                <td>Almacen</td>
                <td>Valor</td>
                <td>Estado</td>
                <td style="width: 9%" align="center">Accion</td>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($entradas as $entrada) { ?>
                <tr style='font-size:12px'>
                  <td><?php echo $entrada['numero_req']; ?></td>
                  <td><?php echo $entrada['fecha_req']; ?></td>
                  <td><?php echo $inven->buscaCentroCosto($entrada['id_centrocosto']); ?></td>
                  <td><?php echo $inven->buscaAlmacen($entrada['id_bodega']); ?></td>                  
                  <td><?php echo number_format($entrada['total'], 2); ?></td>
                  <td><span
                    <?php
                    if ($entrada['estado'] == 0) { ?>
                      class="badge btn btn-danger" 
                      <?php
                    } else { ?>
                      class="badge btn btn-success" 
                      <?php
                    }
                  ?>
                    ><?php echo estadoRequisicion($entrada['estado']); ?></span></td>
                  <td>
                        <button 
                          type             = "button" 
                          class            = "btn btn-xs btn-warning" 
                          data-toggle      = "modal" 
                          data-target      = "#myModalMostrarProductosRequisicion" 
                          data-numero      = "<?php echo $entrada['numero_req']; ?>"
                          data-bodega      = "<?php echo $entrada['id_bodega']; ?>"
                          title            = "Ver productos de la Requisicion"
                          onclick          = 'muestraProductosRequisicion()'
                          > 
                          <i class="fa fa-list-alt" aria-hidden="true"></i>
                        </button>
                        <button onclick="imprimeMovimiento('<?php echo $entrada['numero_req']; ?>',5)" title="Imprime Requisicion" class="btn btn-xs btn-info" type="button"><i class="fa fa-print" aria-hidden="true"></i></button>  
                        <?php
                          if ($entrada['estado'] == 1) { ?>
                            <button 
                              onclick="anulaRequisicion(<?php echo $entrada['numero_req']; ?>)" 
                              title="Anula Requisicion" 
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
            foreach ($entradas as $entrada) { ?>
              <tr style='font-size:12px'>
                  <td><?php echo $entrada['numero_req']; ?></td>
                  <td><?php echo $entrada['fecha_req']; ?></td>
                  <td><?php echo $inven->buscaCentroCosto($entrada['id_centrocosto']); ?></td>
                  <td><?php echo $inven->buscaAlmacen($entrada['id_bodega']); ?></td>                  
                  <td align="right"><?php echo number_format($entrada['total'], 2); ?></td>
                  <td><?php echo estadoRequisicion($entrada['estado']); ?></td>
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
