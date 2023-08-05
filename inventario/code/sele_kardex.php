<?php 
session_start() ;
if ($_SESSION['entro'] != "SI") {
    echo"<script>alert('Usuario Sin Autentiacion, no Puede ingresar a esta pagina'); 
    window.location.href=\"../../index.php\"</script>"; 
	}
	$_SESSION["scodigo"] = "" ;
?>

<?php include("../../bases/archivo_head.php") ; ?>
<?php include("../../Conn/Conn.php"); ?>
<?php
$sql = 'SELECT
	   	movimiento_inventario.PRD_MOVI,
	   	movimiento_inventario.entradas,
	   	movimiento_inventario.salidas,
	   	(movimiento_inventario.entradas - movimiento_inventario.salidas) AS existencias,
	   	productos.NOM_PROD
	FROM
		movimiento_inventario, productos
	WHERE
	 	movimiento_inventario.EST_MOVI = 1 and 
	 	movimiento_inventario.PRD_MOVI = productos.COD_PROD
	 GROUP BY
		movimiento_inventario.PRD_MOVI
	ORDER BY
		movimiento_inventario.PRD_MOVI ASC,
		movimiento_inventario.TIP_MOVI ASC,
		movimiento_inventario.FEC_MOVI ASC' ;
		$result = mysqli_query($conn,$sql) ;
?>
	    <div class="container">
	    <table>
          <td width="30%">
	        <strong>Bodega</strong>
	        <?php 
	        $bod='SELECT nom_alma, cod_alma FROM bodegas ORDER BY nom_alma' ;
	        $res = mysqli_query($conn,$bod) 
			?>
	        <select name="bodega">
	          <?php while($rbod=mysqli_fetch_array($res)) {
	          	printf('<option value="%s">%s </option>',$rbod['cod_alma'],$rbod['nom_alma'] );
	          } ?>
	        </select>
	        <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> <strong>Buscar</strong></button>
	      </td>
        </table>
        </div>
   
	    <table class="table">
	    <tr class="info">
	    	<th>Codigo</th>
	    	<th>Producto</th>
	    	<th>Entradas</th>
	    	<th>Salidas</th>
	    	<th>Existencias</th>
	    	<th>Unidad</th>
	    	<th>Accion</th>
	    </tr>
	    <?php 
	      while($row = mysqli_fetch_array($result)) { ?>
			<tr>
			  <td><?php echo $row['PRD_MOVI'] ?></td>
			  <td><?php echo $row['NOM_PROD'] ?></td>
			  <td><?php echo $row['entradas'] ?></td>
			  <td><?php echo $row['salidas'] ?></td>
			  <td><?php echo $row['existencias'] ?></td>
			  <td><?php ?></td>
			  <td>
			  <a href=sele_kardex_producto.php?codigo=".$row["COD_PROD"].">Movimientos</a></td>
			</tr>
			<!-- ",$row["COD_PROD"],$row["NOM_PROD"],number_format($row["entradas"],2),number_format($row["salidas"],2),number_format($row["existencias"],2),$row["DES_UNID"]); -->
		<?php }
		?>
		

		</table>
		