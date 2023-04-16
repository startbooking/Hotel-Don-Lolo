<?php 
  $idamb         = $_SESSION['AMBIENTE_ID'] ;
  $descuentos    = $pos->getDescuentosPos($idamb);
  $mesas         = $pos->getMesasAmbi($_SESSION['AMBIENTE_ID']);
  $formasdepagos = $pos->getFormasPago();
  $datosClientes = $pos->getClientes();
  
?>

<div class="col-lg-9 col-md-9">
  <h3 class='tituloComanda' align="center" style="font-weight:600">Comanda Numero <?=$com?></h3>
  <input type="hidden" name="numeroComanda" id="numeroComanda" value="<?=$com?>">
</div>
<div class="col-lg-3 col-md-3">
  <h3 align="center" style="font-weight:600"></h3>
</div>
<div class="col-lg-9 col-md-9" >
  <div class="row-fluid" style="overflow:auto;top:40px;height:390px;background-color:#FCF7AB;padding:5px" id="factura">
    <table class="table table-hover comanda">
      <thead>
        <tr class="info">
          <th style="width:60%">Productos</th>
          <th style="width:5%">Cant.</th>
          <th style="width:25%">Valor</th>
          <th style="width:10%">Accion</th>
        </tr>
      </thead>
      <?php 
        $ambiente = $_SESSION['AMBIENTE_ID'];
        $usuario  = $_SESSION['usuario'];
        $impuesto = $_SESSION['IMPUESTO'];
        $propina  = $_SESSION['PROPINA'];
        $neto = 0;
        $na   = 0;
        $subt = 0;
        $pro  = 0;
        $impt = 0;
        $sub  = 0;
        $val  = 0;
        $imp  = 0;
        $des  = 0;
        foreach ($prodventas as $vtaprod) : 
          $na=$na+$vtaprod['cant']; 
          ?>
          <tr style="font-size:15px;height: 14px">
            <td width="60%"><?php echo $vtaprod['nom']; ?></td>
            <td width="5%"><center><?php echo $vtaprod['cant']; ?></center></td>
            <td align="right" width="25%">
              $ <?php echo number_format($vtaprod['venta'],0,",",".");?>
            </td>
            <td align="center" width="10%">
              <button type="button" onclick="getBorraVentas(this.name)" type="button" class="glyphicon glyphicon-trash btn btn-danger btn-xs" name="<?php echo $vtaprod['producto_id']; ?>"></button>
            </td>
          </tr>
          <?php
            $subt = $vtaprod['venta'];
            $impt = $vtaprod['valorimpto'];
            $sub  = $sub+$subt;
            $imp  = $imp+$impt;  
            $des  = $des+$vtaprod['descuento'];
            $neto = $sub+$imp+$pro-$des;
        endforeach  
      ?>
    </table>
  </div>
  <div class="row-fluid" id="valores" style='margin-top:0px;background-color: #B9E3E4B3'>
    <table class="table table-responsive estadoComanda" style="margin-bottom: 0px;font-size:14px">
      <tr align="right">
        <td style="padding:2px">Total Productos</td>
        <td style="padding:2px"><?php echo $na; ?></td>
        <td style="padding:2px" align="right">Valor Cuenta</td>
        <td style="padding:2px" align="right">
            <?php 
              echo '$ '.number_format($sub,2,",",".");
            ?>
        </td>
      </tr>
      <tr align="right">
        <td style="padding:2px">Descuento</td>
        <td style="padding:2px" align="right"><?=number_format($des,2)?></td>
        <td style="padding:2px" align="right">Impuesto</td>
        <td style="padding:2px" align="right"><?=number_format($imp,2)?> </td>
      </tr>
    </table>
    <table class="table table-responsive estadoComanda">
      <tr>
        <td style="padding:2px"></td>
        <td style="padding:2px"></td>
        <td style="padding:2px" align="right">Total Presente Cuenta</td>
        <td style="padding:2px" align="right">
          <?php 
            echo '$ '.number_format($neto,2,",",".");
          ?>
        </td>
      </tr>
    </table>
  </div>
