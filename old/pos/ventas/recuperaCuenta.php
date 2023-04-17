<?php
  require '../../res/php/titles.php';
  require '../../res/php/app_topPos.php'; 
  
  $idamb = $_POST['id'];
  $amb   = $_POST['amb'];
  $pref  = $_POST['pref'];
  $user  = $_POST['user'];
  $impto = $_POST['impto'];
  $prop  = $_POST['prop'];
  
  $mesas         = $pos->getMesasAmbi($idamb);
  $descuentos    = $pos->getDescuentosPos($idamb);
  $formasdepagos = $pos->getFormasdePago();
  $datosClientes = $pos->getClientes();
  $productos     = $pos->getProductosTmp($user,$idamb);

?>

    <div class="row-fluid" style="background-color: #F5FBFC;margin-right: 5px;margin-left: 5px;">
      <div class="row-fluid">
        <input type="hidden" name="numeroComanda" id="numeroComanda" value='0'>
        <div class="col-lg-3 col-md-3 col-xs-6" style="padding:0">
          <div class="container-fluid" style="margin:0;padding:0">
            <div class="container-fluid" style="background-color: antiquewhite;padding:10px">
              <label class="col-md-2" for="">Mesa</label>           
              <div class="col-lg-6">
                <select class="form-control" name='nromesas' id='nromesas'>"
                  <?php
                  foreach ($mesas as $mesa) : ?>
                    <option value="<?php echo $mesa['numero_mesa'];?>"><?php echo $mesa['numero_mesa'];?></option>
                    <?php 
                  endforeach
                  ?>
                </select>
              </div>
              <label class="col-md-2" for="">Pers</label>
              <div class="col-lg-2" style="padding:0px">
                <input class="form-control" type="number" min='1' id="numPax" name='numPax' value="1">  
              </div>           
            </div>            
            <div class="container-fluid"  style="background-color: antiquewhite;padding:0 10px 10px 10px">
              <h4 align="center" style="font-family:ubuntu;">Selecciona Tipo de Plato</h4>
              <form accept-charset="utf-8" method="POST" class="form-horizontal">
                <label class="control-label col-xs-3 " for="">Buscar </label>
                <div class="col-xs-9" style="padding:0;margin:0">
                  <input class="form-control" type="text" name="busqueda" id="busqueda" value="" onKeyUp="buscar();">
                </div>
              </form>
            </div>            
          </div> 
          <div class="row-fluid moduloCentrar" id="seccionList" style="margin-top:5px;padding:0"></div> 
        </div>   
        <div class="col-lg-4 col-md-4 col-xs-6 moduloCentrar" id="productoList" style="padding:5px;margin-bottom: 50px"></div>
        <div class="col-lg-5 col-md-5 col-xs-12" style="padding:5px 0px">
          <div class="row-fluid"> 
            <div class="col-md-9">
              <h3 align ='center' style='color:#261414;font-weight:bold'> Comanda</h3>
            </div> 
          </div>
          <div class="row-fluid" id="ventasList">
            <div class="col-md-9" style="padding:0">
              <div class="row-fluid" style="height: 360px;background-color:#FCF7AB;margin-top: 15px;overflow: auto">
                <table class="table table-hover comanda">
                  <thead>
                    <tr class="danger">
                      <td align="center" style="font-weight: bold" width="30%">Productos</td>
                      <td align="center" style="font-weight: bold" width="4%">Cant.</td>
                      <td align="center" style="font-weight: bold" width="12%">Valor</td>
                      <td align="center" style="font-weight: bold" width="20%">Accion</td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $ambiente = $idamb;
                      $usuario  = $user;
                      $impuesto = $impto;
                      $propina  = $prop;
                      $neto = 0;
                      $na   = 0;
                      $subt = 0;
                      $pro  = 0;
                      $impt = 0;
                      $sub  = 0;
                      $val  = 0;
                      $imp  = 0;
                      $des  = 0;
                      foreach ($productos as $vtaprod) : 
                        $na=$na+$vtaprod['cant']; 
                        ?>
                        <tr style="font-size:15px;height: 14px">
                          <td style="padding:2px 5px" width="50%"><?php echo $vtaprod['nom']; ?></td>
                          <td style="padding:2px 5px" width="5%"><center><?php echo $vtaprod['cant']; ?></center></td>
                          <td style="padding:2px 5px;text-align: right"width="20%">
                            $ <?php echo number_format($vtaprod['venta'],0,",",".");?>
                          </td>
                          <td style="padding:2px 5px" align="center" width="25%">
                            <div class="btn-group" role="group" aria-label="...">
                              <button type="button" onclick="getVentas(this.name)" type="button" class="glyphicon glyphicon-plus btn btn-success btn-xs" name="<?php echo $vtaprod['producto_id']; ?>"></button>
                              <button type="button" onclick="getRestarVentas(this.name)" type="button" class="glyphicon glyphicon-minus btn btn-warning btn-xs" name="<?php echo $vtaprod['producto_id']; ?>"></button>
                              <button type="button" onclick="getBorraVentas(this.name)" type="button" class="glyphicon glyphicon-trash btn btn-danger btn-xs" name="<?php echo $vtaprod['producto_id']; ?>"></button>
                            </div>                      
                          </td>
                        </tr>
                        <?php
                          $subt = $subt+ $vtaprod['venta'];
                          $impt = $impt+ $vtaprod['valorimpto'];
                          $sub  = $sub + $vtaprod['venta'];
                          $imp  = $imp + $vtaprod['valorimpto'];  
                          $des  = $des + $vtaprod['descuento'];
                          $neto = $sub + $imp+$pro-$des;
                      endforeach  
                    ?>
                  </tbody>
                </table>
              </div>
              <div class="row-fluid" id="valores" style='margin-top:5px;background-color: #B9E3E4B3'>
                <table class="table table-responsive estadoComanda" style="margin-bottom: 0px;font-size:14px">
                  <tr align="right">
                    <td style="padding:2px">Total Productos</td>
                    <td style="padding:2px" id="cantProd"><?php echo $na; ?></td>
                    <td style="padding:2px" align="right">Valor Cuenta</td>
                    <td style="padding:2px" align="right">
                        <?php echo '$ '.number_format($subt,2,",","."); ?>
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
                        echo '$ '.number_format($subt+$impt-$des,2,",",".");
                      ?>
                    </td>
                  </tr>
                </table>
              </div>
              <div class="row-fluid" id="valores" style='margin-top:10px;background-color: #B9E3E4B3'>
              </div>
            </div>
            <div class="col-md-3 menuComanda" style="padding: 0 0px 0 15px;margin-top:15px">
              
              <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group-vertical mr-2" role="group" aria-label="First group" style="display: block">
                  <button 
                    type        ="button" 
                    class       ="btn btn-primary" 
                    style       ="height: 64px;font-weight: 600;font-size:14px" 
                    title       ="Guardar Presente Cuenta"
                    onclick     ="guardarCuenta()"
                    >
                    <i class    ="fa fa-save"></i> Guardar
                  </button>
                  <!--
                  <button 
                    type        ="button" 
                    class       ="btn btn-secondary btn-info" 
                    data-toggle ="modal" 
                    data-target ="#myImprimirCuenta"
                    style       ="height: 64px;font-weight: 600;font-size:14px" 
                    title       ="Imprimir Presente Cuenta">
                    <i class="fa fa-print"></i> Imprimir 
                  </button>
                -->
                  <button 
                    type        ="button" 
                    class       ="btn btn-danger" 
                    data-toggle ="modal" 
                    data-target ="#myImprimirCuenta"
                    style       ="height: 64px;font-weight: 600;font-size:14px" 
                    title       ="Imprimir Presente Cuenta"
                    onclick="descuentoComanda()"
                    >
                    <i class="fa fa-print"></i> Descuento 
                  </button>
                  <button 
                    type           ="button" 
                    class          ="btn btn-secondary btn-success"
                    title          ="Pagar Presente Cuenta" 
                    data-toggle    ="modal" 
                    data-nombre    ="<?php echo $user?>" 
                    data-subtotal  ="<?php echo $sub?>" 
                    data-descuento ="<?php echo $des?>" 
                    data-productos ="<?php echo $na?>" 
                    data-sugerida  ="<?php echo $pro?>" 
                    data-impuesto  ="<?php echo $imp?>" 
                    data-total     ="<?php echo $neto?>" 
                    data-target    ="#myModalPagar"
                    style          ="height: 64px;font-weight: 600;font-size:14px" 
                    onclick        ="botonPagar()">
                    <i class="fa fa-money"></i> Pagar
                  </button>
                  <button 
                    onclick  ="getBorraCuenta(this.name,<?=$idamb?>)" 
                    type     ="button" 
                    class    ="btn btn-secondary btn-warning" 
                    name     ="<?php echo $user;?>" 
                    style    ="height: 64px;font-weight: 600;font-size:14px;margin-top:180px" 
                    title    ="Anula Ingreso Presente Cuenta">
                    <i class ="fa fa-reply"></i> Regresar
                  </button>

                </div>
              </div>
              <div class="row-fluid" id='menu' style="margin-top:-15px">
                <div class="btn-group" role="group">     
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
    <div class="modal fade" id="myModalGuardarCuenta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header" style="padding:5px 15px">
            <button type="button" class="close glyphicon glyphicon-off" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
            <h3 class="modal-title" id="myModalLabel">Guardar Comanda</h3>
            <h4><?= $amb ?></h4>  
          </div>
          <form class="form-horizontal" action="javascript:guardarCuenta()" method="POST" accept-charset="utf-8">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-8 col-md-offset-2">
                  <div class="form-group" style="margin-bottom: 5px">
                    <label class="form-label col-lg-6 col-md-6" for="mesa">Numero de Mesa</label>
                    <div class="col-lg-6 col-md-6">
                      <select class="form-control" name='nromesas' id='nromesas'>"
                      <?php
                      foreach ($mesas as $mesa) : ?>
                        <option value="<?php echo $mesa['numero_mesa'];?>"><?php echo $mesa['numero_mesa'];?></option>
                        <?php 
                      endforeach
                      ?>
                      </select>
                    </div>  
                  </div>
                  <div class="form-group" style="margin-bottom: 5px">
                    <label class="form-label col-lg-6 col-md-6" for="pax">Personas</label>
                    <div class="col-lg-6 col-md-6">
                      <input type ="hidden" name="usuario" value="<?=$user?>" >
                      <input type ="hidden" name="ambiente" value="<?=$idamb?>" >
                      <input value="1" type="number" class="form-control" name="pax" id="pax" placeholder="" min=1 max=10>
                    </div>
                  </div>
                </div>                  
              </div>
            </div>
            <div class="modal-footer">
              <div class="btn-group">
                <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Cancelar</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
              </div>
              <div class="row-fluid">                    
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Modal Descuentos-->
    <div class="modal fade" id="myModalDescuento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content modal-md">
          <div class="modal-header">
            <button type="button" class="close glyphicon glyphicon-off" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
            <h4 class="modal-title" id="myModalLabel"><strong>Descuento Presente Cuenta</strong></h4>
            <h5><?= $amb?></h5>  
          </div>
          <form class="form-horizontal" method="POST" accept-charset="utf-8" id="formdescuento" name="descuento">
            <div class="modal-body">
              <?php 
                $val       = $neto;
                $total     = $sub+$imp+$pro ;
                $pagado    = 0 ;
                $resultado = 0 ;
              ?>
              <div class="form-group" >
                <label class="col-lg-4 col-md-4 control-label" style="padding-top:0">Tipo de Descuento</label>
                <div class="col-lg-8 col-md-8"> 
                  <select name='tipodesc' id='tipodesc' required >
                    <option  value="">Seleccione El Tipo de Descuento</option>
                    <?php
                    foreach ($descuentos as $descuento) :  ?>
                      <option  id="tipodesc" value="<?php echo $descuento['id_descuento'];?>"><?php echo $descuento['descripcion_descuento']  ;?></option>
                      <?php 
                    endforeach
                    ?>
                  </select>
                </div>
              </div>
              <div id="resultadoDes"></div>              
            </div>
            <div class="modal-footer">
              <input id = 'comanda'  type="hidden" value='0'>
              <input id = 'ambiente' type="hidden" value='<?= $ambiente?>'>
              <input id = 'usuario'  type="hidden" value='<?= $usuario?>'>
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <button class="btn btn-success" onclick="getDescuento($('#comanda').val(), $('#ambiente').val(),$('#usuario').val(),$('#tipodesc').val())" type="button" data-dismiss="modal">Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="modal fade" id="myModalPagar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <form class="form-horizontal" method="POST" accept-charset="utf-8" id="pagarCuenta" action="javascript:pagarFactura()">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content modal-md">
            <div class="modal-header">
              <button type="button" class="close glyphicon glyphicon-off" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
              <h3 style="font-weight: 700;font-family: 'ubuntu" class="modal-title" id="myModalLabel"><i class="fa fa-money"></i> Pagar Presente Cuenta</h3>
              <h4 style="font-weight: 500;font-family: 'ubuntu"> <?=$amb?></h4>
              <input type="hidden" name="comanda" id="comanda" value="0"> 
              <input type="hidden" name="nombreAmbiente" id="nombreAmbiente" value="<?=$amb?>"> 
              <input type="hidden" name="prefijo" id="prefijo" value="<?=$pref?>"> 
              <input type="hidden" name="fecha" id="fecha" value="<?=$amb?>"> 
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
                <input value="<?= $pagado ?>" required type="number" class="form-control" name="montopago" id="montopago" onblur="calculaCambio()" >
                </div>
              </div>
              <div id="resultado" style="margin-top:15px;"></div>
            </div>
            <div class="modal-footer">
              <input name = 'ambiente' type="hidden" value='<?= $ambiente?>'>
              <input name = 'usuario'  type="hidden" value='<?= $usuario?>'>
              <input name = 'cambio'   type="hidden" value='<?= $pagado-$total?>'>
                <div class="btn-group" role="group">
                <button type="button" class="btn btn-warning" data-dismiss="modal"> <i class="fa fa-reply"></i> Cancelar</button>
                <button type="submit" class="btn btn-primary" ><i class="fa fa-money"></i> Pagar Cuenta</button>
              </div>
            </div>
          </div>
        </div> 
      </form>
    </div>
    <script>getSecciones()</script>
