<?php 
  session_start() ;
  include_once "../../Conn/Conn.php";
  #include_once "../../class/class_prod.php";
  include_once "../../Conn/funciones.php";
  include_once('../../Conn/seciones.php');
  include_once('../../Conn/valida_ingreso.php')
?>

<!DOCTYPE html>
<html>
  <head>
	<title><?= $titulo ?>"Productos"</title>
    <?php include_once("../../bases/archivo_head.php") ?>
  </head>
  <body class="skin-yellow sidebar-mini" onload='loadproducto(1)'>
 	  <?php 
      include_once("../menus/menu_titulo.php");
      include_once("../menus/menu_inventario.php");
     ?>
    <div class="content-wrapper"> 
      <section class="content" style='margin-left:30px'>
        <?php 
          include_once("../modal/modal_agregar_producto.php");
          include_once("../modal/modal_modificar_producto.php");
          include_once("../modal/modal_eliminar_producto.php");
        ?>
        <h3>Catalogo de Productos</h3>
        
        <div id="loader2"></div>
        <div class="outer_div2"></div>
              
        <!-- /.box -->
      </section>
    </div>
    <?php include("../../bases/archivo_pie.php") ?>

    <?php include("../../bases/archivo_script.php") ?>
    <script src="../js/inventario.js"></script>

  </body> 
</html>

