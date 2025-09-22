<?php
$entradas = $inven->getMovimientosInventarios(1);
?>

<div class="content-wrapper">
  <section class="content">
    <div class="panel panel-success">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-6 col-xs-12">
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?php echo BASE_INV; ?>">
            <input type="hidden" name="ubicacion" id="ubicacion" value="entradas">
            <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-calendar"></i> Entradas de Inventario </h3>
          </div>
          <div class="col-lg-6 col-xs-12" align="right">
            <a class="btn btn-info" href="importaXML">
              <i class="fa fa-plus" aria-hidden="true"></i>
              Importar XML
            </a>
            <a class="btn btn-success" href="movimientoEntradas">
              <i class="fa fa-plus" aria-hidden="true"></i>
              Nueva Entrada
            </a>
            <button class="btn btn-info" onclick="exportarJSONaExcel(<?php echo htmlspecialchars(json_encode($entradas));?>, 'tablaEntradas')"><i class="glyphicon glyphicon-th" aria-hidden="true"></i> Exportar Movimientos</button>
          </div>

        </div>
      </div>
      <div class="panel-body">
        <div id="imprimeRegistroHotelero"></div>
        <div class='table-responsive'>
          <table id="example1" class="table modalTable table-condensed" style="width:100%;">
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
                <td style="width: 9%" align="center">Accion</td>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($entradas as $entrada) { ?>
                <tr style='font-size:12px'>
                  <td><?php echo $entrada['numero']; ?></td>
                  <td><?php echo $entrada['fecha_movimiento']; ?></td>
                  <td><?php echo $entrada['descripcion_bodega']; ?></td>
                  <td><?php echo $entrada['descripcion_tipo']; ?></td>
                  <td><?php
                      if ($entrada['traslado'] == 1) {
                        echo $inven->buscaAlmacen($entrada['id_proveedor']);
                      } else {
                        echo $inven->buscaProveedor($entrada['id_proveedor']);
                      }
                      ?></td>

                  <td class="derecha"><?php echo number_format($entrada['subtotal'], 2); ?></td>
                  <td class="derecha"><?php echo number_format($entrada['impto'], 2); ?></td>
                  <td class="derecha"><?php echo number_format($entrada['total'], 2); ?></td>
                  <td>
                    <span 
                      <?php
                        if ($entrada['estado'] == 0) { ?> 
                        class="badge btn btn-danger" 
                      <?php
                      } else { 
                        ?> class="badge btn btn-success" <?php
                      }
                      ?>>
                      <?php echo estadoMovimiento($entrada['estado']); ?>
                    </span>
                  </td>
                  <td style="text-align:center;">
                    <button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#myModalMostrarProductos" data-numero="<?php echo $entrada['numero']; ?>" data-tipo="<?php echo $entrada['tipo']; ?>" data-movimiento="<?php echo $entrada['movimiento']; ?>" data-descripcion="<?php echo $entrada['descripcion_tipo']; ?>" data-bodega="<?php echo $entrada['id_bodega']; ?>" title="Ver productos del Movimiento" onclick='btnMuestraProductos()'>
                      <i class="fa fa-list-alt" aria-hidden="true"></i>
                    </button>
                    <button onclick="imprimeMovimiento(<?php echo $entrada['numero']; ?>,<?php echo $entrada['movimiento']; ?>)" title="Imprime Movimiento" class="btn btn-xs btn-info" type="button"><i class="fa fa-print" aria-hidden="true"></i></button>
                    <?php
                    if ($entrada['estado'] == 1) { ?>
                      <button onclick="anulaMovimiento(<?php echo $entrada['numero']; ?>,<?php echo $entrada['tipo']; ?>,<?php echo $entrada['id_bodega']; ?>)" title="Anula Movimiento" class="btn btn-xs btn-danger" type="button">
                        <i class="fa fa-times" aria-hidden="true"></i>
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
      </div>
    </div>
  </section>
</div>