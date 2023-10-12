
    <div class="content-wrapper"> 
      <section class="content">
        <div class="panel panel-success">
          <div class="panel-heading">
            <div class="row">
              <div class="col-lg-6">
                <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_FE?>">  
                <input type="hidden" name="ubicacion" id="ubicacion" value="productos">
                <h3 class="w3ls_head tituloPagina">
                <span class="material-symbols-outlined">inventory_2</span> Compras / Servicios  </h3>
              </div>
              <div class="col-lg-6" style="text-align:right;">
                <button
                  data-toggle="modal"
                  data-edita="0" 
                  data-documento="0"
                  type="button" 
                  class="btn btn-success" 
                  href="#myModalProductos"
                  >
                  <span class="material-symbols-outlined">add_box</span> Adicionar  </button>
              </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="datos_ajax_delete"></div>
            <div class="container-fluid">
              <div class="table-responsive"> 
                <table id="example1" class="table table-bordered">
                  <thead>
                    <tr class="warning">
                      <td>Descripcion </td>
                      <td>Unidad de Medida</td>
                      <td>Codigo </td>
                      <td>Impuesto</td>
                      <td>Valor</td>
                      <td>Accion</td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($productos as $codigo) { ?>
                      <tr style='font-size:12px'>
                        <td><?php echo $codigo['descripcion_cargo']; ?></td>
                        <td><?php echo $codigo['descripcion_unidad']; ?></td>
                        <td><?php echo $codigo['identificador_dian']; ?></td>
                        <td><?php echo $codigo['descripcionImpto']; ?></td>
                        <td class="derecha"><?php echo number_format($codigo['precio'],2); ?></td>
                        <td style="padding:3px;text-align:center;">
                          <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-info btn-xs" 
                              data-toggle ="modal" 
                              data-target ="#myModalModificaCodigoVentas" 
                              data-id     ="<?php echo $codigo['id_cargo']?>" 
                              title="Modificar El Producto Actual" >
                              <!-- <i class='fa fa-pencil-square'></i> -->
                              <span class="material-symbols-outlined">edit</span>
                            </button>
                            <button type="button" class="btn btn-warning btn-xs" 
                              data-toggle ="modal" 
                              data-target ="#myModalEliminaCodigoVentas" 
                              data-id     ="<?php echo $codigo['id_cargo']?>" 
                              data-impto  ="<?php echo $codigo['id_impto']?>" 
                              title="Elimina El Producto Actual" >
                              <!-- <i class='fa fa-trash'></i> -->
                              <span class="material-symbols-outlined">delete</span>
                            </button> 
                            <!-- 
                          -->
                            <!-- <a type="button" class="btn <?=$color?> btn-xs" 
                              href="javascript:activaPago(<?php echo $codigo['id_cargo']?>,<?=$codigo['restringido']?>)"
                              title="Restringir Pago Actual">
                              <i class='fa fa-toggle-off'></i>
                            </a> -->
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

    <?php include_once 'views/modal/modalProductos.php'; ?> 
