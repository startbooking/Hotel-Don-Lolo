<?php 
  require '../../../../res/php/app_topPos.php'; 
	$id    = $_POST['id'];

  $traeClie = $pos->traeCliente($id);

?>
<div class="form-group">
  <input type="hidden" class="form-control" id="idCli" name="idCli" value="<?=$traeClie[0]['id_cliente']?>">
  <label for="apellidos" class="control-label col-lg-2 col-md-2">1er Apellido</label>
  <div class="col-lg-4 col-md-4">
    <input type="text" class="form-control" id="apellido1" name="apellido1" value="<?=$traeClie[0]['apellido1']?>" required >
  </div>
  <label for="apellidos" class="control-label col-lg-2 col-md-2">2o Apellido</label>
  <div class="col-lg-4 col-md-4">
    <input type="text" class="form-control" id="apellido2" name="apellido2" value="<?=$traeClie[0]['apellido2']?>">
  </div>
</div>
<div class="form-group">
  <label for="nombres" class="control-label col-lg-2 col-md-2">1er Nombre</label>
  <div class="col-lg-4 col-md-4">
    <input type="text" class="form-control" id="nombre1" name="nombre1" required value="<?=$traeClie[0]['nombre1']?>">
  </div>
  <label for="nombres" class="control-label col-lg-2 col-md-2">2o Nombre</label>
  <div class="col-lg-4 col-md-4">
    <input type="text" class="form-control" id="nombre2" name="nombre2" value="<?=$traeClie[0]['nombre2']?>">
  </div>
</div>
<div class="form-group">
  <label for="identificacion" class="control-label col-lg-2 col-md-2">Identificacion</label>
  <div class="col-lg-4 col-md-4">
    <input type="text" class="form-control" id="identificacion" name="identificacion" required maxlength="12" value="<?=$traeClie[0]['identificacion']?>">
  </div>
  <label for="inputEmail3" class="col-sm-2 control-label">Tipo Documento</label>
  <div class="col-sm-4">
    <select name="tipodoc" id="tipodoc" required="">
      <option value="">Seleccione el Tipo de Documento</option>
      <?php 
        $tipodocs = $pos->getTipoDocumento(); 

        echo print_r($tipodocs);
        foreach ($tipodocs as $tipodoc): ?>
          <option value="<?=$tipodoc['id_doc']?>" 
            <?php 
            if($tipodoc['id_doc']==$traeClie[0]['id_tipo_doc']){ ?>
              selected
              <?php 
            }
            ?>
            ><?=$tipodoc['descripcion_documento']?></option>
          <?php 
        endforeach 
      ?>
    </select>
  </div>
</div>
<div class="form-group">
  <label for="direccion" class="control-label col-lg-2 col-md-2">Direccion</label>
  <div class="col-lg-4 col-md-4">
    <input type="text" class="form-control" id="direccion" name="direccion" maxlength="80" value="<?=$traeClie[0]['direccion']?>"> 
  </div>
  <label for="telefono" class="control-label col-lg-2 col-md-2">Telefono</label>
  <div class="col-lg-4 col-md-4">
    <input type="text" class="form-control" id="telefono" name="telefono" maxlength="12" value="<?=$traeClie[0]['telefono']?>">
  </div>
</div>
<div class="form-group">
  <label for="celular" class="control-label col-lg-2 col-md-2">Celular</label>
  <div class="col-lg-4 col-md-4">
    <input type="text" class="form-control" id="celular" name="celular" required maxlength="12" value="<?=$traeClie[0]['celular']?>">
  </div>
  <label for="correo" class="control-label col-lg-2 col-md-2">Correo</label>
  <div class="col-lg-4 col-md-4">
    <input type="email" class="form-control" id="correo" name="correo" required maxlength="80" value="<?=$traeClie[0]['email']?>">
  </div>
</div>