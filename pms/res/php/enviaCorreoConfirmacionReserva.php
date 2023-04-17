<?php

  require_once '../config.php' ;  
  require_once '../app_top.php';
  require_once '../titles.php';

  $info    = $_POST['info'];
  $reserva = $_POST['reserva'];
  $idhotel = $_POST['idhotel'];
  $pago    = $_POST['pago'];
  
 
  $nro_reserva     = $reserva;
  $datapay         = $user->getDataPayHotel($idhotel);
  
  $nombrehotel     = $hotel[0]['hotel_name'];
  
  $infoBooking     = $user->getDetailBooking($idhotel,$nro_reserva);
  
  $infoBook        = $user->getBookingInfo($idhotel); 
  $nombhab         = $user->getRoomName($infoBooking[0]['id_room']);
  
  $email_message   = '';
  $email_to        = $hotel[0]['email_book'];
  $mailbooking     = $email_to;
  
  $error_message   = "Error";
  $mail            = strtolower($infoBooking[0]['email']);
  
  $title_booking   = $infoBook[0]['sub_confirm_booking'];
  $message_booking = $infoBook[0]['message_confirm_booking'];
  
  $email_subject   = $title_booking;
  
  $landname        = $user->getNameLand($infoBooking[0]['id_land']);
  
  $tipor           = $infoBooking[0]['id_room'];
  $nameRoom        = $user->getNameRoom($tipor);

  $estadoRs = 1 ;
  $tx_tax   = 0 ;
  $infopago = 0 ;

  $updbook  = $user->updateBookingPayu($idhotel,$nro_reserva,$estadoRs,$tx_tax, $infopago);

  //A partir de aqui se contruye el cuerpo del mensaje tal y como llegará al correo

  $email_message = "
    <div class='jarallax agile-about w3ls-section' style='margin-bottom: 30px'>
      <div class='container'>
        <h2 class='w3ls_head' style='font-family: ubuntu'><?=RESUMEN_TRANSACTION?> </h2>
        <h3 align='center'></h3>
      </div>
      <div class='container'>
        <div class='row'>        
          <h3 align='center'>Informacion del Huesped</h3>
          <div class='form-horizontal' style='margin-top:15px'>
            <div class='form-group'>
              <label for='name' class='label-control col-lg-2'> Huesped</label>
              <div class='col-lg-4'>
                <input name='name' type='text' id='name' class='form-control' value='".$infoBooking[0]['last_name']." ". $infoBooking[0]['name']."'>
              </div>            
              <label for='name' class='label-control col-lg-2'> Identificacion</label>
              <div class='col-lg-4'>
                <input name='name' type='text' class='form-control' value='".$infoBooking[0]['identify']."' >
              </div>            
            </div>            
            <div class='form-group'>
              <label for='name' class='label-control col-lg-2'> Telefono</label>
              <div class='col-lg-4'>
                <input name='name' type='text' class='form-control' value='".$infoBooking[0]['phone']."'>
              </div>            
              <label for='name' class='label-control col-lg-2'> Email</label>
              <div class='col-lg-4'>
                <input name='name' type='text' class='form-control' value='".$infoBooking[0]['email']."' >
              </div>            
            </div>            
            <div class='form-group'>
              <label for='name' class='label-control col-lg-3'> Direccion</label>
              <div class='col-lg-9'>
                <input name='name' type='text' class='form-control' value='".$infoBooking[0]['adress']."' readonly>
              </div>            
            </div>            
            <div class='form-group'>
              <label for='name' class='label-control col-lg-2'> Ciudad</label>
              <div class='col-lg-4'>
                <input name='name' type='text' class='form-control' value='".$infoBooking[0]['city']."' >
              </div>            
              <label for='name' class='label-control col-lg-2'> Pais</label>
              <div class='col-lg-4'>
                <input name='name' type='text' class='form-control' value='".$landname."'>
              </div>            
            </div>
            <div class='form-group'>
              <label for='name' class='label-control col-lg-2'> Adultos</label>
              <div class='col-lg-4'>
                <input name='name' type='text' class='form-control' value='".$infoBooking[0]['adults']."' >
              </div>            
              <label for='name' class='label-control col-lg-2'>". utf8_decode('Niños')."</label>
              <div class='col-lg-4'>
                <input name='name' type='text' class='form-control' value='".$infoBooking[0]['children']."' >
              </div>            
            </div>            
          </div>
          <h3 align='center' style='margin-top: 30px;'>Datos del Pago </h3>
          <div class='form-horizontal' style='margin-top:15px'>
            <div class='form-group'>
              <label for='name' class='label-control col-lg-2'> Estado de la transaccion</label>
              <div class='col-lg-4'>
                <input name='name' type='text' id='name' class='form-control' value='".$pago."'>
              </div>
            </div>
          </div>
        </div>
        <div class='row'>
          <h3 align='center' style='margin-top: 30px;'>Datos de la Reserva</h3>
          <div class='form-horizontal' style='margin-top:15px'>
            <div class='form-group'>
              <label for='name' class='label-control col-lg-2 col-md-2'> Hotel</label>
              <div class='col-lg-4 col-md-4'>
                <input name='name' type='text' id='name' class='form-control' value='".$nombrehotel."'>
              </div>
              <label for='name' class='label-control col-lg-2 col-md-2'> Ciudad</label>
              <div class='col-lg-4 col-md-4'>
                <input name='name' type='text' id='name' class='form-control' value='". strtoupper(ciudad_hotel($idhotel))."'>
              </div>
            </div>
            <div class='form-group'>
              <label for='name' class='label-control col-lg-2 col-md-2'> Reserva Numero</label>
              <div class='col-lg-4 col-md-4'>
                <input name='name' type='text' id='name' class='form-control' value='".$nro_reserva."' >
              </div>
            </div>
            <div class='form-group'>
              <label for='name' class='label-control col-lg-2 col-md-2'> Fecha Estadia</label>
              <div class='col-lg-4 col-md-4'>
                <input name='name' type='text' id='name' class='form-control' value='".date('Y-m-d',$infoBooking[0]['in_date'])." / ".date('Y-m-d',$infoBooking[0]['out_date'])."' >
              </div>
              <label for='name' class='label-control col-lg-2 col-md-2'> Noches</label>
              <div class='col-lg-4 col-md-4'>
                <input name='name' type='text' id='name' class='form-control' value='".$infoBooking[0]['days']."'>
              </div>
            </div>
            <div class='form-group'>
              <label for='name' class='label-control col-lg-2 col-md-2'> Tarifa X Noche</label>
              <div class='col-lg-4 col-md-4'>
                <input name='name' type='text' class='form-control' value='".number_format($infoBooking[0]['price'],2)."' >
              </div>            
              <label for='name' class='label-control col-lg-2 col-md-2'> Valor Estadia</label>
              <div class='col-lg-4 col-md-4'>
                <input name='name' type='text' class='form-control' value='".number_format($infoBooking[0]['vlr_booking'],2)."'>
              </div>       
            </div>            
            <div class='form-group'>
              <label for='name' class='label-control col-lg-2 col-md-2'> Valor impuestos</label>
              <div class='col-lg-4 col-md-4'>
                <input name='name' type='text' class='form-control' value='".number_format($infoBooking[0]['tax_booking'],2)."'>
              </div>            
              <label for='name' class='label-control col-lg-2 col-md-2'> Valor TOTAL</label>
              <div class='col-lg-4 col-md-4'>
                <input name='name' type='text' class='form-control' value='".number_format($infoBooking[0]['tax_booking']+$infoBooking[0]['vlr_booking'],2)."' >
              </div>            
            </div>            
            <div class='form-group'>
              <label for='name' class='label-control col-lg-2 col-md-2'> Habitaciones Reservadas</label>
              <div class='col-lg-4 col-md-4'>
                <input name='name' type='text' class='form-control' value='".$infoBooking[0]['qty_room']."' >
              </div>            
              <label for='name' class='label-control col-lg-2 col-md-2'> Tipo de Habitacion</label>
              <div class='col-lg-4 col-md-4'>
                <?php 
                 ?>
                <input name='name' type='text' class='form-control' value='".$nameRoom."' >
              </div>            
            </div> 
            <div class='form-group'>
              <label for='name' class='label-control col-lg-2'> Comentarios</label>
              <div class='col-lg-10'>
                <textarea class='form-control' name='comments' id='comments' rows='5'>".utf8_decode($infoBooking[0]['comments'])."</textarea>
              </div>
            </div>
            <div class='form-group'>
              <label for='name' class='label-control col-lg-2 col-md-2'> Fecha Creacion Reserva</label>
              <div class='col-lg-4 col-md-4'>
                <input name='name' type='text' class='form-control' value='".$infoBooking[0]['date_book']."' readonly>
              </div>            
            </div>
          </div>          
        </div>
      </div>
    </div>
