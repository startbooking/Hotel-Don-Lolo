function lista_salidas() {
  var codigo = $("#mov_entradas").val();
  var parametros = { almacen: codigo };
  if (codigo == "") {
    var n = noty({
      text: "Sin Almacen Seleccionado ",
      theme: "relax",
      layout: "center",
      type: "information",
      modal: "true",
      buttons: [
        {
          addClass: "btn btn-danger btn-md",
          text: "Aceptar",
          onClick: function ($noty) {
            $("#mov_entradas").focus();
            $noty.close();
          },
        },
      ],
    });
    return;
  }

  $("#loader").fadeIn("slow");
  $.ajax({
    url: "../code/code_lista_salidas.php",
    type: "post",
    data: parametros,
    beforeSend: function (objeto) {
      $("#loader2").html("<img src='../../img/loader.gif'>");
    },
    success: function (data) {
      $(".almacen").html(data).fadeIn("slow");
      $("#nuevo_mov").attr("disabled", false);
      $("#loader2").html("");
    },
  });
}

function pone_almacen_movimientos(page) {
  var parametros = { action: "ajax", page: page };
  $("#loader").fadeIn("slow");
  $.ajax({
    url: "../code/pone_almacen_movimientos_salidas.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#loader").html("<img src='../../img/loader.gif'>");
    },
    success: function (data) {
      $(".mov_entradas").html(data).fadeIn("slow");
      $("#loader").html("");
      // $("#nuevo_mov").attr("disabled", true);
    },
  });
}

$("#ModalDetalleMovimiento").on("show.bs.modal", function (event) {
  var button = $(event.relatedTarget); // Botón que activó el modal
  var numero = button.data("numero"); // Extraer la información de atributos de datos
  var almacen = button.data("almacen"); // Extraer la información de atributos de datos
  var tipomov = button.data("tipmov"); // Extraer la información de atributos de datos
  var tipo = button.data("tipo"); // Extraer la información de atributos de datos
  var action = "ajax";
  var modal = $(this);
  modal.find(".modal-title").text("Detalle Movimiento Numero: " + numero);
  $(".alert").hide(); //Oculto alert
  $("#cargador").fadeIn("slow");
  $.ajax({
    type: "POST",
    url: "../code/code_cargar_movimientos.php",
    data:
      "bodega=" +
      almacen +
      "&numero=" +
      numero +
      "&action=" +
      action +
      "&tipo=" +
      tipo +
      "&tipomov=" +
      tipomov,
    beforeSend: function (objeto) {
      $("#cargador").html('<img src="../../img/loader.gif"> Cargando ...');
    },
    success: function (data) {
      $(".outer_div1").html(data).fadeIn("slow");
      $("#cargador").html("");
    },
  });
});

$("#ModalAnulaMovimiento").on("show.bs.modal", function (event) {
  var button = $(event.relatedTarget); // Botón que activó el modal
  var numero = button.data("numero"); // Extraer la información de atributos de datos
  var almacen = button.data("almacen"); // Extraer la información de atributos de datos
  var tipomov = button.data("tipmov"); // Extraer la información de atributos de datos
  var tipo = button.data("tipo"); // Extraer la información de atributos de datos
  var modal = $(this);

  modal.find("#numero").val(numero);
  modal.find("#almacen").val(almacen);
  modal.find("#tipo").val(tipo);
  modal.find("#tipomov").val(tipomov);
});

$("#AnulaDatosMovimiento").submit(function (event) {
  var parametros = $(this).serialize();
  $.ajax({
    type: "POST",
    url: "../code/code_anula_movimiento.php",
    data: parametros,
    beforeSend: function (objeto) {
      $(".datos_ajax_delete").html("Anulando Movimiento ...");
    },
    success: function (datos) {
      $(".datos_ajax_delete").html(datos);
      $("#ModalAnulaMovimiento").modal("hide");
      lista_entradas();
    },
  });
  event.preventDefault();
});

