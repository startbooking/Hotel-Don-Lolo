
<?php

$nro_reserva = $_GET['reserva'];
$pago        = $_GET['pago'];

include"../../fpdf/fpdf.php";
require '../config.php' ;
require '../app_top.php'; 
require '../titles.php'; 

$idhotel = ID_HOTEL;
$hora = date('H:i:s a');
$fecha = date('d-m-Y ');

$infopayu = $user->getInfoPayu($pago);

if ($infopayu[0]['transaction_state'] == 4 ) {
    $estadoTx = "Transacción aprobada";
    $estadoRs = 3 ;
  }else if ($infopayu[0]['transaction_state'] == 6 ) {
    $estadoTx = "Transacción rechazada";
    $estadoRs = 2 ;
  }else if ($infopayu[0]['transaction_state'] == 104 ) {
    $estadoTx = "Error";
    $estadoRs = 2 ;
  }else if ($infopayu[0]['transaction_state'] == 7 ) {
    $estadoTx = "Transacción pendiente";
    $estadoRs = 1 ;
  }else {
    $estadoTx = $_REQUEST['mensaje'];
    $estadoRs = 0 ;
  }


/* require('../../fpdf/fpdf.php');
require '../config.php' ;
require '../app_top.php'; 
require '../titles.php'; 
*/
// echo BASE_IMAGES.LOGO_HOTEL;

class PDF extends FPDF{
protected $B = 0;
protected $I = 0;
protected $U = 0;
protected $HREF = '';

function WriteHTML($html){
  // Intérprete de HTML
  $html = str_replace("\n",' ',$html);
  $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
  foreach($a as $i=>$e){
    if($i%2==0){
      // Text
      if($this->HREF)
        $this->PutLink($this->HREF,$e);
      else
        $this->Write(5,$e);
    }else{
      // Etiqueta
      if($e[0]=='/')
        $this->CloseTag(strtoupper(substr($e,1)));
      else{
          // Extraer atributos
          $a2 = explode(' ',$e);
          $tag = strtoupper(array_shift($a2));
          $attr = array();
          foreach($a2 as $v){
            if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
              $attr[strtoupper($a3[1])] = $a3[2];
            }
            $this->OpenTag($tag,$attr);
        }
    }
  }
}

function OpenTag($tag, $attr){
    // Etiqueta de apertura
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,true);
    if($tag=='A')
        $this->HREF = $attr['HREF'];
    if($tag=='BR')
        $this->Ln(5);
}

function CloseTag($tag){
    // Etiqueta de cierre
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,false);
    if($tag=='A')
        $this->HREF = '';
}

function SetStyle($tag, $enable){
    // Modificar estilo y escoger la fuente correspondiente
    $this->$tag += ($enable ? 1 : -1);
    $style = '';
    foreach(array('B', 'I', 'U') as $s){
        if($this->$s>0)
            $style .= $s;
    }
    $this->SetFont('',$style);
}

function PutLink($URL, $txt){
    // Escribir un hiper-enlace
    $this->SetTextColor(0,0,255);
    $this->SetStyle('U',true);
    $this->Write(5,$txt,$URL);
    $this->SetStyle('U',false);
    $this->SetTextColor(0);
}
}

/*$html = 'Ahora puede imprimir fácilmente texto mezclando diferentes estilos: <b>negrita</b>, <i>itálica</i>,
<u>subrayado</u>, o ¡ <b><i><u>todos a la vez</u></i></b>!<br><br>También puede incluir enlaces en el
texto, como <a href="http://www.fpdf.org">www.fpdf.org</a>, o en una imagen: pulse en el logotipo.';
*/
$nombrehotel = $user->getHotelName($idhotel); 
$infoBooking = $user->getDetailBooking($idhotel,$nro_reserva);
$tipor =  $infoBooking[0]['id_room'];
$nameRoom = $user->getNameRoom($tipor);

$infoBooking[0]['last_name'].' '.$infoBooking[0]['name'];

