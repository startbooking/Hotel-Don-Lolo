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
	<title><?= $titulo ?>"Proveedores"</title>
    <?php include_once("../../bases/archivo_head.php") ?>
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
            //include_once("../modal/modal_modificar_producto.php");
            include_once("../modal/modal_eliminar_proveedor.php");
          ?>
          <h3>Catalogo de Proveedores</h3>
          <div class="box-header">
            <!-- Content Wrapper. Contains page content -->
            <?php 
              $query = 'SELECT id_prov, empresa, direccion, nit, digito, telefono, activo FROM proveedores ORDER BY empresa ASC';
              $result = mysqli_query($conn,$query);
              // Imprimir los resultados en HTML'
            ?>
            <div class="row">
              <!-- /.box-header -->
              <div class='table-responsive'>
                <div class="datos_ajax_delete"></div><!-- Datos ajax Final -->
                <table id="example1" class="table table-bordered">
                  <thead>
                    <tr class="warning" align="center">
                      <td>Nombre</td>
                      <td>Direccion</td>
                      <td>Nit</td>
                      <td>Dv</td>
                      <td>Telefono</td>
                      <td>Estado</td>
                      <td>Accion</td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      while($row = mysqli_fetch_array($result)){
                    ?>
                      <tr style='font-size:12px'>
                        <td width="220px"><?php echo $row['empresa']; ?></td>
                        <td><?php echo $row['direccion']; ?></td>
                        <td align="right"><?php echo strtr(number_format($row['nit'],0),",","."); ?></td>
                        <td><?php echo $row['digito']; ?></td>
                        <td align="right"><?php echo $row['telefono']; ?></td>
                        <td><center>
                          <?php echo estado_n($row['activo']); ?></center></td>
                        <td>
                          <!--
                          <center>
                            <a href="#a<?php echo $row['id_prov']; ?>" title="Editar Proveedor" role="button" class="btn btn-mini" 
                            data-toggle="modal">
                              <i class="icon-edit"></i>
                            </a>
                          </center>
                          </td>
                          <td align='center'>
                          --> 
                        <button type="button" class="btn btn-info btn-xs" 
                          data-toggle="modal" 
                          data-target="#dataUpdateProveedor" 
                          data-id="<?php echo $row['id_prov']?>"  
                          data-codigo="<?php echo $row['cod_prov']?>"  
                          data-empresa="<?php echo $row['empresa']?>"  
                          title="Modifica Datos del Proveedor" >
                          <i class='glyphicon glyphicon-edit'></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-xs" 
                            data-toggle="modal" 
                            data-target="#dataDeleteProveedor" 
                            title="Eliminar Proveedor" 
                            data-id="<?php echo $row['id_prov']?>"  
                            data-codigo="<?php echo $row['cod_prov']?>"
                            data-empresa="<?php echo $row['empresa']?>"  >
                            <i class='glyphicon glyphicon-trash '></i> 
                          </button>
                         </td>
                       </tr>
                     <?php
                    }
                    ?>
                  </tbody>
                  
                </table>
              </div>
              <!-- /.box-body -->
            </div> 
          </div>         
          <!-- /.box -->
        </section>
      </div>
    </div>
    <?php include("../../bases/archivo_pie.php") ?>
    <!-- jQuery 2.2.3 -->
    <script src="../../plugins/jquery/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../../plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>

    <!-- SlimScroll -->
    <!-- page script -->
    <script>
      $(function () {
        $('#example1').DataTable({
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
    </script>
    <script src="../js/inventario.js"></script>

  </body> 
</html>

