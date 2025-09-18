document.addEventListener("DOMContentLoaded", async () => {
  // sesion = JSON.parse(localStorage.getItem("sesion"));

  let sesion = JSON.parse(localStorage.getItem("sesion"));
  // let oPos = JSON.parse(localStorage.getItem("oPos"));
  // console.log(oPos);
  const {
    user: { usuario, usuario_id, tipo },
    cia: { impuesto },
  } = sesion;
  /* const { id_ambiente, nombre, fecha_auditoria } = oPos;
  if (oPos) {
  } */
  /* console.log({ usuario, usuario_id });
  console.log({ id_ambiente, nombre, fecha_auditoria }); */
});
function calculaRoomService() {
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let { servicio } = oPos;
  subtota = document.querySelector("#subtotal").value;
  roomSer = (subtota * servicio) / 100;

  if (document.querySelector("#servicio").value == 0) {
    document.querySelector("#roomService").value = roomSer.toFixed(0);
    document.querySelector("#servicio").value = roomSer.toFixed(0);
  } else {
    document.querySelector("#roomService").value = 0;
    document.querySelector("#servicio").value = 0;
  }

  calcular_total();
}

function guardarProductosOriginal() {
  var productos = JSON.parse(localStorage.getItem("productoComanda"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let { pos, user } = sesion;
  let { id_ambiente, nombre, impuesto, fecha_auditoria } = oPos;
  let { usuario } = user;

  var regis = $("#cantProd").html();
  var pax = $("#numPax").val();
  var mesa = $("#nromesas").val();
  var cliente = $("#nombreCliente").val();
  let comanda = $("#numeroComanda").val();

  var parametros = {
    pax,
    mesa,
    cliente,
    comanda,
    user: usuario,
    idamb: id_ambiente,
    imptoInc: impuesto,
    nomamb: nombre,
    fecha: fecha_auditoria,
    productos,
  };

  $.ajax({
    type: "POST",
    data: parametros,
    url: "res/php/user_actions/getGuardaComandaOriginal.php",
    success: function (datos) {},
  });
}

function imprimeComandaDiv() {
  var productos = JSON.parse(localStorage.getItem("nuevaComanda"));
  $.ajax({
    url: "res/php/user_actions/imprimeComanda.php",
    type: "POST",
    data: {
      productos,
    },
    success: function (data) {
      imprime = $.trim(data);
      var ventana = window.open(
        "impresiones/" + imprime,
        "PRINT",
        "height=600,width=600"
      );
    },
  });
}

function guardarProductosDiv() {
  var productos = JSON.parse(localStorage.getItem("nuevaComanda"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let { pos, user } = sesion;
  let { id_ambiente, nombre, impuesto, fecha_auditoria } = oPos;
  let { usuario } = user;
  let regis = $("#cantProd").html();
  let pax = $("#canpax").val();
  let mesa = $("#mesaDivide").val();
  let cliente = $("#nombreClienteDiv").val();

  var parametros = {
    pax,
    mesa,
    cliente,
    user: usuario,
    idamb: id_ambiente,
    imptoInc: impuesto,
    nomamb: nombre,
    fecha: fecha_auditoria,
    productos,
  };

  $.ajax({
    type: "POST",
    data: parametros,
    url: "res/php/user_actions/getGuardaComanda.php",
    success: function (datos) {
      $("#numeroComandaDiv").val(datos);
      $("#nroComandaDiv").val(datos);
      $("#tituloComanda").addClass("alert-success");
      $("#tituloComanda").html(
        `<h4 style="padding:2px;text-align: center;font-weight: bold;margin:0">Comandas Nro  ${datos} Guardada Con Exito</h4>`
      );
    },
  });
}

function guardaClienteComandaDiv() {
  var productos = JSON.parse(localStorage.getItem("nuevaComanda"));

  $("#myModalClienteComandaDiv").modal("hide");
  $("#btnGuardaClienteDiv").attr("disabled", "disabled");
  var regis = $("#cantProd").html();
  var pax = $("#canpax").val();
  var mesa = $("#mesaDivide").val();
  var cliente = $("#nombreCliente").val();
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let { id_ambiente } = oPos;

  guardarProductosDiv();
  guardarProductosOriginal();
  setTimeout(function () {
    imprime = imprimeComandaDiv();
    nuevoNumero = $("#nroComandaDiv").val();
    localStorage.removeItem("nuevaComanda");
    localStorage.removeItem("comandaOriginal");
    localStorage.removeItem("productosComanda");
    swal(
      {
        title: "Comanda Dividida con Exito",
        text: "Nueva Cuenta Nro " + nuevoNumero,
        type: "success",
        confirmButtonText: "Aceptar",
      },
      function () {
        getSeleccionaAmbiente(id_ambiente);
      }
    );
  }, 1000);
}

function guardarCuentaDividida() {
  var productos = localStorage.getItem("nuevaComanda");
  var productosOriginal = localStorage.getItem("productoComanda");

  let listaNuevaComanda = JSON.parse(productos);
  if (listaNuevaComanda.length === 0) {
    swal("Atencion", "Sin Productos Para Crear nueva Comanda", "warning");
    return;
  }
  if (productosOriginal.length === 0) {
    swal(
      "Atencion",
      "Sin Productos En la Comanda de Origen, no Permitido Dividir esta Comanda",
      "warning"
    );
    return;
  }

  $("#myModalClienteComandaDiv").modal("show");
}

function abonoComanda() {
  var comanda = $("#numeroComanda").val();
  var monto = +$("#montoAbono").val();
  let comenta = $("#comentarios").val();
  let fpago = $("#formapagoAbono").val();
  let textopago = $("#formapagoAbono option:selected").text();
  var productos = JSON.parse(localStorage.getItem("productoComanda"));

  mBoton = "#comanda" + $("#numeroComanda").val();
  abonos = abonos + monto;
  $(mBoton).attr("abonos", abonos);

  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    pos,
    user: { usuario, usuario_id },
  } = sesion;
  let { id_ambiente, nombre, fecha_auditoria, logo } = oPos;

  var parametros = {
    user: usuario,
    idusr: usuario_id,
    idamb: id_ambiente,
    nomamb: nombre,
    fecha: fecha_auditoria,
    logo,
    comanda,
    monto,
    fpago,
    productos,
    textopago,
    comenta,
  };

  $.ajax({
    type: "POST",
    data: parametros,
    url: "res/php/user_actions/ingresaAbono.php",
    success: function (datos) {
      var ventana = window.open(
        "impresiones/" + $.trim(datos),
        "PRINT",
        "height=600,width=600"
      );
    },
  });

  totabono = abonos + monto;
  $("#abonosComanda").val(totabono);
  $("#totalAbonos").val(totabono);
  resumenComanda();

  $("#myModalAbonos").modal("hide");
}

function botonPagarDirecto() {
  var productos = JSON.parse(localStorage.getItem("productoComanda"));
  let mesa = $("#nromesas").val();
  if (productos == null) {
    swal("Precaucion", "Sin Productos Asociados a esta comanda", "warning");
    return;
  }
  let total = parseFloat($("#totalCuenta").html().replace(",", ""));
  let impto = parseFloat($("#valorImpto").html().replace(",", ""));

  $("#myModalPagarDirecto").modal("show");
  $("#formapagoDir").val("");
  $("#clientesDir").val("");
  $("#totalDir").val(number_format(total, 2));
  $("#totalImpDir").val(number_format(impto, 2));
  $("#totaliniDir").val(total);
  $("#montopagoDir").val(total);
  $("#mesaDir").val(mesa);
  $("#resultadoDir").html("");
}

function pagarFacturaDirecto() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    pos,
    user: { usuario, usuario_id },
  } = sesion;
  let { id_ambiente, impuesto, nombre, fecha_auditoria } = oPos;

  let productos = JSON.parse(localStorage.getItem("productoComanda"));
  let comanda = $("#pagarCuentaDirecto").serializeArray();
  let pax = $("#numPax").val();
  let mesa = $("#nromesas").val();
  let config = {
    iduser: usuario_id,
    user: usuario,
    idamb: id_ambiente,
    imptoIncl: impuesto,
    nomamb: nombre,
    fecha: fecha_auditoria,
    mesa,
    pax,
    productos,
    comanda,
  };

  $.ajax({
    url: "res/php/user_actions/getGuardaComandaDirecta.php",
    type: "POST",
    data: config,
  }).done(function (info) {
    $("#myModalPagarDirecto").modal("hide");

    imprimeFactura();
    descargarInventario();
    limpiaLista();
    enviaInicio();
  });
}

async function pagarFactura() {
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let { id_ambiente } = oPos;
  let comanda = $("#numeroComanda").val();

  let pago = +parseFloat($("#montopago").val().replace(",", ""));
  let totalCta = +$("#totalCuentPag").val();
  let roomservice = $("#servicio").val();

  if (totalCta - pago <= 0) {
    let numero = await guardaFactura();
    console.log(numero)

    let impre = await imprimeFactura(numero);
    let ver = await muestraFactura(impre);
    let inven = await descargarInventario(comanda, numero);
    let limpia = await limpiaLista();
    await mensaje();
    await enviaInicio();

    /* 
    setTimeout(function () {

      $("#myModalPagar").modal("hide");
      campo = "#comand" + $.trim(numero);
      $(campo).remove();
    }, 1000); */
  } else {
    swal(
      "Precaucion",
      "El Valor Pagado es menor al Total de la Presente Cuenta ",
      "warning"
    );
  }
}

async function mensaje() {
  swal({
    title: "Pago Realizado con Exito",
    type: "success",
    confirmButtonText: "Aceptar",
  });
}

async function muestraFactura(imprime) {
  let ventana = window.open(
    "impresiones/" + imprime,
    "PRINT",
    "height=600,width=600"
  );
}

function guardarCuentaRecuperadaPlano() {
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let { pos, user: { usuario }, } = sesion;
  let { id_ambiente, impuesto, nombre, fecha_auditoria } = oPos;

  imptoIncl = impuesto;

  $("#recuperarComanda").val(0);
  $("#guardaCuenta").css("display", "none");
  $("#recuperaCuenta").css("display", "block");
  $("#listaComandas").css("display", "block");
  $("#productoList").css("display", "none");
  $("#guardaComandaDividida").css("display", "none");

  $(".menuComanda").css("padding", "0");
  $("#guardaCuenta").css("display", "none");
  $("#recuperaCuenta").css("display", "block");
  $(".btnActivo").css("display", "block");
  $("#seccionList").css("display", "none");

  $("#ventasList").removeClass("col-lg-5 col-md-5 col-xs-12");
  $("#ventasList").addClass("col-lg-7 col-md-8 col-xs-8");
  $("#muestraNumero").removeClass("col-lg-5 col-md-5 col-xs-12");
  $("#muestraNumero").addClass("col-lg-7 col-md-7 col-xs-12");
  $("#muestraComanda").removeClass("col-lg-7 col-md-7 col-xs-12");
  $("#muestraComanda").addClass("col-lg-5 col-md-5 col-xs-12");
  $("#tituloComanda").html("Comandas Activas");
  $("#regresarComanda").css("margin-top", "0px");

  let comanda = $("#numeroComanda").val();
  let recuperar = $("#recuperarComanda").val();
  let productos = JSON.parse(localStorage.getItem("productoComanda"));
  let recuento = productos.filter((item) => item.activo === 0).length;
  if (recuento == 0) {
    swal({
      title: "Precaucion",
      text: "Sin Prodcutos Adicionados a la Comanda",
      type: "warning",
    });
    limpiaLista();
    enviaInicio();

    return;
  }

  var parametros = {
    usuario,
    id_ambiente,
    imptoIncl,
    nombre,
    fecha_auditoria,
    comanda,
    productos,
  };

  $.ajax({
    type: "POST",
    data: parametros,
    url: "res/php/user_actions/getGuardaComandaRecu.php",
    beforeSend: function (objeto) {},
    success: function (datos) {
      imprime = imprimeComandaVenRecu(comanda);
      setTimeout(() => {
        enviaInicio();
      }, 3000);
      $("#productosComanda >table >tbody >tr").remove();
      var productos = localStorage.getItem("productoComanda");
      if (productos == null) {
        listaComanda = [];
      } else {
        listaComanda = JSON.parse(productos);
      }
      limpiaLista();
      enviaInicio();
    },
  });
}
/* 
function botonAnulaFactura(factura, amb, numeroMovi) {
  $("#myModalAnulafactura").modal("show");
  $("#comanda").val(factura);
  $("#facturaActiva").val(factura);
} */

async function limpiaLista() {
  abonos = 0;
  $(".modal-backdrop").remove();
  $(".modal-open").css("overflow", "auto");
  $("#myModalAnulaComanda").modal("hide");
  $("#numeroComanda").val(0);
  $("#abonosComanda").val(0);
/*   $("#tituloNumero").removeClass("alert-success");
  $("#tituloNumero").addClass("alert-info"); */
  $("#tituloNumero").html("Informacion Comanda");
  $(".prende").css("display", "none");
  localStorage.removeItem("productoComanda");
  $("#productosComanda >table >tbody >tr").remove();
  var productos = localStorage.getItem("productoComanda");
  if (productos == null) {
    listaComanda = [];
  } else {
    listaComanda = JSON.parse(productos);
  }
}

function botonDescuento() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    pos,
    user: { usuario_id },
  } = sesion;
  let { id_ambiente, fecha_auditoria } = oPos;

  totdes = $("#descuentosComanda").val();

  if (totdes != "0") {
    swal(
      {
        title: "Atencion ",
        text: "La presente Comanda ya se Causo el Descuento ",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si anular el Descuento",
        closeOnConfirm: true,
      },
      function () {
        var comanda = $("#numeroComanda").val();
        descuento = 0;
        var motivo = "";
        var parametros = {
          idusr: usuario_id,
          idamb: id_ambiente,
          fecha: fecha_auditoria,
          comanda,
          descuento,
          motivo,
        };

        $.ajax({
          type: "POST",
          data: parametros,
          url: "res/php/user_actions/getAnulaDescuento.php",
          success: function () {
            mBoton = "#comanda" + comanda;
            $(mBoton).attr("descuento", 0);
            $("#descuentosComanda").val(descuento);
            resumenComanda();
          },
        });
      }
    );
  } else {
    $("#myModalDescuento").modal("show");
  }
}

