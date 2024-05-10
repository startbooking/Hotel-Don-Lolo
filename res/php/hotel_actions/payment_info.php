<?php 
  require '../config.php' ;
  require '../app_top.php'; 

  $fecha      = date("Y-m-d H:i:s");

  $ip         = $_SERVER['REMOTE_ADDR'];
  $fecha_in   = $_POST['fecha_in'];
  $fecha_out  = $_POST['fecha_out'];
  $adultos    = $_POST['adultos'];
  $ninos      = $_POST['ninos'];
  $noches     = $_POST['noches'];
  $tarifa     = $_POST['tarifa'];
  $tipohabi   = $_POST['tipohabi'];
  $nombhabi   = $_POST['nombhabi'];
  $canthabi   = $_POST['canthabi'];
  $idhotel    = $_POST['idhotel'];
  $namehotel  = addslashes(strtoupper($_POST['namehotel']));
  $nombres    = addslashes(strtoupper($_POST['nombres']));
  $apellidos  = addslashes(strtoupper($_POST['apellidos']));
  $vlrestadia = $_POST['vlrestadia'];
  $vlrtotal   = $_POST['vlrtotal'];
  $identi     = $_POST['identi'];
  $mail       = addslashes(strtoupper($_POST['mail']));
  $phone      = $_POST['phone'];
  $adress     = addslashes(strtoupper($_POST['adress']));
  $city       = addslashes(strtoupper($_POST['city']));
  $land       = $_POST['land'];
  $comments   = addslashes(strtoupper($_POST['comments']));
  $abeas      = strtoupper($_POST['abeas']);
  $textos     = $user->getTextHotel($idhotel);
  $hotel      = $namehotel;

  $imptoinc = $user->getTaxHotel($idhotel);
  $datapay  = $user->getDataPayHotel($idhotel);
  $numbook  = $user->getNumberBookingHotel($idhotel);
  $numbook  = $numbook + 1;
  $nrores   = $user->insertNumberBookingHotel($idhotel,$numbook);

  $fechalle = strtotime($fecha_in.' 12:00:00');
  $fechasal = strtotime($fecha_out.' 12:00:00');

  $user = new User_Actions();

  $valtax = round(($imptoinc[0]['tax']* $vlrestadia)/100,2);

  $newbook  = $user->insertBooking($fechalle,$fechasal,$adultos,$ninos,$noches,$tarifa,$tipohabi,$canthabi,$idhotel,$nombres,$apellidos,$vlrestadia,$valtax,$identi,$mail,$phone,$adress,$city,$land,$comments,$abeas,$numbook,$ip,$fecha);
  $idbook   = $numbook;

?>



