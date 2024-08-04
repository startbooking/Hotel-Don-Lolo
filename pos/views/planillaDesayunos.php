<?php
  $encasa = json_decode(file_get_contents('php://input'), true);


?>

<div class="container-fluid" style="margin-bottom:50px;">
  <div class="panel panel-default">
    <div class="panel-heading">
      <div class="row">
        <div class="col-lg-12">
          <h1 style="font-size:34px;text-align:center">Planilla Desayuno Huespedes </h1>
        </div>
      </div>
    </div>
    <div class="panel-body">
      <div class="table-responsive">
        <table id="example1" class="table modalTable table-bordered table-striped">
          <thead>
            <tr class="success" style="font-weight: bold">
              <td>Hab.</td>
              <td style="text-align:center;">Huesped</td>
              <td>Llegada</td>
              <td>Salida</td>
              <td>Desayuno</td>
            </tr>
          </thead>
          <tbody id="dataHuespedes">
          <?php 
              foreach ($encasa as $indice => $huesped) { ?>
                <tr>
                  <td>
                      <?php echo $huesped["num_habitacion"];?>
                  </td>
                  <td>
                    <?php echo $huesped["nombre_completo"];?>
                  </td>
                  <td><?php echo $huesped["fecha_llegada"];?></td>
                  <td><?php echo $huesped["fecha_salida"];?></td>
                  <td class="centro"><input type="checkbox" onclick="cambiaEstado(<?=$indice?>,this.checked)" <?php
                    if($huesped['estado']== 1) { ?>
                      checked = true
                      <?php
                    }
                    ?>
                  ></td>
                </tr>
                <?php
              }
              ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="panel-footer centro">
      <a href="inicio" type="button" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i> Regresar</a>
        <button onclick="guardaPlanillaDesayunos()" class="btn btn-primary"><i class="fa fa-save" aria-hidden="true"></i> Guardar</button>
    </div>
  </div>
</div>