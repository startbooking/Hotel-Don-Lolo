<?php 
  // session_start() ;
  $session_id = session_id();

  $date = date('YY-m-d');
  // include_once "../../Conn/Conn.php";
  // include_once "../../Conn/funciones.php";
  include_once('../../Conn/seciones.php');
  include_once('../../Conn/valida_ingreso.php')
?>

<!DOCTYPE html>
<html>
  <head>
    <title><?= $titulo ?>"Movimientos de Inventarios"</title> 
    <?php include_once("../../bases/archivo_head.php") ?>
    <link rel="stylesheet" type="text/css" href="../../jquery-ui/jquery-ui.min.css">
  </head>
  <body class="skin-yellow sidebar-mini" onload='pone_almacen();pone_tipo_movimiento();pone_proveedor();pone_producto();pone_impuesto();pone_unidad()'>
    <?php 
      include_once("../menus/menu_titulo.php");
      include_once("../menus/menu_inventario.php");
    ?>
    <div class="content-wrapper"> 
      <section class="content" style='margin-left:30px'>
        <?php 
          include_once("../modal/modal_entrada_movimientos.php");
          include_once("../modal/modal_anula_movimientos.php");
          include_once("../modal/modal_movimientos.php"); 
        ?>
        <div class="row">
          <h4 align="center">Movimientos de Entradas de Inventarios</h4>
          <div class="row-fluid">
            <div class="entradas "></div>
            <div id="loader"></div>
            <div class="col-lg-6"></div>
          </div>
        </div>
        <div class="container-fluid" style="margin-top:30px">
          <div class="almacen"></div>
          <div id="loader2"></div>
        </div>
        <br>
        <br>  
        <!-- Content Wrapper. Contains page content -->
        <!-- /.box -->
      </section>
    </div>
    <?php include("../../bases/archivo_pie.php") ?>
    <?php include("../../bases/archivo_script.php") ?>
    <script src="../../dist/datepicker/js/bootstrap-datepicker.js"></script>
    <script src="../../dist/datepicker/locales/bootstrap-datepicker.es.min.js"></script>
    <script type="text/javascript" src="../js/entradas.js"></script>
    <script type="text/javascript" src="../js/imprimir.js"></script>
    <script type="text/javascript">
      $("#fecha").datepicker({
        language: "es",
        format: "yyyy-mm-dd"
      });
    </script>    
  </body> 
</html>

