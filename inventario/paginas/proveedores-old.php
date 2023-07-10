<?php 
  # error_reporting(0);
  session_start();
  include_once('../../Conn/Conn.php');
  include_once('../../Conn/funciones.php');
  include_once('../../Conn/seciones.php');
?>

<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $titulo?> Proveedores</title>
    <?php include("../../bases/archivo_head.php") ?>
  </head>
  <body class="skin-yellow sidebar-mini">
    <div class="wrapper">
      <?php  include("../menus/menu_inventario.php"); ?>
      <?php  include("../menus/menu_titulo.php"); ?>
        <div class="content-wrapper">
          <section class="content-header">
            <?php 
              include_once("../modal/modal_agregar_proveedor.php");
              include_once("../modal/modal_modificar_proveedor.php"); 
              include_once("../modal/modal_eliminar_proveedor.php");
            ?>
            <div class='col-xs-6'>
                <h4 align="center">Catalogo de Proveedores</h4>
            </div>
            <div class='col-xs-6'>
              <h3 class='text-right'>   
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#dataRegisterProveedor"><i class='glyphicon glyphicon-plus'></i> Adicionar Proveedor</button>
              </h3>
            </div>
          </section>
   
          <section class="content">
            <div class="container-fluid">
                <div class="row">
                <div class="col-xs-12">
                  <div id="loader2" class="text-center"> 
                    <img src="<?=$_SESSION['BASE_IMG']?>loader.gif">
                  </div>
                <div class="datos_ajax"></div><!-- Datos ajax Final -->
                <div class="datos_ajax_delete"></div><!-- Datos ajax Final -->
                <div class="outer_div2"></div><!-- Datos ajax Final -->
                </div>
                </div>
            </div>
          </section>  
            <?php include("../../bases/archivo_pie.php") ; ?>
        </div>
    </div>
    <?php 
      include("../../bases/archivo_script.php") 
    ?>
    <script src="../js/inventario.js"></script>
    <script>
      $(document).ready(function(){
        loadproveedor(1);
      });
    </script>  
  </body> 
</html>