function imprimeComanda() {
  comanda = $("#numeroComanda").val();
  prefijo = $("#prefijoAmb").val();
  ventana = window.open(
    "impresiones/comandaCocina_" + prefijo + "_" + comanda + ".pdf",
    "PRINT",
    "height=600,width=600"
  );
}

function anulaFactura() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    cia,
    pos,
    user: { usuario, usuario_id },
  } = sesion;
  let { invMod } = cia;
  let { id_ambiente, fecha_auditoria, prefijo } = oPos;

  var factura = $("#facturaActiva").val();
  var salida = $("#salida").val();
  var motivo = $("#motivoAnula").val();
  parametros = {
    idamb: id_ambiente,
    iduser: usuario_id,
    user: usuario,
    fecha: fecha_auditoria,
    prefijo,
    factura,
    salida,
    motivo,
    invMod,
  };
  $.ajax({
    url: "res/php/user_actions/anulaFactura.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $(".modal-backdrop").remove();
      $(".modal-open").css("overflow", "auto");
      $("#myModalAnulafactura").modal("hide");
      facturasDia();
    },
  });
}

function imprimeEstadoCuenta() {
  comanda = $("#numeroComanda").val();
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let { pos, user: { usuario }, } = sesion;
  let { id_ambiente, fecha_auditoria, nombre, logo } = oPos;

  parametros = {
    comanda,
    fecha_auditoria,
    id_ambiente,
    nombre,
    usuario,
    logo,
  };
  if ((cuenta = 0)) {
    alert("Guardar Comanda");
  } else {
    $.ajax({
      url: "res/php/user_actions/imprimeEstadoCuenta.php",
      type: "POST",
      data: parametros,
      success: function (data) {
        imprime = $.trim(data);
        var ventana = window.open(
          "impresiones/" + imprime,
          "PRINT",
          "height=600,width=600"
        );
      },
    });
  }
}

