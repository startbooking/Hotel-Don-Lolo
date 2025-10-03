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

  let {
    user: { usuario, usuario_id, nombres, apellidos, tipo },
  } = sesion;

  $("#usuarioActivo").val(usuario);
  $("#nombreUsuario").html(
    `${apellidos} ${nombres} <span class="caret"></span>`
  );
  $("#menuClave").html(`
  <a class="altoMenu" id="cambiaPass" 
    data-toggle    = 'modal'
    data-id        = '${usuario_id}' 
    data-user      = '${usuario}' 
    data-apellidos = '${apellidos}' 
    data-nombres   = '${nombres}' 
    href="#myModalCambiarClave" style="padding:10px 15px">Cambiar Contraseña
  </a>
`);

  /* Nuevo FIltro Estado Habitaciones */
  // AGREGANDO CLASE ACTIVE AL PRIMER ENLACE ====================
  $('.category_list .category_item[category="all"]').addClass("ct_item-active");

  // FILTRANDO PRODUCTOS  ============================================

  $(".category_item").click(function () {
    var catProduct = $(this).attr("category");

    // AGREGANDO CLASE ACTIVE AL ENLACE SELECCIONADO
    $(".category_item").removeClass("ct_item-active");
    $(this).addClass("ct_item-active");

    // OCULTANDO PRODUCTOS =========================
    $(".product-item").css("transform", "scale(0)");
    function hideProduct() {
      $(".product-item").hide();
    }
    setTimeout(hideProduct, 400);

    // MOSTRANDO PRODUCTOS =========================
    function showProduct() {
      $('.product-item[category="' + catProduct + '"]').show();
      $('.product-item[category="' + catProduct + '"]').css(
        "transform",
        "scale(1)"
      );
    }
    setTimeout(showProduct, 400);
  });

  // MOSTRANDO TODOS LOS PRODUCTOS =======================

  $('.category_item[category="all"]').click(function () {
    function showAll() {
      $(".product-item").show();
      $(".product-item").css("transform", "scale(1)");
    }
    setTimeout(showAll, 400);
  });

  let cia = document.getElementById("pantallaCompaniasOld");
  if (cia != null) {
    var numRegis = 0;
    var filas = $("#numFiles").val();
    var pages = $("#paginas").val();
    traeTotalCompanias(numRegis, filas);
  }

  let perfil = document.getElementById("pantallaHuespedes");
  if (perfil != null) {
    new DataTable("#tablaHuespedes", {
      lengthMenu: [50, 100, 200, 500],
      ajax: "res/php/datasetHuespedes.php",
      processing: true,
      serverSide: true,
      iDisplayLength: 25,
      columnDefs: [
        {
          targets: "_all",
          orderable: true,
        },
      ],
    });
  }

  let fact = document.getElementById("pantallaFacturacion");
  if (fact != null) {
    traeFacturasEstadia();
  }

  let sinReserva = document.querySelector("#formSinReserva");
  if (sinReserva) {
    sinReserva.reset();
  }

  const formReservas = document.getElementById("formReservas");
  if (formReservas) {
    formReservas.reset();
    const llegadaInput = document.getElementById("llegada");
    const nochesInput = document.getElementById("noches");
    const salidaInput = document.getElementById("salida");
    const tipohabiSelect = document.getElementById("tipohabi");
    const tarifahabSelect = document.getElementById("tarifahab");
    const valortarInput = document.getElementById("valortar");
    const nrohabitacionSelect = document.getElementById("nrohabitacion");
    let globalTarifas;
    // Event listeners para las fechas y las noches
    llegadaInput.addEventListener("change", () => {
      sumaFecha();
      habitacionesDisponibles(1);
    });
    nochesInput.addEventListener("change", () => {
      sumaFecha();
      habitacionesDisponibles(1);
    });
    salidaInput.addEventListener("change", () => {
      restaFechas();
      habitacionesDisponibles(1);
    });

    // Event listener para el tipo de habitación
    tipohabiSelect.addEventListener("change", async () => {
      let tarifaHuesped = parseInt(document.querySelector("#idtarifa").value);
      let tarifahab = document.querySelector("#tarifahab");
      habitacionesDisponibles(1);
      globalTarifas = await cargarTarifas();
      const limpia = await limpiaTarifas();
      const llena = await llenaTarifas(globalTarifas);
    });

    // Event listener para el tipo de tarifa
    tarifahabSelect.addEventListener("change", async (e) => {
      let hombres = parseInt(document.querySelector("#hombres").value);
      let mujeres = parseInt(document.querySelector("#mujeres").value);
      let ninos = parseInt(document.querySelector("#ninos").value);

      const valorTar = document.querySelector("#valortar");
      const tarifaFiltrada = globalTarifas.find(
        (tarifa) => tarifa.id == parseInt(e.target.value)
      );
      let valor = await valorTarifaHabitacion(
        hombres + mujeres,
        ninos,
        tarifaFiltrada
      );
      valorTar.value = valor;
    });

    formReservas.addEventListener("submit", async (e) => {
      e.preventDefault();
      let guarda = await guardaReserva();
    });
  }

  $("#example1").DataTable({
    iDisplayLength: 25,
    language: {
      decimal: "",
      emptyTable: "No hay registros",
      info: "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
      infoEmpty: "Mostrando 0 to 0 of 0 Entradas",
      infoFiltered: "(Filtrado de _MAX_ total entradas)",
      infoPostFix: "",
      thousands: ",",
      lengthMenu: "Mostrar _MENU_ Entradas",
      loadingRecords: "Cargando...",
      processing: "Procesando...",
      search: "Buscar:",
      zeroRecords: "Sin resultados encontrados",
      paginate: {
        first: "Primero",
        last: "Ultimo",
        next: "Siguiente",
        previous: "Anterior",
      },
    },
  });

  $("#myModalCalendarioReservas").on("show.bs.modal", async function (event) {
    let reservas = await traeReservasTotal();
    let llenaTabla = await llenaTablaReservas(reservas);
  });

  $("#myModalAjusteCuenta").on("show.bs.modal", async function (event) {
    let button = $(event.relatedTarget);
    let nombre = button.data("nombre");
    let folio = document.querySelector("#folioActivo").value;
    let reserva = document.querySelector("#reservaActual").value;
    let saldo = document.querySelector("#txtSaldoCta").value;
    if (saldo === 0) {
      swal(
        {
          title: "Precaucion",
          text: "Sin Saldo en la Presente Cuenta",
          confirmButtonText: "Aceptar",
          type: "warning",
          closeOnConfirm: true,
        },
        function () {
          $("#myModalAjusteCuenta").modal("hide");
        }
      );
      return;
    }
    let modal = $(this);
    parametros = {
      reserva,
      folio,
    };
    modal
      .find(".modal-title")
      .text(`Ajustar Cuenta ${nombre} - Folio Nro ${folio}`);
    $.ajax({
      url: "res/php/getEstadoCuentaFolio.php",
      type: "POST",
      data: parametros,
      success: function (data) {
        $("#verAjusteCuenta").attr(
          "data",
          `data:application/pdf;base64,${$.trim(data)}`
        );
      },
    });
  });

  $("#myModalObservaciones").on("show.bs.modal", async function (event) {
    document.querySelector("#formObservacionesHab").reset();
    var button = $(event.relatedTarget);
    numero = button.data("numero");
    reserva = button.data("reserva");
    sucia = button.data("sucia");
    ocupada = button.data("ocupada");
    document.querySelector("#numeroHab").value = numero;
    document.querySelector("#numeroRes").value = reserva;
    document.querySelector("#ocupada").value = ocupada;
    document.querySelector("#sucia").value = sucia;
    titulo = document.querySelector("#myModalObservaciones .modal-title");
    if (ocupada == 1) {
      titulo.innerHTML = "Ingresa Observaciones a la Estadia";
    } else {
      if (sucia == 0) {
        titulo.innerHTML = "Envia A Estado Sucia la Habitacion";
      } else {
        titulo.innerHTML = "Limpiar Habitacion";
      }
    }
    let camareras = await traeCamareras();
    let limpia = await limpiaCamareras();
    let seleCama = await llenaSelectCamareras(camareras);
  });

  $("#myModalAdicionaCompania").on("show.bs.modal", function (event) {
    document.querySelector("#formCompania").reset();
    if (tipo > 2) {
      document.querySelector("#inlineRadio1").readonly = true;
      document.querySelector("#inlineRadio2").readonly = true;
      document.querySelector("#inlineRadio1").disabled = true;
      document.querySelector("#inlineRadio2").disabled = true;
    }
  });

  $("#myModalVerObservaciones").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    let reserva = button.data("reserva");
    let estado = button.data("estado");
    var parametros = {
      reserva,
      estado,
    };
    $.ajax({
      type: "POST",
      url: "res/php/observacionesReservaModal.php",
      data: parametros,
      success: function (data) {
        $("#observacionesReserva").html(data);
      },
    });
  });

  $("#myModalAdicionaGrupo").on("show.bs.modal", function (event) {
    document.querySelector("#formGrupo").reset();
    document.querySelector("#idUsuario").value = usuario_id;
  });

  $("#myModalConfirmaReserva").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    let id = button.data("id");
    let huesped = button.data("huesped");
    let orden = button.data("orden");
    let causar = button.data("causar");
    let llegada = button.data("llegada");
    let salida = button.data("salida");
    let noches = button.data("noches");
    let tipohab = button.data("tipohab");
    let nrohab = button.data("nrohab");
    var modal = $(this);

    modal.find(".modal-title").text("Confirmacion Reserva : " + huesped);

    $("#txtTipoHabEst").val(tipohab);
    $("#txtNumeroHabEst").val(nrohab);
    $("#txtNombresEst").val(huesped);

    $("#verConfirmaReserva").attr(
      "data",
      "imprimir/reservas/ConfirmacionReserva_" + id + ".pdf"
    );
  });

  $("#myModalEliminaCentroCia").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var descri = button.data("descri");
    var respon = button.data("respon");
    var modal = $(this);

    modal.find(".modal-title").text("Elimina Centro de Costo : " + descri);

    $("#idCentroEli").val(id);
    $("#nombreEli").val(descri);
    $("#respoEli").val(respon);
  });

  $("#myModalModificaCentroCia").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var descri = button.data("descri");
    var respon = button.data("respon");
    var modal = $(this);

    modal.find(".modal-title").text("Modifica Centro de Costo : " + descri);

    $("#idCentroMod").val(id);
    $("#nombreMod").val(descri);
    $("#respoMod").val(respon);
  });

  $("#myModalCentrosCia").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var empresa = button.data("empresa");
    var nit = button.data("nit");
    var modal = $(this);

    modal.find(".modal-title").text("Centros de Costo : " + empresa);
    $.ajax({
      url: "res/php/traeCentros.php",
      type: "POST",
      data: {
        id,
        empresa,
        nit,
      },
      success: function (datos) {
        $("#idCiaAdi").val(id);
        $("#centrosCia").html(datos);
      },
    });
  });

  $("#myModalMuestraDocumentoCia").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var imagen = button.data("imagen");
    var modal = $(this);
    $("#muestraDocumento").attr("src", imagen);
  });

  $("#myModalAdicionaMantenimiento").on("show.bs.modal", function (event) {
    var fecha = $("#fechaweb").val();
    $("#desdeFechaAdi").val(fecha);
    $("#desdeFechaAdi").prop("min", fecha);
    $("#hastaFechaAdi").val(fecha);
    $("#hastaFechaAdi").prop("min", fecha);
    $("#mensajeMmto").css("display", "none");
    $("#modalReservasIns").css("display", "block");
    $("#observacionesAdi").val("");
    $("#btnMmto").removeAttr("disabled");
    divRese = document.querySelector("#divReserva");
    divRese.classList.add("apaga");
    FormMmto = document.querySelector("#formAdicionaMantenimiento");
    dataTableMmto = document.querySelector("#huespedesMmto");
    FormMmto.reset();
    limpiaHabitacionesMmto();
  });

  $("#myModalEntregaObjeto").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var objeto = button.data("objeto");
    var huesped = button.data("huesped");
    var observa = button.data("observa");
    var ubica = button.data("ubica");
    var modal = $(this);

    $("#idobjetoEnt").val(id);
    $("#objetoEnt").val(objeto);
    $("#huespedEnt").val(huesped);
    $("#observaObjEnt").val(observa);
    $("#ubicacionEnt").val(ubica);
    $("#observaEnt").val("");
    $("#presupuestoAdi").val(0);
  });

  $("#myModalAdicionaObservacionesObjeto").on(
    "show.bs.modal",
    function (event) {
      var button = $(event.relatedTarget);
      var id = button.data("id");
      var objeto = button.data("objeto");
      var huesped = button.data("huesped");
      var observa = button.data("observa");
      var modal = $(this);

      $("#objetoObs").val(id);
      $("#objetoObsObj").val(objeto);
      $("#huespedObsObj").val(huesped);
      $("#observaAntObj").val(observa);
      $("#adicionaObsObj").val("");
    }
  );

  $("#myModalInformacionObjeto").on("show.bs.modal", function (event) {
    var web = $("#rutaweb").val();
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var parametros = {
      id: id,
    };
    var modal = $(this);

    modal.find(".modal-title").text("Objeto Olvidado : ");
    $(".alert").hide();

    $.ajax({
      url: "res/php/buscaObjetoOlvidado.php",
      type: "POST",
      data: parametros,
      success: function (data) {
        $("#modalObjetoInf").html(data);
      },
    });
  });

  $("#myModalAdicionaObservacionesMantenimiento").on(
    "show.bs.modal",
    function (event) {
      var button = $(event.relatedTarget);
      var id = button.data("id");
      var observa = button.data("observa");
      var mmto = button.data("mmto");
      var room = button.data("room");

      var modal = $(this);
      $("#idObsMto").val(id);
      $("#observaAntMto").val(observa);

      modal.find(".modal-title").text("Mantenimiento Habitacion : " + room);

      var modal = $(this);
      $("#detalleMmtoObs").val(mmto);
      $("#adicionaObsMto").val("");
    }
  );

  $("#myModalTerminaMmto").on("show.bs.modal", function (event) {
    var web = $("#rutaweb").val();
    var pagina = $("#ubicacion").val();
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var numroom = button.data("room");

    $("#idMmtoTer").val(id);
    $("#numroom").val(numroom);

    $.ajax({
      url: web + "res/php/detalleMmto.php",
      type: "POST",
      data: { id },
      success: function (data) {
        $("#infoMto").html(data);
      },
    });
  });

  $("#myModalMuestraDeposito").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var imagen = button.data("imagen");
    var modal = $(this);
    $("#muestraDocumento").prop("src", imagen);
  });

  $("#myModalSubirDocumentoCia").on("show.bs.modal", function (event) {
    id = $("#txtIdCiaDoc").val();
    $("#myModalTitle").text("Adicionar Documentos Huesped : ".nombre);
    $("#txtIdCiaUpl").val(id);
  });

  $("#myModalDocumentosCia").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var nombre = button.data("nombre");
    var modal = $(this);

    modal.find(".modal-title").text("Documentos Compañia : " + nombre);
    $("#txtIdCiaDoc").val(id);

    $.ajax({
      url: "res/php/muestraImagenesCia.php",
      type: "POST",
      data: { id },
      success: function (data) {
        $("#muestraImagenesCia").html(data);
      },
    });
  });

  $("#myModalMuestraDocumento").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var imagen = button.data("imagen");
    var exte = button.data("exte");
    var modal = $(this);

    if (exte == "pdf") {
      $("#muestraDocumento").append(
        "<div> <object data='" + imagen + "'></object></div>"
      );
    } else {
      $("#muestraDocumento").prop("src", imagen);
    }
  });

  $("#myModalDocumentos").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var nombre = button.data("nombre");
    var modal = $(this);

    modal.find(".modal-title").text("Documentos Huesped : " + nombre);
    $("#txtIdHuespedDoc").val(id);

    $.ajax({
      url: "res/php/muestraImagenes.php",
      type: "POST",
      data: { id },
      success: function (data) {
        $("#muestraImagenes").html(data);
      },
    });
  });

  $("#myModalSubirDocumento").on("show.bs.modal", function (event) {
    id = $("#txtIdHuespedDoc").val();
    $("#myModalTitle").text("Adicionar Docuentos Huesped : ".nombre);
    $("#txtIdHuespedUpl").val(id);
  });

  $("#myModalAdicionaPerfil").on("show.bs.modal", async function (event) {
    $("#edita").val(0);
    $("#acompana").val(0);
    formu = document.querySelector("#formAdicionaHuespedes");
    formu.reset();
    var button = $(event.relatedTarget);
    var tiporeserva = button.data("reserva");
    $("#creaReser").val(tiporeserva);
    // const tipoDoc = await traeTipoDocumento();
    // console.log(tipoDoc);
  });

  $("#myModalInformacionMmto").on("show.bs.modal", function (event) {
    var web = $("#rutaweb").val();
    var pagina = $("#ubicacion").val();
    var button = $(event.relatedTarget);
    var idmmto = button.data("idmmto");

    $("#idMmtoUpd").val(idmmto);

    $.ajax({
      url: web + "res/php/detalleMmtoInfo.php",
      type: "POST",
      data: { idmmto },
      success: function (data) {
        $("#infoMtoVer").html(data);
      },
    });
  });

  $("#myModalVerInformacionEstadia").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var reserva = button.data("reserva");
    var modal = $(this);
    var parametros = {
      reserva,
    };

    $.ajax({
      type: "POST",
      data: parametros,
      url: "res/php/getInformacionEstadia.php",
      success: function (datos) {
        $(".modalReservas").html("");
        $(".modalReservas").html(datos);
      },
    });
    $(".alert").hide();
  });

  $("#myModalVerCargosFactura").on("show.bs.modal", function (event) {
    var web = $("#rutaweb").val();
    var button = $(event.relatedTarget);
    var numero = button.data("numero");
    var reserva = button.data("reserva");
    var parametros = {
      numero,
      reserva,
    };
    var modal = $(this);

    modal.find(".modal-title").text("Factura Numero : " + numero);
    $(".alert").hide();

    $.ajax({
      url: "res/php/buscaCargosHistoricoFactura.php",
      type: "POST",
      data: parametros,
      success: function (data) {
        $("#verCargosFactura").html(data);
      },
    });
  });

  $("#myModalVerFactura").on("show.bs.modal", function (event) {
    var web = $("#rutaweb").val();
    var button = $(event.relatedTarget);
    var numero = button.data("numero");
    var tipo = button.data("tipo");
    var facturador = button.data("facturador");
    var modal = $(this);

    $("#verFacturaModalCon").attr("data", "");

    if (tipo == 1) {
      titulo = "Nota Credito Numero : ";
      imprime = web + "imprimir/notas/NotaCredito_" + numero + ".pdf";
    } else {
      if (facturador == 1) {
        titulo = "Factura Numero : ";
        imprime = web + "imprimir/facturas/FES-HDL" + numero + ".pdf";
      } else {
        titulo = "Recibo de Caja Numero : ";
        imprime = web + "imprimir/notas/Abono_" + numero + ".pdf";
      }
    }
    modal.find(".modal-title").text(titulo + numero);

    $("#verFacturaModalCon").attr("data", imprime);
    // $(".alert").hide();
  });

  $("#myModalVerReciboCaja").on("show.bs.modal", function (event) {
    var web = $("#rutaweb").val();
    var button = $(event.relatedTarget);
    var numero = button.data("numero");
    var modal = $(this);

    modal.find(".modal-title").text("Recibo de Caja Nro : " + numero);
    var recibo = "Abono_" + numero + ".pdf";

    $("#verFacturaModal").attr("data", web + "imprimir/notas/" + recibo);
    $(".alert").hide();
  });

  $("#myModalVerNotaCredito").on("show.bs.modal", function (event) {
    var web = $("#rutaweb").val();
    var button = $(event.relatedTarget);
    var numero = button.data("numero");
    var modal = $(this);

    modal.find(".modal-title").text("Nota Credito Nro : " + numero);
    var recibo = web + "imprimir/notas/" + "NotaCredito_" + numero + ".pdf";

    $("#verNotaCredito").attr("data", recibo);
    $(".alert").hide();
  });

  $("#myModalAdicionaObservaciones").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var room = button.data("nrohab");
    var nombre = button.data("nombre");
    var noches = button.data("noches");
    var llegada = button.data("llegada");
    var salida = button.data("salida");
    var observa = button.data("observa");
    var modal = $(this);

    modal.find(".modal-title").text(` Adiciona Observaciones: ${nombre}`);
    $("#reservaObs").val(id);
    $("#habitacionObs").val(room);
    $("#huespedObs").val(nombre);
    $("#llegadaObs").val(llegada);
    $("#nochesObs").val(noches);
    $("#salidaObs").val(salida);
    $("#observaAnt").val(observa);
    $("#adicionaObs").val("");
  });

  $(".btnSubir").on("click", function () {
    var formData = new FormData();
    var files = $("#images");
    formData.append("file", files);
    $.ajax({
      url: "../res/php/user_action/uploadFiles.php",
      type: "post",
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        $("#message").html(response);
      },
    });
    return false;
  });

  $("#myModalAnulaFacturaHistorico").on("show.bs.modal", function (event) {
    sesion = JSON.parse(localStorage.getItem("sesion"));
    let {
      user: { tipo },
    } = sesion;
    if (tipo > 2) {
      swal("Precaucion", "Usuario NO Permitido Anular Factura", "warning");
      $("#myModalAnulaFacturaHistorico").modal("hiden");
      return;
    }
    var button = $(event.relatedTarget);
    var nombre = button.data("nombre");
    /* var llega = button.data("llegada");
    var sale = button.data("salida"); */
    var fecha = button.data("fechafac");
    var numero = button.data("numero");
    var reserva = button.data("reserva");
    var perfil = button.data("perfil");
    var idperfil = button.data("idperfil");
    var prefijo = button.data("prefijo");
    var web = $("#rutaweb").val();
    var facturador = button.data("facturador");

    var modal = $(this);

    modal.find(".modal-title").text("Anular Factura: " + numero);
    modal.find(".modal-body #facturaHis").val(numero);
    modal.find(".modal-body #huespedFacHis").val(nombre);
    /* modal.find(".modal-body #llegadaFacHis").val(llega);
    modal.find(".modal-body #salidaFacHis").val(sale); */
    modal.find(".modal-body #numero").val(numero);
    modal.find(".modal-body #reservaHis").val(reserva);
    modal.find(".modal-body #fechaFacHis").val(fecha);
    modal.find(".modal-body #motivoAnulaHis").val("");
    modal.find(".modal-body #perfilHis").val(perfil);
    modal.find(".modal-body #idperfilHis").val(idperfil);
    modal.find(".modal-body #fechafac").val(fecha);
    modal.find(".modal-body #motivoAnula").val("");

    modal.find(".modal-title").text("Factura Numero : " + numero);
    if (facturador == 1) {
      imprime = web + "imprimir/facturas/FES-HDL" + numero + ".pdf";
    } else {
      imprime = web + "imprimir/notas/Abono_" + numero + ".pdf";
    }
    $("#verFacturaHistoricoModal").attr("data", imprime);
    $(".alert").hide();
  });

  $("#myModalverFacturaReserva").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var reserva = button.data("reserva");

    $.ajax({
      url: "res/php/getFacturaReserva.php",
      type: "POST",
      data: { reserva },
      success: function (data) {
        $("#verFacturasHistorico").html(data);
      },
    });
    $(".alert").hide();
  });

  $("#myModalReasignarHuesped").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var reserva = button.data("reserva");
    var modal = $(this);

    modal
      .find(".modal-title")
      .text("Reasigna Huesped Reserva Nro : " + reserva);
    modal.find(".modal-body #reserva").val(reserva);
    $("#buscarHuespedRes").val("");
    $("#nroreserva").val(reserva);
    $(".alert").hide();
  });

  $("#myModalAnulaFactura").on("show.bs.modal", function (event) {
    sesion = JSON.parse(localStorage.getItem("sesion"));
    let {
      user: { tipo },
    } = sesion;
    if (tipo > 2) {
      swal("Precaucion", "Usuario NO permitido Anular Factura", "warning");
      $("#myModalAnulaFactura").modal("hiden");
      return;
    }

    var web = $("#rutaweb").val();
    var button = $(event.relatedTarget);
    var apellidos = button.data("apellidos");
    var nombres = button.data("nombres");
    var llega = button.data("llegada");
    var sale = button.data("salida");
    var fecha = button.data("fechafac");
    var numero = button.data("numero");
    var reserva = button.data("reserva");
    var perfil = button.data("perfil");
    var idperfil = button.data("idperfil");
    var prefijo = button.data("prefijo");
    var facturador = button.data("facturador");

    var modal = $(this);

    modal.find(".modal-body #factura").val(numero);
    modal.find(".modal-body #huespedAnu").val(apellidos + " " + nombres);
    modal.find(".modal-body #llegada").val(llega);
    modal.find(".modal-body #salida").val(sale);
    modal.find(".modal-body #numero").val(numero);
    modal.find(".modal-body #reserva").val(reserva);
    modal.find(".modal-body #perfil").val(perfil);
    modal.find(".modal-body #idperfil").val(idperfil);
    modal.find(".modal-body #fechafac").val(fecha);
    modal.find(".modal-body #motivoAnula").val("");

    if (facturador == 1) {
      modal.find(".modal-title").text(`Anular Factura: ${prefijo} ${numero}`);
      imprime = web + "imprimir/facturas/FES-" + prefijo + numero + ".pdf";
    } else {
      modal
        .find(".modal-title")
        .text("Anular Recibo de Caja Numero : " + numero);
      imprime = web + "imprimir/notas/Abono_" + numero + ".pdf";
    }

    $("#verFacturaModal").attr("data", imprime);

    $(".alert").hide();
  });

  $("#myModalHistoricoFacturasCia").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var empresa = button.data("empresa");
    var nit = button.data("nit");
    var parametros = {
      id,
    };
    var modal = $(this);

    modal.find(".modal-title").text("Historico Facturas : " + empresa);
    modal.find(".modal-body #txtIdReservasCiaHis").val(id);

    $.ajax({
      type: "POST",
      data: parametros,
      url: "res/php/historicoFacturasCia.php",
      beforeSend: function (objeto) {},
      success: function (datos) {
        $("#historicoFacturas").html(datos);
      },
    });
    $(".alert").hide();
  });

  $("#myModalVerReserva").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var reserva = button.data("reserva");
  });

  $("#myModalModificaPerfilHuesped").on("show.bs.modal", function (event) {
    let button = $(event.relatedTarget);
    let id = button.data("id");
    let nombre = button.data("nombre");
    $("#editaPer").val(1);

    var parametros = {
      id,
    };
    var modal = $(this);

    modal.find(".modal-title").text("Modifica Perfil del Huesped: " + nombre);
    modal.find(".modal-body #txtIdHuespedUpd").val(id);

    $.ajax({
      type: "POST",
      data: parametros,
      url: "res/php/dataUpdateHuesped.php",
      success: function (datos) {
        $("#datosHuesped").html("");
        $("#datosHuesped").html(datos);
      },
    });
    $(".alert").hide();
  });

  $("#myModalSalidaCongelada").on("show.bs.modal", function (event) {
    sesion = JSON.parse(localStorage.getItem("sesion"));
    let {
      user: { usuario, usuario_id },
    } = sesion;
    var web = $("#rutaweb").val();
    var pagina = $("#ubicacion").val();
    var folio = $("#folioActivo").val();
    var reserva = $("#reservaActual").val();
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var hues = button.data("idhues");
    var nombre = button.data("nombre");
    var turismo = button.data("impto");
    var nrohab = button.data("nrohab");
    var idcia = button.data("idcia");
    var idcentro = button.data("idcentro");
    var modal = $(this);

    var parametros = {
      turismo,
      folio,
      reserva,
      nrohab,
      usuario,
      idusuario: usuario_id,
    };

    if (folio == 0) {
      swal(
        "Precaucion",
        "Seleccione un Folio para realizar el Pago",
        "warning"
      );
      $("#myModalSalidaCongelada").modal("data-dismiss", "modal");
    } else {
      var saldo = $("#total" + folio).val();
      var consumo = $("#consumo" + folio).val();
      var abonos = $("#abonos" + folio).val();
      if (abonos == "0.00" && consumo == "0.00") {
        swal(
          {
            title: "Cuenta sin Consumos !",
            text: "Esta Cuenta no Presenta Consumos, Desea Realizar la Salida ?",
            type: "warning",
            showCancelButton: true,
            cancelButtonClass: "btn-warning",
            cancelButtonText: "Cancelar Salida",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Si, Realizar Salida!",
            closeOnConfirm: false,
          },
          function () {
            $.ajax({
              type: "POST",
              url: web + "res/php/salidaSinPago.php",
              data: parametros,
              success: function (data) {
                swal(
                  {
                    title: "Salida del Huesped Realizada con Exito !",
                    type: "success",
                    confirmButtonText: "Aceptar",
                    closeOnConfirm: true,
                  },
                  function () {
                    $(location).attr("href", "home");
                  }
                );
              },
            });
          }
        );
        $("#myModalSalidaCongelada").modal("data-dismiss", "modal");
        return 0;
      }

      modal.find(".modal-title").text("Salida Huesped: " + nombre);

      modal.find(".modal-body #txtIdReservaSal").val(id);
      modal.find(".modal-body #txtIdReservaCon").val(id);
      modal.find(".modal-body #txtIdHuespedSal").val(hues);
      modal.find(".modal-body #txtIdHuespedCon").val(hues);
      modal.find(".modal-body #txtIdCiaSal").val(idcia);
      modal.find(".modal-body #txtIdCentroCiaSal").val(idcentro);

      modal.find(".modal-body #txtNumeroHabSalCon").val(nrohab);
      modal.find(".modal-body #txtNombresSal").val(nombre);
      modal.find(".modal-body #seleccionaCiaCon").val(idcia);

      traeHuespedesCon(reserva, hues);

      $.ajax({
        type: "POST",
        url: web + "res/php/saldoCuenta.php",
        data: parametros,
        success: function (data) {
          $("#estadoCuentaCon").html(data);
        },
      });
    }
  });

  $("#myModalCongelarCuenta").on("show.bs.modal", function (event) {
    var web = $("#rutaweb").val();
    var pagina = $("#ubicacion").val();
    var folio = $("#folioActivo").val();
    var reserva = $("#reservaActual").val();
    var nrofolio1 = $("#nrofolio1").val();
    var nrofolio2 = $("#nrofolio2").val();
    var nrofolio3 = $("#nrofolio3").val();
    var nrofolio4 = $("#nrofolio4").val();
    var empresa = $("#empresa").val();
    var centro = $("#centroCia").val();
    var nit = $("#nit").val();

    var button = $(event.relatedTarget);
    var id = button.data("id");
    var hues = button.data("idhues");
    var apellido1 = button.data("apellido1");
    var apellido2 = button.data("apellido2");
    var nombre1 = button.data("nombre1");
    var nombre2 = button.data("nombre2");
    var nrohab = button.data("nrohab");
    var idcia = button.data("idcia");
    var idcentro = button.data("idcentro");
    var turismo = button.data("impto");

    var modal = $(this);

    var parametros = {
      turismo,
      folio,
      reserva,
      nrohab,
    };

    if (folio == 0) {
      swal({
        title: "Seleccione un Folio para Realizar el Pago",
        type: "warning",
        confirmButtonText: "Aceptar",
        closeOnConfirm: true,
      });
      $("#myModalCongelarCuenta").modal("data-dismiss", "modal");
    } else {
      if (nrofolio2 != 0 || nrofolio3 != 0 || nrofolio4 != 0) {
        swal({
          title: "Precaucion",
          text: "Otros Folios con Saldo, No Permitido Congelar la Presente Cuenta",
          type: "warning",
          confirmButtonText: "Aceptar",
          closeOnConfirm: true,
        });
        $("#myModalCongelarCuenta").modal("data-dismiss", "modal");
      } else {
        var saldo = $("#txtSaldoCta").val();
        var consumo = $("#txtConsumoCta").val();
        var abonos = $("#txtAbonosCta").val();
        var imptos = $("#txtImptoCta").val();

        if (abonos == 0 && consumo == 0) {
          swal(
            {
              title: "Cuenta sin Consumos !",
              text: "Esta Cuenta no Presenta Consumos, Desea Realizar la Salida ?",
              type: "warning",
              showCancelButton: true,
              cancelButtonClass: "btn-warning",
              cancelButtonText: "Cancelar Salida",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Si, Realizar Salida!",
              closeOnConfirm: false,
            },
            function () {
              $.ajax({
                type: "POST",
                url: web + "res/php/salidaSinPago.php",
                data: parametros,
                success: function (data) {
                  swal(
                    {
                      title: "Salida del Huesped Realizada con Exito !",
                      type: "success",
                      confirmButtonText: "Aceptar",
                      closeOnConfirm: true,
                    },
                    function () {
                      $(location).attr("href", "facturacionEstadia");
                    }
                  );
                },
              });
            }
          );
          $("#myModalSalidaHuesped").modal("data-dismiss", "modal");
          return 0;
        }

        modal
          .find(".modal-title")
          .text(
            `Congelar Cuenta  : ${apellido1} ${apellido2} ${nombre1} ${nombre2}`
          );
        modal.find(".modal-body #txtIdCiaCong").val(idcia);
        modal.find(".modal-body #txtEmpresaCong").val(empresa);
        modal.find(".modal-body #txtNitCong").val(nit);
        modal.find(".modal-body #txtIdReservaCong").val(id);
        modal.find(".modal-body #txtIdHuespedCong").val(hues);
        modal.find(".modal-body #txtNumeroHabCong").val(nrohab);
        modal
          .find(".modal-body #txtApellidosCong")
          .val(`${apellido1} ${apellido2} ${nombre1} ${nombre2}`);
        modal.find(".modal-body #valorSaldo").val(number_format(saldo, 2));

        traeHuespedes(reserva, hues);

        $.ajax({
          type: "POST",
          url: web + "res/php/saldoCuenta.php",
          data: parametros,
          success: function (data) {
            $("#estadoCuenta").html(data);
          },
        });
      }
    }
  });

  $("#myModalAdicionaAcompanante").on("show.bs.modal", function (event) {
    $("#mensajeEli").html("");
    let idrese = $("#idreservaAco").val();
    let huespe = $("#idhuespedAco").val();

    FormAcompa = document.querySelector("#acompananteReserva");
    FormAcompa.reset();
    $("#idReservaAdiAco").val(idrese);
    $("#mensajeEliAco").html("");
    $(".alert").hide();
    let modal = $(this);
    modal.find(".modal-title").text("Acompañantes : " + huespe);

    $("#apellido1").focus();
  });

  $("#myModalAcompanantesHistoricoReserva").on(
    "show.bs.modal",
    function (event) {
      var web = $("#rutaweb").val();
      var button = $(event.relatedTarget);
      var idres = button.data("id");
      var nombre = button.data("nombre");
      var modal = $(this);
      var parametros = {
        idres,
      };
      modal.find(".modal-title").text("Acompañantes : " + nombre);
      modal.find(".modal-body #idreservaAco").val(idres);
      $.ajax({
        type: "POST",
        data: parametros,
        url: web + "res/php/dataBuscarAcompanantesHistorico.php",
        success: function (datos) {
          $("#acompanantesHist").html(datos);
        },
      });
      $(".alert").hide();
    }
  );

  $("#myModalAcompanantesReserva").on("show.bs.modal", function (event) {
    var web = $("#rutaweb").val();
    $("#acompana").val(1);
    var button = $(event.relatedTarget);
    var idres = button.data("id");
    var nombre = button.data("nombre");
    let pagina = $("#ubicacion").val();
    let btnSle = document.querySelector(".btnSaleAco");
    btnSle.setAttribute("href", pagina);
    var modal = $(this);
    var parametros = {
      idres,
    };
    modal.find(".modal-title").text("Acompañantes : " + nombre);
    modal.find(".modal-body #idreservaAco").val(idres);
    modal.find(".modal-body #idhuespedAco").val(nombre);
    $.ajax({
      type: "POST",
      data: parametros,
      url: web + "res/php/dataBuscarAcompanantes.php",
      success: function (datos) {
        $("#acompanantes").html(datos);
      },
    });
    $(".alert").hide();
  });

  $("#myModalTrasladarCargo").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var hues = button.data("huesped");
    var descrip = button.data("descrip");
    var monto = button.data("monto");
    var impto = button.data("impto");
    var info = button.data("info");
    var refer = button.data("refer");
    var fecha = button.data("fecha");
    var reserva = button.data("reserva");
    var huesped = button.data("huesped");
    var room = button.data("room");
    var cant = button.data("cant");
    var tipo = button.data("tipo");
    var pagos = button.data("pagos");

    if (tipo == 3) {
      $("#divPagos").css("display", "block");
      $("#divCargos").css("display", "none");
    } else {
      $("#divPagos").css("display", "none");
      $("#divCargos").css("display", "block");
    }

    var modal = $(this);

    modal.find(".modal-title").text("Trasladar Cargo: " + descrip);
    modal.find(".modal-body #txtIdHuespedTras").val(huesped);
    modal.find(".modal-body #txtIdConsumoTras").val(id);
    modal.find(".modal-body #txtIdReservaTras").val(reserva);
    modal.find(".modal-body #txtNumeroHabTras").val(room);
    modal.find(".modal-body #txtDescripcionTras").val(descrip);
    modal.find(".modal-body #txtCantidadTras").val(cant);
    modal.find(".modal-body #txtValorConsumoTras").val(monto);
    modal.find(".modal-body #txtValorImptoTras").val(impto);
    modal.find(".modal-body #txtValorPagosTras").val(pagos);
    modal.find(".modal-body #txtReferenciaTras").val(refer);
    modal.find(".modal-body #txtDetalleCargoTras").val(info);
    $("#txtMotivoTras").val("");
    $("#txtMotivoTras").focus();
  });

  $("#myModalInformacionCompania").on("show.bs.modal", function (event) {
    var web = $("#rutaweb").val();
    var button = $(event.relatedTarget);
    var idcia = button.data("idcia");
    var nombre = button.data("nombre");
    var modal = $(this);
    modal.find(".modal-title").text("Informacion Huesped: " + nombre);
    parametros = {
      idcia,
    };
    $.ajax({
      url: web + "res/php/getDatosCia.php",
      type: "POST",
      data: parametros,
      success: function (data) {
        $("#datosCia").html(data);
      },
    });
  });

  $("#myModalAnularSalida").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var hues = button.data("idhuesped");
    var tipohab = button.data("tipohab");
    var nrohab = button.data("nrohab");
    var nombre = button.data("nombre");
    var llegada = button.data("llegada");
    var salida = button.data("salida");
    var noches = button.data("noches");
    var hombres = button.data("hombres");
    var mujeres = button.data("mujeres");
    var ninos = button.data("ninos");
    var tarifa = button.data("tarifa");
    var valor = button.data("valor");
    var observaciones = button.data("observaciones");
    var modal = $(this);

    modal.find(".modal-title").text("Ingresar Huesped: " + nombre);
    modal.find(".modal-body #txtIdReservaAnu").val(id);
    modal.find(".modal-body #txtIdHuespedAnu").val(hues);
    modal.find(".modal-body #txtTipoHabAnu").val(tipohab);
    modal.find(".modal-body #txtNumeroHabAnu").val(nrohab);
    modal.find(".modal-body #txtNombreCompleto").val(nombre);
    modal.find(".modal-body #txtLlegadaAnu").val(llegada);
    modal.find(".modal-body #txtSalidaAnu").val(salida);
    modal.find(".modal-body #txtNochesAnu").val(noches);
    modal.find(".modal-body #txtHombresAnu").val(hombres);
    modal.find(".modal-body #txtMujeresAnu").val(mujeres);
    modal.find(".modal-body #txtNinosAnu").val(ninos);
    modal.find(".modal-body #areaComentariosAnu").val(observaciones);
    modal.find(".modal-body #txtTarifaAnu").val(tarifa);
    modal.find(".modal-body #txtValorTarifaAnu").val(number_format(valor, 2));
    $(".alert").hide();
  });

  $("#myModalAnulaIngreso").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var hues = button.data("idhuesped");
    var tipohab = button.data("tipohab");
    var nrohab = button.data("nrohab");
    var nombre = button.data("nombre");
    var llegada = button.data("llegada");
    var salida = button.data("salida");
    var noches = button.data("noches");
    var hombres = button.data("hombres");
    var mujeres = button.data("mujeres");
    var ninos = button.data("ninos");
    var tarifa = button.data("tarifa");
    var valor = button.data("valor");
    var observaciones = button.data("observaciones");
    var modal = $(this);

    modal.find(".modal-title").text("Ingresar Huesped: " + nombre);
    modal.find(".modal-body #txtIdReservaAnu").val(id);
    modal.find(".modal-body #txtIdHuespedAnu").val(hues);
    modal.find(".modal-body #txtTipoHabAnu").val(tipohab);
    modal.find(".modal-body #txtNumeroHabAnu").val(nrohab);
    modal.find(".modal-body #txtNombresAnu2").val(nombre);
    modal.find(".modal-body #txtLlegadaAnu").val(llegada);
    modal.find(".modal-body #txtSalidaAnu").val(salida);
    modal.find(".modal-body #txtNochesAnu").val(noches);
    modal.find(".modal-body #txtHombresAnu").val(hombres);
    modal.find(".modal-body #txtMujeresAnu").val(mujeres);
    modal.find(".modal-body #txtNinosAnu").val(ninos);
    modal.find(".modal-body #areaComentariosAnu").val(observaciones);
    modal.find(".modal-body #txtTarifaAnu").val(tarifa);
    modal.find(".modal-body #txtValorTarifaAnu").val(number_format(valor, 2));
    $(".alert").hide();
  });

  $("#myModalBuscaHuesped").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var modal = $(this);
    var buscar = $("#buscarHuesped").val();

    var parametros = {
      buscar,
    };
    modal
      .find(".modal-title")
      .text("Buscar Huesped Por : " + buscar.toUpperCase());
    $.ajax({
      type: "POST",
      data: parametros,
      url: "res/php/dataBuscarHuesped.php",
      success: function (datos) {
        $("#huespedesEncontrados").html("");
        $("#huespedesEncontrados").html(datos);
      },
    });
    $(".alert").hide();
  });

  $("#myModalBuscaAcompanaHuesped").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var modal = $(this);
    var buscar = $("#buscarAcoHuesped").val();

    var parametros = {
      buscar,
    };
    if (buscar === undefined) {
      buscar = "TODOS";
    }
    modal.find(".modal-title").text("Buscar Huesped Por : " + buscar);
    $.ajax({
      type: "POST",
      data: parametros,
      url: "res/php/dataBuscarHuespedAco.php",
      success: function (datos) {
        $("#huespedesAcompaEncontrados").html("");
        $("#huespedesAcompaEncontrados").html(datos);
      },
    });
    $(".alert").hide();
  });

  $("#myModalBuscaHuespedRes").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var modal = $(this);
    var buscar = $("#buscarHuespedRes").val();
    var web = $("#webPage").val();
    var parametros = {
      buscar,
    };
    modal
      .find(".modal-title")
      .text("Buscar Huesped Por : " + buscar.toUpperCase());
    $.ajax({
      type: "POST",
      data: parametros,
      url: web + "res/php/dataBuscarHuespedRes.php",
      success: function (datos) {
        $("#huespedesEncontradosRes").html("");
        $("#huespedesEncontradosRes").html(datos);
      },
    });
    $(".alert").hide();
  });

  $("#myModalModificaEstadia").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var nombre = button.data("nombre");
    var modal = $(this);
    // $("#editaRes").val(0);
    var parametros = {
      id,
    };
    modal.find(".modal-title").text(`Modifica Estadia : ${nombre}`);
    $.ajax({
      type: "POST",
      data: parametros,
      url: "res/php/dataUpdateEstadia.php",
      success: function (datos) {
        $("#modalReservasEst").html("");
        $("#modalReservasEst").html(datos);
      },
    });
    $(".alert").hide();
  });

  $("#myModalModificaCongelada").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var nombrecom = button.data("nombre");
    var modal = $(this);
    var parametros = {
      id,
    };
    modal.find(".modal-title").text("Modifica Estadia : " + nombrecom);
    $.ajax({
      type: "POST",
      data: parametros,
      url: "res/php/dataUpdateCongelada.php",
      beforeSend: function (objeto) {},
      success: function (datos) {
        $("#modalReservasCon").html("");
        $("#modalReservasCon").html(datos);
      },
    });
    $(".alert").hide();
  });

  $("#myModalMoverCargo").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var hues = button.data("huesped");
    var descrip = button.data("descrip");
    var monto = button.data("monto");
    var impto = button.data("impto");
    var info = button.data("info");
    var refer = button.data("refer");
    var fecha = button.data("fecha");
    var reserva = button.data("reserva");
    var huesped = button.data("huesped");
    var room = button.data("room");
    var cant = button.data("cant");

    var modal = $(this);

    modal.find(".modal-title").text("Mover Cargo: " + descrip);
    modal.find(".modal-body #txtIdHuespedMov").val(huesped);
    modal.find(".modal-body #txtIdConsumoMov").val(id);
    modal.find(".modal-body #txtIdReservaMov").val(reserva);
    modal.find(".modal-body #txtNumeroHabMov").val(room);
    modal.find(".modal-body #txtDescripcionMov").val(descrip);
    modal.find(".modal-body #txtCantidadMov").val(cant);
    modal.find(".modal-body #txtValorConsumoMov").val(monto);
    modal.find(".modal-body #txtValorImptoMov").val(impto);
    modal.find(".modal-body #txtReferenciaMov").val(refer);
    modal.find(".modal-body #txtDetalleCargoMov").val(info);
    $("#txtMotivoAnula").focus();
  });

  $("#myModalEstadoCuenta").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var reserva = button.data("id");
    var hues = button.data("idhuesped");
    var nombre = button.data("nombre");
    var turismo = button.data("impto");
    var nrohab = button.data("nrohab");
    var tipohab = button.data("tipohab");
    var modal = $(this);
    var parametros = {
      reserva,
    };

    web = $("#rutaweb").val();
    modal.find(".modal-title").text("Estado de Cuenta : " + nombre);
    modal.find(".modal-body #txtIdReservaEst").val(reserva);
    modal.find(".modal-body #txtIdHuespedEst").val(hues);
    modal.find(".modal-body #txtTipoHabEst").val(tipohab);
    modal.find(".modal-body #txtNumeroHabEst").val(nrohab);
    modal.find(".modal-body #txtNombresEst").val(nombre);
    modal.find(".modal-body #txtImptoTuriEst").val(turismo);

    $.ajax({
      url: "res/php/getEstadoCuentaReservaModal.php",
      type: "POST",
      data: parametros,
      success: function (data) {
        $("#verEstadoCuenta").attr(
          "data",
          web + "imprimir/informes/Estado_Cuenta_Huesped_" + reserva + ".pdf"
        );
      },
    });
  });

  $("#myModalEstadoCuentaFolio").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var reserva = button.data("reserva");
    var folio = $("#folioActivo").val();
    var nombre = button.data("nombre");
    let file = makeid(12);
    var modal = $(this);
    var parametros = {
      reserva,
      folio,
      file,
    };

    web = $("#rutaweb").val();
    modal
      .find(".modal-title")
      .text(`Estado de Cuenta ${nombre} - Folio Nro ${folio}`);
    $.ajax({
      url: "res/php/getEstadoCuentaFolio.php",
      type: "POST",
      data: parametros,
      success: function (data) {
        $("#verEstadoCuentaFolio").attr(
          "data",
          `data:application/pdf;base64,${$.trim(data)}`
        );
      },
    });
  });

  $("#myModalSalidaHuesped").on("show.bs.modal", function (event) {
    sesion = JSON.parse(localStorage.getItem("sesion"));
    let {
      user: { usuario, usuario_id },
    } = sesion;
    var credito = 0;
    var web = $("#rutaweb").val();
    var pagina = $("#ubicacion").val();
    var folio = $("#folioActivo").val();
    var reserva = $("#reservaActual").val();
    var consumo = $("#saldoActual").val();
    var abonos = $("#totalPagos").val();
    var saldo = consumo - abonos;

    formulario = document.querySelector("#guardarPagosRoomSal");
    formulario.reset();

    var button = $(event.relatedTarget);
    var id = button.data("id");
    var hues = button.data("idhues");
    var idcia = button.data("idcia");
    var idcentro = button.data("idcentro");
    var nombre = button.data("nombre");
    var turismo = button.data("impto");
    var nrohab = button.data("nrohab");
    var modal = $(this);
    var saldofolio = $("#consumo" + folio).val();
    var abonofolio = $("#abonos" + folio).val();
    estado = document.querySelector("#estadoCuenta");
    mensajeSal = document.querySelector("#mensajeSalida");
    btnSalida = document.querySelector(".btnSalida");
    estado.classList.remove("apaga");
    mensajeSal.classList.add("apaga");
    btnSalida.classList.remove("apaga");

    $("#txtIdCiaSal").val(0);
    $("#txtIdCentroCiaSal").val(0);

    var parametros = {
      turismo,
      folio,
      reserva,
      nrohab,
      usuario,
      usuario_id,
    };

    if (abonos == 0 && consumo == 0) {
      swal(
        {
          title: "Cuenta sin Consumos !",
          text: "Esta Cuenta no Presenta Consumos, Desea Realizar la Salida ?",
          type: "warning",
          showCancelButton: true,
          cancelButtonClass: "btn-warning",
          cancelButtonText: "Cancelar Salida",
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Si, Realizar Salida!",
          closeOnConfirm: false,
        },
        function () {
          $.ajax({
            type: "POST",
            url: web + "res/php/salidaSinPago.php",
            data: parametros,
            success: function (data) {
              swal(
                {
                  title: "Salida del Huesped Realizada con Exito !",
                  type: "success",
                  confirmButtonText: "Aceptar",
                  closeOnConfirm: true,
                },
                function () {
                  $(location).attr("href", "home");
                }
              );
            },
          });
        }
      );
      $("#myModalSalidaHuesped").modal("data-dismiss", "modal");
    } else {
      if (saldofolio == 0 && abonofolio == 0) {
        swal(
          "Atencion",
          "Folio Sin Consumos, No Permitido Realizar Salida",
          "warning"
        );
        $("#myModalSalidaHuesped").modal("data-dismiss", "modal");
      } else {
        modal.find(".modal-title").text("Salida Huesped : " + nombre);
        modal.find(".modal-body #txtIdReservaSal").val(id);
        modal.find(".modal-body #txtIdHuespedSal").val(hues);
        modal.find(".modal-body #txtIdCiaSal").val(idcia);
        modal.find(".modal-body #txtIdCentroCiaSal").val(idcentro);
        modal.find(".modal-body #txtImptoTuriSal").val(turismo);
        modal.find(".modal-body #txtNumeroHabSal").val(nrohab);
        modal.find(".modal-body #txtHuespedSal").val(`${nombre}`);

        traeHuespedes(reserva, hues);

        $.ajax({
          type: "POST",
          url: web + "res/php/saldoCuenta.php",
          data: parametros,
          success: function (data) {
            $("#estadoCuenta").html(data);
          },
        });
      }
    }
  });

  $("#myModalAjusteConsumo").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var hues = button.data("idhuesped");
    var apellidos = button.data("apellidos");
    var nombres = button.data("nombres");
    var nrohab = button.data("nrohab");
    var modal = $(this);

    modal.find(".modal-title").text("Ajustes : " + apellidos + " " + nombres);
    modal.find(".modal-body #txtIdReservaAju").val(id);
    modal.find(".modal-body #txtIdHuespedAju").val(hues);
    modal.find(".modal-body #txtNumeroHabAju").val(nrohab);
    modal.find(".modal-body #txtApellidosAju").val(apellidos);
    modal.find(".modal-body #txtNombresAju").val(nombres);
    $("#codigoAjuste").focus();
    $(".alert").hide();
  });

  $("#myModalCambiaTarifa").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var nombre = button.data("nombre");
    var modal = $(this);
    var parametros = {
      id,
    };

    modal.find(".modal-title").text(`Informacion Estadia: ${nombre}`);
    modal.find(".modal-body #txtIdReservaTar").val(id);
    $.ajax({
      type: "POST",
      data: parametros,
      url: "res/php/dataCambiarTarifa.php",
      beforeSend: function (objeto) {},
      success: function (datos) {
        $("#modalCambiarTarifa").html("");
        $("#modalCambiarTarifa").html(datos);
      },
    });
    $(".alert").hide();
  });

  $("#myModalCambiaHabitacion").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var nombre = button.data("nombre");
    var modal = $(this);
    var parametros = {
      id,
    };

    modal.find(".modal-title").text(`Informacion Estadia: ${nombre}`);
    modal.find(".modal-body #txtIdReservaCam").val(id);
    $.ajax({
      type: "POST",
      data: parametros,
      url: "res/php/dataCambiarHabitacion.php",
      success: function (datos) {
        $("#cambiaHabitacion").html("");
        $("#cambiaHabitacion").html(datos);
      },
    });
    $(".alert").hide();
  });

  $("#myModalAdicionaReserva").on("show.bs.modal", function (event) {
    $("#edita").val(0);
    $("#editaRes").val(0);
    $("#creaReser").val(1);
    formRes = document.querySelector("#formReservas").reset();
  });

  $("#myModalModificaReserva").on("show.bs.modal", async function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var nombre = button.data("nombre");
    var modal = $(this);
    $("#editaRes").val(1);
    modal.find(".modal-title").text("Modifica Reserva Actual: " + nombre);
    let modalUpd = document.querySelector("#modalReservasUpd");
    let modifica = await traeReservaModificar(id);
    modalUpd.innerHTML = modifica;

    const formReservas = document.getElementById("formUpdateReservas");
    const llegadaInput = document.getElementById("llegadaUpd");
    const nochesInput = document.getElementById("nochesUpd");
    const salidaInput = document.getElementById("salidaUpd");
    const tipohabiSelect = document.getElementById("tipohabiUpd");
    const tarifahabSelect = document.getElementById("tarifahabUpd");
    const valortarInput = document.getElementById("valortarifaUpd");
    const nrohabitacionSelect = document.getElementById("nrohabitacionUpd");
    let globalTarifas;
    // Event listeners para las fechas y las noches
    llegadaInput.addEventListener("change", () => {
      sumaFecha();
      habitacionesDisponibles(2);
    });
    nochesInput.addEventListener("change", () => {
      sumaFecha();
      habitacionesDisponibles(2);
    });
    salidaInput.addEventListener("change", () => {
      restaFechas();
      habitacionesDisponibles(2);
    });

    // Event listener para el tipo de habitación
    tipohabiSelect.addEventListener("blur", async () => {
      // console.log('PAso Evento OnBLur')
      await habitacionesDisponibles(2);
      globalTarifas = await cargarTarifas();
      const limpia = await limpiaTarifas();
      const llena = await llenaTarifas(globalTarifas);
      const valorTar = document.querySelector("#valortarifaUpd");
      valorTar.value = 0;
    });

    // Event listener para el tipo de tarifa
    tarifahabSelect.addEventListener("change", async (e) => {
      let hombres = parseInt(document.querySelector("#hombresUpd").value);
      let mujeres = parseInt(document.querySelector("#mujeresUpd").value);
      let ninos = parseInt(document.querySelector("#ninosUpd").value);

      const valorTar = document.querySelector("#valortarifaUpd");
      const tarifaFiltrada = globalTarifas.find(
        (tarifa) => tarifa.id == parseInt(e.target.value)
      );
      let valor = await valorTarifaHabitacion(
        hombres + mujeres,
        ninos,
        tarifaFiltrada
      );
      valorTar.value = valor;
    });

    formReservas.addEventListener("submit", async (e) => {
      e.preventDefault();
      let guarda = await updateReserva();
    });

    /* $.ajax({
      type: "POST",
      data: parametros,
      url: "res/php/dataUpdateReserva.php",
      success: function (datos) {
        $("#modalReservasUpd").html("");
        $("#modalReservasUpd").html(datos);
      },
    }); */
    $(".alert").hide();
  });

  $("#myModalCancelaReserva").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var nombre = button.data("nombre");
    var modal = $(this);
    $("#editaRes").val(1);
    var parametros = {
      id,
    };
    modal.find(".modal-title").text("Cancela Reserva Actual: " + nombre);

    $.ajax({
      type: "POST",
      data: parametros,
      url: "res/php/dataCancelaReserva.php",
      success: function (datos) {
        $("#modalReservaCan").html("");
        $("#modalReservaCan").html(datos);
      },
    });
    $(".alert").hide();
  });

  $("#myModalHistoricoReservasCia").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var empresa = button.data("empresa");
    var nit = button.data("nit");
    var parametros = {
      id,
    };
    var modal = $(this);

    modal.find(".modal-title").text("Historico Reservas : " + empresa);
    modal.find(".modal-body #txtIdReservasCiaHis").val(id);

    $.ajax({
      type: "POST",
      data: parametros,
      url: "res/php/historicoReservasCia.php",
      beforeSend: function (objeto) {},
      success: function (datos) {
        $("#historicoReserva").html(datos);
      },
    });
    $(".alert").hide();
  });

  $("#myModalReservasEsperadasCia").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var empresa = button.data("empresa");
    var nit = button.data("nit");
    var parametros = {
      id,
    };
    var modal = $(this);

    modal.find(".modal-title").text("Reservas Esperadas: " + empresa);
    modal.find(".modal-body #txtIdReservasCiaEsp").val(id);

    $.ajax({
      type: "POST",
      data: parametros,
      url: "res/php/reservasEsperadasCia.php",
      beforeSend: function (objeto) {},
      success: function (datos) {
        $("#reservasEsperadas").html(datos);
      },
    });
    $(".alert").hide();
  });

  $("#myModalHuespedesCia").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var empresa = button.data("empresa");
    var nit = button.data("nit");
    var parametros = {
      id,
    };
    var modal = $(this);

    modal.find(".modal-title").text("Huespedes de la Compañia: " + empresa);
    modal.find(".modal-body #txtIdCiaUpd").val(id);

    $.ajax({
      type: "POST",
      data: parametros,
      url: "res/php/huespedesCia.php",
      beforeSend: function (objeto) {},
      success: function (datos) {
        $("#huespedesCia").html(datos);
      },
    });
    $(".alert").hide();
  });

  $("#myModalContactosCia").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var empresa = button.data("empresa");
    var nit = button.data("nit");
    var parametros = {
      id,
    };
    var modal = $(this);

    modal.find(".modal-title").text("Contactos de la Compañia: " + empresa);
    modal.find(".modal-body #txtIdCiaUpd").val(id);

    $.ajax({
      type: "POST",
      data: parametros,
      url: "res/php/contactosCia.php",
      beforeSend: function (objeto) {},
      success: function (datos) {
        $("#contactosCia").html(datos);
      },
    });
    $(".alert").hide();
  });

  $("#myModalModificaPerfilCia").on("show.bs.modal", function (event) {
    let sesion = JSON.parse(localStorage.getItem("sesion"));
    let {
      user: { tipo },
    } = sesion;

    let button = $(event.relatedTarget);
    let id = button.data("id");
    let empresa = button.data("empresa");
    let parametros = {
      id,
    };
    let modal = $(this);

    modal
      .find(".modal-title")
      .text("Modifica Perfil de la Compañia: " + empresa);
    modal.find(".modal-body #txtIdCiaUpd").val(id);

    $.ajax({
      type: "POST",
      data: parametros,
      url: "res/php/dataUpdateCia.php",
      success: function (datos) {
        $("#datosCia").html(datos);
        tipodoc = parseInt(
          document.querySelector("#formUpdateCompania #tipodoc").value
        );
        pais = parseInt(document.querySelector("#paicesUpd").value);
        if (tipodoc == 8 || tipodoc == 9) {
          toggleNacionalFields(tipodoc, pais, 1);
        }
        if (tipo > 2) {
          document.querySelector(
            "#formUpdateCompania #inlineRadio1"
          ).readonly = true;
          document.querySelector(
            "#formUpdateCompania #inlineRadio2"
          ).readonly = true;
          document.querySelector(
            "#formUpdateCompania #inlineRadio1"
          ).disabled = true;
          document.querySelector(
            "#formUpdateCompania #inlineRadio2"
          ).disabled = true;
        }
      },
    });
    $(".alert").hide();
  });

  $("#myModalAsignarCompania").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var idres = button.data("idres");
    var idcia = button.data("idcia");
    var nombre = button.data("nombre");

    var modal = $(this);
    modal.find(".modal-title").text("Asignar Compañia A: " + nombre);
    $("#idHuespCia").val(id);
    $.ajax({
      url: "res/php/asignaCia.php",
      type: "POST",
      data: {
        idcia,
        id,
        idres,
      },
      success: function (data) {
        $("#companias").html(data);
      },
    });

    $(".alert").hide();
  });

  $("#myModalReservasEsperadas").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var nombre = button.data("nombre");
    var parametros = {
      id,
    };
    var modal = $(this);

    modal.find(".modal-title").text("Reservas Esperadas: " + nombre);
    modal.find(".modal-body #txtIdHuespedAbo").val(id);

    $.ajax({
      type: "POST",
      data: parametros,
      url: "res/php/reservasEsperadas.php",
      beforeSend: function (objeto) {},
      success: function (datos) {
        $("#reservaEsperadas").html(datos);
      },
    });
    $(".alert").hide();
  });

  $("#myModalHistoricoReservas").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var nombre = button.data("nombre");
    var parametros = {
      id,
    };
    var modal = $(this);

    modal.find(".modal-title").text("Historico de Reservas: " + nombre);
    modal.find(".modal-header #txtIdHuespedHis").val(id);

    $.ajax({
      type: "POST",
      data: parametros,
      url: "res/php/historicoReservas.php",
      beforeSend: function (objeto) {},
      success: function (datos) {
        $("#historicoReserva").html(datos);
      },
    });
    $(".alert").hide();
  });

  $("#myModalAnulaCargo").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var hues = button.data("huesped");
    var descrip = button.data("descrip");
    var monto = button.data("monto");
    var impto = button.data("impto");
    var pagos = button.data("pagos");
    var info = button.data("info");
    var refer = button.data("refer");
    var fecha = button.data("fecha");
    var reserva = button.data("reserva");
    var huesped = button.data("huesped");
    var room = button.data("room");
    var cant = button.data("cant");
    var tipo = button.data("tipo");
    var total = monto + impto;

    if (tipo == 3) {
      $("#divPagos").css("display", "block");
      $("#divCargos").css("display", "none");
    } else {
      $("#divPagos").css("display", "none");
      $("#divCargos").css("display", "block");
    }

    var modal = $(this);

    modal.find(".modal-title").text("Anular Consumos: " + descrip);
    modal.find(".modal-body #txtIdHuespedAnu").val(huesped);
    modal.find(".modal-body #txtIdConsumoAnu").val(id);
    modal.find(".modal-body #txtIdReservaAnu").val(reserva);
    modal.find(".modal-body #txtNumeroHabAnu").val(room);
    modal.find(".modal-body #txtDescripcionAnu").val(descrip);
    modal.find(".modal-body #txtCantidadAnu").val(cant);
    modal.find(".modal-body #txtValorConsumoAnu").val(number_format(monto, 2));
    modal.find(".modal-body #txtValorImptoAnu").val(number_format(impto, 2));
    modal.find(".modal-body #txtValorTotalAnu").val(number_format(total, 2));
    modal.find(".modal-body #txtPagoConsumoAnu").val(number_format(pagos, 2));
    modal.find(".modal-body #txtReferenciaAnu").val(refer);
    modal.find(".modal-body #txtDetalleCargoAnu").val(info);
    modal.find(".modal-body #txtMotivoAnula").val("");

    $("#txtMotivoAnula").focus();
  });

  $("#myModalAbonosConsumos").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var hues = button.data("idhuesped");
    var nombre = button.data("nombre");
    var nrohab = button.data("nrohab");
    var impturis = button.data("impto");
    var modal = $(this);

    document.querySelector("#abonosReserva").reset();

    modal.find(".modal-title").text("Abonos a Cuenta: " + nombre);
    modal.find(".modal-body #txtIdReservaAbo").val(id);
    modal.find(".modal-body #idHuespedAbo").val(hues);
    modal.find(".modal-body #txtImptoTuriAbo").val(impturis);
    modal.find(".modal-body #txtNumeroHabAbo").val(nrohab);
    modal.find(".modal-body #txtNombreCompleto").val(nombre);
    // modal.find(".modal-body #txtNombresAbo").val(nombre1 + " " + nombre2);
    $("#codigoAbono").focus();
    $(".alert").hide();
  });

  $("#myModalCargosConsumo").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var hues = button.data("idhuesped");
    var imptoturi = button.data("impto");
    let nombre = button.data("nombre");
    var nrohab = button.data("nrohab");
    var folio = $("#folioActivo").val();
    var modal = $(this);

    modal.find(".modal-title").text(`Ingreso Consumos : ${nombre}`);
    modal.find(".modal-body #txtIdReservaCon").val(id);
    modal.find(".modal-body #txtIdHuespedCon").val(hues);
    modal.find(".modal-body #txtImptoTurismo").val(imptoturi);
    modal.find(".modal-body #txtNumeroHabCon").val(nrohab);
    modal.find(".modal-body #txtHuesped").val(nombre);
    modal.find(".modal-body #txtFolio").val(folio);
    modal.find(".modal-body #codigoConsumo").val(0);
    modal.find(".modal-body #txtValorConsumo").val(0);

    $("#codigoConsumo").focus();
    $(".alert").hide();
  });

  $("#myModalDepositoReserva").on("show.bs.modal", function (event) {
    let button = $(event.relatedTarget);
    let reserva = button.data("reserva");
    let modal = $(this);

    formulario = document.querySelector("#formDepositoReserva");
    formulario.reset();

    modal
      .find(".modal-title")
      .text("Deposito a Reserva: " + reserva.nombre_completo);
    modal.find(".modal-body #txtIdReservaDep").val(reserva.num_reserva);
    modal.find(".modal-body #txtIdHuespedDep").val(reserva.id_huesped);
    modal.find(".modal-body #txtTipoHab").val(reserva.descripcion_habitacion);
    modal.find(".modal-body #txtNumeroHab").val(reserva.num_habitacion);
    modal.find(".modal-body #txtHuesped").val(reserva.nombre_completo);
    modal.find(".modal-body #txtLlegada").val(reserva.fecha_llegada);
    modal.find(".modal-body #txtSalida").val(reserva.fecha_salida);
    modal.find(".modal-body #txtNoches").val(reserva.dias_reservados);
    modal.find(".modal-body #txtHombres").val(reserva.can_hombres);
    modal.find(".modal-body #txtMujeres").val(reserva.can_mujeres);
    modal.find(".modal-body #txtNinos").val(reserva.can_ninos);
    modal.find(".modal-body #txtTarifa").val(reserva.descripcion_tarifa);
    modal
      .find(".modal-body #txtValorTarifa")
      .val(number_format(reserva.valor_diario, 2));
    $("#txtValorDeposito").val(0);
    $("#formadePago").val("");
    $("#formadePago").focus();
    $(".alert").hide();
  });

  $("#myModalInformacionReserva").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var tipohab = button.data("tipohab");
    var nrohab = button.data("nrohab");
    var nombre = button.data("nombre");
    var llegada = button.data("llegada");
    var salida = button.data("salida");
    var noches = button.data("noches");
    var hombres = button.data("hombres");
    var mujeres = button.data("mujeres");
    var ninos = button.data("ninos");
    var tarifa = button.data("tarifa");
    var valor = button.data("valor");
    var tipo = button.data("tipo");
    var observaciones = button.data("observaciones");
    var usuario = button.data("usuario");
    var fechacrea = button.data("fechacrea");
    var modal = $(this);

    if (tipo == 1) {
      modal.find(".modal-title").text("Informacion Reserva: " + nombre);
    } else {
      modal.find(".modal-title").text("Informacion Estadia: " + nombre);
    }
    modal.find(".modal-body #txtIdReservaInf").val(id);
    modal.find(".modal-body #txtTipoHabInf").val(tipohab);
    modal.find(".modal-body #txtNumeroHabInf").val(nrohab);
    modal.find(".modal-body #txtHuespedInf1").val(nombre);
    modal.find(".modal-body #txtLlegadaInf").val(llegada);
    modal.find(".modal-body #txtSalidaInf").val(salida);
    modal.find(".modal-body #txtNochesInf").val(noches);
    modal.find(".modal-body #txtHombresInf").val(hombres);
    modal.find(".modal-body #txtMujeresInf").val(mujeres);
    modal.find(".modal-body #txtNinosInf").val(ninos);
    modal.find(".modal-body #areaComentariosInf").val(observaciones);
    modal.find(".modal-body #txtTarifaInf").val(tarifa);
    modal.find(".modal-body #txtValorTarifaInf").val(number_format(valor, 2));
    // modal.find(".modal-body #txtValorTarifaInf").val(valor);
    modal.find(".modal-body #tipoOcupacion").val(tipo);
    modal.find(".modal-body #createdusr").val(usuario);
    modal.find(".modal-body #fechaCrea").val(fechacrea);

    $(".alert").hide();
  });

  $("#myModalInformacionHuesped").on("show.bs.modal", function (event) {
    var web = $("#rutaweb").val();
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var apellido1 = button.data("apellido1");
    var apellido2 = button.data("apellido2");
    var nombre1 = button.data("nombre1");
    var nombre2 = button.data("nombre2");
    var nombre = button.data("nombre");
    var modal = $(this);

    modal.find(".modal-title").text("Informacion Huesped: " + nombre);
    modal.find(".modal-body #txtApellido1").val(apellido1);
    modal.find(".modal-body #txtApellido2").val(apellido2);
    modal.find(".modal-body #txtNombre1").val(nombre1);
    modal.find(".modal-body #txtNombre2").val(nombre2);
    parametros = {
      id,
    };
    $.ajax({
      url: web + "res/php/getHuespedReserva.php",
      type: "POST",
      data: parametros,
      success: function (data) {
        $("#datosHuesped").html(data);
      },
    });
  });

  $("#myModalIngresoReserva").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var hues = button.data("idhuesped");
    var tipohab = button.data("tipohab");
    var nrohab = button.data("nrohab");
    var apellidos = button.data("apellidos");
    var nombres = button.data("nombres");
    var llegada = button.data("llegada");
    var salida = button.data("salida");
    var noches = button.data("noches");
    var hombres = button.data("hombres");
    var mujeres = button.data("mujeres");
    var ninos = button.data("ninos");
    var tarifa = button.data("tarifa");
    var valor = button.data("valor");
    var observaciones = button.data("observaciones");
    var modal = $(this);

    modal
      .find(".modal-title")
      .text("Ingresar Huesped: " + apellidos + " " + nombres);
    modal.find(".modal-body #txtIdReservaIng").val(id);
    modal.find(".modal-body #txtIdHuesped").val(hues);
    modal.find(".modal-body #txtTipoHab").val(tipohab);
    modal.find(".modal-body #txtNumeroHabIng").val(nrohab);
    modal.find(".modal-body #txtApellidos").val(apellidos);
    modal.find(".modal-body #txtNombres").val(nombres);
    modal.find(".modal-body #txtLlegada").val(llegada);
    modal.find(".modal-body #txtSalida").val(salida);
    modal.find(".modal-body #txtNoches").val(noches);
    modal.find(".modal-body #txtHombres").val(hombres);
    modal.find(".modal-body #txtMujeres").val(mujeres);
    modal.find(".modal-body #txtNinos").val(ninos);
    modal.find(".modal-body #areaComentarios").val(observaciones);
    modal.find(".modal-body #txtTarifa").val(tarifa);
    modal.find(".modal-body #txtValorTarifa").val(valor);
    $(".alert").hide();
  });

  $("#myModalRegistraReservaOld").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var hues = button.data("idhuesped");
    var tipohab = button.data("tipohab");
    var nrohab = button.data("nrohab");
    var nombre = button.data("nombre");
    var llegada = button.data("llegada");
    var salida = button.data("salida");
    var noches = button.data("noches");
    var hombres = button.data("hombres");
    var mujeres = button.data("mujeres");
    var ninos = button.data("ninos");
    var tarifa = button.data("tarifa");
    var valor = button.data("valor");
    var sucia = button.data("sucia");
    var observaciones = button.data("observaciones");
    var modal = $(this);

    if (sucia == 1) {
      let mensaje = document.querySelector(".alert");
      let btnIng = document.querySelector("#btnRegistra");
      mensaje.classList.remove("apaga");
      btnIng.classList.add("apaga");
      $("#alert").css("display", "block");
    }
    modal.find(".modal-title").text("Ingresar Huesped: " + nombre);
    modal.find(".modal-body #txtIdReservaIng").val(id);
    modal.find(".modal-body #txtIdHuespedINg").val(hues);
    modal.find(".modal-body #txtTipoHabIng").val(tipohab);
    modal.find(".modal-body #txtNumeroHabIng").val(nrohab);
    modal.find(".modal-body #txtHuespedIng").val(nombre);
    modal.find(".modal-body #txtLlegadaIng").val(llegada);
    modal.find(".modal-body #txtSalidaIng").val(salida);
    modal.find(".modal-body #txtNochesIng").val(noches);
    modal.find(".modal-body #txtHombresIng").val(hombres);
    modal.find(".modal-body #txtMujeresIng").val(mujeres);
    modal.find(".modal-body #txtNinosIng").val(ninos);
    modal.find(".modal-body #areaComentariosIng").val(observaciones);
    modal.find(".modal-body #txtTarifaIng").val(tarifa);
    modal.find(".modal-body #txtValorTarifaIng").val(number_format(valor, 2));
    // $(".alert").hide();
  });

  $("#myModalRegistraReserva").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var nombre = button.data("nombre");
    var sucia = button.data("sucia");

    var modal = $(this);
    $("#editaRes").val(1);
    var parametros = {
      id,
    };
    modal.find(".modal-title").text("Ingreso Reserva: " + nombre);

    $.ajax({
      type: "POST",
      data: parametros,
      url: "res/php/dataIngresaReserva.php",
      success: function (datos) {
        $(".modalReservasIng").html("");
        $(".modalReservasIng").html(datos);
      },
    });
    $(".alert").hide();
  });

  $("#dataEstadoCartera").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var compania = button.data("compania");
    var modal = $(this);
    modal.find(".modal-title").text(`Cartera Compañia : ${compania}`);
    $.ajax({
      url: "res/php/traeFacturasCompanias.php",
      type: "POST",
      data: { id },
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
});

