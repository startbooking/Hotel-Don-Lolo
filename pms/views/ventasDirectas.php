<?php 
  require_once '../res/php/app_topHotel.php'; 
  $habitaciones = $hotel->getSeleccionaHabitacionesTipo('1');
?>
  <div class="content-wrapper"> 
    <section class="content" id="listado">
      <div class="container-fluid" style="padding-top:10px 15px;;margin-bottom: 50px">
        <form class="form-horizontal" id="formHuespedes" action="" method="POST">
          <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_PMS?>">              
          <input type="hidden" name="ubicacion" id="ubicacion" value="ventasDirectas"> 
          <input type="hidden" name="folioActivo" id="folioActivo" value="1"> 
          <input type="hidden" name="ingreso" id="ingreso" value="1">
          <h3 style="text-align: center;margin-bottom: 25px" class="w3ls_head tituloPagina">Ventas Directas</h3>
          <div class="panel panel-success panelFolio">
            <div class="panel-heading">
              <div class="panel-title">
                <div class="container-fluid" style="padding:0px;">
                  <div class="col-md-10">
                    <div class="form-group">
                      <label for="identifica" class="col-sm-2 control-label">Identificacion</label>
                      <div class="col-sm-2">
                        <input type="hidden" id="nuevo" name="nuevo" value="1">
                        <input type="hidden" id="idhuesped" name="idhuesped" value="0">
                        <input type="text" class="form-control" id="identifica" placeholder="" value="" required onblur="validaIden()">
                      </div>
                      <label for="apellidos" class="col-sm-1 control-label">Apellidos </label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="apellidos" placeholder="" value="" required="">
                      </div>
                      <label for="nombres" class="col-sm-1 control-label">Nombres </label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="nombres" placeholder="" value="" required="" >
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="nrohabitacion" class="col-sm-2 control-label">Cuenta Maestra</label>
                      <div class="col-sm-2">
                        <select class="form-control" name="nrohabitacion" id="nrohabitacion">

                          <?php 
                            foreach ($habitaciones as $habitacion) { ?>
                              <option value="<?=$habitacion['num_habitacion']?>"
                                <?php 
                                  if($habitacion['num_habitacion']==$numero){?>
                                    selected
                                    <?php 
                                  }
                                ?>
                              ><?=$habitacion['num_habitacion']?></option>
                              <?php 
                            }
                          ?>
                        </select>
                      </div>
                      <label for="llegada" class="col-sm-1 control-label">Llegada</label>
                      <div class="col-sm-2">
                        <input style="line-height: 10px;padding-right: 0;" type="date" class="form-control" name="llegada" id="llegada" readonly="" value="<?= FECHA_PMS?>"> 
                      </div>
                      <label for="noches" class="col-sm-1 control-label">Noches</label>
                      <div class="col-sm-1">
                        <input style="padding-right: 0;" type="number" class="form-control" name="noches" id="noches" readonly="" value='0'>
                      </div>
                      <label for="salida" class="col-sm-1 control-label">Salida</label>
                      <div class="col-sm-2">
                        <input style="line-height: 10px;padding-right: 0;" type="date" class="form-control" name="salida" id="salida" readonly="" value="<?= FECHA_PMS?>">
                      </div>
                    </div>
                  </div> 
                  <div class="col-md-2">
                    <button id="nuevaReserva" style="margin-top: 15px;" type="button" class="btn btn-success btn-block" onclick="ingresaVentaDirecta()"><i class="fa fa-sign-in"></i> Ingresar</button>
                  </div>
                </div>
              </div>
            </div> 
            <div id="datosReserva"></div>
          </div>
        </form> 
      </div>
    </section>
  </div>

