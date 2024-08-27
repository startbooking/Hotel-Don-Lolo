<?php
  require '../config.php' ;
  define("COMPANY", HOTEL_ID);
  require '../titles.php';
  require '../app_top.php'; 

if(!$_POST) exit;
	// Email address verification, do not edit.
	function isEmail($email) {
	  return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|me|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i",$email));
	}

if (!defined("PHP_EOL")) define("PHP_EOL", "\r\n");
	$name     = $_POST['FullName'];
	$phone    = $_POST['Phone'];
	$email    = $_POST['Email'];
	$subject  = $_POST['Subject'];
	$city     = $_POST['City'];
	$refer    = $_POST['Reference'];
	$comments = $_POST['Message'];

	if(get_magic_quotes_gpc()) {
	  $comments = stripslashes($comments);
	}

  $nombrehotel = $hotel[0]['hotel_name']; 

	$e_content = '';

  $message   = '
    <!DOCTYPE HTML>
    <html>
      <head>
      </head>
      <body>
        <div class="container">
          <div class="row"> 
            <div id="logo" style="padding:0"> 
              <div class="col-lg-2">
                <img style="width:50%" clas="img-responsive" id="default-logo" src="'.BASE_IMAGES.LOGO_HOTEL.'"> 
              </div>
              <div class="col-lg-10">
                <h2 style="padding:20px 0;font-size:40px" align="center">'.$nombrehotel.'</h2>
              </div>
            </div>
            <section id="contact-form" class="mt50">
              <div class="payment_info_area">
                <div class="hotel_booking_area">
                  <div class="hotel_booking margin-top-25">
                    <div class="row-fluid">
                      <h2 align="center"> Mensaje de Contacto</h2>
                      <p style="margin-top:25px" align="justify">';

$message2 =            '</p>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>
      </body>
    </html>
  ';




$address = strtolower($hotel[0]['email_contact']) ; // "reservas@sactel.co";

$e_subject = $subject;

$e_body = "Usted ha sido contactado por $name con respecto a $subject."."\n"."\n";
$e_body .= "Su mensaje adicional es."."\n"."\n";


$e_content .= "Nombres         : ".clean_string($name)."\n";
$e_content .= "Email           : ".clean_string($email)."\n";
$e_content .= "Telefono        : ".clean_string($phone)."\n";
$e_content .= "Ciudad          : ".clean_string($city)."\n";
$e_content .= "Comentarios     : ".clean_string($comments)."\n";
$e_content .= "Nos Conocio por : ".clean_string($refer)."\n";

// $e_content .= "\"$comments\"" . PHP_EOL . PHP_EOL;

$e_reply = "Contactar con $name via email, $email";
$msg = wordwrap( $e_body . $e_content . $e_reply, 70 );

$headers = "From: $email" . PHP_EOL;
$headers .= "Reply-To: $email" . PHP_EOL;
$headers .= "MIME-Version: 1.0" . PHP_EOL;
$headers .= "Content-type: text/plain; charset=utf-8" . PHP_EOL;
$headers .= "Content-Transfer-Encoding: quoted-printable" . PHP_EOL;

if(mail($address, $e_subject, $msg, $headers)) {
  echo "<h1>Email Enviado Correctamente !</h1>";
  echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'; 
  echo "<p>Gracias <strong>$name</strong>, Su mensaje ha sido enviado a nosotros.</p>";
  echo '</div>';

} else {

  echo 'ERROR!';

}