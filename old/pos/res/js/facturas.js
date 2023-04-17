function botonPagarDirecto() {
  var storageProd = JSON.parse(localStorage.getItem("productoComanda"));
  let mesa = $("#nromesas").val();
  if (storageProd == null) {
    swal("Precaucion", "Sin Productos Asociados a esta comanda", "warning");
    return;
  }
  let total = parseFloat($("#totalCuenta").html().replace(",", ""));

  $("#myModalPagarDirecto").modal("show");
  $("#totalDir").val(number_format(total, 2));
  $("#totaliniDir").val(total);
  $("#montopagoDir").val(total);
  $("#mesaDir").val(mesa);
}

function pagarFacturaDirecto() {
  oPos = JSON.parse(localStorage.getItem("oPos"));
  sesion = JSON.parse(localStorage.getItem("sesion"));

  let parametros = [];
  let storageProd = JSON.parse(localStorage.getItem("productoComanda"));
  let comanda = $("#pagarCuentaDirecto").serializeArray();
  let pax = $("#numPax").val();
  let mesa = $("#nromesas").val();
  let idamb = oPos[0]["id_ambiente"];
  let config = {
    iduser: sesion["usuario"][0]["usuario_id"],
    user: sesion["usuario"][0]["usuario"],
    idamb: idamb,
    imptoIncl: oPos[0]["impuesto"],
    nomamb: oPos[0]["nombre"],
    fecha: oPos[0]["fecha_auditoria"],
    mesa: mesa,
    pax: pax,
    productos: storageProd,
    comanda: comanda,
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

function guardarCuentaRecuperadaPlano() {
  oPos = JSON.parse(localStorage.getItem("oPos"));
  imptoInc = oPos[0]["impuesto"];

  $("#recuperarComanda").val(0);
  $("#guardaCuenta").css("display", "none");
  $("#recuperaCuenta").css("display", "block");
  $("#listaComandas").css("display", "block");
  $("#productoList").css("display", "none");
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
  $(".btn-group-vertical").css("width", "auto");
  $("#regresarComanda").css("margin-top", "0px");

  var comanda = $("#numeroComanda").val();
  var recuperar = $("#recuperarComanda").val();
  var storageProd = JSON.parse(localStorage.getItem("productoComanda"));

  var parametros = {
    user: sesion["usuario"][0]["usuario"],
    idamb: oPos[0]["id_ambiente"],
    imptoIncl: oPos[0]["impuesto"],
    nomamb: oPos[0]["nombre"],
    fecha: oPos[0]["fecha_auditoria"],
    comanda: comanda,
    produc: storageProd,
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
      var storageProd = localStorage.getItem("productoComanda");
      if (storageProd == null) {
        listaComanda = [];
      } else {
        listaComanda = JSON.parse(storageProd);
      }
      limpiaLista();
      enviaInicio();
    },
  });
}

function botonAnulaFactura(factura, amb) {
  $("#myModalAnulafactura").modal("show");
  $("#comanda").val(factura);
  $("#facturaActiva").val(factura);
}

function limpiaLista() {
  $(".modal-backdrop").remove();
  $(".modal-open").css("overflow", "auto");
  $("#myModalAnulaComanda").modal("hide");
  $("#numeroComanda").val(0);
  $("#tituloNumero").removeClass("alert-success");
  $("#tituloNumero").addClass("alert-info");
  $("#tituloNumero").html("Informacion Comanda");
  $(".prende").attr("disabled", "disabled");
  localStorage.removeItem("productoComanda");
  $("#productosComanda >table >tbody >tr").remove();
  var storageProd = localStorage.getItem("productoComanda");
  if (storageProd == null) {
    listaComanda = [];
  } else {
    listaComanda = JSON.parse(storageProd);
  }
  resumenComanda();
}

