<?php
	session_start();
	// error_reporting(0);
	include_once('../../Conn/Conn.php');
	$tipo        =$_POST['tipo'];
	$usuario = $_SESSION['usuario'];

	$sqldele = "DELETE FROM temp_movi WHERE usuario = '$usuario' and tipo = '$tipo'";
	$resdele = mysqli_query($conn,$sqldele);

?>