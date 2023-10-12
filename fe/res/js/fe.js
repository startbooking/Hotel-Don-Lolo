rutaAPI = '/fe/restAPI/data';
let sesion = JSON.parse(localStorage.getItem("sesion"));
let { user } = sesion;
let { usuario } = user;
let edita ;
let docSopo ;

(function () {
  document.addEventListener("DOMContentLoaded", async () => {
    
    let ds = document.querySelector('#documentoSoporte');

    if(ds != null){
      nuevoDocumento()
      
    }
    
    $("#myModalAdicionarProveedor").on("show.bs.modal", async (event) => {
      var button = event.relatedTarget; // Botón que activó el modal
      edita = JSON.parse(button.dataset.edita);
      document.querySelector('#dataRegistrarProveedor').reset();    
      document.querySelector('#dataRegistrarProveedor')
      .addEventListener('submit', guardaProveedor);
    });

    $("#myModalProductos").on("show.bs.modal", async (event) => {
      var button = event.relatedTarget; // Botón que activó el modal
      edita = JSON.parse(button.dataset.edita);
      docSopo = JSON.parse(button.dataset.documento);
      document.querySelector('#guardarProductos').reset();    
      document.querySelector('#guardarProductos')
      .addEventListener('submit', guardaProducto);
    });

    $("#myModalPagos").on("show.bs.modal", async (event) => {
      var button = event.relatedTarget; // Botón que activó el modal
      edita = JSON.parse(button.dataset.edita);
      document.querySelector('#guardarPagos').reset();    
      document.querySelector('#guardarPagos')
      .addEventListener('submit', guardaFormaPago);
    });

    $("#myModalAdicionaItem").on("show.bs.modal", async (event) => {
      var button = event.relatedTarget; // Botón que activó el modal
      edita = JSON.parse(button.dataset.edita);
      document.querySelector('#dataRegistraItem').reset();    
      document.querySelector('#dataRegistraItem')
      .addEventListener('submit', guardaItemDoc);
    });
    

  });
})();   

