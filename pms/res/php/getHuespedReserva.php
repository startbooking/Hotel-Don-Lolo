<?php 
  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
	
  $id      = $_POST['id'];
  $Huesped = $hotel->getDatosHuespedReserva($id);
  $tipoDoc = $hotel->getTipoDocumentoHuesped($Huesped[0]['tipo_identifica']);

?>

<div class="divHuesped">
  <div class="form-group">
    <label class="control-label col-lg-2">Documento</label>
    <div class="col-lg-4 col-md-4">
      <input class="form-control padInput" type="text" name="txtDocumento" id='txtDocumento' value='<?=$Huesped[0]['identificacion']?>' readonly>
    </div>
    <label class="control-label col-lg-2">Tipo Doc</label>
    <div class="col-lg-4 col-md-4">
      <input class="form-control padInput" type="text" name="txtTipoDoc" id='txtTipoDoc' value='<?=$tipoDoc?>' readonly>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-lg-2">Direccion</label>
    <div class="col-lg-4 col-md-4">
      <input class="form-control padInput" type="text" name="txtDireccion" id='txtDireccion' value='<?=$Huesped[0]['direccion']?>' readonly>
    </div>
    <label class="control-label col-lg-2">Telefono</label>
    <div class="col-lg-4 col-md-4">
      <input class="form-control padInput" type="text" name="txtTelefono" id='txtTelefono' value='<?=$Huesped[0]['telefono']?>' readonly>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-lg-2">eMail</label>
    <div class="col-lg-4 col-md-4">
      <input class="form-control padInput" type="text" name="txteMail" id='txteMail' value='<?=$Huesped[0]['email']?>' readonly>
    </div>
    <label class="control-label col-lg-2">Celular</label>
    <div class="col-lg-4 col-md-4">
      <input class="form-control padInput" style="margin:0;padding:5px" type="text" name="txtCelular" id="txtCelular" value='<?=$Huesped[0]['celular']?>' readonly>
    </div>
  </div>
  <div class="form-group ">
    <label class="control-label col-lg-2">Fecha Nac.</label>
    <div class="col-lg-4 col-md-4">
      <input class="form-control padInput" type="text" name="txtFecha" id='txtFecha' value='<?=$Huesped[0]['fecha_nacimiento']?>' readonly>
    </div>
  </div>
  <div class="form-group ">
    <label class="control-label col-lg-2">Nacionalidad</label>
    <div class="col-lg-4 col-md-4">
      <input class="form-control padInput" type="text" name="txtFecha" id='txtFecha' value="<?php echo $hotel->getLandGUest($Huesped[0]['pais_expedicion'])?>" readonly>
    </div>
    <label class="control-label col-lg-2">Ciudad</label>
    <div class="col-lg-4 col-md-4">
      <input class="form-control padInput" type="text" name="txtFecha" id='txtFecha' value="<?php echo $hotel->getCityExp($Huesped[0]['ciudad_expedicion'])?>" readonly>
    </div>
  </div>

  <div class="form-group ">
    <label class="control-label col-lg-2">Usuario</label>
    <div class="col-lg-4 col-md-4">
      <input class="form-control padInput" type="text" name="txtUsuario" id='txtUsuario' value='<?=$Huesped[0]['usuario_creador']?>'readonly >
    </div>
    <label class="control-label col-lg-2">Fecha Creacion</label>
    <div class="col-lg-4 col-md-4">
      <input class="form-control padInput" type="text" name="txtCreacion" id='txtCreacion' value='<?=$Huesped[0]['fecha_creacion']?>'readonly >
    </div>
  </div>
</div>