";


  $mensajeReserva = "
  <!DOCTYPE HTML>
    <html>
      <head>
      <link href='https://stackpath.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' rel='stylesheet' >
      </head>
      <body>
        <div class='container'>
          <div class='row'>  
            <section id='contact-form' class='mt50'>
              <div class='payment_info_area'>
                <div class='hotel_booking_area'>
                  <div class='hotel_booking margin-top-25'>
                    <div class='row'>
                      <h2 align='center'>Nueva Reserva</h2>
                      <p align='left'>$email_message</p>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>
      </body>
    </html>
  ";

  $message   = "
  <!DOCTYPE HTML>
    <html>
      <head></head>
      <body>
        <div class='container'>
          <div class='row'> 
            <div id='logo' style='padding:0'> 
              <div class='col-lg-10'>
                <h2 style='padding:20px 0;font-size:40px' align='center'>$nombrehotel</h2>
              </div>
            </div>
            <section id='contact-form' class='mt50'>
              <div class='payment_info_area'>
                <div class='hotel_booking_area'>
                  <div class='hotel_booking margin-top-25'>
                    <div class='row-fluid'>
                      <h2 align='center'>$title_booking</h2>
                      <p style='margin-top:25px' align='justify'>$message_booking</p>
                    </div>
                    <div class='row'>
                      <h2 align='center'>Datos de la Reserva</h2>
                      <p align='left'>$email_message</p>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>
      </body>
    </html>";



  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
  $headers .= 'Bcc: sactel@gmail.com'."\r\n";
  $headers .= 'From: '.$mailbooking."\r\n";

  /* Envia Mensaje de Reserva al Hotel */ 
  @mail($email_to, $email_subject, $mensajeReserva, $headers);  

  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
  $headers .= 'From: '.$mailbooking."\r\n";
  /* Envia Mensaje de Reserva al Huesped */ 
  @mail($mail, $email_subject, $message, $headers);  

 ?>
    <!-- <div class="jarallax agile-about w3ls-section" style="margin-bottom: 30px">
      <div class="container">
        <h2 class="w3ls_head" style="font-family: ubuntu"><?=RESUMEN_TRANSACTION?> </h2>
        <h3 align="center"></h3>
      </div>
      <div class="container">
        <?php 
        ?>
        <div class="row">        
          <h3 align="center">Informacion del Huesped</h3>
          <div class="form-horizontal" style="margin-top:15px">
            <div class="form-group">
              <label for="name" class="label-control col-lg-3"> Huesped</label>
              <div class="col-lg-9">
                <input name="name" type="text" id="name" class="form-control" value="<?=$infoBooking[0]['last_name']?> <?=$infoBooking[0]['name']?>" readonly>
              </div>            
            </div>            
            <div class="form-group">
              <label for="name" class="label-control col-lg-3"> Identificacion</label>
              <div class="col-lg-4">
                <input name="name" type="text" class="form-control" value="<?=$infoBooking[0]['identify']?>" readonly>
              </div>            
              <label for="name" class="label-control col-lg-2"> Telefono</label>
              <div class="col-lg-3">
                <input name="name" type="text" class="form-control" value="<?=$infoBooking[0]['phone']?>" readonly>
              </div>            
            </div>            
            <div class="form-group">
              <label for="name" class="label-control col-lg-3"> Email</label>
              <div class="col-lg-9">
                <input name="name" type="text" class="form-control" value="<?=$infoBooking[0]['email']?>" readonly>
              </div>            
            </div>            
            <div class="form-group">
              <label for="name" class="label-control col-lg-3"> Direccion</label>
              <div class="col-lg-9">
                <input name="name" type="text" class="form-control" value="<?=$infoBooking[0]['adress']?>" readonly>
              </div>            
            </div>            
            <div class="form-group">
              <label for="name" class="label-control col-lg-3"> Ciudad</label>
              <div class="col-lg-9">
                <input name="name" type="text" class="form-control" value="<?=$infoBooking[0]['city']?>" readonly>
              </div>            
            </div>
            <div class="form-group">
              <label for="name" class="label-control col-lg-3"> Pais</label>
              <div class="col-lg-9">
                <?php 
                $landname = $user->getNameLand($infoBooking[0]['id_land']);
                 ?>
                <input name="name" type="text" class="form-control" value="<?=$landname?>" readonly>
              </div>            
            </div>
            <div class="form-group">
              <label for="name" class="label-control col-lg-3"> Adultos</label>
              <div class="col-lg-3">
                <input name="name" type="text" class="form-control" value="<?=$infoBooking[0]['adults']?>" readonly>
              </div>            
              <label for="name" class="label-control col-lg-3"> Niños</label>
              <div class="col-lg-3">
                <input name="name" type="text" class="form-control" value="<?=$infoBooking[0]['children']?>" readonly>
              </div>            
            </div>            
          </div>
          <h3 align="center" style="margin-top: 30px;">Datos del Pago </h3>
          <div class="form-horizontal" style="margin-top:15px">
            <div class="form-group">
              <label for="name" class="label-control col-lg-4"> Estado de la transaccion</label>
              <div class="col-lg-8">
                <input name="name" type="text" id="name" class="form-control" value="<?=$pago?>" readonly>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <h3 align="center" style="margin-top: 30px;">Datos de la Reserva</h3>
          <div class="form-horizontal" style="margin-top:15px">
            <div class="form-group">
              <label for="name" class="label-control col-lg-2 col-md-2"> Hotel</label>
              <div class="col-lg-4 col-md-4">
                <input name="name" type="text" id="name" class="form-control" value="<?=$nombrehotel?>" readonly>
              </div>
              <label for="name" class="label-control col-lg-2 col-md-2"> Ciudad</label>
              <div class="col-lg-4 col-md-4">
                <input name="name" type="text" id="name" class="form-control" value="<?php echo strtoupper(ciudad_hotel($idhotel))?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="name" class="label-control col-lg-2 col-md-2"> Reserva Numero</label>
              <div class="col-lg-4 col-md-4">
                <input name="name" type="text" id="name" class="form-control" value="<?=$nro_reserva?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="name" class="label-control col-lg-2 col-md-2"> Fecha Estadia</label>
              <div class="col-lg-4 col-md-4">
                <input name="name" type="text" id="name" class="form-control" value="<?=date('Y-m-d',$infoBooking[0]['in_date'])?> / <?=date('Y-m-d',$infoBooking[0]['out_date'])?>" readonly>
              </div>
              <label for="name" class="label-control col-lg-2 col-md-2"> Noches</label>
              <div class="col-lg-4 col-md-4">
                <input name="name" type="text" id="name" class="form-control" value="<?=$infoBooking[0]['days']?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="name" class="label-control col-lg-2 col-md-2"> Tarifa X Noche</label>
              <div class="col-lg-4 col-md-4">
                <input name="name" type="text" class="form-control" value="<?=number_format($infoBooking[0]['price'],2)?>" readonly>
              </div>            
              <label for="name" class="label-control col-lg-2 col-md-2"> Valor Estadia</label>
              <div class="col-lg-4 col-md-4">
                <input name="name" type="text" class="form-control" value="<?=number_format($infoBooking[0]['vlr_booking'],2)?>" readonly>
              </div>       
            </div>            
            <div class="form-group">
              <label for="name" class="label-control col-lg-2 col-md-2"> Valor impuestos</label>
              <div class="col-lg-4 col-md-4">
                <input name="name" type="text" class="form-control" value="<?=number_format($infoBooking[0]['tax_booking'],2)?>" readonly>
              </div>            
              <label for="name" class="label-control col-lg-2 col-md-2"> Valor TOTAL</label>
              <div class="col-lg-4 col-md-4">
                <input name="name" type="text" class="form-control" value="<?=number_format($infoBooking[0]['tax_booking']+$infoBooking[0]['vlr_booking'],2)?>" readonly>
              </div>            
            </div>            
            <div class="form-group">
              <label for="name" class="label-control col-lg-2 col-md-2"> Habitaciones Reservadas</label>
              <div class="col-lg-4 col-md-4">
                <input name="name" type="text" class="form-control" value="<?=$infoBooking[0]['qty_room']?>" readonly>
              </div>            
              <label for="name" class="label-control col-lg-2 col-md-2"> Tipo de Habitacion</label>
              <div class="col-lg-4 col-md-4">
                <?php 
                $tipor    =  $infoBooking[0]['id_room'];
                $nameRoom = $user->getNameRoom($tipor);
                 ?>
                <input name="name" type="text" class="form-control" value="<?=$nameRoom?>" readonly>
              </div>            
            </div> 
            <div class="form-group">
              <label for="name" class="label-control col-lg-2"> Comentarios</label>
              <div class="col-lg-10">
                <textarea class="form-control" name="comments" id="comments" rows="5" readonly><?=$infoBooking[0]['comments']?></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="name" class="label-control col-lg-2 col-md-2"> Fecha Creacion Reserva</label>
              <div class="col-lg-4 col-md-4">
                <input name="name" type="text" class="form-control" value="<?=$infoBooking[0]['date_book']?>" readonly>
              </div>            
            </div>
          </div>
          
        </div>
      </div>
      <div class="row" style="margin-top:25px;text-align: center">
        <a href="home" class="btn btn-warning" ><i class="fa fa-home"></i> <?=HOME?></a>
      </div>
    </div> -->
