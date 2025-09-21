document.addEventListener("DOMContentLoaded", async () => {
  let sesion = JSON.parse(localStorage.getItem("sesion"));
  if (sesion == null) {
    swal(
      {
        title: "Precaucion",
        text: "Usuario NO identificado en el Sistema",
        confirmButtonText: "Aceptar",
        type: "warning",
        closeOnConfirm: true,
      },
      function () {
        window.location.href = "/";
        return;
      }
    );
  }
  const {
    user: { usuario, usuario_id, tipo },
    cia: { impuesto },
  } = sesion;

  let ingreso = await ingresoPos();
  let validaVe = await validaVentana();
});

function botonEliminaProductoDivi(
  numero,
  codigo,
  ambiente,
  cant,
  producto,
  prdid,
  id,
  index
) {
  let storageProd = localStorage.getItem("productoComanda");
  let totalProductos = JSON.parse(storageProd);
  let storageComanda = localStorage.getItem("nuevaComanda");
  let nuevaComanda = JSON.parse(storageComanda);

  let divide = {
    ...nuevaComanda.filter((productos) => productos.id === parseInt(prdid)),
  };

  nuecom = divide[0];

  const existe = totalProductos.findIndex(
    (producto) => producto.id === nuecom.id
  );

  cantIni = nuecom.cant;

  if (existe < 0) {
    totalProductos = [...totalProductos, nuecom];
  } else {
    totalProductos[existe].cant = totalProductos[existe].cant + cantIni;
    totalProductos[existe].total =
      totalProductos[existe].cant * totalProductos[existe].importe;
    totalProductos[existe].venta =
      (totalProductos[existe].importe * totalProductos[existe].cant) /
      (1 + totalProductos[existe].impto / 100);
    totalProductos[existe].valorimpto =
      totalProductos[existe].importe * totalProductos[existe].cant -
      (totalProductos[existe].importe * totalProductos[existe].cant) /
        (1 + totalProductos[existe].impto / 100);
  }

  localStorage.setItem("productoComanda", JSON.stringify(totalProductos));

  const exis = nuevaComanda.findIndex(
    (prodComan) => prodComan.id === parseInt(prdid)
  );

  if (exis >= 0) {
    nuevaComanda.splice(exis, 1);
  }

  localStorage.setItem("nuevaComanda", JSON.stringify(nuevaComanda));

  productosNuevaComanda();
  resumenDividir();

  productosDividir();
  resumenComanda();
}

function guardaComandaDiv() {
  var storageProd = localStorage.getItem("nuevaComanda");
  let listaNuevaComanda = JSON.parse(storageProd);
  if (listaNuevaComanda.length === 0) {
    swal("Atencion", "Sin Productos Para Crear nueva Comanda", "warning");
    return;
  }
}

function resumenDividir() {
  let storageProd = localStorage.getItem("nuevaComanda");
  let listaNuevaComanda = JSON.parse(storageProd);
  let impuestoDiv = 0;
  let ventaDiv = 0;
  let cantiDiv = 0;
  let impuesto = 0;

  listaNuevaComanda.map(function (productos) {
    impuesto = impuesto + parseFloat(productos.valorimpto);
    ventaDiv = ventaDiv + parseFloat(productos.venta);
    cantiDiv = cantiDiv + parseFloat(productos.cant);
  });

  totalDiv = ventaDiv + impuestoDiv;

  $("#totalComandaDiv").val(total);
  $("#totalVtaDiv").html(number_format(ventaDiv, 2));
  $("#totalCuentaDiv").html(number_format(totalDiv, 2));
  $("#valorImptoDiv").html(number_format(impuestoDiv, 2));
  $("#cantProdDiv").val(cantiDiv);
}

function regresaDividir() {
  localStorage.removeItem("nuevaComanda");
  localStorage.removeItem("comandaOriginal");
  enviaInicio();
}

function productosNuevaComanda() {
  var storageComanda = localStorage.getItem("nuevaComanda");
  let listaNuevaComanda = JSON.parse(storageComanda);

  $(".comandaDiv > tbody").html("");

  listaNuevaComanda.map(function (productos) {
    let { id, producto, cant, total, codigo, ambiente } = productos;
    $(".comandaDiv > tbody").append(`
    <tr>
      <td>${producto}</td>
      <td>${cant}</td>
      <td>${number_format(total, 2)}</td>
      <td style="text-align:center">
        <button
          type="button"
          id="${i}"
          onclick="botonEliminaProductoDivi('${numero}','${codigo}','${ambiente}','${cant}','${producto}','${id}', this.id, this.parentNode.parentNode.parentNode.rowIndex)"
          class="fa fa-trash btn btn-warning btn-xs"
          title="Elimina Producto">
        </button>
      </td>
      </tr>`);
  });
}

function botonDivideComanda(
  numero,
  codigo,
  ambiente,
  can,
  nomprod,
  regis,
  id,
  index
) {
  if (can === "0") {
    swal("Atencion", "Producto Sin Cantidades para Trasladar", "warning");
    return;
  }
  var storageProd = localStorage.getItem("productoComanda");
  var totalProductos = JSON.parse(storageProd);
  var storageComanda = localStorage.getItem("nuevaComanda");
  if (storageComanda == null) {
    nuevaComanda = [];
  } else {
    nuevaComanda = JSON.parse(storageComanda);
  }

  let totales = totalProductos;

  let divide = {
    ...totalProductos.filter((producto) => producto.id === parseInt(regis)),
  };

  nuecom = divide[0];

  const existe = nuevaComanda.findIndex(
    (producto) => producto.id === nuecom.id
  );

  cantIni = nuecom.cant;
  precIni = nuecom.importe;
  imptIni = nuecom.impto;

  if (existe < 0) {
    nuecom.cant = 1;
    nuecom.total = nuecom.cant * nuecom.importe;
    nuecom.venta = (nuecom.importe * nuecom.cant) / (1 + nuecom.impto / 100);
    nuecom.valorimpto =
      nuecom.importe * nuecom.cant -
      (nuecom.importe * nuecom.cant) / (1 + nuecom.impto / 100);
    nuevaComanda = [...nuevaComanda, nuecom];
  } else {
    nuevaComanda[existe].cant++;
    nuevaComanda[existe].total =
      nuevaComanda[existe].cant * nuevaComanda[existe].importe;
    nuevaComanda[existe].venta =
      (nuevaComanda[existe].importe * nuevaComanda[existe].cant) /
      (1 + nuevaComanda[existe].impto / 100);
    nuevaComanda[existe].valorimpto =
      nuevaComanda[existe].importe * nuevaComanda[existe].cant -
      (nuevaComanda[existe].importe * nuevaComanda[existe].cant) /
        (1 + nuevaComanda[existe].impto / 100);
  }
  localStorage.setItem("nuevaComanda", JSON.stringify(nuevaComanda));

  const exis = totalProductos.findIndex(
    (prodComan) => prodComan.id === parseInt(regis)
  );

  if (exis >= 0) {
    totalProductos[exis].cant = can - 1;
    if (totalProductos[exis].cant === 0) {
      totalProductos.splice(exis, 1);
    } else {
      totalProductos[exis].importe = precIni;
      totalProductos[exis].impto = imptIni;
      totalProductos[exis].total =
        totalProductos[exis].cant * totalProductos[exis].importe;
      totalProductos[exis].venta =
        (totalProductos[exis].importe * totalProductos[exis].cant) /
        (1 + totalProductos[exis].impto / 100);
      totalProductos[exis].valorimpto =
        totalProductos[exis].importe * totalProductos[exis].cant -
        (totalProductos[exis].importe * totalProductos[exis].cant) /
          (1 + totalProductos[exis].impto / 100);
    }
  }

  localStorage.setItem("productoComanda", JSON.stringify(totalProductos));

  productosNuevaComanda();
  resumenDividir();

  productosDividir();
  resumenComanda();
}

function dividirCuenta() {
  nuevaComanda = [];
  localStorage.setItem("nuevaComanda", JSON.stringify(nuevaComanda));

  var storageProd = localStorage.getItem("productoComanda");
  let totalProductos = JSON.parse(storageProd);
  localStorage.setItem("comandaOriginal", JSON.stringify(totalProductos));

  numero = $("#numeroComanda").val();
  $("#listaComandas").css("display", "none");
  $("#tituloComanda").html(
    `<h4 style="padding:2px;text-align: center;font-weight: bold;margin:0;background:cornflowerblue"> Productos Nueva Comanda</h4>`
  );
  $(".prende").css("display", "none");
  // $("#regresarComanda").css("margin-top", "424px");
  $("#divideComanda").css("display", "block");
  $("#comandaDividida").css("display", "block");

  productosDividir();
}

function productosDividir() {
  var storageProd = localStorage.getItem("productoComanda");
  let totalProductos = JSON.parse(storageProd);

  $(".comanda > tbody").html("");
  totalProductos.map(function (productos) {
    let { producto, cant, total, codigo, ambiente, id } = productos;

    $(".comanda > tbody").append(`
    <tr>
      <td>${producto}</td>
      <td>${cant}</td>
      <td style="text-align:right">${number_format(total, 2)}</td>
      <td style="text-align:center">
        <button
          type="button"
          id="${i}"
          onclick="botonDivideComanda('${numero}','${codigo}','${ambiente}','${cant}','${producto}','${id}', this.id, this.parentNode.parentNode.parentNode.rowIndex)"
          class="fa fa-arrow-left btn btn-success btn-xs"
          title="Envia Producto">
        </button>
      </td>
      </tr>`);
  });
}

function validaIden(iden) {
  parametros = { iden };
  $.ajax({
    url: "res/php/user_actions/validaIdentificacion.php",
    type: "POST",
    data: parametros,
    success: function (ide) {
      if (ide != 0) {
        swal(
          "Precaucion",
          "Identificacion ya Existe en el Sistema ",
          "warning"
        );
        $("#identificacion").val("");
        $("#identificacion").focus();
      }
    },
  });
}

function carteradelDia() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let {
    pos,
    user: { usuario, usuario_id, tipo },
  } = sesion;
  let { id_ambiente, nombre, propina, fecha_auditoria, logo, impuesto } = oPos;
  file = makeid(12);
  parametros = {
    id: id_ambiente,
    amb: nombre,
    user: usuario,
    iduser: usuario_id,
    impto: impuesto,
    prop: propina,
    fecha: fecha_auditoria,
    logo,
    file,
  };

  $.ajax({
    url: "informes/ventasDiaCartera.php",
    type: "POST",
    data: iden,
    success: function (data) {
      $("#pantalla").html(data);
      $("#verInforme").attr("data", "imprimir/informes/" + oKey + ".pdf");
    },
  });
}

function muestraFacturasCliente(idcliente) {
  $("#dataEstadoCartera").on("show.bs.modal", function (event) {
    let oPos = JSON.parse(localStorage.getItem("oPos"));
    let { id_ambiente } = oPos;

    let idambi = id_ambiente;

    var button = $(event.relatedTarget);
    var cliente = button.data("cliente");
    var modal = $(this);
    modal.find(".modal-title").text(`Cartera Cliente : ${cliente}`);
    $.ajax({
      url: "res/php/user_actions/traeFacturasCliente.php",
      type: "POST",
      data: { idcliente, idambi },
      beforeSend: function () {
        $("#datosClienteCartera").html("");
        $("#datosClienteCartera").html("<img src='../img/loader.gif'>");
      },
      success: function (data) {
        $("#datosClienteCartera").html("");
        $("#datosClienteCartera").html(data);
        $(".rowAsigna").hide();
        $(".form-group").css("display", "none");
      },
    });
  });
}

function estadoCartera() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  $("#pantalla").css("margin-left", "0");
  let {
    pos,
    user: { usuario, usuario_id, tipo },
  } = sesion;
  let { id_ambiente, nombre, propina, fecha_auditoria, impuesto } = oPos;
  parametros = {
    id: id_ambiente,
    amb: nombre,
    user: usuario,
    iduser: usuario_id,
    impto: impuesto,
    prop: propina,
    fecha: fecha_auditoria,
  };

  $.ajax({
    url: "views/estadoCartera.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $("#pantalla").html(data);
      $("#example1").DataTable({
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
    },
  });
}

function balanceCajaCajero() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    user: { usuario, usuario_id },
  } = sesion;
  let { id_ambiente, nombre, fecha_auditoria, logo } = oPos;
  parametros = {
    id_ambiente,
    nombre,
    usuario,
    usuario_id,
    fecha_auditoria,
    logo,
  };

  $.ajax({
    url: "imprimir/imprimeBalanceCajaCajero.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      creaHTMLReportes(data, `Balance del Dia Cajero ${usuario}`);
    },
  });
}

function balanceCaja() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    user: { usuario, usuario_id },
  } = sesion;
  let { id_ambiente, nombre, propina, fecha_auditoria, impuesto, logo } = oPos;
  parametros = {
    id_ambiente,
    nombre,
    usuario,
    usuario_id,
    impuesto,
    propina,
    fecha_auditoria,
    logo,
  };

  $.ajax({
    url: "imprimir/imprimeBalanceCaja.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      creaHTMLReportes(data, `Balance del Dia`);
    },
  });
}

function abonosDia() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    pos,
    user: { usuario, usuario_id, tipo },
  } = sesion;

  let { id_ambiente, nombre, propina, fecha_auditoria, impuesto, logo } = oPos;
  parametros = {
    id: id_ambiente,
    amb: nombre,
    user: usuario,
    iduser: usuario_id,
    impto: impuesto,
    prop: propina,
    fecha: fecha_auditoria,
    logo,
  };

  $.ajax({
    url: "informes/abonosDia.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      creaHTMLReportes(data, `Abonos del Dia`);
    },
  });
}

function balanceHistorico() {
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let { fecha_auditoria } = oPos;
  parametros = {
    fecha_auditoria,
    usuario,
  };

  $.ajax({
    url: "views/historicoBalanceCaja.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $("#pantalla").html(data);
    },
  });
}

function saleFacturasCartera() {
  let nrofacturas = $("#nrofacturas").val();
  let facturas = [];
  let total = 0;
  $("#example1 > tbody > tr").each(function () {
    if ($("#asigna", this).is(":checked") === true) {
      (valor = parseFloat($("#valor", this).html().replaceAll(",", ""))),
        (factura = {
          numero: $("#nrofactura", this).html(),
          valor,
          fecha: $("#fecha", this).html(),
        });
      total = total + valor;
      facturas.push(factura);
    }
  });

  valorfact = $("#valorFacturasSelec").val();
  $("#modalFacturasCliente").modal("hide");
  $("#facturasSele").val(JSON.stringify(facturas));
  $("#concepto").val("Pago Facturas " + nrofacturas);
  $("#base").val(total);
}

function sumaFacturas() {
  let valorselec = 0;
  let nrofacturas = "";

  $("#example1 > tbody > tr").each(function () {
    var carga = $("#asigna", this).is(":checked");
    if (carga === true) {
      valorselec =
        valorselec + parseFloat($("#valor", this).html().replaceAll(",", ""));
      nrofacturas = nrofacturas + $("#nrofactura", this).html() + " ";
    }
  });

  $("#nrofacturas").val(nrofacturas);
  $("#valorFacturasSelec").val(number_format(valorselec, 2));
}

function ventasCreditoDia() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let { id_ambiente, nombre, fecha_auditoria, logo } = oPos;
  parametros = {
    id_ambiente,
    nombre,
    fecha_auditoria,
    logo,
  };

  $.ajax({
    url: "imprimir/imprimeVentasCreditoDia.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      creaHTMLReportes(data, `Ventas Credito del Dia`);
    },
  });
}

$(document).ready(function () {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: {
      usuario_id,
      usuario,
      tipo,
      pos,
      estado,
      ingreso,
      estado_usuario_pms,
    },
  } = sesion;

  $("#myModalAnulaFactura").on("show.bs.modal", function (event) {
    var modal = $(this);
    var button = $(event.relatedTarget); // Botón que activó el modal
    let idamb = button.data("idamb");
    let factura = button.data("factura");
    let movim = button.data("movim");
    modal
      .find(".modal-title")
      .html(
        `<i class="fa fa-ban"></i> Anular Factura ${number_format(factura, 0)} `
      );
    $("#facturaActiva").val(factura);
    $("#salida").val(movim);
  });

  $("#myModalFotoReceta").on("show.bs.modal", function (event) {
    var modal = $(this);
    var button = $(event.relatedTarget); // Botón que activó el modal
    var id = button.data("id"); // Extraer la información de atributos de datos
    var receta = button.data("receta"); // Extraer la información de atributos de datos
    var foto = button.data("foto"); // Extraer la información de atributos de datos
    modal.find(".modal-title").html("Receta Estandar : " + receta);
    $("#idRecetaFoto").val(id);
  });

  $("#modalAdicionaCliente").on("show.bs.modal", function (event) {
    sesion = JSON.parse(localStorage.getItem("sesion"));
    let {
      user: { usuario, usuario_id, tipo },
    } = sesion;
    $("#idusr").val(usuario_id);
  });

  $("#dataDeleteCliente").on("show.bs.modal", function (event) {
    sesion = JSON.parse(localStorage.getItem("sesion"));
    let {
      user: { usuario, usuario_id, tipo },
    } = sesion;

    var button = $(event.relatedTarget);
    var id = button.data("id");
    var modal = $(this);

    $("#idusrdel").val(usuario_id);
  });

  $("#modalConsultaKardex").on("show.bs.modal", function (event) {
    sesion = JSON.parse(localStorage.getItem("sesion"));
    let {
      user: { usuario, usuario_id, tipo },
    } = sesion;
    var button = $(event.relatedTarget);
    var producto = button.data("id");
    var bodega = button.data("bodega");
    var nombre = button.data("nombre");
    var modal = $(this);
    parametros = {
      producto,
      bodega,
    };
    modal.find(".modal-title").html(`Movimientos Producto : ${nombre}`);
    $.ajax({
      url: "res/php/user_actions/getMuestraMovimientosProducto.php",
      type: "POST",
      data: parametros,
      success: function (data) {
        $("#movimientosProducto").html(data);
      },
    });
  });

  $("#modalAdicionaSubReceta").on("show.bs.modal", function (event) {
    swal("Entro adicionar Subreceta");
  });

  $("#dataRecetaProducto").modal("show", async function () {
    console.log('Entro a MOdal Receta Producto');
    // Aquí va el código a ejecutar cuando se dispara el evento de cerrar la ventana modal
  });
});

async function guardaSubReceta() {
  let receta = document.querySelector("#idReceta").value;
  subReceSele = await traeSubRecetasSeleccionadas();
  guarda = await guardaSubRecetas(subReceSele);
  $("#modalAdicionaSubReceta").modal("hide");
  $("#btnRecetas").css("display", "block");

  const productos = await traeProductosRecetas(receta);
  materiaPrima = document.querySelector("#materiaPrima  tbody");
  limpia = await limpiaProductosRecetasHMLT();
  await muestraProductosRecetasHML(productos);
}

const guardaSubRecetas = async (subReceta) => {
  try {
    const resultado = await fetch(`res/php/user_actions/guardaSubRecetas.php`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json;charset=UTF-8", // Y le decimos que los datos se enviaran como JSON
      },
      body: JSON.stringify({ ...subReceta }),
    });
    const datos = await resultado.json();
    return datos;
  } catch (error) {
    console.log(error);
  }
};

