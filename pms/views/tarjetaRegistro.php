<?php 

$llegadas  = $hotel->llegadasDelDiaTRA(FECHA_PMS,'CA');

// echo print_r($llegadas)

/* 
tipo_identificacion = texto
numero_identificacion = numérico
nombres = texto
apellidos = texto
cuidad_residencia = texto
cuidad_procedencia = texto
numero_habitacion = texto
motivo = texto
numero_acompanantes = numerico
check_in = fecha “022-11-11”
check_out = fecha “2022-11-11”
tipo_acomodacion = texto
costo = texto
nombre_establecimiento = texto
rnt_establecimiento =numérico */



?>


<div class="content-wrapper" >
  <div class="container-fluid moduloCentrar">
    <div class="col-lg-10">
      <div class="panel panel-success">
        <div class="panel-heading">
          <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_PMS?>">
          <input type="hidden" name="ubicacion" id="ubicacion" value="home">
          <h3 class="tituloPagina">
          <i class="fa-solid fa-city"></i>
          Huespedes Tarjeta Registro Alojamiento</h3>
        </div>
        <div class="panel-body">
          <table id="example1" class="table modalTable table-condensed">
            <thead>
              <tr class="warning">
                <td>Nro Res</td>
                <td>Hab.</td>
                <td style="text-align:center;">Huesped</td>
                <td style="text-align:center;">Acompañantes</td>
                <td>Tarifa</td>
                <td>Llegada</td>
                <td>Salida</td>
              </tr>
            </thead>
            <tbody id="paginaReservas"> 
              <?php
              foreach ($llegadas as $reserva) { ?>
                <tr style='font-size:12px'>
                  <td><?php echo $reserva['num_reserva']; ?></td>
                  <td style="text-align:right"><?php echo $reserva['num_habitacion']; ?></td>
                  <td>
                    <?php echo $reserva['apellido1'].' '.$reserva['apellido2'].' '.$reserva['nombre1'].' '.$reserva['nombre2']; ?>
                  </td>
                  <td>
                    <?php
                      $acompanas = $hotel->buscaAcompanantes($reserva['num_reserva']);
                      if (count($acompanas) > 0) {
                        foreach ($acompanas as $key => $acompana) { ?>
                          <label><?php echo $acompana['apellido1'].' '.$acompana['apellido2'].' '.$acompana['nombre1'].' '.$acompana['nombre2']; ?> </label>
                          <?php
                        }
                      }
                    ?>
                  </td>
                  <td><?php echo number_format($reserva['valor_diario'],2); ?></td>
                  <td><?php echo $reserva['fecha_llegada']; ?></td>
                  <td><?php echo $reserva['fecha_salida']; ?></td>
                </tr>
                <?php
                } ?>
            </tbody>
          </table>
        </div>
        <div class="panel-footer">
          <div class="row">
            <button class="btn btn-success pull-right mr20"><i class="fa-solid fa-chalkboard-user"></i> Procesar</button>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
