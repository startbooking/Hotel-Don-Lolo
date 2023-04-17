

<?php 
  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
  $id      =  $_POST['id'];

  $huesped   = $hotel->getBuscaIdHuesped($id);  
  $tipodocs  = $hotel->getTipoDocumento(); 
  $paices    = $hotel->getPaices();
  $nombreExp = $hotel->getNombreCiudad($huesped[0]['ciudad_expedicion']);
  $nombreCiu = $hotel->getNombreCiudad($huesped[0]['ciudad']);

?>
<form class="form-horizontal" id="formUpdateHuesped" action="javascript:actualizaHuesped()" method="POST">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Documento</label>
    <div class="col-sm-3">
      <input type="hidden" name="txtIdHuespedUpd" id="txtIdHuespedUpd" value="<?=$id?>">
      <input type="text" class="form-control" name="identifica" id="identifica" value="<?=$huesped[0]['identificacion']?>">
    </div>
    <label for="inputEmail3" class="col-sm-2 control-label">Tipo Documento</label>
    <div class="col-sm-3">
      <select name="tipodoc" required value="<?=$huesped[0]['tipo_identifica']?>">
        <option value="">Seleccione el Tipo de Documeto</option>
          <?php foreach ($tipodocs as $tipodoc): ?>
            <option value="<?=$tipodoc['id_doc']?>"
              <?php 
              if($huesped[0]['tipo_identifica']==$tipodoc['id_doc']){ ?>
                selected
                <?php 
              }
              ?>
              ><?=$tipodoc['descripcion_documento']?></option>}
          <?php endforeach ?>
      </select>
    </div>
  </div>
  <div class="form-group">            
    <label for="paisExp" class="col-sm-2 control-label">Expedicion </label> 
    <div class="col-sm-3">
      <select name="paisExpUpd" id="paisExpUpd" required="" onblur="ciudadesExpedicion(this.value,'<?=$huesped[0]['ciudad_expedicion']?>')">
        <?php 
          foreach ($paices as $pais) { ?>
            <option value="<?=$pais['id_pais']?>"
              <?php 
                if($huesped[0]['pais_expedicion']==$pais['id_pais']){?>
                  selected
                  <?php 
                } 
              ?>          
            ><?=$pais['descripcion']?></option>
            <?php 
          }
        ?>
      </select>
    </div>
    <label for="ciudadExp" class="col-sm-2 control-label">Ciudad </label> 
    <div class="col-sm-3">
      <select name="ciudadExpUpd" id="ciudadExpUpd" required="">
        <option value="<?=$huesped[0]['ciudad_expedicion']?>"><?=$nombreExp?></option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="apellidos" class="col-sm-2 control-label">1er Apellidos</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" name="apellido1" id="apellido1" required value="<?=$huesped[0]['apellido1']?>">
    </div>
    <label for="apellidos" class="col-sm-2 control-label">2o Apellido</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" name="apellido2" id="apellido2" value="<?=$huesped[0]['apellido2']?>">
    </div>
  </div>
  <div class="form-group">
    <label for="nombres" class="col-sm-2 control-label">1er Nombre</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" name="nombre1" id="nombre1" required value="<?=$huesped[0]['nombre1']?>">
    </div>
    <label for="nombres" class="col-sm-2 control-label">2o Nombre</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" name="nombre2" id="nombre2" value="<?=$huesped[0]['nombre2']?>">
    </div>
    <div class="col-sm-2" style="padding:0">
      <div class="col-sm-6" style="padding:0;height: 15px">
        <div class="form-check form-check-inline" style="text-align: left">
            <input style="margin-top:5px" class="form-check-input" type="radio" name="sexOption" id="inlineRadio1" value="1" 
            <?php 
            if($huesped[0]['sexo']==1){?>
              checked
              <?php 
            } 
            ?>
            >
          <label style="margin-top:-18px;margin-left:25px" class="form-check-label" for="inlineRadio1" >Masc</label>
        </div>                    
      </div>
      <div class="col-sm-6" style="padding:0;height: 15px"> 
        <div class="form-check form-check-inline" style="text-align: left">
            <input style="margin-top:5px" class="form-check-input" type="radio" name="sexOption" id="inlineRadio2" value="2" 
            <?php
            if($huesped[0]['sexo']==2){  ?>
              checked=""
              <?php 
            }
            ?>
            >
          <label style="margin-top:-18px;margin-left:25px" class="form-check-label" for="inlineRadio2">Fem</label>
        </div>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label for="direccion" class="col-sm-2 control-label">Direccion </label>
    <div class="col-sm-6">
      <input type="text" class="form-control" name="direccion" id="direccion" required value="<?=$huesped[0]['direccion']?>">
    </div>
  </div>
  <div class="form-group">
    <label for="direccion" class="col-sm-2 control-label">Nacionalidad </label>
    <div class="col-sm-4">
      <select name="paices" id="paices" onblur="getCiudadesPais(this.value,'<?=$huesped[0]['ciudad']?>')">
        <option value="">Seleccione la Nacionalidad</option>
        <?php 
        foreach ($paices as $pais) { ?>
          <option value="<?=$pais['id_pais']?>" 
            <?php 
            if($huesped[0]['pais']==$pais['id_pais']){?>
              selected
            <?php 
            }
            ?>
            ><?=$pais['descripcion']?></option>
          <?php 
          }
         ?>
      </select>
    </div>
    <label class="col-lg-2 col-md-2 control-label" style="padding-top:0">Ciudad</label>
    <div class="col-sm-4">
      <select name="ciudadUpd" id='ciudadUpd'>
        <option value="<?=$huesped[0]['ciudad']?>"><?=$nombreCiu?></option>
      </select>
    </div>
    <div id="ciudadesPais"></div>
  </div>
  <div class="form-group">
    <label for="telefono" class="col-sm-2 control-label">Telefono</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="telefono" id="telefono" value="<?=$huesped[0]['telefono']?>">
    </div>
    <label for="celular" class="col-sm-2 control-label">Celular</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="celular" id="celular"  value="<?=$huesped[0]['celular']?>">
    </div>
  </div>
  <div class="form-group">
    <label for="correo" class="col-sm-2 control-label">Correo </label>
    <div class="col-sm-4">
      <input type="email" class="form-control" name="correo" id="correo"  value="<?=$huesped[0]['email']?>">
    </div>
    <label for="fechanace" class="col-sm-2 control-label">Fecha Nacimiento </label>
    <div class="col-sm-4">
      <input type="date" class="form-control" name="fechanace" id="fechanace" value="<?=$huesped[0]['fecha_nacimiento']?>">
    </div>
  </div>
  <div class="form-group">
    <label for="tipohuesped" class="col-sm-2 control-label">Tipo Huesped </label>
    <div class="col-sm-4">
      <select name="tipohuesped" id="tipohuesped" required="">
      <?php 
        $tipohesps = $hotel->getTipoHuespedes(); ?>
        <?php foreach ($tipohesps as $tipohesp): ?>
          <option value="<?=$tipohesp['id_tipo_huesped']?>"
            <?php 
              if($huesped[0]['tipo_huesped']==$tipohesp['id_tipo_huesped']){ ?>
                selected
                <?php 
              }
             ?>
            ><?=$tipohesp['descripcion_tipo']?></option>}
        <?php endforeach ?>
       ?>
      </select>
    </div>
    <label for="tarifa" class="col-sm-2 control-label">Tarifa </label>
    <div class="col-sm-4">
      <select name="tarifa" id="tarifa" required="">
      <?php 
        $tarifas = $hotel->getTarifasHuespedes(); ?>
        <?php foreach ($tarifas as $tarifa): ?>
          <option value="<?=$tarifa['id_tarifa']?>"
            <?php 
            if($huesped[0]['id_tarifa']==$tarifa['id_tarifa']){ ?>
              selected
              <?php 
            }
             ?>
            ><?=$tarifa['descripcion_tarifa']?></option>
        <?php endforeach ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="formapago" class="col-sm-2 control-label">Forma de Pago </label>
    <div class="col-sm-4">
      <select name="formapago" id="formapago" required="">
        <option value="">Seleccione La Forma de Pago</option>
        <?php 
          $codigos = $hotel->getCodigosConsumos(3);
          foreach ($codigos as $codigo) { ?>
            <option value="<?=$codigo['id_cargo']?>"
              <?php 
              if($huesped[0]['id_forma_pago']==$codigo['id_cargo']){ ?>
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
  <div class="container-fluid">    
    <div class="btn-group" style="margin-top:15px">
      <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i>  Regresar</button>
      <button class="btn btn-success" align="right"><i class="fa fa-save"></i> Procesar</button>
    </div>        
  </div>         
</form>