async function cargarTarifas() {
  let editaReserva = document.querySelector("#editaRes").value;
  let llegadaInput;
  let salidaInput;
  let tipohabiSelect;
  if (editaReserva == 1) {
    llegadaInput = document.getElementById("llegadaUpd");
    salidaInput = document.getElementById("salidaUpd");
    tipohabiSelect = document.getElementById("tipohabiUpd");
  } else {
    llegadaInput = document.getElementById("llegada");
    salidaInput = document.getElementById("salida");
    tipohabiSelect = document.getElementById("tipohabi");
  }

  const tipoHabitacion = tipohabiSelect.value;
  const llegada = llegadaInput.value;
  const salida = salidaInput.value;

  if (!tipoHabitacion || !llegada || !salida) {
    tarifahabSelect.innerHTML =
      '<option value="">Seleccione la Tarifa</option>';
    return;
  }

  const url = "res/php/getTarifasHabitaciones.php";
  const requestBody = {
    tipoHabitacion,
    llegada,
    salida,
  };

  try {
    const response = await fetch(url, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(requestBody),
    });

    if (!response.ok) {
      throw new Error(`Error en la red: ${response.statusText}`);
    }

    const data = await response.json();

    if (data) {
      // Si la API responde con éxito, resolvemos la promesa con los datos
      return data;
    } else {
      // Si la API responde con un error de negocio, rechazamos la promesa
      throw new Error("Sin tarifas asociadas a este tipo de habitacion");
    }
  } catch (error) {
    console.error("Hubo un problema con la solicitud:", error);
    // En caso de error, rechazamos la promesa para que el .catch() lo maneje
    throw error;
  }
}

