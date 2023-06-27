<?php 
  session_start() ;
  #include_once "../../Conn/Conn.php";
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
        
          <div class="box-header">
            <!-- Content Wrapper. Contains page content -->
            <?php 
              $query = 'SELECT p.id_prod, p.cod_prod, p.nom_prod, f.des_falm, g.des_grup, s.des_subg, u.des_unid FROM productos_inve as p, familia_inve as f, grupos_inve as g, subgrupos_inve as s, unidades as u WHERE p.cod_familia = f.cod_falm AND p.cod_grupo = g.cod_grup AND p.cod_subgrupo = s.cod_subg AND p.uco_prod = u.cod_unid ORDER BY p.nom_prod ASC';
              $result = mysqli_query($conn,$query);
              // Imprimir los resultados en HTML'
            ?>
            <div class="row">
              <!-- /.box-header -->
              <div class='table-responsive'>
                <div class="datos_ajax_delete"></div><!-- Datos ajax Final -->
                <table id="example1" class="table table-bordered">
                  <thead>
                    <tr class="warning">
                      <td>Codigo</td>
                      <td>Producto</td>
                      <td>Familia</td>
                      <td>Grupo</td>
                      <td>SubGrupo</td>
                      <td>Unidad</td>
                      <td>Accion</td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      while($row = mysqli_fetch_array($result)){
                    ?>
                      <tr style='font-size:12px'>
                        <td width="22px"><?php echo $row['cod_prod']; ?></td>
                        <td><?php echo $row['nom_prod']; ?></td>
                        <td><?php echo $row['des_falm']; ?></td>
                        <td><?php echo $row['des_grup']; ?></td>
                        <td><?php echo $row['des_subg']; ?></td>
                        <td><?php echo $row['des_unid']; ?></td>                       
                        <td>
                          <!--
                          <center>
                            <a href="#a<?php echo $row['id_prod']; ?>" title="Editar Proveedor" role="button" class="btn btn-mini" 
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
                          data-id="<?php echo $row['id_prod']?>"  
                          data-codigo="<?php echo $row['nom_prod']?>"  
                          title="Modifica Datos del Producto" >
                          <i class='glyphicon glyphicon-edit'></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-xs" 
                            data-toggle="modal" 
                            data-target="#dataDeleteProveedor" 
                            title="Eliminar Proveedor" 
                            data-id="<?php echo $row['id_prod']?>"  
                            data-codigo="<?php echo $row['nom_prod']?>">
                            <i class='glyphicon glyphicon-trash'></i> 
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
    <?php include("../../bases/archivo_pie.php") ?>

    <?php include("../../bases/archivo_script.php") ?>
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
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

