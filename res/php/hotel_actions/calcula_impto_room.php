<?php 
  require '../config.php' ;
  require '../app_top.php'; 

	$idhotel    = $_POST['idhotel'];
	$datapay    = $user->getDataPayHotel($idhotel);
	$valor      = $_POST['valor'];
	$impto      = $_POST['impto'];
	$natio      = $_POST['extranjero'];
	$nombres    = $_POST['nombres'];
	$nombhabi   = $_POST['nameha'];
	$namehotel  = $_POST['nameho'];
	$idbook     = $_POST['idbook'];
	$vlrestadia = $_POST['valorest'];
	$valimpto  = 0;
	if($natio=="false"){
		$valimpto = ($valor * $impto)/100;
		$baseimpto = $valor;
	}else{
		$baseimpto = 0;
	}

	$total = $valor+$valimpto; 

  $webpayu = "https://gateway.payulatam.com/ppp-web-gateway/";

  $singn = md5($datapay[0]["api_key"]."~".$datapay[0]["id_mercant"]."~"."Reserva Nro ".$idbook."~".$total."~".$datapay[0]["type_money"]) ;

	echo '
	<div class="col-lg-8 col-lg-offset-2">
		<div class="form-horizontal">
			<label class="control-label col-lg-4"> Valor Estadia </label>
			<div class="col-lg-8">
				<input style="font-size:16px;font-weight:700; !important" class="form-control" type="text" name="" value="'.number_format($valor,2).'" readonly>
			</div>
			<label class="control-label col-lg-4"> Impuestos </label>
			<div class="col-lg-8">
				<input style="font-size:16px;font-weight:700; !important" class="form-control" type="text" name="" value="'.number_format($valimpto,2).'" readonly>
			</div>
			<label class="control-label col-lg-4"> Total A Pagar </label>
			<div class="col-lg-8">
				<input style="font-size:16px;font-weight:700; !important" class="form-control" type="text" name="" value="'.number_format($total,2).'" readonly>
			</div>
		</div>
  </div>
  <div class="row" style=margin-top:15px">            
    <div class="col-lg-4 col-lg-offset-4" style="margin-top:25px">
      <form method="post" action="'.$webpayu.'">
        <input name ="merchantId"      type="hidden"  value="'.$datapay[0]["id_mercant"].'">
        <input name ="accountId"       type="hidden"  value="'.$datapay[0]["id_payu"].'">
        <input name ="description"     type="hidden"  value="'.$nombhabi.' '.$namehotel.'">
        <input name ="referenceCode"   type="hidden"  value="Reserva Nro '.$idbook.'">
        <input name ="amount"          type="hidden"  value="'.$total.'">
        <input name ="tax"             type="hidden"  value="'.$valimpto.'">
        <input name ="taxReturnBase"   type="hidden"  value="'.$baseimpto.'" >
        <input name ="currency"        type="hidden"  value="'.$datapay[0]['type_money'].'" >
        <input name ="signature"       type="hidden"  value="'.$singn.'"  >
        <input name ="test"            type="hidden"  value="'.$datapay[0]["test"].'" >
        <input name ="buyerEmail"      type="hidden"  value="'.$datapay[0]["paypal_email"].'" >
        <input name ="buyerFullName"   type="hidden"  value="'.$nombres.'" >
        <input name ="responseUrl"     type="hidden"  value="'.$datapay[0]["url_response_payu"].'" >
        <input name ="confirmationUrl" type="hidden"  value="'.$datapay[0]["url_confirm_payu"].'" >
        <input name ="lng" id="lng"    type="hidden"  value="es">

        <input class="btn btn-info btn-block btn-lg" name="Submit" type="submit"  value="Pago En Linea">
      </form> 
    </div>
  </div>
  '
	
		?>