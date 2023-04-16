  
    <div class="panel panel-info" style="margin-top:1em;padding:10px">
      <div class="panel-heading titlePanel">
        <h3 class="titlesPage">Informacion General de la Compañia </h3>
      </div>
      <div class="panel-body" style="padding: 10px">
        <div id="mensaje"></div>
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr align="center">
              <th>Empresa</th>
              <th>Direccion</th>
              <th>Nit</th>
              <th>Logo</th>
              <th>Favicon</th>
              <th>Activo</th> 
              <th>Estado</th> 
              <th style="width: 12%">Accion</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            foreach ($companys as $company) : ?>
              <tr>
                <td style="text-align:left"><?php echo $company['hotel_name'];?></td>
                <td style="text-align:left"><?php echo $company['adress'];?></td>
                <td style="text-align:left"><?php echo $company['nit_hotel'];?></td>
                <td align="center"><img style="height: 35px;" class="img-thumbnail" src="<?php echo BASE_IMAGES.$company['logo'];?>" alt=""></td>
                <td align="center"><img style="height: 35px;" class="img-thumbnail" src="<?php echo BASE_IMAGES.$company['icono'];?>" alt=""></td>
                <td align="center"><?=estadoCompany($company['active_at']);?></td>
                <td align="center"><?=estadoMmto($company['mmto']);?></td>
                <td align="center">
                    <?php 
                      if($company['active_at']==2){
                        $boton  = "btn btn-danger btn-xs";
                        $titulo = "Web En Manteminiento";
                        $icono  = "fa fa-toggle-on";
                      }else{
                        $boton  = "btn btn-success btn-xs";
                        $titulo = "Web On Line";
                        $icono  = "fa fa-toggle-off";
                      }
                    ?>
                    <div class="btn-group">
                      <button class="<?=$boton?>" type="button" title="<?=$titulo?>" onclick="activeHotel(<?=$company['id_hotel'];?>,<?=$company['active_at'];?>)">
                      <i class="<?=$icono?>" aria-hidden="true"></i>
                      </button>
                      <button class="btn btn-info btn-xs" type="button" 
                        title          = "Modificar Datos" 
                        data-toggle    = "modal" 
                        data-target    = "#dataUpdateCompany"
                        data-id        = '<?php echo $company['id_hotel']?>'
                        data-nombre    = '<?php echo $company['hotel_name']?>'
                        data-direccion = '<?php echo $company['adress']?>'
                        data-phone     = '<?php echo $company['phone']?>'
                        data-movil     = '<?php echo $company['movil']?>'
                        data-estado    = '<?php echo $company['active_at']?>'
                        data-nit       = '<?php echo $company['nit_hotel']?>'
                        >
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                      </button>
                    </div>
                </td> 
              </tr>
            <?php 
            endforeach
            ?>
          </tbody>
        </table>    
      </div>
    </div>
