<?php 
  require '../../../res/php/app_topHotel.php'; 
	
  $idcia   = $_POST['idcia'];

  $dCia    = $hotel->getBuscaIdEmpresa($idcia);
  $tipoDoc = $hotel->getTipoDocumentoHuesped($dCia[0]['tipo_documento']);

?>

<div class="form-horizontal"> 
  <div class="form-group">
    <label class="control-label col-lg-2">Nit</label>
    <div class="col-lg-4 col-md-4">
      <input class="form-control padInput" type="text" name="txtDocumento" id='txtDocumento' value='<?=$dCia[0]['nit'].'-'.$dCia[0]['dv'];?>' readonly>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-lg-2">Empresa</label>
    <div class="col-lg-10 col-md-10">
      <input class="form-control padInput" type="text" name="txtDireccion" id='txtDireccion' value='<?=$dCia[0]['empresa']?>' readonly>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-lg-2">Direccion</label>
    <div class="col-lg-10 col-md-10">
      <input class="form-control padInput" type="text" name="txtDireccion" id='txtDireccion' value='<?=$dCia[0]['direccion']?>' readonly>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-lg-2">Celular</label>
    <div class="col-lg-4 col-md-4">
      <input class="form-control padInput" style="margin:0;padding:5px" type="text" name="txtCelular" id="txtCelular" value='<?=$dCia[0]['celular']?>' readonly>
    </div>
    <label class="control-label col-lg-2">Telefono</label>
    <div class="col-lg-4 col-md-4">
      <input class="form-control padInput" type="text" name="txtTelefono" id='txtTelefono' value='<?=$dCia[0]['telefono']?>' readonly>
    </div>
  </div>
  <div class="form-group ">
    <label class="control-label col-lg-2">Pagina Web</label>
    <div class="col-lg-4 col-md-4">
      <input class="form-control padInput" type="text" name="txteMail" id='txteMail' value='<?=$dCia[0]['web']?>' readonly>
    </div>

    <label class="control-label col-lg-2">eMail</label>
    <div class="col-lg-4 col-md-4">
      <input class="form-control padInput" type="text" name="txteMail" id='txteMail' value='<?=$dCia[0]['email']?>' readonly>
    </div>
  </div>
  <div class="form-group ">
    <label class="control-label col-lg-2">Usuario</label>
    <div class="col-lg-4 col-md-4">
      <input class="form-control padInput" type="text" name="txtUsuario" id='txtUsuario' value='<?=$dCia[0]['usuario']?>'readonly >
    </div>
    <label class="control-label col-lg-2">Fecha Creacion</label>
    <div class="col-lg-4 col-md-4">
      <input class="form-control padInput" type="text" name="txtCreacion" id='txtCreacion' value='<?=$dCia[0]['created_at']?>'readonly >
    </div>
  </div>
</div>