async function guardaItemDoc(e){
  e.preventDefault();

  const data = Object.fromEntries(
    new FormData(e.target)
  )

  let dataObj = { }

  let datos = {...dataObj, usuario,};
  respuesta = await ingresaItemDocumento(datos);
  let { id, error } = respuesta;

  if (id != "0") {
    swal({
      title: "Atencion!",
      text: "Compra / Servicio Adicionada Con Exito",
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

async function guardaProducto(e){
  e.preventDefault();


  const data = Object.fromEntries(
    new FormData(e.target)
  )

  let datos = {...data, usuario,};
  respuesta = await ingresaProducto(datos);
  let { id, error } = respuesta;

  if (id != "0") {
    swal({
      title: "Atencion!",
      text: "Compras / Servicios Creado Con Exito",
      type: "success",
      confirmButtonText: "Aceptar",
      closeOnConfirm: true,
    },
    async function () {
      if(docSopo==0){
        window.location.href = "productos";
      }else{
        $('#myModalProductos').modal('hide');
        const datos = await obtenerProductos();
        const com = await muestraProductosCombo(datos);
      }
    })
  } else {
    mostrarAlerta(error, "mensaje");
  }
}

async function muestraProductosCombo(datos) {
  combo = document.querySelector('#itemcompra');
  let option = "<option value=''>Seleccione el Codigo";
  datos.forEach((dato) => {
    const { id_cargo, descripcion_cargo } = dato;
    option += `
    <option value="${id_cargo}">${descripcion_cargo}</option>
    `;
  });
  combo.innerHTML = option;
}

async function guardaFormaPago(e){
  e.preventDefault();

  const data = Object.fromEntries(
    new FormData(e.target)
  )

  let datos = {...data, usuario,};
  respuesta = await ingresaPago(datos);
  let { id, error } = respuesta;

  if (id != "0") {
    swal({
      title: "Atencion!",
      text: "Forma de Pago Creado Con Exito",
      type: "success",
      confirmButtonText: "Aceptar",
      closeOnConfirm: true,
    },
    function () {
      // window.location.href = "formasPago";
    })
  } else {
    mostrarAlerta(error, "mensaje");
  }
}

const ingresaProducto = async (producto) => {
  try {
    const response = await fetch(`${rutaAPI}/productos.php`, {
      method: "POST",
      body: JSON.stringify(producto), // data puede ser string o un objeto
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

const ingresaPago = async (pagos) => {
  try {
    const response = await fetch(`${rutaAPI}/formasPago.php`, {
      method: "POST",
      body: JSON.stringify(pagos), // data puede ser string o un objeto
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

const ingresaProveedor = async (proveedor) => {
  try {
    const response = await fetch(`${rutaAPI}/proveedor`, {
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

const obtenerProductos = async () => {
  try {
    const resultado = await fetch(`${rutaAPI}/productos.php`);
    const productos = await resultado.json();
    return productos;
  } catch (error) {
    console.log(error);
  }
};

async function infoProducto(item){
  const datos = await traeDetalleProducto(item);
  muestraDetalleProducto(datos)
}

const traeDetalleProducto = async (item) => {
  try {
    const response = await fetch(`${rutaAPI}/productos?item=${item}`);
    const producto = await response.json();
    return producto;
  } catch (error) {
    console.log(error);
  }
};

async function muestraDetalleProducto(datos) {
  let { unidad, id_impto, precio } = datos[0];

  document.querySelector('#unidad').value = unidad;
  document.querySelector('#precio').value = precio;
  document.querySelector('#cantidad').value = 1;
  document.querySelector('#total').value = precio * 1;
  document.querySelector('#imptos').value = id_impto;
}

function calculaTotal(){
  unit  = document.querySelector('#precio').value
  cant  = document.querySelector('#cantidad').value
  document.querySelector('#total').value = unit * cant 

}

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

function validaCampos(obj) {
  return !Object.values(obj).every((element) => element !== "");
}

function sumaFecha(){
  let fecha = document.querySelector("#fecha").value;
  let plazo = parseInt(document.querySelector("#plazo").value);
  
  var date = fecha.split("-");
  hoy = new Date(date[0], date[1], date[2]);

  calculado = new Date();
  dateResul = hoy.getDate() + plazo;
  calculado.setDate(dateResul);
  anio = calculado.getFullYear();
  mes = (calculado.getMonth() + 1).toString().padStart(2,'0') ;
  dia = calculado.getDate().toString().padStart(2,'0');

  vence =  anio+ "-" + mes + "-" + dia;

  document.querySelector("#vence").value = vence

}

function nuevoDocumentoOld (){
  documento = JSON.parse(localStorage.getItem("documentoSoporte"));
  if(documento == null){
    const documento = {}
  }
  localStorage.setItem("documentoSoporte", JSON.stringify(documento));
}

function asignaLocalStorage(code, valor) { 
  localStorage.setItem(code, valor);
}


function nuevoDocumento() {

  fecha = new Date;
  anio = fecha.getFullYear();
  mes = (fecha.getMonth() + 1).toString().padStart(2,'0') ;
  dia = fecha.getDate().toString().padStart(2,'0');
  hoy =  anio+ "-" + mes + "-" + dia;

  console.log(hoy);

  let docu = localStorage.getItem("documento");
  let tipo = localStorage.getItem("tipoOperacion");
  let prov = localStorage.getItem("proveedor");
  let fech = localStorage.getItem("fecha");
  let plaz = localStorage.getItem("plazo");
  let venc = localStorage.getItem("vence");
  let form = localStorage.getItem("formaPago");


  console.log({docu, tipo, prov, fech, plaz, venc, form}) ;

  document.querySelector('#documento').value = docu ? docu : ''  ;
  document.querySelector('#tipoOperacion').value =  tipo ? tipo : '';
  document.querySelector('#proveedor').value = prov ?  prov : '';
  document.querySelector('#fecha').value = fech ? fech : hoy;
  document.querySelector('#plazo').value = plaz ? plaz : 0 ;
  document.querySelector('#vence').value = venc ? venc : hoy; 
  document.querySelector('#formaPago').value = form ? form : '' ;


  /*   var alma = localStorage.getItem("almacen");
    var tipo = localStorage.getItem("tipoMov");
    var prov = localStorage.getItem("proveedor");
    var fech = localStorage.getItem("fecha");
    var fact = localStorage.getItem("factura"); */
  
    let documentoSoporte = localStorage.getItem("documentoSoporte");
  
    console.log(documentoSoporte);
    if (documentoSoporte == null) {
      compras = [];
    } else {
    compras = JSON.parse(documentoSoporte);
  }

  console.log(compras)

}