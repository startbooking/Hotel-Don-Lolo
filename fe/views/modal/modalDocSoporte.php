<?php 
$productos   = $user->getCodigosVentas(4);
$retenciones = $user->getTipoImpuestos(2);
$imptos      = $user->getTipoImpuestos(1);
$unidades    = $inven->getUnidadesMedida();
$rechazos    = $user->motivoRechazoNC();
  
?>

<div class="modal fade" id="myModalAdicionaItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="dataRegistraItem" class="form-horizontal" action="javascript:guardaProveedor()">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="glyphicon glyphicon-off"></span></button>        
          
          <!-- 
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="material-symbols-outlined">power_settings_new</span>  
            <i class="fas fa-tags"></i>
          </button>
        -->
          <h4 class="modal-title" id="exampleModalLabel">
          <i class="fas fa-tags"></i>Compras / Servicios </h4>
        </div>
        <div class="modal-body">
          <div id="mensaje" class="alert alert-warning oculto centraTitulo"></div>
          <div class="form-group row">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Compra / Servicio</label>
            <div class="col-md-6">
              <select class="form-control" name="itemcompra" id="itemcompra" onblur="infoProducto(this.value)" required>
                <option value="">Seleccione la Compra / Servicio</option>
                <?php
                  foreach ($productos as $producto) { ?>
                    <option value="<?php echo $producto['id_cargo']; ?>"><?php echo $producto['descripcion_cargo']; ?></option>
                    <?php
                  }
                ?> 
              </select>
            </div>
            <label for="nombre" class="control-label col-lg-1 col-md-1">Unidad</label>
            <div class="col-md-3">
              <select class="form-control" name="unidad" id="unidad" required>
                <option value="">Seleccione la Unidad</option>
                <?php
                  foreach ($unidades as $unidad) { ?>
                    <option value="<?php echo $unidad['id_unidad']; ?>"><?php echo $unidad['descripcion_unidad']; ?></option>
                    <?php
                  }
                ?>
              </select>            
            </div>						
          </div>
          <div class="form-group row">                             
            <label class="control-label col-lg-2 col-md-2">Valor Unitario</label>
            <div class="col-md-2">
              <input type="number" min="1" class="form-control" id="precio" name="precio" required value="0" min="1">
            </div>
            <label for="nombre" class="control-label col-lg-2 col-md-2">Cantidad</label>
            <div class="col-md-2">
              <input type="number" min="1" class="form-control" id="cantidad" name="cantidad" required value="0" min="1" onblur="calculaTotal()">
            </div>
            <label class="control-label col-lg-2 col-md-2">Valor Unitario</label>
            <div class="col-md-2">rechazo
              <input type="number" min="1" class="form-control" id="total" name="total" required value="0" min="1">
            </div>
          </div>
          <div class="form-group row">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Impuesto</label>
            <div class="col-lg-4 col-md-4">
              <select class="form-control" name="imptos" id="imptos" required="">
                <option value="">Seleccione el Impuesto</option>
                <?php 
                foreach ($imptos as $impto) { ?> 
                <option value="<?=$impto['id_cargo']?>"><?=$impto['descripcion_cargo']?></option>
                <?php 
                }
                ?>
              </select>
            </div>                             
            <label class="control-label col-lg-2 col-md-2">Retencion</label>
            <div class="col-md-4">
              <select class="form-control" name="retencion" id="retencion">
                <option value="">Seleccione la Retencion a Aplicar</option>
                <?php
                  foreach ($retenciones as $producto) { ?>
                    <option value="<?php echo $producto['id_cargo']; ?>"><?php echo $producto['descripcion_cargo']; ?></option>
                    <?php
                  }
                ?>
              </select>                
            </div>							
          </div>
          <div class="form-group row">
            <a href="#myModalProductos" 
            data-edita="0"
            data-documento='1'
            data-toggle="modal" 
            class="linkItem control-label col-lg-6 col-md-6">Adicionar Nuevo Compra / Servicio </a>            
          </div>
        </div>
        <div class="modal-footer">
          <div class="row">
            <button type="button" class="btn btn-warning" data-dismiss="modal">
            <i class="fa-solid fa-rotate-left"></i>
            Regresar</button>
            <button type="submit" class="btn btn-primary derechaAbs">
            <i class="fa fa-save"></i> Guardar</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="myModalAnulaDS" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form id="anulaDocumento" class="form-horizontal">rechazo
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class='glyphicon glyphicon-off' style="color:#530505"></span></button>
            <h3 class="modal-title tituloAnula" id="exampleModalLabel"> <i class="fa-solid fa-sheet-plastic"></i> Anular Documento Soporte</h3>
          </div>
          <div class="modal-body">
            <div id="mensajeAnula" class="alert alert-warning centraTitulo oculto">         </div>
            <input type="hidden" name="txtIdDS" id="txtIdDS" value="">
            <div class="form-group">
              <label for="noches" class="col-sm-3 control-label">Documento Nro</label>
              <div class="col-sm-2">
                <input type="number" class="form-control" name="docuSop" id="docuSop" readonly="">
              </div>
              <label for="llegada" class="col-sm-2 control-label">Fecha</label>
              <div class="col-sm-4" style="padding-right: 20px">
                <input type="date" class="form-control" name="fechaDoc" id="fechaDoc" readonly="">
              </div>
            </div>                      
            <div class="form-group">
              <label class="control-label col-lg-3" for="verDocumentoModal">Documento Soporte</label>
              <div class="col-sm-9">
                <object id="verDocumentoModal" width="100%" height="250" data=""></object>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-lg-3" for="motivoAnula">Motivo Anulacion</label>
              <div class="col-sm-8">
                <input class="form-control" type="text" name="motivoAnula" id="motivoAnula" value="">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-lg-3" for="motivoAnula">Tipo Rechazo</label>
              <div class="col-sm-8">
                <select  class="form-control" name="rechazo" id="rechazo">
                  <option value="">Seleccione el Motivo del Rechazo</option>
                  <?php
                  foreach ($rechazos as $unidad) { ?>
                    <option value="<?php echo $unidad['id']; ?>"><?php echo $unidad['descripcionRechazo']; ?></option>
                    <?php
                  }
                ?> 
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <div class="row">
              <div class="col-lg-6 col-lg-offset-3">
                <div class="col-lg-6">
                  <button type="button" class="btn btn-warning btn-block" data-dismiss="modal"><I class="fa fa-reply"></I> Regresar</button>
                </div>
                <div class="col-lg-6">
                  <button type="submit" class="btn btn-primary btn-block btnAnulaDoc">
                  <i class="fa fa-save"></i> Anular</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