async function traeReservaModificar(id) {
  // console.log(id)
  const url = "res/php/dataUpdateReserva.php";
  const requestBody = {
    id,
  };

  try {
    const response = await fetch(url, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(requestBody),
    });

    // console.log(response)

    if (!response.ok) {
      throw new Error(`Error en la red: ${response.statusText}`);
    }

    const data = await response.text();

    if (data) {
      // Si la API responde con éxito, resolvemos la promesa con los datos
      return data;
    } else {
      // Si la API responde con un error de negocio, rechazamos la promesa
      throw new Error("Sin tarifas asociadas a este tipo de habitacion");
    }
  } catch (error) {
    console.error("Hubo un problema con la solicitud:", error);
    // En caso de error, rechazamos la promesa para que el .catch() lo maneje
    throw error;
  }
}

async function valorTarifaHabitacion(adultos, ninos, tarifa) {
  switch (adultos) {
    case 1:
      valorAdulto = tarifa.valor_un_pax;
      break;
    case 2:
      valorAdulto = tarifa.valor_dos_pax;
      break;
    case 3:
      valorAdulto = tarifa.valor_tre_pax;
      break;
    case 4:
      valorAdulto = tarifa.valor_cua_pax;
      break;
    case 5:
      valorAdulto = tarifa.valor_cin_pax;
      break;
    case 6:
      valorAdulto = tarifa.valor_sei_pax;
      break;
    case 7:
      valorAdulto = tarifa.valor_sie_pax;
      break;
    case 8:
      valorAdulto = tarifa.valor_och_pax;
      break;
    case 9:
      valorAdulto = tarifa.valor_nue_pax;
      break;
    case 10:
      valorAdulto = tarifa.valor_die_pax;
      break;
    default:
      break;
  }

  valorNino = ninos * tarifa.valor_nino;
  return valorAdulto + valorNino;
}

function sumaFecha() {
  let nochesInput;
  let salidaInput;
  let editaReserva = document.querySelector("#editaRes").value;
  if (editaReserva == 1) {
    llegadaInput = document.getElementById("llegadaUpd");
    nochesInput = document.getElementById("nochesUpd");
    salidaInput = document.getElementById("salidaUpd");
  } else {
    llegadaInput = document.getElementById("llegada");
    nochesInput = document.getElementById("noches");
    salidaInput = document.getElementById("salida");
  }

  const llegada = new Date(llegadaInput.value);
  const noches = parseInt(nochesInput.value, 10);
  if (llegada && !isNaN(noches) && noches > 0) {
    const salida = new Date(llegada);
    salida.setDate(salida.getDate() + noches);
    salidaInput.value = salida.toISOString().split("T")[0];
  }
}

// Lógica para calcular el número de noches a partir de la llegada y la salida
function restaFechas() {
  let nochesInput;
  let salidaInput;
  let editaReserva = document.querySelector("#editaRes").value;
  if (edita == 1) {
    llegadaInput = document.getElementById("llegadaUpd");
    nochesInput = document.getElementById("nochesUpd");
    salidaInput = document.getElementById("salidaUpd");
  } else {
    llegadaInput = document.getElementById("llegada");
    nochesInput = document.getElementById("noches");
    salidaInput = document.getElementById("salida");
  }

  const llegada = new Date(llegadaInput.value);
  const salida = new Date(salidaInput.value);
  if (llegada && salida) {
    const diffTime = Math.abs(salida - llegada);
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
    nochesInput.value = diffDays > 0 ? diffDays : 1;
  }
}

async function traeInfoTercero(numero, tipo) {
  const eToken = await traeToken();
  let { tokenFE } = eToken[0];
  let req = {
    numero,
    tipo,
  };
  try {
    const res = await fetch(`imprimir/imprimeRecaudo.php`, {
      method: "POST",
      headers: {
        "Content-type": "application/json; charset=UTF-8",
      },
      body: JSON.stringify(req),
    });
    const datos = await res.text();
    return datos;
  } catch (error) {
    return error;
  }
}
async function guardaCartera() {
  let sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario_id },
  } = sesion;
  let totalpago = document.querySelector("#totalpago").value;

  if (totalpago == 0) {
    swal({
      title: "Atencion",
      text: "Sin Facturas Seleccionadas, \n No es posible Generar el Ingreso de Cartera",
      type: "warning",
    });
    return;
  }

  facturas = await obtenerItemsSeleccionados();

  let fecha = document.querySelector("#fecha").value;
  let cliente = document.querySelector("#cliente").value;
  let formapago = document.querySelector("#formapago").value;
  let concepto = document.querySelector("#concepto").value;

  req = {
    fecha,
    cliente,
    formapago,
    concepto,
    totalpago,
    usuario_id,
    facturas: JSON.stringify(facturas),
  };

  let recaudo = await ingresaCartera(req);
  let imprime = await imprimeRecaudo(recaudo);

  var ventana = window.open(
    "imprimir/" + imprime.trim(),
    "PRINT",
    "height=600,width=600"
  );
  $(location).attr("href", "recaudosCartera");
}

async function mostrarRecaudo(numero) {
  var ventana = window.open(
    `imprimir/recaudos/recaudoCartera_REC-${numero.trim()}.pdf`,
    "PRINT",
    "height=600,width=600"
  );
}

async function imprimeRecaudo(numero) {
  let req = {
    numero,
  };
  try {
    const res = await fetch(`imprimir/imprimeRecaudo.php`, {
      method: "POST",
      headers: {
        "Content-type": "application/json; charset=UTF-8",
      },
      body: JSON.stringify(req),
    });
    const datos = await res.text();
    return datos;
  } catch (error) {
    return error;
  }
}

async function ingresaCartera(data) {
  try {
    const res = await fetch(`res/php/guardaCartera.php`, {
      method: "POST",
      body: JSON.stringify(data),
    });
    const datos = await res.json(res);
    return datos;
  } catch (error) {
    return error;
  }
}

async function obtenerItemsSeleccionados() {
  const tabla = document.querySelector("#dataClientes");
  const filas = tabla.getElementsByTagName("tr");
  const itemsSeleccionados = [];

  for (let i = 0; i < filas.length; i++) {
    const fila = filas[i];
    const checkbox = fila.querySelector(
      'input[type="checkbox"][name="asigna"]'
    );

    if (checkbox && checkbox.checked) {
      const nrofactura = fila.querySelector(
        'td[name="nrofactura"]'
      ).textContent;
      const fecha = fila.querySelector('td[name="fecha"]').textContent;
      const valorcta = fila.querySelector('td[name="valorcta"]').textContent;
      const valorret = fila.querySelector('input[name="valorret"]').value;
      const valorica = fila.querySelector('input[name="valorica"]').value;
      const valoriva = fila.querySelector('input[name="valoriva"]').value;
      const valorcom = fila.querySelector('input[name="valorcom"]').value;

      itemsSeleccionados.push({
        nrofactura: nrofactura,
        fecha: fecha,
        valorcta: valorcta,
        valorret: valorret,
        valorica: valorica,
        valoriva: valoriva,
        valorcom: valorcom,
      });
    }
  }

  return itemsSeleccionados;
}

async function llenaTablaReservas(reservas) {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    moduloPms: { fecha_auditoria },
  } = sesion;

  const reservasFilter = reservas.filter(
    (reserva) => reserva.fecha >= fecha_auditoria
  );
  const tablaBody = $("#tablaCalendario > tbody");
  // Limpiar la tabla antes de agregar nuevos datos
  tablaBody.empty();

  reservasFilter.forEach((reserva) => {
    const { fecha, llegadas, salidas } = reserva;
    tablaBody.append(`
      <tr>
        <td>${fecha}</td>
        <td style="text-align:right;">${llegadas}</td>
        <td style="text-align:right;">${salidas}</td>
      </tr>
    `);
  });
}

async function llenaTablaReservasOld(reservas) {
  reservas.map((reserva) => {
    let { fecha_llegada, reservas, salidas } = reserva;
    $("#tablaCalendario >tbody").append(
      `<tr>
        <td>${fecha_llegada}</td>
        <td style="text-align:right;">${reservas}</td>
        <td style="text-align:right;">${salidas}</td>
        </tr>`
    );
  });
}

async function ajusteCuenta() {
  let folio = document.querySelector("#folioActivo").value;
  let reserva = document.querySelector("#reservaActual").value;

  let conse = await traeConsecutivo();
  let guarda = await guardaAjusteCuenta(reserva, folio, conse);
  let { con_ajuste_cuenta } = conse[0];
  let nuevo = await actualizaConsecutivoCuenta(con_ajuste_cuenta + 1);
  let imprime = await imprimeAjusteCuenta(con_ajuste_cuenta, reserva, folio);

  var ventana = window.open(
    "imprimir/ajustes/" + imprime.trim(),
    "PRINT",
    "height=600,width=600"
  );
  $(location).attr("href", "facturacionEstadia");
}

async function imprimeAjusteCuenta(numero, reserva, folio) {
  let token = "9b25a3d3-dbc5-42a8-830d-899d2c9d9233";
  let req = {
    numero,
    reserva,
    folio,
  };

  try {
    const res = await fetch(`../APIHotel/data/imprimeAjusteCuenta.php`, {
      method: "POST",
      headers: {
        "Content-type": "application/json; charset=UTF-8",
        Authorization: `Bearer ${token}`,
      },
      body: JSON.stringify(req),
    });
    const datos = await res.text();
    return datos;
  } catch (error) {
    return error;
  }
}

async function actualizaConsecutivoCuenta(numero) {
  let token = "9b25a3d3-dbc5-42a8-830d-899d2c9d9233";
  let req = {
    numero,
  };

  try {
    const res = await fetch(`../APIHotel/data/consecutivoAjusteCuenta.php`, {
      method: "POST",
      headers: {
        "Content-type": "application/json; charset=UTF-8",
        Authorization: `Bearer ${token}`,
      },
      body: JSON.stringify(req),
    });
    const datos = await res.json();
    return datos;
  } catch (error) {
    return error;
  }
}

async function guardaAjusteCuenta(reserva, folio, conse) {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, usuario_id },
  } = sesion;
  let token = "9b25a3d3-dbc5-42a8-830d-899d2c9d9233";
  let req = {
    reserva,
    folio,
    conse,
    usuario,
    usuario_id,
  };

  try {
    const res = await fetch("../APIHotel/data/actualizaAjusteCuenta.php", {
      method: "POST",
      headers: {
        "Content-type": "application/json; charset=UTF-8",
        Authorization: `Bearer ${token}`,
      },
      body: JSON.stringify(req),
    });
    const datos = await res.json();
    return datos;
  } catch (error) {
    return error;
  }
}

const traeConsecutivo = async () => {
  let token = "9b25a3d3-dbc5-42a8-830d-899d2c9d9233";
  try {
    const resultado = await fetch(
      `../APIHotel/data/consecutivoAjusteCuenta.php`,
      {
        method: "GET",
        headers: {
          Authorization: `Bearer ${token}`,
        },
      }
    );
    const datos = await resultado.json();
    return datos;
  } catch (error) {
    return error;
  }
};

function consumosPorFecha() {
  var web = $("#rutaweb").val();
  desdeFe = $("#desdeFecha").val();
  hastaFe = $("#hastaFecha").val();
  codigo = $("#desdeFormaPago").val();
  parametros = {
    desdeFe,
    hastaFe,
    codigo,
  };

  if (desdeFe == "" && hastaFe == "" && codigo == "") {
    swal("Atencion", "Seleccione un Criterio de Busqueda", "warning");
  } else {
    $.ajax({
      url: web + "res/php/consumosPorRango.php",
      type: "POST",
      data: parametros,
      success: function (x) {
        $("#imprimeInforme").html(x);
        setTimeout(
          muestraDataTable('#example1')
          ,500)
      },
    });
  }
}

function traeFacturasCliente() {
  let idcliente = $("#cliente").val();
  if (idcliente == "") {
    swal("Precaucion", "Seleccione Primero el Cliente", "warning");
    $("#proveedor").focus();
    return 0;
  }

  $.ajax({
    type: "POST",
    url: "res/php/traeFacturasCliente.php",
    data: { idcliente },
    success: function (data) {
      $("#dataClientes tbody").html(data);
    },
  });
}

async function sumaFacturas() {
  let valorTotal = 0;
  let nrofacturas = "";
  $("#dataClientes > tbody > tr").each(function () {
    let carga = $("#asigna", this).is(":checked");
    if (carga === true) {
      valorTotal =
        valorTotal +
        parseFloat($("#valorcta", this).html().replaceAll(",", "")) -
        (parseFloat($("#valorret", this).val().replaceAll(",", "")) +
          parseFloat($("#valorica", this).val().replaceAll(",", "")) +
          parseFloat($("#valoriva", this).val().replaceAll(",", "")) +
          parseFloat($("#valorcom", this).val().replaceAll(",", "")));
      nrofacturas = nrofacturas + $("#nrofactura", this).html() + " ";
    }
  });
  document.getElementById("concepto").value = nrofacturas.trim();
  document.getElementById("totalpago").value = valorTotal.toFixed(2);
}

async function asignaRetencion(fila) {
  if (!fila.checked) {
    fila.parentNode.parentNode.cells[5].children[0].value = number_format(0, 2);
  } else {
    let valorRetencion = 0;
    let idcliente = $("#cliente").val();
    let numFactura = fila.parentNode.parentNode.cells[1].innerHTML;
    valorRetencion = await calculaRetencion(numFactura, idcliente);
    fila.parentNode.parentNode.cells[5].children[0].value = number_format(
      valorRetencion,
      2
    );
  }
  await sumaFacturas();
}

async function asignaReteICA(fila) {
  if (!fila.checked) {
    fila.parentNode.parentNode.cells[7].children[0].value = number_format(0, 2);
  } else {
    let valorRetencion = 0;
    let idcliente = $("#cliente").val();
    let numFactura = fila.parentNode.parentNode.cells[1].innerHTML;
    valorRetencion = await calculaReteICA(numFactura, idcliente);
    fila.parentNode.parentNode.cells[7].children[0].value = number_format(
      valorRetencion,
      2
    );
  }
  await sumaFacturas();
}

async function asignaReteIVA(fila) {
  if (!fila.checked) {
    fila.parentNode.parentNode.cells[9].children[0].value = number_format(0, 2);
  } else {
    let valorRetencion = 0;
    let idcliente = $("#cliente").val();
    let numFactura = fila.parentNode.parentNode.cells[1].innerHTML;
    valorRetencion = await calculaReteIVA(numFactura, idcliente);
    fila.parentNode.parentNode.cells[9].children[0].value = number_format(
      valorRetencion,
      2
    );
  }
  await sumaFacturas();
}

async function calculaRetencion(numero, idcliente) {
  req = { numero, idcliente };
  try {
    const res = await fetch("res/php/calculaRetencionFactura.php", {
      method: "POST",
      headers: {
        "Content-type": "application/json; charset=UTF-8",
      },
      body: JSON.stringify(req),
    });
    const datos = await res.json();
    return datos;
  } catch (error) {
    return error;
  }
}

async function calculaReteICA(numero, idcliente) {
  req = { numero, idcliente };
  try {
    const res = await fetch("res/php/calculaReteICAFactura.php", {
      method: "POST",
      headers: {
        "Content-type": "application/json; charset=UTF-8",
      },
      body: JSON.stringify(req),
    });
    const datos = await res.json();
    return datos;
  } catch (error) {
    return error;
  }
}

async function calculaReteIVA(numero, idcliente) {
  req = { numero, idcliente };
  try {
    const res = await fetch("res/php/calculaReteIVAFactura.php", {
      method: "POST",
      headers: {
        "Content-type": "application/json; charset=UTF-8",
      },
      body: JSON.stringify(req),
    });
    const datos = await res.json();
    return datos;
  } catch (error) {
    return error;
  }
}

async function eliminaHuesped(e, huesped) {
  var button = document.getElementById(e);
  let nombre = button.dataset.nombre;
  let id = button.dataset.id;
  let regis = await preguntaEliminaHuesped(nombre, id);
  if (regis != 0) {
    swal(
      {
        title: "Atencion",
        text: "El Huesped Tiene Estadisticas de Alojamiento, \n No es posible eliminar este Perfil",
        type: "warning",
      },
      function () {}
    );
    return false;
  }

  let elimina = await borraHuesped(id);
  if ((elimina = !0)) {
    swal(
      {
        title: "Atencion",
        text: "Huesped Eliminado con Exito",
        type: "warning",
      },
      function () {
        $(location).attr("href", "huespedesPerfil");
      }
    );
  }
}

async function borraHuesped(id) {
  req = { id };
  try {
    const res = await fetch("res/php/eliminaHuesped.php", {
      method: "POST",
      headers: {
        "Content-type": "application/json; charset=UTF-8",
      },
      body: JSON.stringify(req),
    });
    const datos = await res.json();
    return datos;
  } catch (error) {
    return error;
  }
}

async function preguntaEliminaHuesped(nombre, id) {
  return new Promise((resolve) => {
    swal(
      {
        title: `Huesped ${nombre}`,
        text: "Este proceso Eliminara el Huesped Actual  \n No se podra recuperar la Informacion \n",
        type: "warning",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        confirmButtonText: "¡Adelante!",
        closeOnConfirm: false,
      },
      async function () {
        req = { id };
        const resultado = await fetch("res/php/huespedActivo.php", {
          method: "POST",
          headers: {
            "Content-type": "application/json; charset=UTF-8",
          },
          body: JSON.stringify(req),
        });
        let dato = await resultado.json();
        return resolve(dato);
      }
    );
  });
}

async function guardaReportaObs() {
  ruta = document.querySelector("#ubicacion").value;
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario_id },
  } = sesion;
  let observas = document.querySelector("#formObservacionesHab");
  let formData = new FormData(observas);
  formData.set("usuario_id", usuario_id);
  let ocupa = formData.get("ocupada");
  let sucia = formData.get("sucia");
  let estado = sucia == 1 ? 0 : 1;
  formData.set("estado", estado);
  let habita = formData.get("numeroHab");

  let ingresa = await ingresoObservacion(formData);

  if (ocupa == 0) {
    let cambia = await cambiaEstadoAseo(habita, ocupa, estado, sucia);
  }

  let text =
    ocupa == 1
      ? "Observacion Ingresada Correctamente a la Habitacion"
      : sucia == 1
      ? "Habitacion Limpia "
      : "Cambio a Habitacion Sucia realizado con Exito";

  swal(
    {
      title: "Atencion",
      text,
      type: "success",
      confirmButtonText: "Aceptar",
    },
    function () {
      $(location).attr("href", ruta);
    }
  );
}

async function ingresoObservacion(data) {
  try {
    const resultado = await fetch("res/php/ingresoObservacionCam.php", {
      method: "POST",
      body: data,
    });
    const datos = await resultado.text();
    return datos;
  } catch (error) {}
}

async function traeCamareras() {
  try {
    const resultado = await fetch("res/php/traeCamareras.php", {
      method: "POST",
      headers: {
        "Content-type": "application/json; charset=UTF-8",
      },
    });
    const datos = await resultado.json();
    return datos;
  } catch (error) {
    console.log(error);
  }
}

async function traeReservasTotal() {
  try {
    const resultado = await fetch("res/php/traeTotalReservas.php", {
      method: "POST",
      headers: {
        "Content-type": "application/json; charset=UTF-8",
      },
    });
    const datos = await resultado.json();
    return datos;
  } catch (error) {
    console.log(error);
  }
}

async function llenaTarifas(tarifas) {
  let editaReserva = document.querySelector("#editaRes").value;
  let selectElement;
  if (editaReserva == 1) {
    selectElement = document.querySelector("#tarifahabUpd");
  } else {
    selectElement = document.querySelector("#tarifahab");
  }

  tarifas.map((item) => {
    let { id, descripcion_tarifa } = item;
    const optionElement = document.createElement("option");
    optionElement.value = id;
    optionElement.text = `${descripcion_tarifa}`;
    selectElement.add(optionElement);
  });
}

async function limpiaTarifas() {
  let editaReserva = document.querySelector("#editaRes").value;
  let selectElement;
  if (editaReserva == 1) {
    selectElement = document.querySelector("#tarifahabUpd");
  } else {
    selectElement = document.querySelector("#tarifahab");
  }
  while (selectElement.firstChild) {
    selectElement.removeChild(selectElement.firstChild);
  }
}

async function llenaSelectCamareras(camareras) {
  let selectElement = document.querySelector("#reportadoPor");
  camareras.map((item) => {
    let { idCamarera, apellidosCamarera, nombresCamarera } = item;
    const optionElement = document.createElement("option");
    optionElement.value = idCamarera;
    optionElement.text = `${apellidosCamarera} ${nombresCamarera}`;
    selectElement.add(optionElement);
  });
}

async function limpiaCamareras() {
  let selectElement = document.querySelector("#reportadoPor");

  while (selectElement.firstChild) {
    selectElement.removeChild(selectElement.firstChild);
  }
}

async function traeTipoDocumentoOK() {
  try {
    const resultado = await fetch("res/php/traeTipoDocumento.php", {
      method: "POST",
      headers: {
        "Content-type": "application/json; charset=UTF-8",
      },
    });
    const datos = await resultado.json();
    return datos;
  } catch (error) {
    console.log(error);
  }
}

const traeTipoDocumento = async () => {
  try {
    const resultado = await fetch("res/php/traeTipoDocumento.php", {
      method: "post",
      headers: {
        "Access-Control-Allow-Origin": "*",
        "Access-Control-Allow-Credentials": true,
        "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
      },
    });
    const datos = await resultado.json();
    return datos;
  } catch (error) {
    console.log(error);
    // return error
  }
};

async function backupSQL() {
  const host = "localhost";
  const user = "tu_usuario";
  const password = "tu_contraseña";
  const database = "tu_base_de_datos";

  // Construir la URL para la consulta SQL
  // const url = `http://${host}/backup.php?user=${user}&password=${password}&database=${database}`;
  const url = `../res/php/backup.php`;

  // Realizar la solicitud HTTP
  fetch(url)
    .then((response) => response.text())
    .then((data) => {
      // Guardar el backup en un archivo
      const date = new Date();
      const filename = `backup_${date.getFullYear()}-${
        date.getMonth() + 1
      }-${date.getDate()}.sql`;
      const blob = new Blob([data], { type: "text/plain" });
      const link = document.createElement("a");
      link.href = URL.createObjectURL(blob);
      link.download = filename;
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
      console.log(`Backup guardado en ${filename}`);
    })
    .catch((error) => {
      console.error("Error al realizar el backup:", error);
    });
}

async function enviaTRA(reserva, fecha) {
  const huesped = await traeHuespedReserva(reserva, fecha);
  const acompana = await traeAcompanaReserva(reserva, fecha);
  const regis = acompana.length;

  JSONPpal = await creaJSONPpal(huesped, acompana);
  respo = await enviaJSONPpal(JSONPpal);

  if (acompana.length > 0) {
    JSONAcompa = await creaJSONAcompana(JSONPpal, acompana, respo);
    respoAco = await enviaJSONAcompana(JSONAcompa);
  }

  const guarda = await actualizaEstado(reserva);
  if (guarda == 1) {
    guarda2 = await guardaProcesoEnvioTRA(reserva);
  }

  if (regis.lenght > 0) {
    JSONAcompa = await creaJSONAcompana(JSONPpal, acompana, respo);
  }
}

async function restaEdad(fecha) {
  let date = fecha.split("-");
  let edad;
  let nace = new Date(date[0], date[1] - 1, date[2]);
  let dia = new Date();
  let fechaIni = new Date(nace);
  let hoy = new Date(dia).getTime();
  edad = (hoy - fechaIni) / (1000 * 60 * 60 * 24 * 365);

  return edad;
}

const guardaProcesoEnvioTRA = async (reserva) => {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario_id },
  } = sesion;

  data = {
    usuario_id,
    reserva,
  };

  try {
    const resultado = await fetch("res/php/guardaReservaTRA.php", {
      method: "post",
      headers: {
        "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
      },
      body: JSON.stringify(data),
    });

    return datos;
  } catch (error) {}
};

const enviaJSONPpal = async (JSONPpal) => {
  infoHotel = await traeInfoHotel();
  let { tra, tokenTra, urlTraHuesped, urlTraAcompana, passwordTra, envioTra } =
    infoHotel[0];

  if (tra == 0) {
    swal(
      {
        title: "Precaucion",
        text: "Modulo de Envio de Tarjeta de Registro de Alojamiento – TRA - No Activado",
        type: "warning",
        confirmButtonText: "Aceptar",
      },
      function () {
        $(location).attr("href", "encasa");
      }
    );
    error = {
      mensaje:
        "Modulo de Envio de Tarjeta de Registro de Alojamiento – TRA - No Activado",
    };
    return error;
  }

  if (
    tokenTra == "" ||
    tokenTra == null ||
    urlTraHuesped == "" ||
    urlTraAcompana == "" ||
    passwordTra == ""
  ) {
    swal(
      {
        title: "Precaucion",
        text: "Modulo de Envio de Tarjeta de Registro de Alojamiento – TRA - No Esta Configurado",
        type: "warning",
        confirmButtonText: "Aceptar",
      },
      function () {}
    );
    error = {
      mensaje:
        "Modulo de Envio de Tarjeta de Registro de Alojamiento – TRA - No Esta Configurado",
    };
    return error;
  }

  try {
    const resultado = await fetch(urlTraHuesped, {
      method: "post",
      headers: {
        "Access-Control-Allow-Origin": "*",
        "Access-Control-Allow-Credentials": true,
        "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
        Authorization: `token ${tokenTra}`,
      },
      body: JSON.stringify(JSONPpal),
    });
    return datos;
  } catch (error) {
    return error;
  }
};

const enviaJSONAcompana = async (JSONAcompana) => {
  infoHotel = await traeInfoHotel();
  let { tra, tokenTra, urlTraHuesped, urlTraAcompana, passwordTra, envioTra } =
    infoHotel[0];

  try {
    const resultado = await fetch(urlTraAcompana, {
      method: "post",
      headers: {
        "Access-Control-Allow-Origin": "*",
        "Access-Control-Allow-Credentials": true,
        "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
        Authorization: `token ${tokenTra}`,
      },
      body: JSON.stringify(JSONAcompana),
    });
    return datos;
  } catch (error) {
    return error;
  }
};

const creaJSONPpal = async (huesped, acompana) => {
  let {
    identificacion,
    apellido1,
    apellido2,
    nombre1,
    nombre2,
    fecha_llegada,
    fecha_salida,
    num_habitacion,
    valor_diario,
    origen_reserva,
    descripcion_habitacion,
    descripcion_documento,
    municipio,
    descripcion_grupo,
  } = huesped[0];

  regis = acompana.length;

  residencia = await traeCiudad(origen_reserva);
  infoHotel = await traeInfoHotel();

  let { rnt, nombre_hotel } = infoHotel[0];

  datos = {
    tipo_identificacion: descripcion_documento,
    numero_identificacion: identificacion,
    nombres: `${nombre1} ${nombre2}`,
    apellidos: `${apellido1} ${apellido2}`,
    cuidad_procedencia: municipio,
    numero_habitacion: num_habitacion,
    motivo: descripcion_grupo,
    check_in: fecha_llegada,
    check_out: fecha_salida,
    tipo_acomodacion: descripcion_habitacion,
    costo: valor_diario,
    cuidad_residencia: residencia[0]["municipio"],
    nombre_establecimiento: nombre_hotel,
    rnt_establecimiento: rnt,
    numero_acompanantes: regis,
  };

  return datos;
};

