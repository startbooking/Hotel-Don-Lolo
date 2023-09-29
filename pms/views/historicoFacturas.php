    <div class="content-wrapper"> 
      <section class="content" style="height: 780px;">
        <div class="content" style="margin-bottom: 50px"> 
          <div class="panel panel-success">
            <div class="panel-heading">
              <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_PMS?>">
              <input type="hidden" name="ubicacion" id="ubicacion" value="historicoFacturas">
              <input type="hidden" name="pasos" id="pasos">
              <h3 class="w3ls_head tituloPagina"> <i class="fa fa-tachometer" style="font-size:36px;color:black" ></i> Historico Facturas</h3>
            </div> 
            <div class="datos_ajax_delete"></div>
            <form id="formCierreDiario" class="form-horizontal" action="javascript:buscaFacturas()" method="POST" enctype="multipart/form-data">
              <div class="panel-body">
                <div class="row">
                  <div class="col-lg-6 form-group">
                    <label for="direccion" class="col-sm-4 control-label">Fecha Factura </label>
                    <div class="form-group has-success has-feedback col-sm-6" >
                      <div class="input-group" style="padding-left:15px;">
                        <input type="date" class="form-control" id="buscarFecha" aria-describedby="inputGroupSuccess4Status" value="<?=FECHA_PMS?>" max="<?=FECHA_PMS?>">
                        <span class="input-group-addon" style="padding:1px;border:none">
                          <a 
                            onclick="buscaFacturasFecha()"
                            href="#">
                            <i style="padding:5px 10px" class="fa fa-search" aria-hidden="true"></i>
                          </a>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6" id='facturas'></div>
                </div>
                <div class="row">
                  <div class="col-lg-6" id="muestraResultado" style="font-size:12px"></div>
                  <div class="col-lg-6" id="muestraFactura">
                    <object id="verFactura" width="100%" height="500" data=""></object> 
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
