document.addEventListener('DOMContentLoaded', async () => {
  const resultadoP = document.getElementById('resultado');
  const nombreRestauranteSpan = document.getElementById('nombreRestaurante');

  // Extraer el nombre del restaurante de la URL (parámetro GET)
  const urlParams = new URLSearchParams(window.location.search);
  const nombreRestaurante = urlParams.get('ambiente');
  const API_EMPRESA_URL = '../../../res/php/datosEmpresa.php';
  
  if (nombreRestaurante) {
    nombreRestauranteSpan.textContent = decodeURIComponent(nombreRestaurante);
  }

  async function traeDatosEmpresa() {
    try {
      const response = await fetch(API_EMPRESA_URL, {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
        },
      });
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      return await response.json();
    } catch (error) {
      console.error('Error al obtener los datos de la empresa:', error);
      return null;
    }
  }

  const datosEmpresa = await traeDatosEmpresa();
  if (datosEmpresa && datosEmpresa.empresa) {
    nombreEmpresa.textContent = datosEmpresa.empresa;

    // Crear y mostrar los botones
    headerButtonsDiv.innerHTML = `
      <button class="btn btn-primary" onclick="mostrarTodos()">Todos</button>
      <button class="btn btn-success" onclick="mostrarRecomendados()">Recomendados</button>
    `;
  }

  // Configuración de la validación de seguridad
  const dominiosSeguros = [
    'carta-restaurante.com', // Ejemplo: El dominio donde está la carta
    'menu-digital.net'       // Ejemplo de un segundo dominio
  ];

  /**
   * Valida si la URL escaneada es segura para la redirección.
   * @param {string} url - La URL obtenida del código QR.
   * @returns {boolean} - true si la URL es segura y válida.
   */
  function esURLSegura(url) {
    try {
      const urlObj = new URL(url);

      // 1. **Verificar el protocolo:** Solo permitir HTTPS.
      if (urlObj.protocol !== 'https:') {
        console.warn("URL no segura. Solo se permiten enlaces HTTPS.");
        resultadoP.textContent = "Error: La URL no es segura.";
        return false;
      }

      // 2. **Validar el dominio:** Asegura que el dominio está en la lista blanca.
      const dominioEsValido = dominiosSeguros.some(dominio =>
        urlObj.hostname.includes(dominio)
      );
      if (!dominioEsValido) {
        console.warn(`Dominio no permitido: ${urlObj.hostname}`);
        resultadoP.textContent = "Error: El QR no es válido para este restaurante.";
        return false;
      }

      return true;
    } catch (e) {
      // Manejar URLs mal formadas
      console.error("URL inválida:", e);
      resultadoP.textContent = "Error: Código QR no válido.";
      return false;
    }
  }

});

// Lista de dominios seguros del restaurante.
// **IMPORTANTE:** Reemplaza estos dominios con los de tu propio restaurante.
const DOMINIOS_SEGUROS = [
  'https://sactel.cloud',
  'https://subdominio.tu-restaurante.com',
  'https://donlolohotel.sactel.cloud',
  'http://donlolo.lan',
];