const creaJSONAcompana = async (huesped, acompanas, respo) => {
  let {
    cuidad_procedencia,
    numero_habitacion,
    check_in,
    check_out,
    cuidad_residencia,
  } = huesped;

  let { padre } = respo;
  let responde = [];

  acompanas.map(function (acompana) {
    let {
      identificacion,
      apellido1,
      apellido2,
      nombre1,
      nombre2,
      descripcion_documento,
    } = acompana;
    respuesta = {
      tipo_identificacion: descripcion_documento,
      numero_identificacion: identificacion,
      nombres: `${nombre1} ${nombre2}`,
      apellidos: `${apellido1} ${apellido2}`,
      cuidad_residencia,
      cuidad_procedencia,
      numero_habitacion,
      check_in,
      check_out,
      padre,
    };

    responde.push(respuesta);
  });
  return responde;
};

const traeCiudad = async (ciudad) => {
  try {
    const resultado = await fetch(`res/php/traeCiudad.php`, {
      method: "post",
      headers: {
        "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
      },
      body: `ciudad=${ciudad}`,
    });
    const datos = await resultado.json();
    return datos;
  } catch (error) {
    // console.log(error);
    return error;
  }
};

const traeInfoHotel = async () => {
  try {
    const resultado = await fetch(`res/php/traeInfoHotel.php`, {
      method: "post",
      headers: {
        "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
      },
    });
    const datos = await resultado.json();
    return datos;
  } catch (error) {
    // console.log(error);
    return error;
  }
};

const traeHuespedReserva = async (reserva, fecha) => {
  try {
    const resultado = await fetch(`res/php/traeHuespedReserva.php`, {
      method: "post",
      headers: {
        "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
      },
      body: `reserva=${reserva}&fecha=${fecha}`,
    });
    const datos = await resultado.json();
    return datos;
  } catch (error) {
    // console.log(error);
    return error;
  }
};

const traeAcompanaReserva = async (reserva, fecha) => {
  try {
    const resultado = await fetch(`res/php/traeAcompananteTRA.php`, {
      method: "post",
      headers: {
        "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
      },
      body: `reserva=${reserva}&fecha=${fecha}`,
    });
    const datos = await resultado.json();
    return datos;
  } catch (error) {
    // console.log(error);
    return error;
  }
};

function estadoFacturaDIAN($estado) {
  switch ($estado) {
    case "0":
      return '<span style="font-size:12px" class="label label-warning">No Procesada</span>';
    case "1":
      return '<span style="font-size:12px" class="label label-success">Emitida</span>';
    case "false":
      return '<span style="font-size:12px" class="label label-warning">No Procesada</span>';
    case "true":
      return '<span style="font-size:12px" class="label label-success">Emitida</span>';
  }
}

function actualizaMmto() {
  idmmto = $("#idMmtoUpd").val();
  hasta = $("#hastaFechaUpd").val();

  $.ajax({
    type: "POST",
    url: "res/php/actualizaMmto.php",
    data: {
      idmmto,
      hasta,
    },
    success: function (data) {
      swal(
        {
          title: "Atencion",
          text: "Mantenimiento Actualizado con Exito",
          type: "success",
        },
        function () {
          $(location).attr("href", "mantenimiento");
        }
      );
    },
  });
}

function regresaCasa(reserva) {
  swal(
    {
      title: "Cuenta Congelada",
      text: "Desea Regresar a Casa la Presente Cuenta Congelada",
      type: "warning",
      showCancelButton: true,
      cancelButtonClass: "btn-warning",
      cancelButtonText: "Cancelar Ingreso",
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Si, Regresa a Casa !",
      closeOnConfirm: false,
    },
    function () {
      $.ajax({
        type: "POST",
        url: "res/php/regresaCasa.php",
        data: {
          reserva,
        },
        success: function (data) {
          swal(
            {
              title: "Atencion",
              text: "Cuenta Reactivada con Exito",
              type: "success",
            },
            function () {
              $(location).attr("href", "cuentasCongeladas");
            }
          );
        },
      });
    }
  );
}

function muestraReserva(ev) {
  let reserva = ev.getAttribute("reserva");
  let estado = ev.getAttribute("estado");

  swal("Atencion", "Dio Click en Reserva" + reserva + estado, "success");
}

function descargarAttach(numero) {
  $.ajax({
    url: "api/descargarZIP.php",
    type: "POST",
    data: {
      numero,
    },
    success: function (data) {
      $("#perfilFactura").val(data.trim());
    },
  });
}

const traeToken = async () => {
  try {
    const resultado = await fetch(`res/php/traeToken.php`, {
      method: "post",
      headers: {
        "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
      },
    });
    const datos = await resultado.json();
    return datos;
  } catch (error) {
    // console.log(error);
    return error;
  }
};

const DonwloadFile = async (file, nit, typeFile, base64 = false) => {
  const eToken = await traeToken();

  let { token } = eToken[0];

  if (nit !== null) {
    let fileSystem = null;
    if (typeFile == "pdf") {
      fileSystem = file;
    } else if (typeFile == "zip") {
      fileSystem = "ZipAttachm-" + file + ".xml";
    }

    url = `https://api.nextpyme.plus/api/ubl2.1/download/${nit}/${fileSystem}`;

    const ResponseFile = await descargaXML(url, token, "blob");

    let blob = new Blob([ResponseFile], {
      type: ResponseFile["type"],
    });
    let urlFile = URL.createObjectURL(blob);
    window.open(urlFile);
  }
};

const ValidaFactura = async (fecha, number, email) => {
  const eToken = await traeToken();
  let { token } = eToken[0];

  url = `https://api.nextpyme.plus/api/google_api/get_messages_by_receptor`;

  let data = {
    after: fecha,
    before: null,
    to_email: email,
    query_subject: number,
  };

  const ResponseInfo = await infoFactura(url, data, token);
};

const infoFactura = async (url, data, token) => {
  let datos;
  try {
    const resultado = await fetch(url, {
      method: "POST",
      credentials: "same-origin",
      headers: {
        "Content-Type": "application/json", // Y le decimos que los datos se enviaran como JSON
        Accept: "application/json",
        Authorization: "Bearer " + token,
      },
      body: data,
    });
    datos = await resultado.json();
    // console.log(datos)
    return datos;
  } catch (error) {
    // console.log(error)
  }
};

const ValidaDIAN = async (cufe) => {
  let datos;
  let data = {
    sendmail: false,
  };
  let eToken = await traeToken();
  let { token } = eToken[0];
  url = `https://api.nextpyme.plus/api/ubl2.1/status/document/${cufe}`;
  try {
    const resultado = await fetch(url, {
      method: "POST",
      credentials: "same-origin",
      headers: {
        "Content-Type": "application/json", // Y le decimos que los datos se enviaran como JSON
        Accept: "application/json",
        Authorization: "Bearer " + token,
      },
      body: data,
    });
    datos = await resultado.json();
    // console.log(datos)
    return datos;
  } catch (error) {
    // console.log(error)
  }
};

const traeRetenciones02 = async () => {
  try {
    const resultado = await fetch(`res/php/traeRetenciones.php`, {
      method: "post",
      headers: {
        "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
      },
    });
    const datos = await resultado.json();
    return datos;
  } catch (error) {
    return error;
  }
};

async function descargaArchivo(numero, nit, prefijo) {
  url = `https://api.nextpyme.plus/api/ubl2.1/download/`;
  const eToken = await traeToken();
  let { token } = eToken[0];
  xmlUrl = `${url}${nit}/FES-${prefijo}${numero}.xml`;
  arcXml = `FES-${prefijo}${numero}.xml`;

  let arcRes = await descargaXML(xmlUrl, token, "");

  let element = document.createElement("a");
  element.setAttribute(
    "href",
    "data:text/xml;charset=utf-8," + encodeURIComponent(arcRes)
  );
  element.setAttribute("download", arcXml);

  element.style.display = "none";
  document.body.appendChild(element);

  element.click();

  document.body.removeChild(element);
}

const descargaXML = async (xmlUrl, token, tipo) => {
  let datos;
  try {
    const resultado = await fetch(xmlUrl, {
      method: "get",
      headers: {
        "Content-Type": "application/json", // Y le decimos que los datos se enviaran como JSON
        Accept: "application/json",
        Authorization: "Bearer " + token,
      },
    });
    if (tipo == "blob") {
      datos = await resultado.blob();
    } else {
      datos = await resultado.text();
    }
    return datos;
  } catch (error) {
    // console.log(error)
  }
};

const Notifications = (
  element,
  title,
  icon = "info",
  isHtml,
  html,
  IsReload = null,
  position = "center",
  Isallback = false,
  callback
) => {
  swal(
    {
      title: title,
      text: html,
      type: icon,
      confirmButtonText: "Aceptar",
      closeOnConfirm: false,
    },
    function () {
      window.location.reload();
    }
  );
};

const RequestComponent = async ({ url, token }) => {
  try {
    const resultado = await fetch(url, {
      method: "get",
      headers: {
        "Content-Type": "application/json", // Y le decimos que los datos se enviaran como JSON
        Accept: "application/json",
        Authorization: "Bearer " + token,
      },
    });
    const datos = await resultado.blob();
    return datos;
  } catch (error) {
    // console.log(error)
  }
};

function guardaGrupo() {
  formulario = document.querySelector("#formGrupo");
  let formGrupo = new FormData(formulario);

  object = {};
  formGrupo.forEach((value, key) => (object[key] = value));

  numGrupo = guardaDatosGrupo(JSON.stringify(object));
}

const guardaDatosGrupo = async (formGrupo) => {
  try {
    const resultado = await fetch(`res/php/guardaGrupo.php`, {
      method: "POST",
      body: formGrupo, // data puede ser string o un objeto
      headers: {
        "Content-Type": "application/json", // Y le decimos que los datos se enviaran como JSON
      },
    });
    const datos = await resultado.json();
    return datos;
  } catch (error) {
    // console.log(error);
    return error;
  }
};

function traeReservasMmto() {
  mmtoHab = document.querySelector("#roomAdi");
  desde = document.querySelector("#desdeFechaAdi").value;
  hasta = document.querySelector("#hastaFechaAdi").value;
  let nroHab = mmtoHab.options[mmtoHab.selectedIndex].text;
  let idHab = mmtoHab.value;

  url = "res/php/reservasHabMmto.php";
  fetch(url, {
    method: "post",
    headers: {
      "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
    },
    body: `nroHab=${nroHab}&desde=${desde}&hasta=${hasta}`,
  })
    .then((response) => response.json())
    .then((data) => muestraHabitacionesMmto(data));
}

function muestraHabitacionesMmto(mmtos) {
  if (mmtos.length >= 1) {
    divRese = document.querySelector("#divReserva");
    divRese.classList.remove("apaga");
    dataTableMmto = document.querySelector("#huespedesMmto");
    limpiaHabitacionesMmto();

    mmtos.forEach((mmto) => {
      const { num_reserva, fecha_llegada, fecha_salida, nombre_completo } =
        mmto;
      const trRese = document.createElement("tr");
      const tdNro = document.createElement("td");
      const tdDes = document.createElement("td");
      const tdHab = document.createElement("td");
      const tdNom = document.createElement("td");
      tdNro.innerHTML = num_reserva;
      tdDes.innerHTML = fecha_llegada;
      tdHab.innerHTML = fecha_salida;
      tdNom.innerHTML = nombre_completo;

      trRese.appendChild(tdNro);
      trRese.appendChild(tdDes);
      trRese.appendChild(tdHab);
      trRese.appendChild(tdNom);

      dataTableMmto.appendChild(trRese);
    });

    setTimeout(() => {
      divRese.classList.add("apaga");
      limpiaHabitacionesMmto();
    }, 5000);
  }
}

function limpiaHabitacionesMmto() {
  while (dataTableMmto.firstChild) {
    dataTableMmto.removeChild(dataTableMmto.firstChild);
  }
}

function buscaFacturasExporta() {
  desde = document.querySelector("#desdeFecha").value;
  hasta = document.querySelector("#hastaFecha").value;
  url = "res/php/exportaFactura.php";
  fetch(url, {
    method: "post",
    headers: {
      "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
    },
    body: "desde=" + desde + "&hasta=" + hasta,
  })
    .then((response) => response.text())
    .then((data) => llenaFacturas(data));
}

function buscaNotasCreditoExporta() {
  desde = document.querySelector("#desdeFechaNC").value;
  hasta = document.querySelector("#hastaFechaNC").value;
  url = "res/php/exportaNotasCre.php";
  fetch(url, {
    method: "post",
    headers: {
      "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
    },
    body: "desde=" + desde + "&hasta=" + hasta,
  })
    .then((response) => response.text())
    .then((data) => llenaNotasCre(data));
}

function buscaAbonosExporta() {
  desde = document.querySelector("#desdeFechaAB").value;
  hasta = document.querySelector("#hastaFechaAB").value;
  url = "res/php/exportaAbonos.php";
  data = {
    desde,
    hasta,
  };
  fetch(url, {
    method: "post",
    headers: {
      "Content-type": "application/json; charset=UTF-8",
    },
    body: JSON.stringify(data),
  })
    .then((response) => response.text())
    .then((data) => llenaAbonos(data));
}

function llenaFacturas(datos) {
  facturasHTML = document.querySelector("#dataTable tbody");
  resultado = document.querySelector(".alert");
  if (datos.trim() == "1") {
    facturasHTML.innerHTML = "";
    resultado.classList.remove("apaga");
    resultado.innerHTML =
      '<p style="text-align:center;"> Sin Facturas Generadas para el dia Seleccionado<p>  ';
    setTimeout(() => {
      resultado.classList.add("apaga");
    }, 3000);
  } else {
    facturasHTML.innerHTML = datos;
  }
}

function llenaAbonos(datos) {
  facturasHTML = document.querySelector("#dataTableAbonos tbody");
  resultado = document.querySelector(".mensajeAbonos");
  if (datos.trim() == "1") {
    facturasHTML.innerHTML = "";
    resultado.classList.remove("apaga");
    resultado.innerHTML =
      '<p style="text-align:center;"> Sin Abonos Generadas para el dia Seleccionado<p>  ';
    setTimeout(() => {
      resultado.classList.add("apaga");
    }, 3000);
  } else {
    facturasHTML.innerHTML = datos;
  }
}

function llenaNotasCre(datos) {
  // console.log(datos);
  facturasHTML = document.querySelector("#dataTableNC tbody");
  resultado = document.querySelector(".mensajeNC");
  if (datos.trim() == "1") {
    facturasHTML.innerHTML = "";
    resultado.classList.remove("apaga");
    resultado.innerHTML =
      '<p style="text-align:center;"> Sin Notas Credito Generadas para el dia Seleccionado<p>  ';
    setTimeout(() => {
      resultado.classList.add("apaga");
    }, 3000);
  } else {
    facturasHTML.innerHTML = datos;
  }
}

function LimpiaFacturasHTML() {
  while (facturasHTML.firstChild) {
    facturasHTML.removeChild(facturasHTML.firstChild);
  }
}

function buscaHistoricoNC() {
  desdef = document.querySelector("#desdeFecha").value;
  hastaf = document.querySelector("#hastaFecha").value;
  desden = document.querySelector("#desdeNumero").value;
  hastan = document.querySelector("#hastaNumero").value;

  url = "res/php/buscaHistoricoNC.php";
  fetch(url, {
    method: "post",
    headers: {
      "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
    },
    body:
      "desdef=" +
      desdef +
      "&hastaf=" +
      hastaf +
      "&desden=" +
      desden +
      "&hastan=" +
      hastan,
  })
    .then((response) => response.json())
    .then((data) => llenaHistoricoNC(data));

    setInterval(
      muestraDataTable('#dataNotas')
      ,500)

}

function llenaHistoricoNC(datos) {
  ncHTML = document.querySelector("#dataNotas tbody");
  // resultado = document.querySelector("#muestraResultadoNC");

  if (datos.length == 0) {
    // resultado.classList.add("apaga");
    mensaje = document.querySelector("#mensaje");
    mensaje.innerHTML = "";
    mensaje.classList.remove("apaga");
    mensaje.innerHTML = `
      <div class="alert alert-danger centro">
      <h4 style="color:#0009"> <i class="fa-solid fa-circle-exclamation fa-2x"></i> Sin Notas Credito Generadas el Rango de Fecha Seleccionada<h4>  
      </div>
      `;
    setTimeout(() => {
      mensaje.classList.add("apaga");
      // resultado.classList.remove("apaga");
    }, 3000);
  } else {
    LimpiaNcHTML();

    datos.map(function (dato) {
      let { facturaAnulada, fechaNC, motivoAnulacion, numeroNC, estadoEnvio } =
        dato;
      let rowNC = document.createElement("tr");
      rowNC.innerHTML = `<td style="width:10%;">${numeroNC}</td>
              <td style="width:10%;">${fechaNC}</td>
              <td style="width:10%;">${facturaAnulada}</td>
              <td>${motivoAnulacion}</td>
              <td style="width:10%;">${estadoFacturaDIAN(estadoEnvio)}</td>
              <td style="text-align: center; width:10%;">
                <div class="btn-group" role="group" aria-label="Basic example">
                  <button 
                    id="${numeroNC}"
                    type="button" 
                    href="#myModalVerFactura"
                    class="btn btn-success btn-xs"
                    onclick="mostrarNC(${numeroNC})">
                    <i class="fa-solid fa-print"></i>
                  </button>
                </div>
              </td>
      `;
      ncHTML.appendChild(rowNC);
    });
  }
}

function LimpiaNcHTML() {
  ncHTML = document.querySelector("#dataNotas tbody");
  ncHTML.innerHTML = "";
}

function traePerfilVenta(id) {
  $.ajax({
    url: "res/php/traePerfilCodigo.php",
    type: "POST",
    data: {
      id,
    },
    success: function (data) {
      $("#perfilFactura").val(data.trim());
    },
  });
}

function traeFacturasEstadia() {
  vigencia = document.querySelector("#vigencia").value;
  $.ajax({
    url: "res/php/traeFacturacionEstadia.php",
    type: "POST",
    data: {
      tipo: "1",
      vigencia,
    },
    success: function (data) {
      $("#paginaFacturacion").html(data);
      $("#example1").DataTable({
        iDisplayLength: 25,
        paging: true,
        lengthChange: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: true,
      });
    },
  });
}

function muestraDataTable(data) {
  $(`${data}`).DataTable({
    iDisplayLength: 25,
    paging: true,
    lengthChange: true,
    searching: true,
    ordering: true,
    info: true,
    autoWidth: true,
  });
}

function traeLlegadasDia() {
  $.ajax({
    url: "res/php/traeLlegadasdelDia.php",
    type: "POST",
    data: {
      tipo: "1",
    },
    success: function (data) {
      $("#paginaLlegadas").html(data);
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

function traeHuespedesenCasa() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { tipo },
  } = sesion;

  $.ajax({
    url: "res/php/traeHuespedesenCasa.php",
    type: "POST",
    data: {
      tipo,
    },
    success: function (data) {
      $("#paginaenCasa").html(data);
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

function traeReservasActivas(tipo) {
  $.ajax({
    url: "res/php/traeReservasActivas.php",
    type: "POST",
    data: {
      tipo,
    },
    success: function (data) {
      $("#paginaReservas").html(data);
      $("#example1").DataTable({
        iDisplayLength: 25,
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: true,
        language: {
          decimal: "",
          emptyTable: "No hay registros",
          info: "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
          infoEmpty: "Mostrando 0 to 0 of 0 Entradas",
          infoFiltered: "(Filtrado de _MAX_ total entradas)",
          infoPostFix: "",
          thousands: ",",
          lengthMenu: "Mostrar _MENU_ Entradas",
          loadingRecords: "Cargando...",
          processing: "Procesando...",
          search: "Buscar:",
          zeroRecords: "Sin resultados encontrados",
          paginate: {
            first: "Primero",
            last: "Ultimo",
            next: "Siguiente",
            previous: "Anterior",
          },
        },
      });
    },
  });
}

function consumoVentaDirecta() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, usuario_id },
  } = sesion;
  let = $("#txtIdReservaDep").val();

  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var ingreso = $("#ingreso").val();
  var codigo = $("#codigoConsumo").val();
  var textcodigo = $("#codigoConsumo option:selected").text();
  var canti = $("#txtCantidad").val();
  var valor = $("#txtValorConsumo").val();
  var refer = $("#txtReferencia").val();
  var folio = $("#txtFolio").val();
  var detalle = $("#txtDetalleCargo").val();
  var numero = $("#txtIdReservaCon").val();
  var idhues = $("#txtIdHuespedCon").val();
  var room = $("#txtNumeroHabCon").val();
  var turismo = $("#txtImptoTurismo").val();
  var parametros = {
    codigo,
    textcodigo,
    canti,
    valor,
    refer,
    folio,
    detalle,
    numero,
    idhues,
    room,
    turismo,
    usuario,
    usuario_id,
  };
  $.ajax({
    type: "POST",
    url: web + "res/php/ingresoConsumo.php",
    data: parametros,
    success: function (data) {
      if (data == 0) {
        $("#mensaje").html(
          '<div class="alert alert-warning"><h3>No se pudo ingresar el consumo</h3></div>'
        );
      } else {
        $("#mensaje").html(
          '<div class="alert alert-warning"><h3>Ingreso Realizado con Exito</h3></div>'
        );
      }
      if (ingreso == 1) {
        $("#myModalCargosConsumo").modal("hide");
        activaFolio(numero, 1);
        /// $(location).attr('href',pagina);
      } else {
        $("#myModalCargosConsumo").modal("hide");
        /// movimientosFactura(numero);
      }
    },
  });
}

function ingresaVentaDirecta() {
  $("#nuevaReserva").css("disabled", true);
  nuevo = $("#nuevo").val();
  idhues = $("#idhuesped").val();
  identifica = $("#identifica").val();
  apellidos = $("#apellidos").val();
  nombres = $("#nombres").val();
  nrocuenta = $("#nrohabitacion").val();
  llegada = $("#llegada").val();
  noches = $("#noches").val();
  salida = $("#salida").val();
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, usuario_id },
  } = sesion;

  if (identifica == "") {
    swal("Precaucion", "Seleccione el Cliente para Realizar la Venta", "error");
    $("#identifica").focus();
    return false;
  }

  $.ajax({
    url: "res/php/ingresaVentasDirectas.php",
    type: "POST",
    data: {
      nuevo,
      idhues,
      identifica,
      apellidos,
      nombres,
      usuario,
      idusuario: usuario_id,
      nrocuenta,
      llegada,
      noches,
      salida,
    },
    success: function (data) {
      $("#datosReserva").html("");
      $("#datosReserva").html(data);
      reserva = $("#numeroRes").val();
      activaFolio(reserva, 1);
    },
  });
}

function validaIden() {
  let iden = $("#identifica").val();
  $.ajax({
    url: "res/php/buscaIden.php",
    type: "POST",
    dataType: "json",
    data: {
      iden,
    },
    success: function (data) {
      if (data.length !== 0) {
        $("#nuevo").val(0);
        $("#idhuesped").val(data[0]["id_huesped"]);
        $("#apellidos").val(data[0]["apellido1"] + " " + data[0]["apellido2"]);
        $("#nombres").val(data[0]["nombre1"] + " " + data[0]["nombre2"]);
        $("#cuentas").focus();
      }
    },
  });
}

function listadoCumpleanios() {
  // let file = makeid(12);
  let tipo = $("input[name=cumpleOption]:checked").val();
  $(".btn-info").removeAttr("disabled");

  $.ajax({
    url: "res/php/listadoCumpleanios.php",
    type: "POST",
    data: {
      tipo,
    },
  }).done(function (dato) {
    $("#muestraHuespedes").html(
      `<object type="application/pdf" id="verInforme" width="100%" height="500" data="data:application/pdf;base64,${$.trim(
        dato
      )}"></object>`
    );
  });
}

function listadoPerfilCompanias() {
  let desde = document.querySelector("#desdeEmp").value.toUpperCase();
  // file = makeid(12);
  $.ajax({
    url: "res/php/listadoCompanias.php",
    type: "POST",
    data: { desde },
  }).done(function (data) {
    $("#muestraHuespedes").html(
      `<object type="application/pdf" id="verInforme" width="100%" height="500" data="data:application/pdf;base64,${$.trim(
        data
      )}"></object>`
    );
  });
}

function listadoPerfilHuespedes() {
  let desde = document.querySelector("#desdeApe").value.toUpperCase();
  // let hasta = document.querySelector('#hastaApe').value.toUpperCase();

  datos = {
    desde,
  };
  $.ajax({
    url: "res/php/listadoHuespedes.php",
    type: "POST",
    data: datos,
  }).success(function (data) {
    // console.log(data);
    $("#muestraHuespedes").html(`
      <object type="application/pdf" id="verInforme" width="100%" height="500" data="data:application/pdf;base64,${$.trim(
        data
      )}"></object>`);
  });
}

function seleccionaCentro(idCia) {
  $.ajax({
    url: "res/php/centrosCia.php",
    type: "POST",
    data: { idCia },
    success: function (data) {
      $("#centroCia option").remove();
      $("#centroCia").append(data);
    },
  });
}

function eliminaCentroCia() {
  var pagina = $("#ubicacion").val();
  var idCentro = $("#idCentroEli").val();
  $.ajax({
    url: "res/php/eliminaCentroCia.php",
    type: "POST",
    data: {
      idCentro,
    },
    success: function () {
      $(location).attr("href", pagina);
    },
  });
}

function actualizaCentroCia() {
  var pagina = $("#ubicacion").val();
  var nombre = $("#nombreMod").val();
  var responsable = $("#respoMod").val();
  var idCentro = $("#idCentroMod").val();

  $.ajax({
    url: "res/php/actualizaCentroCia.php",
    type: "POST",
    data: {
      nombre,
      responsable,
      idCentro,
    },
    success: function () {
      $(location).attr("href", pagina);
    },
  });
}

function guardaCentroCia() {
  var pagina = $("#ubicacion").val();
  var nombre = $("#nombreAdi").val();
  var responsable = $("#respoAdi").val();
  var idCia = $("#idCiaAdi").val();
  $.ajax({
    url: "res/php/adicionaCentroCia.php",
    type: "POST",
    data: {
      nombre,
      responsable,
      idCia,
    },
    success: function () {
      $(location).attr("href", pagina);
    },
  });
}

function imprimeHistoricoRegistroHotelero(regis) {
  var ventana = window.open(
    "imprimir/registros/Registro_Hotelero_" + $.trim(regis) + ".pdf",
    "PRINT",
    "height=600,width=600"
  );
}

function buscaCredito(idCia) {
  $.ajax({
    url: "res/php/buscaCreditoCia.php",
    type: "POST",
    dataType: "json",
    data: {
      idCia,
    },
    success: function (data) {
      /// $('#creditoCia').value(data)
    },
  });
}

function traeFactura(factura, modulo) {
  if (modulo == 1) {
    ruta = "../apidian/res/php/traeFactura.php";
  }
  $.ajax({
    url: ruta,
    type: "POST",
    dataType: "json",
    data: {
      factura,
      modulo,
    },
    success: function (data) {
      return data;
    },
  });
}

function generarXML(factura, test, modulo, ambiente) {
  $.ajax({
    url: "../apidian/generaFactura.php",
    type: "POST",
    dataType: "json",
    data: {
      factura,
      test,
      modulo,
      ambiente,
    },
    success: function (data) {
      $("#verCargosFactura").html(data);
    },
  });
}

function imprimeInformeAuditoria(informe, titulo) {
  web = $("#webPage").val();
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, apellidos, nombres, usuario_id },
  } = sesion;
  file = makeid(12);
  $.ajax({
    url: `imprimir/${informe}.php`,
    type: "POST",
    data: {
      file,
      usuario,
      apellidos,
      nombres,
    },
  }).done(function (data) {
    $("#plantilla").html("");
    $("#plantilla").html(`<div class="content-wrapper"> 
      <section class="content">
        <div class="panel panel-success">
          <div class="panel-heading"> 
            <div class="row">
              <div class="col-lg-9">
                <input type="hidden" name="usuarioActivo" id="usuarioActivo" value="${usuario}">
                <input type="hidden" name="rutaweb" id="rutaweb" value="${web}">
                <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-clone"></i> ${titulo} </h3>
              </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="imprimeInforme">
              <object type="application/pdf" id="verInforme" width="100%" height="500" data="data:application/pdf;base64,${$.trim(
                data
              )}"></object>
            </div>
          </div>
        </div>
      </section>
    </div>
	`);
  });
}

function auditoriaCronologico() {
  web = $("#webPage").val();
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario },
  } = sesion;
  $.ajax({
    url: "imprimir/imprimeCargosdelDia.php",
    type: "POST",
  }).done(function (data) {
    $("#plantilla").html("");
    $("#plantilla").html(`<div class="content-wrapper"> 
      <section class="content">
        <div class="panel panel-success">
          <div class="panel-heading"> 
            <div class="row">
              <div class="col-lg-9">
                <input type="hidden" name="usuarioActivo" id="usuarioActivo" value="${usuario}">
                <input type="hidden" name="rutaweb" id="rutaweb" value="${web}">
                <input type="hidden" name="ubicacion" id="ubicacion" value="huespedesPorHabitacion">
                <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-industry"></i> Informe de Huespedes en Casa Por Habitacion </h3>
              </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="imprimeInforme">
              <object id="verInforme" width="100%" style="height:75vh" data="imprimir/informes/${$.trim(
                data
              )}"></object> 
            </div>
          </div>
        </div>
      </section>
    </div>
	`);
  });
}

function auditoriaHuespedes() {
  web = $("#webPage").val();
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario },
  } = sesion;
  $.ajax({
    url: "imprimir/imprimeHuespedesPorHabitacion.php",
    type: "POST",
  }).done(function (data) {
    $("#plantilla").html("");
    $("#plantilla").html(`<div class="content-wrapper">
      <section class="content">
        <div class="panel panel-success">
          <div class="panel-heading">
            <div class="row">
              <div class="col-lg-9">
                <input type="hidden" name="usuarioActivo" id="usuarioActivo" value="${usuario}">
                <input type="hidden" name="rutaweb" id="rutaweb" value="${web}">
                <input type="hidden" name="ubicacion" id="ubicacion" value="huespedesPorHabitacion">
                <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-industry"></i> Informe de Huespedes en Casa Por Habitacion </h3>
              </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="imprimeInforme">
              <object id="verInforme" width="100%" style="height:75vh" data="imprimir/informes/${$.trim(
                data
              )}"></object>
            </div>
          </div>
        </div>
      </section>
    </div>
	`);
  });
}

function buscaCia(id) {
  $.ajax({
    url: "res/php/buscaCia.php",
    type: "POST",
    datatype: "json",
    data: { id },
    success: function (data) {
      $("#txtNitCia").val(`${data["nit"]}`);
      $("#txtIdHuespedCia").val(data[0]["id_compania"]);
      $("#txtNombreCia").val(data[0]["empresa"]);
    },
  });
}

function irPaginaCia(id) {
  var filas = $("#numFiles").val();
  newregis = filas * id;
  traeTotalCompanias(newregis, filas);
}

function traeTotalCompanias(regis, filas) {
  var cias = $("#regiscia").val();
  var pages = Math.ceil(cias / filas);
  lista = "";
  barra = "";

  $.ajax({
    url: "res/php/traeCompaniasLimit.php",
    type: "POST",
    dataType: "json",
    data: {
      regis,
      filas,
    },
    success: function (data) {
      $("#listaCompanias").html("");
      $("#barraPaginas").html("");
      for (i = 0; i < data.length; i++) {
        lista =
          lista +
          `
          <tr style='font-size:12px'>
            <td width="12%">${data[i]["nit"]} - ${data[i]["dv"]}</td>
            <td>${data[i]["empresa"]}</td>
            <td>${data[i]["direccion"]}</td>
            <td>${data[i]["celular"]}</td>
            <td>${data[i]["email"]}</td>
            <td>${data[i]["descripcion_tarifa"]}</td>
            <td style="padding:3px;width: 14%">
              <nav class="navbar navbar-default" style="margin-bottom: 0px;min-height:0px;">
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding:1px">
                  <ul class="nav navbar-nav" style="width:100%">
                    <li class="dropdown">
                      <a 
                      	href="#" 
                      	class="dropdown-toggle" 
                      	data-toggle="dropdown" 
                      	role="button" 
                      	aria-haspopup="true" 
                      	aria-expanded="false" 
                      	style="padding:3px 11px;font-weight: bold;color:#000">Ficha Compañia<span class="caret" style="margin-left:10px;"></span>
                      </a>
                      
                      <ul class="dropdown-menu submenu" style="float:left;margin-left:none;top:40px;left: -195px">  
                        <li>
                          <a 
														data-toggle  ="modal" 
														data-id      ="${data[i]["id_compania"]}" 
														data-empresa ="${data[i]["empresa"]}" 
														data-nit     ="${data[i]["nit"]} - ${data[i]["dv"]}" 
														href         ="#myModalModificaPerfilCia">
                          <i class="fa fa-address-card-o" aria-hidden="true"></i>
                           Modificar Datos</a> 
                        </li>
                        <li> 
                          <a data-toggle="modal" 
                            data-id="${data[i]["id_compania"]}" 
                            data-empresa="${data[i]["empresa"]}" 
                            data-nit="${data[i]["nit"]} - ${data[i]["dv"]}" 
                            href="#myModalHuespedesCia">
                          <i class="fa fa-address-book-o" aria-hidden="true"></i>
                           Huespedes</a> 
                        </li>
                        <li>
                          <a data-toggle="modal" 
                            data-id="${data[i]["id_compania"]}" 
                            data-empresa="${data[i]["empresa"]}" 
                            data-nit="${data[i]["nit"]} - ${data[i]["dv"]}" 
                            href="#myModalReservasEsperadasCia">
                          <i class="fa fa-calendar-plus-o" aria-hidden="true"></i>
                          Reservas Actuales</a>
                        </li>
                        <li>
                          <a data-toggle="modal" 
                            data-id="${data[i]["id_compania"]}" 
                            data-empresa="${data[i]["empresa"]}" 
                            data-nit="${data[i]["nit"]} - ${data[i]["dv"]}" 
                            href="#myModalHistoricoReservasCia">
                          <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                           Historico Reservas</a> 
                        </li>
                        <!-- 
                          <li>
                            <a data-toggle="modal" 
                              data-id="${data[i]["id_compania"]}" 
                              data-empresa="${data[i]["empresa"]}" 
                              data-nit="${data[i]["nit"]} - ${data[i]["dv"]}" 
                              href="#myModalEstadoCreditoCia">
                            <i class="fa fa-money" aria-hidden="true"></i>
                             Estado Credito</a>
                          </li>
                        -->
                        <li>
                          <a data-toggle="modal" 
                            data-id="${data[i]["id_compania"]}" 
                            data-empresa="${data[i]["empresa"]}" 
                            data-nit="${data[i]["nit"]} - ${data[i]["dv"]}" 
                            href="#myModalHistoricoFacturasCia">
                          <i class="fa fa-money" aria-hidden="true"></i>
                           Historico Facturas</a>
                        </li>
                        <li>
                          <a data-toggle="modal" 
                             data-id="${data[i]["id_compania"]}" 
                             data-nombre="${data[i]["empresa"]}" 
                             href="#myModalDocumentosCia">
                          <i class="fa fa-clone" aria-hidden="true"></i>
                           Documentos</a>
                        </li>


                      </ul>
                    </li>
                  </ul>
                </div>
              </nav>                      
            </td>
          </tr>
        `;
      }
      for (i = 1; i <= pages; i++) {
        barra =
          barra +
          `<button 
              class="btn btn-success" 
              data-page ="${i - 1}"
              onclick   ="irPaginaCia(${i - 1})"
            > ${i} </button>`;
      }
      $("#listaCompanias").append(lista);
      $("#barraPaginas").append(barra);
    },
  });
}

