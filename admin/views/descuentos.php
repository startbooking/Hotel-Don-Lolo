<div class="content-wrapper" style="margin-bottom: 50px"> 
  <section class="content">
    <div class="panel panel-success">
      <div class="panel-heading"> 
        <div class="row">
          <div class="col-lg-6">
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_ADM?>">                  
            <input type="hidden" name="ubicacion" id="ubicacion" value="descuentos">
            <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-cube"></i> Descuentos </h3>
          </div>
          <div class="col-lg-6" align="right">
            <a 
              data-toggle="modal" 
              style="margin:20px 0" type="button" class="btn btn-success" href="#myModalAdicionarDescuento">
              <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
               Adicionar Descuento</a>
          </div>
        </div> 
      </div>
      <div class="panel-body">
        <div class="datos_ajax_delete"></div>
        <div class="col-lg-8 col-lg-offset-2">              
          <div class="container-fluid"> 
            <table id="example1" class="table table-bordered">
              <thead>
                <tr class="warning">
                  <td>Descuento</td>
                  <td>Ambiente</td>
                  <td>% Desc.</td>
                  <td>Accion</td>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($descuentos as $descuento) { ?>
                  <tr style='font-size:12px'>
                    <td width="22px"><?php echo $descuento['descripcion_descuento']; ?></td>
                    <td width="22px"><?php echo $descuento['nombre']; ?></td>
                    <td width="22px" align="right"><?php echo $descuento['porcentaje']; ?></td>
                    <td align="center" style="padding:3px;width: 17%">
                      <div class="btn-toolbar" role="toolbar" aria-label="...">
                        <div class="btn-group" role="group" aria-label="...">
                          <button 
                            type        ="button" 
                            class       ="btn btn-info btn-xs" 
                            data-toggle ="modal" 
                            data-target ="#myModalModificaDescuento" 
                            data-id     ="<?php echo $descuento['id_descuento']?>" 
                            data-descri ="<?php echo $descuento['descripcion_descuento']?>" 
                            data-porcen ="<?php echo $descuento['porcentaje']?>" 
                            data-ambien ="<?php echo $descuento['id_ambiente']?>" 
                            title       ="Modificar El Descuento Actual" >
                            <i class='fa fa-pencil-square'></i>
                          </button>
                          <button 
                            type        ="button" 
                            class       ="btn btn-danger btn-xs" 
                            data-toggle ="modal" 
                            data-target ="#myModalEliminaDescuento" 
                            data-id     ="<?php echo $descuento['id_descuento']?>" 
                            data-descri ="<?php echo $descuento['descripcion_descuento']?>" 
                            data-porcen ="<?php echo $descuento['porcentaje']?>" 
                            data-ambien ="<?php echo $descuento['id_ambiente']?>" 
                            title       ="Elimina El Descuento Actual" >
                            <i class='fa fa-trash'></i>
                          </button>
                        </div>
                        <div class="btn-group" role="group" aria-label="...">
                          <?php 
                            if($descuento['actived_at']==1){
                              $color = 'btn-success';
                            }else{
                              $color = 'btn-danger';
                            }
                          ?>
                          <button 
                            type        ="button" 
                            class       ="btn <?=$color?> btn-xs" 
                            class       ="btn btn-danger btn-xs" 
                            data-toggle ="modal" 
                            data-id     ="<?php echo $descuento['id_descuento']?>" 
                            data-descri ="<?php echo $descuento['descripcion_descuento']?>" 
                            data-porcen ="<?php echo $descuento['porcentaje']?>" 
                            data-ambien ="<?php echo $descuento['id_ambiente']?>" 
                            onclick     ="activaDescuento(<?php echo $descuento['id_descuento']?>,<?=$descuento['actived_at']?>)"
                            title       ="Desactivar El Descuento Actual" >
                            <i class='fa fa-toggle-off'></i>
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
