<?php 

	require '../../../../res/php/titles.php';
  require '../../../../res/php/app_topPos.php'; 

	$nFact = $_SESSION['NUMERO_FACTURA'];
	$amb   = $_SESSION['AMBIENTE_ID'];

	include_once('encabezado_impresiones.php');

 	/* Resolucion de Facturacion Factura*/
 	$resol = $pos->getResolucionFacturacion($amb);

	$reso = $resol[0]['resolucion'];
	$rfec = $resol[0]['fecha'];
	$rpre = $resol[0]['prefijo'];
	$desd = $resol[0]['desde'];
	$hast = $resol[0]['hasta']; 
	$habi = $resol[0]['tipo'];

	if($habi==1){
		$tipo = "Habilita"; 
	}else{
		$tipo = "Autoriza";
	}

	/* Encabezado de la Factura */
 	/* Numero de Mesa A Imprimir*/
 	$datosFac = $pos->getDatosFactura($amb,$nFact);

	$mes    = $datosFac[0]['mesa'];
	$pax    = $datosFac[0]['pax'];
	$coma   = $datosFac[0]['comanda'];
	$tot    = $datosFac[0]['valor_total'];
	$net    = $datosFac[0]['valor_neto'];
	$imp    = $datosFac[0]['impuesto'];
	$pro    = $datosFac[0]['propina'];
	$pag    = $datosFac[0]['pagado'];
	$cam    = $datosFac[0]['cambio'];
	$fec    = $datosFac[0]['fecha'];
	$usu    = $datosFac[0]['usuario_factura'];
	$cli    = $datosFac[0]['id_cliente'];
	$pms    = $datosFac[0]['pms'];
	
	/* Datos del Cliente */
	if($pms=='1'){
		$datosCliente = $pos->getDatosHuespedesenCasa($cli);
		$nrohabi = $datosCliente[0]['num_habitacion'];
	}else{
		$datosCliente = $pos->datosCliente($cli); 
		$identif      = $datosCliente[0]['identificacion'];
	}
	$cliente = $datosCliente[0]['apellido1'].' '.$datosCliente[0]['apellido2'].' '.$datosCliente[0]['nombre1'].' '.$datosCliente[0]['nombre2'];

	/* Productos a Imprimir */
	$productosventa = $pos->getProductosVendidosFactura($amb,$coma);

	$na    = 0;
	$val   = 0;
	$desto = 0;
	$subt  = 0;
	$impt  = 0;
	$time  = time();
	$sub   = 0;
?>

