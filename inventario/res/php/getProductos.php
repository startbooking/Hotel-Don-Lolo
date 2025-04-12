<?php
  
  require '../../../res/php/app_topInventario.php'; 

  $productos = $inven->getProductos();

 ?> 
  <table id="example1" class="table table-bordered">
    <thead>
      <tr class="warning">
        <td>Producto</td>
        <td>Unidad de Compra</td>
        <td>Cantidad</td>
        <td>Valor Total</td>
        <td>Impuesto</td>
        <td>% </td>
        <td>Incluido</td>
      </tr>
    </thead>
    <tbody >
    	<?php 
			  foreach ($productos as $producto) { ?>
			    <tr style='font-size:12px'>
			      <td style="padding:2px 5px" ><input  type="hidden" id="idproducto" name="idproducto"><?php echo $producto['nombre_producto']; ?></td>
			      <td style="padding:2px 5px" >
			      	<select style="font-size:12px;padding: 2px 5px;height: 25px" class="form-control" name="productoEnt" id="productoEnt">
			      		<option value="">Unidad de Entrada</option>
									<?php 
					      	$unidades = $admin->getUnidadesMedida();
					      	foreach ($unidades as $unidad) { ?>
			      				<option value="<?=$unidad['id_unidad']?>"><?=$unidad['descripcion_unidad']?></option>
					      	<?php 
					      	}
									?>
			      	</select>
			      </td>
			      <td style="padding:2px 5px;height: 25px;width: 10%" ><input style="height: 25px" class="form-control" type="number" id='cantidad' name='cantidad'> </td>
			      <td style="padding:2px 5px;height: 25px;width: 15%" ><input style="height: 25px" class="form-control" type="number" id='valorCompra' name='valorCompra'> </td>
			      <td style="padding:2px 5px;height: 25px"  align="center"><input class="" type="checkbox" id='impuesto' name='impuesto'> </td>
			      <td style="padding:2px 5px;height: 25px"  align="center"><input class="form-control" type="text" id='porcentaje' name='porcentaje'> </td>
			      <td  style="padding:2px 5px;height: 25px" align="center"><input class="" type="checkbox" id='incluido' name='incluido'> </td>
			    </tr>
			    <?php 
			  }
    	 ?>
    </tbody>                  
  </table>
