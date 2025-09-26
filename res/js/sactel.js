function calculaDV() {
  var myNit = $('#nitUpd').val();
  var vpri, x, y, z;
  // Se limpia el Nit
  myNit = myNit.replace(/\s/g, ""); // Espacios
  myNit = myNit.replace(/,/g, ""); // Comas
  myNit = myNit.replace(/\./g, ""); // Puntos
  myNit = myNit.replace(/-/g, ""); // Guiones

  // Se valida el nit
  if (isNaN(myNit)) {
    console.log("El nit/cédula '" + myNit + "' no es válido(a).");
    return "";
  };

  // Procedimiento
  vpri = new Array(16);
  z = myNit.length;

  vpri[1] = 3;
  vpri[2] = 7;
  vpri[3] = 13;
  vpri[4] = 17;
  vpri[5] = 19;
  vpri[6] = 23;
  vpri[7] = 29;
  vpri[8] = 37;
  vpri[9] = 41;
  vpri[10] = 43;
  vpri[11] = 47;
  vpri[12] = 53;
  vpri[13] = 59;
  vpri[14] = 67;
  vpri[15] = 71;

  x = 0;
  y = 0;
  for (var i = 0; i < z; i++) {
    y = (myNit.substr(i, 1));
    // console.log ( y + "x" + vpri[z-i] + ":" ) ;

    x += (y * vpri[z - i]);
    // console.log ( x ) ;    
  }

  y = x % 11;
  // console.log ( y ) ;

  dig = (y > 1) ? 11 - y : y;

  $('#dvUpd').val(dig)
}

function calcularDV() {
  var myNit = $('#nit').val();
  var vpri, x, y, z;
  // Se limpia el Nit
  myNit = myNit.replace(/\s/g, ""); // Espacios
  myNit = myNit.replace(/,/g, ""); // Comas
  myNit = myNit.replace(/\./g, ""); // Puntos
  myNit = myNit.replace(/-/g, ""); // Guiones

  // Se valida el nit
  if (isNaN(myNit)) {
    console.log("El nit/cédula '" + myNit + "' no es válido(a).");
    return "";
  };

  // Procedimiento
  vpri = new Array(16);
  z = myNit.length;

  vpri[1] = 3;
  vpri[2] = 7;
  vpri[3] = 13;
  vpri[4] = 17;
  vpri[5] = 19;
  vpri[6] = 23;
  vpri[7] = 29;
  vpri[8] = 37;
  vpri[9] = 41;
  vpri[10] = 43;
  vpri[11] = 47;
  vpri[12] = 53;
  vpri[13] = 59;
  vpri[14] = 67;
  vpri[15] = 71;

  x = 0;
  y = 0;
  for (var i = 0; i < z; i++) {
    y = (myNit.substr(i, 1));
    // console.log ( y + "x" + vpri[z-i] + ":" ) ;

    x += (y * vpri[z - i]);
    // console.log ( x ) ;    
  }

  y = x % 11;
  // console.log ( y ) ;

  dig = (y > 1) ? 11 - y : y;

  $('#dv').val(dig)
}

function redondeo(numero, decimales) {
  var flotante = parseFloat(numero);
  var resultado = Math.round(flotante * Math.pow(10, decimales)) / Math.pow(10, decimales);
  return resultado;
}

function clickgaleria() {
  var button = $(event.relatedTarget);
  var id = button.data('id');
  var imagen = button.data('imagen');
  var modal = $(this)

  var modalGallery = '<div class="modalGallery" id="modalGallery"><img src="' + img + '" class="img-thumbnail"><div class="modal_boton"><i style="font-size:16px" class="fa fa-times" aria-hidden="true"></i></div></div>';
  $('body').append(modalGallery);
  $('.modal_boton').click(function () {
    $('.modalGallery').remove();
  });
}

function number_format(amount, decimals) {
  amount += ''; // por si pasan un numero en vez de un string
  amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto
  decimals = decimals || 0; // por si la variable no fue fue pasada

  // si no es un numero o es igual a cero retorno el mismo cero
  if (isNaN(amount) || amount === 0)
    return parseFloat(0).toFixed(decimals);

  // si es mayor o menor que cero retorno el valor formateado como numero
  amount = '' + amount.toFixed(decimals);

  var amount_parts = amount.split('.'),
    regexp = /(\d+)(\d{3})/;

  while (regexp.test(amount_parts[0]))
    amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');

  return amount_parts.join('.');
}