function getAnulaComanda() {
  var comanda = $("#numeroComanda").val();
  var motivo = $("#motivoAnula").val();
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    pos,
    user: { usuario, usuario_id },
  } = sesion;
  let { id_ambiente, fecha_auditoria } = oPos;

  parametros = {
    idamb: id_ambiente,
    iduser: usuario_id,
    user: usuario,
    fecha: fecha_auditoria,
    comanda,
    motivo,
  };
  $.ajax({
    url: "res/php/user_actions/anulaComanda.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      swal(
        {
          title: "Comanda Anulada con Exito",
          type: "success",
          confirmButtonText: "Aceptar",
        },
        function () {
          limpiaLista();
          $("#comanda" + comanda).remove();
        }
      );
    },
  });
}

function getDescuento() {
  var comanda = $("#numeroComanda").val();
  var tipodes = $("#tipodesc").val();
  var motivo = $("#motivoDesc").val();

  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    pos,
    user: { usuario_id },
  } = sesion;
  let { id_ambiente, fecha_auditoria } = oPos;

  var parametros = {
    idusr: usuario_id,
    idamb: id_ambiente,
    fecha: fecha_auditoria,
    comanda,
    tipodes,
    motivo,
  };

  $.ajax({
    type: "POST",
    data: parametros,
    url: "res/php/user_actions/getCalculaDescuento.php",
    success: function (datos) {
      descuento = +datos;
      $("#descuentosComanda").val(datos);
      $("#myModalDescuento").modal("hide");
      mBoton = "#comanda" + $("#numeroComanda").val();
      $(mBoton).attr("descuento", datos);
      resumenComanda();
    },
  });
}