async function modalSubReceta() {
  let receta = document.querySelector("#idReceta").value;
  let producto = document.querySelector("#nomReceta").value;
  $("#modalAdicionaSubReceta").modal("show");
  $("#btnRecetas").css("display", "none");

  const subrecetas = await traeSubRecetas(receta);

  let subRecetas = document.querySelector("#subRecetas tbody");
  limpia = await limpiaSubRecetasHTML();

  await muestraSubRecetasHTML(subrecetas);
}

async function muestraSubRecetasHTML(subrecetas) {
  subrecetas.forEach((subreceta) => {
    const { id_receta, nombre_receta, valor_costo } = subreceta;
    const row = document.createElement("tr");

    row.innerHTML += `
        <td>
            ${nombre_receta}
            <input type="hidden" value="${id_receta}">
            
          </td>
          <td class="derecha">
            ${number_format(valor_costo, 2)}
            <input type="hidden" value="${valor_costo}">
        </td>
        <td class="centro">  
          <input class="form-check-input" type="checkbox" value="" id="seleSub">  
        </td>
        <td style="width:15%">
          <input class="form-control" type="number" id="cantiSub" name="cantiSub" value=0>  
        </td>
    `;

    subRecetas.appendChild(row);
  });
}

async function traeSubRecetasSeleccionadas() {
  const checkboxList = document.querySelectorAll('input[type="checkbox"]');
  const checkedIds = [];
  let idReceta = document.querySelector("#idReceta").value;

  for (let i = 0; i < checkboxList.length; i++) {
    const checkbox = checkboxList[i];

    if (checkbox.checked) {
      let fila = checkbox.closest("tr").querySelectorAll("td");
      let nombre = checkbox.closest("tr").querySelectorAll("td")[0];
      let fila1 = checkbox.closest("tr").querySelectorAll("td")[1];
      let nombreSubRece = nombre.innerText;
      let cantidad = checkbox.closest("tr").querySelectorAll("td")[3]
        .childNodes[1].value;
      let idSubRece = nombre.children[0].value;
      let costoSubR = fila1.children[0].value;
      let data = {
        idSubRece,
        nombreSubRece,
        idReceta,
        costoSubR,
        cantidad,
        usuario_id,
      };
      checkedIds.push(data);
    }
  }

  return checkedIds;
}

async function limpiaSubRecetasHTML() {
  while (subRecetas.firstChild) {
    subRecetas.removeChild(subRecetas.firstChild);
  }
}

const traeSubRecetas = async (receta) => {
  try {
    const resultado = await fetch(`res/php/user_actions/traeSubRecetas.php`, {
      method: "post",
      headers: {
        "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
      },
      body: "receta=" + receta,
    });
    const datos = await resultado.json();
    return datos;
  } catch (error) {
    console.log(error);
  }
};

function traeFacturasCliente() {
  let { id_ambiente } = oPos;
  let idambi = id_ambiente;

  let idcliente = $("#proveedor").val();
  if (idcliente == "") {
    swal("Precaucion", "Seleccione Primero el Cliente", "warning");
    $("#proveedor").focus();
    return 0;
  }
  $("#modalFacturasCliente").modal("show");
  let cliente = $("#proveedor option:selected").text();
  let modal = $(this);
  $(".modal-title").text("Cliente : " + cliente);

  $.ajax({
    type: "POST",
    url: "res/php/user_actions/traeFacturasCliente.php",
    data: { idcliente, idambi },
    success: function (data) {
      $("#traeFacturas").html(data);
    },
  });
}

function ingresoCartera() {
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let { fecha_auditoria } = oPos;

  $.ajax({
    url: "views/recaudosCartera.php",
    type: "POST",
    success: function (data) {
      $("#pantalla").html(data);
      $("#fecha").val(fecha_auditoria);
    },
  });
}

function guardaCartera() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let fecha = $("#fecha").val();
  let base = $("#base").val();
  let naturaleza = $("#naturaleza").val();
  let concepto = $("#concepto").val();
  let proveedor = $("#proveedor").val();
  let formaPago = $("#formapago").val();
  let facturas = $("#facturasSele").val();
  let cliente = $("#proveedor option:selected").text();
  let {
    pos,
    user: { usuario, usuario_id, tipo },
  } = sesion;
  let { id_ambiente, nombre, logo } = oPos;

  ambi = id_ambiente;
  nomambi = nombre;
  // let {user: { usuario, usuario_id, tipo }}= usuario;
  let iduser = usuario_id;

  parametros = {
    facturas,
    base,
    ambi,
    nomambi,
    iduser,
    user,
    fecha,
    naturaleza,
    concepto,
    proveedor,
    formaPago,
    logo,
    cliente,
  };

  $.ajax({
    type: "POST",
    url: "res/php/user_actions/guardaCartera.php",
    data: parametros,
    success: function (data) {
      var ventana = window.open(
        `impresiones/${$.trim(data)}`,
        "PRINT",
        "height=600,width=600"
      );
      enviaInicio();
    },
  });
}

function comprasCaja() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let { pos } = sesion;
  let { fecha_auditoria } = oPos;

  $.ajax({
    url: "views/comprasCaja.php",
    type: "POST",
    success: function (data) {
      $("#pantalla").html(data);
      $("#fecha").val(fecha_auditoria);
    },
  });
}

function baseCaja() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let { pos } = sesion;
  let { fecha_auditoria } = oPos;
  $.ajax({
    url: "views/baseCaja.php",
    type: "POST",
    success: function (data) {
      $("#pantalla").css("margin-left", "0");
      $("#pantalla").html(data);
      $("#fecha").val(fecha_auditoria);
    },
  });
}

function guardaCompras() {
  let base = $("#base").val();
  let naturaleza = $("#naturaleza").val();
  let concepto = $("#concepto").val();
  let documento = $("#documento").val();
  let fecha = $("#fecha").val();
  let proveedor = $("#proveedor").val();

  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    pos,
    user: { usuario, usuario_id, tipo },
  } = sesion;
  let { id_ambiente, nombre, logo } = oPos;

  ambi = id_ambiente;
  nomambi = nombre;
  let user = usuario;
  let iduser = usuario_id;

  parametros = {
    base,
    ambi,
    nomambi,
    iduser,
    user,
    fecha,
    naturaleza,
    concepto,
    documento,
    proveedor,
    logo,
  };

  $.ajax({
    type: "POST",
    url: "res/php/user_actions/guardaCompra.php",
    data: parametros,
    success: function (data) {
      var ventana = window.open(
        `impresiones/${$.trim(data)}`,
        "PRINT",
        "height=600,width=600"
      );
      enviaInicio();
    },
  });
}

function guardaBase() {
  let base = $("#base").val();
  let naturaleza = $("#naturaleza").val();
  let concepto = $("#concepto").val();
  let documento = $("#documento").val();
  let fecha = $("#fecha").val();
  let proveedor = $("#proveedor").val();

  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    pos,
    user: { usuario, usuario_id, tipo, apellidos, nombres },
  } = sesion;
  let { id_ambiente, nombre, logo } = oPos;
  // let { usuario, usuario_id } = user;

  ambi = id_ambiente;
  nomambi = nombre;
  let user = usuario;
  let iduser = usuario_id;

  parametros = {
    base,
    ambi,
    nomambi,
    iduser,
    user,
    fecha,
    naturaleza,
    concepto,
    documento,
    proveedor,
    nombre,
    logo,
  };

  $.ajax({
    type: "POST",
    url: "res/php/user_actions/guardaBaseCaja.php",
    data: parametros,
    success: function (data) {
      var ventana = window.open(
        `impresiones/${$.trim(data)}`,
        "PRINT",
        "height=600,width=600"
      );
      enviaInicio();
    },
  });
}

function buscarProducto() {
  var alto = screen.height;
  var ancho = screen.width;
  oPos = JSON.parse(localStorage.getItem("oPos"));
  // let { pos } = sesion;
  let { id_ambiente } = oPos;
  var textoBusqueda = $("input#busqueda").val();
  parametros = {
    id_ambiente,
    textoBusqueda,
  };

  if (textoBusqueda != "") {
    $.ajax({
      type: "POST",
      url: "res/php/user_actions/getBuscaProducto.php",
      dataType: "json",
      data: parametros,
      beforeSend: function (objeto) {
        $("#productoList").html("<img src='../img/loader.gif'>");
      },
      success: function (datos) {
        $("#productoList").html("");
        $("#productoList").css("min-height", 480);
        $("#productoList").css("height", alto - 263);
        if (datos.length > 1) {
          datos.map(function (dato) {
            let { nom, venta, producto_id, porcentaje_impto } = dato;
            boton = `<button
              style="background-size: contain;line-height:15px ;"
              id="productos"
              class="btn btn-danger btnPos btnProd"
              name="${nom}"
              valor="${venta}"
              idprod="${producto_id}"
              porimp="${porcentaje_impto}"
              onClick="getVentas('${nom}','${venta}','${producto_id}','${porcentaje_impto}','${id_ambiente}')" 
              type="button"
              class='btn btn-danger'>
              ${nom}</button>`;
            $("#productoList").append(boton);
          });
        } else {
          let { nom, venta, producto_id, porcentaje_impto } = datos[0];
          getVentas(nom, venta, producto_id, porcentaje_impto, id_ambiente);
        }
      },
    });
  } else {
    $("#productoList").html("");
  }
  $("input#busqueda").val("");
}

function historicoVentasClientes() {
  let web = $("#rutaweb").val();
  let desdeFe = $("#desdeFecha").val();
  let hastaFe = $("#hastaFecha").val();
  let huesped = $("#desdeCliente").val();
  let formaPa = $("#desdeFormaPago").val();
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    pos,
    user: { usuario, usuario_id, tipo },
  } = sesion;
  let { id_ambiente, prefijo, logo } = oPos;

  idambi = id_ambiente;

  parametros = {
    idamb,
    prefijo,
    desdeFe,
    hastaFe,
    huesped,
  };

  if (desdeFe == "" && hastaFe == "") {
    swal("Atencion", "Seleccione un Criterio de Busqueda", "warning");
  } else {
    $.ajax({
      url: "res/php/user_actions/historicoClientes.php",
      type: "POST",
      data: parametros,
      success: function (x) {
        $(".imprimeInforme").html(x);
        $("#dataTable").DataTable({
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
      },
    });
  }
}

function historicoClientes() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    pos,
    user: { usuario, usuario_id, tipo },
  } = sesion;
  let { id_ambiente, nombre, logo, propina, fecha_auditoria, impuesto } = oPos;

  idambi = id_ambiente;
  amb = nombre;
  let user = usuario;
  let iduser = usuario_id;

  parametros = {
    idamb,
    amb,
    user,
    iduser,
    impto: impuesto,
    prop: propina,
    fecha: fecha_auditoria,
    logo,
  };
  $.ajax({
    url: "ventas/ventasPorCliente.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $("#pantalla").html(data);
    },
  });
}

function ventasPorCliente() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let {
    pos,
    user: { usuario, usuario_id, tipo },
  } = sesion;
  let { id_ambiente, nombre, logo, propina, fecha_auditoria, impuesto } = oPos;

  oKey = makeid(12);
  parametros = {
    id: id_ambiente,
    amb: nombre,
    user: usuario,
    iduser: usuario_id,
    impto: impuesto,
    prop: propina,
    fecha: fecha_auditoria,
    logo,
    file: oKey,
  };

  $.ajax({
    url: "informes/ventasPorCliente.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $("#pantalla").html(data);
      $("#verInforme").attr("data", "imprimir/informes/" + oKey + ".pdf");
    },
  });
}

function getComandasPlano(comanda, nromesa, nomBtn) {
  var alto = screen.height;
  var ancho = screen.width;
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let {
    pos,
    user: { usuario, usuario_id, tipo },
  } = sesion;
  let { id_ambiente, nombre, logo, prefijo, fecha_auditoria } = oPos;

  $(".btn-menu").css("display", "block");
  miBoton = "#" + nomBtn;
  impuesto = $(miBoton).attr("impto");
  propina = $(miBoton).attr("propina");
  descuento = $(miBoton).attr("descuento");
  subtotal = $(miBoton).attr("subtotal");
  // abonos = $(miBoton).attr("abonos");
  total = $(miBoton).attr("total");
  cliente = $(miBoton).attr("cliente");

  parametros = {
    id_ambiente,
    nombre,
    usuario,
    tipo,
    fecha_auditoria,
    prefijo,
    impuesto,
    propina,
    descuento,
    subtotal,
    total,
    comanda,
    nromesa,
    cliente,
  };

  $.ajax({
    url: "ventas/cuentasPlano.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $("#pantalla").html(data);
      $("#tituloNumero2").html(
        `<h3 style="margin-top:10px">Comanda Nro ${comanda} <br>Mesa Nro ${nromesa}</h3>`
      );
      $("#Escritorio").css("height", alto - 420);
    },
  });
}

function mesasActivasPlano() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    pos,
    user: { usuario, usuario_id, tipo },
  } = sesion;
  let { id_ambiente, nombre, propina, prefijo, fecha_auditoria, impuesto } =
    oPos;

  parametros = {
    idamb: id_ambiente,
    amb: nombre,
    user: usuario,
    impto: impuesto,
    prop: propina,
    pref: prefijo,
    fecha: fecha_auditoria,
  };

  $.ajax({
    url: "res/php/user_actions/getCuentasActivas.php",
    type: "POST",
    data: parametros,
    dataType: "json",
    success: function (datos) {
      datos.map((data) => {
        const {
          mesa,
          comanda,
          impuesto,
          subtotal,
          total,
          valor_descuento,
          abonos,
          propina,
          cliente,
        } = data;
        // let btnmesa = "boton" + mesa,
        let nroMesa = `boton${mesa}`;
        // let comanda = data[i]["comanda"];
        $("#" + nroMesa).attr("impto", impuesto);
        $("#" + nroMesa).attr("subtotal", subtotal);
        $("#" + nroMesa).attr("total", total);
        $("#" + nroMesa).attr("descuento", valor_descuento);
        $("#" + nroMesa).attr("abonos", abonos);
        $("#" + nroMesa).attr("propina", propina);
        $("#" + nroMesa).attr("cliente", cliente);
        $("." + nroMesa).removeClass("alert-success");
        $("." + nroMesa).addClass("alert-danger");
        $("#" + nroMesa).removeAttr("attribute onclick");
        $("#" + nroMesa).attr(
          "onclick",
          `getComandasPlano(${comanda} ,'${mesa}',this.name)`
        );
      });
    },
  });
}

function abreCuenta(mesa) {
  let alto = screen.height;
  let ancho = screen.width;
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let {
    pos,
    user: { usuario, usuario_id, tipo },
  } = sesion;
  let { id_ambiente, nombre, propina, prefijo, fecha_auditoria, impuesto } =
    oPos;
  storageProd = localStorage.getItem("productoComanda");
  if (storageProd === null) {
    var listaComanda = [];
  }

  $("#btnGuardar").attr("disabled", "enabled");

  parametros = {
    id: id_ambiente,
    amb: nombre,
    user: usuario,
    impto: impuesto,
    prop: propina,
    fecha: fecha_auditoria,
    prefijo,
    mesa,
  };

  $.ajax({
    url: "ventas/touch.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      getSecciones();
      $("#pantalla").html(data);
      $("#productosComanda").css("height", 463);
      $("#Escritorio").css("height", alto - 420);
      $("#nromesas").val(mesa);
      $("#nromesas").attr("readonly", true);
      $("#nromesas").attr("disabled", true);
      let storageProd = localStorage.getItem("productoComanda");
      let listaComanda;
      if (storageProd == null) {
        listaComanda = [];
      } else {
        listaComanda = JSON.parse(storageProd);
      }
      productosActivos();
      resumenComanda();
    },
  });
}

function muestraMenu() {
  const containerMenu = document.querySelector(".main-sidebar");
  const containerWraper = document.querySelector("#pantalla");
  containerMenu.classList.toggle("activaMenu");
  containerWraper.classList.toggle("cambiaWrapper");
}

function pantallaNormal() {
  //Mozilla Firefox
  if (document.mozCancelFullScreen) {
    document.mozCancelFullScreen();
  }
  //Google Chrome
  else if (document.webkitCancelFullScreen) {
    document.webkitCancelFullScreen();
  }
  //Otro
  else if (document.cancelFullScreen) {
    document.cancelFullScreen();
  }
}

function pantallaCompleta(elem) {
  //Si el navegador es Mozilla Firefox
  if (elem.mozRequestFullScreen) {
    elem.mozRequestFullScreen();
  }
  //Si el navegador es Google Chrome
  else if (elem.webkitRequestFullScreen) {
    elem.webkitRequestFullScreen();
  }
  //Si el navegador es otro
  else if (elem.requestFullScreen) {
    elem.requestFullScreen();
  }
}

function historicoGrupos() {
  var web = $("#rutaweb").val();
  desdeFe = $("#desdeFecha").val();
  hastaFe = $("#hastaFecha").val();
  desdeNu = $("#desdeNumero").val();
  hastaNu = $("#hastaNumero").val();
  huesped = $("#desdeHuesped").val();
  formaPa = $("#desdeFormaPago").val();
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    pos,
    user: { usuario, usuario_id, tipo },
  } = sesion;
  let { id_ambiente, nombre, logo, prefijo } = oPos;

  parametros = {
    idamb: id_ambiente,
    amb: nombre,
    user: usuario,
    iduser: usuario_id,
    logo,
    prefijo,
    desdeFe,
    hastaFe,
  };

  if (desdeFe == "" && hastaFe == "") {
    swal("Atencion", "Seleccione un Criterio de Fechas", "warning");
  } else {
    $.ajax({
      url: "imprimir/imprimeVentasPorGrupoMes.php",
      type: "POST",
      data: parametros,
      success: function (data) {
        $("#verInforme").attr(
          "data",
          `data:application/pdf;base64,${$.trim(data)}`
        );
      },
    });
  }
}

function historicoFormasPago() {
  var web = $("#rutaweb").val();
  desdeFe = $("#desdeFecha").val();
  hastaFe = $("#hastaFecha").val();
  desdeNu = $("#desdeNumero").val();
  hastaNu = $("#hastaNumero").val();
  huesped = $("#desdeHuesped").val();
  formaPa = $("#desdeFormaPago").val();
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    pos,
    user: { usuario, usuario_id, tipo },
  } = sesion;
  let { id_ambiente, nombre, logo, prefijo } = oPos;

  parametros = {
    amb: nombre,
    user: usuario,
    iduser: usuario_id,
    idamb: id_ambiente,
    logo,
    prefijo,
    desdeFe,
    hastaFe,
  };

  if (desdeFe == "" && hastaFe == "") {
    swal("Atencion", "Seleccione un Criterio de Fechas", "warning");
  } else {
    $.ajax({
      url: "imprimir/imprimeVentasFormasPagoMes.php",
      type: "POST",
      data: parametros,
      success: function (data) {
        $("#verInforme").attr(
          "data",
          `data:application/pdf;base64,${$.trim(data)}`
        );
      },
    });
  }
}

