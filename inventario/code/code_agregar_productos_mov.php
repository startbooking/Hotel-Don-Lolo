<?php
	/*-------------------------
	Autor: Obed Alvarado
	Web: obedalvarado.pw
	Mail: info@obedalvarado.pw
	---------------------------*/
	// include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	session_start();
	$session_id = session_id();
	if (isset($_POST['id'])){
		$id=$_POST['id'];
	}
	if (isset($_POST['cantidad'])){
		$cantidad=$_POST['cantidad'];
	}
	if (isset($_POST['vcompra'])){
		$precio=$_POST['vcompra'];
	}

	if (isset($_POST['producto'])){
		$producto=strtoupper($_POST['producto']);
	}

	if (isset($_POST['codigo'])){
		$codigo=strtoupper($_POST['codigo']);
	}

	/* Connect To Database*/
  include_once "../../Conn/Conn.php";
	
	if (!empty($id) and !empty($cantidad) and !empty($precio)){
		$tmp_sql = "select * from tmp_movi where id_prod = '$id' and session_id = '$session_id'";
		$tmp_res = mysqli_query($conn,$tmp_sql);
		$tmp_row = mysqli_num_rows($tmp_res);
		if($tmp_row == 1){
			
			$insert_tmp=mysqli_query($conn, "UPDATE tmp_movi SET cantidad = cantidad + $cantidad, valor = valor + $precio WHERE id_prod='$id' and session_id = '$session_id'");


		}else{
			$insert_tmp=mysqli_query($conn, "INSERT INTO tmp_movi (id_prod, producto, valor, cantidad,session_id,codigo) VALUES ('$id','$producto','$precio','$cantidad','$session_id','$codigo')");
		}

	}
	if (isset($_GET['id'])){ //codigo elimina un elemento del array
		$id_tmp=intval($_GET['id']);	
		$delete=mysqli_query($conn, "DELETE FROM tmp_movi WHERE id_prod='$id_tmp' and session_id = '$session_id'");
	}

?>
	<div class="row-fluid">
		
		<table class="table table-bordered" id="TablaEntradas">
			<tr class="warning">
				<th class='text-center'>Codigo.</th>
				<th class='text-center'>Descripcion</th>
				<th class='text-center'>Cant.</th>
				<th class='text-right'>Valor Unit.</th>
				<th class='text-right'>Valor Total</th>
				<th class='text-right'>Accion</th>
			</tr>
			<?php
				$sumador_total=0;
				$total_compra = 0;
				$sql=mysqli_query($conn, "select * from productos_inve, tmp_movi where productos_inve.id_prod=tmp_movi.id_prod and tmp_movi.session_id='".$session_id."'");
				while ($row=mysqli_fetch_array($sql)){
					$idprod          =$row['id_prod'];
					$nombre_producto =$row['producto'];
					$cantidad        =$row['cantidad'];
					$precio_compra   =$row['valor'];
					$total_compra    += $precio_compra ;
					$valor_unitario  = $precio_compra / $cantidad ;
					// $precio_total    =$precio_venta_r*$cantidad;
					//$sumador_total   +=$precio_total_r;//Sumador
				
					?>
					<tbody>
						<tr>
							<td class='text-center'><?php echo $row['codigo'];?></td>
							<td><?php echo $nombre_producto;?></td>
							<td class='text-right'><?php echo number_format($cantidad,2);?></td>
							<td class='text-right'><?php echo number_format($valor_unitario,2);?></td>
							<td class='text-right'><?php echo number_format($precio_compra,2);?></td>
							<td class='text-center'>
								<button type="btn btn-warning btn-xs" onclick="eliminar('<?php echo $idprod ?>')"><i class="glyphicon glyphicon-trash"></i> </button>
								<!--							
								<a href="#" onclick="eliminar('<?php echo $idprod ?>')"><i class="glyphicon glyphicon-trash"></i></a>
								-->						
							</td>
						</tr>		
					</tbody>
					<?php
				}
				$subtotal=number_format($sumador_total,2,'.','');
				$total_factura=$subtotal;

			?>
		</table>
		<div class="row-fluid">
			<div class="col-lg-6 col-lg-offset-6 ">
				<form action="" class="form-horizontal">
					<!--<div class="form-group">
						<label for="" class="col-lg-6 control-label">SUBTOTAL $ </label>
						<div class="col-lg-6">
							<input type="text" style="font-weight: 600;font-size:1.5em" class="form-control text-right" value="<?php echo number_format($subtotal,2);?>" readonly>	
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-lg-6 control-label">IVA (<?php echo $iva?>)% $ </label>
						<div class="col-lg-6">
							<input type="text" style="font-weight: 600;font-size:1.5em;" class="form-control text-right" value="<?php echo number_format($total_iva,2);?>" readonly>	
						</div>
					</div>-->
					<div class="form-group">
						<label for="" class="col-lg-6 control-label">TOTAL MOVIMIENTO $ </label>
						<div class="col-lg-6">
							<input type="text" class="form-control text-right" value="<?php echo number_format($total_compra,2);?>" readonly>	
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
