<?php 
  
  $periodos = $inven->periodosActivos();

?>

    <div class="content-wrapper"> 
      <section class="content">
        <div class="panel panel-success">
          <div class="panel-heading"> 
            <div class="container-fluid" style="padding:0">
              <div class="col-lg-3" style="padding:0">
                <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_INV?>">
                <input type="hidden" name="ubicacion" id="ubicacion" value="proveedores">
                <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-cubes"></i> Periodos Activos </h3>
              </div>
            </div>
            <div class="container-fluid">
            </div>
          </div>
          <div class="panel-body">
            <div class="row-fluid">
              <h2 align="center">Periodos Activos Sistema de Inventarios</h2>
              <div class="col-lg-4 col-lg-offset-4">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Periodo</th>
                      <th>Mes</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($periodos as $key => $periodo):?>
                      <tr>
                        <td><?=$periodo['mes']?></td>
                        <td><?=nombreMes($periodo['mes'])?></td>
                      </tr>                      
                    <?php endforeach ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>


