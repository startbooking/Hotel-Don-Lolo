<?php 
  include_once('../../Conn/Conn.php');
  $alma = "SELECT * FROM productos_inve order by nom_prod";
  $resp = mysqli_query($conn,$alma);
  $numrow = mysqli_num_rows($resp);
  if($numrow==0){
		?>
		<div class="alert alert_warning"><h3>Sin Productos Creados</h3></div>
		<?php 
  }else{ 
  	?>
	 	<select name="producto" id="producto" class="form-control" onchange='busca_producto()'>
	 		<option value="">Seleccione el Producto</option>
	 		<?php 
		 		$sql_amb = "SELECT * FROM productos_inve order by nom_prod";
		 		$sql_res = mysqli_query($conn,$sql_amb);
		 		while($row=mysqli_fetch_assoc($sql_res)){
	 		?>
		 		<option name="<?=$row['id_prod']?>" value="<?=$row['id_prod']?>"><?=$row['nom_prod']?></option>
	 		<?php 
				}
	 		?>
	 	</select>
		<?php 
  }
?>
