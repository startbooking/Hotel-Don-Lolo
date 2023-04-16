<div class="modal fade" id="myModalAdicionarPeriodo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="guardarDatosPeriodo" class="form-horizontal" action="javascript:guardaPeriodo()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Adicionar Periodo de Servicio</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensajeAdi"></div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-3 col-md-3"> Descripcion </label>
            <div class="col-lg-8 col-md-8">
              <input type="text" class="form-control" id="nombreAdi" name="nombreAdi" required>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-3 col-md-3">Ambiente</label>
            <div class="col-lg-6 col-md-6">
              <select name="nombreAmbi" id="nombreAmbi" required="">
                <option value="">Seleccione el Ambiente</option>
                <?php 
                foreach ($ambientes as $ambiente) { ?>
                  <option value="<?=$ambiente['id_ambiente']?>"><?=$ambiente['nombre']?></option>
                <?php 
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-3 col-md-3">Hora Inicio </label>
            <div class="col-lg-3 col-md-3">
              <input style="line-height:15px" type="time" class="form-control" id="inicioAdi" name="inicioAdi" required >
            </div>
            <label for="nombre" class="control-label col-lg-2 col-md-2">Hora Final </label>
            <div class="col-lg-3 col-md-3">
              <input style="line-height:15px" type="time" class="form-control" id="finalAdi" name="finalAdi" required >
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar </button>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="myModalModificaPeriodo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="actualizaDatosPeriodo" class="form-horizontal" action="javascript:actualizaPeriodo()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Modifica Periodo de Servicio</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensajeMod"></div>
          <div class="form-group">
            <input type="hidden" name="idPeriodoMod" id="idPeriodoMod">
            <label for="nombre" class="control-label col-lg-3 col-md-3"> Descripcion </label>
            <div class="col-lg-8 col-md-8">
              <input type="text" class="form-control" id="nombreMod" name="nombreMod" required>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-3 col-md-3">Ambiente</label>
            <div class="col-lg-6 col-md-6">
              <select name="nombreAmbiMod" id="nombreAmbiMod" required="">
                <option value="">Seleccione el Ambiente</option>
                <?php 
                foreach ($ambientes as $ambiente) { ?>
                  <option value="<?=$ambiente['id_ambiente']?>"><?=$ambiente['nombre']?></option>
                <?php 
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-3 col-md-3">Hora Inicio </label>
            <div class="col-lg-3 col-md-3">
              <input style="line-height:15px" type="time" class="form-control" id="inicioMod" name="inicioMod" required >
            </div>
            <label for="nombre" class="control-label col-lg-2 col-md-2">Hora Final </label>
            <div class="col-lg-3 col-md-3">
              <input style="line-height:15px" type="time" class="form-control" id="finalMod" name="finalMod" required >
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar </button>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="myModalEliminaPeriodo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="eliminaDatosPeriodo" class="form-horizontal" action="javascript:eliminaPeriodo()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Elimina Periodo de Servicio</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensajeEli"></div>
          <div class="form-group">
            <input type="hidden" name="idPeriodoEli" id="idPeriodoEli">
            <label for="nombre" class="control-label col-lg-3 col-md-3"> Descripcion </label>
            <div class="col-lg-8 col-md-8">
              <input type="text" class="form-control" id="nombreEli" name="nombreEli" disabled>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-3 col-md-3">Ambiente</label>
            <div class="col-lg-6 col-md-6">
              <select name="nombreAmbiEli" id="nombreAmbiEli" disabled="">
                <option value="">Seleccione el Ambiente</option>
                <?php 
                foreach ($ambientes as $ambiente) { ?>
                  <option value="<?=$ambiente['id_ambiente']?>"><?=$ambiente['nombre']?></option>
                <?php 
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-3 col-md-3">Hora Inicio </label>
            <div class="col-lg-3 col-md-3">
              <input style="line-height:15px" type="time" class="form-control" id="inicioEli" name="inicioEli" disabled >
            </div>
            <label for="nombre" class="control-label col-lg-2 col-md-2">Hora Final </label>
            <div class="col-lg-3 col-md-3">
              <input style="line-height:15px" type="time" class="form-control" id="finalEli" name="finalEli" disabled >
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Eliminar </button>
        </div>
      </div>
    </div>
  </form>
</div>
