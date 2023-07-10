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
			   	nom_prov,
			   	nit_prov,
			   	div_prov,
				dir_prov,
				tel_prov 
				FROM
					proveedores
				ORDER BY
					nom_prov ASC';
				$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

					// Imprimir los resultados en HTML'
			?>
				<table aling="center" width="90%">
		      	  <tr>
			    	<th width="170px">&nbsp;Proveedor&nbsp;</th>
			      	<th width="70px">&nbsp;Nit</th>
			      	<th width="30px">&nbsp;Div&nbsp;</th>
			      	<th width="160px">&nbsp;Direccion&nbsp;</th>
			      	<th width="70px">&nbsp;Telefono&nbsp;</th>
			      	<th width="140px">&nbsp;Accion&nbsp;</th>
		      	  </tr>

				   <?php while($row = mysql_fetch_array($result)) {
					  printf("<tr>
					  <td>&nbsp;%s</td>
					  <td>&nbsp;%s&nbsp;</td>
					  <td>&nbsp;%s&nbsp;</td>
					  <td>&nbsp;%s&nbsp;</td>
					  <td>%s&nbsp;</td>
					  <td>&nbsp;<a href='mod_prod.php'>Modificar</a> - <a href='eli_prod.php'>Eliminar</a></td>
					  </tr>",$row["nom_prov"],$row["nit_prov"],$row["div_prov"],$row["dir_prov"],$row["tel_prov"]);
				  } 
				    
				    mysql_free_result($result); ?>
		 		</table>
