sesion = JSON.parse(localStorage.getItem("sesion"));
if (sesion) {
  var { user } = sesion;
  var { usuario_id, usuario, nombres, apellidos, tipo } = user;
  // console.log(usuario);
}

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
      nombres: nombres,
      correo: correo,
      telefono: telefono,
      asunto: asunto,
      comments: comments,
      idSoporte: idSoporte,
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
  let { moduloPms } = sesion;
  let { fecha_auditoria } = moduloPms;
  parametros = {
    user: usuario,
    userId: susuario_id,
    fecha: fecha_auditoria,
    tipoUser: tipo,
    cajeroUser: estado_usuario_pms,
  };
}

function ingresoInv() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  parametros = {
    user: sesion["usuario"][0]["usuario"],
    userId: sesion["usuario"][0]["usuario_id"],
    fecha: sesion["pms"][0]["fecha_auditoria"],
    tipoUser: sesion["usuario"][0]["tipo"],
    cajeroUser: sesion["usuario"][0]["estado_usuario_pms"],
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
  /* idusr = sesion["usuario"][0]["usuario_id"];
  user = sesion["usuario"][0]["usuario"];
  nombres = sesion["usuario"][0]["nombres"];
  apellidos = sesion["usuario"][0]["apellidos"]; */
  $("#usuarioActivo").val(usuario);
  $("#nombreUsuario").html(
    apellidos + " " + nombres + ' <span class="caret"></span>'
  );
  $(location).attr("href", "../admin/index.php");
}

