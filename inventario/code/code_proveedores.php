<?php
/*-----------------------
Autor: Obed Alvarado
http://www.obedalvarado.pw
Fecha: 12-06-2015
Version de PHP: 5.6.3
----------------------------*/

	# conectare la base de datos
	# error_reporting(0);
	include_once('../../Conn/Conn.php'); 
	include_once('../../Conn/seciones.php');
	include_once('../../Conn/funciones.php');

	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if($action == 'ajax'){
		include 'paginacion.php'; //incluir el archivo de paginación
		//las variables de paginación
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 15; //la cantidad de registros que desea mostrar
		$adjacents  = 4; //brecha entre páginas después de varios adyacentes
		$offset = ($page - 1) * $per_page;
		//Cuenta el número total de filas de la tabla*/

		$sql_rows = "SELECT count(*) AS numrows FROM proveedores";
		$sql_fact = "SELECT * from proveedores ORDER BY empresa ASC LIMIT $offset, $per_page ";

		
		$count_query  = mysqli_query($conn,$sql_rows);
		if($row= mysqli_fetch_array($count_query)){
			$numrows = $row['numrows'];
		}
		$total_pages = ceil($numrows/$per_page);
		$reload = 'proveedores.php';
		//consulta principal para recuperar los datos
		/* $query = mysqli_query($con,"SELECT * FROM countries  order by countryName LIMIT $offset,$per_page"); */
		$query = mysqli_query($conn,$sql_fact);

		if ($numrows>0){
			?>
			<table class="table table-bordered">
				<thead >
					<tr class="warning">
            <td>Proveedor</td>
            <td>Direccion</td>
            <td>Nit</td>
            <td>Telefono</td>
            <td>Email</td>
            <td>Estado</td>
            <td>Accion</td>
					</tr>
				</thead>
				<tbody>
					<?php
						while($row = mysqli_fetch_array($query)){
					?>
					 	<tr style='font-size:12px'>
              <td><?php echo $row['empresa']; ?></td>
              <td><?php echo $row['direccion']; ?></td>
              <td align="right"><?php echo $row['nit'].'-'.$row['digito']; ?></td>
              <td align="right"><?php echo $row['telefono']; ?></td>
              <td align="right"><?php echo $row['correo']; ?></td>
              <td><?php echo estado_n($row['activo']); ?></td>
					   <td align='center'>
							<button type="button" class="btn btn-info btn-xs" 
								data-toggle="modal" 
								data-target="#dataUpdateProveedor" 
								data-id        ="<?php echo $row['id_prov']?>" 
								data-empresa   ="<?php echo $row['empresa']?>" 
								data-nombre    ="<?php echo $row['nombre']?>" 
								data-nombre2   ="<?php echo $row['nombre2']?>" 
								data-apellido  ="<?php echo $row['apellido']?>" 
								data-apellido2 ="<?php echo $row['apellido2']?>" 
								data-direccion ="<?php echo $row['direccion']?>" 
								data-nit       ="<?php echo $row['nit']?>" 
								data-digito    ="<?php echo $row['digito']?>" 
								data-tipo_doc  ="<?php echo $row['tipo_doc']?>" 
								data-telefono  ="<?php echo $row['telefono']?>" 
								data-telefono2 ="<?php echo $row['telefono2']?>" 
								data-celular   ="<?php echo $row['celular']?>" 
								data-fax       ="<?php echo $row['fax']?>" 
								data-correo    ="<?php echo $row['correo']?>" 
								data-web       ="<?php echo $row['web']?>" 
								data-pais      ="<?php echo $row['pais']?>" 
								data-ciudad    ="<?php echo $row['ciudad']?>" 
								data-tipo_emp  ="<?php echo $row['tipo_emp']?>" 
								data-ciiu  ="<?php echo $row['cod_ciiu']?>" 
								title="Modifica Datos del Proveedor" >
								<i class='glyphicon glyphicon-edit'></i>
							</button>
							<button type="button" class="btn btn-danger btn-xs" 
								data-toggle="modal" 
								data-target="#dataDeleteProveedor" 
								title="Eliminar Proveedor" 
								data-id      ="<?php echo $row['id_prov']?>"  
								data-codigo  ="<?php echo $row['cod_prov']?>"
								data-empresa ="<?php echo $row['empresa']?>"  >
								<i class='glyphicon glyphicon-trash '></i> 
							</button>
					   </td>
					 </tr>
					 <?php
					}
					?>
				</tbody>
			</table>
			<div class="table-pagination pull-right">
				<?php echo paginate($reload, $page, $total_pages, $adjacents,'loadproveedor');?>
			</div>
		<?php
		} else {
			?>
			<div class="alert alert-warning alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4>Atencion !!!</h4> Sin Informacion de Proveedores
      </div>
			<?php
		}
	}
?>