<div class="modal fade" id="myModalAdicionaReserva" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">   
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="glyphicon glyphicon-off"></span>
          </button> 
          <h3 class="modal-title" id="exampleModalLabel">Nueva Reserva</h3>
        </div>
        <div class="modal-body" id="modalReservasIns"> 
          <div id="mensaje" style="margin-bottom:-30px"></div>
          <form class="form-horizontal" id="formReservas" action="javascript:guardaReserva()" method="POST">
            <div class="panel panel-success" id='pantallaNuevaReserva'>
              <div class="panel-heading">
                <div class="form-group">
                  <input type="hidden" name="tipoocupacion" value="1">
                  <input type="hidden" name="estadoocupacion" value="ES">
                  <label for="inputEmail3" class="col-sm-2 control-label">Huesped</label>
                  <div class="form-group has-success has-feedback col-sm-5" >
                    <div class="input-group" style="padding-left:15px;">
                      <input type="text" class="form-control" id="buscarHuesped" aria-describedby="inputGroupSuccess4Status" style="background:#FFF">
                      <span class="input-group-addon" style="padding:1px;border:none">
                        <a data-toggle="modal" 
                          href="#myModalBuscaHuesped">
                          <i style="padding:5px 10px" class="fa fa-search" aria-hidden="true"></i>
                        </a>
                      </span>
                    </div>
                  </div>
                  <div class="col-sm-4" align="right" style="padding-right: 0">
                    <a 
                      class="btn btn-success"
                      data-toggle="modal" 
                      href="#myModalAdicionaPerfil">
                      <i class="fa fa-user-plus" aria-hidden="true"></i>  Adicionar Huesped
                    </a>
                  </div>
                </div>
                <div id="datosHuespedAdi"></div>
              </div>
              <div class="panel-body">
                <div class="form-group">
                  <!--
                  <label for="inputEmail3" class="col-sm-2 control-label">Tipo Alojamiento</label>
                  <div class="col-sm-3">
                    <select name="habitacionOption" id="habitacionOption">
                      <option value="1">Habitacion</option>
                      <option value="2">Dormitorio</option>
                      <option value="3">Motor Home</option>
                      <option value="4">Camping</option>
                      <option value="5">Cuenta Maestra</option>
                    </select>
                  </div>
                  -->
                  <label for="inputEmail3" class="col-sm-2 control-label">Decreto 297 </label>
                  <div class="col-sm-2 ondisplay">
                    <div class="wrap">
                      <div class="col-sm-6" style="padding:0;height: 15px">
                        <div class="form-check form-check-inline">
                          <input style="margin-top:5px" class="form-check-input" type="radio" name="imptoOption" id="inlineRadio1" value="1" checked>
                          <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineRadio1" >NO</label>
                        </div>                    
                      </div>
                      <div class="col-sm-6" style="padding:0;height: 15px"> 
                        <div class="form-check form-check-inline">
                          <input style="margin-top:5px" class="form-check-input" type="radio" name="imptoOption" id="inlineRadio2" value="2">
                          <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineRadio2">SI</label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="llegada" class="col-sm-2 control-label">Llegada</label>
                  <div class="col-sm-3" style="padding-right: 20px">
                    <input type="date" class="form-control" name="llegada" id="llegada" required="" value="<?=FECHA_PMS?>" min="<?=FECHA_PMS?>"> 
                  </div>
                  <label for="noches" class="col-sm-1 control-label">Noches</label>
                  <div class="col-sm-2">
                    <input type="number" class="form-control" name="noches" id="noches" required="" value='1' min='1' onchange="sumarDias()">
                  </div>
                  <label for="salida" class="col-sm-1 control-label">Salida</label>
                  <div class="col-sm-3" style="padding-right: 20px">
                    <input type="date" onfocus="sumarDias()" onblur="restaFechas()" class="form-control" name="salida" id="salida" required="" value="<?=FECHA_PMS?>" min="<?=FECHA_PMS?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="hombres" class="col-sm-2 control-label">Hombres</label>
                  <div class="col-sm-1" style='padding-right: 5px'>
                    <input type="number" class="form-control" name="hombres" id="hombres" required="" value="0" min=0>
                  </div>
                  <label for="mujeres" class="col-sm-1 control-label">Mujeres</label>
                  <div class="col-sm-1" style='padding-right: 5px'>
                    <input type="number" class="form-control" name="mujeres" id="mujeres" required="" value='0' min=0>
                  </div>
                  <label for="ninos" class="col-sm-1 control-label">Niños</label>
                  <div class="col-sm-1" style='padding-right: 5px'>
                    <input type="number" class="form-control" name="ninos" id="ninos" required="" value="0" min=0> 
                  </div>
                  <label for="orden" class="col-sm-2 control-label">Orden Nro</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" name="orden" id="orden" value="">
                  </div> 
                </div>
                <div class="form-group">                    
                  <label for="tipohabi" class="col-sm-2 control-label">Tipo Habitacion</label>
                  <div class="col-sm-4">
                    <select name="tipohabi" id="tipohabi" required onblur="seleccionaHabitacion()">
                      <option value="">Seleccione el Tipo de Habitacion</option>
                      <?php 
                        $tipos = $hotel->getTipoHabitacion();
                        foreach ($tipos as $tipo) {?>
                          <option value="<?=$tipo['id']?>"><?=$tipo['descripcion_habitacion']?></option>
                          <?php 
                        }
                      ?>                      
                    </select>
                    <!--
                    <select name="tipohabi" id="tipohabi" required onfocus="asignaTipoHabitacion()" onblur="seleccionaHabitacion()">
                      <option value="">Seleccione el Tipo de Habitacion</option>
                    </select>
                  -->
                  </div>
                  <label for="nrohabitacion" class="col-sm-2 control-label">Nro Habitacion</label>
                  <div class="col-sm-4">
                    <select name="nrohabitacion" id="nrohabitacion" required onblur='seleccionaTarifas()'>
                      <option value="">Seleccione la Habitacion</option>
                    </select>                        
                  </div>
                </div>
                <div class="form-group">
                  <label for="tarifahab" class="col-sm-2 control-label">Tipo Tarifa</label>
                  <div class="col-sm-4">
                      <select name="tarifahab" required="" id="tarifahab" onblur="valorHabitacion(this.value)">
                        <option value="">Seleccione la Tarifa</option>
                      </select>
                    <!--
                    <div id="tarifas">
                      <select name="" required="">
                        <option value="">Seleccione la Tarifa</option>
                      </select>
                    </div>
                  -->
                  </div>
                  <label for="valortar" class="col-sm-2 control-label">Valor Tarifa</label>
                  <div class="col-sm-4">
                    <div id="valortarifas">
                      <input type="text" class="form-control" name="valortar" id="valortar" required="" value="0" min=0> 
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="tarifahab" class="col-sm-2 control-label">Procedencia</label>
                  <div class="col-sm-4">
                    <select name="origen" id="origen">
                      <option value="">Seleccione la Procedencia</option>
                      <?php 
                        $ciudades = $hotel->getCiudades();
                        foreach ($ciudades as $ciudad) { ?>
                          <option value="<?=$ciudad['id_ciudad']?>"><?=$ciudad['municipio'].' '.$ciudad['depto']?></option>}
                          <?php 
                        }
                       ?>
                    </select>
                  </div>
                  <label for="tarifahab" class="col-sm-2 control-label">Destino</label>
                  <div class="col-sm-4">
                    <select name="destino" id="destino">
                      <option value="">Seleccione el Destino</option>
                      <?php 
                        $ciudades = $hotel->getCiudades();
                        foreach ($ciudades as $ciudad) { ?>
                          <option value="<?=$ciudad['id_ciudad']?>"><?=$ciudad['municipio'].' '.$ciudad['depto']?></option>}
                          <?php 
                        }
                       ?>
                    </select>
                  </div>
                </div>            
                <div class="form-group">
                  <label for="motivo" class="col-sm-2 control-label">Motivo Viaje</label>
                  <div class="col-sm-4">
                    <select name="motivo" id="motivo">
                      <option value="">Seleccione el Motivo</option>
                      <?php 
                      $motivos = $hotel->getMotivoGrupo('MVI');
                      foreach ($motivos as $motivo) { ?>
                        <option value="<?=$motivo['id_grupo']?>"><?=$motivo['descripcion_grupo']?></option>}
                        <?php 
                      }
                       ?>
                    </select>
                  </div>
                  <label for="tarifahab" class="col-sm-2 control-label">Fuente de Reserva</label>
                  <div class="col-sm-4">
                    <select name="fuente" id="fuente">
                      <option value="">Seleccione Fuente</option>
                      <?php 
                        $motivos = $hotel->getMotivoGrupo('FRE');
                        foreach ($motivos as $motivo) { ?>
                          <option value="<?=$motivo['id_grupo']?>"><?=$motivo['descripcion_grupo']?></option>}
                          <?php 
                        }
                       ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="tarifahab" class="col-sm-2 control-label">Segmento</label>
                  <div class="col-sm-4">
                    <select name="segmento" id="segmento">
                      <option value="">Seleccione el Segmento</option>
                      <?php 
                        $motivos = $hotel->getMotivoGrupo('SME');
                        foreach ($motivos as $motivo) { ?>
                          <option value="<?=$motivo['id_grupo']?>"><?=$motivo['descripcion_grupo']?></option>}
                          <?php 
                        }
                       ?>
                    </select>
                  </div>
                  <label for="formapago" class="col-sm-2 control-label">Forma de Pago </label>
                  <div class="col-sm-4">
                    <select name="formapago" id="formapago">
                      <option value="">Seleccione La Forma de Pago</option>
                      <?php 
                        $codigos = $hotel->getCodigosConsumos(3);
                        foreach ($codigos as $codigo) { ?>
                          <option value="<?=$codigo['id_cargo']?>"><?=$codigo['descripcion_cargo']?></option>
                          <?php  
                        }
                         ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="motivo" class="col-sm-2 control-label">Observaciones</label>
                  <div class="col-sm-10">
                    <textarea style="height: 5em !important;min-height: 5em" name="observaciones" id="observaciones" class="form-control" rows="4"></textarea>
                  </div>                    
                </div>                 
              </div>
              <div class="panel-footer">
                <div class="btn-group" style="width: 30%;margin-left:35%">
                  <button style="width: 50%" type="button" class="btn btn-warning btn-block" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>                  
                  <button style="width: 50%" class="btn btn-success" align="right"><i class="fa fa-save" aria-hidden="true"></i> Guardar</button>
                </div>     
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade bs-example-modal-lg" id="myModalAdicionaPerfil" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">  
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class='glyphicon glyphicon-off' style="color:#530505"></span>
        </button>
        <h4 class="modal-title" id="myModalLabel"> <i class="fa fa-user-plus"></i> Adiciona Perfil del Huesped</h4>
      </div>
      <form class="form-horizontal" id="formAdicionaHuespedes" action="javascript:guardaHuesped()" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Documento</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="identifica" id="identifica" placeholder="Identificacion" onblur="buscaHuespedActivo(this.value)" required="">
            </div>
            <label for="inputEmail3" class="col-sm-2 control-label">Tipo Documento</label>
            <div class="col-sm-3">
              <select name="tipodoc" id="tipodoc" required="">
                <option value="">Seleccione el Tipo de Documeto</option>
                <?php 
                  $tipodocs = $hotel->getTipoDocumento(); 
                  foreach ($tipodocs as $tipodoc): ?>
                    <option value="<?=$tipodoc['id_doc']?>"><?=$tipodoc['descripcion_documento']?></option>
                    <?php 
                  endforeach 
                ?>
              </select>
            </div>
            <div class="col-sm-2">
              <div style="width: 100%" class="btn-group" role="group" aria-label="Basic example">
                <button 
                  style="width:50%;padding:2px 10px"
                  class="btn btn-primary" 
                  type="button" 
                  data-toggle="modal" 
                  data-target="#myModalFotoIdentificacion" 
                  title="Adiciona Foto Identificacion">
                  <i class="fa fa-camera-retro" aria-hidden="true"></i>
                </button>
                <button 
                  style="width:50%;padding:2px 10px"
                  type="button" 
                  data-toggle="modal" 
                  data-target="#myModalSubirDocumento" 
                  class="btn btn-secondary btn-success">
                  <i class="fa fa-files-o"></i>
                </button>
              </div>
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
            <div class="col-sm-2" style="padding:0">
              <div class="col-sm-6" style="padding:0;height: 15px">
                <div class="form-check form-check-inline">
                  <input style="margin-top:5px" class="form-check-input" type="radio" name="sexOption" id="inlineRadio1" value="1" checked>
                  <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineRadio1" >Masc</label>
                </div>                    
              </div>
              <div class="col-sm-6" style="padding:0;height: 15px"> 
                <div class="form-check form-check-inline">
                  <input style="margin-top:5px" class="form-check-input" type="radio" name="sexOption" id="inlineRadio2" value="2">
                  <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineRadio2">Fem.</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="direccion" class="col-sm-2 control-label">Direccion </label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Direccion" >
            </div>
          </div>
          <div class="form-group">
            <label for="direccion" class="col-sm-2 control-label">Nacionalidad </label>
            <div class="col-sm-4">
              <select name="paices" id="paices" onblur="getCiudadesPais(this.value)" required="">
                <option value="">Seleccione la Nacionalidad</option>
                <?php 
                $paices =  $hotel->getPaices();
                foreach ($paices as $pais) { ?>
                  <option value="<?=$pais['id_pais']?>"><?=$pais['descripcion']?></option>
                  <?php 
                }
                ?> 
              </select>
            </div>
            <div id="ciudadesPais">
              <label class="col-lg-2 col-md-2 control-label" style="padding-top:0">Ciudad</label>
              <div class="col-sm-4">
                <select name="ciudad" id='ciudad'>
                  <option value=""></option>}
                option</select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="telefono" class="col-sm-2 control-label">Telefono</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Telefono">
            </div>
            <label for="celular" class="col-sm-2 control-label">Celular</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="celular" id="celular" placeholder="Nro celular">
            </div>
          </div>
          <div class="form-group">
            <label for="correo" class="col-sm-2 control-label">Correo </label>
            <div class="col-sm-4">
              <input type="email" class="form-control" name="correo" id="correo" placeholder="Correo Electronico" required>
            </div>
            <label for="fechanace" class="col-sm-2 control-label">Fecha Nacimiento </label>
            <div class="col-sm-4">
              <input type="date" class="form-control" name="fechanace" id="fechanace" placeholder="" value="" required="">
            </div>
          </div>
          <div class="form-group">
            <label for="tipohuesped" class="col-sm-2 control-label">Tipo Huesped </label>
            <div class="col-sm-4">
              <select name="tipohuesped" id="tipohuesped" >
              <?php 
                $tipohesps = $hotel->getTipoHuespedes(); 
                foreach ($tipohesps as $tipohesp): ?>
                  <option value="<?=$tipohesp['id_tipo_huesped']?>"><?=$tipohesp['descripcion_tipo']?></option>
                  <?php 
                endforeach 
              ?>
              </select>
            </div>
            <label for="tarifa" class="col-sm-2 control-label">Tarifa </label>
            <div class="col-sm-4">
              <select name="tarifa" id="tarifa">
              <?php 
                $tarifas = $hotel->getTarifasHuespedes(); 
                foreach ($tarifas as $tarifa): ?>
                  <option value="<?=$tarifa['id_tarifa']?>"><?=$tarifa['descripcion_tarifa']?></option>
                  <?php 
                endforeach 
              ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="formapago" class="col-sm-2 control-label">Forma de Pago </label>
            <div class="col-sm-4">
              <select name="formapago" id="formapago">
                <option value="">Seleccione La Forma de Pago</option>
                <?php 
                  $codigos = $hotel->getCodigosConsumos(3);
                  foreach ($codigos as $codigo) { ?>
                    <option value="<?=$codigo['id_cargo']?>"><?=$codigo['descripcion_cargo']?></option>
                    <?php  
                  }
                ?>
              </select>
            </div>
          </div>            
        </div>
        <div class="modal-footer">
          <div class="btn-group" style="width: 30%;margin-left:35%">
            <button style="width: 50%" type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
            <button style="width: 50%" class="btn btn-success" align="right"><i class="fa fa-save"></i> Procesar</button>
          </div>        
        </div>
      </form>
    </div> 
  </div>