function historicoProductos() {
  var web = $("#rutaweb").val();
  desdeFe = $("#desdeFecha").val();
  hastaFe = $("#hastaFecha").val();
  desdeNu = $("#desdeNumero").val();
  hastaNu = $("#hastaNumero").val();
  huesped = $("#desdeHuesped").val();
  formaPa = $("#desdeFormaPago").val();
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let { nombre, id_ambiente, logo } = oPos;

  parametros = {
    nombre,
    id_ambiente,
    logo,
    desdeFe,
    hastaFe,
  };

  if (desdeFe == "" && hastaFe == "") {
    swal("Atencion", "Seleccione un Criterio de Fechas", "warning");
  } else {
    $.ajax({
      url: "imprimir/imprimeVentasProductosMes.php",
      type: "POST",
      dataType: "json",
      data: parametros,
      success: function (datos) {
        let { tabla, reporte, inventario } = datos;
        $("#exporta").removeAttr("disabled");
        llenaProductos(tabla, inventario);
        $("#verInforme").attr(
          "data",
          `data:application/pdf;base64,${$.trim(reporte)}`
        );
      },
    });
  }
}

function llenaProductos(datos, inventario) {
  dataProd = document.querySelector("#dataProductos tbody");
  let html = "";
  datos.forEach((dato) => {
    let promedio = 0;
    const { nom, unitario, cant, descuento, total, id_receta } = dato;

    let existe = inventario.filter(
      (productos) => productos.id_producto === id_receta
    );

    if (existe.length >= 1) {
      promedio = existe["promedio"];
      if (existe["promedio"] == null) {
        promedio = 0;
      }
    }

    html += `
    <tr>
      <td>${nom}</td>  
      <td>${unitario}</td>  
      <td>${cant}</td>  
      <td>${descuento}</td>  
      <td>${total}</td>  
      <td>${promedio}</td>  
      <td>${promedio * cant}</td>  
    </tr>
    `;
  });
  dataProd.innerHTML = html;
}

function historicoBalanceCaja() {
  var web = $("#rutaweb").val();
  desdeFe = $("#desdeFecha").val();
  hastaFe = $("#hastaFecha").val();
  desdeNu = $("#desdeNumero").val();
  hastaNu = $("#hastaNumero").val();
  huesped = $("#desdeHuesped").val();
  formaPa = $("#desdeFormaPago").val();
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    pos,
    user: { usuario, usuario_id, tipo },
  } = sesion;
  let { id_ambiente, nombre, logo, prefijo } = oPos;

  parametros = {
    nombre,
    usuario,
    usuario_id,
    id_ambiente,
    logo,
    prefijo,
    desdeFe,
    hastaFe,
  };

  if (desdeFe == "" && hastaFe == "") {
    swal("Atencion", "Seleccione un Criterio de Fechas", "warning");
  } else {
    $.ajax({
      url: "imprimir/imprimeBalanceCajaMes.php",
      type: "POST",
      data: parametros,
      success: function (data) {
        $("#verInforme").attr(
          "data",
          `data:application/pdf;base64,${$.trim(data)}`
        );
      },
    });
  }
}

function historicoPeriodos() {
  var web = $("#rutaweb").val();
  desdeFe = $("#desdeFecha").val();
  hastaFe = $("#hastaFecha").val();
  desdeNu = $("#desdeNumero").val();
  hastaNu = $("#hastaNumero").val();
  huesped = $("#desdeHuesped").val();
  formaPa = $("#desdeFormaPago").val();
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    pos,
    user: { usuario, usuario_id, tipo },
  } = sesion;
  const { nombre, id_ambiente, logo, prefijo, id_bodega } = oPos;
  parametros = {
    nombre,
    usuario,
    usuario_id,
    id_ambiente,
    id_bodega,
    logo,
    prefijo,
    desdeFe,
    hastaFe,
  };

  if (desdeFe == "" && hastaFe == "") {
    swal("Atencion", "Seleccione un Criterio de Fechas", "warning");
  } else {
    $.ajax({
      url: "imprimir/imprimeVentasPorPeriodoMes.php",
      type: "POST",
      data: parametros,
      success: function (data) {
        $("#verInforme").attr(
          "data",
          `data:application/pdf;base64,${$.trim(data)}`
        );
      },
    });
  }
}

function devolucionesDia() {
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let { id_ambiente, nombre, fecha_auditoria, logo } = oPos;

  parametros = {
    id_ambiente,
    nombre,
    fecha_auditoria,
    logo,
  };

  $.ajax({
    url: "imprimir/imprimeDevolucionesdelDia.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      creaHTMLReportes(data, `Devoluciones del Dia`);
    },
  });
}

function activaSelecReceta(codigo) {
  if (codigo == 0) {
    $("#receta").css("display", "none");
    $("#idrecetaAdi").val(0);
    $("#idrecetaAdi").removeAttr("required");
  } else {
    $("#receta").css("display", "block");
    $("#idrecetaAdi").attr("required", "required");
  }

  if (codigo == 1) {
    $("#labelReceta").text("Producto de Inventario");
    $.ajax({
      url: "res/php/user_actions/getProductos.php",
      type: "POST",
      dataType: "json",
      data: { param1: "value1" },
      success: function (data) {
        $("#idrecetaAdi option").remove();
        for (i = 0; i < data.length; i++) {
          $("#idrecetaAdi").append(`
            <option value="${data[i]["id_producto"]}">${data[i]["nombre_producto"]}</option>
            `);
        }
      },
    });
  }

  if (codigo == 2) {
    $("#labelReceta").text("Receta Estandar");
    $.ajax({
      url: "res/php/user_actions/getRecetas.php",
      type: "POST",
      dataType: "json",
      data: { param1: "value1" },
      success: function (data) {
        $("#idrecetaAdi option").remove();
        for (i = 0; i < data.length; i++) {
          $("#idrecetaAdi").append(
            `<option value="${data[i]["id_receta"]}">${data[i]["nombre_receta"]}</option>`
          );
        }
      },
    });
  }
}

function activaSelecRecetaUpd(codigo) {
  if (codigo == 0) {
    $("#recetaUpd").css("display", "none");
    $("#idrecetaUpd").val(0);
    $("#idrecetaUpd").removeAttr("required");
  } else {
    $("#recetaUpd").css("display", "block");
    $("#idrecetaUpd").attr("required", "required");
  }

  if (codigo == 1) {
    $("#labelRecetaUpd").text("Producto de Inventario");
    $.ajax({
      url: "res/php/user_actions/getProductos.php",
      type: "POST",
      dataType: "json",
      data: { param1: "value1" },
      success: function (data) {
        $("#idrecetaUpd option").remove();
        for (i = 0; i < data.length; i++) {
          $("#idrecetaUpd").append(`
            <option value="${data[i]["id_producto"]}">${data[i]["nombre_producto"]}</option>
            `);
        }
      },
    });
  }

  if (codigo == 2) {
    $("#labelRecetaUpd").text("Receta Estandar");
    $.ajax({
      url: "res/php/user_actions/getRecetas.php",
      type: "POST",
      dataType: "json",
      data: { param1: "value1" },
      success: function (data) {
        $("#idrecetaUpd option").remove();
        for (i = 0; i < data.length; i++) {
          $("#idrecetaUpd").append(
            `<option value="${data[i]["id_receta"]}">${data[i]["nombre_receta"]}</option>`
          );
        }
      },
    });
  }
}

function devolucionProductos() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    user: { usuario, usuario_id },
  } = sesion;
  let { id_ambiente, nombre, propina, logo, fecha_auditoria, impuesto } = oPos;

  parametros = {
    usuario,
    id_ambiente,
    nombre,
    usuario_id,
    impuesto,
    propina,
    fecha_auditoria,
    logo,
  };

  $.ajax({
    url: "imprimir/imprimeDevolucionProductos.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      creaHTMLReportes(data, `Devolucion Productos del Dia`);
    },
  });
}

function botonDevolverProducto(
  comanda,
  producto,
  ambi,
  canti,
  nombre,
  idprod,
  importe,
  impto,
  codigo,
  regis
) {
  $("#myModalDevolucionComanda").modal("show");
  $("#cantiInicial").val(canti);
  $("#cantidadDev").val(1);
  $("#nombreProd").val(nombre);
  $("#idProductoDev").val(idprod);
  $("#prodImporte").val(importe);
  $("#prodImpto").val(impto);
  $("#ambienteDev").val(ambi);
  $("#comandaDev").val(comanda);
  $("#regisDev").val(regis);
  $("#cantidadDev").attr("max", canti);

  $("#motivoDev").val("");
}

function devolverProducto() {
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let { id_ambiente, nombre, propina, logo, fecha_auditoria, impuesto } = oPos;
  inicial = $("#cantiInicial").val();
  cantidad = $("#cantidadDev").val();
  comanda = $("#numeroComanda").val();
  idprod = $("#idProductoDev").val();
  idambi = $("#ambienteDev").val();
  motivo = $("#motivoDev").val();
  regis = $("#regisDev").val();
  importe = $("#prodImporte").val();
  impto = $("#prodImpto").val();

  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    pos,
    user: { usuario },
  } = sesion;

  parametros = {
    comanda,
    inicial,
    cantidad,
    idprod,
    idambi,
    importe,
    impto,
    motivo,
    fecha_auditoria,
    usuario,
    impuesto,
  };

  $.ajax({
    url: "res/php/user_actions/devolucionProducto.php",
    type: "POST",
    dataType: "json",
    data: parametros,
    success: function (data) {
      $("#myModalDevolucionComanda").modal("hide");
      nombreComanda = "comanda" + comanda;
      getComandas(nombreComanda, comanda);
      resumenComanda();
    },
  });
}

function verComandasAnuladas() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    pos,
    user: { usuario, usuario_id, tipo },
  } = sesion;
  let { id_ambiente, nombre, prefijo } = oPos;
  // let { tipo, usuario } = user;

  var idamb = id_ambiente;
  var nomamb = nombre;
  var pref = prefijo;
  var tipousr = tipo;

  var parametros = {
    idamb,
    pref,
    nomamb,
    tipousr,
    user: usuario,
  };
  $("#loader").fadeIn("slow");
  $.ajax({
    url: "views/comandasAnuladasDelDia.php",
    data: parametros,
    type: "POST",
    beforeSend: function (objeto) {
      $("#loader").html("<img src='../img/loader.gif'>");
    },
    success: function (data) {
      $("#pantalla").html(data);
      $("#example1").DataTable({
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
    },
  });
}

function verComanda(fact) {
  $("#verFactura").attr("data", "impresiones/" + fact);
}

function colorHEX() {
  var coolor = "";
  for (var i = 0; i < 6; i++) {
    coolor = coolor + generarLetra();
  }
  return "#" + coolor;
}

function verSalidaInventarios(fact) {
  $("#verFactura").attr("data", "../inventario/imprimir/" + fact);
}

function facturasDia() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    pos,
    user: { usuario, usuario_id, tipo },
  } = sesion;
  let { id_ambiente, nombre, prefijo } = oPos;

  var parametros = {
    id_ambiente,
    prefijo,
    nombre,
    tipo,
    usuario,
  };
  $("#loader").fadeIn("slow");
  $.ajax({
    url: "views/facturasDelDia.php",
    data: parametros,
    type: "POST",
    beforeSend: function (objeto) {
      $("#loader").html("<img src='../img/loader.gif'>");
    },
    success: function (data) {
      $("#pantalla").html(data);

      $("#example1").DataTable({
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
    },
  });
}

function resumenComanda() {
  let storageProd = localStorage.getItem("productoComanda");
  let listaComanda;
  storageProd == null
    ? (listaComanda = [])
    : (listaComanda = JSON.parse(storageProd));

  let impuesto = 0;
  let venta = 0;
  let canti = 0;
  let propina = 0;
  let abonos = 0;
  let totalCuenta = 0;
  let totalCta = 0;
  canti = listaComanda.reduce(
    (canti, comanda) => canti + parseFloat(comanda.cant),
    0
  );
  impuesto = listaComanda.reduce(
    (impuesto, comanda) => impuesto + parseFloat(comanda.valorimpto),
    0
  );
  ventas = listaComanda.reduce(
    (ventas, comanda) => ventas + parseFloat(comanda.venta),
    0
  );
  totalCta = listaComanda.reduce(
    (totalCta, comanda) => totalCta + parseFloat(comanda.total),
    0
  );

  let miBoton = "comanda" + $("#numeroComanda").val();

  $("#totalVta").val(ventas);
  $("#valorImpto").val(impuesto);
  $("#totalComanda").val(totalCta);
  $("#totalVta").html(number_format(ventas, 2));
  $("#valorImpto").html(number_format(impuesto, 2));
  $("#totalCuenta").html(number_format(totalCta, 2));
  $("#cantProd").val(canti);

  $("#" + miBoton).attr("subtotal", venta.toFixed(2));
  $("#" + miBoton).attr("impto", impuesto.toFixed(2));
  // $("#" + miBoton).attr("descuento", descuento);
  $("#" + miBoton).attr("abonos", abonos);
  $("#" + miBoton).attr("total", totalCuenta.toFixed(2));
}

function saldoComanda() {
  let storageProd = localStorage.getItem("productoComanda");
  let listaComanda;
  storageProd == null
    ? (listaComanda = [])
    : (listaComanda = JSON.parse(storageProd));

  let impuesto = 0;
  let venta = 0;
  let canti = 0;
  let propina = 0;
  let abonos = 0;
  let totalCuenta = 0;
  let totalCta = 0;
  canti = listaComanda.reduce(
    (canti, comanda) => canti + parseFloat(comanda.cant),
    0
  );
  impuesto = listaComanda.reduce(
    (impuesto, comanda) => impuesto + parseFloat(comanda.valorimpto),
    0
  );
  ventas = listaComanda.reduce(
    (ventas, comanda) => ventas + parseFloat(comanda.venta),
    0
  );
  totalCta = listaComanda.reduce(
    (totalCta, comanda) => totalCta + parseFloat(comanda.total),
    0
  );
}

function resumenDescuento(ambiente, comanda) {
  let abono = parseFloat($("#abonosComanda").val());
  $.ajax({
    url: "res/php/user_actions/resumenDescuento.php",
    type: "POST",
    dataType: "json",
    data: {
      comanda,
      ambiente,
    },
  }).done(function (datos) {
    $("#totalVta").html(number_format(datos["subtotal"], 2));
    $("#totalDesc").html(number_format(datos["valor_descuento"], 2));
    $("#totalCuenta").html(
      number_format(datos["total"] - datos["valor_descuento"] - abono, 2)
    );
    $("#valorImpto").html(number_format(datos["imppuesto"], 2));
  });
}

function verFoto(event) {
  const input = event.target;

  imgPrev = document.querySelector("#imgPreview");

  // Verificamos si existe una imagen seleccionada
  if (!input.files.length) return;

  //Recuperamos el archivo subido
  file = input.files[0];

  //Creamos la url
  objectURL = URL.createObjectURL(file);

  //Modificamos el atributo src de la etiqueta img
  imgPreview.src = objectURL;
}

function verFoto02(e) {
  if (e.files && e.files) {
    // console.log(e.files.type);

    if (e.files.type.match("image.*")) {
      var reader = new FileReader();
      reader.onload = function (e) {
        document.getElementById("mostrarFoto").innerHTML =
          "<img loading='lazy' style='margin:0' class='img-thumbnail' src='" +
          e.target.result +
          "'>";
      };
      reader.onerror = function (e) {
        document.getElementById("mostrarFoto").innerHTML = "Error de lectura";
      };
      reader.readAsDataURL(e.files);
    } else {
      document.getElementById("mostrarFoto").innerHTML =
        "No es un formato de imagen";
    }
  }
}

function subeFoto(id, receta, foto) {
  let formImg = document.querySelector("form");
  formImg.reset;
  $("#myModalFotoReceta").modal("show");
  $(".modal-title").html("Foto Receta Estandar : " + receta);
  $("#idRecetaFoto").val(id);
  $("#nombreReceta").val(receta);
  $("#mostrarFoto").html("");
  if (foto != "") {
    $("#mostrarFoto").html(
      `<img loading='lazy' style='margin:0' class='img-thumbnail' src='images/${foto}'>`
    );
  }
}

function subirFoto() {
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var formData = new FormData($("#formFotoReceta")[0]);

  $.ajax({
    url: "res/php/user_actions/subirFotoReceta.php",
    type: "post",
    data: formData,
    contentType: false,
    processData: false,
    success: function (response) {
      $("#myModalFotoReceta").modal("hide");
    },
  });
}

function actualizaReceta() {
  var parametros = $("#actualidarDatosReceta").serialize();
  $.ajax({
    url: "res/php/user_actions/actualizaReceta.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $(".modal-backdrop").remove();
      $(".modal-open").css("overflow", "auto");
      $("#ppal").css("padding-right", "0");
      recetas();
    },
  });
}

function updateReceta(id, receta) {
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let { id_ambiente } = oPos;
  $("#dataUpdateReceta").modal("show");
  $(".modal-title").text("Receta Estandar : " + receta);
  $.ajax({
    url: "res/php/user_actions/updateReceta.php",
    type: "POST",
    data: {
      id,
      id_ambiente,
    },
    success: function (data) {
      $("#traeReceta").html(data);
    },
  });
}

function activaMenu() {
  $(".modal-backdrop").remove();
  $(".modal-open").css("overflow", "auto");
  $(".btn-menu").css("display", "none");
}

function resumenReceta() {
  let total = 0;
  let totales = 0;

  $("#materiaPrima > tbody > tr").each(function () {
    let total = $(this).find("td").eq(4).html();
    total = parseFloat(total.replaceAll(",", ""));
    totales += total;
  });

  $("#costoReceta").val(number_format(totales, 2));
}

async function saleMP() {
  let formreceta = document.querySelector("#idReceta");
  let receta = formreceta.value;
  let formCosto = document.querySelector('#costoReceta');
  let costo = formCosto.value;
  costo = parseFloat(costo.replaceAll(",", ""));
  try {
    const resultado = await fetch(
      `res/php/user_actions/actualizaCostoReceta.php`,
      {
        method: "POST",
        headers: {
          "Content-type": "application/json; charset=UTF-8",
        },
        body: JSON.stringify({ costo, receta }),
      }
    );
    const datos = await resultado.json();
    // return datos;
  } catch (error) {
    console.log(error);
  }

  $("#dataRecetaProducto").modal("hide");
  $(".modal-backdrop").remove();
  $(".modal-open").css("overflow", "auto");
  recetas();
}

function actualizaRece(cod, codigo, regis, receta) {
  document.getElementById("materiaPrima").deleteRow(codigo);
  $.ajax({
    url: "res/php/user_actions/eliminaComponenteReceta.php",
    type: "POST",
    data: {
      cod,
      receta,
    },
    success: function () {
      resumenReceta();
    },
  });
}

function guardarReceta() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let { user: { usuario }, } = sesion;

  let parametros = $("#guardarDatosReceta").serializeArray();
  parametros.push({ name: "usuario", value: usuario });

  $.ajax({
    url: "res/php/user_actions/guardaReceta.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $(".modal-backdrop").remove();
      $(".modal-open").css("overflow", "auto");
      recetas();
    },
  });
}

function eliminaReceta() {
  var id = $("#idproducto").val();
  $.ajax({
    url: "res/php/user_actions/eliminaReceta.php",
    type: "POST",
    data: { id: id },
    success: function (data) {
      $("#dataDeleteProducto").modal("hide");
      $(".modal-backdrop").remove();
      $(".modal-open").css("overflow", "auto");
      $("#ppal").css("padding-right", "0");
      recetas();
    },
  });
}

function btnEliminaReceta(id) {
  $("#dataDeleteReceta").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var producto = button.data("producto");
    var modal = $(this);
    modal.find(".modal-title").text("Eliminar Receta: " + producto);
    $("#idproducto").val(id);
  });
}

