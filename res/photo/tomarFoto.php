<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Tomar foto Comprobante </title>
	<style>
		@media only screen and (max-width: 700px) {
			video {
				max-width: 100%;
			}
		}
	</style>
</head>

<body>
	<h1>Selecciona un dispositivo</h1>
	<div>
		<select name="listaDeDispositivos" id="listaDeDispositivos"></select>
		<button id="boton">Tomar foto</button>
		<p id="estado"></p>
	</div>
	<br>
	<video muted="muted" id="video"></video>
	<canvas id="canvas" style="display: none;"></canvas>
</body>
<script src="script.js"></script>

</html>