<div class="payment_info_area">
  <div class="hotel_booking_area">
    <div class="hotel_booking margin-top-25">
      <div class="panel panel-info">
        <div class="panel-heading">
          <h2 class="titulo" style="text-align: center;font-weight: 800"><?php echo $textos[0]['title_confirmation']?></h2>
          <p>
            <?php echo $textos[0]['confirmation_reservation']?>            
          </p>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-6">
              <h3 align="center">Informacion del Huesped</h3>
              <div class="form-horizontal" style="margin-top:15px">
                <div class="form-group">
                  <label for="name" class="label-control col-lg-3"> Huesped</label>
                  <div class="col-lg-9">
                    <input name="name" type="text" id="name" class="form-control" value="<?=$apellidos?> <?=$nombres?>" readonly>
                  </div>            
                </div>            
                <div class="form-group">
                  <label for="name" class="label-control col-lg-3"> Identificacion</label>
                  <div class="col-lg-3">
                    <input name="name" type="text" class="form-control" value="<?=$identi?>" readonly>
                  </div>            
                  <label for="name" class="label-control col-lg-3"> Telefono</label>
                  <div class="col-lg-3">
                    <input name="name" type="text" class="form-control" value="<?=$phone?>" readonly>
                  </div>            
                </div>
                <div class="form-group">
                  <label for="name" class="label-control col-lg-3"> Email</label>
                  <div class="col-lg-9">
                    <input name="name" type="text" class="form-control" value="<?=$mail?>" readonly>
                  </div>            
                </div>            
                <div class="form-group">
                  <label for="name" class="label-control col-lg-3"> Direccion</label>
                  <div class="col-lg-9">
                    <input name="name" type="text" class="form-control" value="<?=$adress?>" readonly>
                  </div>            
                </div>            
                <div class="form-group">
                  <label for="name" class="label-control col-lg-3"> Ciudad</label>
                  <div class="col-lg-9">
                    <input name="name" type="text" class="form-control" value="<?=$city?>" readonly>
                  </div>            
                </div>
                <div class="form-group">
                  <label for="name" class="label-control col-lg-3"> Pais</label>
                  <div class="col-lg-9">
                    <?php 
                    $landname = $user->getNameLand($land);
                     ?>
                    <input name="name" type="text" class="form-control" value="<?=$landname?>" readonly>
                  </div>            
                </div>
                <div class="form-group">
                  <label for="name" class="label-control col-lg-3"> Adultos</label>
                  <div class="col-lg-3">
                    <input name="name" type="text" class="form-control" value="<?=$adultos?>" readonly>
                  </div>            
                  <label for="name" class="label-control col-lg-3"> Niños</label>
                  <div class="col-lg-3">
                    <input name="name" type="text" class="form-control" value="<?=$ninos?>" readonly>
                  </div>            
                </div>            
              </div>             
            </div>
            <div class="col-lg-6">
              <h3 align="center">Datos de la Reserva</h3>
              <div class="form-horizontal" style="margin-top:15px">
                <div class="form-group">
                  <label for="name" class="label-control col-lg-3"> Hotel</label>
                  <div class="col-lg-9">
                    <input type="hidden" id="idhotel" name="idhotel" value="<?=$idhotel?>">
                    <input type="hidden" id="tipoha" name="tipoha" value="<?=$tipohabi?>">
                    <input name="namehotel" id="namehotel" type="text" class="form-control" value="<?=$namehotel?>" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label for="name" class="label-control col-lg-3"> Ciudad</label>
                  <div class="col-lg-9">
                    <input name="name" type="text" id="name" class="form-control" value="<?php echo strtoupper(ciudad_hotel($idhotel))?>" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label for="name" class="label-control col-lg-3"> Reserva Numero</label>
                  <div class="col-lg-3">
                    <input name="nrobook" type="text" id="nrobook" class="form-control" value="<?=$numbook?>" readonly>
                  </div>
                  <label for="name" class="label-control col-lg-3"> Noches</label>
                  <div class="col-lg-3">
                    <input name="name" type="text" class="form-control" value="<?=$noches?>" readonly>
                  </div>            
                </div>
                <div class="form-group">
                  <label for="name" class="label-control col-lg-3"> Fecha Estadia</label>
                  <div class="col-lg-9">
                    <input name="name" type="text" id="name" class="form-control" value="<?=$fecha_in?> / <?=$fecha_out?>" readonly>
                  </div>
                </div>            
                <div class="form-group">
                  <label for="name" class="label-control col-lg-3"> Tarifa X Noche</label>
                  <div class="col-lg-3">
                    <input name="name" type="text" class="form-control" value="<?=number_format($tarifa,2)?>" readonly>
                  </div>            
                  <label for="name" class="label-control col-lg-3"> Valor Estadia</label>
                  <div class="col-lg-3">
                    <input name="valorest" id="valorest" type="text" class="form-control" value="<?=number_format($vlrestadia,2)?>" readonly>
                  </div>       
                </div>            
                <div class="form-group">
                  <label for="name" class="label-control col-lg-3">Habitaciones Reservadas</label>
                  <div class="col-lg-3">
                    <input name="canhabi" id="canhabi" type="text" class="form-control" value="<?=$canthabi?>" readonly>
                  </div>            
                </div> 
                <div class="form-group">
                  <label for="name" class="label-control col-lg-3"> Tipo de Habitacion</label>
                  <div class="col-lg-9">
                    <input name="nombrehab" id="nombrehab" type="text" class="form-control" value="<?=$nombhabi?>" readonly>
                  </div>            
                </div> 
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group">
              <label for="name" class="label-control col-lg-2"> Comentarios</label>
              <div class="col-lg-10">
                <textarea class="form-control" name="comments" id="comments" rows="5" readonly><?=$comments?></textarea>
              </div>
            </div>
          </div>
          <div class="alert alert-warning"style="margin-top:15px">
            <p style="font-size:10px;font-weight:bold  ">
              <input type="checkbox" name="national" id="national" value="1" onclick="calcula_imptos(<?=$vlrtotal?>,<?=$imptoinc[0]['tax']?>,this.value)">
                Declaro ser extranjero no residente en colombia  y me acojo al Decreto 97 de 2016 sobre la exención del impuesto sobre las ventas de los servicios turísticos prestados a residentes en el exterior     
            </p>
          </div>
        </div>
        <div class="panel-footer">
          <h2 align="center">Informacion de Pago </h2>
          <div class="row" id="valorestadia">
            <div class="col-lg-8 col-lg-offset-2">
              <div class="form-horizontal">
                <div class="form-group">
                  <label class="control-label col-lg-4"> Valor Estadia </label>
                  <div class="col-lg-8">
                    <input style="font-size:16px;font-weight:700 !important;" class="form-control" type="text" name="" value="<?=number_format($vlrtotal,2)?>" readonly>
                  </div>
                  <?php 
                    $vlrtax = round(($vlrtotal * $imptoinc[0]['tax'])/100,2); ?>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4"> Impuestos </label>
                  <div class="col-lg-8">
                    <input style="font-size:16px;font-weight:700 !important;" class="form-control" type="text" name="" value="<?php echo number_format($vlrtax,2)?>" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4"> Total A Pagar </label>
                  <div class="col-lg-8">
                    <input style="font-size:16px;font-weight:700 !important;" class="form-control" type="text" name="" value="<?php echo number_format($vlrtotal + $vlrtax,2) ?>" readonly>
                  </div>
                </div>
              </div>
            </div>
            <?php 
              //if($datapay[0]['test']==1){
                // $webpayu = "https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu"
                // $webpayu = "https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu";
              // }else{
                $webpayu = "https://gateway.payulatam.com/ppp-web-gateway/";
              // }
            ?>
            <div class="row" style='margin-top:15px'>            
              <div class="col-lg-4 col-lg-offset-4" style="margin-top:25px">
                <form method="post" action="<?=$webpayu?>">
                  <?php 
                    $singn = md5($datapay[0]['api_key'].'~'.$datapay[0]['id_mercant'].'~'.'Reserva Nro '.$idbook.'~'.($vlrtotal + $vlrtax).'~'.$datapay[0]['type_money'])
                  ?>
                  <input name ="merchantId"      type="hidden"  value="<?=$datapay[0]['id_mercant']?>">
                  <input name ="accountId"       type="hidden"  value="<?=$datapay[0]['id_payu']?>">
                  <input name ="description"     type="hidden"  value="<?=$nombhabi.' '.$namehotel?>"  >
                  <input name ="referenceCode"   type="hidden"  value="Reserva Nro <?=$idbook?>" >
                  <input name ="amount"          type="hidden"  value="<?=$vlrtotal + $vlrtax?>"   >
                  <input name ="tax"             type="hidden"  value="<?=$vlrtax?>"  >
                  <input name ="taxReturnBase"   type="hidden"  value="<?=$vlrtotal?>" >
                  <input name ="currency"        type="hidden"  value="<?=$datapay[0]['type_money']?>" >
                  <input name ="signature"       type="hidden"  value="<?=$singn?>"  >
                  <input name ="test"            type="hidden"  value="<?=$datapay[0]['test']?>" >
                  <input name ="buyerEmail"      type="hidden"  value="<?=$datapay[0]['paypal_email']?>" >
                  <input name ="buyerFullName"   type="hidden"  value="<?=$apellidos.' '.$nombres?>" >
                  <input name ="responseUrl"     type="hidden"  value="<?=$datapay[0]['url_response_payu']?>" >
                  <input name ="confirmationUrl" type="hidden"  value="<?=$datapay[0]['url_confirm_payu']?>" >
                  <input name ="lng" id="lng"    type="hidden"  value="es">

                  <input class="btn btn-info btn-block btn-lg" name="Submit" type="submit"  value="Pago En Linea">
                </form> 
              </div>
            </div>
          </div>          
        </div>
      </div>
    </div>
  </div>
</div>
