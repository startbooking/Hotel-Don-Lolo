    <div class="content-wrapper" style="margin-bottom: 50px"> 
      <section class="content">
        <div class="panel panel-success">
          <div class="panel-heading">
            <div class="row">
              <div class="col-lg-6">
                <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_ADM?>">  
                <input type="hidden" name="ubicacion" id="ubicacion" value="impuestos">
                <h3 class="tituloPagina"><i class="fa fa-bank"> </i> Impuestos / Retenciones </h3>
              </div>
              <div class="col-lg-6" style="text-align:right;">
                <a style="margin:20px 0" 
                  data-toggle="modal" 
                  class = 'btn btn-success'
                  href="#myModalAdicionarImpto">
                <i class="glyphicon glyphicon-plus" aria-hidden="true"></i> Adicionar Impuesto</a> 
              </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="datos_ajax_delete"></div>
            <div class="table-responsive"> 
              <table id="example1" class="table table-bordered">
                <thead>
                  <tr class="warning">
                    <td>Impuesto</td>
                    <td>% Impto</td>
                    <td>Tipo</td>
                    <td>Accion</td>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($impuestos as $impuesto) { ?>
                    <tr style='font-size:12px'>
                      <td><?php echo $impuesto['descripcion_cargo']; ?></td>
                      <td align="right"><?php echo number_format($impuesto['porcentaje_impto'],2); ?></td>
                      <td><?php echo tipoImpuesto($impuesto['tipo_impto']); ?></td>
                      <td align="center" style="padding:3px;width: 12%">
                        <div class="btn-group" role="group" aria-label="Basic example">
                          <button 
                            type        ="button" 
                            class       ="btn btn-info btn-xs" 
                            data-toggle ="modal" 
                            data-id     ="<?php echo $impuesto['id_cargo']?>" 
                            data-descri ="<?php echo $impuesto['descripcion_cargo']?>" 
                            data-porcen ="<?php echo $impuesto['porcentaje_impto']?>" 
                            data-tipo   ="<?php echo $impuesto['tipo_impto']?>" 
                            data-puc    ="<?php echo $impuesto['cuenta_puc']?>" 
                            data-contab ="<?php echo $impuesto['descripcion_contable']?>" 
                            data-target ="#myModalModificaImpto" 
                            title       ="Modificar El Impuesto Actual" >
                            <i class='fa fa-pencil-square'></i>
                          </button>
                          <button 
                            type        ="button" 
                            class       ="btn btn-danger btn-xs" 
                            data-toggle ="modal" 
                            data-target ="#myModalEliminaImpto" 
                            data-id     ="<?php echo $impuesto['id_cargo']?>" 
                            data-descri ="<?php echo $impuesto['descripcion_cargo']?>" 
                            data-porcen ="<?php echo $impuesto['porcentaje_impto']?>" 
                            data-tipo   ="<?php echo $impuesto['tipo_impto']?>" 
                            data-puc    ="<?php echo $impuesto['cuenta_puc']?>" 
                            data-contab ="<?php echo $impuesto['descripcion_contable']?>" 
                            title       ="Elimina El Impuesto Actual" >
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
      </section>
    </div>
