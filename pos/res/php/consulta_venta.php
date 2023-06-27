<?php 

  $productos     = $pos->getProductosTmp($_SESSION['usuario'],$_SESSION['AMBIENTE_ID']); 
  $mesas         = $pos->getMesasAmbi($_SESSION['AMBIENTE_ID']);
  $formasdepagos = $pos->getFormasPago();
  $descuentos    = $pos->getDescuentosPos($_SESSION['AMBIENTE_ID']);
?>

<div class="col-md-9" style="padding:0">
  <div class="row-fluid" style="height: 370px;background-color:#FCF7AB;margin-top:15px">
    <table class="table table-hover comanda">
      <thead>
        <tr class="danger">
          <td align="center" style="font-weight: bold" width="50%">Productos</td>
          <td align="center" style="font-weight: bold" width="5%">Cant.</td>
          <td align="center" style="font-weight: bold" width="20%">Valor</td>
          <td align="center" style="font-weight: bold" width="25%">Accion</td>
        </tr>
      </thead>
      <tbody>
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
        foreach ($productos as $vtaprod) : 
          $na=$na+$vtaprod['cant']; 
          ?>
          <tr style="font-size:15px;height: 14px">
            <td style="padding:2px 5px" width="50%"><?php echo $vtaprod['nom']; ?></td>
            <td style="padding:2px 5px" width="5%"><center><?php echo $vtaprod['cant']; ?></center></td>
            <td style="padding:2px 5px" align="right" width="20%">
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
            $subt = $subt + $vtaprod['venta'];
            $impt = $impt + $vtaprod['valorimpto'];
            $sub  = $sub  + $vtaprod['venta'];
            $imp  = $imp  + $vtaprod['valorimpto'];  
            $des  = $des  + $vtaprod['descuento'];
            $neto = $sub  + $imp+$pro-$des;
        endforeach  
      ?>
      </tbody>
    </table>
  </div>
  <div class="row-fluid" id="valores" style='background-color: #B9E3E4B3;margin-top:0px'>
    <table class="table table-responsive estadoComanda" style="margin-bottom: 0px;font-size:14px">
      <tr align="right">
        <td style="padding:2px">Total Productos</td>
        <td style="padding:2px"><?php echo $na; ?></td>
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
            echo '$ '.number_format($subt+$imp-$des,2,",",".");
          ?>
        </td>
      </tr>
    </table>
  </div>
  <div class="row-fluid" id="valores" style='margin-top:10px;background-color: #B9E3E4B3'>
  </div>
</div>
<div class="col-md-3 menuComanda" style="padding: 0 0px 0 15px;margin-top:0px">
  <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
    <div class="btn-group-vertical mr-2" role="group" aria-label="First group" style="display: block">
      <button 
        type        ="button" 
        class       ="btn btn-primary" 
        data-toggle ="modal" 
        data-target ="#myModalGuardarCuenta"
        style       ="height: 64px;font-weight: 600;font-size:14px" 
        title       ="Guardar Presente Cuenta">
        <i class    ="fa fa-save"></i> Guardar
      </button>
      <button 
        type           ="button" 
        class          ="btn btn-secondary btn-success"
        title          ="Pagar Presente Cuenta" 
        data-toggle    ="modal" 
        data-nombre    ="<?php echo $_SESSION['usuario'];?>" 
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
        onclick  ="getBorraCuenta(this.name)" 
        type     ="button" 
        class    ="btn btn-secondary btn-warning" 
        name     ="<?php echo $_SESSION['usuario'];?>" 
        style    ="height: 64px;font-weight: 600;font-size:14px;margin-top:200px" 
        title    ="Anula Ingreso Presente Cuenta">
        <i class ="fa fa-trash-o"></i> Cancelar
      </button>

    </div>
  </div>
</div>
