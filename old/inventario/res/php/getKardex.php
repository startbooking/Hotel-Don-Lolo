<?php 

  require '../../../res/php/app_topInventario.php'; 

	$bodega  = $_POST['bodega'];
	$nomBod  = $admin->getNombreBodega($bodega);
	$kardexs = $inven->getTraeKardex($bodega); 
?>
 
<div class="container-fluid"> 
  <table id="example1" class="table table-hover table-bordered table-condensed">
		<div class="alert alert-success" style="background-color: #00a65a4a !important;">
			<h3 style="margin:0px;text-align:center">Kardex <?=$nomBod?></h3>
		</div>
    <thead>
      <tr class="warning">
				<th>Producto</th>
				<th>Unidad</th>
				<th>Entradas</th>
				<th>Salidas</th>
				<th>Saldo</th>
				<th>Promedio</th>
				<th>Valor Total</th>
				<th>Accion</th>
      </tr>
    </thead>
    <tbody>
			<?php foreach ($kardexs as $kardex): ?>
				<tr>
					<td><?=$kardex['nombre_producto']?></td>
					<td><?=$kardex['descripcion_unidad']?></td>
					<td style="text-align: right"><?=number_format($kardex['entradas'],2)?></td>
					<td style="text-align: right"><?=number_format($kardex['salidas'],2)?></td>
					<td style="text-align: right"><?=number_format($kardex['saldo'],2)?></td>
					<td style="text-align: right"><?=number_format($kardex['promedio'],2)?></td>
					<td style="text-align: right"><?=number_format($kardex['promedio']*$kardex['saldo'],2)?></td>

					<td align="center"> 
						<div class="btn-group">
              <button 
								type        = "button" 
								class       = "btn btn-info btn-xs" 
								data-toggle = "modal" 
								data-target = "#modalConsultaKardex"  
								data-id     = "<?php echo $kardex['id_producto']?>"  
								data-bodega = "<?php echo $bodega?>"  
								data-nombre = "<?php echo $kardex['nombre_producto']?>" 
								onclick     = "muestraProductoKardex()" 
								title       = "Muestra Movimientos de Inventario" 
                >
                <i class='glyphicon glyphicon-edit'></i>
              </button>
						</div>
					</td>
				</tr>											
			<?php endforeach ?>
    </tbody>                  
  </table>
</div>
