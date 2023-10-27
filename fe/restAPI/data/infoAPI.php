<?php

require_once '../../../res/php/app_topFE.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $infoAPI = $user->datosTokenFE();
  header('Content-Type: application/json');
  echo json_encode($infoAPI);
  http_response_code(200);
} 