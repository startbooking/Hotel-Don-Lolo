<?php 
  $hoy  = FECHA_PMS;
  $ayer = strtotime ( '-1 day' , strtotime ( $hoy ) ) ;
  $ayer = date ('Y-m-d' , $ayer );
?>

    <div class="content-wrapper"> 
      <section class="content" style="height: 780px;">
        <div class="content" style="margin-bottom: 50px">
          <div class="panel panel-success">
            <div class="panel-heading">
              <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_PMS?>">
              <input type="hidden" name="ubicacion" id="ubicacion" value="historicoCajeros">
              <input type="hidden" name="pasos" id="pasos">
              <h3 class="w3ls_head tituloPagina"> <i class="fa fa-tachometer" style="font-size:36px;color:black" ></i> Historico Movimientos Cajeros</h3>
            </div> 
            <div class="datos_ajax_delete"></div>
            <form id="formCierreDiario" class="form-group" action="javascript:buscaReportesCajero()" method="POST" enctype="multipart/form-data">
              <div class="panel-body">
                <div class="row-fluid">
                  <div class="col-sm-6">
                    <div class="form-group">                    
                      <label for="direccion" class="col-sm-4 control-label">Fecha Movimiento </label>
                      <div class="col-sm-8 has-success has-feedback" >
                          <input style=""
                          type="date" class="form-control" id="buscarFecha" aria-describedby="inputGroupSuccess4Status" value="<?=$ayer?>" max="<?=$ayer?>">
                          <span class="input-group-addon" style="padding:1px;border:none">
                          </span>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group"> 
                      <label for="direccion" class="col-sm-2 control-label">Cajero </label>
                      <div class="col-sm-8 has-success has-feedback" >
                        <select name="usuario" id="usuario" required="">
                          <option value="">Seleccione el Cajero</option>
                          <?php  
                            $usuarios = $hotel->getUsuarios();
                            foreach ($usuarios as $usuario) { ?>
                              <option value="<?=$usuario['usuario']?>"><?=$usuario['apellidos'].' '.$usuario['nombres']?></option>
                              <?php 
                            };
                          ?>
                        </select>
                      </div>
                      <div class="col-sm-2" >
                        <button type="submit" class="btn btn-info" style="padding:4px 20px">
                          <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                      </div>                    
                    </div>
                  </div>
                </div>
                <div class="row-fluid" id="muestraFactura" style="margin-top:70px">
                  <object id="verFactura" width="100%" height="500" data=""></object> 
                </div>                  
              </div>
              <div class="panel-footer">
                <div class="row">
                  <div class="col-lg-4 col-lg-offset-4" >
                    <div class="col-xs-12" style="padding:0">
                      <a type="button" class="btn btn-warning btn-block" href="home"><i class="fa fa-reply"></i> Regresar</a>
                    </div>
                  </div>
                </div>
              </div>  
            </form> 
          </div>
        </div>
      </section>
    </div>
