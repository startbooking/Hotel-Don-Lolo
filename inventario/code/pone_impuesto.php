<?php 
  include_once('../../Conn/Conn.php');
  $alma = "SELECT * FROM impuestos where tip_impu = 1 order by des_impu";
  $resp = mysqli_query($conn,$alma);
  $numrow = mysqli_num_rows($resp);
  if($numrow==0){
		?>
		<div class="alert alert_warning"><h3>Sin Impuestos Creados</h3></div>
		<?php 
  }else{
  	?>
      <div class="input-group">
	      <span class='input-group-addon'>Impuesto</span>
			 	<div class="col-lg-8">

			 	<select name="impuesto" id="impuesto" class="form-control" onchange='pone_por_impto()'>
			 		<option value="">Seleccione el Impuesto</option>
			 		<?php 
				 		$sql_amb = "SELECT * FROM impuestos where tip_impu = 1 order by des_impu";
				 		$sql_res = mysqli_query($conn,$sql_amb);
				 		while($row=mysqli_fetch_assoc($sql_res)){
			 		?>
				 		<option name="<?=$row['cod_impu']?>" value="<?=$row['cod_impu']?>"><?=$row['des_impu']?></option>
			 		<?php 
						}
			 		?>
			 	</select>
			 	</div>
	      <div class="checkbox col-lg-4">
			    <label>
		      	<input type="checkbox" id='incluido'> Incluido
			    </label>
	      </div>
      </div>
		<?php 
  }
?>
