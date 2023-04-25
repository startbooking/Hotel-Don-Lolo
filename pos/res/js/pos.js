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
  $("#guardaComandaDividida").css("display", "block");
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
  $("#regresarComanda").css("margin-top", "424px");
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

  let { pos, user } = sesion;
  let { usuario, usuario_id } = user;
  let { id_ambiente, nombre, impuesto, propina, fecha_auditoria, logo } =
    oPos[0];
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
    // let { pos } = sesion;
    let { id_ambiente } = oPos[0];

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
  let { pos, user } = sesion;
  let { usuario, usuario_id } = user;
  let { id_ambiente, nombre, impuesto, propina, fecha_auditoria } = oPos[0];
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

  let { pos, user } = sesion;
  let { usuario, usuario_id } = user;
  let { id_ambiente, nombre, impuesto, propina, fecha_auditoria, logo } =
    oPos[0];
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
    url: "informes/balanceCajaCajero.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      creaHTMLReportes(data, `Balance del Dia Cajero ${user}`);
    },
  });
}

function balanceCaja() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let { pos, user } = sesion;
  let { usuario, usuario_id } = user;
  let { id_ambiente, nombre, impuesto, propina, fecha_auditoria, logo } =
    oPos[0];
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
    url: "informes/balanceCaja.php",
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

  let { pos, user } = sesion;
  let { usuario, usuario_id } = user;
  let { id_ambiente, nombre, impuesto, propina, fecha_auditoria, logo } =
    oPos[0];
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
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let { pos, user } = sesion;
  let { usuario, usuario_id } = user;
  let { id_ambiente, nombre, impuesto, propina, fecha_auditoria, logo } =
    oPos[0];
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

  let { pos, user } = sesion;
  let { usuario, usuario_id } = user;
  let { id_ambiente, nombre, impuesto, propina, fecha_auditoria, logo } =
    oPos[0];
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
    url: "informes/ventasCreditoDia.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      creaHTMLReportes(data, `Ventas Credito del Dia`);
    },
  });
}
$(document).ready(function () {
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
    let { user } = sesion;
    let { usuario_id } = user;
    $("#idusr").val(usuario_id);
  });

  $("#dataDeleteCliente").on("show.bs.modal", function (event) {
    sesion = JSON.parse(localStorage.getItem("sesion"));
    let { user } = sesion;
    let { usuario_id } = user;

    var button = $(event.relatedTarget);
    var id = button.data("id");
    var modal = $(this);

    $("#idusrdel").val(usuario_id);
  });
});

function traeFacturasCliente() {
  // let { pos } = sesion;
  let { id_ambiente } = oPos[0];
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
  // let { pos } = sesion;
  let { fecha_auditoria } = oPos[0];

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
  let { pos, user } = sesion;
  let { id_ambiente, nombre, logo } = oPos[0];
  let { usuario, usuario_id } = user;

  ambi = id_ambiente;
  nomambi = nombre;
  user = usuario;
  iduser = usuario_id;

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
  let { fecha_auditoria } = oPos[0];

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
  let { fecha_auditoria } = oPos[0];
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

  let { pos, user } = sesion;
  let { id_ambiente, nombre, logo } = oPos[0];
  let { usuario, usuario_id } = user;

  ambi = id_ambiente;
  nomambi = nombre;
  user = usuario;
  iduser = usuario_id;

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

  let { pos, user } = sesion;
  let { id_ambiente, nombre, logo } = oPos[0];
  let { usuario, usuario_id, apellidos, nombres } = user;

  ambi = id_ambiente;
  nomambi = nombre;
  user = usuario;
  iduser = usuario_id;

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
  let { id_ambiente } = oPos[0];
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

  let { pos, user } = sesion;
  let { id_ambiente, prefijo, logo } = oPos[0];
  let { usuario, usuario_id } = user;

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

  let { pos, user } = sesion;
  let { id_ambiente, nombre, logo, impuesto, propina, fecha_auditoria } =
    oPos[0];
  let { usuario, usuario_id } = user;

  idambi = id_ambiente;
  amb = nombre;
  user = usuario;
  iduser = usuario_id;

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
  let { pos, user } = sesion;
  let { id_ambiente, nombre, logo, impuesto, propina, fecha_auditoria } =
    oPos[0];
  let { usuario, usuario_id } = user;

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
  let { pos, user } = sesion;
  let { id_ambiente, nombre, logo, impuesto, prefijo, fecha_auditoria } =
    oPos[0];
  let { usuario, tipo } = user;

  $(".btn-menu").css("display", "block");
  miBoton = "#" + nomBtn;
  propina = $(miBoton).attr("propina");
  impuesto = $(miBoton).attr("impto");
  descuento = $(miBoton).attr("descuento");
  subtotal = $(miBoton).attr("subtotal");
  abonos = $(miBoton).attr("abonos");
  total = $(miBoton).attr("total");
  cliente = $(miBoton).attr("cliente");

  parametros = {
    idamb: id_ambiente,
    amb: nombre,
    user: usuario,
    nivel: tipo,
    fecha: fecha_auditoria,
    pref: prefijo,
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
      $("#productosComanda").css("min-height", 350);
      $("#productosComanda").css("height", alto - 320);
      $("#Escritorio").css("height", alto - 420);
    },
  });
}

