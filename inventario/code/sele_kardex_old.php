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
			   	productos.COD_PROD,
			   	productos.NOM_PROD,
			   	movimiento_inventario.entradas,
			   	movimiento_inventario.salidas,
			   	(movimiento_inventario.entradas - movimiento_inventario.salidas) AS existencias,
			   	unidades.DES_UNID
				FROM
					movimiento_inventario
				INNER JOIN productos ON movimiento_inventario.PRD_MOVI = productos.COD_PROD
				INNER JOIN unidades ON productos.UCP_PROD = unidades.COD_UNID
				WHERE
					movimiento_inventario.BOD_MOVI = "ALM"
				AND movimiento_inventario.EST_MOVI = 1
				GROUP BY
					productos.COD_PROD
				ORDER BY
					productos.COD_PROD ASC,
					movimiento_inventario.FEC_MOVI ASC,
					movimiento_inventario.TIP_MOVI ASC,
					movimiento_inventario.HOR_MOVI ASC';
				$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

					// Imprimir los resultados en HTML'
			?>
				<table aling="center" width="90%">
		      	  <tr>
			    	<th>&nbsp;Codigo&nbsp;</th>
			      	<th>&nbsp;Producto</th>
			      	<th>&nbsp;Entradas&nbsp;</th>
			      	<th>&nbsp;Salidas&nbsp;</th>
			      	<th>&nbsp;Existencias&nbsp;</th>
			      	<th>&nbsp;Unidad&nbsp;</th>
			      	<th>&nbsp;Accion&nbsp;</th>
		      	  </tr>

				   <?php while($row = mysql_fetch_array($result)) {
					  printf("<tr>
					  <td>&nbsp;%s</td>
					  <td>&nbsp;%s&nbsp;</td>
					  <td>&nbsp;%s&nbsp;</td>
					  <td>&nbsp;%s&nbsp;</td>
					  <td>&nbsp;%s&nbsp;</td>
					  <td>%s&nbsp;</td>
					  <td>&nbsp;<a href='ver_kardex.php'>Movimientos</a></td>
					  </tr>",$row["COD_PROD"],$row["NOM_PROD"],number_format($row["entradas"],2),number_format($row["salidas"],2),number_format($row["existencias"],2),$row["DES_UNID"]);
				  } 
				    
				    mysql_free_result($result); ?>
		 		</table>