function recetas() {
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let {
    user: { usuario_id, usuario },
  } = sesion;
  let { id_ambiente, nombre, propina, fecha_auditoria, impuesto } = oPos;

  parametros = {
    id_ambiente,
    fecha_auditoria,
  };

  $.ajax({
    url: "views/recetas.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $("#pantalla").html(data);
      $("#example1").DataTable({
        paging: true,
        iDisplayLength: 25,
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
    },
  });
}

function eliminaProductoReceta() {
  var id = $("#idProductoRec").val();
  $.ajax({
    url: "res/php/user_actions/eliminaProductoReceta.php",
    type: "POST",
    data: { id: id },
    success: function () {},
  });
}

function btnEliminaProductoReceta(id) {
  $("#dataDeleteProductoReceta").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var producto = button.data("producto");
    sesion = JSON.parse(localStorage.getItem("sesion"));
    let {
      user: { usuario, usuario_id, tipo },
    } = sesion;
    // let { usuario_id } = user;

    idusr = usuario_id;
    var modal = $(this);
    modal.find(".modal-title").text(`Elimina Producto Receta : ${producto}`);

    var myTable = $("#materiaPrima");
    var rowid = myTable.find("tbody tr:eq(0)");
    $("#idProductoRec").val(id);
  });
}

function agregarFila(
  idprod,
  producto,
  cantidad,
  medida,
  valUnita,
  valTotal,
  idrece
) {
  var htmlTags = `<tr>
                    <td>${producto}</td>
                    <td align="right">${cantidad}</td>
                    <td>${medida}</td>
                    <td align="right">${number_format(valUnita, 2)}</td>
                    <td align="right">${number_format(valTotal, 2)}</td>
                    <td style="text-align: center">
                      <button 
                        id="${idprod}"
                        type="button" 
                        class="btn btn-danger btn-xs"
                        receta='${idrece}'
                        onclick="actualizaRece(this.id,this.parentNode.parentNode.rowIndex,this.receta,${idprod})">
                        <i class="glyphicon glyphicon-trash"></i>
                      </button>
                    </td>
                  </tr>`;
  $("#materiaPrima tr:last").after(htmlTags);
}

function guardarMateriaPrima() {
  var idProd = $("#productoRec").val();
  var producto = $("#productoRec option:selected").text();
  var idRece = $("#idReceta").val();
  var uniMedida = $("#idMedida").val();
  var medida = $("#medidaRec").val();
  var cantidad = $("#cantidadRec").val();
  var valUnita = $("#valorUni").val();
  var valTotal = $("#valorTot").val();

  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, usuario_id, tipo },
  } = sesion;
  // let { usuario_id, usuario } = user;

  idusr = usuario_id;

  parametros = {
    idProd,
    idRece,
    uniMedida,
    cantidad,
    usuario,
    valUnita,
    valTotal,
  };
  $.ajax({
    url: "res/php/user_actions/guardaMateriaPrima.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $("#modalAdicionaProductoReceta").modal("hide");
      agregarFila(
        idProd,
        producto,
        cantidad,
        medida,
        valUnita,
        valTotal,
        idRece
      );
      $("#btnRecetas").css("display", "block");
      $("#btnRecetas").addClass("pull-right");
      resumenReceta();
    },
  });
}

function actualizaPrecio() {
  cant = $("#cantidadRec").val();
  valUni = $("#valorUni").val();
  valUni = valUni.replaceAll(",", "");
  valTot = valUni * cant;
  $("#valorTot").val(valTot);
}

function datosProducto(id) {
  $.ajax({
    url: "res/php/user_actions/getInfoProducto.php",
    type: "POST",
    dataType: "json",
    data: { id },
    success: function (unidad) {
      let { unidad_procesa, valor_promedio, valor_conversion } = unidad;
      if (unidad_procesa == 0) {
        $("#medidaRec").val("SIN UNIDAD ASIGNADA");
      } else {
        traeUnidad(unidad_procesa);
      }
      can = $("#cantidadRec").val();
      $("#idMedida").val(unidad_procesa);
      $("#valorUni").val(number_format(valor_promedio, 2));
      $("#valorTot").val(number_format(can * valor_promedio, 2));
      $("#cantidadRec").focus();
    },
  });
}

function traeUnidad(id) {
  $.ajax({
    url: "res/php/user_actions/getTraeUnidad.php",
    type: "POST",
    data: {
      id,
    },
    success: function (data) {
      $("#medidaRec").val(data);
    },
  });
}

function saleMat() {
  $("#btnRecetas").css("display", "block");
  $("#btnRecetas").addClass("pull-right");
  $("#modalAdicionaProductoReceta").modal("hide");
}

function adicionaMateriaPrima() {
  $("#btnRecetas").css("display", "none");
  var id = $("#idReceta").val();
  var producto = $("#nomReceta").val();
  $("#modalAdicionaProductoReceta").modal("show");
  $("#cantidadRec").val(0);
  $("#valorUni").val(0);
  $("#valorTot").val(0);
  $("#productoRec").focus();

  sesion = JSON.parse(localStorage.getItem("sesion"));
  var modal = $(this);
  modal.find(".modal-title").text(`Receta Estandar : ${producto}`);

  $.ajax({
    url: "res/php/user_actions/getTraeProductos.php",
    type: "POST",
    dataType: "json",
    data: { id },
    success: function (data) {
      $("#productoRec option").remove();
      for (i = 0; i < data.length; i++) {
        $("#productoRec").append(
          `<option value="${data[i]["id_producto"]}">${data[i]["nombre_producto"]}</option>`
        );
      }
    },
  });
}

async function btnRecetaProducto(boton) {
  $("#dataRecetaProducto").modal("show");
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let { user: { usuario_id }, } = sesion;
  let receta = boton.dataset.receta;
  let subreceta = boton.dataset.subreceta;
  let id = boton.dataset.id;

  $("#nomReceta").val(receta);
  $(".modal-title").html(`Receta Estandar : ${receta}`);
  $("#idusrupd").val(usuario_id);
  $("#idReceta").val(id);
  $('#productoRec').focus()

  if (subreceta == 1) {
    btnRece = document.querySelector("#btnSubReceta");
    btnRece.classList.add("apaga");
  }

  const productos = await traeProductosRecetas(id);
  materiaPrima = document.querySelector("#materiaPrima  tbody");
  limpia = await limpiaProductosRecetasHMLT();
  await muestraProductosRecetasHML(productos);
}

async function muestraProductosRecetasHML(productos) {
  const costoReceta = document.querySelector("#costoReceta");
  let totalPromedio = 0;
  productos.map((producto) => {
    const {
      nombre_producto,
      cantidad,
      descripcion_unidad,
      valor_unitario_promedio,
      valor_promedio,
      tipoProducto,
      id,
      id_receta,
      subreceta,
    } = producto;
    totalPromedio += valor_promedio;
    const row = document.createElement("tr");
    let aviso = "";

    if (tipoProducto == 1) {
      aviso = `
      <i class="fa-solid fa-registered info" style="color:green"></i>
      `;
    }

    row.innerHTML += `
        <td>${aviso} ${nombre_producto}</td>
        <td class="derecha">${cantidad}</td>
        <td>${descripcion_unidad}</td>
        <td class="derecha">${number_format(valor_unitario_promedio, 2)}</td>
        <td class="derecha">${number_format(valor_promedio, 2)}</td>
        <td class="centro">
          <button 
          id='${id}' 
          receta='${id_receta}' 
          subreceta = '${subreceta}'
          class='btn btn-danger btn-xs elimina_articulo' onclick='actualizaRece(this.id,this.parentNode.parentNode.rowIndex,this.receta,"${id}");'><i class='glyphicon glyphicon-trash '></i></button>
        </td>`;
    materiaPrima.appendChild(row);
  });
  costoReceta.value = number_format(totalPromedio, 2);
}

async function limpiaProductosRecetasHMLT() {
  while (materiaPrima.firstChild) {
    materiaPrima.removeChild(materiaPrima.firstChild);
  }
}

async function traeProductosRecetas(id) {
  try {
    const resultado = await fetch(
      `res/php/user_actions/getRecetasProductos.php`,
      {
        method: "POST",
        headers: {
          "Content-type": "application/json; charset=UTF-8",
        },
        body: JSON.stringify({ id }),
      }
    );
    const datos = await resultado.json();
    return datos;
  } catch (error) {
    console.log(error);
  }
}

function actualizaCliente() {
  var parametros = $("#actualidarDatosCliente").serialize();
  $.ajax({
    url: "res/php/user_actions/actualizaCliente.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $(".modal-backdrop").remove();
      $(".modal-open").css("overflow", "auto");
      clientes();
    },
  });
}

function updateCliente(id) {
  $("#dataUpdateCliente").on("show.bs.modal", function (event) {
    sesion = JSON.parse(localStorage.getItem("sesion"));
    let {
      user: { usuario_id },
    } = sesion;
    $("#idusrupd").val(usuario_id);

    var button = $(event.relatedTarget);
    var cliente = button.data("cliente");
    var modal = $(this);
    modal
      .find(".modal-title")
      .html(
        `<i class="fa fa-pencil" aria-hidden="true"></i> Modificar Cliente ${cliente}`
      );

    $.ajax({
      url: "res/php/user_actions/getUpdateCliente.php",
      type: "POST",
      data: { id },
      success: function (data) {
        $("#datosCliente").html(data);
      },
    });
  });
}

function actualizaProducto() {
  var parametros = $("#actualidarDatosProducto").serialize();
  $.ajax({
    url: "res/php/user_actions/actualizaProducto.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $(".modal-backdrop").remove();
      $(".modal-open").css("overflow", "auto");
      productos();
    },
  });
}

function updateProducto(id) {
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let { id_ambiente } = oPos;
  $("#dataUpdateProducto").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var name = button.data("producto");
    var modal = $(this);
    modal.find(".modal-title").text("Modificar Producto: " + name);
    $.ajax({
      url: "res/php/user_actions/updateProducto.php",
      type: "POST",
      data: {
        id,
        id_ambiente,
      },
      success: function (data) {
        $("#traeProducto").html(data);
      },
    });
  });
}

function btnEliminaCliente(id) {
  $("#dataDeleteCliente").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var cliente = button.data("cliente");
    var modal = $(this);
    modal.find(".modal-title").text("Eliminar  Cliente: " + cliente);
    $("#mensaje").css("display", "none");
    $("#pregunta").css("display", "block");
    $("#idusrdel").val(id);
  });
}

function btnEliminaProducto(id) {
  $("#dataDeleteProducto").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var producto = button.data("producto");
    var modal = $(this);
    modal.find(".modal-title").text("Eliminar  Producto: " + producto);
    $("#idproducto").val(id);
  });
}

function generarFacturas() {
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let { id_ambiente, nombre, propina, fecha_auditoria, logo, impuesto } = oPos;

  parametros = {
    id: id_ambiente,
    amb: nombre,
    impto: impuesto,
    prop: propina,
    fecha: fecha_auditoria,
    logo,
  };

  $.ajax({
    url: "views/procesaFactura.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $("#pantalla").html(data);
    },
  });
}

function facturasPorFecha() {
  var web = $("#rutaweb").val();
  desdeFe = $("#desdeFecha").val();
  hastaFe = $("#hastaFecha").val();
  desdeNu = $("#desdeNumero").val();
  hastaNu = $("#hastaNumero").val();
  huesped = $("#desdeHuesped").val();
  formaPa = $("#desdeFormaPago").val();
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let { id_ambiente, prefijo } = oPos;

  parametros = {
    idamb: id_ambiente,
    prefijo,
    desdeFe,
    hastaFe,
    desdeNu,
    hastaNu,
    huesped,
    formaPa,
  };

  if (
    desdeFe == "" &&
    hastaFe == "" &&
    desdeNu == "" &&
    hastaNu == "" &&
    huesped == "" &&
    formaPa == ""
  ) {
    swal("Atencion", "Seleccione un Criterio de Busqueda", "warning");
  } else {
    $.ajax({
      url: "res/php/user_actions/facturasPorRango.php",
      type: "POST",
      data: parametros,
      success: function (x) {
        $(".imprimeInforme").html(x);
        $("#dataTable").DataTable({
          iDisplayLength: 25,
          paging: true,
          searching: true,
          ordering: false,
          language: {
            next: "Siguiente",
            search: "Buscar:",
            entries: "registros",
          },
        });
      },
    });
  }
}

function historicoListadoFacturas() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let {
    pos,
    user: { usuario, usuario_id, tipo },
  } = sesion;
  let { id_ambiente, nombre, propina, fecha_auditoria, logo, impuesto } = oPos;

  parametros = {
    id: id_ambiente,
    amb: nombre,
    user: usuario,
    iduser: usuario_id,
    impto: impuesto,
    prop: propina,
    fecha: fecha_auditoria,
    logo,
  };

  $.ajax({
    url: "views/facturasPorRango.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $("#pantalla").html(data);
    },
  });
}

function ventasHistoricoGrupos() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    pos,
    user: { usuario, usuario_id },
  } = sesion;
  let { id_ambiente, nombre, propina, fecha_auditoria, logo, impuesto } = oPos;
  //

  parametros = {
    id: id_ambiente,
    amb: nombre,
    user: usuario,
    iduser: usuario_id,
    impto: impuesto,
    prop: propina,
    fecha: fecha_auditoria,
    logo,
  };

  $.ajax({
    url: "views/historicoGrupos.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $("#pantalla").html(data);
    },
  });
}

function diaPlanillaDesayunos() {
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let { fecha_auditoria, prefijo } = oPos;
  file = `impresiones/planillaDesayunos_${prefijo}-${fecha_auditoria}.pdf`;

  muestraPDF(file, `Planilla Desayunos Dia ${fecha_auditoria}`);
}

function historicoPlanillaDesayunos() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    pos,
    user: { usuario, usuario_id },
  } = sesion;
  let { id_ambiente, nombre, propina, fecha_auditoria, logo, impuesto } = oPos;

  parametros = {
    id_ambiente,
    nombre,
    usuario,
    usuario_id,
    impuesto,
    propina,
    fecha_auditoria,
    logo,
  };

  $.ajax({
    url: "views/historicoDesayunos.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $("#pantalla").html(data);
    },
  });
}

function historicoDesayunos() {
  ambiente = $("#ambiente").val();
  desdeFe = $("#desdeFecha").val();
  hastaFe = $("#hastaFecha").val();
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    pos,
    user: { usuario, usuario_id, tipo },
  } = sesion;
  let { nombre, id_ambiente, logo, prefijo, id_bodega } = oPos;

  if (ambiente == "" || desdeFe == "" || hastaFe == "") {
    swal({
      title: "Atencion",
      text: "Todos los Campos Son Obligatorios",
      type: "warning",
    });
    return false;
  }

  parametros = {
    ambiente,
    desdeFe,
    hastaFe,
  };

  if (desdeFe == "" && hastaFe == "") {
    swal("Atencion", "Seleccione un Criterio de Fechas", "warning");
  } else {
    $.ajax({
      url: "res/php/user_actions/traeHistoricoDesayunos.php",
      type: "POST",
      dataType: "json",
      data: parametros,
      success: function (datos) {
        console.log(datos);
        llenaHistoricoDesayunos(datos);
      },
    });
  }
}

function muestraDesayuno(fecha, id, pref) {
  file = `impresiones/planillaDesayunos_${pref}-${fecha}.pdf`;

  muestraPDFHist(file, `Planilla Desayunos del Dia ${fecha}`);
}

function muestraPDFHist(file, titulo) {
  document.querySelector("#muestraDesayunos .tituloPagina").innerHTML = titulo;
  document.querySelector("#verDesayuno").data = file;
}

function llenaHistoricoDesayunos(datos) {
  pantDesa = document.querySelector("#dataDesayunos");
  pantDesa.classList.remove("apaga");
  dataDesa = document.querySelector("#dataDesayunos tbody");
  let html = "";
  datos.forEach((dato) => {
    let { fecha, cantidad, id_ambiente, prefijo } = dato;
    html += `
    <tr>
      <td style="font-size:13px;">${fecha}</td>
      <td class="centro" style="font-size:13px;">${cantidad}</td>
      <td class="centro">
        <button class="btn btn-warning" onclick="muestraDesayuno('${fecha}',${id_ambiente}, '${prefijo}')">
          <i class="fa-solid fa-print"></i>
        </button>
      </td>
    </tr>
    `;
  });
  dataDesa.innerHTML = html;
}

function ventasHistoricoProductos() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    pos,
    user: { usuario, usuario_id },
  } = sesion;
  let { id_ambiente, nombre, propina, fecha_auditoria, logo, impuesto } = oPos;

  parametros = {
    id_ambiente,
    nombre,
    usuario,
    fecha_auditoria,
  };

  $.ajax({
    url: "views/historicoProductos.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $("#pantalla").html(data);
    },
  });
}

function ventasHistoricoPeriodos() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    pos,
    user: { usuario, usuario_id },
  } = sesion;
  let { id_ambiente, nombre, propina, fecha_auditoria, logo, impuesto } = oPos;

  parametros = {
    id: id_ambiente,
    amb: nombre,
    user: usuario,
    iduser: usuario_id,
    impto: impuesto,
    prop: propina,
    fecha: fecha_auditoria,
    logo,
  };

  $.ajax({
    url: "views/periodoServicio.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $("#pantalla").html(data);
    },
  });
}

function buscarRecu() {
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let { id_ambiente } = oPos;
  let valorBusqueda = $("input#busqueda").val();
  if (textoBusqueda != "") {
    $.post(
      "res/php/user_actions/getBuscaProductoRecu.php",
      {
        id: id_ambiente,
        valorBusqueda,
      },
      function (mensaje) {
        $("#productoList").html(mensaje);
      }
    );
  } else {
    $("#ventasAdicionales").html("");
  }
}

function sumaValorProductos() {
  var totalventa = 0;
  var totaladi = 0;
  $("#productoVendidos > tbody > tr").each(function () {
    var valor = $("#valorProd", this).html();
    valor = valor.replaceAll("$", "");
    valor = valor.replaceAll(".", "");
    totalventa = totalventa + valor;
  });
  $("#ventasAdicionales > tbody > tr").each(function () {
    var valoradi = $("#valorAdi", this).html();
    valoradi = valoradi.replaceAll("$", "");
    valoradi = valoradi.replaceAll(".", "");
    totaladi = totaladi + valor;
  });

  totalgen = totaladi + totalventa;
}

function getRestarVentasRecu(codigo) {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    pos,
    user: { usuario, usuario_id, tipo },
  } = sesion;
  let { id_ambiente, propina } = oPos;

  idamb = id_ambiente;
  impto = impuesto;
  prop = propina;
  var parametros = {
    codigo,
    idamb,
    impto,
    prop,
    user,
  };
  $("#loader").fadeIn("slow");
  $.ajax({
    type: "POST",
    url: "res/php/user_actions/getRestarVentasRecu.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#ventasAdicionales").html("<img src='../img/loader.gif'>");
    },
    success: function (data) {
      $("#ventasList").html("");
      $("#ventasAdicionales").html(data);
    },
  });
}

