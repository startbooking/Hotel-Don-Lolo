<div class="content-wrapper" style="margin-bottom: 50px"> 
  <section class="content">
    <div class="panel panel-success">
      <div class="panel-heading"> 
        <div class="row">
          <div class="col-lg-6">
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_ADM?>">                  
            <input type="hidden" name="ubicacion" id="ubicacion" value="periodos">
            <h3 class="w3ls_head tituloPagina">
              <i style="color:black;font-size:36px;" class="fa fa-clock-o"></i> Periodos de Servicio </h3>
          </div>
          <div class="col-lg-6" align="right">
            <a 
              data-toggle="modal" 
              style="margin:20px 0" type="button" class="btn btn-success" href="#myModalAdicionarPeriodo">
              <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
               Adicionar Periodo</a>
          </div>
        </div> 
      </div>
      <div class="panel-body">
        <div class="datos_ajax_delete"></div>
        <div class="col-lg-10 col-lg-offset-1">              
          <div class="container-fluid"> 
            <table id="example1" class="table table-bordered">
              <thead>
                <tr class="warning">
                  <td>Descripcion</td>
                  <td>Ambiente</td>
                  <td>Desde Hora</td>
                  <td>Hasta Hora</td>
                  <td>Accion</td>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($periodos as $periodo) { ?>
                  <tr style='font-size:12px'>
                    <td width="22px"><?php echo $periodo['descripcion_periodo']; ?></td>
                    <td width="22px"><?php echo $periodo['nombre']; ?></td>
                    <td width="22px" align="right"><?php echo $periodo['desde_hora']; ?></td>
                    <td width="22px" align="right"><?php echo $periodo['hasta_hora']; ?></td>
                    <td align="center" style="padding:3px;width: 12%">
                      <div class="btn-toolbar" role="toolbar" aria-label="...">
                        <div class="btn-group" role="group" aria-label="...">
                          <button 
                            type        ="button" 
                            class       ="btn btn-info btn-xs" 
                            data-toggle ="modal" 
                            data-target ="#myModalModificaPeriodo" 
                            data-id     ="<?php echo $periodo['id_periodo']?>" 
                            data-descri ="<?php echo $periodo['descripcion_periodo']?>" 
                            data-desde  ="<?php echo $periodo['desde_hora']?>" 
                            data-hasta  ="<?php echo $periodo['hasta_hora']?>" 
                            data-ambien ="<?php echo $periodo['id_ambiente']?>" 
                            title       ="Modificar El Periodo de Servicio Actual" >
                            <i class='fa fa-pencil-square'></i>
                          </button>
                          <button 
                            type        ="button" 
                            class       ="btn btn-danger btn-xs" 
                            data-toggle ="modal" 
                            data-target ="#myModalEliminaPeriodo" 
                            data-id     ="<?php echo $periodo['id_periodo']?>" 
                            data-descri ="<?php echo $periodo['descripcion_periodo']?>" 
                            data-desde  ="<?php echo $periodo['desde_hora']?>" 
                            data-hasta  ="<?php echo $periodo['hasta_hora']?>" 
                            data-ambien ="<?php echo $periodo['id_ambiente']?>" 
                            title       ="Elimina El Periodo de Servicio Actual" >
                            <i class='fa fa-trash'></i>
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
