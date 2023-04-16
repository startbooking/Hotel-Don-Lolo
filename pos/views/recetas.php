<?php 
  require '../../res/php/titles.php';
  require '../../res/php/app_topPos.php'; 

	$idamb = $_POST['id'];	 

	$recetas = $pos->getRecetas();

?>
  <section class="content">
    <div class="panel panel-success">
      <div class="panel-heading"> 
        <div class="row producto" style="display: flex;">
          <div class="col-lg-6">
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_POS?>">                  
            <input type="hidden" name="ubicacion" id="ubicacion" value="recetas">
            <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-address-book-o"></i> Recetas Estandar </h3>
          </div>
          <div class="col-lg-6 pull-right">
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
								<?php foreach ($recetas as $producto): ?>
								  <tr style='font-size:12px'>
								    <td><?php echo $producto["nombre_receta"];?></td>
								    <td><?php echo $producto["nombre_seccion"];?></td>
								    <td align="right"><?php echo number_format($producto["valor_costo_porcion"],2);?></td>
								    <td align="right"><?php echo number_format($producto["valor_porcion"],2);?></td>
								    <td align='right'><?php echo number_format($producto["por_costo"],2) ;?> %</td>
								    <td align='center'><?php echo estadoReceta($producto["estado"]);?></td>
								    <td style="width: 12%;text-align: center">
											<!--
											<div class="btn-group" role="group" aria-label="...">
											  <div class="btn-group btn-outline" role="group">
											    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding:2px 10px">
											      Datos Receta
											      <span class="caret"></span>
											    </button>
											    <ul class="dropdown-menu">
											      <li><a 
														onclick='btnRecetaProducto(<?php echo $producto['id_receta']?>)'
											      		href="#"
											      		>Materia Prima</a></li>
											      <li><a href="#">Modificar Receta</a></li>
											      <li><a href="#">Eliminar Receta</a></li>
											    </ul>
											  </div>
											</div>
										-->
                    	<div class="btn-toolbar" role="toolbar">                    	
	                      <div class="btn-group" role="group" aria-label="Basic example">
													<button type="button" 
														id='btnProductos'
														class="btn btn-success btn-xs" 
														receta="<?php echo $producto['nombre_receta']?>" 
														data-id="<?php echo $producto['id_receta']?>"  
														title="Componentes Receta [Materia Prima]"
														onclick='btnRecetaProducto(<?php echo $producto['id_receta']?>,"<?php echo $producto['nombre_receta']?>")'
														>
														<i class='fa fa-pie-chart'></i> 
													</button>
														<!-- 
															data-toggle="modal" 
															data-target="#dataRecetaProducto" 
														-->
												</div>
	                      <div class="btn-group" role="group" aria-label="Basic example">
													<button 
														type="button" 
														class="btn btn-info btn-xs" 
														receta="<?php echo $producto['nombre_receta']?>" 
														title="Modifica Datos de la Receta Estandar"
														onclick='updateReceta(<?php echo $producto['id_receta']?>,"<?php echo $producto['nombre_receta']?>")'
														 >
														<i class='glyphicon glyphicon-edit'></i>
													</button>
													<button type="button" class="btn btn-warning btn-xs" 
														id="btnFoto"
														idreceta="<?php echo $producto['id_receta']?>" 
														receta="<?php echo $producto['nombre_receta']?>" 
														foto="<?php echo $producto['foto']?>" 
														title="Adicionr Foto Receta"
														onclick="subeFoto(<?php echo $producto['id_receta']?>,'<?php echo $producto['nombre_receta']?>','<?php echo $producto['foto']?>')"
														 >
														<i class='fa fa-camera-retro'></i>
													</button>
												</div>
	                      <div class="btn-group" role="group" aria-label="Basic example">
													<button type="button" class="btn btn-danger btn-xs" 
														data-toggle="modal" 
														data-producto="<?php echo $producto['nombre_receta']?>" 
														data-target="#dataDeleteReceta" 
														data-id="<?php echo $producto['id_receta']?>"  
														onclick='btnEliminaReceta(<?php echo $producto['id_receta']?>)'
														>
														<i class='glyphicon glyphicon-trash '></i> 
													</button>
												</div>
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
  include("modal/modalRecetas.php");
?>

