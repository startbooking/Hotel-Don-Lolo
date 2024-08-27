<?php 
  session_start() ;
  $session_id = session_id();

  $date = date('YY-m-d');
  // include_once "../../Conn/Conn.php";
  // include_once "../../Conn/funciones.php";
  include_once('../../Conn/seciones.php');
  include_once('../../Conn/valida_ingreso.php')
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <title><?= $titulo ?>"Movimientos de Inventarios"</title>
    <?php include_once("../../bases/archivo_head.php") ?>
    <link rel="stylesheet" type="text/css" href="../../jquery-ui/jquery-ui.min.css">
  </head>
  <body class="skin-yellow sidebar-mini" onload="pone_almacenes();pone_producto();pone_unidad();pone_tipo_movimiento();">
    <?php 
      include_once("../menus/menu_titulo.php");
      include_once("../menus/menu_inventario.php");
    ?>
    <div class="content-wrapper"> 
      <section class="content-fluid" style='margin-left:30px'>
        <?php 
        /* Ventanas Modal*/
        ?>

        <div class="row">
          <h3 align="center">Ajustes de Inventarios</h3>
        </div>
        <!-- Content Header (Page header) -->
        <div class="row">
        <div class='col-md-4'>
          <div class='box box-success'>
            <div class='box-header with-border'>
              <h3 align="center" class='box-title'>Articulo de Inventario</h3>
            </div>
            <div class='box-body'>
              <form class='form-horizontal'>
                <div class='form-group'>
                  <label class="col-sm-3 control-label">Fecha</label>
                  <div class="col-lg-9">
                    <input type="text" class="form-control pull-right" id="fecha" autocomplete="off">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Almacen</label>
                  <div id="pone_almacen" class="col-sm-9"></div>
                </div>
                <div class="form-group">
                  <label  class="col-sm-3 control-label">Producto</label>
                  <input type="hidden" id='codigo'> 
                  <input type="hidden" id='descripcion'> 
                  <div id="pone_producto" class="col-sm-9"></div>
                </div>
                <div class="form-group">
                  <label  class="col-sm-3 control-label">Unidad</label>
                  <div id="pone_unidad" class="col-sm-9"></div>
                </div>
                <div class='form-group'>
                  <label for="existencias" class="col-sm-6 control-label">Saldo Actual:</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id='exis_anterior' disabled>
                  </div>
                </div>
                <div class='form-group'>
                  <label for="promedio" class="col-sm-6 control-label">Valor Prom:</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id='val_prome' disabled>
                  </div>
                </div>
                <div class='form-group'>
                  <label for="exis_actual" class="col-sm-6 control-label">Nuevo Saldo</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control cantidades" id='saldo_act' onblur='tipo_ajuste();'
                  data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false" disabled>
                  </div>
                </div>
                <div class='form-group'>
                  <label for="tipo_movi" class="col-sm-3 control-label">Movim.</label>
                  <input type="hidden" name="" id="tipo">
                  <div id="pone_tipo_movi" class="col-sm-9">
                  </div>
                </div>

              </form>
            </div>
            <div class='box-footer'>
              <div class="row">
                <div class="col-lg-6">
                  <button type='button' class='btn btn-primary btn-block' onclick='verifica_tabla_existencia();agrega_a_lista();'><i class='fa fa-plus'></i> Agregar</button>
                </div>
                <div class="col-lg-6">
                  <button type='button' class='btn btn-danger btn-block' onclick='cancela();'><i class='fa fa-times'></i> Cancelar</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class='col-md-8'>
          <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'>Articulos para Ajustar</h3>
            </div>
            <div class='box-body'>
              <table id='tabla_articulos' class='table table-bordered'>
                <thead>
                  <tr>
                    <th>Codigo</th>
                    <th>Descripcion</th>
                    <th>Saldo Actual</th>
                    <th>Nuevo Saldo</th>
                    <th>Dif.</th>
                    <th>Valor</th>
                    <th>Tipo</th>
                    <th>Accion</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
            <div class='box-footer'>
              <div class="row">
                <div class="col-lg-3 col-lg-offset-3">
                  <button class='btn btn-danger btn-block' onclick='cancela_todo();'><i class='fa fa-trash-o'></i> Cancelar</button>
                </div> 
                <div class="col-lg-3">
                  <button class='btn btn-primary btn-block' onclick='procesa_lista_ajustes();'><i class='fa fa-thumbs-up'></i> Procesar Ajuste</button>
                </div> 
              </div>
            </div>
          </div>
        </div>
        </div>
      </section>

        <!-- Main content -->
      <section class="content">
          <!-- Your Page Content Here -->
      </section><!-- /.content -->
    </div><!-- ./wrapper -->
    <?php include("../../bases/archivo_pie.php") ?>
    <?php include("../../bases/archivo_script.php") ?>
    <script src="../../dist/datepicker/js/bootstrap-datepicker.js"></script>
    <script src="../../dist/datepicker/locales/bootstrap-datepicker.es.min.js"></script>
    <script src="../../dist/noty/packaged/jquery.noty.packaged.min.js"></script>
    <script type="text/javascript" src="../js/ajustes.js"></script>
    <script type="text/javascript" src="../js/imprimir.js"></script>
    <script type="text/javascript">
      $("#fecha").datepicker({
        language: "es",
        format: "yyyy-mm-dd"
      });
    </script>
<!--    <script>
      $(function () {
        $('#tabla_articulos').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": true,
          "language": {
            "next": "Siguiente",
            "search": "Buscar:",
            "entries": "registros"
          },
        });
      });
    </script>    -->
    <!-- REQUIRED JS SCRIPTS -->
  </body>
</html>