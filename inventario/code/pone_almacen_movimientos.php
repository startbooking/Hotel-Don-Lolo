<?php 
  include_once('../../Conn/Conn.php');
  $alma = "SELECT * FROM bodegas order by nom_alma";
  $resp = mysqli_query($conn,$alma);
  $numrow = mysqli_num_rows($resp);
  if($numrow==0){
		?>
		<div class="alert alert_warning"><h3>Sin Bodegas Creadas</h3></div>
		<?php 
  }else{
  	?>
	      <div class="row-fluid">
		      <div class="col-md-3 col-offset-md-3">
			      <h5 style="margin-top: 20px">Seleccione el Almacen</h5>
		      </div>
					<div class='col-md-4' style="margin-top:10px">
					 	<form id="ambienteKardex">
						 	<select onblur="lista_entradas(this.value);"  name="mov_entradas" id="mov_entradas" class="form-control">
						 		<option value=" ">Seleccione el Almacen</option>
						 		<?php 
							 		$sql_amb = "SELECT * FROM bodegas order by nom_alma";
							 		$sql_res = mysqli_query($conn,$sql_amb);
							 		while($row=mysqli_fetch_assoc($sql_res)){
						 		?>
							 		<option name="<?=$row['cod_alma']?>" value="<?=$row['cod_alma']?>"><?=$row['nom_alma']?></option>
						 		<?php 
									}
						 		?>
						 	</select>
					 	</form>
					</div>
	        <div class="col-lg-2 col-lg-offset-1">
            <button type="button" class="btn btn-danger btn-block" 
              data-toggle="modal" 
              data-target="#ModalEntradaMovimientos" 
              title="Nuevo Entrada a inventarios" 
              data-almacen="<?php echo $almacen?>"  
              title        ="Nuevo Movimiento de Inventarios" >Nueva Entrada
              </button>

		        <button style="margin-top: 9px" id='nuevo_mov' class="btn btn-info btn-block" type="">Nuevo Movimiento</button>
	        </div>
	      </div>
		<?php 
  }
?>