function buscaTarifa(id) {
  $.ajax({
    url: "res/php/nombreTarifa.php",
    type: "POST",
    data: { id },
    success: function (data) {
      var nombreTarifaCia = data["descripcion_tarifa"];
      return nombreTarifaCia;
    },
  });
}

function irPagina(id) {
  var filas = $("#numFiles").val();
  newregis = filas * id;
  traeTotalHuespedes(newregis, filas);
}

function traeTotalHuespedes() {
  $.ajax({
    url: "res/php/traeHuesped.php",
    type: "POST",
    success: function (data) {
      $("#listaHuespedes").html("");
      $("#listaHuespedes").append(data);
    },
  });
}

function mostrarNC(nc) {
  var nota = nc + ".pdf";
  $("#myModalVerFactura").modal("show");

  var titulo = document.querySelector("#myModalVerFactura #exampleModalLabel");
  titulo.innerHTML = `Nota Credito :  ${nc}`;
  $("#verFacturaModalCon").attr("data", "imprimir/notas/NotaCredito_" + nota);
}

function mostrarRC(rc) {
  var recibo = `Abono_${rc}.pdf`;

  $("#myModalVerFactura").modal("show");
  var titulo = document.querySelector("#myModalVerFactura #exampleModalLabel");
  titulo.innerHTML = `Recibo de Caja :  ${rc}`;

  $("#verFacturaModalCon").attr("data", `imprimir/notas/${recibo}`);
}

function verfacturaHistorico(fact) {
  var factura = fact + ".pdf";
  $("#verFactura").attr("data", "imprimir/facturas/FES-HDL" + factura);
}

function anulaFacturaHistorico() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, usuario_id, tipo },
  } = sesion;
  var pagina = $("#ubicacion").val();
  var factura = $("#facturaHis").val();
  var motivo = $("#motivoAnulaHis").val();
  var reserva = $("#reservaHis").val();
  var perfil = $("#perfilHis").val();
  btnAnula = document.querySelector(".btnAnulaHis");
  btnAnula.classList.add("apaga");

  $.ajax({
    url: "res/php/anulaFacturaHistorico.php",
    type: "POST",
    dataType: "json",
    data: {
      tipo,
      factura,
      motivo,
      usuario,
      usuario_id,
      reserva,
      perfil,
    },
    beforeSend: function (objeto) {
      registrosImpresos;
      $(".avisoAnuHis").html("");
      $(".avisoAnuHis").html(
        '<h4 class="bg-red" style="padding:10px;display:flex"><img style="margin-bottom:0" class="thumbnail" src="../img/loader.gif" alt="" /><span style="font-size:24px;font-weight: 700;font-family: ubuntu;margin:15px">Procesando Informacion, No Interrumpa </span></h4>'
      );
    },
    success: function (resp) {
      // console.log(resp)
      let { error, mensaje, archivo } = resp[0];
      let mensajeErr = "";
      if (error == "1") {
        infoError = JSON.parse(mensaje);
        let { string } = infoError;
        for (let i = 0; i < string.length; i++) {
          mensajeErr += `<li class="justify">${string[i]}</li>`;
        }
        mensajeError = `<div class="alert alert-warning" style="margin-bottom:0px">
        <h3 style="color:black !important;margin-top:0px;">
        <i class="fa-solid fa-circle-exclamation fa-2x" style="color:red;"></i>
        ATENCION, Nota Credito no Procesada </h3>
        
        <h4 style="color: brown;font-weight: 700;font-size: 20px;text-align:center;">MOTIVO DEL RECHAZO</h4>
        <ul>
          ${mensajeErr}
        </ul>`;
        $(".avisoAnuHis").html("");
        $(".avisoAnuHis").html(mensajeError);
      } else {
        var ventana = window.open(
          "imprimir/notas/" + archivo.trim(),
          "PRINT",
          "height=600,width=600"
        );
        swal(
          {
            title: "Atencion",
            text: "Factura Anulada con Exito",
            type: "success",
          },
          function () {
            $(location).attr("href", pagina);
          }
        );
      }
    },
  });
}

function fotoIdentificacion() {
  var ventana = window.open(
    "../res/photo/tomarFoto.php",
    "PRINT",
    "height=600,width=600"
  );
}

function tomarFoto() {
  var ventana = window.open(
    "../res/photo/tomarFoto.php",
    "PRINT",
    "height=600,width=600"
  );
}

function buscarCompania() {
  var valorBusqueda = $("input#search").val();
  var huesp = $("#regiscia").val();
  var filas = $("#numFiles").val();
  lista = "";
  barra = "";
  regos = 0;

  if (valorBusqueda == "") {
    return;
  }

  $.ajax({
    url: "res/php/getBuscaCompania.php",
    type: "POST",
    dataType: "json",
    data: {
      regis,
      filas,
      valorBusqueda,
    },
    beforeSend: function (data) {},
    success: function (data) {
      $("#listaCompanias").html("");
      $("#barraPaginas").html("");
      var pages = Math.ceil(data.length / filas);
      for (i = 0; i < data.length; i++) {
        lista =
          lista +
          `
        <tr style='font-size:12px'>
          <td width="12%">${data[i]["nit"]} - ${data[i]["dv"]}</td>
          <td>${data[i]["empresa"]}</td>
          <td>${data[i]["direccion"]}</td>
          <td>${data[i]["celular"]}</td>
          <td>${data[i]["email"]}</td>
          <td>${data[i]["descripcion_tarifa"]}</td>
          <td style="padding:3px;width: 12%">
            <nav class="navbar navbar-default" style="margin-bottom: 0px;min-height:0px;">
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding:1px">
                <ul class="nav navbar-nav">
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding:3px 5px;font-weight: 400;color:#000">Ficha Compañia<span class="caret" style="margin-left:10px;"></span></a>
                    
                    <ul class="dropdown-menu submenu" style="float:left;margin-left:none;top:40px;left: -195px">  
                      <li>
                        <a 
													data-toggle  ="modal" 
													data-id      ="${data[i]["id_compania"]}" 
													data-empresa ="${data[i]["empresa"]}" 
													data-nit     ="${data[i]["nit"]} - ${data[i]["dv"]}" 
													href         ="#myModalModificaPerfilCia">
                        <i class="fa fa-address-card-o" aria-hidden="true"></i>
                        Modificar Datos</a> 
                      </li>
                      <li>
                        <a 
                        	data-toggle="modal" 
                          data-id="${data[i]["id_compania"]}" 
                          data-empresa="${data[i]["empresa"]}" 
                          data-nit="${data[i]["nit"]} - ${data[i]["dv"]}" 
                          href="#myModalContactosCia">
                          <i class="fa fa-users" aria-hidden="true"></i>
                        Contactos</a> 
                      </li>
                      <li> 
                        <a data-toggle="modal" 
                          data-id="${data[i]["id_compania"]}" 
                          data-empresa="${data[i]["empresa"]}" 
                          data-nit="${data[i]["nit"]} - ${data[i]["dv"]}" 
                          href="#myModalHuespedesCia">
                        <i class="fa fa-address-book-o" aria-hidden="true"></i>
                         Huespedes</a> 
                      </li>
                      <li>
                        <a data-toggle="modal" 
                          data-id="${data[i]["id_compania"]}" 
                          data-empresa="${data[i]["empresa"]}" 
                          data-nit="${data[i]["nit"]} - ${data[i]["dv"]}" 
                          href="#myModalReservasEsperadasCia">
                        <i class="fa fa-calendar-plus-o" aria-hidden="true"></i>
                        Reservas Actuales</a>
                      </li>
                      <li>
                        <a data-toggle="modal" 
                          data-id="${data[i]["id_compania"]}" 
                          data-empresa="${data[i]["empresa"]}" 
                          data-nit="${data[i]["nit"]} - ${data[i]["dv"]}" 
                          href="#myModalHistoricoReservasCia">
                        <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                         Historico Compañia</a> 
                      </li>
                      <!-- 
                        <li>
                          <a data-toggle="modal" 
                            data-id="${data[i]["id_compania"]}" 
                            data-empresa="${data[i]["empresa"]}" 
                            data-nit="${data[i]["nit"]} - ${data[i]["dv"]}" 
                            href="#myModalEstadoCreditoCia">
                          <i class="fa fa-money" aria-hidden="true"></i>
                           Estado Credito</a>
                        </li>
                      -->
                      <li>
                        <a data-toggle="modal" 
                          data-id="${data[i]["id_compania"]}" 
                          data-empresa="${data[i]["empresa"]}" 
                          data-nit="${data[i]["nit"]} - ${data[i]["dv"]}" 
                          href="#myModalHistoricoFacturasCia">
                        <i class="fa fa-money" aria-hidden="true"></i>
                         Historico Facturas</a>
                      </li>
                      <li>
                        <a data-toggle="modal" 
                           data-id="${data[i]["id_compania"]}" 
                           data-nombre="${data[i]["empresa"]}" 
                           href="#myModalDocumentosCia">
                        <i class="fa fa-clone" aria-hidden="true"></i>
                         Documentos</a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>
            </nav>                      
          </td>
        </tr>`;
      }
      for (i = 1; i <= pages; i++) {
        barra =
          barra +
          `<button 
					class     ="btn btn-success"
					data-page ="${i - 1}"
					onclick   ="irPagina(${i - 1})"
				> ${i} </button>`;
      }
      $("#listaCompanias").append(lista);
      $("#barraPaginas").append(barra);
    },
  });
}

function buscarHuesped() {
  var valorBusqueda = $("input#search").val();
  var huesp = $("#regishue").val();
  var filas = $("#numFiles").val();
  lista = "";
  barra = "";
  regis = 0;

  if (valorBusqueda == "") {
    return;
  }

  $.ajax({
    url: "res/php/getBuscaHuesped.php",
    type: "POST",
    dataType: "json",
    data: {
      regis,
      filas,
      valorBusqueda,
    },
    beforeSend: function (data) {},
    success: function (data) {
      $("#listaHuespedes").html("");
      $("#barraPaginas").html("");
      var pages = Math.ceil(data.length / filas);
      for (i = 0; i < data.length; i++) {
        lista =
          lista +
          `<tr style='font-size:12px'>
          <td width="22px">${data[i]["identificacion"]}</td>
          <td>${data[i]["apellido1"]} ${data[i]["apellido2"]} ${data[i]["nombre1"]} ${data[i]["nombre2"]}</td>          
          <td>${data[i]["celular"]}</td>
          <td>${data[i]["email"]}</td>
          <td>${data[i]["edad"]}</td>
          <td style="padding:3px;width: 13%">
            <nav class="navbar navbar-default" style="margin-bottom: 0px;min-height:0px;">
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding:1px">
                <ul class="nav navbar-nav">
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding:3px 5px;font-weight: bold;color:#000">Ficha Huesped<span class="caret" style="margin-left:20px;"></span></a>
                    <ul class="dropdown-menu submenu" style="left: -180px">  
                      <li>
                        <a 
													data-toggle ="modal" 
													data-id     ="${data[i]["id_huesped"]}" 
													data-nombre ="${data[i]["nombre_completo"]}" 
													href        ="#myModalModificaPerfilHuesped">
                        <i class="fa fa-address-card-o" aria-hidden="true"></i>
                        Modificar Perfil</a> 
                      </li>
                      <li>
                        <a 
													data-toggle ="modal" 
													data-id     ="${data[i]["id_huesped"]}" 
													data-nombre ="${data[i]["nombre_completo"]}" 
													href        ="#myModalReservasEsperadas">
                        <i class="fa fa-calendar-plus-o" aria-hidden="true"></i>
                        Reservas</a>
                      </li>
                      <li>
                        <a 
													data-toggle ="modal" 
													data-id     ="${data[i]["id_huesped"]}" 
													data-nombre ="${data[i]["nombre_completo"]}" 
													href        ="#myModalHistoricoReservas">
                          <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                        Historico Reservas</a> 
                      </li>
                      <li>
                        <a 
													data-toggle ="modal" 
													data-id       ="${data[i]["id_huesped"]}" 
													data-nombre   ="${data[i]["nombre_completo"]}" 
													data-idcia    ="${data[i]["id_compania"]}" 
													data-idcentro ="${data[i]["idCentroCia"]}" 
													href        ="#myModalAsignarCompania">
                        <i class="fa fa-industry" aria-hidden="true"></i>
                        Asignar Compañia</a>
                      </li>
                      <li>
                        <a 
													data-toggle ="modal" 
													data-id     ="${data[i]["id_huesped"]}" 
													data-nombre ="${data[i]["nombre_completo"]}" 
													href        ="#myModalDocumentos">
                        <i class="fa fa-clone" aria-hidden="true"></i>
                        Documentos</a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>
            </nav>                                                  
          </td>
        </tr>`;
      }
      for (i = 1; i <= pages; i++) {
        barra =
          barra +
          `<button 
					class     ="btn btn-success"
					data-page ="${i - 1}"
					onclick   ="irPagina(${i - 1})"
				> ${i} </button>`;
      }
      $("#listaHuespedes").append(lista);
      $("#barraPaginas").append(barra);
    },
  });
}

function crearMovimientoDiarioAcumulado() {
  var fechaIni = $("#fechaIn").val();
  var fechaFin = $("#fechaOut").val();

  $.ajax({
    url: "res/php/recrearMovimientoDiarioAcumulado.php",
    type: "POST",
    data: {
      fechaIni,
      fechaFin,
    },
    success: function () {
      $("#aviso").html(
        '<div class="alert alert-success"><h4 align="center" style="font-size:25px:color:brown">Proceso Terminado con exito</h4></div>'
      );
    },
  });
}

function crearMovimientoDiario() {
  var fechaIni = $("#fechaIn").val();
  var fechaFin = $("#fechaOut").val();

  $.ajax({
    url: "res/php/recrearMovimientoDiario.php",
    type: "POST",
    data: {
      fechaIni,
      fechaFin,
    },
    success: function () {
      $("#aviso").html(
        '<div class="alert alert-success"><h4 align="center" style="font-size:25px:color:brown">Proceso Terminado con exito</h4></div>'
      );
    },
  });
}

function crearMovimientoCajero() {
  var fechaIni = $("#fechaIn").val();
  var fechaFin = $("#fechaOut").val();

  $.ajax({
    url: "res/php/recrearMovimientoCajero.php",
    type: "POST",
    data: {
      fechaIni,
      fechaFin,
    },
    success: function () {
      $("#aviso").html(
        '<div class="alert alert-success"><h4 align="center" style="font-size:25px:color:brown">Proceso Terminado con exito</h4></div>'
      );
    },
  });
}

function buscaReportesCajero() {
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var fecha = $("#buscarFecha").val();
  var usuario = $("#usuario").val();

  $("#verFactura").attr("data", "");

  var repo = "cierre_Cajero_" + usuario + "_" + fecha + ".pdf";
  $("#verFactura").attr("data", "imprimir/cajeros/" + repo);
}

function buscaFechaAuditoria() {
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var fechaaudi = $("#buscarFecha").val();
  var parametros = {
    fechaaudi,
  };
  $("#verFactura").attr("data", "");
  $.ajax({
    url: web + "res/php/buscaFechaAuditoria.php",
    type: "POST",
    data: parametros,
    success: function (datos) {
      $("#muestraResultado").html(datos);
    },
  });
}

async function anulaEnvioFactura(factura, reserva) {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, usuario_id, tipo },
  } = sesion;
  data = { factura, reserva, perfil: 1, usuario, usuario_id };
  try {
    const resultado = await fetch(`res/php/anulaFacturaEnvio.php`, {
      method: "post",
      headers: {
        "Content-type": "application/json; charset=UTF-8",
      },
      body: JSON.stringify(data),
    });
    const datos = await resultado.json();
    swal(
      {
        title: "Atencion!",
        text: `Factura sin Procesar a sido Anulada, Verifique la Estadia del Huesped`,
        type: "error",
        confirmButtonText: "Aceptar",
        closeOnConfirm: true,
      },
      function () {
        $(location).attr("href", "facturasDelDia");
      }
    );
  } catch (error) {
    return error;
  }
}

function anulaFactura() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, usuario_id, tipo },
  } = sesion;
  var pagina = $("#ubicacion").val();
  var numero = $("#factura").val();
  var motivo = $("#motivoAnula").val();
  var reserva = $("#reserva").val();
  var perfil = $("#perfil").val();

  $(".btnAnulaFac").css("display", "none");
  btnAnula = document.querySelector(".btnAnulaFac");
  btnAnula.classList.add("apaga");

  $.ajax({
    url: "res/php/anulaFactura.php",
    type: "POST",
    data: {
      tipo,
      numero,
      motivo,
      reserva,
      usuario,
      usuario_id,
      perfil,
    },
    beforeSend: function (objeto) {
      $(".avisoAnu").html("");
      $(".avisoAnu").html(
        '<h4 class="bg-red" style="padding:10px;display:flex"><img style="margin-bottom:0" class="thumbnail" src="../img/loader.gif" alt="" /><span style="font-size:24px;font-weight: 700;font-family: ubuntu;margin:15px">Procesando Informacion, No Interrumpa </span></h4>'
      );
    },
    success: function (data) {
      var ventana = window.open(
        "imprimir/notas/" + data.trim(),
        "PRINT",
        "height=600,width=600"
      );
      swal(
        {
          title: "Atencion",
          text: "Documento Anulado Con Exito",
          type: "success",
          confirmButtonText: "Aceptar",
        },
        function () {
          $(location).attr("href", pagina);
        }
      );
    },
  });
}

function verDepositos(reserva) {
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var parametros = { reserva };
  $.ajax({
    type: "POST",
    url: web + "res/php/depositosReservaModal.php",
    data: parametros,
    success: function (data) {
      $("#myModalVerDepositos").modal("show");
      $("#depositoHuesped").html(data);
    },
  });
}

function asignaTipoHabitacion() {
  var web = $("#webPage").val();
  id = $("#habitacionOption").val();
  $.ajax({
    url: web + "res/php/asignaTipoHabitacion.php",
    type: "POST",
    success: function (data) {
      $("#tipohabi option").remove();
      $("#tipohabi").append(data);
    },
  });
}

async function guardaHuesped(e) {
  e.preventDefault;
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, usuario_id, tipo },
  } = sesion;
  // sesion = JSON.parse(localStorage.getItem("sesion"));
  let web = $("#rutaweb").val();
  let pagina = $("#ubicacion").val();
  let nuevaIde = $("#identifica").val();
  let creaRese = parseInt($("#creaReser").val());
  let tarifa = $("#tarifa").val();

  let formHuesped = document.querySelector("#formAdicionaHuespedes");
  let dataHuesp = new FormData(formHuesped);

  fechanace = dataHuesp.get("fechanace");

  const edad = await restaEdad(fechanace);

  dataHuesp.append("usuario", usuario);
  dataHuesp.append("usuario_id", usuario_id);
  dataHuesp.append("edad", parseInt(edad));

  $.ajax({
    type: "POST",
    data: dataHuesp,
    url: "res/php/ingresoHuesped.php",
    dataType: "json",
    cache: false,
    contentType: false,
    processData: false,
    success: function (resp) {
      mensajeCrea(resp, "Huesped Creado", "huespedesPerfil", creaRese, tarifa);
    },
  });
}

function mensajeCrea(resp, texto, pagina, creaRese, tarifa) {
  let { id, error } = resp;
  if (id != "0") {
    swal(
      {
        title: "Atencion!",
        text: `${texto}  Con Exito`,
        type: "success",
        confirmButtonText: "Aceptar",
        closeOnConfirm: true,
      },
      function () {
        if (creaRese == 1) {
          $("#buscarHuesped").focus();
          btnRegresa = document.querySelector("#btnRegresaPerfil");
          btnRegresa.click();
          var nuevaIde = $("#identifica").val();
          $("#buscarHuesped").val(nuevaIde);
          seleccionaHuespedReserva(id, tarifa);
          $("#noches").focus();
        } else {
          window.location.href = pagina;
        }
      }
    );
  } else {
    mostrarAlerta(error, "alerta");
  }
}

function mostrarAlerta(mensaje, campo) {
  const alerta = document.querySelector("#" + campo);
  if ((alerta.classList.contains = "oculto")) {
    alerta.classList.remove("oculto");
    alerta.innerHTML = `
        <h3 class="font-bold tc m0">¡ Error !<br>
        <span class="block sm:inline">${mensaje}</span>
        </h3>
    `;
    setTimeout(() => {
      alerta.classList.add("oculto");
    }, 3000);
  }
}

function traeHuespedesCon(reserva, huesped) {
  $.ajax({
    url: "res/php/buscaHuespedesSalida.php",
    type: "POST",
    data: {
      reserva,
      huesped,
    },
    success: function (data) {
      $("#titular option").remove();
      $("#titular").append(data);
    },
  });
}

function traeHuespedes(reserva, huesped) {
  $.ajax({
    url: "res/php/buscaHuespedesSalida.php",
    type: "POST",
    data: {
      reserva,
      huesped,
    },
    success: function (data) {
      $("#titular option").remove();
      $("#titular").append(data);
    },
  });
}

function activaCongelado(reserva, folio) {
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  if (folio == 1) {
    $("#folio1").hide().addClass("in active").slideDown("fast");
  }
  if (folio == 1) {
    $("#folio1").hide().addClass("in active").slideDown("fast");
    $("#folio2").hide().removeClass("in active").slideDown("fast");
    $("#folio3").hide().removeClass("in active").slideDown("fast");
    $("#folio4").hide().removeClass("in active").slideDown("fast");
    $("#folio1").css("display", "block");
    $("#folio2").css("display", "none");
    $("#folio3").css("display", "none");
    $("#folio4").css("display", "none");
  }
  if (folio == 2) {
    $("#folio1").hide().removeClass("in active").slideDown("fast");
    $("#folio2").hide().addClass("in active").slideDown("fast");
    $("#folio3").hide().removeClass("in active").slideDown("fast");
    $("#folio4").hide().removeClass("in active").slideDown("fast");
    $("#folio1").css("display", "none");
    $("#folio2").css("display", "block");
    $("#folio3").css("display", "none");
    $("#folio4").css("display", "none");
  }
  if (folio == 3) {
    $("#folio1").hide().removeClass("in active").slideDown("fast");
    $("#folio2").hide().removeClass("in active").slideDown("fast");
    $("#folio3").hide().addClass("in active").slideDown("fast");
    $("#folio4").hide().removeClass("in active").slideDown("fast");
    $("#folio1").css("display", "none");
    $("#folio2").css("display", "none");
    $("#folio3").css("display", "block");
    $("#folio4").css("display", "none");
  }
  if (folio == 4) {
    $("#folio4").hide().addClass("in active").slideDown("fast");
    $("#folio1").hide().removeClass("in active").slideDown("fast");
    $("#folio2").hide().removeClass("in active").slideDown("fast");
    $("#folio3").hide().removeClass("in active").slideDown("fast");
    $("#folio1").css("display", "none");
    $("#folio2").css("display", "none");
    $("#folio3").css("display", "none");
    $("#folio4").css("display", "block");
  }

  $("#folioActivo").val(folio);
  var parametros = {
    reserva,
    folio,
  };
  $.ajax({
    type: "POST",
    url: web + "res/php/movimientoCongelado.php",
    data: parametros,
    success: function (data) {
      $(".saldoFolioRoom" + folio).html(data);
    },
  });
}

function movimientosCongelada(reserva) {
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var parametros = { reserva };
  $.ajax({
    type: "POST",
    url: web + "res/php/saldoHabitacion.php",
    data: parametros,
    success: function (data) {
      $("#plantilla").html("");
      $("#plantilla").html(data);
      activaCongelado(reserva, 1);
      $(location).attr("href", "facturacionCongelada");
    },
  });
}

function congelaHuesped() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, usuario_id },
  } = sesion;

  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var reserva = $("#reservaActual").val();
  var idhues = $("#txtIdHuespedCong").val();
  var room = $("#nrohabitacion").val();
  var folio = $("#folioActivo").val();
  var idcia = $("#txtIdCiaCong").val();

  var parametros = {
    room,
    folio,
    idhues,
    reserva,
    idcia,
    usuario,
    usuario_id,
  };
  $.ajax({
    type: "POST",
    url: web + "res/php/ingresoCongela.php",
    data: parametros,
    success: function (data) {
      // console.log(data);
      var ventana = window.open(
        "imprimir/congela/" + data.trim(),
        "PRINT",
        "height=600,width=600"
      );
      swal(
        {
          title: "Atencion",
          text: "Cuenta Congelada con Exito",
          type: "success",
        },
        function () {
          $(location).attr("href", "facturacionEstadia");
        }
      );
    },
  });
}

function allowDrop(ev) {
  ev.preventDefault();
}

function drag(ev) {
  ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
  ev.preventDefault();
  var data = ev.dataTransfer.getData("text");
  ev.target.appendChild(document.getElementById(data));
}

function verAuditoria(info) {
  var fecha = $("#fechaaudi").val();
  var repo = info + fecha + ".pdf";
  $("#verFactura").attr("data", "imprimir/auditorias/" + repo);
}

function buscaAuditoriasFecha() {
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var fechaaudi = $("#buscarFecha").val();

  var parametros = {
    fechaaudi: fechaaudi,
  };
  $("#verFactura").attr("data", "");
  $.ajax({
    url: web + "res/php/buscaAuditoriaFecha.php",
    type: "POST",
    data: parametros,
    beforeSend: function (datos) {
      $("#aviso").html("");
      $("#aviso").html(
        '<h4 class="bg-red" style="padding:10px;display:flex"><img style="margin-bottom:0" class="thumbnail" src="../img/loader.gif" alt="" /><span style="font-size:24px;font-weight: 700;font-family: ubuntu;margin:15px">Buscando Informacion </span></h4>'
      );
    },
    success: function (datos) {
      $("#muestraResultado").html(datos);
    },
  });
}

function verfactura(fact, perfil) {
  if (perfil == "1") {
    var factura = fact + ".pdf";
    $("#verFactura").attr("data", "imprimir/facturas/FES-" + factura);
  } else {
    var factura = "Abono_" + fact + ".pdf";
    $("#verFactura").attr("data", "imprimir/notas/" + factura);
  }
}

function verRecibo(fact) {
  var recibo = "Abono_" + fact + ".pdf";
  $("#verFactura").attr("data", "imprimir/notas/" + recibo);
}

function buscaFacturasFecha() {
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var fechafac = $("#buscarFecha").val();
  var parametros = {
    fechafac,
  };
  $("#verFactura").attr("data", "");
  $.ajax({
    url: web + "res/php/buscaFacturasFecha.php",
    type: "POST",
    data: parametros,
    success: function (datos) {
      $("#muestraResultado").html(datos);
    },
  });
}

function guardaHuespedReserva() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, usuario_id },
  } = sesion;
  var web = $("#rutaweb").val();
  var ubicacion = $("#ubicacion").val();
  var idreser = $("#idreservaAco").val();
  var parametros = $("#nuevoHuespedReserva").serializeArray();
  parametros.push({ name: "usuario", value: usuario });
  parametros.push({ name: "idusuario", value: usuario_id });
  $.ajax({
    type: "POST",
    data: parametros,
    url: web + "res/php/guardaHuespedReserva.php",
    success: function (datos) {
      $("#myModalAdicionaHuespedReserva").modal("hide");
      $("#buscarHuesped").val(datos.trim());
      swal(
        "Precaucion",
        "Huesped Creado con Exito, No Olvide Actualizar la Informacion del Cliente",
        "success"
      );
    },
  });
}

function traeAcompanantes(idres) {
  idres = parseInt(idres);
  var param = {
    idres,
  };
  $.ajax({
    type: "POST",
    data: param,
    url: "res/php/dataBuscarAcompanantes.php",
    success: function (datos) {
      $("#acompanantes").html(datos);
    },
  });
}

async function facturaDetalladaHistorico(prefijo, factura) {
  let imprime = await imprimeFacturaDetalladaHistorico(factura, prefijo);
  let { impresion } = imprime;

  datos = "facturas/FES-" + prefijo + factura + ".pdf";
  var ventana = window.open(
    "imprimir/" + $.trim(datos),
    "PRINT",
    "height=600,width=600"
  );
}

const imprimeFacturaDetalladaHistorico = async (factura, prefijo) => {
  data = { factura, prefijo };
  try {
    const resultado = await fetch(
      `res/php/imprimeFacturaDetalladaHistorico.php`,
      {
        method: "post",
        headers: {
          "Content-type": "application/json; charset=UTF-8",
        },
        body: JSON.stringify(data),
      }
    );
    const datos = await resultado.json();
    return datos;
  } catch (error) {
    return error;
  }
};

async function facturaDetallada(prefijo, factura) {
  let imprime = await imprimeFacturaDetallada(factura, prefijo);
  let { impresion } = imprime;
  datos = "facturas/FES-" + prefijo + factura + ".pdf";
  var ventana = window.open(
    "imprimir/" + $.trim(datos),
    "PRINT",
    "height=600,width=600"
  );
}

const imprimeFacturaDetallada = async (factura, prefijo) => {
  data = { factura, prefijo };
  try {
    const resultado = await fetch(`res/php/imprimeFacturaDetallada.php`, {
      method: "post",
      headers: {
        "Content-type": "application/json; charset=UTF-8",
      },
      body: JSON.stringify(data),
    });
    const datos = await resultado.json();
    return datos;
  } catch (error) {
    // console.log(error);
    return error;
  }
};

async function reEnviaFactura(factura) {
  $("#myModalReenviaFactura").modal("show");
  document.querySelector("#verFacturaNro").value = factura;

  let jsonFactura = await creaJSONFactura(factura);
  const eToken = await traeToken();
  let { token } = eToken[0];
  let recibeData = await enviaJSONFactura(jsonFactura, token);
  let recibe = await recibeData.json();
  let { ok } = recibeData;
  if (!ok) {
    let vistaErr = await errorEnvio(recibeData);
  } else {
    let {
      ResponseDian: {
        Envelope: {
          Body: {
            SendBillSyncResponse: {
              SendBillSyncResult: {
                IsValid,
                ErrorMessage: { string },
              },
            },
          },
        },
      },
    } = recibe;
    const pares = string.split(", ");
    // 2. Mapear cada par para crear un array de arrays [clave, valor]
    const matriz = pares.map((par) => {
      const partes = par.split(": ");
      // Asegúrate de manejar casos donde no haya valor después de los dos puntos
      return [partes[0].trim(), partes[1] ? partes[1].trim() : ""];
    });

    const objetoRecibe = Object.fromEntries(
      matriz.map(([key, value]) => [key.toLowerCase(), value])
    );
    let { regla, rechazo } = objetoRecibe;
    if (IsValid === "true") {
      let {
        ResponseDian: {
          Envelope: {
            Body: {
              SendBillSyncResponse: {
                SendBillSyncResult: {
                  ErrorMessage: { string },
                  StatusMessage,
                  StatusDescription,
                  StatusCode,
                },
              },
            },
          },
        },
      } = recibe;

      let infoFac = await traeResolucion();
      let { prefijo } = infoFac;
      let {
        message,
        send_email_success,
        send_email_date_time,
        urlinvoicexml,
        urlinvoicepdf,
        cufe,
        QRStr,
        dian_validation_date_time: { date },
      } = recibe;

      datosFe = {
        factura,
        prefijo,
        message,
        send_email_success,
        send_email_date_time,
        urlinvoicexml,
        urlinvoicepdf,
        cufe,
        QRStr,
        date,
        IsValid,
        ErrorMessage: string,
        StatusCode,
        StatusDescription,
        StatusMessage,
      };

      let insertaFE = await ingresaDatosFE(datosFe);
      let imprime = await imprimeFacturaReenvio(factura, prefijo);
      let guarda = await guardaJSON(JSON.stringify(recibe), jsonFactura);
      let infocorreos = await traeCorreosFactura(factura);
      let { impresion } = imprime;
      let { correo, correofac } = infocorreos;

      let envioFAC = {
        number: factura,
        prefix: prefijo,
        base64graphicrepresentation: impresion,
      };
      let mail = await enviaCorreoFactura(envioFAC, token);
      swal(
        {
          title: "Atencion !",
          text: "Documento Procesado Con Exito !",
          type: "success",
          confirmButtonText: "Aceptar",
          closeOnConfirm: false,
        },
        function () {
          $(location).attr("href", "facturasDelDia");
        }
      );
    } else {
      if (regla == 90) {
        // Trae datos del JSON ya procesados en la DIAN
        let { uuid_dian } = recibe;
        let recibeJson = await leerDatosJSON(uuid_dian, token);
        let infoFac = await traeResolucion();
        let { prefijo } = infoFac;
        let {
          ResponseDian: {
            Envelope: {
              Body: {
                GetStatusResponse: {
                  GetStatusResult: {
                    ErrorMessage: { string },
                    StatusMessage,
                    StatusDescription,
                    StatusCode,
                  },
                },
              },
            },
          },
        } = recibeJson;

        let {
          message,
          send_email_success,
          send_email_date_time,
          urlinvoicexml,
          urlinvoicepdf,
          cufecude,
          QRStr,
          dian_validation_date_time: { date },
        } = recibeJson;

        datosFe = {
          factura,
          prefijo,
          message,
          send_email_success: 0,
          send_email_date_time: null,
          urlinvoicexml,
          urlinvoicepdf,
          cufe: cufecude,
          QRStr,
          date,
          IsValid: "true",
          ErrorMessage: string,
          StatusCode,
          StatusDescription,
          StatusMessage,
        };

        // console.log(datosFe)

        let insertaFE = await ingresaDatosFE(datosFe);
        // console.log(factura)
        let imprime = await imprimeFacturaReenvio(factura, prefijo);
        let guarda = await guardaJSON(JSON.stringify(recibeJson), jsonFactura);
        let infocorreos = await traeCorreosFactura(factura);
        let { impresion } = imprime;
        let { correo, correofac } = infocorreos;

        let envioFAC = {
          number: factura,
          prefix: prefijo,
          base64graphicrepresentation: impresion,
        };
        // console.log(envioFAC);
        let mail = await enviaCorreoFactura(envioFAC, token);
        swal(
          {
            title: "Atencion !",
            text: "Documento Procesado Con Exito !",
            type: "success",
            confirmButtonText: "Aceptar",
            closeOnConfirm: false,
          },
          function () {
            $(location).attr("href", "facturasDelDia");
          }
        );
      } else {
        let {
          ResponseDian: {
            Envelope: {
              Body: {
                SendBillSyncResponse: {
                  SendBillSyncResult: { ErrorMessage },
                },
              },
            },
          },
        } = recibe;
        let { string } = ErrorMessage;
        let mensaje = "";
        let isArray = Array.isArray(string);
        if (isArray) {
          string.map((error) => {
            mensaje = mensaje + error + "\n";
          });
        } else {
          mensaje = string;
        }
        dataErr = {
          statusText: mensaje,
          status: "200 \n",
        };
        let vistaErr = await errorEnvio(dataErr);
        let alerta = document.querySelector(".showSweetAlert");
        alerta.classList.add("anchoalerta");
      }
    }
  }
  let guarda = await guardaJSON(JSON.stringify(recibe), jsonFactura);
}

