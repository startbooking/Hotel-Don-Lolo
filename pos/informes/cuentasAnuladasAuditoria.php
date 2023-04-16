<?php 
  require_once '../../res/php/titles.php';
  require_once '../../res/php/app_topPos.php'; 

  $idamb  = $_POST['id'];
  $nomamb = $_POST['amb'];
  $user   = $_POST['user'];
  $iduser = $_POST['iduser'];
  $impto  = $_POST['impto'];
  $prop   = $_POST['prop'];

  define('FECHA_POS', $_POST['fecha']); 
  
  $_SESSION['NOMBRE_AMBIENTE'] = $nomamb;
  $_SESSION['AMBIENTE_ID']     = $idamb;
  $_SESSION['usuario']         = $user;
  $_SESSION['usuario_id']      = $iduser;
?>

<section class="content">
  <div class="panel panel-success">
    <div class="panel-heading"> 
      <div class="row">
        <div class="col-lg-9">
          <input type="hidden" name="user" id="user" value="<?=$_SESSION['usuario']?>">
          <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_POS?>">
          <input type="hidden" name="ubicacion" id="ubicacion" value="balanceDiario.php">
          <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-industry"></i> Comandas Activas</h3>
        </div>
      </div>
    </div>
    <div class="panel-body">
      <div class="imprimeInforme">
        <object id="verInforme" width="100%" height="500" data=""></object> 
      </div>
      <?php 
        include '../imprimir/imprimeCuentasActivas.php';
      ?>
    </div>
  </div> 
</section>

      <!--

<!DOCTYPE html>
<html>
  <head>
	<title><?= TITLE_PMS ?> | Cuentas Activas</title>
    <?php // include_once("../../res/shared/archivo_head.php") ; ?>
    <link rel="stylesheet" type="text/css" href="../res/css/estilo.css">
  </head>
  <body class="skin-red sidebar-mini">
 	  <?php 
      // include_once("../menus/menu_titulo_venta2.php");
      // include_once("../menus/menu_pos.php");
     ?>
    <div class="content-wrapper"> 
    </div>
    <?php 
      // include("../../res/shared/archivo_pie.php") ;
      // include("../../res/shared/archivo_script.php") ;
    ?>
    <script>
      usu = $('#user').val();
      $('#verInforme').attr('data','../imprimir/informes/cuentasActivas_'+usu+'.pdf')
    </script>
    <script src="../res/js/pos.js"></script> 
  </body> 
</html>

-->