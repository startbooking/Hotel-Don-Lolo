<?php 
  require_once '../../res/php/titles.php';
  require_once '../../res/php/app_topPos.php'; 
  include_once('../../res/php/validaIngreso.php');
?>
<!DOCTYPE html>
<html lang="es"> 
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= TITLE_POS?> | Balance Cajero </title>
		<?php include_once("../../res/shared/archivo_head.php") ?>
    <link rel="stylesheet" type="text/css" href="../res/css/estilo.css">
	</head>

	<body class="skin-red sidebar-mini"> 
  	<?php 
      include_once('../menus/menu_titulo_venta2.php') ;
			include_once("../menus/menu_pos.php");	
  	?>

    <div class="content-wrapper"> 
      <section class="content">
        <div class="panel panel-success">
          <div class="panel-heading"> 
            <div class="row">
              <div class="col-lg-9">
                <input type="hidden" name="user" id="user" value="<?=$_SESSION['usuario']?>">
                <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_POS?>">
                <input type="hidden" name="ubicacion" id="ubicacion" value="balance_diario.php">
                <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-industry"></i> Balance del Dia Cajero <?=$_SESSION['usuario']?></h3>
              </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="imprimeInforme">
              <object id="verInforme" width="100%" height="500" data=""></object> 
            </div>
            <?php 
              include '../imprimir/imprimeBalanceDiario.php';
            ?>
          </div>
        </div>
      </section>
    </div>

		<?php 
			include("../../res/shared/archivo_pie.php");
			include("../../res/shared/archivo_script.php") 
		?>
    <script>
      usu = $('#user').val();
      $('#verInforme').attr('data','../imprimir/informes/Balance_diario_'+usu+'.pdf')
    </script>
 	</body>
</html>


