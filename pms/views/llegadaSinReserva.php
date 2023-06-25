  
  
<?php
  $hoy  = FECHA_PMS;
  $manana = strtotime ( '+1 day' , strtotime ( $hoy ) ) ;
  $manana = date ('Y-m-d' , $manana );
?>

<div class="content-wrapper"> 
  <section class="content" style="width: 90%">
    <div id="crearReserva"></div>
    <div class="panel panel-success" id='pantallaNuevaReserva'>
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-6">
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_PMS?>">
            <input type="hidden" name="ubicacion" id="ubicacion" value="llegadaSinReserva">
            <h3 class="w3ls_head tituloPagina"> <i style="color:black;font-size:36px" class="fa fa-briefcase" aria-hidden="true"></i> Huespedes Sin Reserva</h3>
          </div>

        </div> 
        <div id="mensaje"></div>
      </div>
      <form class="form-horizontal" id="formReservas" action="javascript:guardasinReserva()" method="POST">
        <div class="panel-body">
          <div class="form-group">
            <input type="hidden" name="tipoocupacion" value="2">
            <input type="hidden" name="estadoocupacion" value="CA"> 
            <label for="inputEmail3" class="col-sm-2 control-label">Huesped</label>
            <div class="form-group has-success has-feedback col-sm-6" >
              <div class="input-group" style="padding-left:15px;">
                <input type="text" class="form-control" id="buscarHuesped" aria-describedby="inputGroupSuccess4Status">
                <span class="input-group-addon" style="padding:1px;border:none">
                  <a 
                    class="btn btn-info"  
                    data-toggle="modal" 
                    style="padding: 3px 10px"
                    href="#myModalBuscaHuesped">
                    <i class="fa fa-search" aria-hidden="true"></i>
                  </a>
                </span>
              </div>
            </div>
            <div class="col-sm-4" align="right" style="padding-right: 0">
              <a 
                style="height: 30px;padding: 4px 10px;" 
                class="btn btn-success"
                data-toggle="modal" 
                href="#myModalAdicionaPerfil">
                <i class="fa fa-user-plus" aria-hidden="true"></i>
                 Adicionar Huesped
              </a>
            </div>
          </div>
          <div class="divHuesped" id="datosHuespedAdi"></div>
          <div class="form-group">
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
            <div class="col-sm-3">
              <input type="date" class="form-control" name="llegada" id="llegada" required="" value="<?=$hoy?>" readonly min="<?=$hoy?>">
            </div>
            <label for="noches" class="col-sm-1 control-label">Noches</label>
            <div class="col-sm-2">
              <input type="number" class="form-control" name="noches" id="noches" required="" value='1' min='1' onchange="sumarDias()">
            </div>
            <label for="salida" class="col-sm-1 control-label">Salida</label>
            <div class="col-sm-3">
              <input type="date" onblur="restaFechas()" class="form-control" name="salida" id="salida" required="" value="<?=$manana?>">
            </div>
          </div>
          <div class="form-group">
            <label for="hombres" class="col-sm-2 control-label">Hombres</label>
            <div class="col-lg-1 col-md-1" style="padding-right: 5px">
              <input type="number" class="form-control" name="hombres" id="hombres" required="" value="0" min=0>
            </div>
            <label for="mujeres" class="col-sm-1 control-label">Mujeres</label>
            <div class="col-lg-1 col-md-1" style="padding-right: 5px">
              <input type="number" class="form-control" name="mujeres" id="mujeres" required="" value='0' min=0>
            </div>
            <label for="ninos" class="col-sm-1 control-label">Niños</label>
            <div class="col-lg-1 col-md-1" style="padding-right: 5px">
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
              <div id="tarifas">
                <select name="tarifahab" required="" id="tarifahab" onblur="valorHabitacion(this.value)">
                  <option value="">Seleccione la Tarifa</option>
                </select>
              </div>
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
              <select name="origen" id="origen" required="">
                <option value="">Seleccione la Procedencia</option>
                <?php 
                  $ciudades = $hotel->getCiudades();
                  foreach ($ciudades as $ciudad) { ?>
                    <option value="<?=$ciudad['id_ciudad']?>"><?=$ciudad['municipio'].' '.$ciudad['depto']?></option>}
                    option
                    <?php 
                  }
                 ?>
              </select>
            </div>
            <label for="tarifahab" class="col-sm-2 control-label">Destino</label>
            <div class="col-sm-4">
              <select name="destino" id="destino" required="">
                <option value="">Seleccione el Destino</option>
                <?php 
                  $ciudades = $hotel->getCiudades();
                  foreach ($ciudades as $ciudad) { ?>
                    <option value="<?=$ciudad['id_ciudad']?>"><?=$ciudad['municipio'].' '.$ciudad['depto']?></option>}
                    option
                    <?php 
                  }
                 ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="motivo" class="col-sm-2 control-label">Motivo Viaje</label>
            <div class="col-sm-4">
              <select name="motivo" id="motivo" required="">
                <option value="">Seleccione el Motivo</option>
                <?php 
                $motivos = $hotel->getMotivoGrupo('MVI');
                foreach ($motivos as $motivo) { ?>
                  <option value="<?=$motivo['id_grupo']?>"><?=$motivo['descripcion_grupo']?></option>}
                  option
                  <?php 
                }
                 ?>
              </select>
            </div>
            <label for="tarifahab" class="col-sm-2 control-label">Fuente de Reserva</label>
            <div class="col-sm-4">
              <select name="fuente" id="fuente" required="">
                <option value="">Seleccione Fuente</option>
                <?php 
                  $motivos = $hotel->getMotivoGrupo('FRE');
                  foreach ($motivos as $motivo) { ?>
                    <option value="<?=$motivo['id_grupo']?>"><?=$motivo['descripcion_grupo']?></option>}
                    option
                    <?php 
                  }
                 ?>
              </select>
            </div>
          </div>
          <div class="form-group">               
            <label for="tarifahab" class="col-sm-2 control-label">Segmento</label>
            <div class="col-sm-4">
              <select name="segmento" id="segmento" required="">
                <option value="">Seleccione el Segmento</option>
                <?php 
                  $motivos = $hotel->getMotivoGrupo('SME');
                  foreach ($motivos as $motivo) { ?>
                    <option value="<?=$motivo['id_grupo']?>"><?=$motivo['descripcion_grupo']?></option>}
                    option
                    <?php 
                  }
                 ?>
              </select>
            </div>
            <label for="formapago" class="col-sm-2 control-label">Forma de Pago </label>
            <div class="col-sm-4">
              <select name="formapago" id="formapago" required="">
                <option value="">Seleccione La Forma de Pago</option>
                <?php 
                  $codigos = $hotel->getCodigosConsumos(3);
                  foreach ($codigos as $codigo) { ?>
                    <option value="<?=$codigo['id_cargo']?>"><?=$codigo['descripcion_cargo']?></option>
                     option 
                    <?php  
                  }
                   ?>
              </select>
            </div>
          </div>              
          <div class="form-group">
            <label for="motivo" class="col-sm-2 control-label">Observaciones</label>
            <div class="col-sm-10">
              <textarea style="height: 5em !important;min-height: 5em" name="observaciones" id="observaciones" class="form-control"></textarea>
            </div>
            
          </div>                 
        </div>
        <div class="panel-footer">
          <div class="btn-group" style="width: 30%;margin-left:35%">
            <a style="width: 50%" type="button" class="btn btn-warning" href="index"><i class="fa fa-reply"></i> Cancelar</a>
            <button style="width: 50%" class="btn btn-success" align="right"><i class="fa fa-save"></i> Registrar</button>
          </div>     
        </div>
      </form>
    </div>
  </section>
</div>