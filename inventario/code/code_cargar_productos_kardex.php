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

	$bod = $_POST['bodega'];
	$pro = $_POST['producto'];

	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if($action == 'ajax'){
		# include 'paginacion_kardex.php'; //incluir el archivo de paginación
		//las variables de paginación
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; //la cantidad de registros que desea mostrar
		$adjacents  = 4; //brecha entre páginas después de varios adyacentes
		$offset = ($page - 1) * $per_page;
		//Cuenta el número total de filas de la tabla*/
		$sql_rows = "SELECT count(*) AS numrows FROM movimientos_inventario where bodega = '$bod'";
		$sql_fact = "SELECT movimientos_inventario.numero, movimientos_inventario.fecha_movimiento, if(movimientos_inventario.tipo=1,movimientos_inventario.cantidad,0) as entradas, if(movimientos_inventario.tipo=2,movimientos_inventario.cantidad,0) as salidas, tipo_movimiento_inv.descripcion, movimientos_inventario.valor_unit, movimientos_inventario.valor_total, unidades.des_unid FROM movimientos_inventario, tipo_movimiento_inv, unidades WHERE movimientos_inventario.tipo_movi = tipo_movimiento_inv.codigo AND movimientos_inventario.unidad_alm = unidades.cod_unid and bodega = '$bod' and producto = '$pro' ORDER BY movimientos_inventario.fecha_movimiento, movimientos_inventario.tipo, movimientos_inventario.producto ASC" ;

		
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
			<table class="table table-bordered table-responsive">
				<thead >
					<tr class="warning">
              <th>Movimiento</th>
              <th>Fecha</th>
              <th>Numero</th>
              <th>Entradas</th>
              <th>Salidas</th>
              <th>Saldo</th>
              <th>Vlr Unit. </th>
              <th>Vlr Total</th>
              <th>Unidad</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$saldo = 0 ;
					while($row = mysqli_fetch_array($query)){
						$saldo  = $saldo + ($row["entradas"] - $row["salidas"]);
					?>
					 	<tr style='font-size:12px'>
					  	<td><?php echo $row["descripcion"];?></td>
					   	<td align='center'><?php echo $row["fecha_movimiento"];?></td>
					   	<td align='right'><?php echo $row["numero"];?></td>
					   	<td align='right'><?php if($row["entradas"]==0){echo "";}else{echo number_format($row["entradas"],0);};?>
					   	</td>
					   	<td align='right'><?php if($row["salidas"]==0){echo "";}else{echo number_format($row["salidas"],0);};?></td>
					   	<td align='right'><?php echo number_format($saldo,0);?></td>
					   	<td align='right'><?php echo number_format($row["valor_unit"],2);?></td>
					   	<td align='right'><?php echo number_format($row["valor_total"],2);?></td>
					   	<td align='right'><?php echo $row["des_unid"];?></td>
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
        <h4>Atencion !!!</h4> Sin Informacion de Movimientos
      </div>
			<?php
		}
	}
?>