function pone_tipo_movimiento(page) {
  var parametros = { action: "ajax", page: page };
  $("#loader").fadeIn("slow");
  $.ajax({
    url: "../code/pone_tipo_movimiento_salida.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#loader").html("<img src='../../img/loader.gif'>");
    },
    success: function (data) {
      $("#pone_tipo_movi").html(data).fadeIn("slow");
      $("#loader").html("");
    },
  });
}

function pone_proveedor(page) {
  var parametros = { action: "ajax", page: page };
  $("#loader").fadeIn("slow");
  $.ajax({
    url: "../code/pone_proveedor.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#loader").html("<img src='../../img/loader.gif'>");
    },
    success: function (data) {
      $("#pone_proveedor").html(data).fadeIn("slow");
      $("#loader").html("");
    },
  });
}

function pone_almacen(page) {
  var parametros = { action: "ajax", page: page };
  $("#loader").fadeIn("slow");
  $.ajax({
    url: "../code/pone_almacenes_salidas.php",
    data: parametros,
    beforeSend: function (objeto) {},
    success: function (data) {
      $("#pone_almacen").html(data).fadeIn("slow");
    },
  });
}

function pone_producto(page) {
  var parametros = { action: "ajax", page: page };
  $("#loader").fadeIn("slow");
  $.ajax({
    url: "../code/pone_producto.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#loader").html("<img src='../../img/loader.gif'>");
    },
    success: function (data) {
      $("#pone_producto").html(data).fadeIn("slow");
      $("#loader").html("");
    },
  });
}

function pone_impuesto(page) {
  var parametros = { action: "ajax", page: page };
  $("#loader").fadeIn("slow");
  $.ajax({
    url: "../code/pone_impuesto.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#loader").html("<img src='../../img/loader.gif'>");
    },
    success: function (data) {
      $("#pone_impuesto").html(data).fadeIn("slow");
      $("#porc_impto").val(0);
      $("#loader").html("");
    },
  });
}

function pone_unidad(page) {
  var parametros = { action: "ajax", page: page };
  $("#loader").fadeIn("slow");
  $.ajax({
    url: "../code/pone_unidad.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#loader").html("<img src='../../img/loader.gif'>");
    },
    success: function (data) {
      $("#pone_unidad").html(data).fadeIn("slow");
      $("#loader").html("");
    },
  });
}

function busca_producto(codigo) {
  $.ajax({
    beforeSend: function () {},
    url: "../code/busca_productos.php",
    type: "POST",
    dataType: "json",
    data: "codigo=" + $("#producto").val(),
    success: function (x) {
      $("#codigo").val(x.cod_prod);
      $("#costo").val(x.pco_prod);
      $("#unidad").val(x.uco_prod);
      $("#descripcion").val(x.nom_prod);
      $("#cantidad").val(0);
      $("#costo").attr("disabled", false);
      $("#cantidad").attr("disabled", false);
    },
  });
  /* $(document).ready(function(){
  }) */
}

function activa_botones_mov() {
  $("#btn-add-article").attr("disabled", false);
  $("#btn-cancel-article").attr("disabled", false);
}

