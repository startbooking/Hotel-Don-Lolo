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
	  
    <section class="container" style="margin-top:3%">      
      <div class="container"> 
        <div class="col-md-5 col-sm-5 col-xs-12">          
          <h1 class="fontModule">
          Control Panel <br>
          <small class="">Modulos del Sistema </small>
            <!-- <p style="font-weight: 600"></p> -->
          </h1>
        </div>
        <div class="col-md-2 col-sm-2 col-xs-12 centro">
            <div class="container-fluid">
              <img class="img-thumbnail" style="margin-top:0;" src="<?=BASE_WEB?>img/<?=LOGO_EMPRESA?>"> 
            </div>
        </div>          
        <div class="col-sm-5 col-sm-5 col-xs-12">          
          <h1 class="derecha fontModule" >
            <?=NAME_EMPRESA?>
            <br>
            <!-- <b style="font-weight: 800">
            </b> -->
            <small>
              Nit <?=NIT_EMPRESA?>
          </small>
          </h1>
          <!-- <div class="col-xs-3">
          </div>
          <div class="col-xs-9">
          </div> -->
        </div>  
      </div>
      <div id="modulos" class="container" style="margin-top:5%;"></div>       
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
