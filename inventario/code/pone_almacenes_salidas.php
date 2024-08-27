<?php 
  include_once('../../Conn/Conn.php');
  $alma = "SELECT * FROM bodegas order by nom_alma";
  $resp = mysqli_query($conn,$alma);
  $numrow = mysqli_num_rows($resp);
  if($numrow==0){
		?>
		<div class="alert alert_warning"><h3>Sin Almacenes/Bodegas Creados</h3></div>
		<?php 
  }else{
  	?>
			 	<select name="almacen" id="almacen" class="form-control">
			 		<option value="">Seleccione el Almacen</option>
			 		<?php 
				 		while($row=mysqli_fetch_assoc($resp)){
			 		?>
				 		<option name="<?=$row['cod_alma']?>" value="<?=$row['cod_alma']?>"><?=$row['nom_alma']?></option>
			 		<?php 
						}
			 		?>
			 	</select>
		<?php 
  }
?>