function ingresoPms() {
  sesion = JSON.parse(localStorage.getItem("sesion"));

  let { user, moduloPms } = sesion;
  let { usuario, usuario_id, tipo, estado_usuario_pms } = user;
  let { fecha_auditoria } = moduloPms;

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

function ingresoPos() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  oPos = JSON.parse(localStorage.getItem("sesion"));

  console.log(oPos);

  parametros = {
    fecha: oPos[0]["fecha_auditoria"],
  };
  $.ajax({
    url: "",
    type: "POST",
    data: parametros,
    success: function (data) {},
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
  let { cia, user, moduloPms } = sesion;
  let { estado, ingreso, tipo, apellidos, nombres } = user;
  let { inv, pos, pms, res } = cia;
  let { fecha_auditoria } = moduloPms;

  var div = '<div class="container-fluid moduloCentrar">';
  if (inv == "1") {
    div =
      div +
      `<div id="inv" style="cursor: pointer;" class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
          <a onclick="ingresoInv()" class="small-box-footer">
            <div class="small-box bg-yellow-gradient">	
              <div class="inner">	
                <h3>Inventarios</h3>
                <p>Control de Stock</p>
              </div>
              <div class="icon">
                <i class="ion ion-archive"></i>
              </div>
              <small class="small-box-footer" style="font-size:12px">Ingresar
                <i class="fa fa-arrow-circle-right"></i>
              </small>
            </div>
          </a>
       </div>`;
  }
  if (pos == "1") {
    div =
      div +
      `
			<div id="pos" class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<a href="../pos/inicio.php" class="small-box-footer">
				<div class="small-box bg-green-gradient">
					<div class="inner"> 
						<h3>Puntos de Venta</h3> 
						<p>Ventas Restaurantes </p>
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
  if (pms == "1") {
    div =
      div +
      `
			<div id="pms" 
				style="cursor: pointer;" 
				class="col-lg-4 col-md-4 col-sm-6 col-xs-12">	
				<a onclick="ingresoPms()" >
					<div class="small-box bg-blue-gradient">			
						<div class="inner">				
							<h3>PMS Software </h3> 				
							<p style="color:#FFF" id="fechaPms">Fecha de Proceso [${fecha_auditoria}] </p>
						</div>              			
						<div class="icon">                				
							<i class="ion ion-ios-home-outline"></i>              			
						</div>			
						<span class="small-box-footer">Ingresar 
							<i class="fa fa-arrow-circle-right"></i>
						</span>		
					</div>	
				</a>              
			</div>
		`;
  }
  if (tipo == "1") {
    div =
      div +
      `
		<div id="par" style="cursor: pointer;display:flex;margin-top:40px" class="container-fluid">
			<div class="container moduloCentrar">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
					<a onclick="ingresoAdmin()" class="small-box-footer">                  
						<div class="small-box bg-red-gradient">                    
							<div class="inner">                      
								<h3 style="overflow-x: hidden;">Configuracion General <br></h3> 
								<p style="color:#FFF">Parametros del Sistema</p>
							</div>                    
							<div class="icon">
								<i class="fa fa-cogs"></i>
							</div>
							<small class="small-box-footer" style="font-size:12px">Ingresar <i class="fa fa-arrow-circle-right"></i></small>
						</div>
					</a>
				</div>
			</div>
		</div>
		`;
  }
  $("#modulos").html(div);
  $("#nombreUsuario").html(
    `${apellidos}  ${nombres}<span class="caret"></span>`
  );
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
  if (clave1 == clave2) {
  } else {
    swal("Precaucion", "Las Contraseñas no Coinciden", "warning");
    $("#clave1").val("");
    $("#clave2").val("");
    $("#clave1").focus();
  }
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
      } else {
        let { estado, ingreso, multipleIngreso } = user;
        if (estado == "C") {
          muestraError("Usuario sin Acceso Permitido al Sistema");
        } else if (ingreso == 1 && multipleIngreso == 0) {
          muestraError("Usuario Activo en el Sistema");
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
      correo: correo,
    },
    success: function (x) {
      console.log(x);
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
        usuario: usuario,
        id: id,
        claveactual: claveactual,
        nuevaclave: nuevaclave,
      },
      success: function (x) {
        if (x == 0) {
          $("#claveactual").val("");
          $("#nuevaclave").val("");
          $("#confirmaclave").val("");
          $("#mensaje").html(
            '<div class="alert alert-warning"> <span class="glyphicon glyphicon-info-sign"></span> Contraseña Incorrecta !!</div>'
          );
          $("#claveactual").focus();
        } else {
          if (x == "1") {
            $("#mensaje").html(
              '<div class="alert alert-success"> <span class="glyphicon glyphicon-info-sign"></span> Contraseña Actualizada con Exito !!</div>'
            );
            $("#confirmaclave").val("");
            $("#nuevaclave").val("");
            $("#claveactual").focus();
            $(location).attr("href", "modulos.php");
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

  // Specify file name
  filename = filename ? filename + ".xls" : "excel_data.xls";

  // Create download link element
  downloadLink = document.createElement("a");

  document.body.appendChild(downloadLink);

  if (navigator.msSaveOrOpenBlob) {
    var blob = new Blob(["ufeff", tableHTML], {
      type: dataType,
    });
    navigator.msSaveOrOpenBlob(blob, filename);
  } else {
    // Create a link to the file
    downloadLink.href = "data:" + dataType + ", " + tableHTML;

    // Setting the file name
    downloadLink.download = filename;

    //triggering the function
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

document.addEventListener("DOMContentLoaded", async () => {
  $("#myModalLogin").on("show.bs.modal", function (event) {
    $("#error").html("");
    if (localStorage.getItem("sesion")) {
      entro = JSON.parse(localStorage.getItem("sesion"));
      let { user } = entro;
      let { usuario, usuario_id } = user;
      swal(
        "Atencion",
        `Usuario ${usuario} Ya Activo en el Sistema, Recuperando Informacion`,
        "warning"
      );
      setTimeout(function () {
        parametros = {
          idUsr: usuario_id,
        };
        $.ajax({
          url: "res/php/user_action/sesionActiva.php",
          type: "POST",
          data: parametros,
        });
        $(location).attr("href", "views/modulos.php");
      }, 2000);
      $("#myModalLogin").modal("hidden");
    }
  });
});

function muestraError(error) {
  $("#error").html(`
    <div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> ${error}</div>`);

  $("#login").val("");
  $("#pass").val("");
  $("#login").focus();

  limpiaError();
}

function limpiaError() {
  setTimeout(function () {
    $("#error").html(``);
  }, 2000);
}
