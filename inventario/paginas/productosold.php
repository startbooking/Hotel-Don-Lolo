<?php 
	session_start();
	include_once "../../Conn/Conn.php";
	include_once "../../class/class_prod.php";
	include_once "../../Conn/funciones.php";
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Catalogo de Producto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="../../css/bootstrap2.css" rel="stylesheet">

    <link href="../../css/bootstrap-responsive.css" rel="stylesheet">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../../ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../../ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../../ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../../ico/apple-touch-icon-57-precomposed.png">
	<link rel="shortcut icon" href="../../ico/favicon.png">
  </head>
  <body>
    <div align="center">
    	<table width="90%">
          <tr>
            <td>
            	<table class="table table-bordered">
                  <tr class="info">
                    <td>
                    	<div class="row-fluid">
                            <div class="span6">
                            	<h2 class="text-info">
                                    <img src="../../img/productos.jpg" width="80" height="80">
                                    Catalogo de Productos
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
                                	<strong><i class="icon-plus"></i> Ingresar Nuevo Productos</strong>
                                </a>
                                
                        		<div id="nuevo" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	                                <form name="form2" method="post" action="">
                                    <div class="modal-header">
                    	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                	                    <h3 id="myModalLabel">Registrar Nuevo Profesor</h3>
                                    </div>
                                    <div class="modal-body">
                						<div class="row-fluid">
                                        	<div class="span6">
                                            	<strong>Documento</strong><br>
                                                <input type="text" name="doc" autocomplete="off" required value=""><br>
                                                <strong>Nombre del Profesor</strong><br>
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
					if(!empty($_POST['cod_prod']) and !empty($_POST['nom_prod'])){
						$prd=limpiar($_POST['nom_prod']);		$cod=limpiar($_POST['cod_prod']);
						$cfa=limpiar($_POST['cfa_prod']);		$cgr=limpiar($_POST['cgr_prod']);
						$csg=limpiar($_POST['csg_prod']);		$uco=limpiar($_POST['uco_prod']);
						$ual=limpiar($_POST['ual_prod']);		$upr=limpiar($_POST['upr_prod']);
						$ubc=limpiar($_POST['ubc_prod']);       $por=limpiar($_POST['por_prod']);	    
						if(empty($_POST['id'])){
							$oProductos=new Proceso_Productos('', $prd, $cod, $cfa, $cgr, $csg, $uco, $ual, $upr, $uni, $por);
							$oProductos->guardar_prd();
							echo mensajes('El Producto "'.$nom.'" Ha sido Guardado con Exito','verde');
						}else{
							$id=limpiar($_POST['id']);
							$oProductos=new Proceso_Productos($id,$prd, $cod, $cfa, $cgr, $csg, $uco, $ual, $upr, $uni, $por);
							$oProductos->actualizar_prd();
							echo mensajes('El Producto "'.$nom.'" Ha sido Actualizado con Exito','verde');
						}
					}
				?>
            	<table class="table table-bordered table table-hover">
                  <tr class="info">
                    <td><strong class="text-info">Codigo</strong></td>
                    <td><strong class="text-info">Producto</strong></td>
                    <td><strong class="text-info">Familia</strong></td>
                    <td><strong class="text-info">Grupo</strong></td>
                    <td><strong class="text-info">SubGrupo</strong></td>
                    <td><strong class="text-info">Unidad</strong></td>
                    <td>&nbsp;</td>
                  </tr>
                  <?php
				    if(!empty($_POST['buscar'])){
						$buscar=limpiar($_POST['buscar']);
                        $sql="SELECT * FROM productos WHERE nom_prod LIKE '$buscar' order by cod_prod" ;
                    }else{
                        $sql="SELECT * FROM productos order by cod_prod" ;
                    }
                    
                    $res = $conexion->query($sql)  ;
                    
                    if ($res->num_rows = 0) {
                        echo "<script>alert('Sin Datos')</script>";
                    }else{
                        while($row = $res->fetch_assoc()) {
                       	?>
                        <tr>
                          <td><?php echo $row['cod_prod']; ?></td>
                          <td><?php echo $row['nom_prod']; ?></td>
                          <td><?php echo $row['cfa_prod']; ?></td>
                          <td><?php echo $row['cgr_prod']; ?></td>
                          <td><?php echo $row['csg_prod']; ?></td>
                          <td><?php echo $row['uco_prod']; ?></td>
                          <td>
                                        	<center>
                                            	<a href="#a<?php echo $row['id']; ?>" title="Editar Producto" role="button" class="btn btn-mini" data-toggle="modal">
                                                	<i class="icon-edit"></i>
                                                </a>
                                            </center>
                                            <div id="a<?php echo $row['id']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <form name="form2" method="post" action="">
                                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h3 id="myModalLabel">Actualizar Profesor</h3>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row-fluid">
                                                        <div class="span6">
                                                            <strong>Documento</strong><br>
                                                            <input type="text" name="doc" autocomplete="off" readonly value="<?php echo $row['doc']; ?>"><br>
                                                            <strong>Nombre del Profesor</strong><br>
                                                            <input type="text" name="nom" autocomplete="off" required value="<?php echo $row['nom']; ?>"><br>
                                                            <strong>Apellidos del Profesor</strong><br>
                                                            <input type="text" name="ape" autocomplete="off" required value="<?php echo $row['ape']; ?>"><br>
                                                            <strong>Especialidades</strong><br>
                                                            <input type="text" name="especialidad" autocomplete="off" required value="<?php echo $row['especialidad'];?>"><br>
                                                            <strong>Correo</strong><br>
                                                            <input type="email" name="correo" autocomplete="off" required value="<?php echo $row['correo']; ?>"><br>
                                                            <strong>Tipo de Usuario</strong><br>
                                                            <select name="tipo">
                                                            	<option value="p" <?php if($row['tipo']=='p'){ echo 'selected'; } ?>>Profesor</option>
                                                                <option value="a" <?php if($row['tipo']=='a'){ echo 'selected'; } ?>>Administrador</option>
                                                            </select>
                                                        </div>
                                                        <div class="span6">
                                                            <strong>Direccion</strong><br>
                                                            <input type="text" name="dir" autocomplete="off" required value="<?php echo $row['dir']; ?>"><br>
                                                            <strong>Telefonos</strong><br>
                                                            <input type="text" name="tel" autocomplete="off" value="<?php echo $row['tel']; ?>"><br>
                                                            <strong>Celulares</strong><br>
                                                            <input type="text" name="cel" autocomplete="off" required value="<?php echo $row['cel']; ?>"><br>
                                                            <strong>Fecha de Nacimiento</strong><br>
                                                            <input type="date" name="fecha" autocomplete="off" required value="<?php echo $row['fecha']; ?>"><br>
                                                            <strong>Estado</strong><br>
                                                            <select name="estado">
                                                                <option value="s" <?php if($row['estado']=='s'){ echo 'selected'; } ?>>Activo</option>
                                                                <option value="n" <?php if($row['estado']=='n'){ echo 'selected'; } ?>>No Activo</option>
                                                            </select>
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
                    <?php }
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