function botonDescuento() {
  var canti = $("#totalproductos").html();
  var coma = $("#numeroComanda").val();

  var totdes = $("#totalDesc").html();
  totdes = totdes.replace(".00", "");
  totdes = totdes.replace(",", "");
  if (totdes != 0) {
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
        var descu = 0;
        var motivo = "";
        sesion = JSON.parse(localStorage.getItem("sesion"));
        oPos = JSON.parse(localStorage.getItem("oPos"));
        var parametros = {
          idusr: sesion["usuario"][0]["usuario_id"],
          idamb: oPos[0]["id_ambiente"],
          fecha: oPos[0]["fecha_auditoria"],
          comanda: comanda,
          descuento: descu,
          motivo: motivo,
        };

        $.ajax({
          type: "POST",
          data: parametros,
          url: "res/php/user_actions/getAnulaDescuento.php",
          success: function (datos) {
            setTimeout(function () {
              getComandas(comanda);
            }, 1000);
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
  var factura = $("#facturaActiva").val();
  var motivo = $("#motivoAnula").val();
  parametros = {
    idamb: oPos[0]["id_ambiente"],
    iduser: sesion["usuario"][0]["usuario_id"],
    user: sesion["usuario"][0]["usuario"],
    fecha: oPos[0]["fecha_auditoria"],
    prefijo: oPos[0]["prefijo"],
    factura: factura,
    motivo: motivo,
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

      /// getSeleccionaAmbiente(oPos[0]['id_ambiente'])
    },
  });
}

function imprimeEstadoCuenta() {
  cuenta = $("#numeroComanda").val();
  oPos = JSON.parse(localStorage.getItem("oPos"));
  sesion = JSON.parse(localStorage.getItem("sesion"));
  user = sesion["usuario"][0]["usuario"];
  idamb = oPos[0]["id_ambiente"];

  parametros = {
    cuenta: cuenta,
    fecha: oPos[0]["fecha_auditoria"],
    idamb: oPos[0]["id_ambiente"],
    ambie: oPos[0]["nombre"],
    user: user,
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
  oPos = JSON.parse(localStorage.getItem("oPos"));
  parametros = {
    idamb: oPos[0]["id_ambiente"],
    iduser: sesion["usuario"][0]["usuario_id"],
    user: sesion["usuario"][0]["usuario"],
    fecha: oPos[0]["fecha_auditoria"],
    comanda: comanda,
    motivo: motivo,
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
          $("#" + comanda).remove();
          enviaInicio();
        }
      );
    },
  });
}

function getDescuento() {
  var comanda = $("#numeroComanda").val();
  var descu = $("#tipodesc").val();
  var motivo = $("#motivoDesc").val();

  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  var parametros = {
    idusr: sesion["usuario"][0]["usuario_id"],
    idamb: oPos[0]["id_ambiente"],
    fecha: oPos[0]["fecha_auditoria"],
    comanda: comanda,
    descuento: descu,
    motivo: motivo,
  };

  $.ajax({
    type: "POST",
    data: parametros,
    url: "res/php/user_actions/getCalculaDescuento.php",
    success: function (datos) {
      $("#myModalDescuento").modal("hide");
      setTimeout(function () {
        resumenDescuento(oPos[0]["id_ambiente"], comanda);
        getComandas(comanda);
      }, 1000);
    },
  });
}

function pagarFacturaComanda() {
  oPos = JSON.parse(localStorage.getItem("oPos"));
  sesion = JSON.parse(localStorage.getItem("sesion"));
  user = sesion["usuario"][0]["usuario"];
  iduser = sesion["usuario"][0]["usuario_id"];
  idamb = oPos[0]["id_ambiente"];

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
  oPos = JSON.parse(localStorage.getItem("oPos"));
  sesion = JSON.parse(localStorage.getItem("sesion"));
  idBod = oPos[0]["id_bodega"];
  idAmb = oPos[0]["id_ambiente"];
  fecha = oPos[0]["fecha_auditoria"];
  centr = oPos[0]["id_centrocosto"];
  user = oPos[0]["usuario"];

  parametros = {
    idbod: idBod,
    idamb: idAmb,
    fecha: fecha,
    centr: centr,
    user: sesion["usuario"][0]["usuario"],
  };
  $.ajax({
    url: "res/php/user_actions/descargaInventarios.php",
    type: "POST",
    data: parametros,
    success: function (data) {},
  });
}

