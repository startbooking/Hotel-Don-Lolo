<?php 
  session_start() ;
  $session_id = session_id();
  $date = date('Y-m-d');
  include_once "../../Conn/Conn.php";
  include_once "../../Conn/funciones.php";
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
  <body class="skin-yellow sidebar-mini">
    
    <?php 
      include_once("../menus/menu_titulo.php");
      include_once("../menus/menu_inventario.php");
     ?>
    <div class="wrapper">
      <div class="content-wrapper"> 
        <section class="content" style='margin-left:30px'>
          <?php 
            //include_once("../modal/modal_agregar_producto.php");
            //include_once("../modal/modal_agregar_proveedor.php");
            include_once("../modal/modal_productos_movimientos.php"); 
          ?>
          <h3>Movimientos de Entradas de Inventarios</h3>
          <form id="Entradas" class="form-horizontal">
            <div class="panel panel-warning">
              <div class="panel-heading">
                <input type="hidden" id="session" name="session" value="<?=$session_id?>">    
                <div class="form-group">
                  <label for="tipo" class="control-label col-lg-1 col-md-1">Almacen</label>
                  <div class="col-lg-3 col-md-3">
                    <select name="bodega" id="bodega" required>
                      <option value="">Seleccione la Bodega</option>
                      <?php 
                      $sql_bod = "SELECT * FROM bodegas where pri_alma = 1 ORDER BY nom_alma" ;
                      $res_bod = mysqli_query($conn,$sql_bod);
                      while($row_bod=mysqli_fetch_assoc($res_bod)){
                        ?>
                        <option value="<?=$row_bod['cod_alma']?>"><?=$row_bod['nom_alma']?></option>
                      <?php 
                        }
                      ?>
                    </select>
                  </div>
                  <label for="tipo" class="control-label col-lg-2 col-md-2">Movimiento</label>
                  <div class="col-lg-3 col-md-3">
                    <select name="tipomov" id="tipomov" required>
                      <option value="">Seleccione el tipo de Entrada</option>
                      <?php 
                      $sql_tmo = "SELECT * FROM tipo_movimiento_inv where tipo = 1 and ajuste <> 1 ORDER BY descripcion" ;
                      $res_tmo = mysqli_query($conn,$sql_tmo);
                      while($row_tmo=mysqli_fetch_assoc($res_tmo)){
                        ?>
                        <option value="<?=$row_tmo['codigo']?>"><?=$row_tmo['descripcion']?></option>
                      <?php 
                        }
                      ?>
                    </select>
                  </div>
                  <label for="tipo" class="control-label col-lg-1 col-md-1">Fecha</label>
                  <div class="col-lg-2 col-md-2">
                    <input type="text" id="fecha" name="fecha" class="fecha" required>
                  </div>
                </div>
                <div class="form-group">
                  <!--<label for="tipo" class="control-label col-lg-1 col-md-1">Doc.</label>
                  <div class="col-lg-1 col-md-1">
                    <input type="text" class="form-control" id="fecha" name="fecha" readonly>
                  </div>-->
                  <label for="tipo" class="control-label col-lg-1 col-md-1">Proveedor</label>
                  <div class="col-lg-3 col-md-3">
                    <div class="btn-group">
                      <select name="proveedor" id="proveedor" required>
                        <option value="">Seleccione el Proveedor</option>
                        <?php 
                        $sql_pro = "SELECT * FROM proveedores where activo = 1 ORDER BY empresa" ;
                        $res_pro = mysqli_query($conn,$sql_pro);
                        while($row_pro=mysqli_fetch_assoc($res_pro)){
                          ?>
                          <option value="<?=$row_pro['id_prov']?>"><?=$row_pro['empresa']?></option>
                        <?php 
                          }
                        ?>
                      </select>
                    </div>
                  </div>
                  <label for="tipo" class="control-label col-lg-1 col-md-1">Factura</label>
                  <div class="col-lg-2 col-md-2">
                    <input type="text" class="form-control" id="factura" name="factura" required="">
                  </div>
                  <div class="col-lg-2">
                    <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#myModal">
                      <i class='glyphicon glyphicon-plus'></i> Agregar Productos
                    </button>
                  </div>                  
                </div>
              </div>
              <div class="panel-body">
                <div id="resultados" class='col-md-12' style="margin-top:15px"></div><!-- Carga los datos ajax -->      
              </div>
              <div class="panel-footer">
                <div class="row">
                  <div class="col-lg-3 col-lg-offset-3">
                    <button class="btn btn-warning btn-block" type="">
                      <i class="fa fa-reply" aria-hidden="true"></i>
                      Cancelar  
                    </button>
                  </div>
                  <div class="col-lg-3">
                    <button class="btn btn-success btn-block" type="submit" onclick="AgregarEntradas()">  
                      <i class="fa fa-floppy-o" aria-hidden="true"></i>
                      Procesar   
                    </button>
                  </div>
                </div>
              </div>  
            </div>
          </form>
          <div class="box-header">
            
            <!-- Content Wrapper. Contains page content -->
            
          </div>         
          <!-- /.box -->
        </section>
      </div>
    </div>
    <?php // include("../../bases/archivo_pie.php") ?>
    <!-- jQuery 2.2.3 
    -->
    <script src="../../plugins/jquery/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 
    -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables 
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    -->
    <!-- FastClick 
    <script src="../../plugins/fastclick/fastclick.js"></script>
    -->
    <script src="../../dist/js/app.min.js"></script>
    <!-- AdminLTE App 
    -->
    <!-- AdminLTE for demo purposes 
    <script src="../../dist/js/demo.js"></script>
    -->

    <!-- SlimScroll 
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    -->
    <!-- page script 
    <script type="text/javascript" src="../../jquery-ui/external/jquery/jquery.js"></script>
    -->
    <!-- jquery ui 
    -->
    <script type="text/javascript" src="../../jquery-ui/jquery-ui.min.js"></script>

    <script type="text/javascript">
      $("#fecha").datepicker();
      $('#fecha').datepicker('option', {dateFormat: 'yy-mm-dd'}); 
      $("#fecha").datepicker( "setDate" , "<?php echo $date ?>" ); 
    </script>    
    
    <script type="text/javascript" src="../js/movimientos.js"></script>
  </body> 
</html>

