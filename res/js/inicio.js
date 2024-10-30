document.addEventListener("DOMContentLoaded", async () => {
  let sesion = JSON.parse(localStorage.getItem("sesion"));
  let {user: { usuario, usuario_id, nombres, apellidos, tipo, estado_usuario_pms, estado_usuario_pos },} = sesion;
  if (sesion) {
  }
  $("#myModalLogin").on("show.bs.modal", function (event) {
    $("#error").html("");
    if (sesion) {
      let { user: {usuario_id, usuario, nombres, apellidos, tipo, estado_usuario_pms} } = sesion;
      swal({
        title: `Usuario ${usuario} Ya Activo en el Sistema, Recuperando Informacion`,
        type: "warning",
        confirmButtonText: "Aceptar",
        closeOnConfirm: true,

      },
      function () {
        parametros = {
          usuario_id ,
          tipo,
        };
        $.ajax({
          url: "res/php/user_action/sesionActiva.php",
          type: "POST",
          data: parametros,
        });
        $(location).attr("href", "views/modulos.php");
      })
      $("#myModalLogin").modal("hidden");
    }
  });

  $("#myModalCambiarClave").on("show.bs.modal", function (event) {
    let { user: {usuario_id, usuario, nombres, apellidos, tipo, estado_usuario_pms} } = sesion;
    $("#error").html("");
    $("#idUserPass").val(usuario_id);
    $("#userPass").val(usuario);
  });
  
  modulos = document.querySelector('#modulos');

  /* if(modulos != null){
    if (estado_usuario_pos == "2") {
      $("#cerrado").css("display", "block");
      $("#linkPos").attr("href", "#");
    }
  } */

});
  
function solicitudSoporte() {
  nombres = $("#nombres").val();
  correo = $("#email").val();
  telefono = $("#phone").val();
  asunto = $("#asunto").val();
  comments = $("#comments").val();
  idSoporte = makeNro(6);
  $.ajax({
    url: "../res/php/user_action/enviaCorreo.php",
    type: "POST",
    data: {
      nombres,
      correo,
      telefono,
      asunto,
      comments,
      idSoporte,
    },
    beforeSend: function () {
      $("#mensaje").html(
        '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h1>Verificando Correo !</h1><p>Estamos Procesando su Informacion.</p></div>'
      );
    },
    success: function (x) {
      $("#nombres").val("");
      $("#email").val("");
      $("#phone").val("");
      $("#asunto").val("");
      $("#comments").val("");
      $("#mensajeSoporte").html(x);
      $("#myModalSoporteTecnico").modal("hide");
    },
  });
}

function activaSesion() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let { user:{ usuario, usuario_id, tipo, estado_usuario_pms}, moduloPms: {fecha_auditoria}} = sesion;
  parametros = {
    user: usuario,
    userId: usuario_id,
    fecha: fecha_auditoria,
    tipoUser: tipo,
    cajeroUser: estado_usuario_pms,
  };
}

function ingresoInv() {
  parametros = {
  };
  $.ajax({
    type: "POST",
    data: parametros,
    success: function (data) {
      $(location).attr("href", "../inventario/index.php");
    },
  });
}

function ingresoAdmin() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  const { user: {usuario_id, usuario, nombres, apellidos, tipo, estado_usuario_pms} } = sesion;
  $("#usuarioActivo").val(usuario);
  $("#nombreUsuario").html(` ${apellidos} ${nombres} <span class="caret"></span>`
  );
  $(location).attr("href", "../admin/index.php");
}

function ingresoPms() {
  sesion = JSON.parse(localStorage.getItem("sesion"));

  let { user: { usuario, usuario_id, tipo, estado_usuario_pms }, moduloPms:{ fecha_auditoria } } = sesion;
  
  parametros = {
    usuario,
    usuario_id,
    fecha: fecha_auditoria,
    tipoUser: tipo,
    cajeroUser: estado_usuario_pms,
  };
  $.ajax({
    url: "../pms/res/php/abreCajero.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      $(location).attr("href", "../pms/index.php");
    },
  });
}

