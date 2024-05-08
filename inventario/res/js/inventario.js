/* sesion = JSON.parse(localStorage.getItem("sesion"));
let { usuarioAct } = sesion;
let { usuario, usuario_id, apellidos, nombres } = usuarioAct;
 */

document.addEventListener("DOMContentLoaded", async () => {    

  let sesion = JSON.parse(localStorage.getItem("sesion"));
 
  if(sesion == null){
    alert('Usuario NO identificado en el Sistema');    
    window.location.href = "/";
    return 
  }

  let { user } = sesion;
  let { usuario, usuario_id } = user;
  $("#modalConsultaKardex").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget); // Botón que activó el modal
    var id = button.data("id"); // Extraer la información de atributos de datos
    var nombre = button.data("nombre"); // Extraer la información de atributos de datos
    var modal = $(this);
    $(".modal-title").html("<h4>Modificar Proveedor : " + nombre + "</h4>");
  });
});

async function abreXML(){
  fileXML = document.querySelector('#archivoxml');
  let file = fileXML.files[0]
  reader = new FileReader();
  console.log(reader);
  waitForTextReadComplete(reader);
  reader.readAsText(file); 
}

function parseTextAsXml(text) {
  let parser = new DOMParser(),
  xmlDom = parser.parseFromString(text, "text/xml");
    console.log(reader)

    //ahora, extraer los elementos del xmlDom y asignarlos a los imputs
}

function waitForTextReadComplete(reader) {
  reader.onloadend = function(event) {
    var text = event.target.result;
    console.log(reader)
    parseTextAsXml(text);
  }
}

function muestraKardex(bodega) {
  $.ajax({
    url: "res/php/getKardex.php",
    type: "POST",
    data: { bodega },
    success: function (data) {
      $("#datosMovimientos").html(data);
      $("#example1").DataTable({
        paging: true,
        iDisplayLength: 25,
      });
    },
  });
}

function imprimeMovimiento(id, tipo) {
  switch (tipo) {
    case 1:
      doc = "imprimir/Entrada_" + id + ".pdf";
      break;
    case 2:
      doc = "imprimir/Salida_" + id + ".pdf";
      break;
    case 3:
      doc = "imprimir/Traslado_" + id + ".pdf";
      break;
    case 4:
      doc = "imprimir/Ajuste_" + id + ".pdf";
      break;
    case 5:
      doc = "imprimir/Requisicion_" + id + ".pdf";
      break;
    case 6:
      doc = "imprimir/Pedido_" + id + ".pdf";
      break;
  }
  var ventana = window.open(doc, "PRINT", "height=600,width=600");
}

function anulaMovimiento(id, movimiento, bodega) {
  var ubica = $("#ubicacion").val();
  var id = id;
  var tipo = movimiento;
  parametros = {
    id,
    tipo,
    bodega,
    usuario,
  };
  if (tipo == 1) {
    movimiento = "Entrada";
  }
  if (tipo == 2) {
    movimiento = "Salida";
  }
  if (tipo == 3) {
    movimiento = "Traslado";
  }
  if (tipo == 4) {
    movimiento = "Ajuste";
  }
  swal(
    {
      title: "Anular " + movimiento + "!",
      text: "Anular Presente Movimiento de " + movimiento + " ?",
      type: "warning",
      showCancelButton: true,
      cancelButtonClass: "btn-warning",
      cancelButtonText: "Cancelar",
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Si, Anular " + movimiento + " !",
      closeOnConfirm: false,
    },
    function () {
      $.ajax({
        type: "POST",
        url: "res/php/anulaMovimiento.php",
        data: parametros,
        success: function (data) {
          swal("Atencion", "Documento Anulado con Exito", "success", 5000);
          $(location).attr("href", ubica);
        },
      });
    }
  );
}

function actualizaProveedor() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var productos = $("#dataActualizaProveedor").serialize();
  var parametros = productos;
  $.ajax({
    url: ruta + "res/php/actualizaProveedor.php",
    type: "POST",
    data: parametros,
    beforeSend: function (objeto) {
      $("#datos_ajax").html(
        '<div align="center" style="padding:5px" class="alert alert-info"><h4>Actualizando Producto</h4></div>'
      );
    },
    success: function (dato) {
      $("#datos_ajax").html(dato);
      $(location).attr("href", ruta + pagina);
    },
  });
}

