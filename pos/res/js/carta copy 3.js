const URL_TIPOS = 'res/php/user_actions/traeTipoPlatosCarta.php';
const URL_PLATOS = 'res/php/user_actions/traePlatosCarta.php';
const URL_EMPRESA = '../../../res/php/datosEmpresa.php';
const IMAGEN_DEFAULT = '../img/noimage.png';
const urlParams = new URLSearchParams(window.location.search);
const urlRestaurante = urlParams.get('ambiente');

async function cargarPlatosRecomendadosOld(platos) {
  const listaRecomendados = document.getElementById('lista-recomendados');
  const platosRecomendados = platos.filter(plato => plato.plato_recomendado);

  platosRecomendados.forEach(plato => async () => {
    const li = document.createElement('li');

    // li.textContent = plato.nom;
    let muestra = await crearPlatoHTML(plato)
    console.log(li);

    li.innerHTML = muestra;
    listaRecomendados.appendChild(li);
  });
}

async function cargarPlatosRecomendadosOld(platos, crearPlatoHTML) {
  const listaRecomendados = document.getElementById('lista-recomendados');
  listaRecomendados.innerHTML = ''; // Limpia el contenedor antes de agregar elementos
  const platosRecomendados = platos.filter(plato => plato.plato_recomendado === 1);

  for (const plato of platosRecomendados) {
    const cardHTML = await crearPlatoHTML(plato);
    const li = document.createElement('li');
    li.innerHTML = cardHTML;
    listaRecomendados.appendChild(li);
  }
}

async function cargarTiposDePlatos(tipo_platos, platos) {
  const listaTipos = document.getElementById('lista-tipos');
  tipo_platos.forEach(tipo => {
    let { nombre_seccion, id_seccion } = tipo;
    const h3 = document.createElement('h3');
    h3.textContent = nombre_seccion;
    listaTipos.appendChild(h3);

    const ul = document.createElement('ul');
    const platosDelTipo = platos.filter(plato => plato.seccion === id_seccion);

    platosDelTipo.forEach(plato => {
      const li = document.createElement('li');
      li.innerHTML = `<strong>${plato.nom}</strong>`;
      ul.appendChild(li);
    });
    listaTipos.appendChild(ul);
  });
}

function openTab(evt, tabName) {
  let i, tabcontent, tabbuttons;
  tabcontent = document.getElementsByClassName("tab-pane");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tabbuttons = document.getElementsByClassName("tab-button");
  for (i = 0; i < tabbuttons.length; i++) {
    tabbuttons[i].className = tabbuttons[i].className.replace(" active", "");
  }
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " active";
}

/* function cargarPlatosRecomendados() {
  const listaRecomendados = document.getElementById('lista-recomendados');
  const platosRecomendados = platos.filter(plato => plato.recomendado);

  platosRecomendados.forEach(plato => {
    const li = document.createElement('li');
    li.textContent = plato.nombre;
    listaRecomendados.appendChild(li);
  });
}
 */
