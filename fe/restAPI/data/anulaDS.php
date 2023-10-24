<?php
require_once '../../../res/php/app_topFE.php';

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
  $postBody = json_decode(file_get_contents('php://input'), true);
  extract($postBody);
  $result = $user->anulaDS($id, $numDocu, strtoupper($motivo), $usuario_id);
  echo json_encode($result);
}

?>