function cierraSesion() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  let { user } = sesion;
  let { usuario, usuario_id } = user;
  $.ajax({
    url: "../res/shared/salir.php",
    type: "POST",
    data: {
      id: usuario_id,
      usuario,
    },
    success: function () {
      localStorage.removeItem("sesion");
      localStorage.removeItem("oPos");
      $(location).attr("href", "/");
    },
  });
}

function fechapos() {
  $.ajax({
    url: "../res/shared/fechaPos.php",
    type: "POST",
    success: function (data) {
      $("#fechaPos").html(" Fecha de Proceso [" + data + "] ");
    },
  });
}

function fechapms() {
  $.ajax({
    url: "../res/shared/fechaPms.php",
    type: "POST",
    success: function (data) {
      $("#fechaPms").html(" Fecha de Proceso [" + data + "] ");
    },
  });
}

function activaModulos() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("sesion"));

  fecha = new Date();
  fechaAct =
    fecha.getDate() + "/" + (fecha.getMonth() + 1) + "/" + fecha.getFullYear();
  let { cia: { invMod, posMod, pmsMod, resMod, feMod }, user: { estado, ingreso, tipo, apellidos, nombres, inv, pos, pms, res, fe, estado_usuario_pos }, moduloPms: { fecha_auditoria } } = sesion;
  /* let { estado, ingreso, tipo, apellidos, nombres, inv, pos, pms, res } = user;
  let {   console.log(sesion)
invMod, posMod, pmsMod, resMod } = cia;
  let { fecha_auditoria } = moduloPms; */

  muestraFecha = document.querySelector('#fechaPms');
  muestraFecha.innerHTML(`Fecha de Proceso [${fecha_auditoria}]`)

  $("#nombreUsuario").html(
    `${apellidos}  ${nombres}<span class="caret"></span>`
  );

  /* if (estado_usuario_pos == "2") {
    $("#cerrado").css("display", "block");
    $("#linkPos").attr("href", "#");
  } */
}

function redondeo(numero, decimales) {
  var flotante = parseFloat(numero);
  var resultado =
    Math.round(flotante * Math.pow(10, decimales)) / Math.pow(10, decimales);
  return resultado;
}

function duplicadoClave() {
  clave1 = $("#clave1").val();
  clave2 = $("#clave2").val();
  if (clave1 != clave2) {
    muestraError("Las Contraseñas no Coinciden")
    limpiaClaves()
  }
}

function limpiaClaves(){
  $("#claveactual").val("");
  $("#clave1").val("");
  $("#clave2").val("");
  $("#clave1").focus();
}

function valida_ingreso() {
  var user = $("#login").val().toUpperCase();
  var pass = $("#pass").val();
  $.ajax({
    url: "res/php/user_action/validaIngreso.php",
    type: "POST",
    dataType: "json",
    data: "login=" + user + "&password=" + pass,
    success: function (data) {
      let { entro, user } = data;
      if (entro == "0") {
        muestraError("Usuario o Contraseña Incorrecto");
        limpiaError();
      } else {
        let { estado, ingreso, multipleIngreso } = user;
        if (estado == "C") {
          muestraError("Usuario sin Acceso Permitido al Sistema");
          limpiaError();
        } else if (ingreso == 1 && multipleIngreso == 0) {
          muestraError("Usuario Activo en el Sistema");
          limpiaError();
        } else {
          localStorage.setItem("sesion", JSON.stringify(data));
          $(location).attr("href", "views/modulos.php");
        }
      }
    },
  });
}

function recuperaClave() {
  var correo = $("#email").val();
  $.ajax({
    url: "res/php/user_actions/validaEmail.php",
    type: "post",
    dataType: "json",
    data: {
      correo,
    },
    success: function (x) {
      $("#mensaje").html(x.mensaje);
      $("#email").val("");
    },
  });
}

