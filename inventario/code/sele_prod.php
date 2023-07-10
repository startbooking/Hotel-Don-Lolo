<?php 
error_reporting(0);
session_start() ;
if ($_SESSION['entro'] != "SI") {
    echo"<script>alert('Usuario Sin Autentiacion, no Puede ingresar a esta pagina'); 
    window.location.href=\"../../login/ingreso.php\"</script>"; 
	}
?>

<? include("../../config/Activos.php") ; ?>
<?php include("../../config/archivo_head.php") ?>
		  	  <div >
				<?php
				$query = 'SELECT
			   	productos.COD_PROD,
			   	productos.NOM_PROD,
				familia_inve.des_falm,
				grupos_inve.des_grup,
			   	unidades.DES_UNID
				FROM
					productos
				INNER JOIN familia_inve ON productos.cfa_prod = familia_inve.cod_falm
				INNER JOIN grupos_inve ON productos.cgr_prod = grupos_inve.COD_grup
				INNER JOIN unidades ON productos.uco_prod = unidades.COD_UNID
				ORDER BY
					productos.COD_PROD ASC';
				$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

					// Imprimir los resultados en HTML'
			  ?>
				<table aling="center" width="90%">
		      	  <tr>
			    	<th width="70px">&nbsp;Codigo&nbsp;</th>
			      	<th width="170px">&nbsp;Producto</th>
			      	<th width="80px">&nbsp;Familia&nbsp;</th>
			      	<th width="100px">&nbsp;Grupo&nbsp;</th>
			      	<th width="100px">&nbsp;Unidad&nbsp;</th>
			      	<th width="100px">&nbsp;Accion&nbsp;</th>
		      	  </tr>

				   <?php while($row = mysql_fetch_array($result)) {
					  printf("<tr>
					  <td>&nbsp;%s</td>
					  <td>&nbsp;%s&nbsp;</td>
					  <td>&nbsp;%s&nbsp;</td>
					  <td>&nbsp;%s&nbsp;</td>
					  <td>%s&nbsp;</td>
					  <td>&nbsp;<a href='mod_prod.php'>Modificar</a> - <a href='eli_prod.php'>Eliminar</a></td>
					  </tr>",$row["COD_PROD"],$row["NOM_PROD"],$row["des_falm"],$row["des_grup"],$row["DES_UNID"]);
				  } 
				    
				    mysql_free_result($result); ?>
		 		</table>
		 	  </div>
