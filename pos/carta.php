<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menú del Restaurante</title>
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
    <div class="main-tab-container">
      <div class="main-tab-buttons">
        <button class="main-tab-button active" onclick="openMainTab(event, 'recomendados')">Sugerencias del Chef</button>
        <button class="main-tab-button" onclick="openMainTab(event, 'tipos')">Nuestra Carta</button>
      </div>

      <div class="main-tab-content">
        <div id="recomendados" class="main-tab-pane active">
          <h2>Nuestras Sugerencias del Chef</h2>
          <ul id="lista-recomendados" class="platos-recomendados"></ul>
        </div>
        <div id="tipos" class="main-tab-pane">
          <div class="inner-tab-container">
            <div class="menu-container"></div>
          </div>
        </div>
        <div class="carta">
        </div>
      </div>
    </div>
  </div>
  <footer>
    <p>&copy; <a target="_blank" href="http://www.sactel.cloud">SACTEL Cloud.</a> Todos los derechos reservados. Bogota DC - Colombia 2025</p>
  </footer>
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