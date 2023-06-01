/* sesion = JSON.parse(localStorage.getItem("sesion"));
let { user } = sesion;
// let { usuario } = user;
// console.log(user);
let { usuario_id, usuario, nombres, apellidos, tipo } = user; */

$(document).ready(function () {
  let cia = document.getElementById("pantallaCompanias");
  if (cia != null) {
    var numRegis = 0;
    var filas = $("#numFiles").val();
    var pages = $("#paginas").val();
    traeTotalCompanias(numRegis, filas);
  }

  let hue = document.getElementById("pantallaHuespedes");
  if (hue != null) {
    var numRegis = 0;
    var filas = $("#numFiles").val();
    var pages = $("#paginas").val();
    traeTotalHuespedes(numRegis, filas);
  }

  let reserva = document.getElementById("pantallaReservas");
  if (reserva != null) {
    traeReservasActivas(1);
  }

  let casa = document.getElementById("pantallaenCasa");
  if (casa != null) {
    /* 
sesion = JSON.parse(localStorage.getItem("sesion"));
let { user } = sesion;
let { usuario_id, usuario, nombres, apellidos, tipo } = user; 
*/
    traeHuespedesenCasa();
  }

  let llga = document.getElementById("pantallaLlegadas");
  if (llga != null) {
    traeLlegadasDia();
  }

  let fact = document.getElementById("pantallaFacturacion");
  if (fact != null) {
    traeFacturasEstadia();
  }

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
        id: id,
        empresa: empresa,
        nit: nit,
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
      data: { id: id },
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
      data: { id: id },
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
      data: { id: id },
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

  $("#myModalAdicionaPerfil").on("show.bs.modal", function (event) {
    $("#edita").val(0);
  });

  $("#myModalInformacionMmto").on("show.bs.modal", function (event) {
    var web = $("#rutaweb").val();
    var pagina = $("#ubicacion").val();
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var numroom = button.data("room");

    $("#idMmtoTer").val(id);
    $("#numroom").val(numroom);

    $.ajax({
      url: web + "res/php/detalleMmtoInfo.php",
      type: "POST",
      data: { id: id },
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
      reserva: reserva,
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
      numero: numero,
      reserva: reserva,
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
    var modal = $(this);

    modal.find(".modal-title").text("Factura Numero : " + numero);
    var factura = "Factura_" + numero + ".pdf";

    $("#verFacturaModal").attr("data", web + "imprimir/facturas/" + factura);
    $(".alert").hide();
  });

  $("#myModalAdicionaObservaciones").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var room = button.data("nrohab");
    var apellido1 = button.data("apellido1");
    var apellido2 = button.data("apellido2");
    var nombre1 = button.data("nombre1");
    var nombre2 = button.data("nombre2");
    var noches = button.data("noches");
    var llegada = button.data("llegada");
    var salida = button.data("salida");
    var observa = button.data("observa");
    var modal = $(this);

    modal
      .find(".modal-title")
      .text(
        "Adiciona Observaciones: " +
          apellido1 +
          " " +
          apellido2 +
          " " +
          nombre1 +
          " " +
          nombre2
      );

    $("#reservaObs").val(id);
    $("#habitacionObs").val(room);
    $("#huespedObs").val(
      apellido1 + " " + apellido2 + " " + nombre1 + " " + nombre2
    );
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
    var button = $(event.relatedTarget);
    var apellidos = button.data("apellidos");
    var nombres = button.data("nombres");
    var llega = button.data("llegada");
    var sale = button.data("salida");
    var fecha = button.data("fechafac");
    var numero = button.data("numero");
    var reserva = button.data("reserva");
    var modal = $(this);

    modal.find(".modal-title").text("Anular Factura: " + numero);
    modal.find(".modal-body #facturaHis").val(numero);
    modal.find(".modal-body #huesped").val(apellidos + " " + nombres);
    modal.find(".modal-body #llegada").val(llega);
    modal.find(".modal-body #salida").val(sale);
    modal.find(".modal-body #numero").val(numero);
    modal.find(".modal-body #reservaHis").val(reserva);
    modal.find(".modal-body #fechafac").val(fecha);
    modal.find(".modal-body #motivoAnulaHis").val("");
    var factura = "Factura_" + numero + ".pdf";

    $("#verFacturaHistoricoModal").attr("data", "imprimir/facturas/" + factura);
    $(".alert").hide();
  });

  $("#myModalverFacturaReserva").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var reserva = button.data("reserva");

    $.ajax({
      url: "res/php/getFacturaReserva.php",
      type: "POST",
      data: { reserva: reserva },
      success: function (data) {
        $("#verFacturasHistorico").html(data);
      },
    });
    $(".alert").hide();
  });

  $("#myModalReasignarHuesped").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var apellidos = button.data("apellidos");
    var nombres = button.data("nombres");
    var llega = button.data("llegada");
    var sale = button.data("salida");
    var numero = button.data("numero");
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
    var modal = $(this);

    modal.find(".modal-title").text("Anular Factura: " + numero);
    modal.find(".modal-body #factura").val(numero);
    modal.find(".modal-body #huespedAnu").val(apellidos + " " + nombres);
    /* modal.find(".modal-body #apellidos").val(apellidos);
    modal.find(".modal-body #nombres").val(nombres); */
    modal.find(".modal-body #llegada").val(llega);
    modal.find(".modal-body #salida").val(sale);
    modal.find(".modal-body #numero").val(numero);
    modal.find(".modal-body #reserva").val(reserva);
    modal.find(".modal-body #perfil").val(perfil);
    modal.find(".modal-body #idperfil").val(idperfil);
    modal.find(".modal-body #fechafac").val(fecha);
    modal.find(".modal-body #motivoAnula").val("");

    if (perfil == 1) {
      var factura = "Factura_" + numero + ".pdf";
      $("#verFacturaModal").attr("data", web + "imprimir/facturas/" + factura);
    } else {
      var factura = "Abono_" + numero + ".pdf";
      $("#verFacturaModal").attr("data", web + "imprimir/notas/" + factura);
    }

    $(".alert").hide();
  });

  $("#myModalHistoricoFacturasCia").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var empresa = button.data("empresa");
    var nit = button.data("nit");
    var parametros = {
      id: id,
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
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var nombre = button.data("nombre");
    $("#edita").val(1);

    var parametros = {
      id: id,
    };
    var modal = $(this);

    modal.find(".modal-title").text("Modifica Perfil del Huesped: " + nombre);
    modal.find(".modal-body #txtIdHuespedUpd").val(id);

    $.ajax({
      type: "POST",
      data: parametros,
      url: "res/php/dataUpdateHuesped.php",
      success: function (datos) {
        $("#datosHuesped").html(datos);
      },
    });
    $(".alert").hide();
  });

  $("#myModalSalidaCongelada").on("show.bs.modal", function (event) {
    sesion = JSON.parse(localStorage.getItem("sesion"));
    let { user } = sesion;
    let { usuario, usuario_id } = user;
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
                  "Atencion",
                  "Salida del Huesped realizada con Exito",
                  "success",
                  5000
                );
                $(location).attr("href", "home");
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

    var modal = $(this);

    var parametros = {
      folio: folio,
      reserva: reserva,
      nrohab: nrohab,
    };

    if (folio == 0) {
      swal(
        "Precaucion",
        "Seleccione un Folio para Realizar el Pago",
        "warning"
      );
      $("#myModalCongelarCuenta").modal("data-dismiss", "modal");
    } else {
      if (nrofolio2 != 0 || nrofolio3 != 0 || nrofolio4 != 0) {
        swal(
          "Precuacion",
          "Otros Folios con Saldo, No Permitido Congelar la Presente Cuenta ",
          "warning"
        );
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
                    "Atencion",
                    "Salida del Huesped realizada con Exito",
                    "success",
                    5000
                  );
                  $(location).attr("href", "facturacionEstadia");
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
        // modal.find(".modal-body #txtIdCentroCia").val(idcentro);
        // modal.find(".modal-body #txtCentroCon").val(centro);
        modal.find(".modal-body #txtNitCong").val(nit);
        modal.find(".modal-body #txtIdReservaCong").val(id);
        modal.find(".modal-body #txtIdHuespedCong").val(hues);
        modal.find(".modal-body #txtNumeroHabCong").val(nrohab);
        modal
          .find(".modal-body #txtApellidosCong")
          .val(`${apellido1} ${apellido2} ${nombre1} ${nombre2}`);
        // modal.find(".modal-body #txtNombresCong").val();
        modal.find(".modal-body #valorSaldo").val(saldo);

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
    $("#nuevoPax").val(1);
    $("#identifica").val("");
    $("#tipodoc").val("");
    $("#apellido1").val("");
    $("#apellido2").val("");
    $("#nombre1").val("");
    $("#nombre2").val("");
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
        idres: idres,
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
    var button = $(event.relatedTarget);
    var idres = button.data("id");
    var nombre = button.data("nombre");
    var modal = $(this);
    var parametros = {
      idres: idres,
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
      idcia: idcia,
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
    modal.find(".modal-body #txtValorTarifaAnu").val(valor);
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
    modal.find(".modal-body #txtValorTarifaAnu").val(valor);
    $(".alert").hide();
  });

  $("#myModalBuscaHuesped").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var modal = $(this);
    var buscar = $("#buscarHuesped").val();
    var parametros = {
      buscar: buscar,
    };
    modal.find(".modal-title").text("Buscar Huesped Por : " + buscar);
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

  $("#myModalBuscaHuespedRes").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var modal = $(this);
    var buscar = $("#buscarHuespedRes").val();
    var web = $("#webPage").val();
    var parametros = {
      buscar: buscar,
    };
    modal.find(".modal-title").text("Buscar Huesped Por : " + buscar);
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
    var nombrecom = button.data("nombre");
    var modal = $(this);
    var parametros = {
      id: id,
    };
    modal.find(".modal-title").text("Modifica Estadia : " + nombrecom);
    $.ajax({
      type: "POST",
      data: parametros,
      url: "res/php/dataUpdateEstadia.php",
      beforeSend: function (objeto) {},
      success: function (datos) {
        $("#modalReservasEst").html("");
        $("#modalReservasEst").html(datos);
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
    var id = button.data("id");
    var hues = button.data("idhuesped");
    var nombre = button.data("nombre");
    var turismo = button.data("impto");
    var nrohab = button.data("nrohab");
    var tipohab = button.data("tipohab");
    var modal = $(this);
    var parametros = {
      reserva: id,
    };

    web = $("#rutaweb").val();
    modal.find(".modal-title").text("Estado de Cuenta : " + nombre);
    modal.find(".modal-body #txtIdReservaEst").val(id);
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
          web + "imprimir/informes/Estado_Cuenta_Huesped_" + id + ".pdf"
        );
        /// $("#divConsumos").html(data);
      },
    });
  });

  $("#myModalSalidaHuesped").on("show.bs.modal", function (event) {
    sesion = JSON.parse(localStorage.getItem("sesion"));
    let { user } = sesion;
    let { usuario, usuario_id } = user;
    var credito = 0;
    var web = $("#rutaweb").val();
    var pagina = $("#ubicacion").val();
    var folio = $("#folioActivo").val();
    var reserva = $("#reservaActual").val();
    var consumo = $("#saldoActual").val();
    var abonos = $("#totalPagos").val();
    var saldo = consumo - abonos;

    var button = $(event.relatedTarget);
    var id = button.data("id");
    var hues = button.data("idhues");
    var idcia = button.data("idcia");
    var idcentro = button.data("idcentro");
    var apellido1 = button.data("apellido1");
    var apellido2 = button.data("apellido2");
    var nombre1 = button.data("nombre1");
    var nombre2 = button.data("nombre2");
    var nombre = button.data("nombre");
    var turismo = button.data("impto");
    var nrohab = button.data("nrohab");
    var modal = $(this);
    var saldofolio = $("#consumo" + folio).val();
    var abonofolio = $("#abonos" + folio).val();

    $("#txtIdCiaSal").val(0);
    $("#txtIdCentroCiaSal").val(0);

    /*
    $("#inlineRadio1").checked;
      if (idcia == 0) {
      $("#selecentro").css("display", "none");
      $("#selecomp").css("display", "none");
    } else {
      $("#inlineRadio2").checked;
      $("#selecentro").css("display", "block");
      $("#selecomp").css("display", "block");
    } */

    var parametros = {
      turismo,
      folio,
      reserva,
      nrohab,
      usuario,
      idusuario: usuario_id,
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
                "Atencion",
                "Salida del Huesped realizada con Exito",
                "success",
                5000
              );
              $(location).attr("href", "home");
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
        modal
          .find(".modal-body #txtHuespedSal")
          .val(`${apellido1} ${apellido2} ${nombre1} ${nombre2}`);
        // modal.find(".modal-body #txtNombresSal").val(nombre1 + " " + nombre2);

        /* if (idcia == 0) {
          $("#inlineRadio1").prop("disabled", "disabled");
          $("#inlineRadio2").prop("disabled", "disabled");
        }

        if (turismo == 2) {
          $("#inlineRadio1").attr("disabled", true);
          $("#inlineRadio2").attr("disabled", true);
        } */

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
    var apellido1 = button.data("apellido1");
    var apellido2 = button.data("apellido2");
    var nombre1 = button.data("nombre1");
    var nombre2 = button.data("nombre2");
    var modal = $(this);
    var parametros = {
      id: id,
    };

    modal
      .find(".modal-title")
      .text(
        "Informacion Estadia: " +
          apellido1 +
          " " +
          apellido2 +
          " " +
          nombre1 +
          " " +
          nombre2
      );
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
    var tipohab = button.data("tipohab");
    var nrohab = button.data("nrohab");
    var apellido1 = button.data("apellido1");
    var apellido2 = button.data("apellido2");
    var nombre1 = button.data("nombre1");
    var nombre2 = button.data("nombre2");
    var modal = $(this);
    var parametros = {
      id: id,
    };

    modal
      .find(".modal-title")
      .text(
        "Informacion Estadia: " +
          apellido1 +
          " " +
          apellido2 +
          " " +
          nombre1 +
          " " +
          nombre2
      );
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
  });

  $("#myModalModificaReserva").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var nombre = button.data("nombrecomp");
    var modal = $(this);
    $("#editaRes").val(1);
    var parametros = {
      id: id,
    };
    modal.find(".modal-title").text("Modifica Reserva Actual: " + nombre);

    $.ajax({
      type: "POST",
      data: parametros,
      url: "res/php/dataUpdateReserva.php",
      success: function (datos) {
        $("#modalReservasUpd").html("");
        $("#modalReservasUpd").html(datos);
      },
    });
    $(".alert").hide();
  });

  $("#myModalCancelaReserva").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var nombre = button.data("nombre");
    var modal = $(this);
    $("#editaRes").val(1);
    var parametros = {
      id: id,
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
      id: id,
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
      id: id,
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
      id: id,
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
      id: id,
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
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var empresa = button.data("empresa");
    var nit = button.data("nit");
    var parametros = {
      id: id,
    };
    var modal = $(this);

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
      url: "res/php/asiganCia.php",
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
      id: id,
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
    modal.find(".modal-body #txtValorConsumoAnu").val(monto);
    modal.find(".modal-body #txtValorImptoAnu").val(impto);
    modal.find(".modal-body #txtValorTotalAnu").val(total);
    modal.find(".modal-body #txtPagoConsumoAnu").val(pagos);
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
    var apellido1 = button.data("apellido1");
    var apellido2 = button.data("apellido2");
    var nombre1 = button.data("nombre1");
    var nombre2 = button.data("nombre2");
    var turismo = button.data("impto");
    var nrohab = button.data("nrohab");
    var impturis = button.data("impto");
    var modal = $(this);

    modal.find(".modal-title").text("Abonos a Cuenta: " + nombre);
    modal.find(".modal-body #txtIdReservaAbo").val(id);
    modal.find(".modal-body #txtIdHuespedAbo").val(hues);
    modal.find(".modal-body #txtImptoTuriAbo").val(impturis);
    modal.find(".modal-body #txtNumeroHabAbo").val(nrohab);
    modal.find(".modal-body #txtNombreCompleto").val(nombre);
    modal.find(".modal-body #txtNombresAbo").val(nombre1 + " " + nombre2);
    $("#codigoAbono").focus();
    $(".alert").hide();
  });

  $("#myModalCargosConsumo").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var hues = button.data("idhuesped");
    var apellido1 = button.data("apellido1");
    var apellido2 = button.data("apellido2");
    var imptoturi = button.data("impto");
    var nombre1 = button.data("nombre1");
    var nombre2 = button.data("nombre2");
    var nrohab = button.data("nrohab");
    var folio = $("#folioActivo").val();
    var modal = $(this);

    modal
      .find(".modal-title")
      .text(
        "Ingreso Consumos: " +
          apellido1 +
          " " +
          apellido2 +
          " " +
          nombre1 +
          " " +
          nombre2
      );
    modal.find(".modal-body #txtIdReservaCon").val(id);
    modal.find(".modal-body #txtIdHuespedCon").val(hues);
    modal.find(".modal-body #txtImptoTurismo").val(imptoturi);
    modal.find(".modal-body #txtNumeroHabCon").val(nrohab);
    modal.find(".modal-body #txtApellidosCon").val(apellido1 + " " + apellido2);
    modal.find(".modal-body #txtNombresCon").val(nombre1 + " " + nombre2);
    modal.find(".modal-body #txtFolio").val(folio);
    modal.find(".modal-body #codigoConsumo").val(0);
    modal.find(".modal-body #txtValorConsumo").val(0);

    $("#codigoConsumo").focus();
    $(".alert").hide();
  });

  $("#myModalDepositoReserva").on("show.bs.modal", function (event) {
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
    var modal = $(this);

    modal.find(".modal-title").text("Deposito a Reserva: " + nombre);
    modal.find(".modal-body #txtIdReservaDep").val(id);
    modal.find(".modal-body #txtIdHuespedDep").val(hues);
    modal.find(".modal-body #txtTipoHab").val(tipohab);
    modal.find(".modal-body #txtNumeroHab").val(nrohab);
    modal.find(".modal-body #txtHuesped").val(nombre);
    modal.find(".modal-body #txtLlegada").val(llegada);
    modal.find(".modal-body #txtSalida").val(salida);
    modal.find(".modal-body #txtNoches").val(noches);
    modal.find(".modal-body #txtHombres").val(hombres);
    modal.find(".modal-body #txtMujeres").val(mujeres);
    modal.find(".modal-body #txtNinos").val(ninos);
    modal.find(".modal-body #txtTarifa").val(tarifa);
    modal.find(".modal-body #txtValorTarifa").val(valor);
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
    modal.find(".modal-body #txtValorTarifaInf").val(valor);
    modal.find(".modal-body #txtValorTarifaInf").val(valor);
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
      id: id,
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

  $("#myModalRegistraReserva").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var hues = button.data("idhuesped");
    var tipohab = button.data("tipohab");
    var nrohab = button.data("nrohab");
    var apellido1 = button.data("apellido1");
    var apellido2 = button.data("apellido2");
    var nombre1 = button.data("nombre1");
    var nombre2 = button.data("nombre2");
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
    modal.find(".modal-body #txtIdReservaIng").val(id);
    modal.find(".modal-body #txtIdHuespedINg").val(hues);
    modal.find(".modal-body #txtTipoHabIng").val(tipohab);
    modal.find(".modal-body #txtNumeroHabIng").val(nrohab);
    modal.find(".modal-body #txtApellidosIng").val(apellido1 + " " + apellido2);
    modal.find(".modal-body #txtNombresIng").val(nombre1 + " " + nombre1);
    modal.find(".modal-body #txtLlegadaIng").val(llegada);
    modal.find(".modal-body #txtSalidaIng").val(salida);
    modal.find(".modal-body #txtNochesIng").val(noches);
    modal.find(".modal-body #txtHombresIng").val(hombres);
    modal.find(".modal-body #txtMujeresIng").val(mujeres);
    modal.find(".modal-body #txtNinosIng").val(ninos);
    modal.find(".modal-body #areaComentariosIng").val(observaciones);
    modal.find(".modal-body #txtTarifaIng").val(tarifa);
    modal.find(".modal-body #txtValorTarifaIng").val(number_format(valor, 2));
    $(".alert").hide();
  });
});

