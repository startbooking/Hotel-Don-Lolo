/* import {
  traeProveedores,
} from "./API.js"; */


// console.log(traeProveedores);

rutaAPI = '/fe/restAPI/data';
let sesion = JSON.parse(localStorage.getItem("sesion"));
let { user } = sesion;
let { usuario } = user;

(function () {
  document.addEventListener("DOMContentLoaded", async () => {
    $("#myModalProductos").on("show.bs.modal", async (event) => {
      swal('Entro a Modal ');
      var button = event.relatedTarget; // Botón que activó el modal
      edita = JSON.parse(button.dataset.edita);
      document.querySelector('#guardarProductos').reset();    
      document.querySelector('#guardarProductos')
      .addEventListener('submit', guardaProducto);
    });
  });
})();   

$(document).ready(function () {
  $("#myModalAdicionarProveedor").on("show.bs.modal", async (event) => {
    var button = event.relatedTarget; // Botón que activó el modal
    edita = JSON.parse(button.dataset.edita);
    document.querySelector('#dataRegistrarProveedor').reset();    
    document.querySelector('#dataRegistrarProveedor')
    .addEventListener('submit', guardaProveedor);
  });
});

const ingresaProveedor = async (proveedor) => {
  try {
    const response = await fetch(`${rutaAPI}/proveedores.php`, {
      method: "POST",
      body: JSON.stringify(proveedor), // data puede ser string o un objeto
      headers: {
        "Content-Type": "application/json", // Y le decimos que los datos se enviaran como JSON
      },
    });
    const datos = await response.json();
    return datos;
  } catch (error) {
    return error;
  }
};

async function guardaProveedor(e){
  e.preventDefault();

  const data = Object.fromEntries(
    new FormData(e.target)
  )

  let dataObj = { }

  let { empresa, apellido1, nombre1, apellido2, nombre2 } = data;

  if(empresa == '' && (apellido1 == '' || nombre1 == '')){
    swal({
      title:'Precaucion',
      text:'Sin Datos Definidos para el proveedor',
      type: "error",
      confirmButtonText: "Aceptar",
    })
    return; 
  }

  if(empresa==''){
    empresa = `${apellido1} ${apellido2} ${nombre1} ${nombre2}`
    dataObj = {...data, empresa,};
  }else{
    dataObj = {...data, empresa,};    
  }

  let datos = {...dataObj, usuario,};
  respuesta = await ingresaProveedor(datos);
  let { id, error } = respuesta;

  if (id != "0") {
    swal({
      title: "Atencion!",
      text: "Proveedor Creado Con Exito",
      type: "success",
      confirmButtonText: "Aceptar",
      closeOnConfirm: true,
    },
    function () {
      // $(location).attr("href", "proveedores");
      window.location.href = "proveedores";
    })
  } else {
    mostrarAlerta(error, "mensaje");
  }
}

/* async function ingresaCliente(e) {
  e.preventDefault();

  if (edita === 0) {
    respuesta = await nuevoCliente(clienteObj);
    mensaje = "Cliente Creado Con Exito";
  } else {
    respuesta = await actualizaCliente(clienteObj);
    mensaje = "Cliente Modificado con Exito";
  }

  let { error_id, error } = respuesta;
  if (error_id != "0") {
    Swal.fire({
      title: "Atencion!",
      text: mensaje,
      icon: "success",
      confirmButtonText: "Aceptar",
    }).then((result) => {
      window.location.href = "clientes";
    });
  } else {
    mostrarAlerta(error, "mensaje");
  }
} */

function mostrarAlerta(mensaje, campo) {
  const alerta = document.querySelector("#" + campo);
  if ((alerta.classList.contains = "oculto")) {
    alerta.classList.remove("oculto");
    alerta.innerHTML = `
        <h3 class="font-bold tc">¡ Error !<br>
        <span class="block sm:inline">${mensaje}</span>
        </h3>
    `;
    setTimeout(() => {
      alerta.classList.add("oculto");
    }, 3000);
  }
}