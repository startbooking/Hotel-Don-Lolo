<?php 
  include_once('../../Conn/Conn.php');
  $alma = "SELECT * FROM proveedores where activo = 1 order by empresa";
  $resp = mysqli_query($conn,$alma);
  $numrow = mysqli_num_rows($resp);
  if($numrow==0){
		?>
		<div class="alert alert_warning"><h3>Sin Proveedores Creados</h3></div>
		<?php 
  }else{
  	?>
		 	<select name="proveedor" id="proveedor" class="form-control">
		 		<option value="">Seleccione el Proveedor</option>
		 		<?php 
			 		$sql_amb = "SELECT * FROM proveedores where activo = 1 order by empresa";
			 		$sql_res = mysqli_query($conn,$sql_amb);
			 		while($row=mysqli_fetch_assoc($sql_res)){
		 		?>
			 		<option name="<?=$row['id_prov']?>" value="<?=$row['id_prov']?>"><?=$row['empresa']?></option>
		 		<?php 
					}
		 		?>
		 	</select>
		<?php 
  }
?>
