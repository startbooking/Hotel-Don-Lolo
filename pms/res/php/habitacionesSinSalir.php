<?php
$fecha = FECHA_PMS;
$reservas = $hotel->getSalidasDia($fecha, 2, 'CA');
?> 
<section class="centrar mb-0"> 
  <div class="col-md-12">
		<div class="alert alert-danger mb-0 pd-5">
      <h4 style="font-weight: 600;text-align:center; color:brown">
      <i class="fa fa-exclamation-triangle fa-2x" aria-hidden="true"></i>
       Actualize las Salidas Antes de Realizar el Cierre del Dia</h4>
    </div>
		<div class="table-responsive">
      <table id="example1" class="table table-bordered mb-0">
        <thead>
          <tr class="warning" style="font-weight: bold">
            <td>Nro Hab.</td>
            <td>Huesped</td>
            <td>Salida</td>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($reservas as $sinSalida) { ?>
            <tr style='font-size:12px'>
              <td><?php echo $sinSalida['num_habitacion']; ?></td>
              <td><?php echo $sinSalida['nombre_completo']; ?></td>
              <td><?php echo $sinSalida['fecha_salida']; ?></td>
            </tr>
            <?php
          }
?>
        </tbody>
      </table>
    </div>			
  </div>
</section>







