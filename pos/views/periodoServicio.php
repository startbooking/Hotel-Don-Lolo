<?php 
  require '../../res/php/titles.php';
  require '../../res/php/app_topPos.php'; 

  $idamb  = $_POST['id'];
  $nomamb = $_POST['amb'];
  $user   = $_POST['user'];
  $iduser = $_POST['iduser'];
  $impto  = $_POST['impto'];
  $prop   = $_POST['prop'];
  $logo   = $_POST['logo'];
  $fecha  = $_POST['fecha'];
 
?>
  <section class="content centrar">
    <div class="container">
      <div class="panel panel-success">
        <div class="panel-heading"> 
          <div class="row">
            <div class="col-md-6">
              <input type="hidden" name="usuarioActivo" id="usuarioActivo" value="<?=$_SESSION['usuario']?>">
              <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_PMS?>">                  
              <input type="hidden" name="ubicacion" id="ubicacion" value="periodoServicio">
              <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-industry"></i> Historico Periodos de Servicio</h3> 
            </div>
            <div class="col-md-6">
              <div class="btn-group pull-right">                
              <button class="btn btn-success push-right" type="buttom" onclick='historicoPeriodos()'><i class="fa fa-print" aria-hidden="true"></i> Imprimir</button>
              </div>
            </div>
          </div>  
        </div>
        <div class="panel-body ">
          <div class="form-horizontal">
            <div class="form-group">
              <label class="control-label col-md-2">Desde Fecha</label>
              <div class="col-lg-3 col-md-3">
                <input class="form-control" type="date" min="1" name="desdeFecha" id='desdeFecha' value='' style="line-height:16px" required>
              </div>
              <label class="control-label col-md-2">Hasta Fecha</label>
              <div class="col-lg-3 col-md-3">
                <input class="form-control" type="date" min="1" name="hastaFecha" id='hastaFecha' value='' style="line-height:16px" required>
              </div>
            </div>
            <div class="imprimeInforme">
              <object id="verInforme" width="100%" height="500" data=""></object> 
            </div>
          </div>
        </div>
        <div class="panel-footer">
          <div class="row-fluid">
          </div>
        </div>
      </div>
      
    </div>
  </section> 
