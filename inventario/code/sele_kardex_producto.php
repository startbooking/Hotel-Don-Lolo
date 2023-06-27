<?php 
session_start() ;
if ($_SESSION['entro'] != "SI") {
    echo"<script>alert('Usuario Sin Autentiacion, no Puede ingresar a esta pagina'); 
    window.location.href=\"../../login/ingreso.php\"</script>"; 
	}
	$codigo = $_GET["codigo"]
?>


<?php include("../../config/archivo_head.php") ?>
<? include("../../conn/connect.php") ?>
<?php  
if ($conn->connect_error) {
     die("Fallo en la Coneccion: " . $conn->connect_error);
	}

$sql = 'SELECT
			movimiento_inventario.TIP_MOVI,
			movimiento_inventario.NUM_MOVI,
			productos.NOM_PROD,
			movimiento_inventario.FEC_MOVI,
			movimiento_inventario.salidas,
			movimiento_inventario.entradas,
			movimiento_inventario.VUN_MOVI,
			movimiento_inventario.VTO_MOVI
		FROM
			productos ,
			movimiento_inventario
		WHERE
			movimiento_inventario.PRD_MOVI = productos.COD_PROD 
			and movimiento_inventario.EST_MOVI = 1 
			and movimiento_inventario.PRD_MOVI = "111004" and movimiento_inventario.bod_movi = "ALM"
		ORDER BY
			movimiento_inventario.FEC_MOVI ASC,
			movimiento_inventario.PRD_MOVI ASC,
			movimiento_inventario.TIP_MOVI ASC' ;

		$result      = $conn->query($sql);
		$filas       = mysqli_fetch_array($result);
		$Nomproducto =  $filas["NOM_PROD"];     
	
	if ($result->num_rows > 0) {
	    ?>
	    <h2>
	    	<?php 
	    	printf($Nomproducto)
	    	 ?>
	    </h2>
	    <table>
	    <tr>
	    	<th>Tipo</th>
	    	<th>Nro</th>
	    	<th>Fecha</th>
	    	<th>Entradas</th>
	    	<th>Salidas</th>
	    	<th>Valor Unit.</th>
	    	<th>Valor Tot.</th>
	    </tr>
	    <?php 
	    while($row = mysqli_fetch_array($result)) {
		  printf("<tr>
		  <td>&nbsp;%s</td>
		  <td>&nbsp;%s&nbsp;</td>
		  <td>&nbsp;%s&nbsp;</td>
		  <td>&nbsp;%s&nbsp;</td>
		  <td>&nbsp;%s&nbsp;</td>
		  <td>&nbsp;%s&nbsp;</td>
		  <td>%s&nbsp;</td>
		  </tr>",$row["TIP_MOVI"],number_format($row["NUM_MOVI"],0),$row["FEC_MOVI"],number_format($row["entradas"],2),number_format($row["salidas"],2),number_format($row["VUN_MOVI"],2),number_format($row["VTO_MOVI"],2));
		}
		?>
		</table>
		<?php 
	}
	
	$conn->close();
?>