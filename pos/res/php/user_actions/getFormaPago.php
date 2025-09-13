<?php
require '../../../../res/php/titles.php';
require '../../../../res/php/app_topPos.php';

$fpa = $_POST['fpago'];

$PMS = $pos->getPagoPMS($fpa);
// echo $PMS;
?>
<select name="clientes" id='clientes' required>
  <?php
    if ($PMS == 1) {
      $huespedes = $pos->getHuespedesAlojadosPOS();
      foreach ($huespedes as $huesped) { ?>
        <option value="<?php echo $huesped['num_reserva']; ?>"><?php echo $huesped['num_habitacion'].' | '.$huesped['nombre_completo']; ?></option>
      <?php
      }
    } else {
      $clientes = $pos->getClientes();
      foreach ($clientes as $cliente) { ?>
	    <option value="<?php echo $cliente['id_cliente']; ?>"><?php echo $cliente['apellido1'].' '.$cliente['apellido2'].' '.$cliente['nombre1'].' '.$cliente['nombre2']; ?></option>
        <?php
      }
    }
  ?>
</select>

<input type="hidden" id="pms" name="pms" value="<?php echo $PMS; ?>">
