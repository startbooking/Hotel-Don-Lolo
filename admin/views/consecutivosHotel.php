<?php 
  $ciudades  = $hotel->getCiudadesPais($empresa[0]['pais']);
  $rooms     = $admin->getHabitaciones(); 
  $huespedes = $admin->getPerfilHuesped(); 

?>

<div class="content-wrapper" style="margin-bottom: 0px"> 
  <form id="updateConsecutivosHotel" class="form-horizontal" action="javascript:updateConsecutivosHotel()" method="POST" enctype="multipart/form-data">
    <section class="content">
      <div class="panel panel-success">
        <div class="panel-heading"> 
          <div class="row">
            <div class="col-lg-6">
              <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_ADM?>">                  
              <input type="hidden" name="ubicacion" id="ubicacion" value="home">
              <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-cogs"></i> Consecutivos Hotel </h3>
            </div>
            <div class="col-lg-6" align="right">
              <button type="submit" name="edit_settings" class="btn btn-success btnPpal"><i class="fa fa-save"></i> Actualizar </button>
            </div>
          </div>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
              <?php 
                foreach ($datosHotel as $cia) { 
                  ?>
                  <input type="hidden" name="idHotel" id="idHotel" value="<?=$cia['id']?>">
                  <div class="form-group">
                    <label class="control-label col-lg-2">Factura</label>
                    <div class="col-lg-2 col-md-2">
                      <input class="form-control" type="number" min="1" name="facturaUpd" id="facturaUpd" value="<?=$cia['con_factura']?>" required>
                    </div>
                    <label class="control-label col-lg-2">Depositos</label>
                    <div class="col-lg-2 col-md-2">
                      <input class="form-control" type="number" min="1" name="depositosUpd" id="depositosUpd" value="<?=$cia['con_deposito']?>" required>
                    </div>
                    <label class="control-label col-lg-2">Abonos</label>
                    <div class="col-lg-2 col-md-2">
                      <input class="form-control" type="number" min="1" name="abonosUpd" id="huespedUpd" value="<?=$cia['con_abonos']?>" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-2">Reserva</label>
                    <div class="col-lg-2 col-md-2">
                      <input class="form-control" type="number" min="1" name="reservaUpd" id="reservaUpd" value="<?=$cia['con_reserva']?>" required>
                    </div>
                    <label class="control-label col-lg-2">Registro Hotelero</label>
                    <div class="col-lg-2 col-md-2">
                      <input class="form-control" type="number" min="1" name="registroUpd" id="registroUpd" value="<?=$cia['con_registro_hotelero']?>" required>
                    </div>
                    <label class="control-label col-lg-2">Decreto 297</label>
                    <div class="col-lg-2 col-md-2">
                      <input class="form-control" type="number" min="1" name="decretoUpd" id="decretoUpd" value="<?=$cia['con_decreto']?>" required>
                    </div>
                  </div>                 
                  <div class="form-group">
                    <label class="control-label col-lg-2">Efectivo</label>
                    <div class="col-lg-2 col-md-2">
                      <input class="form-control" type="number" min="1" name="efectivoUpd" id="efectivoUpd" value="<?=$cia['con_efectivo']?>" required>
                    </div>
                    <label class="control-label col-lg-2">Avances</label>
                    <div class="col-lg-2 col-md-2">
                      <input class="form-control" type="number" min="1" name="avanceUpd" id="avanceUpd" value="<?=$cia['con_avances']?>" required>
                    </div>
                    <label class="control-label col-lg-2">Pagos</label>
                    <div class="col-lg-2 col-md-2">
                      <input class="form-control" type="number" min="1" name="pagosUpd" id="pagosUpd" value="<?=$cia['con_pago']?>" required>
                    </div>
                  </div>
                  <div class="form-group">
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-2">Recaudos Cartera</label>
                    <div class="col-lg-2 col-md-2">
                      <input class="form-control" type="number" min="1" name="recaudosUpd" id="recaudosUpd" value="<?=$cia['con_recaudos']?>" required>
                    </div>
                    <label class="control-label col-lg-2">Cuentas Congeladas</label>
                    <div class="col-lg-2 col-md-2">
                      <input class="form-control" type="number" min="1" name="ctaConUpd" id="decretoUpd" value="<?=$cia['con_cta_congelada']?>" required>
                    </div>
                    <label class="control-label col-lg-2">Mantenimiento</label>
                    <div class="col-lg-2 col-md-2">
                      <input class="form-control" type="number" min="1" name="mmtoUpd" id="mmtoUpd" value="<?=$cia['con_mantenimiento']?>" required>
                    </div>
                  </div>
                  <?php 
                }
              ?>
            </div>
          </div>              
        </div>
        <div class="panel-footer"> </div>
      </div>
    </section>
  </form>
</div>