function guardaProveedor() {
  /* sesion = JSON.parse(localStorage.getItem("sesion"));
  usuario = sesion["usuario"][0]["usuario"]; */
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var proveedor =
    $("#dataRegistrarProveedor").serialize() + "&usuario=" + usuario;
  var parametros = proveedor;
  $.ajax({
    type: "POST",
    url: ruta + "res/php/guardaProveedor.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#datos_ajax").html("<h4>Ingresando Proveedor...</h4>");
    },
    success: function (datos) {
      $("#datos_ajax").html(datos);
      $(location).attr("href", ruta + pagina);
    },
  });
}

function guardaProducto() {
  /* sesion = JSON.parse(localStorage.getItem("sesion"));
  usuario = sesion["usuario"][0]["usuario"]; */
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var productos =
    $("#dataRegistrarProducto").serialize() + "&usuario=" + usuario;

  var parametros = productos;
  $.ajax({
    url: ruta + "res/php/guardaProducto.php",
    type: "POST",
    data: parametros,
    beforeSend: function (objeto) {
      $("#datos_ajax").html(
        '<div align="center" style="padding:5px" class="alert alert-info"><h4>Ingresando Producto</h4></div>'
      );
    },
    success: function (dato) {
      $("#datos_ajax").html(dato);
      $(location).attr("href", ruta + pagina);
    },
  });
}

function botonModificaProveedor(id, nombre) {
  $("#myModalModificaProveedor").modal("show");
  $("#idTituloProveedor").text("Modificar Proveedor : " + nombre);
  $.ajax({
    url: "res/php/getUpdateProveedor.php",
    type: "POST",
    data: { idprod: id },
    success: function (data) {
      $("#updProveedor").html(data);
    },
  });
}

function eliminaProducto() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  id = $("#idproducto").val();
  $.ajax({
    url: "res/php/eliminaProducto.php",
    type: "POST",
    data: { id: id },
    success: function () {
      $(location).attr("href", ruta + pagina);
    },
  });
}

function actualizaProducto() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  var productos = $("#dataActualizaProducto").serialize();
  var parametros = productos;
  $.ajax({
    url: ruta + "res/php/actualizaProducto.php",
    type: "POST",
    data: parametros,
    beforeSend: function (objeto) {
      $("#datos_ajax").html(
        '<div align="center" style="padding:5px" class="alert alert-info"><h4>Actualizando Producto</h4></div>'
      );
    },
    success: function (dato) {
      $("#datos_ajax").html(dato);
      $(location).attr("href", ruta + pagina);
    },
  });
}

function btnEliminaProducto() {
  $("#myModalEliminaProducto").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget); // Botón que activó el modal
    var id = button.data("id"); // Extraer la información de atributos de datos
    var nombre = button.data("nombre"); // Extraer la información de atributos de datos
    var modal = $(this);
    modal.find(".modal-title").text("Elimina Producto : " + nombre);
    $("#idproducto").val(id);
  });
}

function cambiasubGrupo() {
  idgru = $("#gruposUpd").val();
  $.ajax({
    url: "res/php/getSubGrupos.php",
    type: "POST",
    data: { codigo: idgru },
    success: function (data) {
      $("#subgrupoUpd option").remove();
      $("#subgrupoUpd").append(data);
    },
  });
}

function cambiaGrupo() {
  idfam = $("#familiaUpd").val();
  $.ajax({
    url: "res/php/getGrupos.php",
    type: "POST",
    data: { codigo: idfam },
    success: function (data) {
      $("#gruposUpd option").remove();
      $("#gruposUpd").append(data);
    },
  });
}

function btnModificaProducto() {
  $("#myModalModificaProducto").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget); // Botón que activó el modal
    var id = button.data("id"); // Extraer la información de atributos de datos
    var nombre = button.data("nombre"); // Extraer la información de atributos de datos
    var modal = $(this);
    modal.find(".modal-title").text("Modificar Producto : " + nombre);
    $.ajax({
      url: "res/php/getUpdateProducto.php",
      type: "POST",
      data: { idprod: id },
      success: function (data) {
        $("#updProducto").html(data);
      },
    });
  });
}

function getKardex(bodega) {
  var parametros = { action: "ajax", bodega: bodega };
  $("#loader").fadeIn("slow");
  $.ajax({
    url: "../code/code_consulta_kardex.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#loader").html("<img src='../../img/loader.gif'>");
    },
    success: function (data) {
      $(".outer_div").html(data).fadeIn("slow");
      $("#loader").html("");
    },
  });
}

