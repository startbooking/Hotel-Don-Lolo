<?php 
  include_once('../../Conn/Conn.php');
  $alma = "SELECT * FROM tipo_movimiento_inv where tipo = 1 and ajuste = 0 order by descripcion";
  $resp = mysqli_query($conn,$alma);
  $numrow = mysqli_num_rows($resp);
  if($numrow==0){
		?>
		<div class="alert alert_warning"><h3>Sin Tipode de Movimiento Creados</h3></div>
		<?php 
  }else{
  	?>
		 	<select name="tipo_movi" id="tipo_movi" class="form-control">
		 		<option value="">Seleccione el Tipo de Entrada</option>
		 		<?php 
			 		$sql_amb = "SELECT * FROM tipo_movimiento_inv where tipo = 1 and ajuste = 0 and traslado = 0 order by descripcion";
			 		$sql_res = mysqli_query($conn,$sql_amb);
			 		while($row=mysqli_fetch_assoc($sql_res)){
		 		?>
			 		<option name="<?=$row['codigo']?>" value="<?=$row['codigo']?>"><?=$row['descripcion']?></option>
		 		<?php 
					}
		 		?>
		 	</select>
		<?php 
  }
?>
