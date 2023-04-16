<?php
session_start();
error_reporting(0);
// require('class_lib/class_conecta_mysql.php');
// require('class_lib/funciones.php');
// $db=new ConexionMySQL();

include_once('../../Conn/Conn.php');

$fecha     = test_input($_POST['fecha']);
$tipomovi  = test_input($_POST['tipo_movi']);
$proveedor = test_input($_POST['proveedor']);
$factura   = test_input($_POST['num_fact']);
$impuesto  = test_input($_POST['impuesto']);
/*

$descuento = test_input($_POST['descuento']);
if($descuento==""){
  $descuento=0.00;
}
 */
$articulo      =test_input(strtoupper($_POST['articulo']));
$costo         =test_input($_POST['costo']);
$cantidad      =test_input($_POST['cantidad']);
$tipo          =test_input($_POST['tipo']);
$desc_articulo =test_input(strtoupper($_POST['descripcion_articulo']));
$desc_prov     =test_input(strtoupper($_POST['descripcion_prov']));

$cadena="Insert into temp_movi(fecha,proveedor,num_fact_nota,impuesto_porcentaje,desc_porcentaje,
articulo,costo,cantidad,tipo,descripcion_articulo,descripcion_prov) values('$fecha',$proveedor,'$factura',$impuesto,$descuento,
'$articulo',$costo,$cantidad,'$tipo','$desc_articulo','$desc_prov')";
if($db->consulta($cadena)){

}else{
  echo "0";
}
?>