/* PRODUCTOS */
function loadproducto(page) {
  var parametros = { action: "ajax", page: page };
  $("#loader").fadeIn("slow");
  $.ajax({
    url: "../code/code_producto.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#loader2").html("<img src='../../img/loader.gif'>");
    },
    success: function (data) {
      $(".outer_div2").html(data).fadeIn("slow");
      $("#loader2").html("");
    },
  });
}

$("#dataDeleteProducto").on("show.bs.modal", function (event) {
  var button = $(event.relatedTarget); // Botón que activó el modal
  var id = button.data("id"); // Extraer la información de atributos de datos
  var cod = button.data("codigo"); // Extraer la información de atributos de datos
  var modal = $(this);
  modal.find("#id_prod").val(id);
  modal.find("#cod_prod").val(cod);
});

$("#eliminarDatosProducto").submit(function (event) {
  var parametros = $(this).serialize();
  $.ajax({
    type: "POST",
    url: "../code/code_eliminar_producto.php",
    data: parametros,
    beforeSend: function (objeto) {
      $(".datos_ajax_delete").html("Mensaje: Cargando ...");
    },
    success: function (datos) {
      $(".datos_ajax_delete").html(datos);

      $("#dataDeleteProducto").modal("hide");
      loadproducto(1);
    },
  });
  event.preventDefault();
});

$("#dataUpdateProducto").on("show.bs.modal", function (event) {
  var button = $(event.relatedTarget); // Botón que activó el modal
  var id = button.data("id"); // Extraer la información de atributos de datos
  var codigo = button.data("codigo"); // Extraer la información de atributos de datos
  var producto = button.data("producto"); // Extraer la información de atributos de datos
  var familia = button.data("familia");
  var grupo = button.data("grupo");
  var subgrupo = button.data("subgrupo");
  var compra = button.data("compra");
  var almacena = button.data("almacena");
  var procesa = button.data("procesa");
  var costo = button.data("costo");
  var promedio = button.data("promedio");
  var minimo = button.data("minimo");
  var maximo = button.data("maximo");
  var porciona = button.data("porciona");
  var equivale = button.data("equivale");
  var cantidad = button.data("cantidad");
  var ubicacion = button.data("ubicacion");

  var modal = $(this);
  modal
    .find(".modal-title")
    .text("Modificar Producto de Inventarios: " + producto);
  modal.find(".modal-body #id").val(id);
  modal.find(".modal-body #codigo").val(codigo);
  modal.find(".modal-body #producto").val(producto);
  modal.find(".modal-body #familia").val(familia);
  modal.find(".modal-body #grupo_inven").val(grupo);
  modal.find(".modal-body #subgrupo").val(subgrupo);
  modal.find(".modal-body #compra").val(compra);
  modal.find(".modal-body #almacena").val(almacena);
  modal.find(".modal-body #procesa").val(procesa);
  modal.find(".modal-body #costo").val(costo);
  modal.find(".modal-body #promedio").val(promedio);
  modal.find(".modal-body #minimo").val(minimo);
  modal.find(".modal-body #maximo").val(maximo);
  modal.find(".modal-body #porciona").val(porciona);
  modal.find(".modal-body #equivale").val(equivale);
  modal.find(".modal-body #cantidad").val(cantidad);
  modal.find(".modal-body #ubicacion").val(ubicacion);
  $(".alert").hide(); //Oculto alert
});

function getDv(codigo) {
  if (window.XMLHttpRequest) {
    xmlhttp3 = new XMLHttpRequest();
  } else {
    xmlhttp3 = new ActiveXObject("Microsoft.XMLHTTP");
  }

  xmlhttp3.onreadystatechange = function () {
    if (xmlhttp3.readyState == 4 && xmlhttp3.status == 200) {
      document.getElementById("dv").innerHTML = xmlhttp3.responseText;
    }
  };
  xmlhttp3.open("GET", "../code/code_calcula_digito.php?codigo" + codigo, true);
  xmlhttp3.send();
}

/* PROVEEDORES    */
function loadproveedor(page) {
  var parametros = { action: "ajax", page: page };
  $("#loader").fadeIn("slow");
  $.ajax({
    url: "../code/code_proveedores.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#loader2").html("<img src='../../img/loader.gif'>");
    },
    success: function (data) {
      $(".outer_div2").html(data).fadeIn("slow");
      $("#loader2").html("");
    },
  });
}

