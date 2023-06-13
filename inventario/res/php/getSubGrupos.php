<?php
  
  require '../../../res/php/app_topInventario.php'; 

  $codigo = $_POST['codigo'];

  $subgrupos = $inven->getSubGruposFamilia($codigo);

  ?>
    <option value="">Seleccione el SubGrupo de Inventarios</option>
  <?php 
  foreach ($subgrupos as $subgrupo) { ?>
    <option value="<?=$subgrupo['id_subgrupo'];?>"><?= $subgrupo['descripcion_subgrupo'];?> </option>
  <?php 
  }

?>