// Función principal para los tabs horizontales
function openMainTab(evt, tabName) {
  let i, tabcontent, tabbuttons;
  tabcontent = document.getElementsByClassName("main-tab-pane");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tabbuttons = document.getElementsByClassName("main-tab-button");
  for (i = 0; i < tabbuttons.length; i++) {
    tabbuttons[i].className = tabbuttons[i].className.replace(" active", "");
  }
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Funciones para el tab vertical
function generarTabsVerticales(tipo_platos, platos) {
  // const tiposOrdenados = [...tipo_platos].sort();
  const buttonContainer = document.getElementById('vertical-tab-buttons-container');
  const contentContainer = document.getElementById('vertical-tab-content-container');
  tipo_platos.forEach((tipo, index) => {
    const id = tipo.nombre_seccion.toLowerCase().replace(/\s/g, '_'); // Generar ID para cada tab

    // Crear el botón
    const button = document.createElement('button');
    button.className = 'vertical-tab-button';
    button.textContent = tipo.nombre_seccion;
    button.onclick = () => openVerticalTab(id);
    buttonContainer.appendChild(button);

    // Crear el panel de contenido
    const pane = document.createElement('div');
    pane.id = id;
    pane.className = 'vertical-tab-pane';

    const h3 = document.createElement('h3');
    h3.textContent = tipo.nombre_seccion;
    pane.appendChild(h3);

    const ul = document.createElement('ul');
    const platosDelTipo = platos.filter(plato => plato.tipo === tipo.id_seccion);

    platosDelTipo.forEach(plato => {
      console.log(plato)
      const li = document.createElement('li');
      li.innerHTML = `<strong>${plato.nom}</strong>`;
      ul.appendChild(li);
    });
    pane.appendChild(ul);
    contentContainer.appendChild(pane);

    // Activar la primera pestaña vertical por defecto
    if (index === 0) {
      button.classList.add('active');
      pane.classList.add('active');
    }
  });
}

function openVerticalTab(tabId) {
  document.querySelectorAll('.vertical-tab-pane').forEach(pane => pane.classList.remove('active'));
  document.querySelectorAll('.vertical-tab-button').forEach(button => button.classList.remove('active'));

  document.getElementById(tabId).classList.add('active');
  document.querySelector(`[onclick="openVerticalTab('${tabId}')"]`).classList.add('active');
}

document.addEventListener('DOMContentLoaded', async () => {
  const nombreEmpresa = document.getElementById('nombreEmpresa');
  const nombreRestauranteSpan = document.getElementById('nombreRestaurante');

  const datosEmpresa = await traeDatosEmpresa();
  const tipo_platos = await obtenerTipoPlatos()
  const platos_carta = await obtenerPlatos()
  if (datosEmpresa && datosEmpresa.empresa) {
    nombreEmpresa.textContent = datosEmpresa.empresa;
  }
  nombreRestauranteSpan.textContent = urlRestaurante.replace("_", " ");
  const tabs = generarMenu(tipo_platos, platos_carta);
  const carta = await cargarPlatosRecomendados(platos_carta);
  
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

function generarTabsYContenido() {
  const tabButtonContainer = document.getElementById('tab-button-container');
  const tabContentContainer = document.getElementById('tab-content-container');

  tipos_platos.forEach((tipo, index) => {
    // Crear el botón (tab)
    const button = document.createElement('button');
    button.className = 'tab-button';
    button.textContent = tipo.nombre;
    button.onclick = () => openTab(tipo.id);
    tabButtonContainer.appendChild(button);

    // Crear el panel de contenido
    const pane = document.createElement('div');
    pane.id = tipo.id;
    pane.className = 'tab-pane';

    // Agregar el título de la sección
    const title = document.createElement('h2');
    title.textContent = tipo.nombre;
    pane.appendChild(title);

    // Agregar la lista de platos
    const ul = document.createElement('ul');
    const platosDelTipo = platos.filter(plato => plato.seccion === tipo.id);

    if (platosDelTipo.length > 0) {
      platosDelTipo.forEach(plato => {
        const li = document.createElement('li');
        li.innerHTML = `<strong>${plato.nombre}</strong>`;
        ul.appendChild(li);
      });
    } else {
      const li = document.createElement('li');
      li.textContent = "No hay platos disponibles en esta categoría.";
      ul.appendChild(li);
    }
    pane.appendChild(ul);
    tabContentContainer.appendChild(pane);

    // Activar la primera pestaña por defecto
    if (index === 0) {
      button.classList.add('active');
      pane.classList.add('active');
    }
  });
}

function openTab(tabId) {
  // Ocultar todos los paneles y quitar la clase 'active' de los botones
  document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('active'));
  document.querySelectorAll('.tab-button').forEach(button => button.classList.remove('active'));

  // Mostrar el panel seleccionado y activar el botón correspondiente
  document.getElementById(tabId).classList.add('active');
  document.querySelector(`.tab-button[onclick="openTab('${tabId}')"]`).classList.add('active');
}

function openMainTab(evt, tabName) {
  let i, tabcontent, tabbuttons;
  tabcontent = document.getElementsByClassName("main-tab-pane");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tabbuttons = document.getElementsByClassName("main-tab-button");
  for (i = 0; i < tabbuttons.length; i++) {
    tabbuttons[i].className = tabbuttons[i].className.replace(" active", "");
  }
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Funciones para el tab interno (ahora también horizontal)
function generarTabsInternosOld(tipo_platos, platos) {
  // const tiposOrdenados = [...tipo_platos].sort();
  const buttonContainer = document.getElementById('inner-tab-buttons-container');
  const contentContainer = document.getElementById('inner-tab-content-container');

  tipo_platos.forEach((tipo, index) => {
    const id = tipo.nombre_seccion.toLowerCase().replace(/\s/g, '_'); // Generar ID para cada tab

    // Crear el botón
    const button = document.createElement('button');
    button.className = 'inner-tab-button';
    button.textContent = tipo.nombre_seccion;
    button.onclick = () => openInnerTab(id);
    buttonContainer.appendChild(button);

    // Crear el panel de contenido
    const pane = document.createElement('div');
    pane.id = id;
    pane.className = 'inner-tab-pane';

    const ul = document.createElement('ul');
    const platosDelTipo = platos.filter(plato => plato.seccion === tipo.id_seccion);

    if (platosDelTipo.length > 0) {
      platosDelTipo.forEach(plato => {
        const li = document.createElement('li');
        li.innerHTML = `<strong>${plato.nom}</strong>`;
        ul.appendChild(li);
      });
    } else {
      const li = document.createElement('li');
      li.textContent = "No hay platos disponibles en esta categoría.";
      ul.appendChild(li);
    }
    pane.appendChild(ul);
    contentContainer.appendChild(pane);

    // Activar la primera pestaña interna por defecto
    if (index === 0) {
      button.classList.add('active');
      pane.classList.add('active');
    }
  });
}

function openInnerTab(tabId) {
  document.querySelectorAll('.inner-tab-pane').forEach(pane => pane.classList.remove('active'));
  document.querySelectorAll('.inner-tab-button').forEach(button => button.classList.remove('active'));

  document.getElementById(tabId).classList.add('active');
  document.querySelector(`.inner-tab-button[onclick="openInnerTab('${tabId}')"]`).classList.add('active');
}


function generarMenu(tipo_platos, platos) {
  const menuContainer = document.querySelector('.menu-container');
  // const tiposOrdenados = [...tipos_platos].sort();

  tipo_platos.forEach(tipo => {
    let { nombre_seccion, id_seccion } = tipo;
    // Crear el contenedor de cada tipo de plato
    const menuItem = document.createElement('div');
    menuItem.className = 'menu-item';

    // Crear el botón de la categoría
    const button = document.createElement('button');
    button.className = 'menu-button';
    button.innerHTML = `<span>${nombre_seccion}</span>`;

    // Crear el contenedor para los productos
    const productsContainer = document.createElement('div');
    productsContainer.className = 'menu-products';

    const ul = document.createElement('ul');
    const platosDelTipo = platos.filter(plato => plato.seccion === id_seccion);

    platosDelTipo.forEach(plato => {
      const li = document.createElement('li');
      li.textContent = plato.nom;
      ul.appendChild(li);
    });

    productsContainer.appendChild(ul);
    menuItem.appendChild(button);
    menuItem.appendChild(productsContainer);
    menuContainer.appendChild(menuItem);

    // Añadir el evento de clic al botón
    button.addEventListener('click', () => {
      const isActive = button.classList.contains('active');

      // Cerrar todos los menús abiertos
      document.querySelectorAll('.menu-button').forEach(btn => btn.classList.remove('active'));
      document.querySelectorAll('.menu-products').forEach(prod => prod.classList.remove('active'));

      // Si no estaba activo, abrir este
      if (!isActive) {
        button.classList.add('active');
        productsContainer.classList.add('active');
      }
    });
  });
}

async function mostrarPlato(plato) {
  let cardHTML = ''
  const imagenSrc = (plato.foto === 'null' || !plato.foto) ? IMAGEN_DEFAULT : 'images/' + plato.foto;
  const textoPlato = (plato.descripcion_plato === null) ? ' ' : plato.descripcion_plato.length >= 50 ? plato.descripcion_plato.substr(0, 50) : plato.descripcion_plato;
  const platoRecomendadoBadge = (plato.plato_recomendado == 1) ?
    `<p class="badge badge-success"><i class="fas fa-star"></i> Recomendado</p>` : '';

  cardHTML = `
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
  console.log(cardHTML);
  return cardHTML
}

async function crearPlatoHTML(plato) {
  // Define constantes para los valores predeterminados
  const IMAGEN_DEFAULT = 'images/default.jpg';
  const MAX_DESCRIPCION_LENGTH = 50;

  // Valida y formatea la imagen
  const imagenSrc = (plato.foto && plato.foto !== 'null') ? `images/${plato.foto}` : IMAGEN_DEFAULT;

  // Valida y formatea la descripción
  let textoPlato = '';
  if (plato.descripcion_plato) {
    textoPlato = plato.descripcion_plato.length > MAX_DESCRIPCION_LENGTH 
      ? `${plato.descripcion_plato.substring(0, MAX_DESCRIPCION_LENGTH)}...` 
      : plato.descripcion_plato;
  }

  // Crea el badge de plato recomendado
  const platoRecomendadoBadge = (plato.plato_recomendado === 1) ?
    `<p class="badge badge-success"><i class="fas fa-star"></i> Recomendado</p>` : '';

  // Formatea el precio (asumiendo que 'number_format' es una función externa)
  const precioFormateado = `$ ${number_format(plato.venta, 2)}`;

  // Retorna el HTML completo de la tarjeta
  return `
    <div class="card" onclick='mostrarModal(${JSON.stringify(plato)})'>
      <div class="card-image-container">
        <img src="${imagenSrc}" alt="${plato.nombre}" onerror="this.src='${IMAGEN_DEFAULT}';">
      </div>
      <div class="card-content">
        <h3>${plato.nom}</h3>
        <p class="price">${precioFormateado}</p>
        <p class="descript">${textoPlato}</p>
      </div>
      ${platoRecomendadoBadge}
    </div>
  `;
}

async function generarTabsInternos(platos, tipos_platos, crearPlatoHTML) {
  const tiposOrdenados = [...tipos_platos].sort();
  const buttonContainer = document.getElementById('inner-tab-buttons-container');
  const contentContainer = document.getElementById('inner-tab-content-container');

  buttonContainer.innerHTML = '';
  contentContainer.innerHTML = '';

  for (const [index, tipo] of tiposOrdenados.entries()) {
    const id = tipo.toLowerCase().replace(/\s/g, '_');

    // Crea el botón del tab
    const button = document.createElement('button');
    button.className = 'inner-tab-button';
    button.textContent = tipo;
    button.onclick = () => openInnerTab(id);
    buttonContainer.appendChild(button);

    // Crea el panel de contenido
    const pane = document.createElement('div');
    pane.id = id;
    pane.className = 'inner-tab-pane';

    const ul = document.createElement('ul');
    const platosDelTipo = platos.filter(plato => plato.tipo === tipo);

    if (platosDelTipo.length > 0) {
      for (const plato of platosDelTipo) {
        const cardHTML = await crearPlatoHTML(plato);
        const li = document.createElement('li');
        li.innerHTML = cardHTML;
        ul.appendChild(li);
      }
    } else {
      const li = document.createElement('li');
      li.textContent = "No hay platos disponibles en esta categoría.";
      ul.appendChild(li);
    }

    pane.appendChild(ul);
    contentContainer.appendChild(pane);

    // Activa el primer tab por defecto
    if (index === 0) {
      button.classList.add('active');
      pane.classList.add('active');
    }
  }
}

async function cargarPlatosRecomendados(platos, crearPlatoHTML) {
  const listaRecomendados = document.getElementById('lista-recomendados');
  listaRecomendados.innerHTML = ''; // Limpia el contenedor antes de agregar elementos
  const platosRecomendados = platos.filter(plato => plato.plato_recomendado === 1);

  // Usa un bucle for...of para manejar la función asíncrona de forma secuencial
  for (const plato of platosRecomendados) {
    const cardHTML = await crearPlatoHTML(plato);
    const li = document.createElement('li');
    li.innerHTML = cardHTML;
    listaRecomendados.appendChild(li);
  }
}