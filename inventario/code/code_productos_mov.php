<?php

	include_once('../../Conn/Conn.php');
	
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
    $q = mysqli_real_escape_string($conn,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		$aColumns = array('cod_prod', 'nom_prod');//Columnas de busqueda
		$sTable = "productos_inve, unidades";
		$sWhere = "WHERE(productos_inve.uco_prod = unidades.cod_unid AND nom_prod LIKE '%".$q."%' ";
		$sWhere .= ")";
		include_once('paginacion_productos_mov.php'); //include pagination file
		//pagination variables
		$page      = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page  = 5; //how much records you want to show
		$adjacents = 4; //gap between pages after number of adjacents
		$offset    = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query = mysqli_query($conn, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row         = mysqli_fetch_array($count_query);
		$numrows     = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload      = 'entradas.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($conn, $sql);
		//loop through fetched data
		if ($numrows>0){
			
			?>
			<div class="table-responsive">
			  <table class="table table-bordered">
					<tr class="warning">
						<th>Código</th>
						<th>Producto</th>
						<th>Unidad de Compra</th>
						<th><span class="pull-right">Cant.</span></th>
						<th><span class="pull-right">Precio</span></th>
						<th class='text-center' style="width: 36px;">Agregar</th>
					</tr>
					<?php
					while ($row=mysqli_fetch_array($query)){
						$idprod  =$row['id_prod'];
						$codigo  =$row['cod_prod'];
						$nombre  =$row['nom_prod'];
						$unidad  =$row['des_unid'];
						$vcompra =$row["ppo_prod"];
						?>

						<tr>
							<td style="width:30px">
								<?php //echo $codigo; ?>
								<input type="text" name="" id="codigo_<?=$idprod?>" value="<?php echo $codigo;?>" readonly>
							</td>
							<td>
								<input type="text" style="width: 100%" id="producto_<?=$idprod?>" value="<?php echo $nombre;?>" readonly>
							</td>
							<td><?php echo $unidad; ?></td>
							<td class='col-xs-1'>
								<div class="pull-right">
									<input type="text" style="text-align:right" id="cantidad_<?php echo $idprod; ?>"  value="1" >
								</div>
							</td>
							<td class='col-xs-2'>
								<div class="pull-right">
									<input type="text" style="text-align:right" id="vcompra_<?php echo $idprod; ?>"  value="<?php echo $vcompra;?>" >
								</div>
							</td>
								<td class='text-center'>
									<button type="btn btn-info" onclick="agregar('<?php echo $idprod ?>')"><i class="glyphicon glyphicon-plus"></i> </button>
							</td>
						</tr>
						<?php
					}
					?>
					<tr>
						<td colspan=5>
							<span class="pull-right">
								<?php echo paginate($reload, $page, $total_pages, $adjacents);?>
							</span>
						</td>
					</tr>
			  </table>
			</div>
			<?php
		}
	}
?>