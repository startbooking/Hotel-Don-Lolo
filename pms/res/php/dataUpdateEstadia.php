<?php 
  require_once '../../../res/php/titles.php';
  require_once '../../../res/php/app_topHotel.php'; 

  $id      = $_POST['id'];
  $reserva = $hotel->getBuscaReserva($id);
  $huesped = $hotel->getBuscaIdHuesped($reserva[0]['id_huesped']);
  $tipohab = $reserva[0]['tipo_habitacion'];
  $dias    = strtotime(FECHA_PMS) - strtotime($reserva[0]['fecha_llegada']);
  $dias    = $dias / (60*60*24);
  $fecha   = FECHA_PMS;
  $cia     = $hotel->getBuscaCia($reserva[0]['id_compania']);
  $centros = $hotel->getBuscaCentroCia($reserva[0]['idCentroCia']);
?> 
  <div class="panel panel-success">
    <div class="panel-heading" style="padding:5px">
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Documento</label>
        <div class="col-sm-3">
          <input type="hidden" name="numeroReserva" id="numeroReserva" value="<?=$id?>">
          <input type="hidden" name="tipoocupacion" id="tipoocupacion" value="<?=$reserva[0]['tipo_ocupacion']?>">
          <input type="text" class="form-control" name="identifica" id="identifica" value="<?=$huesped[0]['identificacion']?>" readonly="">
        </div>
        <label for="inputEmail3" class="col-sm-2 control-label">Tipo</label>
        <div class="col-sm-3">
          <select name="tipodoc" id="tipodoc" disabled="" readonly>
            <option value="">Seleccione el Tipo de Documeto</option>
            <?php 
              $tipodocs = $hotel->getTipoDocumento();
              foreach ($tipodocs as $tipodoc): ?>
                <option value="<?=$tipodoc['id_doc']?>"  
                  <?php 
                  if($tipodoc['id_doc']==$huesped[0]['tipo_identifica']){ ?>
                    selected=""
                    <?php 
                  } 
                  ?>
                >
                <?=$tipodoc['descripcion_documento']?></option>
                <?php 
              endforeach
            ?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Huesped</label>
        <div class="col-sm-8">
          <input type="hidden" name="idhuesped" id="idhuesped" value="<?=$reserva[0]['id_huesped']?>">
          <input type="text" class="form-control" name="huesped" id="huesped" value="<?=$huesped[0]['nombre_completo']?>" readonly="">
          <input type="hidden" name="idcia" id="idcia" value="<?=$reserva[0]['id_compania']?>">
          <input type="hidden" name="idCentro" id="idCentro" value="<?=$huesped[0]['idCentroCia']?>">
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Empresa</label>
        <div class="col-lg-6 col-md-6">
          <select class="form-control" name="empresaUpd" id="empresaUpd" >
            <option value="0">SIN COMPAÑIA</option>
            <?php
              $companias = $hotel->getCompanias(); 
              foreach ($companias as $compañia) { ?>
                <option value="<?=$compañia['id_compania']?>"
                <?php
                if ($reserva[0]['id_compania'] == $compañia['id_compania']) { ?>
                  selected
                  <?php
                }
                ?>              
                ><?=$compañia['empresa']?></option>
                <?php
              }?>
          </select>
        </div>
      </div>
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
          <input type="date" class="form-control" name="llegada" id="llegada" required="" value="<?=$reserva[0]['fecha_llegada']?>" min='<?=FECHA_PMS?> 'readonly disabled> 
        </div>
        <label for="noches" class="col-sm-1 control-label">Noches</label>
        <div class="col-sm-1"  style="padding:0 5px">
          <input type="number" class="form-control" name="noches" id="noches" required="" value='<?=$reserva[0]['dias_reservados']?>' min='<?=$dias?>' onchange="sumarDias()" onblur="sumarDias()">
        </div>
        <label for="salida" class="col-sm-1 control-label">Salida</label>
        <div class="col-sm-3">
          <input type="date" onblur="restaFechas()" class="form-control" name="salida" id="salida" required="" value="<?=$reserva[0]['fecha_salida']?>" min="<?=$fecha?>">
        </div>
      </div>
      <div class="form-group">
        <label for="hombres" class="col-sm-2 control-label">Hombres</label>
        <div class="col-lg-1 col-md-1" style="padding-right: 5px">
          <input type="number" class="form-control" name="hombres" id="hombres" required="" value="<?=$reserva[0]['can_hombres']?>" min=0 readonly disabled>
        </div>
        <label for="mujeres" class="col-sm-1 control-label">Mujeres</label>
        <div class="col-lg-1 col-md-1" style="padding-right: 5px">
          <input type="number" class="form-control" name="mujeres" id="mujeres" required="" value='<?=$reserva[0]['can_mujeres']?>' min=0 readonly disabled>
        </div>
        <label for="ninos" class="col-sm-1 control-label">Niños</label>
        <div class="col-lg-1 col-md-1" style="padding-right: 5px">
          <input type="number" class="form-control" name="ninos" id="ninos" required="" value="<?=$reserva[0]['can_ninos']?>" min=0 readonly disabled> 
        </div>
        <label for="orden" class="col-sm-1 control-label">Orden Nro</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="orden" id="orden" value="<?=$reserva[0]['orden_reserva']?>">
        </div> 
      </div>
      <div class="form-group">
        <label for="tipohabi" class="col-sm-2 control-label">Tipo Habitacion</label>
        <div class="col-sm-4">
          <select name="tipohabi" id="tipohabi" required onblur="seleccionaHabitacionUpd(this.value,'<?=$reserva[0]['tipo_habitacion']?>','<?=$reserva[0]['num_habitacion']?>')" readonly disabled>
            <?php 
              $tipos = $hotel->getTipoHabitacion();
              foreach ($tipos as $tipo) { ?>
                <option value="<?=$tipo['id']?>"
                  <?php 
                    if($reserva[0]['tipo_habitacion']==$tipo['id']){?>
                      selected
                      <?php 
                    }?>
                  >
                  <?=$tipo['descripcion_habitacion']?>
                </option>
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
            <select name="nrohabitacion" id="nrohabitacion" required onblur='seleccionaTarifasUpd()' readonly disabled>
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
          <div id="tarifas">
            <?php 
              $llega   = $reserva[0]['fecha_llegada'];
              $sale    = $reserva[0]['fecha_salida'];
              $tarifas = $hotel->getSeleccionaTarifa($tipo,$llega,$sale); 
            ?>
            <select name="tarifahab" id="tarifahab" required onblur="valorHabitacionUpd(this.value)" readonly disabled>
              <?php 
                foreach ($tarifas as $tarifa) { ?>
                  <option value="<?=$tarifa['id']?>"
                    <?php 
                      if($reserva[0]['tarifa']==$tarifa['id']){?>
                        selected
                        <?php 
                      }
                    ?>
                    >
                    <?=$tarifa['descripcion_tarifa']?></option>
                  <?php 
                }
              ?>
            </select>
          </div>
        </div>
        <label for="valortar" class="col-sm-2 control-label">Valor Tarifa</label>
        <div class="col-sm-4">
          <div id="valortarifas">
            <input type="text" class="form-control" name="valortarifa" id="valortarifa" required="" value="<?=number_format($reserva[0]['valor_diario'],2)?>" min=0 readonly disabled> 
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="tarifahab" class="col-sm-2 control-label">Procedencia</label>
        <div class="col-sm-4">
          <select name="origen" id="origen" readonly disabled>
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
                  >
                  <?=$ciudad['municipio'].' '.$ciudad['depto']?></option>}
                <?php 
              }
            ?>
          </select>
        </div>
        <label for="tarifahab" class="col-sm-2 control-label">Destino</label>
        <div class="col-sm-4">
          <select name="destino" id="destino" readonly disabled>
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
                >
                <?=$ciudad['municipio'].' '.$ciudad['depto']?></option>}
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
              echo print_r($codigos);
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
        <label for="motivo" class="col-sm-2 control-label">Observaciones</label>
        <div class="col-sm-10">
          <textarea style="height: 5em !important;min-height: 5em" name="observaciones" id="observaciones" class="form-control" rows="4" readonly="" disabled=""><?=$reserva[0]['observaciones']?></textarea>
        </div>
      </div>
      <div class="form-group">
        <label for="tarifahab" class="col-sm-2 control-label">Creada Por</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="createdusr" id="createdusr" value="<?=$reserva[0]['usuario']?>" readonly="">
        </div>
        <label for="formapago" class="col-sm-2 control-label">Fecha - Hora </label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="createdusr" id="createdusr" value="<?=$reserva[0]['fecha_ingreso']?>" readonly="">
        </div>
      </div>
    </div>
    <div class="panel-footer">
      <div class="btn-group" style="width: 30%;margin-left:35%">
        <button style="width: 50%" type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply" aria-hidden="true"></i> Regresar</button>
        <button style="width: 50%" class="btn btn-success"><i class="fa fa-save" aria-hidden="true"></i> Actualizar</button>
      </div>     
    </div>
  </div>