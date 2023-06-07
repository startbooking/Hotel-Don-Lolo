<div class="modal fade bs-example-modal-lg" id="myModalAcompanantesReserva" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-md" role="document"> 
    <div class="modal-content"> 
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class='glyphicon glyphicon-off' style="color:#530505"></span></button>
        <h4 class="modal-title" id="myModalLabel">Acompañantes en la Reserva</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" id="idreservaAco" name="idreservaAco">
        <input type="hidden" id="idhuespedAco" name="idhuespedAco">
        <div id="mensajeEliAco"></div>
        <div id="acompanantes"></div>
        <div class="container">
          <input type="hidden" name="numeroReserva" id="numeroReserva">
          <button class="btn btn-primary" type="button" 
            data-toggle="modal" 
            data-target="#myModalAdicionaAcompanante" 
            title="Adicionar Acompañante Reserva">
            <i class="fa fa-plus" aria-hidden="true"></i> Adicionar
          </button>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply" aria-hidden="true"></i> Regresar</button>
      </div>
    </div> 
  </div>
</div>

<div class="modal fade" id="myModalAdicionaAcompanante" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close " data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Adicionar Acompañantes</h4>
      </div>
      <form id="acompananteReserva" class="form-horizontal" action="javascript:guardaAcompanante()">
        <div class="modal-body" style="font-size:12px;">
          <div id="mensajeEli"></div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Documento</label>
            <div class="col-sm-4">
              <input type="hidden" name="idReservaAdiAco" id="idReservaAdiAco">
              <input type="hidden" name="nuevoPax" id="nuevoPax">
              <input type="hidden" name="idHuesAdi" id="idHuesAdi">
              <input type="text" class="form-control" name="identifica" id="identifica" placeholder="Identificacion" onblur="buscaHuespedAcompanante(this.value)" >
            </div>
            <label for="inputEmail3" class="col-sm-1 control-label">Tipo</label>
            <div class="col-sm-4">
              <select name="tipodoc" id='tipodoc'>
                <option value="">Seleccione el Tipo de Documeto</option>
                <?php
                  $tipodocs = $hotel->getTipoDocumento(); ?>
                  <?php foreach ($tipodocs as $tipodoc) { ?>
                    <option value="<?php echo $tipodoc['id_doc']; ?>"><?php echo $tipodoc['descripcion_documento']; ?></option>}
                  <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="apellidos" class="col-sm-2 control-label">1r Apellidos</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="apellido1" id="apellido1" placeholder="1er Apellido" required>
            </div>
            <label for="apellidos" class="col-sm-1 control-label">2o Apellido</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="apellido2" id="apellido2" placeholder="2o Apellido">
            </div>
          </div>
          <div class="form-group">
            <label for="nombres" class="col-sm-2 control-label">1r Nombres</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="nombre1" id="nombre1" placeholder="1er Nombre">
            </div>
            <label for="nombres" class="col-sm-1 control-label">2o Nombre</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="nombre2" id="nombre2" placeholder="2o Nombre">
            </div>
          </div>
          <div class="form-group">
            <label for="fechanace" class="col-sm-2 control-label">Fecha Nac. </label>
            <div class="col-sm-4">
              <input type="date" class="form-control" name="fechanace" id="fechanace" placeholder="" value="">
            </div> 
            <label for="apellidos" class="col-sm-1 control-label">Sexo</label>
            <div class="col-sm-4" style="padding:0px 10px">
              <div class="col-sm-6" style="padding:0;height: 15px">
                <div class="form-check form-check-inline">
                  <input style="margin-top:5px" class="form-check-input" type="radio" name="sexOption" id="inlineRadio1" value="1" checked>
                  <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineRadio1" >Masculino</label>
                </div>                    
              </div>
              <div class="col-sm-6" style="padding:0;height: 15px"> 
                <div class="form-check form-check-inline">
                  <input style="margin-top:5px" class="form-check-input" type="radio" name="sexOption" id="inlineRadio2" value="2">
                  <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineRadio2">Femenino</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="direccion" class="col-sm-2 control-label">Nacionalidad </label>
            <div class="col-sm-4">
              <select name="paices" id="paices" onchange="getCiudadesPais(this.value)">
                <option value="">Seleccione la Nacionalidad</option>
                <?php
                $paices = $hotel->getPaices();
                foreach ($paices as $pais) { ?>
                  <option value="<?php echo $pais['id_pais']; ?>"><?php echo $pais['descripcion']; ?></option>
                  <?php
                }
                ?>
              </select>
            </div>
            <div id="ciudadesPais">
                <label class="col-lg-1 col-md-1 control-label" style="padding-top:0">Ciudad</label>
                <div class="col-sm-4">
                  <select name="ciudad" id='ciudad'>
                    <option value="">Ciudad</option>
                    <?php
                    $ciudades = $hotel->getCiudades();
                foreach ($ciudades as $ciudad) { ?> 
                      <option value="<?php echo $ciudad['id_ciudad']; ?>"><?php echo $ciudad['municipio'].' '.$ciudad['depto']; ?></option>
                      <?php
                }
                ?>
                  </select>
                </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="btn-group">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply" aria-hidden="true"></i> Regresar</button>
            <button type="submit" class="btn btn-primary" ><i class="fa fa-save" aria-hidden="true"></i> Guardar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-lg" id="myModalAcompanantesHistoricoReserva" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-md" role="document"> 
    <div class="modal-content"> 
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class='glyphicon glyphicon-off' style="color:#530505"></span></button>
        <h4 class="modal-title" id="myModalLabel">Acompañantes en la Reserva</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" id="idreservaAco" name="idreservaAco">
        <div id="mensajeEliAco"></div>
        <div id="acompanantesHist"></div>
        <div class="container">
          <input type="hidden" name="numeroReserva" id="numeroReserva">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply" aria-hidden="true"></i> Regresar</button>
      </div>
    </div> 
  </div>
</div>
