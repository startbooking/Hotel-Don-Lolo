<?php 

	require '../../../../res/php/titles.php';
  require '../../../../res/php/app_topPos.php'; 

  $idamb = $_SESSION['AMBIENTE_ID'];
  $fecha = $pos->getFechaAmbiente($idamb);
  $comandas = $pos->getComandasActivas($idamb,'A');

?>
	<div class="container-fluid" style="padding:0">
		<div class="alert alert-danger" style="padding:0;padding-top:5px;">
			<h4 style="font-weight: 600;text-align:center">Cierre las Comandas Antes de Realizar el Proceso de Auditoria</h4>
		</div>
		<div class="table-responsive">
      <table id="example1" class="table table-bordered">
        <thead>
          <tr class="warning" style="font-weight: bold">
            <td>Comanda</td>
            <td>Mesa</td>
            <td>Pax</td>
            <td>Usuario</td>
            <td>Hora</td>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($comandas as $comanda) { ?>
            <tr style='font-size:12px'>
              <td><?php echo $comanda['comanda']; ?></td>
              <td><?php echo $comanda['mesa']; ?></td>
              <td><?php echo $comanda['pax']; ?></td>
              <td><?php echo $comanda['usuario']; ?></td>
              <td><?php echo substr($comanda['fecha_comanda'],11,5); ?></td>
            </tr>
            <?php 
            }
          ?>
        </tbody>
      </table>
    </div>			
	</div>  	

