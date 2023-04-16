<?php session_start() ; ?>

<!DOCTYPE html>
<html>
  <head>
	<title>Catalogo de Productos </title>
  <!-- <?php #include("../../config/archivo_head.php") ?> -->
  <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
  </head>
  <body class="skin-blue sidebar-mini">
    <?php  include("../config/menu_izq.php"); ?>
    <!-- <?php # include_once "../../menu/m_profesor.php"; ?> -->
    <div class="wrapper">
      <table width="80%">
        <tr>
          <td>
            <table class="table table-bordered">
              <tr class="info">
                <td>
                  <div class="row-fluid">
                    <div class="span6">
                      <h2 class="text-info">
                        <img src="../../img/frutas.png" width="80" height="80">Catalogo de Productos
                      </h2>
                    </div>
                    <div class="span6">
                      <form name="form1" method="post" action="">
                        <div class="input-append">
                          <input type="text" name="buscar" class="input-xlarge" autocomplete="off" autofocus placeholder="Buscar Productos">
                          <button type="submit" class="btn"><strong><i class="icon-search"></i> Buscar</strong></button>
                        </div>
                      </form>
                      <a href="#nuevo" role="button" class="btn" data-toggle="modal">
                        <strong><i class="icon-plus"></i> Ingresar Nuevo Producto</strong>
                      </a>
                      <div id="nuevo" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <form name="form2" method="post" action="">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="myModalLabel">Registrar Nuevo Producto</h3>
                          </div>
                          <div class="modal-body">
                            <div class="row-fluid">
                              <div class="span6">
                                <strong>Codigo</strong><br>
                                <input type="text" name="cod_prod" autocomplete="off" required value=""><br>
                                <strong>Producto</strong><br>
                                <input type="text" name="nom_prod" autocomplete="off" required value=""><br>
                                <strong>Familia</strong><br>
                                <input type="text" name="fal_prod" autocomplete="off" required value=""><br>
                                <strong>Grupo</strong><br>
                                <input type="text" name="gru_prod" autocomplete="off" required value=""><br>
                                <strong>Subgrupo</strong><br>
                                <input type="text" name="sgr_prod" autocomplete="off" required value=""><br>
                                <strong>Unidad de Medida</strong><br>
                                <input type="text" name="unc_prod" autocomplete="off" required value=""><br>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> <strong>Cerrar</strong></button>
                            <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> <strong>Guardar</strong></button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <table width="80%">
        <tr>
          <td>
              <?php
              if(!empty($_POST['doc']) and !empty($_POST['nom'])){
                $nom=limpiar($_POST['nom']);    $ape=limpiar($_POST['ape']);
                $doc=limpiar($_POST['doc']);    $fecha=limpiar($_POST['fecha']);
                $dir=limpiar($_POST['dir']);    $tel=limpiar($_POST['tel']);
                $cel=limpiar($_POST['cel']);    $correo=limpiar($_POST['correo']);
                $especialidad=limpiar($_POST['especialidad']);  $estado=limpiar($_POST['estado']);
                $tipo=limpiar($_POST['tipo']);    $con=$doc;
                if(empty($_POST['id'])){
                  $oProfesor=new Proceso_Profesor('', $nom, $ape, $doc, $fecha, $dir, $tel, $cel, $correo, $especialidad, $estado, $tipo, $con);
                  $oProfesor->guardar();
                  echo mensajes('El Producto "'.$nom.' '.$ape.'" Ha sido Guardado con Exito','verde');
                }else{
                  $id=limpiar($_POST['id']);
                  $oProfesor=new Proceso_Profesor($id,$nom, $ape, $doc, $fecha, $dir, $tel, $cel, $correo, $especialidad, $estado, $tipo, $con);
                  $oProfesor->actualizar();
                  echo mensajes('El Producto "'.$nom.' '.$ape.'" Ha sido Actualizado con Exito','verde');
                  }
                }
              ?>
            <table class="table table-bordered table table-hover">
              <tr class="info">
                <td><strong class="text-info">Documento</strong></td>
                <td><strong class="text-info">Nombre y Apellido</strong></td>
                <td><strong class="text-info">Correo</strong></td>
                <td><strong class="text-info">Celulares</strong></td>
                <td><center><strong class="text-info">Tipo de Usuario</strong></center></td>
                <td><center><strong class="text-info">Estado</strong></center></td>
                <td>&nbsp;</td>
              </tr>
              <?php
                if(!empty($_POST['buscar'])){
                  $buscar=limpiar($_POST['buscar']);
                  $pa=mysql_query("SELECT * FROM productos WHERE nom_prod LIKE '%$buscar%' or ape LIKE '%$buscar%' or doc='$buscar'");          
                }else{
                  $pa=mysql_query("SELECT * FROM profesor");        
                }
              ?>
              <tr>
                <td><?php echo $row['doc']; ?></td>
                <td><?php echo $row['nom'].' '.$row['ape']; ?></td>
                <td><?php echo $row['correo']; ?></td>
                <td><?php echo $row['cel']; ?></td>
                <td><center><?php echo $tipo; ?></center></td>
                <td><center><?php echo estado($row['estado']); ?></center></td>
                <td>
                  <center>
                    <a href="#a<?php echo $row['id']; ?>" title="Editar Profesor" role="button" class="btn btn-mini" data-toggle="modal">
                      <i class="icon-edit"></i>
                    </a>
                  </center>
                  <div id="a<?php echo $row['id']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <form name="form2" method="post" action="">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h3 id="myModalLabel">Actualizar Productos</h3>
                    </div>
                    <div class="modal-body">
                      <div class="row-fluid">
                        <div class="span6">
                          <strong>Codigo</strong><br>
                          <input type="text" name="doc" autocomplete="off" readonly value="<?php echo $row['doc']; ?>"><br>
                          <strong>Producto</strong><br>
                          <input type="text" name="nom" autocomplete="off" required value="<?php echo $row['nom']; ?>"><br>
                          <strong>Familia</strong><br>
                          <input type="text" name="ape" autocomplete="off" required value="<?php echo $row['ape']; ?>"><br>
                          <strong>Grupo</strong><br>
                          <input type="text" name="especialidad" autocomplete="off" required value="<?php echo $row['especialidad'];?>"><br>
                          <strong>SubGrupo</strong><br>
                          <input type="email" name="correo" autocomplete="off" required value="<?php echo $row['correo']; ?>"><br>
                          <strong>Tipo de Usuario</strong><br>
                          <select name="tipo">
                            <option value="p" <?php if($row['tipo']=='p'){ echo 'selected'; } ?>>Profesor</option>
                            <option value="a" <?php if($row['tipo']=='a'){ echo 'selected'; } ?>>Administrador</option>
                          </select>
                        </div>
                      </div>
                    <div>
                      <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> <strong>Cerrar</strong></button>
                        <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> <strong>Actualizar</strong></button>
                      </div>
                  </form>
                     </div>
                      
                  </td>
                </tr>
                <?php } ?>
              </table>
          </td>
        </tr>
      </table>
  </div>
 <!-- Le javascript ../../js/jquery.js
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../js/jquery.js"></script>
    <script src="../../js/bootstrap-transition.js"></script>
    <script src="../../js/bootstrap-alert.js"></script>
    <script src="../../js/bootstrap-modal.js"></script>
    <script src="../../js/bootstrap-dropdown.js"></script>
    <script src="../../js/bootstrap-scrollspy.js"></script>
    <script src="../../js/bootstrap-tab.js"></script>
    <script src="../../js/bootstrap-tooltip.js"></script>
    <script src="../../js/bootstrap-popover.js"></script>
    <script src="../../js/bootstrap-button.js"></script>
    <script src="../../js/bootstrap-collapse.js"></script>
    <script src="../../js/bootstrap-carousel.js"></script>
    <script src="../../js/bootstrap-typeahead.js"></script>

  </body>
</html>

