<?php 

  require '../../../../res/php/app_topPos.php'; 

// MySQL database connection code

/*
	$connection = mysqli_connect("localhost","root","","google_pie") or die("Error " . mysqli_error($connection));
*/
//Fetch productos data
//
	$idamb = 2;

  $prods = $pos->getTotalProductosVendidos($idamb);


/*

$sql = "SELECT * FROM productos";
$result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));
 */
//create an array
$array = array();
$i = 0;

// $array[] = ['PRODUCTO','VALOR'];
$array[] = ['attendancede', 'Numbder'];
foreach ($prods as $prod) {
	/*
    echo $prod['nom'];
    echo $prod['cant'];
 	*/
    $producto = $prod['nom'];
    $unidades_vendidas = $prod['cant'];
    /// $array['cols'][] = array('type' => 'string'); 
    /// $array[] = array($producto,$unidades_vendidas);
    $array['cols'][] = array('type' => 'string'); 
    $array['rows'][] = array('c' => array( array('v'=> $producto), array('v'=>(int)$unidades_vendidas)));
}


/*

echo print_r($array);
while($row = mysqli_fetch_assoc($result)){  
    $producto = $row['producto'];
    $unidades_vendidas = $row['unidades_vendidas'];
    $array['cols'][] = array('type' => 'string'); 
    $array['rows'][] = array('c' => array( array('v'=> $producto), array('v'=>(int)$unidades_vendidas)) );
}
*/
/// $data = json_encode($array);
echo json_encode($array);
?>