async function leerDatosJSON(uuid_dian, token) {
  url = `https://api.nextpyme.plus/api/ubl2.1/status/document/${uuid_dian}`;
  const response = await fetch(url, {
    method: "post",
    credentials: "same-origin",
    headers: {
      "Content-Type": "application/json",
      Accept: "application/json",
      Authorization: `Bearer ${token}`,
    },
    body: JSON.stringify({ sendmail: false }),
  });

  const data = await response.json();
  return data;
}

const enviaCorreoFactura = async (envioFAC, token) => {
  try {
    // url = "https://api.nextpyme.plus/api/ubl2.1/send-emaill";
    url = "http://donlolo.lan/pms/api/pruebaCorreo.php";
    const resultado = await fetch(url, {
      method: "post",
      credentials: "same-origin",
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
        Authorization: `Bearer ${token}`,
      },
      body: JSON.stringify(envioFAC),
    });
    const datos = await resultado;
    return datos;
  } catch (error) {
    return error;
  }
};

const traeCorreosFactura = async (factura) => {
  data = { factura };
  try {
    const resultado = await fetch(`res/php/traeCorreosFactura.php`, {
      method: "post",
      headers: {
        "Content-type": "application/json; charset=UTF-8",
      },
      body: JSON.stringify(data),
    });
    const datos = await resultado.json();
    return datos;
  } catch (error) {
    return error;
  }
};

const guardaJSON = async (recibe, envio) => {
  data = { recibe, envio };
  try {
    const resultado = await fetch(`res/php/guardaDatosJSON.php`, {
      method: "post",
      headers: {
        "Content-type": "application/json; charset=UTF-8",
      },
      body: JSON.stringify(data),
    });
    const datos = await resultado.json();
    return datos;
  } catch (error) {
    return error;
  }
};

const imprimeFacturaReenvio = async (factura, prefijo) => {
  data = { factura, prefijo };
  try {
    const resultado = await fetch(`res/php/imprimeFacturaReenvio.php`, {
      method: "post",
      headers: {
        "Content-type": "application/json; charset=UTF-8",
      },
      body: JSON.stringify(data),
    });
    const datos = await resultado.json();
    return datos;
  } catch (error) {
    return error;
  }
};

const traeResolucion = async () => {
  try {
    const resultado = await fetch(`res/php/traeResolucion.php`, {
      method: "post",
      headers: {
        "Content-type": "application/json; charset=UTF-8",
      },
    });
    const datos = await resultado.json();
    return datos;
  } catch (error) {
    return error;
  }
};

const ingresaDatosFE = async (datosFe) => {
  data = { datosFe };
  try {
    const resultado = await fetch(`res/php/ingresaDatosFE.php`, {
      method: "post",
      headers: {
        "Content-type": "application/json; charset=UTF-8",
      },
      body: JSON.stringify(datosFe),
    });
    const datos = await resultado.json();
    return datos;
  } catch (error) {
    return error;
  }
};

const creaJSONFactura = async (factura) => {
  data = { factura };
  try {
    const resultado = await fetch(`res/php/creaJSONFactura.php`, {
      method: "post",
      headers: {
        "Content-type": "application/json; charset=UTF-8",
      },
      body: JSON.stringify(data),
    });
    const datos = await resultado.json();

    return JSON.stringify(datos);
  } catch (error) {
    return error;
  }
};

const enviaJSONFactura = async (jsonFactura, token) => {
  data = { jsonFactura };
  try {
    // url = "https://api.nextpyme.plus/api/ubl2.1/invoice";
    url = "http://donlolo.lan/pms/api/prueba.json";
    const resultado = await fetch(url, {
      method: "post",
      credentials: "same-origin",
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
        Authorization: `Bearer ${token}`,
      },
      body: jsonFactura,
    });
    const datos = await resultado;
    return datos;
  } catch (error) {
    return error;
  }
};

async function guardaAcompanante(e) {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, usuario_id },
  } = sesion;

  var web = $("#rutaweb").val();
  var ubicacion = $("#ubicacion").val();

  let formHuesped = document.querySelector("#perfilAcompananteReserva");
  let dataHuesp = new FormData(formHuesped);

  let idreser = dataHuesp.get("idReservaAdiAco");

  dataHuesp.append("usuario", usuario);
  dataHuesp.append("usuario_id", usuario_id);

  $.ajax({
    type: "POST",
    data: dataHuesp,
    url: "res/php/guardaAcompanante.php",
    dataType: "json",
    cache: false,
    contentType: false,
    processData: false,
    success: function (resp) {
      let { id, adicional, error } = resp;
      if (id != "0") {
        btnSaveAco = document.querySelector("#btnSaveAco");
        btnSaleAco = document.querySelector("#bntSaleAcompana");
        btnSaveAco.click();
        btnSaleAco.click();
        traeAcompanantes(idreser);
      } else {
        mostrarAlerta(error, "alerta");
      }
    },
  });
}

function buscaHuespedAcompanante(id) {
  var web = $("#rutaweb").val();
  var parametros = {
    id,
  };
  $.ajax({
    url: web + "res/php/buscaIdenAcompana.php",
    type: "POST",
    dataType: "json",
    data: parametros,
    success: function (datos) {
      if (datos.length !== 0) {
        let { identificacion } = datos[0];
        swal(
          {
            title: "Atencion!",
            text: `Identificacion ${identificacion} Ya existe, NO permitido Duplicar`,
            type: "error",
            confirmButtonText: "Aceptar",
            closeOnConfirm: true,
          },
          function () {
            document.querySelector("#identificaAdiAco").value = "";
            document.querySelector("#identificaAdiAco").focus;
          }
        );
      }
    },
  });
}

function buscaIdent(ident, id) {
  var web = $("#rutaweb").val();
  var parametros = {
    ident,
    id,
  };
  $.ajax({
    url: web + "res/php/buscaIdenModi.php",
    type: "POST",
    dataType: "json",
    data: parametros,
    success: function (datos) {
      if (datos.length !== 0) {
        let { identificacion } = datos[0];
        swal(
          {
            title: "Atencion!",
            text: `Identificacion ${identificacion} Ya existe, NO permitido Duplicar`,
            type: "error",
            confirmButtonText: "Aceptar",
            closeOnConfirm: true,
          },
          function () {
            document.querySelector("#identificaUpd").value = "";
            document.querySelector("#identificaUpd").focus;
          }
        );
      }
    },
  });
}

function buscaIdentNit(ident, id) {
  var web = $("#rutaweb").val();
  var parametros = {
    ident,
    id,
  };
  $.ajax({
    url: web + "res/php/buscaIdenModiCia.php",
    type: "POST",
    dataType: "json",
    data: parametros,
    success: function (datos) {
      // console.log(datos)
      if (datos.length !== 0) {
        let { nit } = datos[0];
        swal(
          {
            title: "Atencion!",
            text: `Nit ${nit} Ya existe, NO permitido Duplicar`,
            type: "error",
            confirmButtonText: "Aceptar",
            closeOnConfirm: true,
          },
          function () {
            document.querySelector("#nitUpd").value = "";
            document.querySelector("#nitUpd").focus;
          }
        );
      }
    },
  });
}

function buscaIdentificacion(id) {
  var web = $("#rutaweb").val();
  var parametros = {
    id,
  };
  $.ajax({
    url: web + "res/php/buscaIdenAcompana.php",
    type: "POST",
    dataType: "json",
    data: parametros,
    success: function (datos) {
      if (datos.length !== 0) {
        let { identificacion } = datos[0];
        swal(
          {
            title: "Atencion!",
            text: `Identificacion ${identificacion} Ya existe, NO permitido Duplicar`,
            type: "error",
            confirmButtonText: "Aceptar",
            closeOnConfirm: true,
          },
          function () {
            document.querySelector("#identifica").value = "";
            document.querySelector("#identifica").focus;
          }
        );
      }
    },
  });
}

function eliminaAcompanante(id) {
  var web = $("#rutaweb").val();
  var parametros = { id };
  $("#mensajeEli").css("display", "none");
  let idreser = $("#idreservaAco").val();
  $.ajax({
    type: "POST",
    data: parametros,
    url: web + "res/php/eliminaAcompanante.php",
    success: function (datos) {
      $("#mensajeEli").html(datos);
      traeAcompanantes(idreser);
    },
  });
}

function trasladarConsumos() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario },
  } = sesion;

  var web = $("#rutaweb").val();
  var idconsumo = $("#txtIdConsumoTras").val();
  var idreserva = $("#txtIdReservaTras").val();
  var idhuesped = $("#txtIdHuespedTras").val();
  var newreserva = $("#roomChange").val();
  var motivotras = $("#txtMotivoTras").val();
  var numero = $("#reservaActual").val();

  var parametros = {
    idconsumo,
    idreserva,
    idhuesped,
    motivotras,
    newreserva,
    usuario,
  };
  $.ajax({
    url: web + "res/php/trasladarCargo.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $("#myModalTrasladarCargo").modal("hide");
      movimientosFactura(numero);
    },
  });
}

function anulaSalida() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, usuario_id },
  } = sesion;
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var numero = $("#txtIdReservaAnu").val();
  var habita = $("#txtNumeroHabAnu").val();
  var parametros = {
    numero,
    habita,
    usuario,
    idusuario: usuario_id,
  };
  $.ajax({
    type: "POST",
    url: web + "res/php/anulaSalida.php",
    data: parametros,
    success: function (data) {
      if (data == 1) {
        swal(
          "Salida Anulada !",
          "Su Estadia a sido activada de con Exito",
          "success"
        );
        // $(location).attr("href", pagina);
      }
    },
  });
}

function actualizaCiaRecepcion() {
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var idreserva = $("#idReservaCia").val();
  var idcia = $("#companiaSele").val();

  var parametros = {
    idreserva,
    idcia,
  };
  $.ajax({
    url: web + "res/php/updateCiaReserva.php",
    type: "POST",
    data: parametros,
    success: function (datos) {
      $(location).attr("href", pagina);
    },
  });
}

function cierreCajero(user) {
  var page = $("#rutaweb").val();
  var parametros = {
    usuario,
    page,
  };
  $.ajax({
    url: "paginas/cierreDelDiaCajero.php",
    type: "POST",
    data: parametros,
    success: function (datos) {
      swal("Atencion", "Cajero Cerrado Con Exito", "success");
      setTimeout(cierraSesion(), 5000);
    },
  });
}

function calculaRetencionesOld(id) {
  $.ajax({
    type: "POST",
    url: "res/php/traeRetencionesCia.php",
    data: id,
    success: function (data) {},
  });
}

const calculaRetenciones = async () => {
  try {
    const resultado = await fetch(`res/php/traeToken.php`, {
      method: "post",
      headers: {
        "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
      },
    });
    const datos = await resultado.json();
    // console.log(datos);
    return datos;
  } catch (error) {
    // console.log(error);
    return error;
  }
};

async function apagaselecomp(tipo) {
  idCiaFac = $("#txtIdCiaSal").val();
  idCenFac = $("#txtIdCentroCiaSal").val();
  nroReserva = $("#txtIdReservaSal").val();
  nroFolio = $("#folioActivo").val();
  sinBase = $("#sinBaseRete").val();
  var reteFte = 0;
  var reteIva = 0;
  var reteIca = 0;
  let totCta = 0;

  if (tipo == "2") {
    if (idCiaFac == "0") {
      $("#habitacionOptionCon").val(1);
      swal("Precaucion", "Asigne Primero la Compañia", "warning");
      return;
    }
    $("#selecentro").css("display", "block");
    $("#selecomp").css("display", "block");
    $("#seleccionaCiaCon").attr("disabled", true);
    $("#seleccionaCiaCon").attr("disabled", true);
    $(".retencion").removeClass("apaga");

    let reteCia = await traeRetencionesCia(idCiaFac);
    let { reteiva, reteica, retefuente, sinBaseRete } = reteCia;
    let reteFuentes = await valorRetencionesFolio(
      nroReserva,
      nroFolio,
      sinBaseRete
    );

    let mReteIca = await valorReteIcaFolio(nroReserva, nroFolio);

    totalRteFte = parseInt($("#baseRetenciones").val());
    totalImpto = parseInt($("#totalIva").val());
    totalBaseImpto = parseInt($("#totalBaseIva").val());

    retenciones = await traeRetenciones();

    let valbase = 0;
    let valrete = 0;
    let valbaseIca = 0;
    let valreteIca = 0;

    reteFuentes.map((valor) => {
      let { base, valorRetencion } = valor;
      valbase = valbase + base;
      valrete = valrete + valorRetencion;
    });

    mReteIca.map((valor) => {
      let { base, valorRetencion } = valor;
      valbaseIca = valbaseIca + base;
      valreteIca = valreteIca + valorRetencion;
    });

    let rFte = retenciones.filter((retencion) => retencion.idRetencion == "1");
    let rIva = retenciones.filter((retencion) => retencion.idRetencion == "2");
    let rIca = retenciones.filter((retencion) => retencion.idRetencion == "3");

    if (retefuente == 1) {
      if (sinBaseRete == 1) {
        reteFte = valrete;
      } else {
        if (rFte[0].baseRetencion <= valbase) {
          reteFte = valrete;
        }
      }
    }

    if (reteiva == 1) {
      reteIva = totalImpto * (rIva[0].porcentajeRetencion / 100);
    }

    if (reteica == 1) {
      reteIca = valreteIca;
    }

    reteFte = parseInt(reteFte.toFixed(0));
    reteIva = parseInt(reteIva.toFixed(0));
    reteIca = parseInt(reteIca.toFixed(0));

    $("#reteiva").val(number_format(reteIva, 2));
    $("#reteica").val(number_format(reteIca, 2));
    $("#retefuente").val(number_format(reteFte, 2));
    $("#sinBaseRete").val(sinBaseRete);

    $("#porceReteiva").val(number_format(rIva[0].porcentajeRetencion, 2));
    $("#porceReteica").val(number_format(rIca[0].porcentajeRetencion, 2));
    $("#porceRetefuente").val(number_format(rFte[0].porcentajeRetencion, 2));

    $("#totalReteiva").val(reteIva);
    $("#totalReteica").val(reteIca);
    $("#totalRetefuente").val(reteFte);

    totCta = await sumaTotales();
  } else {
    $(".retencion").addClass("apaga");
    $("#selecentro").css("display", "none");
    $("#selecomp").css("display", "none");
    $("#reteiva").val(0);
    $("#reteica").val(0);
    $("#retefuente").val(0);
    $("#totalReteiva").val(0);
    $("#totalReteica").val(0);
    $("#totalRetefuente").val(0);
    $("#sinBaseRete").val(0);
    totCta = await sumaTotales();
  }
}

async function actualizaRetencionesCia(reteCia) {
  let { sinBase } = reteCia;
  document.querySelector("#sinBaseRete").val = sinBase;
}

async function valorRetencionesFolio(nroReserva, nroFolio, sinBase) {
  data = {
    nroReserva,
    nroFolio,
    sinBase,
  };
  try {
    const resultado = await fetch(`res/php/traeRetencionesValor.php`, {
      method: "post",
      headers: {
        "Content-type": "application/json; charset=UTF-8",
      },
      body: JSON.stringify(data),
    });
    const datos = await resultado.json();
    return datos;
  } catch (error) {
    return error;
  }
}

async function valorReteIcaFolio(nroReserva, nroFolio) {
  data = {
    nroReserva,
    nroFolio,
  };
  try {
    const resultado = await fetch(`res/php/traeReteIcaValor.php`, {
      method: "post",
      headers: {
        "Content-type": "application/json; charset=UTF-8",
      },
      body: JSON.stringify(data),
    });
    const datos = await resultado.json();
    return datos;
  } catch (error) {
    return error;
  }
}

function sumaTotales() {
  toCon = parseFloat($("#totalConsumo").val());
  toImp = parseFloat($("#totalImpuesto").val());
  toAbo = parseFloat($("#totalAbono").val());
  toRiv = parseFloat($("#totalReteiva").val());
  toRic = parseFloat($("#totalReteica").val());
  toFue = parseFloat($("#totalRetefuente").val());
  totGen = toCon + toImp - (toAbo + toRiv + toRic + toFue);
  $("#SaldoFolioActual").val(totGen);
  $("#txtValorPago").val(totGen);
  $("#total").val(totGen);
}

const traeRetencionesCia = async (idcia) => {
  try {
    const resultado = await fetch(`res/php/traeRetencionesCia.php`, {
      method: "post",
      headers: {
        "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
      },
      body: `idcia=${idcia}`,
    });
    const datos = await resultado.json();
    return datos;
  } catch (error) {
    return error;
  }
};

const traeRetenciones = async () => {
  try {
    const resultado = await fetch(`res/php/traeRetenciones.php`, {
      method: "post",
      headers: {
        "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
      },
    });
    const datos = await resultado.json();
    return datos;
  } catch (error) {
    return error;
  }
};

function anulaIngreso() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, usuario_id },
  } = sesion;

  var pagina = $("#ubicacion").val();
  var numero = $("#txtIdReservaAnu").val();
  var habita = $("#txtNumeroHabAnu").val();
  var parametros = {
    numero,
    habita,
    usuario,
    idusuario: usuario_id,
  };
  $.ajax({
    type: "POST",
    url: "res/php/anulaIngreso.php",
    data: parametros,
    success: function (data) {
      if (data == 1) {
        swal(
          "Estadia Anulada !",
          "Su Estadia a Sido anulada con Exito",
          "success"
        );
        $(location).attr("href", pagina);
      } else if (data == -1) {
        swal(
          "Precaucion !",
          "La Habitacion Presenta Saldo en la Cuenta no se pudo anular el Ingreso",
          "warning"
        );
      } else {
        swal("Precaucion !", "Su Estadia no se pudo anular", "warning");
      }
    },
  });
}

function accesoUsuarios() {
  menuFicha = document.querySelectorAll("#menuFicha");
  btnAdiciona = document.querySelectorAll(".btnAdiciona");
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, usuario_id, tipo },
  } = sesion;

  if (tipo > 2) {
    document.querySelector("#menuAuditoria").classList.add("apaga");
    document.querySelector("#recaudoCartera").classList.add("apaga");
    document.querySelector("#exportaDocs").classList.add("apaga");
    document.querySelector("#ciudades").classList.add("apaga");
  }

  if (tipo > 3) {
    document.querySelector("#menuCartera").classList.add("apaga");
  }

  if (tipo > 4) {
    $document.querySelector("menuAmaLlaves").classList.add("apaga");
    $document.querySelector("menuFacturacion").classList.add("apaga");
    menuFicha.forEach((element, index) => {
      if (index < menuFicha.length) {
        element.classList.add("accesoUsuarios apaga");
      }
    });
    btnAdiciona.forEach((element, index) => {
      if (index < btnAdiciona.length) {
        element.classList.add("apaga");
      }
    });
  }
}

function seleccionaHuespedReserva(id, tarifa) {
  if (!tarifa) {
    swal({
      title: "Precaucion !",
      text: `Huesped sin Tarifa Asociada \n No permitido Crear la Reserva !`,
      type: "warning",
      confirmButtonText: "Aceptar",
      closeOnConfirm: false,
    });
    return;
  }
  var web = $("#webPage").val();
  var pagina = $("#ubicacion").val();
  var parametros = {
    id,
  };
  $.ajax({
    url: web + "res/php/seleccionaHuesped.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $("#datosHuespedAdi").html(data);
      $("#tarifahab").val(tarifa);
    },
  });

  btnBusca = document.querySelector("#btnBuscaHues");
  btnBusca.click();
}

function seleccionaHuespedAco(id) {
  let numRese = document.querySelector("#idreservaAco").value;
  let web = $("#webPage").val();
  let parametros = {
    numRese,
    id,
  };

  btnSaleAco = document.querySelector("#bntSaleAcompana");
  btnCloseAco = document.querySelector("#btnBuscaAco");
  btnSaleAco.click();
  btnCloseAco.click();

  $.ajax({
    url: web + "/res/php/adicionaAcompanante.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      traeAcompanantes(numRese);
    },
  });
}

function seleccionaCambioHuespedReserva(hues) {
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var rese = $("#nroreserva").val();

  var parametros = {
    hues,
    rese,
  };
  $.ajax({
    url: web + "/res/php/seleccionaHuespedRes.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $("#datosHuespedAdi").html(data);
      $("#myModalBuscaHuespedRes").modal("hide");
      $("#myModalReasignarHuesped").modal("hide");
      swal(
        {
          title: "Atencion !",
          text: "No Olvide Reimprir el Registro Hotelero",
          type: "success",
          confirmButtonText: "Aceptar",
          closeOnConfirm: false,
        },
        function () {
          $(location).attr("href", pagina);
        }
      );
    },
  });
}

function updateEstadia() {
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var parametros = $("#formUpdateEstadia").serialize();

  $.ajax({
    type: "POST",
    data: parametros,
    url: "res/php/updateEstadia.php",
    success: function (datos) {
      $(location).attr("href", "encasa");
    },
  });
}

function updateCongelada() {
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var parametros = $("#formUpdateCongelada").serialize();

  $.ajax({
    type: "POST",
    data: parametros,
    url: "res/php/updateCongelada.php",
    success: function (datos) {
      $(location).attr("href", "cuentasCongeladas");
    },
  });
}

function cierreDiario() {
  var web = $("#rutaweb").val();
  $("#botonCierre").attr("disabled", "disabled");
  fecha = $("#fechaAuditoria").html();

  huespedesencasa();
  registrosImpresos();

  setTimeout(function () {
    sale = $("#contador").val();
    regi = $("#registro").val();
    if (sale == 0 && regi == 0) {
      $.ajax({
        url: web + "/res/php/procesosAuditoriaNocturna.php",
        type: "POST",
        dataType: "json",
        beforeSend: function (objeto) {
          registrosImpresos;
          $("#aviso").html("");
          $("#aviso").html(
            '<h4 class="bg-red" style="padding:10px;display:flex"><img style="margin-bottom:0" class="thumbnail" src="../img/loader.gif" alt="" /><span style="font-size:24px;font-weight: 700;font-family: ubuntu;margin:15px">Procesando Informacion, No Interrumpa </span></h4>'
          );
        },
        success: function (datos) {
          $.each(datos, function (i, item) {
            proceso = item.nombre_proceso;
            corre = item.estado_proceso;
            titulo = item.titulo_proceso;
            reporte = item.reporte;
            setTimeout(
              correProceso(proceso, corre, fecha, titulo, reporte),
              5000
            );
          });
          swal(
            {
              title: "Atencion !",
              text: "Auditoria Nocturna Terminada con Exito !",
              type: "success",
              confirmButtonText: "Aceptar",
              closeOnConfirm: false,
            },
            function () {}
          );
        },
      });
    } else if (sale != 0) {
      $.ajax({
        url: web + "res/php/habitacionesSinSalir.php",
        type: "POST",
        data: { fecha },
        success: function (data) {
          $("#aviso").html(data);
        },
      });
    } else {
      $.ajax({
        url: web + "res/php/registrosSinImprimir.php",
        type: "POST",
        data: { fecha },
        success: function (data) {
          $("#aviso").html(data);
        },
      });
    }
  }, 1000);
}

function correProceso(procesor, correr, fecha, titulo, reporte) {
  if (correr == 1) {
    $("#aviso").html("");
    $("#aviso").html(
      '<div><h4 class="bg-red-gradient" style="padding:10px">Proceso : <span style="font-size:24px;font-weight: 700;font-family: "ubuntu"">' +
        titulo +
        "</span> Ya Ejecutado</h4></div>"
    );
  } else {
    registrosImpresos;
    $.ajax({
      url: "auditoria/" + procesor,
      type: "POST",
      data: { fecha },
      beforeSend: function (objeto) {
        $("#aviso").html("");
        $("#aviso").html(
          '<div><h4 class="bg-green-gradient" style="padding:10px">Ejecutando Proceso : <span style="font-size:24px;font-weight: 700;font-family: "ubuntu"">' +
            titulo +
            "</span></h4></div>"
        );
      },
      success: function () {
        $("#aviso").html("");
        $("#aviso").html(
          '<div><h4 class="bg-blue-gradient" style="padding:10px">Proceso : <span style="font-size:24px;font-weight: 700;font-family: "ubuntu"">' +
            titulo +
            "</span> Ejecutado Con Exito</h4></div>"
        );
      },
    });
  }
}

function registrosImpresos() {
  var web = $("#rutaweb").val();
  $.ajax({
    url: web + "res/php/registrosdelDia.php",
    type: "POST",
    success: function (data) {
      $("#registro").val($.trim(data));
    },
  });
}

function huespedesencasa() {
  var web = $("#rutaweb").val();
  $.ajax({
    url: web + "res/php/salidasDelDia.php",
    type: "POST",
    success: function (data) {
      $("#contador").val($.trim(data));
    },
  });
}

function moverConsumos() {
  var pagina = $("#ubicacion").val();
  var id = $("#txtIdConsumoMov").val();
  var folio = $("#txtFolioMov").val();
  var numero = $("#reservaActual").val();
  var parametros = {
    id,
    folio,
  };
  $.ajax({
    url: "res/php/moverCargo.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $("#myModalMoverCargo").modal("hide");
      movimientosFactura(numero);
    },
  });
}

function ingresaAjuste() {
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var codigo = $("#codigoAjuste").val();
  var textcodigo = $("#codigoAjuste option:selected").text();
  var canti = $("#txtCantidadAju").val();
  var valor = $("#txtValorAjuste").val();
  var refer = $("#txtReferenciaAju").val();
  var folio = $("#txtFolioAju").val();
  var detalle = $("#txtDetalleAjuste").val();
  var numero = $("#txtIdReservaAju").val();
  var idhues = $("#txtIdHuespedAju").val();
  var room = $("#txtNumeroHabAju").val();
  var turismo = $("#txtImptoTurismo").val();

  var parametros = {
    codigo,
    textcodigo,
    canti,
    valor,
    refer,
    folio,
    detalle,
    numero,
    idhues,
    room,
  };
  $.ajax({
    type: "POST",
    url: web + "res/php/ingresoConsumo.php",
    data: parametros,
    success: function (data) {
      if (data == 0) {
        $("#mensaje").html(
          '<div class="alert alert-warning"><h3>No se pudo ingresar el consumo</h3></div>'
        );
      } else {
        $("#mensaje").html(
          '<div class="alert alert-warning"><h3>Ingreso Realizado con Exito</h3></div>'
        );
      }
      $(location).attr("href", pagina);
    },
  });
}

function cambiaTarifa() {
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var id = $("#txtIdReservaTar").val();
  var tipoact = $("#tarifaHabAct").val();
  var habiact = $("#valortarifaAct").val();
  var tiponue = $("#tarifahab").val();
  var habinue = $("#valortarifa").val();
  var motivo = $("#motivoCambio").val();
  var mmto = 0;
  var motivo = 0;
  var parametros = {
    id,
    tipoact,
    habiact,
    tiponue,
    habinue,
    motivo,
    mmto,
  };
  $.ajax({
    url: "res/php/cambiaTarifa.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $("#mensajeAct").html(data);
      $(location).attr("href", pagina);
    },
  });
}

function valorHabitacionAct(tarifa) {
  var tipo = $("#tipohabiAct").val();
  var hom = $("#hombresAct").val();
  var muj = $("#mujeresAct").val();
  var nin = $("#ninosAct").val();
  let desde = $("#llegadaAct").val();
  let hasta = $("#salidaAct").val();

  var habi = $("#tipoocupacionAct").val();
  if (hom + muj == 0) {
    $("#mensaje").html(
      '<div class="alert alert-warning"><h3 class="tituloPagina">Sin Adultos Asignados a la Reserva</h3></div>'
    );
    $("#hombres").focus();
  } else {
    $("#mensaje").html("");
    var parametros = {
      tarifa,
      tipo,
      hom,
      muj,
      nin,
      desde,
      hasta,
    };
    $.ajax({
      url: "res/php/valorTarifa.php",
      type: "POST",
      data: parametros,
      success: function (data) {
        $("#valortarifa").val(data);
        $("#valortarifa").focus();
      },
    });
  }
}

function cambiaHabitacion() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario_id },
  } = sesion;

  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  $("input:radio:checked").each(function () {
    mmto = $(this).val();
  });
  var id = $("#txtIdReservaCam").val();
  var tipoact = $("#txtTipoHabCam").val();
  var habiact = $("#txtNumeroHabCam").val();
  var tiponue = $("#tipohabi").val();
  var habinue = $("#nrohabitacion").val();
  var motivo = $("#motivoCambio").val();
  var observa = $("#observaCambio").val();

  var parametros = {
    id,
    tipoact,
    habiact,
    tiponue,
    habinue,
    motivo,
    observa,
    mmto,
    usuario_id,
  };

  $.ajax({
    type: "POST",
    url: "res/php/cambiaHabitacion.php",
    data: parametros,
    success: function (data) {
      $("#mensaje").html(data);
      $(location).attr("href", pagina);
    },
  });
}

function seleccionaTarifasUpd() {
  var tipo = $("#tipohabiUpd").val();
  var llega = $("#llegada").val();
  var sale = $("#salida").val();
  var parametros = { tipo, llega, sale };
  $.ajax({
    type: "POST",
    url: "res/php/seleccionaTarifasUpd.php",
    data: parametros,
    beforeSend: function (objeto) {},
    success: function (data) {
      $("#tarifahabUpd option").remove();
      $("#tarifahabUpd").html(data);
    },
  });
}

function seleccionaHabitacionUpd(tipohab, anterior, numero, llega, sale) {
  let tipo = document.querySelector("#tipohabiUpd").value;
  // console.log(tipo);
  var parametros = {
    tipo,
    anterior,
    numero,
    llega,
    sale,
  };
  $.ajax({
    type: "POST",
    url: "res/php/seleccionaTipoHabitacion.php",
    data: parametros,
    beforeSend: function (objeto) {},
    success: function (data) {
      $("#nrohabitacionUpd option").remove();
      $("#nrohabitacionUpd").append(data);
    },
  });
}

async function updateReserva() {
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var parametros = $("#formUpdateReservas").serialize();
  $.ajax({
    type: "POST",
    data: parametros,
    url: "res/php/updateReserva.php",
    success: function (datos) {
      $(location).attr("href", "reservasActivas");
    },
  });
}

function valorHabitacionUpd(tarifa) {
  var tipo = $("#tipohabiUpd").val();
  var hom = $("#hombresUpd").val();
  var muj = $("#mujeresUpd").val();
  var nin = $("#ninosUpd").val();
  let desde = $("#llegadaUpd").val();
  let hasta = $("#salidaUpd").val();

  let valtar = $("#valortarifaUpd").val();
  if (hom + muj == 0) {
    $("#mensaje").html(
      '<div class="alert alert-warning"><h3 class="tituloPagina">Sin Adultos Asignados a la Reserva</h3></div>'
    );
    $("#hombres").focus();
  } else {
    $("#mensaje").html("");
    var parametros = {
      tarifa,
      tipo,
      hom,
      muj,
      nin,
      desde,
      hasta,
    };
    $.ajax({
      url: "res/php/valorTarifa.php",
      type: "POST",
      data: parametros,
      success: function (data) {
        if ($.trim(data) === "-1") {
          swal({
            title: "Error!",
            text: "Sin Tarifa Asignada a Este Tipo de Habitacion \n Verifique las Fechas de la Reserva",
            type: "error",
            confirmButtonText: "Aceptar",
          });
          return;
        }
        $("#valortarifaUpd").val(data);
      },
    });
  }
}

function updateCompania() {
  var web = $("#rutaweb").val();
  let pagina = $("#ubicacion").val();
  let parametros = $("#formUpdateCompania").serialize();
  let creaRese = 0;
  $.ajax({
    type: "POST",
    data: parametros,
    url: "res/php/updateCompania.php",
    success: function (resp) {
      mensajeCrea(resp, "Compañia Actualizada", pagina, creaRese);
    },
  });
}

async function actualizaHuesped() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, usuario_id, tipo },
  } = sesion;

  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  // var parametros = $("#formUpdateHuesped").serialize();
  let creaRese = parseInt($("#creaReser").val());

  let formHuesped = document.querySelector("#formUpdateHuesped");
  let dataHuesp = new FormData(formHuesped);

  fechanace = dataHuesp.get("fechanace");

  const edad = await restaEdad(fechanace);

  dataHuesp.append("usuario", usuario);
  dataHuesp.append("usuario_id", usuario_id);
  dataHuesp.append("edad", parseInt(edad));

  $.ajax({
    type: "POST",
    data: dataHuesp,
    cache: false,
    contentType: false,
    processData: false,
    url: "res/php/updateHuesped.php",
    success: function (resp) {
      mensajeCrea(resp, "Huesped Actualizado", pagina, creaRese);
    },
  });
}

