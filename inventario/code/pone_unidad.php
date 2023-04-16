<?php 
  include_once('../../Conn/Conn.php');
  $alma = "SELECT * FROM unidades order by des_unid";
  $resp = mysqli_query($conn,$alma);
  $numrow = mysqli_num_rows($resp);
  if($numrow==0){
		?>
		<div class="alert alert_warning"><h3>Sin Unidades de Medida Creados</h3></div>
		<?php 
  }else{
  	?>
		 	<select name="unidad" id="unidad" class="form-control">
		 		<option value=" ">Seleccione La Unidad de Compra</option>
		 		<?php 
			 		$sql_res = mysqli_query($conn,$alma);
			 		while($row=mysqli_fetch_assoc($sql_res)){
				 		?>
				 		<option id="unidades" name="unidades" value="<?=$row['cod_unid']?>"><?=$row['des_unid']?></option>
				 		<?php 
					}
			 		?>
		 	</select>
		<?php 
  }
?>
