<?php
  require '../../res/php/titles.php';
  require '../../res/php/app_topPos.php'; 

  $fecha = $_POST['fecha'];
  $ayer  = strtotime ( '-1 day' , strtotime (  $fecha  ) ) ;
  $ayer  = date ('Y-m-d' , $ayer );
  
?>
  <div class="container-fluid" style="margin-bottom: 50px">
    <div class="panel panel-success">
      <div class="panel-heading">
        <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_POS?>">
        <input type="hidden" name="ubicacion" id="ubicacion" value="historicoAuditoria.php">
        <input type="hidden" name="pasos" id="pasos">
        <h3 class="w3ls_head tituloPagina"> <i class="fa fa-tachometer" style="font-size:36px;color:black" ></i> Historico Auditoria</h3>
      </div> 
      <div class="datos_ajax_delete"></div>
      <form id="formCierreDiario" class="form-horizontal" method="POST" enctype="multipart/form-data">
        <div class="panel-body">
          <div class="row">
            <div class="form-group">
              <label for="direccion" class="col-sm-2 control-label">Fecha Auditoria </label>
              <div class="form-group has-success has-feedback col-sm-4" >
                <div class="input-group" style="padding-left:15px;">
                  <input style="line-height: 15px;" type="date" class="form-control" id="buscarFecha" name="buscarFecha" aria-describedby="inputGroupSuccess4Status" value="<?=$ayer?>" max="<?=$ayer?>">
                  <span class="input-group-addon" style="padding:1px;border:none"> 
                    <a 
                      onclick="buscaFechaAuditoria()" 
                      >
                      <i style="padding:5px 10px" class="fa fa-search" aria-hidden="true"></i>
                    </a>
                  </span>
                </div>
              </div>
            </div>
            <div class="col-md-6" id='facturas'></div>
          </div>
          <div class="row">
            <div class="col-md-6" id="muestraResultado" style="font-size:12px"></div>
            <div class="col-md-6" id="muestraFactura">
              <object id="verFactura" width="100%" height="500" data=""></object> 
            </div>
          </div>
        </div>
        <div class="panel-footer">
          <div class="row">
            <div class="col-xs-4 col-xs-offset-4" >
              <div class="col-xs-12" style="padding:0">
                <a type="button" class="btn btn-warning btn-block" href="javascript:enviaInicio()"><i class="fa fa-reply"></i> Regresar</a>
              </div>
            </div>
          </div>
        </div>  
      </form> 
    </div>
  </div>