function getBorraVentasRecu(codigo) {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    pos,
    user: { usuario, usuario_id, tipo },
  } = sesion;
  let { id_ambiente, propina } = oPos;

  idamb = id_ambiente;
  impto = impuesto;
  prop = propina;

  var parametros = {
    codigo,
    idamb,
    impto,
    prop,
    user,
  };
  $("#loader").fadeIn("slow");
  $.ajax({
    type: "POST",
    url: "res/php/user_actions/getBorraVentas.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#ventasAdicionales").html("<img src='../img/loader.gif'>");
    },
    success: function (data) {
      $("#ventasAdicionales").html(data);
    },
  });
}

function getVentasRecu(codigo) {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    pos,
    user: { usuario },
  } = sesion;
  let { id_ambiente, propina } = oPos;

  idamb = id_ambiente;
  impto = impuesto;
  // user:  { usuario, usuario_id, tipo }= usuario;
  prop = propina;

  var parametros = {
    codigo,
    idamb,
    impto,
    prop,
    usuario,
  };
  $("#loader").fadeIn("slow");
  $.ajax({
    type: "POST",
    url: "res/php/user_actions/getVentasRecu.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#ventasList").html("<img src='../img/loader.gif'>");
    },
    success: function (data) {
      $("#ventasAdicionales").html(data);
    },
  });
}

function getProductoRecu(codigo, ambi) {
  var parametros = {
    codigo,
    ambi,
  };
  $("#loader").fadeIn("slow");
  $.ajax({
    type: "POST",
    url: "res/php/user_actions/getProductoRecu.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#productoList").html("<img src='../img/loader.gif'>");
    },
    success: function (data) {
      $("#productoList").html(data);
    },
  });
}

function getSeccionesRecu() {
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let { id_ambiente } = oPos;
  $("#loader").fadeIn("slow");
  $.ajax({
    type: "POST",
    url: "res/php/user_actions/getSeccionRecu.php",
    data: {
      id_ambiente,
    },
    beforeSend: function (objeto) {
      $("#loader").html("<img src='../img/loader.gif'>");
    },
    success: function (data) {
      $("#seccionList").html(data);
    },
  });
}

function productos() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let {
    pos,
    user: { usuario, usuario_id },
  } = sesion;
  let { id_ambiente, nombre, propina, fecha_auditoria, impuesto } = oPos;

  parametros = {
    id: id_ambiente,
    amb: nombre,
    user: usuario,
    iduser: usuario_id,
    impto: impuesto,
    prop: propina,
    fecha: fecha_auditoria,
  };

  $.ajax({
    url: "views/productos.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $("#pantalla").html(data);
      $("#example1").DataTable({
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
    },
  });
}

function clientes() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let {
    pos,
    user: { usuario, usuario_id },
  } = sesion;
  let { id_ambiente, nombre, propina, fecha_auditoria, impuesto } = oPos;

  parametros = {
    id: id_ambiente,
    amb: nombre,
    user: usuario,
    iduser: usuario_id,
    impto: impuesto,
    prop: propina,
    fecha: fecha_auditoria,
  };

  $.ajax({
    url: "views/clientes.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $("#pantalla").html(data);
      $("#example1").DataTable({
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
    },
  });
}

function recuperarCuenta() {
  $("#recuperarComanda").val(1);
  $("#listaComandas").css("display", "none");
  // $("#Escritorio").css("margin-left", "0");
  $("#productoList").css("display", "block");
  $("#guardaCuenta").css("display", "block");
  $("#recuperaCuenta").css("display", "none");
  $(".btnActivo").css("display", "none");
  // $("#regresarComanda").css("margin-top", "336px");
  // $("#productosComanda").css("height", "422px");

  $("#seccionList").css("display", "block");
  $("#tituloComanda").removeClass("col-lg-12");
  $("#tituloComanda").addClass("col-lg-5");
  $("#tituloBusca").css("display", "block");

  $("#ventasList").removeClass("col-lg-6 col-md-6");
  $("#ventasList").addClass("col-lg-5 col-md-5");
  $("#muestraNumero").addClass("col-lg-5 col-md-5 col-xs-12");
  $("#muestraNumero2").addClass("col-lg-12 col-md-12 col-xs-12");
  $("#muestraComanda").removeClass("col-lg-6 col-md-6");
  $("#muestraComanda").addClass("col-lg-7 col-md-7");
  $("#tituloComanda").html(
    "<h4 style='padding:2px;text-align: center;font-weight: bold;margin:0'>Tipo de Producto</h4>"
  );

  idamb = $("#idAmbiente").val();
  getSecciones();
  cuenta = $("#numeroComanda").val();
  sesion = JSON.parse(localStorage.getItem("sesion"));
}

function muestraPos(ambienteSel) {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    user: { tipo, apellidos, nombres },
    pos,
  } = sesion;
  let { plano, fecha_auditoria } = oPos;
  $("#fechaPos").html(`Fecha Proceso ${fecha_auditoria}`);
  $("#fechaAuditoria").val(fecha_auditoria);

  $.ajax({
    url: "res/php/user_actions/muestraPos.php",
    type: "POST",
    data: {
      ambienteSel,
      tipo,
    },
    success: function (data) {
      $("#pantalla").html(data);
      setTimeout(function () {
        if (plano == 1) {
          mesasActivasPlano();
        }
      }, 500);
    },
  });
}

function traeAmbientes(id) {
  $.ajax({
    url: "res/php/user_actions/traeAmbientes.php",
    type: "POST",
    succes: function (data) {
      $("#ambientes").html(data);
    },
  });
}

function ventasGrupos() {
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let { id_ambiente, nombre, fecha_auditoria, logo } = oPos;

  parametros = {
    id_ambiente,
    nombre,
    fecha_auditoria,
    logo,
  };

  $.ajax({
    url: "imprimir/imprimeVentasPorGrupo.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      creaHTMLReportes(data, `Ventas Por Grupo de Producto`);
    },
  });
}

function ventasPorPeriodo() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    pos,
    user: { usuario, usuario_id },
  } = sesion;
  let { id_ambiente, nombre, propina, fecha_auditoria, logo, impuesto } = oPos;

  parametros = {
    id_ambiente,
    nombre,
    usuario,
    usuario_id,
    impuesto,
    propina,
    fecha_auditoria,
    logo,
  };

  $.ajax({
    url: "imprimir/imprimeVentasPorPeriodo.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      creaHTMLReportes(data, `Ventas Por Peridodo de Servicio `);
    },
  });
}

function buscaReportesCajero() {
  let { prefijo } = oPos;
  var fecha = $("#buscarFecha").val();
  let usuario = document.querySelector("#usuario").value;
  $("#verFactura").attr("data", "");
  var repo = `cierre_Cajero_${usuario}-${prefijo}_${fecha}.pdf`;
  $("#verFactura").attr("data", "imprimir/cierres/" + repo);
}

function historicoCajeros() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    pos,
    user: { usuario, usuario_id },
  } = sesion;
  let {
    id_ambiente,
    nombre,
    propina,
    fecha_auditoria,
    logo,
    impuesto,
    prefijo,
  } = oPos;

  parametros = {
    id: id_ambiente,
    amb: nombre,
    user: usuario,
    iduser: usuario_id,
    impto: impuesto,
    prop: propina,
    fecha: fecha_auditoria,
    prefijo,
  };

  $.ajax({
    url: "informes/historicoCajeros.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $("#pantalla").html(data);
    },
  });
}

function verfactura(fact) {
  $("#verFactura").attr("data", "impresiones/" + fact + ".pdf");
}

function buscaFacturasFecha() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let { id_ambiente } = oPos;

  var fechafac = $("#buscarFecha").val();
  var parametros = {
    idamb: id_ambiente,
    fechafac,
  };
  $("#verFactura").attr("data", "");
  $.ajax({
    url: "res/php/buscaFacturasFecha.php",
    type: "POST",
    data: parametros,
    success: function (datos) {
      $("#muestraResultado").html(datos);
    },
  });
}

function historicoFacturas() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let {
    pos,
    user: { usuario, usuario_id },
  } = sesion;
  let { id_ambiente, nombre, propina, fecha_auditoria, logo, impuesto } = oPos;

  parametros = {
    id: id_ambiente,
    amb: nombre,
    user: usuario,
    iduser: usuario_id,
    impto: impuesto,
    prop: propina,
    fecha: fecha_auditoria,
  };

  $.ajax({
    url: "informes/historicoFacturas.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $("#pantalla").html(data);
    },
  });
}

function ventasUsuario() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let {
    pos,
    user: { usuario, usuario_id },
  } = sesion;
  let { id_ambiente, nombre, propina, fecha_auditoria, logo, impuesto } = oPos;
  file = makeid(12);

  parametros = {
    id: id_ambiente,
    amb: nombre,
    user: usuario,
    iduser: usuario_id,
    impto: impuesto,
    prop: propina,
    fecha: fecha_auditoria,
    logo,
    file,
  };

  $.ajax({
    url: "informes/ventasUsuario.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $("#pantalla").html(data);
      $("#verInforme").attr(
        "data",
        "imprimir/informes/ventasdelDiaUsuario_" + usuario + ".pdf"
      );
    },
  });
}

function ventasFormaPago() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    pos,
    user: { usuario, usuario_id },
  } = sesion;
  let { id_ambiente, nombre, propina, fecha_auditoria, logo, impuesto } = oPos;

  parametros = {
    id_ambiente,
    nombre,
    usuario,
    usuario_id,
    impuesto,
    propina,
    fecha_auditoria,
    logo,
  };

  $.ajax({
    url: "imprimir/imprimeVentasFormadePago.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      creaHTMLReportes(data, `Ventas Por Forma de Pago`);
    },
  });
}

function ventasHistoricoFormaPago() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    pos,
    user: { usuario, usuario_id },
  } = sesion;
  let { id_ambiente, nombre, propina, fecha_auditoria, logo, impuesto } = oPos;
  file = makeid(12);

  parametros = {
    id: id_ambiente,
    amb: nombre,
    user: usuario,
    iduser: usuario_id,
    impto: impuesto,
    prop: propina,
    fecha: fecha_auditoria,
    logo,
    file,
  };

  $.ajax({
    url: "views/historicoFormasPago.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $("#pantalla").html(data);
    },
  });
}

function ventasProducto() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let { id_ambiente, nombre, fecha_auditoria, logo } = oPos;

  parametros = {
    id_ambiente,
    nombre,
    fecha_auditoria,
    logo,
  };

  $.ajax({
    url: "imprimir/imprimeVentasPorProducto.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      creaHTMLReportes(data, `Ventas Por Producto`);
    },
  });
}

function ventasDiaAuditoria() {
  let sesion = JSON.parse(localStorage.getItem("sesion"));
  let oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    user: { usuario, usuario_id },
  } = sesion;
  let { id_ambiente, nombre, propina, fecha_auditoria, logo, impuesto } = oPos;

  parametros = {
    id_ambiente,
    nombre,
    usuario,
    usuario_id,
    fecha_auditoria,
    logo,
  };

  $.ajax({
    url: "imprimir/imprimeVentasDia.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      creaHTMLReportes(data, `Ventas del Dia`);
    },
  });
}

function kardexInventario() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let { id_bodega, descripcion_bodega } = oPos;

  parametros = {
    descripcion_bodega,
    id_bodega,
  };

  $.ajax({
    url: "views/kardex.php",
    type: "POST",
    datatype: "json",
    data: parametros,
    success: function (data) {
      $("#pantalla").removeClass("pd0");
      $("#pantalla").addClass("pd10");
      $("#pantalla").html(data);
      $("#tablaKardex").DataTable({
        paging: true,
        iDisplayLength: 25,
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
    },
  });
}

function huespedesenCasa() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    user: { usuario, usuario_id },
  } = sesion;
  let { id_ambiente, nombre, propina, fecha_auditoria, impuesto } = oPos;

  parametros = {
    id_ambiente,
    nombre,
    usuario,
    usuario_id,
    impuesto,
    propina,
    fecha_auditoria,
  };

  $.ajax({
    url: "views/huespedesCasa.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $("#pantalla").html(data);
      $("#example1").DataTable({
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
    },
  });
}

async function planillaDesayunos() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let {
    pos,
    user: { usuario, usuario_id },
    moduloPms: { fecha_auditoria },
  } = sesion;
  let { id_ambiente, prefijo, fecha_auditoria: fechaAuditoriaPOS } = oPos;
  parametros = {
    id_ambiente,
    fecha_auditoria,
  };

  let total = await totalDesayunos(parametros);

  if (total > 0) {
    swal(
      {
        title: "Precaucion",
        text: "Planilla de Desayunos ya Procesada",
        type: "warning",
      },
      function () {
        data = `impresiones/planillaDesayunos_${prefijo}-${fecha_auditoria}.pdf`;
        verPDF(data, `Planilla Desayunos ${fecha_auditoria}`);
        // enviaInicio()
      }
    );
  } else {
    let planilla = localStorage.getItem("planilla");
    let huespedes;
    if (!planilla) {
      huespedes = await traeHuespedesDesayuno();
      localStorage.setItem("planilla", JSON.stringify(huespedes));
    } else {
      huespedes = JSON.parse(localStorage.getItem("planilla"));
    }
    llenaHtml = await llenaHTML(huespedes, fechaAuditoriaPOS);
    document.querySelector("#pantalla").innerHTML = llenaHtml;
  }
}

async function cambiaEstado(indice, check) {
  let huespedes = JSON.parse(localStorage.getItem("planilla"));
  huespedes[indice].estado = check ? 1 : 0;
  localStorage.setItem("planilla", JSON.stringify(huespedes));
}

async function llenaHTML(huespedes, fecha) {
  try {
    const resp = await fetch(`views/planillaDesayunos.php`, {
      method: "POST",
      body: JSON.stringify({ huespedes, fecha }),
    });
    const datos = await resp.text();
    return datos;
  } catch (error) {
    return error;
  }
}

async function totalDesayunos(parametros) {
  try {
    const resp = await fetch(`res/php/user_actions/totalDesayunos.php`, {
      method: "POST",
      body: JSON.stringify(parametros),
    });
    const datos = await resp.json();
    return datos;
  } catch (error) {
    return error;
  }
}

async function traeHuespedesDesayuno() {
  try {
    const resultado = await fetch(
      `res/php/user_actions/datosHuespedesDesayuno.php`,
      {
        method: "get",
      }
    );
    const datos = await resultado.json();
    return datos;
  } catch (error) {
    return error;
  }
}

async function guardaPlanillaDesayunos() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    user: { usuario },
    moduloPms: { fecha_auditoria },
  } = sesion;
  let { logo, nombre, prefijo } = oPos;
  let resp = await preguntaGuardaPlanilla();
  if (resp) {
    let huespedes = JSON.parse(localStorage.getItem("planilla"));
    envia = { huespedes, fecha_auditoria, logo, nombre, usuario, prefijo };
    let regi = await guardaPlanilla(envia);
    let impr = await imprimePlanilla(envia);
    var planilla = `imprimir/${impr}`;
    var ventana = window.open(planilla, "PRINT", "height=600,width=600");
    localStorage.removeItem("planilla");
    enviaInicio();
  } else {
    swal(
      {
        title: "Planilla no Guardada",
        text: `No se ha guardado la planilla de desayunos \n Necesita escribir "Aceptar"`,
        type: "warning",
      },
      function () {}
    );
  }
}

async function guardaPlanilla(envia) {
  try {
    const resp = await fetch(
      `res/php/user_actions/guardaPlanillaDesayunos.php`,
      {
        method: "POST",
        body: JSON.stringify(envia),
      }
    );
    const datos = await resp.json();
    return datos;
  } catch (error) {
    return error;
  }
}

async function imprimePlanilla(envia) {
  try {
    const resp = await fetch(`imprimir/imprimePlanillaDesayunos.php`, {
      method: "POST",
      body: JSON.stringify(envia),
    });
    const datos = await resp.text();
    return datos.trim();
  } catch (error) {
    return error;
  }
}

async function preguntaGuardaPlanilla() {
  return new Promise((resolve) => {
    swal(
      {
        icon: "warning",
        title: "Desea Guardar la Planilla de Desayunos",
        text: "Este proceso Almacenara la Informacion y no se podra adicionar mas desayunos en el dia \nDigita Aceptar para guardar la Planilla",
        type: "input",
        showCancelButton: true,
        closeOnConfirm: true,
        animation: "slide-from-top",
        inputPlaceholder: "Digita Aceptar",
      },
      function (inputValue) {
        if (inputValue === false) {
          return resolve(false);
        }
        if (inputValue === "") {
          swal.showInputError(`Necesita escribir "Aceptar" !`);
          return resolve(false);
        }
        if (inputValue !== "Aceptar") {
          swal.showInputError(`Necesita escribir "Aceptar" !`);
          return resolve(false);
        } else {
          return resolve(true);
        }
      }
    );
  });
}

function cierreDiarioAuditoria() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    pos,
    user: { usuario, usuario_id },
  } = sesion;
  let {
    id_ambiente,
    nombre,
    propina,
    fecha_auditoria,
    logo,
    prefijo,
    impuesto,
  } = oPos;

  parametros = {
    id: id_ambiente,
    amb: nombre,
    user: usuario,
    iduser: usuario_id,
    impto: impuesto,
    prop: propina,
    fecha: fecha_auditoria,
    logo,
    prefijo,
  };

  $.ajax({
    url: "views/cierreDiario.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $("#pantalla").html(data);
    },
  });
}

function cuentasAnuladasAuditoriaOld() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    user: { usuario, usuario_id, tipo },
  } = sesion;
  let { id_ambiente, nombre, propina, fecha_auditoria, impuesto } = oPos;

  parametros = {
    id_ambiente,
    nombre,
    usuario,
    usuario_id,
    tipo,
    impuesto,
    propina,
    fecha_auditoria,
    logo,
  };

  $.ajax({
    url: "informes/cuentasAnuladasAuditoria.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      creaHTMLReportes(data, `Comandas Activas`);
    },
  });
}

function cuentasActivasAuditoria() {
  let { id_ambiente, nombre, impuesto, propina, fecha_auditoria, logo } = oPos;

  parametros = {
    id_ambiente,
    nombre,
    usuario,
    usuario_id,
    tipo,
    impuesto,
    propina,
    fecha_auditoria,
    logo,
  };

  $.ajax({
    url: "imprimir/imprimeCuentasActivas.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      creaHTMLReportes(data, `Comandas Activas del Dia`);
    },
  });
}

function cuentasAnuladasAuditoria() {
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let { id_ambiente, nombre, fecha_auditoria, logo } = oPos;

  parametros = {
    id_ambiente,
    nombre,
    fecha_auditoria,
    logo,
  };

  $.ajax({
    url: "imprimir/imprimeCuentasAnuladas.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      creaHTMLReportes(data, `Comandas Anuladas del Dia`);
    },
  });
}

function historicoAuditorias() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    pos,
    user: { usuario, usuario_id, tipo },
  } = sesion;
  let { id_ambiente, nombre, impuesto, propina, fecha_auditoria } = oPos;

  parametros = {
    idamb: id_ambiente,
    amb: nombre,
    user: usuario,
    iduser: usuario_id,
    impto: impuesto,
    prop: propina,
    fecha: fecha_auditoria,
  };

  $.ajax({
    url: "ventas/historicoAuditorias.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $("#pantalla").html(data);
    },
  });
}

function cierreDiarioCajero() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    pos,
    user: { usuario, usuario_id, tipo },
  } = sesion;
  let {
    id_ambiente,
    nombre,
    impuesto,
    propina,
    fecha_auditoria,
    id_bodega,
    logo,
    prefijo,
  } = oPos;

  parametros = {
    id: id_ambiente,
    amb: nombre,
    user: usuario,
    iduser: usuario_id,
    impto: impuesto,
    prop: propina,
    fecha: fecha_auditoria,
    prefijo,
  };

  $.ajax({
    url: "imprimir/cierre_cajero.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $("#pantalla").html(data);
    },
  });
}

