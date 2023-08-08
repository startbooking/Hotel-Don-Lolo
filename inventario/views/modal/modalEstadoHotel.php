<php  
$hoy = date('Y-m-d);
echo $hoy;

?>


<div class="modal fade" id="myModalEstadoHotel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div id="dataEstadoHotel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-body" id="modalReservasIns">  
          <div class="row-fluid">
            <form class="form-horizontal" id="formReservas" action="javascript:buscaCantidad()" method="POST">
              <div class="panel panel-success" id='pantallaNuevaReserva'>
                <div class="panel-heading">
                  <h4>Seleccione la Fecha Ocupacion Hotel</h4>
                </div>
                <div class="panel-body" style="padding: 5px 15px;">
                  <div class="form-group">
                    <label for="llegada" class="col-sm-2 control-label">Llegada</label>
                    <div class="col-sm-4" style="padding-right: 20px">
                      <input style="line-height: 15px;" type="date" class="form-control" name="llegada" id="llegada" required="" value="<?=$hoy?>" min="<?=$hoy?>"> 
                    </div>
                    <label for="salida" class="col-sm-2 control-label">Salida</label>
                    <div class="col-sm-4" style="padding-right: 20px">
                      <input style="line-height: 15px;" type="date" class="form-control" name="salida" id="salida" required="" value="<?=$hoy?>" min="<?=$hoy?>">
                    </div>
                  </div>
                </div>
                <div class="panel-footer">
                  <div class="btn-group" style="margin-left:35%">
                    <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>                  
                    <button class="btn btn-success"><i class="fa fa-save" aria-hidden="true"></i> Confirmar</button>
                  </div>     
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div> 
</div>