function pagarFacturaComanda() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    pos,
    user: { usuario, usuario_id },
  } = sesion;
  let { id_ambiente } = oPos;

  user = usuario;
  iduser = usuario_id;
  idamb = id_ambiente;

  var parametros = $("#acompananteReserva").serializeArray();

  parametros.push({ name: "usuario", value: user });
  parametros.push({ name: "idusuario", value: iduser });

  var pago = parseFloat($("#montopago").val().replace(",", ""));
  var tota = parseFloat($("#total").val().replace(",", ""));
  var comanda = $("#numeroComanda").val();

  $("#btnPagarComanda").attr("disabled", "disabled");

  if (tota - pago <= 0) {
    $.ajax({
      type: "POST",
      data: parametros,
      url: "res/php/user_actions/getGuardaFacturaComanda.php",
      beforeSend: function (objeto) {
        $("#factura").html("Mensaje: Cargando ...");
      },
      success: function (datos) {
        if (datos == 0) {
          swal(
            "Precaucion",
            "Sin Productos Asignados a esta cuenta 1",
            "warning"
          );
        } else {
          $(".modal-backdrop").remove();
          $(".modal-open").css("overflow", "auto");
          $("#ppal").css("padding-right", "0");
          imprimeFactura(comanda);
          descargarInventario(comanda);
          getSeleccionaAmbiente(idamb);
        }
      },
    });
  } else {
    swal(
      "Precaucion",
      "El Valor Pagado es menor al Total de la Presente Cuenta",
      "warning"
    );
  }
}