function mesasActivasPlano() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let { pos, user } = sesion;
  let { id_ambiente, nombre, impuesto, propina, prefijo, fecha_auditoria } =
    oPos[0];
  let { usuario } = user;

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
    success: function (data) {
      for (i = 0; i < data.length; i++) {
        mesa = "boton" + data[i]["mesa"];
        nroMesa = data[i]["mesa"];
        comanda = data[i]["comanda"];
        $("#" + mesa).removeClass("btn-success");
        $("#" + mesa).addClass("btn-warning");
        $("#" + mesa).removeAttr("attribute onclick");
        $("#" + mesa).attr("impto", data[i]["impuesto"]);
        $("#" + mesa).attr("subtotal", data[i]["subtotal"]);
        $("#" + mesa).attr("total", data[i]["total"]);
        $("#" + mesa).attr("descuento", data[i]["valor_descuento"]);
        $("#" + mesa).attr("abonos", data[i]["abonos"]);
        $("#" + mesa).attr("propina", data[i]["propina"]);
        $("#" + mesa).attr("cliente", data[i]["cliente"]);
        $("#" + mesa).attr(
          "onclick",
          `getComandasPlano(${comanda} ,'${nroMesa}',this.name)`
        );
      }
    },
  });
}

function abreCuenta(mesa) {
  var alto = screen.height;
  var ancho = screen.width;
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let { pos, user } = sesion;
  console.table({
    id_ambiente,
    nombre,
    impuesto,
    propina,
    prefijo,
    fecha_auditoria,
  });
  let { id_ambiente, nombre, impuesto, propina, prefijo, fecha_auditoria } =
    oPos[0];

  let { usuario } = user;
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
      $("#productosComanda").css("height", alto - 292);
      $("#Escritorio").css("height", alto - 420);
      $("#nromesas").val(mesa);
      $("#nromesas").attr("readonly", true);
      $("#nromesas").attr("disabled", true);
      let storageProd = localStorage.getItem("productoComanda");
      if (storageProd == null) {
        let listaComanda = [];
      } else {
        let listaComanda = JSON.parse(storageProd);
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

  let { pos, user } = sesion;
  let { id_ambiente, nombre, logo, prefijo } = oPos[0];
  let { usuario, usuario_id } = user;

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

  let { pos, user } = sesion;
  let { id_ambiente, nombre, logo, prefijo } = oPos[0];
  let { usuario, usuario_id } = user;

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
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let { pos, user } = sesion;
  const { nombre, id_ambiente, logo, prefijo, id_bodega } = oPos[0];
  const { usuario, usuario_id } = user;

  parametros = {
    nombre,
    usuario,
    usuario_id,
    id_ambiente,
    logo,
    prefijo,
    id_bodega,
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

  let { pos, user } = sesion;
  let { id_ambiente, nombre, logo, prefijo } = oPos[0];
  let { usuario, usuario_id } = user;

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

  let { pos, user } = sesion;

  const { nombre, id_ambiente, logo, prefijo, id_bodega } = oPos[0];
  const { usuario, usuario_id } = user;
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
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let { pos, user } = sesion;
  let { id_ambiente, nombre, impuesto, propina, fecha_auditoria, logo } =
    oPos[0];
  let { usuario, usuario_id } = user;

  parametros = {
    id: id_ambiente,
    amb: nombre,
    user: usuario,
    iduser: usuario_id,
    impto: impuesto,
    prop: propina,
    fecha: fecha_auditoria,
    logo: logo,
  };

  $.ajax({
    url: "informes/devolucionesDelDia.php",
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

function devolucionProductos() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let { pos, user } = sesion;
  let { id_ambiente, nombre, propina, logo, impuesto, fecha_auditoria } =
    oPos[0];
  let { usuario, usuario_id } = user;

  parametros = {
    user: usuario,
    id: id_ambiente,
    amb: nombre,
    iduser: usuario_id,
    impto: impuesto,
    prop: propina,
    fecha: fecha_auditoria,
    logo,
  };

  $.ajax({
    url: "informes/devolucionProductos.php",
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

  let { pos, user } = sesion;
  let { fecha_auditoria } = oPos[0];
  let { usuario } = user;

  user = usuario;
  fecha = fecha_auditoria;

  parametros = {
    comanda,
    inicial,
    cantidad,
    idprod,
    idambi,
    importe,
    impto,
    motivo,
    fecha,
    user,
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

  let { pos, user } = sesion;
  let { id_ambiente, nombre, prefijo } = oPos[0];
  let { tipo, usuario } = user;

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

  let { pos, user } = sesion;
  let { id_ambiente, nombre, prefijo } = oPos[0];
  let { tipo, usuario } = user;

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
  var storageProd = localStorage.getItem("productoComanda");
  let listaComanda = JSON.parse(storageProd);

  var impuesto = 0;
  var venta = 0;
  var canti = 0;
  let propina = 0;
  // let abonos = 0;

  abonos = $("#abonosComanda").val();

  for (i = 0; i < listaComanda.length; i++) {
    canti = canti + 1;
    impuesto = impuesto + parseFloat(listaComanda[i]["valorimpto"]);
    venta = venta + parseFloat(listaComanda[i]["venta"]);
  }

  miBoton = "comanda" + $("#numeroComanda").val();
  total = venta + impuesto + propina - descuento - abonos;
  $("#totalComanda").val(total);
  $("#totalVta").html(number_format(venta, 2));
  $("#totalDesc").html(number_format(descuento, 2));
  $("#totalAbonos").html(number_format(abonos, 2));
  $("#totalCuenta").html(number_format(total, 2));
  $("#valorImpto").html(number_format(impuesto, 2));
  $("#cantProd").val(canti);

  $("#" + miBoton).attr("subtotal", venta);
  $("#" + miBoton).attr("impto", impuesto);
  $("#" + miBoton).attr("descuento", descuento);
  $("#" + miBoton).attr("abonos", abonos);
  $("#" + miBoton).attr("total", total);
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

function verFoto(e) {
  if (e.files && e.files) {
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
  var formData = new FormData($("#formFotoReceta"));
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

function muestraProductoKardex() {
  $("#modalConsultaKardex").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget); // Botón que activó el modal
    var id = button.data("id"); // Extraer la información de atributos de datos
    var bodega = button.data("bodega"); // Extraer la información de atributos de datos
    var nombre = button.data("nombre"); // Extraer la información de atributos de datos
    parametros = {
      id,
      bodega,
    };
    var modal = $(this);
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
  $("#dataUpdateReceta").modal("show");
  $(".modal-title").text("Receta Estandar : " + receta);
  $.ajax({
    url: "res/php/user_actions/updateReceta.php",
    type: "POST",
    data: { id: id },
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
  var total = 0.0;
  var totales = 0.0;

  $("#materiaPrima > tbody > tr").each(function () {
    var total = $(this).find("td").eq(4).html();
    total = parseFloat(total.replaceAll(",", ""));
    totales = totales + total;
  });

  $("#vlrTotal").text(number_format(totales, 2));
}

function saleMP() {
  $("#dataRecetaProducto").modal("hide");
  $(".modal-backdrop").remove();
  $(".modal-open").css("overflow", "auto");
  recetas();
}

function actualizaRece(cod, codigo, regis, regis2) {
  document.getElementById("materiaPrima").deleteRow(codigo);
  $.ajax({
    url: "res/php/user_actions/eliminaComponenteReceta.php",
    type: "POST",
    data: {
      cod,
      regis2,
    },
    success: function () {
      resumenReceta();
    },
  });
}

function guardarReceta() {
  var parametros = $("#guardarDatosReceta").serialize();
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
  let { pos, user } = sesion;
  let { id_ambiente, nombre, impuesto, propina, fecha_auditoria } = oPos[0];
  let { usuario_id, usuario } = user;

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
    let { user } = sesion;
    let { usuario_id } = user;

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
                      <td style="width: 10%;text-align: center">
                        <div class="btn-group" role="group" aria-label="Basic example">
                          <button 
                            id="${idprod}"
                            type="button" 
                            class="btn btn-danger btn-xs"
                            receta='${idrece}'
                            onclick="actualizaRece(this.id,this.parentNode.parentNode.rowIndex,this.receta,${idprod})">
                            <i class="glyphicon glyphicon-trash"></i>
                          </button>
                        </div>
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
  let { user } = sesion;
  let { usuario_id, usuario } = user;

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
        idprod,
        producto,
        cantidad,
        medida,
        valUnita,
        valTotal,
        idrece
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
    data: { id: id },
    success: function (unidad) {
      if (unidad.length > 0) {
        traeUnidad(unidad["unidad_procesa"]);
        can = $("#cantidadRec").val();
        $("#idMedida").val(unidad["unidad_procesa"]);
        $("#valorUni").val(
          number_format(
            unidad["valor_promedio"] / unidad["valor_conversion"],
            2
          )
        );
        $("#valorTot").val(
          number_format(
            can * (unidad["valor_promedio"] / unidad["valor_conversion"]),
            2
          )
        );
        $("#cantidadRec").focus();
      }
    },
  });
}

function traeUnidad(id) {
  $.ajax({
    url: "res/php/user_actions/getTraeUnidad.php",
    type: "POST",
    data: {
      id: id,
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
        $("#productoRec").append(`
          <option value="${data[i]["id_producto"]}">${data[i]["nombre_producto"]}</option>'`);
      }
    },
  });
}

function btnRecetaProducto(id, nombre) {
  $("#dataRecetaProducto").modal("show");
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let { user } = sesion;
  let { usuario_id, usuario } = user;
  user = usuario;
  var producto = nombre;
  $("#nomReceta").val(producto);
  $(".modal-title").html(`Receta Estandar : ${producto}`);
  $("#idusrupd").val(usuario_id);
  $("#idReceta").val(id);
  $.ajax({
    url: "res/php/user_actions/getRecetasProductos.php",
    type: "POST",
    dataType: "json",
    data: {
      id: id,
    },
    beforeSend: function (objeto) {
      $("#materiaPrima > tbody").html("");
    },
    success: function (data) {
      $("#materiaPrima > tbody").html("");
      $("#valorReceta > tbody").html("");
      valorReceta = 0;
      for (i = 0; i < data.length; i++) {
        valorReceta += Number.parseFloat(data[i]["valor_promedio"], 2);
        $("#materiaPrima > tbody").append(`<tr>
          <td class='paddingCelda' align='left'>${
            data[i]["nombre_producto"]
          }</td>
          <td style="text-align:right">${number_format(
            data[i]["cantidad"],
            2
          )}</td>
          <td class='paddingCelda' align='left'>${
            data[i]["descripcion_unidad"]
          }</td>
          <td class='paddingCelda' align='right'>${number_format(
            data[i]["valor_unitario_promedio"],
            2
          )}</td>
          <td class='paddingCelda' align='right'>${number_format(
            data[i]["valor_promedio"],
            2
          )}</td>
          <td class='paddingCelda' align='center'>
            <button id='${data[i]["id"]}' receta='${data[i]["id_receta"]}' 
              class='btn btn-danger btn-xs elimina_articulo' onclick='actualizaRece(this.id,this.parentNode.parentNode.rowIndex,this.receta,"${
                data[i]["id"]
              }");'><i class='glyphicon glyphicon-trash '></i></button>
              </td>
          </tr>`);
      }
      $("#valorReceta > tbody").append(
        "<tr><td>Valor Receta</td><td id='vlrTotal'>" +
          number_format(valorReceta, 2) +
          "</td><td></td></tr>"
      );
    },
  });
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
    let { user } = sesion;
    let { usuario_id } = user;
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
      data: { id: id },
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
  // let { pos } = sesion;
  let { id_ambiente } = oPos[0];
  idamb = id_ambiente;
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
        idamb,
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
  // let { pos } = sesion;
  let { id_ambiente, nombre, impuesto, propina, fecha_auditoria, logo } =
    oPos[0];

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
  // let { pos } = sesion;
  let { id_ambiente, prefijo } = oPos[0];

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

function historicoListadoFacturas() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let { pos, user } = sesion;
  let { id_ambiente, nombre, impuesto, propina, fecha_auditoria, logo } =
    oPos[0];
  let { usuario, usuario_id } = user;

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

  let { pos, user } = sesion;
  let { id_ambiente, nombre, impuesto, propina, fecha_auditoria, logo } =
    oPos[0];
  let { usuario, usuario_id } = user;

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

function ventasHistoricoProductos() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let { pos, user } = sesion;
  let { id_ambiente, nombre, impuesto, propina, fecha_auditoria, logo } =
    oPos[0];
  let { usuario, usuario_id } = user;

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

  let { pos, user } = sesion;
  let { id_ambiente, nombre, impuesto, propina, fecha_auditoria, logo } =
    oPos[0];
  let { usuario, usuario_id } = user;

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
  // let { pos } = sesion;
  let { id_ambiente } = oPos[0];

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

  let { pos, user } = sesion;
  let { id_ambiente, impuesto, propina } = oPos[0];
  let { usuario } = user;

  idamb = id_ambiente;
  impto = impuesto;
  user = usuario;
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

  let { pos, user } = sesion;
  let { id_ambiente, impuesto, propina } = oPos[0];
  let { usuario } = user;

  idamb = id_ambiente;
  impto = impuesto;
  user = usuario;
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

  let { pos, user } = sesion;
  let { id_ambiente, impuesto, propina } = oPos[0];
  let { usuario } = user;

  idamb = id_ambiente;
  impto = impuesto;
  user = usuario;
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
    codigo: codigo,
    ambi: ambi,
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
  // let { pos } = sesion;
  let { id_ambiente } = oPos[0];
  $("#loader").fadeIn("slow");
  $.ajax({
    type: "POST",
    url: "res/php/user_actions/getSeccionRecu.php",
    data: {
      id: id_ambiente,
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
  let { pos, user } = sesion;
  let { id_ambiente, nombre, impuesto, propina, fecha_auditoria } = oPos[0];
  let { usuario, usuario_id } = user;

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
  let { pos, user } = sesion;
  let { id_ambiente, nombre, impuesto, propina, fecha_auditoria } = oPos[0];
  let { usuario, usuario_id } = user;

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

// seccionList
function recuperarCuenta() {
  $("#recuperarComanda").val(1);
  $("#listaComandas").css("display", "none");
  // $("#Escritorio").css("margin-left", "0");
  $("#productoList").css("display", "block");
  $("#guardaCuenta").css("display", "block");
  $("#recuperaCuenta").css("display", "none");
  $(".btnActivo").css("display", "none");
  $("#regresarComanda").css("margin-top", "418px");
  $("#productosComanda").css("height", "428px");

  $("#seccionList").css("display", "block");
  // $("#seccionList").css("margin-top", "5px");
  $("#tituloComanda").removeClass("col-lg-12");
  $("#tituloComanda").addClass("col-lg-6");
  $("#tituloBusca").css("display", "block");

  $("#ventasList").removeClass("col-lg-6 col-md-6");
  $("#ventasList").addClass("col-lg-5 col-md-5");
  $("#muestraNumero").addClass("col-lg-5 col-md-5 col-xs-12");
  $("#muestraNumero2").addClass("col-lg-12 col-md-12 col-xs-12");
  $("#muestraComanda").addClass("col-lg-7 col-md-7 col-xs-12");
  $("#tituloComanda").html(
    "<h4 style='padding:2px;text-align: center;font-weight: bold;margin:0'>Tipo de Producto</h4>"
  );

  idamb = $("#idAmbiente").val();
  getSecciones();
  cuenta = $("#numeroComanda").val();
  sesion = JSON.parse(localStorage.getItem("sesion"));
}

function muestraPos(ambSel) {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let { user, pos } = sesion;
  let { tipo, apellidos, nombres } = user;
  let { plano, fecha_auditoria } = oPos[0];
  $("#fechaPos").html(`Fecha Proceso ${fecha_auditoria}`);
  $("#fechaAuditoria").val(fecha_auditoria);

  $.ajax({
    url: "res/php/user_actions/muestraPos.php",
    type: "POST",
    data: {
      ambSel,
      tipousr: tipo,
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
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let { pos, user } = sesion;
  let { id_ambiente, nombre, impuesto, propina, fecha_auditoria, logo } =
    oPos[0];
  let { usuario, usuario_id } = user;

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
    url: "informes/ventasPorGrupo.php",
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

  let { pos, user } = sesion;
  let { id_ambiente, nombre, impuesto, propina, fecha_auditoria, logo } =
    oPos[0];
  let { usuario, usuario_id } = user;

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
    url: "informes/ventasPorPeriodo.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      creaHTMLReportes(data, `Ventas Por Peridodo de Servicio `);
    },
  });
}

function buscaReportesCajero() {
  var fecha = $("#buscarFecha").val();
  var user = $("#usuario").val();

  $("#verFactura").attr("data", "");

  var repo = "cierre_Cajero_" + user + "_" + fecha + ".pdf";
  $("#verFactura").attr("data", "imprimir/cierres/" + repo);
}

function historicoCajeros() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let { pos, user } = sesion;
  let { id_ambiente, nombre, impuesto, propina, fecha_auditoria, logo } =
    oPos[0];
  let { usuario, usuario_id } = user;

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

  // let { pos } = sesion;
  let { id_ambiente } = oPos[0];

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
  let { pos, user } = sesion;
  let { id_ambiente, nombre, impuesto, propina, fecha_auditoria, logo } =
    oPos[0];
  let { usuario, usuario_id } = user;

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
  let { pos, user } = sesion;
  let { id_ambiente, nombre, impuesto, propina, fecha_auditoria, logo } =
    oPos[0];
  let { usuario, usuario_id } = user;
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

  let { pos, user } = sesion;
  let { id_ambiente, nombre, impuesto, propina, fecha_auditoria, logo } =
    oPos[0];
  let { usuario, usuario_id } = user;

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
    url: "informes/ventasFormaPago.php",
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

  let { pos, user } = sesion;
  let { id_ambiente, nombre, impuesto, propina, fecha_auditoria, logo } =
    oPos[0];
  let { usuario, usuario_id } = user;
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
      $("#verInforme").attr("data", "imprimir/informes/" + oKey + ".pdf");
    },
  });
}

function ventasProducto() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let { pos, user } = sesion;
  let { id_ambiente, nombre, impuesto, propina, fecha_auditoria, logo } =
    oPos[0];
  let { usuario, usuario_id } = user;

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
    url: "informes/ventasPorProducto.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      creaHTMLReportes(data, `Ventas Por Producto`);
    },
  });
}

function ventasDiaAuditoria() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let { pos, user } = sesion;
  let { id_ambiente, nombre, impuesto, propina, fecha_auditoria, logo } =
    oPos[0];
  let { usuario, usuario_id } = user;

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
    url: "informes/ventasDia.php",
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

  let { pos, user } = sesion;
  let { id_ambiente, nombre, impuesto, propina, fecha_auditoria, id_bodega } =
    oPos[0];
  let { usuario, usuario_id } = user;

  parametros = {
    id: id_ambiente,
    amb: nombre,
    user: usuario,
    iduser: usuario_id,
    impto: impuesto,
    prop: propina,
    fecha: fecha_auditoria,
    bodega: id_bodega,
  };

  $.ajax({
    url: "views/kardex.php",
    type: "POST",
    datatype: "json",
    data: parametros,
    success: function (data) {
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

  let { pos, user } = sesion;
  let { id_ambiente, nombre, impuesto, propina, fecha_auditoria } = oPos[0];
  let { usuario, usuario_id } = user;

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

function cierreDiarioAuditoria() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let { pos, user } = sesion;
  let {
    id_ambiente,
    nombre,
    impuesto,
    propina,
    fecha_auditoria,
    logo,
    prefijo,
  } = oPos[0];
  let { usuario, usuario_id } = user;

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

function cuentasAnuladasAuditoria() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let { pos, user } = sesion;
  let { id_ambiente, nombre, impuesto, propina, fecha_auditoria, id_bodega } =
    oPos[0];
  let { usuario, usuario_id, tipo } = user;
  let file = makeid(12);

  parametros = {
    id: id_ambiente,
    amb: nombre,
    user: usuario,
    iduser: usuario_id,
    nivel: tipo,
    impto: impuesto,
    prop: propina,
    fecha: fecha_auditoria,
    logo,
    file,
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
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let { pos, user } = sesion;
  let {
    id_ambiente,
    nombre,
    impuesto,
    propina,
    fecha_auditoria,
    id_bodega,
    logo,
  } = oPos[0];
  let { usuario, usuario_id, tipo } = user;

  parametros = {
    id: id_ambiente,
    amb: nombre,
    user: usuario,
    iduser: usuario_id,
    nivel: tipo,
    impto: impuesto,
    prop: propina,
    fecha: fecha_auditoria,
    logo,
  };

  $.ajax({
    url: "informes/cuentasActivas.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      creaHTMLReportes(data, `Comandas Activas del Dia`);
    },
  });
}

function cuentasAnuladasAuditoria() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let { pos, user } = sesion;
  let { id_ambiente, nombre, impuesto, propina, fecha_auditoria, logo } =
    oPos[0];
  let { usuario, usuario_id } = user;

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
    url: "informes/cuentasAnuladas.php",
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

  let { pos, user } = sesion;
  let {
    id_ambiente,
    nombre,
    impuesto,
    propina,
    fecha_auditoria,
    id_bodega,
    logo,
  } = oPos[0];
  let { usuario, usuario_id, tipo } = user;

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

  let { pos, user } = sesion;
  let {
    id_ambiente,
    nombre,
    impuesto,
    propina,
    fecha_auditoria,
    id_bodega,
    logo,
  } = oPos[0];
  let { usuario, usuario_id, tipo } = user;

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

  let { pos, user } = sesion;
  let { id_ambiente, nombre, impuesto, propina, fecha_auditoria, logo } =
    oPos[0];
  let { usuario, usuario_id, tipo } = user;

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
    url: "informes/facturasAnuladasCajero.php",
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

  let { pos, user } = sesion;
  let { id_ambiente, nombre, impuesto, propina, fecha_auditoria, logo } =
    oPos[0];
  let { usuario, usuario_id, tipo } = user;

  console.log({
    id_ambiente,
    nombre,
    impuesto,
    propina,
    fecha_auditoria,
    logo,
  });
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
  console.log(parametros);

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

  let { pos, user } = sesion;
  let { id_ambiente, nombre, impuesto, propina, fecha_auditoria, logo } =
    oPos[0];
  let { usuario, usuario_id, tipo } = user;

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
    url: "informes/facturasCajero.php",
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

  let { pos, user } = sesion;
  let { id_ambiente, nombre, impuesto, propina, fecha_auditoria, logo } =
    oPos[0];
  let { usuario, usuario_id, tipo } = user;

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
    url: "informes/devolucionesCajero.php",
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

  let { pos, user } = sesion;
  let { id_ambiente, nombre, impuesto, propina, fecha_auditoria, logo } =
    oPos[0];
  let { usuario, usuario_id, tipo } = user;
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

  let { pos, user } = sesion;
  let { id_ambiente, nombre, impuesto, propina, fecha_auditoria, logo } =
    oPos[0];
  let { usuario, usuario_id, tipo } = user;

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

  let { pos, user } = sesion;
  let { id_ambiente, nombre, impuesto, propina, fecha_auditoria, logo } =
    oPos[0];
  let { usuario, usuario_id, tipo } = user;
  let file = makeid(12);

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
    url: "informes/cuentasAnuladasCajero.php",
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

  let { pos, user } = sesion;
  let { id_ambiente, nombre, impuesto, propina, fecha_auditoria, logo } =
    oPos[0];
  let { usuario, usuario_id, tipo } = user;
  let file = makeid(12);

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
    url: "informes/cuentasActivasCajero.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      creaHTMLReportes(data, `Comandas Activas Cajero ${usuario}`);
    },
  });
}

function creaHTMLReportes(data, titulo) {
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

  let { pos, user } = sesion;
  let { id_ambiente, nombre, impuesto, propina, fecha_auditoria, logo } =
    oPos[0];
  let { usuario, usuario_id, tipo } = user;
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

function cuentasActivas() {
  var alto = screen.height;
  var ancho = screen.width;
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let { pos, user } = sesion;
  let {
    id_ambiente,
    nombre,
    impuesto,
    propina,
    fecha_auditoria,
    prefijo,
    logo,
  } = oPos[0];
  let { usuario, tipo } = user;

  parametros = {
    id: id_ambiente,
    amb: nombre,
    user: usuario,
    nivel: tipo,
    impto: impuesto,
    prop: propina,
    fecha: fecha_auditoria,
    prefijo,
  };
  $(".btn-menu").css("display", "block");

  $.ajax({
    url: "ventas/cuentas_activas.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $("#pantalla").html(data);
      $(".prende").css("display", "none");
      $("#productosComanda").css("height", alto - 334);
      $("#imprimeComanda").css("margin-top", "31px");
    },
  });
}

function muestraTouch() {
  var alto = screen.height;
  var ancho = screen.width;
  let abonos = 0;
  let propina = 0;
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let { pos, user } = sesion;
  let { usuario } = user;
  let { id_ambiente, nombre, impuesto, prefijo, fecha_auditoria } = oPos[0];
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
      $("#productosComanda").css("height", alto - 320);
    },
  });
}

