<div class="modal fade" id="myModalAdicionarFormaPago" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="guardarDatosFormaPago" class="form-horizontal" action="javascript:guardaFormaPago()">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">
            <i style="font-size:18px;" class="fa fa-money"></i> Adicionar Forma de Pago</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensaje"></div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Forma de Pago </label>
            <div class="col-lg-4 col-md-">
              <input type="text" class="form-control" id="nombreAdi" name="nombreAdi" required>
            </div>
          </div>
          <div class="form-group">
            <label for="puc" class="control-label col-lg-2 col-md-2">PUC </label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="pucAdi" name="pucAdi" required >
            </div>
            <label for="puc" class="control-label col-lg-2 col-md-2">Descripcion </label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="descripcionAdi" name="descripcionAdi" required >
            </div>
          </div>
          <div class="form-group">
            <label for="crucepucAdi" class="control-label col-lg-2 col-md-2">Cuenta Cruce PUC </label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="crucepucAdi" name="crucepucAdi" required >
            </div>
          </div>
          <div class="form-group">
            <label for="formaDian" class="control-label col-lg-2 col-md-2">Tipo de Negociación</label>
            <div class="col-lg-4 col-md-4">
              <select class="form-control" name="formaDian" id="formaDian" required>
                <option value="">Seleccione la Forma de Pago</option>
                <option value=1>Contado</option>
                <option value=2>Credito</option>
                ?>
              </select>
            </div>
            <label for="metodoDian" class="control-label col-lg-2 col-md-2">Medio De Pago</label>
            <div class="col-lg-4 col-md-4">
              <select class="form-control" name="metodoDian" id="metodoDian" required>
                <option value="">Seleccione el medio del Pago</option>
                <?php
                  foreach ($medios as $medio) { ?>
                  <option value="<?php echo $medio['id']; ?>"
                  ><?php echo $medio['name']; ?></option>
                <?php
                }
                ?>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar </button>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="myModalEliminaFormaPago" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="eliminaDatosImpuesto" class="form-horizontal" action="javascript:eliminaFormaPago()">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Eliminar Forma de Pago</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensajeEli"></div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Forma de Pago </label>
            <div class="col-lg-4 col-md-4">
              <input type="hidden" id="idFormaPagoEli" name="idFormaPagoEli" required>
              <input type="text" class="form-control" id="nombreEli" name="nombreEli" disabled>
            </div>
          </div>
          <div class="form-group">
            <label for="puc" class="control-label col-lg-2 col-md-2">PUC </label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="pucEli" name="pucEli" disabled >
            </div>
            <label for="puc" class="control-label col-lg-2 col-md-2">Descripcion </label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="descripcionEli" name="descripcionEli" disabled >
            </div>
          </div>
          <div class="form-group">
            <label for="crucepucEli" class="control-label col-lg-2 col-md-2">Cuenta Cruce PUC </label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="crucepucEli" name="crucepucEli" required >
            </div>
          </div>
          <div class="form-group">
            <label for="formaDianEli" class="control-label col-lg-2 col-md-2">Tipo de Negociación</label>
            <div class="col-lg-4 col-md-4">
              <select class="form-control" name="formaDianEli" id="formaDianEli" required>
                <!-- <option value="">Seleccione la Forma de Pago</option> -->
                <option value=1>Contado</option>
                <option value=2>Credito</option>
                ?>
              </select>
            </div>
            <label for="metodoDianEli" class="control-label col-lg-2 col-md-2">Medio De Pago</label>
            <div class="col-lg-4 col-md-4">
              <select class="form-control" name="metodoDianEli" id="metodoDianEli" required>
                <!-- <option value="">Seleccione el medio del Pago</option> -->
                <?php
                  foreach ($medios as $medio) { ?>
                  <option value="<?php echo $medio['id']; ?>"
                  ><?php echo $medio['name']; ?></option>
                <?php
                }
                ?>
              </select>
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

<div class="modal fade" id="myModalModificaFormaPago" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="actualizaDatosFormaPago" class="form-horizontal" action="javascript:actualizaFormaPago()">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">
            <i style="font-size:18px;" class="fa fa-money"></i> Actualiza Forma de Pago</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensaje"></div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Forma de Pago </label>
            <div class="col-lg-4 col-md-4">
              <input type="hidden" id="idFormaPagoMod" name="idFormaPagoMod" required>
              <input type="text" class="form-control" id="nombreMod" name="nombreMod" required>
            </div>
          </div>
          <div class="form-group">
            <label for="puc" class="control-label col-lg-2 col-md-2">PUC </label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="pucMod" name="pucMod" required >
            </div>
            <label for="puc" class="control-label col-lg-2 col-md-2">Descripcion </label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="descripcionMod" name="descripcionMod" required >
            </div>
          </div>
          <div class="form-group">
            <label for="crucepucMod" class="control-label col-lg-2 col-md-2">Cuenta Cruce PUC </label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="crucepucMod" name="crucepucMod" required >
            </div>
          </div>
          <div class="form-group">
            <label for="formaDianMod" class="control-label col-lg-2 col-md-2">Tipo de Negociación</label>
            <div class="col-lg-4 col-md-4">
              <select class="form-control" name="formaDianMod" id="formaDianMod" required>
                <!-- <option value="">Seleccione la Forma de Pago</option> -->
                <option value=1>Contado</option>
                <option value=2>Credito</option>
                ?>
              </select>
            </div>
            <label for="metodoDianMod" class="control-label col-lg-2 col-md-2">Medio De Pago</label>
            <div class="col-lg-4 col-md-4">
              <select class="form-control" name="metodoDianMod" id="metodoDianMod" required>
                <!-- <option value="">Seleccione el medio del Pago</option> -->
                <?php
                  foreach ($medios as $medio) { ?>
                  <option value="<?php echo $medio['id']; ?>"
                  ><?php echo $medio['name']; ?></option>
                <?php
                }
                ?>
              </select>
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