function creaUUID() {
  alert('Entro ')
  return "10000000-1000-4000-8000-100000000000".replace(/[018]/g, c =>
    (+c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> +c / 4).toString(16)
  );
}

function generateUUID() { // Public Domain/MIT
  var d = new Date().getTime();//Timestamp
  var d2 = ((typeof performance !== 'undefined') && performance.now && (performance.now() * 1000)) || 0;//Time in microseconds since page-load or 0 if unsupported
  return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
    var r = Math.random() * 16;//random number between 0 and 16
    if (d > 0) {//Use timestamp until depleted
      r = (d + r) % 16 | 0;
      d = Math.floor(d / 16);
    } else {//Use microseconds since page-load if supported
      r = (d2 + r) % 16 | 0;
      d2 = Math.floor(d2 / 16);
    }
    return (c === 'x' ? r : (r & 0x3 | 0x8)).toString(16);
  });
}

$('.images').click(function (e) {
  var img = e.target.srcset;

  var modalGallery = '<div class="modalGallery" id="modalGallery"><img src="' + img + '" class="img-thumbnail"><div class="modal_boton"><i style="font-size:16px" class="fa fa-times" aria-hidden="true"></i></div></div>';
  $('body').append(modalGallery);
  $('.modal_boton').click(function () {
    $('.modalGallery').remove();
  });
})

$(document).keyup(function (e) {
  if (e.which == 27) {
    $('.modalGallery').remove();
  }
})

function validateEmail(email) {
  let validEmail = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
  if (validEmail.test(email)) {
    return true;
  } else {
    swal({
      title: "Precaucion",
      text: "Correo Electronico Invalido",
      type: "warning",
    })
    document.querySelector('#correo').value = '';
    return false;
  }
}

async function formDataToArrayOld(formData) {
  const datosArray = [];

  // Usar un bucle for...of para iterar sobre las entradas del FormData
  for (const [nombre, valor] of formData.entries()) {
    datosArray.push([nombre, valor]);
  }

  return datosArray;
}

function formDataToArray(formData) {
  const array = [];
  for (const [name, value] of formData.entries()) {
    // En este ejemplo, los campos con el mismo nombre se agrupan en un array.
    // Si no necesitas agruparlos, puedes simplificar la lógica.
    if (array.find(item => item.name === name)) {
      // Si el campo ya existe, convierte su valor a un array y añade el nuevo valor.
      const existingItem = array.find(item => item.name === name);
      if (!Array.isArray(existingItem.value)) {
        existingItem.value = [existingItem.value];
      }
      existingItem.value.push(value);
    } else {
      array.push({ name, value });
    }
  }
  return array;
}

/**
 * Convierte un objeto FormData en un objeto plano de JavaScript.
 * Los campos con el mismo nombre (ej. checkboxes) se agrupan en un array de valores.
 * @param {FormData} formData - El objeto FormData a convertir.
 * @returns {Object} Un objeto con los nombres de los campos como claves y sus valores.
 */
function formDataToObject(formData) {
  const obj = {};
  for (const [name, value] of formData.entries()) {
    // Si el campo ya existe, lo convierte en un array y añade el nuevo valor
    if (obj[name]) {
      if (!Array.isArray(obj[name])) {
        obj[name] = [obj[name]];
      }
      obj[name].push(value);
    } else {
      // Si el campo no existe, lo añade directamente
      obj[name] = value;
    }
  }
  return obj;
}

function exportarJSONaExcel(data, nombreArchivo) {
  // 1. Crear el contenido de la tabla HTML
  let tablaHTML = '<table><thead><tr>';

  // Obtener las cabeceras (keys del primer objeto)
  const cabeceras = Object.keys(data[0]);
  cabeceras.forEach(key => {
    tablaHTML += `<th>${key}</th>`;
  });
  tablaHTML += '</tr></thead><tbody>';

  // 2. Agregar los datos (filas)
  data.forEach(fila => {
    tablaHTML += '<tr>';
    cabeceras.forEach(key => {
      tablaHTML += `<td>${fila[key]}</td>`;
    });
    tablaHTML += '</tr>';
  });
  tablaHTML += '</tbody></table>';

  // 3. Crear el enlace para descargar el archivo
  const enlaceDescarga = document.createElement('a');

  // Codificar los datos en formato URL (usando Base64 para compatibilidad)
  // El "data:application/vnd.ms-excel" es el tipo MIME para archivos XLS
  const uri = 'data:application/vnd.ms-excel,' + encodeURIComponent(tablaHTML);

  enlaceDescarga.href = uri;
  enlaceDescarga.download = nombreArchivo + '.xls';

  // 4. Simular un clic para iniciar la descarga
  document.body.appendChild(enlaceDescarga);
  enlaceDescarga.click();
  document.body.removeChild(enlaceDescarga);
}