function calcular_total() {
  var coma = $("#numeroComanda").val();
  miBoton = "#comanda" + coma;

  propina = parseFloat($("#propinaPag").val().replaceAll(",", ""));

  subtotal = parseFloat($(miBoton).attr("subtotal"));
  impuesto = parseFloat($(miBoton).attr("impto"));
  descuento = parseFloat($(miBoton).attr("descuento"));
  abonos = parseFloat($(miBoton).attr("abonos"));
  total = parseFloat($(miBoton).attr("total"));

  $("#montopago").val(subtotal + propina - descuento - abonos);
}

function calcular_totalDir() {
  total = parseFloat($("#totalDir").val().replaceAll(",", ""));
  totalini = parseFloat($("#totaliniDir").val());
  propina = parseFloat($("#propinaDir").val().replaceAll(",", ""));
  total = totalini + propina;
  $("#totalDir").val(number_format(total, 2));
  $("#montopagoDir").val(total);
}

function activaMenus() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let { pos, user } = sesion;
  let { apellidos, nombres } = user;
  let { fecha_auditoria } = oPos[0];
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

function ingresoPos() {
  sesion = JSON.parse(localStorage.getItem("sesion"));

  let { cia, user } = sesion;
  let { inv, pos } = cia;
  let { usuario_id, apellidos, nombres, estado_usuario_pos, tipo } = user;

  $("#idUsuario").val(usuario_id);

  if (inv == 1 && tipo <= 2) {
    $("#menuInve").css("display", "block");
  }
  if (tipo <= 1) {
    $("#menuKardex").css("display", "block");
  }

  if (tipo <= 2) {
    $("#menuAudi").css("display", "block");
    $("#menuHist").css("display", "block");
    $("#menuMovi").css("display", "block");
    $("#menuDiar").css("display", "block");
    $("#menuInfo").css("display", "block");
    $("#menuInfoCaje").css("display", "block");
  }

  if (tipo <= 3) {
    $("#menuCaje").css("display", "block");
    $("#menuDatos").css("display", "block");
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
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let { pos, user } = sesion;
  let { fecha_auditoria } = oPos[0];
  let { nombres, apellidos } = user;
  $("#fechaAuditoria").val(fecha_auditoria);
  /*
  $("#nombreUsuario").html(
    `${apellidos} ${nombres} <span class="caret"></span>`
  ); */
}

function cierreCajero(user) {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  // let { user, pos } = sesion;
  let { usuario_id, usuario } = user;
  let { fecha_auditoria, id_ambiente, nombre, logo } = oPos[0];

  var web = $("#rutaweb").val();
  var parametros = {
    usuario_id,
    usuario,
    fecha_auditoria,
    id_ambiente,
    nombre,
    logo,
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

  let { pos, user } = sesion;
  let { id_ambiente, prefijo } = oPos[0];

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

function enviaInicio() {
  localStorage.removeItem("productoComanda");
  oPos = JSON.parse(localStorage.getItem("oPos"));
  // let { pos } = sesion;
  let { id_ambiente } = oPos[0];
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
    console.log(error);
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
    console.log(error);
  }
};

async function cierreDiario() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let { user, pos } = sesion;
  const { usuario, usuario_id } = user;
  const { fecha_auditoria, id_ambiente, prefijo, nombre, logo } = oPos[0];

  const sinsalir = await mesasSinSalir(fecha_auditoria, id_ambiente);
  if (sinsalir !== 0) {
    mesasActivas(fecha_auditoria, id_ambiente);
    return;
  }

  $("#botonCierre").attr("disabled", "disabled");

  const mensaje = await mensajeAuditoria(
    "Procesando Informacion, No Interrumpa "
  );
  const backup = await fetch("auditoria/backupDiario.php", {
    method: "post",
    headers: {
      "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
    },
    body: "fecha=" + fecha_auditoria + "&prefijo=" + prefijo,
  });
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
        cierraSesion();
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
  console.log(parametros);
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

  let { pos, user } = sesion;
  let { id_ambiente, nombre, impuesto, propina, fecha_auditoria, logo } =
    oPos[0];
  let { usuario, tipo } = user;

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
  // let { pos } = sesion;
  let { id_ambiente } = oPos[0];

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
      localStorage.setItem("oPos", JSON.stringify(data));
      muestraPos(codigo);
    },
  });
}

