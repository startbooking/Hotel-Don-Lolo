<?php

/* require_once 'vendor/autoload.php';

use Medoo\Medoo;

$database = new Medoo([
    'type' => 'mysql',
    'host' => $databasehost,
    'database' => $databasename,
    'username' => $databaseuser,
    'password' => $databasepass,
    'charset' => 'utf8'
]); */


echo 'ENtro ';

require_once '../../../../init.php';
// require '../../../res/php/app_topHotel.php';

echo 'Paso ';

$filter = ['ORDER' => ['apellido1' => 'ASC']];
$cols = $database->select('huespedes', '*', ['LIMIT' => 1])[0];
if ($_REQUEST['search']['value'] !== ""){
  foreach ($cols as $key => $value) {
    $filter['OR'][$key . '[~]'] = $_REQUEST['search']['value'];
  }
}
if ($_REQUEST['length'] !== -1) {
  $filter['LIMIT'] = [$_REQUEST['start'], $_REQUEST['length']];
}
if (isset($_REQUEST['order'])) {
 $colIdx = $_REQUEST['order']['0']['column'];
 $filter['ORDER'] = [$_REQUEST['columns'][$colIdx]['data'] => strtoupper($_REQUEST['order']['0']['dir'])];
}

$huespedes = $database->select('huespedes', '*', $filter);
$recordsTotal = $database->count('huespedes');
$recordsFiltered = count($huespedes);

if (!isset($filter['OR']) {
 $recordsFiltered = $recordsTotal;
}

$result = [
  'draw' => intval($_REQUEST['draw']),
  'recordsTotal' => $recordsTotal,
  'recordsFiltered' => $recordsFiltered,
  'data' => $huespedes
];

return json_encode($result);