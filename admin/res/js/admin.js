/* CONFIGURACION GENERAL */

/* Actualizacion Datos Empresa*/
function updateConfigCia() {
  ruta = $("#rutaweb").val();
  pagina = $("#ubicacion").val();
  var formData = new FormData($("#updateCompany")[0]);

  $.ajax({
    url: "res/php/updateCompany.php",
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
    success: function () {
      $(location).attr("href", pagina);
    },
  });
}

/* Modulos Activos de la Empresa*/
function activaModulos() {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  parametros = sesion["cia"][0];
  $.ajax({
    url: "res/php/activaModulos.php",
    type: "POST",
    data: parametros,
    success: function () {},
  });
}

/* Mesas */
function guardaMesa() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var impuestos = $("#guardarDatosMesa").serialize();
  var parametros = impuestos;
  $.ajax({
    url: ruta + "res/php/guardaMesa.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensaje").html(
        '<div style="padding:5px" class="alert alert-info"><h4" align="center">Impuesto Ingresado con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function updateMesa() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var mesa = $("#updateDatosMesa").serialize();
  var parametros = mesa;
  $.ajax({
    url: ruta + "res/php/updateMesa.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensaje").html(
        '<div style="padding:5px" class="alert alert-info"><h4" align="center">Impuesto Ingresado con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function deleteMesa() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var mesa = $("#deleteDatosMesa").serialize();
  var parametros = mesa;
  $.ajax({
    url: ruta + "res/php/eliminaMesa.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensaje").html(
        '<div style="padding:5px" class="alert alert-info"><h4" align="center">Impuesto Ingresado con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

/* Impuestos */
function actualizaImpuestos() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var impuestos = $("#modificaDatosImpuesto").serialize();
  var parametros = impuestos;
  $.ajax({
    url: ruta + "res/php/actualizaImpuesto.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensajeMod").html(
        '<div style="padding:5px" class="alert alert-info"><h4 align="center">Impuesto Actualizado con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function eliminaImpuesto() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var id = $("#idImptoEliImp").val();
  var parametros = {
    id: id,
  };
  $.ajax({
    url: ruta + "res/php/eliminaImpuesto.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensaje").html(
        '<div style="padding:5px" class="alert alert-danger"><h4" align="center">Impuesto Eliminado con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function guardaImpuestos() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var impuestos = $("#guardarDatosImpuesto").serialize();
  var parametros = impuestos;
  $.ajax({
    url: ruta + "res/php/guardaImpuestos.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensaje").html(
        '<div style="padding:5px" class="alert alert-info"><h4" align="center">Impuesto Ingresado con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

/* Usuarios del Sisterma*/
function reabrirUsuario() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var id = $("#idUserRea").val();
  parametros = {
    id: id,
  };
  $.ajax({
    url: ruta + "res/php/reabreUsuario.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      swal("Atencion", "Usuario Reabierto Con Exito", "success");
      $(location).attr("href", "usuarios.php");
    },
  });
}

function bloqueaUsuario() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var id = $("#idUserBloq").val();
  var estado = $("#estadoBloq").val();
  parametros = {
    id,
    estado,
  };
  $.ajax({
    url: ruta + "res/php/bloqueaUsuario.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      swal("Atencion", "Usuario Bloqueado Con Exito", "success");
      $(location).attr("href", "usuarios.php");
    },
  });
}

function asignaClave() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var id = $("#idUserPsw").val();
  var usuario = $("#usuarioPsw").val();
  var clave1 = $("#clave1Asi").val();
  var clave2 = $("#clave2Asi").val();

  parametros = {
    id: id,
    usuario: usuario,
    clave: clave1,
  };
  $.ajax({
    url: ruta + "res/php/asignaClave.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      swal("Atencion", "Contraseña Actualizada con Exito", "success");
      $("#myModalAsignaClave").modal("hide");
    },
  });
}

function duplicadoClave() {
  clave1 = $("#clave1").val();
  clave2 = $("#clave2").val();
  if (clave1 != clave2) {
    swal("Precaucion", "Las Contraseñas no Coinciden", "warning");
    $("#clave1").val("");
    $("#clave2").val("");
    $("#clave1").focus();
  }
}

function usuarioRepetido(user) {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var parametros = {
    user: user,
  };
  $.ajax({
    url: ruta + "res/php/buscaUsuario.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      if (data == 1) {
        swal(
          "Precaucion",
          "Usuario Ya existe, no permitido Duplicar",
          "warning"
        );
        $("#usuario").val("");
      }
    },
  });
}

function actualizaUsuario() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var usuario = $("#formModificaUsuario").serializeArray();
  if ($("#idPosUpd").is(":checked")) {
    Pos = 1;
  } else {
    Pos = 0;
  }
  if ($("#idPMSUpd").is(":checked")) {
    PMS = 1;
  } else {
    PMS = 0;
  }
  if ($("#idInvUpd").is(":checked")) {
    Inv = 1;
  } else {
    Inv = 0;
  }
  usuario.push({ name: "Pos", value: Pos });
  usuario.push({ name: "PMS", value: PMS });
  usuario.push({ name: "Inv", value: Inv });

  var parametros = usuario;

  $.ajax({
    url: ruta + "res/php/actualizaUsuario.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensajeMod").html(
        '<div class="alert alert-info"><h4 style="text-align:center;">Usuario Actualizado con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function adicionaUsuario() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var usuario = $("#formAdicionaUsuario").serializeArray();
  if ($("#idPos").is(":checked")) {
    Pos = 1;
  } else {
    Pos = 0;
  }
  if ($("#idPMS").is(":checked")) {
    PMS = 1;
  } else {
    PMS = 0;
  }
  if ($("#idInv").is(":checked")) {
    Inv = 1;
  } else {
    Inv = 0;
  }
  usuario.push({ name: "Pos", value: Pos });
  usuario.push({ name: "PMS", value: PMS });
  usuario.push({ name: "Inv", value: Inv });

  var parametros = usuario;
  $.ajax({
    url: ruta + "res/php/guardaUsuario.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensaje").html(
        '<div class="alert alert-info"><h4>Usuario Ingresado con Exito</h4></div>'
      );
      $(location).attr("href", "usuarios.php");
    },
  });
}

/* Equipos Control de Acceo al Sistema por IP */
function activaEquipo(id, tipo) {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  $.ajax({
    url: ruta + "res/php/activaEquipo.php",
    type: "POST",
    data: {
      id: id,
      tipo: tipo,
    },
    success: function (data) {
      $(location).attr("href", ruta + pagina);
    },
  });
}

function eliminaEquipo() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var id = $("#idEquipoEli").val();
  var equipo = $("#nombreEli").val();
  var descrip = $("#descripcionEli").val();

  parametros = {
    id: id,
    equipo: equipo,
    descrip: descrip,
  };
  $.ajax({
    url: ruta + "res/php/eliminaEquipos.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensajeEli").html(`
						<div style="padding:5px" class="alert alert-danger">
							<h4 align="center">Equipo Eliminado con Exito</h4>
						</div>`);
      $(location).attr("href", ruta + pagina);
    },
  });
}

function actualizaEquipo() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var id = $("#idEquipoMod").val();
  var equipo = $("#nombreMod").val();
  var descrip = $("#descripcionMod").val();

  parametros = {
    id: id,
    equipo: equipo,
    descrip: descrip,
  };
  $.ajax({
    url: ruta + "res/php/actualizaEquipos.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensajeMod").html(`
						<div style="padding:5px" class="alert alert-info">
							<h4 align="center">Equipo Actualizado con Exito</h4>
						</div>`);
      $(location).attr("href", ruta + pagina);
    },
  });
}

function guardaEquipo() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var equipo = $("#equipoAdi").val();
  var descrip = $("#descripcionAdi").val();

  parametros = {
    equipo: equipo,
    descrip: descrip,
  };
  $.ajax({
    url: ruta + "res/php/guardaEquipo.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensaje").html(`
						<div style="padding:5px" class="alert alert-info">
							<h4 align="center">Equipo Ingresado con Exito</h4>
						</div>`);
      $(location).attr("href", ruta + pagina);
    },
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

function verFotoAct(e) {
  if (e.files && e.files[0]) {
    if (e.files[0].type.match("image.*")) {
      var reader = new FileReader();
      reader.onload = function (e) {
        document.getElementById("mostrarFotoMod").innerHTML =
          "<img loading='lazy' style='margin:0' class='img-thumbnail' src='" +
          e.target.result +
          "'>";
      };
      reader.onerror = function (e) {
        document.getElementById("mostrarFotoMod").innerHTML =
          "Error de lectura";
      };
      reader.readAsDataURL(e.files[0]);
    } else {
      document.getElementById("mostrarFotoMod").innerHTML =
        "No es un formato de imagen";
    }
  }
}

