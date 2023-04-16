<?php 
  require '../../res/php/app_topPos.php'; 
	$idamb     = $_POST['id'];
	$productos = $pos->getProductos($idamb);

?>
  <section class="content">
    <div class="panel panel-success">
      <div class="panel-heading"> 
        <div class="row producto" style="display: flex;">
          <div class="col-lg-6">
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_ADM?>">                  
            <input type="hidden" name="ubicacion" id="ubicacion" value="clientes.php">
            <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-address-book-o"></i> Catalogo Productos de Ventas </h3>
          </div>
          <div class="col-lg-6 pull-right">
            <a 
              data-toggle="modal" 
              style="margin:10px 0;float: right;" 
              type="button" 
              class="btn btn-success" 
              href="#modalAdicionaProducto"
              >
              <i class="fa fa-plus" aria-hidden="true"></i>
               Adicionar Producto</a>
          </div>
        </div>
      </div>
      <div class="panel-body">
        <div class="datos_ajax_delete"></div>
          <div class="container-fluid"> 
						<table id="example1" class="table table-bordered table-hover ">
							<thead >
								<tr class="warning">
		              <th>Producto</th>
		              <th>Seccion</th>
		              <th>Precio Venta</th>
		              <th>Impuesto</th>
		              <th>Tipo Plato</th>
		              <th>Estado</th>
		              <th>Accion</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								foreach ($productos as $producto): ?>
								  <tr style='font-size:12px'>
								    <td><?php echo $producto["nom"];?></td>
								    <td><?php echo $producto["nombre_seccion"];?></td>
								    <td align="right"><?php echo number_format($producto["venta"],2);?></td>
								    <td style="width: 17%;text-align:right"><?php echo $producto["descripcion_cargo"];?></td>
								    <td align='center'><?php echo tipo_prd($producto["tipo_producto"]);?></td>
								    <td align='center'><?php echo estadoProducto($producto["estado"]);?></td>
								    <td style="width: 10%;text-align: center">
                      <div class="btn-group" role="group" aria-label="Basic example">
												<button 
													type          ="button" 
													class         ="btn btn-info btn-xs" 
													data-toggle   ="modal" 
													data-target   ="#dataUpdateProducto" 
													data-id       ="<?php echo $producto['producto_id']?>" 
													data-codigo   ="<?php echo $producto['cod']?>" 
													data-producto ="<?php echo $producto['nom']?>" 
													data-seccion  ="<?php echo $producto['seccion']?>" 
													data-venta    ="<?php echo $producto['venta']?>" 
													data-impto    ="<?php echo $producto['impto']?>" 
													data-tipo     ="<?php echo $producto['estado']?>" 
													title         ="Modifica Datos del Producto"
													onclick       ="updateProducto(<?php echo $producto['producto_id']?>)"
													 >
													<i class='glyphicon glyphicon-edit'></i>
												</button>
												<button 
													type          ="button" 
													class         ="btn btn-danger btn-xs" 
													data-toggle   ="modal" 
													data-producto ="<?php echo $producto['nom']?>" 
													data-target   ="#dataDeleteProducto" 
													data-id       ="<?php echo $producto['producto_id']?>"  
													onclick       ='btnEliminaProducto(<?php echo $producto['producto_id']?>)'
													>
													<i class='glyphicon glyphicon-trash '></i> 
												</button>

											</div>
								    </td>
								  </tr>	
									<?php endforeach ?>
							</tbody>
						</table>
          </div>
      </div>
    </div>
  </section>
<?php 
  include("modal/modalProductos.php");
?>

