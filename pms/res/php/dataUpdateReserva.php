<?php
require '../../../res/php/titles.php';
require '../../../res/php/app_topHotel.php';

$id = $_POST['id'];
$reserva = $hotel->getBuscaReserva($id);
$llega = $reserva[0]['fecha_llegada'];
$sale = $reserva[0]['fecha_salida'];
$huesped = $hotel->getBuscaIdHuesped($reserva[0]['id_huesped']);
$tipohab = $reserva[0]['tipo_habitacion'];
$cia = $hotel->getBuscaCia($reserva[0]['id_compania']);
$tipodocs = $hotel->getTipoDocumento();
$tipos = $hotel->getTipoHabitacion();
$ciudades = $hotel->getCiudades();
$habitaciones = $hotel->getSeleccionaHabitacionesTipo($tipohab);
$tarifas = $hotel->getSeleccionaTarifa($tipohab, $llega, $sale);

?> 
  <div class="panel panel-success" >
    <div class="panel-heading" style="padding:5px">
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Documento</label>
        <div class="col-sm-3">
          <input type="hidden" name="numeroReserva" id="numeroReserva" value="<?php echo $id; ?>">
          <input type="hidden" name="tipoocupacion" id="tipoocupacion" value="<?php echo $reserva[0]['tipo_ocupacion']; ?>">
          <input type="text" class="form-control" name="identifica" id="identifica" value="<?php echo $huesped[0]['identificacion']; ?>" readonly="">
        </div>
        <label for="inputEmail3" class="col-sm-2 control-label">Tipo</label>
        <div class="col-sm-3">
          <select name="tipodoc" id="tipodoc" disabled="" readonly>
            <option value="">Seleccione el Tipo de Documeto</option>
            <?php
               foreach ($tipodocs as $tipodoc) { ?>
                  <option value="<?php echo $tipodoc['id_doc']; ?>"  <?php
                 if ($tipodoc['id_doc'] == $huesped[0]['tipo_identifica']) { ?>
                    selected
                    <?php
                 }
                   ?>>
                <?php echo $tipodoc['descripcion_documento']; ?></option>
              <?php } ?>
          </select>
        </div> 
      </div>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Huesped </label>
        <div class="col-sm-8">
          <input type="hidden" name="idhuesped" id="idhuesped" value="<?php echo $reserva[0]['id_huesped']; ?>">
          <input type="text" class="form-control" name="huesped" id="huesped" value="<?php echo $huesped[0]['nombre_completo']; ?>" readonly="">
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
            if ($reserva[0]['causar_impuesto'] == 1) { ?>
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
  if ($reserva[0]['causar_impuesto'] == 2) { ?>
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
          <input type="date" class="form-control" name="llegadaUpd" id="llegadaUpd" required="" value="<?php echo $reserva[0]['fecha_llegada']; ?>" min='<?php
            if ($reserva[0]['tipo_reserva'] == 2) {
                echo $reserva[0]['fecha_llegada'];
            } else {
                echo FECHA_PMS;
            }?>'
            <?php
            if ($reserva[0]['tipo_reserva'] == 2) { ?>
              disabled="true"
              <?php
            }
?>
            > 
        </div>
        <label for="noches" class="col-sm-1 control-label">Noches</label>
        <div class="col-sm-1"  style="padding:0 5px">
          <input type="number" class="form-control" name="nochesUpd" id="nochesUpd" required="" value='<?php echo $reserva[0]['dias_reservados']; ?>' min='1' onchange="sumarDias()" onblur="sumarDias()">
        </div>
        <label for="salida" class="col-sm-2 control-label">Salida</label>
        <div class="col-sm-3">
          <input type="date" onfocus="sumarDias()" onblur="restaFechas()" class="form-control" name="salidaUpd" id="salidaUpd" required="" value="<?php echo $reserva[0]['fecha_salida']; ?>">
        </div> 
      </div>
      <div class="form-group">
        <label for="hombres" class="col-sm-2 control-label">Hombres</label>
        <div class="col-sm-1" style='padding-right: 5px'>
          <input type="number" class="form-control" name="hombresUpd" id="hombresUpd" required="" value="<?php echo $reserva[0]['can_hombres']; ?>" min=0>
        </div>
        <label for="mujeres" class="col-sm-1 control-label">Mujeres</label>
        <div class="col-sm-1" style='padding-right: 5px'>
          <input type="number" class="form-control" name="mujeresUpd" id="mujeresUpd" required="" value='<?php echo $reserva[0]['can_mujeres']; ?>' min=0>
        </div>
        <label for="ninos" class="col-sm-1 control-label">Niños</label>
        <div class="col-sm-1" style='padding-right: 5px'>
          <input type="number" class="form-control" name="ninosUpd" id="ninosUpd" required="" value="<?php echo $reserva[0]['can_ninos']; ?>" min=0> 
        </div>
        <label for="orden" class="col-sm-2 control-label">Orden Nro</label>
        <div class="col-sm-3">
          <input type="text" class="form-control" name="orden" id="orden" value="<?php echo $reserva[0]['orden_reserva']; ?>">
        </div> 
      </div>
      <div class="form-group">
        <label for="tipohabi" class="col-sm-2 control-label">Tipo Habitacion</label>
        <div class="col-sm-4">
          <select name="tipohabiUpd" id="tipohabiUpd" required onblur="seleccionaHabitacionUpd(this.value,'<?php echo $reserva[0]['tipo_habitacion']; ?>','<?php echo $reserva[0]['num_habitacion']; ?>')">
            <?php
 foreach ($tipos as $tipo) {
     ?>
                <option value="<?php echo $tipo['id']; ?>"
                  <?php
       if ($reserva[0]['tipo_habitacion'] == $tipo['id']) {?>
                    selected
                    <?php
       }
     ?>
                  ><?php echo $tipo['descripcion_habitacion']; ?></option>
                <?php
 }
?>
          </select>
        </div>
        <label for="nrohabitacion" class="col-sm-2 control-label">Nro Habitacion</label>
        <div class="col-sm-4">
          <div id="habitacionesUpd">
          <?php
?>
            <select name="nrohabitacionUpd" id="nrohabitacionUpd" required onblur='seleccionaTarifasUpd()'>
              <?php
  foreach ($habitaciones as $habitacion) { ?>
                <option value="<?php echo $habitacion['num_habitacion']; ?>"
                  <?php
      if ($habitacion['num_habitacion'] == $reserva[0]['num_habitacion']) {?>
                    selected
                    <?php
      }
      ?>
                  ><?php echo $habitacion['num_habitacion']; ?></option>
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
?>
            <select name="tarifahabUpd" id="tarifahabUpd" required onblur="valorHabitacionUpd(this.value)">
              <?php
  foreach ($tarifas as $tarifa) { ?>
                <option value="<?php echo $tarifa['id']; ?>"
                  <?php
      if ($reserva[0]['tarifa'] == $tarifa['id']) {?>
                    selected
                    <?php
      }
      ?>
                  ><?php echo $tarifa['descripcion_tarifa']; ?></option>
                <?php
  }
?>
            </select>
          </div>
        </div>
        <label for="valortar" class="col-sm-2 control-label">Valor Tarifa</label>
        <div class="col-sm-4">
          <div id="valortarifas">
            <input type="text" class="form-control" name="valortarifaUpd" id="valortarifaUpd" required="" value="<?php echo number_format($reserva[0]['valor_diario'], 2); ?>" min=0> 
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
foreach ($ciudades as $ciudad) { ?>
                <option value="<?php echo $ciudad['id_ciudad']; ?>"
                  <?php
    if ($reserva[0]['origen_reserva'] == $ciudad['id_ciudad']) {?>
                    selected
                    <?php
    }
    ?>
                  ><?php echo $ciudad['municipio'].' '.$ciudad['depto']; ?></option>}
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
 foreach ($ciudades as $ciudad) { ?>
                <option value="<?php echo $ciudad['id_ciudad']; ?>"
                  <?php
     if ($reserva[0]['destino_reserva'] == $ciudad['id_ciudad']) {?>
                    selected
                    <?php
     }
     ?>
                  ><?php echo $ciudad['municipio'].' '.$ciudad['depto']; ?></option>}
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
              <option value="<?php echo $motivo['id_grupo']; ?>"
              <?php
    if ($reserva[0]['motivo_viaje'] == $motivo['id_grupo']) {?>
                  selected
                  <?php
    }
    ?>
                ><?php echo $motivo['descripcion_grupo']; ?></option>}
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
                <option value="<?php echo $motivo['id_grupo']; ?>"
                <?php
    if ($reserva[0]['fuente_reserva'] == $motivo['id_grupo']) {?>
                    selected
                    <?php
    }
    ?>
                  ><?php echo $motivo['descripcion_grupo']; ?></option>}
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
                <option value="<?php echo $motivo['id_grupo']; ?>"
                  <?php
    if ($reserva[0]['segmento_mercado'] == $motivo['id_grupo']) {?>
                    selected
                    <?php
    }
    ?>                  
                ><?php echo $motivo['descripcion_grupo']; ?></option>}
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
                <option value="<?php echo $codigo['id_cargo']; ?>"
                  <?php
      if ($reserva[0]['forma_pago'] == $codigo['id_cargo']) {?>
                      selected
                      <?php
      }
    ?>  
                    ><?php echo $codigo['descripcion_cargo']; ?></option>
                <?php
}
?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="motivo" class="col-sm-2 control-label">Observaciones</label>
        <div class="col-sm-10">
          <textarea style="height: 5em !important;min-height: 5em" name="observaciones" id="observaciones" class="form-control" rows="4" readonly=""><?php echo $reserva[0]['observaciones']; ?></textarea>
        </div>
      </div>    
      <div class="form-group">
        <label for="tarifahab" class="col-sm-2 control-label">Creada Por</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="createdusr" id="createdusr" value="<?php echo $reserva[0]['usuario']; ?>" readonly="">
        </div>
        <label for="formapago" class="col-sm-2 control-label">Fecha - Hora </label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="createdusr" id="createdusr" value="<?php echo $reserva[0]['fecha_ingreso']; ?>" readonly="">
        </div>
      </div>
    </div>
    <div class="panel-footer">
      <div class="btn-group" style="width: 30%;margin-left:35%">
        <button style="width: 50%" type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply" aria-hidden="true"></i> Regresar</button>
        <button style="width: 50%" class="btn btn-success" align="right"><i class="fa fa-save" aria-hidden="true"></i> Actualizar</button>
      </div>           
    </div>
  </div>
