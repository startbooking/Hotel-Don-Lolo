<?php
$centros = $admin->getCentrosCosto();
$bodegas = $admin->getBodegas();
$codigos = $admin->getCodigosVentas(1);

?>

<div class="content-wrapper"> 
  <section class="content">
    <div class="panel panel-success">
      <div class="panel-heading"> 
        <div class="row">
          <div class="col-lg-6">
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?php echo BASE_ADM; ?>">                  
            <input type="hidden" name="ubicacion" id="ubicacion" value="ambientes">
            <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-cube"></i> Ambientes POS </h3>
          </div> 
        </div>
      </div>
      <div class="panel-body">
        <div class="datos_ajax_delete"></div>
        <div class="container-fluid">              
          <div class="container-fluid"> 
            <table id="example1" class="table table-bordered">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Bodega</th>
                  <th>Factura</th>
                  <th>Orden</th>
                  <th>Comanda</th>
                  <th>Centro de Costo</th>
                  <th>Estado</th>
                  <th>Accion</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($ambientes as $ambiente) { ?> 
                  <tr  align="right">
                    <td align="left"><?php echo $ambiente['nombre']; ?></td>
                    <td align="left" style=""><?php echo $admin->getNombreBodega($ambiente['id_bodega']); ?></td>
                    <td><?php echo number_format($ambiente['conc_factura']); ?></td>
                    <td><?php echo number_format($ambiente['conc_orden']); ?></td>
                    <td><?php echo number_format($ambiente['conc_comanda']); ?></td>
                    <td align="left"><?php echo $admin->getCentroCosto($ambiente['id_centrocosto']); ?></td>
                    <td><?php echo estadoAmbiente($ambiente['active_at']); ?></td>
                    <td align="center">
                      <div class="btn-toolbar" role="toolbar" aria-label="...">
                        <div class="btn-group" role="group" aria-label="...">
                          <button type="button" class="btn btn-info btn-xs" 
                            data-toggle ="modal" 
                            data-target ="#myModalModificaAmbiente" 
                            data-id     ="<?php echo $ambiente['id_ambiente']; ?>" 
                            data-desc   ="<?php echo $ambiente['nombre']; ?>" 
                            data-pref   ="<?php echo $ambiente['prefijo']; ?>" 
                            data-fact   ="<?php echo $ambiente['conc_factura']; ?>" 
                            data-orde   ="<?php echo $ambiente['conc_orden']; ?>" 
                            data-coma   ="<?php echo $ambiente['conc_comanda']; ?>" 
                            data-impu   ="<?php echo $ambiente['impuesto']; ?>" 
                            data-bode   ="<?php echo $ambiente['id_bodega']; ?>" 
                            data-cent   ="<?php echo $ambiente['id_centrocosto']; ?>" 
                            data-vent   ="<?php echo $ambiente['codigo_venta']; ?>" 
                            data-prop   ="<?php echo $ambiente['codigo_propina']; ?>" 
                            data-logo   ="<?php echo $ambiente['logo']; ?>" 
                            title       ="Modificar el Ambiente Actual" >
                            <i class='fa fa-pencil-square'></i>
                          </button>
                          <!-- <button type="button" class="btn btn-warning btn-xs" 
                            data-toggle ="modal" 
                            data-target ="#myModalEliminaAmbiente" 
                            data-id     ="<?php echo $ambiente['id_ambiente']; ?>" 
                            data-desc   ="<?php echo $ambiente['nombre']; ?>" 
                            data-pref   ="<?php echo $ambiente['prefijo']; ?>" 
                            data-fact   ="<?php echo $ambiente['conc_factura']; ?>" 
                            data-orde   ="<?php echo $ambiente['conc_orden']; ?>" 
                            data-coma   ="<?php echo $ambiente['conc_comanda']; ?>" 
                            data-impu   ="<?php echo $ambiente['impuesto']; ?>" 
                            data-bode   ="<?php echo $ambiente['id_bodega']; ?>" 
                            data-cent   ="<?php echo $ambiente['id_centrocosto']; ?>" 
                            data-vent   ="<?php echo $ambiente['codigo_venta']; ?>" 
                            data-prop   ="<?php echo $ambiente['codigo_propina']; ?>" 
                            data-logo   ="<?php echo $ambiente['logo']; ?>" 
                            title       ="Elimina el Ambiente Actual" >
                            <i class='fa fa-trash'></i>
                          </button> -->
                        </div>
                        <div class="btn-group" role="group" aria-label="">
                          <button type="button" class="btn btn-danger btn-xs" 
                            data-toggle ="modal" 
                            data-id     ="<?php echo $ambiente['id_ambiente']; ?>" 
                            data-desc   ="<?php echo $ambiente['nombre']; ?>" 
                            data-pref   ="<?php echo $ambiente['prefijo']; ?>" 
                            data-estado ="<?php echo $ambiente['active_at']; ?>" 
                            onclick     ="cambiaEstadoAmbiente(<?php echo $ambiente['id_ambiente']; ?>,<?php echo $ambiente['active_at']; ?>)"
                            title       ="Bloquea El Punto de Venta Actual" >
                            <i style="font-size:16px" class="fa fa-ban" aria-hidden="true"></i>
                          </button>                          
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
        </div>
      </div>
    </div>
  </section>
</div>