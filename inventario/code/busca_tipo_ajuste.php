<?php
session_start();
// error_reporting(0);
include_once('../../Conn/Conn.php');

$diferencia = $_POST['valor'];


if($diferencia<0){
	$sqlmovi = "SELECT * FROM tipo_movimiento_inv WHERE ajuste = 1 and tipo = 2 ";
}else{
	$sqlmovi = "SELECT * FROM tipo_movimiento_inv WHERE ajuste = 1 and tipo = 1 ";
}

$arrs = array();
if($respmov = mysqli_query($conn,$sqlmovi)){
	while ($rows = mysqli_fetch_assoc($respmov)) {
		$arrs = $rows;
	}
	echo json_encode($arrs);
}else{
	echo "0";
}






?>