function agrega_a_lista() {
  var movi = $("#tipo_movi").val();
  var prov = $("#proveedor").val();
  var fech = $("#fecha").val();
  var fact = $("#factura").val();
  var alma = $("#almacen").val();
  if (movi == "") {
    alert("Sin Tipo de Movimiento Asignado A Este Movimiento ");
    $("#tipo_movi").focus();
    return;
  }
  if (prov == "") {
    alert("Sin Proveedor Asignado A Este Movimiento ");
    $("#proveedor").focus();
    return;
  }
  if (fech == "") {
    alert("Sin Fecha Asignado A Este Movimiento ");
    $("#fecha").focus();
    return;
  }
  if (fact == "") {
    alert("Sin Nuevo de Documento Asignado A Este Movimiento ");
    $("#factura").focus();
    return;
  }

  if (alma == "") {
    alert("Sin Almacen Asignado A Este Movimiento ");
    $("#almacen").focus();
    return;
  }

  var prod = $("#codigo").val();
  var unid = $("#unidad").val();
  var valp = $("#costo").val();
  var cant = $("#cantidad").val();
  var desc = $("#descripcion").val();
  var impu = $("#impuesto").val();
  var pori = $("#porc_impto").val();

  if ($("#incluido").is(":checked")) {
    incl = 1;
  } else {
    incl = 0;
  }
  if (incl == 1) {
    nval = valp / (1 + pori / 100);
    valp = nval;
  }
  valu = valp / cant;
  vali = valp * (pori / 100);
  vato = vali + valu * cant;
  $("#tabla_articulos > tbody").append(
    "<tr><td>" +
      prod +
      "</td><td>" +
      desc +
      "</td><td align='right'>" +
      cant +
      "</td><td align='right'>" +
      valu.toFixed(2) +
      "</td><td align='right'>" +
      vali.toFixed(2) +
      "</td><td align='right'>" +
      vato.toFixed(2) +
      "</td><td align='center'><button id='" +
      prod +
      "' class='btn btn-danger btn-xs elimina_articulo' onclick='actualiza_entrada_temp(this.id);'><i class='fa fa-times'></i></button></td></tr>"
  );
  /*graba la entrada temporalmente*/
  $.ajax({
    beforeSend: function () {},
    url: "../code/guarda_movimiento_temp.php",
    type: "POST",
    data:
      "tipo=" +
      "1" +
      "&tipo_movi=" +
      $("#tipo_movi").val() +
      "&factura=" +
      $("#factura").val() +
      "&fecha=" +
      $("#fecha").val() +
      "&proveedor=" +
      $("#proveedor").val() +
      "&producto=" +
      prod +
      "&cantidad=" +
      cant +
      "&unidad=" +
      unid +
      "&valoruni=" +
      valu +
      "&valortot=" +
      valp +
      "&impuesto=" +
      vali +
      "&nombre=" +
      desc +
      "&almacen=" +
      alma +
      "&porc_impu=" +
      pori +
      "&cod_impu=" +
      impu,
    success: function (z) {
      if (z == "0") {
        alert(
          "No fue posible guardar el registro temporalmente, por favor consulte a soporte de inmediato..."
        );
      }
    },
    error: function (jqXHR, estado, error) {},
  });
  /*******************************************/
  // $("#btn-add-article").attr("disabled", false);
  $("#btn-procesa").attr("disabled", false);
  $("#btn-cancela").attr("disabled", false);
  $("#codigo").val("");
  resumen();
  apagadatos();
  $("#producto").select();
}

function pone_por_impto() {
  var imp = $("#impuesto").val();
  $.ajax({
    beforeSend: function () {},
    url: "../code/busca_porc_impto.php",
    type: "POST",
    dataType: "json",
    data: "codigo=" + $("#impuesto").val(),
    success: function (x) {
      if ("x" == 0) {
        $("#porc_impto").val(0);
      } else {
        $("#porc_impto").val(x.mpo_impu);
      }
    },
  });
  /* $(document).ready(function(){
  }) */
}

///
function cancela_add() {
  $("#tipo_movi").attr("disabled", false);
  $("#proveedor").attr("disabled", false);
  $("#fecha").attr("disabled", false);
  $("#factura").attr("disabled", false);
  $("#almacen").attr("disabled", false);
  $("#tipo_movi").val("");
  $("#proveedor").val("");
  $("#fecha").val("");
  $("#factura").val("");
  $("#almacen").val("");
  $("#codigo").val("");
  $("#descripcion").val("");
  $("#producto").val("");
  $("#porc_impto").val(0);
  $("#incluido").attr("checked", false);
  $("#impuesto").val("");
  $("#unidad").val("");
  $("#costo").val(0);
  $("#cantidad").val(0);
  $("#costo").attr("disabled", true);
  $("#cantidad").attr("disabled", true);
  $("#btn-add-article").attr("disabled", true);
  $("#btn-cancel-article").attr("disabled", true);
  $("#tipo_movi").focus();
}

