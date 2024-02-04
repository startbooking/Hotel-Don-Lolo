<?php 
  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 

  $id      = $_POST['id'];
  $reserva = $hotel->getBuscaReserva($id);
  $huesped = $hotel->getBuscaIdHuesped($reserva[0]['id_huesped']);
  $cia     = $hotel->getBuscaCia($reserva[0]['id_compania']);
  $tipohab =  $reserva[0]['tipo_habitacion'];

 ?>
<div class="">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Documento</label>
    <div class="col-sm-3"> 
      <input type="hidden" name="numeroReservaAct" id="numeroReservaAct" value="<?=$id?>">
      <input type="hidden" name="tipoocupacionAct" id="tipoocupacionAct" value="<?=$reserva[0]['tipo_ocupacion']?>">
      <input type="text" class="form-control" name="identifica" id="identifica" value="<?=$huesped[0]['identificacion']?>" readonly="">
    </div>
    <label for="inputEmail3" class="col-sm-1 control-label">Tipo</label>
    <div class="col-sm-4">
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
    <label for="inputEmail3" class="col-sm-2 control-label">Huesped</label>
    <div class="col-sm-6">
      <input type="hidden" name="idhuesped" id="idhuesped" value="<?=$reserva[0]['id_huesped']?>">
      <input type="text" class="form-control" name="apellidos" id="apellidos" value="<?=$huesped[0]['nombre_completo']?>" readonly disabled>
    </div>
    <label for="inputEmail3" class="col-sm-2 control-label">Decreto 297</label>
    <div class="col-sm-2">
      <div class="wrap">
        <div class="col-sm-6" style="padding:0;height: 15px">
          <div class="form-check form-check-inline">
            <input style="margin-top:5px" class="form-check-input" type="radio" name="imptoOption" id="inlineRadio1" value="1" readonly
            <?php  
              if($reserva[0]['causar_impuesto']==1){ ?>
                checked
              <?php 
              }
            ?>
            >
            <label style="margin-top:-20px;margin-left:25px" class="form-check-label" for="inlineRadio1" >NO</label>
          </div>                    
        </div>
        <div class="col-sm-6" style="padding:0;height: 15px"> 
          <div class="form-check form-check-inline">
            <input style="margin-top:5px" class="form-check-input" type="radio" name="imptoOption" id="inlineRadio2" value="2" readonly
            <?php  
              if($reserva[0]['causar_impuesto']==2){ ?>
                checked
              <?php 
              }
            ?>
            >
            <label style="margin-top:-20px;margin-left:25px" class="form-check-label" for="inlineRadio2">SI</label>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php 
  if(!empty($reserva[0]['id_compania'])){ ?>
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Empresa</label>
      <div class="col-sm-6">
        <input type="hidden" name="idcia" id="idcia" value="<?=$reserva[0]['id_compania']?>">
        <input type="text" class="form-control" name="empresa" id="empresa" value="<?=$cia[0]['empresa']?>" readonly disabled>
      </div>
      <label for="inputEmail3" class="col-sm-2 control-label">Nit</label>
      <div class="col-sm-2">
        <input type="text" class="form-control" name="nit" id="nit" value="<?=$cia[0]['nit'].'-'.$cia[0]['dv']?>" readonly disabled>
      </div>
    </div>
    <?php 
  }
  ?>
