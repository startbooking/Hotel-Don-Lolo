<?php 

  require '../../../res/php/app_topHotel.php'; 

  $nuevo      = $_POST['nuevo'];
  $idhues     = $_POST['idhues'];
  $identifica = $_POST['identifica'];
  $apellidos  = $_POST['apellidos'];
  $nombres    = $_POST['nombres'];
  $usuario    = $_POST['usuario'];
  $idusuario  = $_POST['idusuario'];
  $nrocuenta  = $_POST['nrocuenta'];
  $llegada    = $_POST['llegada'];
  $noches     = $_POST['noches'];
  $salida     = $_POST['salida'];

  $posApe     = strpos($apellidos, ' ');
  $posNom     = strpos($nombres, ' ');
  $idhuesped  = $idhues;

  $apellido1  = strtoupper(substr($_POST['apellidos'],0,$posApe));
  $apellido2  = strtoupper(substr($_POST['apellidos'],$posApe));
  $nombre1    = strtoupper(substr($_POST['nombres'],0,$posNom));
  $nombre2    = strtoupper(substr($_POST['nombres'],$posNom));

  if($idhues==0){
    $idhuesped = $hotel->creaHuespedDirecto($identifica, $apellido1, $apellido2, $nombre1, $nombre2, $usuario, $idusuario);
  }


  $idcia         =  0;
  $idCentro      =  0;
  
  $hombres       =  1;
  $mujeres       =  0;
  $ninos         =  0;
  $tipohabi      =  1;
  $orden         =  '';
  $nrohabitacion =  $_POST['nrocuenta'];
  $tarifahab     =  0;
  $valortarifa   =  0;
  $origen        =  '';
  $destino       =  ''; 
  $motivo        =  '';
  $fuente        =  '';
  $segmento      =  '';
  /// $idhuesp       =  $_POST['idhuesped'];
  $idusuario     =  $_POST['idusuario'];
  $usuario       =  $_POST['usuario'];
  $tipo          =  2;
  $estado        =  'CA';
  $formapa       =  1;
  $impto         =  0;
  $observa       =  '';

  $numero      = $hotel->getNumeroReserva(); // Numero Actual de La Reserva
  $nuevonumero = $hotel->updateNumeroReserva($numero + 1); // Actualiza Consecutivo de Reserva

  $reserva = $hotel->insertNuevaReserva($iden, $llegada, $salida, $noches, $hombres, $mujeres, $ninos, $orden, $tipohabi, $nrohabitacion, $tarifahab, $valortarifa, $origen, $destino, $motivo, $fuente, $segmento, $idhuesped, $idcia, $idCentro, $numero, $usuario, $estado,$observa, $formapa, 0, $impto, $idusuario, $tipo);

  sleep(1);

  $datosReserva   = $hotel->getReservasDatos($numero);



?>