function apagadatos() {
  $("#tipo_movi").attr("disabled", true);
  $("#proveedor").attr("disabled", true);
  $("#fecha").attr("disabled", true);
  $("#factura").attr("disabled", true);
  $("#almacen").attr("disabled", true);
  $("#codigo").val("");
  $("#descripcion").val("");
  $("#producto").val("");
  $("#porc_impto").val(0);
  $("#incluido").attr("checked", false);
  $("#impuesto").val("");
  $("#unidad").val("");
  $("#costo").val(0);
  $("#cantidad").val(0);
  $("#costo").attr("disabled", true);
  $("#cantidad").attr("disabled", true);
  $("#btn-add-article").attr("disabled", true);
  $("#btn-cancel-article").attr("disabled", true);
  $("#producto").focus();
}

function resumen() {
  var totcan = 0.0;
  var totval = 0.0;
  var totimp = 0.0;

  $("#tabla_articulos > tbody > tr").each(function () {
    var canti = parseFloat($(this).find("td").eq(2).html());
    var impto = parseFloat($(this).find("td").eq(4).html());
    var total = parseFloat($(this).find("td").eq(5).html());
    totcan = totcan + canti;
    totval = totval + total;
    totimp = totimp + impto;
  });
  $("#net").val(totval.toFixed(2));
  $("#imp").val(totimp.toFixed(2));
  $("#arts").val(totcan.toFixed(2));
  if (totval > 0) {
    $("#btn-procesa").prop("disabled", false);
    $("#btn-cancela").prop("disabled", false);
  } else {
    $("#btn-procesa").prop("disabled", true);
    $("#btn-cancela").prop("disabled", true);
  }
}

function actualiza_entrada_temp(codigo) {
  var art = codigo;
  $.ajax({
    beforeSend: function () {},
    url: "../code/busca_porc_impto.php",
    type: "POST",
    dataType: "json",
    data: "codigo=" + $("#impuesto").val(),
    success: function (x) {
      if ("x" == 0) {
        $("#porc_impto").val(0);
      } else {
        $("#porc_impto").val(x.mpo_impu);
      }
    },
  });
  /* $(document).ready(function(){
  }) */
}

function procesa_entrada() {
  $("#btn-procesa").prop("disabled", true);
  var n = noty({
    text: "Deseas procesar la entrada...?",
    theme: "relax",
    layout: "center",
    type: "information",
    modal: "true",
    buttons: [
      {
        addClass: "btn btn-primary",
        text: "Si",
        onClick: function ($noty) {
          $noty.close();
          $.ajax({
            beforeSend: function () {
              $("#prefi").html("Buscando prox. entrada...");
            },
            url: "../code/busca_num_entrada.php",
            type: "POST",
            dataType: "json",
            data: "tipo=" + "1",
            success: function (x) {
              $("#prefi").html(
                '<div class="alert alert-info"> Movimiento de Entrada Nro ' +
                  x.c_entradas +
                  " Prefijo " +
                  x.prefijo_ent +
                  "</div>"
              );
              $("#prefijo_mov").val(x.prefijo_ent);
              $("#nro_movi").val(x.c_entradas);
              pref = x.prefijo_ent;
              nume = x.c_entradas;
            },
            error: function (jqXHR, estado, error) {
              $("#prefi").html("Hubo un error!!!" + " " + estado + " " + error);
            },
          });
          timeout: 4000;
          var pref = $("#prefijo_mov").val();
          var nume = $("#nro_movi").val();

          $("#tabla_articulos > tbody > tr").each(function () {
            var codi = $(this).find("td").eq(0).html();
            var cant = $(this).find("td").eq(2).html();
            var valu = $(this).find("td").eq(3).html();
            var vali = $(this).find("td").eq(4).html();
            var valp = $(this).find("td").eq(5).html();
            var nomb = $(this).find("td").eq(1).html();
            $.ajax({
              beforeSend: function () {},
              url: "../code/guarda_movimiento.php",
              type: "POST",
              data:
                "tipo=" +
                "1" +
                "&tipo_movi=" +
                $("#tipo_movi").val() +
                "&factura=" +
                $("#factura").val() +
                "&fecha=" +
                $("#fecha").val() +
                "&proveedor=" +
                $("#proveedor").val() +
                "&producto=" +
                codi +
                "&cantidad=" +
                cant +
                "&valoruni=" +
                valu +
                "&valortot=" +
                valp +
                "&impuesto=" +
                vali +
                "&numero=" +
                $("#nro_movi").val() +
                "&prefijo=" +
                $("#prefijo_mov").val(),
              success: function (x) {
                if (x == "0") {
                  var n = noty({
                    text:
                      "Hubo un error al procesar el Articulo: " +
                      nomb +
                      ". Consulte a soporte inmediatamente...",
                    theme: "relax",
                    layout: "topLeft",
                    type: "success",
                  });
                } else {
                  var n = noty({
                    text: "Se Proceso el Articulo: " + nomb,
                    theme: "relax",
                    layout: "topLeft",
                    type: "success",
                  });
                }
              },
              error: function (jqXHR, estado, error) {},
            });
          });
          var n = noty({
            text:
              "Movimiento Creado con exito, Entrada Numero " +
              $("#nro_movi").val(),
            theme: "relax",
            layout: "center",
            type: "information",
            modal: "true",
            buttons: [
              {
                addClass: "btn btn-info",
                text: "Imprimir",
                onClick: function ($noty) {
                  $noty.close();
                },
              },
              {
                addClass: "btn btn-warning",
                text: "Contiuar",
                onClick: function ($noty) {
                  $noty.close();
                },
              },
            ],
          });
          //********************
          cancela_entrada_all();
          $("#ModalEntradaMovimientos").modal("hide");
          $(location).attr("href", "entradas.php");
        },
      },
      {
        addClass: "btn btn-danger",
        text: "No",
        onClick: function ($noty) {
          $("#btn-procesa").prop("disabled", false);
          $noty.close();
        },
      },
    ],
  });
}

