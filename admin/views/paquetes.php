    <div class="content-wrapper"> 
      <section class="content">
        <div class="panel panel-success">
          <div class="panel-heading">
            <div class="row">
              <div class="col-lg-6">
                <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_ADM?>">  
                <input type="hidden" name="ubicacion" id="ubicacion" value="paquetes">
                <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-money"></i> Paquetes  </h3>
              </div>
              <div class="col-lg-6" align="right">
                <a style="margin:20px 0" 
                  data-toggle="modal" 
                  class = 'btn btn-success'
                  href="#myModalAdicionarPaquetes">
                <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
                 Adicionar Paquetes</a> 
              </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="datos_ajax_delete"></div>
            <div class="col-lg-10 col-lg-offset-1">
                  <table id="example1" class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Descripcion</th>
                        <th>Frecuencia</th>
                        <th>Tipo Cargo</th>
                        <th>Codigo Venta</th>
                        <th>Valor</th>
                        <th>Accion</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      foreach ($paquetes as $paquete): ?>
                        <tr>
                          <td><?php echo $paquete["descripcion"]?></td>
                          <td><?php echo frecuenciaPaquete($paquete["frecuencia"])?></td>
                          <td><?php echo tipoCargoPaquete($paquete["tipo_cargo"])?></td>
                          <td><?php echo $admin->getDescriptionImpto($paquete["codigo_vta"])?></td>
                          <td align="right"><?php echo number_format($paquete["valor"],2)?></td>
                          <td align="center">
                            <div class="btn-group" role="group" aria-label="Basic example">
                              <button type="button" class="btn btn-info btn-xs" 
                                data-toggle ="modal" 
                                data-target ="#myModalModificaPaquete" 
                                data-id     ="<?= $paquete['id']?>" 
                                data-codigo ="<?= $paquete['codigo']?>" 
                                data-descri ="<?= $paquete['descripcion']?>" 
                                data-codvta ="<?= $paquete['codigo_vta']?>" 
                                data-tipoca ="<?= $paquete['tipo_cargo']?>" 
                                data-frecue ="<?= $paquete['frecuencia']?>" 
                                data-valor  ="<?= $paquete['valor']?>" 
                                data-separa ="<?= $paquete['separar_tarifa']?>" 
                                title="Modificar el Paquete Actual" >
                                <i class='fa fa-pencil-square'></i>
                              </button>
                              <button type="button" class="btn btn-danger btn-xs" 
                                data-toggle ="modal" 
                                data-target ="#myModalEliminaPaquete" 
                                data-id     ="<?php echo $paquete['id']?>" 
                                data-codigo ="<?php echo $paquete['codigo']?>" 
                                data-descri ="<?php echo $paquete['descripcion']?>" 
                                data-codvta ="<?php echo $paquete['codigo_vta']?>" 
                                data-tipoca ="<?php echo $paquete['tipo_cargo']?>" 
                                data-frecue ="<?php echo $paquete['frecuencia']?>" 
                                data-valor ="<?php echo $paquete['valor']?>" 
                                data-separa ="<?php echo $paquete['separar_tarifa']?>" 
                                title="Elimina Paquete Actual" >
                                <i class='fa fa-trash'></i>
                              </button>
                            </div> 

                            <!-- <a href='mod_agrupa.php'> <span class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span></span></a><a href='eli_agrupa.php'><span class="btn btn-danger btn-xs"><span class='glyphicon glyphicon-trash'></span></span></a> -->
                          </td>
                        </tr>                        
                      <?php endforeach 
                      ?>
                    </tbody>
                  </table>
            </div>
          </div>
        </div>
      </section>
    </div>
