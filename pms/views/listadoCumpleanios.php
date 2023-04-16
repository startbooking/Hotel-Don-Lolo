    <div class="content-wrapper"> 
      <section class="content" style="height: 780px;">
        <div class="content" style="margin-bottom: 50px">
          <div class="panel panel-success">
            <div class="panel-heading">
              <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_PMS?>">
              <input type="hidden" name="ubicacion" id="ubicacion" value="listadoCumpleanios">
              <input type="hidden" name="pasos" id="pasos">
              <h3 class="w3ls_head tituloPagina"> <i class="fa fa-tachometer" style="font-size:36px;color:black" ></i> Listado Cumpleaños Huespedes</h3>
            </div> 
            <div class="datos_ajax_delete"></div>
            <div class="panel-body">
              <div class="container-fluid">
                <div class="col-md-9">
                  <div class="col-md-8" style="padding:0">
                    <label for="" class="col-lg-3" style="margin-top: 5px;"> Cumpleaños </label> 
                    <div class="col-lg-3" style="padding:0;height: 15px">
                      <div class="form-check form-check-inline">
                        <input style="margin-top:5px" class="form-check-input" type="radio" name="cumpleOption" id="inlineRadio1" value="1" checked>
                        <label style="margin-top:-21px;margin-left:25px" class="form-check-label" for="inlineRadio1" >Dia</label>
                      </div>                    
                    </div>
                    <div class="col-sm-3" style="padding:0;height: 15px"> 
                      <div class="form-check form-check-inline">
                        <input style="margin-top:5px" class="form-check-input" type="radio" name="cumpleOption" id="inlineRadio2" value="2">
                        <label style="margin-top:-21px;margin-left:25px" class="form-check-label" for="inlineRadio2">Mes</label>
                      </div>
                    </div>
                    <div class="col-sm-3" style="padding:0;height: 15px"> 
                      <div class="form-check form-check-inline">
                        <input style="margin-top:5px" class="form-check-input" type="radio" name="cumpleOption" id="inlineRadio2" value="3">
                        <label style="margin-top:-21px;margin-left:25px" class="form-check-label" for="inlineRadio2">Todos</label>
                      </div>
                    </div>
                  </div>
                  <!--
                  <div class="col-md-4" style="padding:0">
                    <label for="" class="control-label col-lg-2" style="margin-top: 5px;">Mes</label>
                    <div class="col-md-10">
                      <select  class="form-control" name="" id="">
                        <option value="1">Enero</option>
                        <option value="2">Febrero</option>
                        <option value="3">Marzo</option>
                        <option value="4">Abril</option>
                        <option value="5">Mayo</option>
                        <option value="6">Junio</option>
                        <option value="7">Julio</option>
                        <option value="8">Agosto</option>
                        <option value="9">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="direccion" class="col-sm-2 control-label">Desde </label>
                    <div class="col-sm-4" >
                      <select class="form-control" name="desdeApe" id="desdeApe">
                        <option value="">Todos</option>
                      </select>
                    </div>
                    <label for="direccion" class="col-sm-2 control-label">Hasta </label>
                    <div class="col-sm-4" >
                      <select class="form-control" name="desdeApe" id="desdeApe">
                        <option value="">Todos</option>
                      </select>
                    </div>
                  </div>                  
                -->
                </div>
                <div class="col-md-3">
                  <div class="btn-group pull-right">                    
                    <button class="btn btn-success" type="buttom" onclick="listadoCumpleanios()"><i class="fa fa-print" aria-hidden="true"></i> Imprimir</button>
                    <button class="btn btn-info" type="buttom" disabled="disabled" onclick="exportTableToExcel('listadoCumpleanios')"><i class="glyphicon glyphicon-th" aria-hidden="true"></i> Exportar</button> 
                  </div>
                </div>
              </div>
              <div class="container-fluid">                  
                <div class="row-fluid" id="muestraHuespedes">
                  <object id="verHuespedes" width="100%" height="500" data=""></object> 
                </div>
                <div class="row-fluid">
                  <div class="table" >
                    <table id="listadoCumpleanios" style="display: none;">
                      <thead>
                        <tr>
                          <td>Huesped</td>
                          <td>Direccion</td>
                          <td>Telefono</td>
                          <td>Correo Electronico</td>
                          <td>Fecha Nacimiento</td>
                        </tr>
                      </thead>
                      <tbody >
                        
                      </tbody>                        
                    </table>
                  </div>
                </div>
              </div>               
            </div>
            <div class="panel-footer">
              <div class="row">
                <div class="col-lg-4 col-lg-offset-4" >
                  <div class="col-xs-12" style="padding:0">
                    <a type="button" class="btn btn-warning" href="home"><i class="fa fa-reply"></i> Regresar</a>
                  </div>
                </div>
              </div>
            </div>  
          </div>
        </div>
      </section>
    </div>
