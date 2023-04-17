<?php 
  require '../../res/php/titles.php';
  require '../../res/php/app_topHotel.php'; 
  if(!isset($_SESSION["usuario"])){ ?>
    <meta charset="utf-8" />
    <meta http-equiv="refresh" content="0;URL=../../index.php" />
    <?php 
  }
  $path      = $_SERVER['PHP_SELF'];

?>

<!DOCTYPE html>
<html>
  <head>
	<title><?= TITLE_PMS ?> | LLegadas del Dia </title>
    <?php include_once("../../res/shared/archivo_head.php") ; ?>
    <link rel="stylesheet" type="text/css" href="../css/stylepms.css">
  </head>
  <body class="skin-yellow sidebar-mini">
 	  <?php 
      include_once("../menus/menu_titulo.php");
      include_once("../menus/menu_hotel.php");
     ?>
    <div class="content-wrapper"> 
      <section class="content">
        <div class="panel panel-success">
          <div class="panel-heading"> 
            <div class="row">
              <div class="col-lg-9">
                <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_PMS?>">                  
                <input type="hidden" name="ubicacion" id="ubicacion" value="balanceCajero.php">
                <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-industry"></i> Informe de Huespedes Llegando en el Dia</h3>
              </div>
              <div class="col-lg-3" align="right">
                <a style="margin:20px 0" type="button" class="btn btn-success" href=""> <i class="fa fa-print" aria-hidden="true"></i>Imprimir</a>
              </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="imprimeInforme">
              <object id="verInforme" width="100%" height="500" data=""></object> 
            </div>
            <?php 
              include '../imprimir/imprimeHuespedesLlegadasHoy.php';
            ?>              
          </div>
        </div>
      </section>
    </div>
    <?php 
      include("../../res/shared/archivo_pie.php") ;
      include("../../res/shared/archivo_script.php") ;
    ?>
    <script>
      $('#verInforme').attr('data','../imprimir/informes/Informes_reservas.pdf')
    </script>
    <script src="../js/ajax-pms.js"></script> 
  </body> 
</html>

