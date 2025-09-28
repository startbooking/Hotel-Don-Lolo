<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SACTel Cloud - Carta Restaurante</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
  <link rel="stylesheet" href="res/css/carta.css">
</head>

<body>
  <div class="container">
    <header>
      <h1><span id="nombreEmpresa"></span></h1>
      <h2><span id="nombreRestaurante"></span></h2>
      <div id="headerButtonsDiv"></div>
    </header>
    <div id="lector-qr"></div>
    <main>
      <button id="btnVerTiposPlatos" class="btn-tipo">Ver Tipos de Platos</button>
      <div id="tiposPlatosScreen" class="hidden-screen">
        <div class="screen-header">
          <h2>Tipos de Platos</h2>
          <button id="btnCloseScreen" class="btn-close-screen">&times;</button>
        </div>
        <div id="tiposPlatosContainer" class="card-grid">
        </div>
      </div>

      <div id="platosContainer" class="grid-container"></div>

    </main>

    <footer>
      <p>&copy; <a target="_blank" href="http://www.sactel.cloud">SACTEL Cloud.</a> Todos los derechos reservados. Bogota DC - Colombia 2025</p>
    </footer>
  </div>

  <script src="https://unpkg.com/html5-qrcode"></script>
  <script src="../res/js/sactel.js"></script>
  <script src="res/js/carta.js"></script>

  <div id="platoModal" class="modal">
    <div class="modal-content">
      <span class="close-btn">&times;</span>
      <div id="modal-body">
      </div>
    </div>
  </div>
</body>

</html>