
<div class="content-wrapper" style="margin-bottom: 50px"> 
  <section class="content">
    <div class="panel panel-success">
      <div class="panel-heading">  
        <div class="row">
          <div class="col-lg-6">
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_ADM?>">
            <input type="hidden" name="ubicacion" id="ubicacion" value="tiposdePlatos">
            <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-cube"></i> Tipo de Plato </h3>
          </div>
          <div class="col-lg-6" align="right">
            <a 
              data-toggle="modal" 
              style="margin:20px 0" type="button" class="btn btn-success" href="#myModalAdicionarTipoPlato">
              <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
               Adicionar Tipo de Plato
             </a>
          </div>
        </div>
      </div>
      <div class="panel-body">
        <div class="datos_ajax_delete"></div>
        <div class="col-lg-8 col-lg-offset-2">              
          <div class="container-fluid"> 
            <table id="example1" class="table table-bordered">
              <thead>
                <tr>
                  <th>Tipo de Plato</th>
                  <th>Ambiente</th>
                  <th>Estado</th>
                  <th>Accion</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                foreach ($tipos as $tipo) { ?> 
                  <tr>
                    <td><?php echo $tipo["nombre_seccion"]?></td>
                    <td><?php echo $admin->getNombreAmbiente($tipo["id_ambiente"])?></td>
                    <td align="right"><?php echo estado_n($tipo["estado_seccion"])?></td>
                    <td align="center">
                      <button type="button" class="btn btn-info btn-xs" 
                        data-toggle   ="modal" 
                        data-target   ="#myModalModificaTipoPlato" 
                        data-id       ="<?= $tipo['id_seccion']?>" 
                        data-ambiente ="<?= $tipo['id_ambiente']?>" 
                        data-seccion  ="<?= $tipo['nombre_seccion']?>" 
                        data-estado   ="<?= $tipo['estado_seccion']?>" 
                        title         ="Modificar El Tipo de Plato Actual" >
                        <i class='fa fa-pencil-square'></i>
                      </button>
                      <button type="button" class="btn btn-danger btn-xs" 
                        data-toggle   ="modal" 
                        data-target   ="#myModalEliminaTipoPlato" 
                        data-id       ="<?= $tipo['id_seccion']?>" 
                        data-ambiente ="<?= $tipo['id_ambiente']?>" 
                        data-seccion  ="<?= $tipo['nombre_seccion']?>" 
                        data-estado   ="<?= $tipo['estado_seccion']?>" 
                        title         ="Elimina El Tipo de Plato Actual" >
                        <i class='fa fa-trash'></i>
                      </button>
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


<?php 
  include_once 'modal/modalTiposdePlatos.php';
 ?>