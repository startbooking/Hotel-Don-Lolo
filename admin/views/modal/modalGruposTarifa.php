<div class="modal fade" id="myModalAdicionarGrupoTarifa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="guardarDatosGrupoTar" class="form-horizontal" action="javascript:guardaGrupoTarifa()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-off" aria-hidden="true"></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Adicionar Tarifa</h4>

        </div>
        <div class="modal-body">
          <div id="datos_ajax_register"></div>
          <div id="mensaje"></div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Descripcion </label>
            <div class="col-lg-8 col-md-8">
              <input type="text" class="form-control" id="descripcionAdi" name="descripcionAdi" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal">
          <i class="fa fa-reply" aria-hidden="true"></i> Regresar</button>
          <button type="submit" class="btn btn-primary">
            <i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar </button>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="myModalEliminaGrupoTarifa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="eliminaDatosPaquete" class="form-horizontal" action="javascript:eliminaGrupoTarifa()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Eliminar Grupo de Tarifa</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensajeEli"></div>
          <input type="hidden" name="idTariEli" id="idTariEli">
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Descripcion </label>
            <div class="col-lg-6 col-md-6">
              <input type="text" class="form-control" id="descripcionEli" name="descripcionEli" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal">
            <i class="fa fa-reply" aria-hidden="true"></i> Regresar</button>
          <button type="submit" class="btn btn-primary">
            <i class="fa fa-minus-circle" aria-hidden="true"></i> Eliminar
          </button>
        </div>
      </div>
    </div>
  </form>
</div> 

<div class="modal fade" id="myModalModificaGrupoTarifa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="modificaGrupoTar" class="form-horizontal" action="javascript:actualizaGrupoTarifa()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Modifica Paquete</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensajeMod"></div>
          <input type="hidden" name="idTariMod" id="idTariMod">
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Descripcion </label>
            <div class="col-lg-6 col-md-6">
              <input type="text" class="form-control" id="descripcionMod" name="descripcionMod" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal">
            <i class="fa fa-reply" aria-hidden="true"></i> Regresar</button>
          <button type="submit" class="btn btn-primary">
          <i class="fa fa-save" aria-hidden="true"></i> Actualizar</button>
        </div>
      </div>
    </div> 
  </form> 
</div>

<div class="modal fade" id="myModalTarifasAsociadas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="modificaGrupoTar" class="form-horizontal" action="javascript:actualizaGrupoTarifa()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Tarifas Asociadas</h4>
          
          <button style="margin:10px" class="btn btn-primary pull-right" type="button" 
            data-toggle="modal" 
            data-target="#myModalAdicionarSubTarifa" 
            title="Adicionar Sub Tarifas">
            <i class="glyphicon glyphicon-plus" aria-hidden="true"></i> Adicionar
          </button>

        </div>
        <div class="modal-body">
          <div id="datos_ajax_register"></div>
          <input type="hidden" name="idTariLis" id="idTariLis">
          <input type="hidden" name="idDescrLis" id="idDescrLis">
          <div class="container-fluid">
            <div id="datosTarifa"></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="btnTarifasAsociadas" class="btn btn-warning" data-dismiss="modal">
            <i class="fa fa-reply" aria-hidden="true"></i> Regresar</button>
        </div>
      </div>
    </div>
  </form>
</div>

