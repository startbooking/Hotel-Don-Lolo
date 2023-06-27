<?php 
  $rooms   = $hotel->getHabitacionesMmto(5);
  $motivos = $hotel->getMotivoGrupo('MTO') 
?>

<div class="modal fade" id="myModalAdicionaMantenimiento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="container-fluid" id="adicionaMantenimiento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">   
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="glyphicon glyphicon-off"></span>
          </button> 
          <h3 class="modal-title" id="exampleModalLabel">Ingreso Nuevo Mantenimiento</h3>
        </div>
        <form class="form-horizontal" id="formAdicionaMantenimiento" action="javascript:guardaMantenimiento()" method="POST">
          <div id='mensajeMmto'></div> 
          <div class="modal-body" id="modalReservasIns">
            <div class="form-group">
              <label for="roomAdi" class="col-sm-2 control-label">Habitacion</label>
              <div class="col-sm-2" style='padding-right: 5px'>
                <select name="roomAdi" id="roomAdi">
                  <?php 
                    foreach ($rooms as $room) { ?>
                      <option value="<?=$room['id']?>"><?=$room['numero_hab']?></option>
                      <?php 
                    }
                  ?>                      
                </select>
              </div>
              <label for="desdeFechaAdi" class="col-sm-2 control-label">Desde Fecha</label>
              <div class="col-sm-2" style="padding-right: 5px">
                <input style="padding: 4px;" type="date" class="form-control" name="desdeFechaAdi" id="desdeFechaAdi" required="" value="<?=FECHA_PMS?>" onblur="cambiaFecha()">
              </div>
              <label for="hastaFechaAdi" class="col-sm-2 control-label">Hasta Fecha</label>
              <div class="col-sm-2" style="padding-right: 5px">
                <input style="padding: 4px;" type="date" class="form-control" name="hastaFechaAdi" id="hastaFechaAdi" required="" value="<?=FECHA_PMS?>">
              </div>
            </div>
            <div class="apaga" id="divReserva">
              <div class="table-responsive">
                <div class="alert alert-warning" style="text-align:center;margin:0px;"><h4 style="margin:0px;">Asigne Primero Nueva Habitacion a las Reservas </h4></div> 
                <table id="example1" class="table table-bordered">
                  <thead>
                    <tr class="warning">
                      <td style="text-align:center;">Reserva</td>
                      <td style="text-align:center;">Llegada</td>
                      <td style="text-align:center;">Salida</td>
                      <td style="text-align:center;">Huesped</td>
                    </tr>
                  </thead>
                  <tbody id='huespedesMmto'>
                  </tbody>
                </table>
              </div>
            </div>    
            <div class="form-group">              
              <label for="motivoAdi" class="col-sm-2 control-label">Motivo</label>
              <div class="col-sm-4" style='padding-right: 5px'>
                <select name="motivoAdi" id="motivoAdi" onfocus="traeReservasMmto()">
                  <?php 
                    foreach ($motivos as $motivo) { ?>
                      <option value="<?=$motivo['id_grupo']?>"><?=$motivo['descripcion_grupo']?></option>
                      <?php 
                    }
                  ?>
                </select>
              </div>
              <!-- <label for="inputEmail3" class="col-sm-3 control-label"> Retirar de Inventario </label>
              <div class="col-sm-3 ondisplay">
                <div class="wrap">
                  <div class="col-sm-6" style="padding:0;height: 15px">
                    <div class="form-check form-check-inline">
                      <input style="margin-top:5px" class="form-check-input" type="radio" name="mmtoOption" id="inlineRadio1" value="1" checked>
                      <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineRadio1" >SI</label>
                    </div>                    
                  </div>
                  <div class="col-sm-6" style="padding:0;height: 15px"> 
                    <div class="form-check form-check-inline">
                      <input style="margin-top:5px" class="form-check-input" type="radio" name="mmtoOption" id="inlineRadio2" value="2">
                      <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineRadio2">NO</label>
                    </div>
                  </div>
                </div>
              </div> 
            </div>
            <div class="form-group">
              -->
              <label for="inputEmail3" class="col-sm-2 control-label" style="margin-top:10px;"> Mantenimiento </label>
              <div class="col-sm-4 ondisplay" style="margin-top:10px;font-size:12px;">
                <div class="wrap">
                  <div class="col-sm-6" style="padding:0;height: 15px">
                    <div class="form-check form-check-inline">
                      <input style="margin-top:5px" class="form-check-input" type="radio" name="tipoMmtoOption" id="inlineRadio1" value="1" checked>
                      <label style="margin-top:-20px;margin-left:25px" class="form-check-label" for="inlineRadio1" >Preventivo</label>
                    </div>                    
                  </div>
                  <div class="col-sm-6" style="padding:0;height: 15px"> 
                    <div class="form-check form-check-inline">
                      <input style="margin-top:5px" class="form-check-input" type="radio" name="tipoMmtoOption" id="inlineRadio2" value="2">
                      <label style="margin-top:-20px;margin-left:25px" class="form-check-label" for="inlineRadio2">Correctivo</label>
                    </div>
                  </div>
                </div>
              </div>
              <!-- <label for="presupuestoAdi" class="col-sm-2 control-label">Presupuesto</label>
              <div class="col-sm-3" style="padding-right: 5px">
                <input type="number" class="form-control" name="presupuestoAdi" id="presupuestoAdi" required="" value="0" min="0">
              </div> -->
            </div>
            <div class="form-group">
              <label for="motivo" class="col-sm-2 control-label">Observaciones</label>
              <div class="col-sm-10">
                <textarea style="height: 8em !important;min-height: 8em" name="observacionesAdi" id="observacionesAdi" class="form-control" rows="4"></textarea>
              </div>                    
            </div>                 
          </div>
          <div class="modal-footer">
            <div class="btn-group" style="width: 40%;">
              <button style="width: 50%" type="button" class="btn btn-warning btn-block" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>                  
              <button id="btnMmto" style="width: 50%" class="btn btn-success"><i class="fa fa-save" aria-hidden="true"></i> Guardar</button>
            </div>                 
          </div>
        </form>
      </div>
    </div> 
  </div>