function imprimeFactura() {
  let ruta = $("#rutaweb").val();
  $.ajax({
    url: "res/php/user_actions/imprime_factura.php",
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
  oPos = JSON.parse(localStorage.getItem("oPos"));
  sesion = JSON.parse(localStorage.getItem("sesion"));
  user = sesion["usuario"][0]["usuario"];
  idamb = oPos[0]["id_ambiente"];

  var canti = $("#cantProd").val();
  var coma = $("#numeroComanda").val();
  $("#formapago").val("");
  $("#clientes").val("");
  var totvta = parseFloat($("#totalVta").html().replace(",", ""));
  var totimp = parseFloat($("#valorImpto").html().replace(",", ""));
  var totdes = parseFloat($("#totalDesc").html().replace(",", ""));
  var total = parseFloat($("#totalCuenta").html().replace(",", ""));
  if (canti == 0) {
    swal("Precaucion", "Sin Productos Asignados a esta cuenta 2", "warning");
    return 0;
  } else {
    $("#myModalPagar").modal("show");
    $(".modal-title").text("Pagar Presente Cuenta " + coma);
    $("#total").val(number_format(total, 2));
    $("#propina").val(0);
    $("#totalini").val(total);
    $("#montopago").val(total);
    $("#productosPag").val(canti);
    $("#ambientePag").val(idamb);
    $("#usuarioPag").val(user);
    $("#comandaPag").val(coma);
    $("#descuento").val(number_format(totdes, 2));
    $("#montopago").focus();
    $("#resultado").html("");
    $("#btnPagarCuenta").removeAttr("disabled");
  }
}

function pagarFactura() {
  oPos = JSON.parse(localStorage.getItem("oPos"));
  idamb = oPos[0]["id_ambiente"];
  numero = $("#numeroComanda").val();
  var pago = parseFloat($("#montopago").val().replace(",", ""));
  var tota = parseFloat($("#total").val().replace(",", ""));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  var storageProd = localStorage.getItem("productoComanda");

  if (tota - pago <= 0) {
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
      campo = "#" + $.trim(numero);
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
      "El Valor Pagado es menor al Total de la Presente Cuenta",
      "warning"
    );
  }
}

function guardaFactura() {
  oPos = JSON.parse(localStorage.getItem("oPos"));
  sesion = JSON.parse(localStorage.getItem("sesion"));
  user = sesion["usuario"][0]["usuario"];
  iduser = sesion["usuario"][0]["usuario_id"];
  idamb = oPos[0]["id_ambiente"];

  /*
		var parametros = $("#acompananteReserva").serializeArray();	
		parametros.push({name:'usuario',value: user})
		parametros.push({name:'idusuario',value:iduser})
		var parametros = $('#pagarCuenta').serialize();
	*/
  var parametros = $("#pagarCuenta").serializeArray();

  parametros.push({ name: "usuario", value: user });
  parametros.push({ name: "idusuario", value: iduser });

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
        $("#ppal").css("padding-right", "0");
      }
    },
  });
}

function getBorraCuenta(usuario, amb) {
  cant = $("#cantProd").val();
  oPos = JSON.parse(localStorage.getItem("oPos"));

  if (cant == 0) {
    getSeleccionaAmbiente(oPos[0]["id_ambiente"]);
    return false;
  }
  var parametros = {
    usuario: usuario,
    amb: amb,
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
      getSeleccionaAmbiente(oPos[0]["id_ambiente"]);
    }
  );
}

function guardarCuentaRecuperada() {
  oPos = JSON.parse(localStorage.getItem("oPos"));
  imptoInc = oPos[0]["impuesto"];

  $("#recuperarComanda").val(0);
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
  var storageProd = JSON.parse(localStorage.getItem("productoComanda"));

  var parametros = {
    user: sesion["usuario"][0]["usuario"],
    idamb: oPos[0]["id_ambiente"],
    imptoIncl: oPos[0]["impuesto"],
    nomamb: oPos[0]["nombre"],
    fecha: oPos[0]["fecha_auditoria"],
    comanda: comanda,
    produc: storageProd,
  };

  $.ajax({
    type: "POST",
    data: parametros,
    url: "res/php/user_actions/getGuardaComandaRecu.php",
    beforeSend: function (objeto) {},
    success: function (datos) {
      $("#productosComanda >table >tbody >tr").remove();
      var storageProd = localStorage.getItem("productoComanda");
      imprime = imprimeComandaVenRecu();
      if (storageProd == null) {
        listaComanda = [];
      } else {
        listaComanda = JSON.parse(storageProd);
      }
      limpiaLista();
    },
  });
}

