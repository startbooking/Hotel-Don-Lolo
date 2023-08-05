<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$familia = $_POST['id'];

	$grupos = $admin->getGruposFamilia($familia);
	
 ?>

<?php foreach ($grupos as $key => $value): ?>
	<option value="<?=$value['id_grupo']?>"><?=$value['descripcion_grupo']?></option>}
<?php endforeach ?>