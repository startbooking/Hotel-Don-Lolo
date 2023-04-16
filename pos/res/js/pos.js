function buscarProducto() {
  var alto = screen.height;
  var ancho = screen.width;
  oPos = JSON.parse(localStorage.getItem("oPos"));
  ambi = oPos[0]["id_ambiente"];
  var textoBusqueda = $("input#busqueda").val();
  parametros = {
    id: ambi,
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
        $("#productoList").css("min-height", 455);
        $("#productoList").css("height", alto - 400);
        if (data.length > 1) {
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
        } else {
          if (data.length > 0) {
            getVentas(
              data[0]["nom"],
              data[0]["venta"],
              data[0]["producto_id"],
              data[0]["porcentaje_impto"],
              ambi
            );
          }
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
  let oPos = JSON.parse(localStorage.getItem("oPos"));

  parametros = {
    idamb: oPos[0]["id_ambiente"],
    prefijo: oPos[0]["prefijo"],
    desdeFe: desdeFe,
    hastaFe: hastaFe,
    huesped: huesped,
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

  parametros = {
    idamb: oPos[0]["id_ambiente"],
    amb: oPos[0]["nombre"],
    user: sesion["usuario"][0]["usuario"],
    iduser: sesion["usuario"][0]["usuario_id"],
    impto: oPos[0]["impuesto"],
    prop: oPos[0]["propina"],
    fecha: oPos[0]["fecha_auditoria"],
    logo: oPos[0]["logo"],
  };
  $.ajax({
    url: "ventas/ventasPorCliente.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $(".content-wrapper").html(data);
    },
  });
}

function ventasPorCliente() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  oKey = makeid(12);
  parametros = {
    id: oPos[0]["id_ambiente"],
    amb: oPos[0]["nombre"],
    user: sesion["usuario"][0]["usuario"],
    iduser: sesion["usuario"][0]["usuario_id"],
    impto: oPos[0]["impuesto"],
    prop: oPos[0]["propina"],
    fecha: oPos[0]["fecha_auditoria"],
    logo: oPos[0]["logo"],
    file: oKey,
  };

  $.ajax({
    url: "informes/ventasPorCliente.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $(".content-wrapper").html(data);
      $("#verInforme").attr("data", "imprimir/informes/" + oKey + ".pdf");
    },
  });
}

function getComandasPlano(comanda, nromesa, nombre) {
  var alto = screen.height;
  var ancho = screen.width;
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  $(".btn-menu").css("display", "block");
  miBoton = "#" + nombre;
  propina = $(miBoton).attr("propina");
  impuesto = $(miBoton).attr("impto");
  descuento = $(miBoton).attr("descuento");
  subtotal = $(miBoton).attr("subtotal");
  total = $(miBoton).attr("total");

  parametros = {
    id: oPos[0]["id_ambiente"],
    amb: oPos[0]["nombre"],
    user: sesion["usuario"][0]["usuario"],
    nivel: sesion["usuario"][0]["tipo"],
    impto: impuesto,
    propina: propina,
    descuento: propina,
    subtotal: subtotal,
    total: total,
    fecha: oPos[0]["fecha_auditoria"],
    pref: oPos[0]["prefijo"],
    comanda: comanda,
    nromesa: nromesa,
  };

  $.ajax({
    url: "ventas/cuentasPlano.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $(".content-wrapper").html(data);
      $("#titulo3").html(
        `<h4 style="text-align: center;">Comanda Nro ${comanda} - Mesa Nro ${nromesa}</h4>`
      );
      /*       $("#tituloNumero2").html(
        `<h3 style="margin-top:10px">Comanda Nro ${comanda} <br>Mesa Nro ${nromesa}</h3>`
      ); */
      $("#productosComanda").css("min-height", 350);
      $("#productosComanda").css("height", alto - 352);
      $("#Escritorio").css("height", alto - 420);
    },
  });
}

