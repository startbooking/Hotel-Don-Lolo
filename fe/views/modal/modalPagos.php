<?php 
  $imptos   = $admin->getCodigosVentas(2); 
  $unidades = $inven->getUnidadesMedida();
  $centros  = $admin->getCentrosCosto();

?>


<div class="modal fade" id="myModalPagos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="guardarPagos" class="form-horizontal">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="material-symbols-outlined">power_settings_new</span></button>
          <h4 class="modal-title" id="exampleModalLabel">
          <span class="material-symbols-outlined">add_chart</span> Nueva Forma de Pago</h4>
        </div>
        <div class="modal-body">
          <div id="mensaje" class="alert alert-warning oculto centraTitulo"></div>
          <div class="form-group row">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Descripcion </label>
            <div class="col-lg-6 col-md-6">
              <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
          </div> 
          <div class="form-group row">
            <label for="puc" class="control-label col-lg-2 col-md-2">Codigo DIAN</label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="codigo" name="codigo" required >
            </div>
            <label for="nombre" class="control-label col-lg-2 col-md-2">Tipo</label>
            <div class="col-lg-4 col-md-4">
              <select class="form-control" name="tipo" id="tipo" required="">
                <option value="">Seleccione el Tipo de Pago</option>
                <option value="1">Contado</option>
                <option value="2">Credito</option>                
              </select>
            </div>
          </div>          
          <div class="form-group">            
            <label for="puc" class="control-label col-lg-2 col-md-2">PUC </label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="puc" name="puc" required >
            </div>
            <label for="nombre" class="control-label col-lg-2 col-md-2">Centro Costo</label>
            <div class="col-lg-4 col-md-4">  
              <select class="form-control" id="centro" name="centro" required>
                <option value="">Seleccione el Centro de Costo</option>
                <?php
                  foreach ($centros as $unidad) { ?>
                    <option value="<?php echo $unidad['id_centrocosto']; ?>"><?php echo $unidad['descripcion_centro']; ?></option>
                    <?php
                  }
                ?>                
              </select> 
            </div>            
          </div>
          <div class="form-group">
            <label for="puc" class="control-label col-lg-2 col-md-2">Descripcion Contabilidad</label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="descripcion" name="descripcion" required >
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="row">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><span class="material-symbols-outlined">undo</span> Regresar</button>
            <button type="submit" class="btn btn-primary derechaAbs">
            <i class="fa fa-save">
            <!-- <span class="material-symbols-outlined">save</span> -->
            Guardar</button>
          </div>
          <!-- <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar </button> -->
        </div>
      </div>
    </div>
  </form>
</div>


