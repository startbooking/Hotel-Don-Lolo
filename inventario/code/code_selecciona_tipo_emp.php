<?php 
$tipo = $_POST['codigo']; 
if($tipo=='001'){

	echo "<div class='form-group'>
		      <label class='control-label col-lg-2 col-md-2'>Nombre</label>
		      <div class='col-lg-4 col-md-4'>
		        <input type='text' class='form-control' id='nombre1' name='nombre1' required >
		      </div>
		      <label for='producto' class='control-label col-lg-2 col-md-2'>2o Nombre</label>
		      <div class='col-lg-4 col-md-4'>
		        <input type='text' class='form-control' id='nombre2' name='nombre2' required >
		      </div>
		    </div>

		    <div class='form-group'>
		      <label for='' class='control-label col-lg-2 col-md-2'>Apellido</label>
		      <div class='col-lg-4 col-md-4'>
		        <input type='text' class='form-control' id='apellido1' name='apellido1' required >
		      </div>
		      <label for='producto' class='control-label col-lg-2 col-md-2'>2o Apellido</label>
		      <div class='col-lg-4 col-md-4'>
		        <input type='text' class='form-control' id='apellido2' name='apellido2' required >
		      </div>
		    </div>";
}else{
	echo "";
}
?>
