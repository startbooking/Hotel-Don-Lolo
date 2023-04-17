<!-- Modal Pagar-->
<div class="modal fade" id="myModalPagar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form class="form-horizontal" method="POST" accept-charset="utf-8" id="pagarCuenta" action="javascript:pagarFactura()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content modal-md">
        <div class="modal-header">
          <button type="button" class="close glyphicon glyphicon-off" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
          <h3 style="font-weight: 700;font-family: 'ubuntu" class="modal-title" id="myModalLabel"><i class="fa fa-money"></i> Pagar Presente Cuenta</h3>
          <h4 style="font-weight: 500;font-family: 'ubuntu"> <?=$amb?></h4>
          <input type="hidden" name="comandaPag" id="comandaPag" value="0"> 
          <input type="hidden" name="nombreAmbiente" id="nombreAmbiente" value="<?=$amb?>"> 
          <input type="hidden" name="productosPag" id="productosPag" value="0"> 
          <input type="hidden" name="prefijo" id="prefijo" value="<?=$prefijo?>"> 
          <input type="hidden" name="fecha" id="fecha" value="<?=$fecha?>"> 
          <input id='ambientePag' name='ambientePag' type="hidden" value=''>
          <input id='usuarioPag' name='usuarioPag'  type="hidden" value=''>
          <input id='cambio' name='cambio'   type="hidden" value='0'>
        </div>
        <div class="modal-body">
          <?php 
            $pagado    = 0 ; 
            $resultado = 0 ;
            $pro       =  0; 
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
            <label class='col-lg-3 col-md-3 control-label ctrlCta' style="padding-top:0">Propina</label>
            <div class="col-lg-3 col-md-3">
              <input value="0" minvalue="0" type="number" class="suma_propina form-control" name="propina" id="propina" onblur="calcular_total()">
            </div>
            <label class='col-lg-2 col-md-2 control-label ctrlCta' style="padding-top:0">Descuento</label>
            <div class="col-lg-3 col-md-3">
              <input value="0" minvalue="0" type="text" class="form-control" name="descuento" id="descuento" readonly="">
            </div>
          </div>
          <div class="form-group">
            <label for="total" class='col-lg-3 col-md-3 control-label ctrlCta' style="padding-top:0">Total Cuenta</label>
            <div class="col-lg-3 col-md-3">   
            <input class="form-control" name="total" id="total" readonly>
            <input type="hidden" name="totalini" id="totalini" readonly>
            </div>
          </div>
          <div class="form-group">
            <label for="montopago" class='col-lg-3 col-md-3 control-label ctrlCta' style="padding-top:0">Valor Pagado</label>
            <div class="col-lg-3 col-md-3">   
            <input value="<?= $pagado ?>" required type="number" class="form-control" name="montopago" id="montopago" onblur="calculaCambio()" >
            </div>
          </div> 
          <div id="resultado" style="margin-top:15px;">
          </div>
        </div>
        <div class="modal-footer">
            <div class="btn-group" role="group">
            <button type="button" class="btn btn-warning" data-dismiss="modal"> <i class="fa fa-reply"></i> Cancelar</button>
            <button id="btnPagarCuenta" type="submit" class="btn btn-primary" ><i class="fa fa-money"></i> Pagar Cuenta</button>
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
        <h4><?=$amb?></h4>  
      </div>
      <form class="form-horizontal" method="POST" id="formdescuento" name="descuento" action="javascript:getDescuento()">
        <div class="modal-body">
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
          <input id = 'ambiente' type="hidden" value='<?=$idamb?>'>
          <input id = 'usuario'  type="hidden" value='<?=$user?>'>
          <div class="btn-group">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Cancelar</button>
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal Anular Comanda--> 
<div class="modal fade" id="myModalAnulaComanda" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content modal-md">
      <div class="modal-header">
        <button type="button" class="close glyphicon glyphicon-off" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
        <h3 class="modal-title" id="myModalLabel"><i class="fa fa-money"></i> Anular Comanda Actual</h3>
        <h4><?=$amb?></h4>  
      </div>
      <form class="form-horizontal" method="POST" id="formdescuento" name="descuento" action="javascript:getAnulaComanda()">
        <div class="modal-body">
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
          <input id = 'ambiente' type="hidden" value='<?=$idamb?>'>
          <input id = 'usuario'  type="hidden" value='<?=$user?>'>
          <div class="btn-group">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Cancelar</button>
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Anular Comada</button>
          </div>     
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal Devolucion Productos Comanda-->
<div class="modal fade" id="myModalDevolucionComanda" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content modal-md">
      <div class="modal-header">
        <button type="button" class="close glyphicon glyphicon-off" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
        <h3 class="modal-title" id="myModalLabel"><i class="fa fa-money"></i> Anular Comanda Actual</h3>
        <h4><?=$amb?></h4>  
      </div>
      <form class="form-horizontal" method="POST" id="formDevolucion" name="formDevolucion" action="javascript:devolverProducto()">
        <div class="modal-body"> 
          <div class="form-group">
            <label class="col-lg-4 col-md-4 control-label" style="padding-top:0">Producto</label>
            <div class="col-lg-8 col-md-8"> 
              <input type="text" class="form-control" name="nombreProd" id="nombreProd" disabled>
            </div>           
          </div>           
          <div class="form-group">
            <label class="col-lg-4 col-md-4 control-label" style="padding-top:0">Cantidad Devolucion</label>
            <div class="col-lg-2 col-md-2"> 
              <input type="text" class="form-control" name="cantidadDev" id="cantidadDev" disabled>
            </div>           
          </div>
          <div class="form-group">
            <label class="col-lg-4 col-md-4 control-label" style="padding-top:0">Motivo Devolucion</label>
            <div class="col-lg-8 col-md-8"> 
              <input type="text" class="form-control" name="motivoDev" id="motivoDev" required="">
            </div>           
          </div>
          <div id="resultado"></div>              
        </div>
        <div class="modal-footer">
          <input name='idProductoDev' id='idProductoDev'  type="hidden" value='0'>
          <input name='comandaDev' id='comandaDev'  type="hidden" value='0'>
          <input name='ambienteDev' id='ambienteDev' type="hidden" value='<?=$idamb?>'>
          <input name='regisDev' id='regisDev' type="hidden" value='<?=$idamb?>'>
          <input name='usuario' id='usuario'  type="hidden" value='<?=$user?>'>
          <div class="btn-group">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Cancelar</button>
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Devolver Producto</button>
          </div>     
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal Pagar Comanda Directo -->
<div class="modal fade" id="myModalPagarDirecto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form class="form-horizontal" method="POST" accept-charset="utf-8" id="pagarCuentaDirecto" action="javascript:pagarFacturaDirecto()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content modal-md">
        <div class="modal-header">
          <button type="button" class="close glyphicon glyphicon-off" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
          <h3 style="font-weight: 700;font-family: 'ubuntu" class="modal-title" id="myModalLabel"><i class="fa fa-money"></i> Pagar Presente Cuenta</h3>
          <h4 style="font-weight: 500;font-family: 'ubuntu"> <?=$amb?></h4>
          <input type="hidden" name="comandaPag" id="comandaPag" value="0"> 
          <input type="hidden" name="nombreAmbiente" id="nombreAmbiente" value="<?=$amb?>"> 
          <input type="hidden" name="productosPag" id="productosPag" value="0"> 
          <input type="hidden" name="prefijo" id="prefijo" value="<?=$prefijo?>"> 
          <input type="hidden" name="fecha" id="fecha" value="<?=$fecha?>"> 
          <input type="hidden" name='ambientePag' id='ambientePag' value=''>
          <input type="hidden" name='usuarioPag' id='usuarioPag' value=''>
          <input type="hidden" name='cambioDir' id='cambioDir' value='0'>
          <input type="hidden" name='mesaDir' id='mesaDir' value=''>
        </div>
        <div class="modal-body">
          <?php 
            $pagado    = 0 ; 
            $resultado = 0 ;
            $pro       = 0; 
          ?>
          <div class="form-group" >
            <input type="hidden" id="sugerida" value="<?=$pro?>">
            <label class="col-lg-3 col-md-3 control-label" style="padding-top:0">Forma de Pago</label>
            <div class="col-lg-8 col-md-8"> 
              <select onchange="getFormaPagoDir(this.value)" name='formapagoDir' id='formapagoDir' required >
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
              <select name="clientesDir" id='clientesDir' required>
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
            <label class='col-lg-3 col-md-3 control-label ctrlCta' style="padding-top:0">Propina</label>
            <div class="col-lg-3 col-md-3">
              <input value="0" minvalue="0" type="number" class="suma_propina form-control" name="propinaDir" id="propinaDir" onblur="calcular_totalDir()">
            </div>
            <label class='col-lg-2 col-md-2 control-label ctrlCta' style="padding-top:0">Descuento</label>
            <div class="col-lg-3 col-md-3">
              <input value="0" minvalue="0" type="text" class="form-control" name="descuento" id="descuento" readonly="">
            </div>
          </div>
          <div class="form-group">
            <label for="total" class='col-lg-3 col-md-3 control-label ctrlCta' style="padding-top:0">Total Cuenta</label>
            <div class="col-lg-3 col-md-3">   
            <input class="form-control" name="totalDir" id="totalDir" readonly>
            <input type="hidden" name="totaliniDir" id="totaliniDir" readonly>
            </div>
          </div>
          <div class="form-group">
            <label for="montopago" class='col-lg-3 col-md-3 control-label ctrlCta' style="padding-top:0">Valor Pagado</label>
            <div class="col-lg-3 col-md-3">   
            <input value="<?= $pagado ?>" required type="number" class="form-control" name="montopagoDir" id="montopagoDir" onblur="calculaCambioDir()" >
            </div>
          </div> 
          <div id="resultadoDir" name="resultadoDir" style="margin-top:15px;">
          </div>
        </div>
        <div class="modal-footer">
            <div class="btn-group" role="group">
            <button type="button" class="btn btn-warning" data-dismiss="modal"> <i class="fa fa-reply"></i> Cancelar</button>
            <button id="btnPagarCuenta" type="submit" class="btn btn-primary" ><i class="fa fa-money"></i> Pagar Cuenta</button>
          </div>
        </div>
      </div>
    </div> 
  </form>
</div>

