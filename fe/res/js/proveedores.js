$(document).ready(function () {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  
  formulario = document.querySelector('form');
  
  let { user } = sesion;
  let { apellidos, nombres } = user;

  tabla = document.querySelector("#example1");

  console.log(tabla);

  tabla.DataTable({
    iDisplayLength: 25,
    paging: true,
    lengthChange: true,
    searching: true,
    ordering: true,
    info: true,
    autoWidth: true,
    language: {
      next: "Siguiente",
      search: "Buscar:",
      entries: "registros",
    },
  });
  
  addEventListener('submit', e => {
    const data = Object.fromEntries(new FormData(e.target))
    // alert(JSON.stringify(data))
  })

/*   nombreUsuaro = document.querySelector('#nombreUsuario');
  nombreUsuaro.innerHTML = `${apellidos}  ${nombres}<span class="caret"></span>`;
 */
  
  
});