async function descargarInventario(comanda, factura) {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    pos,
    user: { usuario },
  } = sesion;
  let {
    id_bodega,
    id_ambiente,
    fecha_auditoria,
    id_centrocosto,
    nombre,
    prefijo,
  } = oPos;

  parametros = {
    id_bodega,
    id_ambiente,
    nombre,
    prefijo,
    fecha_auditoria,
    id_centrocosto,
    usuario,
    comanda,
    factura,
  };
  let url = "res/php/user_actions/descargaInventarios.php";
  try {
    const result = await fetch(url, {
      method: "POST",
      headers: {
        "Content-Type": "application/json;charset=UTF-8", // Y le decimos que los datos se enviaran como JSON
      },
      body: JSON.stringify(parametros),
    });
    const resp = await result.text();
    return resp.trim();
  } catch (error) {
    console.log(error);
  }
}

async function imprimeFactura(factura) {
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let { logo, id_ambiente, prefijo } = oPos;
  let rs = document.querySelector("#servicio").value;

  parametros = {
    logo,
    rs,
    id_ambiente,
    prefijo,
    factura,
  };

  try {
    const resultado = await fetch(`res/php/user_actions/imprime_factura.php`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json;charset=UTF-8", // Y le decimos que los datos se enviaran como JSON
      },
      body: JSON.stringify(parametros),
    });
    const resp = await resultado.text();
    return resp.trim();
  } catch (error) {
    console.log(error);
  }
  /* $.ajax({
    url: "res/php/user_actions/imprime_factura.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      imprime = $.trim(data);
      var ventana = window.open(
        "impresiones/" + imprime,
        "PRINT",
        "height=600,width=600"
      );
    },
  }); */
}

function botonPagarComanda() {
  var canti = $("#totalproductos").html();
  var coma = $("#numeroComanda").val();
  $("#btnPagarComanda").removeAttr("disabled");

  $("#myModalPagarComanda").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget); // Botón que activó el modal
    var subtotal = button.data("subtotal"); // Extraer la información de atributos de datos
    var descuento = button.data("descuento"); // Extraer la información de atributos de datos
    var propina = button.data("sugerida"); // Extraer la información de atributos de datos
    var impuesto = button.data("impuesto"); // Extraer la información de atributos de datos
    var total = button.data("total"); // Extraer la información de atributos de datos
    var productos = button.data("productos"); // Extraer la información de atributos de datos
    var ambiente = button.data("ambiente"); // Extraer la información de atributos de datos
    var cambio = button.data("cambio"); // Extraer la información de atributos de datos
    var modal = $(this);

    modal.find(".modal-title").text("Pagar Comanda Nro  " + coma);
    modal.find(".modal-body #subtotal").val(number_format(subtotal, 2));
    modal.find(".modal-body #descuento").val(number_format(descuento, 2));
    modal.find(".modal-body #propina").val(number_format(propina, 2));
    modal.find(".modal-body #impuesto").val(number_format(impuesto, 2));
    modal.find(".modal-body #total").val(number_format(total, 2));
    modal.find(".modal-body #montopago").val(total);
    modal.find(".modal-body #productos").val(productos);
    modal.find(".modal-body #ambiente").val(ambiente);
    modal.find(".modal-body #cambio").val(cambio);
    modal.find(".modal-body #pagado").val(total);

    $("#comanda").val(coma);
    $(".alert").hide(); //Oculto alert
  });
}

function botonPagar() {
  oPos = JSON.parse(localStorage.getItem("oPos"));
  /* sesion = JSON.parse(localStorage.getItem("sesion"));
  let { pos, user:{ usuario } } = sesion;
  */
  let { id_ambiente } = oPos;

  abonos = +$("#abonosComanda").val();

  var coma = $("#numeroComanda").val();
  $("#formapago").val("");
  $("#clientes").val("");

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

  propina = 0;
  descuento = 0;

  if (canti == 0) {
    swal("Precaucion", "Sin Productos Asignados a esta cuenta 2", "warning");
    return 0;
  } else {
    $("#myModalPagar").modal("show");
    $(".modal-title").text("Pagar Presente Cuenta " + coma);
    $("#total").val(number_format(subtotal, 2));
    $("#propina").val(propina);
    $("#totalCuentPag").val(total);
    $("#totalini").val(total);
    $("#totalImp").val(number_format(impuesto, 2));
    // $("#montopago").val(subtotal + propina + impuesto - descuento);
    $("#montopago").val(total);
    $("#productosPag").val(canti);
    $("#ambientePag").val(id_ambiente);
    $("#comandaPag").val(coma);
    /* 
    $("#usuarioPag").val(usuario);
    $("#descuento").val(number_format(descuento, 2));
    $("#abono").val(number_format(abonos, 2)); 
    */
    $("#montopago").focus();
    $("#abonosComanda").val(abonos);
    $("#subtotal").val(subtotal);
    $("#subtotImto").val(impuesto);
    $("#totalCuenta").val(total);
    $("#resultado").html("");
    $("#btnPagarCuenta").removeAttr("disabled");

    // montopago
  }
}

