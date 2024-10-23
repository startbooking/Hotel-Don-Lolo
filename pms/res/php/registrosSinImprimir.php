<?php 
	$fecha    = FECHA_PMS;
  $registros = $hotel->registrosHotelerosSinImprimir($fecha); 
?> 
<section class="centrar" style="margin-bottom: 0px;">
  <div class="col-md-12">
  	<div class="alert alert-danger">
    <h4 style="font-weight: 600;text-align:center; color:brown">
      <i class="fa fa-exclamation-triangle fa-2x" aria-hidden="true"></i>
      Actualize la Informacion de los Huesped y luego Imprima los Registros Hoteleros para Continuar la Auditoria</h4>
      <!-- <h4 align="center" style="font-weight: 600;"></h4> -->
    </div>
  	<div class="table-responsive">
      <table id="example1" class="table table-bordered">
        <thead>
          <tr class="warning" style="font-weight: bold">
            <td>Nro Hab.</td>
            <td>Llegada</td>
            <td>Huesped</td>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($registros as $registro) { ?>
            <tr style='font-size:12px'>
              <td><?php echo $registro['num_habitacion']; ?></td>
              <td><?php echo $registro['fecha_llegada']; ?></td>
              <td><?php echo $registro['nombre_completo']; ?></td>
            </tr>
            <?php 
            }
          ?>
        </tbody>
      </table>
    </div>			
  </div>    
</section>  	







