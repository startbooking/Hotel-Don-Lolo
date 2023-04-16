<div class="modal fade" id="myModalAdicionarAmbiente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="guardarDatosAmbiente" class="form-horizontal" action="javascript:guardaAmbiente()" method="POST" enctype="multipart/form-data">    
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Adicionar Ambiente</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div id="mensajeAdi"></div>
        <div class="modal-body">
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Ambiente</label>
            <div class="col-lg-6 col-md-6">
              <input type="text" class="form-control" id="nombreAdi" name="nombreAdi" required>
            </div>
            <label for="nombre" class="control-label col-lg-2 col-md-2">Prefijo</label>
            <div class="col-lg-2 col-md-2">
              <input type="text" class="form-control" id="prefijoAdi" name="prefijoAdi" required>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Conc Factura</label>
            <div class="col-lg-2 col-md-2">
              <input type="number" min="1" class="form-control" id="facturaAdi" name="facturaAdi" required>
            </div>
            <label for="nombre" class="control-label col-lg-2 col-md-2">Conc Orden</label>
            <div class="col-lg-2 col-md-2">
              <input type="number" min="1" class="form-control" id="ordenAdi" name="ordenAdi" required>
            </div>
            <label for="nombre" class="control-label col-lg-2 col-md-2">Conc Comanda</label>
            <div class="col-lg-2 col-md-2">
              <input type="number" min="1" class="form-control" id="comandaAdi" name="comandaAdi" required>
            </div>
          </div>
          <div class="form-group" >
            <label for="inputEmail3" class="col-sm-2 control-label">Iva incluido</label>
            <div class="col-sm-4 ondisplay">
              <div class="wrap">
                <div class="col-sm-6" style="padding:0;height: 15px">
                  <div class="form-check form-check-inline">
                    <input style="margin-top:5px" class="form-check-input" type="radio" name="imptoOption" id="inlineRadio1" value="1" 
                    >
                    <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineRadio1" >SI</label>
                  </div>                    
                </div>
                <div class="col-sm-6" style="padding:0;height: 15px"> 
                  <div class="form-check form-check-inline">
                    <input style="margin-top:5px" class="form-check-input" type="radio" name="imptoOption" id="inlineRadio2" value="0"
                    >
                    <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineRadio2">NO</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">            
            <label class="control-label col-lg-2">Bodega</label>
            <div class="col-lg-4 col-md-4">
              <select name="BodegaAdi" id="BodegaAdi" required="">
                <?php 
                foreach ($bodegas as $bodega) { ?>
                  <option value="<?=$bodega['id_bodega']?>" 
                    ><?=$bodega['descripcion_bodega']?></option>
                  <?php 
                }
                ?>
              </select>
            </div>
            <label class="control-label col-lg-2">Centro de Costo</label>
            <div class="col-lg-4 col-md-4">
              <select name="centroAdi" id="centroAdi" required="">
                <?php 
                foreach ($centros as $centro) { ?>
                  <option value="<?=$centro['id_centrocosto']?>" 
                    ><?=$centro['descripcion_centro']?></option>
                  <?php 
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group pms">            
            <label class="control-label col-lg-2">Codigo Venta</label>
            <div class="col-lg-4 col-md-4">
              <select name="ventaAdi" id="ventaAdi" required="">
                <option value="">Seleccione el Codigo de Ventas</option>}
                option
                <?php 
                foreach ($codigos as $codigo) { ?>
                  <option value="<?=$codigo['id_cargo']?>" 
                    ><?=$codigo['descripcion_cargo']?></option>
                  <?php 
                }
                ?>
              </select>
            </div>
            <label class="control-label col-lg-2">Codigo Propina</label>
            <div class="col-lg-4 col-md-4">
              <select name="propinaAdi" id="propinaAdi" required="">
                <option value="">Seleccione el Codigo de Propinas</option>}
                <?php 
                foreach ($codigos as $codigo) { ?>
                  <option value="<?=$codigo['id_cargo']?>" 
                    ><?=$codigo['descripcion_cargo']?></option>
                  <?php 
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group" >  
            <label class="control-label col-lg-2" for="">Logo</label>
            <input type="hidden" id="imgLogo" name="imgLogo" value=""> 
            <div class="col-lg-2 col-md-2" id="mostrarFoto">
              <?php 
                $images = '../img/noimage.png'; 
              ?>
              <img class="img-thumbnail" src="<?php echo $images ?>" alt="" >
            </div>          
            <label class="control-label col-lg-2" for="">Importar Logo</label>
            <div class="col-lg-2 col-md-2" >
              <input type="file" name="logoAdi" id="logoAdi" onchange="verFoto(this)">
            </div>          
          </div>
        </div>
        <div class="modal-footer">
          <div class="btn-group">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="myModalEliminaAmbiente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="guardarDatosAmbiente" class="form-horizontal" action="javascript:eliminaAmbiente()" method="POST" enctype="multipart/form-data">    
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Elimina Ambiente</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div id="mensajeEli"></div>
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" name="idAmbienteEli" id="idAmbienteEli" value="" placeholder="">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Ambiente</label>
            <div class="col-lg-6 col-md-6">
              <input type="text" class="form-control" id="nombreEli" name="nombreEli" disabled>
            </div>
            <label for="nombre" class="control-label col-lg-2 col-md-2">Prefijo</label>
            <div class="col-lg-2 col-md-2">
              <input type="text" class="form-control" id="prefijoEli" name="prefijoEli" disabled>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Conc Factura</label>
            <div class="col-lg-2 col-md-2">
              <input type="number" min="1" class="form-control" id="facturaEli" name="facturaEli" disabled>
            </div>
            <label for="nombre" class="control-label col-lg-2 col-md-2">Conc Orden</label>
            <div class="col-lg-2 col-md-2">
              <input type="number" min="1" class="form-control" id="ordenEli" name="ordenEli" disabled>
            </div>
            <label for="nombre" class="control-label col-lg-2 col-md-2">Conc Comanda</label>
            <div class="col-lg-2 col-md-2">
              <input type="number" min="1" class="form-control" id="comandaEli" name="comandaEli" disabled>
            </div>
          </div>
          <div class="form-group" >
            <label for="inputEmail3" class="col-sm-2 control-label">Iva incluido</label>
            <div class="col-sm-4 ondisplay">
              <div class="wrap">
                <div class="col-sm-6" style="padding:0;height: 15px">
                  <div class="form-check form-check-inline">
                    <input style="margin-top:5px" class="form-check-input" type="radio" name="imptoOption" id="inlineRadioEli1" value="1" disabled
                    >
                    <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineRadio1" >SI</label>
                  </div>                    
                </div>
                <div class="col-sm-6" style="padding:0;height: 15px"> 
                  <div class="form-check form-check-inline">
                    <input style="margin-top:5px" class="form-check-input" type="radio" name="imptoOption" id="inlineRadioEli2" value="0" disabled
                    >
                    <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineRadio2">NO</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">            
            <label class="control-label col-lg-2">Bodega</label>
            <div class="col-lg-4 col-md-4">
              <select name="BodegaEli" id="BodegaEli" disabled="">
                <?php 
                foreach ($bodegas as $bodega) { ?>
                  <option value="<?=$bodega['id_bodega']?>" 
                    ><?=$bodega['descripcion_bodega']?></option>
                  <?php 
                }
                ?>
              </select>
            </div>
            <label class="control-label col-lg-2">Centro de Costo</label>
            <div class="col-lg-4 col-md-4">
              <select name="centroEli" id="centroEli" disabled="">
                <?php 
                foreach ($centros as $centro) { ?>
                  <option value="<?=$centro['id_centrocosto']?>" 
                    ><?=$centro['descripcion_centro']?></option>
                  <?php 
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group pms">            
            <label class="control-label col-lg-2">Codigo Venta</label>
            <div class="col-lg-4 col-md-4">
              <select name="ventaEli" id="ventaEli" disabled="">
                <option value="">Seleccione el Codigo de Ventas</option>}
                option
                <?php 
                foreach ($codigos as $codigo) { ?>
                  <option value="<?=$codigo['id_cargo']?>" 
                    ><?=$codigo['descripcion_cargo']?></option>
                  <?php 
                }
                ?>
              </select>
            </div>
            <label class="control-label col-lg-2">Codigo Propina</label>
            <div class="col-lg-4 col-md-4">
              <select name="propinaEli" id="propinaEli" disabled="">
                <option value="">Seleccione el Codigo de Propinas</option>}
                <?php 
                foreach ($codigos as $codigo) { ?>
                  <option value="<?=$codigo['id_cargo']?>" 
                    ><?=$codigo['descripcion_cargo']?></option>
                  <?php 
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group" >  
            <label class="control-label col-lg-2" for="">Logo</label>
            <input type="hidden" id="imgLogoEli" name="imgLogoEli" value=""> 
            <div class="col-lg-2 col-md-2" id="mostrarFoto">
              <img class="img-thumbnail" src="<?php echo $images ?>" alt="" >
            </div>          
            <label class="control-label col-lg-2" for="">Importar Logo</label>
            <div class="col-lg-2 col-md-2" >
              <input type="file" name="logoAdi" id="logoAdi" onchange="verFoto(this)">
            </div>          
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-trash"></i> Eliminar</button>
        </div>
      </div>
    </div>
  </form>
</div>
 
<div class="modal fade" id="myModalModificaAmbiente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="actualizaDatosAmbiente" class="form-horizontal" action="javascript:actualizaAmbiente()" method="POST" enctype="multipart/form-data">    
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Modifica Ambiente</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div id="mensajeMod"></div>
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" name="idAmbienteMod" id="idAmbienteMod" value="" placeholder="">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Ambiente</label>
            <div class="col-lg-6 col-md-6">
              <input type="text" class="form-control" id="nombreMod" name="nombreMod" required>
            </div>
            <label for="nombre" class="control-label col-lg-2 col-md-2">Prefijo</label>
            <div class="col-lg-2 col-md-2">
              <input type="text" class="form-control" id="prefijoMod" name="prefijoMod" required>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Conc Factura</label>
            <div class="col-lg-2 col-md-2">
              <input type="number" min="1" class="form-control" id="facturaMod" name="facturaMod" required>
            </div>
            <label for="nombre" class="control-label col-lg-2 col-md-2">Conc Orden</label>
            <div class="col-lg-2 col-md-2">
              <input type="number" min="1" class="form-control" id="ordenMod" name="ordenMod" required>
            </div>
            <label for="nombre" class="control-label col-lg-2 col-md-2">Conc Comanda</label>
            <div class="col-lg-2 col-md-2">
              <input type="number" min="1" class="form-control" id="comandaMod" name="comandaMod" required>
            </div>
          </div>
          <div class="form-group" >
            <label for="inputEmail3" class="col-sm-2 control-label">Iva incluido</label>
            <div class="col-sm-4 ondisplay">
              <div class="wrap">
                <div class="col-sm-6" style="padding:0;height: 15px">
                  <div class="form-check form-check-inline">
                    <input style="margin-top:5px" class="form-check-input" type="radio" name="imptoOption" id="inlineRadioMod1" value="1" 
                    >
                    <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineRadio1" >SI</label>
                  </div>                    
                </div>
                <div class="col-sm-6" style="padding:0;height: 15px"> 
                  <div class="form-check form-check-inline">
                    <input style="margin-top:5px" class="form-check-input" type="radio" name="imptoOption" id="inlineRadioMod2" value="0"
                    >
                    <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineRadio2">NO</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">            
            <label class="control-label col-lg-2">Bodega</label>
            <div class="col-lg-4 col-md-4">
              <select name="BodegaMod" id="BodegaMod" required="">
                <?php 
                foreach ($bodegas as $bodega) { ?>
                  <option value="<?=$bodega['id_bodega']?>" 
                    ><?=$bodega['descripcion_bodega']?></option>
                  <?php 
                }
                ?>
              </select>
            </div>
            <label class="control-label col-lg-2">Centro de Costo</label>
            <div class="col-lg-4 col-md-4">
              <select name="centroMod" id="centroMod" required="">
                <?php 
                foreach ($centros as $centro) { ?>
                  <option value="<?=$centro['id_centrocosto']?>" 
                    ><?=$centro['descripcion_centro']?></option>
                  <?php 
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group pms">            
            <label class="control-label col-lg-2">Codigo Venta</label>
            <div class="col-lg-4 col-md-4">
              <select name="ventaMod" id="ventaMod" required="">
                <option value="">Seleccione el Codigo de Ventas</option>}
                option
                <?php 
                foreach ($codigos as $codigo) { ?>
                  <option value="<?=$codigo['id_cargo']?>" 
                    ><?=$codigo['descripcion_cargo']?></option>
                  <?php 
                }
                ?>
              </select>
            </div>
            <label class="control-label col-lg-2">Codigo Propina</label>
            <div class="col-lg-4 col-md-4">
              <select name="propinaMod" id="propinaMod" required="">
                <option value="">Seleccione el Codigo de Propinas</option>}
                <?php 
                foreach ($codigos as $codigo) { ?>
                  <option value="<?=$codigo['id_cargo']?>" 
                    ><?=$codigo['descripcion_cargo']?></option>
                  <?php 
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group" >  
            <label class="control-label col-lg-2" for="">Logo</label>
            <input type="hidden" id="imgLogoMod" name="imgLogoMod" value=""> 
            <div class="col-lg-2 col-md-2" id="mostrarFotoMod">
              <img class="img-thumbnail" src="<?php echo $images ?>" alt="" >
            </div>          
            <label class="control-label col-lg-2" for="">Importar Logo</label>
            <div class="col-lg-2 col-md-2" >
              <input type="file" name="logoAdi" id="logoAdi" onchange="verFotoAct(this)">
            </div>          
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Actualizar</button>
        </div>
      </div>
    </div>
  </form>
</div>