<!DOCTYPE html>
<html>
  <head>
      <meta charset="UTF-8">
      <title></title>
      <script type="text/javascript">
        function imprimir() {
          if (window.print) {
            window.print();
          } else {
          	swal('Precaucion','La función de impresion no esta soportada por su navegador','warning')
          }
        }
      </script>
      <style type="text/css" media="print">
				@page{
			   	margin: 0;
				}
			</style>
  </head>
  <body onload="imprimir();">
		<div class="col-lg-4 col-md-4 col-xs-12">
			<h3 align="center" style='font-weight: 600;margin: 10px 0 5px 0;'><?=$empresa?></h3 align="center">
			<h4 align="center" style='font-weight: 500;margin: 0px 0 5px 0;'>Nit: <?=$nit?></h4 align="center">
			<h5 style='font-weight: 500;margin: 0px 0 5px 0;' align="center"><?=REGIMEN?></h5 align="center">
			<h5 style='font-weight: 500;margin: 0px 0 5px 0;' align="center"><?=$direccion.' '.$ciudad?></h5 align="center">
			<label style="font-weight:initial;font-size:10px;margin:0 ">Telefono <?=$telefono ?> Celular <?=$celular ?></label><br>
			<label style="font-weight:initial;font-size:10px;margin:0 ">Fecha: <?= $fec ?></label><br>
			<label style="font-weight:initial;font-size:10px;margin:0 ">
			<?php 
				if($pms==0){ 
					?>
					Factura de Venta Nro: <?=$rpre?>  <?= str_pad($nFact,5,'0',STR_PAD_LEFT)?>
				<?php 
				}else{ ?>
					Cuenta Nro : <?=$rpre?>  <?= str_pad($nFact,5,'0',STR_PAD_LEFT)?>
					<?php 
				} ?>
	    Mesa: <?= $mes ?>  Usuario: <?=$_SESSION['usuario']?></label>
			<h5 align="center" style="font-size:10px;font-weight:bold;margin:5 0;"><?=$nombre?></h5>
			<div class="row-fluid" style="border-style:solid;border-width:1px;border-radius:5px">
				<h5 style="font-size:10px;padding-left:10px;text-align:center;margin:2px 0;">Resolucion de Facturacion Dian Nro <?=$reso?> de <?= $rfec.' '.$tipo ?>  Desde: <?=$rpre?> <?=$desd ?> Hasta: <?=$rpre?> <?= number_format($hast,0) ?> </h5>
			</div>
			<div class="row-fluid">
				<?php 
					if($pms==0){
						echo '<h5 style="font-size:10px;margin:2px 0">Cliente '.$cliente.'</h5>';
						echo '<h5 style="font-size:10px;margin:2px 0">Identificacion '.$identif.'</h5>';	
					}else{
						echo '<h5 style="font-size:10px;margin:2px 0">Huesped '.$cliente.'</h5>';
						echo '<h5 style="font-size:10px;margin:2px 0">Nro Habitacion '.$nrohabi.'</h5>';	
					}
				?>
			</div>
	  	<div class="row-fluid" style="padding-top:5px">
		  	<table>
			   	<tr style="font-size:10px">
		      	<td width="30%" align="center"><strong>PRODUCTOS</strong></td>
		      	<td width="4%" align="center"><strong>CANT.</strong></td>
		      	<td width="12%" align="center"><strong>VALOR</strong></td>
			   	</tr>
				<?php 
					$subt = 0;
					$impt = 0;
					$sub  = 0;
					$na   = 0;
					$val  = 0;
					$des  = 0;
					$imp  = 0;

					foreach ($productosventa as $producto) {
			    $na  = $na  + $producto['cant']; 
			    $val = $val + $producto['importe']; 
			     // $des = $des + $dato['descuento']; 
					?>
		      <tr style="font-size:10px">
	        	<td style="padding-top:2px"><?php echo $producto['nom']; ?></td>
		        <td style="padding-top:2px" align="center"><?php echo $producto['cant']; ?></td>
			      <td style="padding-top:2px"><div align="right">$ <?php echo number_format($producto['importe'],2,",",".");?></div></td>
			   	</tr>

			   	<?php 
					$sub = $sub+$producto['importe'];
					$imp = $imp+$producto['valorimpto'];
					}			
				?>
				</table>
			</div>
	  	<div class="row-fluid" style="margin-top:10px">
		  	<div class="col-lg-12">
			  	<table style="width: 100%">
			  		<tr align="right" style="font-size:10px">
				  		<td style="width: 50%">Subtotal</td>
				  		<td style="width: 50%" align="right"><?php echo number_format($sub,2)?></td>
			  		</tr>
			  		<tr align="right" style="font-size:10px">
				  		<td >Descuento</td>
				  		<td><?php // echo number_format($des,2)?></td>
			  		</tr>
			  		<tr align="right" style="font-size:10px">
			  			<td align="rigth">IMPOCONSUMO</td>
			  			<td><?php echo number_format($imp,2)?></td>
			  		</tr>
			  		<tr align="right" style="font-size:10px">
				  		<td align="rigth">Propina</td>
				  		<td><?php echo number_format($pro,2)?> </td>
			  		</tr>
			  	</table>
		  	</div>
			</div>
	  	<div class="row-fluid">
		  	<h3 align="right" style="font-size:12px">Total Cuenta: <?=number_format($tot,2)?></h3>
				<h5 style="font-size:10px">Son: <?php echo numtoletras($tot) ?></h5>	  		
	  	</div>
			<?php 
			if($pms==1){ ?>
				<div class="row-fluid" style="margin-top:40px">
					<h5 align="center" style="font-size:12px;font-weight: bold">Acepto se incluya en mi cuenta de Alojamiento el Presente Consumo </h5>
					<h5 align="center" style='margin-top:40px'><?php echo str_repeat('_', 50)?></h5>
					<h5 align="center">Firma Huesped</h5>
				</div>
				<?php 
			}
			?>
			<div class="row-fluid" style='margin-top:10px'>
				<div class="row-fluid">
					<p style="text-align: justify;font-size:10px">
						
					<?php 
 						$fp = fopen("../../../text/propina.txt", "r");
						while(!feof($fp)) {
							$linea = fgets($fp);
							echo $linea . "<br />";
						}
						fclose($fp);
					 ?>
					</p>
				</div>				
			</div>
		</div>
		<?php 
			include("../../../../res/shared/archivo_script.php") 
		?>
		<script src="../../res/js/ajax.js"></script>
 	</body>

</html>

<?php 
	/* 
	echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
	echo ("<script>location.href='../ventas/cuentas_activas.php'</script>"); 
	*/
?>

