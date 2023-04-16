<form id="EntradaMovimientos" class="form-horizontal">
  <div class="modal fade" id="ModalEntradaMovimientos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="glyphicon glyphicon-off"></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Nueva Entrada a Inventarios</h4>
        </div>
        <div class="modal-body">
          <div class='row'>
            <div class='col-md-6'>
              <div class='box box-primary'>
                <div class='box-header with-border'>
                  <h5 align="center">Datos de la Entrada </h5>
                </div>
                <div class='box-body'>
                  <form class='form-horizontal'>
                    <div class='input-group'>
                      <span class='input-group-addon'>Movimiento</span>
                      <div id='pone_tipo_movi'></div>
                    </div>
                    <div class='input-group' style="margin-top:8px">
                      <span class='input-group-addon' >Proveedor</span>
                      <div id='pone_proveedor'></div>
                    </div>
                    <div class='input-group' style="margin-top:8px">
                      <span class='input-group-addon'> Fecha</span>
                      <input type="text" class="form-control pull-right" id="fecha" onchange="actualiza_fecha_temp();" autocomplete="off">
                    </div>
                    <div class='input-group' style="margin-top:8px">
                      <span class='input-group-addon'>Documento:</span>
                      <input type="text" class="form-control" id="factura" onchange="actualiza_num_fac_entrada_temp();">
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class='col-md-6'>
              <div class='box box-primary'>
                <div class='box-header with-border'>
                  <h5 align="center">Articulo</h5>
                </div>
                <div class='box-body'>
                  <div class='input-group'>
                    <span class='input-group-addon'>Producto</span>
                    <input type="hidden" id='codigo'> 
                    <input type="hidden" id='descripcion'> 
                    <div id='pone_producto'></div>
                  </div>
                  <input type="hidden" id='porc_impto'> 
                  <div id='pone_impuesto' style="margin-top:8px">
                  </div>
                  <div class='input-group' style="margin-top:8px">
                    <span class='input-group-addon'>Unidad</span>
                    <div id='pone_unidad'></div>
                  </div>
                  <div class='input-group' style="margin-top:8px">
                    <span class='input-group-addon'> Valor </span>
                    <input type="text" class="form-control" id="costo" data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'"
                      disabled>    
                    <span class='input-group-addon'> Cantidad:</span>
                    <input type="text" 
                    class="form-control pull-right" id="cantidad"
                    data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'" onchange="activa_botones_mov();" disabled>
                  </div>
                  <div class='btn-group btn-block' style="margin-top:8px">
                    <div class="row">
                      <div class="col-lg-6">
                        <button class='btn btn-primary btn-block btn-md' type='button' onclick='agrega_a_lista();' id='btn-add-article' disabled><i class='fa fa-download'></i> Agregar</button>
                      </div>
                      <div class="col-lg-6">
                        <button class='btn btn-danger btn-block btn-md' type='button' onclick='cancela_add();' id='btn-cancel-article' disabled><i class='fa fa-times'></i> Cancelar</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class='col-md-4'>
            </div>

            <div class='col-md-12'>
              <div class='box box-success'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Articulos En la entrada</h3>
                </div>
                <div class='box-body table-responsice no-padding'>
                  <table id='tabla_articulos' class='table table-hover'>
                    <thead>
                      <tr>
                        <th>Codigo</th>
                        <th>Descripcion</th>
                        <th>Cantidad</th>
                        <th>Valor Unit</th>
                        <th>Impuesto</th>
                        <th>Valor Total</th>
                        <th>Accion</th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <input type='hidden' id='num_entrada2' value='0'>
          </div>
        </div>
        <div class="modal-footer">
          <div class="row-fluid">
            <div class='box-body'>
              <div class='input-group'>
                <span class='input-group-addon bg-blue'> Total Movimiento:</span>
                <input type="text" 
                  class="form-control pull-right" 
                  id="net" 
                  value=''
                  style="font-size:16px; text-align:right; color:blue; font-weight: bold;" disabled>
                <span class='input-group-addon bg-blue'> Impuesto</span>
                <input type="text" class="form-control pull-right" id="imp" value=''
               style="font-size:16px; text-align:right; color:blue; font-weight: bold;" disabled>
                <span class='input-group-addon bg-blue'> Articulos:</span>
                <input type="text" class="form-control pull-right" id="arts" value=''
               style="font-size:16px; text-align:right; color:blue; font-weight: bold;" disabled>
              </div>
            </div>
            <div class='box box-primary'>
            </div>
                <div class='box-header with-border'>
                  <div class='col-lg-8'>
                    <button class='btn btn-warning btn-md' type='button' onclick='cancela_entrada_all();' id='btn-cancela'><i class='fa fa-times'></i> Cancelar Entrada</button>
                    <button class='btn btn-primary btn-md' type='button' onclick='procesa_entrada();' id='btn-procesa' disabled><i class='fa fa-external-link'></i> Procesar entrada</button>
                  </div>
                </div>

<!--            <div class="col-lg-3 col-lg-offset-3">
              <button class="btn btn-warning btn-block" type="">Cancelar</button>
            </div>
            <div class="col-lg-3">
              <button class="btn btn-success btn-block" type="">Procesar</button>
            </div> 
-->          </div>       
        </div>
      </div>
    </div>
  </div>
</form>