async function guardaFactura() {
  let parametros = document.querySelector("#pagarCuenta");
  let formData = new FormData(parametros);
  formData.append("usuario", usuario);
  formData.append("idusuario", usuario_id);
  let data = formDataToObject(formData);

  var pago = parseFloat($("#montopago").val().replace(",", ""));
  var tota = parseFloat($("#total").val().replace(",", ""));
  var coman = $("#numeroComanda").val();
  $("#comandaPag").val(coman);
  try {
    const resultado = await fetch(
      `res/php/user_actions/getGuardaFacturaVenta.php`,
      {
        method: "POST",
        headers: {
          "Content-Type": "application/json;charset=UTF-8",
        },
        body: JSON.stringify(data),
      }
    );
    const datos = await resultado.text();
    return datos.trim();
  } catch (error) {
    console.log(error);
  }
}

function getBorraCuenta(usuario, amb) {
  let productos = JSON.parse(localStorage.getItem("productoComanda"));

  var listaComanda;
  if (productos == null) {
    listaComanda = [];
  } else {
    listaComanda = productos;
  }

  if (listaComanda.length == 0) {
    getSeleccionaAmbiente(amb);
    return false;
  }
  let parametros = {
    usuario,
    amb,
  };
  swal(
    {
      title: "Esta Seguro de Cancelar la Presente Cuenta ?",
      text: "Los Productos de la Comanda se eliminaran",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Si Elimina los Productos de la Comanda",
      closeOnConfirm: true,
    },
    function () {
      localStorage.removeItem("productoComanda");
      getSeleccionaAmbiente(amb);
    }
  );
}

function guardarCuentaRecuperada() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {pos, user: { usuario },} = sesion;
  let { id_ambiente, impuesto, nombre, fecha_auditoria } = oPos;

  $("#recuperarComanda").val(0);
  // $("#guardaComandaDividida").css("display", "none");
  $("#guardaCuenta").css("display", "none");
  $("#recuperaCuenta").css("display", "block");
  $("#listaComandas").css("display", "block");
  $("#productoList").css("display", "none");
  $(".menuComanda").css("padding", "0");
  $("#guardaCuenta").css("display", "none");
  $("#recuperaCuenta").css("display", "block");
  $(".btnActivo").css("display", "block");

  $("#seccionList").css("display", "none");

  $("#tituloComanda").removeClass("col-lg-5");
  $("#tituloComanda").addClass("col-lg-12");
  $("#tituloBusca").css("display", "none");

  $("#ventasList").removeClass("col-lg-5 col-md-5 col-xs-12");
  $("#ventasList").addClass("col-lg-6 col-md-6 col-xs-12");
  $("#muestraNumero").removeClass("col-lg-5 col-md-5");
  $("#muestraNumero").addClass("col-lg-6 col-md-6");
  $("#muestraComanda").removeClass("col-lg-7 col-md-7 col-xs-12");
  $("#muestraComanda").addClass("col-lg-6 col-md-6 col-xs-12");
  $("#tituloComanda").html(
    "<h4 style='padding:2px;text-align: center;font-weight: bold;margin:0'>Tipo de Producto</h4>"
  );
  $(".btn-group-vertical").css("width", "auto");
  $("#regresarComanda").css("margin-top", "0px");

  var comanda = $("#numeroComanda").val();
  var recuperar = $("#recuperarComanda").val();
  var productos = JSON.parse(localStorage.getItem("productoComanda"));
  const nuevosprod = productos.filter((producto) => producto.activo === 0);

  if (nuevosprod.length == 0) {
    swal({
      title: "Sin Nuevos Productos",
      text: " No permitido Guardar Comanda",
      type: "warning",
      showCancelButton: false,
      confirmButtonColor: "#DD6B55",
      closeOnConfirm: true,
    });
    return false;
  }

  var parametros = {
    usuario,
    id_ambiente,
    impuesto,
    nombre,
    fecha_auditoria,
    comanda,
    nuevosprod,
  };

  $.ajax({
    type: "POST",
    data: parametros,
    url: "res/php/user_actions/getGuardaComandaRecu.php",
    beforeSend: function (objeto) {},
    success: function (datos) {
      $("#productosComanda >table >tbody >tr").remove();
      let productos = localStorage.getItem("productoComanda");

      imprime = imprimeComandaVenRecu(comanda);
      if (productos == null) {
        listaComanda = [];
      } else {
        listaComanda = JSON.parse(productos);
      }
      limpiaLista();
    },
  });
}

