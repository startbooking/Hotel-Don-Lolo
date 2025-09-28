const URL_TIPOS_PLATOS = 'res/php/user_actions/traeTipoPlatosCarta.php';
const URL_PLATOS = 'res/php/user_actions/traePlatosCarta.php';
const API_EMPRESA_URL = '../../../res/php/datosEmpresa.php';
const IMAGEN_DEFAULT = '../img/noimage.png';

const btnVerTiposPlatos = document.getElementById('btnVerTiposPlatos');
const tiposPlatosScreen = document.getElementById('tiposPlatosScreen');
const btnCloseScreen = document.getElementById('btnCloseScreen');

const tiposPlatosContainer = document.getElementById('tiposPlatosContainer');
const platosContainer = document.getElementById('platosContainer');
const btnTiposPlatos = document.getElementById('btnTiposPlatos');
const urlParams = new URLSearchParams(window.location.search);
const urlRestaurante = urlParams.get('ambiente');
const resultadoP = document.getElementById('resultado');
const nombreRestauranteSpan = document.getElementById('nombreRestaurante');
const modal = document.getElementById('platoModal');
const modalBody = document.getElementById('modal-body');
const closeBtn = document.querySelector('.close-btn');
// Llamar a las funciones al cargar la página
// Extraer el nombre del restaurante de la URL (parámetro GET)
const nombreRestaurante = urlRestaurante.replaceAll("_", " ");
const platos = await obtenerPlatos();
const tipos = await obtenerTipoPlatos();
console.log(tipos)
console.log(platos)

document.addEventListener('DOMContentLoaded', async () => {
  const filtroPlatos = platos.filter(plato => plato.plato_recomendado === 1);

  await renderizarPlatos(filtroPlatos);
  await renderizarTiposPlatos(tipos);

  if (nombreRestaurante) {
    nombreRestauranteSpan.textContent = decodeURIComponent(nombreRestaurante);
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

  // Event listener para el botón "Ver Tipos de Platos"
  headerButtonsDiv.innerHTML = `<button id="btnTiposPlatos" class="btn-tipo">Ver Tipos de Platos</button>`;
  const btnTiposPlatos = document.getElementById('btnTiposPlatos');
  btnTiposPlatos.addEventListener('click', () => mostrarTiposDePlatos(nombreRestaurante));




  // Configuración de la validación de 
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

  window.mostrarModal = (plato) => {
    // Limpiar el contenido anterior
    modalBody.innerHTML = '';

    // Lógica para la imagen por defecto
    const imagenSrc = (plato.foto && plato.foto !== 'null') ? `images/${plato.foto}` : IMAGEN_DEFAULT;

    // Insertar el contenido del plato en el modal
    modalBody.innerHTML = `
      <img src="${imagenSrc}" alt="${plato.nom}" onerror="this.src='${IMAGEN_DEFAULT}';">
      <h3>${plato.nom}</h3>
      <p class="price">Precio: $ ${number_format(plato.venta, 2)}</p>
      <p><strong>Descripción:</strong> ${plato.descripcion_plato}</p>
    `;

    // Mostrar el modal
    modal.style.display = 'block';
  }

  // Cerrar el modal al hacer clic en el botón 'x'
  closeBtn.onclick = () => {
    modal.style.display = 'none';
  }

  // Cerrar el modal si el usuario hace clic fuera de él
  window.onclick = (event) => {
    if (event.target == modal) {
      modal.style.display = 'none';
    }
  }

  btnVerTiposPlatos.addEventListener('click', fetchTiposPlatos);
  btnCloseScreen.addEventListener('click', () => {
    tiposPlatosScreen.classList.remove('visible-screen');
  });
  
  async function obtenerPlatos() {
    try {
      // console.log(nombreRestaurante.value);
      const url = `${URL_PLATOS}?ambiente=${urlRestaurante}`;
      const response = await fetch(url);
      if (!response.ok) {
        throw new Error(`Error HTTP: ${response.status}`);
      }
      const data = await response.json();
      return data;
    } catch (error) {
      console.error('Error al obtener los platos:', error);
      return []; // Retorna un array vacío en caso de error
    }
  }
});





async function mostrarTiposDePlatos(restaurante) {
  try {
    const url = `${URL_TIPOS_PLATOS_BASE}?restaurante=${encodeURIComponent(restaurante)}`;
    const response = await fetch(url);

    if (!response.ok) {
      throw new Error('Error al obtener los tipos de platos.');
    }

    const tipos = await response.json();
    tiposPlatosContainer.innerHTML = '';

    tipos.forEach(tipo => {
      const btn = document.createElement('button');
      btn.textContent = tipo.descripcion;
      btn.className = 'btn-tipo';
      btn.addEventListener('click', () => {
        filtrarPlatosPorTipo(restaurante, tipo.id_tipo_plato);
      });
      tiposPlatosContainer.appendChild(btn);
    });

  } catch (error) {
    console.error('Error:', error);
    tiposPlatosContainer.innerHTML = '<p>Error al cargar los tipos de platos.</p>';
  }
}

// Lista de dominios seguros del restaurante.
// **IMPORTANTE:** Reemplaza estos dominios con los de tu propio restaurante.
const DOMINIOS_SEGUROS = [
  'https://sactel.cloud',
  'https://subdominio.tu-restaurante.com',
  'https://donlolohotel.sactel.cloud',
  'http://donlolo.lan',
];



async function obtenerTipoPlatos() {
  try {
    // console.log(nombreRestaurante.value);
    const url = `${URL_TIPOS_PLATOS}?ambiente=${urlRestaurante}`;
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error(`Error HTTP: ${response.status}`);
    }
    const data = await response.json();
    return data;
  } catch (error) {
    console.error('Error al obtener los platos:', error);
    return []; // Retorna un array vacío en caso de error
  }
}