<!-- Ventanas Sub Tarifas -->
<div class="modal fade" id="myModalAdicionarSubTarifa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="guardarDatosGrupoTar" class="form-horizontal" action="javascript:guardaSubTarifa()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-off" aria-hidden="true"></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Adicionar Tarifa Grupo XXX</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensaje"></div>
          <div class="form-group">
            <input type="hidden" name="idTariAdiMod" id="idTariAdiMod">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Descripcion </label>
            <div class="col-lg-8 col-md-8">
              <input type="text" class="form-control" id="descripcionTarifaAdi" name="descripcionTarifaAdi" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal"> 
            <i class="fa fa-reply" aria-hidden="true"></i> Regresar</button>
          <button type="submit" class="btn btn-primary"> 
            <i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="myModalModificaSubtarifa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="guardarDatosSubTarifa" class="form-horizontal" action="javascript:actualizaSubTarifa()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-off" aria-hidden="true"></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Modifica Sub Tarifa Grupo</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensajeEli"></div>
          <div class="form-group">
            <input type="hidden" name="idTariGruMod" id="idTariGruMod">
            <input type="hidden" name="idSubTariMod" id="idSubTariMod">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Descripcion </label>
            <div class="col-lg-8 col-md-8">
              <input type="text" class="form-control" id="descripcionSubTarifaMod" name="descripcionSubTarifaMod" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal"> 
            <i class="fa fa-reply" aria-hidden="true"></i> Regresar</button>
          <button type="submit" class="btn btn-primary"> 
            <i class="fa fa-pencil-square" aria-hidden="true"></i> Actualizar</button>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="myModalEliminaSubtarifa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="eliminaDatosSubTarifa" class="form-horizontal" action="javascript:eliminaSubTarifa()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
          </button>
          <h4 class="modal-title" id="exampleModalLabel">Elimina Sub Tarifa Grupo</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensaje"></div>
          <div class="form-group">
            <input type="hidden" name="idTariGruEli" id="idTariGruEli">
            <input type="hidden" name="idSubTariEli" id="idSubTariEli">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Descripcion </label>
            <div class="col-lg-8 col-md-8">
              <input type="text" class="form-control" id="descripcionSubTarifaEli" name="descripcionSubTarifaEli" required>
            </div>
          </div> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal">
            <i class="fa fa-reply" aria-hidden="true"></i> Regresar</button>
          <button type="submit" class="btn btn-primary">
            <i class="fa fa-minus-circle" aria-hidden="true"></i>
          Eliminar</button>
        </div>
      </div>
    </div>
  </form>
</div>

<!-- Ventanas VAlores SubTarifas por Tipo de Habitacion -->
<div class="modal fade" id="myModalValoresSubTarifas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="modificaGrupoTar" class="form-horizontal" action="javascript:actualizaGrupoTarifa()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Tarifas Tipos de Habitacion</h4>
          <button style="margin:10px" class="btn btn-primary pull-right" type="button" 
            data-toggle="modal" 
            data-target="#myModalAdicionarValorSubTarifa" 
            title="Adicionar Tarifa Tipo de Habitacion">
            <i class="fa fa-plus-circle" aria-hidden="true"></i> Adicionar
          </button>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <input type="hidden" name="idSubTariLis" id="idSubTariLis">
          <input type="hidden" name="idDescrLis" id="idDescrLis">
          <div class="container-fluid">
            <div id="valoresTarifa"></div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal">
            <i class="fa fa-reply" aria-hidden="true"></i> Regresar</button>
        </div>
      </div>
    </div>
  </form>
</div>

<!-- Ventanas Paquetes Tarifas -->
<div class="modal fade" id="myModalPaquetesSubTarifas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="modificaPaquetesTar" class="form-horizontal" action="javascript:actualizaPaquetesGrupoTarifa()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Paquetes Asociados a la Tarifas</h4>
          <button style="margin:10px" class="btn btn-primary pull-right" type="button" 
            data-toggle="modal" 
            data-target="#myModalAdicionarPaquete" 
            title="Adicionar Paquete Tipo de Habitacion">
            <i class="fa fa-plus-circle" aria-hidden="true"></i> Adicionar
          </button>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <input type="hidden" name="idSubTariLis" id="idSubTariLis">
          <input type="hidden" name="idDescrLis" id="idDescrLis">
          <div class="container-fluid">
            <div id="paquetesTarifa"></div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal">
            <i class="fa fa-reply" aria-hidden="true"></i> Regresar</button>
        </div>
      </div>
    </div>
  </form>
</div>


