<div class="modal fade bs-example-modal-lg" id="myModalAcompanantesReserva" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class='glyphicon glyphicon-off' style="color:#530505"></span></button>
        <h4 class="modal-title" id="myModalLabel">Acompañantes en la Reserva </h4>
      </div>
      <div class="modal-body">
        <input type="hidden" id="idreservaAco" name="idreservaAco">
        <input type="hidden" id="idhuespedAco" name="idhuespedAco">
        <div id="mensajeEliAco"></div>
        <div id="acompanantes"></div>
        <div class="container-fluid">
          <input type="hidden" name="numeroReserva" id="numeroReserva">
          <button class="btn btn-primary pull-right" type="button"
            data-toggle="modal"
            data-target="#myModalAdicionaAcompanante"
            title="Adicionar Acompañante Reserva">
            <i class="fa fa-plus" aria-hidden="true"></i> Adicionar
          </button>
        </div>
      </div>
      <div class="modal-footer">
        <a href="reservasActivas" class="btn btn-warning btnSaleAco"><i class="fa fa-reply" aria-hidden="true"></i> Regresar</a>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="myModalAdicionaAcompanante" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class='glyphicon glyphicon-off' style="color:#530505"></span>
        </button>
        <h4 class="modal-title" id="myModalLabel"> <i class="fa fa-user-plus"></i> Adiciona Perfil del Huesped</h4>
        <input type="hidden" name="creaReser" id="creaReser" value="0">
        <input type="hidden" name="editaPer" id="editaPer" value="0">
        <input type="hidden" name="paginaviene" id="paginaviene" value="">
        <div class="container-fluid"></div>
      </div>
      <form id="acompananteReserva" class="form-horizontal" style="padding :0px;" action="javascript:guardaAcompanante()">
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-8">
              <span class="col-lg-2">Huesped</span>
              <div class="input-group">
                <input type="text" class="form-control" id="buscarAcoHuesped" placeholder="Buscar Huesped ...">
                <span class="input-group-btn">
                  <button data-toggle="modal" href="#myModalBuscaAcompanaHuesped" style="padding:3px" class="btn btn-default" type="button"><i style="padding:3px 8px" class="fa fa-search" aria-hidden="true"></i></button>
                </span>
              </div>
            </div>
            <div class="col-lg-4 derecha">
              <a class="btn btn-success" data-toggle="modal" data-reserva='1' href="#myModalAdicionaPerfilAcompanante">
                <i class="fa fa-user-plus" aria-hidden="true"></i> Adicionar Huesped
              </a>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="btn-group">
            <button type="button" class="btn btn-warning" id="bntSaleAcompana" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
            <button class="btn btn-success" style="text-align:right;"><i class="fa fa-save"></i> Actualizar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="myModalAdicionaPerfilAcompanante" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class='glyphicon glyphicon-off' style="color:#530505"></span>
        </button>
        <h4 class="modal-title" id="myModalLabel"> <i class="fa fa-user-plus"></i> Adiciona Perfil del Huesped</h4>
        <input type="hidden" name="creaReser" id="creaReser" value="0">
        <input type="hidden" name="editaPer" id="editaPer" value="0">
        <input type="hidden" name="acompana" id="acompana" value="1">
        <input type="hidden" name="paginaviene" id="paginaviene" value="">
        <div class="container-fluid"></div>
      </div>
      <form id="perfilAcompananteReserva" class="form-horizontal" style="padding :0px;" action="javascript:guardaAcompanante()">
        <div class="modal-body">
          <div class="alert alert-warning oculto centro" id="alerta"></div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Documento</label>
            <div class="col-sm-3">
              <input type="hidden" name="idReservaAdiAco" id="idReservaAdiAco">
              <input type="hidden" name="nuevoPax" id="nuevoPax" value="1">
              <input type="hidden" name="idHuesAdi" id="idHuesAdi">
              <input type="text" class="form-control" name="identificaAdiAco" id="identificaAdiAco" placeholder="Identificacion" onblur="buscaHuespedAcompanante(this.value)" required>
            </div>
            <label for="inputEmail3" class="col-sm-2 control-label">Tipo </label>
            <div class="col-sm-3">
              <select name="tipodoc" id="tipodoc" required="">
                <option value="">Seleccione el Tipo de Documento</option>
                <?php
                $tipodocs = $hotel->getTipoDocumento();
                foreach ($tipodocs as $tipodoc) { ?>
                  <option value="<?php echo $tipodoc['id_doc']; ?>"><?php echo $tipodoc['descripcion_documento']; ?></option>
                <?php
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="paisExp" class="col-sm-2 control-label">Expedicion </label>
            <div class="col-sm-3">
              <select name="paisExp" id="paisExp" required="" onblur="ciudadesExpedicion(this.value,'')">
                <option value="">Lugar de Expedicion</option>
                <?php
                foreach ($paices as $pais) { ?>
                  <option value="<?php echo $pais['id_pais']; ?>"><?php echo $pais['descripcion']; ?></option>
                <?php
                }
                ?>
              </select>
            </div>
            <label for="ciudadExpAco" class="col-sm-2 control-label">Ciudad </label>
            <div class="col-sm-3">
              <select name="ciudadExpAco" id="ciudadExpAco" required="">
                <option value="">Ciudad de Expedicion</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="apellidos" class="col-sm-2 control-label">1er Apellidos</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="apellido1" id="apellido1" placeholder="Primer Apellido" required>
            </div>
            <label for="apellidos" class="col-sm-2 control-label">2o Apellidos</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="apellido2" id="apellido2" placeholder="Segundo Apellido">
            </div>
          </div>
          <div class="form-group">
            <label for="nombre1" class="col-sm-2 control-label">1er Nombre</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="nombre1" id="nombre1" placeholder="Primer Nombre" required>
            </div>
            <label for="nombre2" class="col-sm-2 control-label">2o Nombre</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="nombre2" id="nombre2" placeholder="Segundo Nombre">
            </div>
          </div>
          <div class="form-group">
            <label for="correo" class="col-sm-2 control-label">Correo </label>
            <div class="col-sm-4">
              <input type="email" class="form-control" name="correo" id="correo" placeholder="Correo Electronico" required onblur="validateEmail(this.value)">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="btn-group">
            <button type="button" id="btnSaveAco" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
            <button class="btn btn-success" style="text-align:right;"><i class="fa fa-save"></i> Procesar</button>
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
        <input type="hidden" id="idreservaAcoHis" name="idreservaAcoHis">
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


<div class="modal fade" id="myModalBuscaAcompanaHuesped" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form id="guardarDatosRooms" class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span class="glyphicon glyphicon-off"></span>
            </button>
            <h3 class="modal-title" id="exampleModalLabel">Huesped Encontrados</h3>
          </div>
          <div id="datos_ajax_register"></div>
          <div class="modal-body" id="huespedesAcompaEncontrados" style="max-height: 445px;overflow: auto;">
          </div>
          <div class="modal-footer">
            <div class="row">
              <div class="col-lg-4 col-lg-offset-4">
                <button type="button" class="btn btn-warning btn-block" id="btnBuscaAco" data-dismiss="modal"><i class="fa fa-reply" aria-hidden="true"></i> Regresar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>