</div>
<div class="col-lg-3 col-md-3 menuComanda">
  <div class="row-fluid" id='menu'>
    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
      <div class="btn-group-vertical mr-2" role="group" aria-label="First group">
        <button 
          style="height: 64px"
          type="button" 
          class="btn btn-success" 
          onclick="recuperarCuenta()"
          title="Recuperar Presente Cuenta">
          <i class="fa fa-save"></i> Recuperar Comanda
        </button>
        <button 
          style="height: 64px;"
          data-toggle    ="modal" 
          type="button" 
          class="btn btn-warning" 
          data-target="#myModalDescuento" 
          name="<?php echo $_SESSION['usuario'];?>" 
          title="Anula Ingreso Presente Cuenta">
          <i class="fa fa-calculator"></i> Descuento
        </button>
        <button 
          style="height: 64px;overflow: hidden;"
          type="button" 
          class="btn btn-default" 
          data-toggle="modal" 
          data-target="#myImprimirCuenta" 
          onclick="imprimeEstadoCuenta()"
          title="Imprimir Presente Cuenta">
          <i class="fa fa-print"></i> Estado de Cuenta
        </button>
        <button type="button" class="btn btn-danger"
          style="height: 64px;"
          title="Anular Presente Cuenta"
          data-toggle="modal"
          name="<?php echo $_SESSION['usuario'];?>" 
          data-target="#myModalAnulaComanda" 
          ><i class="fa fa-trash-o"></i> Anular Comanda
        </button> 
        <button type="button" class="btn btn-info"
          style="height: 64px;"
          title          ="Pagar Presente Cuenta" 
          data-toggle    ="modal" 
          data-nombre    ="<?php echo $_SESSION['usuario'];?>" 
          data-subtotal  ="<?php echo $sub?>" 
          data-descuento ="<?php echo $des?>" 
          data-productos ="<?php echo $na?>" 
          data-sugerida  ="<?php echo $pro?>" 
          data-impuesto  ="<?php echo $imp?>" 
          data-total     ="<?php echo $neto?>" 
          data-target    ="#myModalPagarComanda"
          onclick        ="botonPagarComanda()" 
          ><i class="fa fa-money"></i> Pagar
        </button>
        <button 
          style="height: 64px;overflow: hidden;margin-top:30px;"
          type="button" 
          class="btn btn-default" 
          data-toggle="modal" 
          data-target="#myImprimirCuenta" 
          onclick="imprimeComanda()"
          title="Imprimir Presente Cuenta">
          <i class="fa fa-print"></i> Imprimir Comanda
        </button>
        <button 
          style="height: 64px;background-color: yellow;border-color:yellow;color:black;padding:20px 0;"
          type="button" 
          class="btn btn-success" 
          onclick        ="enviaInicio()"           
          title="Recuperar Presente Cuenta">
          <i class="fa fa-home"></i> Regresar
        </button>
      </div>
    </div>
  </div>
</div>
  <!-- Modal Guardar Comanda-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content modal-sm">
      <div class="modal-header">
        <button type="button" class="close glyphicon glyphicon-off" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
        <h4 class="modal-title" id="myModalLabel">Guardar Comanda</h4>
            <h3><?= $_SESSION['NOMBRE_AMBIENTE']?></h3>  
      </div>
      <form action="../../res/php/getGuardaComanda.php" method="POST" accept-charset="utf-8">
        <div class="modal-body">
          <div class="form-group">
            <label for="mesa">Numero de Mesa</label>
            <select class="form-control" name='mesas' id='mesas'>"
            <?php
            foreach ($mesas as $mesa) { ?>
              <option value="<?php echo $mesa['numero_mesa'];?>"><?php echo $mesa['numero_mesa'];?></option>
              <?php 
            }
            ?>
            </select>
          </div>
          <div class="form-group">
            <label for="pax">Personas</label>
            <input type ="hidden" name="usuario" value="<?=$_SESSION['usuario']?>" >
            <input type ="hidden" name="ambiente" value="<?=$_SESSION['AMBIENTE']?>" >
            <input value="1" type="number" class="form-control" name="pax" id="pax" placeholder="" min=1 max=10>
          </div>
        </div>
        <div class="modal-footer">
          <button style="width: 30%" type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
          <button style="width: 30%" type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal Pagar-->