async function verificarArchivoXHR(urlArchivo) {
  const xhr = new XMLHttpRequest();
  xhr.open('HEAD', urlArchivo, true); // true para solicitud asíncrona
  let resp
  xhr.onreadystatechange = async function () {
    if (xhr.readyState === 4) {
      /* if (xhr.status === 200) {
        console.log(`El archivo existe en: ${urlArchivo}`);
        resp =  true;
      } else if (xhr.status === 404) {
        console.log(`El archivo no se encontró en: ${urlArchivo}`);
        resp = false;
      } else {
        console.log(`Error al verificar el archivo. Código de estado: ${xhr.status}`);
        resp = false;
      } */
      console.log(xhr.status)
    }
  };

  xhr.send();
}

async function verificarArchivo(url) {
  try {
    const respuesta = await fetch(url, { method: 'HEAD' });
    // 'HEAD' es más eficiente, ya que solo solicita los encabezados, no el cuerpo del archivo
    // console.log(respuesta);
    return respuesta.ok; // Devuelve true si el estado es 200-299
  } catch (error) {
    console.error("Error al verificar el archivo:", error);
    return false;
  }
}

// Lógica principal
async function gestionarQR(id, descr) {
  const modal = $(".modal"); // Selecciona tu modal, asegúrate de que el selector sea el correcto
  modal.find(".modal-title").text("Modifica Ambiente : " + descr);

  const fileQR = `${window.location.origin}/pos/images/QRFiles/${id}.png`;
  const contenedorQR = document.getElementById("contenedor-qr"); // Asume que tienes un <div> con este ID
  const urlContenidoQR = `${window.location.origin}/pos/ambiente/${id}`; // URL o dato a codificar en el QR

  // Verificar si el archivo QR ya existe
  const existe = await verificarArchivo(fileQR);

  if (existe) {
    // Si el archivo existe, mostrarlo en una etiqueta <img>
    contenedorQR.innerHTML = `<img src="${fileQR}" alt="Código QR de ${descr}" style="width: 200px; height: 200px;" />`;
    console.log("El archivo QR existe y se ha mostrado.");
  } else {
    // Si no existe, crear el código QR
    console.log("El archivo QR no existe, creando uno nuevo...");
    // Asegúrate de incluir la librería qrcode.js en tu HTML: <script src="qrcode.min.js"></script>
    const qrcode = new QRCode(contenedorQR, {
      text: urlContenidoQR,
      width: 200,
      height: 200,
      colorDark: "#000000",
      colorLight: "#ffffff",
      correctLevel: QRCode.CorrectLevel.H
    });

    // Opcional: Si necesitas la imagen como un archivo PNG, puedes hacerlo así
    // qrcode.toDataURL((dataUrl) => {
    //     // Aquí puedes enviar el dataUrl al servidor para guardarlo
    //     console.log("QR generado como Data URL:", dataUrl);
    // });
  }
}

async function creaCodigoQR(QRStr, filename) {
  
  try {
    const respuesta = await fetch('../res/php/creaQR.php', { 
      method: 'POST',
      body:JSON.stringify({QRStr, filename}) 
    });
    // 'HEAD' es más eficiente, ya que solo solicita los encabezados, no el cuerpo del archivo
    console.log(respuesta)
    return respuesta.ok; // Devuelve true si el estado es 200-299
  } catch (error) {
    console.error("Error al verificar el archivo:", error);
    return false;
  }
}

function printQR() {
    const contenedorQR = document.getElementById("fileQR");
    const img = contenedorQR.querySelector("img");

    if (img) {
        const urlQR = img.src;
        let printWindow = window.open('', '_blank', 'height=400,width=400');
        printWindow.document.write('<html><head><title>Imprimir QR</title>');
        printWindow.document.write('</head><body>');
        printWindow.document.write('<img src="' + urlQR + '" style="max-width:100%;" />');
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.onload = () => {
            printWindow.focus();
            printWindow.print();
        };
    } else {
        alert("El código QR no está visible para imprimir.");
    }
}