$("#dataDeleteProveedor").on("show.bs.modal", function (event) {
  var button = $(event.relatedTarget); // Botón que activó el modal
  var id = button.data("id"); // Extraer la información de atributos de datos
  var cod = button.data("codigo"); // Extraer la información de atributos de datos
  var emp = button.data("empresa"); // Extraer la información de atributos de datos
  var modal = $(this);
  modal.find("#id_prov").val(id);
  modal.find("#cod_prov").val(cod);
  modal.find("#empresa").val(emp);
  modal.find(".modal-title").text("Proveedor: " + emp);
});

$("#eliminarDatosProveedor").submit(function (event) {
  var parametros = $(this).serialize();
  $.ajax({
    type: "POST",
    url: "../code/code_eliminar_proveedor.php",
    data: parametros,
    beforeSend: function (objeto) {
      $(".datos_ajax_delete").html(" Elimiando Proveedor ...");
    },
    success: function (datos) {
      $(".datos_ajax_delete").html(datos);

      $("#dataDeleteProveedor").modal("hide");
      loadproveedor(1);
    },
  });
  event.preventDefault();
});

$("#dataUpdateProveedor").on("show.bs.modal", function (event) {
  var button = $(event.relatedTarget); // Botón que activó el modal
  var id = button.data("id"); // Extraer la información de atributos de datos
  var empresa = button.data("empresa"); // Extraer la información de atributos de datos
  var nombre = button.data("nombre");
  var nombre2 = button.data("nombre2");
  var apellido = button.data("apellido");
  var apellido2 = button.data("apellido2");
  var direccion = button.data("direccion");
  var nit = button.data("nit");
  var digito = button.data("digito");
  var tipo_doc = button.data("tipo_doc");
  var telefono = button.data("telefono");
  var telefono2 = button.data("telefono2");
  var celular = button.data("celular");
  var fax = button.data("fax");
  var correo = button.data("correo");
  var pais = button.data("pais");
  var ciudad = button.data("ciudad");
  var tipo_emp = button.data("tipo_emp");
  var ciiu = button.data("ciiu");
  var web = button.data("web");

  var modal = $(this);
  modal.find(".modal-title").text("Modificar Proveedor: " + empresa);
  modal.find(".modal-body #id").val(id);
  modal.find(".modal-body #empresa").val(empresa);
  modal.find(".modal-body #nombre").val(nombre);
  modal.find(".modal-body #nombre2").val(nombre2);
  modal.find(".modal-body #apellido").val(apellido);
  modal.find(".modal-body #apellido2").val(apellido2);
  modal.find(".modal-body #direccion").val(direccion);
  modal.find(".modal-body #nit").val(nit);
  modal.find(".modal-body #digito").val(digito);
  modal.find(".modal-body #tipo_doc").val(tipo_doc);
  modal.find(".modal-body #telefono").val(telefono);
  modal.find(".modal-body #telefono2").val(telefono2);
  modal.find(".modal-body #celular").val(celular);
  modal.find(".modal-body #fax").val(fax);
  modal.find(".modal-body #correo").val(correo);
  modal.find(".modal-body #web").val(web);
  modal.find(".modal-body #pais").val(pais);
  modal.find(".modal-body #ciudad").val(ciudad);
  modal.find(".modal-body #tipo_emp").val(tipo_emp);
  modal.find(".modal-body #ciiu").val(ciiu);
  $(".alert").hide(); //Oculto alert
});

$("#UpdateDataProveedor").submit(function (event) {
  var parametros = $(this).serialize();
  $.ajax({
    type: "POST",
    url: "../code/code_modificar_proveedor.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#datos_ajax").html("Actualizando Proveedor ...");
    },
    success: function (datos) {
      $("#datos_ajax").html(datos);

      $("#dataUpdateProveedor").modal("hide");
      loadproveedor(1);
    },
  });
  event.preventDefault();
});

function verificaTipo(codigo) {
  var parametros = {
    tipoemp: codigo,
  };
  $("#loader").fadeIn("slow");
  $.ajax({
    data: parametros,
    url: "../code/code_selecciona_tipo_emp.php",
    type: "post",
    beforeSend: function () {
      $("#nombre_personas").html("<img src='../../img/loader.gif'>");
    },
    success: function (data) {
      $(".outer_div2").html(data).fadeIn("slow");
      $("#nombre_personas").html("");
    },
  });
}