<div class="modal fade" id="myModalAdicionarValorSubTarifa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="formGuardarValorSubTarifa" class="form-horizontal" action="javascript:guardaValorSubTarifa()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-off" aria-hidden="true"></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Adicionar Tipo de Habitacion a Tarifa </h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensajesubtar"></div>
          <div class="form-group">
            <input type="hidden" name="idSubTariAdiMod" id="idSubTariAdiMod">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Tipo de Habitacion </label>
            <div class="col-lg-8 col-md-8">
              <select name="valTipoHabit" id="valTipoHabit">
                <?php 
                  $tiposHabi = $admin->getTipoHabitacionAct(); 
                  foreach ($tiposHabi as $tipoHabi) { ?> 
                    <option value="<?=$tipoHabi['id']?>"><?=$tipoHabi['descripcion_habitacion']?></option>
                    <?php 
                  }
                 ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Desde </label>
            <div class="col-lg-4 col-md-4">
              <input type="date" style="line-height: 15px;" class="form-control" id="desdeFechaAdi" name="desdeFechaAdi" required> 
            </div>
            <label for="nombre" class="control-label col-lg-2 col-md-2">Hasta </label>
            <div class="col-lg-4 col-md-4">
                <input type="date" style="line-height: 15px;" class="form-control" id="hastaFechaAdi" name="hastaFechaAdi" required> 
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Una Persona </label>
            <div class="col-lg-4 col-md-4">
              <input type="number" min="0" class="form-control" id="valorUnPax" name="valorUnPax" required value="0"> 
            </div>
            <label for="nombre" class="control-label col-lg-2 col-md-2">Dos Persona </label>
            <div class="col-lg-4 col-md-4">
                <input type="number" min="0" class="form-control" id="valorDosPax" name="valorDosPax" required value="0"> 
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Tres Persona </label>
            <div class="col-lg-4 col-md-4">
              <input type="number" min="0" class="form-control" id="valorTresPax" name="valorTresPax" required value="0"> 
            </div>
            <label for="nombre" class="control-label col-lg-2 col-md-2">Cuatro Pers. </label>
            <div class="col-lg-4 col-md-4">
                <input type="number" min="0" class="form-control" id="valorCuatroPax" name="valorCuatroPax" required value="0"> 
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Cinco Persona </label>
            <div class="col-lg-4 col-md-4">
              <input type="number" min="0" class="form-control" id="valorCincoPax" name="valorCincoPax" required value="0"> 
            </div>
            <label for="nombre" class="control-label col-lg-2 col-md-2">Seis Persona </label>
            <div class="col-lg-4 col-md-4">
                <input type="number" min="0" class="form-control" id="valorSeisPax" name="valorSeisPax" required value="0"> 
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Adicional </label>
            <div class="col-lg-4 col-md-4">
              <input type="number" min="0" class="form-control" id="valorAdicional" name="valorAdicional" required value="0"> 
            </div>
            <label for="nombre" class="control-label col-lg-2 col-md-2">Niño </label>
            <div class="col-lg-4 col-md-4">
                <input type="number" min="0" class="form-control" id="valorNino" name="valorNino" required value="0"> 
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal">
            <i class="fa fa-reply" aria-hidden="true"></i> Regresar</button>
          <button type="submit" class="btn btn-primary"> 
            <i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar </button>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="myModalModificaValorSubTarifa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="formActualizaValorSubTarifa" class="form-horizontal" action="javascript:actualizaValorSubTarifa()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-off" aria-hidden="true"></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Modifica Valor a Tarifa </h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <input type="hidden" name="idValSubTariMod" id="idValSubTariMod">
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Tipo de Habitacion </label>
            <div class="col-lg-8 col-md-8">
              <select name="valTipoHabitMod" id="valTipoHabitMod" value="" disabled="">
                <?php 
                  foreach ($tiposHabi as $tipoHabi) { ?> 
                    <option value="<?=$tipoHabi['id']?>"><?=$tipoHabi['descripcion_habitacion']?></option>
                    <?php 
                  }
                 ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Desde </label>
            <div class="col-lg-4 col-md-4">
              <input type="date" style="line-height: 15px;" class="form-control" id="desdeFechaMod" name="desdeFechaMod" required value=""> 
            </div>
            <label for="nombre" class="control-label col-lg-2 col-md-2">Hasta </label>
            <div class="col-lg-4 col-md-4">
                <input type="date" style="line-height: 15px;" class="form-control" id="hastaFechaMod" name="hastaFechaMod" required value=""> 
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Una Persona </label>
            <div class="col-lg-4 col-md-4">
              <input type="number" min="0" class="form-control" id="valorUnPaxMod" name="valorUnPaxMod" required value=""> 
            </div>
            <label for="nombre" class="control-label col-lg-2 col-md-2">Dos Persona </label>
            <div class="col-lg-4 col-md-4">
                <input type="number" min="0" class="form-control" id="valorDosPaxMod" name="valorDosPaxMod" required value=""> 
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Tres Persona </label>
            <div class="col-lg-4 col-md-4">
              <input type="number" min="0" class="form-control" id="valorTresPaxMod" name="valorTresPaxMod" required value=""> 
            </div>
            <label for="nombre" class="control-label col-lg-2 col-md-2">Cuatro Persona </label>
            <div class="col-lg-4 col-md-4">
                <input type="number" min="0" class="form-control" id="valorCuatroPaxMod" name="valorCuatroPaxMod" required value=""> 
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Cinco Persona </label>
            <div class="col-lg-4 col-md-4">
              <input type="number" min="0" class="form-control" id="valorCincoPaxMod" name="valorCincoPaxMod" required value=""> 
            </div>
            <label for="nombre" class="control-label col-lg-2 col-md-2">Seis Persona </label>
            <div class="col-lg-4 col-md-4">
                <input type="number" min="0" class="form-control" id="valorSeisPaxMod" name="valorSeisPaxMod" required value=""> 
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Adicional </label>
            <div class="col-lg-4 col-md-4">
              <input type="number" min="0" class="form-control" id="valorAdicionalMod" name="valorAdicionalMod" required value=""> 
            </div>
            <label for="nombre" class="control-label col-lg-2 col-md-2">Niño </label>
            <div class="col-lg-4 col-md-4">
                <input type="number" min="0" class="form-control" id="valorNinoMod" name="valorNinoMod" required value=""> 
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal">
            <i class="fa fa-reply" aria-hidden="true"></i> Regresar</button>
          <button type="submit" class="btn btn-primary"> 
            <i class="fa fa-floppy-o" aria-hidden="true"></i> Actualizar </button>
        </div>
      </div>
    </div>
  </form>
