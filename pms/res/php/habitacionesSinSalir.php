<?php
$fecha = FECHA_PMS;
$reservas = $hotel->getSalidasDia($fecha, 2, 'CA');
?> 
<section class="content centrar" style="margin-bottom: 0px;"> 
  <div class="col-md-12">
		<div class="alert alert-danger">
      <h4 style="font-weight: 600;text-align:center"><i class="fa fa-exclamation-triangle fa-2x" aria-hidden="true"></i>
 Actualize las Salidas Antes de Realizar el Cierre del Dia</h4>
    </div>
		<div class="table-responsive">
      <table id="example1" class="table table-bordered">
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







