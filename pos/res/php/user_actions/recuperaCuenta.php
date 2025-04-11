<?php
  
  require '../../../../res/php/titles.php';
  require '../../../../res/php/app_topPos.php'; 

  $comanda = $_POST['comanda'];
  $idamb   = $_POST['idamb'];
  $user    = $_POST['user'];
  $iduser  = $_POST['iduser'];
  $impto   = $_POST['impto'];
  $prop    = $_POST['prop'];
  $amb     = $_POST['amb'];

  $datosComanda     = $pos->datosComanda($idamb,$comanda);
  $productosComanda = $pos->productosComanda($idamb,$comanda);

?>

    <div class="row-fluid" style="background-color: #F5FBFC;margin-right: 5px;margin-left: 5px;padding:0">
      <div class="row-fluid">
        <input type="hidden" name="numeroComanda" id="numeroComanda" value='<?=$comanda?>'>
        <div class="col-lg-3 col-md-3 col-xs-6" style="padding:0">
          <div class="container-fluid" style="margin:0;padding:0">
            <div class="container-fluid" style="background-color: antiquewhite;padding:10px">
              <label class="col-md-2" for="">Mesa</label>           
              <div class="col-lg-6">
                <select class="form-control" name='nromesas' id='nromesas' readonly>
                  <option value="<?php echo $datosComanda[0]['mesa'];?>"><?php echo $datosComanda[0]['mesa'];?></option>
                </select>
              </div>
              <label class="col-md-2" for="">Pers</label>
              <div class="col-lg-2" style="padding:0px">
                <input class="form-control" type="number" min='1' id="numPax" name='numPax' value="<?php echo $datosComanda[0]['pax'];?>" readonly>  
              </div>           
            </div>            
            <div class="container-fluid"  style="background-color: antiquewhite;padding:0 10px 10px 10px">
              <h4 align="center" style="font-family:ubuntu;">Selecciona Tipo de Plato</h4>
              <form accept-charset="utf-8" method="POST" class="form-horizontal">
                <label class="control-label col-xs-3 " for="">Buscar </label>
                <div class="col-xs-9" style="padding:0;margin:0">
                  <input class="form-control" type="text" name="busqueda" id="busqueda" value="" onKeyUp="buscarRecu();">
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
          <div class="row-fluid" id="vienelistado">
            <div class="col-md-9" style="padding:0">
              <div class="row-fluid" style="height: 440px;background-color:#FCF7AB;margin-top: 15px;overflow: auto">
                <table class="table table-hover"  id='productoVendidos'>
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
                      $ambiente  = $idamb;
                      $usuario   = $user;
                      $impuesto  = $impto;
                      $propina   = $prop;
                      $vieneneto = 0;
                      $vienesubt = 0;
                      $vieneimpt = 0;
                      $vieneimp  = 0;
                      $vienedes  = 0;
                      $na        = 0;
                      $vienepro  = 0;
                      $vienesub  = 0;
                      $vieneval  = 0;
                      foreach ($productosComanda as $vtaprod) : 
                        $na=$na+$vtaprod['cant']; 
                        ?>
                        <tr style="font-size:15px;height: 14px">
                          <td style="padding:2px 5px" width="50%"><?php echo $vtaprod['nom']; ?></td>
                          <td style="padding:2px 5px" width="5%"><center><?php echo $vtaprod['cant']; ?></center></td>
                          <td style="padding:2px 5px;text-align: right"width="20%" id="valorProd">
                            $ <?php echo number_format($vtaprod['venta'],0,",",".");?>
                          </td>
                          <td style="padding:2px 5px" align="center" width="25%"></td>
                        </tr>
                        <?php
                          $vienesubt = $vienesubt+ $vtaprod['venta'];
                          $vieneimpt = $vieneimpt+ $vtaprod['valorimpto'];
                          $vienesub  = $vienesub + $vtaprod['venta'];
                          $vieneimp  = $vieneimp + $vtaprod['valorimpto'];  
                          $vienedes  = $vienedes + $vtaprod['descuento'];
                          $vieneneto = $vienesub + $vieneimpt+$propina-$vienedes;
                      endforeach  
                    ?>
                  </tbody>
                </table>
                <table class="table table-hover comanda" id='ventasAdicionales'>
                </table>
              </div>
              <!--
              <div class="row-fluid" id="valores" style='margin-top:5px;background-color: #B9E3E4B3'>
                <table class="table table-responsive estadoComanda" style="margin-bottom: 0px;font-size:14px">
                  <tr align="right">
                    <td style="padding:2px">Total Productos</td>
                    <td style="padding:2px" id="cantProd"><?php echo $na; ?></td>
                    <td style="padding:2px" align="right">Valor Cuenta</td>
                    <td style="padding:2px" align="right">
                        <?php echo '$ '.number_format($vienesubt,2,",","."); ?>
                    </td>
                  </tr>
                  <tr align="right">
                    <td style="padding:2px">Descuento</td>
                    <td style="padding:2px" align="right"><?=number_format($vienedes,2)?></td>
                    <td style="padding:2px" align="right">Impuesto</td>
                    <td style="padding:2px" align="right"><?=number_format($vieneimp,2)?> </td>
                  </tr>
                </table>
                <table class="table table-responsive estadoComanda">
                  <tr>
                    <td style="padding:2px"></td>
                    <td style="padding:2px"></td>
                    <td style="padding:2px" align="right">Total Presente Cuenta</td>
                    <td style="padding:2px" align="right">
                      <?php 
                        echo '$ '.number_format($vienesubt+$vieneimpt-$vienedes,2,",",".");
                      ?>
                    </td>
                  </tr>
                </table>
              </div>
              <div class="row-fluid" id="valores" style='margin-top:10px;background-color: #B9E3E4B3'>
              </div>
            -->
            </div>
            <div class="col-md-3 menuComanda" style="padding: 0 0px 0 15px;margin-top:15px">
              <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group-vertical mr-2" role="group" aria-label="First group" style="display: block">
                  <button 
                    type        ="button" 
                    class       ="btn btn-primary" 
                    style       ="height: 64px;font-weight: 600;font-size:14px" 
                    title       ="Guardar Presente Cuenta"
                    onclick     ="guardarCuentaRecu()"
                    >
                    <i class    ="fa fa-save"></i> Guardar
                   </button>
                  <button 
                    onclick  ="getBorraCuenta(this.name,<?=$idamb?>)" 
                    type     ="button" 
                    class    ="btn btn-secondary btn-warning" 
                    name     ="<?php echo $user;?>" 
                    style    ="height: 64px;font-weight: 600;font-size:14px;margin-top:315px" 
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
    <script>getSeccionesRecu()</script>
