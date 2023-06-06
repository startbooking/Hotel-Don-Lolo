<?php 
  include_once('../../Conn/Conn.php');
  $alma = "SELECT * FROM tipo_movimiento_inv where tipo = 2 and ajuste = 0 order by descripcion";
  $resp = mysqli_query($conn,$alma); 
  $numrow = mysqli_num_rows($resp);
  if($numrow==0){
		?>
		<div class="alert alert_warning"><h3>Sin Tipode de Movimiento Creados</h3></div>
		<?php 
  }else{
  	?>
		 	<select name="tipo_movi" id="tipo_movi" class="form-control">
		 		<option value="" id="tipo_movi">Seleccione el Tipo de Salida</option>
		 		<?php 
			 		while($row=mysqli_fetch_assoc($resp)){
		 		?>
			 		<option name="<?=$row['codigo']?>" value="<?=$row['codigo']?>"><?=$row['descripcion']?></option>
		 		<?php 
					}
		 		?>
		 	</select>
		<?php 
  }
?>
