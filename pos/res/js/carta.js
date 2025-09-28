const URL_TIPOS = 'res/php/user_actions/traeTipoPlatosCarta.php';
const URL_PLATOS = 'res/php/user_actions/traePlatosCarta.php';
const URL_EMPRESA = '../../../res/php/datosEmpresa.php';
const IMAGEN_DEFAULT = '../img/noimage.png';
const urlParams = new URLSearchParams(window.location.search);
const urlRestaurante = urlParams.get('ambiente');
console.log(urlRestaurante)

document.addEventListener('DOMContentLoaded', async () => {
  const btnVerTiposPlatos = document.getElementById('btnVerTiposPlatos');
  const tiposPlatosScreen = document.getElementById('tiposPlatosScreen');
  const btnCloseScreen = document.getElementById('btnCloseScreen');
  const tiposPlatosContainer = document.getElementById('tiposPlatosContainer');
  const platosContainer = document.getElementById('platosContainer');
  const nombreRestauranteSpan = document.getElementById('nombreRestaurante');
  const btnTiposPlatos = document.getElementById('btnTiposPlatos');

  const modal = document.getElementById('platoModal');
  const modalBody = document.getElementById('modal-body');
  const closeBtn = document.querySelector('.close-btn');
  // Llamar a las funciones al cargar la página
  // Extraer el nombre del restaurante de la URL (parámetro GET)
  const nombreRestaurante = urlRestaurante.replaceAll("_", " ");


  let todosLosPlatos = [];
  const platos = await obtenerPlatos();
  const tipos = await obtenerTipoPlatos();

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


  // Función para obtener los tipos de platos y mostrar la pantalla
  

  // Eventos
  btnVerTiposPlatos.addEventListener('click', fetchTiposPlatos);
  btnCloseScreen.addEventListener('click', () => {
    tiposPlatosScreen.classList.remove('visible-screen');
  });

  // Cargar todos los platos al inicio
  // fetchTodosLosPlatos();
});

async function traeDatosEmpresa() {
  try {
    const response = await fetch(URL_EMPRESA, {
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


async function obtenerPlatos() {
  try {
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

async function obtenerTipoPlatos() {
  try {
    const url = `${URL_TIPOS}?ambiente=${urlRestaurante}`;
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


async function fetchTiposPlatos() {
    try {
      const response = await fetch(URL_TIPOS);
      if (!response.ok) {
        throw new Error('Error al obtener los tipos de platos.');
      }
      const tipos = await response.json();
      renderizarTiposPlatos(tipos);
      // Muestra la pantalla con animación
      tiposPlatosScreen.classList.add('visible-screen');
    } catch (error) {
      console.error(error);
      tiposPlatosContainer.innerHTML = '<p>No se pudieron cargar los tipos de platos.</p>';
    }
  }

  // Función para renderizar los tipos de platos como tarjetas con imagen
  function renderizarTiposPlatos(tipos) {
    tiposPlatosContainer.innerHTML = '';
    tipos.forEach(tipo => {
      const cardHTML = `
        <div class="card-tipo" data-id="${tipo.id_tipo_plato}">
          <img src="${tipo.imagen_fondo}" alt="${tipo.descripcion}" class="card-tipo-img">
          <div class="card-tipo-overlay">${tipo.descripcion}</div>
        </div>
      `;
      tiposPlatosContainer.innerHTML += cardHTML;
    });

    // Añadir event listeners después de renderizar
    document.querySelectorAll('.card-tipo').forEach(card => {
      card.addEventListener('click', () => {
        const tipoId = card.dataset.id;
        filtrarYRenderizarPlatos(tipoId);
        // Ocultar la pantalla de tipos de platos después de la selección
        tiposPlatosScreen.classList.remove('visible-screen');
      });
    });
  }

  // Carga inicial de todos los platos (se mantienen en una variable)
  async function fetchTodosLosPlatos() {
    try {
      const response = await fetch(URL_PLATOS);
      if (!response.ok) {
        throw new Error('Error al obtener los platos.');
      }
      todosLosPlatos = await response.json();
      renderizarPlatos(todosLosPlatos); // Renderiza todos los platos al inicio
    } catch (error) {
      console.error(error);
      platosContainer.innerHTML = '<p>No se pudieron cargar los platos.</p>';
    }
  }

  // Lógica de filtrado de platos (sin cambios)
  function filtrarYRenderizarPlatos(tipoId) {
    const platosFiltrados = todosLosPlatos.filter(plato => plato.id_tipo_plato == tipoId);
    renderizarPlatos(platosFiltrados);
  }

  // Lógica de renderizado de platos (sin cambios)
  function renderizarPlatos(platos) { /* ... */ }