<!-- <div class="modal fade" id="myModalAdicionarProveedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="dataRegistrarProveedor" class="form-horizontal" action="javascript:guardaProveedor()">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="glyphicon glyphicon-off"></span></button>
          <h4 class="modal-title" id="exampleModalLabel"><span class="material-symbols-outlined">person_add</span> Adiciona Proveedor</h4>
        </div>
        <div class="modal-body">
          <div id="datos_ajax"></div>
          <form class="form-horizontal">
            <div class="card-body">
              <div class="form-group row">
                <label for="empresa" class="control-label col-lg-2 col-md-2">Empresa</label>
                <div class="col-lg-6 col-md-6">
                  <input type="text" class="form-control" id="empresa" name="empresa" required >
                </div>
                <label for="nit" class="control-label col-lg-1 col-md-1">Nit</label>
                <div style="padding-right:0" class="col-lg-2 col-md-2">
                  <input  type="text" class="form-control" id="nit" onblur="calcularDV()" name="nit" min="1000000" required >
                </div>
                <div style="padding-left:2px" class="col-lg-1 col-md-1" id="dvnit">
                  <label for="nit">-</label>
                  <input style="width: 80%;margin-left: 12px;margin-top: -40px;" type="text" class="form-control" id="dv" name="dv" min="" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="direccion" class="control-label col-lg-2 col-md-2">Direccion</label>
                <div class="col-lg-6 col-md-6">
                  <input type="text" class="form-control" id="direccion" name="direccion" required >
                </div>
                <label for="ciudad" class="control-label col-lg-1  col-md-1">Ciudad</label>
                <div class="col-lg-3 col-md-3">
                  <select class="form-control" name="ciudad" id="ciudad" required>
                    <option value="">Seleccione La Ciudad</option>
                    <?php 
                    foreach ($ciudades as $ciudad) { ?>
                      <option value="<?=$ciudad['id_ciudad'];?>"><?= $ciudad['municipio'].' - '.$ciudad['depto'];?> </option>
                      <?php 
                    }
                    ?>
                  </select> 
                </div>
              </div>
              <div class="form-group row">
                <label for="seccion" class="control-label col-lg-2 col-md-2">Telefono</label>
                <div class="col-lg-3 col-md-3">
                  <input type="text" class="form-control" id="telefono" name="telefono" required >
                </div>
                <label for="seccion" class="control-label col-lg-2 col-md-2">Celular</label>
                <div class="col-lg-3 col-md-3">
                  <input type="text" class="form-control" id="celular" name="celular" required >
                </div>
              </div>
              <div class="form-group row">
                <label for="seccion" class="control-label col-lg-2 col-md-2">Email</label>
                <div class="col-lg-4 col-md-4">
                  <input type="email" class="form-control" id="correo" name="correo" required >
                </div>
                <label class="control-label col-lg-2  col-md-2" for="">Pagina web</label>
                <div class="col-lg-4 col-md-4">
                  <input class="form-control" type="text" name="web" id="web">
                </div>
              </div>
              <div class="form-group row">
                <label for="seccion" class="control-label col-lg-2 col-md-2">Tipo Empresa</label>
                <div class="col-lg-4 col-md-4">
                  <select class="form-control" name="tipo_emp" id="tipo_emp" required>
                    <option value="">Seleccione El Tipo de Empresa</option>
                    <?php 
                    foreach ($tiposCia as $tipoCia) {
                      ?>
                      <option value="<?= $tipoCia['id_tipo_cia']?>"><?php echo $tipoCia['descripcion']?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
                <label for="costo" class="control-label col-lg-2  col-md-2">Documento</label>
                <div class="col-lg-4 col-md-4">
                  <select class="form-control" name="tipo_doc" id="tipo_doc" required>
                    <option value="">Seleccione El Tipo de Documento</option>
                    <?php 
                    foreach ($tiposDoc as $tipoDoc) { ?>
                      <option value="<?= $tipoDoc['id_doc']?>"
                        <?php 
                        if($tipoDoc['id_doc']==8) {
                        ?>
                        selected
                          <?php
                        }
                        ?>
                      ><?php echo $tipoDoc['descripcion_documento']?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div id='nombre_personas'></div>
              <div class="form-group row"> 
                <label for="promedio" class="control-label col-lg-2  col-md-2">Codigo CIIU</label>
                <div class="col-lg-4 col-md-4">
                  <select class="form-control" name="ciiu" id="ciiu">
                    <option value="">Seleccione El Codigo CIIU</option>
                    <?php 
                    foreach ($codigosCiiu as $codigoCiiu) { ?>
                      <option value="<?= $codigoCiiu['id_ciiu']?>"><?php echo $codigoCiiu['codigo'].' '.substr($codigoCiiu['descripcion'],0,50)?></option>
                      <?php
                      }
                    ?>
                  </select>
                </div>
                <label for="tipoAdquiriente" class="col-sm-2 control-label">Tipo Empresa </label>
                <div class="col-sm-4">
                  <select class="form-control" name="tipoAdquiriente" id="tipoAdquiriente" required>
                    <option value="">Seleccione el Tipo Empresa</option>
                    <?php
                    $tipoAdquiere = $hotel->getTipoAdquiriente();
                    foreach ($tipoAdquiere as $tipoAdqui) { ?>
                      <option value="<?php echo $tipoAdqui['id']; ?>"><?php echo $tipoAdqui['descripcionAdquiriente']; ?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="tipoResponsabilidad" class="col-sm-2 control-label">Tipo Regimen </label>
                <div class="col-sm-4">
                  <select class="form-control" name="tipoResponsabilidad" id="tipoResponsabilidad" required>
                    <option value="">Seleccione Tipo de Regimen</option>
                    <?php
                    $tipoRespo = $hotel->getTipoResponsabilidad();
                    foreach ($tipoRespo as $tipoRes) { ?>
                      <option value="<?php echo $tipoRes['id']; ?>"><?php echo $tipoRes['descripcion']; ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
                <label for="responsabilidadTribu" class="col-sm-2 control-label">Tipo Obligacion</label>
                <div class="col-sm-4">
                  <select class="form-control" name="responsabilidadTribu" id="responsabilidadTribu" required>
                    <option value="">Seleccione Tipo Obligacion</option>
                    <?php
                    $tipoTribus = $hotel->getResponsabilidadTributaria();
                    foreach ($tipoTribus as $tipoTribu) { ?>
                      <option value="<?php echo $tipoTribu['id']; ?>"><?php echo $tipoTribu['descripcionResponsabilidad']; ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="row">
                <button type="button" class="btn btn-warning" data-dismiss="modal"><span class="material-symbols-outlined">undo</span> Regresar</button>
                <button type="submit" class="btn btn-primary derechaAbs"><span class="material-symbols-outlined">save</span> Guardar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </form>
</div> -->




<div class="modal fade" id="myModalModificaCodigoVentas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="actualizaDatosCodigosVentas" class="form-horizontal" action="javascript:actualizaCodigoVentas()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">
            <i style="font-size:18px;" class="fa fa-money"></i> Adicionar Codigo de Ventas</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensaje"></div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Descripcion </label>
            <div class="col-lg-8 col-md-8">
              <input type="hidden" id="idCodigoMod" name="idCodigoMod" required>
              <input type="text" class="form-control" id="nombreMod" name="nombreMod" required>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Impuesto</label>
            <?php 
              $imptos = $admin->getCodigosVentas(2); 
            ?>
            <div class="col-lg-4 col-md-4">
              <select class="form-control" name="imptosMod" id="imptosMod" required="">
                <option value="">Seleccione el Impuesto</option>
                <?php 
                foreach ($imptos as $impto) { ?> 
                <option value="<?=$impto['id_cargo']?>"><?=$impto['descripcion_cargo']?></option>
                <?php 
                }
                ?>
              </select>
            </div>
            <label for="nombre" class="control-label col-lg-2 col-md-2">Grupo</label>
            <?php 
              $grupos = $admin->getGruposVentas(); 
            ?>
            <div class="col-lg-4 col-md-4">
              <select class="form-control" name="grupoMod" id="grupoMod" required="">
                <option value="">Seleccione el Grupo</option>
                <?php 
                foreach ($grupos as $grupo) { ?> 
                <option value="<?=$grupo['id']?>"><?=$grupo['descripcion']?></option>
                <?php 
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">            
            <label for="nombre" class="control-label col-lg-2 col-md-2">Centro de Costo</label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="centroMod" name="centroMod" required >
            </div>
            <label for="puc" class="control-label col-lg-2 col-md-2">PUC </label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="pucMod" name="pucMod" required >
            </div>
          </div>
          <div class="form-group">
            <label for="puc" class="control-label col-lg-2 col-md-2">Descripcion Contable</label>
            <div class="col-lg-8 col-md-8">
              <input type="text" class="form-control" id="descripcionMod" name="descripcionMod" required >
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Actualizar</button>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="myModalEliminaCodigoVentas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="actualizaDatosCodigosVentas" class="form-horizontal" action="javascript:eliminaCodigoVentas()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">
            <i style="font-size:18px;" class="fa fa-money"></i> Adicionar Codigo de Ventas</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensaje"></div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Descripcion </label>
            <div class="col-lg-6 col-md-6">
              <input type="hidden" id="idCodigoEli" name="idCodigoEli" >
              <input type="text" class="form-control" id="nombreEli" name="nombreEli" disabled="">
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Impuesto</label>
            <?php 
              $imptos = $admin->getCodigosVentas(2); 
            ?>
            <div class="col-lg-4 col-md-4">
              <select class="form-control" name="imptosEli" id="imptosEli" disabled="" >
                <option value="">Seleccione el Impuesto</option>
                <?php 
                foreach ($imptos as $impto) { ?> 
                <option value="<?=$impto['id_cargo']?>"><?=$impto['descripcion_cargo']?></option>
                <?php 
                }
                ?>
              </select>
            </div>
            <label for="nombre" class="control-label col-lg-2 col-md-2">Grupo</label>
            <?php 
              $grupos = $admin->getGruposVentas(); 
            ?>
            <div class="col-lg-4 col-md-4">
              <select class="form-control" name="grupoEli" id="grupoEli" disabled="">
                <option value="">Seleccione el Grupo</option>
                <?php 
                foreach ($grupos as $grupo) { ?> 
                <option value="<?=$grupo['id']?>"><?=$grupo['descripcion']?></option>
                <?php 
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="puc" class="control-label col-lg-2 col-md-2">PUC </label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="pucEli" name="pucEli" disabled="">
            </div>
            <label for="puc" class="control-label col-lg-2 col-md-2">Descripcion </label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="descripcionEli" name="descripcionEli" disabled="">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Eliminar</button>
        </div>
      </div>
    </div>
  </form>
</div>

