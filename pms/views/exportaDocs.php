<?php
$dia = strtotime('-1 day', strtotime(FECHA_PMS));
$ayer = date('Y-m-d', $dia);
$inicial = date('Y-m-01', $dia);

?>
<div class="content-wrapper">
  <section class="content">
    <ul class="nav nav-tabs">
      <li class="active">
        <a href="#pagina1" class="" data-toggle="tab">
          <i class="fa-solid fa-money-bills"></i>
          Exportar Facturas
        </a>
      </li>
      <li>
        <a href="#pagina2" class="" data-toggle="tab">
          <i class="fa-solid fa-wallet"></i> Exportar Notas Credito
        </a>
      </li>
      <li>
        <a href="#pagina3" class="" data-toggle="tab">
          <i class="fa-solid fa-wallet"></i> Exportar Abonos
        </a>
      </li>
    </ul>
    <div class="tab-content">
      <input type="hidden" name="rutaweb" id="rutaweb" value="<?php echo BASE_PMS; ?>">
      <input type="hidden" name="ubicacion" id="ubicacion" value="exportaFacturas">
      <input type="hidden" name="pasos" id="pasos">
      <input type="hidden" name="formaPago" id="formaPago">
      <input type="hidden" name="cuentaPago" id="cuentaPago">
      <div class="tab-pane active" id="pagina1">
        <div class="content-fluid" style="margin-bottom: 50px">
          <div class="panel panel-success">
            <div class="panel-heading">
            </div>
            <div class="datos_ajax_delete"></div>
            <form id="formCierreDiario" class="form-horizontal" method="POST" enctype="multipart/form-data">
              <div class="panel-body">
                <div class="row">
                  <h3 class="centraTitulo"><i class="fa-solid fa-money-bills"></i> Facturas</h3>
                  <div class="form-horizontal">
                    <div class="form-group">
                      <label class="control-label col-md-1">Desde Fecha</label>
                      <div class="col-lg-3 col-md-3">
                        <input class="form-control" type="date" min="1" name="desdeFecha" id='desdeFecha' value='<?= $inicial ?>' max="<?= $ayer ?>">
                      </div>
                      <label class="control-label col-md-1">Hasta Fecha</label>
                      <div class="col-lg-3 col-md-3">
                        <input class="form-control" type="date" min="1" name="hastaFecha" id='hastaFecha' value='<?= $ayer ?>' max="<?= $ayer ?>">
                      </div>
                      <div class="col-md-4">
                        <button class="btn btn-info pull-right" onclick="exportTableToExcel('dataTable')"><i class="glyphicon glyphicon-th" aria-hidden="true"></i> Exportar</button>
                        <a type="bottom" class="btn btn-success pull-right" onclick="buscaFacturasExporta()" href="#">
                          <i class="fa fa-search" aria-hidden="true"></i> Buscar
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="alert alert-danger apaga">
                    <h2 style="text-align:center;">Sin Facturas para este dia</h2>
                  </div>
                  <div class="col-lg-12" id="muestraResultado" style="font-size:12px;overflow: auto;">
                    <table id="dataTable" class="table table-bordered">
                      <thead>
                        <tr class="warning">
                          <td>CodigoE</td>
                          <td>Anio</td>
                          <td>TipoD</td>
                          <td>NumeroD</td>
                          <td>Fecha</td>
                          <td>Concepto</td>
                          <td>Anulado</td>
                          <td>Aplicacion</td>
                          <td>CodigoE</td>
                          <td>Año</td>
                          <td>TipoD</td>
                          <td>NumeroD</td>
                          <td>Codigo_Cuenta</td>
                          <td>Cons</td>
                          <td>Fecha</td>
                          <td>Centro_Costo</td>
                          <td>Nit</td>
                          <td>DV</td>
                          <td>Nombre</td>
                          <td>Nombre_2</td>
                          <td>Apellido</td>
                          <td>Apellido_2</td>
                          <td>Razon_Social</td>
                          <td>Codigo_Depto</td>
                          <td>Codigo_Ciudad</td>
                          <td>Direccion</td>
                          <td>Telefono</td>
                          <td>Sexo</td>
                          <td>Referencia</td>
                          <td>Detalle</td>
                          <td>Valor_Debito</td>
                          <td>Valor_Credito</td>
                          <td>Sub_Tipo_Doc</td>
                          <td>Sub_Numero_Doc</td>
                          <td>Fecha_Conciliado</td>
                          <td>Valor_Total</td>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="panel-footer">
                <div class="row">
                  <div class="col-md-4 col-md-offset-4">
                    <div class="col-xs-12" style="padding:0">
                      <a type="button" class="btn btn-warning btn-block" href="home"><i class="fa fa-reply"></i> Regresar</a>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="tab-pane" id="pagina2">
        <div class="content-fluid" style="margin-bottom: 50px">
          <div class="panel panel-success">
            <div class="panel-heading"></div>
            <div class="datos_ajax_delete"></div>
            <form id="formCierreDiario" class="form-horizontal" method="POST" enctype="multipart/form-data">
              <div class="panel-body">
                <div class="row"> 
                  <h3 class="centraTitulo"><i class="fa-solid fa-wallet "></i> Notas Credito</h3>
                  <div class="form-horizontal">
                    <div class="form-group">
                      <label class="control-label col-md-1">Desde Fecha</label>
                      <div class="col-lg-3 col-md-3">
                        <input class="form-control" type="date" min="1" name="desdeFechaNC" id='desdeFechaNC' value='<?= $inicial ?>' max="<?= $ayer ?>">
                      </div>
                      <label class="control-label col-md-1">Hasta Fecha</label>
                      <div class="col-lg-3 col-md-3">
                        <input class="form-control" type="date" min="1" name="hastaFechaNC" id='hastaFechaNC' value='<?= $ayer ?>' max="<?= $ayer ?>">
                      </div>
                      <div class="col-md-4">
                        <button class="btn btn-info pull-right" onclick="exportTableToExcel('dataTableNC')"><i class="glyphicon glyphicon-th" aria-hidden="true"></i> Exportar</button>
                        <a type="bottom" class="btn btn-success pull-right" onclick="buscaNotasCreditoExporta()" href="#">
                          <i class="fa fa-search" aria-hidden="true"></i> Buscar
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="alert alert-danger apaga mensajeNC">
                    <h2 style="text-align:center;">Sin Notas Credito para este dia</h2>
                  </div>
                  <div class="col-lg-12" id="muestraResultadoNC" style="font-size:12px;overflow: auto;">
                    <table id="dataTableNC" class="table table-bordered">
                      <thead>
                        <tr class="warning">
                          <td>CodigoE</td>
                          <td>Anio</td>
                          <td>TipoD</td>
                          <td>NumeroD</td>
                          <td>Fecha</td>
                          <td>Concepto</td>
                          <td>Anulado</td>
                          <td>Aplicacion</td>
                          <td>CodigoE</td>
                          <td>Año</td>
                          <td>TipoD</td>
                          <td>NumeroD</td>
                          <td>Codigo_Cuenta</td>
                          <td>Cons</td>
                          <td>Fecha</td>
                          <td>Centro_Costo</td>
                          <td>Nit</td>
                          <td>DV</td>
                          <td>Nombre</td>
                          <td>Nombre_2</td>
                          <td>Apellido</td>
                          <td>Apellido_2</td>
                          <td>Razon_Social</td>
                          <td>Codigo_Depto</td>
                          <td>Codigo_Ciudad</td>
                          <td>Direccion</td>
                          <td>Telefono</td>
                          <td>Sexo</td>
                          <td>Referencia</td>
                          <td>Detalle</td>
                          <td>Valor_Debito</td>
                          <td>Valor_Credito</td>
                          <td>Sub_Tipo_Doc</td>
                          <td>Sub_Numero_Doc</td>
                          <td>Fecha_Conciliado</td>
                          <td>Valor_Total</td>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="panel-footer">
                <div class="row">
                  <div class="col-md-4 col-md-offset-4">
                    <div class="col-xs-12" style="padding:0">
                      <a type="button" class="btn btn-warning btn-block" href="home"><i class="fa fa-reply"></i> Regresar</a>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="tab-pane" id="pagina3">
        <div class="content-fluid" style="margin-bottom: 50px">
          <div class="panel panel-success">
            <div class="panel-heading"></div>
            <div class="datos_ajax_delete"></div>
            <form id="formCierreDiario" class="form-horizontal" method="POST" enctype="multipart/form-data">
              <div class="panel-body">
                <div class="row">
                  <h3 class="centraTitulo">
                    <i class="fa-solid fa-money-bill-transfer"></i>
                    Abonos / Depositos
                  </h3>
                  <div class="form-horizontal">
                    <div class="form-group">
                      <label class="control-label col-md-1">Desde Fecha</label>
                      <div class="col-lg-3 col-md-3">
                        <input class="form-control" type="date" min="1" name="desdeFechaAB" id='desdeFechaAB' value='<?= $inicial ?>' max="<?= $ayer ?>">
                      </div>
                      <label class="control-label col-md-1">Hasta Fecha</label>
                      <div class="col-lg-3 col-md-3">
                        <input class="form-control" type="date" min="1" name="hastaFechaAB" id='hastaFechaAB' value='<?= $ayer ?>' max="<?= $ayer ?>">
                      </div>
                      <div class="col-md-4">
                        <button class="btn btn-info pull-right" onclick="exportTableToExcel('dataTableAbonos')"><i class="glyphicon glyphicon-th" aria-hidden="true"></i> Exportar</button>
                        <a type="bottom" class="btn btn-success pull-right" onclick="buscaAbonosExporta()" href="#">
                          <i class="fa fa-search" aria-hidden="true"></i> Buscar
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="alert alert-danger apaga mensajeAbonos">
                    <h2 style="text-align:center;">Sin Abonos para este dia</h2>
                  </div>
                  <div class="col-lg-12" id="muestraResultadoNC" style="font-size:12px;overflow: auto;">
                    <table id="dataTableAbonos" class="table table-bordered">
                      <thead>
                        <tr class="warning">
                          <td>CodigoE</td>
                          <td>Anio</td>
                          <td>TipoD</td>
                          <td>NumeroD</td>
                          <td>Fecha</td>
                          <td>Concepto</td>
                          <td>Anulado</td>
                          <td>Aplicacion</td>
                          <td>CodigoE</td>
                          <td>Año</td>
                          <td>TipoD</td>
                          <td>NumeroD</td>
                          <td>Codigo_Cuenta</td>
                          <td>Cons</td>
                          <td>Fecha</td>
                          <td>Centro_Costo</td>
                          <td>Nit</td>
                          <td>DV</td>
                          <td>Nombre</td>
                          <td>Nombre_2</td>
                          <td>Apellido</td>
                          <td>Apellido_2</td>
                          <td>Razon_Social</td>
                          <td>Codigo_Depto</td>
                          <td>Codigo_Ciudad</td>
                          <td>Direccion</td>
                          <td>Telefono</td>
                          <td>Sexo</td>
                          <td>Referencia</td>
                          <td>Detalle</td>
                          <td>Valor_Debito</td>
                          <td>Valor_Credito</td>
                          <td>Sub_Tipo_Doc</td>
                          <td>Sub_Numero_Doc</td>
                          <td>Fecha_Conciliado</td>
                          <td>Valor_Total</td>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="panel-footer">
                <div class="row">
                  <div class="col-md-4 col-md-offset-4">
                    <div class="col-xs-12" style="padding:0">
                      <a type="button" class="btn btn-warning btn-block" href="home"><i class="fa fa-reply"></i> Regresar</a>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
  </section>
</div>