function buscaFacturasExporta() {
  fecha = document.querySelector("#buscarFecha").value;
  url = "res/php/exportaFactura.php";
  fetch(url, {
    method: "post",
    headers: {
      "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
    },
    body: "fecha=" + fecha,
  })
    .then((response) => response.text())
    .then((data) => llenaFacturas(data));
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

function LimpiaFacturasHTML() {
  while (facturasHTML.firstChild) {
    facturasHTML.removeChild(facturasHTML.firstChild);
  }
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
  $.ajax({
    url: "res/php/traeFacturacionEstadia.php",
    type: "POST",
    data: {
      tipo: "1",
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
        language: {
          next: "Siguiente",
          search: "Buscar:",
          entries: "registros",
        },
      });
    },
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
  let { user } = sesion;
  let { tipo } = user;

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
      tipo: tipo,
    },
    success: function (data) {
      $("#paginaReservas").html(data);
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

function consumoVentaDirecta() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let { user } = sesion;
  let { usuario, usuario_id } = user;
  /* usuario = sesion["usuario"][0]["usuario"];
  idusuario = sesion["usuario"][0]["usuario_id"]; */
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
    idusuario: usuario_id,
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
  let { user } = sesion;
  let { usuario, usuario_id } = user;
  /*  usuario = sesion["usuario"][0]["usuario"];
  idusuario = sesion["usuario"][0]["usuario_id"]; */

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
      iden: iden,
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
  let file = makeid(12);
  let tipo = $("input[name=cumpleOption]:checked").val();
  $(".btn-info").removeAttr("disabled");

  $.ajax({
    url: "res/php/listadoCumpleanios.php",
    type: "POST",
    data: {
      file: file,
      tipo: tipo,
    },
  })
    .done(function () {
      $("#muestraHuespedes").html(
        `<object id="verHuespedes" width="100%" height="500" data="imprimir/informes/${file}.pdf"></object>`
      );
    })
    .fail(function () {})
    .always(function (data) {
      $("#listadoCumpleanios > tbody").html("");
      $("#listadoCumpleanios > tbody").append(data);
    });
}

function listadoPerfilCompanias() {
  file = makeid(12);
  $.ajax({
    url: "res/php/listadoCompanias.php",
    type: "POST",
    data: { file: file },
  })
    .done(function (data) {
      $("#muestraHuespedes").html(
        `<object id="verHuespedes" width="100%" height="500" data="imprimir/informes/${file}.pdf"></object>`
      );
    })
    .always(function (data) {
      $("#listadoCompanias > tbody").html("");
      $("#listadoCompanias > tbody").append(data);
    });
}

function listadoPerfilHuespedes() {
  file = makeid(12);
  $.ajax({
    url: "res/php/listadoHuespedes.php",
    type: "POST",
    data: { file: file },
  })
    .done(function (data) {
      $("#muestraHuespedes").html(
        `<object id="verHuespedes" width="100%" height="500" data="imprimir/informes/${file}.pdf"></object>`
      );
    })
    .always(function (data) {
      $("#listadoHuespedes > tbody").html("");
      $("#listadoHuespedes > tbody").append(data);
    });
}

function seleccionaCentro(idCia) {
  $.ajax({
    url: "res/php/centrosCia.php",
    type: "POST",
    data: { idCia: idCia },
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
      idCentro: idCentro,
    },
    success: function () {
      $(location).attr("href", pagina);
    },
  });
}

