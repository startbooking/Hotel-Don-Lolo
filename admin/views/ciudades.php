
    <div class="content-wrapper"> 
      <section class="content">
        <div class="panel panel-success">
          <div class="panel-heading"> 
            <div class="row">
              <div class="col-lg-6">
                <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_ADM?>">
                <input type="hidden" name="ubicacion" id="ubicacion" value="ciudades">
                <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-cubes"></i> Ciudades </h3>
              </div>
              <div class="col-lg-6" style="text-align:right;">
                <a 
                  data-target  ="#myModalAdicionaCiudad" 
                  data-toggle  ="modal" 
                  style        ="margin:20px 0" 
                  type         ="button" 
                  class        ="btn btn-success" 
                  >
                  <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
                   Adicionar Ciudad</a>
              </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="datos_ajax_delete"></div>
            <div class="col-lg-6 col-lg-offset-3">              
              <div class="container-fluid"> 
                <table id="example1" class="table table-bordered">
                  <thead>
                    <tr class="warning">
                      <td>Pais</td>
                      <td>Ciudad</td>
                      <td>Codigo</td>
                      <td>Accion</td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($ciudades as $ciudad) { ?>
                      <tr style='font-size:12px'>
                        <td><?php echo $ciudad['descripcion']; ?></td>
                        <td><?php echo $ciudad['municipio']; ?></td>
                        <td><?php echo $ciudad['codigo']; ?></td>
                        <td  style="padding:3px;width: 17%">
                          <div class="btn-group" role="group" aria-label="Basic example">
                            <button 
                              type        ="button" 
                              class       ="btn btn-info btn-xs" 
                              data-toggle ="modal" 
                              data-target ="#myModalModificaCiudad" 
                              data-id     ="<?php echo $ciudad['id_ciudad']?>" 
                              data-munic  ="<?php echo $ciudad['municipio']?>" 
                              data-codigo ="<?php echo $ciudad['codigo']?>" 
                              title       ="Modificar la Ciudad Actual" >
                              <i class='fa fa-pencil-square'></i>
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
