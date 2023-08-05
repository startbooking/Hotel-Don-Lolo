<?php
session_start();
// error_reporting(0);
include_once('../../Conn/Conn.php');

$codigo=$_POST['codigo'];
$cadena="select p.* from productos_inve p where p.id_prod = '$codigo'";

$resp = mysqli_query($conn,$cadena);
$numrow = mysqli_num_rows($resp);
if ($numrow ==0){
  echo "0";
}else{
 	$array=array();
	while($row=mysqli_fetch_assoc($resp)){
  	$array=$row;
	}
	echo json_encode($array);	
}

?> 