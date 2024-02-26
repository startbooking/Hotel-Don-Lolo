<?php 
  require '../../../res/php/app_topHotel.php'; 
	
    $huespedes = $hotel->getPerfilHuespedes();

  echo json_encode($huespedes);
  
  
  foreach ($huespedes as $huesped) { ?>
    <tr style='font-size:12px'>
      <td width="22px"><?=$huesped["identificacion"]?></td>
      <td><?=$huesped["apellido1"].' '.$huesped["apellido2"].' '.$huesped["nombre1"].' '.$huesped["nombre2"]?></td>          
      <td><?=$huesped["celular"]?></td>
      <td><?=$huesped["email"]?></td>
      <td><?=$huesped["edad"]?></td>
      <td style="padding:3px;width: 13%">
        <nav class="navbar navbar-default" style="margin-bottom: 0px;min-height:0px;">
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding:1px">
            <ul class="nav navbar-nav">
              <li class="dropdown">
                <a 
                  href="#" 
                  class="dropdown-toggle" 
                  data-toggle="dropdown" 
                  role="button" 
                  aria-haspopup="true" 
                  aria-expanded="false" 
                  style="padding:3px 8px;font-weight:bold;color:#000">Ficha Huesped<span class="caret" style="margin-left:10px;"></span></a>
                <ul class="dropdown-menu submenu" style="left: -180px">  
                  <li>
                    <a 
                      data-toggle ="modal" 
                      data-id     ="<?=$huesped["id_huesped"]?>" 
                      data-nombre ="<?=$huesped["nombre_completo"]?>" 
                      href        ="#myModalModificaPerfilHuesped">
                    <i class="fa fa-address-card-o" aria-hidden="true"></i>
                    Modificar Perfil</a> 
                  </li>
                  <li>
                    <a  
                      data-toggle ="modal" 
                      data-id     ="<?=$huesped["id_huesped"]?>" 
                      data-nombre ="<?=$huesped["nombre_completo"]?>" 
                      href        ="#myModalReservasEsperadas">
                    <i class="fa fa-calendar-plus-o" aria-hidden="true"></i>
                    Reservas</a>
                  </li>
                  <li> 
                    <a 
                      data-toggle ="modal" 
                      data-id     ="<?=$huesped["id_huesped"]?>" 
                      data-nombre ="<?=$huesped["nombre_completo"]?>" 
                      href        ="#myModalHistoricoReservas">
                      <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                    Historico Reservas</a> 
                  </li>
                  
                  <li>
                    <a 
                      data-toggle ="modal" 
                      data-id     ="<?=$huesped["id_huesped"]?>" 
                      data-nombre ="<?=$huesped["nombre_completo"]?>" 
                      href        ="#myModalDocumentos">
                    <i class="fa fa-clone" aria-hidden="true"></i>
                    Documentos</a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>                                                  
      </td>
    </tr>    
    <?php
  }
?>
