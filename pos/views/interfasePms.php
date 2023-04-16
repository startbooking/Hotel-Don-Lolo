<?php

  require '../../res/php/titles.php';
  require '../../res/php/app_topPos.php'; 

  $fecha   = FECHA_POS;
  $codigos = $pos->getCodigosVentas(1);
  $imptos  = $pos->getCodigosVentas(2);

?>

<!DOCTYPE html>
<html lang="es"> 
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= TITLE_POS?> | Configuracion Interfase  POS - PMS</title>
    <?php include_once("../../res/shared/archivo_head.php") ?>
    <link rel="stylesheet" type="text/css" href="<?=BASE_POS?>res/css/estilo.css">
  </head>

  <body class="skin-red sidebar-mini"> 
    <?php 
      include_once('../menus/menu_titulo_venta2.php') ;
      include_once("../menus/menu_pos.php");  
    ?>
    <div class="content-wrapper" style="margin-bottom: 50px"> 
      <section class="content">
        <div class="panel panel-success">
          <div class="panel-heading"> 
            <div class="row" style="display: flex">
              <div class="col-lg-6">
                <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_ADM?>">                  
                <input type="hidden" name="ubicacion" id="ubicacion" value="clientes.php">
                <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-address-book-o"></i> Interfase  PMS </h3>
              </div>
            </div>
          </div>
          <form id="guardarDatosInterfase" class="form-horizontal" action="javascript:actualizaInterfase()">
            <div class="panel-body">
              <div class="mensaje"></div>
              <div class="form-group">
                <label for="nombre" class="control-label col-lg-2 col-md-2">Descripcion</label>
                <div class="col-lg-4 col-md-4">
                  <select class="form-control" name="codigo" id="codigo" required="">
                    <option value="">Selecccione el Codigo de Venta PMS</option>
                    <?php 
                      foreach ($codigos as $codigo) { ?>
                        <option value="<?=$codigo['id_cargo']?>"><?=$codigo['descripcion_cargo']?></option>}
                        <?php 
                      }
                    ?>
                  </select>
                </div>
                <label for="nombre" class="control-label col-lg-2 col-md-2">Propina</label>
                <div class="col-lg-4 col-md-4">
                  <select class="form-control" name="propina" id="propina" required="">
                    <option value="">Selecccione el Codigo de Propina PMS</option>
                    <?php 
                      foreach ($codigos as $codigo) { ?>
                        <option value="<?=$codigo['id_cargo']?>"><?=$codigo['descripcion_cargo']?></option>}
                        <?php 
                      }
                    ?>

                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="nombre" class="control-label col-lg-2 col-md-2">Servicio</label>
                <div class="col-lg-4 col-md-4">
                  <select class="form-control" name="servicio" id="servicio" required="">
                    <option value="">Selecccione el Codigo de Venta PMS</option>
                    <?php 
                      foreach ($codigos as $codigo) { ?>
                        <option value="<?=$codigo['id_cargo']?>"><?=$codigo['descripcion_cargo']?></option>}
                        <?php 
                      }
                    ?>
                  </select>
                </div>
              </div>  
            </div>
            <div class="panel-footer" style="text-align:right">
              <a style="width: 20%" type="button" class="btn btn-warning" href="../index.php"><i class="fa fa-reply"></i> Regresar</a>
              <button style="width: 20%" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Actualizar</button>
            </div>
          </form>
        </div>
      </section>
    </div>

    <?php 
      include("../../res/shared/archivo_pie.php");
      include("../../res/shared/archivo_script.php") 
    ?>
    <script src="../../res/dist/dataTables.bootstrap.js"></script>
    <script src="../../res/dist/jquery.dataTables.min.js"></script> 
    <script>
      $(function () {
        $('#example1').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": true,
          "language": {
          "next": "Siguiente",
          "search": "Buscar:",
          "entries": "registros"
        },
      });
    });
    </script>
    <script src="../res/js/pos.js"></script>
  </body>
</html>