function guardarCuenta() {
  var storageProd = JSON.parse(localStorage.getItem("productoComanda"));
  if (storageProd == null) {
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

  $("#btnGuardarComanda").attr("disabled", "disabled");
  var regis = $("#cantProd").html();
  var pax = $("#numPax").val();
  var mesa = $("#nromesas").val();
  oPos = JSON.parse(localStorage.getItem("oPos"));
  guardarProductos();
  setTimeout(function () {
    imprime = imprimeComandaVen();
    localStorage.removeItem("productoComanda");
    getSeleccionaAmbiente(oPos[0]["id_ambiente"]);
  }, 1000);
}

function guardarProductosPago() {
  var storageProd = JSON.parse(localStorage.getItem("productoComanda"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  var regis = $("#cantProd").html();
  var pax = $("#numPax").val();
  var mesa = $("#nromesas").val();

  if (storageProd == null) {
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
    pax: pax,
    mesa: mesa,
    user: sesion["usuario"][0]["usuario"],
    idamb: oPos[0]["id_ambiente"],
    imptoInc: oPos[0]["impuesto"],
    nomamb: oPos[0]["nombre"],
    fecha: oPos[0]["fecha_auditoria"],
    produc: storageProd,
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
  var storageProd = JSON.parse(localStorage.getItem("productoComanda"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  var regis = $("#cantProd").html();
  var pax = $("#numPax").val();
  var mesa = $("#nromesas").val();

  if (storageProd == null) {
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
    pax: pax,
    mesa: mesa,
    user: sesion["usuario"][0]["usuario"],
    idamb: oPos[0]["id_ambiente"],
    imptoInc: oPos[0]["impuesto"],
    nomamb: oPos[0]["nombre"],
    fecha: oPos[0]["fecha_auditoria"],
    produc: storageProd,
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
  var storageProd = JSON.parse(localStorage.getItem("productoComanda"));
  $.ajax({
    url: "res/php/user_actions/imprimeComandaRecupera.php",
    type: "POST",
    data: {
      produc: storageProd,
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
  var storageProd = JSON.parse(localStorage.getItem("productoComanda"));
  $.ajax({
    url: "res/php/user_actions/imprimeComanda.php",
    type: "POST",
    data: {
      produc: storageProd,
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
  var storageProd = JSON.parse(localStorage.getItem("productoComanda"));
  var regis = $("#cantProd").html();
  var pax = $("#numPax").val();
  var coman = $("#comandaActiva").val();
  var mesa = $("#nromesas").val();
  oPos = JSON.parse(localStorage.getItem("oPos"));
  idamb = oPos[0]["id_ambiente"];
  nomamb = oPos[0]["nombre"];
  $.ajax({
    url: "res/php/user_actions/imprimeComandaGen.php",
    type: "POST",
    data: {
      user: sesion["usuario"][0]["usuario"],
      idamb: idamb,
      nomamb: nomamb,
      numComa: coman,
      produc: storageProd,
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
  oPos = JSON.parse(localStorage.getItem("oPos"));

  var parametros = {
    pax: pax,
    mesa: mesa,
    comanda: comanda,
    user: sesion["usuario"][0]["usuario"],
    idamb: oPos[0]["id_ambiente"],
    nomamb: oPos[0]["nombre"],
    fecha: oPos[0]["fecha_auditoria"],
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
            getSeleccionaAmbiente(oPos[0]["id_ambiente"]);
          }
        );
        imprimeComandaRecu();
      },
    });
  }
}

$(document).ready(function () {
  $("#myModalPagarDirecto").on("show.bs.modal", function (event) {
    var storageProd = JSON.parse(localStorage.getItem("productoComanda"));
    if (storageProd == null) {
      swal("Precaucion", "Sin Productos Asociados a esta comanda", "warning");
      $("#myModalPagarDirecto").modal("hide");
      return;
    }
    valor = $("#totalCuenta").val();
    /// $('#btnPagarComanda').attr('disabled',true);
    /// $('#myModalPagarDirecto').modal('show');
  });

  $("#myModalAnulaComanda").on("show.bs.modal", function (event) {
    $("#motivoAnula").val("");
    $("#motivoAnula").focus();
  });

  $("#myModalDescuento").on("show.bs.modal", function (event) {
    var totdes = $("#totalDesc").html();
    totdes = totdes.replace(".00", "");
    totdes = totdes.replace(",", "");
    if (totdes != 0) {
      swal(
        {
          title: "Atencion ",
          text: "La presenre Comanda ya se Causo el Descuento ",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Si anular el Descuento",
          closeOnConfirm: true,
        },
        function () {
          var comanda = $("#numeroComanda").val();
          var descu = 0;
          var motivo = "";
          sesion = JSON.parse(localStorage.getItem("sesion"));
          oPos = JSON.parse(localStorage.getItem("oPos"));
          var parametros = {
            idusr: sesion["usuario"][0]["usuario_id"],
            idamb: oPos[0]["id_ambiente"],
            fecha: oPos[0]["fecha_auditoria"],
            comanda: comanda,
            descuento: descu,
            motivo: motivo,
          };

          $.ajax({
            type: "POST",
            data: parametros,
            url: "res/php/user_actions/getAnulaDescuento.php",
            success: function (datos) {
              setTimeout(function () {
                getComandas(comanda);
              }, 1000);
            },
          });
        }
      );
    }
  });
});