function facturasAnuladasCajero() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    pos,
    user: { usuario, usuario_id, tipo },
  } = sesion;
  let { id_ambiente, nombre, propina, fecha_auditoria, logo, impuesto } = oPos;

  parametros = {
    id_ambiente,
    nombre,
    usuario,
    usuario_id,
    fecha_auditoria,
    logo,
  };

  $.ajax({
    url: "imprimir/imprimeFacturasAnuladasCajero.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      creaHTMLReportes(data, `Facturas Anuladas Cajero  ${usuario}`);
    },
  });
}

function abonosCajero() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    pos,
    user: { usuario, usuario_id, tipo },
  } = sesion;
  let { id_ambiente, nombre, propina, fecha_auditoria, logo, impuesto } = oPos;

  parametros = {
    id: id_ambiente,
    amb: nombre,
    user: usuario,
    iduser: usuario_id,
    impto: impuesto,
    prop: propina,
    fecha: fecha_auditoria,
    logo,
  };

  $.ajax({
    url: "informes/abonosCajero.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      creaHTMLReportes(data, `Abonos Cajero  ${usuario}`);
    },
  });
}

function facturasCajero() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    user: { usuario, usuario_id },
  } = sesion;
  let { id_ambiente, nombre, fecha_auditoria, logo } = oPos;

  parametros = {
    id_ambiente,
    nombre,
    usuario,
    usuario_id,
    fecha_auditoria,
    logo,
  };

  $.ajax({
    url: "imprimir/imprimeFacturasCajero.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      creaHTMLReportes(data, `Facturas del Dia Cajero ${usuario}`);
    },
  });
}

function devolucionesCajero() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    user: { usuario, usuario_id },
  } = sesion;
  let { id_ambiente, nombre, fecha_auditoria, logo } = oPos;

  parametros = {
    id_ambiente,
    nombre,
    usuario,
    usuario_id,
    fecha_auditoria,
    logo,
  };

  $.ajax({
    url: "imprimir/imprimeDevolucionesCajero.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      creaHTMLReportes(data, `Devolucion Producto del Dia Cajero ${usuario}`);
    },
  });
}

function balanceDiarioGeneral() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    pos,
    user: { usuario, usuario_id, tipo },
  } = sesion;
  let { id_ambiente, nombre, propina, fecha_auditoria, logo, impuesto } = oPos;
  let file = makeid(12);

  parametros = {
    idamb: id_ambiente,
    amb: nombre,
    user: usuario,
    iduser: usuario_id,
    impto: impuesto,
    prop: propina,
    fecha: fecha_auditoria,
    logo,
    file,
  };

  $.ajax({
    url: "informes/balanceDiarioGeneral.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $("#pantalla").html(data);
      $("#verInforme").attr(
        "data",
        "imprimir/informes/balance_Diario_" + oKey + ".pdf"
      );
    },
  });
}

function balanceDiarioCajero() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    pos,
    user: { usuario, usuario_id, tipo },
  } = sesion;
  let { id_ambiente, nombre, propina, fecha_auditoria, logo, impuesto } = oPos;

  parametros = {
    id: id_ambiente,
    amb: nombre,
    user: usuario,
    iduser: usuario_id,
    impto: impuesto,
    prop: propina,
    fecha: fecha_auditoria,
    logo,
  };

  $.ajax({
    url: "informes/balanceDiarioCajero.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      creaHTMLReportes(data, `Balance del Dia Cajero ${usuario}`);
    },
  });
}

function cuentasAnuladasCajero() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    user: { usuario, usuario_id },
  } = sesion;
  let { id_ambiente, nombre, propina, fecha_auditoria, logo, impuesto } = oPos;

  parametros = {
    id_ambiente,
    nombre,
    usuario,
    usuario_id,
    impuesto,
    propina,
    fecha_auditoria,
    logo,
  };
  $.ajax({
    url: "imprimir/imprimeCuentasAnuladasCajero.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      creaHTMLReportes(data, `Comandas Anuladas Cajero ${usuario}`);
    },
  });
}

function cuentasActivasCajero() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    user: { usuario, usuario_id },
  } = sesion;
  let { id_ambiente, nombre, fecha_auditoria, logo } = oPos;

  parametros = {
    id_ambiente,
    nombre,
    usuario,
    usuario_id,
    fecha_auditoria,
    logo,
  };

  $.ajax({
    url: "imprimir/imprimeCuentasActivasCajero.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      creaHTMLReportes(data, `Comandas Activas Cajero ${usuario}`);
    },
  });
}

function verPDF(data, titulo) {
  $("#pantalla").html("");
  $("#pantalla").html(`
  <section class="content">
      <div class="panel panel-success">
        <div class="panel-heading"> 
          <div class="row">
            <div class="col-lg-9">
              <input type="hidden" name="user" id="user" value="">
              <input type="hidden" name="rutaweb" id="rutaweb" value="<?php echo BASE_POS; ?>">
              <input type="hidden" name="nombreAmbiente" id="nombreAmbiente" value="">
              <input type="hidden" name="ubicacion" id="ubicacion" value="cuentasActivasCajero.php">
              <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-industry"></i> ${titulo} <?php echo $usuario; ?></h3>
            </div>
          </div>
        <div class="panel-body">
          <div class="divInforme">
              <object type="application/pdf" id="verInforme" width="100%" height="500" data="${data}"></object> 
          </div>
        </div>
      </div> 
    </section>
  `);
}

function muestraPDF(file, titulo) {
  $("#pantalla").html("");
  $("#pantalla").html(`
  <section class="content">
      <div class="panel panel-success">
        <div class="panel-heading"> 
          <div class="row">
            <div class="col-lg-9">
              <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-industry"></i> ${titulo} </h3>
            </div>
          </div>
        <div class="panel-body">
          <div class="divInforme">
            <object type="application/pdf" id="verInforme" width="100%" height="500" data="${file}"></object>
          </div>
        </div>
      </div> 
    </section>
  `);
}

function creaHTMLReportes(data, titulo) {
  $("#pantalla").html("");
  $("#pantalla").removeClass("pd0");
  $("#pantalla").addClass("pd10");
  $("#pantalla").html(`
    <section class="content">
      <div class="panel panel-success">
        <div class="panel-heading"> 
          <div class="row">
            <div class="col-lg-6">
              <input type="hidden" name="user" id="user" value="">
              <input type="hidden" name="rutaweb" id="rutaweb" value="<?php echo BASE_POS; ?>">
              <input type="hidden" name="nombreAmbiente" id="nombreAmbiente" value="">
              <input type="hidden" name="ubicacion" id="ubicacion" value="cuentasActivasCajero.php">
              <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-industry"></i> ${titulo}</h3>
            </div> 
          </div>
        </div>
        <div class="panel-body">
          <div class="divInforme">
            <object type="application/pdf" id="verInforme" width="100%" height="500" data="data:application/pdf;base64,${$.trim(
              data
            )}"></object>
          </div>
        </div>
      </div>
    </section>
  `);
}

function ventasDia() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    pos,
    user: { usuario, usuario_id, tipo },
  } = sesion;
  let { id_ambiente, nombre, propina, fecha_auditoria, impuesto, logo } = oPos;
  let file = makeid(12);

  parametros = {
    id: id_ambiente,
    amb: nombre,
    user: usuario,
    impto: impuesto,
    prop: propina,
  };
  $.ajax({
    url: "ventas/ventas_dia.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $(".pantalla").html(data);
    },
  });
}

async function cuentasActivas() {
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    id_ambiente,
    nombre,
    impuesto,
    propina,
    fecha_auditoria,
    prefijo,
    logo,
  } = oPos;

  $(".btn-menu").css("display", "block");

  let cuentas = await traeCuentasAmbiente(id_ambiente);
  parametros = {
    id_ambiente,
    nombre,
    usuario,
    tipo,
    impto: impuesto,
    prop: propina,
    fecha_auditoria,
    prefijo,
  };
  let llena = await llenaCuentas(parametros);
  let panta = document.querySelector("#pantalla");
  let prs = document.querySelectorAll(".prende");
  panta.innerHTML = llena;
  const nuevaAltura = window.innerHeight;
  comanda = await getCuentasActivas(id_ambiente);
  let pc = document.querySelector("#productosComanda");
  let lc = document.querySelector("#listaComandas");
  let bg = document.querySelector(".btn-group-vertical");
  let pl = document.querySelector("#productoList");

  pc.style.height = `${nuevaAltura - 160}px`;
  lc.style.height = `${nuevaAltura - 160}px`;
  bg.style.height = `${nuevaAltura - 138}px`;
  pl.style.height = `${nuevaAltura - 138}px`;
  botones = document.querySelectorAll(".apagado");
  ocultarBotones(botones, "display", 0);
}

async function traeCuentasAmbiente(id_ambiente) {
  console.log({ usuario, usuario_id, tipo });
  try {
    const response = await fetch(`res/php/user_actions/cuentasActivas.php`, {
      method: "POST",
      headers: {
        "Content-type": "application/json",
      },
      body: JSON.stringify({ id_ambiente }),
    });
    const datos = await response.json();
    return datos;
  } catch (error) {
    return error;
  }
}

function ocultarBotones(elementos, metodo = "display", tipo) {
  // Verificamos si hay elementos para ocultar
  if (!elementos || elementos.length === 0) {
    console.warn("No se encontraron elementos para ocultar.");
    return;
  }

  // Iteramos sobre cada elemento en la lista
  elementos.forEach((boton) => {
    switch (metodo) {
      case "display":
        // Método 1: Ocultar usando 'display: none'. Esto elimina el botón del flujo del documento.
        if (tipo == 0) {
          boton.style.display = "none";
        } else {
          boton.style.display = "block";
        }
        break;
      case "visibility":
        // Método 2: Ocultar usando 'visibility: hidden'. El botón no es visible, pero ocupa su espacio.
        boton.style.visibility = "hidden";
        break;
      case "clase":
        // Método 3: Ocultar agregando una clase CSS. Es la mejor práctica para la separación de preocupaciones.
        boton.classList.add("oculto");
        break;
      default:
        console.error("Método de ocultamiento no válido.");
        break;
    }
  });
}

async function llenaCuentas(parametros) {
  try {
    const response = await fetch(`ventas/cuentas_activas.php`, {
      method: "POST",
      headers: {
        "Content-type": "application/json",
      },
      body: JSON.stringify(parametros),
    });
    const datos = await response.text();
    return datos;
  } catch (error) {
    return error;
  }
}

async function muestraTouch() {
  var alto = screen.height;
  var ancho = screen.width;
  let abonos = 0;
  let propina = 0;
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let {
    pos,
    user: { usuario, usuario_id, tipo },
  } = sesion;
  let { id_ambiente, nombre, prefijo, fecha_auditoria, impuesto } = oPos;
  $("#btnGuardar").attr("disabled", "enabled");

  parametros = {
    id: id_ambiente,
    amb: nombre,
    user: usuario,
    impto: impuesto,
    prop: propina,
    prefijo,
    fecha: fecha_auditoria,
  };

  $.ajax({
    url: "ventas/touch.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      storageProd = localStorage.getItem("productoComanda");
      if (storageProd === null) {
        listaComanda = [];
      } else {
        listaComanda = JSON.parse(storageProd);
        abonos = 0;
        descuento = listaComanda.reduce(
          (totdes, comanda) => totdes + comanda.descuento,
          0
        );
        productosActivos();
        resumenComanda();
      }
      getSecciones();
      $("#pantalla").html("");
      $("#pantalla").html(data);
      prod = document.querySelector("#productosComanda");
      btntool = document.querySelector(".btn-toolbar");
      group = document.querySelector(".btn-group-vertical");
      pl = document.querySelector("#productoList");
      sl = document.querySelector("#seccionList");
      vl = document.querySelector("#ventasList");

      const nuevaAltura = window.innerHeight;
      pl.style.height = `${nuevaAltura - 138}px`;
      sl.style.height = `${nuevaAltura - 138}px`;
      vl.style.height = `${nuevaAltura - 138}px`;
      btntool.style.height = `${nuevaAltura - 137}px`;
      group.style.height = `${nuevaAltura - 135}px`;
      prod.style.height = `${nuevaAltura - 183}px`;
    },
  });
}

function calcular_total() {
  var coma = $("#numeroComanda").val();
  miBoton = "#comanda" + coma;
  let storageProd = localStorage.getItem("productoComanda");
  let listaComanda;
  storageProd == null
    ? (listaComanda = [])
    : (listaComanda = JSON.parse(storageProd));

  canti = listaComanda.reduce(
    (canti, comanda) => canti + parseFloat(comanda.cant),
    0
  );
  subtotal = listaComanda.reduce(
    (ventas, comanda) => ventas + parseFloat(comanda.venta),
    0
  );
  impuesto = listaComanda.reduce(
    (impuesto, comanda) => impuesto + parseFloat(comanda.valorimpto),
    0
  );
  total = listaComanda.reduce(
    (totalCta, comanda) => totalCta + parseFloat(comanda.total),
    0
  );

  propina = parseFloat($("#propinaPag").val().replaceAll(",", ""));
  roomser = parseFloat(document.querySelector("#servicio").value);

  totalCta = total + propina + roomser;
  // console.log(totalCta);
  $("#totalCuentPag").val(totalCta);
  $("#montopago").val(totalCta);
}

function calcular_totalDir() {
  total = parseFloat($("#totalDir").val().replaceAll(",", ""));
  totalini = parseFloat($("#totaliniDir").val());
  propina = parseFloat($("#propinaDir").val().replaceAll(",", ""));
  total = totalini + propina;
  $("#totalDir").val(number_format(total, 2));
  $("#totalCuenta").val(total);
}

function activaMenus() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let {
    pos,
    user: { usuario, usuario_id, tipo },
  } = sesion;
  let { apellidos, nombres } = user;
  let { fecha_auditoria } = oPos;
  $("#nombreUsuario").html(
    `${apellidos} ${nombres} <span class="caret"></span>`
  );
  $("#fechaPos").html(`Fecha Proceso ${fecha_auditoria}`);
  $("#fechaAuditoria").val(fecha_auditoria);
}

function seleccionaAmbiente() {
  $.ajax({
    url: "res/php/escritorio_pos.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $("#Escritorio").html(data);
      $(".main-sidebar").css("height", alto - 420);
    },
  });
}

sesion = JSON.parse(localStorage.getItem("sesion"));
let {
  cia: { invMod, posMmod },
  user: { usuario_id, usuario, apellidos, nombres, estado_usuario_pos, tipo },
} = sesion;

async function ingresoPos() {
  console.log("Ingreso al POS ");
  console.log({ usuario_id, usuario });
  $("#idUsuario").val(usuario_id);

  if (invMod == 1 && tipo <= 2) {
    $("#menuInve").css("display", "block");
  }
  if (tipo <= 1) {
    $(".menuKardex").css("display", "block");
  }

  if (tipo <= 2) {
    $("#menuAudi").css("display", "block");
    $("#menuHist").css("display", "block");
    $("#menuMovi").css("display", "block");
    $("#menuDiar").css("display", "block");
    $("#menuInfo").css("display", "block");
    $("#menuInfoCaje").css("display", "block");
    $("#menuDatos").css("display", "block");
  }

  if (tipo <= 3) {
    $("#menuCaje").css("display", "block");
    $("#menuVenta").css("display", "block");
    $("#menuCaja").css("display", "block");
  }
  if (tipo <= 4) {
  }
  if (tipo <= 5) {
  }

  $("#nombreUsuario").html(
    `<p>${apellidos} ${nombres} </p> <span class="caret"></span>`
  );

  if (estado_usuario_pos == "0") {
    $.ajax({
      url: "res/php/user_actions/activaCajero.php",
      type: "POST",
      data: { usuario_id },
      success: function () {},
    });
  }
}

function activaPos() {
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let { fecha_auditoria } = oPos;
  $("#fechaAuditoria").val(fecha_auditoria);
}

function cierreCajero(cajero) {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let {
    user: { usuario, usuario_id, tipo, nombres, apellidos },
  } = sesion;
  let { fecha_auditoria, id_ambiente, nombre, logo, prefijo } = oPos;

  var web = $("#rutaweb").val();
  var parametros = {
    usuario_id,
    usuario,
    fecha_auditoria,
    id_ambiente,
    nombre,
    logo,
    prefijo,
  };
  $.ajax({
    url: web + "res/php/cierreDelDiaCajero.php",
    type: "POST",
    data: parametros,
    success: function (datos) {
      swal("Atencion", "Cajero Cerrado Con Exito", "success");
      var ventana = window.open(datos, "PRINT", "height=600,width=600");
      setTimeout(function () {
        cierraSesion();
      }, 2000);
    },
  });
}

function verAuditoria(info) {
  var fecha = $("#fechaaudi").val();
  var repo = info;
  $("#verFactura").attr("data", "imprimir/auditorias/" + repo);
}

function buscaFechaAuditoria() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    pos,
    user: { usuario, usuario_id, tipo },
  } = sesion;
  let { id_ambiente, prefijo } = oPos;

  var fecha = $("#buscarFecha").val();
  var parametros = {
    fecha,
    idamb: id_ambiente,
    prefijo,
  };
  $("#verFactura").attr("data", "");
  $.ajax({
    url: "res/php/user_actions/buscaFechaAuditoria.php",
    type: "POST",
    data: parametros,
    success: function (datos) {
      $("#muestraResultado").html(datos);
    },
  });
}

function reimprimirFactura() {
  fact = $("#facturaActiva").val();
  rpre = $("#prefijoFac").val();
  pref = $("#prefijoAmb").val();
  pms = $("#tipoCargo").val();
  if (pms == 0) {
    factura = "impresiones/Factura_" + pref + "_" + rpre + "-" + fact + ".pdf";
  } else {
    factura = "impresiones/ChequeCuenta_" + pref + "_" + fact + ".pdf";
  }
  var ventana = window.open(factura, "PRINT", "height=600,width=600");
}

async function enviaInicio() {
  localStorage.removeItem("productoComanda");
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let { id_ambiente } = oPos;
  getSeleccionaAmbiente(id_ambiente);
}

function mesasActivas(fecha, id) {
  parametros = {
    fecha,
    id,
  };
  $.ajax({
    url: "res/php/user_actions/comandasSinCerrar.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $("#aviso").html(data);
    },
  });
}

const mesasSinSalir = async (fecha_auditoria, id_ambiente) => {
  try {
    const resultado = await fetch(`res/php/user_actions/mesasActivas.php`, {
      method: "post",
      headers: {
        "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
      },
      body: "fecha=" + fecha_auditoria + "&idambiente=" + id_ambiente,
    });
    const datos = await resultado.json();
    return datos;
  } catch (error) {
    // console.log(error);
    return error;
  }
};

mensajeAuditoria = async (mensaje) => {
  try {
    aviso = document.querySelector("#aviso");
    aviso.innerHTML = `
    <h4 class="bg-red" style="padding:10px;display:flex">
      <img loading="lazy" style="margin-bottom:0;width:15%;" class="thumbnail" src="../img/loader.gif" alt="" />
      <span id="mensaje" style="font-size:24px;font-weight: 700;font-family: ubuntu;margin:15px">${mensaje}</span>
      </h4>
      `;
  } catch (error) {
    // console.log(error);
  }
};

