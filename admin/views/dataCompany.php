<?php 
  $tiposCia    = $admin->getTiposCia();
  $codigosCiiu = $admin->getCodigosCiiu();
?>

<div class="content-wrapper" style="margin-bottom: 0px"> 
  <form id="updateCompany" class="form-horizontal" action="javascript:updateConfigCia()" method="POST" enctype="multipart/form-data">
    <section class="content">
      <div class="panel panel-success">
        <div class="panel-heading"> 
          <div class="row">
            <div class="col-lg-6">
              <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_ADM?>">                  
              <input type="hidden" name="ubicacion" id="ubicacion" value="home">
              <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-cogs"></i> Configuracion General Empresa </h3>
            </div>
            <div class="col-lg-6" style="text-align:right;">
              <button type="submit" name="edit_settings" class="btn btn-success btnPpal"><i class="fa fa-save"></i> Actualizar </button>
            </div>
          </div>
        </div>
        <div class="panel-body">
          <?php 
            foreach ($empresa as $cia) { 
              $ciudades = $hotel->getCiudadesPais($cia['pais']);
              ?>
              <div class="form-group">
                <label class="control-label col-lg-2">Empresa</label>
                <div class="col-lg-5 col-md-5">
                  <input class="form-control" type="text" name="nameOwerUpd" id="nameOwerUpd" value="<?=$cia['empresa']?>" required>
                </div>
                <label class="control-label col-lg-1">Nit</label>
                <div class="col-lg-2 col-md-2">
                  <input class="form-control" type="text" name='nitUpd' id='nitUpd' value="<?=$cia['nit']?>" required>  
                </div>
                <div class="col-lg-1 col-md-1">
                  <input class="form-control" type="text" name='dvNitUpd' id='dvNitUpd' value="<?=$cia['dv']?>" required>  
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-2">Direccion</label>
                <div class="col-lg-4 col-md-4">
                  <input class="form-control" type="text" name="adressUpd" id="adressUpd" value="<?=$cia['direccion']?>"  required>
                </div>
                <label class="control-label col-lg-2">Ciudad</label>
                <div class="col-lg-4 col-md-4">
                  <select name="cityUpd" id="cityUpd" required="">
                    <?php 
                    foreach ($ciudades as $ciudad) { ?>
                      <option value="<?=$ciudad['id_ciudad']?>" 
                        <?php 
                          if($cia['ciudad']== $ciudad['id_ciudad']){
                            echo 'selected' ;
                          }
                        ?>
                        ><?=$ciudad['municipio'].' ' .$ciudad['depto']?></option>
                      <?php 
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group" >
                <label class="control-label col-lg-2" for="">Pagina Web</label>
                <div class="col-lg-4 col-md-4" >
                  <input class="form-control" type="text" name="webPageUpd" id="webPageUpd" value="<?=$cia['web']?>" required>
                </div>          
                <label class="control-label col-lg-2" for="">EMail</label>
                <div class="col-lg-4 col-md-4" >
                  <input class="form-control" type="text" name="emailUpd" id="emailUpd" value="<?=$cia['correo']?>" required>
                </div>          
              </div> 
              <div class="form-group" >
                <label class="control-label col-lg-2" for="">Telefono</label>
                <div class="col-lg-4 col-md-4" >
                  <input class="form-control" maxlength="14" minlength="7" type="text" name="phoneUpd" id="phoneUpd" value="<?=$cia['telefonos']?>">
                </div>          
                <label class="control-label col-lg-2" for="">Celular</label>
                <div class="col-lg-4 col-md-4" >
                  <input class="form-control" maxlength="10" minlength="10" type="text" name="movilUpd" id="movilUpd" value="<?=$cia['celular']?>" required>
                </div>          
              </div> 
              <div class="form-group">
                <label for="seccion" class="control-label col-lg-2 col-md-2">Tipo Empresa</label>
                <div class="col-lg-4 col-md-4">
                  <select class="form-control" name="tipo_emp" id="tipo_emp" required>
                    <option value="">Seleccione El Tipo de Empresa</option>
                    <?php 
                    foreach ($tiposCia as $tipoCia) {
                      ?>
                      <option value="<?= $tipoCia['id_tipo_cia']?>" 
                        <?php 
                          if($cia['tipo_empresa']== $tipoCia['id_tipo_cia']){
                            echo 'selected' ;
                          }
                        ?>
                        ><?php echo $tipoCia['descripcion']?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
                <label for="promedio" class="control-label col-lg-2  col-md-1">Codigo CIIU</label>
                <div class="col-lg-4 col-md-4">
                  <select class="form-control" name="ciiu" id="ciiu">
                    <option value="">Seleccione El Codigo CIIU</option>
                    <?php 
                    foreach ($codigosCiiu as $codigoCiiu) { ?>
                      <option value="<?= $codigoCiiu['id_ciiu']?>" 
                        <?php 
                          if($cia['codigo_ciiu'] == $codigoCiiu['id_ciiu']){
                            echo 'selected' ;
                          }
                        ?>
                        ><?php echo $codigoCiiu['codigo'].' '.substr($codigoCiiu['descripcion'],0,50)?></option>
                      <?php
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group" >
                <label for="inputEmail3" class="col-sm-2 control-label">Iva incluido</label>
                <div class="col-sm-4 ondisplay">
                  <div class="wrap">
                    <div class="col-sm-6" style="padding:0;height: 15px">
                      <div class="form-check form-check-inline">
                        <input style="margin-top:5px" class="form-check-input" type="radio" name="imptoOption" id="inlineRadio1" value="1" 
                        <?php  
                          if($cia['impto_incl']==1){ ?>
                            checked
                          <?php 
                          }
                        ?>
                        >
                        <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineRadio1" >SI</label>
                      </div>                    
                    </div>
                    <div class="col-sm-6" style="padding:0;height: 15px"> 
                      <div class="form-check form-check-inline">
                        <input style="margin-top:5px" class="form-check-input" type="radio" name="imptoOption" id="inlineRadio2" value="0"
                          <?php  
                            if($cia['impto_incl']==0){ ?>
                              checked
                              <?php 
                            }
                          ?>
                        >
                        <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineRadio2">NO</label>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- <label for="inputEmail3" class="col-sm-2 control-label">Acceso por Equipo [IP]</label>
                <div class="col-sm-2 ondisplay">
                  <div class="wrap">
                    <div class="col-sm-6" style="padding:0;height: 15px">
                      <div class="form-check form-check-inline">
                        <input style="margin-top:5px" class="form-check-input" type="radio" name="accessOption" id="inlineAccess1" value="1" 
                        <?php  
                          if($cia['ip_acceso']==1){ ?>
                            checked
                          <?php 
                          }
                        ?>
                        >
                        <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineAccess1" >SI</label>
                      </div>                    
                    </div>
                    <div class="col-sm-6" style="padding:0;height: 15px"> 
                      <div class="form-check form-check-inline">
                        <input style="margin-top:5px" class="form-check-input" type="radio" name="accessOption" id="inlineAccess2" value="0"
                          <?php  
                            if($cia['ip_acceso']==0){ ?>
                              checked
                              <?php 
                            }
                          ?>
                        >
                        <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineAccess2">NO</label>
                      </div>
                    </div>
                  </div>
                </div>
                <label for="inputEmail3" class="col-sm-2 control-label">Activar SubDominio </label>
                <div class="col-sm-2 ondisplay">
                  <div class="wrap">
                    <div class="col-sm-6" style="padding:0;height: 15px">
                      <div class="form-check form-check-inline">
                        <input style="margin-top:5px" class="form-check-input" type="radio" name="cmsOption" id="inlineRadio1" value="1" 
                        <?php  
                          if($cia['cms']==1){ ?>
                            checked
                          <?php 
                          }
                        ?>
                        >
                        <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineRadio1" >SI</label>
                      </div>                    
                    </div>
                    <div class="col-sm-6" style="padding:0;height: 15px"> 
                      <div class="form-check form-check-inline">
                        <input style="margin-top:5px" class="form-check-input" type="radio" name="cmsOption" id="inlineRadio2" value="0"
                          <?php  
                            if($cia['cms']==0){ ?>
                              checked
                              <?php 
                            }
                          ?>
                        >
                        <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineRadio2">NO</label>
                      </div>
                    </div>
                  </div>
                </div> -->
              <!-- </div>
              <div class="form-group" > -->
                <label class="control-label col-lg-2" for="">RNT</label>
                <div class="col-lg-2 col-md-2" >
                  <input class="form-control" type="text" name="RNTUpd" id="RNTUpd" value="<?=$cia['rnt']?>" required>
                </div>
              </div>
              <div class="form-group" >  
                <label class="control-label col-lg-2" for="">Logo</label>
                <input type="hidden" id="imgLogo" name="imgLogo" value="<?=$cia['logo']?>"> 
                <div class="col-lg-2 col-md-2" id="mostrarFoto">
                  <?php 
                    if($cia['logo']==''){
                      $images = '../img/noimage.png'; 
                    }else{
                      $images = '../img/'.$cia['logo'] ;
                    }
                  ?>
                  <img class="img-thumbnail" src="<?php echo $images ?>" alt="" >
                </div>          
                <label class="control-label col-lg-2" for="">Importar Logo</label>
                <div class="col-lg-2 col-md-2" >
                  <input type="file" name="logoUpd" id="logoUpd" onchange="verFoto(this)">
                </div>          
              </div>
              <?php 
            }
          ?>              
        </div>
        <!-- <div class="panel-footer"> </div> -->
      </div>
    </section>
  </form>
</div>




