    <div class="content-wrapper"> 
      <section class="content" style="height: 780px;">
        <div class="col-md-8 col-md-offset-2" style="margin-bottom: 50px">
          <div class="panel panel-success">
            <div class="panel-heading">
              <div class="row">
                <div class="col-lg-9">
                  <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_PMS?>">
                  <input type="hidden" name="ubicacion" id="ubicacion" value="index.php">
                  <h3 class="w3ls_head tituloPagina"> <i class="fa fa-money icon" style="font-size:36px;color:black" ></i> Reprocesar Balance General Diario</h3>
                </div>
              </div>
            </div>
            <div class="datos_ajax_delete"></div>
            <form id="formCargarHabitaciones" class="form-horizontal" action="javascript:crearMovimientoDiario()" method="POST" enctype="multipart/form-data">
              <div class="panel-body">
                <div class="row-fluid">
                  <div class="form-horizontal">
                    <label for="fechaIn" class="col-sm-2 control-label">Desde Fecha</label>
                    <div class="col-sm-4">
                      <input class="form-control" type="date" name="fechaIn" id="fechaIn">
                    </div>
                    <label for="fechaOut" class="col-sm-2 control-label">hasta Fecha</label>
                    <div class="col-sm-4">
                      <input class="form-control" type="date" name="fechaOut" id="fechaOut">
                    </div>
                  </div>
                </div>
              </div>
              <div id="aviso"></div>
              <div class="panel-footer">
                <div class="row">
                  <div class="col-lg-8 col-lg-offset-2" >
                    <div class="col-lg-6" style="padding:0">
                      <a type="button" class="btn btn-warning btn-block" href="<?=BASE_PMS?>index.php"><i class="fa fa-reply"></i> Regresar</a>
                    </div>
                    <div class="col-lg-6" style="padding:0">
                      <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-save"></i> Procesar</button>
                    </div>                
                  </div>
                </div>
              </div>  
            </form>
          </div>
        </div>
      </section>
    </div>