/* MODULO DE INVENTARIOS */
/* Tipos de Movimientos de Inventarios  */
function guardaTipoMovi() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var descri = $("#nombreAdi").val();
  var tipo = $("input:radio[name=moviOption]:checked").val();

  if ($("#idCompraAdi").is(":checked")) {
    Compra = 1;
  } else {
    Compra = 0;
  }
  if ($("#idAjusteAdi").is(":checked")) {
    Ajuste = 1;
  } else {
    Ajuste = 0;
  }
  if ($("#idTrasladoAdi").is(":checked")) {
    Traslado = 1;
  } else {
    Traslado = 0;
  }
  $.ajax({
    url: "res/php/adicionaTipoMovi.php",
    type: "POST",
    data: {
      descri: descri,
      tipo: tipo,
      compra: Compra,
      ajuste: Ajuste,
      traslado: Traslado,
    },
    success: function () {
      $("#mensajeAdi").html(
        '<div style="padding:5px" class="alert alert-info"><h4 align="center">Tipo Movimiento Adicionado con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function eliminaTipoMovi() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var id = $("#idTipoMovEli").val();
  var descri = $("#nombreEli").val();
  var tipo = $("input:radio[name=moviOptionEli]:checked").val();

  $.ajax({
    url: "res/php/eliminaTipoMovi.php",
    type: "POST",
    data: {
      id: id,
    },
    success: function () {
      $("#mensajeEli").html(
        '<div style="padding:5px" class="alert alert-danger"><h4 align="center">Tipo Movimiento Eliminado con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function actualizaTipoMovi() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var id = $("#idTipoMovMod").val();
  var descri = $("#nombreMod").val();
  var tipo = $("input:radio[name=moviOptionMod]:checked").val();

  if ($("#idCompraMod").is(":checked")) {
    Compra = 1;
  } else {
    Compra = 0;
  }
  if ($("#idAjusteMod").is(":checked")) {
    Ajuste = 1;
  } else {
    Ajuste = 0;
  }
  if ($("#idTrasladoMod").is(":checked")) {
    Traslado = 1;
  } else {
    Traslado = 0;
  }
  $.ajax({
    url: "res/php/actualizaTipoMovi.php",
    type: "POST",
    data: {
      id: id,
      descri: descri,
      tipo: tipo,
      compra: Compra,
      ajuste: Ajuste,
      traslado: Traslado,
    },
    success: function () {
      $("#mensajeMod").html(
        '<div style="padding:5px" class="alert alert-info"><h4 align="center">Tipo Movimiento Actualizado con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

/* Unidades de Medida*/
function guardaUnidad() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var unidad = $("#nombreAdi").val();

  parametros = {
    unidad,
  };
  $.ajax({
    url: ruta + "res/php/guardaUnidad.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      console.log(objeto);
      $("#mensaje").html(`
					<div style="padding:5px" class="alert alert-success">
						<h4 align="center">Unidad de Medida Ingresada con Exito</h4>
					</div>`);
      $(location).attr("href", ruta + pagina);
    },
  });
}

function actualizaUnidad() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var nombre = $("#nombreMod").val();
  var id = $("#idUnidadMod").val();

  parametros = {
    unidad: nombre,
    id: id,
  };
  $.ajax({
    url: ruta + "res/php/actualizaUnidad.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensaje").html(`
					<div style="padding:5px" class="alert alert-success">
						<h4 align="center">Unidad de Medida Actualizada con Exito</h4>
					</div>`);
      $(location).attr("href", ruta + pagina);
    },
  });
}

function eliminaUnidad() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var nombre = $("#nombreEli").val();
  var id = $("#idUnidadEli").val();

  parametros = {
    unidad: nombre,
    id: id,
  };
  $.ajax({
    url: ruta + "res/php/eliminarUnidad.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensaje").html(`
					<div style="padding:5px" class="alert alert-success">
						<h4 align="center">Unidad de Medida Eliminada con Exito</h4>
					</div>`);
      $(location).attr("href", ruta + pagina);
    },
  });
}

/* Bodegas de Almacenamiento */
function eliminaBodega() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var bodega = $("#eliminaDatosBodega").serialize();

  $.ajax({
    url: ruta + "res/php/eliminaBodega.php",
    type: "POST",
    data: bodega,
    success: function (objeto) {
      $("#mensajeEli").html(`
					<div style="padding:5px" class="alert alert-danger">
						<h4 align="center">Bodega Eliminada con Exito</h4>
					</div>`);
      $(location).attr("href", ruta + pagina);
    },
  });
}

function actualizaBodega() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var bodega = $("#modificaDatosBodega").serialize();

  $.ajax({
    url: ruta + "res/php/actualizaBodega.php",
    type: "POST",
    data: bodega,
    success: function (objeto) {
      $("#mensaje").html(`
					<div style="padding:5px" class="alert alert-info">
						<h4 align="center">Bodega Actualizada con Exito</h4>
					</div>`);
      $(location).attr("href", ruta + pagina);
    },
  });
}

function guardaBodega() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var nombre = $("#nombreAdi").val();
  var tipo = $("#imptoOption").val();
  var bodega = $("#guardarDatosBodega").serialize();

  parametros = {
    bodega: nombre,
    tipo: tipo,
  };
  $.ajax({
    url: ruta + "res/php/guardaBodega.php",
    type: "POST",
    data: bodega,
    success: function (objeto) {
      $("#mensaje").html(`
					<div style="padding:5px" class="alert alert-success">
						<h4 align="center">Bodega Ingresada con Exito</h4>
					</div>`);
      $(location).attr("href", ruta + pagina);
    },
  });
}

/* Familias de Inventarios */
function actualizaFamilia() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var idfamilia = $("#idFamiliaMod").val();
  var familia = $("#nombreMod").val();
  var parametros = {
    id: idfamilia,
    familia: familia,
  };
  $.ajax({
    url: ruta + "res/php/actualizaFamilia.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensajeMod").html(
        '<div style="padding:5px" class="alert alert-info"><h4" align="center">Agrupacion Actualizada con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function eliminaFamilia() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var id = $("#idFamiliaEli").val();
  $.ajax({
    url: ruta + "res/php/eliminaFamilia.php",
    type: "POST",
    data: { id: id },
    success: function (objeto) {
      $("#mensajeEli").html(
        '<div style="padding:5px" class="alert alert-danger"><h4 align="center">Familia de Inventarios Eliminada con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function guardaFamilia() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var familia = $("#nombreAdi").val();
  parametros = {
    familia: familia,
  };
  $.ajax({
    url: ruta + "res/php/guardaFamilia.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensaje").html(
        '<div style="padding:5px" class="alert alert-info"><h4" align="center">Departamento Ingresado con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

/* Grupos de Inventarios */
function guardaGrupo() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var parametros = $("#guardarDatosGrupo").serialize();
  $.ajax({
    url: ruta + "res/php/guardaGrupo.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensaje").html(
        '<div style="padding:5px" class="alert alert-info"><h4" align="center">Departamento Ingresado con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function actualizaGrupo() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  parametros = $("#modificaDatosGrupo").serialize();
  $.ajax({
    url: ruta + "res/php/actualizaGrupoInv.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensaje").html(
        '<div style="padding:5px" class="alert alert-info"><h4" align="center">Grupo de Inventarios Actualizado con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function eliminaGrupo() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var id = $("#idGrupoEli").val();
  $.ajax({
    url: ruta + "res/php/eliminaGrupo.php",
    type: "POST",
    data: { id: id },
    success: function (objeto) {
      $("#mensajeEli").html(
        '<div style="padding:5px" class="alert alert-danger"><h4 align="center">Familia de Inventarios Eliminada con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

/* Sub Grupos de Inventarios */
function guardaSubgrupo() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var idfam = $("#familiaGrp").val();
  var grupo = $("#nombreGrupo").val();
  var subgrupo = $("#nombreSubG").val();
  parametros = {
    id: idfam,
    grupo: grupo,
    subgrupo: subgrupo,
  };
  $.ajax({
    url: ruta + "res/php/guardaSubgrupo.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensaje").html(
        '<div style="padding:5px" class="alert alert-info"><h4" align="center">Departamento Ingresado con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function actualizaSubgrupo() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var parametros = $("#actualizaDatosSubgrupo").serialize();
  $.ajax({
    url: ruta + "res/php/actualizaSubgrupo.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensajeMod").html(
        '<div style="padding:5px" class="alert alert-success"><h4 align="center">Departamento Ingresado con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function eliminaSubgrupo() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var parametros = $("#eliminaDatosSubgrupo").serialize();
  $.ajax({
    url: ruta + "res/php/eliminaSubgrupo.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensajeMod").html(
        '<div style="padding:5px" class="alert alert-success"><h4 align="center">Departamento Ingresado con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function traeGrupoInventarios(id, tipo) {
  var flag = tipo;
  grupo = $("#grupoSubGrupoMod").val();
  $.ajax({
    url: "res/php/getGruposInventarios.php",
    type: "POST",
    data: {
      id: id,
    },
    success: function (data) {
      if (flag == 1) {
        $("#nombreGrupo option").remove();
        $("#nombreGrupo").append(data);
      } else {
        $("#grupoSubGrupoMod option").remove();
        $("#grupoSubGrupoMod").append(data);
        $("#grupoSubGrupoMod").val(grupo);
      }
    },
  });
}

/* MODULO POS */

function validaMonto(valor, campo) {}

function cambiaEstadoAmbiente(ambiente, estado) {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  $.ajax({
    url: ruta + "res/php/cambiaEstadoAmbiente.php",
    type: "POST",
    data: {
      ambiente: ambiente,
      estado: estado,
    },
    success: function (objeto) {
      $(location).attr("href", ruta + pagina);
    },
  });
}

function guardaFormaPagoPos() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var formaspago = $("#guardarDatosFormaPagoPos").serializeArray();
  var parametros = formaspago;
  $.ajax({
    url: ruta + "res/php/guardaFormaPagoPos.php",
    type: "POST",
    data: formaspago,
    success: function (objeto) {
      $("#mensaje").html(
        '<div style="padding:5px" class="alert alert-info"><h4" align="center">Forma de Pago Ingresado con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function actualizaFormaPagoPos() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var formaspago = $("#actualizaDatosFormaPagoPos").serializeArray();
  var parametros = formaspago;

  $.ajax({
    url: ruta + "res/php/actualizaFormaPagoPos.php",
    type: "POST",
    data: formaspago,
    success: function (objeto) {
      $("#mensaje").html(
        '<div style="padding:5px" class="alert alert-info"><h4" align="center">Forma de Pago Actualizado con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function eliminaFormaPagoPos() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var id = $("#idFormaPagoEli").val();
  $.ajax({
    url: ruta + "res/php/eliminaFormaPagoPos.php",
    type: "POST",
    data: { id: id },
    success: function (objeto) {
      $("#mensajeEli").html(
        '<div style="padding:5px" class="alert alert-danger"><h4 align="center">Forma de Pago Eliminado con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

/* Periodos de Servivios */
function guardaPeriodo() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var parametros = $("#guardarDatosPeriodo").serialize();
  $.ajax({
    url: ruta + "res/php/guardaPeriodo.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensajeAdi").html(
        '<div style="padding:5px" class="alert alert-info"><h4 align="center">Periodo de Servicio Ingresado con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function actualizaPeriodo() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var parametros = $("#actualizaDatosPeriodo").serialize();
  $.ajax({
    url: ruta + "res/php/actualizaPeriodo.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensajeMod").html(
        '<div style="padding:5px" class="alert alert-info"><h4 align="center">Periodo de Servicio Actualizado con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function eliminaPeriodo() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var parametros = $("#eliminaDatosPeriodo").serialize();
  $.ajax({
    url: ruta + "res/php/eliminaPeriodo.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensajeEli").html(
        '<div style="padding:5px" class="alert alert-danger"><h4 align="center">Periodo de Servicio Eliminado con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

/* Descuentos */
function activaDescuento(id, tipo) {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  $.ajax({
    url: ruta + "res/php/activaDescuento.php",
    type: "POST",
    data: {
      id: id,
      tipo: tipo,
    },
    success: function (data) {
      $(location).attr("href", ruta + pagina);
    },
  });
}

function guardaDescuento() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var descu = $("#guardarDatosDescuento").serialize();
  var porce = $("#porcentajeAdi").val();
  var monto = $("#montoAdi").val();
  if (porce == 0 && monto == 0) {
    swal("Precaucion", "Descuento en cero no permitidos", "warning");
  } else {
    if (porce != 0 && monto != 0) {
      swal("Precaucion", "Descuento no Permitido", "warning");
    } else {
      var parametros = descu;
      $.ajax({
        url: ruta + "res/php/guardaDescuento.php",
        type: "POST",
        data: parametros,
        success: function (objeto) {
          $("#mensajeAdi").html(
            '<div style="padding:5px" class="alert alert-info"><h4 align="center">Descuento Ingresado con Exito</h4></div>'
          );
          $(location).attr("href", ruta + pagina);
        },
      });
    }
  }
}

function eliminaDescuento() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var descu = $("#eliminaDatosDescuento").serialize();
  var parametros = descu;
  $.ajax({
    url: ruta + "res/php/eliminaDescuento.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensajeEli").html(
        '<div style="padding:5px" class="alert alert-danger"><h4 align="center">Descuento Eliminado con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function actualizaDescuento() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var descu = $("#actualizaDatosDescuento").serialize();
  var porce = $("#porcentajeMod").val();
  var monto = $("#montoMod").val();
  if (porce == 0 && monto == 0) {
    swal("Precaucion", "Descuento en cero no permitidos", "warning");
  } else {
    if (porce != 0 && monto != 0) {
      $("#porcentajeAdi").val(0);
      $("#montoAdi").val(0);
      $("#porcentajeAdi").focus();
      swal("Precaucion", "Descuento no Permitido", "warning");
    } else {
      var parametros = descu;
      $.ajax({
        url: ruta + "res/php/actualizaDescuento.php",
        type: "POST",
        data: parametros,
        success: function (objeto) {
          $("#mensajeMod").html(
            '<div style="padding:5px" class="alert alert-info"><h4 align="center">Descuento Actualizado con Exito</h4></div>'
          );
          $(location).attr("href", ruta + pagina);
        },
      });
    }
  }
}

/* Ambientes */
function guardaAmbiente() {
  ruta = $("#rutaweb").val();
  pagina = $("#ubicacion").val();
  var formData = new FormData($("#guardarDatosAmbiente")[0]);

  $.ajax({
    url: "res/php/adicionaAmbiente.php",
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
    success: function () {
      $(location).attr("href", pagina);
    },
  });
}

function eliminaAmbiente() {
  ruta = $("#rutaweb").val();
  pagina = $("#ubicacion").val();
  id = $("#idAmbienteEli").val();

  $.ajax({
    url: "res/php/eliminaAmbiente.php",
    type: "POST",
    data: { id: id },
    success: function () {
      $(location).attr("href", pagina);
    },
  });
}

function actualizaAmbiente() {
  ruta = $("#rutaweb").val();
  pagina = $("#ubicacion").val();
  var formData = new FormData($("#actualizaDatosAmbiente")[0]);

  $.ajax({
    url: "res/php/actualizaAmbiente.php",
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
    success: function () {
      $(location).attr("href", pagina);
    },
  });
}

/* Tipos de Platos*/
function eliminaTipoPlato() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var id = $("#idAgrupEli").val();
  $.ajax({
    url: ruta + "res/php/eliminaTipoPlato.php",
    type: "POST",
    data: { id: id },
    success: function (objeto) {
      $("#mensajeEli").html(
        '<div style="padding:5px" class="alert alert-danger"><h4 align="center">Agrupacion Eliminada con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function actualizaTipoPlato() {
  let pagina = $("#ubicacion").val();
  let ruta = $("#rutaweb").val();
  let parametros = $("#modificaDatosAgrupacion").serialize();
  // var parametros = conversion;
  $.ajax({
    url: ruta + "res/php/actualizaTipoPlato.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensajeMod").html(
        '<div style="padding:5px" class="alert alert-info"><h4" align="center">Agrupacion Actualizada con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function guardaTipoPlato() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var agrupa = $("#guardarDatosAgrupacion").serialize();
  var parametros = agrupa;
  $.ajax({
    url: ruta + "res/php/guardaTipoPlato.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensaje").html(
        '<div style="padding:5px" class="alert alert-info"><h4" align="center">Tipo de Plato Ingresado con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

/* MODULO PMS */
/* Actualizacion Datos Hotel*/

function updateConsecutivosHotel() {
  ruta = $("#rutaweb").val();
  pagina = $("#ubicacion").val();
  var parametros = $("#updateConsecutivosHotel").serialize();

  $.ajax({
    url: "res/php/updateConsecutivosHotel.php",
    type: "POST",
    data: parametros,
    success: function () {
      $(location).attr("href", pagina);
    },
  });
}

function updateHotel() {
  ruta = $("#rutaweb").val();
  pagina = $("#ubicacion").val();
  var formData = new FormData($("#updateHotel")[0]);

  $.ajax({
    url: "res/php/updateDataHotel.php",
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
    success: function () {
      $(location).attr("href", pagina);
    },
  });
}

function eliminarValorSubTarifa() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var id = $("#idValSubTariEli").val();

  $.ajax({
    url: ruta + "res/php/eliminaValorSubTarifa.php",
    type: "POST",
    data: { id: id },
    success: function (objeto) {
      $("#mensajesubtar").html(
        '<div style="padding:5px" class="alert alert-info"><h4" align="center">Tarifa Habitacion Ingresada con Exito</h4></div>'
      );
      $("#myModalEliminaValorSubtarifa").modal("hide");
      $("#myModalValoresSubTarifas").modal("hide");
    },
  });
}

function actualizaValorSubTarifa() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var id = $("#idSubTariAdiMod").val();
  var habita = $("#formActualizaValorSubTarifa").serialize();

  var parametros = habita;
  $.ajax({
    url: ruta + "res/php/actualizaValorSubTarifa.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensajesubtar").html(
        '<div style="padding:5px" class="alert alert-info"><h4" align="center">Tarifa Habitacion Ingresada con Exito</h4></div>'
      );
      $("#myModalModificaValorSubTarifa").modal("hide");
    },
  });
}

function guardaValorSubTarifa() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var habita = $("#formGuardarValorSubTarifa").serialize();
  var parametros = habita;

  $.ajax({
    url: ruta + "res/php/guardaValorSubTarifa.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensajesubtar").html(`
					<div style="padding:5px" class="alert alert-info"><h4 align="center">Tarifa Habitacion Ingresada con Exito</h4></div>
					`);
      $("#myModalAdicionarValorSubTarifa").modal("hide");
      $("#myModalValoresSubTarifas").modal("hide");
    },
  });
}

function eliminaSubTarifa(id) {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var id = $("#idSubTariEli").val();
  var descr = $("#descripcionSubTarifaEli").val();

  $.ajax({
    url: ruta + "res/php/eliminaSubtarifa.php",
    type: "POST",
    data: { id: id },
    success: function (objeto) {
      $("#mensajeEli").html(`
					<div style="padding:5px" class="alert alert-danger"><h4 align="center">Grupo de Tarifa Eliminada con Exito</h4></div>
					`);
      $("#myModalEliminaSubtarifa").modal("hide");
      // $("#tablaSubTarifas > tbody:last").children().remove();
      // $(location).attr('href',ruta+pagina);
    },
  });
}

function actualizaSubTarifa() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var id = $("#idSubTariMod").val();
  var idgrupo = $("#idTariGruMod").val();
  var desctar = $("#descripcionSubTarifaMod").val();

  $.ajax({
    url: ruta + "res/php/actualizaSubtarifa.php",
    type: "POST",
    data: {
      id: id,
      idgrupo: idgrupo,
      desctar: desctar,
    },
    success: function (data) {
      // $("#tablaTarifas > tbody").append("<tr><td>"+desctar+"</td><td align='center' style='width: 20%'><div class='btn-toolbar' role='toolbar' aria-label='...'><div class='btn-group' role='group' aria-label='...'><button type='button' class='btn btn-info btn-xs' data-toggle  ='modal' data-target  ='#myModalModificaSubtarifa' data-id      ="+data+" data-idgrupo ="+idgrupo+" data-descri  ="+desctar+" title='Modificar la Subtarifa Actual' ><i class='fa fa-pencil-square'></i></button><button type='button' class='btn btn-danger btn-xs' data-toggle  ='modal' data-target  ='#myModalEliminaTarifa' data-id ="+data+" data-idgrupo ="+idgrupo+" data-descri  ="+desctar+" title='Elimina la Subtarifa Actual' ><i class='fa fa-trash'></i></button></div></div></td></tr>");
      $("#myModalModificaSubtarifa").modal("hide");
    },
  });
}

function calendarioTarifas(id, desc) {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var tarifa = id;
  var descri = desc;

  $.ajax({
    url: ruta + "res/php/calendarioTarifas.php",
    type: "POST",
    data: {
      tarifa: tarifa,
      descri: descri,
    },
    success: function (obj) {
      $("#valorTarifa").html(obj);
      /// $("#mensaje").html('<div style="padding:5px" class="alert alert-danger"><h4 align="center">Grupo de Tarifa Creado con Exito</h4></div>');
      /// $(location).attr('href',ruta+pagina);
    },
  });
}

function guardaSubTarifa() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var idgrupo = $("#idTariLis").val();
  var desctar = $("#descripcionTarifaAdi").val();
  desctar = desctar.toUpperCase();
  $.ajax({
    url: ruta + "res/php/guardaSubtarifa.php",
    type: "POST",
    data: {
      idgrupo: idgrupo,
      desctar: desctar,
    },
    success: function (data) {
      $("#tablaSubTarifas > tbody").append(
        "<tr><td>" +
          desctar +
          "</td><td align='center' style='width: 20%'><div class='btn-toolbar' role='toolbar'><div class='btn-group' role='group'><button type='button' class='btn btn-info btn-xs' data-toggle  ='modal' data-target  ='#myModalModificaSubtarifa' data-id =" +
          data +
          " data-idgrupo =" +
          idgrupo +
          " data-descri  =" +
          desctar +
          " title='Modificar la SubTarifa Actual' ><i class='fa fa-pencil-square'></i></button><button type='button' class='btn btn-danger btn-xs' data-toggle  ='modal' data-target  ='#myModalEliminaSubtarifa' data-id =" +
          data +
          " data-idgrupo =" +
          idgrupo +
          " data-descri  =" +
          desctar +
          " title='Eimina el Sub Grupo de Tarifa Actual' > <i class='fa fa-trash'></i> </button> </div> <div class='btn-group' role='group' aria-label='...'> <button type='button' class='btn btn-success btn-xs' data-toggle  ='modal' data-target  ='#myModalValoresSubTarifas' data-id =" +
          data +
          " data-idgrupo =" +
          idgrupo +
          " data-descri  =" +
          desctar +
          " title='Tipos de Habitaciones de la Sub Tarifa Actual' > <i class='fa fa-window-restore'></i> </button> </div> </div></td></tr>"
      );
      $("#myModalAdicionarSubTarifa").modal("hide");
    },
  });
}

/* Grupos de Tarifas*/
function eliminaGrupoTarifa() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var id = $("#idTariEli").val();
  $.ajax({
    url: ruta + "res/php/eliminaGrupoTarifa.php",
    type: "POST",
    data: { id: id },
    success: function (objeto) {
      $("#mensajeEli").html(
        '<div style="padding:5px" class="alert alert-danger"><h4 align="center">Grupo de Tarifa Eliminada con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function actualizaGrupoTarifa() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var id = $("#idTariMod").val();
  var descri = $("#descripcionMod").val();

  $.ajax({
    url: ruta + "res/php/actualizaGrupoTarifa.php",
    type: "POST",
    data: {
      id: id,
      descri: descri,
    },
    success: function (objeto) {
      $("#mensaje").html(
        '<div style="padding:5px" class="alert alert-info"><h4" align="center">Paquete Actualizado con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function guardaGrupoTarifa() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var descr = $("#descripcionAdi").val();

  $.ajax({
    url: ruta + "res/php/guardaGrupoTarifa.php",
    type: "POST",
    data: { descri: descr },
    success: function (obj) {
      $("#mensaje").html(
        '<div style="padding:5px" class="alert alert-danger"><h4 align="center">Grupo de Tarifa Creado con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

/* Paquetes PMS*/
function eliminaPaquete() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var id = $("#idPaquEli").val();
  $.ajax({
    url: ruta + "res/php/eliminaPaquete.php",
    type: "POST",
    data: { id: id },
    success: function (objeto) {
      $("#mensajeEli").html(
        '<div style="padding:5px" class="alert alert-danger"><h4 align="center">Paquete Eliminada con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function actualizaPaquete() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var habita = $("#modificaPaquete").serialize();

  var parametros = habita;
  $.ajax({
    url: ruta + "res/php/actualizaPaquete.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensaje").html(
        '<div style="padding:5px" class="alert alert-info"><h4" align="center">Paquete Actualizado con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function guardaPaquete() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var paquete = $("#guardarDatosPaquete").serialize();

  var parametros = paquete;
  $.ajax({
    url: ruta + "res/php/guardaPaquete.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensaje").html(
        '<div style="padding:5px" class="alert alert-info"><h4" align="center">Paquete Ingresada con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

/* Habitaciones PMS*/
function actualizaHabitacion() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var habita = $("#modificaDatosHabi").serialize();

  var parametros = habita;
  $.ajax({
    url: ruta + "res/php/actualizaHabitacion.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensaje").html(
        '<div style="padding:5px" class="alert alert-info"><h4" align="center">Habitacion Ingresada con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function eliminaHabitacion() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var id = $("#idHabiEli").val();
  $.ajax({
    url: ruta + "res/php/eliminaHabitacion.php",
    type: "POST",
    data: { id: id },
    success: function (objeto) {
      $("#mensajeEli").html(
        '<div style="padding:5px" class="alert alert-danger"><h4 align="center">Habitacion Eliminada con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function guardaHabitacion() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var habita = $("#guardarDatosHabitacion").serialize();

  var parametros = habita;
  $.ajax({
    url: ruta + "res/php/guardaHabitacion.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensaje").html(
        '<div style="padding:5px" class="alert alert-info"><h4" align="center">Habitacion Ingresada con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function activaHabitacion(id, tipo) {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  $.ajax({
    url: ruta + "res/php/activaHabitacion.php",
    type: "POST",
    data: {
      id: id,
      tipo: tipo,
    },
    success: function (data) {
      $(location).attr("href", ruta + pagina);
    },
  });
}

/* Tipos de Habitacion */
function actualizaTipoHabi() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var id = $("#idTipoHabiMod").val();
  var codigo = $("#CodigoMod").val();
  var descr = $("#nombreMod").val();
  var tipoh = $("#TipoHabiMod").val();
  var codvta = $("#CodTipoHabiMod").val();

  var parametros = {
    id,
    codigo,
    descr,
    tipoh,
    codvta,
  };

  $.ajax({
    url: ruta + "res/php/actualizaTipoHabi.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensajeMod").html(
        '<div style="padding:5px" class="alert alert-info"><h4" align="center">Tipo de Habitacion Actualizada con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function eliminaTipoHabi() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var id = $("#idTipoHabiEli").val();
  $.ajax({
    url: ruta + "res/php/eliminaTipoHabi.php",
    type: "POST",
    data: { id: id },
    success: function (objeto) {
      $("#mensajeEli").html(
        '<div style="padding:5px" class="alert alert-danger"><h4 align="center">Agrupacion Eliminada con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function guardaTipoHabi() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var codigo = $("#CodigoAdi").val();
  var descr = $("#nombreAdi").val();
  var tipoh = $("#TipoHabiAdi").val();
  var codvta = $("#CodTipoHabiAdi").val();

  var parametros = {
    codigo: codigo,
    descr: descr,
    tipoh: tipoh,
    codvta: codvta,
  };
  $.ajax({
    url: ruta + "res/php/guardaTipoHabi.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensaje").html(
        '<div style="padding:5px" class="alert alert-info"><h4" align="center">Tipo de Habitacion Ingresada con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function activaTipoHabi(id, tipo) {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  $.ajax({
    url: ruta + "res/php/activaTipoHabi.php",
    type: "POST",
    data: {
      id: id,
      tipo: tipo,
    },
    success: function (data) {
      $(location).attr("href", ruta + pagina);
    },
  });
}

/* Sectores Hotel */
function actualizaSector() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var id = $("#idSectorMod").val();
  var sector = $("#nombreMod").val();
  var parametros = {
    id: id,
    sector: sector,
  };

  $.ajax({
    url: ruta + "res/php/actualizaSector.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensajeMod").html(
        '<div style="padding:5px" class="alert alert-info"><h4 align="center">Sector Actualizada con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function eliminaSector() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var id = $("#idSectorEli").val();
  $.ajax({
    url: ruta + "res/php/eliminaSector.php",
    type: "POST",
    data: { id: id },
    success: function (objeto) {
      $("#mensajeEli").html(
        '<div style="padding:5px" class="alert alert-danger"><h4 align="center">Agrupacion Eliminada con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function guardaSectorHabi() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var sector = $("#nombreAdi").val();
  var parametros = { sector: sector };
  $.ajax({
    url: ruta + "res/php/guardaSectorHabi.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensaje").html(
        '<div style="padding:5px" class="alert alert-info"><h4" align="center">Conversion Ingresada con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

/* Agrupaciones de Ventas */
function eliminaAgrupacion() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var id = $("#idAgrupEli").val();
  $.ajax({
    url: ruta + "res/php/eliminaAgrupacion.php",
    type: "POST",
    data: { id: id },
    success: function (objeto) {
      $("#mensajeEli").html(
        '<div style="padding:5px" class="alert alert-danger"><h4 align="center">Agrupacion Eliminada con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function actualizaAgrupacion() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var conversion = $("#modificaDatosAgrupacion").serialize();
  var parametros = conversion;
  $.ajax({
    url: ruta + "res/php/actualizaAgrupacion.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensajeMod").html(
        '<div style="padding:5px" class="alert alert-info"><h4" align="center">Agrupacion Actualizada con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function guardaAgrupacion() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var agrupa = $("#guardarDatosAgrupacion").serialize();
  var parametros = agrupa;
  $.ajax({
    url: ruta + "res/php/guardaAgrupacion.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensaje").html(
        '<div style="padding:5px" class="alert alert-info"><h4" align="center">Agrupacion Ingresada con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

/* Conversiones de Medidas */
function actualizaConversion() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var conversion = $("#modificaDatosConversion").serialize();
  var parametros = conversion;
  $.ajax({
    url: ruta + "res/php/actualizaConversion.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensajeMod").html(
        '<div style="padding:5px" class="alert alert-info"><h4" align="center">Conversion Actualizada con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function eliminaConversion() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var id = $("#idConvEli").val();
  $.ajax({
    url: ruta + "res/php/eliminaConversion.php",
    type: "POST",
    data: { id: id },
    success: function (objeto) {
      $("#mensajeEli").html(
        '<div style="padding:5px" class="alert alert-danger"><h4 align="center">Conversion Eliminada con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function guardaConversion() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var conversion = $("#guardarDatosConversion").serialize();
  var parametros = conversion;
  $.ajax({
    url: ruta + "res/php/guardaConversion.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensaje").html(
        '<div style="padding:5px" class="alert alert-info"><h4" align="center">Conversion Ingresada con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

/* Centros de Costos Empresa*/
function eliminaCentro() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var id = $("#idCentroEli").val();
  $.ajax({
    url: ruta + "res/php/eliminaCentro.php",
    type: "POST",
    data: { id: id },
    success: function (objeto) {
      $("#mensajeEli").html(
        '<div style="padding:5px" class="alert alert-danger"><h4 align="center">Centro de Costos Eliminado con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function actualizaCentro() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var centros = $("#modificaDatosCentro").serialize();
  var parametros = centros;
  $.ajax({
    url: ruta + "res/php/actualizaCentros.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensajeMod").html(
        '<div style="padding:5px" class="alert alert-info"><h4 align="center">Centro de Costos Actualizado con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function guardaCentro() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var centros = $("#guardarDatosCentro").serialize();
  var parametros = centros;
  $.ajax({
    url: ruta + "res/php/guardaCentros.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensaje").html(
        '<div style="padding:5px" class="alert alert-info"><h4" align="center">Centro de Costos Ingresado con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

/* Departamentos Empresa */
function actualizaDepto() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var depto = $("#nombreMod").val();
  var id = $("#idDeptoMod").val();
  var parametros = { id: id, depto: depto };
  $.ajax({
    url: ruta + "res/php/actualizaDepto.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensaje").html(
        '<div style="padding:5px" class="alert alert-info"><h4" align="center">Departamento Actualziado con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function eliminaDepto() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var id = $("#idDeptoEli").val();
  $.ajax({
    url: ruta + "res/php/eliminaDepto.php",
    type: "POST",
    data: { id: id },
    success: function (objeto) {
      $("#mensajeEli").html(
        '<div style="padding:5px" class="alert alert-danger"><h4 align="center">Departamento Eliminado con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function guardaDepto() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var depto = $("#nombreAdi").val();
  parametros = {
    depto: depto,
  };
  $.ajax({
    url: ruta + "res/php/guardaDepto.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensaje").html(
        '<div style="padding:5px" class="alert alert-info"><h4" align="center">Departamento Ingresado con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

/* Codigos de Ventas */
function eliminaCodigoVentas() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var id = $("#idCodigoEli").val();
  $.ajax({
    url: ruta + "res/php/eliminaCodigoVenta.php",
    type: "POST",
    data: { id: id },
    success: function (objeto) {
      $("#mensajeEli").html(
        '<div style="padding:5px" class="alert alert-danger"><h4 align="center">Codigo de Venta Eliminado con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function actualizaCodigoVentas() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var ventas = $("#actualizaDatosCodigosVentas").serialize();
  var parametros = ventas;
  $.ajax({
    url: ruta + "res/php/actualizaCodigoVentas.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensaje").html(
        '<div style="padding:5px" class="alert alert-info"><h4" align="center">Forma de Pago Ingresado con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function guardaCodigoVentas() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var ventas = $("#guardarDatosCodigosVentas").serialize();
  var parametros = ventas;
  $.ajax({
    url: ruta + "res/php/guardaCodigoVentas.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensaje").html(
        '<div style="padding:5px" class="alert alert-info"><h4" align="center">Forma de Pago Ingresado con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

/* Formas de Pago */
function actualizaFormaPago() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var impuestos = $("#actualizaDatosFormaPago").serialize();
  var parametros = impuestos;
  $.ajax({
    url: ruta + "res/php/actualizaFormaPago.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensaje").html(
        '<div style="padding:5px" class="alert alert-info"><h4" align="center">Forma de Pago Actualizado con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function eliminaFormaPago() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var id = $("#eliminaFormaPago").val();
  $.ajax({
    url: ruta + "res/php/eliminaFormaPago.php",
    type: "POST",
    data: { id: id },
    success: function (objeto) {
      $("#mensajeEli").html(
        '<div style="padding:5px" class="alert alert-danger"><h4 align="center">Forma de Pago Eliminado con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function guardaFormaPago() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var impuestos = $("#guardarDatosFormaPago").serialize();
  var parametros = impuestos;
  $.ajax({
    url: ruta + "res/php/guardaFormaPago.php",
    type: "POST",
    data: parametros,
    success: function (objeto) {
      $("#mensaje").html(
        '<div style="padding:5px" class="alert alert-info"><h4" align="center">Forma de Pago Ingresado con Exito</h4></div>'
      );
      $(location).attr("href", ruta + pagina);
    },
  });
}

function activaPago(id, tipo) {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  $.ajax({
    url: ruta + "res/php/activaFormaPago.php",
    type: "POST",
    data: {
      id: id,
      tipo: tipo,
    },
    success: function (data) {
      $(location).attr("href", ruta + pagina);
    },
  });
}

/* Funciones de Modal */
$(document).ready(function () {
  /* Formas de Pago POS*/
  $("#myModalEliminaFormaPagoPos").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var descri = button.data("descri");
    var puc = button.data("puc");
    var descon = button.data("descon");
    var pms = button.data("pms");
    var modal = $(this);

    modal.find(".modal-title").text("Elimina Forma de Pago : " + descri);

    modal.find(".modal-body #idFormaPagoEli").val(id);
    modal.find(".modal-body #nombreEli").val(descri);
    modal.find(".modal-body #pucEli").val(puc);
    modal.find(".modal-body #descripcionEli").val(descon);
    if (pms == 1) {
      $("#pmsEli").attr("checked", true);
    } else {
      $("#pmsEli").attr("checked", false);
    }
  });

  $("#myModalModificaFormaPagoPos").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var descri = button.data("descri");
    var puc = button.data("puc");
    var descon = button.data("descon");
    var pms = button.data("pms");
    var modal = $(this);

    modal.find(".modal-title").text("Elimina Forma de Pago : " + descri);

    modal.find(".modal-body #idFormaPagoMod").val(id);
    modal.find(".modal-body #nombreMod").val(descri);
    modal.find(".modal-body #pucMod").val(puc);
    modal.find(".modal-body #descripcionMod").val(descon);
    if (pms == "1") {
      $("#pmsMod").prop("checked", true);
    } else {
      $("#pmsMod").prop("checked", false);
    }
  });

  /* Periodos de Servicio*/
  $("#myModalEliminaPeriodo").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var descr = button.data("descri");
    var desde = button.data("desde");
    var hasta = button.data("hasta");
    var ambie = button.data("ambien");
    var modal = $(this);

    modal.find(".modal-title").text("Elimina Periodo : " + descr);

    modal.find(".modal-body #idPeriodoEli").val(id);
    modal.find(".modal-body #nombreEli").val(descr);
    modal.find(".modal-body #nombreAmbiEli").val(ambie);
    modal.find(".modal-body #inicioEli").val(desde);
    modal.find(".modal-body #finalEli").val(hasta);
  });

  $("#myModalModificaPeriodo").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var descr = button.data("descri");
    var desde = button.data("desde");
    var hasta = button.data("hasta");
    var ambie = button.data("ambien");
    var modal = $(this);

    modal.find(".modal-title").text("Modifica Periodo : " + descr);

    modal.find(".modal-body #idPeriodoMod").val(id);
    modal.find(".modal-body #nombreMod").val(descr);
    modal.find(".modal-body #nombreAmbiMod").val(ambie);
    modal.find(".modal-body #inicioMod").val(desde);
    modal.find(".modal-body #finalMod").val(hasta);
  });

  /* Descuentos */
  $("#myModalEliminaDescuento").on("show.bs.modal", function (event) {
    var sesion = JSON.parse(localStorage.getItem("sesion"));
    let { cia } = sesion;
    let { pms } = cia;
    // var pms = sesion["cia"][0]["pms"];
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var descr = button.data("descri");
    var porce = button.data("porcen");
    var ambie = button.data("ambien");
    var modal = $(this);

    modal.find(".modal-title").text("Elimina Descuento : " + descr);

    modal.find(".modal-body #idDescuentoEli").val(id);
    modal.find(".modal-body #nombreEli").val(descr);
    modal.find(".modal-body #nombreAmbiEli").val(ambie);
    modal.find(".modal-body #porcentajeEli").val(porce);
  });

  $("#myModalModificaDescuento").on("show.bs.modal", function (event) {
    var sesion = JSON.parse(localStorage.getItem("sesion"));
    let { cia } = sesion;
    let { pms } = cia;
    // var pms = sesion["cia"][0]["pms"];
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var descr = button.data("descri");
    var porce = button.data("porcen");
    var ambie = button.data("ambien");
    var modal = $(this);

    modal.find(".modal-title").text("Modifica Descuento : " + descr);

    modal.find(".modal-body #idDescuentoMod").val(id);
    modal.find(".modal-body #nombreMod").val(descr);
    modal.find(".modal-body #nombreAmbiMod").val(ambie);
    modal.find(".modal-body #porcentajeMod").val(porce);
  });

  /* Ambientes */
  $("#myModalAdicionarAmbiente").on("show.bs.modal", function (event) {
    var pagina = $("#ubicacion").val();
    var ruta = $("#rutaweb").val();
    var sesion = JSON.parse(localStorage.getItem("sesion"));
    let { cia } = sesion;
    let { pms } = cia;
    // var pms = sesion["cia"][0]["pms"];
    var modal = $(this);

    modal.find(".modal-title").text("Adicionar Ambiente");

    if (pms == 0) {
      $(".pms").css("display", "none");
      $("#ventaAdi").removeAttr("required");
      $("#propinaAdi").removeAttr("required");
    } else {
      $(".pms").css("display", "block");
    }
  });

  $("#myModalEliminaAmbiente").on("show.bs.modal", function (event) {
    var sesion = JSON.parse(localStorage.getItem("sesion"));
    let { cia } = sesion;
    let { pms } = cia;
    // var pms = sesion["cia"][0]["pms"];
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var descr = button.data("desc");
    var pref = button.data("pref");
    var fact = button.data("fact");
    var orde = button.data("orde");
    var coma = button.data("coma");
    var impu = button.data("impu");
    var bode = button.data("bode");
    var cent = button.data("cent");
    var vent = button.data("vent");
    var prop = button.data("prop");
    var logo = button.data("logo");
    var modal = $(this);

    modal.find(".modal-title").text("Elimina Ambiente : " + descr);

    if (pms == 0) {
      $(".pms").css("display", "none");
      $("#ventaAdi").removeAttr("required");
      $("#propinaAdi").removeAttr("required");
    } else {
      $(".pms").css("display", "block");
    }

    modal.find(".modal-body #idAmbienteEli").val(id);
    modal.find(".modal-body #nombreEli").val(descr);
    modal.find(".modal-body #prefijoEli").val(pref);
    modal.find(".modal-body #facturaEli").val(fact);
    modal.find(".modal-body #ordenEli").val(orde);
    modal.find(".modal-body #comandaEli").val(coma);
    modal.find(".modal-body #BodegaEli").val(bode);
    modal.find(".modal-body #centroEli").val(cent);
    modal.find(".modal-body #ventaEli").val(vent);
    modal.find(".modal-body #propinaEli").val(prop);
    modal.find(".modal-body #imgLogoEli").val(logo);

    if (impu == 1) {
      $("#inlineRadioEli1").attr("checked", true);
    } else {
      $("#inlineRadioEli2").attr("checked", true);
    }

    if (logo == "") {
      $(".img-thumbnail").attr("src", "../img/noimage.png");
    } else {
      $(".img-thumbnail").attr("src", "../img/" + logo);
    }
  });

  $("#myModalModificaAmbiente").on("show.bs.modal", function (event) {
    var sesion = JSON.parse(localStorage.getItem("sesion"));
    let { cia } = sesion;
    let { pms } = cia;
    // var pms = sesion["cia"][0]["pms"];
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var descr = button.data("desc");
    var pref = button.data("pref");
    var fact = button.data("fact");
    var orde = button.data("orde");
    var coma = button.data("coma");
    var impu = button.data("impu");
    var bode = button.data("bode");
    var cent = button.data("cent");
    var vent = button.data("vent");
    var prop = button.data("prop");
    var logo = button.data("logo");

    var modal = $(this);

    modal.find(".modal-title").text("Modifica Ambiente : " + descr);

    if (pms == 0) {
      $(".pms").css("display", "none");
      $("#ventaAdi").removeAttr("required");
      $("#propinaAdi").removeAttr("required");
    } else {
      $(".pms").css("display", "block");
    }

    modal.find(".modal-body #idAmbienteMod").val(id);
    modal.find(".modal-body #nombreMod").val(descr);
    modal.find(".modal-body #prefijoMod").val(pref);
    modal.find(".modal-body #facturaMod").val(fact);
    modal.find(".modal-body #ordenMod").val(orde);
    modal.find(".modal-body #comandaMod").val(coma);
    modal.find(".modal-body #BodegaMod").val(bode);
    modal.find(".modal-body #centroMod").val(cent);
    modal.find(".modal-body #ventaMod").val(vent);
    modal.find(".modal-body #propinaMod").val(prop);
    modal.find(".modal-body #imgLogoMod").val(logo);

    if (impu == 1) {
      $("#inlineRadioMod1").attr("checked", true);
    } else {
      $("#inlineRadioMod2").attr("checked", true);
    }

    if (logo == "") {
      $(".img-thumbnail").attr("src", "../img/noimage.png");
    } else {
      $(".img-thumbnail").attr("src", "../img/" + logo);
    }
  });

  $("#myModalEliminaTipoMovimiento").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var descri = button.data("descri");
    var tipo = button.data("tipo");
    var compra = button.data("compra");
    var ajuste = button.data("ajuste");
    var traslado = button.data("trasla");
    var modal = $(this);

    modal.find(".modal-title").text("Elimina Tipo de Movimiento : " + descri);
    modal.find(".modal-body #idTipoMovEli").val(id);
    modal.find(".modal-body #nombreEli").val(descri);
    modal.find(".modal-body #nombreEli").val(descri);
    if (compra == 1) {
      modal.find(".modal-body #idCompraEli").prop("checked", true);
    } else {
      modal.find(".modal-body #idCompraEli").prop("checked", false);
    }
    if (ajuste == 1) {
      modal.find(".modal-body #idAjusteEli").prop("checked", true);
    } else {
      modal.find(".modal-body #idAjusteEli").prop("checked", false);
    }
    if (traslado == 1) {
      modal.find(".modal-body #idTrasladoEli").prop("checked", true);
    } else {
      modal.find(".modal-body #idTrasladoEli").prop("checked", false);
    }

    if (tipo == 1) {
      $("#inlineRadioEli1").attr("checked", true);
    } else {
      $("#inlineRadioEli2").attr("checked", true);
    }
  });

  $("#myModalModificaTipoMovimiento").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var descri = button.data("descri");
    var tipo = button.data("tipo");
    var compra = button.data("compra");
    var ajuste = button.data("ajuste");
    var traslado = button.data("trasla");
    var modal = $(this);

    modal.find(".modal-title").text("Modifica Tipo de Movimiento : " + descri);
    modal.find(".modal-body #idTipoMovMod").val(id);
    modal.find(".modal-body #nombreMod").val(descri);
    modal.find(".modal-body #nombreMod").val(descri);
    if (compra == 1) {
      modal.find(".modal-body #idCompraMod").prop("checked", true);
    } else {
      modal.find(".modal-body #idCompraMod").prop("checked", false);
    }
    if (ajuste == 1) {
      modal.find(".modal-body #idAjusteMod").prop("checked", true);
    } else {
      modal.find(".modal-body #idAjusteMod").prop("checked", false);
    }
    if (traslado == 1) {
      modal.find(".modal-body #idTrasladoMod").prop("checked", true);
    } else {
      modal.find(".modal-body #idTrasladoMod").prop("checked", false);
    }

    if (tipo == 1) {
      $("#inlineRadioMod1").attr("checked", true);
    } else {
      $("#inlineRadioMod2").attr("checked", true);
    }
  });

  /* Modal Bodegas */
  $("#myModalEliminaBodega").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var tipo = button.data("tipo");
    var descri = button.data("descri");
    var modal = $(this);

    if (tipo == 1) {
      swal(
        "Precaucion",
        "Almacen Principal, No permitido Eliminarlo",
        "warning"
      );
      return false;
    }

    modal.find(".modal-title").text("Elimina Bodega : " + descri);
    modal.find(".modal-body #idBodegaEli").val(id);
    modal.find(".modal-body #nombreEli").val(descri);

    for (var i = 1; i <= 6; i++) {
      if (i == tipo) {
        campo = "#inlineRadioEli" + i;
        $(campo).prop("checked", true);
      }
    }
  });

  $("#myModalModificaBodega").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var tipo = button.data("tipo");
    var descri = button.data("descri");
    var modal = $(this);

    modal.find(".modal-title").text("Modifica Bodega : " + descri);
    modal.find(".modal-body #idBodegaMod").val(id);
    modal.find(".modal-body #nombreMod").val(descri);

    for (var i = 1; i <= 6; i++) {
      if (i == tipo) {
        campo = "#inlineRadioMod" + i;
        $(campo).prop("checked", true);
      }
    }
  });

  $("#myModalAdicionarBodega").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var bodegas = button.data("bodegas");

    if (bodegas > 1) {
      $("#inlineRadio1").prop("disabled", "disabled");
    }
  });

  /* Modal Unidades de Medida */
  $("#myModalModificaUnidad").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var unidad = button.data("unidad");
    var id = button.data("id");
    var modal = $(this);

    modal.find(".modal-title").text("Modifica Unidad de Medida : " + unidad);
    modal.find(".modal-body #idUnidadMod").val(id);
    modal.find(".modal-body #nombreMod").val(unidad);
  });

  $("#myModalEliminaUnidad").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var unidad = button.data("unidad");
    var id = button.data("id");
    var modal = $(this);

    modal.find(".modal-title").text("Modifica Unidad de Medida : " + unidad);
    modal.find(".modal-body #idUnidadEli").val(id);
    modal.find(".modal-body #nombreEli").val(unidad);
  });

  /* Modal Usuarios */
  $("#myModalActualizaUsuario").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var usuario = button.data("usuario");
    var apellidos = button.data("apellidos");
    var nombres = button.data("nombres");
    var identificacion = button.data("identificacion");
    var correo = button.data("correo");
    var estado = button.data("estado");
    var telefono = button.data("telefono");
    var celular = button.data("celular");
    var tipo = button.data("tipo");
    var pos = button.data("pos");
    var pms = button.data("pms");
    var inv = button.data("inv");
    var modal = $(this);

    modal.find(".modal-title").text("Modifica Usuario : " + usuario);
    modal.find(".modal-body #idUsuarioMod").val(id);
    modal.find(".modal-body #usuarioMod").val(usuario);
    modal.find(".modal-body #apellidosMod").val(apellidos);
    modal.find(".modal-body #nombresMod").val(nombres);
    modal.find(".modal-body #identificacionMod").val(identificacion);
    modal.find(".modal-body #correoMod").val(correo);
    modal.find(".modal-body #estadoUsuarioMod").val(estado);
    modal.find(".modal-body #telefonoMod").val(telefono);
    modal.find(".modal-body #celularMod").val(celular);
    modal.find(".modal-body #tipoMod").val(tipo);
    if (pos == 1) {
      modal.find(".modal-body #idPosUpd").prop("checked", true);
    }
    if (pms == 1) {
      modal.find(".modal-body #idPMSUpd").prop("checked", true);
    }
    if (inv == 1) {
      modal.find(".modal-body #idInvUpd").prop("checked", true);
    }
  });

  $("#myModalCambiarClave").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var usuario = button.data("usuario");
    var apellidos = button.data("apellidos");
    var nombres = button.data("nombres");
    var modal = $(this);

    modal
      .find(".modal-title")
      .text("Asignar Clave : " + apellidos + " " + nombres);
    modal.find(".modal-body #idUserPsw").val(id);
    modal.find(".modal-body #usuarioPsw").val(usuario);
  });

  $("#myModalBloquearUsuario").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var usuario = button.data("usuario");
    var apellidos = button.data("apellidos");
    var nombres = button.data("nombres");
    var estado = button.data("estado");
    var modal = $(this);

    modal
      .find(".modal-title")
      .text("Bloquear Usuario : " + apellidos + " " + nombres);
    modal.find(".modal-body #idUserBloq").val(id);
    modal.find(".modal-body #usuarioBloq").val(usuario);
    modal.find(".modal-body #apellidosBloq").val(apellidos);
    modal.find(".modal-body #nombresBloq").val(nombres);
    modal.find(".modal-body #estadoBloq").val(estado);
  });

  $("#myModalReabrirUsuario").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var usuario = button.data("usuario");
    var apellidos = button.data("apellidos");
    var nombres = button.data("nombres");
    var estado = button.data("estado");
    var modal = $(this);

    modal
      .find(".modal-title")
      .text("Reabrir Usuario : " + apellidos + " " + nombres);
    modal.find(".modal-body #idUserRea").val(id);
    modal.find(".modal-body #usuarioRea").val(usuario);
    modal.find(".modal-body #apellidosRea").val(apellidos);
    modal.find(".modal-body #nombresRea").val(nombres);
    modal.find(".modal-body #estadoRea").val(estado);
  });

  $("#myModalAsignaClave").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var usuario = button.data("usuario");
    var apellidos = button.data("apellidos");
    var nombres = button.data("nombres");
    var modal = $(this);

    modal
      .find(".modal-title")
      .text("Asignar Clave : " + apellidos + " " + nombres);
    modal.find(".modal-body #idUserPsw").val(id);
    modal.find(".modal-body #usuarioPsw").val(usuario);
    $("#clave1Asi").val("");
    $("#clave2Asi").val("");
  });

  /* Modal Impuestos */
  $("#myModalEliminaImpto").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var descri = button.data("descri");
    var porcen = button.data("porcen");
    var puc = button.data("puc");
    var contab = button.data("contab");
    var tipoEliImp = button.data("tipo");
    var modal = $(this);

    modal.find(".modal-title").text("Eliminar Forma de Pago : " + descri);
    modal.find(".modal-body #idImptoEliImp").val(id);
    modal.find(".modal-body #porcentajeEliImp").val(porcen);
    modal.find(".modal-body #nombreEliImp").val(descri);
    modal.find(".modal-body #pucEliImp").val(puc);
    modal.find(".modal-body #descripcionEliImp").val(contab);
    modal.find(".modal-body #tipoEliImp").val(tipoEliImp);
  });

  $("#myModalModificaImpto").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var descri = button.data("descri");
    var porcen = button.data("porcen");
    var puc = button.data("puc");
    var contab = button.data("contab");
    var tipoEliMod = button.data("tipo");
    var modal = $(this);

    modal.find(".modal-title").text("Modifica Impuesto : " + descri);
    modal.find(".modal-body #idImptoModImp").val(id);
    modal.find(".modal-body #nombreModImp").val(descri);
    modal.find(".modal-body #porcentajeModImp").val(porcen);
    modal.find(".modal-body #tipoModImp").val(tipoEliMod);
    modal.find(".modal-body #pucModImp").val(puc);
    modal.find(".modal-body #descripcionModImp").val(contab);
  });

  /* Modal Familias de Inventarios */
  $("#myModalModificaFamilia").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var familia = button.data("familia");
    var modal = $(this);

    modal
      .find(".modal-title")
      .text("Modifica Familia Inventarios : " + familia);
    modal.find(".modal-body #idFamiliaMod").val(id);
    modal.find(".modal-body #nombreMod").val(familia);
  });

  $("#myModalEliminaFamilia").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var familia = button.data("familia");
    var modal = $(this);

    modal.find(".modal-title").text("Elimina familia Inventarios : " + familia);
    modal.find(".modal-body #idFamiliaEli").val(id);
    modal.find(".modal-body #descripcionEli").val(familia);
  });

  /* Modal Grupos de Inventarios */
  $("#myModalEliminaGrupo").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var familia = button.data("familia");
    var grupo = button.data("grupo");
    var modal = $(this);

    modal.find(".modal-title").text("Elimina Grupo de Inventarios : " + grupo);
    modal.find(".modal-body #idGrupoEli").val(id);
    modal.find(".modal-body #familiaGrpEli").val(familia);
    modal.find(".modal-body #grupoEli").val(grupo);
  });

  $("#myModalModificaGrupo").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var familia = button.data("familia");
    var grupo = button.data("grupo");
    var modal = $(this);

    modal.find(".modal-title").text("Modifica Grupo de Inventarios : " + grupo);
    modal.find(".modal-body #idGrupoMod").val(id);
    modal.find(".modal-body #familiaGrpMod").val(familia);
    modal.find(".modal-body #grupoMod").val(grupo);
  });

  /* Modal Sub Grupos de Inventarios */
  $("#myModalEliminaSubgrupo").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var familia = button.data("idfami");
    var grupo = button.data("idgrup");
    var descri = button.data("descri");
    var modal = $(this);

    modal
      .find(".modal-title")
      .text("Elimina Sub Grupo de Inventarios : " + descri);
    modal.find(".modal-body #idSubGrupoEli").val(id);
    modal.find(".modal-body #familiaSubGrpEli").val(familia);
    modal.find(".modal-body #grupoSubGrupoEli").val(grupo);
    modal.find(".modal-body #descripSubGrupoEli").val(descri);
  });

  $("#myModalModificaSubGrupo").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var familia = button.data("idfami");
    var grupo = button.data("idgrup");
    var descri = button.data("descri");
    var modal = $(this);

    modal
      .find(".modal-title")
      .text("Modifica Sub Grupo de Inventarios : " + descri);
    modal.find(".modal-body #idSubGrupoMod").val(id);
    modal.find(".modal-body #familiaSubGrpMod").val(familia);
    modal.find(".modal-body #grupoSubGrupoMod").val(grupo);
    modal.find(".modal-body #descripSubGrupoMod").val(descri);
  });

  /* Modal Equipos [Accesos al Sistema] */
  $("#myModalModificaEquipo").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var equipo = button.data("direc");
    var descrip = button.data("descri");
    var modal = $(this);

    modal.find(".modal-title").text("Modifica Equipos : " + descrip);
    modal.find(".modal-body #idEquipoMod").val(id);
    modal.find(".modal-body #nombreMod").val(equipo);
    modal.find(".modal-body #descripcionMod").val(descrip);
  });

  $("#myModalEliminaEquipo").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var equipo = button.data("direc");
    var descrip = button.data("descri");
    var modal = $(this);

    modal.find(".modal-title").text("Elimina Equipos : " + descrip);
    modal.find(".modal-body #idEquipoEli").val(id);
    modal.find(".modal-body #nombreEli").val(equipo);
    modal.find(".modal-body #descripcionEli").val(descrip);
  });

  /* Tipos de Plato */
  $("#myModalEliminaTipoPlato").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var descri = button.data("seccion");
    var ambi = button.data("ambiente");
    var modal = $(this);

    modal.find(".modal-title").text("Elimina Tipo de Plato : " + descri);
    modal.find(".modal-body #idAgrupEli").val(id);
    modal.find(".modal-body #descripcionEli").val(descri);
    modal.find(".modal-body #nombreAmbiEli").val(ambi);
  });

  $("#myModalModificaTipoPlato").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var descri = button.data("seccion");
    var ambi = button.data("ambiente");
    var modal = $(this);

    modal.find(".modal-title").text("Modifica Tipo de Plato : " + descri);
    modal.find(".modal-body #idAgrpMod").val(id);
    modal.find(".modal-body #descripcionMod").val(descri);
    modal.find(".modal-body #nombreAmbiMod").val(ambi);
  });

  /* SubTarifas PMS*/
  $("#myModalPaquetesSubTarifas").on("show.bs.modal", function (event) {
    var pagina = $("#ubicacion").val();
    var ruta = $("#rutaweb").val();
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var idgrupo = button.data("idgrupo");
    var descri = button.data("descri");
    var modal = $(this);

    modal
      .find(".modal-title")
      .text("Paquetes Asociados a la Tarifas : " + descri);
    modal.find(".modal-body #idSubTariLis").val(id);
    modal.find(".modal-body #idTariGruEli").val(idgrupo);
    modal.find(".modal-body #descripcionSubTarifaEli").val(descri);

    $.ajax({
      url: ruta + "res/php/paquetesTarifa.php",
      type: "POST",
      data: {
        id,
      },
      success: function (data) {
        $("#paquetesTarifa").html(data);
      },
    });
  });

  $("#myModalEliminaValorSubtarifa").on("show.bs.modal", function (event) {
    var pagina = $("#ubicacion").val();
    var ruta = $("#rutaweb").val();
    var button = $(event.relatedTarget);
    var idsub = button.data("id");
    var modal = $(this);

    modal.find(".modal-body #idValSubTariEli").val(idsub);
    $("#idValSubTariEli").val(idsub);

    $.ajax({
      url: ruta + "res/php/valorTarifaHabi.php",
      type: "POST",
      data: { id: idsub },
      success: function (data) {
        $("#valorTarifaEli").html(data);
      },
    });
  });

  $("#myModalModificaValorSubTarifa").on("show.bs.modal", function (event) {
    var pagina = $("#ubicacion").val();
    var ruta = $("#rutaweb").val();
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var tipoha = button.data("tipoha");
    var valuno = button.data("valuno");
    var valdos = button.data("valdos");
    var valtre = button.data("valtre");
    var valcua = button.data("valcua");
    var valcin = button.data("valcin");
    var valsei = button.data("valsei");
    var valadi = button.data("valadi");
    var valnin = button.data("valnin");
    var desde = button.data("desde");
    var hasta = button.data("hasta");
    var modal = $(this);

    modal.find(".modal-body #idValSubTariMod").val(id);
    modal.find(".modal-body #valTipoHabitMod").val(tipoha);
    modal.find(".modal-body #desdeFechaMod").val(desde);
    modal.find(".modal-body #hastaFechaMod").val(hasta);
    modal.find(".modal-body #valorUnPaxMod").val(valuno);
    modal.find(".modal-body #valorDosPaxMod").val(valdos);
    modal.find(".modal-body #valorTresPaxMod").val(valtre);
    modal.find(".modal-body #valorCuatroPaxMod").val(valcua);
    modal.find(".modal-body #valorCincoPaxMod").val(valcin);
    modal.find(".modal-body #valorSeisPaxMod").val(valsei);
    modal.find(".modal-body #valorAdicionalMod").val(valadi);
    modal.find(".modal-body #valorNinoMod").val(valnin);
  });

  $("#myModalAdicionarValorSubTarifa").on("show.bs.modal", function (event) {
    var pagina = $("#ubicacion").val();
    var ruta = $("#rutaweb").val();
    var button = $(event.relatedTarget);
    var idsub = $("#idSubTariLis").val();
    var descrisub = $("#idDescrLis").val();
    var modal = $(this);

    modal
      .find(".modal-title")
      .text("Adicionar Tipo de Habitacion a Tarifa : " + descrisub);
    modal.find(".modal-body #idSubTariAdiMod").val(idsub);

    $("#desdeFechaAdi").val("");
    $("#hastaFechaAdi").val("");
    $("#valorUnPax").val(0);
    $("#valorDosPax").val(0);
    $("#valorTresPax").val(0);
    $("#valorCuatroPax").val(0);
    $("#valorCincoPax").val(0);
    $("#valorSeisPax").val(0);
    $("#valorAdicional").val(0);
    $("#valorNino").val(0);
  });

  $("#myModalAdicionarSubTarifa").on("show.bs.modal", function (event) {
    var pagina = $("#ubicacion").val();
    var ruta = $("#rutaweb").val();
    var id = $("#idTariLis").val();
    var descri = $("#idDescrLis").val();
    var modal = $(this);
    modal
      .find(".modal-title")
      .text("Adicionar Tarifa Habitacion SuGrupo : " + descri);
    modal.find(".modal-body #idTariAdiMod").val(id);
    modal.find(".modal-body #descripcionTarifaAdi").val("");
    /// $('#btnTarifasAsociadas').css('display','none')
  });

  $("#myModalValoresSubTarifas").on("show.bs.modal", function (event) {
    var pagina = $("#ubicacion").val();
    var ruta = $("#rutaweb").val();
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var idgrupo = button.data("idgrupo");
    var descri = button.data("descri");
    var modal = $(this);

    modal.find(".modal-title").text("Valor Subgrupo de Tarifa : " + descri);
    modal.find(".modal-body #idSubTariLis").val(id);
    modal.find(".modal-body #idTariGruEli").val(idgrupo);
    modal.find(".modal-body #descripcionSubTarifaEli").val(descri);

    $.ajax({
      url: ruta + "res/php/valoresSubTarifa.php",
      type: "POST",
      data: {
        id: id,
      },
      success: function (data) {
        $("#valoresTarifa").html(data);
      },
    });
  });

  $("#myModalEliminaSubtarifa").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var idgrupo = button.data("idgrupo");
    var descri = button.data("descri");
    var modal = $(this);

    modal.find(".modal-title").text("Eliminar Subgrupo de Tarifa : " + descri);

    modal.find(".modal-body #idSubTariEli").val(id);
    modal.find(".modal-body #idTariGruEli").val(idgrupo);
    modal.find(".modal-body #descripcionSubTarifaEli").val(descri);
  });

  $("#myModalModificaSubtarifa").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var idgrupo = button.data("idgrupo");
    var descri = button.data("descri");
    var modal = $(this);

    modal.find(".modal-title").text("Modifica Subgrupo de Tarifa : " + descri);

    modal.find(".modal-body #idSubTariMod").val(id);
    modal.find(".modal-body #idTariGruMod").val(idgrupo);
    modal.find(".modal-body #descripcionSubTarifaMod").val(descri);
  });

  $("#myModalAdicionarSubTarifa").on("show.bs.modal", function (event) {
    var pagina = $("#ubicacion").val();
    var ruta = $("#rutaweb").val();
    var id = $("#idTariLis").val();
    var descri = $("#idDescrLis").val();
    var modal = $(this);
    modal.find(".modal-title").text("Adicionar Tarifa Grupo : " + descri);
    modal.find(".modal-body #idTariAdiMod").val(id);
    modal.find(".modal-body #descripcionTarifaAdi").val("");
  });

  $("#myModalTarifasAsociadas").on("show.bs.modal", function (event) {
    var pagina = $("#ubicacion").val();
    var ruta = $("#rutaweb").val();
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var descri = button.data("descri");
    var modal = $(this);

    modal
      .find(".modal-title")
      .html("<h3> <span>Tarifa : </span>" + descri + "</h3>");
    modal.find(".modal-body #idTariLis").val(id);
    modal.find(".modal-body #idDescrLis").val(descri);

    $.ajax({
      type: "POST",
      url: ruta + "res/php/listaTarifasGrupo.php",
      data: { id: id },
      success: function (data) {
        $("#datosTarifa").html(data);
        $("#tablaSubTarifas_length").prop("display", "none");
        // $("#mensajeEli").html('<div style="padding:5px" class="alert alert-danger"><h4 align="center">Grupo de Tarifa Eliminada con Exito</h4></div>');
      },
    });
  });

  /* Grupos de Tarifas */
  $("#myModalEliminaGrupoTarifa").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var descri = button.data("descri");
    var modal = $(this);

    modal.find(".modal-title").text("Elimina Grupo de Tarifa : " + descri);

    modal.find(".modal-body #idTariEli").val(id);
    modal.find(".modal-body #descripcionEli").val(descri);
  });

  $("#myModalModificaGrupoTarifa").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var descri = button.data("descri");
    var modal = $(this);

    modal.find(".modal-title").text("Modifica Grupo de Tarifa : " + descri);

    modal.find(".modal-body #idTariMod").val(id);
    modal.find(".modal-body #descripcionMod").val(descri);
  });

  /* Paquetes de Tarifas */
  $("#myModalEliminaPaquete").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var codigo = button.data("codigo");
    var descri = button.data("descri");
    var codvta = button.data("codvta");
    var tipoca = button.data("tipoca");
    var frecue = button.data("frecue");
    var valor = button.data("valor");
    var separa = button.data("separa");
    var modal = $(this);

    modal.find(".modal-title").text("Elimina Paquete : " + descri);

    modal.find(".modal-body #idPaquEli").val(id);
    modal.find(".modal-body #descripcionEli").val(descri);
    modal.find(".modal-body #codigoPaqEli").val(codvta);
    modal.find(".modal-body #tipoCargoEli").val(tipoca);
    modal.find(".modal-body #frecuenciaEli").val(frecue);
    modal.find(".modal-body #valorEli").val(valor);
    if (tipoca == 1) {
      $("#inlineRadio1Eli").attr("checked", true);
    } else {
      $("#inlineRadio2Eli").attr("checked", true);
    }
    if (frecue == 1) {
      $("#inlineFrecu1Eli").attr("checked", true);
    } else {
      $("#inlineFrecu2Eli").attr("checked", true);
    }
  });

  $("#myModalModificaPaquete").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var codigo = button.data("codigo");
    var descri = button.data("descri");
    var codvta = button.data("codvta");
    var tipoca = button.data("tipoca");
    var frecue = button.data("frecue");
    var valor = button.data("valor");
    var separa = button.data("separa");
    var modal = $(this);

    modal.find(".modal-title").text("Modifica Paquete : " + descri);

    modal.find(".modal-body #idPaquMod").val(id);
    modal.find(".modal-body #descripcionMod").val(descri);
    modal.find(".modal-body #codigoPaqMod").val(codvta);
    modal.find(".modal-body #tipoCargoMod").val(tipoca);
    modal.find(".modal-body #frecuenciaMod").val(frecue);
    modal.find(".modal-body #valorMod").val(valor);
    if (tipoca == 1) {
      $("#inlineRadio1Eli").attr("checked", true);
    } else {
      $("#inlineRadio2Eli").attr("checked", true);
    }
    if (frecue == 1) {
      $("#inlineFrecu1Eli").attr("checked", true);
    } else {
      $("#inlineFrecu2Eli").attr("checked", true);
    }
  });

  /* Tarifas Habitaciones */
  $("#myModalModificaHabitacion").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var numero = button.data("numero");
    var tipo = button.data("tipo");
    var sector = button.data("sector");
    var pax = button.data("pax");
    var camas = button.data("camas");
    var modal = $(this);

    modal.find(".modal-title").text("Modifica Habitacion : " + numero);

    modal.find(".modal-body #idHabiMod").val(id);
    modal.find(".modal-body #CodigoMod").val(numero);
    modal.find(".modal-body #tipoHabiMod").val(tipo);
    modal.find(".modal-body #sectorHabiMod").val(sector);
    modal.find(".modal-body #camasMod").val(camas);
    modal.find(".modal-body #huespedesMod").val(pax);
  });

  $("#myModalEliminaHabitacion").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var numero = button.data("numero");
    var tipo = button.data("tipo");
    var sector = button.data("sector");
    var pax = button.data("pax");
    var camas = button.data("camas");
    var modal = $(this);

    modal.find(".modal-title").text("Elimina Habitacion : " + numero);

    modal.find(".modal-body #idHabiEli").val(id);
    modal.find(".modal-body #CodigoEli").val(numero);
    modal.find(".modal-body #tipoHabiEli").val(tipo);
    modal.find(".modal-body #sectorHabiEli").val(sector);
    modal.find(".modal-body #camasEli").val(camas);
    modal.find(".modal-body #huespedesEli").val(pax);
  });

  /* Tipos de Habitaciones */
  $("#myModalModificaTipoHabitacion").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var descr = button.data("descri");
    var codigo = button.data("codigo");
    // var tipoh = button.data("tipo");
    var codvta = button.data("venta");
    var modal = $(this);

    modal.find(".modal-title").text("Modifica Tipo Habitacion : " + descr);
    modal.find(".modal-body #idTipoHabiMod").val(id);
    modal.find(".modal-body #CodigoMod").val(codigo);
    modal.find(".modal-body #nombreMod").val(descr);
    modal.find(".modal-body #TipoHabiMod").val(id);
    modal.find(".modal-body #CodTipoHabiMod").val(codvta);
  });

  $("#myModalEliminaTipoHabitacion").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var descr = button.data("descri");
    var codigo = button.data("codigo");
    var tipoh = button.data("tipo");
    var codvta = button.data("venta");
    var modal = $(this);

    modal.find(".modal-title").text("Elimina Tipo Habitacion : " + descr);

    modal.find(".modal-body #idTipoHabiEli").val(id);
    modal.find(".modal-body #CodigoEli").val(codigo);
    modal.find(".modal-body #nombreEli").val(descr);
    modal.find(".modal-body #TipoHabiEli").val(tipoh);
    modal.find(".modal-body #CodTipoHabiEli").val(codvta);
  });

  /* *Sectores Habitaciones */
  $("#myModalModificaSectorHabitacion").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var descri = button.data("descr");
    var modal = $(this);

    modal.find(".modal-title").text("Modifica Sector : " + descri);
    modal.find(".modal-body #idSectorMod").val(id);
    modal.find(".modal-body #nombreMod").val(descri);
  });

  $("#myModalEliminaSectorHabitacion").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var descri = button.data("descr");
    var modal = $(this);

    modal.find(".modal-title").text("Elimina Sector : " + descri);
    modal.find(".modal-body #idSectorEli").val(id);
    modal.find(".modal-body #nombreEli").val(descri);
  });

  /* Agrupaciones */
  $("#myModalEliminaAgrupacion").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var descri = button.data("desc");
    var modal = $(this);

    modal.find(".modal-title").text("Elimina Agrupacion : " + descri);
    modal.find(".modal-body #idAgrupEli").val(id);
    modal.find(".modal-body #descripcionEli").val(descri);
  });

  $("#myModalModificaAgrupacion").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var descri = button.data("desc");
    var modal = $(this);

    modal.find(".modal-title").text("Modifica Agrupacion : " + descri);
    modal.find(".modal-body #idAgrpMod").val(id);
    modal.find(".modal-body #descripcionMod").val(descri);
  });

  $("#myModalModificaConversion").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var descri = button.data("desc");
    var unid = button.data("unid");
    var conv = button.data("conv");
    var valo = button.data("valo");
    var modal = $(this);

    modal.find(".modal-title").text("Modifica Conversion : " + descri);
    modal.find(".modal-body #idConvMod").val(id);
    modal.find(".modal-body #unidadUnidMod").val(unid);
    modal.find(".modal-body #unidadConvMod").val(conv);
    modal.find(".modal-body #valorConvMod").val(valo);
  });

  $("#myModalEliminaConversion").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var descri = button.data("desc");
    var unid = button.data("unid");
    var conv = button.data("conv");
    var valo = button.data("valo");
    var modal = $(this);

    modal.find(".modal-title").text("Elimina Conversion : " + descri);
    modal.find(".modal-body #idConvEli").val(id);
    modal.find(".modal-body #unidadUnid").val(unid);
    modal.find(".modal-body #unidadConv").val(conv);
    modal.find(".modal-body #valorConv").val(valo);
  });

  $("#myModalEliminaCentro").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var descri = button.data("descri");
    var depto = button.data("depto");
    var costo = button.data("costo");
    var gasto = button.data("gasto");

    var modal = $(this);
    modal.find(".modal-title").text("Modifica Departamento : " + descri);
    modal.find(".modal-body #idCentroEli").val(id);
    modal.find(".modal-body #nombreEli").val(descri);
    modal.find(".modal-body #deptoEli").val(depto);
    modal.find(".modal-body #costoEli").val(costo);
    modal.find(".modal-body #gastoEli").val(gasto);
  });

  $("#myModalModificaCentro").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var descri = button.data("descri");
    var depto = button.data("depto");
    var costo = button.data("costo");
    var gasto = button.data("gasto");

    var modal = $(this);
    modal.find(".modal-title").text("Modifica Departamento : " + descri);
    modal.find(".modal-body #idCentroMod").val(id);
    modal.find(".modal-body #nombreMod").val(descri);
    modal.find(".modal-body #deptoMod").val(depto);
    modal.find(".modal-body #costoMod").val(costo);
    modal.find(".modal-body #gastoMod").val(gasto);
  });

  $("#myModalModificaDepto").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var descri = button.data("descri");

    var modal = $(this);
    modal.find(".modal-title").text("Modifica Departamento : " + descri);
    modal.find(".modal-body #idDeptoMod").val(id);
    modal.find(".modal-body #nombreMod").val(descri);
  });

  $("#myModalEliminaDepto").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var descri = button.data("descri");

    var modal = $(this);
    modal.find(".modal-title").text("Modifica Departamento : " + descri);
    modal.find(".modal-body #idDeptoEli").val(id);
    modal.find(".modal-body #nombreEli").val(descri);
  });

  $("#myModalEliminaCodigoVentas").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var descri = button.data("descri");
    var impto = button.data("impto");
    var grupo = button.data("grupo");
    var puc = button.data("puc");
    var contab = button.data("contab");
    var modal = $(this);

    modal.find(".modal-title").text("Eliminar Codigo : " + descri);
    modal.find(".modal-body #idCodigoEli").val(id);
    modal.find(".modal-body #nombreEli").val(descri);
    modal.find(".modal-body #imptosEli").val(impto);
    modal.find(".modal-body #grupoEli").val(grupo);
    modal.find(".modal-body #pucEli").val(puc);
    modal.find(".modal-body #descripcionEli").val(contab);
  });

  $("#myModalModificaCodigoVentas").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var impto = button.data("impto");
    var descri = button.data("descri");
    var grupo = button.data("grupo");
    var puc = button.data("puc");
    var contab = button.data("contab");
    var modal = $(this);

    modal.find(".modal-title").text("Modifica Codigo : " + descri);
    modal.find(".modal-body #idCodigoMod").val(id);
    modal.find(".modal-body #nombreMod").val(descri);
    modal.find(".modal-body #imptosMod").val(impto);
    modal.find(".modal-body #grupoMod").val(grupo);
    modal.find(".modal-body #pucMod").val(puc);
    modal.find(".modal-body #descripcionMod").val(contab);
  });

  $("#myModalModificaFormaPago").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var descri = button.data("descri");
    var puc = button.data("puc");
    var contab = button.data("contab");
    var modal = $(this);

    modal.find(".modal-title").text("Modifica Impuesto : " + descri);
    modal.find(".modal-body #idFormaPagoMod").val(id);
    modal.find(".modal-body #nombreMod").val(descri);
    modal.find(".modal-body #pucMod").val(puc);
    modal.find(".modal-body #descripcionMod").val(contab);
  });

  $("#myModalEliminaFormaPago").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var id = button.data("id");
    var descri = button.data("descri");
    var puc = button.data("puc");
    var contab = button.data("contab");
    var modal = $(this);

    modal.find(".modal-title").text("Elimina Impuesto : " + descri);
    modal.find(".modal-body #idFormaPagoEli").val(id);
    modal.find(".modal-body #nombreEli").val(descri);
    modal.find(".modal-body #pucEli").val(puc);
    modal.find(".modal-body #descripcionEli").val(contab);
  });

  $(function () {
    $(".image_file").change(function () {
      var file = this.files[0];
      var imagefile = file.type;
      var match = ["image/jpeg", "image/png", "image/jpg"];
      if (
        !(
          imagefile == match[0] ||
          imagefile == match[1] ||
          imagefile == match[2]
        )
      ) {
        $("#preview").attr("src", "noimage.png");
        $("#message").html(
          "<p id='error'>Selecciona un archivo de imagen válido</p>" +
            "<h4>Nota</h4>" +
            "<span id='error_message'>Solo jpeg, jpg y png Tipo de imágenes permitidas</span>"
        );
        return false;
      } else {
        var reader = new FileReader();
        reader.onload = imageIsLoaded;
        reader.readAsDataURL(this.files[0]);
      }
    });
  });

  function imageIsLoaded(e) {
    $("#file").css("color", "green");
    $("#image_preview").css("display", "block");
    $("#previewing").attr("src", e.target.result);
    $("#previewing").attr("width", "250px");
    $("#previewing").attr("height", "230px");
  }

  $("#file").on("change", function () {
    /* Limpiar vista previa */
    $("#vista-previa").html("");
    var archivos = document.getElementById("file").files;
    var navegador = window.URL || window.webkitURL;
    /* Recorrer los archivos */
    for (x = 0; x < archivos.length; x++) {
      /* Validar tamaño y tipo de archivo */
      var size = archivos[x].size;
      var type = archivos[x].type;
      var name = archivos[x].name;
      if (size > 1024 * 1024) {
        $("#vista-previa").append(
          "<p style='color: red'>El archivo " +
            name +
            " supera el máximo permitido 1MB</p>"
        );
      } else if (
        type != "image/jpeg" &&
        type != "image/jpg" &&
        type != "image/png" &&
        type != "image/gif"
      ) {
        $("#vista-previa").append(
          "<p style='color: red'>El archivo " +
            name +
            " no es del tipo de imagen permitida.</p>"
        );
      } else {
        var objeto_url = navegador.createObjectURL(archivos[x]);
        $("#vista-previa").append(
          "<img src=" + objeto_url + " width='250' height='230'>"
        );
      }
    }
  });

  $("#btn-acept-logo").on("click", function () {
    var formData = new FormData($("#formulario_logo")[0]);
    $.ajax({
      url: "../codes/save_imagen.php",
      type: "POST",
      data: formData,
      beforeSend: function (objeto) {
        $("#mensaje").html("<img src='../../img/loader.gif'>");
      },
    });
  });

  $(".btnSaveImage").on("click", function (e) {
    e.preventDefault();

    var formData = new FormData($("#formulario_logo")[0]);

    $.ajax({
      type: "POST",
      url: "../codes/save_image.php",
      data: formData,
      processData: false,
      contentType: false,
      beforeSend: function () {
        $("#mensaje").html("<img src='../../img/loader.gif'>");
      },
      success: function (data) {
        $("#mensaje").html(
          "<div class='alert alert-success'><h3 align='center'>Imagen Actualizada con Exito</h3></div>"
        );
        /// $("#inicio").html(data).fadeIn('slow');
      },
      error: function () {
        $("#mensaje").html(
          "<div class='alert alert-danger'><h3 align='center'>A Ocurrido un Error al Actualizar la Imagen</h3></div>"
        );
      },
    });
  });

  $(".btnSaveDataEmpresa").on("click", function (e) {
    e.preventDefault();
    var empresa = $("#empresa").val();
    var nit = $("#nit").val();
    var dv = $("#dv").val();
    var tipocia = $("#tipocia").val();
    var ciiu = $("#ciiu").val();
    var direccion = $("#direccion").val();
    var ciudad = $("#ciudad").val();
    var pais = $("#pais").val();
    var celular = $("#celular").val();
    var telefono = $("#telefono").val();
    var web = $("#web").val();
    var correo = $("#correo").val();
    var parametros = {
      empresa: empresa,
      nit: nit,
      dv: dv,
      tipocia: tipocia,
      ciiu: ciiu,
      direccion: direccion,
      ciudad: ciudad,
      celular: celular,
      telefono: telefono,
      web: web,
      correo: correo,
      pais: pais,
    };
    // var parametros = $(this).serialize();

    $.ajax({
      type: "POST",
      url: "../codes/save_data_empresa.php",
      data: parametros,
      beforeSend: function () {
        $("#mensaje").html("<img src='../../img/loader.gif' align='center>");
      },
      success: function (data) {
        $("#mensaje").html(
          "<div class='alert alert-success'><h3 align='center'>Datos de la Empresa Actualizada con Exito</h3></div>"
        );
      },
      error: function () {
        $("#mensaje").html(
          "<div class='alert alert-danger'><h3 align='center'>A Ocurrido un Error al Actualizar la Empresa</h3></div>"
        );
      },
    });
  });

  $(".CheckCodePOS").on("click", function (e) {
    checkPos = $("#CheckPos").checked();
    if (checkPos) {
      alert("Dio Click en checkpos");
    }
  });
});

/* */

/* Functiones Generales */
