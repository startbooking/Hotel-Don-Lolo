<?php

// echo FECHA_PMS;
$hoy = FECHA_PMS;
$ayer = strtotime('-1 day', strtotime($hoy));
$ayer = date('Y-m-d', $ayer);
?>


<div class="content-wrapper"> 
  <section class="content" style="height: 780px;">
    <div class="content" style="margin-bottom: 50px">
      <div class="panel panel-success">
        <div class="panel-heading">
          <input type="hidden" name="rutaweb" id="rutaweb" value="<?php echo BASE_PMS; ?>">
          <input type="hidden" name="ubicacion" id="ubicacion" value="exportaFacturas">
          <input type="hidden" name="pasos" id="pasos">
          <input type="hidden" name="formaPago" id="formaPago">
          <input type="hidden" name="cuentaPago" id="cuentaPago">
          <div class="container-fluid">
            <div class="col-lg-9 col-xs-12">
              <h3 class="w3ls_head tituloPagina"> <i class="fa fa-tachometer" style="font-size:36px;color:black" ></i> Exportar Facturas</h3>
            </div>
            <div class="col-lg-3 col-xs-12">
              <button class="btn btn-info" style="float:right;" onclick="exportTableToExcel('dataTable')"><i class="glyphicon glyphicon-th" aria-hidden="true"></i> Exportar</button> 
            </div>
          </div>
        </div> 
        <div class="datos_ajax_delete"></div>
        <form id="formCierreDiario" class="form-horizontal" method="POST" enctype="multipart/form-data">
          <div class="panel-body">
            <div class="row"> 
              <div class="col-lg-6 col-md-6 col-xs-12 form-group">
                <label for="direccion" class="col-sm-4 control-label">Fecha Factura </label>
                <div class="form-group has-success has-feedback col-sm-8" >
                  <div class="input-group" style="padding-left:15px;">
                    <input type="date" class="form-control" id="buscarFecha" name="buscarFecha" aria-describedby="inputGroupSuccess4Status" value="<?php echo $ayer; ?>" max="<?php echo $ayer; ?>">
                    <span class="input-group-addon" style="padding:1px;border:none">
                      <a type="bottom" class="btn btn-success" style="padding:3px 10px ;"
                        onclick="buscaFacturasExporta()"
                        href="#">
                        <i class="fa fa-search" aria-hidden="true"></i> Buscar
                      </a>
                    </span>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-xs-12" id='loader'></div>
            </div>
            <div class="row">
              <div class="alert alert-danger apaga"><h2 style="text-align:center;">Sin Facturas para este dia</h2></div>  
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
              <div class="col-lg-4 col-lg-offset-4" >
                <div class="col-xs-12" style="padding:0">
                  <a type="button" class="btn btn-warning btn-block" href="home"><i class="fa fa-reply"></i> Regresar</a>
                </div>
              </div>
            </div>
          </div>  
        </form> 
      </div>
    </div>
  </section>
</div>