/**
 * Función para renderizar los platos en la página.
 * @param {Array<Object>} platos - Array de platos a renderizar.
 */
async function renderizarPlatos(platos) {
  const container = document.getElementById('platos-container');
  container.innerHTML = ''; // Limpiar contenedor

  if (platos.length === 0) {
    container.innerHTML = '<p class="text-center text-gray-500">No se encontraron platos.</p>';
    return;
  }

  platos.forEach(plato => {
    const imagenSrc = (plato.foto === 'null' || !plato.foto) ? IMAGEN_DEFAULT : 'images/' + plato.foto;
    const textoPlato = (plato.descripcion_plato === null) ? ' ' : plato.descripcion_plato.length >= 50 ? plato.descripcion_plato.substr(0, 50) : plato.descripcion_plato;
    const platoRecomendadoBadge = (plato.plato_recomendado == 1) ?
      `<p class="badge badge-success"><i class="fas fa-star"></i> Recomendado</p>` : '';

    const cardHTML = `
      <div class="card" onclick='mostrarModal(${JSON.stringify(plato)})'>
        <div class="card-image-container">
          <img src="${imagenSrc}" alt="${plato.nombre}" onerror="this.src='${IMAGEN_DEFAULT}';">
        </div>
        <div class="card-content">
          <h3>${plato.nom}</h3>
          <p class="price">$ ${number_format(plato.venta, 2)}</p>
          <p class="descript">${plato.descripcion_plato}</p>
        </div>
        ${platoRecomendadoBadge}
      </div>
    `;
    container.innerHTML += cardHTML;
  });
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

async function mostrarTiposDePlatosOld() {
  try {
    const url = `${URL_TIPOS_PLATOS}?ambiente=${urlRestaurante}`;
    const response = await fetch(url, {
      headers: {
        'Content-Type': 'application/json',
      },
    });

    if (!response.ok) {
      throw new Error('Error al obtener los tipos de platos.');
    }
    const tipos = await response.json();

    // Limpiar el contenedor de tipos de platos
    tiposPlatosContainer.innerHTML = '';

    // Crear y mostrar un botón por cada tipo de plato
    tipos.forEach(tipo => {
      const btn = document.createElement('button');
      btn.textContent = tipo.descripcion;
      btn.className = 'btn-tipo';
      btn.addEventListener('click', () => {
        // Al hacer clic, filtrar y mostrar los platos de ese tipo
        filtrarPlatosPorTipo(tipo.id_tipo_plato);
      });
      tiposPlatosContainer.appendChild(btn);
    });
  } catch (error) {
    console.error('Error:', error);
    tiposPlatosContainer.innerHTML = '<p>Error al cargar los tipos de platos.</p>';
  }
}

/**
 * Filtra los platos por tipo y los renderiza en pantalla.
 * @param {string} tipoId - El ID del tipo de plato a filtrar.
 */
async function filtrarPlatosPorTipo(tipoId) {
  try {
    const response = await fetch(URL_PLATOS);
    if (!response.ok) {
      throw new Error('Error al obtener los platos.');
    }
    const platos = await response.json();

    // Filtrar los platos por el ID del tipo
    const platosFiltrados = platos.filter(plato => plato.id_tipo_plato == tipoId);

    // Limpiar y renderizar los platos filtrados
    platosContainer.innerHTML = '';
    if (platosFiltrados.length === 0) {
      platosContainer.innerHTML = '<p>No hay platos de este tipo.</p>';
    } else {
      platosFiltrados.forEach(plato => {
        // Aquí puedes reutilizar la función que ya tengas para renderizar una tarjeta de plato
        platosContainer.innerHTML += `
          <div class="card">
            <img src="${plato.foto}" alt="${plato.nombre}">
            <div class="card-content">
              <h3>${plato.nombre}</h3>
              <p class="price">$${plato.precio}</p>
              <p>${plato.descripcion}</p>
            </div>
          </div>
        `;
      });
    }
  } catch (error) {
    console.error('Error:', error);
    platosContainer.innerHTML = '<p>Error al cargar los platos.</p>';
  }
}


async function mostrarTiposDePlatos() {
  try {
    const response = await fetch(URL_TIPOS_PLATOS);
    if (!response.ok) {
      throw new Error('Error al obtener los tipos de platos.');
    }
    const tipos = await response.json();

    // Limpiar el contenedor de tipos de platos
    tiposPlatosContainer.innerHTML = '';

    // Crear y mostrar un botón por cada tipo de plato
    tipos.forEach(tipo => {
      const btn = document.createElement('button');
      btn.textContent = tipo.descripcion;
      btn.className = 'btn-tipo';
      btn.addEventListener('click', () => {
        // Al hacer clic, filtrar y mostrar los platos de ese tipo
        filtrarPlatosPorTipo(tipo.id_tipo_plato);
      });
      tiposPlatosContainer.appendChild(btn);
    });
  } catch (error) {
    console.error('Error:', error);
    tiposPlatosContainer.innerHTML = '<p>Error al cargar los tipos de platos.</p>';
  }
}

/**
 * Filtra los platos por tipo y los renderiza en pantalla.
 * @param {string} tipoId - El ID del tipo de plato a filtrar.
 */
async function filtrarPlatosPorTipoOld(tipoId) {
  try {
    const response = await fetch(URL_PLATOS);
    if (!response.ok) {
      throw new Error('Error al obtener los platos.');
    }
    const platos = await response.json();

    // Filtrar los platos por el ID del tipo
    const platosFiltrados = platos.filter(plato => plato.id_tipo_plato == tipoId);

    // Limpiar y renderizar los platos filtrados
    platosContainer.innerHTML = '';
    if (platosFiltrados.length === 0) {
      platosContainer.innerHTML = '<p>No hay platos de este tipo.</p>';
    } else {
      platosFiltrados.forEach(plato => {
        // Aquí puedes reutilizar la función que ya tengas para renderizar una tarjeta de plato
        platosContainer.innerHTML += `
          <div class="card">
            <img src="${plato.foto}" alt="${plato.nombre}">
            <div class="card-content">
              <h3>${plato.nombre}</h3>
              <p class="price">$${plato.precio}</p>
              <p>${plato.descripcion}</p>
            </div>
          </div>
        `;
      });
    }
  } catch (error) {
    console.error('Error:', error);
    platosContainer.innerHTML = '<p>Error al cargar los platos.</p>';
  }
}

// Agregar el evento al botón principal
btnTiposPlatos.addEventListener('click', mostrarTiposDePlatos);

/**
   * Filtra los platos por tipo y los renderiza en pantalla.
   * @param {string} restaurante - El nombre del restaurante para filtrar.
   * @param {string} tipoId - El ID del tipo de plato a filtrar.
   */
async function filtrarPlatosPorTipoOld(restaurante, tipoId) {
  try {
    const url = `${URL_PLATOS_BASE}?restaurante=${encodeURIComponent(restaurante)}&tipo=${encodeURIComponent(tipoId)}`;
    const response = await fetch(url);

    if (!response.ok) {
      throw new Error('Error al obtener los platos.');
    }

    const platos = await response.json();
    await renderizarPlatos(platos);

  } catch (error) {
    console.error('Error:', error);
    platosContainer.innerHTML = '<p>Error al cargar los platos.</p>';
  }
}


async function iniciarCargaDePlatosRecomendados(restaurante) {
  try {
    // Adjunta el parámetro para filtrar por productos recomendados
    const url = `${URL_PLATOS_BASE}?restaurante=${encodeURIComponent(restaurante)}&recomendado=1`;
    const response = await fetch(url);

    if (!response.ok) {
      throw new Error('Error al obtener los platos.');
    }

    const platos = await response.json();
    await renderizarPlatos(platos);

  } catch (error) {
    console.error('Error:', error);
    platosContainer.innerHTML = '<p>Error al cargar los platos recomendados.</p>';
  }
}

async function renderizarTiposPlatos(tipos) {
  tiposPlatosContainer.innerHTML = ''; // Limpiar contenedor
  tipos.forEach(tipo => {
    const button = document.createElement('button');
    button.textContent = tipo.descripcion;
    button.className = 'btn-tipo';
    button.addEventListener('click', () => {
      filtrarYRenderizarPlatos(tipo.id_tipo_plato);
    });
    tiposPlatosContainer.appendChild(button);
  });
}