function cambiaClave() {
  var id = $("#idUserPass").val();
  var usuario = $("#userPass").val();
  var claveactual = $("#claveactual").val();
  var nuevaclave = $("#clave1").val();
  var confirmaclave = $("#clave2").val();
  if (claveactual == "") {
    $("#mensaje").html(
      '<div class="alert alert-warning"> <span class="glyphicon glyphicon-info-sign"></span> Constraseña Actual en Blanco No Permitido</div>'
    );
    $("#claveactual").focus();
    return false;
  }
  if (nuevaclave == confirmaclave) {
    $.ajax({
      beforeSend: function () {},
      url: "../res/php/user_action/cambiaClave.php",
      type: "POST",
      dataType: "json",
      data: {
        usuario,
        id,
        claveactual,
        nuevaclave,
      },
      success: function (resp) {

        if (resp == 0) {
          muestraError("Contraseña Incorrecta !!")
          limpiaClaves()
        } else {
          if (resp == "1") {
            muestraError("Contraseña Actualizada con Exito !! \n Ingrese de Nuevo al sistema para Actualizar su Usuario")
            limpiaClaves()
            cierraSesion()
          }
        }
      },
    });
  } else {

    $("#mensaje").html(
      '<div class="alert alert-warning"> <span class="glyphicon glyphicon-info-sign"></span> No Coinciden los Datos de la Nueva Contraseña</div>'
    );
    $("#nuevaclave").val("");
    $("#confirmaclave").val("");
    $("#claveactual").focus();
  }
}



function makeNro(length) {
  var result = "";
  var characters = "0123456789";
  var charactersLength = characters.length;
  for (var i = 0; i < length; i++) {
    result += characters.charAt(Math.floor(Math.random() * charactersLength));
  }
  return result;
}

function makeid(length) {
  var result = "";
  var characters =
    "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
  var charactersLength = characters.length;
  for (var i = 0; i < length; i++) {
    result += characters.charAt(Math.floor(Math.random() * charactersLength));
  }
  return result;
}

function exportTableToExcel(tableID, filename = "") {
  var downloadLink;
  var dataType = "application/vnd.ms-excel";
  var tableSelect = document.getElementById(tableID);
  var tableHTML = tableSelect.outerHTML.replace(/ /g, "%20");

  filename = filename ? filename + ".xls" : "excel_data.xls";

  downloadLink = document.createElement("a");
  document.body.appendChild(downloadLink);

  if (navigator.msSaveOrOpenBlob) {
    var blob = new Blob(["ufeff", tableHTML], {
      type: dataType,
    });
    navigator.msSaveOrOpenBlob(blob, filename);
  } else {
    downloadLink.href = "data:" + dataType + ", " + tableHTML;
    downloadLink.download = filename;
    downloadLink.click();
  }
}

function leeCajeroCerrado(file) {
  var archivo = new XMLHttpRequest();
  archivo.open("GET", file, false);
  archivo.onreadystatechange = function () {
    if (archivo.readyState === 4) {
      if (archivo.status === 200 || archivo.status == 0) {
        var Texto = archivo.responseText;
        resp = Texto;
        $(".sidebar-mini").html("");
        $(".sidebar-mini").html(`${resp}`);
      }
    }
  };
  archivo.send(null);
}

function leeCajeroActivo() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  var archivo = new XMLHttpRequest();
  archivo.open("GET", "menus/menu_hotel.php", false);
  archivo.onreadystatechange = function () {
    if (archivo.readyState === 4) {
      if (archivo.status === 200 || archivo.status == 0) {
        var Texto = archivo.responseText;
        resp = Texto;
        $(".main-sidebar").html("");
        $(".main-sidebar").html(`${resp}`);
      }
    }
  };
  archivo.send(null);
}

/* function muestraErrorAlerta(error) {
  $("#error").html(`
    <div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> ${error}</div>`);
  $("#login").val("");
  $("#pass").val("");
  $("#login").focus();

  limpiaError();
} */

function muestraError(error) {
  $("#error").html(`
    <div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> ${error}</div>`);
    setTimeout(function () {
      $("#error").html(``);
    }, 4000);
  }

function limpiaError() {
  $("#login").val("");
  $("#pass").val("");
  $("#login").focus();
}