function actualizaCentroCia() {
  var pagina = $("#ubicacion").val();
  var nombre = $("#nombreMod").val();
  var respon = $("#respoMod").val();
  var idCentro = $("#idCentroMod").val();

  $.ajax({
    url: "res/php/actualizaCentroCia.php",
    type: "POST",
    data: {
      nombre: nombre,
      responsable: respon,
      idCentro: idCentro,
    },
    success: function () {
      $(location).attr("href", pagina);
    },
  });
}

function guardaCentroCia() {
  var pagina = $("#ubicacion").val();
  var nombreAdi = $("#nombreAdi").val();
  var respoAdi = $("#respoAdi").val();
  var idCiaAdi = $("#idCiaAdi").val();
  $.ajax({
    url: "res/php/adicionaCentroCia.php",
    type: "POST",
    data: {
      nombre: nombreAdi,
      responsable: respoAdi,
      idCia: idCiaAdi,
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
      idCia: idCia,
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
      factura: factura,
      modulo: modulo,
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
      factura: factura,
      test: test,
      modulo: modulo,
      ambiente: ambiente,
    },
    success: function (data) {
      $("#verCargosFactura").html(data);
    },
  });
}

function imprimeInformeAuditoria(informe, titulo) {
  web = $("#webPage").val();
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let { user } = sesion;
  let { usuario, apellidos, nombres, usuario_id } = user;
  /* 
  usuario = sesion["usuario"][0]["usuario"];
  apellidos = sesion["usuario"][0]["apellidos"];
  nombres = sesion["usuario"][0]["nombres"]; 
  idusuario = sesion["usuario"][0]["usuario_id"];
  */
  file = makeid(12);
  $.ajax({
    url: "imprimir/" + informe + ".php",
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
              <object id="verInforme" width="100%" height="500" data="imprimir/informes/${$.trim(
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
  let { user } = sesion;
  let { usuario, usuario_id } = user;
  /* usuario = sesion["usuario"][0]["usuario"];
  idusuario = sesion["usuario"][0]["usuario_id"]; */
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
              <object id="verInforme" width="100%" height="500" data="imprimir/informes/${$.trim(
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
  let { user } = sesion;
  let { usuario, usuario_id } = user;
  /* usuario = sesion["usuario"][0]["usuario"];
  idusuario = sesion["usuario"][0]["usuario_id"]; */
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
              <object id="verInforme" width="100%" height="500" data="imprimir/informes/${$.trim(
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
    data: { id: id },
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
      regis: regis,
      filas: filas,
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
                      	style="padding:3px 13px;font-weight: bold;color:#000">Ficha Compañia<span class="caret" style="margin-left:10px;"></span>
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
    data: { id: id },
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

function traeTotalHuespedes(regis, filas) {
  var huesp = $("#regishue").val();
  var pages = Math.ceil(huesp / filas);
  lista = "";
  barra = "";

  $.ajax({
    url: "res/php/traeHuespedLimit.php",
    type: "POST",
    dataType: "json",
    data: {
      regis: regis,
      filas: filas,
    },
    success: function (data) {
      $("#listaHuespedes").html("");
      $("#barraPaginas").html("");
      for (i = 0; i < data.length; i++) {
        lista =
          lista +
          `<tr style='font-size:12px'>
          <td width="22px">${data[i]["identificacion"]}</td>
          <td>${data[i]["apellido1"]}</td>
          <td>${data[i]["apellido2"]}</td>
          <td>${data[i]["nombre1"]}</td>
          <td>${data[i]["nombre2"]}</td>
          <td>${data[i]["celular"]}</td>
          <td>${data[i]["email"]}</td>
          <td>${calcularEdad(data[i]["fecha_nacimiento"])}</td>
          <td style="padding:3px;width: 13%">
            <nav class="navbar navbar-default" style="margin-bottom: 0px;min-height:0px;">
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding:1px">
                <ul class="nav navbar-nav">
                  <li class="dropdown">
                    <a 
                    	href="#" 
                    	class="dropdown-toggle" 
                    	data-toggle="dropdown" 
                    	role="button" 
                    	aria-haspopup="true" 
                    	aria-expanded="false" 
                    	style="padding:3px 8px;font-weight:bold;color:#000">Ficha Huesped<span class="caret" style="margin-left:10px;"></span></a>
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
													data-toggle   ="modal" 
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
														class="btn btn-success" 
														data-page ="${i - 1}"
														onclick   ="irPagina(${i - 1})"
													> ${i} </button>`;
      }
      $("#listaHuespedes").append(lista);
      $("#barraPaginas").append(barra);
    },
  });
}

function verfacturaHistorico(fact) {
  var factura = "Factura_" + fact + ".pdf";
  $("#verFactura").attr("data", "imprimir/facturas/" + factura);
}

function anulaFacturaHistorico() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let { user } = sesion;
  let { usuario, usuario_id } = user;
  /* usuario = sesion["usuario"][0]["usuario"];
  idusuario = sesion["usuario"][0]["usuario_id"]; */
  var pagina = $("#ubicacion").val();
  var factura = $("#facturaHis").val();
  var motivo = $("#motivoAnulaHis").val();
  var reserva = $("#reservaHis").val();

  $.ajax({
    url: "res/php/anulaFacturaHistorico.php",
    type: "POST",
    data: {
      factura,
      motivo,
      usuario,
      idusuario: usuario_id,
      reserva,
    },
    success: function (data) {
      swal("Atencion", "Factura Anulada con Exito", "success", 5000);
      $(location).attr("href", pagina);
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
  var textoBusqueda = $("input#search").val();
  var huesp = $("#regiscia").val();
  var filas = $("#numFiles").val();
  lista = "";
  barra = "";

  if (textoBusqueda == "") {
    return;
  }

  $.ajax({
    url: "res/php/getBuscaCompania.php",
    type: "POST",
    dataType: "json",
    data: {
      regis: 0,
      filas: filas,
      valorBusqueda: textoBusqueda,
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
  var textoBusqueda = $("input#search").val();
  var huesp = $("#regishue").val();
  var filas = $("#numFiles").val();
  lista = "";
  barra = "";

  if (textoBusqueda == "") {
    return;
  }

  $.ajax({
    url: "res/php/getBuscaHuesped.php",
    type: "POST",
    dataType: "json",
    data: {
      regis: 0,
      filas: filas,
      valorBusqueda: textoBusqueda,
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
          <td>${data[i]["apellido1"]}</td>
          <td>${data[i]["apellido2"]}</td>
          <td>${data[i]["nombre1"]}</td>
          <td>${data[i]["nombre2"]}</td>
          <td>${data[i]["celular"]}</td>
          <td>${data[i]["email"]}</td>
          <td>${calcularEdad(data[i]["fecha_nacimiento"])}</td>
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
      fechaIni: fechaIni,
      fechaFin: fechaFin,
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
      fechaIni: fechaIni,
      fechaFin: fechaFin,
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
      fechaIni: fechaIni,
      fechaFin: fechaFin,
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
    fechaaudi: fechaaudi,
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

function anulaFactura() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let { user } = sesion;
  let { usuario, usuario_id } = user;
  var pagina = $("#ubicacion").val();
  var numero = $("#factura").val();
  var motivo = $("#motivoAnula").val();
  var reserva = $("#reserva").val();
  var perfil = $("#perfil").val();

  $.ajax({
    url: "res/php/anulaFactura.php",
    type: "POST",
    data: {
      numero,
      motivo,
      reserva,
      usuario,
      usuario_id,
      perfil,
    },
    success: function (data) {
      var ventana = window.open(
        "imprimir/notas/" + data.trim(),
        "PRINT",
        "height=600,width=600"
      );
      swal("Atencion", "Documento Anulado Con Exito", "success");
      $(location).attr("href", pagina);
    },
  });
}

function verDepositos(reserva) {
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var parametros = { reserva: reserva };
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

function guardaHuesped() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let { user } = sesion;
  let { usuario, usuario_id, tipo } = user;
  /* usuario = sesion["usuario"][0]["usuario"];
  idusuario = sesion["usuario"][0]["usuario_id"];
  nivel = sesion["usuario"][0]["tipo"]; */
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var parametros = $("#formAdicionaHuespedes").serializeArray();

  parametros.push({ name: "usuario", value: usuario });
  parametros.push({ name: "idusuario", value: usuario_id });

  $.ajax({
    type: "POST",
    data: parametros,
    url: "res/php/ingresoHuesped.php",
    success: function (datos) {
      $(location).attr("href", pagina);
    },
  });
}

function traeHuespedesCon(reserva, huesped) {
  $.ajax({
    url: "res/php/buscaHuespedesSalida.php",
    type: "POST",
    data: {
      reserva: reserva,
      huesped: huesped,
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
      reserva: reserva,
      huesped: huesped,
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
    reserva: reserva,
    folio: folio,
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
      // $(location).attr("href", "facturacionCongelada");
    },
  });
}

function congelaHuesped() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let { user } = sesion;
  let { usuario, usuario_id } = user;
  /* usuario = sesion["usuario"][0]["usuario"];
  idusuario = sesion["usuario"][0]["usuario_id"]; */

  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var reserva = $("#reservaActual").val();
  var idhues = $("#txtIdHuespedCong").val();
  var room = $("#nrohabitacion").val();
  var folio = $("#folioActivo").val();
  var idcia = $("#txtIdCiaCong").val();
  // var idcentro = $("#txtIdCentroCia").val();

  var parametros = {
    room,
    folio,
    idhues,
    reserva,
    idcia,
    usuario,
    idUser: usuario_id,
  };
  $.ajax({
    type: "POST",
    url: web + "res/php/ingresoCongela.php",
    data: parametros,
    success: function (data) {
      var ventana = window.open(data, "PRINT", "height=600,width=600");
      swal(
        "Atencion",
        "Cuenta del Huesped Congelada con Exito",
        "success",
        5000
      );
      $(location).attr("href", "facturacionEstadia");
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
  if (perfil == 1) {
    var factura = "Factura_" + fact + ".pdf";
    $("#verFactura").attr("data", "imprimir/facturas/" + factura);
  } else {
    var factura = "Abono_" + fact + ".pdf";
    $("#verFactura").attr("data", "imprimir/notas/" + factura);
  }
}

function buscaFacturasFecha() {
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var fechafac = $("#buscarFecha").val();
  var parametros = {
    fechafac: fechafac,
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

function guardaAcompanante() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let { user } = sesion;
  let { usuario, usuario_id } = user;
  /* usuario = sesion["usuario"][0]["usuario"];
  idusuario = sesion["usuario"][0]["usuario_id"]; */
  var web = $("#rutaweb").val();
  var ubicacion = $("#ubicacion").val();
  var idreser = $("#idreservaAco").val();
  /// var parametros = $('#acompananteReserva').serialize();
  var parametros = $("#acompananteReserva").serializeArray();

  parametros.push({ name: "usuario", value: usuario });
  parametros.push({ name: "idusuario", value: usuario_id });
  $.ajax({
    type: "POST",
    data: parametros,
    url: web + "res/php/guardaAcompanante.php",
    success: function (datos) {
      $("#mensajeEliAco").html(datos);
      $("#myModalAdicionaAcompanante").modal("hide");
      $("#myModalAcompanantesReserva").modal("hide");
      $(location).attr("href", ubicacion);
    },
  });
}

function buscaHuespedAcompanante(id) {
  var web = $("#rutaweb").val();
  var parametros = {
    id: id,
  };
  $.ajax({
    url: web + "res/php/buscaIdenAcompana.php",
    type: "POST",
    dataType: "json",
    data: parametros,
    success: function (datos) {
      if (datos == 0) {
        $("#nuevoPax").val(1);
        $("#tipodoc").val("");
        $("#apellido1").val("");
        $("#apellido2").val("");
        $("#nombre1").val("");
        $("#nombre2").val("");
        $("#fechanace").val("");
      } else {
        $("#nuevoPax").val(2);
        $("#idHuesAdi").val(datos[0]["id_huesped"]);
        $("#tipodoc").val(datos[0]["tipo_identifica"]);
        $("#apellido1").val(datos[0]["apellido1"]);
        $("#apellido2").val(datos[0]["apellido2"]);
        $("#nombre1").val(datos[0]["nombre1"]);
        $("#nombre2").val(datos[0]["nombre2"]);
        $("#sexOption").val(datos[0]["sexo"]);
        $("#fechanace").val(datos[0]["fecha_nacimiento"]);
        $("#paices").val(datos[0]["pais"]);
        $("#ciudad").val(datos[0]["ciudad"]);
      }
    },
  });
}

function eliminaAcompanante(id) {
  var web = $("#rutaweb").val();
  var parametros = { id: id };
  $("#mensajeEli").css("display", "none");
  $.ajax({
    type: "POST",
    data: parametros,
    url: web + "res/php/eliminaAcompanante.php",
    success: function (datos) {
      $("#mensajeEli").html(datos);
      $("#myModalAcompanantesReserva").modal("hide");
      $(location).attr("href", "reservasActivas");
    },
  });
}

function trasladarConsumos() {
  var web = $("#rutaweb").val();
  var idconsumo = $("#txtIdConsumoTras").val();
  var idreserva = $("#txtIdReservaTras").val();
  var idhuesped = $("#txtIdHuespedTras").val();
  var newreserva = $("#roomChange").val();
  var motivoTras = $("#txtMotivoTras").val();
  var numero = $("#reservaActual").val();

  var parametros = {
    idconsumo: idconsumo,
    idreserva: idreserva,
    idhuesped: idhuesped,
    motivotras: motivoTras,
    newreserva: newreserva,
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
  let { user } = sesion;
  let { usuario, usuario_id } = user;
  /* usuario = sesion["usuario"][0]["usuario"];
  idusuario = sesion["usuario"][0]["usuario_id"]; */
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

function actualizaCiaRecepcion() {
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var idrese = $("#idReservaCia").val();
  var idcia = $("#companiaSele").val();
  /// var idcentro = $("#centroCia").val();

  var parametros = {
    idreserva: idrese,
    idcia,
    /// 'idcentro':idcentro,
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

function calculaRetenciones(id) {
  $.ajax({
    type: "POST",
    url: "res/php/traeRetencionesCia.php",
    data: id,
    success: function (data) {},
  });
}

function apagaselecomp(tipo) {
  idCiaFac = $("#txtIdCiaSal").val();
  idCenFac = $("#txtIdCentroCiaSal").val();
  var reteFte = 0;
  var reteIva = 0;
  var reteIca = 0;

  if (tipo == "2") {
    if (idCiaFac == "0") {
      /*
			$('#inlineRadio2').prop('checked',false);
			$('#inlineRadio1').prop('checked',true);
			*/
      $("#habitacionOptionCon").val(1);
      swal("Precaucion", "Asigne Primero la Compañia", "warning");
      return;
    }
    $("#selecentro").css("display", "block");
    $("#selecomp").css("display", "block");
    $("#seleccionaCiaCon").attr("disabled", true);
    $("#seleccionaCiaCon").attr("disabled", true);
    $(".retencion").removeClass("apaga");
    totalRteFte = parseInt($("#baseRetenciones").val());
    totalImpto = parseInt($("#totalIva").val());
    totalBaseImpto = parseInt($("#totalBaseIva").val());

    traeRetencionesCia(idCiaFac);

    setTimeout(function () {
      retenciones = JSON.parse($("#retenciones").val());
      reteCia = JSON.parse($("#retencionCia").val());
      // retenCia = $("#retencionCia").val();

      let rFte = retenciones.filter(
        (retencion) => retencion.idRetencion == "1"
      );
      let rIva = retenciones.filter(
        (retencion) => retencion.idRetencion == "2"
      );
      let rIca = retenciones.filter(
        (retencion) => retencion.idRetencion == "3"
      );

      let { reteiva, reteica, retefuente } = reteCia;

      if (retefuente == "1") {
        if (rFte[0].baseRetencion <= totalRteFte) {
          reteFte = totalRteFte * (rFte[0].porcentajeRetencion / 100);
        }
      }

      if (reteiva == "1") {
        if (rFte[0].baseRetencion <= totalRteFte) {
          reteIva = totalImpto * (rIva[0].porcentajeRetencion / 100);
        }
      }
      if (reteica == "1") {
        if (rIca[0].baseRetencion <= totalRteFte) {
          reteIca = totalRteFte * (rIca[0].porcentajeRetencion / 100);
        }
      }
      reteFte = parseInt(reteFte.toFixed(0));
      reteIva = parseInt(reteIva.toFixed(0));
      reteIca = parseInt(reteIca.toFixed(0));

      $("#reteiva").val(number_format(reteIva, 2));
      $("#reteica").val(number_format(reteIca, 2));
      $("#retefuente").val(number_format(reteFte, 2));

      $("#porceReteiva").val(number_format(rIva[0].porcentajeRetencion, 2));
      $("#porceReteica").val(number_format(rIca[0].porcentajeRetencion, 2));
      $("#porceRetefuente").val(number_format(rFte[0].porcentajeRetencion, 2));

      $("#totalReteiva").val(reteIva);
      $("#totalReteica").val(reteIca);
      $("#totalRetefuente").val(reteFte);

      sumaTotales();
    }, 1000);
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

    sumaTotales();
  }
}

function sumaTotales() {
  toCon = parseInt($("#totalConsumo").val());
  toImp = parseInt($("#totalImpuesto").val());
  toAbo = parseInt($("#totalAbono").val());
  toRiv = parseInt($("#totalReteiva").val());
  toRic = parseInt($("#totalReteica").val());
  toFue = parseInt($("#totalRetefuente").val());

  totGen = toCon + toImp - toAbo - toRiv - toRic - toFue;

  $("#total").val(number_format(totGen, 2));
  $("#SaldoFolioActual").val(totGen);
  $("#txtValorPago").val(totGen);
}

function traeRetencionesCia(cia) {
  parametros = {
    cia,
  };
  $.ajax({
    type: "POST",
    url: "res/php/traeRetencionesCia.php",
    data: parametros,
    success: function (data) {
      $("#retencionCia").val(data);
    },
  });
}

function anulaIngreso() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let { user } = sesion;
  let { usuario, usuario_id } = user;
  /* usuario = sesion["usuario"][0]["usuario"];
  idusuario = sesion["usuario"][0]["usuario_id"]; */

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

function seleccionaHuespedReserva(id) {
  var web = $("#webPage").val();
  var pagina = $("#ubicacion").val();
  var parametros = {
    id: id,
  };
  $.ajax({
    url: web + "/res/php/seleccionaHuesped.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $("#datosHuespedAdi").html(data);
    },
  });

  $("#myModalBuscaHuesped").modal("hide");
}

function seleccionaCambioHuespedReserva(id) {
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var rese = $("#nroreserva").val();

  var parametros = {
    hues: id,
    rese: rese,
  };
  $.ajax({
    url: web + "/res/php/seleccionaHuespedRes.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $("#datosHuespedAdi").html(data);
      $("#myModalBuscaHuespedRes").modal("hide");
      $("#myModalReasignarHuesped").modal("hide");
      $(location).attr("href", pagina);
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
              title: "Auditoria Nocturna Terminada con Exito !",
              type: "success",
              confirmButtonText: "Aceptar",
              closeOnConfirm: false,
            },
            function () {
              /// $(location).attr('href','home');
              cierraSesion();
            }
          );
        },
      });
    } else if (sale != 0) {
      $.ajax({
        url: web + "res/php/habitacionesSinSalir.php",
        type: "POST",
        data: { fecha: fecha },
        success: function (data) {
          $("#aviso").html(data);
        },
      });
    } else {
      $.ajax({
        url: web + "res/php/registrosSinImprimir.php",
        type: "POST",
        data: { fecha: fecha },
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
    $.ajax({
      url: "auditoria/" + procesor,
      type: "POST",
      data: { fecha: fecha },
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
    id: id,
    folio: folio,
  };
  $.ajax({
    url: "res/php/moverCargo.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      /// $('#mensajeAnu').html(data)
      ///	$('#myModalCargosConsumo').modal('hide')
      /// $(location).attr('href',pagina);
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
    codigo: codigo,
    textcodigo: textcodigo,
    canti: canti,
    valor: valor,
    refer: refer,
    folio: folio,
    detalle: detalle,
    numero: numero,
    idhues: idhues,
    room: room,
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
  var actualval = $("#valortarifaAct").val();
  var tiponue = $("#tarifahab").val();
  var nuevoval = $("#valortarifa").val();
  var motivo = $("#motivoCambio").val();
  var mmto = 0;
  var motivo = 0;
  var parametros = {
    id: id,
    tipoact: tipoact,
    habiact: actualval,
    tiponue: tiponue,
    habinue: nuevoval,
    motivo: motivo,
    mmto: mmto,
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
  var habi = $("#tipoocupacionAct").val();
  if (hom + muj == 0) {
    $("#mensaje").html(
      '<div class="alert alert-warning"><h3 class="tituloPagina">Sin Adultos Asignados a la Reserva</h3></div>'
    );
    $("#hombres").focus();
  } else {
    $("#mensaje").html("");
    var parametros = {
      tarifa: tarifa,
      tipo: tipo,
      hom: hom,
      muj: muj,
      nin: nin,
      habi: habi,
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
    id: id,
    tipoact: tipoact,
    habiact: habiact,
    tiponue: tiponue,
    habinue: habinue,
    motivo: motivo,
    observa: observa,
    mmto: mmto,
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
  var parametros = { tipo: tipo, llega: llega, sale: sale };
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

function seleccionaHabitacionUpd(actual, anterior, numero) {
  var parametros = {
    tipo: actual,
    anterior: anterior,
    numero: numero,
  };
  $.ajax({
    type: "POST",
    url: "res/php/seleccionaHabitacionUpd.php",
    data: parametros,
    beforeSend: function (objeto) {},
    success: function (data) {
      $("#nrohabitacionUpd option").remove();
      $("#nrohabitacionUpd").append(data);
    },
  });
}

function updateReserva() {
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
  var valtar = $("#valortarifaUpd").val();
  if (hom + muj == 0) {
    $("#mensaje").html(
      '<div class="alert alert-warning"><h3 class="tituloPagina">Sin Adultos Asignados a la Reserva</h3></div>'
    );
    $("#hombres").focus();
  } else {
    $("#mensaje").html("");
    var parametros = {
      tarifa: tarifa,
      tipo: tipo,
      hom: hom,
      muj: muj,
      nin: nin,
    };
    $.ajax({
      url: "res/php/valorTarifa.php",
      type: "POST",
      data: parametros,
      success: function (data) {
        $("#valortarifaUpd").val(data);
      },
    });
  }
}

function updateCompania() {
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var parametros = $("#formUpdateCompania").serialize();
  $.ajax({
    type: "POST",
    data: parametros,
    url: "res/php/updateCompania.php",
    success: function (datos) {
      $(location).attr("href", pagina);
    },
  });
}

function actualizaHuesped() {
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var parametros = $("#formUpdateHuesped").serialize();
  $.ajax({
    type: "POST",
    data: parametros,
    url: "res/php/updateHuesped.php",
    success: function (datos) {
      $(location).attr("href", pagina);
    },
  });
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
  let { user } = sesion;
  let { usuario } = user;
  // usuario = sesion["usuario"][0]["usuario"];
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
  let { user } = sesion;
  let { usuario, usuario_id } = user;
  /* usuario = sesion["usuario"][0]["usuario"];
  idusuario = sesion["usuario"][0]["usuario_id"]; */

  var id = $("#txtIdConsumoAnu").val();
  var motivo = $("#txtMotivoAnula").val();
  var reserva = $("#txtIdReservaAnu").val();
  var parametros = {
    id,
    motivo,
    usuario,
    idusuario: usuario_id,
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
      // activaFolio(reserva, 1);
      // movimientosFactura(numero);
      activaFolio(reserva, 1);

      // $(location).attr("href", web + "facturacionHuesped");
    },
  });
}

function modificaReserva(reserva) {
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var parametros = { reserva: reserva };
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
  let { user } = sesion;
  let { usuario, usuario_id } = user;
  /* usuario = sesion["usuario"][0]["usuario"];
  idusuario = sesion["usuario"][0]["usuario_id"]; */
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  $("input:radio:checked").each(function () {
    cargo = $(this).val();
  });

  var cargar = $("#cargarHabitacion").val();
  var parametros = {
    cargar,
    cargo,
    usuario,
    idusuario: usuario_id,
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
  var parametros = { reserva: reserva };
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

function salidaHuesped() {
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var saldo = $("#SaldoActual").val();
  var abonos = $("#totalPagos").val();
  let perfilFac = $("#perfilFactura").val();
  var tipofac = $(
    "input[name=habitacionOptionCon]:checked",
    "#guardarPagosRoomSal"
  ).val();

  if (tipofac == 2 && perfilFac == 2) {
    swal(
      "Precaucion",
      "NO pude Utilziar esa Forma de Pago para la presente Cuenta",
      "warning"
    );
    return;
  }

  var pago = $("#txtValorPago").val();
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let { user } = sesion;
  let { usuario, usuario_id, tipo } = user;

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
    var reserva = $("#reservaActual").val();
    var idhues = $("#titular").val();
    var room = $("#txtNumeroHabSal").val();
    var codigo = $("#codigoPago").val();
    var textopago = $("#codigoPago option:selected").text();
    var detalle = $("#txtDetallePag").val();
    var refer = $("#txtReferenciaPag").val();
    var folio = $("#folioActivo").val();
    var idcia = $("#txtIdCiaSal").val();
    var baseIva = $("#totalIva").val();
    var baseRete = $("#baseRetenciones").val();
    var baseIca = $("#baseRetenciones").val();
    var reteiva = $("#totalReteiva").val();
    var reteica = $("#totalReteica").val();
    var retefuente = $("#totalRetefuente").val();
    var porceReteiva = $("#porceReteiva").val();
    var porceReteica = $("#porceReteica").val();
    var porceRetefuente = $("#porceRetefuente").val();

    // let perfilFac = $("#perfilFactura").val();
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
      idcentro,
      usuario,
      usuario_id,
      perfilFac,
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
    };
    $.ajax({
      type: "POST",
      url: web + "res/php/ingresoPago.php",
      dataType: "json",
      data: parametros,
      success: function (data) {
        if (perfilFac == 1) {
          /* var ventana = window.open(
            "imprimir/facturas/" + data[0],
            "PRINT",
            "height=600,width=600"
          ); */
        } else {
          var ventana = window.open(
            "imprimir/notas/" + data[0],
            "PRINT",
            "height=600,width=600"
          );
        }

        if (data[1] == "0") {
          setTimeout(function () {
            swal(
              "Atencion",
              "Salida del Huesped realizada con Exito",
              "success"
            );
            $(location).attr("href", "home");
          }, 2000);
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
    reserva: reserva,
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
  let { user } = sesion;
  let { usuario, usuario_id } = user;
  /* usuario = sesion["usuario"][0]["usuario"];
  idusuario = sesion["usuario"][0]["usuario_id"]; */

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
  var parametros = { reserva: reserva };
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
  let { user } = sesion;
  let { usuario, usuario_id, tipo } = user;
  /*
  usuario = sesion["usuario"][0]["usuario"];
  idusuario = sesion["usuario"][0]["usuario_id"]; 
  nivel = sesion["usuario"][0]["tipo"];
  */
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var nrohabi = $("#nrohabitacion").val();

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
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var parametros = { reserva: reserva };
  $.ajax({
    type: "POST",
    url: web + "views/facturacionHuesped.php",
    data: parametros,
    success: function (data) {
      $("#listado").html("");
      $("#listado").html(data);
      activaFolio(reserva, 1);
    },
  });
}

function getCiudadesPais(pais, city) {
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var edita = $("#edita").val();
  if (edita == 1) {
    $("#ciudadUpd option").remove();
  } else {
    $("#ciudadHue option").remove();
  }

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

function guardasinReserva() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let { user } = sesion;
  let { usuario, usuario_id } = user;
  /* usuario = sesion["usuario"][0]["usuario"];
  idusuario = sesion["usuario"][0]["usuario_id"]; */
  iden = $("#identifica").val();
  if (typeof iden == "undefined") {
    swal("Precaucion", "Seleccione el Huesped a Reservar", "warning");
    return;
  }
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var parametros = $("#formReservas").serializeArray();

  parametros.push({ name: "usuario", value: usuario });
  parametros.push({ name: "idusuario", value: usuario_id });

  $.ajax({
    type: "POST",
    data: parametros,
    url: "res/php/ingresoSinReserva.php",
    beforeSend: function (objeto) {},
    success: function (datos) {
      swal("Atencion", "Huesped Registrado Con Exito", "success");
      $(location).attr("href", "home");
    },
  });
}

function restaFechas() {
  var web = $("#webPage").val();
  var pagina = $("#ubicacion").val();
  var edita = $("#edita").val();
  if (edita == 1) {
    var fecha = $("#llegadaUpd").val();
    var sale = $("#salidaUpd").val();
  } else {
    var fecha = $("#llegada").val();
    var sale = $("#salida").val();
  }
  var parametros = { fecha: fecha, sale: sale };
  $.ajax({
    type: "POST",
    url: web + "res/php/restaFechas.php",
    data: parametros,
    success: function (data) {
      if (edita == 1) {
        $("#nochesUpd").val(data);
      } else {
        $("#noches").val(data);
      }
    },
  });
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
  var parametros = { fecha: fecha, dias: dias };
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
  let { user } = sesion;
  let { usuario, usuario_id } = user;
  /* usuario = sesion["usuario"][0]["usuario"];
  idusuario = sesion["usuario"][0]["usuario_id"]; */
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var codigo = $("#codigoAbono").val();
  var textcodigo = $("#codigoAbono option:selected").text();
  var valor = $("#txtValorAbono").val();
  var refer = $("#txtReferenciaAbo").val();
  var detalle = $("#txtDetalleAbo").val();
  var numero = $("#txtIdReservaAbo").val();
  var idhues = $("#txtIdHuespedAbo").val();
  var room = $("#txtNumeroHabAbo").val();
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
    idusuario: usuario_id,
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
  let { user } = sesion;
  let { usuario, usuario_id } = user;
  /* usuario = sesion["usuario"][0]["usuario"];
  idusuario = sesion["usuario"][0]["usuario_id"]; */
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
    idusuario: usuario_id,
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
        $(location).attr("href", pagina);
      } else {
        $("#myModalCargosConsumo").modal("hide");
        movimientosFactura(numero);
      }
    },
  });
}

function ingresaReserva() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let { user } = sesion;
  let { usuario } = user;
  // usuario = sesion["usuario"][0]["usuario"];
  var pagina = $("#ubicacion").val();
  var numero = $("#txtIdReservaIng").val();
  var habita = $("#txtNumeroHabIng").val();
  var parametros = {
    numero,
    habita,
    usuario,
  };
  $.ajax({
    type: "POST",
    url: "res/php/ingresaReserva.php",
    data: parametros,
    success: function (data) {
      if (data == 1) {
        swal(
          "Reserva Ingresada !",
          "Su Reserva a Sido ingresada con Exito",
          "success"
        );
      } else {
        swal("Precaucion !", "Su Reserva no se pudo ingresar", "warning");
      }
      $(location).attr("href", "llegadasDelDia");
    },
  });
}

function imprimeDeposito(web, numero, pagina) {
  $.ajax({
    url: web + "paginas/imprimeDeposito.php",
    type: "POST",
    data: { numero: numero },
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
  let { user } = sesion;
  let { usuario, usuario_id } = user;
  /* usuario = sesion["usuario"][0]["usuario"];
  idusuario = sesion["usuario"][0]["usuario_id"]; */
  var pagina = $("#ubicacion").val();
  var motivo = $("#motivoCancela").val();
  var numero = $("#txtIdReservaCan").val();
  var observa = $("#areaObservacionesCan").val();
  var parametros = {
    motivo,
    observa,
    numero,
    idusuario: usuario_id,
    usuario,
  };
  $.ajax({
    type: "POST",
    url: "res/php/cancelaReserva.php",
    data: parametros,
    success: function (data) {
      if (data == -1) {
        titulo = "Atencion !! ";
        mensaje = "Anule Primero el Deposito ";
        alerta = "warning";
      }
      if (data == 0) {
        titulo = "Precaucion !! ";
        mensaje = "Su Reserva no se pudo cancelar ";
        alerta = "warning";
      }
      if (data == 1) {
        titulo = "Atencion";
        mensaje = "Reserva Cancelada con Exito ";
        alerta = "warning";
      }
      /* */
      swal(titulo, mensaje, alerta);
      $(location).attr("href", pagina);
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
  let { user } = sesion;
  let { usuario, usuario_id } = user;
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var parametros = $("#formCompania").serializeArray();

  parametros.push({ name: "usuario", value: usuario });
  parametros.push({ name: "idusuario", value: usuario_id });

  $.ajax({
    type: "POST",
    data: parametros,
    url: "res/php/ingresoCompania.php",
    success: function (datos) {
      $(location).attr("href", pagina);
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

function buscaHuesped(regis) {
  var parametros = { iden: regis };
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

function seleccionaHabitacion() {
  var llega = $("#llegada").val();
  var sale = $("#salida").val();
  var tipo = $("#tipohabi").val();
  var parametros = {
    llega: llega,
    sale: sale,
    tipo: tipo,
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
  var parametros = { tipo: tipo, llega: llega, sale: sale };
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
  var tipo = $("#tipohabi").val();
  var hom = $("#hombres").val();
  var muj = $("#mujeres").val();
  var nin = $("#ninos").val();
  if (tipo == "CMA") {
    var parametros = {
      tarifa: tarifa,
      tipo: tipo,
      hom: hom,
      muj: muj,
      nin: nin,
    };
    $.ajax({
      url: "res/php/valorTarifa.php",
      type: "POST",
      data: parametros,
      success: function (data) {
        $("#valortar").val(data);
        $("#valortar").focus();
      },
    });
  } else {
    if (hom + muj == 0) {
      swal({
        title: "Error!",
        text: "Sin Adultos en esta Reserva",
        type: "error",
        confirmButtonText: "Aceptar",
      });
      $("#hombres").focus();
    } else {
      var parametros = {
        tarifa: tarifa,
        tipo: tipo,
        hom: hom,
        muj: muj,
        nin: nin,
      };
      $.ajax({
        url: "res/php/valorTarifa.php",
        type: "POST",
        data: parametros,
        success: function (data) {
          $("#valortar").val(data);
          $("#valortar").focus();
        },
      });
    }
  }
}

function guardaReserva() {
  iden = $("#identifica").val();
  if (typeof iden == "undefined") {
    swal("Precaucion", "Seleccione el Huesped a Reservar", "warning");
    return;
  }
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let { user } = sesion;
  let { usuario, usuario_id } = user;
  /*  usuario = sesion["usuario"][0]["usuario"];
  idusuario = sesion["usuario"][0]["usuario_id"]; */
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
      swal("Reserva Nro " + datos, "Reserva Creada con Exito", "success");
      $(location).attr("href", "home");
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
    console.log("El nit/cédula '" + myNit + "' no es válido(a).");
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

function reservasPorFecha() {
  var web = $("#rutaweb").val();
  desdeFe = $("#desdeFecha").val();
  hastaFe = $("#hastaFecha").val();
  huesped = $("#desdeHuesped").val();
  parametros = {
    desdeFe: desdeFe,
    hastaFe: hastaFe,
    huesped: huesped,
  };

  if (desdeFe == "" && hastaFe == "" && huesped == "" && empresa == "") {
    swal("Atencion", "Seleccione un Criterio de Busqueda", "warning");
  } else {
    $.ajax({
      url: web + "res/php/reservasPorRango.php",
      type: "POST",
      data: parametros,
      success: function (x) {
        $(".imprimeInforme").html(x);
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
      numero: numero,
      reserva: reserva,
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
  let { user } = sesion;
  let { usuario, usuario_id } = user;
  /* usuario = sesion["usuario"][0]["usuario"];
  idusuario = sesion["usuario"][0]["usuario_id"]; */

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
      console.log(datos);
      var ventana = window.open(
        `imprimir/notas/Abono_${datos}.pdf`,
        "PRINT",
        "height=600,width=600"
      );
      $("#myModalDepositoReserva").modal("hide");
      $(location).attr("href", pagina);
    },
  });
}

function subirArchivosCia() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let { user } = sesion;
  let { usuario_id } = user;
  /* usuario = sesion["usuario"][0]["usuario"];
  idusuario = sesion["usuario"][0]["usuario_id"]; */

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
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var edita = $("#edita").val();
  if (edita == 1) {
    $("#ciudadExpUpd option").remove();
  } else {
    $("#ciudadExp option").remove();
  }

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
        if (edita == 1) {
          $("#ciudadExpUpd").append(data);
          $("#ciudadExpUpd").val(city);
        } else {
          $("#ciudadExp").append(data);
        }
      }
    },
  });
}

function imprimirHistoricoRegistro(registro) {
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var parametros = {
    registro: registro,
  };
  $.ajax({
    type: "POST",
    data: parametros,
    url: web + "res/php/imprimeHistoricoRegistro.php",
    success: function (datos) {
      $("#imprimeRegistroHotelero").html(datos);
      $(location).attr("href", pagina);
    },
  });
}

function imprimirPreRegistro(reserva) {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let { user } = sesion;
  let { usuario } = user;
  // usuario = sesion["usuario"][0]["usuario"];
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
  let { user } = sesion;
  let { usuario } = user;
  // usuario = sesion["usuario"][0]["usuario"];
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var parametros = {
    reserva,
    usuario,
  };
  $.ajax({
    type: "POST",
    data: parametros,
    url: web + "imprimir/confirmaReserva.php",
    beforeSend: function (objeto) {},
    success: function (datos) {
      $("#confirmaReserva").html(datos);
      setTimeout(function () {
        $("#confirmaReserva").html("");
      }, 5000);
    },
  });
}

function imprimirOrdenM(orden) {
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var parametros = {
    orden: orden,
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
  let { user } = sesion;
  let { usuario, usuario_id } = user;
  /* usuario = sesion["usuario"][0]["usuario"];
  idusuario = sesion["usuario"][0]["usuario_id"]; */
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
      idusuario: usuario_id,
    },
    success: function () {
      $(location).attr("href", pagina);
    },
  });
}

function adicionaObservacionMmto() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  usuario = sesion["usuario"][0]["usuario"];

  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var id = $("#idObsMto").val();
  var ante = $("#observaAntMto").val();
  var obse = $("#adicionaObsMto").val();

  parametros = {
    id: id,
    obse: obse,
    ante: ante,
    usuario: usuario,
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
  usuario = sesion["usuario"][0]["usuario"];

  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var parametros = $("#formAdicionaMantenimiento").serializeArray();

  parametros.push({ name: "usuario", value: usuario });

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
      /*
			if(datos==1){
			}else{
				$("#btnMmto").attr('disabled','disabled');	
	  		$('#modalReservasIns').css('display','none')
	  		$('#mensajeMmto').css('display','block')
	  		$('#mensajeMmto').html(datos)
			}
			*/
    },
  });
}

function entregaObjeto() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  usuario = sesion["usuario"][0]["usuario"];
  idusuario = sesion["usuario"][0]["usuario_id"];

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
  let { user } = sesion;
  let { usuario } = user;
  // usuario = sesion["usuario"][0]["usuario"];
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
  let { user } = sesion;
  let { usuario, usuario_id } = user;
  /* usuario = sesion["usuario"][0]["usuario"];
  idusuario = sesion["usuario"][0]["usuario_id"]; */

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

function cambiaEstado(habi, estado, cambio) {
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();

  switch (cambio) {
    case "SO":
      color = "bg-suciaOcu";
      break;
    case "SV":
      color = "bg-suciaVac";
      break;
    case "LO":
      color = "bg-limpiaOcu";
      break;
    case "LV":
      color = "bg-limpiaVac";
      break;
    case "FO":
      color = "bg-maroon";
      break;
    case "FS":
      color = "bg-red";
      break;
    default:
      $color = "aliceblue";
      break;
  }

  switch (estado) {
    case "SO":
      actual = "bg-suciaOcu";
      break;
    case "SV":
      actual = "bg-suciaVac";
      break;
    case "LO":
      actual = "bg-limpiaOcu";
      break;
    case "LV":
      actual = "bg-limpiaVac";
      break;
    case "FO":
      actual = "bg-maroon";
      break;
    case "FS":
      actual = "bg-red";
      break;
    default:
      actual = "aliceblue";
      break;
  }

  $.ajax({
    url: "res/php/cambiaEstadoHabitacion.php",
    type: "POST",
    data: {
      habi: habi,
      cambio: cambio,
      estado: estado,
    },
    success: function () {
      $("#" + habi).removeClass(actual);
      $("#" + habi).addClass(color);
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
      habi: habi,
      cambio: cambio,
      estado: estado,
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
    desdeFe: desdeFe,
    hastaFe: hastaFe,
    desdeNu: desdeNu,
    hastaNu: hastaNu,
    huesped: huesped,
    empresa: empresa,
    formaPa: formaPa,
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
  var web = $("#rutaweb").val();
  desdeFe = $("#desdeFecha").val();
  hastaFe = $("#hastaFecha").val();
  desdeNu = $("#desdeNumero").val();
  hastaNu = $("#hastaNumero").val();
  huesped = $("#desdeHuesped").val();
  empresa = $("#desdeEmpresa").val();
  formaPa = $("#desdeFormaPago").val();
  parametros = {
    desdeFe: desdeFe,
    hastaFe: hastaFe,
    desdeNu: desdeNu,
    hastaNu: hastaNu,
    huesped: huesped,
    empresa: empresa,
    formaPa: formaPa,
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
      url: web + "res/php/facturasPorRango.php",
      type: "POST",
      data: parametros,
      success: function (x) {
        $(".imprimeInforme").html(x);
      },
    });
  }
}

function validaCierreDiario() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let { user } = sesion;
  let { usuario, usuario_id } = user;
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
          '<h3 class="alert alert-danger"><i style="font-size:3em;margin-top:1px;color:#BBB0B0; " class="ion ion-ios-gear-outline fa-spin"></i>Procesando Auditoria, NO Interrumpir</h3>'
        );
      },
      success: function (x) {
        if (x == 1) {
          swal("Atencion", "Auditoria Terminada con Exito", "success");
          setTimeout(function () {
            $(location).attr("href", "home");
          }, 5000);
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
  var pagina = $("#ubicacion").val();
  login = $("#login").val().toUpperCase();
  login = $.trim(login);
  pass = $("#pass").val();
  usuario = $("#usuarioActivo").val();
  usuario = $.trim(usuario);

  parametros = {
    login: login,
    pass: pass,
    usuario: usuario,
  };
  if (usuario == login) {
    $.ajax({
      url: "res/php/validaCajero.php",
      type: "POST",
      data: parametros,
      success: function (x) {
        if (x == 0) {
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
  let { user } = sesion;
  let { usuario } = user;
  // usuario = sesion["usuario"][0]["usuario"];
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var rese = $("#reservaObs").val();
  var obse = $("#adicionaObs").val();
  var ante = $("#observaAnt").val();
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

function subirArchivos() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let { user } = sesion;
  let { usuario, usuario_id } = user;
  /*  usuario = sesion["usuario"][0]["usuario"];
  idusuario = sesion["usuario"][0]["usuario_id"]; */
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

function verObservaciones(reserva, estado) {
  var web = $("#rutaweb").val();
  var pagina = $("#ubicacion").val();
  var parametros = {
    reserva: reserva,
    estado: estado,
  };
  $.ajax({
    type: "POST",
    url: web + "res/php/observacionesReservaModal.php",
    data: parametros,
    success: function (data) {
      $("#myModalVerObservaciones").modal("show");
      $("#observacionesHuesped").html(data);
    },
  });
}

function salidaHuespedCongelada() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let { user } = sesion;
  let { usuario, usuario_id } = user;
  /* usuario = sesion["usuario"][0]["usuario"];
  idusuario = sesion["usuario"][0]["usuario_id"]; */

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
    let perfilFac = $("#perfilFactura").val();
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
    };
    $.ajax({
      type: "POST",
      url: web + "res/php/ingresoPago.php",
      data: parametros,
      success: function (data) {
        var ventana = window.open(
          "imprimir/imprimeFactura.php",
          "PRINT",
          "height=600,width=600"
        );
        if (data == -1) {
          setTimeout(function () {
            swal(
              "Atencion",
              "Salida del Huesped realizada con Exito",
              "success"
            );
            $(location).attr("href", "home");
          }, 2000);
        } else {
          swal(
            "Atencion",
            "La Cuenta Actual Presenta Folios con Saldos",
            "warning",
            5000
          );
          $("#myModalSalidaCongelada").modal("hide");
          $("#folios1").hide().removeClass("active").slideDown("fast");
          $("#folios2").hide().removeClass("active").slideDown("fast");
          $("#folios3").hide().removeClass("active").slideDown("fast");
          $("#folios4").hide().removeClass("active").slideDown("fast");
          $("#folio1").hide().removeClass("in active fade").slideDown("fast");
          $("#folio2").hide().removeClass("in active fade").slideDown("fast");
          $("#folio3").hide().removeClass("in active fade").slideDown("fast");
          $("#folio4").hide().removeClass("in active fade").slideDown("fast");
          $("#folio1").css("display", "none");
          $("#folio2").css("display", "none");
          $("#folio3").css("display", "none");
          $("#folio4").css("display", "none");
          $(data).hide().addClass("in active").slideDown("fast");
          if (data == "folios1") {
            $("#folio1").hide().addClass("in active").slideDown("fast");
            $("#folio1").css("display", "block");
          }
          if (data == "folios2") {
            $("#folio2").hide().addClass("in active").slideDown("fast");
            $("#folio2").css("display", "block");
          }
          if (data == "folios3") {
            $("#folio3").hide().addClass("in active").slideDown("fast");
            $("#folio3").css("display", "block");
          }
          if (data == "folios4") {
            $("#folio4").addClass("in active").slideDown("fast");
            $("#folio4").css("display", "block");
          }
          $(data).click();
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
