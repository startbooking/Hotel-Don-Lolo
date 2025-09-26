<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SACTel Cloud - Carta Restaurante</title>
  <link rel="stylesheet" href="res/css/carta.css">
</head>

<body>
  <div class="container">
    <header >
      <h1><span id="nombreEmpresa"></span></h1>
      <h2><span id="nombreRestaurante"></span></h2>
      <div id="headerButtonsDiv"></div>
    </header>
    <div id="lector-qr"></div>
    <main>
      <p id="resultado"></p>
    </main>

    <footer>
      <p>&copy; <a target="_blank" href="http://www.sactel.cloud">SACTEL Cloud.</a> Todos los derechos reservados. Bogota DC - Colombia 2025</p>
    </footer>
  </div>

  <script src="https://unpkg.com/html5-qrcode"></script>
  <script src="res/js/carta.js"></script>
</body>

</html>