</div>

<div class="modal fade" id="myModalInformacionMmto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">   
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="glyphicon glyphicon-off"></span>
          </button> 
          <h3 class="modal-title" id="exampleModalLabel">Informacion Mantenimiento</h3>
        </div>
        <form class="form-horizontal" id="formInformacionObjetos" action="" method="POST">
          <div class="modal-body" id="infoMtoVer"></div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="myModalAdicionaObservacionesMantenimiento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form id="guardarDatosRooms" class="form-horizontal" action="javascript:adicionaObservacionMmto()" method="POST" enctype="multipart/form-data">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-md" role="document" id="">
        <div class="modal-content">
          <div class="modal-header"> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-off"></span>
            </button> 
            <input type="hidden" name="idObsMto" id="idObsMto">
            <input type="hidden" name="observaAntMto" id="observaAntMto">
            <h3 class="modal-title" id="exampleModalLabel">Observaciones al Manteiniento</h3>

          </div>
          <div class="modal-body">
            <div class="panel panel-success">
              <div class="panel-heading" style="padding:5px;">
                <div class="container-fluid" style="padding:0px;">
                  <div class="form-group">
                    <label for="detalleMmtoObs" class="col-sm-3 control-label">Mantenimiento </label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="detalleMmtoObs" name="detalleMmtoObs" placeholder="" value="" readonly>
                    </div>
                  </div>
                </div>
              </div>
              <div class="panel-body" style="padding:5px">
                <div class="container-fluid" style="padding:0 10px">
                  <h5 style="margin:10px;font-weight: 600;font-size: 14px;font-family: 'Ubuntu'">Observaciones</h5>
                  <div class="col-md-12">
                    <textarea style="text-transform: uppercase;" id="adicionaObsMto" name="adicionaObsMto" value=""></textarea>
                  </div>
                </div>          
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
            <button class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="myModalTerminaMmto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form id="guardarDatosRooms" class="form-horizontal" action="javascript:terminaMmto()" method="POST" enctype="multipart/form-data">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-lg" role="document" id="">
        <div class="modal-content">
          <div class="modal-header"> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-off"></span>
            </button> 
            <input type="hidden" name="idMmtoTer" id="idMmtoTer">
            <input type="hidden" name="observaAntMto" id="observaAntMto">
            <input type="hidden" name="numroom" id="numroom">
            <h3 class="modal-title" id="exampleModalLabel">Termina  Mantenimiento</h3>

          </div>
          <div class="modal-body">
            <div class="panel panel-success">
              <div class="panel-heading" style="padding:5px;">
                <div id="infoMto"></div>
              </div>
              <div class="panel-body" style="padding:5px">
                <div class="form-group">
                  <label for="costoMmto" class="col-sm-3 control-label">Valor Mantenimiento</label>
                  <div class="col-sm-3" style="padding-right: 5px">
                    <input type="number" class="form-control" name="costoMmto" id="costoMmto" required="" value="0" min="0">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
            <button class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="myModalEntregaObjeto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form id="entregaObjetoOlvidado" class="form-horizontal" action="javascript:entregaObjeto()" method="POST" enctype="multipart/form-data">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-md" role="document" id="">
        <div class="modal-content">
          <div class="modal-header"> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-off"></span>
            </button> 
            <input type="hidden" name="idobjetoEnt" id="idobjetoEnt">
            <input type="hidden" name="observaObjEnt" id="observaObjEnt">
            <h3 class="modal-title" id="exampleModalLabel">Entrega Objeto Olvidado</h3>
          </div>
          <div class="modal-body">
            <div class="panel panel-success">
              <div class="panel-heading" style="padding:5px;">
                <div class="container-fluid" style="padding:0px;">
                  <div class="form-group">
                    <label for="objetoObsObj" class="col-sm-2 control-label">Objeto</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="objetoEnt" id="objetoEnt" placeholder="" value="" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="apellidos" class="col-sm-2 control-label">Huesped </label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="huespedEnt" name="huespedEnt" placeholder="" value="" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="ubicacionEnt" class="col-sm-2 control-label">Ubicacion </label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="ubicacionEnt" name="ubicacionEnt" placeholder="" value="" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="entregadoEnt" class="col-sm-2 control-label">Entregado a</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="entregadoEnt" id="entregadoEnt" required="" value=""> 
                    </div>
                  </div>
                  <div class="form-group">  
                    <label for="noches" class="col-sm-2 control-label">Fecha</label>
                    <div class="col-sm-4">
                      <input type="date" class="form-control" name="fechaEnt" id="fechaEnt" required value='<?=FECHA_PMS?>'>
                    </div>
                    <label for="salida" class="col-sm-2 control-label">Entregado por</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="porEnt" id="porEnt" required="" value="">
                    </div>
                  </div>
                </div>
              </div>
              <div class="panel-body" style="padding:5px">
                <div class="container-fluid" style="padding:0 10px">
                  <h5 style="margin:10px;font-weight: 600;font-size: 14px;font-family: 'Ubuntu'">Observaciones</h5>
                  <div class="col-md-12">
                    <textarea style="height: 5em !important;min-height: 5em;text-transform: uppercase;" id="observaEnt" name="observaEnt" value="" rows="4" ></textarea>
                  </div>
                </div>          
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
            <button class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
