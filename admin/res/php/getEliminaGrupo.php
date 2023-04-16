<?php 
  
  require '../../../res/php/app_topAdmin.php'; 

  $id     = $_POST['id'];
  $grupos = $admin->traeGrupoInventarios($id);  
 ?>

  <input type="hidden" name="idEliminaGrupo" id="idEliminaGrupo" value="<?=$grupos[0]['id_grupo']?>">
  <div class="form-group">
    <label for="nombre" class="control-label col-lg-4 col-md-4">Familia </label>
    <div class="col-lg-6 col-md-6">
      <select name="familiaGrp" id="familiaGrp" required disabled>
        <?php 
        $familia = $admin->getDescriptionFamilia($grupos[0]['id_familia']) ?>
        <option value="<?=$grupos[0]['id_familia']?>"><?=$familia?></option>                
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="nombre" class="control-label col-lg-4 col-md-4">Grupo </label>
    <div class="col-lg-6 col-md-6">
      <input type="text" class="form-control" id="nombreGrp" name="nombreGrp" required value="<?=$grupos[0]['descripcion_grupo']?>" disabled>
    </div>
  </div>
