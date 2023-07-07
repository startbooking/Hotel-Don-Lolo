<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 

  $fecha      =  $_POST['fechaaudi'];
  $auditorias = $hotel->getBuscaAuditoriaFecha(); 
?>

<div class="table-responsive">
  <input type="hidden" name="fechaaudi" id="fechaaudi" value="<?=$fecha?>">
  <table id="example1" class="table table-bordered">
    <thead>
      <tr class="warning">
        <td>Informe</td>
        <td>Accion</td>
      </tr>
    </thead>
    <tbody>
      <?php
      if(count($auditorias)==0){ ?>
        <tr>
          <td> Fecha NO Encontrada</td>
        </tr>
        <?php 
      }else{
        foreach ($auditorias as $auditoria) { ?>
          <tr style='font-size:12px'>
            <td style="padding:3px 5px"><?php echo $auditoria['titulo_proceso']; ?></td>
            <td style="padding:3px 5px" align="center">
              <button class="btn btn-info btn-xs" type="button"><i class="fa fa-file-pdf-o" aria-hidden="true" onclick="verAuditoria('<?php echo $auditoria['reporte']?>')"></i></button>
            </td>
          </tr>
          <?php 
        }            
      }
      ?>
    </tbody>
  </table>
</div>