function getSecciones() {
  oPos = JSON.parse(localStorage.getItem("oPos"));
  // let { pos } = sesion;
  let { id_ambiente } = oPos[0];
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
      $("#seccionList").html("");
      $("#seccionList").css("min-height", 120);
      $("#seccionList").css("height", alto - 262);
      for (i = 0; i < data.length; i++) {
        boton = `
        <button 
          class="btn btn-success btnPos btnSecc" 
          onClick="getProducto(this.name,${id_ambiente});" 
          type="button" name='${data[i]["id_seccion"]}'  
          title="${data[i]["nombre_seccion"]}">
          <span>${data[i]["nombre_seccion"]}</span> 
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
}

function productosActivos() {
  numero = $("#numeroComanda").val();
  recuperar = $("#recuperarComanda").val();
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let { user } = sesion;
  let { usuario, tipo } = user;

  $(".comanda > tbody").html("");
  listaComanda.map((productos) => {
    let { id, producto, cant, total, codigo, ambiente } = productos;
  });

  for (i = 0; i < listaComanda.length; i++) {
    if (numero == 0) {
      $(".comanda > tbody").append(
        `<tr>
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
          `<tr>
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
            class="fa fa-share btn btn-danger btn-xs"
            title="Devolver Producto Uno">
          </button>
          </td>
        </tr>`
        );
        if (tipo > 3) {
          $(".btnDevuelve").remove();
          $(".btnDevuelve").css("disabled", "disabled");
        }
      } else {
        if (listaComanda[i]["activo"] == 1) {
          $(".comanda > tbody").append(
            `<tr>
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
                  class="fa fa-share btn btn-danger btn-xs"
                  title="Devolver Producto Dos">
                </button>
              </td>
          </tr>`
          );
          if (tipo > 3) {
            $(".btnDevuelve").remove();
            $(".btnDevuelve").css("disabled", "disabled");
          }
        } else {
          $(".comanda > tbody").append(
            `<tr>
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
  // let { pos } = sesion;
  let { impuesto } = oPos[0];

  imptoInc = impuesto;
  nohay = true;

  for (i = 0; i < listaComanda.length; i++) {
    if (listaComanda[i]["codigo"] === idp && listaComanda[i]["activo"] === 0) {
      canti = listaComanda[i]["cant"] + 1;
      totve = canti * listaComanda[i]["importe"];
      if (imptoInc == 0) {
        porImpto = 0;
      } else {
        porImpto = listaComanda[i]["impto"];
      }
      subt = Math.round(
        (canti * listaComanda[i]["importe"]) / (1 + porImpto / 100),
        0
      );
      impto = canti * listaComanda[i]["importe"] - subt;
      listaComanda[i]["valorimpto"] = impto;

      subt = Math.round(subt);

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
    subt = (val * 1) / (1 + imp / 100);
    subt = Math.round(subt);
    impuesto = val * 1 - subt;

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
    };
    listaComanda.push(dataProd);
  }
  localStorage.setItem("productoComanda", JSON.stringify(listaComanda));

  productosActivos();
  resumenComanda();
}

function getRestarVentas(codigo, index) {
  if (listaComanda[codigo]["cant"] == 1) {
    getBorraVentas(codigo, index);
  } else {
    canti = listaComanda[index - 1]["cant"] - 1;
    subt =
      (canti * listaComanda[index - 1]["importe"]) /
      (1 + listaComanda[index - 1]["impto"] / 100);
    totve = canti * listaComanda[index - 1]["importe"];
    subt = Math.round(subt);
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
  canti = listaComanda[index - 1]["cant"] + 1;
  totve = canti * listaComanda[index - 1]["importe"];
  subt =
    (canti * listaComanda[index - 1]["importe"]) /
    (1 + listaComanda[index - 1]["impto"] / 100);
  subt = Math.round(subt);
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
  listaComanda.splice(codigo, 1);
  localStorage.setItem("productoComanda", JSON.stringify(listaComanda));
  productosActivos();
  resumenComanda();
}

function buscar() {
  var alto = screen.height;
  var ancho = screen.width;
  oPos = JSON.parse(localStorage.getItem("oPos"));
  // let { pos } = sesion;
  let { id_ambiente } = oPos[0];

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
      $("#clientes option").remove();
      $("#clientes").append(data);
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

function getCuentasActivas(idamb) {
  var alto = screen.height;
  var ancho = screen.width;
  oPos = JSON.parse(localStorage.getItem("oPos"));
  // let { pos } = sesion;
  let { fecha_auditoria } = oPos[0];

  var parametros = {
    idamb,
    fecha: fecha_auditoria,
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
      $("#listaComandas").css("height", alto - 250);

      x.map(function (y) {
        let { comanda, cliente, abonos } = y;
      });
      /*       
      listaNuevaComanda.map(function (productos) {
        impuesto = impuesto + parseFloat(productos.valorimpto);
        ventaDiv = ventaDiv + parseFloat(productos.venta);
        cantiDiv = cantiDiv + parseFloat(productos.cant);
      }); 
      */

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
            <h3>Mesa ${x[i]["mesa"]}</h3>
            <h3>Comanda ${number_format(x[i]["comanda"], 0)}</h3>
            </button>`;
        $("#listaComandas").append(boton);

        $("#" + miBoton).attr("subtotal", x[i]["subtotal"]);
        $("#" + miBoton).attr("impto", x[i]["impuesto"]);
        $("#" + miBoton).attr("descuento", x[i]["valor_descuento"]);
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
  let { pos, user } = sesion;
  let { id_ambiente, nombre, impuesto, propina, prefijo, fecha_auditoria } =
    oPos[0];
  let { usuario, tipo } = user;
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
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let { pos, user } = sesion;
  let { id_ambiente, nombre, impuesto, propina, prefijo, fecha_auditoria } =
    oPos[0];
  let { usuario, tipo } = user;

  miBoton = "#" + comanda;
  subtotal = parseInt($(miBoton).attr("subtotal"));
  impuesto = parseFloat($(miBoton).attr("impto"));
  propina = parseFloat($(miBoton).attr("propina"));
  descuento = parseFloat($(miBoton).attr("descuento"));
  abonos = parseFloat($(miBoton).attr("abonos"));
  total = parseFloat($(miBoton).attr("total"));
  mesa = parseFloat($(miBoton).attr("mesa"));
  pax = parseFloat($(miBoton).attr("pax"));

  // console.log(abonos);

  listaComanda = [];

  var parametros = {
    comanda: numero,
    user: usuario,
    nivel: tipo,
    nomamb: nombre,
    idamb: id_ambiente,
    impto: impuesto,
    prop: propina,
    pref: prefijo,
    fecha: fecha_auditoria,
  };
  $("#numeroComanda").val(numero);
  $("#abonosComanda").val(abonos);
  $("#descuentosComanda").val(descuento);
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
      $("#tituloNumero").removeClass("alert-info");
      $("#tituloNumero").addClass("alert-success");
      $("#tituloNumero").html(`Comanda Numero ${numero}`);
      $("#guardaComandaDividida").css("display", "none");
      for (i = 0; i < data.length; i++) {
        dataProd = {
          producto: data[i]["nom"],
          cant: parseInt(data[i]["cant"]),
          importe: parseInt(data[i]["importe"]),
          total: parseInt(data[i]["importe"] * data[i]["cant"]),
          codigo: parseInt(data[i]["producto_id"]),
          descuento: parseInt(data[i]["descuento"]),
          venta: parseInt(data[i]["venta"]),
          impto: parseInt(data[i]["impto"]),
          id: parseInt(data[i]["id"]),
          valorimpto: parseInt(data[i]["valorimpto"]),
          ambiente: parseInt(id_ambiente),
          activo: 1,
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
  var coma = $("#numeroComanda").val();
  miBoton = "#comanda" + coma;

  propina = parseFloat($("#propinaPag").val().replaceAll(",", ""));
  subtotal = parseFloat($(miBoton).attr("subtotal"));
  impuesto = parseFloat($(miBoton).attr("impto"));
  descuento = parseFloat($(miBoton).attr("descuento"));
  abonos = parseFloat($(miBoton).attr("abonos"));
  total = parseFloat($(miBoton).attr("total"));

  pagado = parseFloat($("#montopago").val().replaceAll(",", ""));
  cambio = subtotal + impuesto + propina - descuento - abonos - pagado;

  $("#cambio").val(cambio);

  if (cambio == 0) {
    $("#resultado").html(
      `<label name='resultado' class='avisoVta avisCambio alert alert-success'>SALDO PENDIENTE ${cambio}</label>`
    );
  }
  if (cambio > 0) {
    $("#resultado").html(
      `<label name='resultado' class='avisoVta avisCambio alert alert-danger'>SALDO PENDIENTE $ ${cambio}</label>`
    );
  }
  if (cambio < 0) {
    $("#resultado").html(
      `<label name='resultado' class='avisoVta avisCambio alert alert-info'>VUELTAS/CAMBIO $ ${
        cambio * -1
      }</label>`
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
      `<label name='resultadoDir' class='avisoVta avisCambio alert alert-success'>SALDO PENDIENTE ${cambio}</label>`
    );
  }
  if (cambio > 0) {
    $("#resultadoDir").html(
      `<label name='resultadoDir' class='avisoVta avisCambio alert alert-danger'>SALDO PENDIENTE $ ${cambio}</label>`
    );
  }
  if (cambio < 0) {
    $("#resultadoDir").html(
      `<label name='resultadoDir' class='avisoVta avisCambio alert alert-info'>VUELTAS/CAMBIO $ ${
        cambio * -1
      }</label>`
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
