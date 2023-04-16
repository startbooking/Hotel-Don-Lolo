<?php
  require '../../../res/php/app_topAdmin.php'; 

  $id           = $_POST['id'];
  $valorTipoHab = $admin->getValorSubTarifaHabitacion($id);
  $tiposHabi    = $hotel->getTipoHabitacion(); 

  


?>

<div class="form-group">
  <label for="nombre" class="control-label col-lg-2 col-md-2">Tipo de Habitacion </label>
  <div class="col-lg-8 col-md-8">
    <select name="valTipoHabitMod" id="valTipoHabitMod" value="<?=$valorTipoHab[0]['id_tipohabitacion']?>" readonly disabled="">
      <?php 
        foreach ($tiposHabi as $tipoHabi) { ?> 
          <option value="<?=$tipoHabi['id']?>"><?=$tipoHabi['descripcion_habitacion']?></option>
          <?php 
        }
       ?>
    </select>
  </div>
</div>
<div class="form-group">
  <label for="nombre" class="control-label col-lg-2 col-md-2">Desde </label>
  <div class="col-lg-4 col-md-4">
    <input type="date" style="line-height: 15px;" class="form-control" id="desdeFechaMod" name="desdeFechaMod" required value="<?=$valorTipoHab[0]['desde_fecha']?>"> 
  </div>
  <label for="nombre" class="control-label col-lg-2 col-md-2">Hasta </label>
  <div class="col-lg-4 col-md-4">
      <input type="date" style="line-height: 15px;" class="form-control" id="hastaFechaMod" name="hastaFechaMod" required value="<?=$valorTipoHab[0]['hasta_fecha']?>"> 
  </div>
</div>
<div class="form-group">
  <label for="nombre" class="control-label col-lg-2 col-md-2">Una Persona </label>
  <div class="col-lg-4 col-md-4">
    <input type="number" min="0" class="form-control" id="valorUnPaxMod" name="valorUnPaxMod" required value="<?=$valorTipoHab[0]['valor_un_pax']?>"> 
  </div>
  <label for="nombre" class="control-label col-lg-2 col-md-2">Dos Persona </label>
  <div class="col-lg-4 col-md-4">
      <input type="number" min="0" class="form-control" id="valorDosPaxMod" name="valorDosPaxMod" required value="<?=$valorTipoHab[0]['valor_dos_pax']?>"> 
  </div>
</div>
<div class="form-group">
  <label for="nombre" class="control-label col-lg-2 col-md-2">Tres Persona </label>
  <div class="col-lg-4 col-md-4">
    <input type="number" min="0" class="form-control" id="valorTresPaxMod" name="valorTresPaxMod" required value="<?=$valorTipoHab[0]['valor_tre_pax']?>"> 
  </div>
  <label for="nombre" class="control-label col-lg-2 col-md-2">Cuatro Persona </label>
  <div class="col-lg-4 col-md-4">
      <input type="number" min="0" class="form-control" id="valorCuatroPaxMod" name="valorCuatroPaxMod" required value="<?=$valorTipoHab[0]['valor_cua_pax']?>"> 
  </div>
</div>
<div class="form-group">
  <label for="nombre" class="control-label col-lg-2 col-md-2">Cinco Persona </label>
  <div class="col-lg-4 col-md-4">
    <input type="number" min="0" class="form-control" id="valorCincoPaxMod" name="valorCincoPaxMod" required value="<?=$valorTipoHab[0]['valor_cin_pax']?>"> 
  </div>
  <label for="nombre" class="control-label col-lg-2 col-md-2">Seis Persona </label>
  <div class="col-lg-4 col-md-4">
      <input type="number" min="0" class="form-control" id="valorSeisPaxMod" name="valorSeisPaxMod" required value="<?=$valorTipoHab[0]['valor_sei_pax']?>"> 
  </div>
</div>
<div class="form-group">
  <label for="nombre" class="control-label col-lg-2 col-md-2">Adicional </label>
  <div class="col-lg-4 col-md-4">
    <input type="number" min="0" class="form-control" id="valorAdicionalMod" name="valorAdicionalMod" required value="<?=$valorTipoHab[0]['valor_adicional']?>"> 
  </div>
  <label for="nombre" class="control-label col-lg-2 col-md-2">Niño </label>
  <div class="col-lg-4 col-md-4">
      <input type="number" min="0" class="form-control" id="valorNinoMod" name="valorNinoMod" required value="<?=$valorTipoHab[0]['valor_nino']?>"> 
  </div>
</div>
