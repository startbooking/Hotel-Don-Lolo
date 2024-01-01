<?php

// echo "Entro";

echo json_encode($_REQUEST).'<br>';

require '../../../res/php/init.php';

$filter = ['ORDER' => ['apellido1' => 'ASC']];
$cols = $database->select('huespedes', ['id_huesped', 'apellido1','apellido2','nombre1','nombre2','edad','identificacion'], ['LIMIT' => 1])[0];

// echo print_r($filter);
/* echo $_REQUEST['search']['value'].'<br>';
echo 'Search '; */
if ($_REQUEST['search']['value'] !== ""){
  foreach ($cols as $key => $value) {
    $filter['OR'][$key . '[~]'] = $_REQUEST['search']['value'];
  }
}

// echo print_r($cols);

// echo $_REQUEST['length'];

if ($_REQUEST['length'] !== -1) {
  $filter['LIMIT'] = [$_REQUEST['start'], $_REQUEST['length']];
}

echo 'Filtro Antes'.'<br>';

echo print_r($filter).'<br>';

echo 'Orden Antes'.'<br>';
echo print_r($_REQUEST['order']).'<br>';
echo 'Orden Despues'.'<br>';
if (isset($_REQUEST['order'])) {
 $colIdx = $_REQUEST['order']['0']['column'];
 $filter['ORDER'] = [$_REQUEST['columns'][$colIdx]['data'] => strtoupper($_REQUEST['order']['0']['dir'])];
}

echo print_r($filter).'<br>';

$huespedes = $database->select('huespedes', ['id_huesped', 'apellido1','apellido2','nombre1','nombre2','edad','identificacion'], $filter);

echo print_r($huespedes).'<br>';

$recordsTotal = $database->count('huespedes');
$recordsFiltered = count($huespedes);


/* if (!isset($filter['OR']) {
 $recordsFiltered = $recordsTotal;
} */

$result = [
  'recordsTotal' => $recordsTotal,// 
  'recordsFiltered' => $recordsFiltered,
  'data' => $huespedes
];

echo json_encode($result);

return json_encode($result);