var edita;
var docSopo;
var compras = [];
var docu;
var tipo;
var prov;
var fech;
var plaz;
var venc;
var form;
var come;
var rutaAPI;
var rutaIMP;

(function () {
  document.addEventListener("DOMContentLoaded", async () => {
    rutaAPI = '/fe/restAPI/data';
    rutaIMP = '/fe/imprimir';
    let sesion = JSON.parse(localStorage.getItem("sesion"));

    if (sesion == null) {
      swal({
        title: 'Precaucion',
        text: 'Usuario NO identificado en el Sistema',
        confirmButtonText: "Aceptar",
        type: "warning",
        closeOnConfirm: true,
      }, function () {
        window.location.href = "/";
        return

      })
    }
    let { user } = sesion;
    let { usuario, usuario_id, nombres, apellidos } = user;

    menuUsu = document.querySelector('#nombreUsuario')
    menuUsu.innerHTML = ` ${apellidos} ${nombres} <span class="caret"></span>`

    let ds = document.querySelector('#nuevoDS');
    let paginaDS = document.querySelector('#paginaDS');

    if (ds != null) {
      nuevoDocumento()
    }

    formularioDocumento = document.querySelector('#datosDocSoporte');
    if (formularioDocumento != null) {
      formularioDocumento.addEventListener('submit', btnSubmitDocumento);
    }

    if (paginaDS != null) {
      paginaDS.addEventListener('submit', btnSubmitDS);
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

async function btnSubmitDS(e) {
  e.preventDefault();
  var prefijo = document.querySelector('#prefijo').value ;
  var button = e.submitter;
  let idDoc = JSON.parse(button.dataset.id);
  let estado = JSON.parse(button.dataset.estado);
  let dian = JSON.parse(button.dataset.dian);
  let proveedor = JSON.parse(button.dataset.proveedor);
  let numDocu = JSON.parse(button.dataset.documento);

  if (e.submitter.classList.contains('imprimeDS')) {
    // alert(`Imprime DS ${idDoc}`)
    await imprimeDS(idDoc, dian, proveedor,numDocu, prefijo)
  } else if (e.submitter.classList.contains('imprimeNC')) {
    alert(`Imprime NC ${idDoc}`)
  } else if (e.submitter.classList.contains('enviaDS')) {
    await enviaDS(idDoc, dian, proveedor)
  } else if (e.submitter.classList.contains('anulaDS')) {
    alert(`Anula ${idDoc}`)
  }
}

async function enviaDS(idDoc,dian,proveedor){
  const infoDS = await infoAPI();
  let { token, rutaFE, documentoSoporte, prefijoDS, consecutivoDS } = infoDS[0]; 

  if(documentoSoporte==0){
    swal({
      title:'Precaucion',
      text:'Modulo Documento Soporte NO Instalado',
      type: "error",
      confirmButtonText: "Aceptar",
    },
    function(){
      
    })
    return ;
  }

  $('#myModalImpresion').modal('show');
  $("#verImpresion").attr(
    "data",
    `data:application/pdf;base64,''`
  );

  document.querySelector("#tituloDocumento").innerHTML = `<i class="fa-regular fa-newspaper"></i> Procesando Documento Soporte`;
  document.querySelector('.btnImprime').classList.add('oculto')
  document.querySelector("#mensajeImprime").innerHTML = `
  <div class="col-lg-8">
    <h1 style="margin-top:50px;margin-left: 50px">
      <p style="font-weight: 800;font-size: 35px;margin-bottom:10px">Procesando Informacion</p>
      <small style="font-weight: 600">NO Interrumpa </small>
    </h1>
  </div>
  <div class="col-lg-4">
    <small>
      <i style="font-size:10em;margin-top:50px;color:#BBB0B0; " class="ion ion-ios-gear-outline fa-spin"></i>
    </small>
  </div>`

  const dataDS = await traeDataDS(idDoc, proveedor);
  const recibeDS = await enviaDatosDS(dataDS, token, rutaFE )
  
  let {status, statusText } = recibeDS;
  if(status< 200 || status > 299){
    swal({
      title:'Precaucion',
      text:`${statusText}`,
      type: "error",
      confirmButtonText: "Aceptar",
    })
    return 
  }
  const recibe = await recibeDS.json();
    
  let recibe2 = {
    "message": "AttachedDocument #DS1 generada con éxito",
    "send_email_success": false,
    "send_email_date_time": false,
    "ResponseDian": {
        "Envelope": {
            "Header": {
                "Action": {
                    "_attributes": {
                        "mustUnderstand": "1"
                    },
                    "_value": "http://wcf.dian.colombia/IWcfDianCustomerServices/SendBillSyncResponse"
                },
                "Security": {
                    "_attributes": {
                        "mustUnderstand": "1"
                    },
                    "Timestamp": {
                        "_attributes": {
                            "Id": "_0"
                        },
                        "Created": "2022-07-05T15:16:38.656Z",
                        "Expires": "2022-07-05T15:21:38.656Z"
                    }
                }
            },
            "Body": {
                "SendBillSyncResponse": {
                    "SendBillSyncResult": {
                        "ErrorMessage": {
                            "string": "Regla: DSDS01, Rechazo: Tipo de documento no disponible para validación en el ambiente de producción en operación"
                        },
                        "IsValid": "false",
                        "StatusCode": "99",
                        "StatusDescription": "Validación contiene errores en campos mandatorios.",
                        "StatusMessage": "Documento con errores en campos mandatorios.",
                        "XmlBase64Bytes": "....",
                        "XmlBytes": {
                            "_attributes": {
                                "nil": "true"
                            }
                        },
                        "XmlDocumentKey": "288298ffe83832fdb9d434af5d6ad21dd9bced3541d1ab8da90a3b72eb212eb98de88d3893719b7b47c1c5e0751b3877",
                        "XmlFileName": "dse09012492320002200000001"
                    }
                }
            }
        }
    },
    "invoicexml": "......",
    "unsignedinvoicexml": "...",
    "reqfe": "...",
    "rptafe": "...",
    "attacheddocument": "",
    "urlinvoicexml": "DSS-DS1.xml",
    "urlinvoicepdf": "DSS-DS1.pdf",
    "urlinvoiceattached": ".xml",
    "cude": "288298ffe83832fdb9d434af5d6ad21dd9bced3541d1ab8da90a3b72eb212eb98de88d3893719b7b47c1c5e0751b3877",
    "QRStr": "NumFac: 1\nFecFac: 2020-10-06\nNitFac: 901249232\nDocAdq: 900166483\nValFac: 0.00\nValIva: 0.00\nValOtroIm: 0.00\nValTotal: 1000000.00\nCUFE: b3d063d98c773df5c42f14bc2ce20a24ef6c62fd81ccbd7f3672b9d116933125a05a5fe4046632ed310f473e24b8cf6a\nhttps://catalogo-vpfe.dian.gov.co/document/searchqr?documentkey=b3d063d98c773df5c42f14bc2ce20a24ef6c62fd81ccbd7f3672b9d116933125a05a5fe4046632ed310f473e24b8cf6a\n"
  };

  let { StatusCode, StatusDescription, StatusMessage, ErrorMessage, IsValid } = recibe2['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']['SendBillSyncResult']; 

  if(IsValid !=='false'){
    swal({
      title:'Precaucion',
      text:`${ErrorMessage.string}`,
      type: "error",
      confirmButtonText: "Aceptar",
    },
    function(){
      
    })
    return ;
  }
  
  let { message, send_email_success, send_email_date_time, urlinvoicexml, urlinvoicepdf, cude, QRStr } = recibe2;
  let { Created } = recibe2['ResponseDian']['Envelope']['Header']['Security']['Timestamp'];

  ErrorMessage = JSON.stringify(ErrorMessage);

  datosFE = { 
    dataDS,
    prefijoDS,
    consecutivoDS,
    status,
    statusText,
    StatusCode,
    StatusDescription,
    StatusMessage,
    ErrorMessage,
    IsValid,
    message,
    send_email_success,
    send_email_date_time,
    urlinvoicexml,
    urlinvoicepdf,
    cude,
    QRStr,
    Created
  }

  const regID = await guardaDatosDS(datosFE)

  let {id, error } = regID;

  if(id == 0){
    swal({
      title:'Precaucion',
      text:`${error}`,
      type: "error",
      confirmButtonText: "Aceptar",
    },
    function(){
      
    })
    return 
  }
  
  const increm = await incrementaConsec(consecutivoDS+1) ;
  const actualizaEstado = await actualizaEstadoDS(idDoc, consecutivoDS) ;
  const imprime = await generaDocumentoDS(idDoc, consecutivoDS, QRStr, recibe2);
  // const muestraDoc  = await muestraPDFDoc(imprime)
  
  if(actualizaEstado !==1){
    swal({
      title:'Atencion',
      text:`Documento Soporte NO Procesado, Intente Mas Tarde`,
      type: "success",
      confirmButtonText: "Aceptar",
    },
    function(){
       window.location.href = "docSoporte";
    })
  }
  swal({
    title:'Atencion',
    text:`Documento Soporte Nro ${consecutivoDS} Procesado Con Exito`,
    type: "success",
    confirmButtonText: "Aceptar",
  },
  function(){
    window.location.href = "docSoporte";
  })
}

async function muestraPDFDoc(imprime) {
  document.querySelector("#tituloDocumento").innerHTML = `<i class="fa-regular fa-newspaper"></i> Imprime Documento Soporte`;
  document.querySelector("#mensajeImprime").innerHTML = ``
  document.querySelector('.btnImprime').classList.remove('oculto')  
  $("#verImpresion").attr(
    "data",
    `data:application/pdf;base64,${imprime}`
  );
}

const generaDocumentoDS = async(idDoc, consecutivoDS, QRStr, recibe2) => {
  data = {
    idDoc,
    consecutivoDS,
    QRStr,
    usuario,
    recibe2,
  }
  try {
    const response = await fetch(`${rutaIMP}/generaDS.php`, {
      method: "POST",
      body:JSON.stringify(data),
      headers: {
        'Content-Type': 'application/json',        
        'Accept': 'application/json',  
      },
    });
    const datos = response.text();  
    return datos;
  } catch (error) {
    return error;
  }
}

const actualizaEstadoDS = async(idDoc, conse) => {
  data = {
    idDoc,
    conse,
  }
  try {
    const response = await fetch(`${rutaAPI}/documentos`, {
      method: "PUT",
      body:JSON.stringify(data),
      headers: {
        'Content-Type': 'application/json',        
        'Accept': 'application/json',  
      },
    });
    const datos = response.json();  
    return datos;
  } catch (error) {
    return error;
  }
}

const incrementaConsec = async(numDS) => {
  data = {
    numDS
  }
  try {
    const response = await fetch(`${rutaAPI}/datosDS`, {
      method: "PUT",
      body:JSON.stringify(data),
      headers: {
        'Content-Type': 'application/json',        
        'Accept': 'application/json',  
      },
    });
    const datos = response.json();  
    return datos;
  } catch (error) {
    return error;
  }
}

const guardaDatosDS = async(datosFE) => {
  try {
    const response = await fetch(`${rutaAPI}/datosDS`, {
      method: "POST",
      body:JSON.stringify(datosFE),
      headers: {
        'Content-Type': 'application/json',        
        'Accept': 'application/json',  
      },
    });
    const datos = response.json();  
    return datos;
  } catch (error) {
    return error;
  }
}

const enviaDatosDS = async(dataDS, token, rutaFE) => {
  try {
    const response = await fetch(`${rutaFE}plan/infoplanuser`, {
      method: "GET",
      headers: {
        'Content-Type': 'application/json',        
        'Accept': 'application/json',  
        'Authorization': `Bearer ${token}`
      },
    });
    const datos = await response;
  
    return datos;
  } catch (error) {
    return error;
  }
}

const enviaDatosDSACt = async(dataDS, token, rutaFE) => {
  try {
    const response = await fetch(`${rutaFE}support-document`, {
      method: "POST",
      headers: {
        'Content-Type': 'application/json',        
        'Accept': 'application/json',  
        'Authorization': `Bearer ${token}`
      },
    });
    // const datos = await response.json();
    const datos = await console.log(datos);

    console.log(response)
    console.log(response.status)
    console.log(response.statusText)

    // const datos = await console.log(datos);
    console.log(datos);
    
    return datos;
  } catch (error) {
    console.log(error)
    return error;
  }
}

const infoAPI = async() => {
  try {
    const response = await fetch(`${rutaAPI}/infoAPI.php`, {
      method: "GET",
      headers: {
        "Content-Type": "application/json", // Y le decimos que los datos se enviaran como JSON
      },
    }); 
    const datos = await response.json ();
    return datos;
  } catch (error) {
    return error;
  }
}

const traeDataDS = async(id, proveedor) => {
  try {
    data = {id, proveedor}

    const response = await fetch(`${rutaAPI}/infoDS.php`, {
      method: "POST",
      body: JSON.stringify(data), // data puede ser string o un objeto
      headers: {
        "Content-Type": "application/json", // Y le decimos que los datos se enviaran como JSON
      },
    });
    const datos = await response.text();
    return datos;
  } catch (error) {
    return error;
  }
}

const generaJsonDS = async() => {
  try {
    data = {id, usuario, proveedor}
    const response = await fetch(`${rutaAPI}/generaJSON.php`, {
      method: "POST",
      body: JSON.stringify(data), // data puede ser string o un objeto
      headers: {
        "Content-Type": "application/json", // Y le decimos que los datos se enviaran como JSON
      },
    });
    const datos = await response.text();
    return datos;
  } catch (error) {
    return error;
  }
}

// imprimeDS(idDoc, dian, proveedor,numDocu, prefijo)

async function imprimeDS(id, dian, proveedor, numDocu, prefijo){
  if(dian==1){
    // console.log(numDocu);
    // numer = numDocu.toString().padStart(5,'0');
    // console.log(numer)
  // $("#verFactura").attr("data", "imprimir/facturas/FES-HDL" + factura);
    archivo = `documentoSoporte_${prefijo}-${numDocu.toString().padStart(5,'0')}.pdf`
    $('#myModalImpresion').modal('show');
    document.querySelector("#tituloDocumento").innerHTML = `<span class="material-symbols-outlined">picture_as_pdf</span> Documento Soporte `
    $("#verImpresion").attr(
      "data",`impresos/${archivo}`
    );

  }else{
    /* 
    swal({
      title:'Precaucion',
      text:'Documento NO Generado',
      type: "error",
      confirmButtonText: "Aceptar",
    })
    */
    const impresion = await generaDS(id, proveedor);
    $('#myModalImpresion').modal('show');
    document.querySelector("#tituloDocumento").innerHTML = `<span class="material-symbols-outlined">picture_as_pdf</span> Documento Soporte SIN PROCESAR`
    $("#verImpresion").attr(
      "data",
      `data:application/pdf;base64,${$.trim(impresion)}`
    ); 
  }
}

const generaDS = async (id, proveedor) => {
  try {
    data = {id, usuario, proveedor}
    const response = await fetch(`${rutaIMP}/imprimeDS.php`, {
      method: "POST",
      body: JSON.stringify(data), // data puede ser string o un objeto
      headers: {
        "Content-Type": "application/json", // Y le decimos que los datos se enviaran como JSON
      },
    });
    const datos = await response.text();
    return datos;
  } catch (error) {
    return error;
  }
};

async function btnSubmitDocumento(e) {
  e.preventDefault();
  if (e.submitter.classList.contains('guarda')) {
    await guardaDocumento();
  } else if (e.submitter.classList.contains('cancela')) {
    await cancelaDocumento();
  } else if (e.submitter.classList.contains('elimina_articulo')) {
    var button = e.submitter;
    let idArt = button.dataset.id;
    await eliminaProductoDoc(idArt)
  } else if (e.submitter.classList.contains('imprimeDS')) {
  } else if (e.submitter.classList.contains('imprimeNC')) {
  } else if (e.submitter.classList.contains('enviaDS')) {
  } else if (e.submitter.classList.contains('anulaDS')) {
  }
}

async function cancelaDocumento() {
  swal({
    title: "Atencion !",
    text: "Esta Seguro de Cancelar el Documento ?",
    type: "warning",
    showCancelButton: true,
    cancelButtonClass: "#DD6B55",
    cancelButtonText: "No",
    confirmButtonClass: "btn-info",
    confirmButtonText: "Si",
    closeOnConfirm: false,
  },
    function () {
      borraStorage();
      window.location.href = "docSoporte";
    })
}

async function guardaItemDoc(e) {
  e.preventDefault();

  const data = Object.fromEntries(
    new FormData(e.target)
  )

  let txtComp = $("#itemcompra option:selected").text();
  let txtUnid = $("#unidad option:selected").text();
  let txtIMpt = $("#imptos option:selected").text();

  let datos = { ...data, txtComp, txtUnid, txtIMpt };

  compras.push(datos);

  itemCompra = document.querySelector('#dataRegistraItem');
  localStorage.setItem("documentoSoporte", JSON.stringify(compras));

  $('#myModalAdicionaItem').modal('hide');

  productosCompra = document.querySelector('#dataDocSoporte  tbody')
  limpia = await limpiaProductosDocumentoHMLT();
  const mostrar = await muestraProductosDocumentoHTML(compras)

}

async function limpiaProductosDocumentoHMLT() {
  while (productosCompra.firstChild) {
    productosCompra.removeChild(productosCompra.firstChild);
  }
}

async function muestraProductosDocumentoHTML(compras) {
  let totDocu = 0;
  compras.map((compra) => {
    let { itemcompra, txtComp, txtUnid, precio, cantidad, total } = compra;
    totDocu = totDocu + parseFloat(total);
    const row = document.createElement("tr");
    let aviso = '';

    row.innerHTML += `
        <td>${txtComp}</td>        
        <td>${txtUnid}</td>
        <td class="derecha">${number_format(precio, 2)}</td>
        <td class="derecha">${number_format(cantidad, 0)}</td>
        <td class="derecha">${number_format(total, 2)}</td>        
        <td class="centro">
          <button 
          type="submit"
          data-id='${itemcompra}' 
          class='btn btn-danger btn-xs elimina_articulo' ><i class='glyphicon glyphicon-trash '></i></button>
        </td>`;
    productosCompra.appendChild(row);
  })
  document.querySelector('#totalDocumento').value = number_format(totDocu, 2)
}

async function muestraProductosDocumento(datos) {
  dataCompra = document.querySelector('#dataDocSoporte tbody');
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

async function guardaProveedor(e) {
  e.preventDefault();

  const data = Object.fromEntries(
    new FormData(e.target)
  )

  let dataObj = {}

  let { empresa, apellido1, nombre1, apellido2, nombre2 } = data;

  if (empresa == '' && (apellido1 == '' || nombre1 == '')) {
    swal({
      title: 'Precaucion',
      text: 'Sin Datos Definidos para el proveedor',
      type: "error",
      confirmButtonText: "Aceptar",
    })
    return;
  }

  if (empresa == '') {
    empresa = `${apellido1} ${apellido2} ${nombre1} ${nombre2}`
    dataObj = { ...data, empresa, };
  } else {
    dataObj = { ...data, empresa, };
  }

  let datos = { ...dataObj, usuario, };
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
        window.location.href = "proveedores";
      })
  } else {
    mostrarAlerta(error, "mensaje");
  }
}

async function guardaProducto(e) {
  e.preventDefault();


  const data = Object.fromEntries(
    new FormData(e.target)
  )

  let datos = { ...data, usuario, };
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
        if (docSopo == 0) {
          window.location.href = "productos";
        } else {
          $('#myModalAdicionaItem').modal('hide');
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

async function guardaFormaPago(e) {
  e.preventDefault();

  const data = Object.fromEntries(
    new FormData(e.target)
  )

  let datos = { ...data, usuario, };
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
        window.location.href = "formasPago";
      })
  } else {
    mostrarAlerta(error, "mensaje");
  }
}

const ingresaProducto = async (producto) => {
  try {
    const response = await fetch(`${rutaAPI}/productos`, {
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
    const response = await fetch(`${rutaAPI}/proveedores`, {
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

async function infoProducto(item) {
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

function calculaTotal() {
  unit = document.querySelector('#precio').value
  cant = document.querySelector('#cantidad').value
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

async function validaCampos(obj) {
  return !Object.values(obj).every((element) => element !== null);
}

function sumaFecha() {
  let fecha = document.querySelector("#fecha").value;
  let plazo = parseInt(document.querySelector("#plazo").value);

  var date = fecha.split("-");
  hoy = new Date(date[0], date[1], date[2]);

  calculado = new Date();
  dateResul = hoy.getDate() + plazo;
  calculado.setDate(dateResul);
  anio = calculado.getFullYear();
  mes = (calculado.getMonth() + 1).toString().padStart(2, '0');
  dia = calculado.getDate().toString().padStart(2, '0');

  let vence = anio + "-" + mes + "-" + dia;

  document.querySelector("#vence").value = vence

}

function asignaLocalStorage(code, valor) {
  localStorage.setItem(code, valor);
}

async function nuevoDocumento() {
  let fecha = new Date;
  anio = fecha.getFullYear();
  mes = (fecha.getMonth() + 1).toString().padStart(2, '0');
  dia = fecha.getDate().toString().padStart(2, '0');
  hoy = anio + "-" + mes + "-" + dia;

  await traeStorage()

  document.querySelector('#documento').value = docu ? docu : '';
  document.querySelector('#tipoOperacion').value = tipo ? tipo : '';
  document.querySelector('#proveedor').value = prov ? prov : '';
  document.querySelector('#fecha').value = fech ? fech : hoy;
  document.querySelector('#plazo').value = plaz ? plaz : 0;
  document.querySelector('#vence').value = venc ? venc : hoy;
  document.querySelector('#comentarios').value = come ? come : '';
  document.querySelector('#formaPago').value = form ? form : '';

  let documentoSoporte = JSON.parse(localStorage.getItem("documentoSoporte"));

  if (documentoSoporte == null) {
    compras = [];
  } else {
    compras = documentoSoporte;
    productosCompra = document.querySelector('#dataDocSoporte  tbody')
    limpia = await limpiaProductosDocumentoHMLT();
    const mostrar = await muestraProductosDocumentoHTML(compras)
  }
}

async function guardaDocumento() {

  await traeStorage()

  infoDoc = { docu, tipo, prov, fech, plaz, venc, form, usuario_id };

  const regis = await validaCampos(infoDoc);

  if (regis) {
    mostrarAlerta('Datos del Proveedor Incompletos', "mensaje");
    return;
  }

  let documentoSoporte = JSON.parse(localStorage.getItem("documentoSoporte"));

  if (documentoSoporte == null || documentoSoporte.length == 0) {
    swal({
      title: 'Precaucion',
      text: 'Sin Compras / Servicios Asignados a este Documento',
      confirmButtonText: "Aceptar",
      type: "warning",
      closeOnConfirm: true,
    }, function () {
    })
    return 
  }

  datosDoc = { ...documentoSoporte, docu, tipo, prov, fech, plaz, venc, form, usuario_id, come }

  let encabezado = { ...infoDoc, come, };
  respuesta = await ingresaEncabezadoDocumento(encabezado);
  let { id, error } = respuesta
  if (id == 0) {
    mostrarAlerta(error, "mensaje");
    return 0
  }

  compras = { ...documentoSoporte }

  documentoSoporte.map((documento) => {
    const regis = ingresaDetalleDocumento(documento, id);
  })

  swal({
    title: 'Atencion',
    text: 'Documento Soporte Almacenado con Exito',
    type: "success",
    confirmButtonText: "Aceptar",
  },
    function () {
      borraStorage();
      window.location.href = "docSoporte";
    })
}

async function eliminaProductoDoc(item) {
  swal({
    title: "Atencion !",
    text: "Esta Seguro de Eliminar la Compra / Servicio Actual ?",
    type: "warning",
    showCancelButton: true,
    cancelButtonClass: "#DD6B55",
    cancelButtonText: "No",
    confirmButtonClass: "btn-info",
    confirmButtonText: "Si",
    closeOnConfirm: true,
  },
    async function () {
      console.log(compras)
      console.log(item)
      compras = compras.filter(compra => Number(compra.itemcompra) !== item);
      console.log(compras)
      limpia = await limpiaProductosDocumentoHMLT();
      const mostrar = await muestraProductosDocumentoHTML(compras)
      localStorage.setItem("documentoSoporte", JSON.stringify(compras));
    })

  // console.log(compras);
  // eliminarProductoDoc(item)
}

async function traeStorage() {
  docu = localStorage.getItem("documento");
  tipo = localStorage.getItem("tipoOperacion");
  prov = localStorage.getItem("proveedor");
  fech = localStorage.getItem("fecha");
  plaz = localStorage.getItem("plazo");
  venc = localStorage.getItem("vence");
  form = localStorage.getItem("formaPago");
  come = localStorage.getItem("comentarios");
}

async function borraStorage() {
  localStorage.removeItem("documento");
  localStorage.removeItem("tipoOperacion");
  localStorage.removeItem("proveedor");
  localStorage.removeItem("fecha");
  localStorage.removeItem("plazo");
  localStorage.removeItem("vence");
  localStorage.removeItem("formaPago");
  localStorage.removeItem("comentarios");
  localStorage.removeItem("documentoSoporte");
}

const ingresaEncabezadoDocumento = async (encabezado) => {
  try {
    const response = await fetch(`${rutaAPI}/documentos`, {
      method: "POST",
      body: JSON.stringify(encabezado), // data puede ser string o un objeto
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

const ingresaDetalleDocumento = async (compra, idDoc) => {
  dataObj = { ...compra, idDoc }
  try {
    const response = await fetch(`${rutaAPI}/detalleDocumento`, {
      method: "POST",
      body: JSON.stringify(dataObj), // data puede ser string o un objeto
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