$html = '    <div class="container">
      <h2 class="w3ls_head"><?=RESUMEN_TRANSACTION?> </h2>
      <h3 align="center"></h3>

    </div>
    <div class="container">
      <div class="col-lg-6 title-txt">
        <h3>Informacion del Huesped</h3>
        <div class="form-horizontal" style="margin-top:15px">
          <div class="form-group">
            <label for="name" class="label-control col-lg-3"> Huesped</label>
            <div class="col-lg-9">
              <input name="name" type="text" id="name" class="form-control" value="'.$infoBooking[0]['last_name'].' '.$infoBooking[0]['name'].'" readonly>
            </div>            
          </div>            
          <div class="form-group">
            <label for="name" class="label-control col-lg-3"> Identificacion</label>
            <div class="col-lg-4">
              <input name="name" type="text" class="form-control" value="'.$infoBooking[0]['identify'].'" readonly>
            </div>            
            <label for="name" class="label-control col-lg-2"> Telefono</label>
            <div class="col-lg-3">
              <input name="name" type="text" class="form-control" value="'.$infoBooking[0]['phone'].'" readonly>
            </div>            
          </div>            
          <div class="form-group">
            <label for="name" class="label-control col-lg-3"> Email</label>
            <div class="col-lg-9">
              <input name="name" type="text" class="form-control" value="'.$infoBooking[0]['email'].'" readonly>
            </div>            
          </div>            
          <div class="form-group">
            <label for="name" class="label-control col-lg-3"> Direccion</label>
            <div class="col-lg-9">
              <input name="name" type="text" class="form-control" value="'.$infoBooking[0]['adress'].'" readonly>
            </div>            
          </div>            
          <div class="form-group">
            <label for="name" class="label-control col-lg-3"> Ciudad</label>
            <div class="col-lg-9">
              <input name="name" type="text" class="form-control" value="'.$infoBooking[0]['city'].'" readonly>
            </div>            
          </div>
        </div>
        <h3>Datos de la Reserva</h3>
        <div class="form-horizontal" style="margin-top:15px">
          <div class="form-group">
            <label for="name" class="label-control col-lg-3"> Hotel</label>
            <div class="col-lg-9">
              <input name="name" type="text" id="name" class="form-control" value="'.$nombrehotel.'" readonly>
            </div>
          </div>
          <div class="form-group">
            <label for="name" class="label-control col-lg-3"> Ciudad</label>
            <div class="col-lg-9">
              <input name="name" type="text" id="name" class="form-control" value="'.strtoupper(ciudad_hotel($idhotel)).'" readonly>
            </div>
          </div>
          <div class="form-group">
            <label for="name" class="label-control col-lg-3"> Reserva Numero</label>
            <div class="col-lg-3">
              <input name="name" type="text" id="name" class="form-control" value="'.$nro_reserva.'" readonly>
            </div>
            <label for="name" class="label-control col-lg-3"> Habitaciones</label>
            <div class="col-lg-3">
              <input name="name" type="text" id="name" class="form-control" value="'.$infoBooking[0]['qty_room'].'" readonly>
            </div>
          </div>
          <div class="form-group">
            <label for="name" class="label-control col-lg-3"> Adultos</label>
            <div class="col-lg-2">
              <input name="name" type="text" class="form-control" value="'.$infoBooking[0]['adults'].'" readonly>
            </div>            
            <label for="name" class="label-control col-lg-1"> Niños</label>
            <div class="col-lg-2">
              <input name="name" type="text" class="form-control" value="'.$infoBooking[0]['children'].'" readonly>
            </div>            
          </div>            
          <div class="form-group">
            <label for="name" class="label-control col-lg-3"> Fecha Estadia</label>
            <div class="col-lg-5">
              <input name="name" type="text" id="name" class="form-control" value="'.date('Y-m-d',$infoBooking[0]['in_date']).' / '. date('Y-m-d',$infoBooking[0]['out_date']).'" readonly>
            </div>            
            <label for="name" class="label-control col-lg-2"> Noches</label>
            <div class="col-lg-2">
              <input name="name" type="text" class="form-control" value="'.$infoBooking[0]['days'].'" readonly>
            </div>            
          </div>
          <div class="form-group">
            <label for="name" class="label-control col-lg-3"> Tarifa X Noche</label>
            <div class="col-lg-3">
              <input name="name" type="text" class="form-control" value="'.number_format($infoBooking[0]['price'],2).'" readonly>
            </div>            
            <label for="name" class="label-control col-lg-3"> Valor Estadia</label>
            <div class="col-lg-3">
              <input name="name" type="text" class="form-control" value="'.number_format($infoBooking[0]['vlr_booking'],2).'" readonly>
            </div>       
          </div>            
          <div class="form-group">
            <label for="name" class="label-control col-lg-3"> Valor impuestos</label>
            <div class="col-lg-3">
              <input name="name" type="text" class="form-control" value="'.number_format($infoBooking[0]['tax_booking'],2).'" readonly>
            </div>            
            <label for="name" class="label-control col-lg-3"> Valor TOTAL</label>
            <div class="col-lg-3">
              <input name="name" type="text" class="form-control" value="'.number_format($infoBooking[0]['tax_booking']+$infoBooking[0]['vlr_booking'],2).'" readonly>
            </div>            
          </div>            
          <div class="form-group">
            <label for="name" class="label-control col-lg-3"> Tipo de Habitacion</label>
            <div class="col-lg-9">
              <input name="name" type="text" class="form-control" value="<?=$nameRoom?>" readonly>
            </div>            
          </div> 
          <div class="form-group">
            <label for="name" class="label-control col-lg-3"> Comentarios</label>
            <div class="col-lg-9">
              <textarea class="form-control" name="comments" id="comments" rows="5" readonly>'.$infoBooking[0]['comments'].'</textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="name" class="label-control col-lg-3"> Fecha Creacion Reserva</label>
            <div class="col-lg-9">
              <input name="name" type="text" class="form-control" value="'.$infoBooking[0]['date_book'].'" readonly>
            </div>            
          </div>
        </div>
      </div>
      <div class="col-lg-6 title-txt">
        <h3 align="center">Datos del Pago </h3>
        <div class="form-horizontal" style="margin-top:15px">
          
          <div class="form-group">
            <label for="name" class="label-control col-lg-4"> Estado de la transaccion</label>
            <div class="col-lg-8">
              <input name="name" type="text" id="name" class="form-control" value="'.$estadoTx.'" readonly>
            </div>
          </div>
          <div class="form-group">
            <label for="name" class="label-control col-lg-4"> ID de la transaccion</label>
            <div class="col-lg-8">
              <input name="name" type="text" id="name" class="form-control" value="'.$infopayu[0]['transaction_id'].'" readonly>
            </div>
          </div>
          <div class="form-group">
            <label for="name" class="label-control col-lg-4"> Referencia Venta</label>
            <div class="col-lg-8">
              <input name="name" type="text" id="name" class="form-control" value="'.$infopayu[0]['reference_pol'].'" readonly>
            </div>
          </div>
          <div class="form-group">
            <label for="name" class="label-control col-lg-4"> Referencia Transaccion</label>
            <div class="col-lg-8">
              <input name="name" type="text" id="name" class="form-control" value="'.$infopayu[0]['reference_code'].'" readonly>
            </div>
          </div>
          <?php
          if($infopayu[0]["pse_bank"] != null) {
            ?>
            <div class="form-group">
              <label for="name" class="label-control col-lg-4">cus</label>
              <div class="col-lg-8">
                <input name="name" type="text" id="name" class="form-control" value="'.$infopayu[0]['cus'].'" readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="name" class="label-control col-lg-4"> Banco</label>
              <div class="col-lg-8">
                <input name="name" type="text" id="name" class="form-control" value="'.$infopayu[0]['pse_bank'].'" readonly>
              </div>
            </div>
          <?php
          }
          ?>
            <div class="form-group">
              <label for="name" class="label-control col-lg-4"> Valor Total</label>
              <div class="col-lg-8">
                <input name="name" type="text" id="name" class="form-control" value="'.$infopayu[0]['currency'].' '.number_format($infopayu[0]['tx_value'],2).'" readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="name" class="label-control col-lg-4"> Descripción</label>
              <div class="col-lg-8">
                <input name="name" type="text" id="name" class="form-control" value="'.$infopayu[0]['extra1'].'" readonly>
              </div>
            </div>          
            <div class="form-group">
              <label for="name" class="label-control col-lg-4"> Entidad:</label>
              <div class="col-lg-8">
                <input name="name" type="text" id="name" class="form-control" value="'.$infopayu[0]['lap_payment'].'" readonly>
              </div>
            </div>          
          <?php
          ?>
        </div>
      </div>
    </div>';

$pdf = new PDF();
// Primera página
$archivo = DIR_ROOT.BASE_URL.'Reserva_'.rand(1000,4).'.pdf';
// echo $archivo;
$pdf->AddPage();
$pdf->SetFont('Arial','',20);
//$pdf->Write(5,'Para saber qué hay de nuevo en este tutorial, pulse ');
$pdf->SetFont('','U');
//$link = $pdf->AddLink();
//$pdf->Write(5,'aquí',$link);
//$pdf->SetFont('');
// Segunda página
// $pdf->AddPage();
//$pdf->SetLink($link);
$pdf->Image(DIR_ROOT.BASE_IMAGES.LOGO_HOTEL,10,12,30,0,'','http://www.fpdf.org');
$pdf->SetLeftMargin(45);
$pdf->SetFontSize(14);
$pdf->WriteHTML($html);
$pdf->Output($archivo,'F');

?>