async function cierreDiario() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let { user, pos } = sesion;
  const { usuario, usuario_id } = user;
  const { fecha_auditoria, id_ambiente, prefijo, nombre, logo } = oPos;

  const sinsalir = await mesasSinSalir(fecha_auditoria, id_ambiente);
  if (sinsalir !== 0) {
    mesasActivas(fecha_auditoria, id_ambiente);
    return;
  }

  $("#botonCierre").attr("disabled", "disabled");

  const mensaje = await mensajeAuditoria(
    "Procesando Informacion, No Interrumpa "
  );
  /* const backup = await fetch("auditoria/backupDiario.php", {
    method: "post",
    headers: {
      "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
    },
    body: "fecha=" + fecha_auditoria + "&prefijo=" + prefijo,
  }); */
  const cajeros = await fetch("auditoria/balanceDiarioCajero.php", {
    method: "post",
    headers: {
      "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
    },
    body:
      "fecha=" +
      fecha_auditoria +
      "&idamb=" +
      id_ambiente +
      "&nomamb=" +
      nombre +
      "&logo=" +
      logo,
  });
  const balance = await fetch("auditoria/balanceDiarioAuditoria.php", {
    method: "post",
    headers: {
      "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
    },
    body:
      "fecha=" +
      fecha_auditoria +
      "&idamb=" +
      id_ambiente +
      "&nomamb=" +
      nombre +
      "&logo=" +
      logo +
      "&iduser=" +
      usuario_id +
      "&user=" +
      usuario +
      "&prefijo=" +
      prefijo,
  });

  const informeGe = await fetch("auditoria/gerenciaDiariaAuditoria.php", {
    method: "post",
    headers: {
      "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
    },
    body:
      "fecha=" +
      fecha_auditoria +
      "&idamb=" +
      id_ambiente +
      "&nomamb=" +
      nombre +
      "&logo=" +
      logo +
      "&iduser=" +
      usuario_id +
      "&user=" +
      usuario +
      "&prefijo=" +
      prefijo,
  });

  const productos = await fetch("auditoria/productosDiarioAuditoria.php", {
    method: "post",
    headers: {
      "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
    },
    body:
      "fecha=" +
      fecha_auditoria +
      "&idamb=" +
      id_ambiente +
      "&nomamb=" +
      nombre +
      "&logo=" +
      logo +
      "&iduser=" +
      usuario_id +
      "&user=" +
      usuario +
      "&prefijo=" +
      prefijo,
  });

  const grupos = await fetch("auditoria/gruposVentaDiarioAuditoria.php", {
    method: "post",
    headers: {
      "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
    },
    body:
      "fecha=" +
      fecha_auditoria +
      "&idamb=" +
      id_ambiente +
      "&nomamb=" +
      nombre +
      "&logo=" +
      logo +
      "&iduser=" +
      usuario_id +
      "&user=" +
      usuario +
      "&prefijo=" +
      prefijo,
  });

  const cartera = await fetch("auditoria/carteraDiarioAuditoria.php", {
    method: "post",
    headers: {
      "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
    },
    body:
      "fecha=" +
      fecha_auditoria +
      "&idamb=" +
      id_ambiente +
      "&nomamb=" +
      nombre +
      "&logo=" +
      logo +
      "&iduser=" +
      usuario_id +
      "&user=" +
      usuario +
      "&prefijo=" +
      prefijo,
  });

  const historico = await fetch("auditoria/envioHistoricoDiarioAuditoria.php", {
    method: "post",
    headers: {
      "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
    },
    body:
      "fecha=" +
      fecha_auditoria +
      "&idamb=" +
      id_ambiente +
      "&nomamb=" +
      nombre +
      "&logo=" +
      logo +
      "&iduser=" +
      usuario_id +
      "&user=" +
      usuario +
      "&prefijo=" +
      prefijo,
  });

  const acumuladoDiario = await fetch(
    "auditoria/acumuladoDiarioAuditoria.php",
    {
      method: "post",
      headers: {
        "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
      },
      body:
        "fecha=" +
        fecha_auditoria +
        "&idamb=" +
        id_ambiente +
        "&nomamb=" +
        nombre +
        "&logo=" +
        logo +
        "&iduser=" +
        usuario_id +
        "&user=" +
        usuario +
        "&prefijo=" +
        prefijo,
    }
  );

  const acumulado = await fetch(
    "auditoria/gruposAcumuladoDiarioAuditoria.php",
    {
      method: "post",
      headers: {
        "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
      },
      body:
        "fecha=" +
        fecha_auditoria +
        "&idamb=" +
        id_ambiente +
        "&nomamb=" +
        nombre +
        "&logo=" +
        logo +
        "&iduser=" +
        usuario_id +
        "&user=" +
        usuario +
        "&prefijo=" +
        prefijo,
    }
  );

  const formasPago = await fetch("auditoria/formasPagoDiarioAuditoria.php", {
    method: "post",
    headers: {
      "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
    },
    body:
      "fecha=" +
      fecha_auditoria +
      "&idamb=" +
      id_ambiente +
      "&nomamb=" +
      nombre +
      "&logo=" +
      logo +
      "&iduser=" +
      usuario_id +
      "&user=" +
      usuario +
      "&prefijo=" +
      prefijo,
  });

  const fecha = await fetch("auditoria/cambiaFechaAuditoria.php", {
    method: "post",
    headers: {
      "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
    },
    body:
      "fecha=" +
      fecha_auditoria +
      "&idamb=" +
      id_ambiente +
      "&nomamb=" +
      nombre +
      "&logo=" +
      logo +
      "&iduser=" +
      usuario_id +
      "&user=" +
      usuario +
      "&prefijo=" +
      prefijo,
  });
  const nuevaFecha = await fecha.text();

  if (fecha_auditoria != nuevaFecha) {
    swal(
      {
        title: "Auditoria Nocturna Terminada con Exito !",
        type: "success",
        confirmButtonText: "Aceptar",
        closeOnConfirm: false,
      },
      function () {
        localStorage.removeItem("oPos");
        $(location).attr("href", "inicio.php");
        // cierraSesion();
      }
    );
  }
}

function actualizaInterfase() {
  var ruta = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var codigo = $("#codigo").val();
  var propina = $("#propina").val();
  var servicio = $("#servicio").val();

  $.ajax({
    url: "res/php/user_actions/actualizaInterfase.php",
    type: "POST",
    data: {
      codigo,
      propina,
      servicio,
    },
    success: function (data) {
      $("#mensaje").html("<h4>Interfase PMS Actualizada con Exito</h4>");
    },
  });
}

function eliminaProducto() {
  var id = $("#idproducto").val();
  $.ajax({
    url: "res/php/user_actions/eliminaProducto.php",
    type: "POST",
    data: { id: id },
    success: function (data) {
      $("#dataDeleteProducto").modal("hide");
      $(".modal-backdrop").remove();
      $(".modal-open").css("overflow", "auto");
      productos();
    },
  });
}

function guardarProducto() {
  var parametros = $("#guardarDatosProducto").serialize();
  $.ajax({
    url: "res/php/user_actions/guardaProducto.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $(".modal-backdrop").remove();
      $(".modal-open").css("overflow", "auto");
      productos();
    },
  });
}

function eliminaCliente() {
  var idusr = $("#idusrdel").val();
  $.ajax({
    url: "res/php/user_actions/eliminaCliente.php",
    type: "POST",
    data: {
      idusr: idusr,
    },
    success: function (data) {
      if (data == 1) {
        $("#dataDeleteCliente").modal("hide");
        $(".modal-backdrop").remove();
        $(".modal-open").css("overflow", "auto");
        clientes();
      } else {
        $("#pregunta").css("display", "none");
        $("#mensaje").css("display", "block");
        $("#mensaje")
          .html(`<h3 class="text-center" style="text-align-center">Precaucion</h3> 
        <p class="lead text-center" style="display: block;margin:10px">El Cliente presenta movimientos de cartera, no es posible eliminarlo.
        </p>`);
      }
    },
  });
}

function guardaCliente() {
  var parametros = $("#guardarDatosCliente").serializeArray();

  if ($("#empleado").is(":checked")) {
    empleado = 1;
  } else {
    empleado = 0;
    parametros.push({ name: "empleado", value: empleado });
  }

  $.ajax({
    url: "res/php/user_actions/guardarCliente.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $(".modal-backdrop").remove();
      $(".modal-open").css("overflow", "auto");
      clientes();
    },
  });
}

function getFactura(comanda, factura, pms) {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    pos,
    user: { usuario, usuario_id, tipo },
  } = sesion;
  let { id_ambiente, nombre, propina, fecha_auditoria, impuesto, logo } = oPos;

  parametros = {
    idamb: id_ambiente,
    amb: nombre,
    user: usuario,
    nivel: tipo,
    impto: impuesto,
    prop: propina,
    comanda,
    factura,
  };

  $("#numeroFactura").html("Productos Factura Nro " + fact);
  $("#facturaActiva").val(fact);
  $("#tipoCargo").val(pms);
  $("#loader").fadeIn("slow");

  $.ajax({
    url: "res/php/user_actions/getFactura.php",
    data: parametros,
    type: "POST",
    beforeSend: function (objeto) {
      $("#loader").html("<img src='../img/loader.gif'>");
    },
    success: function (data) {
      $("#ventasList").html(data);
    },
  });
}

function getVentasDia(idamb) {
  var parametros = {
    idamb,
  };
  $("#loader").fadeIn("slow");
  $.ajax({
    url: "res/php/user_actions/getVentasDia.php",
    data: parametros,
    type: "POST",
    beforeSend: function (objeto) {
      $("#loader").html("<img src='../img/loader.gif'>");
    },
    success: function (data) {
      $("#ComandasList").html(data);
    },
  });
}

function getAmbientes() {
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let { id_ambiente } = oPos;

  var parametros = {
    idamb: id_ambiente,
  };
  $("#loader").fadeIn("slow");
  $.ajax({
    type: "POST",
    dataType: "json",
    data: parametros,
    url: "res/php/user_actions/getAmbiente.php",
    beforeSend: function (objeto) {
      $("#loader").html("<img src='../img/loader.gif'>");
    },
    success: function (data) {
      if (data == "0") {
        swal(
          "Precaucion",
          "No existen Puntos de venta Creados en el Sistema",
          "warning"
        );
      } else if (data == 1) {
        traeAmbientes(1);
      } else if (data) {
        localStorage.setItem("oPos", JSON.stringify(data));
        $(location).attr("href", "ventas/inicio.php");
      }
    },
  });
}

function getSeleccionaAmbiente(codigo) {
  var parametros = {
    codigo,
  };
  $.ajax({
    url: "res/php/user_actions/getSeleccionaAmbiente.php",
    type: "POST",
    dataType: "json",
    data: parametros,
    beforeSend: function (objeto) {
      $("#loader").html("<img src='../img/loader.gif'>");
    },
    success: function (data) {
      menu = document.querySelector("#menuPos");
      menusup = document.querySelector(".sidebar-toggle");

      menu.classList.remove("apaga");
      menusup.classList.remove("apaga");
      localStorage.setItem("oPos", JSON.stringify(data));
      const { id_ambiente, nombre, logo, prefijo, fecha_auditoria } = data;
      muestraPos(codigo);
    },
  });
}

function getSecciones() {
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let { id_ambiente } = oPos;
  var alto = screen.height;
  var ancho = screen.width;
  $("#loader").fadeIn("slow");
  $.ajax({
    type: "POST",
    url: "res/php/user_actions/getSeccion.php",
    dataType: "json",
    data: {
      id_ambiente,
    },
    beforeSend: function (objeto) {
      $("#loader").html("<img src='../img/loader.gif'>");
    },
    success: function (data) {
      for (i = 0; i < data.length; i++) {
        boton = `
        <button 
          class="btn btn-success btnPos btnSecc" 
          onClick="getProducto(this.name,${id_ambiente});" 
          type="button" name='${data[i]["id_seccion"]}'  
          title="${data[i]["nombre_seccion"]}">
          <span class="sombraBlanca">${data[i]["nombre_seccion"]}</span> 
        </button>`;
        $("#seccionList").append(boton);
      }
    },
  });
}

function getProducto(codigo, ambi) {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  var alto = screen.height;
  var ancho = screen.width;
  var parametros = {
    codigo,
    ambi,
  };
  $("#loader").fadeIn("slow");
  $.ajax({
    type: "POST",
    url: "res/php/user_actions/getProducto.php",
    dataType: "json",
    data: parametros,
    beforeSend: function (objeto) {
      $("#productoList").html("<img src='../img/loader.gif'>");
    },
    success: function (data) {
      $("#productoList").html("");
      for (i = 0; i < data.length; i++) {
        boton = `<button
                  style="background-size: contain;line-height:15px ;"
                  id="productos"
                  class="btn btn-danger btnPos btnProd" 
                  name="${data[i]["nom"]}"
                  valor="${data[i]["venta"]}"
                  idprod="${data[i]["producto_id"]}"
                  porimp="${data[i]["porcentaje_impto"]}"
                  onClick="getVentas('${data[i]["nom"]}','${data[i]["venta"]}','${data[i]["producto_id"]}','${data[i]["porcentaje_impto"]}','${ambi}')" 
                  type="button"
                  class='btn btn-danger'>
                  ${data[i]["nom"]}</button>`;
        $("#productoList").append(boton);
      }
    },
  });
}

function productosActivos() {
  numero = $("#numeroComanda").val();
  recuperar = $("#recuperarComanda").val();
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let storageProd = localStorage.getItem("productoComanda");
  let listaComanda;
  if (storageProd == null) {
    listaComanda = [];
  } else {
    listaComanda = JSON.parse(storageProd);
  }
  let {
    user: { usuario, usuario_id, tipo },
  } = sesion;

  $(".comanda > tbody").html("");
  /* listaComanda.map((productos) => {
    let { id, producto, cant, total, codigo, ambiente } = productos;
    // console.log({ id, producto, cant, total, codigo, ambiente })
  });
 */
  for (i = 0; i < listaComanda.length; i++) {
    if (numero == 0) {
      $(".comanda > tbody").append(
        `<tr class="tablaComanda">
          <td>${listaComanda[i]["producto"]}</td>
          <td>${listaComanda[i]["cant"]}</td>
          <td class="t-right">${number_format(listaComanda[i]["total"], 2)}</td>
          <td class="t-center">
            <div class="btn-group" role="group">
              <button
                type="button"
                id="${i}"
                onclick="getSumaVentas(this.id,this.parentNode.parentNode.parentNode.rowIndex)" 
                class="glyphicon glyphicon-plus btn btn-success btn-xs">
              </button>
              <button
                type="button"
                id="${i}"
                onclick="getRestarVentas(this.id,this.parentNode.parentNode.parentNode.rowIndex)" 
                class="glyphicon glyphicon-minus btn btn-warning btn-xs" >
              </button>
              <button
                type="button"
                id="${i}"
                onclick="getBorraVentas(this.id,this.parentNode.parentNode.parentNode.rowIndex)" 
                class="glyphicon glyphicon-trash btn btn-danger btn-xs" >
              </button>
            </div>
          </td>
        </tr>`
      );
    } else {
      if (recuperar == 0) {
        $(".comanda > tbody").append(
          `<tr class="tablaComanda">
          <td>${listaComanda[i]["producto"]}</td>
          <td>${listaComanda[i]["cant"]}</td>
          <td class="t-right">${number_format(listaComanda[i]["total"], 2)}</td>
          <td class="t-center">
            <button
              type="button"
              id="${i}"
              onclick="botonDevolverProducto('${numero}','${
            listaComanda[i]["codigo"]
          }','${listaComanda[i]["ambiente"]}','${listaComanda[i]["cant"]}','${
            listaComanda[i]["producto"]
          }','${listaComanda[i]["id"]}','${listaComanda[i]["importe"]}','${
            listaComanda[i]["impto"]
          }',this.id, this.parentNode.parentNode.parentNode.rowIndex)"
              class="btn btn-danger btn-xs btnDevuelve"
              title="Devolver Producto Uno">
              <i class="fa-solid fa-reply"></i>
            </button> 
          </td>
        </tr>`
        );
        if (tipo > 2) {
          // $(".btnDevuelve").remove();
          /* $(".btnDevuelve").css("readonly", "readonly");
          $(".btnDevuelve").css("disabled", "disabled");
          $(".btnDevuelve").css("display", "none"); */
          $(".btnDevuelve").removeAttr("attribute onclick");
        }
      } else {
        if (listaComanda[i]["activo"] == 1) {
          $(".comanda > tbody").append(
            `<tr class="tablaComanda">
              <td>${listaComanda[i]["producto"]}</td>
              <td>${listaComanda[i]["cant"]}</td>
              <td class="t-right">${number_format(
                listaComanda[i]["total"],
                2
              )}</td>
              <td class="t-center">
                <button
                  type="button"
                  id="${i}"
                  onclick="botonDevolverProducto('${numero}','${
              listaComanda[i]["codigo"]
            }','${listaComanda[i]["ambiente"]}','${listaComanda[i]["cant"]}','${
              listaComanda[i]["producto"]
            }','${listaComanda[i]["id"]}','${listaComanda[i]["importe"]}','${
              listaComanda[i]["impto"]
            }',this.id, this.parentNode.parentNode.parentNode.rowIndex)"
                  class="btn btn-danger btn-xs"
                  title="Devolver Producto Dos">
                  <i class="fa-solid fa-reply"></i>
                </button>
              </td>
          </tr>`
          );
          if (tipo > 2) {
            $(".btnDevuelve").remove();
            $(".btnDevuelve").css("disabled", "disabled");
          }
        } else {
          $(".comanda > tbody").append(
            `<tr class="tablaComanda">
              <td>${listaComanda[i]["producto"]}</td>
              <td>${listaComanda[i]["cant"]}</td>
              <td>${number_format(listaComanda[i]["total"], 2)}</td>
              <td style="text-align:center">
                <div class="btn-group" role="group">
                  <button
                    type="button"
                    id="${i}"
                    onclick="getSumaVentas(this.id,this.parentNode.parentNode.parentNode.rowIndex)" 
                    class="glyphicon glyphicon-plus btn btn-success btn-xs">
                  </button>
                  <button
                    type="button"
                    id="${i}"
                    onclick="getRestarVentas(this.id,this.parentNode.parentNode.parentNode.rowIndex)" 
                    class="glyphicon glyphicon-minus btn btn-warning btn-xs" >
                  </button>
                  <button
                    type="button"
                    id="${i}"
                    onclick="getBorraVentas(this.id,this.parentNode.parentNode.parentNode.rowIndex)" 
                    class="glyphicon glyphicon-trash btn btn-danger btn-xs" >
                  </button>
                </div>
              </td>
            </tr>`
          );
        }
      }
    }
  }
}

