<?php 
  require '../res/php/titles.php';
  require '../res/php/app_top.php';
 
?>

<!DOCTYPE html>
<html lang="es">
  <head>
  	<meta charset="utf-8">
  	<title><?= TITLE?> Modulos del Sistema</title>
    <?php 
    include_once("../res/shared/archivo_head.php") ;
    ?>
  </head>
  
  <body class="skin-green sidebar-mini">
    <?php  include("../res/menus/menu_salir.php"); ?>
	  
    <section class="container" style="margin-top:5px">      
      <div class="container"> 
        <div class="col-md-4 col-sm-4 col-xs-12">          
          <h1 class="fontModule">
          <b style="font-weight: 800">Control Panel</b>
          <small class="badge btn-info" style="border-radius:10px;padding:8px;background: #3c8dbc">Modulos del Sistema
          </small>
            <p style="font-weight: 600"></p>
          </h1>
        </div>
        <div class="col-sm-8 col-sm-8 col-xs-12">          
          <div class="col-xs-3">
            <img class="img-thumbnail" src="<?=BASE_WEB?>img/<?=LOGO_EMPRESA?>"> 
          </div>
          <div class="col-xs-9">
            <h1 class="fontModule">
              <b style="font-weight: 800"><?=NAME_EMPRESA?></b>
              <small>
                <p style="font-weight: 600">Nit <?=NIT_EMPRESA?></p>
            </small>
            </h1>
          </div>
        </div>  
      </div>
      <div id="modulos" class="container" style="margin-top:30px;"></div>       
    </section>
  </body>
  <?php  
    include("../res/shared/archivo_pie.php") ;
    include("../res/shared/archivo_script.php");
    include_once '../views/modal/modalUsuario.php';    
  ?>
    <script src="../res/js/inicio.js"></script>  
    <script>
      activaModulos();
    </script> 


</html>