<div class="panel-body">
  <div id="imprimeRegistroHotelero"></div>
  <div class="container-fluid">
    <h2>Folios Consumos</h2>
    <input type="hidden" name="reservaActual" id="reservaActual" value="<?=$numero?>">
    <div id="mensajeCargo"></div>
    <ul class="nav nav-tabs nav-justified">
      <li class="active folios" id="folios1">
        <a style="cursor:pointer;" data-toggle="tab" onclick="activaFolio(<?=$numero?>,1)">Folio 1
        <?php 
        if($saldofolio1<> 0){ ?>
          <span class="fa-stack fa-xs" title="Reserva con Depositos" style="margin-left:0px;cursor:pointer;">
            <i style="font-size:20px;color: #085908" class="fa fa-circle fa-stack-2x"></i>
            <i style="font-size:10px;margin-top: -2px;margin-left: 1px;" class="fa fa-usd fa-stack-1x fa-inverse"></i>
          </span>
          <?php 
        }
        ?>
        </a>
      </li>
      <li class="folios" id="folios2">
        <a style="cursor:pointer;" data-toggle="tab" onclick="activaFolio(<?=$numero?>,2)">Folio 2 
          <?php 
          if($saldofolio2<> 0){ ?>
            <span class="fa-stack fa-xs" title="Reserva con Depositos" style="margin-left:0px;cursor:pointer;">
            <i style="font-size:20px;color: #085908" class="fa fa-circle fa-stack-2x"></i>
            <i style="font-size:10px;margin-top: -2px;margin-left: 1px;" class="fa fa-usd fa-stack-1x fa-inverse"></i>
          </span>
            <?php 
          }
          ?>
        </a>
      </li>
      <li class="folios" id="folios3">
        <a style="cursor:pointer;" data-toggle="tab" onclick="activaFolio(<?=$numero?>,3)">Folio 3
          <?php 
          if($saldofolio3<> 0){ ?>
            <span class="fa-stack fa-xs" title="Reserva con Depositos" style="margin-left:0px;cursor:pointer;">
            <i style="font-size:20px;color: #085908" class="fa fa-circle fa-stack-2x"></i>
            <i style="font-size:10px;margin-top: -2px;margin-left: 1px;" class="fa fa-usd fa-stack-1x fa-inverse"></i>
          </span>
            <?php 
          }
          ?>
        </a>
      </li>
      <li class="folios" id="folios4">
        <a style="cursor:pointer;" data-toggle="tab" onclick="activaFolio(<?=$numero?>,4)">Folio 4
          <?php 
          if($saldofolio4<> 0){ ?>
            <span class="fa-stack fa-xs" title="Reserva con Depositos" style="margin-left:0px;cursor:pointer;">
            <i style="font-size:20px;color: #085908" class="fa fa-circle fa-stack-2x"></i>
            <i style="font-size:10px;margin-top: -2px;margin-left: 1px;" class="fa fa-usd fa-stack-1x fa-inverse"></i>
          </span>
            <?php 
          }
          ?>
        </a>
      </li>
    </ul>
    <div class="tab-content">
      <div class="folio" id="folio1" class="tab-pane fade in active">
        <div class="saldoFolioRoom1" style="font-size:12px"></div>
      </div>
      <div class="folio" id="folio2" class="tab-pane fade">
        <div class="saldoFolioRoom2" style="font-size:12px"></div>
      </div>
      <div class="folio" id="folio3" class="tab-pane fade">
        <div class="saldoFolioRoom3" style="font-size:12px"></div>
      </div>
      <div class="folio" id="folio4" class="tab-pane fade">
        <div class="saldoFolioRoom4" style="font-size:12px"></div>
      </div>
    </div>
  </div>          
</div>
<div class="panel-footer" style="background-color:lightgoldenrodyellow">
  <div class="container-fluid" id='saldoReserva'></div>
  <div class="container-fluid" style='padding: 0px'>
    <div class="col-sm-8 col-sm-offset-2">
      <div class="btn-toolbar" role="toolbar" aria-label="...">      
        <div class="btn-group" style="width: 100%;" role="group" aria-label="...">
          <a 
            style="width: 33%;"
            type           ="button" 
            class          ="btn btn-success" 
            data-toggle    ="modal" 
            data-target    ="#myModalSalidaHuesped"
            data-id        ="<?php echo $numero?>" 
            data-idhues    ="<?php echo $idhuesped?>" 
            data-idcia     ="<?php echo $idcia?>" 
            data-idcentro  ="<?php echo $idCentro?>" 
            data-nrohab    ="<?php echo $nrocuenta?>" 
            data-nombre    ="<?php echo $apellidos.' '.$nombres?>" 
            data-apellido1 ="<?php echo $apellido1?>" 
            data-apellido2 ="<?php echo $apellido2?>" 
            data-nombre1   ="<?php echo $nombre1?>" 
            data-nombre2   ="<?php echo $nombre2?>" 
            data-impto     ="<?php echo $impto?>" 
            data-llegada   ="<?php echo $llegada?>" 
            data-salida    ="<?php echo $salida?>" 
            data-valor     ="<?php echo $valortarifa?>" 
            ><i class="fa fa-sign-out"></i> Salida Huesped</a>
          <a  
            style="width: 33%;"
            type           ="button" 
            class          ="btn btn-info "  
            data-toggle    ="modal" 
            data-id        ="<?php echo $numero?>" 
            data-nombre    ="<?php echo $apellidos.' '.$onmbres?>" 
            data-apellido1 ="<?php echo $apellido1?>" 
            data-apellido2 ="<?php echo $apellido2?>" 
            data-nombre1   ="<?php echo $nombre1?>" 
            data-nombre2   ="<?php echo $nombre2?>" 
            data-impto     ="<?php echo $impto?>" 
            data-nrohab    ="<?php echo $nrocuenta?>" 
            data-idhuesped ="<?php echo $idhuesped?>" 
            href           ="#myModalCargosConsumo"
            ><i class      ="fa fa-plus-square"></i> Ingreso Consumos 
          </a>
          <a  
            style="width: 33%;"
            type="button" 
            class="btn btn-warning"
            href="home"
            ><i class="fa fa-home"></i> Inicio
          </a>
        </div>
      </div>
    </div>            
  </div>     
</div>