<div class="modal fade" id="myModalPagarComanda" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form class="form-horizontal" method="POST" accept-charset="utf-8" id="pagarCuenta" action="javascript:pagarFacturaComanda()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content modal-md">
        <div class="modal-header">
          <button type="button" class="close glyphicon glyphicon-off" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
          <h3 style="font-weight: 700;font-family: 'ubuntu" class="modal-title" id="myModalLabel"><i class="fa fa-money"></i> Pagar Presente Cuenta</h3>
          <h4 style="font-weight: 500;font-family: 'ubuntu"><?= $_SESSION['NOMBRE_AMBIENTE']?></h4>
          <h5 class="titulocuenta">Comanda Nro <span class="badge comanda"></span></h5>  
          <input type="hidden" name="comanda" id="comanda" value="0"> 
        </div>
        <div class="modal-body">
          <?php 
            $val       = $neto;
            $total     = $sub+$imp+$pro ;
            $descu     = $des ;
            $pagado    = 0 ;
            $resultado = 0 ;
          ?>
          <div class="form-group" >
            <input type="hidden" id="sugerida" value="<?=$pro?>">
            <label class="col-lg-3 col-md-3 control-label" style="padding-top:0">Forma de Pago</label>
            <div class="col-lg-8 col-md-8"> 
              <select onchange="getFormaPago(this.value)" name='formapago' id='formapago' required >
                <option value="">Seleccione la Forma de Pago</option>
                <?php
                  foreach ($formasdepagos as $pago) :
                    ?>
                    <option name="<?php echo $pago['id_pago'];?>" value="<?php echo $pago['id_pago'];?>"><?php echo $pago['descripcion'];?></option>
                    <?php 
                  endforeach
                ?>
              </select>
            </div>
          </div>
          <div class="form-group" id="clientesPago">
            <label class="col-lg-3 col-md-3 control-label" style="padding-top:0">Cliente</label>
            <div class="col-lg-8 col-md-8">
              <select name="clientes" id='clientes' required>
                <option value="">Seleccione el Cliente </option>
                <?php 
                  foreach ($datosClientes as $cliente) { ?>
                    <option value="<?=$cliente['id_cliente']?>"><?=$cliente['apellido1'].' '.$cliente['apellido2'].' '.$cliente['nombre1'].' '.$cliente['apellido2']?></option> 
                    <?php 
                  }
                 ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class='col-lg-3 col-md-3 control-label ctrlCta' style="padding-top:0">Subtotal</label>
            <div class="col-lg-3 col-md-3">
              <input class="suma_propina form-control" name="subtotal" id="subtotal" readonly>
            </div>
            <label class='col-lg-2 col-md-2 control-label ctrlCta' style="padding-top:0" >Impo consumo</label>
            <div class="col-lg-3 col-md-3">
              <input class="suma_propina form-control" name="impuesto" id="impuesto" readonly>
            </div>
          </div>
          <div class="form-group">
            <label class='col-lg-3 col-md-3 control-label ctrlCta' style="padding-top:0">Propina</label>
            <div class="col-lg-3 col-md-3">
              <input value="<?= $pro?>" minvalue="0" type="number" class="suma_propina form-control" name="propina" id="propina" onblur="calcular_total()">
            </div>
          </div>

          <div class="form-group">
            <label for="pax" class='col-lg-3 col-md-3 control-label ctrlCta' style="padding-top:0">Total Cuenta</label>
            <div class="col-lg-3 col-md-3">   
            <input class="form-control" name="total" id="total" readonly>
            </div>
          </div>

          <div class="form-group">
            <label for="pax" class='col-lg-3 col-md-3 control-label ctrlCta' style="padding-top:0">Valor Pagado</label>
            <div class="col-lg-3 col-md-3">   
            <input value="<?= $pagado ?>" required type="number" class="form-control" name="pagado" id="pagado" onblur="calculaCambio($('#total').val(), $('#pagado').val());return false;" >
            </div>
          </div>
          <div id="resultado" style="margin-top:15px;"></div>
        </div>
        <div class="modal-footer">
          <input name = 'ambiente' type="hidden" value='<?= $ambiente?>'>
          <input name = 'usuario'  type="hidden" value='<?= $usuario?>'>
          <input name = 'cambio'   type="hidden" value='<?= $pagado-$total?>'>
          <div class="col-sm-8 col-sm-offset-2">
            <div class="btn-group" role="group">
              <button type="button" style="width: 50%" class="btn btn-warning" data-dismiss="modal"> <i class="fa fa-reply"></i> Cancelar</button>
              <button type="submit" style="width: 50%" class="btn btn-primary" ><i class="fa fa-money"></i> Pagar</button>
            </div>
          </div>
        </div>
      </div>
    </div> 
  </form>