</div>

<div class="modal fade" id="myModalBuscaHuesped" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form id="guardarDatosRooms" class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header"> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-off"></span>
            </button> 
            <h3 class="modal-title" id="exampleModalLabel">Huesped Encontrados</h3>
          </div>
          <div id="datos_ajax_register"></div>
          <div class="modal-body" id="huespedesEncontrados">
          </div>
          <div class="modal-footer">
            <div class="row">
              <div class="col-lg-4 col-lg-offset-4" >
                  <button type="button" class="btn btn-warning btn-block" data-dismiss="modal"><i class="fa fa-reply" aria-hidden="true"></i> Regresar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="myModalCalendarioReservas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form id="formCalendario" class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
    <div id="dataCalendario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header"> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-off"></span>
            </button> 
            <h3 class="modal-title" id="exampleModalLabel">Reservas / Salidas Proyectada</h3>
          </div>
          <div id="datos_ajax_register"></div>
          <div class="modal-body" id="huespedesCalendario">
          <div class="table-responsive" style="max-height: 350px;overflow: auto;">
          <table id="tablaCalendario" class="table table-striped table-bordered table-condensed" >
            <thead class="centro b500">
              <tr class="table-success">
                <td>Fecha</td>
                <td>Llegadas</td>
                <td>Salidas</td>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
          </div>
          <div class="modal-footer">
            <div class="row">
              <div class="col-lg-4 col-lg-offset-4" >
                  <button type="button" class="btn btn-warning btn-block" data-dismiss="modal"><i class="fa fa-reply" aria-hidden="true"></i> Regresar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>


