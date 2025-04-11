<?php 

  require '../../../../res/php/titles.php';
  require '../../../../res/php/app_topHotel.php'; 

	$fecha    = $_POST['fecha'];
	$procesos = $hotel->getProcesoAuditoria();
  $reservas = $hotel->getSalidasDia(FECHA_PMS,2,"CA"); 

  if(count($reservas)>=1){ ?> 
		<div class="container-fluid">
			<div class="alert alert-warning" style="padding:0;padding-top:5px;"><h4 align="center" style="font-weight: 600;">Actualize las Salidas Antes de Realizar el Cierre del Dia</h4></div>
			<div class="table-responsive">
        <table id="example1" class="table table-bordered">
          <thead>
            <tr class="warning" style="font-weight: bold">
              <td>Nro Hab.</td>
              <td>Apellidos</td>
              <td>Nombres</td>
              <td>Salida</td>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($reservas as $sinSalida) { ?>
              <tr style='font-size:12px'>
                <td><?php echo $sinSalida['num_habitacion']; ?></td>
                <td><?php echo $sinSalida['apellidos']; ?></td>
                <td><?php echo $sinSalida['nombres']; ?></td>
                <td><?php echo $sinSalida['fecha_salida']; ?></td>
              </tr>
              <?php 
              }
            ?>
          </tbody>
        </table>
      </div>			
		</div>  	
		<?php 
  }else{
    $activaAud = $hotel->EstadoAuditoriaPMS(1);
    foreach ($procesos as $proceso) {
      if($proceso['estado_proceso']==2){
        if(!empty($proceso['nombre_proceso'])){
          require($proceso['nombre_proceso']); 
        } ?>
        <h4 class="bg-blue-gradient" style="padding:10px">Proceso : <span style="font-size:24px;font-weight: 700;font-family: 'ubuntu'"><?=$proceso['titulo_proceso']?></span> Ejecutado con Exito</h4>         
        <?php 
        $ejecutado = $hotel->updateProcesoAuditoria($proceso['id_proceso'],1);
      }else{ ?>
        <h4 class="bg-red" style="padding:10px">Proceso : <span style="font-size:24px;font-weight: 700;font-family: 'ubuntu'"><?=$proceso['titulo_proceso']?></span> Ya Ejecutado</h4>
      <?php 
      }
      // time_sleep_until(microtime(true)+2);
    } 
    $limpaEstado = $hotel->limpiaProcesosAuditoria();
    $fechanueva  = strtotime ( '+1 day' , strtotime ( $fecha ) ) ;
    $fechanueva  = date ('Y-m-d' , $fechanueva );
    $habitaciones = $hotel->getHabitaciones(CTA_MASTER);
    foreach ($habitaciones as $habitacion) {
      $estadofo = $habitacion['estado_fo'];
      $estadohk = $habitacion['estado_hk'];
      if($estadofo<>'FS' && $estadofo <>'FO'){
        $estadohk = 'S'.substr($estadohk,1,1);
        $estadofo = 'S'.substr($estadofo,1,1);
        $estHabi = $hotel->cambiaEstadoHabitacion($habitacion['numero_hab'],$estadofo);
        ;
      }
    }    
    $cambiaFecha = $hotel->cambiaFechaAuditoria($fechanueva);
    /*
     */
    ?>
    <h4 class="bg-red" align="center" style="font-size:24px;font-weight: 700;font-family: 'ubuntu';padding: 10px">Auditoria Terminada con Exito</h4>
    <?php 
  }
?>







