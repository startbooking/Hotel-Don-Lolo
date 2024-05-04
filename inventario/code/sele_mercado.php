<?php 
#error_reporting(0);
session_start() ;
if ($_SESSION['entro'] != "SI") {
    echo"<script>alert('Usuario Sin Autentiacion, no Puede ingresar a esta pagina'); 
    window.location.href=\"../../login/ingreso.php\"</script>"; 
	}
include_once("../../Conn/Conn.php") ; 
include_once("../../bases/archivo_head.php") ;
$query = 'SELECT listamercados.codigo, listamercados.descripcion, listamercados.val_lista, bodegas.nom_alma 	FROM listamercados, bodegas where listamercados.cod_alma = bodegas.cod_alma ORDER BY listamercados.descripcion ASC' ;

	$result = mysqli_query($conn,$query);

	?>
	<table aling="center" class="table table-bordered table table-hover">
		<tr>
			<th>Codigo</th>
			<th>Lista de Mercado</th>
			<th>Almacen</th>
			<th align="rigth">Valor</th>
			<th>Accion</th>
		</tr>
	  <?php 

	   	while($row = mysqli_fetch_array($result)) {
	   	?>	
	 	<tr style='font-size:12px'>
			<td><?=$row['codigo'];?></td>
			<td><?=$row['descripcion']?></td>
			<td><?=$row['nom_alma']?></td>
			<td align="rigth"><?=number_format($row['val_lista'],2);?></td>
			<td align="center">
			<button class="btn btn-info btn-xs">
				<i class='ion ion-grid'></i>
			</button>
			<button class="btn btn-success btn-xs">
				<i class='glyphicon glyphicon-edit'></i>
			</button>
			<button class="btn btn-danger btn-xs">
				<i class='glyphicon glyphicon-trash '></i>
			</button>
				<!--<a href='adi_prod_list.php' class="btn btn-info btn-xs" style="font-size: 14px">
					<i class='ion ion-grid'></i>
				</a>
			 	<a href='mod_list.php' class="btn btn-success btn-xs" style="font-size: 14px">
			 		<i class='glyphicon glyphicon-edit'></i>
			 	</a> 
			 	<a href='del_prod.php' class="btn btn-danger btn-xs" style="font-size: 14px">
			 		<i class='glyphicon glyphicon-trash '></i>
			 	</a>-->
			</td>
		 </tr>
			<?php 
				} ;
		 	?>

		  
	</table>

