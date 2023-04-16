<?php 
  require '../../res/php/titles.php';
  require '../../res/php/app_topPos.php'; 

  $clientes = $pos->getClientes() ;
  
  $idamb  = $_POST['id'];
  $nomamb = $_POST['amb'];
  $user   = $_POST['user'];
  $iduser = $_POST['iduser'];
  $impto  = $_POST['impto'];
  $prop   = $_POST['prop'];
  $fecha  = $_POST['fecha'];
  $logo   = $_POST['logo'];

  $_SESSION['NOMBRE_AMBIENTE'] = $nomamb; 
  $_SESSION['AMBIENTE_ID']     = $idamb;
  $_SESSION['usuario']         = $user;
  $_SESSION['usuario_id']      = $iduser;

?>
<section class="content" style="height: 780px;">
  <div class="col-md-8 col-md-offset-2" style="margin-bottom: 50px">
    <div class="panel panel-success">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-9"> 
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_POS?>">
            <input type="hidden" name="ubicacion" id="ubicacion" value="cierreDiario">
            <input type="hidden" name="pagina" id="pagina" value="cierreDiario">
            <input type="hidden" name="pasos" id="pasos">
            <input type="hidden" name="contador" id="contador">
            <h3 class="w3ls_head tituloPagina"> <i class="fa fa-tachometer" style="font-size:36px;color:black" ></i> Auditoria Nocturna </h3>
          </div>
        </div>   
      </div> 
      <div class="datos_ajax_delete"></div>
      <form id="formCierreDiario" class="form-horizontal" action="javascript:cierreDiario()" method="POST" enctype="multipart/form-data">
        <div class="panel-body">
          <div class="form -group">
            <div class="form-group">
              <label style="margin-top:8px" for="fechaAuditoria" class="col-sm-5 control-label">Fecha Auditoria </label>
              <div class="col-sm-6">
                <h3 id="fechaAuditoria" style="font-weight: 700;margin-top: 0;font-size:30px;color:brown"><?=$fecha?></h3>
              </div>
            </div>
          </div>                                
          <div class="container-fluid" id='procesosCierre' style="display:none">
            <div class="table-responsive">
            </div>      
          </div>
          <div id="aviso"></div>
          <div id="verInforme"></div>          
        </div>
        <div class="panel-footer" style="text-align: center">
          <a style="width: 20%" type="button" class="btn btn-warning" onclick="getSeleccionaAmbiente(<?=$idamb?>)"><i class="fa fa-home"></i> Regresar</a >
          <button style="width: 20%" type="submit" id="botonCierre" class="btn btn-primary"><i class="fa fa-arrow-circle-right"></i> Procesar</button>
        </div>  
      </form> 
    </div>
  </div>
</section>
 