function cancela_entrada_all() {
  $.ajax({
    beforeSend: function () {},
    url: "../code/cancela_temp_movimiento.php",
    type: "POST",
    data: "tipo=" + "1" + "&tipo_movi=" + $("#tipo_movi").val(),
    success: function (t) {},
    error: function (jqXHR, estado, error) {},
  });
  /* $(document).ready(function () {
  }); */
  $("#tabla_articulos > tbody:last").children().remove();
  cancela_add();
  resumen();
  // alert("Se cancelo el proceso de Movimientos de Entrada");
  //$("#fecha").val("");
  //$("#factura").val("");
  //$("#impuesto").select2('val', 0);
  //$("#proveedor").focus();
}

function pone_num_entrada(tipo) {
  var tip = tipo;
  $.ajax({
    beforeSend: function () {
      $("#prefi").html("Buscando prox. entrada...");
    },
    url: "../code/busca_num_entrada.php",
    type: "POST",
    dataType: "json",
    data: "tipo=" + tip,
    success: function (x) {
      $("#prefi").html(
        '<div class="alert alert-info"> Movimiento de Entrada Nro ' +
          x.c_entradas +
          " Prefijo " +
          x.prefijo_ent +
          "</div>"
      );
      $("#prefijo_mov").val(x.prefijo_ent);
      $("#nro_movi").val(x.c_entradas);
    },
    error: function (jqXHR, estado, error) {
      $("#prefi").html("Hubo un error!!!" + " " + estado + " " + error);
    },
  });
  /* $(document).ready(function () {
  }); */
}

function busca_productoX(codigo) {
  $.ajax({
    beforeSend: function () {},
    url: "../code/busca_productos.php",
    type: "POST",
    dataType: "json",
    data: "codigo=" + $("#producto").val(),
    success: function (x) {
      $("#codigo").val(x.cod_prod);
      $("#costo").val(x.pco_prod);
      $("#unidad").val(x.uco_prod);
      $("#descripcion").val(x.nom_prod);
      $("#cantidad").val(0);
      $("#costo").attr("disabled", false);
      $("#cantidad").attr("disabled", false);
    },
  });
  /* $(document).ready(function () {
  }); */
}
