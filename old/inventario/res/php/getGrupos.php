<?php
  

  require '../../../res/php/app_topInventario.php'; 

  $codigo = $_POST['codigo'];

  $grupos = $inven->getGruposFamilia($codigo); 

  ?> 
  <option value="">Seleccione el grupo de Inventarios</option>
  <?php 
  foreach ($grupos as $grupo) { ?> 
    <option value="<?=$grupo['id_grupo'];?>"><?= $grupo['descripcion_grupo'];?> </option>
  <?php 
  }
 
?>