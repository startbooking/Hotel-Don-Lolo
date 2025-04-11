<?php

  require '../app_top.php'; 


$fecha      = date("Y-m-d H:i:s");
$ip         = $_SERVER['REMOTE_ADDR'];

if(!$_POST) exit;
	// Email address verification, do not edit.
	function isEmail($email) {
	  return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|me|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i",$email));
}

if (!defined("PHP_EOL")) define("PHP_EOL", "\r\n");

$name     = $_POST['nombres'];
$email    = htmlspecialchars($_POST['correo']);  
$phone    = $_POST['telefono'];
$subject  = htmlspecialchars($_POST['asunto']);
$comments = htmlspecialchars($_POST['comments']);
$idSoporte = $_POST['idSoporte'];

$comments = stripslashes($comments);

$envio = $user->adicionaSoporte($name, $email, $phone, $subject, $comments, $idSoporte, $ip);

$address = 'soporte@sactel.net' ;

$e_subject = 'Nos ha contactado : ' . $name . '.';

$e_body = "Usted ha sido contactado por $name con respecto a $subject, su mensaje adicional es ." . PHP_EOL . PHP_EOL;
$e_content = "\"$comments\"" . PHP_EOL . PHP_EOL;
$e_reply = "Contactar con $name via email, $email o Celular Nro $phone";

$msg = wordwrap( $e_body . $e_content . $e_reply, 70 );

$headers = "From: $email" . PHP_EOL;
$headers .= "Reply-To: $email" . PHP_EOL;
$headers .= "MIME-Version: 1.0" . PHP_EOL;
$headers .= "Content-type: text/plain; charset=utf-8" . PHP_EOL;
$headers .= "Content-Transfer-Encoding: quoted-printable" . PHP_EOL;

if(mail($address, $e_subject, $msg, $headers)) {
	echo '
	<div class="alert alert-info"> 
	  <h3 style="text-align: center;font-weight: bold;margin: 10px">Email Enviado Correctamente !</h3>
		  <p>Gracias <strong>'.strtoupper($name).'</strong>, Su mensaje ha sido enviado con exito, en las proximas horas 	recibida informacion sobre su correo.</p>
		  <p>Si desea Saber el Estado de su Soporte haga referencia a este numero '.$idSoporte.'</p>
	</div>
	'	;
} else {

  echo '
  <div class="alert alert-danger">
  <h3 class="alert alert-danger" style="text-align:center;font-weight:bold;margin:0px;">ERROR!, No Se envio el correo, Revise su informacion</h3>
  </div>';
}