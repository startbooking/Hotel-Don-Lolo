

<?php
  // require '../../../res/php/titles.php';
require '../../../res/php/app_topHotel.php';

$id = $_POST['id'];

$perfil = $hotel->getTipoPerfilCodigo($id);

echo $perfil;

?>