</div>
<div class="alert" style="padding:5px 0;margin:0">
  <div class="form-group">
    <label for="llegada" class="col-sm-2 control-label">Llegada</label>
    <div class="col-sm-3" style="padding:0px 5px 0px 15px">
      <input type="date" class="form-control" name="llegada" id="llegada" readonly disabled value="<?=$reserva[0]['fecha_llegada']?>"> 
    </div>
    <label for="noches" class="col-sm-1 control-label">Noches</label>
    <div class="col-sm-2"  style="padding:0px 5px 0px 15px">
      <input type="number" class="form-control" name="noches" id="noches" readonly disabled value='<?=$reserva[0]['dias_reservados']?>' min='1' onchange="sumarDias()" onblur="sumarDias()" >
    </div>
    <label for="salida" class="col-sm-1 control-label">Salida</label>
    <div class="col-sm-3" style="padding:0px 5px 0px 15px">
      <input type="date" onblur="restaFechas()" class="form-control" name="salida" id="salida" readonly disabled value="<?=$reserva[0]['fecha_salida']?>">
    </div>
  </div>
  <div class="form-group">
    <label for="hombres" class="col-sm-2 control-label">Hombres</label>
    <div class="col-sm-2">
      <input type="number" class="form-control" name="hombresAct" id="hombresAct" readonly disabled value="<?=$reserva[0]['can_hombres']?>" min=0>
    </div>
    <label for="mujeres" class="col-sm-1 control-label">Mujeres</label>
    <div class="col-sm-2">
      <input type="number" class="form-control" name="mujeresAct" id="mujeresAct" readonly disabled value='<?=$reserva[0]['can_mujeres']?>' min=0>
    </div>
    <label for="ninos" class="col-sm-1 control-label">Niños</label>
    <div class="col-sm-2">
      <input type="number" class="form-control" name="ninosAct" id="ninosAct" readonly disabled value="<?=$reserva[0]['can_ninos']?>" min=0> 
    </div>
  </div>
  <div class="form-group">
    <label for="tipohabi" class="col-sm-2 control-label">Tipo Hab.</label>
    <div class="col-sm-4">
      <select name="tipohabiAct" id="tipohabiAct" readonly disabled onblur="seleccionaHabitacionUpd(this.value,'<?=$reserva[0]['tipo_habitacion']?>','<?=$reserva[0]['num_habitacion']?>')">
        <?php 
          $tipos = $hotel->getTipoHabitacion($reserva[0]['tipo_ocupacion']);
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
    <label for="nrohabitacion" class="col-sm-2 control-label">Nro Hab.</label>
    <div class="col-sm-4">
      <div id="habitacionesUpd">
      <?php 
        $habitaciones = $hotel->getSeleccionaHabitacionesTipo($tipohab); 
        ?>
        <select name="nrohabitacion" id="nrohabitacion" readonly disabled onblur='seleccionaTarifasUpd()'>
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
          $tarifas = $hotel->getSeleccionaTarifa($tipohab,$llega,$sale); 
        ?>
        <select name="tarifaHabAct" id="tarifaHabAct" readonly disabled onblur="valorHabitacionUpd(this.value)">
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
      <div id="valortarifasAct">
        <input type="text" class="form-control" name="valortarifaAct" id="valortarifaAct" readonly="" disabled="" value="<?=number_format($reserva[0]['valor_diario'],2)?>" min=0> 
      </div>
    </div>
  </div>
  <div class="form-group">
    <label for="tarifahab" class="col-sm-2 control-label">Nueva Tarifa</label>
    <div class="col-sm-4">
      <div id="tarifas">
        <?php 
          $llega   =  $reserva[0]['fecha_llegada'];
          $sale    =  $reserva[0]['fecha_salida'];
          $tarifas = $hotel->getSeleccionaTarifa($tipohab,$llega,$sale); 
        ?>
        <select name="tarifahab" id="tarifahab" readonly onblur="valorHabitacionAct(this.value)">
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
    <label for="valortar" class="col-sm-2 control-label">Nuevo Valor</label>
    <div class="col-sm-4">
      <div id="valortarifas">
        <input type="text" class="form-control" name="valortarifa" id="valortarifa" value="<?=number_format($reserva[0]['valor_diario'],2)?>" min=0> 
      </div>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Motivo </label>
    <div class="col-sm-10">
      <input class="motivoCambio" type="text" name="motivoCambio" id="motivoCambio" required>
      <!-- <input type="text" class="form-control" name="motivoCambio" id="motivoCambio" placeholder="Motivo Cambio" required="" value=""> -->
    </div>
  </div>
</div>                 
