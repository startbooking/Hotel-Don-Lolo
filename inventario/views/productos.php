    <div class="content-wrapper"> 
      <section class="content">
        <div class="panel panel-success">
          <div class="panel-heading"> 
            <div class="row">
              <div class="col-lg-6 col-xs-12">
                <input type="hidden" name="rutaweb" id="rutaweb" value="<?php echo BASE_INV; ?>">                
                <input type="hidden" name="ubicacion" id="ubicacion" value="productos">
                <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-cubes"></i> Catalogo de Productos</h3>
              </div>
              <div class="col-lg-6 col-xs-12" align="right">
                <a 
                  data-toggle="modal" 
                  style="margin:10px 0" type="button" class="btn btn-success" href="#myModalAdicionarProducto">
                  <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
                   Adicionar Producto</a>
              </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="datos_ajax_delete"></div>
            <div class="row">              
              <div class="container-fluid"> 
                <table id="example1" class="table table-bordered table-condensed">
                  <thead>
                    <tr class="warning">
                      <td>Codigo</td>
                      <td>Producto</td>
                      <td>Familia</td>
                      <td>Grupo</td>
                      <td>SubGrupo</td>
                      <td>Unidad</td>
                      <td>Accion</td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($productos as $producto) { ?>
                      <tr style='font-size:12px'>
                        <td><?php echo $producto['id_producto']; ?></td>
                        <td><?php echo $producto['nombre_producto']; ?></td>
                        <td><?php echo $inven->getDescriptionFamilia($producto['id_familia']); ?></td>
                        <td><?php echo $inven->getDescriptionGrupo($producto['id_grupo']); ?></td>
                        <td><?php echo $inven->getDescriptionSubGrupo($producto['id_subgrupo']); ?></td>
                        <td><?php echo $inven->getDescriptionUnidades($producto['unidad_compra']); ?></td>                       
                        <td>
                          <div class="btn-group" style="display:flex;">
                            <button type="button" 
                              class="btn btn-info btn-xs" 
                              data-toggle="modal" 
                              data-target="#myModalModificaProducto" 
                              data-id="<?php echo $producto['id_producto']; ?>"  
                              data-nombre="<?php echo $producto['nombre_producto']; ?>"  
                              title="Modifica Datos del Producto"
                              onclick='btnModificaProducto()'
                              >
                              <i class='glyphicon glyphicon-edit'></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-xs" 
                              data-toggle="modal" 
                              data-target="#myModalEliminaProducto" 
                              title="Eliminar Producto" 
                              data-id="<?php echo $producto['id_producto']; ?>"  
                              data-nombre="<?php echo $producto['nombre_producto']; ?>"
                              onclick='btnEliminaProducto()' 
                              >
                              <i class='glyphicon glyphicon-trash'></i> 
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
