<?php
require '../../res/php/titles.php';
require '../../res/php/app_topPos.php';
$clientes = $pos->getClientes();

?>

<section class="content">
  <div class="panel panel-success">
    <div class="panel-heading"> 
      <div class="row">
        <div class="col-lg-6 col-xs-12">
          <input type="hidden" name="rutaweb" id="rutaweb" value="<?php echo BASE_ADM; ?>">                  
          <input type="hidden" name="ubicacion" id="ubicacion" value="clientes()">
          <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-address-book-o"></i> Catalogo de Clientes </h3>
        </div>
        <div class="col-lg-6  col-xs-12 pull-rigth">
          <a 
            data-toggle="modal"  
            style="margin:10px 0;float: right;" 
            type="button" 
            class="btn btn-success" 
            href="#modalAdicionaCliente"
            >
            <i class="fa fa-user-plus" aria-hidden="true"></i>
             Adicionar Cliente</a>
        </div>
      </div>
    </div>
    <div class="panel-body">
      <div class="datos_ajax_delete"></div>
        <div class="container-fluid"> 
					<table id="example1" class="table table-bordered">
						<thead >
							<tr class="warning">
	              <th>Ident.</th>
	              <th>Cliente</th>
	              <th>Direccion</th>
	              <th>Movil</th>
	              <th>Correo </th>
	              <th>Estado </th>
	              <th>Accion</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($clientes as $cliente) { ?>
							 	<tr style='font-size:12px'>
							    <td><?php echo $cliente['identificacion']; ?></td>
							    <td><?php echo $cliente['apellido1'].' '.$cliente['apellido2'].' '.$cliente['nombre1'].' '.$cliente['nombre2']; ?></td>
							    <td><?php echo $cliente['direccion']; ?></td>
							    <td><?php echo $cliente['celular']; ?></td>
							    <td><?php echo $cliente['email']; ?></td>
							    <td style="text-align:center;"> 
							   		<button type="button" class="btn btn-success btn-xs" onclick="desactiva_usuario(<?php echo $cliente['id_cliente']; ?>)">	
							   			<?php echo estado_cliente($cliente['estado']); ?>
							   		</button>
							   	</td> 
							   	<td style="text-align:center;'>
							   		<div class="btn-group">
											<button 
												type="button" class="btn btn-info btn-xs" 
												data-toggle="modal" 
												data-target="#dataUpdateCliente" 
												data-id="<?php echo $cliente['id_cliente']; ?>" 
												data-identificacion="<?php echo $cliente['identificacion']; ?>" 
												data-cliente="<?php echo $cliente['apellido1'].' '.$cliente['apellido2'].' '.$cliente['nombre1'].' '.$cliente['nombre2']; ?>" 
												data-direccion="<?php echo $cliente['direccion']; ?>" 
												data-telefono="<?php echo $cliente['telefono']; ?>" 
												data-celular="<?php echo $cliente['celular']; ?>"
												data-correo="<?php echo $cliente['email']; ?>"
												title="Modifica Datos del Cliente"
												onclick="updateCliente(<?php echo $cliente['id_cliente']; ?>)"
												 >
												<i class='glyphicon glyphicon-edit'></i>
											</button>
											<button type="button" class="btn btn-danger btn-xs" 
												data-toggle="modal" 
												data-target="#dataDeleteCliente" 
												data-id="<?php echo $cliente['id_cliente']; ?>"  
												data-cliente="<?php echo $cliente['apellido1'].' '.$cliente['apellido2'].' '.$cliente['nombre1'].' '.$cliente['nombre2']; ?>" 
												onclick='btnEliminaCliente("<?php echo $cliente['id_cliente']; ?>")'
												>
												<i class='glyphicon glyphicon-trash '></i> 
											</button>
											
							   		</div>	
							   	</td>
							 	</tr>
								<?php
							} ?>
						</tbody>
					</table>
        </div>
    </div>
  </div>
</section>
<?php
    include 'modal/modalClientes.php';
?>

	