<?php
require_once 'res/php/titles.php';
require_once 'res/php/app_top.php';
?>
<!DOCTYPE html>
<html lang="es">


<head>
	<title><?php echo TITLE; ?> Ingreso al Sistema</title>
	<?php
    include_once 'res/shared/archivo_head.php';
?>
	<link href="res/css/estilocms.css" rel="stylesheet" type="text/css" media="all" />
	<link href="res/css/miestilo.css" rel="stylesheet" type="text/css" media="all" />
	<link rel="stylesheet" href="res/css/flexslider.css" type="text/css" media="screen" property="" />
</head>

<body class="skin-green sidebar-mini">
	<section id="pantallaPpal">
		<div class="row-fluid">
			<?php include_once 'res/menus/menu_index.php'; ?>
		</div>
		<section class="centrar">
			<div class="col-xs-8" style="margin-top:10%;">
				<div class="row" style="display:flex;">
					<div class="polig dvGreen letraBaldosin">
						<label for="" class="">POS</label>
					</div>
					<div class="letraBaldosin letraLogo">
						<label style="" for="">Barahona Software</label>
					</div>
				</div>
				<div class="row" style="display:flex;">
					<div class="polig dvViolet letraBaldosin"><label for="">PMS</label></div>
					<div class="polig dvYellow letraBaldosin"><label for="">CRS</label></div>
				</div>
			</div>
		</section>
	</section>

	<div class="modal fade" id="myModalLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header" style="padding-bottom: 0px">
					<button type="button" class="close ion ion-power" data-dismiss="modal" aria-label="Close"></button>
					<div class="form-top-left">
						<h3>Ingresa a tu cuenta</h3>
						<h5>Introduzca su nombre de usuario y contraseña para iniciar sesión:</h5>
					</div>
					<div class="form-top-right">
						<i class="fa fa-lock"></i>
					</div>
				</div>
				<form class="form-signin" role="form" id="login-form" name="login-form" action="javascript:valida_ingreso();" method="post">
					<div class="modal-body">
						<div id="error" name="error"></div>
						<div class="form-bottom bg-aqua">
							<div class="form-group">
								<label class="sr-only" for="form-username">Usuario</label>
								<input type="text" name="login" id="login" placeholder="Usuario" class="form-username form-control" required="">
							</div>
							<div class="form-group">
								<label class="sr-only" for="form-password">Password</label>
								<input type="password" id="pass" name="pass" placeholder="Password" class="form-password form-control" required="">
							</div>
						</div>
					</div>
					<div class="modal-footer" style="text-align: center">
						<button style="width: 25%" type="button" class="btn btn-warning" data-dismiss="modal"><span class="glyphicon glyphicon-log-out"></span> Cancelar</button>
						<button style="width: 25%" type="submit" class="btn btn-success" name="btn-login" id="btn-login"> <span class="glyphicon glyphicon-log-in"></span> Ingresar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php
include_once 'res/shared/archivo_pie.php';
include_once 'res/shared/archivo_script.php';
?>
	<script src="<?php echo BASE_JS; ?>inicio.js"></script>
</body>

</html>