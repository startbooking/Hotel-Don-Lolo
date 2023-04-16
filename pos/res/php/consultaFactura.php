  <div class="col-lg-9 col-md-9" style="padding-left: 5px;">
    <div class="row-fluid" style="overflow:auto;top:40px;height:390px;background-color:#FCF7AB;padding:5px">
      <table class="table table-hover ">
        <tr class="info">
          <td align="center" style="font-weight: bold" width="30%">Productos</td>
          <td align="center" style="font-weight: bold" width="4%">Cant.</td>
          <td align="center" style="font-weight: bold" width="12%">Valor</td>
        </tr>
        <?php 
          $ambiente = $_SESSION['AMBIENTE_ID'];
          $usuario  = $_SESSION['usuario'];
          $impuesto = $_SESSION['IMPUESTO'];
          $propina  = $_SESSION['PROPINA'];
          $neto     = 0;
          $na       = 0;
          $subt     = 0;
          $pro      = 0;
          $impt     = 0;
          $sub      = 0;
          $val      = 0;
          $imp      = 0;
          $des      = 0;


          foreach ($prodventas as $vtaprod) : 
            $na=$na+$vtaprod['cant']; 
            ?>
            <tr style="font-size:16px;height: 14px">
              <td width="50%"><?php echo $vtaprod['nom']; ?></td>
              <td width="5%"><center><?php echo $vtaprod['cant']; ?></center></td>
              <td align="right" width="20%">
                $ <?php echo number_format($vtaprod['venta'],0,",",".");?>
              </td>
            </tr>
            <?php
              $subt = $vtaprod['venta'];
              $impt = $vtaprod['valorimpto'];
              // $pro  = $vtaprod['propina'];
              $sub  = $sub+$subt;
              $imp  = $imp+$impt;  
              $des  = $des+$vtaprod['descuento'];
              $neto = $sub+$imp+$pro-$des;
          endforeach  
        ?>
      </table>
    </div>
    <div class="row-fluid" id="valores" style='margin-top:10px;background-color: #B9E3E4B3'>
      <table class="table table-responsive" style="font-size:16px;">
        <tr  align="right">
          <td style="padding:2px">Total Productos</td>
          <td style="padding:2px"><?php echo $na; ?></td>
          <td style="padding:2px" align="right">Valor Factura</td>
          <td style="padding:2px" align="right">
              <?php 
                echo '$ '.number_format($subt,2,",",".");
              ?>
          </td>
        </tr>
        <tr align="right">
          <td style="padding:2px">Descuento</td>
          <td style="padding:2px" align="right"><?=number_format($des,2)?></td>
          <td style="padding:2px" align="right">Impuesto</td>
          <td style="padding:2px" align="right"><?=number_format($imp,2)?> </td>
        </tr>
        <tr align="right">
          <td style="padding:2px"></td>
          <td style="padding:2px" align="right"></td>
          <td style="padding:2px" align="right">Total Factura</td>
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
    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
      <div class="btn-group-vertical mr-2" role="group" aria-label="First group" style="display: block">
        <button 
          style="height: 64px"
          type="button" 
          class="btn btn-success" 
          onclick="reimprimirFactura()"
          title="Recuperar Presente Cuenta">
          <i class="fa fa-save"></i> ReImprimir Factura
        </button>
        <?php 
        if()
         ?>
        <button 
          style="height: 64px;"
          data-toggle    ="modal" 
          type="button" 
          class="btn btn-warning" 
          data-target="#myModalAnulafactura" 
          name="<?php echo $_SESSION['usuario'];?>" 
          title="Anula Ingreso Presente Cuenta">
          <i class="fa fa-calculator"></i> Anular Factura
        </button>
        <button 
          style="height: 64px;margin-top:280px;background-color: yellow;border-color:yellow;color:black;padding:20px 0;"
          type="button" 
          class="btn btn-success" 
          onclick        ="enviaInicio()"           
          title="Recuperar Presente Cuenta">
          <i class="fa fa-home"></i> Regresar
        </button>
      </div>
    </div>
  </div>



<div class="modal fade" id="myModalAnulafactura" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content modal-md">
      <div class="modal-header">
        <button type="button" class="close glyphicon glyphicon-off" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
        <h3 class="modal-title" id="myModalLabel"><i class="fa fa-money"></i> Anular Factura Actual</h3>
        <h4><?=$_SESSION['NOMBRE_AMBIENTE']?></h4>  
      </div>
      <form class="form-horizontal" method="POST" id="formdescuento" name="descuento" action="javascript:anulaFactura()">
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