// function guardaClienteComanda() {
function guardarCuenta() {
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let { id_ambiente } = oPos;

  var productos = JSON.parse(localStorage.getItem("productoComanda"));
  if (productos == null) {
    swal({
      title: "Sin Productos",
      text: " No permitido Guardar Comanda",
      type: "warning",
      showCancelButton: false,
      confirmButtonColor: "#DD6B55",
      closeOnConfirm: true,
    });
    return;
  }

  guardarProductos();
  setTimeout(function () {
    let comanda = parseInt($("#numeroComanda").val());
    // console.log(comanda);
    imprime = imprimeComandaVen(productos, comanda);
    localStorage.removeItem("productoComanda");
    getSeleccionaAmbiente(id_ambiente);
  }, 1000);
}

function guardarProductosPago() {
  var productos = JSON.parse(localStorage.getItem("productoComanda"));
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    pos,
    user: { usuario },
  } = sesion;
  let { id_ambiente, impuesto, nombre, fecha_auditoria } = oPos;

  var regis = $("#cantProd").html();
  var pax = $("#numPax").val();
  var mesa = $("#nromesas").val();

  if (productos == null) {
    swal(
      {
        title: "Sin Productos",
        text: " No permitido Guardar Comanda",
        type: "warning",
        showCancelButton: false,
        confirmButtonColor: "#DD6B55",
        closeOnConfirm: true,
      },
      function () {
        $("#myModalGuardarCuenta").modal("hide");
      }
    );
    return;
  }

  var parametros = {
    pax,
    mesa,
    user: usuario,
    idamb: id_ambiente,
    imptoInc: impuesto,
    nomamb: nombre,
    fecha: fecha_auditoria,
    productos,
  };

  $.ajax({
    type: "POST",
    data: parametros,
    url: "res/php/user_actions/getGuardaComanda.php",
    beforeSend: function (objeto) {},
    success: function (datos) {
      $("#numeroComanda").val(datos);
      $("#comandaPag").val(datos);
    },
  });
}

function guardarProductos() {
  let productos = JSON.parse(localStorage.getItem("productoComanda"));
  let sesion = JSON.parse(localStorage.getItem("sesion"));
  let oPos = JSON.parse(localStorage.getItem("oPos"));

  let { pos, user: { usuario }, } = sesion;
  let { id_ambiente, impuesto, nombre, fecha_auditoria, prefijo } = oPos;
  let regis = $("#cantProd").html();
  let pax = $("#numPax").val();
  let mesa = $("#nromesas").val();

  var parametros = {
    pax,
    mesa,
    usuario,
    id_ambiente,
    impuesto,
    nombre,
    fecha_auditoria,
    prefijo,
    productos,
  };

  $.ajax({
    type: "POST",
    data: parametros,
    url: "res/php/user_actions/getGuardaComanda.php",
    beforeSend: function (objeto) {},
    success: function (datos) {
      $("#numeroComanda").val(datos.trim());
      $("#comandaPag").val(datos);
      $("#tituloNumero").html("Comanda Nro " + datos + " Guardada Con Exito");
      setTimeout(function () {
        $("#tituloNumero").html("Nueva Comanda");
      }, 500);
    },
  });
}

function imprimeComandaVenRecu(comanda) {
  let sesion = JSON.parse(localStorage.getItem("sesion"));
  let { pos, user: { usuario }, } = sesion;
  let oPos = JSON.parse(localStorage.getItem("oPos"));
  let { id_ambiente, impuesto, nombre, fecha_auditoria, prefijo } = oPos;

  var productos = JSON.parse(localStorage.getItem("productoComanda"));
  $.ajax({
    url: "res/php/user_actions/imprimeComandaRecupera.php",
    type: "POST",
    data: {
      productos,
      prefijo,
      id_ambiente,
      comanda,
      nombre,
      fecha_auditoria,
      usuario,
    },
    success: function (data) {
      imprime = $.trim(data);
      var ventana = window.open(
        "impresiones/" + imprime,
        "PRINT",
        "height=600,width=600"
      );
    },
  });
}

function imprimeComandaVen(productos, comanda) {
  let oPos = JSON.parse(localStorage.getItem("oPos"));

  let { pos, user: { usuario }, } = sesion;
  let { id_ambiente, impuesto, nombre, fecha_auditoria, prefijo } = oPos;
  // var productos = JSON.parse(localStorage.getItem("productoComanda"));

  $.ajax({
    url: "res/php/user_actions/imprimeComanda.php",
    type: "POST",
    data: {
      productos,
      id_ambiente,
      comanda,
      prefijo,
      nombre,
      usuario,
    },
    success: function (data) {
      imprime = $.trim(data);
      var ventana = window.open(
        "impresiones/" + imprime,
        "PRINT",
        "height=600,width=600"
      );
    },
  });
}

