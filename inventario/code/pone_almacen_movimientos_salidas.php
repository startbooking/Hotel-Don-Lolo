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
      <div class="row-fluid">
	      <div class="col-md-3 col-offset-md-3">
		      <h5 style="margin-top: 20px">Seleccione el Almacen</h5>
	      </div>
				<div class='col-md-4' style="margin-top:10px">
				 	<form id="ambienteKardex">
					 	<select 
					 		name="mov_entradas" 
					 		id="mov_entradas" 
					 		class="form-control">
					 		<option value="">Seleccione el Almacen</option>
					 		<?php 
						 		while($row=mysqli_fetch_assoc($resp)){
					 		?>
						 		<option name="<?=$row['cod_alma']?>" value="<?=$row['cod_alma']?>"><?=$row['nom_alma']?></option>
					 		<?php 
								}
					 		?>
					 	</select>
				 	</form>
				</div>
        <div class="col-lg-4 btn-group" role="group">
	        <button 
	        	style="margin-top:10px"
	        	id="buscar_mov"
	        	class="btn btn-success" 
	        	onclick='lista_salidas();'
	        	>
	        	Buscar Salidas
        	</button>
          <button type="button" 
	        	style="margin-top:10px"
	        	id='nuevo_mov' 
          	class="btn btn-info" 
            data-toggle="modal" 
            data-target="#ModalEntradaMovimientos" 
            data-almacen="<?php echo $row['cod_alma']?>"  
            title        ="Nuevo Movimiento de Inventarios" >
            Nueva Salida
          </button>
	      </div>
      </div>
		<?php 
  }
?>