async function actualizaHuespedOld() {
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var parametros = $("#formUpdateHuesped").serialize();
  let creaRese = parseInt($("#creaReser").val());

  let formHuesped = document.querySelector("#formUpdateHuesped");
  let dataHuesp = new FormData(formHuesped);

  fechanace = dataHuesp.get("fechanace");

  const edad = await restaEdad(fechanace);
  dataHuesp.append("usuario", usuario);
  dataHuesp.append("usuario_id", usuario_id);
  dataHuesp.append("edad", parseInt(edad));

  const regis = await enviaPerfil(dataHuesp);
  await mensajeCrea(regis, "Huesped Actualizado", pagina, creaRese);
}

async function enviaPerfil(dataHuesp) {
  try {
    const resp = await fetch(`res/php/updateHuesped.php`, {
      method: "post",
      headers: {
        "Content-type": "application/json; charset=UTF-8",
      },
      body: dataHuesp,
    });
    const datos = await resp.json();
    return datos;
  } catch (error) {
    // console.log(error);
    return error;
  }
}

function actualizaCiaHuesped() {
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var idhues = $("#idHuespCia").val();
  var idcia = $("#companiaSele").val();
  var parametros = {
    idcia,
    idhues,
  };
  $.ajax({
    url: "res/php/updateCiaHuesped.php",
    type: "POST",
    data: parametros,
    success: function (datos) {
      $(location).attr("href", pagina);
    },
  });
}

function imprimirRegistro(reserva, causar) {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario },
  } = sesion;
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var parametros = {
    reserva,
    causar,
    usuario,
  };
  $.ajax({
    type: "POST",
    data: parametros,
    url: web + "res/php/imprimeRegistro.php",
    beforeSend: function (objeto) {},
    success: function (datos) {
      var ventana = window.open(datos, "PRINT", "height=600,width=600");
    },
  });
}

function anulaConsumos() {
  var web = $("#rutaweb").val();

  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, usuario_id },
  } = sesion;

  var id = $("#txtIdConsumoAnu").val();
  var motivo = $("#txtMotivoAnula").val();
  var reserva = $("#txtIdReservaAnu").val();
  var parametros = {
    id,
    motivo,
    usuario,
    usuario_id,
  };

  $.ajax({
    type: "POST",
    data: parametros,
    url: "res/php/anulaConsumos.php",
    success: function (data) {
      $("#mensajeCargo").html(
        '<h3 style="font-weight:600;color:brown">Cargo Anulado Con Exito</h3>'
      );
      $("#myModalAnulaCargo").modal("hide");
      activaFolio(reserva, 1);
    },
  });
}

function modificaReserva(reserva) {
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var parametros = { reserva };
  $.ajax({
    type: "POST",
    data: parametros,
    url: web + "res/php/modificaReserva.php",
    beforeSend: function (objeto) {},
    success: function (datos) {
      $("#registroHotelero").html(datos);
      $(location).attr("href", web + pagina);
    },
  });
}

function cargarHabitaciones() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, usuario_id },
  } = sesion;
  let web = $("#rutaweb").val();
  let pagina = $("#ubicacion").val();
  $("input:radio:checked").each(function () {
    cargo = $(this).val();
  });

  var cargar = $("#cargarHabitacion").val();
  var parametros = {
    cargar,
    cargo,
    usuario,
    usuario_id,
  };
  $.ajax({
    type: "POST",
    data: parametros,
    url: "res/php/cargarHabitaciones.php",
    success: function (datos) {
      if (datos == 1) {
        $("#aviso").html(
          '<div class="alert alert-info alert-function" style="margin-bottom: 1px"><h4 align="center" style="color:brown;font-weight: 700">Habitaciones Cargadas con Exito</h4></div>'
        );
      } else {
        $("#aviso").html(datos);
      }
    },
  });
}

async function cargarHabitacionCkeckIn(cargar) {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, usuario_id },
  } = sesion;
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  cargo = 1;
  var parametros = {
    cargar,
    cargo,
    usuario,
    usuario_id,
  };
  $.ajax({
    type: "POST",
    data: parametros,
    url: "res/php/cargarHabitaciones.php",
    success: function (datos) {
      if (datos == 1) {
        $("#aviso").html(
          '<div class="alert alert-info" style="margin-bottom: 30px"><h4 align="center" style="color:brown;font-weight: 700">Habitaciones Cargadas con Exito</h4></div>'
        );
      } else {
        $("#aviso").html(datos);
      }
    },
  });
}

function cambiaEstadoCargarHabitaciones(tipo) {
  if (tipo == 1) {
    $("#habitacionesCasa").css("display", "block");
    $("#cargarHabitacion").attr("required", true);
  } else {
    $("#habitacionesCasa").css("display", "none");
    $("#cargarHabitacion").attr("required", false);
    $("#cargarHabitacion").val("");
  }
}

function cargosHuesped(reserva) {
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var parametros = { reserva };
  $.ajax({
    type: "POST",
    url: web + "res/php/movimientosCargosHuespedModal.php",
    data: parametros,
    success: function (data) {
      $("#myModalSaldoHuesped").modal("show");
      $("#saldoHuesped").html(data);
    },
  });
}

async function salidaHuesped() {
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var saldo = $("#SaldoActual").val();
  var abonos = $("#totalPagos").val();
  let facturador = document.querySelector("#facturador").value;

  let perfilFac = 1;

  var tipofac = $(
    "input[name=habitacionOptionCon]:checked",
    "#guardarPagosRoomSal"
  ).val();

  if (tipofac == 0 || tipofac == undefined) {
    swal(
      "Precaucion",
      "Seleccione el Huesped o La Compañia a Facturar ",
      "warning"
    );
    return;
  }

  if (tipofac == 2 && perfilFac == 2) {
    swal(
      "Precaucion",
      "NO Puede Utilizar esa Forma de Pago para la presente Cuenta",
      "warning"
    );
    return;
  }

  var pago = $("#txtValorPago").val();
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, usuario_id, tipo },
  } = sesion;

  if (pago < saldo) {
    $("#mensajeSal").html(
      '<h4 align="center" class="bg-red" style="padding:10px"><span style="font-size:24px;font-weight: 700;font-family: ubuntu">El Valor Ingresado es menor al Saldo<br>Ingrese este valor por Abonos a Cuenta</span></h4>'
    );
    $("#cambio").css("display", "hide");
    $("#cambio").html("");
  } else {
    $("#mensaje").html("");
    if (pago > saldo) {
      cambio = pago - saldo;
      pago = saldo;
      $("#cambio").css("display", "block");
      $("#cambio").html(
        '<label for="txtValorConsumo" class="col-sm-4 control-label">Cambio / Vueltas</label><div class="col-sm-6"><input style="font-size: 19px;font-weight: 600;color:brown" class="form-control padInput" type="number" readonly value="' +
          cambio +
          '"></div>'
      );
    }

    let reserva = $("#reservaActual").val();
    let idhues = $("#titular").val();
    let room = $("#txtNumeroHabSal").val();
    let codigo = $("#codigoPago").val();
    let textopago = $("#codigoPago option:selected").text();
    let detalle = $("#txtDetallePag").val();
    let refer = $("#txtReferenciaPag").val();
    let correofac = $("#txtCorreoPag").val();
    let folioAct = $("#folioActivo").val();
    let idcia = $("#txtIdCiaSal").val();
    let baseIva = $("#totalIva").val();
    let baseRete = $("#baseRetenciones").val();
    let baseIca = $("#baseRetenciones").val();
    let reteiva = $("#totalReteiva").val();
    let reteica = $("#totalReteica").val();
    let sinBaseRete = $("#sinBaseRete").val();
    let retefuente = $("#totalRetefuente").val();
    let porceReteiva = $("#porceReteiva").val();
    let porceReteica = $("#porceReteica").val();
    let porceRetefuente = $("#porceRetefuente").val();

    estado = document.querySelector("#estadoCuenta");
    mensajeSal = document.querySelector("#mensajeSalida");
    btnSalida = document.querySelector(".btnSalida");
    estado.classList.add("apaga");
    mensajeSal.classList.remove("apaga");
    btnSalida.classList.add("apaga");

    if (detalle == "") {
      detalle = "";
    }
    if (refer == "") {
      refer = "";
    }
    if (correofac == "") {
      correofac = "";
    }

    var idcentro = 0;
    var parametros = {
      codigo,
      textopago,
      valor: pago,
      room,
      folioAct,
      idhues,
      reserva,
      tipofac,
      idcia,
      idcentro,
      usuario,
      usuario_id,
      perfilFac,
      detalle,
      refer,
      baseRete,
      baseIva,
      baseIca,
      reteiva,
      reteica,
      retefuente,
      porceReteiva,
      porceReteica,
      porceRetefuente,
      correofac,
    };

    let facturado = await enviaPago(parametros);
    let { error, mensaje, factura, perfil, errorDian, archivo, folio } =
      facturado[0];
    if (error == "1") {
      let muestra = await muestraError(mensaje);
    } else {
      if (facturador == 1) {
        ruta = "imprimir/facturas/";
      } else {
        ruta = "imprimir/notas/";
      }
      var ventana = window.open(
        ruta + archivo,
        "PRINT",
        "height=600,width=600"
      );

      if (folio == "0") {
        swal(
          {
            title: "Atencion !",
            text: "Salida del Huesped Realizada con Exito !",
            type: "success",
            confirmButtonText: "Aceptar",
            closeOnConfirm: true,
          },
          function () {
            $(location).attr("href", "facturacionEstadia");
          }
        );
      } else {
        swal(
          {
            title: "Precaucion !",
            text: "La Cuenta Actual Presenta Folios con Saldos !",
            type: "success",
            confirmButtonText: "Aceptar",
            closeOnConfirm: true,
          },
          function () {
            $("#myModalSalidaHuesped").modal("hide");
            activaFolio(reserva, folio);
          }
        );
      }
    }
  }
}

async function errorEnvio(cErrors) {
  let { statusText, status } = cErrors;
  swal({
    title: `Documento no Procesado`,
    text: `Error ${status} ${statusText}`,
    type: "warning",
    confirmButtonText: "Aceptar",
    closeOnConfirm: true,
  });
}

async function muestraError(cErrors) {
  // console.log(cErrors)
  let { string } = cErrors;
  let mensajeErr = "";
  if (typeof cErrors == "string") {
    mensajeErr += `<li class="justify">${cErrors}</li>`;
  } else {
    for (const campo in cErrors) {
      const errores = cErrors[campo];
      for (const error of errores) {
        mensajeErr += `<li class="justify">Campo: ${campo},  Error: ${error}</li>`;
      }
    }
  }

  let mensajeError = document.querySelector("#mensajeSalida");
  mensajeError.innerHTML = "";
  mensajeError.innerHTML = `<div class="alert alert-warning" style="margin-bottom:0px">
  <h3 style="color:black !important;margin-top:0px;">
  <i class="fa-solid fa-circle-exclamation fa-2x" style="color:red;"></i>
  ATENCION, Factura no Procesada </h3>
  
  <h4 style="color: brown;font-weight: 700;font-size: 20px;text-align:center;">MOTIVO DEL RECHAZO</h4>
  <ul>
    ${mensajeErr}
  </ul>`;
  return 0;
}

const enviaPago = async (data) => {
  var web = $("#rutaweb").val();
  try {
    const resultado = await fetch(`${web}res/php/ingresoPago.php`, {
      method: "POST",
      headers: {
        "Content-type": "application/json; charset=UTF-8",
      },
      body: JSON.stringify(data),
    });
    const datos = await resultado.json();
    return datos;
  } catch (error) {
    return error;
  }
};

const anulaFacturaEnvio = async (factura, perfil) => {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, usuario_id },
  } = sesion;

  data = {
    factura,
    perfil,
    usuario,
    usuario_id,
  };
  var web = $("#rutaweb").val();

  try {
    const resultado = await fetch(`${web}res/php/anulaFacturaEnvio.php`, {
      method: "POST",
      headers: {
        "Content-type": "application/json; charset=UTF-8",
      },
      body: JSON.stringify(data),
    });
    const datos = await resultado.json();
    return datos;
  } catch (error) {
    // console.log(error);
    return error;
  }
};

function imprimeFactura() {
  $.ajax({
    url: "imprimir/imprimeFactura.php",
    type: "POST",
    success: function (data) {
      imprime = $.trim(data);
      var ventana = window.open(
        "imprimir/facturas/" + imprime,
        "PRINT",
        "height=600,width=600"
      );
    },
  });
}

function saldoReserva(reserva) {
  parametros = {
    reserva,
  };
  $.ajax({
    type: "POST",
    data: parametros,
    url: "res/php/saldoReserva.php",
    success: function (saldo) {
      $("#saldoActual").val(saldo);
    },
  });
}

function guardaAgencia() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, usuario_id },
  } = sesion;

  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var parametros = $("#formAgencia").serializeArray();

  parametros.push({ name: "usuario", value: usuario });
  parametros.push({ name: "idusuario", value: usuario_id });
  $.ajax({
    type: "POST",
    data: parametros,
    url: "res/php/ingresoAgencia.php",
    beforeSend: function (objeto) {},
    success: function (datos) {
      $(location).attr("href", pagina);
    },
  });
}

function buscaAgenciaActiva(iden) {
  var parametros = { iden: iden };
  $.ajax({
    type: "POST",
    url: "res/php/buscaAgencia.php",
    data: parametros,
    success: function (data) {
      if (data == 1) {
        swal(
          "Identificacion ya registrada",
          "No Permitido Duplicar !",
          "warning"
        );
        $("#nit").focus();
        $("#nit").val("");
      }
    },
  });
}

function ImprimeEstadoCuenta(reserva) {
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var parametros = { reserva: reserva };
  $.ajax({
    type: "POST",
    data: parametros,
    url: web + "imprimir/imprimeEstadoCuenta.php",
    beforeSend: function (objeto) {
      $("#factura").html("Mensaje: Cargando ...");
    },
    success: function (datos) {},
  });
}

function estadoCuenta(reserva) {
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var parametros = { reserva: reserva };
  $.ajax({
    type: "POST",
    url: web + "res/php/saldoReserva.php",
    data: parametros,
    success: function (data) {
      if (data == 0) {
        swal("Atencion", "Sin Saldos en la Presente Cuenta", "warning");
      } else {
        $(location).attr("href", web + "paginas/saldoHuesped.php");
      }
    },
  });
}

function saldoTotal(reserva) {
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var parametros = { reserva };
  $.ajax({
    type: "POST",
    url: web + "res/php/movimientoReserva.php",
    data: parametros,
    success: function (data) {
      $("#saldoReserva").html(data);
    },
  });
}

function activaFolio(reserva, folio) {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, usuario_id, tipo },
  } = sesion;
  let web = $("#rutaweb").val();
  let pagina = $("#ubicacion").val();
  let nrohabi = $("#nrohabitacion").val();

  $(".folios").hide().removeClass("active").slideDown("fast");
  $(".folio").hide().removeClass("in active").slideDown("fast");
  $(".folio").css("display", "none");
  $("#folios" + folio)
    .hide()
    .addClass("active")
    .slideDown("fast");
  $("#folio" + folio)
    .hide()
    .addClass("in active")
    .slideDown("fast");
  $("#folio" + folio).css("display", "block");

  $("#folioActivo").val(folio);
  var parametros = {
    reserva,
    folio,
    nrohabi,
    tipo,
  };
  $.ajax({
    type: "POST",
    url: web + "res/php/movimientoFolio.php",
    data: parametros,
    success: function (data) {
      $(".saldoFolioRoom" + folio).html(data);
      if (tipo == 1) {
        $("#btnAnulaCargo").css("display", "block");
      }
    },
  });
}
function movimientosFactura(reserva) {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { tipo },
  } = sesion;
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var parametros = { reserva, tipo };
  $.ajax({
    type: "POST",
    url: web + "views/facturacionHuesped.php",
    data: parametros,
    success: function (data) {
      $("#listado").html("");
      $("#listado").html(data);
      if (tipo == 1) {
        btn = document.querySelector("#btnAjuste");
        btn.classList.remove("apaga");
      }
      activaFolio(reserva, 1);
    },
  });
}

function getCiudadesPais(pais, city) {
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var edita = $("#editaPer").val();
  if (edita == 1) {
    $("#ciudadUpd option").remove();
  } else {
    $("#ciudadHue option").remove();
  }

  var parametros = { pais };
  $("#loader").fadeIn("slow");
  $.ajax({
    type: "POST",
    url: web + "res/php/getCiudadesPais.php",
    data: parametros,
    success: function (data) {
      if (data == 0) {
        swal(
          "Precaucion",
          "No existen Ciudades Creados para este Pais",
          "warning"
        );
      } else {
        if (edita == 1) {
          $("#ciudadUpd").append(data);
          $("#ciudadUpd").val(city);
        } else {
          $("#ciudadHue").append(data);
        }
      }
    },
  });
}

function apagaEstado(tipo) {
  if (tipo === 8 || tipo === 9) {
  }
}

function toggleNacionalFields(documentTypeId, codiPais, edita) {
  // Selecciona todos los elementos con la clase 'nacional'
  documentTypeId = parseInt(documentTypeId);
  let depto;
  let pais;
  let tipo;
  let ciu;

  const nacionalFields = document.querySelectorAll(".nacional");
  if (edita === 0) {
    depto = document.querySelector("#depto");
    pais = document.querySelector("#paices");
    tipo = document.querySelector("#tipoEmpresaAdi");
    ciu = document.querySelector("#codigoCiiuAdi");
  } else {
    depto = document.querySelector("#deptoUpd");
    pais = document.querySelector("#paicesUpd");
    tipo = document.querySelector("#tipoEmpresaUpd");
    ciu = document.querySelector("#codigoCiiuUpd");
  }

  // Convierte el valor de string a número para la comparación
  const isPerson = documentTypeId === 8 || documentTypeId === 9;
  // Itera sobre los campos y los deshabilita si es una persona (CC o CE)
  nacionalFields.forEach((field) => {
    field.disabled = isPerson;
    // Para una mejor UX, también puedes cambiar el color de fondo para indicar que está deshabilitado
    if (isPerson) {
      field.classList.add("bg-gray-100");
    } else {
      field.classList.remove("bg-gray-100");
    }
  });
  if (depto != null) {
    depto.disabled = !isPerson;
    if (!isPerson) {
      depto.classList.add("bg-gray-100");
      depto.value = "";
      pais.value = codiPais;
    } else {
      depto.classList.remove("bg-gray-100");
      pais.disabled = false;
      tipo.value = "";
      ciu.value = "";
    }
  }
}

/**
 * Esta función maneja la lógica de cambio de estado del campo de crédito
 * Puedes agregar lógica adicional aquí si es necesario.
 * @param {string} value - El valor del radio button ('1' para Sí, '0' para No).
 */
function cambiaEstadoCredito(value) {
  // Lógica para el estado de crédito
  console.log(`Estado de crédito cambiado a: ${value === "1" ? "Sí" : "No"}`);
}

// Se ejecuta al cargar la página para establecer el estado inicial del formulario.
document.addEventListener("DOMContentLoaded", () => {
  // Dispara la función con el valor inicial del select
  initialDoc = document.querySelector("#tipodoc");
  if (initialDoc) {
    const initialDocType = initialDoc.value;
    toggleNacionalFields(initialDocType);
  }
});

function getCiudadesPaisUpd(pais) {
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var parametros = { pais: pais };
  $("#loader").fadeIn("slow");
  $.ajax({
    type: "POST",
    url: web + "res/php/getCiudadesPais.php",
    data: parametros,
    success: function (data) {
      if (data == 0) {
        swal(
          "Precaucion",
          "No existen Ciudades Creados para este Pais",
          "warning"
        );
      } else {
        $("#ciudadUpd option").remove();
        $("#ciudadUpd").append(data);
      }
    },
  });
}

function getCiudadesPaisAco(pais) {
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var parametros = { pais: pais };
  $("#loader").fadeIn("slow");
  $.ajax({
    type: "POST",
    url: web + "res/php/getCiudadesPais.php",
    data: parametros,
    success: function (data) {
      if (data == 0) {
        swal(
          "Precaucion",
          "No existen Ciudades Creados para este Pais",
          "warning"
        );
      } else {
        $("#ciudadHueAco option").remove();
        $("#ciudadHueAco").append(data);
      }
    },
  });
}

async function guardasinReserva() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, usuario_id },
  } = sesion;
  iden = $("#identifica").val();

  if (iden == "") {
    swal("Precaucion", "Seleccione el Huesped a Reservar", "warning");
    return;
  }
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  let reserva = document.querySelector("#formSinReserva");
  let formData = new FormData(reserva);

  document.querySelector("#btnRegistra").setAttribute("disabled", pagina);
  let idhuesped = formData.get("idhuesped");
  let idcia = formData.get("empresaUpd");

  formData.set("usuario", usuario);
  formData.set("usuario_id", usuario_id);

  let hErrors = await validaDatosHuesped(idhuesped);
  let cErrors = await validaDatosEmpresa(idcia);
  let nroRes = await ingresoSinReserva(formData);
  let cargo = await cargarHabitacionCkeckIn(nroRes.trim());

  cErrors = cErrors.concat(hErrors);
  mensajeErr = "Huesped Registrado Con Exito \n";

  if (cErrors.length > 0) {
    cErrors.map(function (error) {
      let { mensaje } = error;
      mensajeErr += mensaje + "\n";
    });
  }
  swal(
    {
      title: mensajeErr,
      type: "success",
      confirmButtonText: "Aceptar",
      closeOnConfirm: true,
    },
    function () {
      $(location).attr("href", "home");
    }
  );
}

async function ingresoSinReserva(data) {
  try {
    const resultado = await fetch("res/php/ingresoSinReserva.php", {
      method: "POST",
      body: data,
    });
    const datos = await resultado.text();
    return datos;
  } catch (error) {}
}

async function validaDatosHuesped(id) {
  data = { id };
  try {
    const resultado = await fetch("res/php/validaDatosHuesped.php", {
      method: "post",
      headers: {
        "Content-type": "application/json; charset=UTF-8",
      },
      body: JSON.stringify(data),
    });
    const datos = await resultado.json();
    return datos;
  } catch (error) {}
}

async function validaDatosEmpresa(id) {
  data = { id };
  try {
    const resultado = await fetch("res/php/validaDatosEmpresa.php", {
      method: "POST",
      headers: {
        "Content-type": "application/json; charset=UTF-8",
      },
      body: JSON.stringify(data),
    });
    const datos = await resultado.json();
    return datos;
  } catch (error) {}
}

function restaFechasOld() {
  let llega;
  let sale;
  let noches;
  let edita = document.querySelector("#editaRes").value;
  if (edita == 1) {
    llega = document.querySelector("#llegadaUpd").value;
    sale = document.querySelector("#salidaUpd").value;
  } else {
    llega = document.querySelector("#llegada").value;
    sale = document.querySelector("#salida").value;
  }

  let llegada = new Date(llega).getTime();
  let salida = new Date(sale).getTime();

  noches = (salida - llegada) / (1000 * 60 * 60 * 24);

  if (edita == 1) {
    document.querySelector("#nochesUpd").value = noches;
  } else {
    document.querySelector("#noches").value = noches;
  }
}

function sumaFechaOld() {
  let fecha;
  let dias;
  let edita = document.querySelector("#editaRes").value;

  if (edita == 1) {
    fecha = new Date(document.querySelector("#llegadaUpd").value + " 12:00:00");
    dias = parseInt(document.querySelector("#nochesUpd").value);
  } else {
    fecha = new Date(document.querySelector("#llegada").value + " 12:00:00");
    dias = parseInt(document.querySelector("#noches").value);
  }

  fecfin = new Date(fecha.setDate(fecha.getDate() + dias));

  let yyyy = fecfin.getFullYear();
  let mm = fecfin.getMonth() + 1;
  let dd = fecfin.getDate();
  vence =
    yyyy +
    "-" +
    mm.toString().padStart(2, "0") +
    "-" +
    dd.toString().padStart(2, "0");

  if (edita == 1) {
    document.querySelector("#salidaUpd").value = vence;
  } else {
    document.querySelector("#salida").value = vence;
  }
}

function sumarDias() {
  var web = $("#webPage").val();
  var pagina = $("#ubicacion").val();
  var edita = $("#editaRes").val();

  if (edita == 1) {
    var fecha = $("#llegadaUpd").val();
    var dias = $("#nochesUpd").val();
  } else {
    var fecha = $("#llegada").val();
    var dias = $("#noches").val();
  }
  var parametros = { fecha, dias };

  $.ajax({
    type: "POST",
    url: web + "res/php/sumaFecha.php",
    data: parametros,
    success: function (data) {
      if (edita == 1) {
        $("#salidaUpd").val(data);
      } else {
        $("#salida").val(data);
      }
    },
  });
}

function asignaHuesped(reserva) {
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var textcodigo = $("#txtIdReservaCon option:selected").text();
  var parametros = { reserva: reserva };
  $.ajax({
    type: "POST",
    url: web + "res/php/buscaReservaHuespedCargos.php",
    data: parametros,
    success: function (data) {
      $("#datosHuesped").html(data);
    },
  });
}

function ingresaAbonos() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, usuario_id },
  } = sesion;
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var codigo = $("#codigoAbono").val();
  var textcodigo = $("#codigoAbono option:selected").text();
  var valor = $("#txtValorAbono").val();
  var refer = $("#txtReferenciaAbo").val();
  var detalle = $("#txtDetalleAbo").val();
  var numero = $("#txtIdReservaAbo").val();
  var idhues = $("#idHuespedAbo").val();
  var room = $("#txtNumeroHabAbo").val();

  if (valor == 0) {
    swal({
      title: "Atencion",
      text: "Cargo Sin Valor, No es posible Registrarlo",
      type: "warning",
      confirmButtonText: "Aceptar",
      closeOnConfirm: false,
    });
    return;
  }

  var parametros = {
    codigo,
    textcodigo,
    valor,
    refer,
    detalle,
    numero,
    room,
    idhues,
    usuario,
    usuario_id,
  };
  $.ajax({
    type: "POST",
    url: web + "res/php/ingresoAbonos.php",
    data: parametros,
    success: function (data) {
      var ventana = window.open(
        "imprimir/notas/Abono_" + data.trim() + ".pdf",
        "PRINT",
        "height=600,width=600"
      );
      $("#myModalAbonosConsumos").modal("hide");
      movimientosFactura(numero);
    },
  });
}

function ingresaConsumos() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, usuario_id },
  } = sesion;
  var congela = $("#cuentaCongelada").val();
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var ingreso = $("#ingreso").val();
  var codigo = $("#codigoConsumo").val();
  var textcodigo = $("#codigoConsumo option:selected").text();
  var canti = $("#txtCantidad").val();
  var valor = $("#txtValorConsumo").val();
  var refer = $("#txtReferencia").val();
  var folio = $("#txtFolio").val();
  var detalle = $("#txtDetalleCargo").val();
  var numero = $("#reservaActual").val();
  var idhues = $("#idHuespedSal").val();
  var room = $("#txtNumeroHabCon").val();
  var turismo = $("#txtImptoTurismo").val();

  if (valor == 0) {
    swal({
      title: "Atencion",
      text: "Cargo Sin Valor, No es posible Registrarlo",
      type: "warning",
      confirmButtonText: "Aceptar",
      closeOnConfirm: false,
    });
    return;
  }

  var parametros = {
    codigo,
    textcodigo,
    canti,
    valor,
    refer,
    folio,
    detalle,
    numero,
    idhues,
    room,
    turismo,
    usuario,
    usuario_id,
  };
  $.ajax({
    type: "POST",
    url: web + "res/php/ingresoConsumo.php",
    data: parametros,
    success: function (data) {
      if (data == 0) {
        $("#mensaje").html(
          '<div class="alert alert-warning"><h3>No se pudo ingresar el consumo</h3></div>'
        );
      } else {
        $("#mensaje").html(
          '<div class="alert alert-warning centro m0"><h3 class="mt-10">Ingreso Realizado con Exito</h3></div>'
        );
      }
      if (ingreso == 1) {
        $(location).attr("href", pagina);
      } else {
        $("#myModalCargosConsumo").modal("hide");
        if (congela == 1) {
          activaCongelado(numero, 1);
        } else {
          movimientosFactura(numero);
        }
      }
    },
  });
}

function ingresaReserva() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, usuario_id },
  } = sesion;
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var numero = $("#numeroReserva").val();
  var habita = $("#txtNumeroHabIng").val();
  let placa = $("#placavehiculo").val();
  let equipaje = $("#equipaje").val();
  let transporte = $("#transporte").val();

  var parametros = $("#formIngreso").serializeArray();
  parametros.push({ name: "usuario", value: usuario });
  parametros.push({ name: "idusuario", value: usuario_id });

  $.ajax({
    type: "POST",
    url: "res/php/ingresaReserva.php",
    data: parametros,
    success: function (data) {
      if (data == 1) {
        cargarHabitacionCkeckIn(numero);
        swal(
          {
            title: "Atencion!",
            text: "Su Reserva a Sido ingresada con Exito",
            type: "success",
            confirmButtonText: "Aceptar",
            closeOnConfirm: true,
          },
          function () {
            $(location).attr("href", "llegadasDelDia");
          }
        );
      } else {
        swal("Precaucion !", "Su Reserva no se pudo ingresar", "warning");
        $(location).attr("href", "llegadasDelDia");
      }
    },
  });
}

function imprimeDeposito(web, numero, pagina) {
  $.ajax({
    url: web + "paginas/imprimeDeposito.php",
    type: "POST",
    data: { numero },
  }).done(function (data) {
    var ventana = window.open(
      "imprimir/notas/" + data,
      "PRINT",
      "height=600,width=600"
    );
  });
}

function cancelaReserva() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, usuario_id },
  } = sesion;
  var pagina = $("#ubicacion").val();
  var motivo = $("#motivoCancela").val();
  var numero = $("#txtIdReservaCan").val();
  var observa = $("#areaObservacionesCan").val();
  var parametros = {
    motivo,
    observa,
    numero,
    usuario_id,
    usuario,
  };
  $.ajax({
    type: "POST",
    url: "res/php/cancelaReserva.php",
    data: parametros,
    success: function (data) {
      data = JSON.parse(data);
      let { anula, cancela } = data;

      if (cancela == 0) {
        titulo = "Precaucion !! ";
        mensaje = "Su Reserva no se pudo cancelar ";
        alerta = "warning";
      }
      if (cancela == 1) {
        titulo = "Atencion";
        mensaje = "Reserva Cancelada con Exito ";
        alerta = "warning";
      }
      if (anula == 1) {
        mensaje = mensaje + " y su Deposito Anulado";
      }
      swal(
        {
          title: titulo,
          text: mensaje,
          type: alerta,
        },
        function () {
          $(location).attr("href", pagina);
        }
      );
    },
  });
}

function buscaCompaniaActiva(iden) {
  var parametros = { iden: iden };
  $.ajax({
    type: "POST",
    url: "res/php/buscaCompania.php",
    data: parametros,
    success: function (data) {
      if (data == 1) {
        swal(
          "Identificacion ya registrada",
          "No Permitido Duplicar !",
          "warning"
        );
        $("#nit").focus();
        $("#nit").val("");
      }
    },
  });
}

function guardaCompania() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, usuario_id },
  } = sesion;
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var parametros = $("#formCompania").serializeArray();

  parametros.push({ name: "usuario", value: usuario });
  parametros.push({ name: "idusuario", value: usuario_id });

  $.ajax({
    type: "POST",
    data: parametros,
    url: "res/php/ingresoCompania.php",
    success: function (resp) {
      respo = JSON.parse(resp);
      if (respo.id === "0") {
        swal({
          title: "Error!",
          text: respo.error,
          type: "error",
          confirmButtonText: "Aceptar",
        });
      } else {
        $(location).attr("href", pagina);
      }
    },
  });
}

function buscaHuespedActivo(iden) {
  var parametros = { iden: iden };
  $.ajax({
    type: "POST",
    url: "res/php/buscaHuesped.php",
    data: parametros,
    success: function (data) {
      if (data == 1) {
        $("#identifica").val("");
        $("#identifica").focus();
        swal(
          "Identificacion ya registrada",
          "No Permitido Duplicar !",
          "warning"
        );
      }
    },
  });
}

function buscaHuesped(id) {
  var parametros = { id };
  web = $("#webPage").val();
  $.ajax({
    type: "POST",
    url: web + "res/php/seleccionaHuesped.php",
    data: parametros,
    beforeSend: function (objeto) {},
    success: function (data) {
      if (data == 0) {
        swal({
          title: "Error!",
          text: "Huesped No Encontrado",
          type: "error",
          confirmButtonText: "Aceptar",
        });
      } else {
        $("#datoshuesped").html(data);
      }
    },
  });
}

async function habitacionesDisponibles(estado) {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    moduloPms: { fecha_auditoria },
  } = sesion;
  let llega = estado == 1 ? $("#llegada").val() : $("#llegadaUpd").val();
  let sale = estado == 1 ? $("#salida").val() : $("#salidaUpd").val();
  let tipo = estado == 1 ? $("#tipohabi").val() : $("#tipohabiUpd").val();

  var parametros = {
    llega,
    sale,
    tipo,
  };

  let habitacionesDisp = await traeHabitacionesDisp(parametros);
  let habitacionMmto = await traeHabitacionesMmto(parametros);
  let suciasDia = await traeHabitacionesSucias(parametros);
  let reservasActuales = await traeReservasActuales(parametros);

  habitacionesDisp = habitacionesDisp.filter(
    (numero_hab) => !habitacionMmto.includes(numero_hab)
  );

  if (llega <= fecha_auditoria) {
    for (let sucia of suciasDia) {
      habitacionesDisp = habitacionesDisp.filter(
        (habitacion) => habitacion.numero_hab !== sucia.numero_hab
      );
    }
  }

  for (let reserva of reservasActuales) {
    if (
      (llega >= reserva.fecha_llegada && llega < reserva.fecha_salida) ||
      (sale > reserva.fecha_llegada && sale <= reserva.fecha_salida) ||
      (llega <= reserva.fecha_llegada && sale >= reserva.fecha_salida)
    ) {
      habitacionesDisp = habitacionesDisp.filter(
        (habitacion) => habitacion.numero_hab !== reserva.num_habitacion
      );
    }
  }

  const limpia = await limpiaSelect(estado);
  const sele = await llegaHabitacionesSele(habitacionesDisp, estado);
}

