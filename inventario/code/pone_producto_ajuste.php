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
	 	<select  
		 	name="producto" 
		 	id="producto" 
		 	class="form-control col-lg-8" 
		 	onchange='busca_producto()'>
	 		<option value="">Seleccione el Producto</option>
	 		<?php 
		 		while($row=mysqli_fetch_assoc($resp)){
	 		?>
		 		<option name="<?=$row['cod_prod']?>" value="<?=$row['cod_prod']?>"><?=$row['nom_prod']?></option>
	 		<?php 
				}
	 		?>
	 	</select>
		<?php 
  }
?>
