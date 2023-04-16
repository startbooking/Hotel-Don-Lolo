    <div class="content-wrapper"> 
      <section class="content" style="height: 780px;">
        <div class="content" style="margin-bottom: 50px">
          <div class="panel panel-success">
            <div class="panel-heading">
              <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_PMS?>">
              <input type="hidden" name="ubicacion" id="ubicacion" value="historicoFacturas">
              <input type="hidden" name="pasos" id="pasos">
              <h3 class="w3ls_head tituloPagina"> <i class="fa fa-tachometer" style="font-size:36px;color:black" ></i> Listado Compañias</h3>
            </div> 
            <div class="datos_ajax_delete"></div>
            <div class="panel-body">
              <div class="container-fluid">
                <div class="col-md-9">
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
                </div>
                <div class="col-md-3">
                  <div class="btn-group pull-right">                    
                    <button class="btn btn-success" onclick='listadoPerfilCompanias()'><i class="fa fa-print" aria-hidden="true"></i> Imprimir</button>
                    <button class="btn btn-info" onclick="exportTableToExcel('listadoCompanias')"><i class="glyphicon glyphicon-th" aria-hidden="true"></i> Exportar</button> 
                  </div>
                </div>
              </div>
              <div class="container-fluid">                  
                <div class="row-fluid" id="muestraHuespedes">
                  <object id="verHuespedes" width="100%" height="500" data=""></object> 
                </div>
                <div class="row-fluid">
                  <div class="table" >
                    <table id="listadoCompanias" style="display: none;">
                      <thead>
                        <tr>
                          <td>Empresa</td>
                          <td>Nit</td>
                          <td>Direccion</td>
                          <td>Telefono</td>
                          <td>Correo Electronico</td>
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
