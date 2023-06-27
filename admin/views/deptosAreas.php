
<div class="content-wrapper" style="margin-bottom: 50px"> 
  <section class="content">
    <div class="panel panel-success">
      <div class="panel-heading"> 
        <div class="row">
          <div class="col-lg-6">
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_ADM?>">                  
            <input type="hidden" name="ubicacion" id="ubicacion" value="deptos">
            <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-cube"></i> Departamentos - Areas </h3>
          </div>
          <div class="col-lg-6" align="right">
            <a 
              data-toggle="modal" 
              style="margin:20px 0" type="button" class="btn btn-success" href="#myModalAdicionarDepto">
              <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
               Adicionar Departamentos</a>
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
                  <td>Departamento</td>
                  <td>Accion</td>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($deptos as $depto) { ?>
                  <tr style='font-size:12px'>
                    <td width="22px"><?php echo $depto['nombre_depto']; ?></td>
                    <td align="center" style="padding:3px;width: 17%">
                      <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-info btn-xs" 
                          data-toggle ="modal" 
                          data-target ="#myModalModificaDepto" 
                          data-id     ="<?php echo $depto['id_depto']?>" 
                          data-descri ="<?php echo $depto['nombre_depto']?>" 
                          title="Modificar El Departamento Actual" >
                          <i class='fa fa-pencil-square'></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-xs" 
                          data-toggle ="modal" 
                          data-target ="#myModalEliminaDepto" 
                          data-id     ="<?php echo $depto['id_depto']?>" 
                          data-descri ="<?php echo $depto['nombre_depto']?>" 
                          title="Elimina El Departamento Actual" >
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
