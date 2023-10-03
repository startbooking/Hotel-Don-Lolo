    <div class="content-wrapper" style=""> 
      <section class="content">
        <div class="panel panel-success">
          <div class="panel-heading"> 
            <div class="row">
              <div class="col-lg-6 col-xs-12">
                <input type="hidden" name="rutaweb" id="rutaweb" value="<?php echo BASE_FE; ?>">                  
                <input type="hidden" name="ubicacion" id="ubicacion" value="proveedores">
                <h3 class="w3ls_head tituloPagina">
                <span class="material-symbols-outlined">group</span> Catalogo de Proveedores</h3>
              </div>
              <div class="col-lg-6 col-xs-12">
                <button
                data-toggle="modal" 
                style="display:inline-flex;" type="button" class="btn btn-success pull-right" href="#myModalAdicionarProveedor"
                >
                <span class="material-symbols-outlined">add_box</span> Adicionar Proveedor </button>
              </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="container-fluid">
              <div class="datos_ajax_delete"></div>
              <div class="row">              
                <div class="table-responsive"> 
                  <table id="example1" class="table table-bordered table-condensed" style="width:100%;">
                    <thead>
                      <tr class="warning">
                        <td>Nit</td>
                        <td>Empresa</td>
                        <td>Direccion</td>
                        <td>Celular</td>
                        <td>Correo</td>
                        <td>Estado</td>
                        <td>Tipo</td>
                        <td>Accion</td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($proveedores as $compania) { ?>
                        <tr style='font-size:12px'>
                          <td><?php echo $compania['nit'].'-'.$compania['dv']; ?></td>
                          <td><?php echo $compania['empresa']; ?></td>
                          <td><?php echo $compania['direccion']; ?></td>
                          <td><?php echo $compania['celular']; ?></td>
                          <td><?php echo $compania['email']; ?></td>
                          <td><?php echo estadoCompania($compania['activo']); ?></td>
                          <td><?php echo tipoCompania($compania['tipo_compania']); ?></td>
                          <td style="text-align:center;">
                            <button type="button" class="btn btn-info btn-xs" 
                              onclick="botonModificaProveedor('<?php echo $compania['id_compania']; ?>','<?php echo $compania['empresa']; ?>')"
                              idprov = "<?php echo $compania['id_compania']; ?>"
                              nombre = "<?php echo $compania['empresa']; ?>"
                              data-id="<?php echo $compania['id_compania']; ?>"  
                              data-nombre="<?php echo $compania['empresa']; ?>"  
                              title="Modifica Datos del Proveedor">
                              <span class="material-symbols-outlined">edit</span>
                              <!-- <i class='glyphicon glyphicon-edit'></i> -->
                            </button>
                            <div class="btn-group">
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
        </div>
      </section>
    </div>

<?php include_once 'views/modal/modalProveedores.php'; ?> 
