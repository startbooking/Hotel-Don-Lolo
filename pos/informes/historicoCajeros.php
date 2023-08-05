<?php
  require_once '../../res/php/titles.php';
  require_once '../../res/php/app_topPos.php'; 

  $fecha = $_POST['fecha'];
  $ayer  = strtotime ( '-1 day' , strtotime (  $fecha  ) ) ;
  $ayer  = date ('Y-m-d' , $ayer );

  
?>

<section class="container-fluid" style="height: 780px;">
  <div class="container-fluid" style="margin-bottom: 50px">
    <div class="panel panel-success">
      <div class="panel-heading">
        <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_POS?>">
        <input type="hidden" name="ubicacion" id="ubicacion" value="historicoCajeros">
        <input type="hidden" name="pasos" id="pasos">
        <h3 class="w3ls_head tituloPagina"> <i class="fa fa-tachometer" style="font-size:36px;color:black" ></i> Historico Movimientos Cajeros</h3>
      </div> 
      <div class="datos_ajax_delete"></div>
      <form id="formCierreDiario" class="form-horizontal" action="javascript:buscaReportesCajero()" method="POST" enctype="multipart/form-data">
        <div class="panel-body">
          <div class="row-fluid">
            <div class="container-fluid">
              <div class="form-group">                    
                <label style="padding:0"for="direccion" class="col-sm-2 control-label">Fecha Movimiento </label>
                <div class="col-sm-4 has-success has-feedback" >
                  <div class="input-group" style="">
                    <input style="line-height: 15px;padding:0 10px" type="date" class="form-control" id="buscarFecha" aria-describedby="inputGroupSuccess4Status" value="<?=$fecha?>" max="<?=$fecha?>">
                    <span class="input-group-addon" style="padding:1px;border:none">
                    </span>
                  </div>
                </div>
                <label style="padding:0" for="direccion" class="col-sm-1 control-label">Cajero </label>
                <div class="col-sm-3 has-success has-feedback" >
                  <select name="usuario" id="usuario" required="">
                    <option value="">Seleccione el Cajero</option>
                    <?php  
                      $usuarios = $pos->getUsuarios();
                      foreach ($usuarios as $usuario) { ?>
                        <option value="<?=$usuario['usuario']?>"><?=$usuario['apellidos'].' '.$usuario['nombres']?></option>
                        <?php 
                      };
                    ?>
                  </select>
                </div>
                <div class="col-sm-1" >
                  <button type="submit" class="btn btn-info" style="padding:4px 20px">
                    <i class="fa fa-search" aria-hidden="true"></i>
                  </button>
                </div>                    
              </div>
            </div>

            <div class="container-fluid" id="muestraFactura" style="margin-top:10px">
              <object id="verFactura" width="100%" height="500" data=""></object> 
            </div>                  
          </div>
        </div>
        <div class="panel-footer">
          <div class="row">
            <div class="col-md-4 col-md-offset-4" >
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