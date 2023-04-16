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

	$alm    = $_POST['bodega'];
	$num    = $_POST['numero'];
	$tip    = $_POST['tipo'];
	$tipmov = $_POST['tipomov'];

	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if($action == 'ajax'){
		# include 'paginacion_kardex.php'; //incluir el archivo de paginación
		//las variables de paginación
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page  = 10; //la cantidad de registros que desea mostrar
		$adjacents = 4; //brecha entre páginas después de varios adyacentes
		$offset    = ($page - 1) * $per_page;
		//Cuenta el número total de filas de la tabla*/
		$sql_rows = "SELECT count(*) AS numrows FROM movimientos_inventario where bodega = '$alm' and numero = '$num' and tipo = '$tip' ";
		
		$sql_fact = "SELECT m.numero, p.nom_prod, m.proveedor, m.cantidad, m.valor_unit, m.valor_total, m.impuesto, u.des_unid FROM movimientos_inventario AS m, productos_inve AS p, unidades u WHERE m.producto = p.cod_prod AND m.numero = '$num' AND m.bodega = '$alm' and m.tipo = '$tip' AND m.tipo_movi = '$tipmov' AND p.uco_prod = u.cod_unid order by nom_prod" ;
		
		$count_query   = mysqli_query($conn,$sql_rows);
		if($row= mysqli_fetch_array($count_query)){
			$numrows = $row['numrows'];
		}
		$total_pages = ceil($numrows/$per_page);
		$reload = 'entradas.php';
		//consulta principal para recuperar los datos
		/* $query = mysqli_query($con,"SELECT * FROM countries  order by countryName LIMIT $offset,$per_page"); */
		$query = mysqli_query($conn,$sql_fact);

		if ($numrows>0){
			?>
			<table class="table table-bordered table-responsive">
				<thead >
					<tr class="warning">
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Unidad</th>
            <th>Valor Unit.</th>
            <th>Impuesto</th>
            <th>Valor Tot.</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$saldo = 0 ;
					$total = 0 ;
					while($row = mysqli_fetch_array($query)){
						$total = $total + $row["valor_total"];
					?>
					 	<tr style='font-size:12px'>
					  	<td><?php echo $row["nom_prod"];?></td>
					   	<td align='right'><?php echo number_format($row["cantidad"],2);?></td>
					   	<td align='right'><?php echo $row["des_unid"];?></td>
					   	<td align='right'><?php echo number_format($row["valor_unit"],2);?></td>
					   	</td>
					   	<td align='right'><?php echo number_format($row["impuesto"]);?></td>
					   	<td align='right'><?php echo number_format($row["valor_total"],2);?></td>
					 	</tr>
					 	<?php
					};
					?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td style="font-size:18px">Total Movimiento </td>
						<td style="font-size:18px" align='right'><?=number_format($total,2)?></td>
					</tr>
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
