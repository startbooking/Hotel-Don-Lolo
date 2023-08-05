<?php 
  require_once '../../res/php/app_topPos.php'; 

  $idamb  = $_POST['id'];
  $nomamb = $_POST['amb'];
  $user   = $_POST['user'];
  $iduser = $_POST['iduser'];
  $impto  = $_POST['impto'];
  $prop   = $_POST['prop'];
  $logo   = $_POST['logo'];
  $file   = $_POST['file'];
  $fecha  = $_POST['fecha'];

?>

<section class="content">
  <div class="panel panel-success">
    <div class="panel-heading">  
      <div class="row">
        <div class="col-lg-9">
          <input type="hidden" name="user" id="user" value="<?=$user?>">
          <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_POS?>">
          <input type="hidden" name="fechapos" id="fechapos" value="<?=$fecha?>">
          <input type="hidden" name="ubicacion" id="ubicacion" value="balance_diario.php">
          <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-industry"></i> Balance del Dia Cajero <?=$user?> </h3>
        </div>
      </div>
    </div>
    <div class="panel-body">
      <div class="imprimeInforme">
        <object id="verInforme" width="100%" height="500" data=""></object> 
      </div>
      <?php 
        include_once '../imprimir/imprimeCarteraDiario.php'; 
      ?>
    </div>
  </div> 
</section>  