function mesasActivasPlano() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  parametros = {
    idamb: oPos[0]["id_ambiente"],
    amb: oPos[0]["nombre"],
    user: sesion["usuario"][0]["usuario"],
    impto: oPos[0]["impuesto"],
    prop: oPos[0]["propina"],
    pref: oPos[0]["prefijo"],
    fecha: oPos[0]["fecha_auditoria"],
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
        $("#" + mesa).attr("propina", data[i]["propina"]);
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
  $(".main-sidebar").css("display", "none");
  $(".content-wrapper").css("margin-left", "0");
  $("#btnGuardar").attr("disabled", "enabled");

  parametros = {
    id: oPos[0]["id_ambiente"],
    amb: oPos[0]["nombre"],
    user: sesion["usuario"][0]["usuario"],
    impto: oPos[0]["impuesto"],
    prop: oPos[0]["propina"],
    pref: oPos[0]["prefijo"],
    fecha: oPos[0]["fecha_auditoria"],
    mesa: mesa,
  };

  $.ajax({
    url: "ventas/touch.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      getSecciones();
      $(".content-wrapper").html(data);
      $("#productosComanda").css("height", alto - 344);
      $("#Escritorio").css("height", alto - 420);
      $("#nromesas").val(mesa);
      $("#nromesas").attr("readonly", true);
      $("#nromesas").attr("disabled", true);
      var storageProd = localStorage.getItem("productoComanda");
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
  const containerWraper = document.querySelector(".content-wrapper");
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

function historicoPeriodos() {
  var web = $("#rutaweb").val();
  desdeFe = $("#desdeFecha").val();
  hastaFe = $("#hastaFecha").val();
  desdeNu = $("#desdeNumero").val();
  hastaNu = $("#hastaNumero").val();
  huesped = $("#desdeHuesped").val();
  formaPa = $("#desdeFormaPago").val();
  oPos = JSON.parse(localStorage.getItem("oPos"));
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oKey = makeid(12);

  parametros = {
    amb: oPos[0]["nombre"],
    user: sesion["usuario"][0]["usuario"],
    iduser: sesion["usuario"][0]["usuario_id"],
    idamb: oPos[0]["id_ambiente"],
    logo: oPos[0]["logo"],
    prefijo: oPos[0]["prefijo"],
    desdeFe: desdeFe,
    hastaFe: hastaFe,
    file: oKey,
  };

  if (desdeFe == "" && hastaFe == "") {
    swal("Atencion", "Seleccione un Criterio de Fechas", "warning");
  } else {
    $.ajax({
      url: "imprimir/imprimeVentasPorPeriodoMes.php",
      type: "POST",
      data: parametros,
      success: function (x) {
        $("#verInforme").attr(
          "data",
          "imprimir/informes/" + $.trim(x) + ".pdf"
        );
      },
    });
  }
}

function activaModulos() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("sesion"));
  fecha = new Date();
  fechaAct =
    fecha.getDate() + "/" + (fecha.getMonth() + 1) + "/" + fecha.getFullYear();
  var div = '<div class="container-fluid moduloCentrar">';
  if (sesion["cia"][0]["con"] == "1") {
    div =
      div +
      '<div id="con" class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><a href="" class="small-box-footer"><div class="small-box bg-blue-gradient"> <div class="inner"><h3>Contabilidad</h3><p>Control de Stock</p>                </div>                <div class="icon">                  <i class="ion ion-ios-briefcase-outline"></i>                </div>                <small class="small-box-footer" style="font-size:12px">Ingresar<i class="fa fa-arrow-circle-right"></i></small></div></a></div>';
  }
  if (sesion["cia"][0]["inv"] == "1" && sesion["usuario"][0]["inv"] == "1") {
    div =
      div +
      '<div id="inv" style="cursor: pointer;" class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><a onclick="ingresoInv()" class="small-box-footer"><div class="small-box bg-yellow-gradient">  <div class="inner">  <h3>Inventarios</h3><p>Control de Stock</p></div><div class="icon"><i class="ion ion-archive"></i></div><small class="small-box-footer" style="font-size:12px">Ingresar<i class="fa fa-arrow-circle-right"></i></small>                  </div>                </a>              </div>';
  }
  if (sesion["cia"][0]["com"] == "1") {
    div =
      div +
      '<div id="com" class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><a href="#" class="small-box-footer"><div class="small-box bg-aqua"><div class="inner"><h3>Compras</h3> <p>Mes de Proceso</p>                </div>                <div class="icon">                  <i class="ion ion-ios-cart-outline"></i>                </div>                <small class="small-box-footer" style="font-size:12px">Ingresar<i class="fa fa-arrow-circle-right"></i></small> </div></a></div>';
  }
  if (sesion["cia"][0]["cxp"] == "1") {
    div =
      div +
      '<div id="cxp" class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><a href="#" class="small-box-footer"><div class="small-box bg-teal"><div class="inner">  <h3>Tesoreria - Bancos</h3>  <p>Mes de Proceso</p>                    </div>                    <div class="icon">                      <i class="ion ion-cash"></i>                    </div>                    <small class="small-box-footer">Ingresar<i class="fa fa-arrow-circle-right"></i></small></div></a></div>';
  }
  if (sesion["cia"][0]["cxc"] == "1") {
    div =
      div +
      '<div id="cxc" class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><a href="#" class="small-box-footer"><div class="small-box bg-purple-gradient"><div class="inner"> <h3>Cuentas por Cobrar</h3> <p>Mes de Proceso</p>                </div>                <div class="icon">                  <i class="ion ion-bag"></i>                </div>                <small class="small-box-footer">Ingresar<i class="fa fa-arrow-circle-right"></i></small></div></a></div>';
  }
  if (sesion["cia"][0]["pos"] == "1" && sesion["usuario"][0]["pos"] == "1") {
    div =
      div +
      `
      <div id="pos" class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <a href="../pos/inicio.php" class="small-box-footer">
        <div class="small-box bg-green-gradient">
          <div class="inner"> 
            <h3>Puntos de Venta</h3> 
            <p id="fechaPos">Ventas Restaurantes </p>
          </div>
          <div class="icon">
            <i class="ion ion-coffee"></i>
          </div>
          <small class="small-box-footer" style="font-size:12px">Ingresar
            <i class="fa fa-arrow-circle-right"></i>
          </small>
        </div>
      </a>
    </div>`;
  }
  if (sesion["cia"][0]["tar"] == "1") {
    div =
      div +
      '<div id="cxp" class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><a href="#" class="small-box-footer"><div class="small-box bg-teal"><div class="inner"><h3>Tarificador Telefonico</h3><p>Mes de Proceso</p>                    </div>                    <div class="icon">                      <i class="ion ion-cash"></i>                    </div>                    <small class="small-box-footer">Ingresar<i class="fa fa-arrow-circle-right"></i></small></div></a></div>';
  }
  if (sesion["cia"][0]["pms"] == "1" && sesion["usuario"][0]["pms"] == "1") {
    div =
      div +
      '<div id="pms" style="cursor: pointer;" class="col-lg-4 col-md-4 col-sm-6 col-xs-12">  <a onclick="ingresoPms()" >    <div class="small-box bg-blue-gradient">      <div class="inner">        <h3>PMS Software </h3>         <p style="color:#FFF" id="fechaPms">Fecha de Proceso [' +
      sesion[2]["fecha_auditoria"] +
      '] </p>                      </div>                    <div class="icon">                        <i class="ion ion-ios-home-outline"></i>                    </div>      <span class="small-box-footer">Ingresar <i class="fa fa-arrow-circle-right"></i></span>    </div>  </a>              </div>';
  }
  div = div + "</div>";
  if (sesion["usuario"][0]["tipo"] == "A") {
    div =
      div +
      '<div id="par" style="cursor: pointer;display:flex;"  class="container-fluid"><div class="container moduloCentrar"><div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> <a onclick="ingresoAdmin()" class="small-box-footer">                  <div class="small-box bg-red-gradient">                    <div class="inner">                      <h3 style="overflow-x: hidden;">Configuracion General <br></h3> <p style="color:#FFF">Parametros del Sistema</p></div>                    <div class="icon"><i class="fa fa-cogs"></i></div><small class="small-box-footer" style="font-size:12px">Ingresar<i class="fa fa-arrow-circle-right"></i></small></div></a></div></div></div>';
  }
  $("#modulos").html(div);
  $("#nombreUsuario").html(
    sesion["usuario"][0]["apellidos"] +
      " " +
      sesion["usuario"][0]["nombres"] +
      ' <span class="caret"></span>'
  );
}

function devolucionesDia() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  oKey = makeid(12);
  parametros = {
    id: oPos[0]["id_ambiente"],
    amb: oPos[0]["nombre"],
    user: sesion["usuario"][0]["usuario"],
    iduser: sesion["usuario"][0]["usuario_id"],
    impto: oPos[0]["impuesto"],
    prop: oPos[0]["propina"],
    fecha: oPos[0]["fecha_auditoria"],
    logo: oPos[0]["logo"],
    file: oKey,
  };

  $.ajax({
    url: "informes/devolucionesDelDia.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $(".content-wrapper").html(data);
      $("#verInforme").attr("data", "imprimir/informes/" + oKey + ".pdf");
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
  oKey = makeid(12);
  parametros = {
    id: oPos[0]["id_ambiente"],
    amb: oPos[0]["nombre"],
    user: sesion["usuario"][0]["usuario"],
    iduser: sesion["usuario"][0]["usuario_id"],
    impto: oPos[0]["impuesto"],
    prop: oPos[0]["propina"],
    fecha: oPos[0]["fecha_auditoria"],
    logo: oPos[0]["logo"],
    file: oKey,
  };

  $.ajax({
    url: "informes/devolucionProductos.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $(".content-wrapper").html(data);
      $("#verInforme").attr(
        "data",
        "imprimir/informes/devolucionProductos_" + oKey + ".pdf"
      );
    },
  });
}

function botonDevolverProducto(
  comanda,
  producto,
  ambi,
  canti,
  nombre,
  codigo,
  regis
) {
  $("#myModalDevolucionComanda").modal("show");
  $("#cantidadDev").val(canti);
  $("#nombreProd").val(nombre);
  $("#idProductoDev").val(producto);
  $("#ambienteDev").val(ambi);
  $("#comandaDev").val(comanda);
  $("#regisDev").val(regis);
  $("#motivoDev").val("");
}

function devolverProducto() {
  comanda = $("#numeroComanda").val();
  idprod = $("#idProductoDev").val();
  idambi = $("#ambienteDev").val();
  motivo = $("#motivoDev").val();
  regis = $("#regisDev").val();
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  user = sesion["usuario"][0]["usuario"];
  fecha = oPos[0]["fecha_auditoria"];

  parametros = {
    comanda: comanda,
    idprod: idprod,
    idambi: idambi,
    motivo: motivo,
    fecha: fecha,
    user: user,
  };

  $.ajax({
    url: "res/php/user_actions/devolucionProducto.php",
    type: "POST",
    dataType: "json",
    data: parametros,
    success: function (data) {
      $("#myModalDevolucionComanda").modal("hide");
      document.getElementsByTagName("table")[0].setAttribute("id", "comanda");
      document.getElementById("comanda").deleteRow(regis);
      borrar = regis - 1;
      listaComanda.splice(borrar, 1);
      localStorage.setItem("productoComanda", JSON.stringify(listaComanda));
      resumenComanda();
      resumenDescuento(idambi, comanda);
    },
  });
}

function verComandasAnuladas() {
  oPos = JSON.parse(localStorage.getItem("oPos"));
  sesion = JSON.parse(localStorage.getItem("sesion"));

  var id = oPos[0]["id_ambiente"];
  var nomamb = oPos[0]["nombre"];
  var pref = oPos[0]["prefijo"];
  var tipoUsr = sesion["usuario"][0]["tipo"];

  var parametros = {
    idamb: id,
    pref: pref,
    nomamb: nomamb,
    tipousr: tipoUsr,
    user: sesion["usuario"][0]["usuario"],
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
      $(".content-wrapper").html(data);
      $("#example1").DataTable({
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

function buscaRecetas(){
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  tipo = $('#tipoReceta').val();
  parametros = {
    id: oPos[0]["id_ambiente"],
    amb: oPos[0]["nombre"],
    user: sesion["usuario"][0]["usuario"],
    iduser: sesion["usuario"][0]["usuario_id"],
    impto: oPos[0]["impuesto"],
    prop: oPos[0]["propina"],
    logo: oPos[0]["logo"],
    fecha: oPos[0]["fecha_auditoria"],
    tipo:tipo,
    file: makeid(12),
  };

  $.ajax({
    url: "imprimir/imprimeCatalogoRecetas.php",
    type: "POST",
    data: parametros,
    success: function (x) {
      $("#verInforme").attr(
        "data",
        "imprimir/" + $.trim(x)
      );
    },
    /* success: function (data) {
      ///$(".content-wrapper").html(data);
    }, */
  })


}

function catalogoRecetas() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  parametros = {
    id: oPos[0]["id_ambiente"],
    amb: oPos[0]["nombre"],
    user: sesion["usuario"][0]["usuario"],
    iduser: sesion["usuario"][0]["usuario_id"],
    impto: oPos[0]["impuesto"],
    prop: oPos[0]["propina"],
    logo: oPos[0]["logo"],
    fecha: oPos[0]["fecha_auditoria"],
  };

  $.ajax({
    url: "views/catalogoRecetas.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $(".content-wrapper").html(data);
    },
  });
}



function facturasDia() {
  oPos = JSON.parse(localStorage.getItem("oPos"));
  sesion = JSON.parse(localStorage.getItem("sesion"));

  var id = oPos[0]["id_ambiente"];
  var nomamb = oPos[0]["nombre"];
  var prefijo = oPos[0]["prefijo"];
  var tipoUsr = sesion["usuario"][0]["tipo"];

  var parametros = {
    idamb: id,
    prefijo: prefijo,
    nomamb: nomamb,
    tipousr: tipoUsr,
    user: sesion["usuario"][0]["usuario"],
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
      $(".content-wrapper").html(data);

      $("#example1").DataTable({
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
  var desc = 0.0;
  var impt = 0.0;
  var venta = 0.0;
  var canpr = 0.0;
  var canti = 0.0;

  for (i = 0; i < listaComanda.length; i++) {
    canti = canti + 1;
    desc = desc + parseFloat(listaComanda[i]["descuento"]);
    impt = impt + parseFloat(listaComanda[i]["valorimpto"]);
    venta = venta + parseFloat(listaComanda[i]["venta"]);
  }
  $("#totalVta").html(number_format(venta, 2));
  $("#totalDesc").html(number_format(desc, 2));
  $("#totalCuenta").html(number_format(venta - desc + impt, 2));
  $("#valorImpto").html(number_format(impt, 2));
  $("#cantProd").val(canti);
}

function resumenDescuento(ambi, comanda) {
  $.ajax({
    url: "res/php/user_actions/resumenDescuento.php",
    type: "POST",
    dataType: "json",
    data: {
      comanda: comanda,
      ambiente: ambi,
    },
  }).done(function (datos) {
    $("#totalVta").html(number_format(datos[0]["subtotal"], 2));
    $("#totalDesc").html(number_format(datos[0]["valor_descuento"], 2));
    $("#totalCuenta").html(
      number_format(datos[0]["total"] - datos[0]["valor_descuento"], 2)
    );
    $("#valorImpto").html(number_format(datos[0]["imppuesto"], 2));
  });
}

function verFoto(e) {
  if (e.files && e.files[0]) {
    if (e.files[0].type.match("image.*")) {
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
      reader.readAsDataURL(e.files[0]);
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

function muestraProductoKardex() {
  $("#modalConsultaKardex").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget); // Botón que activó el modal
    var id = button.data("id"); // Extraer la información de atributos de datos
    var bodega = button.data("bodega"); // Extraer la información de atributos de datos
    var nombre = button.data("nombre"); // Extraer la información de atributos de datos
    parametros = {
      id: id,
      bodega: bodega,
    };
    var modal = $(this);
    modal.find(".modal-title").html("Movimientos Producto : " + nombre);
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
    total = parseFloat(total.replace(",", ""));
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

function actualizaRece(id, codigo, regis, regis2) {
  document.getElementById("materiaPrima").deleteRow(codigo);
  $.ajax({
    url: "res/php/user_actions/eliminaComponenteReceta.php",
    type: "POST",
    data: {
      cod: id,
      regis2: regis2,
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
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  parametros = {
    id: oPos[0]["id_ambiente"],
    amb: oPos[0]["nombre"],
    user: sesion["usuario"][0]["usuario"],
    iduser: sesion["usuario"][0]["usuario_id"],
    impto: oPos[0]["impuesto"],
    prop: oPos[0]["propina"],
    fecha: oPos[0]["fecha_auditoria"],
  };

  $.ajax({
    url: "views/recetas.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $(".content-wrapper").html(data);
      $("#example1").DataTable({
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
    idusr = sesion["usuario"][0]["usuario_id"];
    var modal = $(this);
    modal.find(".modal-title").text("Elimina Producto Receta : " + producto);

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
                      <td align="right">${number_format(cantidad, 2)}</td>
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
  var idprod = $("#productoRec").val();
  var producto = $("#productoRec option:selected").text();
  var idrece = $("#idReceta").val();
  var uniMedida = $("#idMedida").val();
  var medida = $("#medidaRec").val();
  var cantidad = $("#cantidadRec").val();
  var valUnita = $("#valorUni").val();
  var valTotal = $("#valorTot").val();

  sesion = JSON.parse(localStorage.getItem("sesion"));
  idusr = sesion["usuario"][0]["usuario_id"];
  user = sesion["usuario"][0]["usuario"];

  parametros = {
    idProd: idprod,
    idRece: idrece,
    uniMedida: uniMedida,
    cantidad: cantidad,
    usuario: user,
    valUnita: valUnita,
    valTotal: valTotal,
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
  valUni = valUni.replace(",", "");
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
        traeUnidad(unidad[0]["unidad_procesa"]);
        can = $("#cantidadRec").val();
        $("#idMedida").val(unidad[0]["unidad_procesa"]);
        $("#valorUni").val(number_format(unidad[0]["valor_promedio"], 2));
        $("#valorTot").val(number_format(can * unidad[0]["valor_promedio"], 2));
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
  idusr = sesion["usuario"][0]["usuario_id"];
  var modal = $(this);
  modal.find(".modal-title").text("Receta Estandar : " + producto);

  $.ajax({
    url: "res/php/user_actions/getTraeProductos.php",
    type: "POST",
    dataType: "json",
    data: { id: id },
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
  idusr = sesion["usuario"][0]["usuario_id"];
  user = sesion["usuario"][0]["usuario"];
  var producto = nombre;
  $("#nomReceta").val(producto);
  $(".modal-title").html("Receta Estandar : " + producto);
  $("#idusrupd").val(idusr);
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
          <td align='right'>${number_format(data[i]["cantidad"], 2)}</td>
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
    idusr = sesion["usuario"][0]["usuario_id"];
    $("#idusrupd").val(idusr);

    var button = $(event.relatedTarget);
    var cliente = button.data("cliente");
    var modal = $(this);
    modal.find(".modal-title").text("Modificar Cliente : " + cliente);

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
  idamb = oPos[0]["id_ambiente"];
  $("#dataUpdateProducto").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var name = button.data("producto");
    var modal = $(this);
    modal.find(".modal-title").text("Modificar Producto: " + name);
    $.ajax({
      url: "res/php/user_actions/updateProducto.php",
      type: "POST",
      data: {
        id: id,
        idamb: idamb,
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

  parametros = {
    id: oPos[0]["id_ambiente"],
    amb: oPos[0]["nombre"],
    impto: oPos[0]["impuesto"],
    prop: oPos[0]["propina"],
    fecha: oPos[0]["fecha_auditoria"],
    logo: oPos[0]["logo"],
  };

  $.ajax({
    url: "views/procesaFactura.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $(".content-wrapper").html(data);
    },
  });
}

function reCreaFacturas() {
  desde = $("#fechaIn").val();
  hasta = $("#fechaOut").val();
  for (var i = desde; i <= hasta; i++) {
    $.ajax({
      url: "res/php/user_actions/infoFactura.php",
      type: "POST",
      data: {
        factura: i,
        idAmb: 2,
        nomAmb: "CAFE TIK TAK",
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
  formaPa = $("#desdeFormaPago").val();
  oPos = JSON.parse(localStorage.getItem("oPos"));

  parametros = {
    idamb: oPos[0]["id_ambiente"],
    prefijo: oPos[0]["prefijo"],
    desdeFe: desdeFe,
    hastaFe: hastaFe,
    desdeNu: desdeNu,
    hastaNu: hastaNu,
    huesped: huesped,
    formaPa: formaPa,
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

  parametros = {
    id: oPos[0]["id_ambiente"],
    amb: oPos[0]["nombre"],
    user: sesion["usuario"][0]["usuario"],
    iduser: sesion["usuario"][0]["usuario_id"],
    impto: oPos[0]["impuesto"],
    prop: oPos[0]["propina"],
    fecha: oPos[0]["fecha_auditoria"],
    logo: oPos[0]["logo"],
  };

  $.ajax({
    url: "views/facturasPorRango.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $(".content-wrapper").html(data);
    },
  });
}

function ventasHistoricoPeriodos() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  parametros = {
    id: oPos[0]["id_ambiente"],
    amb: oPos[0]["nombre"],
    user: sesion["usuario"][0]["usuario"],
    iduser: sesion["usuario"][0]["usuario_id"],
    impto: oPos[0]["impuesto"],
    prop: oPos[0]["propina"],
    fecha: oPos[0]["fecha_auditoria"],
    logo: oPos[0]["logo"],
  };

  $.ajax({
    url: "views/periodoServicio.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $(".content-wrapper").html(data);
    },
  });
}

function buscarRecu() {
  oPos = JSON.parse(localStorage.getItem("oPos"));
  id = oPos[0]["id_ambiente"];
  var textoBusqueda = $("input#busqueda").val();
  if (textoBusqueda != "") {
    $.post(
      "res/php/user_actions/getBuscaProductoRecu.php",
      {
        id: id,
        valorBusqueda: textoBusqueda,
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
    valor = valor.replace("$", "");
    valor = valor.replace(".", "");
    totalventa = totalventa + valor;
  });
  $("#ventasAdicionales > tbody > tr").each(function () {
    var valoradi = $("#valorAdi", this).html();
    valoradi = valoradi.replace("$", "");
    valoradi = valoradi.replace(".", "");
    totaladi = totaladi + valor;
  });

  totalgen = totaladi + totalventa;
}

function getRestarVentasRecu(codigo) {
  oPos = JSON.parse(localStorage.getItem("oPos"));
  idamb = oPos[0]["id_ambiente"];
  impt = oPos[0]["impuesto"];
  user = sesion["usuario"][0]["usuario"];
  prop = oPos[0]["propina"];
  var parametros = {
    codigo: codigo,
    idamb: idamb,
    impto: impt,
    prop: prop,
    user: user,
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
  oPos = JSON.parse(localStorage.getItem("oPos"));
  idamb = oPos[0]["id_ambiente"];
  impt = oPos[0]["impuesto"];
  user = sesion["usuario"][0]["usuario"];
  prop = oPos[0]["propina"];
  var parametros = {
    codigo: codigo,
    idamb: idamb,
    impto: impt,
    prop: prop,
    user: user,
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
  oPos = JSON.parse(localStorage.getItem("oPos"));
  idamb = oPos[0]["id_ambiente"];
  impt = oPos[0]["impuesto"];
  user = sesion["usuario"][0]["usuario"];
  prop = oPos[0]["propina"];
  var parametros = {
    codigo: codigo,
    idamb: idamb,
    impto: impt,
    prop: prop,
    user: user,
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
  id = oPos[0]["id_ambiente"];
  $("#loader").fadeIn("slow");
  $.ajax({
    type: "POST",
    url: "res/php/user_actions/getSeccionRecu.php",
    data: {
      id: oPos[0]["id_ambiente"],
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

  parametros = {
    id: oPos[0]["id_ambiente"],
    amb: oPos[0]["nombre"],
    user: sesion["usuario"][0]["usuario"],
    iduser: sesion["usuario"][0]["usuario_id"],
    impto: oPos[0]["impuesto"],
    prop: oPos[0]["propina"],
    fecha: oPos[0]["fecha_auditoria"],
  };

  $.ajax({
    url: "views/productos.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $(".content-wrapper").html(data);
      $("#example1").DataTable({
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

  parametros = {
    id: oPos[0]["id_ambiente"],
    amb: oPos[0]["nombre"],
    user: sesion["usuario"][0]["usuario"],
    iduser: sesion["usuario"][0]["usuario_id"],
    impto: oPos[0]["impuesto"],
    prop: oPos[0]["propina"],
    fecha: oPos[0]["fecha_auditoria"],
  };

  $.ajax({
    url: "views/clientes.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $(".content-wrapper").html(data);
      $("#example1").DataTable({
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
  $(".main-sidebar").css("display", "none");
  $("#recuperarComanda").val(1);
  $("#listaComandas").css("display", "none");
  $("#Escritorio").css("margin-left", "0");
  $("#productoList").css("display", "block");
  $(".menuComanda").css("padding", "0 10px");
  $("#guardaCuenta").css("display", "block");
  $("#recuperaCuenta").css("display", "none");
  $(".btnActivo").css("display", "none");
  $("#regresarComanda").css("margin-top", "360px");

  $("#seccionList").css("display", "block");
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
  $(".btn-group-vertical").css("width", "100%");

  idamb = $("#idAmbiente").val();
  getSecciones(idamb);
  cuenta = $("#comandaActiva").val();
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
}

function muestraPos(id) {
  oPos = JSON.parse(localStorage.getItem("oPos"));
  plano = oPos[0]["plano"];
  $("#fechaPos").html("Fecha Proceso " + oPos[0]["fecha_auditoria"]);
  $("#nombreAmbiente").html(`
    <a href="inicio.php" style="font-weight: 700;padding:12px 0;text-align: center">
      <img loading='lazy' class="img-thumbnail" style="width:50px;margin:0px 10px" src='../img/${oPos[0]["logo"]}' alt='' /> ${oPos[0]["nombre"]}
    </a>
    `);
  $("#fechaAuditoria").val(oPos[0]["fecha_auditoria"]);
  $("#nombreUsuario").html(
    `${sesion["usuario"][0]["apellidos"]} ${sesion["usuario"][0]["nombres"]}<span class="caret"></span>`
  );

  $.ajax({
    url: "res/php/user_actions/muestraPos.php",
    type: "POST",
    data: { ambSel: id },
    success: function (data) {
      $("#Escritorio").html(data);
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
  oKey = makeid(12);
  parametros = {
    id: oPos[0]["id_ambiente"],
    amb: oPos[0]["nombre"],
    user: sesion["usuario"][0]["usuario"],
    iduser: sesion["usuario"][0]["usuario_id"],
    impto: oPos[0]["impuesto"],
    prop: oPos[0]["propina"],
    fecha: oPos[0]["fecha_auditoria"],
    logo: oPos[0]["logo"],
    file: oKey,
  };

  $.ajax({
    url: "informes/ventasPorGrupo.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $(".content-wrapper").html(data);
      $("#verInforme").attr(
        "data",
        "imprimir/informes/ventasGrupos_" + oKey + ".pdf"
      );
    },
  });
}

function ventasPorPeriodo() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  oKey = makeid(12);
  parametros = {
    id: oPos[0]["id_ambiente"],
    amb: oPos[0]["nombre"],
    user: sesion["usuario"][0]["usuario"],
    iduser: sesion["usuario"][0]["usuario_id"],
    impto: oPos[0]["impuesto"],
    prop: oPos[0]["propina"],
    fecha: oPos[0]["fecha_auditoria"],
    logo: oPos[0]["logo"],
    file: oKey,
  };

  $.ajax({
    url: "informes/ventasPorPeriodo.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $(".content-wrapper").html(data);
      $("#verInforme").attr("data", "imprimir/informes/" + oKey + ".pdf");
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
  parametros = {
    id: oPos[0]["id_ambiente"],
    amb: oPos[0]["nombre"],
    user: sesion["usuario"][0]["usuario"],
    iduser: sesion["usuario"][0]["usuario_id"],
    impto: oPos[0]["impuesto"],
    prop: oPos[0]["propina"],
    fecha: oPos[0]["fecha_auditoria"],
  };

  $.ajax({
    url: "informes/historicoCajeros.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $(".content-wrapper").html(data);
    },
  });
}

function verfactura(fact) {
  $("#verFactura").attr("data", "impresiones/" + fact + ".pdf");
}

function buscaFacturasFecha() {
  oPos = JSON.parse(localStorage.getItem("oPos"));
  var fechafac = $("#buscarFecha").val();
  var parametros = {
    idamb: oPos[0]["id_ambiente"],
    fechafac: fechafac,
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
  parametros = {
    id: oPos[0]["id_ambiente"],
    amb: oPos[0]["nombre"],
    user: sesion["usuario"][0]["usuario"],
    iduser: sesion["usuario"][0]["usuario_id"],
    impto: oPos[0]["impuesto"],
    prop: oPos[0]["propina"],
    fecha: oPos[0]["fecha_auditoria"],
  };

  $.ajax({
    url: "informes/historicoFacturas.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $(".content-wrapper").html(data);
    },
  });
}

function ventasUsuario() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  oKey = makeid(12);
  parametros = {
    id: oPos[0]["id_ambiente"],
    amb: oPos[0]["nombre"],
    user: sesion["usuario"][0]["usuario"],
    iduser: sesion["usuario"][0]["usuario_id"],
    impto: oPos[0]["impuesto"],
    prop: oPos[0]["propina"],
    fecha: oPos[0]["fecha_auditoria"],
    logo: oPos[0]["logo"],
    file: oKey,
  };

  $.ajax({
    url: "informes/ventasUsuario.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $(".content-wrapper").html(data);
      $("#verInforme").attr(
        "data",
        "imprimir/informes/ventasdelDiaUsuario_" + sesion[0]["usuario"] + ".pdf"
      );
    },
  });
}

function ventasProducto() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  oKey = makeid(12);
  parametros = {
    id: oPos[0]["id_ambiente"],
    amb: oPos[0]["nombre"],
    user: sesion["usuario"][0]["usuario"],
    iduser: sesion["usuario"][0]["usuario_id"],
    impto: oPos[0]["impuesto"],
    prop: oPos[0]["propina"],
    fecha: oPos[0]["fecha_auditoria"],
    logo: oPos[0]["logo"],
    file: oKey,
  };

  $.ajax({
    url: "informes/ventasPorProducto.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $(".content-wrapper").html(data);
      $("#verInforme").attr(
        "data",
        "imprimir/informes/ventasProductos_" + oKey + ".pdf"
      );
    },
  });
}

function ventasDiaAuditoria() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  oKey = makeid(12);

  parametros = {
    id: oPos[0]["id_ambiente"],
    amb: oPos[0]["nombre"],
    user: sesion["usuario"][0]["usuario"],
    iduser: sesion["usuario"][0]["usuario_id"],
    impto: oPos[0]["impuesto"],
    prop: oPos[0]["propina"],
    fecha: oPos[0]["fecha_auditoria"],
    logo: oPos[0]["logo"],
    file: oKey,
  };

  $.ajax({
    url: "informes/ventasDia.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $(".content-wrapper").html(data);
      $("#verInforme").attr(
        "data",
        "imprimir/informes/ventasdelDia_" + oKey + ".pdf"
      );
    },
  });
}

function kardexInventario() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  parametros = {
    id: oPos[0]["id_ambiente"],
    amb: oPos[0]["nombre"],
    user: sesion["usuario"][0]["usuario"],
    iduser: sesion["usuario"][0]["usuario_id"],
    impto: oPos[0]["impuesto"],
    prop: oPos[0]["propina"],
    fecha: oPos[0]["fecha_auditoria"],
    bodega: oPos[0]["id_bodega"],
  };

  $.ajax({
    url: "views/kardex.php",
    type: "POST",
    datatype: "json",
    data: parametros,
    success: function (data) {
      $(".content-wrapper").html(data);
      $("#tablaKardex").DataTable({
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

function huespedesenCasa() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  parametros = {
    id: oPos[0]["id_ambiente"],
    amb: oPos[0]["nombre"],
    user: sesion["usuario"][0]["usuario"],
    iduser: sesion["usuario"][0]["usuario_id"],
    impto: oPos[0]["impuesto"],
    prop: oPos[0]["propina"],
    fecha: oPos[0]["fecha_auditoria"],
  };

  $.ajax({
    url: "views/huespedesCasa.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $(".content-wrapper").html(data);
      $("#example1").DataTable({
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
  parametros = {
    id: oPos[0]["id_ambiente"],
    amb: oPos[0]["nombre"],
    user: sesion["usuario"][0]["usuario"],
    iduser: sesion["usuario"][0]["usuario_id"],
    impto: oPos[0]["impuesto"],
    prop: oPos[0]["propina"],
    logo: oPos[0]["logo"],
    prefijo: oPos[0]["prefijo"],
    fecha: oPos[0]["fecha_auditoria"],
  };

  $.ajax({
    url: "imprimir/cierreDiario.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $(".content-wrapper").html(data);
    },
  });
}

function cuentasAnuladasAuditoria() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  oKey = makeid(12);
  parametros = {
    id: oPos[0]["id_ambiente"],
    amb: oPos[0]["nombre"],
    user: sesion["usuario"][0]["usuario"],
    iduser: sesion["usuario"][0]["usuario_id"],
    nivel: sesion["usuario"][0]["tipo"],
    impto: oPos[0]["impuesto"],
    prop: oPos[0]["propina"],
    fecha: oPos[0]["fecha_auditoria"],
    logo: oPos[0]["logo"],
    file: oKey,
  };

  $.ajax({
    url: "informes/cuentasAnuladasAuditoria.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $(".content-wrapper").html(data);
      $("#verInforme").attr(
        "data",
        "imprimir/informes/cuentasActivas_" + oKey + ".pdf"
      );
    },
  });
}

function cuentasActivasAuditoria() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  oKey = makeid(12);
  parametros = {
    id: oPos[0]["id_ambiente"],
    amb: oPos[0]["nombre"],
    user: sesion["usuario"][0]["usuario"],
    iduser: sesion["usuario"][0]["usuario_id"],
    nivel: sesion["usuario"][0]["tipo"],
    impto: oPos[0]["impuesto"],
    prop: oPos[0]["propina"],
    fecha: oPos[0]["fecha_auditoria"],
    logo: oPos[0]["logo"],
    file: oKey,
  };

  $.ajax({
    url: "informes/cuentasActivas.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $(".content-wrapper").html(data);
      $("#verInforme").attr(
        "data",
        "imprimir/informes/cuentasActivas_" + oKey + ".pdf"
      );
    },
  });
}

function cuentasAnuladasAuditoria() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  oKey = makeid(12);

  parametros = {
    id: oPos[0]["id_ambiente"],
    amb: oPos[0]["nombre"],
    user: sesion["usuario"][0]["usuario"],
    iduser: sesion["usuario"][0]["usuario_id"],
    impto: oPos[0]["impuesto"],
    prop: oPos[0]["propina"],
    fecha: oPos[0]["fecha_auditoria"],
    logo: oPos[0]["logo"],
    file: oKey,
  };

  $.ajax({
    url: "informes/cuentasAnuladas.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $(".content-wrapper").html(data);
      $("#verInforme").attr(
        "data",
        "imprimir/informes/cuentasAnuladas_" + oKey + ".pdf"
      );
    },
  });
}

function historicoAuditorias() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  parametros = {
    idamb: oPos[0]["id_ambiente"],
    amb: oPos[0]["nombre"],
    user: sesion["usuario"][0]["usuario"],
    iduser: sesion["usuario"][0]["usuario_id"],
    impto: oPos[0]["impuesto"],
    prop: oPos[0]["propina"],
    fecha: oPos[0]["fecha_auditoria"],
  };
  $.ajax({
    url: "ventas/historicoAuditorias.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $(".content-wrapper").html(data);
    },
  });
}

function cierraSesion() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  var id = sesion["usuario"][0]["usuario_id"];
  var usua = sesion["usuario"][0]["usuario"];
  $.ajax({
    url: "../res/shared/salir.php",
    type: "POST",
    data: {
      id: id,
      usuario: usua,
    },
    success: function () {
      localStorage.removeItem("sesion");
      localStorage.removeItem("oPos");
      $(location).attr("href", "/");
    },
  });
}

function cierreDiarioCajero() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  parametros = {
    id: oPos[0]["id_ambiente"],
    amb: oPos[0]["nombre"],
    user: sesion["usuario"][0]["usuario"],
    iduser: sesion["usuario"][0]["usuario_id"],
    impto: oPos[0]["impuesto"],
    prop: oPos[0]["propina"],
    fecha: oPos[0]["fecha_auditoria"],
  };

  $.ajax({
    url: "imprimir/cierre_cajero.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $(".content-wrapper").html(data);
    },
  });
}

function facturasAnuladasCajero() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  oKey = makeid(12);

  parametros = {
    id: oPos[0]["id_ambiente"],
    amb: oPos[0]["nombre"],
    user: sesion["usuario"][0]["usuario"],
    iduser: sesion["usuario"][0]["usuario_id"],
    impto: oPos[0]["impuesto"],
    prop: oPos[0]["propina"],
    fecha: oPos[0]["fecha_auditoria"],
    logo: oPos[0]["logo"],
    file: oKey,
  };

  $.ajax({
    url: "informes/facturasAnuladasCajero.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $(".content-wrapper").html(data);
      $("#verInforme").attr(
        "data",
        "imprimir/informes/facturasAnuladas_Cajero_" + oKey + ".pdf"
      );
    },
  });
}

function facturasCajero() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  oKey = makeid(12);

  parametros = {
    id: oPos[0]["id_ambiente"],
    amb: oPos[0]["nombre"],
    user: sesion["usuario"][0]["usuario"],
    iduser: sesion["usuario"][0]["usuario_id"],
    impto: oPos[0]["impuesto"],
    prop: oPos[0]["propina"],
    fecha: oPos[0]["fecha_auditoria"],
    logo: oPos[0]["logo"],
    file: oKey,
  };

  $.ajax({
    url: "informes/facturasCajero.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $(".content-wrapper").html(data);
      $("#verInforme").attr(
        "data",
        "imprimir/informes/facturas_Cajero_" + oKey + ".pdf"
      );
    },
  });
}

function devolucionesCajero() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  oKey = makeid(12);
  parametros = {
    id: oPos[0]["id_ambiente"],
    amb: oPos[0]["nombre"],
    user: sesion["usuario"][0]["usuario"],
    iduser: sesion["usuario"][0]["usuario_id"],
    impto: oPos[0]["impuesto"],
    prop: oPos[0]["propina"],
    fecha: oPos[0]["fecha_auditoria"],
    logo: oPos[0]["logo"],
    file: oKey,
  };

  $.ajax({
    url: "informes/devolucionesCajero.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $(".content-wrapper").html(data);
      $("#verInforme").attr("data", "imprimir/informes/" + oKey + ".pdf");
    },
  });
}

function balanceDiarioGeneral() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  oKey = makeid(12);
  parametros = {
    id: oPos[0]["id_ambiente"],
    amb: oPos[0]["nombre"],
    user: sesion["usuario"][0]["usuario"],
    iduser: sesion["usuario"][0]["usuario_id"],
    impto: oPos[0]["impuesto"],
    prop: oPos[0]["propina"],
    fecha: oPos[0]["fecha_auditoria"],
    logo: oPos[0]["logo"],
    file: oKey,
  };

  $.ajax({
    url: "informes/balanceDiarioGeneral.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $(".content-wrapper").html(data);
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
  oKey = makeid(12);
  parametros = {
    id: oPos[0]["id_ambiente"],
    amb: oPos[0]["nombre"],
    user: sesion["usuario"][0]["usuario"],
    iduser: sesion["usuario"][0]["usuario_id"],
    impto: oPos[0]["impuesto"],
    prop: oPos[0]["propina"],
    fecha: oPos[0]["fecha_auditoria"],
    logo: oPos[0]["logo"],
    file: oKey,
  };

  $.ajax({
    url: "informes/balanceDiarioCajero.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $(".content-wrapper").html(data);
      $("#verInforme").attr(
        "data",
        "imprimir/informes/balance_Diario_" + oKey + ".pdf"
      );
    },
  });
}

function cuentasAnuladasCajero() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  oKey = makeid(12);
  parametros = {
    id: oPos[0]["id_ambiente"],
    amb: oPos[0]["nombre"],
    user: sesion["usuario"][0]["usuario"],
    iduser: sesion["usuario"][0]["usuario_id"],
    impto: oPos[0]["impuesto"],
    prop: oPos[0]["propina"],
    fecha: oPos[0]["fecha_auditoria"],
    logo: oPos[0]["logo"],
    file: oKey,
  };
  $.ajax({
    url: "informes/cuentasAnuladasCajero.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $(".content-wrapper").html(data);
      $("#verInforme").attr(
        "data",
        "imprimir/informes/cuentasAnuladas_Cajero_" +
          sesion["usuario"][0]["usuario"] +
          ".pdf"
      );
    },
  });
}

function cuentasActivasCajero() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  oKey = makeid(12);
  parametros = {
    id: oPos[0]["id_ambiente"],
    amb: oPos[0]["nombre"],
    user: sesion["usuario"][0]["usuario"],
    iduser: sesion["usuario"][0]["usuario_id"],
    impto: oPos[0]["impuesto"],
    prop: oPos[0]["propina"],
    fecha: oPos[0]["fecha_auditoria"],
    logo: oPos[0]["logo"],
    file: oKey,
  };
  $.ajax({
    url: "informes/cuentasActivasCajero.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $(".content-wrapper").html(data);
      $("#verInforme").attr(
        "data",
        "imprimir/informes/cuentasActivas_Cajero_" + oKey + ".pdf"
      );
    },
  });
}

function ventasDia() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));

  parametros = {
    id: oPos[0]["id_ambiente"],
    amb: oPos[0]["nombre"],
    user: sesion["usuario"][0]["usuario"],
    impto: oPos[0]["impuesto"],
    prop: oPos[0]["propina"],
  };

  $.ajax({
    url: "ventas/ventas_dia.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $(".content-wrapper").html(data);
    },
  });
}

function cuentasActivas() {
  var alto = screen.height;
  var ancho = screen.width;
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  $(".btn-menu").css("display", "block");

  parametros = {
    id: oPos[0]["id_ambiente"],
    amb: oPos[0]["nombre"],
    user: sesion["usuario"][0]["usuario"],
    nivel: sesion["usuario"][0]["tipo"],
    impto: oPos[0]["impuesto"],
    prop: oPos[0]["propina"],
    fecha: oPos[0]["fecha_auditoria"],
    pref: oPos[0]["prefijo"],
  };

  $.ajax({
    url: "ventas/cuentas_activas.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $(".content-wrapper").html(data);
      $(".main-sidebar").css("display", "none");
      // $('#productosComanda').css('min-height',350);
      $("#productosComanda").css("height", alto - 340);
      $("#Escritorio").css("height", alto - 420);
    },
  });
}

function muestraTouch() {
  var alto = screen.height;
  var ancho = screen.width;
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  $(".main-sidebar").css("display", "none");
  $(".content-wrapper").css("margin-left", "0");
  $("#btnGuardar").attr("disabled", "enabled");

  parametros = {
    id: oPos[0]["id_ambiente"],
    amb: oPos[0]["nombre"],
    user: sesion["usuario"][0]["usuario"],
    impto: oPos[0]["impuesto"],
    prop: oPos[0]["propina"],
    pref: oPos[0]["prefijo"],
    fecha: oPos[0]["fecha_auditoria"],
  };

  $.ajax({
    url: "ventas/touch.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      getSecciones();
      $(".content-wrapper").html(data);
      /// $('#productosComanda').css('min-height',350);
      $("#productosComanda").css("height", alto - 384);
      $("#Escritorio").css("height", alto - 420);
      var storageProd = localStorage.getItem("productoComanda");
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

function calcular_total() {
  total = parseFloat($("#total").val().replace(",", ""));
  totalini = parseFloat($("#totalini").val());
  propina = parseFloat($("#propina").val().replace(",", ""));
  total = totalini + propina;
  $("#total").val(number_format(total, 2));
  $("#montopago").val(total);
}

function calcular_totalDir() {
  total = parseFloat($("#totalDir").val().replace(",", ""));
  totalini = parseFloat($("#totaliniDir").val());
  propina = parseFloat($("#propinaDir").val().replace(",", ""));
  total = totalini + propina;
  $("#totalDir").val(number_format(total, 2));
  $("#montopagoDir").val(total);
}

function activaMenus() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  $("#nombreUsuario").html(
    sesion["usuario"][0]["apellidos"] +
      " " +
      sesion["usuario"][0]["nombres"] +
      '<span class="caret"></span>'
  );
  $("#fechaPos").html("Fecha Proceso " + oPos[0]["fecha_auditoria"]);
  $("#fechaAuditoria").val(oPos[0]["fecha_auditoria"]);
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
  if (sesion["usuario"][0]["estado_usuario_pos"] == 2) {
    swal(
      {
        title: "Usuario ya cerro su movimiento en el Dia !",
        type: "warning",
        confirmButtonText: "Aceptar",
        closeOnConfirm: false,
      },
      function () {
        $(location).attr("href", "../views/modulos.php");
      }
    );
  } else {
    if (sesion["usuario"][0]["id_ambiente"] == 0) {
      $(".main-sidebar").css("display", "none");
      $(".content-wrapper").css("margin-left", "0");
    }
    modInv = sesion["cia"][0]["inv"];
    modPos = sesion["cia"][0]["pms"];

    if (modInv == 1) {
      $("#moduloInv").css("display", "block");
    } else {
      $("#moduloInv").css("display", "none");
    }

    if (modPos == 1) {
      $("#moduloPms").css("display", "block");
    } else {
      $("#moduloPms").css("display", "none");
    }

    parametros = {
      ambSel: sesion["usuario"][0]["id_ambiente"],
      idUsr: sesion["usuario"][0]["usuario_id"],
      sesionUsr: sesion["usuario"][0]["estado_usuario_pos"],
      modInv: modInv,
      modPos: modPos,
    };

    $.ajax({
      url: "res/php/escritorio_pos.php",
      type: "POST",
      data: parametros,
      success: function (data) {
        $("#Escritorio").html(data);
      },
    });
  }
}

function activaPos() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  $("#fechaPos").html("Fecha Proceso " + oPos[0]["fecha_auditoria"]);
  $("#fechaAuditoria").val(oPos[0]["fecha_auditoria"]);
  $("#nombreUsuario").html(
    sesion["usuario"][0]["apellidos"] +
      " " +
      sesion["usuario"][0]["nombres"] +
      '<span class="caret"></span>'
  );
}

function cierreCajero(user) {
  oPos = JSON.parse(localStorage.getItem("oPos"));
  sesion = JSON.parse(localStorage.getItem("sesion"));
  var web = $("#rutaweb").val();
  var parametros = {
    user: user,
    iduser: sesion["usuario"][0]["usuario_id"],
    fecha: oPos[0]["fecha_auditoria"],
    idamb: oPos[0]["id_ambiente"],
    amb: oPos[0]["nombre"],
    logo: oPos[0]["logo"],
    page: web,
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
  oPos = JSON.parse(localStorage.getItem("oPos"));
  var fecha = $("#buscarFecha").val();
  var parametros = {
    fecha: fecha,
    idamb: oPos[0]["id_ambiente"],
    prefijo: oPos[0]["prefijo"],
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
  getSeleccionaAmbiente(oPos[0]["id_ambiente"]);
}

function mesasActivas() {
  oPos = JSON.parse(localStorage.getItem("oPos"));
  parametros = {
    fecha: oPos[0]["fecha_auditoria"],
    id: oPos[0]["id_ambiente"],
  };
  $.ajax({
    url: "res/php/user_actions/mesasActivas.php",
    type: "POST",
    dataType: "json",
    data: parametros,
    success: function (data) {
      $("#contador").val($.trim(data));
    },
  });
}

function cierreDiario() {
  $("#botonCierre").attr("disabled", "disabled");
  mesasActivas();

  setTimeout(function () {
    sale = $("#contador").val();
    web = $("#rutaweb").val();
    fecha = $("#fechaAuditoria").html();
    if (sale == 0) {
      sesion = JSON.parse(localStorage.getItem("sesion"));
      oPos = JSON.parse(localStorage.getItem("oPos"));
      parametros = {
        id: oPos[0]["id_ambiente"],
        amb: oPos[0]["nombre"],
        user: sesion["usuario"][0]["usuario"],
        iduser: sesion["usuario"][0]["usuario_id"],
        impto: oPos[0]["impuesto"],
        prop: oPos[0]["propina"],
        fecha: oPos[0]["fecha_auditoria"],
        prefijo: oPos[0]["prefijo"],
        logo: oPos[0]["logo"],
      };
      $.ajax({
        url: web + "res/php/user_actions/cierreDiario.php",
        type: "POST",
        dataType: "json",
        data: parametros,
        beforeSend: function (objeto) {
          $("#aviso").html("");
          $("#aviso").html(`
            <h4 class="bg-red" style="padding:10px;display:flex">
              <img loading="lazy" style="margin-bottom:0" class="thumbnail" src="../img/loader.gif" alt="" />
              <span style="font-size:24px;font-weight: 700;font-family: ubuntu;margin:15px">Procesando Informacion, No Interrumpa </span>
            </h4>
            `);
        },
        success: function (datos) {
          swal(
            {
              title: "Auditoria Nocturna Terminada con Exito !",
              type: "success",
              confirmButtonText: "Confirmar",
              closeOnConfirm: false,
            },
            function () {
              cierraSesion();
            }
          );
        },
      });
    } else {
      $.ajax({
        url: "res/php/user_actions/comandasSinCerrar.php",
        type: "POST",
        data: { fecha: fecha },
        success: function (data) {
          $("#aviso").html(data);
        },
      });
    }
  }, 1000);
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
      codigo: codigo,
      propina: propina,
      servicio: servicio,
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
      $(".modal-backdrop").remove();
      $(".modal-open").css("overflow", "auto");
      clientes();
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

function getFactura(coma, fact, pms) {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("oPos"));
  var parametros = {
    idamb: oPos[0]["id_ambiente"],
    amb: oPos[0]["nombre"],
    user: sesion["usuario"][0]["usuario"],
    nivel: sesion["usuario"][0]["tipo"],
    impto: oPos[0]["impuesto"],
    prop: oPos[0]["propina"],
    comanda: coma,
    factura: fact,
    pms: pms,
  };
  if (pms == 1) {
    $("#numeroFactura").html("Productos Cheque Cuenta Nro " + fact);
  } else {
    $("#numeroFactura").html("Productos Factura Nro " + fact);
  }
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
    idamb: idamb,
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
  sesion = JSON.parse(localStorage.getItem("sesion"));
  var parametros = {
    idamb: sesion["usuario"][0]["id_ambiente"],
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
    codigo: codigo,
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
      $(".main-sidebar").css("display", "block");
      $(".content-wrapper").css("margin-left", "17%");
      localStorage.setItem("oPos", JSON.stringify(data));
      muestraPos(codigo);
    },
  });
}

function getSecciones() {
  oPos = JSON.parse(localStorage.getItem("oPos"));
  id = oPos[0]["id_ambiente"];
  var alto = screen.height;
  var ancho = screen.width;
  $("#loader").fadeIn("slow");
  $.ajax({
    type: "POST",
    url: "res/php/user_actions/getSeccion.php",
    dataType: "json",
    data: {
      id: id,
    },
    beforeSend: function (objeto) {
      $("#loader").html("<img src='../img/loader.gif'>");
    },
    success: function (data) {
      $("#seccionList").html("");
      $("#seccionList").css("min-height", 120);
      $("#seccionList").css("height", alto - 275);
      for (i = 0; i < data.length; i++) {
        boton = `
        <button 
          class="btn btn-success btnPos btnSecc" 
          onClick="getProducto(this.name,${id});" 
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
  oPos = JSON.parse(localStorage.getItem("oPos"));
  imptoInc = oPos[0]["impuesto"];
  var alto = screen.height;
  var ancho = screen.width;
  var parametros = {
    codigo: codigo,
    ambi: ambi,
    imptoInc: imptoInc,
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
      $("#productoList").css("min-height", 455);
      $("#productoList").css("height", alto - 275);
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

  $(".comanda > tbody").html("");
  for (i = 0; i < listaComanda.length; i++) {
    if (numero == 0) {
      $(".comanda > tbody").append(
        `<tr>
          <td style="padding:3px 3px 0px 3px">${
            listaComanda[i]["producto"]
          }</td>
          <td style="padding:3px 3px 0px 3px">${listaComanda[i]["cant"]}</td>
          <td style="padding:3px 3px 0px 3px" align='right'>${number_format(
            listaComanda[i]["total"],
            2
          )}</td>
          <td style="padding:3px 3px 0px 3px" align='center'>
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
          <td style="padding:3px 3px 0px 3px">${
            listaComanda[i]["producto"]
          }</td>
          <td style="padding:3px 3px 0px 3px">${listaComanda[i]["cant"]}</td>
          <td style="padding:3px 3px 0px 3px" align='right'>${number_format(
            listaComanda[i]["total"],
            2
          )}</td>
          <td style="padding:3px 3px 0px 3px" align='center'>
            <div class="btn-group btnDevuelve" role="group">          
              <button  
                type="button" 
                id="${i}" 
                onclick="botonDevolverProducto('${numero}','${
            listaComanda[i]["codigo"]
          }','${listaComanda[i]["ambiente"]}','${listaComanda[i]["cant"]}','${
            listaComanda[i]["producto"]
          }', this.id, this.parentNode.parentNode.parentNode.rowIndex)" 
                class="fa fa-share btn btn-danger btn-xs"
                title="Devolver Producto">
              </button>
            </div>
          </td>
        </tr>`
        );

        if (sesion["usuario"][0]["tipo"] != "A") {
          $(".btnDevuelve").remove();
          $(".btnDevuelve").css("disabled", "disabled");
        }
      } else {
        if (listaComanda[i]["activo"] == 1) {
          $(".comanda > tbody").append(
            `<tr>
            <td style="padding:3px 3px 0px 3px">${
              listaComanda[i]["producto"]
            }</td>
            <td style="padding:3px 3px 0px 3px">${listaComanda[i]["cant"]}</td>
            <td style="padding:3px 3px 0px 3px" align='right'>${number_format(
              listaComanda[i]["total"],
              2
            )}</td>
            <td style="padding:3px 3px 0px 3px" align='center'>
              <div class="btn-group btnDevuelve" role="group">          
                <button  
                  type="button" 
                  id="${i}" 
                  onclick="botonDevolverProducto('${numero}','${
              listaComanda[i]["codigo"]
            }','${listaComanda[i]["ambiente"]}','${listaComanda[i]["cant"]}','${
              listaComanda[i]["producto"]
            }', this.id, this.parentNode.parentNode.parentNode.rowIndex)" 
                  class="fa fa-share btn btn-danger btn-xs"
                  title="Devolver Producto">
                </button>
              </div>
            </td>
          </tr>`
          );
          if (sesion["usuario"][0]["tipo"] != "A") {
            $(".btnDevuelve").remove();
            $(".btnDevuelve").css("disabled", "disabled");
          }
        } else {
          $(".comanda > tbody").append(
            `<tr>
              <td style="padding:3px 3px 0px 3px">${
                listaComanda[i]["producto"]
              }</td>
              <td style="padding:3px 3px 0px 3px">${
                listaComanda[i]["cant"]
              }</td>
              <td style="padding:3px 3px 0px 3px" align='right'>${number_format(
                listaComanda[i]["total"],
                2
              )}</td>
              <td style="padding:3px 3px 0px 3px" align='center'>
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
  oPos = JSON.parse(localStorage.getItem("oPos"));
  imptoInc = oPos[0]["impuesto"];
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
    valimp = val * 1 - subt;

    dataProd = {
      producto: nom,
      cant: 1,
      importe: val * 1,
      total: val * 1,
      codigo: idp,
      descuento: 0,
      venta: subt,
      impto: imp,
      valorimpto: valimp,
      ambiente: ambi,
      activo: 0,
    };
    listaComanda.push(dataProd);
  }
  localStorage.setItem("productoComanda", JSON.stringify(listaComanda));
  productosActivos();
  resumenComanda();
  /// resumenDescuento(ambi,);
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
  document.getElementsByTagName("table")[0].setAttribute("id", "comanda");
  document.getElementById("comanda").deleteRow(regis);
  borrar = regis - 1;
  listaComanda.splice(borrar, 1);
  localStorage.setItem("productoComanda", JSON.stringify(listaComanda));
  resumenComanda();
}

function buscar() {
  var alto = screen.height;
  var ancho = screen.width;
  oPos = JSON.parse(localStorage.getItem("oPos"));
  ambi = oPos[0]["id_ambiente"];
  var textoBusqueda = $("input#busqueda").val();
  parametros = {
    id: ambi,
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
        $("#productoList").css("min-height", 455);
        $("#productoList").css("height", alto - 400);
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
  var parametros = { fpago: fpago };
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
  var parametros = { fpago: fpago };
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
        // document.location.href="ventas/inicio.php"
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
  $(".content-wrapper").css("margin-left", "0");

  var parametros = {
    idamb: idamb,
    fecha: oPos[0]["fecha_auditoria"],
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
      $("#listaComandas").css("min-height", 120);
      $("#listaComandas").css("height", alto - 275);
      for (i = 0; i < x.length; i++) {
        boton = `
            <button 
              class   ="btn btn-info btnPos btnInfoCom" 
              onClick ="getComandas(this.value);" 
              type    ="button" 
              id      ="${x[i]["comanda"]}"
              value   ="${x[i]["comanda"]}" 
              title   ="Comanda Numero ${x[i]["comanda"]}">
            <h3>Mesa ${x[i]["mesa"]}</h3>
            <h3>Comanda ${number_format(x[i]["comanda"], 0)}</h3>
            <h4>Activa Desde ${x[i]["fecha_comanda"].substr(11, 5)}</h4>
          </button>`;
        $("#listaComandas").append(boton);
      }
    },
  });
}

function getProductosComanda(numero, mesa) {
  oPos = JSON.parse(localStorage.getItem("oPos"));
  listaComanda = [];

  var idamb = oPos[0]["id_ambiente"];
  var parametros = {
    comanda: numero,
    user: sesion["usuario"][0]["usuario"],
    nivel: sesion["usuario"][0]["tipo"],
    nomamb: oPos[0]["nombre"],
    idamb: idamb,
    impto: oPos[0]["impuesto"],
    prop: oPos[0]["propina"],
    pref: oPos[0]["prefijo"],
    fecha: oPos[0]["fecha_auditoria"],
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

function getComandas(numero) {
  oPos = JSON.parse(localStorage.getItem("oPos"));
  listaComanda = [];

  var idamb = oPos[0]["id_ambiente"];
  var parametros = {
    comanda: numero,
    user: sesion["usuario"][0]["usuario"],
    nivel: sesion["usuario"][0]["tipo"],
    nomamb: oPos[0]["nombre"],
    idamb: idamb,
    impto: oPos[0]["impuesto"],
    prop: oPos[0]["propina"],
    pref: oPos[0]["prefijo"],
    fecha: oPos[0]["fecha_auditoria"],
  };
  $("#comandaActiva").val(numero);
  $("#numeroComanda").val(numero);

  $.ajax({
    url: "res/php/user_actions/getComanda.php",
    data: parametros,
    dataType: "json",
    type: "POST",
    beforeSend: function (objeto) {
      $("#loader").html("<img src='../img/loader.gif'>");
    },
    success: function (data) {
      $(".prende").removeAttr("disabled");
      $("#tituloNumero").removeClass("alert-info");
      $("#tituloNumero").addClass("alert-success");
      $("#tituloNumero").html("Comanda Numero " + numero);
      for (i = 0; i < data.length; i++) {
        dataProd = {
          producto: data[i]["nom"],
          cant: data[i]["cant"],
          importe: data[i]["importe"],
          total: data[i]["importe"] * data[i]["cant"],
          codigo: data[i]["producto_id"],
          descuento: data[i]["descuento"],
          venta: data[i]["venta"],
          impto: data[i]["impto"],
          valorimpto: data[i]["valorimpto"],
          ambiente: idamb,
          activo: "1",
        };
        listaComanda.push(dataProd);
        localStorage.setItem("productoComanda", JSON.stringify(listaComanda));
      }
      productosActivos();
      resumenComanda();
      resumenDescuento(idamb, numero);
      if (sesion["usuario"][0]["tipo"] != "A") {
        $(".btnDevolver").css("display", "none");
        $(".btnDevuelve").css("disabled", "disabled");
      }
    },
  });
}

function calculaCambio() {
  total = parseFloat($("#total").val().replace(",", ""));
  pagado = parseFloat($("#montopago").val().replace(",", ""));
  cambio = total - pagado;
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
  total = parseFloat($("#totalDir").val().replace(",", ""));
  pagado = parseFloat($("#montopagoDir").val().replace(",", ""));
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
      // $("#loader2").html("<img src='../img/loader.gif'>");
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

$(document).ready(function () {
  $("#myModalFotoReceta").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget); // Botón que activó el modal
    var id = button.data("id"); // Extraer la información de atributos de datos
    var receta = button.data("receta"); // Extraer la información de atributos de datos
    var foto = button.data("foto"); // Extraer la información de atributos de datos
    modal.find(".modal-title").html("Receta Estandar : " + receta);
    $("#idRecetaFoto").val(id);
  });

  $("#modalAdicionaCliente").on("show.bs.modal", function (event) {
    sesion = JSON.parse(localStorage.getItem("sesion"));
    id = sesion["usuario"][0]["usuario_id"];
    $("#idusr").val(id);
  });

  $("#dataDeleteCliente").on("show.bs.modal", function (event) {
    sesion = JSON.parse(localStorage.getItem("sesion"));
    idusr = sesion["usuario"][0]["usuario_id"];

    var button = $(event.relatedTarget);
    var id = button.data("id");
    var modal = $(this);

    $("#idusrdel").val(idusr);
  });
});
