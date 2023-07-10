function calculaRoomService() {
  subtota = document.querySelector("#subtotal").value;
  // console.log(subtota);
  roomSer = subtota * 0.1;

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
  let { id_ambiente, nombre, impuesto, fecha_auditoria } = oPos[0];
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
  let { id_ambiente, nombre, impuesto, fecha_auditoria } = oPos[0];
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
  // let { pos } = sesion;
  let { id_ambiente } = oPos[0];

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

  // console.log(monto);

  mBoton = "#comanda" + $("#numeroComanda").val();
  // $("abonosComanda");
  abonos = abonos + monto;
  $(mBoton).attr("abonos", abonos);

  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let { pos, user } = sesion;
  let { id_ambiente, nombre, fecha_auditoria, logo } = oPos[0];
  let { usuario, usuario_id } = user;

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

  let { pos, user } = sesion;
  let { usuario, usuario_id } = user;
  let { id_ambiente, impuesto, nombre, fecha_auditoria } = oPos[0];

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

function pagarFactura() {
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let { id_ambiente } = oPos[0];

  idamb = id_ambiente;
  numero = $("#numeroComanda").val();

  var pago = +parseFloat($("#montopago").val().replace(",", ""));
  totalCta = +$("#totalComanda").val();
  abonos = $("#abonosComanda").val();
  roomservice = $("#servicio").val();

  var productos = localStorage.getItem("productoComanda");

  if (totalCta - (pago + abonos) <= 0) {
    $("#btnPagarComanda").attr("disabled", "disabled");
    $("#btnPagarCuenta").attr("disabled", "disabled");
    if (numero == 0) {
      guardarProductos();
      imprime = imprimeComandaVen();
    }
    guardaFactura();
    setTimeout(function () {
      imprimeFactura();
      descargarInventario();
      limpiaLista();
      enviaInicio();

      $("#myModalPagar").modal("hide");
      campo = "#comand" + $.trim(numero);
      $(campo).remove();
      swal({
        title: "Pago Realizado con Exito",
        type: "success",
        confirmButtonText: "Aceptar",
      });
    }, 1000);
  } else {
    swal(
      "Precaucion",
      "El Valor Pagado es menor al Total de la Presente Cuenta ",
      "warning"
    );
  }
}

function guardarCuentaRecuperadaPlano() {
  let { pos, user } = sesion;
  let { usuario } = user;
  let { id_ambiente, impuesto, nombre, fecha_auditoria } = oPos[0];

  imptoInc = impuesto;

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

  var comanda = $("#numeroComanda").val();
  var recuperar = $("#recuperarComanda").val();
  var productos = JSON.parse(localStorage.getItem("productoComanda"));

  var parametros = {
    user: usuario,
    idamb: id_ambiente,
    imptoIncl: impuesto,
    nomamb: nombre,
    fecha: fecha_auditoria,
    comanda,
    productos,
  };

  $.ajax({
    type: "POST",
    data: parametros,
    url: "res/php/user_actions/getGuardaComandaRecu.php",
    beforeSend: function (objeto) {},
    success: function (datos) {
      imprime = imprimeComandaVenRecu();
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

function limpiaLista() {
  abonos = 0;
  $(".modal-backdrop").remove();
  $(".modal-open").css("overflow", "auto");
  $("#myModalAnulaComanda").modal("hide");
  $("#numeroComanda").val(0);
  $("#abonosComanda").val(0);
  $("#tituloNumero").removeClass("alert-success");
  $("#tituloNumero").addClass("alert-info");
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
  // resumenComanda();
}

function botonDescuento() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let { pos, user } = sesion;
  let { usuario_id } = user;
  let { id_ambiente, fecha_auditoria } = oPos[0];

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

  let { cia, pos, user } = sesion;
  let { inv } = cia;
  let { usuario, usuario_id } = user;
  let { id_ambiente, fecha_auditoria, prefijo } = oPos[0];

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
    inv,
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
  cuenta = $("#numeroComanda").val();
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let { pos, user } = sesion;
  let { usuario } = user;
  let { id_ambiente, fecha_auditoria, nombre, logo } = oPos[0];

  parametros = {
    cuenta: cuenta,
    fecha: fecha_auditoria,
    idamb: id_ambiente,
    ambie: nombre,
    user: usuario,
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

  let { pos, user } = sesion;
  let { usuario, usuario_id } = user;
  let { id_ambiente, fecha_auditoria } = oPos[0];

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

  let { pos, user } = sesion;
  let { usuario_id } = user;
  let { id_ambiente, fecha_auditoria } = oPos[0];

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

  let { pos, user } = sesion;
  let { usuario, usuario_id } = user;
  let { id_ambiente } = oPos[0];

  user = usuario;
  iduser = usuario_id;
  idamb = id_ambiente;

  var parametros = $("#acompananteReserva").serializeArray();

  parametros.push({ name: "usuario", value: user });
  parametros.push({ name: "idusuario", value: iduser });

  var pago = parseFloat($("#montopago").val().replace(",", ""));
  var tota = parseFloat($("#total").val().replace(",", ""));
  var coman = $("#numeroComanda").val();

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
          imprimeFactura();
          descargarInventario();
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

function descargarInventario() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let { pos, user } = sesion;
  let { usuario } = user;
  let { id_bodega, id_ambiente, fecha_auditoria, id_centrocosto } = oPos[0];

  parametros = {
    idbod: id_bodega,
    idamb: id_ambiente,
    fecha: fecha_auditoria,
    centr: id_centrocosto,
    usuario,
  }; 
  $.ajax({
    url: "res/php/user_actions/descargaInventarios.php",
    type: "POST",
    data: parametros,
    success: function (data) {},
  });
}

function imprimeFactura() {
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let { pos, user } = sesion;
  let { usuario } = user;
  let { logo } = oPos[0];
  let rs = document.querySelector("#servicio").value;

  parametros = {
    logo,
    rs,
  };
  $.ajax({
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
  });
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
    var usuario = button.data("usuario"); // Extraer la información de atributos de datos
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
    modal.find(".modal-body #usuario").val(usuario);
    modal.find(".modal-body #cambio").val(cambio);
    modal.find(".modal-body #pagado").val(total);

    $("#comanda").val(coma);
    $(".alert").hide(); //Oculto alert
  });
}

function botonPagar() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let { pos, user } = sesion;
  let { usuario } = user;
  let { id_ambiente } = oPos[0];

  abonos = +$("#abonosComanda").val();

  var canti = $("#cantProd").val();
  var coma = $("#numeroComanda").val();
  $("#formapago").val("");
  $("#clientes").val("");

  $("#propinaPag").val(0);

  miBoton = "#comanda" + coma;
  subtotal = parseFloat($(miBoton).attr("subtotal"));
  impuesto = parseFloat($(miBoton).attr("impto"));
  propina = parseFloat($(miBoton).attr("propina"));
  descuento = parseFloat($(miBoton).attr("descuento"));
  abonos = parseFloat($(miBoton).attr("abonos"));
  total = parseFloat($(miBoton).attr("total"));

  if (canti == 0) {
    swal("Precaucion", "Sin Productos Asignados a esta cuenta 2", "warning");
    return 0;
  } else {
    $("#myModalPagar").modal("show");
    $(".modal-title").text("Pagar Presente Cuenta " + coma);
    $("#total").val(number_format(subtotal, 2));
    $("#propina").val(propina);
    $("#totalini").val(total);
    $("#totalImp").val(number_format(impuesto, 2));
    // $("#montopago").val(subtotal + propina + impuesto - descuento);
    $("#montopago").val(total);
    $("#productosPag").val(canti);
    $("#ambientePag").val(id_ambiente);
    $("#usuarioPag").val(usuario);
    $("#comandaPag").val(coma);
    $("#descuento").val(number_format(descuento, 2));
    $("#abono").val(number_format(abonos, 2));
    $("#montopago").focus();
    $("#abonosComanda").val(abonos);
    $("#subtotal").val(subtotal);
    $("#subtotImto").val(impuesto);

    $("#resultado").html("");
    $("#btnPagarCuenta").removeAttr("disabled");

    // montopago
  }
}

function guardaFactura() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let { pos, user } = sesion;
  let { usuario, usuario_id } = user;
  let { id_ambiente } = oPos[0];

  idamb = id_ambiente;

  var parametros = $("#pagarCuenta").serializeArray();

  parametros.push({ name: "usuario", value: usuario });
  parametros.push({ name: "idusuario", value: usuario_id });

  var pago = parseFloat($("#montopago").val().replace(",", ""));
  var tota = parseFloat($("#total").val().replace(",", ""));
  var coman = $("#numeroComanda").val();
  $("#comandaPag").val(coman);

  $.ajax({ 
    type: "POST",
    data: parametros,
    url: "res/php/user_actions/getGuardaFacturaVenta.php",
    beforeSend: function (objeto) {
      $("#factura").html("Mensaje: Cargando ...");
    },
    success: function (datos) {
      if (datos == 0) {
        swal( 
          "Precaucion",
          "Sin Productos Asignados a esta cuenta 3",
          "warning"
        );
      } else {
        $(".modal-backdrop").remove();
        $(".modal-open").css("overflow", "auto");
      }
    },
  });
}

function getBorraCuenta(usuario, amb) {
  cant = $("#cantProd").val();

  if (cant == 0) {
    getSeleccionaAmbiente(amb);
    return false;
  }
  var parametros = {
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

  let { pos, user } = sesion;
  let { usuario } = user;
  let { id_ambiente, impuesto, nombre, fecha_auditoria } = oPos[0];

  $("#recuperarComanda").val(0);
  $("#guardaComandaDividida").css("display", "none");
  $("#guardaCuenta").css("display", "none");
  $("#recuperaCuenta").css("display", "block");
  $("#listaComandas").css("display", "block");
  $("#productoList").css("display", "none");
  $(".menuComanda").css("padding", "0");
  $("#guardaCuenta").css("display", "none");
  $("#recuperaCuenta").css("display", "block");
  $(".btnActivo").css("display", "block");

  $("#seccionList").css("display", "none");

  $("#tituloComanda").removeClass("col-lg-6");
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

  var parametros = {
    user: usuario,
    idamb: id_ambiente,
    imptoIncl: impuesto,
    nomamb: nombre,
    fecha: fecha_auditoria,
    comanda,
    productos,
  };

  $.ajax({
    type: "POST",
    data: parametros,
    url: "res/php/user_actions/getGuardaComandaRecu.php",
    beforeSend: function (objeto) {},
    success: function (datos) {
      $("#productosComanda >table >tbody >tr").remove();
      var productos = localStorage.getItem("productoComanda");
      imprime = imprimeComandaVenRecu();
      if (productos == null) {
        listaComanda = [];
      } else {
        listaComanda = JSON.parse(productos);
      }
      limpiaLista();
    },
  });
}

function guardarCuentaOld() {
  var productos = JSON.parse(localStorage.getItem("productoComanda"));
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
        // ACA
        // $("#myModalClienteComanda").modal("hide");
      }
    );
    return;
  }

  $("#myModalClienteComanda").modal("show");
}