function imprimeComandaGen() {
  var productos = JSON.parse(localStorage.getItem("productoComanda"));
  var regis = $("#cantProd").html();
  var pax = $("#numPax").val();
  var comanda = $("#numeroComanda").val();
  var mesa = $("#nromesas").val();
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let {
    pos,
    user: { usuario },
  } = sesion;
  let { id_ambiente, nombre, prefijo } = oPos;

  $.ajax({
    url: "res/php/user_actions/imprimeComandaGen.php",
    type: "POST",
    data: {
      usuario,
      id_ambiente,
      nombre,
      comanda,
      productos,
      prefijo,
    },
    success: function (data) {
      imprime = $.trim(data);
      var ventana = window.open(
        "impresiones/" + imprime,
        "PRINT",
        "height=600,width=600"
      );
    },
  });
}

function imprimeComandaRecu() {
  $.ajax({
    url: "res/php/user_actions/imprimeComandaRecu.php",
    type: "POST",
    success: function (data) {
      imprime = $.trim(data);
      var ventana = window.open(
        "impresiones/" + imprime,
        "PRINT",
        "height=600,width=600"
      );
    },
  });
}

function guardarCuentaRecu() {
  var regis = $("#cantProd").html();
  var pax = $("#numPax").val();
  var mesa = $("#nromesas").val();
  var comanda = $("#numeroComanda").val();
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    pos,
    user: { usuario },
  } = sesion;
  let { id_ambiente, nombre, fecha_auditoria } = oPos;

  var parametros = {
    pax,
    mesa,
    comanda,
    user: usuario,
    idamb: id_ambiente,
    nomamb: nombre,
    fecha: fecha_auditoria,
  };

  if (regis == 0) {
    swal(
      {
        title: "Sin Productos",
        text: " No permitido Guardar Comanda",
        type: "warning",
        showCancelButton: false,
        confirmButtonColor: "#DD6B55",
        closeOnConfirm: true,
      },
      function () {
        $("#myModalGuardarCuenta").modal("hide");
      }
    );
  } else {
    $.ajax({
      type: "POST",
      data: parametros,
      url: "res/php/user_actions/getGuardaComandaRecu.php",
      beforeSend: function (objeto) {
        $("#ventasList").html(
          " <h3 align'=center'>Almacenando Comanda <img src='../img/loader.gif'> </h3>"
        );
      },
      success: function (datos) {
        swal(
          {
            title: "Comanda Guardada con Exito",
            text: "Cuenta Nro ".datos,
            type: "success",
            confirmButtonText: "Aceptar",
          },
          function () {
            getSeleccionaAmbiente(id_ambiente);
          }
        );
        imprimeComandaRecu();
      },
    });
  }
}

$(document).ready(function () {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let {
    pos,
    user: { usuario },
  } = sesion;
  if (oPos) {
    let { id_ambiente, nombre, fecha_auditoria } = oPos;
  }

  $("#myModalAbonos").on("show.bs.modal", function (event) {
    var canti = $("#cantProd").val();
    var coma = $("#numeroComanda").val();
    var totvta = parseFloat($("#totalVta").html().replace(",", ""));
    var totimp = parseFloat($("#valorImpto").html().replace(",", ""));
    var totdes = parseFloat($("#totalDesc").html().replace(",", ""));
    var total = parseFloat($("#totalCuenta").html().replace(",", ""));
    $("#formapagoAbono").val("");
    $("#comentarios").val("");
    $("#montoAbono").val(0);
  });

  $("#myModalPagarDirecto").on("show.bs.modal", function (event) {
    var productos = JSON.parse(localStorage.getItem("productoComanda"));
    if (productos == null) {
      swal("Precaucion", "Sin Productos Asociados a esta comanda", "warning");
      $("#myModalPagarDirecto").modal("hide");
      return;
    }
    valor = $("#totalCuenta").val();
  });

  $("#myModalAnulaComanda").on("show.bs.modal", function (event) {
    $("#motivoAnula").val("");
    $("#motivoAnula").focus();
  });

  $("#myModalDescuento").on("show.bs.modal", function (event) {
    $("#tipodesc").val("");
    $("#motivoDesc").val("");
  });

  $("#myModalClienteComandaDiv").on("show.bs.modal", function (event) {
    let idambi = id_ambiente;

    $.ajax({
      type: "POST",
      url: "res/php/user_actions/traeMesasDisponibles.php",
      dataType: "json",
      data: { idambi },
      success: function (mesas) {
        $("#mesaDivide option").remove();
        for (i = 0; i < mesas.length; i++) {
          $("#mesaDivide").append(
            `<option value="${mesas[i]["numero_mesa"]}">${mesas[i]["numero_mesa"]}</option>`
          );
        }
      },
    });
  });
});
