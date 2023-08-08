<?php
require '../../res/php/titles.php';
require '../../res/php/app_topPos.php';

$idamb = $_POST['id'];
$recetas = $pos->getRecetas($idamb);

?>
  <section class="content">
    <div class="panel panel-success">
      <div class="panel-heading"> 
        <div class="row producto">
          <div class="col-lg-6 col-xs-12">
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?php echo BASE_POS; ?>">
            <input type="hidden" name="ubicacion" id="ubicacion" value="recetas">
            <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-address-book-o"></i> Recetas Estandar </h3>
          </div>
          <div class="col-lg-6 col-xs-12 pull-right">
            <a 
              data-toggle="modal" 
              style="margin:10px 0;float: right;" 
              type="button" 
              class="btn btn-success" 
              href="#modalAdicionaReceta"
              >
              <i class="fa fa-plus" aria-hidden="true"></i>
							Adicionar Recetas</a>
          </div>
        </div>
      </div>
      <div class="panel-body">
        <div class="datos_ajax_delete"></div>
          <div class="container-fluid" style="padding:0"> 
						<table id="example1" class="table table-condensed ">
							<thead >
								<tr class="warning">
		              <th>Producto</th>
		              <th>Seccion</th>
		              <th>Valor Costo</th>
		              <th>Precio Venta</th>
		              <th>% Costo</th>
		              <th>Estado</th>
		              <th>Accion</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($recetas as $producto) { ?>
								  <tr style='font-size:12px'>
								    <td><?php echo $producto['nombre_receta']; ?></td>
								    <td><?php echo $producto['nombre_seccion']; ?></td>
								    <td class="t-right"><?php
											if ($producto['valor_costo_porcion'] == '') {
													echo number_format(0, 2);
											} else {
													echo number_format($producto['valor_costo_porcion'], 2);
                                                }
								    ?>
										
									</td>
								    <td class="t-right"><?php echo number_format($producto['valor_porcion'], 2); ?></td>
								    <td class="t-right"><?php echo number_format($producto['por_costo'], 2); ?> %</td>
								    <td class="t-center"><?php echo estadoReceta($producto['estado']); ?></td>
								    <td style="display:flex;">
											<div class="btn-group" role="group" aria-label="Basic example">
												<button type="button" 
													id='btnProductos'
													class="btn btn-success btn-xs" 
													data-receta="<?php echo $producto['nombre_receta']; ?>" 
													data-id="<?php echo $producto['id_receta']; ?>" 
													data-subreceta="<?php echo $producto['subreceta']; ?>" 
													title="Componentes Receta [Materia Prima]"
													onclick='btnRecetaProducto(this)'
													>
													<i class='fa fa-pie-chart'></i> 
												</button>
												<button 
													type="button" 
													class="btn btn-info btn-xs" 
													receta="<?php echo $producto['nombre_receta']; ?>" 
													title="Modifica Datos de la Receta Estandar"
													onclick='updateReceta(<?php echo $producto['id_receta']; ?>,"<?php echo $producto['nombre_receta']; ?>")'
													 >
													<i class='glyphicon glyphicon-edit'></i>
												</button>
												<button type="button" class="btn btn-warning btn-xs" 
													id="btnFoto"
													idreceta="<?php echo $producto['id_receta']; ?>" 
													receta="<?php echo $producto['nombre_receta']; ?>" 
													foto="<?php echo $producto['foto']; ?>" 
													title="Adicionr Foto Receta"
													onclick="subeFoto(<?php echo $producto['id_receta']; ?>,'<?php echo $producto['nombre_receta']; ?>','<?php echo $producto['foto']; ?>')"
													 >
													<i class='fa fa-camera-retro'></i>
												</button>
												<button type="button" class="btn btn-danger btn-xs" 
													data-toggle="modal" 
													data-producto="<?php echo $producto['nombre_receta']; ?>" 
													data-target="#dataDeleteReceta" 
													data-id="<?php echo $producto['id_receta']; ?>"  
													onclick='btnEliminaReceta(<?php echo $producto['id_receta']; ?>)'
													>
													<i class='glyphicon glyphicon-trash '></i> 
												</button>
											</div>
                    	<div class="btn-toolbar" role="toolbar">
											</div>
								    </td>
								  </tr>	
									<?php } ?>
							</tbody>
						</table>
          </div>
      </div>
    </div>
  </section>
<?php
  include 'modal/modalRecetas.php';
?>

