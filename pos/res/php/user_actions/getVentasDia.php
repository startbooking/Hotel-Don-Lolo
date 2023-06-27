<?php

  require '../../../../res/php/app_topPos.php'; 


	$idamb      = $_POST['idamb'];
	$comandas   = $pos->getVentasdelDia($idamb,0);

 ?>

	<div class="row-fluid centrarBotones">
	<?php
		foreach ($comandas as $comanda) { ?>
			<button 
				style="width: 19%"
				data-factura = "<?=$comanda['factura']; ?>"
				data-comanda = "<?=$comanda['comanda']; ?>"
				data-pms     = "<?=$comanda['pms']; ?>"
				data-estado  = "<?=$comanda['estado']; ?>" 
				value        = "<?=$comanda['comanda']; ?>" 
				<?php 
				if($comanda['estado']=='X'){ 
					?>
					class        = "btn btn-danger btnPos" 
					<?php 
				} ?>
					onClick      = "getFactura(this.value,'<?=$comanda['factura']; ?>','<?=$comanda['pms']; ?>');"
				<?php 
				if($comanda['pms']=='0'){ ?>
					class        = "btn btn-success btnPos" 
					title        = "Factura Numero <?php echo $comanda['factura']; ?>">					
						Mesa <?php echo $comanda['mesa']; ?><br>
			    	Factura Nro <?php echo number_format($comanda['factura'],0) ?>
					<?php 
				}else{?>
					class        = "btn btn-info btnPos" 
					title        = "Cheque Cuenta Numero <?php echo $comanda['factura']; ?>">
						Mesa <?php echo $comanda['mesa']; ?><br>
			    	Cheque Cuenta Nro <?php echo number_format($comanda['factura'],0) ?>
					<?php 
				}?>
			</button>
			<?php 
		}
	?>
	</div>