</div>


<!-- Modal Descuentos-->
<div class="modal fade" id="myModalDescuento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content modal-md">
      <div class="modal-header">
        <button type="button" class="close glyphicon glyphicon-off" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
        <h3 class="modal-title" id="myModalLabel">Descuento Presente Cuenta</h3>
        <h4><?=$_SESSION['NOMBRE_AMBIENTE']?></h4>  
      </div>
      <form class="form-horizontal" method="POST" id="formdescuento" name="descuento" action="javascript:getDescuento()">
        <div class="modal-body">
          <?php 
            $val       = $neto;
            $total     = $sub+$imp+$pro ;
            $pagado    = 0 ;
            $pms       = 0 ;
            $resultado = 0 ;
          ?>
          <div class="form-group" >
            <label class="col-lg-4 col-md-4 control-label" style="padding-top:0">Tipo de Descuento</label>
            <div class="col-lg-8 col-md-8"> 
              <select name='tipodesc' id='tipodesc' required >
                <option  value="">Seleccione El Tipo de Descuento</option>
                <?php
                foreach ($descuentos as $descuento) { ?>
                  <option  id="tipodesc" value="<?php echo $descuento['id_descuento'];?>"><?php echo $descuento['descripcion_descuento']  ;?></option>
                  <?php 
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-4 col-md-4 control-label" style="padding-top:0">Motivo Descuento</label>
            <div class="col-lg-8 col-md-8"> 
              <input type="text" class="form-control" name="motivoDesc" id="motivoDesc" required="">
            </div>           
          </div>
          <div id="resultado"></div>              
        </div>
        <div class="modal-footer">
          <input id = 'comanda'  type="hidden" value='0'>
          <input id = 'ambiente' type="hidden" value='<?=$ambiente?>'>
          <input id = 'usuario'  type="hidden" value='<?=$usuario?>'>
          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Cancelar</button>
          <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="myModalAnulaComanda" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content modal-md">
      <div class="modal-header">
        <button type="button" class="close glyphicon glyphicon-off" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
        <h3 class="modal-title" id="myModalLabel"><i class="fa fa-money"></i>Anular Comanda Actual</h3>
        <h4><?=$_SESSION['NOMBRE_AMBIENTE']?></h4>  
      </div>
      <form class="form-horizontal" method="POST" id="formdescuento" name="descuento" action="javascript:getAnulaComanda()">
        <div class="modal-body">
          <?php  
            $val       = $neto;
            $total     = $sub+$imp+$pro ;
            $pagado    = 0 ;
            $pms       = 0 ;
            $resultado = 0 ;
          ?>
          <div class="form-group">
            <label class="col-lg-4 col-md-4 control-label" style="padding-top:0">Motivo Anulacion</label>
            <div class="col-lg-8 col-md-8"> 
              <input type="text" class="form-control" name="motivoAnula" id="motivoAnula" required="">
            </div>           
          </div>
          <div id="resultado"></div>              
        </div>
        <div class="modal-footer">
          <input id = 'comanda'  type="hidden" value='0'>
          <input id = 'ambiente' type="hidden" value='<?=$ambiente?>'>
          <input id = 'usuario'  type="hidden" value='<?=$usuario?>'>
          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Cancelar</button>
          <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Procesar</button>
        </div>
      </form>
    </div>
  </div>
</div>

