<?php 
  require '../../res/php/titles.php';
  require '../../res/php/app_topPos.php'; 

  $idamb  = $_POST['id'];
  $nomamb = $_POST['amb'];
  $user   = $_POST['user'];
  $iduser = $_POST['iduser']; 
  $impto  = $_POST['impto'];
  $prop   = $_POST['prop'];
  $fecha  = $_POST['fecha'];

  $_SESSION['NOMBRE_AMBIENTE'] = $nomamb;
  $_SESSION['AMBIENTE_ID']     = $idamb;
  $_SESSION['usuario']         = $user;
  $_SESSION['usuario_id']      = $iduser;
?>

<section class="content" style="height: 780px;">
  <div class="col-md-8 col-md-offset-2" style="margin-bottom: 50px; margin-top:50px;">
    <div class="panel panel-success">
      <div class="panel-heading">
        <div class="row"> 
          <div class="col-lg-9">
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_POS?>">
            <input type="hidden" name="ubicacion" id="ubicacion" value="home">
            <input type="hidden" name="usuarioActivo" id="usuarioActivo" value="<?=$user?>">
            <input type="hidden" name="pasos" id="pasos">
            <h3 class="w3ls_head tituloPagina"> <i class="fa fa-tachometer" style="font-size:36px;color:black" ></i> Cierre Cajero [<?=$user?>]</h3>
          </div>
        </div>
      </div>
      <div class="datos_ajax_delete"></div>
      <form id="formCierreDiario" class="form-horizontal" action="javascript:cierreCajero('<?=$user?>')" method="POST" enctype="multipart/form-data">
        <div class="panel-body"> 
          <div class="form-group">
            <div class="form-group">
              <label style="margin-top:8px" for="direccion" class="col-sm-5 control-label">Fecha </label>
              <div class="col-sm-6">
                <h3 id="fechaAuditoria" style="font-weight: 700;margin-top: 0;font-size:30px;color:brown"><?=$fecha?></h3>
              </div>
            </div> 
          </div>                                
          
          <div class="container-fluid galeria" id='procesosCierreCajero' >
            <div class="col-md-2 col-sm-12" style="padding:0;width: 73px">
              <h4 class="bg-red" style="padding:10px">
                <img style="width: 44px;margin-left: auto;margin-right: auto;margin-top:0" class="img-thumbnail" src="<?=BASE_WEB?>img/alert2.png" alt="">
                <span style="font-size:24px;font-weight: 700;font-family: 'ubuntu'">
                </span>
              </h4>

            </div>                  
            <div class="col-md-10 col-sm-12" style="padding:0">
              <h4 align="center" class="bg-red" style="padding:10px"><span style="font-size:20px;font-weight: 700;font-family: 'ubuntu';"> Este Proceso No Permitira Ingresar Nuevos Movimientos Al Sistema</span></h4>
            </div>
          </div>
          <div id="imprimeCierre"></div>
          <div id="aviso"></div>
        </div>
        <div class="panel-footer" style="text-align: center">
          <a style="width: 25%" type="button" class="btn btn-warning" href="javascript:enviaInicio()"><i class="fa fa-reply"></i> Regresar</a>
          <button style="width: 25%" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Procesar</button>
        </div>  
      </form> 
    </div>
  </div>
</section>