function getVentas(nom, val, idp, imp, ambi) {
  propina = 0;
  descuento = 0;
  abonos = $("#abonosComanda").val();
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let storageProd = localStorage.getItem("productoComanda");

  let listaComanda;
  if (storageProd == null) {
    listaComanda = [];
  } else {
    listaComanda = JSON.parse(storageProd);
  }

  let { impuesto } = oPos;
  imptoInc = impuesto;
  let nohay = true;

  for (i = 0; i < listaComanda.length; i++) {
    if (listaComanda[i]["codigo"] === idp && listaComanda[i]["activo"] === 0) {
      canti = listaComanda[i]["cant"] + 1;
      totve = canti * listaComanda[i]["importe"];

      if (impuesto == 0) {
        porImpto = 0;
      } else {
        porImpto = listaComanda[i]["impto"];
      }

      subt = (
        (canti * listaComanda[i]["importe"]) /
        (1 + porImpto / 100)
      ).toFixed(2);
      impto = canti * listaComanda[i]["importe"] - subt;
      listaComanda[i]["valorimpto"] = impto;

      listaComanda[i]["venta"] = subt;
      listaComanda[i]["cant"] = canti;
      listaComanda[i]["total"] = totve;
      nohay = false;
    }
  }

  if (nohay) {
    if (imptoInc == 0) {
      imp = 0;
    }

    subt = ((val * 1) / (1 + imp / 100)).toFixed(2);
    impuesto = (val * 1 - subt).toFixed(2);

    dataProd = {
      producto: nom,
      cant: 1,
      importe: val * 1,
      total: val * 1,
      codigo: idp,
      descuento: 0,
      venta: subt,
      impto: imp,
      valorimpto: impuesto,
      ambiente: ambi,
      activo: 0,
      importeTot: val * 1,
    };
    listaComanda.push(dataProd);
  }
  localStorage.setItem("productoComanda", JSON.stringify(listaComanda));

  productosActivos();
  resumenComanda();
}

function getRestarVentas(codigo, index) {
  let listaComanda = JSON.parse(localStorage.getItem("productoComanda"));

  if (listaComanda[codigo]["cant"] == 1) {
    getBorraVentas(codigo, index);
  } else {
    canti = listaComanda[index - 1]["cant"] - 1;
    subt = (
      (canti * listaComanda[index - 1]["importe"]) /
      (1 + listaComanda[index - 1]["impto"] / 100)
    ).toFixed(2);
    totve = canti * listaComanda[index - 1]["importe"];
    impto = canti * listaComanda[index - 1]["importe"] - subt;
    listaComanda[index - 1]["cant"] = canti;
    listaComanda[index - 1]["total"] = totve;
    listaComanda[index - 1]["venta"] = subt;
    listaComanda[index - 1]["valorimpto"] = impto;
    localStorage.setItem("productoComanda", JSON.stringify(listaComanda));
  }
  productosActivos();
  resumenComanda();
}

function getSumaVentas(codigo, index) {
  let listaComanda = JSON.parse(localStorage.getItem("productoComanda"));
  canti = listaComanda[index - 1]["cant"] + 1;
  totve = canti * listaComanda[index - 1]["importe"];
  subt = (
    (canti * listaComanda[index - 1]["importe"]) /
    (1 + listaComanda[index - 1]["impto"] / 100)
  ).toFixed(2);
  impto = canti * listaComanda[index - 1]["importe"] - subt;
  listaComanda[index - 1]["cant"] = canti;
  listaComanda[index - 1]["total"] = totve;
  listaComanda[index - 1]["venta"] = subt;
  listaComanda[index - 1]["valorimpto"] = impto;

  localStorage.setItem("productoComanda", JSON.stringify(listaComanda));
  productosActivos();
  resumenComanda();
}

function getBorraVentas(codigo, regis) {
  let listaComanda = JSON.parse(localStorage.getItem("productoComanda"));
  listaComanda.splice(codigo, 1);
  localStorage.setItem("productoComanda", JSON.stringify(listaComanda));
  productosActivos();
  resumenComanda();
}

function buscar() {
  var alto = screen.height;
  var ancho = screen.width;
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let { id_ambiente } = oPos;

  var textoBusqueda = $("input#busqueda").val();
  parametros = {
    id: id_ambiente,
    valorBusqueda: textoBusqueda,
  };

  if (textoBusqueda != "") {
    $.ajax({
      type: "POST",
      url: "res/php/user_actions/getBuscaProducto.php",
      dataType: "json",
      data: parametros,
      beforeSend: function (objeto) {
        $("#productoList").html("<img src='../img/loader.gif'>");
      },
      success: function (data) {
        $("#productoList").html("");
        // $("#productoList").css("min-height", 455);
        $("#productoList").css("height", alto - 263);
        for (i = 0; i < data.length; i++) {
          boton = `<button 
                    style="background-size: contain;line-height:15px ;"
                    id="productos"
                    class="btn btn-danger btnPos btnProd" 
                    name="${data[i]["nom"]}"
                    valor="${data[i]["venta"]}"
                    idprod="${data[i]["producto_id"]}"
                    porimp="${data[i]["porcentaje_impto"]}"
                    onClick="getVentas('${data[i]["nom"]}','${data[i]["venta"]}','${data[i]["producto_id"]}','${data[i]["porcentaje_impto"]}','${ambi}')" 
                    type="button"
                    class='btn btn-danger'>
                    ${data[i]["nom"]}</button>`;
          $("#productoList").append(boton);
        }
      },
    });
  } else {
    $("#productoList").html("");
  }
}

function getFormaPago(fpago) {
  var parametros = { fpago };
  $("#loader").fadeIn("slow");
  $.ajax({
    type: "POST",
    url: "res/php/user_actions/getFormaPago.php",
    data: parametros,
    success: function (data) {
      $("#divClientes").html("");
      $("#divClientes").html(data);
    },
  });
}

function getFormaPagoDir(fpago) {
  var parametros = { fpago };
  $("#loader").fadeIn("slow");
  $.ajax({
    type: "POST",
    url: "res/php/user_actions/getFormaPago.php",
    data: parametros,
    success: function (data) {
      $("#clientesDir option").remove();
      $("#clientesDir").append(data);
    },
  });
}

function getBorraTotalVentas(codigo) {
  if (window.XMLHttpRequest) {
    xmlhttp3 = new XMLHttpRequest();
  } else {
    xmlhttp3 = new ActiveXObject("Microsoft.XMLHTTP");
  }

  xmlhttp3.onreadystatechange = function () {
    if (xmlhttp3.readyState == 4 && xmlhttp3.status == 200) {
      document.getElementById("ventasList").innerHTML = xmlhttp3.responseText;
    }
  };
  if (confirm("Esta seguro que desea Cancelar/Anular la Presente Cuenta?")) {
    xmlhttp3.open(
      "GET",
      "includes/getBorraTotalVentas.php?xusu=" + codigo,
      true
    );
    xmlhttp3.send();
  }
}

// Función para recoger los datos de PHP según el navegador, se usa siempre.
function objetoAjax() {
  var xmlhttp = false;
  try {
    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
  } catch (e) {
    try {
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    } catch (E) {
      xmlhttp = false;
    }
  }

  if (!xmlhttp && typeof XMLHttpRequest != "undefined") {
    xmlhttp = new XMLHttpRequest();
  }
  return xmlhttp;
}

//Función para recoger los datos del formulario y enviarlos por post
function enviarDatosProducto() {
  //div donde se mostrará lo resultados
  divResultado = document.getElementById("ventas");
  //recogemos los valores de los inputs
  nom = document.productos_ventas.producto.value;
  cod = document.productos_ventas.codigo.value;
  //instanciamos el objetoAjax
  ajax = objetoAjax();

  //uso del medotod POST
  //archivo que realizará la operacion
  //registro.php
  ajax.open("POST", "registra_producto.php", true);
  //cuando el objeto XMLHttpRequest cambia de estado, la función se inicia
  ajax.onreadystatechange = function () {
    //la función responseText tiene todos los datos pedidos al servidor
    if (ajax.readyState == 4) {
      //mostrar resultados en esta capa
      divResultado.innerHTML = ajax.responseText;
      //llamar a funcion para limpiar los inputs
      // LimpiarCampos();
    }
  };
  ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  //enviando los valores a registro.php para que inserte los datos
  ajax.send("&producto=" + nom + "&codigo=" + cod);
}

//función para limpiar los campos
function LimpiarCampos() {
  document.productos_ventas.producto.value = "";
  document.productos_ventas.codigo.value = "";
}

function getSeleccionaAmbiente2(codigo) {
  var parametros = { action: "ajax" };
  $("#loader").fadeIn("slow");
  $.ajax({
    type: "POST",
    url: "res/php/user_actions/getSeleccionaAmbiente.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#loader").html("<img src='../img/loader.gif'>");
    },
    success: function (data) {
      if (data == 0) {
        swal(
          "Precaucion",
          "No existen Puntos de venta Creados en el Sistema",
          "warning"
        );
      } else {
      }
    },
  });
}

function getGuardaComandas(usuario) {
  if (window.XMLHttpRequest) {
    xmlhttp3 = new XMLHttpRequest();
  } else {
    xmlhttp3 = new ActiveXObject("Microsoft.XMLHTTP");
  }

  xmlhttp3.onreadystatechange = function () {
    if (xmlhttp3.readyState == 4 && xmlhttp3.status == 200) {
      document.getElementById("Escritorio").innerHTML = xmlhttp3.responseText;
    }
  };
  xmlhttp3.open(
    "GET",
    "includes/getGuardaComanda.php?usuario=" + usuario,
    true
  );
  xmlhttp3.send();
}

async function getCuentasActivas(idamb) {
  var alto = screen.height;
  var ancho = screen.width;
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let { fecha_auditoria } = oPos;

  var parametros = {
    idamb,
  };

  $("#loader").fadeIn("slow");
  $.ajax({
    url: "res/php/user_actions/getCuentasActivas.php",
    data: parametros,
    type: "POST",
    dataType: "json",
    beforeSend: function (objeto) {
      $("#loader").html("<img src='../img/loader.gif'>");
    },
    success: function (x) {
      $("#listaComandas").html("");
      $("#listaComandas").css("min-height", 240);
      // $("#listaComandas").css("height", alto - 280);

      x.map(function (y) {
        let { comanda, cliente, abonos } = y;
      });

      for (i = 0; i < x.length; i++) {
        miBoton = `comanda${x[i]["comanda"]}`;
        boton = `
            <button
              class   ="btn btn-primary btnPos btnInfoCom"
              onClick ="getComandas(this.id,this.value);"
              type    ="button"
              id      ="comanda${x[i]["comanda"]}"
              value   ="${x[i]["comanda"]}"
              title   ="Comanda Numero ${x[i]["comanda"]}">
            <h3 style="color:white;">Mesa ${x[i]["mesa"]}</h3>
            <h3 style="color:white;">Comanda ${number_format(
              x[i]["comanda"],
              0
            )}</h3>
            </button>`;
        $("#listaComandas").append(boton);

        $("#" + miBoton).attr("subtotal", x[i]["subtotal"]);
        $("#" + miBoton).attr("impto", x[i]["impuesto"]);
        $("#" + miBoton).attr("propina", x[i]["propina"]);
        $("#" + miBoton).attr("abonos", x[i]["abonos"]);
        $("#" + miBoton).attr("total", x[i]["total"]);
        $("#" + miBoton).attr("mesa", x[i]["mesa"]);
        $("#" + miBoton).attr("pax", x[i]["pax"]);
      }
    },
  });
}

function getProductosComanda(comanda, mesa) {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let {
    pos,
    user: { usuario, usuario_id, tipo },
  } = sesion;
  let { id_ambiente, nombre, propina, prefijo, fecha_auditoria, impuesto } =
    oPos;

  listaComanda = [];

  var parametros = {
    comanda,
    user: usuario,
    nivel: tipo,
    nomamb: nombre,
    idamb: id_ambiente,
    impto: impuesto,
    prop: propina,
    pref: prefijo,
    fecha: fecha_auditoria,
  };
  $.ajax({
    url: "res/php/user_actions/getComanda.php",
    data: parametros,
    dataType: "json",
    type: "POST",
    beforeSend: function (objeto) {
      $("#loader").html("<img src='../img/loader.gif'>");
    },
    success: function (dato) {
      var total = 0;
      titulo = "";
      for (j = 0; j < dato.length; j++) {
        titulo =
          titulo +
          `${dato[j]["nom"].substring(0, 30).padEnd(30, " ")} ${
            dato[j]["cant"]
          }     ${number_format(dato[j]["venta"], 2)} \n`;
        total = total + parseInt(dato[j]["venta"], 10);
      }
      titulo = titulo + `\n`;
      titulo =
        titulo +
        `TOTAL PRESENTE CUENTA             ${number_format(total, 2)} \n`;
      $("#" + mesa).attr("title", titulo);
    },
  });
}

function getComandas(comanda, numero) {
  // sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  /* 
  // let {pos, user: { usuario, usuario_id, tipo }, } = sesion;
  */
  let { id_ambiente, nombre, propina, prefijo, fecha_auditoria, impuesto } =
    oPos;

  console.log({ usuario, usuario_id, tipo });
  console.log({
    id_ambiente,
    nombre,
    propina,
    prefijo,
    fecha_auditoria,
    impuesto,
  });

  miBoton = "#" + comanda;
  subtotal = parseFloat($(miBoton).attr("subtotal"));
  imptos = parseFloat($(miBoton).attr("impto"));
  propina = parseFloat($(miBoton).attr("propina"));
  /* descuento = parseFloat($(miBoton).attr("descuento"));
  abonos = parseFloat($(miBoton).attr("abonos")); */
  descuento = 0;
  abonos = 0;
  total = parseFloat($(miBoton).attr("total"));
  mesa = parseFloat($(miBoton).attr("mesa"));
  pax = parseFloat($(miBoton).attr("pax"));

  // console.log({subtotal, impuesto, propina, descuento, abonos, total, mesa, pax})

  listaComanda = [];

  var parametros = {
    comanda: numero,
    user: usuario,
    nivel: tipo,
    nomamb: nombre,
    idamb: id_ambiente,
    impto: imptos,
    prop: propina,
    pref: prefijo,
    fecha: fecha_auditoria,
  };
  $("#numeroComanda").val(numero);
  $("#abonosComanda").val(abonos);
  $("#descuentosComanda").val(0);
  $("#nromesa").val(mesa);
  $("#canpax").val(pax);

  $.ajax({
    url: "res/php/user_actions/getComanda.php",
    data: parametros,
    dataType: "json",
    type: "POST",
    beforeSend: function (objeto) {
      $("#loader").html("<img src='../img/loader.gif'>");
    },
    success: function (data) {
      $(".prende").css("display", "block");
      botones = document.querySelectorAll(".apagado");
      ocultarBotones(botones, "display", 1);

      $("#tituloNumero").removeClass("alert-info");
      // $("#tituloNumero").addClass("alert-success");
      $("#tituloNumero").html(`Comanda Numero ${numero}`);
      // $("#guardaComandaDividida").css("display", "none");
      const nuevaAltura = window.innerHeight;
      let bg = document.querySelector(".btn-toolbar");
      bg.style.height = `${nuevaAltura - 138}px`;

      for (i = 0; i < data.length; i++) {
        dataProd = {
          producto: data[i]["nom"],
          cant: parseInt(data[i]["cant"]),
          importe: parseFloat(data[i]["importe"]),
          total: parseFloat(data[i]["importe"] * data[i]["cant"]),
          codigo: parseInt(data[i]["producto_id"]),
          descuento: parseFloat(data[i]["descuento"]),
          venta: parseFloat(data[i]["venta"]),
          impto: parseFloat(data[i]["impto"]),
          id: parseInt(data[i]["id"]),
          valorimpto: parseFloat(data[i]["valorimpto"]),
          ambiente: parseInt(id_ambiente),
          activo: 1,
          importeTot:
            parseFloat(data[i]["importe"]) * parseInt(data[i]["cant"]),
        };
        listaComanda.push(dataProd);
        localStorage.setItem("productoComanda", JSON.stringify(listaComanda));
      }
      productosActivos();
      resumenComanda();
      if (tipo != "1") {
        $(".btnDevolver").css("display", "none");
        $(".btnDevuelve").css("disabled", "disabled");
      }
    },
  });
}

function calculaCambio() {
  let pago = +parseFloat($("#montopago").val().replace(",", ""));
  totalCta = +$("#totalCuentPag").val();
  cambio = pago - totalCta;

  $("#cambio").val(cambio);

  if (cambio == 0) {
    $("#resultado").html(
      `<label name='resultado' class='avisoVta avisCambio alert alert-success'>SALDO PENDIENTE ${cambio}</label>`
    );
  }
  if (cambio < 0) {
    $("#resultado").html(
      `<label name='resultado' class='avisoVta avisCambio alert alert-danger'>SALDO PENDIENTE $ ${
        cambio * -1
      }</label>`
    );
  }
  if (cambio > 0) {
    $("#resultado").html(
      `<label name='resultado' class='avisoVta avisCambio alert alert-info'>VUELTAS/CAMBIO $ ${cambio}</label>`
    );
  }
}

function calculaCambioDir() {
  total = parseFloat($("#totalDir").val().replaceAll(",", ""));
  pagado = parseFloat($("#montopagoDir").val().replaceAll(",", ""));
  cambio = total - pagado;
  $("#cambioDir").val(cambio);
  if (cambio == 0) {
    $("#resultadoDir").html(
      `<label name='resultadoDir' class='avisoVta avisCambio alert alert-success'>SALDO PENDIENTE $ ${number_format(
        cambio,
        2
      )}</label>`
    );
  }
  if (cambio > 0) {
    $("#resultadoDir").html(
      `<label name='resultadoDir' class='avisoVta avisCambio alert alert-danger'>SALDO PENDIENTE $ ${number_format(
        cambio,
        2
      )}</label>`
    );
  }
  if (cambio < 0) {
    $("#resultadoDir").html(
      `<label name='resultadoDir' class='avisoVta avisCambio alert alert-info'>VUELTAS/CAMBIO $ ${number_format(
        cambio * -1,
        2
      )}</label>`
    );
  }
}

function load(page) {
  var parametros = { action: "ajax", page: page };
  $("#loader").fadeIn("slow");
  $.ajax({
    url: "codes/code_ventas_dia.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#loader").html("<img src='../img/loader.gif'>");
    },
    success: function (data) {
      $(".outer_div").html(data).fadeIn("slow");
      $("#loader").html("");
    },
  });
}

function loadcliente(page) {
  var parametros = { action: "ajax", page: page };
  $("#loader").fadeIn("slow");
  $.ajax({
    url: "codes/code_clientes.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#loader2").html("<img src='../img/loader.gif'>");
    },
    success: function (data) {
      $(".outer_div2").html(data).fadeIn("slow");
      $("#loader2").html("");
    },
  });
}

function loadproducto(page) {
  var parametros = { action: "ajax", page: page };
  $("#loader").fadeIn("slow");
  $.ajax({
    url: "codes/code_productos.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#loader2").html("<img src='../img/loader.gif'>");
    },
    success: function (data) {
      $(".outer_div2").html(data).fadeIn("slow");
      $("#loader2").html("");
    },
  });
}

/* Actualiza Valor Producto Ambiente POS*/

function loadcambioprecioproducto(page) {
  var parametros = { action: "ajax", page: page };
  $("#loader").fadeIn("slow");
  $.ajax({
    url: "includes/getCambiarValorProducto.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#loader2").html("<img src='../img/loader.gif'>");
    },
    success: function (data) {
      $(".outer_div2").html(data).fadeIn("slow");
      $("#loader2").html("");
    },
  });
}

function verfacturaHis(numero, factura) {
  $("#myModalVerFactura").modal("show");
  $(".modal-title").html(`Ver Factura ${numero}`);
  $("#verFacturaModal").attr("data", "impresiones/" + factura);
}