// function guardaClienteComanda() {
  function guardarCuenta() {
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let { id_ambiente } = oPos[0];

  var productos = JSON.parse(localStorage.getItem("productoComanda"));
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
    );
    return;
  }

  var regis = $("#cantProd").html();
  var pax = $("#numPax").val();
  var mesa = $("#nromesas").val();
  var cliente = '';
  guardarProductos();
  setTimeout(function () {
    imprime = imprimeComandaVen();
    localStorage.removeItem("productoComanda");
    getSeleccionaAmbiente(id_ambiente);
  }, 1000);
}

function guardarProductosPago() {
  var productos = JSON.parse(localStorage.getItem("productoComanda"));
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let { pos, user } = sesion;
  let { usuario } = user;
  let { id_ambiente, impuesto, nombre, fecha_auditoria } = oPos[0];

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
  var productos = JSON.parse(localStorage.getItem("productoComanda"));
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  let { pos, user } = sesion;
  let { usuario } = user;
  let { id_ambiente, impuesto, nombre, fecha_auditoria } = oPos[0];
  var regis = $("#cantProd").html();
  var pax = $("#numPax").val();
  var mesa = $("#nromesas").val();
  var cliente = $("#nombreCliente").val();

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
    beforeSend: function (objeto) {},
    success: function (datos) {
      $("#numeroComanda").val(datos);
      $("#comandaPag").val(datos);
      $("#tituloNumero").removeClass("alert-info");
      $("#tituloNumero").addClass("alert-success");
      $("#tituloNumero").html("Comanda Nro " + datos + " Guardada Con Exito");
      setTimeout(function () {
        $("#tituloNumero").removeClass("alert-success");
        $("#tituloNumero").addClass("alert-info");
        $("#tituloNumero").html("Nueva Comanda");
      }, 1000);
    },
  });
}