async function llegaHabitacionesSele(habitaciones, estado) {
  let selectElement;
  if (estado == 1) {
    selectElement = document.getElementById("nrohabitacion");
  } else {
    selectElement = document.getElementById("nrohabitacionUpd");
    selectElement.removeAttribute("disabled");
  }
  habitaciones.map((item) => {
    const optionElement = document.createElement("option");
    optionElement.value = item.numero_hab;
    optionElement.text = item.numero_hab;
    selectElement.add(optionElement);
  });
}

function limpiaSelect(estado) {
  let selectElement;
  if (estado == 1) {
    selectElement = document.getElementById("nrohabitacion");
  } else {
    selectElement = document.getElementById("nrohabitacionUpd");
  }
  while (selectElement.firstChild) {
    selectElement.removeChild(selectElement.firstChild);
  }
}

async function traeHabitacionesDisp(data) {
  try {
    const resultado = await fetch("res/php/traeHabitacionesDisp.php", {
      method: "POST",
      headers: {
        "Content-type": "application/json; charset=UTF-8",
      },
      body: JSON.stringify(data),
    });
    const datos = await resultado.json();
    return datos;
  } catch (error) {}
}

async function traeHabitacionesMmto(data) {
  try {
    const resultado = await fetch("res/php/traeHabitacionesMmto.php", {
      method: "POST",
      headers: {
        "Content-type": "application/json; charset=UTF-8",
      },
      body: JSON.stringify(data),
    });
    const datos = await resultado.json();
    return datos;
  } catch (error) {}
}

async function traeHabitacionesSucias(data) {
  try {
    const resultado = await fetch("res/php/traeHabitacionesSucias.php", {
      method: "POST",
      headers: {
        "Content-type": "application/json; charset=UTF-8",
      },
      body: JSON.stringify(data),
    });
    const datos = await resultado.json();
    return datos;
  } catch (error) {}
}

async function traeReservasActuales(data) {
  try {
    const resultado = await fetch("res/php/traeReservasActuales.php", {
      method: "POST",
      headers: {
        "Content-type": "application/json; charset=UTF-8",
      },
      body: JSON.stringify(data),
    });
    const datos = await resultado.json();
    return datos;
  } catch (error) {}
}

function seleccionaHabitacion() {
  var llega = $("#llegada").val();
  var sale = $("#salida").val();
  var tipo = $("#tipohabi").val();
  var parametros = {
    llega,
    sale,
    tipo,
  };
  $.ajax({
    type: "POST",
    url: "res/php/seleccionaTipoHabitacion.php",
    data: parametros,
    success: function (data) {
      $("#nrohabitacion option").remove();
      $("#nrohabitacion").append(data);
      $("#nrohabitacion").focus();
    },
  });
}

function seleccionaDormitorio() {
  var tipo = $("#tipohabi").val();
  var sexo = $("#sexo").val();
  var parametros = { tipo: tipo };
  if (sexo == 1) {
    hom = 1;
    muj = 0;
  } else {
    hom = 0;
    muj = 1;
  }
  $("#hombres").val(hom);
  $("#mujeres").val(muj);

  $.ajax({
    type: "POST",
    url: "res/php/seleccionaDormitorio.php",
    data: parametros,
    beforeSend: function (objeto) {},
    success: function (data) {
      $("#habitaciones").html(data);
    },
  });
}

function selDormitorio(tipo) {
  var sexo = $("#sexo").val();
  var tarifa = $("tarifahab").val();
  if (tipo == 2) {
    $("#hombres").attr("readonly", "readonly");
    $("#mujeres").attr("readonly", "readonly");
    $("#ninos").attr("readonly", "readonly");
  } else {
    $("#hombres").removeAttr("readonly", "");
    $("#mujeres").removeAttr("readonly", "");
    $("#ninos").removeAttr("readonly", "");
  }
  if (sexo == 1) {
    hom = 1;
    muj = 0;
  } else {
    hom = 0;
    muj = 1;
  }
  $("#hombres").val(hom);
  $("#mujeres").val(muj);
}

function selHabitacion() {
  hom = 0;
  muj = 0;
  $("#hombres").val(hom);
  $("#mujeres").val(muj);
}

function seleccionaTarifas() {
  var tipo = $("#tipohabi").val();
  var llega = $("#llegada").val();
  var sale = $("#salida").val();
  var parametros = { tipo, llega, sale };
  $.ajax({
    type: "POST",
    url: "res/php/seleccionaTarifas.php",
    data: parametros,
    beforeSend: function (objeto) {},
    success: function (data) {
      $("#tarifahab option").remove();
      $("#tarifahab").html(data);
    },
  });
}

function valorHabitacion(tarifa) {
  // console.log(tarifa)
  let tipo = $("#tipohabi").val();
  // console.log(`Tipo de Habitacion ${tipo}`);
  let hom = $("#hombres").val();
  let muj = $("#mujeres").val();
  let nin = $("#ninos").val();
  let desde = $("#llegada").val();
  let hasta = $("#salida").val();

  if (tipo == "") {
    swal("Precaucion", "Tipo de Habitacion no Asignado", "warning");
    return;
  }

  if (hom + muj == 0 && tipo > 1) {
    swal({
      title: "Error!",
      text: "Sin Adultos en esta Reserva",
      type: "error",
      confirmButtonText: "Aceptar",
    });
    $("#hombres").focus();
    return;
  }
  var parametros = {
    tarifa,
    tipo,
    hom,
    muj,
    nin,
    desde,
    hasta,
  };
  $.ajax({
    url: "res/php/valorTarifa.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      if ($.trim(data) === "-1") {
        swal({
          title: "Error!",
          text: "Sin Tarifa Asignada a Este Tipo de Habitacion \n Verifique las Fechas de la Reserva",
          type: "error",
          confirmButtonText: "Aceptar",
        });
        return;
      }
      $("#valortar").val(data);
      $("#valortar").focus();
    },
  });
}

async function guardaReserva() {
  iden = $("#identifica").val();
  if (iden == "") {
    swal("Precaucion", "Seleccione el Huesped a Reservar", "warning");
    return;
  }
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, usuario_id },
  } = sesion;
  // let  = user;
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var parametros = $("#formReservas").serializeArray();

  parametros.push({ name: "usuario", value: usuario });
  parametros.push({ name: "idusuario", value: usuario_id });

  $.ajax({
    type: "POST",
    data: parametros,
    url: "res/php/ingresoReserva.php",
    success: function (datos) {
      confirmarReserva(datos);
      swal(
        {
          title: "Atencion",
          type: "success",
          confirmButtonText: "Aceptar",
          text: `Reserva ${datos} Creada con Exito`,
        },
        function () {
          $(location).attr("href", "reservasActivas");
        }
      );
    },
  });
}

function printMe(el) {
  var objeto = document.getElementById(el); //obtenemos el objeto a imprimir
  var ventana = window.open("", "_blank"); //abrimos una ventana vacía nueva
  objeto.style.marginRight = "0";
  objeto.style.marginTop = "0";
  objeto.style.marginLeft = "0";
  objeto.style.marginBottom = "0";
  ventana.document.write(objeto.innerHTML); //imprimimos el HTML del objeto en la nueva ventana

  ventana.document.close(); //cerramos el documento
  ventana.print(); //imprimimos la ventana
  ventana.close(); //cerramos la ventana
}

function imprimir_factura(id_factura) {
  VentanaCentrada(
    "./pdf/documentos/ver_factura.php?id_factura=" + id_factura,
    "Factura",
    "",
    "1024",
    "768",
    "true"
  );
}

function imprimirReserva() {
  VentanaCentrada(
    "res/pdf/documentos/verReservas.php",
    "Reservas Activas",
    "",
    "1024",
    "768",
    "true"
  );
}

function VentanaCentrada(
  theURL,
  winName,
  features,
  myWidth,
  myHeight,
  isCenter
) {
  //v3.0
  if (window.screen)
    if (isCenter)
      if (isCenter == "true") {
        var myLeft = (screen.width - myWidth) / 2;
        var myTop = (screen.height - myHeight) / 2;
        features += features != "" ? "," : "";
        features += ",left=" + myLeft + ",top=" + myTop;
      }
  window.open(
    theURL,
    winName,
    features +
      (features != "" ? "," : "") +
      "width=" +
      myWidth +
      ",height=" +
      myHeight
  );
}

function cambiaEstadoCredito(id) {
  if (id == 1) {
    $("#estadocredito").css("display", "block");
  } else {
    $("#estadocredito").css("display", "none");
  }
}

function cambiaEstadoCreditoUpd(id) {
  if (id == 1) {
    $("#estadocreditoUpd").css("display", "block");
  } else {
    $("#estadocreditoUpd").css("display", "none");
  }
}

function calcularDigitoVerificacion() {
  var myNit = $("#nit").val();
  var vpri, x, y, z;
  // Se limpia el Nit
  myNit = myNit.replace(/\s/g, ""); // Espacios
  myNit = myNit.replace(/,/g, ""); // Comas
  myNit = myNit.replace(/\./g, ""); // Puntos
  myNit = myNit.replace(/-/g, ""); // Guiones

  // Se valida el nit
  if (isNaN(myNit)) {
    // console.log("El nit/cédula '" + myNit + "' no es válido(a).");
    return "";
  }

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
    y = myNit.substr(i, 1);
    // console.log ( y + "x" + vpri[z-i] + ":" ) ;

    x += y * vpri[z - i];
    // console.log ( x ) ;
  }

  y = x % 11;
  // console.log ( y ) ;

  dig = y > 1 ? 11 - y : y;

  $("#dv").val(dig);
}

function filePreview(input) {
  var fileList = input.files;
  var anyWindow = window.URL || window.webkitURL;
  for (var i = 0; i < fileList.length; i++) {
    var objectUrl = anyWindow.createObjectURL(fileList[i]);
    var tipo = fileList[i].type;
    var name = fileList[i].name;
    if (tipo == "application/pdf") {
      $("#form_fotos").append(
        "<div class='col-md-6' style='padding:0 15px'> <object style='width:100%;overflow:hidden' data='" +
          objectUrl +
          "'></object><div class='row-fluid'><button style='padding: 2px 10px;' class='btn btn-danger'><i class='fa fa-trash'></i></button></div></div>"
      );
    } else {
      $("#form_fotos").append(
        "<div class='col-md-4' style='margin:10px 0 10px 0;padding:0'><img style='max-height:100px;margin:0;overflow:hidden' class='uploaded_foto img-thumbnail' src='" +
          objectUrl +
          "'/><div class='row-fluid'> <button style='margin-top: 5px;' class='btn btn-danger'><i class='fa fa-trash'></i></button></div></div>"
      );
    }
    window.URL.revokeObjectURL(fileList[i]);
  }
}

async function reservasPorFecha() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, usuario_id },
  } = sesion;
  var web = $("#rutaweb").val();
  desdeFe = $("#desdeFecha").val();
  hastaFe = $("#hastaFecha").val();
  huesped = $("#desdeHuesped").val();
  parametros = {
    desdeFe,
    hastaFe,
    huesped,
    usuario,
    usuario_id,
  };

  if (desdeFe == "" && hastaFe == "" && huesped == "" && empresa == "") {
    swal("Atencion", "Seleccione un Criterio de Busqueda", "warning");
  } else {
    $.ajax({
      url: web + "res/php/reservasPorRango.php",
      type: "POST",
      data: parametros,
      success: function (x) {
        $("#imprimeInforme").html(x);
        setTimeout(
          muestraDataTable("#example1"), 500
        )
      },
    });
  }
}

function verCargosFacturaHistorico(numero, reserva) {
  huesped = $("#txtIdHuespedHis").val();
  $.ajax({
    url: "res/php/buscaCargosHistoricoFactura.php",
    type: "POST",
    data: {
      numero,
      reserva,
    },
    beforeSend: function (objeto) {
      $("#verFactura").html('<div><img src="" alt="" /></div>');
    },
    success: function (data) {
      $("#muestraFactura").attr("data", "");
      $("#muestraFactura").html("");
      $("#muestraFactura").html(data);
    },
  });
}

function muestraId(id) {}

function imprimechequeCuenta(numero) {
  var cheque = "../pos/impresiones/ChequeCuenta_" + numero + ".pdf";
  var ventana = window.open(cheque, "PRINT", "height=600,width=600");
}

function ingresaDeposito() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, usuario_id },
  } = sesion;

  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var formData = new FormData($("#formDepositoReserva")[0]);
  id = $("#txtIdHuespedDep").val();
  var textforma = $("#formadePago option:selected").text();

  formData.append("id", id);
  formData.append("textforma", textforma);
  formData.append("usuario", usuario);
  formData.append("idusuario", usuario_id);

  $.ajax({
    url: "res/php/ingresoDeposito.php",
    type: "post",
    data: formData,
    contentType: false,
    processData: false,
    success: function (datos) {
      datos = $.trim(datos);
      var ventana = window.open(
        `imprimir/notas/Abono_${datos}.pdf`,
        "PRINT",
        "height=600,width=600"
      );
      document.querySelector("#btnDeposito").click();
    },
  });
}

function subirArchivosCia() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario_id },
  } = sesion;

  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var formData = new FormData($("#uploadFiles")[0]);

  id = $("#txtIdCiaUpl").val();

  formData.append("id", id);
  formData.append("idusr", usuario_id);

  $.ajax({
    url: "res/php/uploadCia.php",
    type: "post",
    data: formData,
    contentType: false,
    processData: false,
    success: function (response) {
      $(location).attr("href", pagina);
    },
  });
}

function ciudadesExpedicion(pais, city) {
  let web = $("#rutaweb").val();
  let edita = parseInt($("#editaPer").val());
  let acompana = parseInt($("#acompana").val());
  let parametros = { pais };

  $("#loader").fadeIn("slow");
  $.ajax({
    type: "POST",
    url: web + "res/php/getCiudadesPais.php",
    data: parametros,
    success: function (resp) {
      if (resp == 0) {
        swal(
          "Precaucion",
          "No existen Ciudades Creados para este Pais",
          "warning"
        );
      } else {
        if (edita == 1) {
          $("#ciudadExpUpd option").remove();
          $("#ciudadExpUpd").append(resp);
          $("#ciudadExpUpd").val(city);
        } else {
          if (acompana == 1) {
            $("#ciudadExpAco option").remove();
            $("#ciudadExpAco").append(resp);
          } else {
            $("#ciudadExp option").remove();
            $("#ciudadExp").append(resp.trim());
          }
        }
      }
    },
  });
}

function imprimirHistoricoRegistro(registro) {
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  if (registro == 0) {
    swal(
      {
        title: "Precaucion!",
        text: "Registro Hotelero no Impreso",
        type: "error",
        confirmButtonText: "Aceptar",
      },
      function () {}
    );
  } else {
    $("#myModalverRegistroHotelero").modal("show");
    $("#verRegistroHotelero").attr(
      "data",
      "imprimir/registros/Registro_Hotelero_" +
        registro.padStart(5, "0") +
        ".pdf"
    );
  }
}

function imprimirPreRegistro(reserva) {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario },
  } = sesion;
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var parametros = {
    reserva,
    usuario,
  };
  $.ajax({
    type: "POST",
    data: parametros,
    url: web + "imprimir/imprimePreRegistroHotelero.php",
    beforeSend: function (objeto) {},
    success: function (datos) {
      var ventana = window.open(
        "imprimir/registros/" + $.trim(datos),
        "PRINT",
        "height=600,width=600"
      );
    },
  });
}

function confirmarReserva(reserva) {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario },
  } = sesion;

  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  reserva = $.trim(reserva);
  var parametros = {
    reserva,
    usuario,
  };
  $.ajax({
    type: "POST",
    data: parametros,
    url: web + "imprimir/confirmaReserva.php",
    success: function (datos) {
      var ventana = window.open(
        "imprimir/" + $.trim(datos),
        "PRINT",
        "height=600,width=600"
      );
    },
  });
}

function imprimirOrdenM(orden) {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario },
  } = sesion;
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var parametros = {
    orden,
    usuario,
  };
  $.ajax({
    type: "POST",
    data: parametros,
    url: web + "res/php/imprimeOrden.php",
    beforeSend: function (objeto) {},
    success: function (datos) {
      $("#imprimeMantenimiento").html(datos);
      $(location).attr("href", pagina);
    },
  });
}

function terminaMmto() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, usuario_id },
  } = sesion;
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var costo = $("#costoMmto").val();
  var id = $("#idMmtoTer").val();
  var room = $("#numroom").val();

  $.ajax({
    url: web + "res/php/terminaMmto.php",
    type: "POST",
    data: {
      id,
      costo,
      room,
      usuario,
      usuario_id,
    },
    success: function () {
      $(location).attr("href", pagina);
    },
  });
}

function adicionaObservacionMmto() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, usuario_id },
  } = sesion;

  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var id = $("#idObsMto").val();
  var ante = $("#observaAntMto").val();
  var obse = $("#adicionaObsMto").val();

  parametros = {
    id,
    obse,
    ante,
    usuario,
  };
  $.ajax({
    url: "res/php/adicionaObservacionMmto.php",
    type: "POST",
    data: parametros,
    success: function () {
      $(location).attr("href", pagina);
    },
  });
}

function cambiaFecha() {
  fechanu = $("#desdeFechaAdi").val();
  $("#hastaFechaAdi").val(fechanu);
  $("#hastaFechaAdi").prop("min", fechanu);
}

function fechaReservasStr() {
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();

  $.ajax({
    type: "POST",
    url: "res/php/updateFechaReserva.php",
    success: function (datos) {
      $(location).attr("href", pagina);
    },
  });
}

function guardaMantenimiento() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, usuario_id },
  } = sesion;

  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var roomNroAdi = $("#roomAdi option:selected").text();
  var parametros = $("#formAdicionaMantenimiento").serializeArray();

  parametros.push({ name: "usuario", value: usuario });
  parametros.push({ name: "roomNroAdi", value: roomNroAdi });

  $.ajax({
    type: "POST",
    datatype: "JSON",
    data: parametros,
    url: "res/php/guardaMantenimiento.php",
    success: function (datos) {
      var ventana = window.open(
        "imprimir/mmtos/" + $.trim(datos),
        "PRINT",
        "height=600,width=600"
      );
      $(location).attr("href", pagina);
    },
  });
}

function entregaObjeto() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, usuario_id },
  } = sesion;

  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var parametros = $("#entregaObjetoOlvidado").serializeArray();

  parametros.push({ name: "idusuario", value: idusuario });
  parametros.push({ name: "usuario", value: usuario });

  $.ajax({
    type: "POST",
    data: parametros,
    url: "res/php/entregaObjeto.php",
    success: function (datos) {
      $(location).attr("href", pagina);
    },
  });
}

function adicionaObservacionObjeto() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario },
  } = sesion;
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var id = $("#objetoObs").val();
  var ante = $("#observaAntObj").val();
  var obse = $("#objetoObsObj").val();

  parametros = {
    id,
    obse,
    ante,
    usuario,
  };
  $.ajax({
    url: "res/php/adicionaObservacionObjeto.php",
    type: "POST",
    data: parametros,
    success: function () {
      $(location).attr("href", pagina);
    },
  });
}

function guardaObjeto() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, usuario_id },
  } = sesion;
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var parametros = $("#formAdicionaObjetos").serializeArray();

  parametros.push({ name: "idusuario", value: usuario_id });
  parametros.push({ name: "usuario", value: usuario });

  $.ajax({
    type: "POST",
    data: parametros,
    url: "res/php/guardaObjeto.php",
    success: function (datos) {
      $(location).attr("href", pagina);
    },
  });
}

async function cambiaEstadoAseo(habi, ocupada, sucia, estado) {
  if (estado == 0) {
    actual = "bg-limpia";
  } else {
    actual = "bg-sucia";
  }

  if (sucia == 0) {
    color = "bg-limpia";
    categ = "limpias";
  } else {
    color = "bg-sucia";
    categ = "sucias";
  }

  $.ajax({
    url: "res/php/cambiaEstadoAseoHabitacion.php",
    type: "POST",
    data: {
      habi,
      sucia,
    },
    success: function () {
      $("#" + habi).removeClass(actual);
      $("#" + habi).addClass(color);
      sucia == 1
        ? $("#" + habi).attr("category", "sucias")
        : $("#" + habi).attr("category", "limpias");
    },
  });
}

function cambiaEstadoHK(habi, estado, cambio) {
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  $.ajax({
    url: "res/php/cambiaEstadoHabitacion.php",
    type: "POST",
    data: {
      habi,
      cambio,
      estado,
    },
    success: function () {
      $(location).attr("href", "hk.php");
    },
  });
}

function facturasPorImpuesto() {
  var web = $("#rutaweb").val();
  desdeFe = $("#desdeFecha").val();
  hastaFe = $("#hastaFecha").val();
  desdeNu = $("#desdeNumero").val();
  hastaNu = $("#hastaNumero").val();
  huesped = $("#desdeHuesped").val();
  empresa = $("#desdeEmpresa").val();
  formaPa = $("#desdeFormaPago").val();
  parametros = {
    desdeFe,
    hastaFe,
    desdeNu,
    hastaNu,
    huesped,
    empresa,
    formaPa,
  };

  if (
    desdeFe == "" &&
    hastaFe == "" &&
    desdeNu == "" &&
    hastaNu == "" &&
    huesped == "" &&
    empresa == "" &&
    formaPa == ""
  ) {
    swal("Atencion", "Seleccione un Criterio de Busqueda", "warning");
  } else {
    $.ajax({
      url: web + "res/php/facturasPorImpuestos.php",
      type: "POST",
      data: parametros,
      success: function (x) {
        $(".imprimeInforme").html(x);
      },
    });
  }
}

function facturasPorFecha() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, usuario_id, tipo, contador },
  } = sesion;

  var web = $("#rutaweb").val();
  desdeFe = $("#desdeFecha").val();
  hastaFe = $("#hastaFecha").val();
  desdeNu = $("#desdeNumero").val();
  hastaNu = $("#hastaNumero").val();
  huesped = $("#desdeHuesped").val();
  empresa = $("#desdeEmpresa").val();
  formaPa = $("#desdeFormaPago").val();
  parametros = {
    tipo,
    contador,
    desdeFe,
    hastaFe,
    desdeNu,
    hastaNu,
    huesped,
    empresa,
    formaPa,
  };

  if (
    desdeFe == "" &&
    hastaFe == "" &&
    desdeNu == "" &&
    hastaNu == "" &&
    huesped == "" &&
    empresa == "" &&
    formaPa == ""
  ) {
    swal("Atencion", "Seleccione un Criterio de Busqueda", "warning");
  } else {
    horaI = new Date();

    $.ajax({
      url: web + "res/php/facturasPorRango.php",
      type: "POST",
      data: parametros,
      beforeSend: function (o) {
        $(".imprimeInforme").html(`
        <div style="text-align: center;">
          <h3 class="alert alert-danger" style="color:#0009 !important;text-align:center;display:grid;"><i style="font-size:3em;margin-top:1px;color:#BBB0B0; " class="ion ion-ios-gear-outline fa-spin"></i>Procesando Informacion, NO Interrumpir</h3>
        </div>
        `);
      },
      success: function (x) {
        horaF = new Date();
        $(".imprimeInforme").html(x);
      },
    });
  }
}

async function generaInforme(data) {
  // console.log(data);
  try {
    const resultado = await fetch("imprimir/imprimePropinas.php", {
      method: "post",
      headers: {
        "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
      },
      body: JSON.stringify(data),
    });
    const datos = await resultado.text();
    return datos.trim();
  } catch (error) {}
}

async function propinasPorFecha() {
  var web = $("#rutaweb").val();
  desdeFe = document.querySelector("#desdeFecha").value;
  hastaFe = document.querySelector("#hastaFecha").value;

  data = {
    desdeFe,
    hastaFe,
  };

  if (desdeFe == "" && hastaFe == "") {
    swal("Atencion", "Seleccione un Criterio de Busqueda", "warning");
  } else {
    const informe = await generaInforme(data);
    // console.log(informe);
    creaHTMLReportes(informe, "Informe Propinas");
  }
}

function creaHTMLReportes(data, titulo) {
  $("#imprimeInforme").html("");
  $("#imprimeInforme").html(`
  <section class="content">
    <object type="application/pdf" id="verInforme" width="100%" height="500" data="data:application/pdf;base64,${$.trim(
      data
    )}"></object> 
  </section>`);
}

function recibosPorFecha() {
  var web = $("#rutaweb").val();
  desdeFe = $("#desdeFecha").val();
  hastaFe = $("#hastaFecha").val();
  desdeNu = $("#desdeNumero").val();
  hastaNu = $("#hastaNumero").val();
  huesped = $("#desdeHuesped").val();
  formaPa = $("#desdeFormaPago").val();
  parametros = {
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
    empresa == "" &&
    formaPa == ""
  ) {
    swal("Atencion", "Seleccione un Criterio de Busqueda", "warning");
  } else {
    $.ajax({
      url: web + "res/php/recibosPorRango.php",
      type: "POST",
      data: parametros,
      success: function (x) {
        $(".imprimeInforme").html(x);
        setTimeout(
          muestraDataTable('#dataTable')
          ,500)
      },
    });
  }
}

function validaCierreDiario() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario },
  } = sesion;
  var pagina = $("#ubicacion").val();
  login = $("#login").val().toUpperCase();
  pass = $("#pass").val();
  $("#botonCierre").attr("disabled", "disabled");

  parametros = {
    login,
    pass,
  };
  if (usuario == login) {
    $("#myModalValidaAuditor").modal("hide");
    $.ajax({
      url: "res/php/validaAuditor.php",
      type: "POST",
      data: parametros,
      beforeSend: function (objeto) {
        $(".mensaje").html(
          `<h3 class="alert alert-danger" style="color:#000;"><i style="font-size:3em;margin-top:1px;color:#BBB0B0; " class="ion ion-ios-gear-outline fa-spin"></i>Procesando Auditoria, NO Interrumpir</h3>`
        );
      },
      success: function (x) {
        if (x == 1) {
          swal(
            {
              title: "Atencion !",
              text: "Auditoria Terminada con Exito !",
              type: "success",
              confirmButtonText: "Aceptar",
              closeOnConfirm: true,
            },
            function () {
              $(location).attr("href", "home");
            }
          );
        } else {
          if (x == 0) {
            $(".mensaje").html(
              '<div class="alert alert-danger"><h4>Usuario y/o Contraseña Incorrectos, Verifique la Informacion</h4></div>'
            );
          } else {
            $(".mensaje").html(x);
          }
        }
      },
    });
  } else {
    $("#error").html(
      '<h4 class="alert alert-danger">El Usuario o la Contraseña no Coinciden con el Usuario Activo</h4>'
    );
  }
}

function validaCierreCajero() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario },
  } = sesion;

  var pagina = $("#ubicacion").val();
  login = $.trim($("#login").val().toUpperCase());
  pass = $("#pass").val();

  parametros = {
    login,
    pass,
    usuario,
  };
  if (usuario == login) {
    $.ajax({
      url: "res/php/validaCajero.php",
      type: "POST",
      data: parametros,
      success: function (x) {
        if (parseInt(x) === 0) {
          $("#error").html(
            '<h4 class="alert alert-danger">El Usuario o la Contraseña no Coinciden con el Usuario Activo</h4>'
          );
        } else {
          var ventana = window.open(x, "PRINT", "height=600,width=600");
          swal("Atencion", "Cajero Cerrado Con Exito", "success");
          setTimeout(cierraSesion(), 5000);
        }
      },
    });
  } else {
    $("#error").html(
      '<h4 class="alert alert-danger">El Usuario o la Contraseña no Coinciden con el Usuario Activo</h4>'
    );
  }
}

function adicionaObservacion() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario },
  } = sesion;
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var rese = $("#reservaObs").val();
  var obse = $("#adicionaObs").val();
  var ante = $("#observaAnt").val() + "/n";

  parametros = {
    rese,
    obse,
    ante,
    usuario,
  };
  $.ajax({
    url: "res/php/adicionaObservacion.php",
    type: "POST",
    data: parametros,
    success: function () {
      $(location).attr("href", pagina);
    },
  });
}

function subirArchivosOld() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, usuario_id },
  } = sesion;
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var formData = new FormData($("#uploadFiles")[0]);
  id = $("#txtIdHuespedUpl").val();

  formData.append("id", id);
  formData.append("idusr", usuario_id);

  $.ajax({
    url: "res/php/upload.php",
    type: "post",
    data: formData,
    contentType: false,
    processData: false,
    success: function (response) {
      $(location).attr("href", pagina);
    },
  });
}

function subirArchivos(e) {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, usuario_id, tipo },
  } = sesion;

  let id = document.querySelector("#txtIdHuespedUpl").value;
  let archivos = document.querySelector("#imgSelect").files;

  const FD = new FormData();
  for (let file of archivos) {
    FD.append("files[]", file);
    FD.append("id", id);
    FD.append("idusr", usuario_id);
  }
  fetch("res/php/upload.php", { method: "POST", body: FD })
    .then((rta) => rta.json()) //es lo mismo JSON.parse( variable )
    .then((json) => {
      swal(
        {
          title: "Atencion",
          text: "Documentos Importados con Exito",
          type: "success",
          confirmButtonText: "Aceptar",
        },
        function () {
          $(location).attr("href", "huespedesPerfil");
        }
      );
    })
    .catch((e) => {
      console.error(e);
    });
}

function take_snapshot() {
  Webcam.snap(function (data_uri) {
    document.getElementById("results").innerHTML =
      '<h3 align="center">Foto</h3>' +
      '<img id="foto" src="' +
      data_uri +
      '"/>';
  });
}

function guardarFoto() {
  var hora = new Date();
  miFoto = $("#fotoTomada").attr("src");
  if (miFoto != "") {
    $("#tablaFotos >tbody").append(
      '<tr><td style="text-align:center"><img style="width: 120px;" src="' +
        miFoto +
        '" alt="" /></td></tr>'
    );
    $("#tablaFotos >tbody").append(
      '<tr><td><label style="font-size:9px;text-align:justify" for="">Hora :' +
        hora +
        " </label></td></tr>"
    );
    miFoto = $("#fotoTomada").attr("src", "");
  }
}

function salidaHuespedCongelada() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, usuario_id },
  } = sesion;

  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var saldo = $("#SaldoActual").val();
  var abonos = $("#totalPagos").val();

  var tipofac = $(
    "input[name=habitacionOptionCon]:checked",
    "#guardarPagosRoomCongela"
  ).val();
  var pago = $("#txtValorPago").val();

  if (pago < saldo) {
    $("#mensajeSal").html(
      '<h4 align="center" class="bg-red" style="padding:10px"><span style="font-size:24px;font-weight: 700;font-family: ubuntu">El Valor Ingresado es menor al Saldo<br>Ingrese este valor por Abonos a Cuenta</span></h4>'
    );
    $("#cambio").css("display", "hide");
    $("#cambio").html("");
  } else {
    $("#mensaje").html("");
    if (pago > saldo) {
      cambio = pago - saldo;
      pago = saldo;
      $("#cambio").css("display", "block");
      $("#cambio").html(`
      <label for="txtValorConsumo" class="col-sm-4 control-label">Cambio / Vueltas</label>
      <div class="col-sm-6">
        <input style="font-size: 19px;font-weight: 600;color:brown" class="form-control padInput" type="number" readonly value="${cambio}">
      </div>`);
    }
    var reserva = $("#reservaActual").val();
    var idhues = $("#titularCon").val();
    var room = $("#txtNumeroHabSalCon").val();
    var codigo = $("#codigoPago").val();
    var textopago = $("#codigoPago option:selected").text();
    var detalle = $("#txtDetallePag").val();
    var refer = $("#txtReferenciaPag").val();
    var folio = $("#folioActivo").val();
    var idcia = $("#seleccionaPagoCiaCon").val();
    let perfilFac = 1;
    var idcentro = 0;

    var parametros = {
      codigo,
      textopago,
      valor: pago,
      refer,
      room,
      folio,
      idhues,
      reserva,
      tipofac,
      idcia,
      usuario,
      usuario_id,
      perfilFac,
      idcentro,
      detalle,
      baseRete,
      baseIva,
      baseIca,
      reteiva,
      reteica,
      retefuente,
      porceReteiva,
      porceReteica,
      porceRetefuente,
      correofac,
    };
    $.ajax({
      type: "POST",
      url: web + "res/php/ingresoPago.php",
      data: parametros,
      success: function (data) {
        var ventana = window.open(
          "imprimir/facturas/FES-" + data[0],
          "PRINT",
          "height=600,width=600"
        );
        if (data[1] == "0") {
          swal({
            title: "Error!",
            text: "Sin Adultos en esta Reserva",
            type: "error",
            confirmButtonText: "Aceptar",
          });
          let = user;

          $(location).attr("href", "home");
        } else {
          swal(
            "Atencion",
            "La Cuenta Actual Presenta Folios con Saldos",
            "warning",
            5000
          );
          $("#myModalSalidaHuesped").modal("hide");
          activaFolio(reserva, data[1]);
        }
      },
    });
  }
}

function cambiaTitularCon() {
  idhuesp = $("#titularCon").val();
  $("#txtIdHuespedCon").val(0);
  $("#txtIdHuespedCon").val(idhuesp);
  $("#txtIdHuespedSal").val(idhuesp);
}

function cambiaTitular() {
  idhuesp = $("#titular").val();
  $("#txtIdHuespedCon").val(0);
  $("#txtIdHuespedCon").val(idhuesp);
  $("#txtIdHuespedSal").val(idhuesp);
}

function verCargosFacturaDia(factura, reserva, perfil) {
  huesped = $("#txtIdHuespedHis").val();
  $.ajax({
    url: "res/php/buscaCargosFacturaDia.php",
    type: "POST",
    data: {
      factura,
      reserva,
      perfil,
    },
    beforeSend: function (objeto) {
      $("#verFactura").html('<div><img src="" alt="" /></div>');
    },
    success: function (data) {
      $("#verCargosFactura").attr("data", "");
      $("#verCargosFactura").html("");
      $("#verCargosFactura").html(data);
    },
  });
}

function calcularEdad(fecha) {
  var hoy = new Date();
  var cumpleanos = new Date(fecha);
  var edad = hoy.getFullYear() - cumpleanos.getFullYear();
  var m = hoy.getMonth() - cumpleanos.getMonth();

  if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
    edad--;
  }

  return edad;
}
