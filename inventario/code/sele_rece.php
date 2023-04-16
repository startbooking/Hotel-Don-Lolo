<?php 
error_reporting(0);
session_start() ;
if ($_SESSION['entro'] != "SI") {
    echo"<script>alert('Usuario Sin Autentiacion, no Puede ingresar a esta pagina'); 
    window.location.href=\"../../login/ingreso.php\"</script>"; 
	}
?>

<?php include("../../config/archivo_head.php") ?>
<? include("../../config/Activos.php") ; ?>
<?php
$query = 'SELECT
	recetas.DES_RECE,
	tipos_recetas.DES_TIPO,
	recetas.CAN_RECE,
	recetas.VCR_RECE,
	recetas.VPR_RECE,
	impuestos.DES_IMPU
FROM
	recetas
INNER JOIN tipos_recetas ON recetas.TIP_RECE = tipos_recetas.COD_TIPO
INNER JOIN impuestos ON recetas.IMP_RECE = impuestos.COD_IMPU
WHERE
	recetas.TIP_RECE = tipos_recetas.COD_TIPO
ORDER BY
	recetas.DES_RECE ASC';

$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
	?>
	<table aling="center" width="90%">
	  <tr>
		<th width="170px">&nbsp;Receta&nbsp;</th>
		<th width="70px">&nbsp;Tipo</th>
		<th width="60px">&nbsp;Porc.&nbsp;</th>
		<th width="70px">&nbsp;Valor Costo&nbsp;</th>
		<th width="140px">&nbsp;Precio Venta&nbsp;</th>
		<th width="140px">&nbsp;Impuesto&nbsp;</th>
		<th width="140px">&nbsp;Accion&nbsp;</th>
	  </tr>

	  <?php while($row = mysql_fetch_array($result)) {
		  printf("<tr>
		  <td>&nbsp;%s</td>
			<td>&nbsp;%s&nbsp;</td>
			<td>&nbsp;%s&nbsp;</td>
			<td>&nbsp;%s&nbsp;</td>
			<td>&nbsp;%s&nbsp;</td>
			<td>%s&nbsp;</td>
			<td>&nbsp;<a href='mod_prod.php'>Modificar</a> - <a href='eli_prod.php'>Eliminar</a></td>
		  </tr>",$row["DES_RECE"],$row["DES_TIPO"],$row["CAN_RECE"],number_format($row["VCR_RECE"],2),number_format($row["VPR_RECE"],2),$row["DES_IMPU"]);
		} 	    
	  mysql_free_result($result); ?>
	</table>
