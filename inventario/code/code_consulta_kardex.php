<?php
/*-----------------------
Autor: Obed Alvarado
http://www.obedalvarado.pw
Fecha: 12-06-2015
Version de PHP: 5.6.3
----------------------------*/

	# conectare la base de datos
	# error_reporting(0);
	session_start();
	include_once('../../Conn/Conn.php');
	include_once('../../Conn/seciones.php');
	include_once('../../Conn/funciones.php');

	$bod = $_GET['bodega'];
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if($action == 'ajax'){
		# include 'paginacion_kardex.php'; //incluir el archivo de paginación
		//las variables de paginación
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; //la cantidad de registros que desea mostrar
		$adjacents  = 4; //brecha entre páginas después de varios adyacentes
		$offset = ($page - 1) * $per_page;
		//Cuenta el número total de filas de la tabla*/

		$sql_rows = "SELECT count(*) AS numrows FROM movimientos_inventario where bodega = '$bod' ";
		$sql_fact = "SELECT productos_inve.nom_prod, producto,sum(if(tipo=1,cantidad,0)) as entradas, sum(if(tipo=2,cantidad,0)) as salidas, (sum(if(tipo=1,cantidad,0)) - sum(if(tipo=2,cantidad,0))) as saldo, sum(if(tipo=1,valor_total,0))/(sum(if(tipo=1,cantidad,0)) - sum(if(tipo=2,cantidad,0))) as promedio, (sum(if(tipo=1,valor_total,0))/(sum(if(tipo=1,cantidad,0)) - sum(if(tipo=2,cantidad,0)))) * ((sum(if(tipo=1,cantidad,0)) - sum(if(tipo=2,cantidad,0)))) as vlr_total, bodega FROM movimientos_inventario, productos_inve where bodega = '$bod' and movimientos_inventario.producto = productos_inve.cod_prod  group by bodega, producto order by nom_prod ASC" ;

		
		$count_query   = mysqli_query($conn,$sql_rows);
		if($row= mysqli_fetch_array($count_query)){
			$numrows = $row['numrows'];
		}
		$total_pages = ceil($numrows/$per_page);
		$reload = 'kardex_almacen.php';
		//consulta principal para recuperar los datos
		/* $query = mysqli_query($con,"SELECT * FROM countries  order by countryName LIMIT $offset,$per_page"); */
		$query = mysqli_query($conn,$sql_fact);

		if ($numrows>0){
			?>
			<table class="table table-bordered table-responsive" style="margin-bottom: 50px">
				<thead >
					<tr class="warning">
	              <th>Codigo</th>
	              <th>Producto</th>
	              <th>Entradas</th>
	              <th>Salidas</th>
	              <th>Saldo</th>
	              <th>Vlr Promedio </th>
	              <th>Vlr Total</th>
	              <th>Accion</th>
					</tr>
				</thead>
				<tbody>
					<?php
					while($row = mysqli_fetch_array($query)){
					?>
					 <tr style='font-size:12px'>
					   <td><?php echo $row["producto"];?></td>
					   <td><?php echo $row["nom_prod"];?></td>
					   <td align='right'><?php echo number_format($row["entradas"],0);?></td>
					   <td align='right'><?php echo number_format($row["salidas"],0);?></td>
					   <td align='right'><?php echo number_format($row["saldo"],0);?></td>
					   <td align='right'><?php echo number_format($row["promedio"],2);?></td>
					   <td align='right'><?php echo number_format($row["vlr_total"],2);?></td>
					   <td align='center'>
							<button type="button" class="btn btn-success btn-xs" 
								data-toggle="modal" 
								data-target="#dataConsultaKardex" 
								data-bodega="<?php echo $row['bodega']?>" 
								data-nombre="<?php echo $row['nom_prod']?>" 
								data-producto="<?php echo $row['producto']?>">
								<title>Ver Detalles de Movimiento</title>
								<i class='fa fa-server'></i> 
							</button>
					   </td>
					 </tr>
					 <?php
					}
					?>
				</tbody>
			</table>
			<div class="table-pagination pull-right">
				<?php # echo paginate($reload, $page, $total_pages, $adjacents);?>
			</div>
		<?php
		} else {
			?>
			<div class="alert alert-warning alert-dismissable">
        <button type="button" class="close ion ion-power" data-dismiss="alert" aria-hidden="true"></button>
        <h4>Atencion !!!</h4> Sin Informacion de Productos
      </div>
			<?php
		}
	}
?>
