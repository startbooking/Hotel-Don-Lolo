<?php 
	session_start();
	include_once "../../Conn/Conn.php";
	include_once "../../Conn/funciones.php";

?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <head>
    <link href="../../css/bootstrap2.css" rel="stylesheet">
    <link href="../../css/bootstrap-responsive.css" rel="stylesheet">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../../ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../../ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../../ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../../ico/apple-touch-icon-57-precomposed.png">
  </head>
  <body>
  <br>
    <div align="center">
    	<table width="90%" align="center">
          <tr>
            <td>
            	<table class="table table-bordered">
                  <tr class="info">
                    <td>
                    	<div class="row-fluid">
                        <div class="span6">
                          <h2 class="text-info">
                            <img src="../../img/proveedor.jpg" width="80" height="80">
                            Catalogo de Proveedores
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
                            <strong><i class="icon-plus"></i> Ingresar Nuevo Proveedor</strong>
                          </a>
                     		  <div id="nuevo" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <form name="form2" method="post" action="">
                              <div class="modal-header">
               	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
           	                    <h3 id="myModalLabel">Registrar Nuevo Proveedor</h3>
                              </div>
                              <div class="modal-body">
           						          <div class="row-fluid">
                                 	<div class="span6">
                                   	<strong>Documento</strong><br>
                                    <input type="text" name="doc" autocomplete="off" required value=""><br>                                   <strong>Nombre del Profesor</strong><br>
                                    <input type="text" name="nom" autocomplete="off" required value=""><br>
                                    <strong>Apellidos del Profesor</strong><br>
                                    <input type="text" name="ape" autocomplete="off" required value=""><br>
                                    <strong>Especialidades</strong><br>
                                    <input type="text" name="especialidad" autocomplete="off" required value=""><br>
                                    <strong>Correo</strong><br>
                                    <input type="email" name="correo" autocomplete="off" required value=""><br>
                                    <strong>Tipo de Usuario</strong><br>
                                    <select name="tipo">
                                      <option value="p">Profesor</option>
                                      <option value="a">Administrador</option>
                                    </select>
                                  </div>
                                  <div class="span6">
                                    <strong>Direccion</strong><br>
                                    <input type="text" name="dir" autocomplete="off" required value=""><br>
                                    <strong>Telefonos</strong><br>
                                    <input type="text" name="tel" autocomplete="off" value=""><br>
                                    <strong>Celulares</strong><br>
                                    <input type="text" name="cel" autocomplete="off" required value=""><br>
                                    <strong>Fecha de Nacimiento</strong><br>
                                    <input type="date" name="fecha" autocomplete="off" required value=""><br>
												            <strong>Estado</strong><br>
                                    <select name="estado">
                                     	<option value="s">Activo</option>
                                      <option value="n">No Activo</option>
                                    </select>
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
        
        <table width="90%">
          <tr>
            <td>
            	 <?php
      					if(!empty($_POST['COD_PROD']) and !empty($_POST['NOM_PROD'])){
      						$prd=limpiar($_POST['NOM_PROD']);		$cod=limpiar($_POST['COD_PROD']);
      						$cfa=limpiar($_POST['CFA_PROD']);		$cgr=limpiar($_POST['CGR_PROD']);
      						$csg=limpiar($_POST['CSG_PROD']);		$uco=limpiar($_POST['UCO_PROD']);
      						$ual=limpiar($_POST['UAL_PROD']);		$upr=limpiar($_POST['UPR_PROD']);
      						$ubc=limpiar($_POST['UBC_PROD']);   $por=limpiar($_POST['POR_PROD']);	    
      						if(empty($_POST['ID_PROD'])){
      							$oProductos=new Proceso_Productos('', $prd, $cod, $cfa, $cgr, $csg, $uco, $ual, $upr, $uni, $por);
      							$oProductos->guardar_prd();
      							echo mensajes('El Producto "'.$nom.'" Ha sido Guardado con Exito','verde');
      						}else{
      							$id=limpiar($_POST['ID_PROD']);
      							$oProductos=new Proceso_Productos($id,$prd, $cod, $cfa, $cgr, $csg, $uco, $ual, $upr, $uni, $por);
      							$oProductos->actualizar_prd();
      							echo mensajes('El Producto "'.$nom.'" Ha sido Actualizado con Exito','verde');
      						}
      					}
      				?>
            	<table class="table table-bordered table table-hover">
                  <tr class="info">
                    <td><strong class="text-info">Nombre</strong></td>
                    <td><strong class="text-info">Direccion</strong></td>
                    <td><strong class="text-info">Nit</strong></td>
                    <td><strong class="text-info">DV</strong></td>
                    <td><strong class="text-info">Telefonos</strong></td>
                    <td><strong class="text-info">Estado</strong></td>
                    <td><strong class="text-info">Accion</strong></td>
                  </tr>
                  <?php
				            if(!empty($_POST['buscar'])){
						            $buscar=limpiar($_POST['buscar']);
                        $sql="SELECT
                        proveedores.empresa,
                        proveedores.direccion,
                        proveedores.nit,
                        proveedores.digito,
                        proveedores.telefono,
                        proveedores.id_prov,
                        proveedores.activo
                        FROM
                        proveedores
                        where empresa LIKE '%$buscar%' order by empresa" ;
                    }else{
                        $sql="SELECT
                        proveedores.empresa,
                        proveedores.direccion,
                        proveedores.nit,
                        proveedores.digito,
                        proveedores.telefono,
                        proveedores.id_prov,
                        proveedores.activo
                        FROM
                        proveedores
                        ORDER BY
                        proveedores.empresa ASC" ;
                    }
                    
                    $result = mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_assoc($result)) {
                  	?>
                        <tr>
                          <td><?php echo $row['empresa']; ?></td>
                          <td><?php echo $row['direccion']; ?></td>
                          <td><?php echo $row['nit']; ?></td>
                          <td><?php echo $row['digito']; ?></td>
                          <td><?php echo $row['telefono']; ?></td>
                          <td><center>
                            <?php echo estado_n($row['activo']); ?></center></td>
                          <td>
                            <center>
                              <a href="#a<?php echo $row['id_prov']; ?>" title="Editar Producto" role="button" class="btn btn-mini" data-toggle="modal">
                                <i class="icon-edit"></i>
                              </a>
                            </center>
                          <!-- ACA va el div-->
                            <div id="a<?php echo $row['id_prov']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                              <form name="form2" method="post" action="">
                                  <input type="hidden" name="id" value="<?php echo $row['id_prov']; ?>">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h3 id="myModalLabel">Actualizar Proveedor</h3>
                                  </div>
                                  <div class="modal-body">
                                    <div class="row-fluid">
                                      <div class="span6">
                                        <strong>Nombre</strong><br>
                                        <input type="text" name="nom" autocomplete="off" required value="<?php echo $row['empresa']; ?>"><br>
                                        <strong>Nit</strong><br>
                                        <input type="text" name="doc" autocomplete="off" readonly value="<?php echo $row['nit']; ?>"><br>
                                        <strong>DV</strong><br>
                                        <input type="text" name="doc" autocomplete="off" readonly value="<?php echo $row['digito']; ?>"><br>
                                        <strong>Direccion</strong><br>
                                        <input type="text" name="ape" autocomplete="off" required value="<?php echo $row['direccion']; ?>"><br>
                                        <strong>Telefono</strong><br>
                                        <input type="text" name="especialidad" autocomplete="off" required value="<?php echo $row['telefono'];?>"><br>
                                        <strong>Correo</strong><br>
                                        <input type="email" name="correo" autocomplete="off" required value="<?php echo $row['activo']; ?>"><br>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> <strong>Cerrar</strong></button>
                                    <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> <strong>Actualizar</strong></button>
                                  </div>
                              </form>
                            </div>

                          </td>
                        </tr>
                    <?php 
                    } ?>
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
