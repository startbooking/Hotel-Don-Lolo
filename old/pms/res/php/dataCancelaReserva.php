<?php 
  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
  
  $id      = $_POST['id'];
  $reserva = $hotel->getBuscaReserva($id);
  $huesped = $hotel->getBuscaIdHuesped($reserva[0]['id_huesped']);
  $tipohab = $reserva[0]['tipo_habitacion'];
  $cia     = $hotel->getBuscaCia($reserva[0]['id_compania']);
  $centros = $hotel->getBuscaCentroCia($reserva[0]['idCentroCia']);
 
 ?> 
  <div class="panel panel-success" >
    <div class="panel-heading" style="padding:5px">
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Documento</label>
        <div class="col-sm-3">
          <input type="hidden" name="txtIdReservaCan" id="txtIdReservaCan" value="<?=$id?>">
          <input type="hidden" name="tipoocupacion" id="tipoocupacion" value="<?=$reserva[0]['tipo_ocupacion']?>">
          <input type="text" class="form-control" name="identifica" id="identifica" value="<?=$huesped[0]['identificacion']?>" readonly="">
        </div>
        <label for="inputEmail3" class="col-sm-2 control-label">Tipo</label>
        <div class="col-sm-3">
          <select name="tipodoc" id="tipodoc" disabled="" readonly>
            <option value="">Seleccione el Tipo de Documeto</option>
            <?php 
              $tipodocs = $hotel->getTipoDocumento(); ?>
              <?php foreach ($tipodocs as $tipodoc): ?>
                <option value="<?=$tipodoc['id_doc']?>"  <?php 
                if($tipodoc['id_doc']==$huesped[0]['tipo_identifica']){ ?>
                  selected
                  <?php 
                } 
                ?>>
                <?=$tipodoc['descripcion_documento']?></option>
              <?php endforeach ?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Huesped </label>
        <div class="col-sm-8">
          <input type="hidden" name="idhuesped" id="idhuesped" value="<?=$reserva[0]['id_huesped']?>">
          <input type="text" class="form-control" name="huesped" id="huesped" value="<?=$huesped[0]['nombre_completo']?>" readonly="">
        </div>
      </div> 
      <?php 
        if($reserva[0]['id_compania']!=0){ ?>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Empresa</label>
            <div class="col-sm-6">
              <input type="hidden" name="idcia" id="idcia" value="<?=$reserva[0]['id_compania']?>">
              <input type="text" class="form-control" name="empresa" id="empresa" value="<?=$cia[0]['empresa']?>" disabled="">
            </div>
            <label for="inputEmail3" class="col-sm-1 control-label">Nit</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="nit" id="nit" value="<?=$cia[0]['nit'].'-'.$cia[0]['dv']?>" disabled="">
            </div>
          </div>
          <?php 
            if($reserva[0]['idCentroCia']!=0){ ?> 
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Centro de Costo</label>
                <div class="col-sm-6">
                  <input type="hidden" name="idCentro" id="idCentro" value="<?=$reserva[0]['idCentroCia']?>">
                  <input type="text" class="form-control" name="centroCia" id="centroCia" value="<?=$centros[0]['descripcion_centro']?>" disabled="">
                </div>
              </div>
              <?php 
            } 
          ?>
          <?php 
        }
      ?>
    </div>    
    <div class="panel-body" style="padding:5px">
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Decreto 297</label>
        <div class="col-sm-2">
          <div class="wrap">
            <div class="col-sm-6" style="padding:0;height: 15px">
              <div class="form-check form-check-inline">
                <input style="margin-top:5px" class="form-check-input" type="radio" name="imptoOption" id="inlineRadio1" value="1" 
                <?php  
                  if($reserva[0]['causar_impuesto']==1){ ?>
                    checked
                  <?php 
                  }
                ?>
                >
                <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineRadio1" >NO</label>
              </div>                    
            </div>
            <div class="col-sm-6" style="padding:0;height: 15px"> 
              <div class="form-check form-check-inline">
                <input style="margin-top:5px" class="form-check-input" type="radio" name="imptoOption" id="inlineRadio2" value="2"
                <?php  
                  if($reserva[0]['causar_impuesto']==2){ ?>
                    checked
                  <?php 
                  }
                ?>
                >
                <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineRadio2">SI</label>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="llegada" class="col-sm-2 control-label">Llegada</label>
        <div class="col-sm-3">
          <input type="date" class="form-control" name="llegadaUpd" id="llegadaUpd" required="" value="<?=$reserva[0]['fecha_llegada']?>" min='<?php 
            if($reserva[0]["tipo_reserva"]==2){
              echo $reserva[0]["fecha_llegada"] ;
            }else{
              echo FECHA_PMS;
            }?>'
            <?php 
            if($reserva[0]["tipo_reserva"]==2){ ?>
              disabled="true"
              <?php  
            }
             ?>
            > 
        </div>
        <label for="noches" class="col-sm-1 control-label">Noches</label>
        <div class="col-sm-1"  style="padding:0 5px">
          <input type="number" class="form-control" name="nochesUpd" id="nochesUpd" required="" value='<?=$reserva[0]['dias_reservados']?>' min='1' onchange="sumarDias()" onblur="sumarDias()">
        </div>
        <label for="salida" class="col-sm-2 control-label">Salida</label>
        <div class="col-sm-3">
          <input type="date" onfocus="sumarDias()" onblur="restaFechas()" class="form-control" name="salidaUpd" id="salidaUpd" required="" value="<?=$reserva[0]['fecha_salida']?>">
        </div> 
      </div>
      <div class="form-group">
        <label for="hombres" class="col-sm-2 control-label">Hombres</label>
        <div class="col-sm-1" style='padding-right: 5px'>
          <input type="number" class="form-control" name="hombresUpd" id="hombresUpd" required="" value="<?=$reserva[0]['can_hombres']?>" min=0>
        </div>
        <label for="mujeres" class="col-sm-1 control-label">Mujeres</label>
        <div class="col-sm-1" style='padding-right: 5px'>
          <input type="number" class="form-control" name="mujeresUpd" id="mujeresUpd" required="" value='<?=$reserva[0]['can_mujeres']?>' min=0>
        </div>
        <label for="ninos" class="col-sm-1 control-label">Niños</label>
        <div class="col-sm-1" style='padding-right: 5px'>
          <input type="number" class="form-control" name="ninosUpd" id="ninosUpd" required="" value="<?=$reserva[0]['can_ninos']?>" min=0> 
        </div>
        <label for="orden" class="col-sm-2 control-label">Orden Nro</label>
        <div class="col-sm-3">
          <input type="text" class="form-control" name="orden" id="orden" value="<?=$reserva[0]['orden_reserva']?>">
        </div> 
      </div>
      <div class="form-group">
        <label for="tipohabi" class="col-sm-2 control-label">Tipo Habitacion</label>
        <div class="col-sm-4">
          <select name="tipohabiUpd" id="tipohabiUpd" required onblur="seleccionaHabitacionUpd(this.value,'<?=$reserva[0]['tipo_habitacion']?>','<?=$reserva[0]['num_habitacion']?>')">
            <?php 
              $tipos = $hotel->getTipoHabitacion();
              foreach ($tipos as $tipo) {
                ?>
                <option value="<?=$tipo['id']?>"
                  <?php 
                  if($reserva[0]['tipo_habitacion']==$tipo['id']){?>
                    selected
                    <?php 
                  }
                  ?>
                  ><?=$tipo['descripcion_habitacion']?></option>
                <?php 
              }
            ?>
          </select>
        </div>
        <label for="nrohabitacion" class="col-sm-2 control-label">Nro Habitacion</label>
        <div class="col-sm-4">
          <div id="habitacionesUpd">
          <?php 
            $habitaciones = $hotel->getSeleccionaHabitacionesTipo($tipohab);
            ?>
            <select name="nrohabitacionUpd" id="nrohabitacionUpd" required onblur='seleccionaTarifasUpd()'>
              <?php 
              foreach ($habitaciones as $habitacion) { ?>
                <option value="<?=$habitacion['num_habitacion']?>"
                  <?php 
                  if($habitacion['num_habitacion']==$reserva[0]['num_habitacion']){?>
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
        </div>
      </div>
      <div class="form-group">
        <label for="tarifahab" class="col-sm-2 control-label">Tipo Tarifa</label>
        <div class="col-sm-4">
          <div>
            <?php 
              $llega   = $reserva[0]['fecha_llegada'];
              $sale    = $reserva[0]['fecha_salida'];
              $tarifas = $hotel->getSeleccionaTarifa($tipohab,$llega,$sale);
            ?>
            <select name="tarifahabUpd" id="tarifahabUpd" required onblur="valorHabitacionUpd(this.value)">
              <?php 
              foreach ($tarifas as $tarifa) { ?>
                <option value="<?=$tarifa['id']?>"
                  <?php 
                  if($reserva[0]['tarifa']==$tarifa['id']){?>
                    selected
                    <?php 
                  }
                  ?>
                  ><?=$tarifa['descripcion_tarifa']?></option>
                <?php 
              }
              ?>
            </select>
          </div>
        </div>
        <label for="valortar" class="col-sm-2 control-label">Valor Tarifa</label>
        <div class="col-sm-4">
          <div id="valortarifas">
            <input type="text" class="form-control" name="valortarifaUpd" id="valortarifaUpd" required="" value="<?=number_format($reserva[0]['valor_diario'],2)?>" min=0> 
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="tarifahab" class="col-sm-2 control-label">Procedencia</label>
        <div class="col-sm-4">
          <select name="origen" id="origen">
            <option value="">Seleccione la Ciudad de Procedencia</option>}
            option
            <?php 
              $ciudades = $hotel->getCiudades();
              foreach ($ciudades as $ciudad) { ?>
                <option value="<?=$ciudad['id_ciudad']?>"
                  <?php 
                  if($reserva[0]['origen_reserva']==$ciudad['id_ciudad']){?>
                    selected
                    <?php 
                  }
                  ?>
                  ><?=$ciudad['municipio'].' '.$ciudad['depto']?></option>}
                <?php 
              }
             ?>
          </select>
        </div>
        <label for="tarifahab" class="col-sm-2 control-label">Destino</label>
        <div class="col-sm-4">
          <select name="destino" id="destino">
            <option value="">Seleccione la Ciudad de Destino</option>}
            <?php 
              $ciudades = $hotel->getCiudades();
              foreach ($ciudades as $ciudad) { ?>
                <option value="<?=$ciudad['id_ciudad']?>"
                  <?php 
                  if($reserva[0]['destino_reserva']==$ciudad['id_ciudad']){?>
                    selected
                    <?php 
                  }
                  ?>
                  ><?=$ciudad['municipio'].' '.$ciudad['depto']?></option>}
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
              <option value="<?=$motivo['id_grupo']?>"
              <?php 
                if($reserva[0]['motivo_viaje']==$motivo['id_grupo']){?>
                  selected
                  <?php 
                }
                ?>
                ><?=$motivo['descripcion_grupo']?></option>}
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
                <option value="<?=$motivo['id_grupo']?>"
                <?php 
                  if($reserva[0]['fuente_reserva']==$motivo['id_grupo']){?>
                    selected
                    <?php 
                  }
                  ?>
                  ><?=$motivo['descripcion_grupo']?></option>}
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
                <option value="<?=$motivo['id_grupo']?>"
                  <?php 
                  if($reserva[0]['segmento_mercado']==$motivo['id_grupo']){?>
                    selected
                    <?php 
                  }
                  ?>                  
                ><?=$motivo['descripcion_grupo']?></option>}
                <?php 
              }
             ?>
          </select>
        </div>
        <label for="formapago" class="col-sm-2 control-label">Forma de Pago </label>
        <div class="col-sm-4">
          <select name="formapagoUpd" id="formapagoUpd">
            <option value="">Seleccione La Forma de Pago</option>
            <?php 
              $codigos = $hotel->getCodigosConsumos(3);
              foreach ($codigos as $codigo) { ?>
                <option value="<?=$codigo['id_cargo']?>"
                  <?php 
                    if($reserva[0]['forma_pago']==$codigo['id_cargo']){?>
                      selected
                      <?php 
                    }
                    ?>  
                    ><?=$codigo['descripcion_cargo']?></option>
                <?php  
              }
               ?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-lg-2" for="">Motivo</label>
        <div class="col-lg-6 col-md-6" >
          <select name="motivoCancela" id="motivoCancela" required>
            <option value="">Motivo Cancelacion Reserva</option>
            <?php 
            $motivos = $hotel->getMotivoCancelacion(1);
            foreach ($motivos as $motivo) { ?>
              <option value="<?=$motivo['id_cancela']?>"><?=$motivo['descripcion_motivo']?></option>
              <?php  
            }
            ?>
          </select>
        </div>
      </div>
      <div class="form-group" >
        <label class="control-label col-lg-2" for="">Observaciones</label>
        <div class="col-lg-10 col-md-10" >
          <textarea class="form-control padInput" id="areaObservacionesCan" name="areaObservacionesCan" style="height: 5em !important;min-height: 5em"></textarea>  
        </div>          
      </div>          
    </div>
    <div class="panel-footer">
      <div class="btn-group" style="width: 30%;margin-left:35%">
        <button style="width: 50%" type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply" aria-hidden="true"></i> Regresar</button>
        <button style="width: 50%" class="btn btn-success" align="right"><i class="fa fa-save" aria-hidden="true"></i> Procesar</button>
      </div>           
    </div>
  </div>
