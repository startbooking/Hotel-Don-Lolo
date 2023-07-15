
    <div class="content-wrapper"> 
      <section class="content" style="height: 780px">
        <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-success">
            <div class="panel-heading">
              <div class="row">
                <div class="col-lg-9">
                  <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_PMS?>">
                  <input type="hidden" name="ubicacion" id="ubicacion" value="ingresoConsumos">
                  <input type="hidden" name="ingreso" id="ingreso" value="1">
                  <h3 class="w3ls_head tituloPagina"> <i class="fa fa-money icon fa-2x" style="color:black;" ></i> Ingreso Consumos</h3>
                </div>
              </div>
            </div>
            <div id="mensaje"></div>
            <form id="guardarDatosRooms" class="form-horizontal" action="javascript:ingresaConsumos()" method="POST" enctype="multipart/form-data">
              <div class="panel-body">
                <div id="infoReserva"></div>
                <div class="form-group"> 
                  <label class="control-label col-lg-3">Habitacion</label>
                  <div class="col-lg-6 col-md-6">
                    <select name="txtIdReservaCon" id="txtIdReservaCon" onchange="asignaHuesped(this.value)">
                      <option value="">Seleccione la Habitacion</option>
                      <?php 
                        foreach ($reservas as $reserva) { ?> 
                          <option value="<?=$reserva['num_reserva']?>" ><?=$reserva['num_habitacion'].' '.$reserva['apellido1'].' '.$reserva['apellido2'].' '.$reserva['nombre1'].' '.$reserva['nombre2']?></option>
                        <?php 
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group" id="datosHuesped"></div>
                <div class="divs divDeposito">
                  <div class="form-group">
                    <label class="control-label col-lg-3" for="codigoConsumo">Codigo Consumo</label>
                    <div class="col-lg-9 col-md-" >
                      <select name="codigoConsumo" id="codigoConsumo" required>
                        <option value="">Seleccione Concepto</option>
                        <?php 
                        $codigos = $hotel->getCodigosConsumos(1);
                        foreach ($codigos as $codigo) { ?>
                          <option value="<?=$codigo['id_cargo']?>"><?=$codigo['descripcion_cargo']?></option>
                           option 
                          <?php  
                        }
                         ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="txtCantidad" class="col-sm-3 control-label">Cantidad</label>
                    <div class="col-sm-2">
                      <input class="form-control padInput" type="number" name="txtCantidad" id="txtCantidad" value="1" min="1">
                    </div>
                    <label for="txtValorConsumo" class="col-sm-2 control-label">Valor Cargo</label>
                    <div class="col-sm-5">
                      <input class="form-control padInput" type="number" name="txtValorConsumo" id="txtValorConsumo" value="" min="1">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="txtReferencia" class="col-sm-3 control-label">Referencia</label>
                    <div class="col-sm-5">
                      <input class="form-control padInput" type="text" name="txtReferencia" id="txtReferencia" value="" min="1">
                    </div>
                    <label for="txtFolio" class="col-sm-2 control-label">Folio</label>
                    <div class="col-sm-2">
                      <input class="form-control padInput" type="number" name="txtFolio" id="txtFolio" value="1" min="1" max="4">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="txtDetalleCargo" class="col-sm-3 control-label">Comentarios</label>
                    <div class="col-sm-9">
                      <input class="form-control padInput" type="text" name="txtDetalleCargo" id="txtDetalleCargo" value='' placeholder="Informacion del Cargo ">
                    </div>
                  </div>
                </div>          
              </div>
              <div class="panel-footer">
                <div class="row">
                  <div class="col-lg-6 col-lg-offset-3" >
                    <div class="col-lg-6">
                      <a type="button" class="btn btn-warning btn-block" href="home"><i class="fa fa-reply"></i> Regresar</a>
                    </div>
                    <div class="col-lg-6">
                      <button class="btn btn-primary btn-block"><i class="fa fa-save"></i> Procesar</button>
                    </div>                
                  </div>
                </div>
              </div>  
            </form>
          </div>
        </div>
      </section>
    </div>
