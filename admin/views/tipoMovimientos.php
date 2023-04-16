<div class="content-wrapper"> 
  <section class="content">
    <div class="panel panel-success">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-6">
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_ADM?>">  
            <input type="hidden" name="ubicacion" id="ubicacion" value="tipoMovimientos">
            <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-money"></i> Tipo de Movimientos de Inventario </h3>
          </div>
          <div class="col-lg-6" align="right">
            <a style="margin:20px 0" 
              data-toggle="modal" 
              class = 'btn btn-success'
              href="#myModalAdicionarTipoMovimiento">
            <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
             Adicionar Tipo de Movimiento </a> 
          </div>
        </div>
      </div>
      <div class="panel-body">
        <div class="datos_ajax_delete"></div>
        <div class="col-lg-6 col-lg-offset-3">
          <div class="table-responsive"> 
            <table id="example1" class="table table-bordered">
              <thead>
                <tr class="warning">
                  <td>Descripcion</td>
                  <td>Tipo</td>
                  <td>Accion</td>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($tiposmovi as $tipomovi) { ?>
                  <tr style='font-size:12px'>
                    <td><?php echo $tipomovi['descripcion_tipo']; ?></td>
                    <td align="left"><?php echo tipoMovimiento($tipomovi['tipo']); ?></td>
                    <td align="center" style="padding:3px;width: 17%">
                      <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-info btn-xs" 
                          data-toggle ="modal" 
                          data-target ="#myModalModificaTipoMovimiento" 
                          data-id     ="<?php echo $tipomovi['id_tipomovi']?>" 
                          data-descri ="<?php echo $tipomovi['descripcion_tipo']?>" 
                          data-tipo   ="<?php echo $tipomovi['tipo']?>" 
                          data-ajuste ="<?php echo $tipomovi['ajuste']?>" 
                          data-trasla ="<?php echo $tipomovi['traslado']?>" 
                          data-compra ="<?php echo $tipomovi['compra']?>" 
                          data-ordene ="<?php echo $tipomovi['ordenes']?>" 
                          data-remisi ="<?php echo $tipomovi['remisiones']?>" 
                          data-provee ="<?php echo $tipomovi['proveedor']?>" 
                          data-venta  ="<?php echo $tipomovi['venta']?>" 
                          data-cierre ="<?php echo $tipomovi['cierre']?>" 
                          title="Modificar El Tipo de Movimiento Actual" >
                          <i class='fa fa-pencil-square'></i>
                        </button>
                        <button type="button" class="btn btn-warning btn-xs" 
                          data-toggle ="modal" 
                          data-target ="#myModalEliminaTipoMovimiento" 
                          data-id     ="<?php echo $tipomovi['id_tipomovi']?>" 
                          data-descri ="<?php echo $tipomovi['descripcion_tipo']?>" 
                          data-tipo   ="<?php echo $tipomovi['tipo']?>" 
                          data-ajuste ="<?php echo $tipomovi['ajuste']?>" 
                          data-trasla ="<?php echo $tipomovi['traslado']?>" 
                          data-compra ="<?php echo $tipomovi['compra']?>" 
                          data-ordene ="<?php echo $tipomovi['ordenes']?>" 
                          data-remisi ="<?php echo $tipomovi['remisiones']?>" 
                          data-provee ="<?php echo $tipomovi['proveedor']?>" 
                          data-venta  ="<?php echo $tipomovi['venta']?>" 
                          data-cierre ="<?php echo $tipomovi['cierre']?>" 
                          title="Elimina El Tipo de Habitacion Actual" >
                          <i class='fa fa-trash'></i>
                        </button>                            
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
