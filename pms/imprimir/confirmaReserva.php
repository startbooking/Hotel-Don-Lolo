<?php

  setlocale(LC_ALL,"es_CO.utf8","es_CO","esp")  ;
  date_default_timezone_set("America/Bogota");

  require_once '../../res/php/titles.php';
  require_once '../../res/php/app_topHotel.php';
 
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  require '../../vendor/autoload.php';

  $mail = new PHPMailer;

  $link = 'http://'.$_SERVER["HTTP_HOST"];

  $reserva           = $_POST['reserva'];
  $usuario           = $_POST['usuario'];

  $datosReserva      = $hotel->getReservasDatos($reserva);
  $datosHuesped      = $hotel->getbuscaDatosHuesped($datosReserva[0]['id_huesped']);
  $datosCompania     = $hotel->getSeleccionaCompania($datosReserva[0]['id_compania']);

  $nombres = $datosHuesped[0]['nombre1'].' '.$datosHuesped[0]['nombre2'];
  $llega = fechaReserva($datosReserva[0]['fecha_llegada']);
  $sale  = fechaReserva($datosReserva[0]['fecha_salida']);
  $huesped = $datosHuesped[0]['apellido1'].' '.$datosHuesped[0]['apellido2'].' '.$datosHuesped[0]['nombre1'].' '.$datosHuesped[0]['nombre2'];
  $iden    = $datosHuesped[0]['identificacion'];

  $regisCia          = count($datosCompania) ;
  $fecha             = $hotel->getDatePms();

  $name = 'Reservas Hotel Quinto Nivel';
  $emaiConf =  $datosHuesped[0]['email'];
  // $emaiConf =  'sactel@gmail.com';
  // .';'.$datosCompania[0]['email'];
  if($emaiConf===''){
    ?>
    <div class="alert alert-danger"><h3 style="text-align:center;">Huesped sin Correo Electronico <br><span>Reserva sin Confirmar </span></h3></div>
    <?php
    return;
  }
  // $email_to = 'soporte@sactel.net';
  $email_to = $emaiConf;
  $email_subject   = 'Confirmacion Reserva';
  $email = 'reservas@hotelquintonivel.com';

$mensajeReserva = "
  <!DOCTYPE HTML>
  <html>
    <head>
      <title>Confirmacion Sistema de Administracion Hotelera SACTel PMS</title>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
      <meta name='viewport' content='width=device-width, initial-scale=1'>
      <link rel='icon' type='image/png' href='".$link.BASE_IMG."logoBarahona.png'>
      <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
      <link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
      <link rel='stylesheet' type='text/css' href='".$link.BASE_RES."dist/jquery.dataTables.css'>
      <link rel='stylesheet' type='text/css' href='".$link.BASE_RES."dist/dataTables.bootstrap.css'>
      <link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u' crossorigin='anonymous'> 
      <link href='".$link.BASE_CSS."AdminLTE.css' rel='stylesheet' type='text/css'>
      <link href='".$link.BASE_CSS."_all-skins.css' rel='stylesheet' type='text/css'>
      <link rel='stylesheet' type='text/css' href='".$link.BASE_CSS."sweetalert.css'>
      <link rel='stylesheet' type='text/css' href='".$link.BASE_CSS."style.css'>
      <link rel='stylesheet' type='text/css' href='".$link.BASE_CSS."fuentes.css'>
      <link rel='stylesheet' type='text/css' href='".$link."/pms/res/css/pms.css'>
      <script src='".$link.BASE_WEB."res/js/inicio.js'></script>
      <style>
        body{
          font-family:geosanslight;
        }
      </style>
    </head>
    <body>
      <div class='container col-lg-8' style='margin-bottom:50px;'>
        <div class='row'>
          <img style='width:100%' src='".$link.BASE_IMG."bannerQ.jpg' alt=''>
        </div>
        <div class='row'>
          <img style='width:100%;' src='".$link.BASE_IMG."fachadaHotel.jpg' alt=''>
        </div>
        <div class='row' style='text-align: center;font-family:geosanslight;'>
          <h2 style='text-align: center;font-family:geosanslight;font-weight:800;'>".utf8_decode($nombres)." </h2>
          <h3 style='text-align: center;font-family:geosanslight;'>Tu reserva fue confirmada </h3>
          <h3 style='font-family:geosanslightoblique;'>".utf8_decode('Escogiste la mejor opción para descansar')."</h3>
        </div>
        <div class='row'>
          <div class='alert-confirm'>
            <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'><h4 class='izquierda'>".$llega."</h4></div>
            <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'><h4 class='derecha'>".$sale."</h4></div>
            <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'><h4 class='izquierda'>Check In a partir de las 14:00</h4> </div>
            <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'><h4 class='derecha'>Check Out  hasta las 11:00</h4></div>
          </div>
        </div>
        <div class='row' style='text-align: center;font-family:geosanslight;'>
          <div class='col-lg-4 col-md-4 col-sm-6 col-xs-12'>
            <h3 style='font-family:geosanslight;font-weight:800;'>".utf8_decode($huesped)."</h3>
          </div>
          <div class='col-lg-4 col-md-4 col-sm-6 col-xs-12'><h3 style='font-family:geosanslight;'>CC ".$iden."</h3></div>
          <div class='col-lg-4 col-md-4 col-sm-6 col-xs-12'><h3 style='font-family:geosanslight;font-weight:800'>Reserva Nro ".$reserva."</h3>  </div>
        </div>
      </div>
    </body>
  </html>"
;

$mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
$mail->isSMTP();                                            //Send using SMTP
$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
$mail->Username   = 'reservashotelquintonivel@gmail.com';                     //SMTP username
$mail->Password   = 'otusitcwpybgjyhc';                               //SMTP password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
$mail->Port       = 465;
$mail->IsHTML(true);

$mail->From = $email;
$mail->FromName = $name;
$mail->AddAddress($email_to, $huesped);

$mail->WordWrap = 70;                                 // set word wrap to 50 characters
$mail->IsHTML(true);                                  // set email format to HTML

$mail->Subject = $email_subject;
$mail->Body    = $mensajeReserva;
$mail->AltBody = $mensajeReserva;;

if(!$mail->Send()){
   echo "Message could not be sent. <p>";
   echo "Mailer Error: " . $mail->ErrorInfo;
   exit;
}

?>
<div class="alert alert-success"><h3 style="text-align:center;">Reserva Confirmada con Exito</h3></div>