</div>

<!-- 
<div class="modal fade" id="myModalModificaValorSubTarifa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="formActualizaValorSubTarifa" class="form-horizontal" action="javascript:actualizaValorSubTarifa()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-off" aria-hidden="true"></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Modifica Valor a Tarifa </h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <input type="hidden" name="idValSubTariMod" id="idValSubTariMod">

          <div id="mensajesubtar"></div>
          <div id="valorTarifaMod"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal">
            <i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Regresar</button>
          <button type="submit" class="btn btn-primary"> 
            <i class="fa fa-floppy-o" aria-hidden="true"></i> Actualizar Datos</button>
        </div>
      </div>
    </div>
  </form>
</div>
--> 

<div class="modal fade" id="myModalEliminaValorSubtarifa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="formActualizaValorSubTarifa" class="form-horizontal" action="javascript:eliminarValorSubTarifa()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-off" aria-hidden="true"></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Elimina Valor a Tarifa </h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <input type="hidden" name="idValSubTariEli" id="idValSubTariEli">
          <div id="mensajesubtar"></div>
          <div id="valorTarifaEli"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal">
            <i class="fa fa-reply" aria-hidden="true"></i> Regresar</button>
          <button type="submit" class="btn btn-primary"> 
            <i class="fa fa-floppy-o" aria-hidden="true"></i> Elimina</button>
        </div>
      </div>
    </div>
  </form>
</div>
