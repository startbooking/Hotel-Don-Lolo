<div class="modal fade" id="myModalAdicionaObjeto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">   
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="glyphicon glyphicon-off"></span>
          </button> 
          <h3 class="modal-title" id="exampleModalLabel">Ingreso Nuevo Objeto Olvidado</h3>
        </div>
        <form class="form-horizontal" id="formAdicionaObjetos" action="javascript:guardaObjeto()" method="POST">
          <div class="modal-body" id="modalReservasIns"> 
            <div class="form-group">
              <label for="llegada" class="col-sm-2 control-label">Objeto Encontrado</label>
              <div class="col-sm-6" style="padding-right: 5px">
                <input type="text" class="form-control" name="objetoEnc" id="objetoEnc" required="" value="" > 
              </div>
               <label for="salida" class="col-sm-1 control-label">Fecha</label>
              <div class="col-sm-3">
                <input style="padding:5px" type="date" class="form-control" name="fechaEnc" id="fechaEnc" required="" value="<?=FECHA_PMS?>">
              </div>
            </div>
            <div class="form-group">
              <label for="ninos" class="col-sm-2 control-label">Habitacion</label>
              <div class="col-sm-2" style='padding-right: 5px'>
                <select name="roomEnc" id="roomEnc">
                  <?php 
                    $rooms = $hotel->getHabitaciones(5);
                    foreach ($rooms as $room) { ?>
                      <option value="<?=$room['id']?>"><?=$room['numero_hab']?></option>
                      <?php 
                    }
                  ?>                      
                </select>
              </div>
              <label for="hombres" class="col-sm-1 control-label">Lugar</label>
              <div class="col-sm-3" style='padding-right: 5px'>
                <input type="text" class="form-control" name="lugarEnc" id="lugarEnc" required="" value="">
              </div>
              <label for="orden" class="col-sm-1 control-label">Estado</label>
              <div class="col-sm-3">
                <input type="text" class="form-control" name="estadoEnc" id="estadoEnc" value="">
              </div>
            </div>
            <div class="form-group">
              <label for="mujeres" class="col-sm-2 control-label">Huesped</label>
              <div class="col-sm-4" style='padding-right: 5px'>
                <select name="huespedEnc" id="huespedEnc" >
                  <?php 
                    $huespedes = $hotel->getHuespedesActivos();
                    foreach ($huespedes as $huesped) { ?>
                      <option value="<?=$huesped['id_huesped']?>"><?=$huesped['nombre_completo']?></option>
                      <?php 
                    }
                  ?>
                </select>
              </div>
              <label for="encontradoEnc" class="col-sm-2 control-label">Encontrado Por</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" name="encontradoEnc" id="encontradoEnc" required="" value=''>
              </div>
            </div>
            <div class="form-group">                    
              <label for="tipohabi" class="col-sm-2 control-label">Lugar Almacenado</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" name="almacenadoEnc" id="almacenadoEnc" required="" value=''>
              </div>
            </div>
            <div class="form-group">
              <label for="motivo" class="col-sm-2 control-label">Observaciones</label>
              <div class="col-sm-10">
                <textarea style="height: 5em !important;min-height: 5em" name="observacionesEnc" id="observacionesEnc" class="form-control" rows="4"></textarea>
              </div>                    
            </div>                 
          </div>
          <div class="modal-footer">
            <div class="btn-group" style="width: 30%;margin-left:35%">
              <button style="width: 50%" type="button" class="btn btn-warning btn-block" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>                  
              <button style="width: 50%" class="btn btn-success" align="right"><i class="fa fa-save" aria-hidden="true"></i> Guardar</button>
            </div>                 
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="myModalInformacionObjeto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">   
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="glyphicon glyphicon-off"></span>
          </button> 
          <h3 class="modal-title" id="exampleModalLabel">Informacion Objeto Olvidado</h3>
        </div>
        <form class="form-horizontal" id="formInformacionObjetos" action="" method="POST">
          <div class="modal-body" id="modalObjetoInf"> 
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="myModalAdicionaObservacionesObjeto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form id="guardarDatosRooms" class="form-horizontal" action="javascript:adicionaObservacionObjeto()" method="POST" enctype="multipart/form-data" style="font-size:11px">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-md" role="document" id="">
        <div class="modal-content">
          <div class="modal-header"> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-off"></span>
            </button> 
            <input type="hidden" name="objetoObs" id="objetoObs">
            <input type="hidden" name="observaAntObj" id="observaAntObj">
            <h3 class="modal-title" id="exampleModalLabel">Observaciones al Objeto Olvidado</h3>
          </div>
          <div class="modal-body">
            <div class="panel panel-success">
              <div class="panel-heading" style="padding:5px;">
                <div class="container-fluid" style="padding:0px;">
                  <div class="form-group">
                    <label for="objetoObsObj" class="col-sm-2 control-label">Objeto</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="objetoObsObj" id="objetoObsObj" placeholder="" value="" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="apellidos" class="col-sm-2 control-label">Huesped </label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="huespedObsObj" name="huespedObsObj" placeholder="" value="" readonly>
                    </div>
                  </div>
                  <!--
                  <div class="form-group">
                    <label for="llegada" class="col-sm-2 control-label">Llegada</label>
                    <div class="col-sm-3">
                      <input type="text" class="form-control" name="llegadaObs" id="llegadaObs" readonly="" value=""> 
                    </div>
                    <label for="noches" class="col-sm-1 control-label">Noches</label>
                    <div class="col-sm-2">
                      <input type="text" class="form-control" name="nochesObs" id="nochesObs" readonly="" value=''>
                    </div>
                    <label for="salida" class="col-sm-1 control-label">Salida</label>
                    <div class="col-sm-3">
                      <input type="text" class="form-control" name="salidaObs" id="salidaObs" readonly="" value="">
                    </div>
                  </div>
                -->
                </div>
              </div>
              <div class="panel-body" style="padding:5px">
                <div class="container-fluid" style="padding:0 10px">
                  <h5 style="margin:10px;font-weight: 600;font-size: 14px;font-family: 'Ubuntu'">Observaciones</h5>
                  <div class="col-md-12" style="padding:0">
                    <textarea style="text-transform: uppercase;" id="adicionaObsObj" name="adicionaObsObj" value=""></textarea>
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
                  <div class="col-md-12" style="padding:0px;">
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
