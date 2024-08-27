<?php
  // require '../../../../res/php/titles.php';
  require '../../../../res/php/app_topPos.php'; 

  $codigo  = $_POST['codigo'];
  $idamb   = $_POST['idamb'];
  $parinve = $_POST['impto'];
  $xusu    = $_POST['usuario'];
  $prop    = $_POST['prop'];
  $user    = $xusu;

  $prodvta = $pos->getProductoVenta($codigo,$idamb);
  
  if(count($prodvta)==1){
    $idprod   = $prodvta[0]['producto_id'];
    $codi     = $prodvta[0]['cod'];
    $nom      = $prodvta[0]['nom'];
    $venta    = $prodvta[0]['venta'];
    $porimpto = $prodvta[0]['porcentaje_impto'];
    $regis    = $pos->buscaProductoVenta($codigo,$xusu,$idamb);

    if($parinve == 1){
      $subt = round(($prodvta[0]['venta']) / (1+($porimpto/100)),2);
      $impt = ($prodvta[0]['venta']) - $subt;
    }else{
      $subt = $prodvta[0]['venta'];
      $impt = round($prodvta[0]['venta'] * ($porimpto/100),2);
    }; 

    if($regis==1){
      $venta = $pos->actualizaSumaProductosVenta($codigo,$xusu,$idamb,$subt,$impt);
    }else{
      $venta = $pos->adicionaProductosComanda($codi,$nom,$subt,1,0,$xusu, $idamb,$porimpto, $impt, $idprod,$parinve) ;
    }
  }

  $productos     = $pos->getProductosTmp($user,$idamb); 
  $mesas         = $pos->getMesasAmbi($idamb);
  $formasdepagos = $pos->getFormasPago();
  $descuentos    = $pos->getDescuentosPos($idamb);
?>

      <tbody>
      <?php 
        $ambiente = $idamb;
        $usuario  = $user;
        $impuesto = $parinve;
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
            <td style="padding:2px 5px" align="right" width="20%" id="valorAdi">
              $ <?php echo number_format($vtaprod['venta'],0,",",".");?>
            </td>
            <td style="padding:2px 5px" align="center" width="25%">
              <div class="btn-group" role="group" aria-label="...">
                <button type="button" onclick="getVentasRecu(this.name)" type="button" class="glyphicon glyphicon-plus btn btn-success btn-xs" name="<?php echo $vtaprod['producto_id']; ?>"></button>
                <button type="button" onclick="getRestarVentasRecu(this.name)" type="button" class="glyphicon glyphicon-minus btn btn-warning btn-xs" name="<?php echo $vtaprod['producto_id']; ?>"></button>
                <button type="button" onclick="getBorraVentasRecu(this.name)" type="button" class="glyphicon glyphicon-trash btn btn-danger btn-xs" name="<?php echo $vtaprod['producto_id']; ?>"></button>
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
