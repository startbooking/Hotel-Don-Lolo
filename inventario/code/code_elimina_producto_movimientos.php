<?php
session_start();
// error_reporting(0);

include_once('../../Conn/Conn.php');
$codigo = $_POST['articulo'];
$usua   = $_SESSION['USUARIO'];
echo $codigo;
echo $usua;
$quitar = "DELETE FROM temp_movi WHERE codigo = '$codigo' and usuario = '$usua' and tipo = '1'";
/*revisamos si hay entradas en tabla temp*/
$resp = mysqli_query($conn,$quitar);

?>