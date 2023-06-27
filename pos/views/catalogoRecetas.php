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
              <input type="hidden" name="usuarioActivo" id="usuarioActivo" value="<?=$user?>">
              <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_PMS?>">
              <input type="hidden" name="ubicacion" id="ubicacion" value="catalogoRecetas">
              <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-industry"></i> Catalogo Recetas Estandar</h3> 
            </div>
          </div>
        </div>
        <div class="panel-body ">
          <div class="form-horizontal">
            <div class="form-group">
              <label class="control-verInformelabel col-md-2">Tipo de Recetas</label>
              <div class="col-lg-4 col-md-4">
                <select name="tipoReceta" id="tipoReceta"  class="form-control" style="padding:4px 12px">
                  <option value="">Todas</option>
                  <?php
                  $formas = $pos->getSeccionesPos();
                  foreach ($formas as $forma) { ?>
                    <option value="<?=$forma['id_seccion']?>"><?=$forma['nombre_seccion']?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <div class="btn-group pull-right">
                  <button class="btn btn-success" type="buttom" onclick='buscaRecetas()'>
                  <i class="fa fa-print" aria-hidden="true"></i>
                  Imprimir</button>
                </div>
              </div>
            </div>
          </div>
          <div class="imprimeInforme">
            <object id="verInforme" width="100%" height="500" data=""></object> 
          </div>
        </div>
        <div class="panel-footer">
<!--           <div class="row-fluid">
            <div class="imprimeInforme"></div>
          </div>
 -->        </div>
      </div>
    </div>
  </section>
