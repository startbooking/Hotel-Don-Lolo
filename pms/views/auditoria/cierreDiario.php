    <div class="content-wrapper"> 
      <section class="content" style="height: 780px;">
        <div class="col-md-8 col-md-offset-2" style="margin-bottom: 50px">
          <div class="panel panel-success">
            <div class="panel-heading">
              <div class="row">
                <div class="col-lg-9">
                  <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_PMS?>">
                  <input type="hidden" name="ubicacion" id="ubicacion" value="cierreDiario">
                  <input type="hidden" name="pagina" id="pagina" value="cierreDiario">
                  <input type="hidden" name="pasos" id="pasos">
                  <h3 class="w3ls_head tituloPagina"> <i class="fa fa-tachometer" style="font-size:36px;color:black" ></i> Auditoria Nocturna </h3>
                </div>
              </div>
            </div> 
            <div class="datos_ajax_delete"></div>
            <form id="formCierreDiario" class="form-horizontal" action="javascript:cierreDiario()" method="POST" enctype="multipart/form-data">
              <div class="panel-body">
                <div class="form -group">
                  <div class="form-group">
                    <label style="margin-top:8px" for="direccion" class="col-sm-5 control-label">Fecha Auditoria </label>
                    <div class="col-sm-6">
                      <h3 id="fechaAuditoria" style="font-weight: 700;margin-top: 0;font-size:30px;color:brown"><?=FECHA_PMS?></h3>
                    </div>
                  </div>
                </div>                                
                <div class="container-fluid" id='procesosCierre' style="display:none">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered">
                      <thead>
                        <tr class="warning" style="font-weight: bold">
                          <td align="center">Proceso</td>
                          <td align="center">Accion</td>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $procesos = $hotel->getProcesoAuditoria(); 
                        foreach ($procesos as $proceso) { ?>
                          <tr style='font-size:12px'>
                            <td style="display:none">
                            <?=$proceso['nombre_proceso'];?>
                            </td>
                            <td style='padding: 2px 10px;margin: 0;'><?php echo $proceso['titulo_proceso']; ?></td>
                            <td style='padding: 2px 10px;margin: 0;' id="procesado" align="center"><?php echo estadoAuditoria($proceso['estado_proceso']); ?></td>
                          </tr>
                          <?php 
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>      
                </div>
                <div id="aviso"></div>
              </div>
              <div class="panel-footer">
                <div class="row">
                  <div class="col-lg-8 col-lg-offset-2" >
                    <div class="col-xs-6" style="padding:0">
                      <a type="button" class="btn btn-warning btn-block" href="home"><i class="fa fa-home"></i> Regresar</a>
                    </div>
                    <div class="col-xs-6" style="padding:0">
                      <button type="submit" id="botonCierre" class="btn btn-primary btn-block"><i class="fa fa-arrow-circle-right"></i> Procesar</button>
                    </div>                
                  </div>
                </div>
              </div>  
            </form> 
          </div>
        </div>
      </section>
    </div>