function imprimeComandaVenRecu() {
  var productos = JSON.parse(localStorage.getItem("productoComanda"));
  $.ajax({
    url: "res/php/user_actions/imprimeComandaRecupera.php",
    type: "POST",
    data: {
      produc: productos,
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

function imprimeComandaVen() {
  var productos = JSON.parse(localStorage.getItem("productoComanda"));
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

function imprimeComandaGen() {
  var productos = JSON.parse(localStorage.getItem("productoComanda"));
  var regis = $("#cantProd").html();
  var pax = $("#numPax").val();
  var numComa = $("#numeroComanda").val();
  var mesa = $("#nromesas").val();
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  let { pos, user } = sesion;
  let { usuario } = user;
  let { id_ambiente, nombre } = oPos[0];

  $.ajax({
    url: "res/php/user_actions/imprimeComandaGen.php",
    type: "POST",
    data: {
      user: usuario,
      idamb: id_ambiente,
      nomamb: nombre,
      numComa,
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

  let { pos, user } = sesion;
  let { usuario } = user;
  let { id_ambiente, nombre, fecha_auditoria } = oPos[0];

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

  let { pos, user } = sesion;
  let { usuario } = user;
  if (oPos) {
    let { id_ambiente, nombre, fecha_auditoria } = oPos[0];
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
