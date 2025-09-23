let sesion = JSON.parse(localStorage.getItem("sesion"));
let {
  user: { usuario },
} = sesion;
function buscaCantidad() {
  desde = $("#llegada").val();
  hasta = $("#salida").val();

  $.ajax({
    url: "res/php/ocupacionHotel.php",
    type: "POST",
    data: { desde, hasta },
    success: function (data) {
      data = $.trim(data);
      $("#sugerido").val(data);
      $("#myModalEstadoHotel").modal("hide");
      $("#cantidad").val(data);
    },
  });
}

async function cierreMes(mes, anio) {

  let proce = document.querySelector('#tituloProcesa')
  proce.classList.remove('oculto');
  document.querySelector('#botonCierre').disabled;
  let sesion = JSON.parse(localStorage.getItem("sesion"));
  let { user: { usuario }, } = sesion;

  let backup = await backupCierre(mes, anio);
  if (backup === 0) {
    swal(
      {
        title: "Precaucion",
        text: "Backup no se pudo Realizar, el Proceso de Cierre no Continuara",
        type: "warning",
      },
      function () {
        window.location.href = "home";
      }
    );
  }

  envia = {
    mes,
    anio,
    usuario,
  };

  const cierre = await cierreBodegas(envia);
  swal(
    {
      title: "Cierre de Mes Realizado con Exito !",
      type: "success",
      confirmButtonText: "Confirmar",
      closeOnConfirm: false,
    },
    function () {
      $(location).attr("href", "home");
    }
  );

  // console.log(cierre);

  /* parametros = {
    periodo,
    usuario,
  };
  $.ajax({
    url: "res/php/cierreMes.php",
    type: "POST",
    data: parametros,
    beforeSend: function () {
      $("#loader").html(
        `
        <img src='../img/loader.gif'>
        <h3 align="center>Cerrando Periodo Actual</h3>
        `
      );
    },
    success: function () {
      swal(
        {
          title: "Cierre de Mes Realizado con Exito !",
          type: "success",
          confirmButtonText: "Confirmar",
          closeOnConfirm: false,
        },
        function () {
          $(location).attr("href", "home");
        }
      );
    },
  }); */
}

async function cierreBodegas(envia) {

  try {
    const resultado = await fetch("res/php/cierreMes.php", {
      method: "POST",
      headers: {
        "Content-type": "application/json; charset=UTF-8",
      },
      body: JSON.stringify(envia),
    });
    const datos = await resultado.text();
    return parseInt(datos);
  } catch (error) {
    console.log(error);
  }
}

async function backupCierre(mes, anio) {
  try {
    const resultado = await fetch("res/php/backupCierre.php", {
      method: "POST",
      headers: {
        "Content-type": "application/json; charset=UTF-8",
      },
      body: JSON.stringify({mes, anio})
    });
    const datos = await resultado.text();
    // console.log(datos);
    return parseInt(datos);
  } catch (error) {
    console.log(error);
  }
}

function conteoInventario(bodega) { }

/* Pedidos Recetas*/

function procesaRecPed() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  let sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, usuario_id },
  } = sesion;

  asignaConsecutivo(6);

  setTimeout(function () {
    var numero = $("#numeroMovimiento").val();
    var almacen = $("#almacenRecPed").val();
    var centro = $("#proveedorRecPed").val();
    var fecha = $("#fechaRecPed").val();
    var storageList = localStorage.getItem("PedidosRecetasLista");
    recetas = JSON.parse(storageList);
    parametros = {
      usuario_id,
      usuario,
      numero,
      centro,
      almacen,
      fecha,
      recetas,
    };
    $.ajax({
      url: ruta + "res/php/guardaProductoRecPed.php",
      type: "POST",
      data: parametros,
      success: function (data) {
        data = $.trim(data);
        imprimeMovimiento(data, 6);
        localStorage.removeItem("PedidosRecetasLista");
        localStorage.removeItem("proveedorRecPed");
        localStorage.removeItem("almacenRecPed");
        localStorage.removeItem("fechaRecPed");
        swal("Atencion", "Pedido Creado con Exito", "success", 5000);
        $(location).attr("href", "pedidos");
      },
    });
  }, 1000);
}

function cancelaRecPed() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();

  localStorage.removeItem("PedidosRecetasLista");
  localStorage.removeItem("almacenRecPed");
  localStorage.removeItem("proveedorRecPed");
  localStorage.removeItem("fechaRecPed");

  $(location).attr("href", ruta + pagina);
}

function actualizaRecPed(codigo, regis) {
  document
    .getElementsByTagName("table")[0]
    .setAttribute("id", "tablaArticulos");
  document.getElementById("tablaArticulos").deleteRow(regis);
  borrar = regis - 1;
  listaRecetasPed.splice(borrar, 1);

  localStorage.setItem("PedidosRecetasLista", JSON.stringify(listaRecetasPed));
  resumenRecReq();
}

function agregaListaRecPed() {
  var centro = $("#proveedorRecPed").val();
  var almace = $("#almacenRecPed").val();
  var fechaR = $("#fechaRecPed").val();
  var producto = $("#producto").val();

  if (centro == null || centro == "") {
    swal(
      "Precaucion",
      "Sin Centro de Costo Asignado A Esta Requisicion ",
      "warning"
    );
    $("#proveedorRecPed").focus();
    return;
  }

  if (almace == null || almace == "") {
    swal("Precaucion", "Sin Almancen Asignado A Esta Requisicion ", "warning");
    $("#almacenRecPed").focus();
    return;
  }

  if (fechaR == null) {
    swal("Precaucion", "Sin Fecha Asignado A Esta Requisicion ", "warning");
    $("#fechaRecPed").focus();
    return;
  }

  if (producto == "") {
    swal("Precaucion", "Sin Producto Seleccionado ", "warning");
    $("#producto").focus();
    return;
  }

  var prod = $("#codigo").val();
  var unit = parseFloat($("#unitario").val());
  var valp = $("#costo").val();
  var cant = $("#cantidad").val();
  var desc = $("#descripcion").val();
  total = unit * cant;

  $("#total").val(total);
  $("#tablaArticulos > tbody").append(`
  	<tr>
  		<td class='paddingCelda'>${prod}</td>
  		<td class='paddingCelda'>${desc}</td>
  		<td class='paddingCelda' align='right'>${number_format(cant, 2)}</td>
  		<td class='paddingCelda' align='right'>${number_format(unit, 2)}</td>
  		<td class='paddingCelda' align='right'>${number_format(total, 2)}</td>
  		<td class='paddingCelda' align='center'>
  			<button id='${prod}' class='btn btn-danger btn-xs elimina_articulo' onclick='actualizaRecPed(this.id,this.parentNode.parentNode.rowIndex);'>
  			<i class='fa fa-times'></i></button>
			</td>
		</tr>"
  	`);
  var dataProd = {
    codigo: $("#codigo").val(),
    descripcion: $("#descripcion").val(),
    subtotal: unit * cant,
    unit: unit,
    total: total,
    producto: $("#producto").val(),
    cantidad: cant,
    porciones: $("#porciones").val(),
    costo: unit,
  };

  listaRecetasPed.push(dataProd);
  localStorage.setItem("PedidosRecetasLista", JSON.stringify(listaRecetasPed));

  resumenRecReq();
  $("#producto").val("");
  $("#producto").focus();
}

function listaRecetasPed() {
  var alma = localStorage.getItem("almacenRecPed");
  var cent = localStorage.getItem("proveedorRecPed");
  var fech = localStorage.getItem("fechaRecPed");

  if (alma != null) {
    $("#almacenRecPed").val(alma);
  }
  if (cent != null) {
    $("#proveedorRecPed").val(cent);
  }
  if (fech != null) {
    $("#fechaRecPed").val(fech);
  }

  var storageList = localStorage.getItem("PedidosRecetasLista");
  if (storageList == null) {
    listaRecetasPed = [];
  } else {
    listaRecetasPed = JSON.parse(storageList);
  }

  for (x = 0; x < listaRecetasPed.length; x++) {
    $("#tablaArticulos > tbody").append(`
	  		<tr>
	  			<td class='paddingCelda'>${listaRecetasPed[x]["codigo"]}</td>
	  			<td class='paddingCelda'>${listaRecetasPed[x]["descripcion"]}</td>
	  			<td class='paddingCelda' align='right'>${number_format(
      listaRecetasPed[x]["cantidad"],
      2
    )}</td>
	  			<td class='paddingCelda' align='right'>${number_format(
      listaRecetasPed[x]["unit"],
      2
    )}</td>
	  			<td class='paddingCelda' align='right'>${number_format(
      listaRecetasPed[x]["total"],
      2
    )}</td>
	  			<td class='paddingCelda' align='center'>
	  				<button id='${listaRecetasPed[x]["codigo"]}' 
	  				class='btn btn-danger btn-xs elimina_articulo' 
	  				onclick='actualizaRecPed(this.id,this.parentNode.parentNode.rowIndex);'>
	  				<i class='fa fa-times'></i></button>
  				</td>
				</tr>"
	  	`);
  }
  resumenRecPed();
}

function resumenRecPed() {
  var total = 0.0;
  var totales = 0.0;
  var cantp = 0.0;
  var cantis = 0.0;
  $("#tablaArticulos > tbody > tr").each(function () {
    var total = $(this).find("td").eq(4).html();
    var cantp = $(this).find("td").eq(2).html();
    total = parseFloat(total.replace(",", ""));

    totales = totales + total;
  });
  $("#net").val("$ " + number_format(totales, 2));
  if (totales > 0) {
    $("#btn-procesa").prop("disabled", false);
    $("#btn-cancela").prop("disabled", false);
  } else {
    $("#btn-procesa").prop("disabled", true);
    $("#btn-cancela").prop("disabled", true);
  }
}

function buscaRecetaPed(codigo) {
  var ruta = $("#rutaweb").val();
  var prod = $("#producto").val();
  $.ajax({
    url: ruta + "res/php/buscaRecetas.php",
    type: "POST",
    dataType: "json",
    data: { codigo },
    success: function (x) {
      sugerido = $("#sugerido").val();
      $("#codigo").val(x.id_receta);
      $("#descripcion").val(x.nombre_receta);
      $("#unitario").val(x.valor_costo);
      $("#porciones").val(x.cantidad);
      $("#cantidad").val(sugerido);
      $("#costo").val(number_format(x.valor_costo, 2));
      $("#costo").attr("disabled", false);
      $("#cantidad").attr("disabled", false);
      $("#unidad").focus();
    },
  });
}

/* Requisiciones Recetas*/

function procesaRecReq() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  let sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, usuario_id },
  } = sesion;

  asignaConsecutivo(5);

  setTimeout(function () {
    var numero = $("#numeroMovimiento").val();
    var centro = $("#centroCostoRecReq").val();
    var almacen = $("#almacenRecReq").val();
    var fecha = $("#fechaRecReq").val();
    var storageList = localStorage.getItem("RequisicionRecetasLista");
    recetas = JSON.parse(storageList);
    parametros = {
      usuario_id,
      usuario,
      numero,
      centro,
      almacen,
      fecha,
      recetas,
    };
    $.ajax({
      url: ruta + "res/php/guardaProductoRecReq.php",
      type: "POST",
      data: parametros,
      success: function (data) {
        data = $.trim(data);
        imprimeMovimiento(data, 5);
        localStorage.removeItem("RequisicionRecetasLista");
        localStorage.removeItem("centroCostoRecReq");
        localStorage.removeItem("almacenRecReq");
        localStorage.removeItem("fechaRecReq");
        swal("Atencion", "Requisicion Creada con Exito", "success", 5000);
        $(location).attr("href", "requisiciones");
      },
    });
  }, 1000);
}

function cancelaRecReq() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();

  localStorage.removeItem("RequisicionRecetasLista");
  localStorage.removeItem("almacenRecReq");
  localStorage.removeItem("centroCostoRecReq");
  localStorage.removeItem("fechaRecReq");

  $(location).attr("href", ruta + pagina);
}

function actualizaRecReq(codigo, regis) {
  document
    .getElementsByTagName("table")[0]
    .setAttribute("id", "tablaArticulos");
  document.getElementById("tablaArticulos").deleteRow(regis);
  borrar = regis - 1;
  listaRecetasReq.splice(borrar, 1);

  localStorage.setItem(
    "RequisicionRecetasLista",
    JSON.stringify(listaRecetasReq)
  );
  resumenRecReq();
}

function agregaListaRecReq() {
  var centro = $("#centroCostoRecReq").val();
  var almace = $("#almacenRecReq").val();
  var fechaR = $("#fechaRecReq").val();
  if (centro == null || centro == "") {
    swal(
      "Atencion",
      "Sin Centro de Costo Asociado Asignado A Esta Requisicion",
      "warning"
    );
    $("#centroCostoRecReq").focus();
    return;
  }

  if (almace == null || almace == "") {
    swal(
      "Atencion",
      "Sin Almancen Asociado Asignado A Esta Requisicion",
      "warning"
    );
    $("#almacenRecReq").focus();
    return;
  }
  if (fechaR == null) {
    swal(
      "Atencion",
      "Sin Fecha Asociada Asignado A Esta Requisicion",
      "warning"
    );
    $("#fechaRecReq").focus();
    return;
  }

  var prod = $("#codigo").val();
  var unit = parseFloat($("#unitario").val());
  var valp = $("#costo").val();
  var cant = $("#cantidad").val();
  var desc = $("#descripcion").val();
  total = unit * cant;

  $("#total").val(total);
  $("#tablaArticulos > tbody").append(`
  	<tr>
  		<td class='paddingCelda'>${prod}</td>
  		<td class='paddingCelda'>${desc}</td>
  		<td class='paddingCelda' align='right'>${number_format(cant, 2)}</td>
  		<td class='paddingCelda' align='right'>${number_format(unit, 2)}</td>
  		<td class='paddingCelda' align='right'>${number_format(total, 2)}</td>
  		<td class='paddingCelda' align='center'>
  			<button id='${prod}' class='btn btn-danger btn-xs elimina_articulo' onclick='actualizaRecReq(this.id,this.parentNode.parentNode.rowIndex);'>
  			<i class='fa fa-times'></i></button>
			</td>
		</tr>"
  	`);
  var dataProd = {
    codigo: $("#codigo").val(),
    descripcion: $("#descripcion").val(),
    subtotal: unit * cant,
    unit: unit,
    total: total,
    producto: $("#producto").val(),
    cantidad: cant,
    porciones: $("#porciones").val(),
    costo: unit,
  };

  listaRecetasReq.push(dataProd);
  localStorage.setItem(
    "RequisicionRecetasLista",
    JSON.stringify(listaRecetasReq)
  );

  resumenRecReq();
  $("#producto").val("");
  $("#producto").focus();
}

function listaRecetasReq() {
  var alma = localStorage.getItem("almacenRecReq");
  var cent = localStorage.getItem("centroCostoRecReq");
  var fech = localStorage.getItem("fechaRecReq");

  if (alma != null) {
    $("#almacenRecReq").val(alma);
  }
  if (cent != null) {
    $("#centroCostoRecReq").val(cent);
  }
  if (fech != null) {
    $("#fechaRecReq").val(fech);
  }

  var storageList = localStorage.getItem("RequisicionRecetasLista");
  if (storageList == null) {
    listaRecetasReq = [];
  } else {
    listaRecetasReq = JSON.parse(storageList);
  }

  for (x = 0; x < listaRecetasReq.length; x++) {
    $("#tablaArticulos > tbody").append(`
	  		<tr>
	  			<td class='paddingCelda'>${listaRecetasReq[x]["codigo"]}</td>
	  			<td class='paddingCelda'>${listaRecetasReq[x]["descripcion"]}</td>
	  			<td class='paddingCelda' align='right'>${number_format(
      listaRecetasReq[x]["cantidad"],
      2
    )}</td>
	  			<td class='paddingCelda' align='right'>${number_format(
      listaRecetasReq[x]["unit"],
      2
    )}</td>
	  			<td class='paddingCelda' align='right'>${number_format(
      listaRecetasReq[x]["total"],
      2
    )}</td>
	  			<td class='paddingCelda' align='center'>
	  				<button id='${listaRecetasReq[x]["codigo"]}' 
	  				class='btn btn-danger btn-xs elimina_articulo' 
	  				onclick='actualizaRecReq(this.id,this.parentNode.parentNode.rowIndex);'>
	  				<i class='fa fa-times'></i></button>
  				</td>
				</tr>"
	  	`);
  }
  resumenRecReq();
}

function resumenRecReq() {
  var total = 0.0;
  var totales = 0.0;
  var cantp = 0.0;
  var cantis = 0.0;
  $("#tablaArticulos > tbody > tr").each(function () {
    var total = $(this).find("td").eq(4).html();
    var cantp = $(this).find("td").eq(2).html();
    total = parseFloat(total.replace(",", ""));
    totales = totales + total;
  });
  $("#net").val("$ " + number_format(totales, 2));
  if (totales > 0) {
    $("#btn-procesa").prop("disabled", false);
    $("#btn-cancela").prop("disabled", false);
  } else {
    $("#btn-procesa").prop("disabled", true);
    $("#btn-cancela").prop("disabled", true);
  }
}

function buscaRecetaReq(codigo) {
  var ruta = $("#rutaweb").val();
  var prod = $("#producto").val();
  $.ajax({
    url: ruta + "res/php/buscaRecetas.php",
    type: "POST",
    dataType: "json",
    data: { codigo: codigo },
    success: function (x) {
      $("#codigo").val(x.id_receta);
      $("#descripcion").val(x.nombre_receta);
      $("#unitario").val(x.valor_costo);
      $("#porciones").val(x.cantidad);
      $("#cantidad").val(1);
      $("#costo").val(number_format(x.valor_costo, 2));
      $("#costo").attr("disabled", false);
      $("#cantidad").attr("disabled", false);
      $("#cantidad").focus();
    },
  });
}

// PEDIDOS

function procesaPed() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  let sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, usuario_id },
  } = sesion;

  var centro = $("#almacenPed").val();
  var proveedor = $("#proveedorPed").val();
  var fecha = $("#fechaPed").val();
  if (centro == "" || proveedor == "") {
    swal("Atencion", "Sin Centro de Costo y/o Proveedor Asociado", "success");
    return 0;
  }

  asignaConsecutivo(6);

  setTimeout(function () {
    var numero = $("#numeroMovimiento").val();
    var storageList = localStorage.getItem("pedidoProductosLista");
    pedidos = JSON.parse(storageList);
    console.log(pedidos);
    parametros = {
      usuario_id,
      usuario,
      numero,
      centro,
      proveedor,
      fecha,
      pedidos,
    };
    $.ajax({
      url: ruta + "res/php/guardaProductoPed.php",
      type: "POST",
      data: parametros,
      success: function (data) {
        data = $.trim(data);
        imprimeMovimiento(data, 6);
        localStorage.removeItem("pedidoProductosLista");
        localStorage.removeItem("almacenPed");
        localStorage.removeItem("proveedorPed");
        localStorage.removeItem("fechaPed");
        swal("Atencion", "Pedido Creado con Exito", "success", 5000);
        $(location).attr("href", "pedidos");
      },
    });
  }, 1000);
}

function cancelaPed() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();

  localStorage.removeItem("pedidoProductosLista");
  localStorage.removeItem("almacenPed");
  localStorage.removeItem("proveedorPed");
  localStorage.removeItem("fechaPed");

  $(location).attr("href", ruta + pagina);
}

function buscaProductoPed(codigo) {
  var ruta = $("#rutaweb").val();
  var prod = $("#producto").val();
  $.ajax({
    url: ruta + "res/php/buscaProductos.php",
    type: "POST",
    dataType: "json",
    data: { codigo: codigo },
    success: function (x) {
      $("#codigo").val(x.id_producto);
      $("#unidadalm").val(x.unidad_almacena);
      $("#unidad").val(x.unidad_compra);
      $("#descripcion").val(x.nombre_producto);
      $("#cantidad").val(0);
      $("#costo").val(x.valor_promedio);
      $("#costo").attr("disabled", false);
      $("#cantidad").attr("disabled", false);
      $("#cantidad").val("");
      $("#unidad").focus();
    },
  });
}

function agregaListaPed() {
  var cent = $("#almacenPed").val();
  var prov = $("#proveedorPed").val();
  var fech = $("#fechaPed").val();
  if (cent == null || cent == "") {
    swal("Atencion", "Sin Almacen Asignado A Este Pedido", "warning");
    $("#almacenPed").focus();
    return;
  }

  if (prov == null || prov == "") {
    swal("Atencion", "Sin Provedor Asignado A Este Pedido", "warning");
    $("#fecha").focus();
    return;
  }
  if (fech == null) {
    swal("Atencion", "Sin Fecha Asignado A Este Pedido", "warning");
    $("#fecha").focus();
    return;
  }

  var prod = $("#codigo").val();
  var unid = $("#unidad").val();
  var unidalm = $("#unidadalm").val();
  var desunid = $("#unidad option:selected").text();
  var unit = $("#unitario").val();
  var valp = $("#costo").val();
  var cant = $("#cantidad").val();
  var desc = $("#descripcion").val();
  var subtot = parseFloat(valp);
  valp = parseFloat(valp);
  cant = parseInt(cant);

  valu = subtot;
  valu = redondeo(valu, 2);
  cant = redondeo(cant, 2);
  valp = redondeo(valp, 2);
  total = valu * cant;

  $("#total").val(total);
  $("#unitario").val(valu);
  $("#unidad").val(unid);
  $("#unidadcom").val(desunid);
  $("#unidadalm").val(unidalm);
  $("#tablaArticulos > tbody").append(`
  	<tr>
  		<td class='paddingCelda'>${prod}</td>
  		<td class='paddingCelda'>${desc}</td>
  		<td class='paddingCelda'>${desunid}</td>
  		<td class='paddingCelda' align='right'>${number_format(cant, 2)}</td>
  		<td class='paddingCelda' align='right'>${number_format(valu, 2)}</td>
  		<td class='paddingCelda' align='right'>${number_format(total, 2)}</td>
  		<td class='paddingCelda' align='center'>
  			<button id='${prod}' class='btn btn-danger btn-xs elimina_articulo' onclick='actualizaPed(this.id,this.parentNode.parentNode.rowIndex);'>
  			<i class='fa fa-times'></i></button>
			</td>
		</tr>
  	`);
  var dataProd = {
    codigo: $("#codigo").val(),
    descripcion: $("#descripcion").val(),
    subtotal: $("#subtotal").val(),
    unit: $("#unitario").val(),
    desunid: $("#unidad option:selected").text(),
    total: $("#total").val(),
    producto: $("#producto").val(),
    unidad: $("#unidad").val(),
    unidadalm: $("#unidadalm").val(),
    cantidad: $("#cantidad").val(),
    costo: $("#costo").val(),
  };

  listaPedidos.push(dataProd);
  localStorage.setItem("pedidoProductosLista", JSON.stringify(listaPedidos));

  $("#producto").val("");
  resumenPed();
  $("#producto").focus();
}

function actualizaPed(codigo, regis) {
  document
    .getElementsByTagName("table")[0]
    .setAttribute("id", "tablaArticulos");
  document.getElementById("tablaArticulos").deleteRow(regis);
  borrar = regis - 1;
  listaPedidos.splice(borrar, 1);

  localStorage.setItem("pedidoProductosLista", JSON.stringify(listaPedidos));
  resumenPed();
}

function resumenPed() {
  var total = 0.0;
  var totales = 0.0;
  var cantp = 0.0;
  var cantis = 0.0;
  $("#tablaArticulos > tbody > tr").each(function () {
    var total = $(this).find("td").eq(5).html();
    var cantp = $(this).find("td").eq(3).html();
    total = parseFloat(total.replace(",", ""));
    cantp = parseFloat(cantp.replace(",", ""));
    totales = totales + total;
    cantis = cantis + cantp;
  });
  $("#net").val("$ " + number_format(totales, 2));
  $("#arts").val(number_format(cantis, 2));
  if (totales > 0) {
    $("#btn-procesa").prop("disabled", false);
    $("#btn-cancela").prop("disabled", false);
  } else {
    $("#btn-procesa").prop("disabled", true);
    $("#btn-cancela").prop("disabled", true);
  }
}

function listaPedido() {
  var cent = localStorage.getItem("almacenPed");
  var prov = localStorage.getItem("proveedorPed");
  var fech = localStorage.getItem("fechaPed");

  if (cent != null) {
    $("#almacenPed").val(cent);
  }
  if (prov != null) {
    $("#proveedorPed").val(prov);
  }
  if (fech != null) {
    $("#fechaPed").val(fech);
  }

  var storageList = localStorage.getItem("pedidoProductosLista");
  if (storageList == null) {
    listaPedidos = [];
  } else {
    listaPedidos = JSON.parse(storageList);
  }

  for (x = 0; x < listaPedidos.length; x++) {
    $("#tablaArticulos > tbody").append(`
	  	<tr>
	  		<td class='paddingCelda'>${listaPedidos[x]["codigo"]}</td>
	  		<td class='paddingCelda'>${listaPedidos[x]["descripcion"]}</td>
	  		<td class='paddingCelda'>${listaPedidos[x]["desunid"]}</td>
	  		<td class='paddingCelda' align='right'>${number_format(
      listaPedidos[x]["cantidad"],
      2
    )}</td>
	  		<td class='paddingCelda' align='right'>${number_format(
      listaPedidos[x]["unit"],
      2
    )}</td>
	  		<td class='paddingCelda' align='right'>${number_format(
      listaPedidos[x]["total"],
      2
    )}</td>
	  		<td class='paddingCelda' align='center'>
	  			<button id='${listaPedidos[x]["codigo"]
      }' class='btn btn-danger btn-xs elimina_articulo' onclick='actualizaPed(this.id,this.parentNode.parentNode.rowIndex);'>
	  				<i class='fa fa-times'></i></button>
				</td>
			</tr>"
	  	`);
  }
  resumenPed();
}

function muestraProductosPedido() {
  $("#myModalMostrarProductosRequisicion").on(
    "show.bs.modal",
    function (event) {
      var button = $(event.relatedTarget); // Botón que activó el modal
      var numero = button.data("numero"); // Extraer la información de atributos de datos
      var bodega = button.data("bodega"); // Extraer la información de atributos de datos
      var titulo = $("#titulo").val();
      parametros = {
        numero,
        bodega,
      };
      var modal = $(this);
      modal.find(".modal-title").html("Productos " + titulo + " : " + numero);
      $.ajax({
        url: "res/php/getMuestraProductosPedido.php",
        type: "POST",
        data: parametros,
        success: function (data) {
          $("#movimientosProducto").html(data);
        },
      });
    }
  );
}

function anulaPedido(id) {
  var ubica = $("#ubicacion").val();
  let sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario },
  } = sesion;
  parametros = {
    id,
    usuario,
  };

  swal(
    {
      title: "Anular Pedido !",
      text: "Anular Presente Pedido ?",
      type: "warning",
      showCancelButton: true,
      cancelButtonClass: "btn-warning",
      cancelButtonText: "Cancelar",
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Si, Anular el Pedido !",
      closeOnConfirm: false,
    },
    function () {
      $.ajax({
        type: "POST",
        url: "res/php/anulaPedido.php",
        data: parametros,
        success: function (data) {
          swal("Atencion", "Pedido Anulado con Exito", "success", 5000);
          $(location).attr("href", ubica);
        },
      });
    }
  );
}

/// REQUISICIONES

function anulaRequisicion(id) {
  let sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario },
  } = sesion;

  var ubica = $("#ubicacion").val();
  parametros = {
    id,
    usuario,
  };

  swal(
    {
      title: "Anular Requisicion !",
      text: "Anular Presente Requisicion ?",
      type: "warning",
      showCancelButton: true,
      cancelButtonClass: "btn-warning",
      cancelButtonText: "Cancelar",
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Si, Anular la Requsicion !",
      closeOnConfirm: false,
    },
    function () {
      $.ajax({
        type: "POST",
        url: "res/php/anulaRequisicion.php",
        data: parametros,
        success: function (data) {
          swal("Atencion", "Requisicion Anulada con Exito", "success", 5000);
          $(location).attr("href", ubica);
        },
      });
    }
  );
}

function procesaReq() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  let sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, usuario_id },
  } = sesion;

  asignaConsecutivo(5);

  setTimeout(function () {
    var numero = $("#numeroMovimiento").val();
    var centro = $("#centroCostoReq").val();
    var almacen = $("#almacenReq").val();
    var fecha = $("#fechaReq").val();
    var storageList = localStorage.getItem("RequisicionProductosLista");
    requision = JSON.parse(storageList);
    parametros = {
      usuario_id,
      usuario,
      numero,
      centro,
      almacen,
      fecha,
      requision,
    };
    $.ajax({
      url: ruta + "res/php/guardaProductoReq.php",
      type: "POST",
      data: parametros,
      success: function (data) {
        data = $.trim(data);
        imprimeMovimiento(data, 5);
        localStorage.removeItem("RequisicionProductosLista");
        localStorage.removeItem("centroCostoReq");
        localStorage.removeItem("almacenReq");
        localStorage.removeItem("fechaReq");
        swal("Atencion", "Requisicion Creada con Exito", "success", 5000);
        $(location).attr("href", "requisiciones");
      },
    });
  }, 1000);
}

function buscaProductoReq(codigo) {
  var ruta = $("#rutaweb").val();
  var prod = $("#producto").val();
  $.ajax({
    url: ruta + "res/php/buscaProductos.php",
    type: "POST",
    dataType: "json",
    data: { codigo: codigo },
    success: function (x) {
      $("#codigo").val(x.id_producto);
      $("#unidadalm").val(x.unidad_almacena);
      $("#unidad").val(x.unidad_almacena);
      $("#descripcion").val(x.nombre_producto);
      $("#cantidad").val(0);
      $("#costo").val(x.valor_promedio);
      $("#costo").attr("disabled", true);
      $("#cantidad").attr("disabled", false);
      $("#cantidad").val("");
      $("#cantidad").focus();
    },
  });
}

function cancelaReq() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();

  localStorage.removeItem("RequisicionProductosLista");
  localStorage.removeItem("almacenReq");
  localStorage.removeItem("centroCostoReq");
  localStorage.removeItem("fechaReq");

  $(location).attr("href", ruta + pagina);
}

function agregaListaReq() {
  var centro = $("#centroCostoReq").val();
  var almace = $("#almacenReq").val();
  var fechaR = $("#fechaReq").val();
  var producto = $("#producto").val();

  if (centro == null || centro == "") {
    swal(
      "Precaucion",
      "Sin Centro de Costo Asignado A Esta Requisicion ",
      "warning"
    );
    $("#proveedor").focus();
    return;
  }

  if (almace == null || almace == "") {
    swal("Precaucion", "Sin Almancen Asignado A Esta Requisicion ", "warning");
    $("#fecha").focus();
    return;
  }
  if (fechaR == null) {
    swal("Precaucion", "Sin Fecha Asignado A Esta Requisicion ", "warning");
    $("#fecha").focus();
    return;
  }

  if (producto == "") {
    swal("Precaucion", "Seleccione un Producto ", "warning");
    $("#producto").focus();
    return;
  }

  var prod = $("#codigo").val();
  var unid = $("#unidad").val();
  var unidalm = $("#unidadalm").val();
  var desunid = $("#unidad option:selected").text();
  var unit = $("#unitario").val();
  var valp = $("#costo").val();
  var cant = $("#cantidad").val();
  var desc = $("#descripcion").val();
  var subtot = parseFloat(valp);
  valp = parseFloat(valp);
  cant = parseInt(cant);

  valu = subtot;
  valu = redondeo(valu, 2);
  cant = redondeo(cant, 2);
  valp = redondeo(valp, 2);
  total = valu * cant;

  $("#total").val(total);
  $("#unitario").val(valu);
  $("#unidad").val(unid);
  $("#unidadcom").val(desunid);
  $("#unidadalm").val(unidalm);
  $("#tablaArticulos > tbody").append(`
  	<tr>
  		<td class='paddingCelda'>${prod}</td>
  		<td class='paddingCelda'>${desc}</td>
  		<td class='paddingCelda'>${desunid}</td>
  		<td class='paddingCelda' align='right'>${number_format(cant, 2)}</td>
  		<td class='paddingCelda' align='right'>${number_format(valu, 2)}</td>
  		<td class='paddingCelda' align='right'>${number_format(total, 2)}</td>
  		<td class='paddingCelda' align='center'>
  			<button id='${prod}' 
  				class='btn btn-danger btn-xs elimina_articulo' 
  				onclick='actualizaReq(this.id,this.parentNode.parentNode.rowIndex);'>
  			<i class='fa fa-times'></i></button>
			</td>
		</tr>"
  	`);
  var dataProd = {
    codigo: $("#codigo").val(),
    descripcion: $("#descripcion").val(),
    subtotal: $("#subtotal").val(),
    unit: $("#unitario").val(),
    desunid: $("#unidad option:selected").text(),
    total: $("#total").val(),
    producto: $("#producto").val(),
    unidad: $("#unidad").val(),
    unidadalm: $("#unidadalm").val(),
    cantidad: $("#cantidad").val(),
    costo: $("#costo").val(),
  };

  listaRequisicion.push(dataProd);
  localStorage.setItem(
    "RequisicionProductosLista",
    JSON.stringify(listaRequisicion)
  );

  $("#producto").val("");
  resumenReq();
  $("#producto").focus();
}

function resumenReq() {
  var total = 0.0;
  var totales = 0.0;
  var cantp = 0.0;
  var cantis = 0.0;
  $("#tablaArticulos > tbody > tr").each(function () {
    var total = $(this).find("td").eq(5).html();
    var cantp = $(this).find("td").eq(3).html();
    total = parseFloat(total.replace(",", ""));
    cantp = parseFloat(cantp.replace(",", ""));

    totales = totales + total;
    cantis = cantis + cantp;
  });
  $("#net").val("$ " + number_format(totales, 2));
  $("#arts").val(number_format(cantis, 2));
  if (totales > 0) {
    $("#btn-procesa").prop("disabled", false);
    $("#btn-cancela").prop("disabled", false);
  } else {
    $("#btn-procesa").prop("disabled", true);
    $("#btn-cancela").prop("disabled", true);
  }
}

function actualizaReq(codigo, regis) {
  document
    .getElementsByTagName("table")[0]
    .setAttribute("id", "tablaArticulos");
  document.getElementById("tablaArticulos").deleteRow(regis);
  borrar = regis - 1;
  listaRequisicion.splice(borrar, 1);

  localStorage.setItem(
    "RequisicionProductosLista",
    JSON.stringify(listaRequisicion)
  );
  resumenReq();
}

function listaRequisicion() {
  var alma = localStorage.getItem("almacenReq");
  var cent = localStorage.getItem("centroCostoReq");
  var fech = localStorage.getItem("fechaReq");

  if (alma != null) {
    $("#almacenReq").val(alma);
  }
  if (cent != null) {
    $("#centroCostoReq").val(cent);
  }
  if (fech != null) {
    $("#fechaReq").val(fech);
  }

  var storageList = localStorage.getItem("RequisicionProductosLista");
  if (storageList == null) {
    listaRequisicion = [];
  } else {
    listaRequisicion = JSON.parse(storageList);
  }

  for (x = 0; x < listaRequisicion.length; x++) {
    $("#tablaArticulos > tbody").append(`
	  		<tr>
	  			<td class='paddingCelda'>${listaRequisicion[x]["codigo"]}</td>
	  			<td class='paddingCelda'>${listaRequisicion[x]["descripcion"]}</td>
	  			<td class='paddingCelda'>${listaRequisicion[x]["desunid"]}</td>
	  			<td class='paddingCelda' align='right'>${number_format(
      listaRequisicion[x]["cantidad"],
      2
    )}</td>
	  			<td class='paddingCelda' align='right'>${number_format(
      listaRequisicion[x]["unit"],
      2
    )}</td>
	  			<td class='paddingCelda' align='right'>${number_format(
      listaRequisicion[x]["total"],
      2
    )}</td>
	  			<td class='paddingCelda' align='center'>
	  				<button id='${listaRequisicion[x]["codigo"]}' 
	  				class='btn btn-danger btn-xs elimina_articulo' 
	  				onclick='actualizaReq(this.id,this.parentNode.parentNode.rowIndex);'>
	  				<i class='fa fa-times'></i></button>
  				</td>
				</tr>"
	  	`);
  }
  resumenReq();
}

function muestraProductosRequisicion() {
  $("#myModalMostrarProductosRequisicion").on(
    "show.bs.modal",
    function (event) {
      var titulo = $("#titulo").val();
      var button = $(event.relatedTarget); // Botón que activó el modal
      var numero = button.data("numero"); // Extraer la información de atributos de datos
      var bodega = button.data("bodega"); // Extraer la información de atributos de datos
      parametros = {
        numero,
        bodega,
      };
      var modal = $(this);
      modal.find(".modal-title").html("Productos " + titulo + " : " + numero);
      $.ajax({
        url: "res/php/getMuestraProductosRequisicion.php",
        type: "POST",
        data: parametros,
        success: function (data) {
          $("#movimientosProducto").html(data);
        },
      });
    }
  );
}

function muestraProductoKardex() {
  $("#modalConsultaKardex").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget); // Botón que activó el modal
    var id = button.data("id"); // Extraer la información de atributos de datos
    var bodega = button.data("bodega"); // Extraer la información de atributos de datos
    var nombre = button.data("nombre"); // Extraer la información de atributos de datos
    parametros = {
      id,
      bodega,
    };
    var modal = $(this);
    modal.find(".modal-title").html("Movimientos Producto : " + nombre);
    $.ajax({
      url: "res/php/getMuestraMovimientosProducto.php",
      type: "POST",
      data: parametros,
      success: function (data) {
        $("#movimientosProducto").html(data);
      },
    });
  });
}

async function procesaAjuste() {
  let productos = JSON.parse(localStorage.getItem("AjusteProductosLista"));
  // console.log(productos)
  if (!productos) {
    swal({
      title: 'Precaucion',
      text: 'Sin Productos Asignados para el Ajuste',
      type: 'warning'
    })
    return false;
  }

  let conce = await asignaConsecutivo(4);
  let guarda = await guardaAjuste(productos, conce, 4);
  let imprie = await imprimeMovimiento(conce, 4);
  let cierra = await limpiaAjuste(conce, 4);
}

async function guardaAjuste(productos, numero, tipo) {
  let sesion = JSON.parse(localStorage.getItem("sesion"));
  let { user: { usuario }, } = sesion;
  let almacen = localStorage.getItem("almacenAju");
  let fecha = localStorage.getItem("fechaAj");
  let tipomov = localStorage.getItem("tipoMovimientoAju");
  let movimiento = localStorage.getItem("movimientoAju");
  if (!fecha) {
    fecha = document.querySelector("#fechaAju").value
  }
  parametros = {
    usuario,
    almacen,
    tipo,
    tipomov,
    movimiento,
    numero,
    fecha,
    productos,
  };


  $.ajax({
    url: "res/php/guardaProductoAju.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      return data;
    },
  });
}

async function limpiaAjuste(conce, tipo) {
  let movitext = "Ajuste";
  localStorage.removeItem("AjusteProductosLista");
  localStorage.removeItem("almacenAju");
  localStorage.removeItem("fechaAju");
  localStorage.removeItem("movimientoAju");
  localStorage.removeItem("tipoMovimientoAju");
  if (conce == 0) {
    (title = "Precaucion"),
      (text = `Movimiento de ${movitext} Cancelado`),
      (type = "warning");
  } else {
    (title = "Atencion"),
    (text = `${movitext} Nro ${conce} Realizada con Exito`),
    (type = "success");
  }
  swal(
    {
      title,
      text,
      type,
    },
    function () {
      $(location).attr("href", "ajustes");
    }
  );
}

function cancelaAjuste() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();

  localStorage.removeItem("AjusteProductosLista");
  localStorage.removeItem("almacenAju");
  localStorage.removeItem("fechaAju");
  localStorage.removeItem("movimientoAju");
  localStorage.removeItem("tipoMovimientoAju");

  $(location).attr("href", ruta + pagina);
}

function buscaTipoMovimiento() {
  movAju = $("#movimientoAju").val();
  movAju = movAju.trim();

  asignaLocalStorage("movimientoAju", movAju);
  $.ajax({
    url: "res/php/buscaTipoMovimiento.php",
    type: "POST",
    data: { movi: movAju },
    success: function (data) {
      $("#tipoMovimientoAju").val(data.trim());
      asignaLocalStorage("tipoMovimientoAju", data);
    },
  });
}

function agregaListaAjuste() {
  var alma = $("#almacenAju").val();
  var movi = $("#movimientoAju").val();
  var tipomovi = $("#tipoMovimientoAju").val();
  var fech = $("#fechaAju").val();
  if (alma == null || alma == "") {
    swal("Atencion", "Sin Almacen Asignado A Este Pedido", "warning");
    $("#proveedor").focus();
    return;
  }

  if (tipomovi == null || tipomovi == "") {
    swal(
      "Atencion",
      "Sin Tipo de Movimiento Asignado A Este Pedido",
      "warning"
    );
    $("#fecha").focus();
    return;
  }
  if (fech == null) {
    swal("Atencion", "Sin Fecha Asignado A Este Pedido", "warning");
    $("#fecha").focus();
    return;
  }

  var prod = $("#codigo").val();
  var unid = $("#unidad").val();
  var unidalm = $("#unidadalm").val();
  var desunid = $("#unidad option:selected").text();
  var unit = $("#unitario").val();
  var valp = $("#costo").val().replace(",", "");
  var cant = $("#cantidad").val();
  var desc = $("#descripcion").val();
  var subtot = parseFloat(valp);
  valp = parseFloat(valp);
  cant = parseInt(cant);

  valu = subtot;
  valu = redondeo(valu, 2);
  cant = redondeo(cant, 2);
  valp = redondeo(valp, 2);
  total = valu * cant;

  $("#total").val(total);
  $("#unitario").val(valu);
  $("#unidad").val(unid);
  $("#unidadcom").val(desunid);
  $("#unidadalm").val(unidalm);

  $("#tablaArticulos > tbody").append(`
  		<tr>
  			<td class='paddingCelda'>${prod}</td>
  			<td class='paddingCelda'>${desc}</td>
  			<td class='paddingCelda'>${desunid}</td>
  			<td class='paddingCelda' align='right'>${number_format(cant, 2)}</td>
  			<td class='paddingCelda' align='right'>${number_format(valu, 2)}</td>
  			<td class='paddingCelda' align='right'>${number_format(total, 2)}</td>
  			<td class='paddingCelda' align='center'>
  				<button id='${prod}' class='btn btn-danger btn-xs elimina_articulo' onclick='actualizaAjuste(this.id,this.parentNode.parentNode.rowIndex);'>
  				<i class='fa fa-times'></i></button>
				</td>
			</tr>
  	`);
  var dataProd = {
    almacen: $("#almacen").val(),
    tipomovi: $("#Movimiento").val(),
    movimi: $("#tipoMov").val(),
    provee: $("#centroCosto").val(),
    fecham: $("#fecha").val(),
    codigo: $("#codigo").val(),
    descripcion: $("#descripcion").val(),
    subtotal: $("#subtotal").val(),
    unit: $("#unitario").val(),
    desunid: $("#unidad option:selected").text(),
    total: $("#total").val(),
    producto: $("#producto").val(),
    unidad: $("#unidad").val(),
    unidadalm: $("#unidadalm").val(),
    cantidad: $("#cantidad").val(),
    costo: $("#costo").val(),
  };

  ajusteLista.push(dataProd);
  localStorage.setItem("AjusteProductosLista", JSON.stringify(ajusteLista));

  $("#producto").val("");
  resumenAjuste();
  cancelaAdd();
  $("#producto").focus();
}

function resumenAjuste() {
  var total = 0.0;
  var sutot = 0.0;
  var impue = 0.0;
  var produ = 0.0;
  var totales = 0.0;
  var imptos = 0.0;
  var cantis = 0.0;
  $("#tablaArticulos > tbody > tr").each(function () {
    var total = $(this).find("td").eq(5).html();
    var cantp = $(this).find("td").eq(3).html();
    total = parseFloat(total.replace(",", ""));
    cantp = parseFloat(cantp.replace(",", ""));
    totales = totales + total;
    cantis = cantis + cantp;
  });
  $("#net").val("$ " + number_format(totales, 2));
  $("#arts").val(number_format(cantis, 2));
  /* if (totales > 0) {
    $("#btn-procesa").prop("disabled", false);
    $("#btn-cancela").prop("disabled", false);
  } else {
    $("#btn-procesa").prop("disabled", true);
    $("#btn-cancela").prop("disabled", true);
  } */
}

function actualizaAjuste(codigo, regis) {
  document
    .getElementsByTagName("table")[0]
    .setAttribute("id", "tablaArticulos");
  document.getElementById("tablaArticulos").deleteRow(regis);
  borrar = regis - 1;
  ajusteLista.splice(borrar, 1);

  localStorage.setItem("AjusteProductosLista", JSON.stringify(ajusteLista));
  resumenAjuste();
}

function listaAjustes() {
  var alma = localStorage.getItem("almacenAju");
  var tipo = localStorage.getItem("movimientoAju");
  var movi = localStorage.getItem("tipoMovimientoAju");
  var fech = localStorage.getItem("fechaAju");
  if (alma != null) {
    $("#almacenAju").val(alma);
  }
  if (tipo != null) {
    $("#movimientoAju").val(tipo);
    $("#tipoMovimientoAju").val(movi);
  }
  if (fech != null) {
    $("#fechaAju").val(fech);
  }
  var storageList = localStorage.getItem("AjusteProductosLista");
  if (storageList == null) {
    ajusteLista = [];
  } else {
    ajusteLista = JSON.parse(storageList);
  }

  for (x = 0; x < ajusteLista.length; x++) {
    $("#tablaArticulos > tbody").append(`
	  	<tr>
	  		<td class='paddingCelda'>${ajusteLista[x]["codigo"]}</td>
	  		<td class='paddingCelda'>${ajusteLista[x]["descripcion"]}</td>
	  		<td class='paddingCelda'>${ajusteLista[x]["desunid"]}</td>
	  		<td class='paddingCelda' align='right'>${number_format(
      ajusteLista[x]["cantidad"],
      2
    )}</td>
	  		<td class='paddingCelda' align='right'>${number_format(
      ajusteLista[x]["unit"],
      2
    )}</td>
	  		<td class='paddingCelda' align='right'>${number_format(
      ajusteLista[x]["total"],
      2
    )}</td>
	  		<td class='paddingCelda' align='center'>
	  			<button id='${ajusteLista[x]["codigo"]}' 
	  				class='btn btn-danger btn-xs elimina_articulo' 
	  				onclick='actualizaAjuste(this.id,this.parentNode.parentNode.rowIndex);'>
	  			<i class='fa fa-times'></i></button>
  			</td>
			</tr>
	  	`);
  }
  resumenAjuste();
}

function btnMuestraProductos() {
  $("#myModalMostrarProductos").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var numero = button.data("numero");
    var tipo = button.data("tipo");
    var movimiento = button.data("movimiento");
    var descripcion = button.data("descripcion");
    var bodega = button.data("bodega");
    parametros = {
      numero,
      tipo,
      movimiento,
      descripcion,
      bodega,
    };
    var modal = $(this);
    modal
      .find(".modal-title")
      .html(
        "Ver Movimiento : " + descripcion + "<br> Movimiento Nro : " + numero
      );
    $.ajax({
      url: "res/php/getProductosMovimiento.php",
      type: "POST",
      data: parametros,
      success: function (data) {
        $("#productosMov").html(data);
      },
    });
  });
}

function actualizaTraslado(codigo, regis) {
  document
    .getElementsByTagName("table")[0]
    .setAttribute("id", "tablaArticulos");
  document.getElementById("tablaArticulos").deleteRow(regis);
  borrar = regis - 1;
  trasladoProductos.splice(borrar, 1);

  localStorage.setItem(
    "trasladoListaProductos",
    JSON.stringify(trasladoProductos)
  );
  resumenTraslado();
}

function cancelaTraslado() {
  $("#almacenTras").attr("disabled", false);
  $("#tipoMovEntr").attr("disabled", false);
  $("#proveedor").attr("disabled", false);
  $("#destinoTras").attr("disabled", false);
  $("#fechaTras").attr("disabled", false);
  $("#codigo").val("");
  $("#descripcion").val("");
  $("#producto").val("");
  $("#porc_impto").val("");
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

function resumenTraslado() {
  var total = 0.0;
  var sutot = 0.0;
  var impue = 0.0;
  var produ = 0.0;
  var totales = 0.0;
  var imptos = 0.0;
  var cantis = 0.0;
  $("#tablaArticulos > tbody > tr").each(function () {
    var impto = $(this).find("td").eq(4).html();
    var total = $(this).find("td").eq(5).html();
    var cantp = $(this).find("td").eq(3).html();
    impto = parseFloat(impto.replace(",", ""));
    total = parseFloat(total.replace(",", ""));
    cantp = parseFloat(cantp.replace(",", ""));

    totales = totales + total;
    imptos = imptos + impto;
    cantis = cantis + cantp;
  });
  $("#net").val("$ " + number_format(totales, 2));
  $("#imp").val("$ " + number_format(imptos, 2));
  $("#arts").val(number_format(cantis, 2));
  /* if (totales > 0) {
    $("#btn-procesa").prop("disabled", false);
    // $("#btn-cancela").prop("disabled", false);
  } else {
    $("#btn-procesa").prop("disabled", true);
    // $("#btn-cancela").prop("disabled", true);
  } */
}

function listaTraslados() {
  var sale = localStorage.getItem("tipoMovSale");
  var alma = localStorage.getItem("almacenTras");
  var entra = localStorage.getItem("tipoMovEntr");
  var desti = localStorage.getItem("destinoTras");
  var fech = localStorage.getItem("fechaTras");

  if (sale != null) {
    $("#tipoMovSale").val(sale);
  }
  if (alma != null) {
    $("#almacenTras").val(alma);
  }
  if (entra != null) {
    $("#tipoMovEntr").val(entra);
  }
  if (desti != null) {
    $("#destinoTras").val(desti);
  }
  if (fech != null) {
    $("#fechaTras").val(fech);
  }
  var storageList = localStorage.getItem("trasladoListaProductos");
  if (storageList == null) {
    trasladoProductos = [];
  } else {
    trasladoProductos = JSON.parse(storageList);
  }

  for (x = 0; x < trasladoProductos.length; x++) {
    $("#tablaArticulos > tbody").append(`
	  	<tr>
	  		<td class='paddingCelda'>${trasladoProductos[x]["codigo"]}</td>
	  		<td class='paddingCelda'>${trasladoProductos[x]["descripcion"]}</td>
	  		<td class='paddingCelda'>${trasladoProductos[x]["desunid"]}</td>
	  		<td class='paddingCelda' align='right'>${number_format(
      trasladoProductos[x]["cantidad"],
      2
    )}</td>
	  		<td class='paddingCelda' align='right'>${number_format(
      trasladoProductos[x]["unit"],
      2
    )}</td>
	  		<td class='paddingCelda' align='right'>${number_format(
      trasladoProductos[x]["total"],
      2
    )}</td>
	  		<td class='paddingCelda' align='center'>
	  			<button id='${trasladoProductos[x]["codigo"]}' 
	  				class='btn btn-danger btn-xs elimina_articulo' 
	  				onclick='actualizaTraslado(this.id,this.parentNode.parentNode.rowIndex);'>
	  			<i class='fa fa-times'></i></button>
  			</td>
			</tr>
	  	`);
  }
  resumenTraslado();
}

function agregaListaTraslado() {
  var alma = $("#almacen").val();
  var sale = $("#tipoMovSale").val();
  var entra = $("#tipoMovEntr").val();
  var desti = $("#destino").val();
  var fech = $("#fecha").val();

  if (sale == "") {
    swal(
      "Atencion",
      "Sin Tipo de Movimiento Asignado A Este Movimiento",
      "warning"
    );
    $("#tipoMovSale").focus();
    return;
  }
  if (entra == "") {
    swal(
      "Atencion",
      "Sin Tipo de Movimiento Asignado A Este Movimiento",
      "warning"
    );
    $("#tipoMovEntr").focus();
    return;
  }

  if (desti == "") {
    swal(
      "Atencion",
      "Sin Almacen Destino Asignado A Este Movimiento",
      "warning"
    );
    $("#tipoMov").focus();
    return;
  }
  if (alma == "") {
    swal("Atencion", "Sin Almacen Asignado A Este Movimiento", "warning");
    $("#almacen").focus();
    return;
  }
  if (fech == "") {
    alert("Sin Fecha Asignado A Este Movimiento ");
    $("#fecha").focus();
    return;
  }

  var prod = $("#codigo").val();
  var unid = $("#unidad").val();
  var unidalm = $("#unidadalm").val();
  var desunid = $("#unidad option:selected").text();
  var unit = $("#unitario").val();
  var valp = $("#costo").val().replace(",", "");
  var cant = $("#cantidad").val();
  var desc = $("#descripcion").val();
  var subtot = parseFloat(valp);
  valp = parseFloat(valp);
  cant = parseInt(cant);

  valu = subtot;
  valu = redondeo(valu, 2);
  cant = redondeo(cant, 2);
  valp = redondeo(valp, 2);
  total = valu * cant;

  $("#total").val(total);
  $("#unitario").val(valu);
  $("#unidad").val(unid);
  $("#unidadcom").val(desunid);
  $("#unidadalm").val(unidalm);

  $("#tablaArticulos > tbody").append(`
  	<tr>
  		<td class='paddingCelda'>${prod}</td>
  		<td class='paddingCelda'>${desc}</td>
  		<td class='paddingCelda'>${desunid}</td>
  		<td class='paddingCelda' align='right'>${number_format(cant, 2)}</td>
  		<td class='paddingCelda' align='right'>${number_format(valu, 2)}</td>
  		<td class='paddingCelda' align='right'>${number_format(total, 2)}</td>
  		<td class='paddingCelda' align='center'>
  			<button id='${prod}' 
  				class='btn btn-danger btn-xs elimina_articulo' 
  				onclick='actualizaTraslado(this.id,this.parentNode.parentNode.rowIndex);'>
  			<i class='fa fa-times'></i></button>
			</td>
		</tr>
  	`);
  var dataProd = {
    codigo: $("#codigo").val(),
    descripcion: $("#descripcion").val(),
    unit: $("#unitario").val(),
    desunid: $("#unidad option:selected").text(),
    total: $("#total").val(),
    producto: $("#producto").val(),
    unidad: $("#unidad").val(),
    unidadalm: $("#unidadalm").val(),
    cantidad: $("#cantidad").val(),
    costo: $("#costo").val(),
  };

  trasladoProductos.push(dataProd);
  localStorage.setItem(
    "trasladoListaProductos",
    JSON.stringify(trasladoProductos)
  );

  $("#producto").val("");
  resumenSalida();
  cancelaAdd();
  $("#producto").focus();
}

function asignaConsecutivoTraslado(tipo) {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  $.ajax({
    url: ruta + "res/php/getNumeroMovimiento.php",
    type: "POST",
    data: { tipo },
    success: function (data) {
      $("#numeroTraslado").val(parseInt(data));
    },
  });
}

function reImprimeMovimiento(numero, tipo) {
  var ruta = $("#rutaweb").val();

  parametros = {
    numero,
    tipo,
  };

  $.ajax({
    url: ruta + "res/php/reimprimeMovimiento.php",
    type: "POST",
    data: parametros,
    success: function (data) {
      imprimeMovimiento(data.trim(), 3);
    },
  });
}

async function procesaTraslado() {
  let sesion = JSON.parse(localStorage.getItem("sesion"));
  let { user: { usuario }, } = sesion;

  let pagina = $("#ubicacion").val();
  let ruta = $("#rutaweb").val();
  let almacen = localStorage.getItem("almacenTras");
  let movEntra = localStorage.getItem("tipoMovEntr");
  let movSale = localStorage.getItem("tipoMovSale");
  let destino = localStorage.getItem("destinoTras");
  let fecha = localStorage.getItem("fechaTras");
  if (!fecha) {
    fecha = document.querySelector('#fechaTras').value
  }

  var storageList = localStorage.getItem("trasladoListaProductos");
  productos = JSON.parse(storageList);
  if (!productos) {
    swal({
      title: 'Precaucion',
      text: 'Sin Productos Asociados al Traslado',
      type: 'warning'
    })
    return false;
  }
  let numero = await asignaConsecutivo(3);
  datos = {
    usuario,
    almacen,
    movEntra,
    movSale,
    destino,
    fecha,
    numero,
    productos,
  };


  let guarda = await guardaTraslado(datos)
  let imprie = await imprimeMovimiento(numero, 3);
  let limpia = await limpiaTraslado()
}

async function guardaTraslado(datos) {
  try {
    const resultado = await fetch("res/php/guardaProductoTras.php", {
      method: "POST",
      headers: {
        "Content-type": "application/json; charset=UTF-8",
      },
      body: JSON.stringify(datos),
    });
    const resp = await resultado.text();
    return parseInt(resp);
  } catch (error) {
    console.log(error);
  }
}

function cancelaSalida() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();

  localStorage.removeItem("salidaListaProductos");
  localStorage.removeItem("almacen");
  localStorage.removeItem("fecha");
  localStorage.removeItem("factura");
  localStorage.removeItem("tipoMov");
  localStorage.removeItem("centroCosto");

  $(location).attr("href", ruta + pagina);
}

function cancelaTraslado() {
  localStorage.removeItem("trasladoListaProductos");
  localStorage.removeItem("almacenTras");
  localStorage.removeItem("tipoMovEntr");
  localStorage.removeItem("tipoMovSale");
  localStorage.removeItem("destinoTras");
  localStorage.removeItem("fechaTras");
  $(location).attr("href", "traslados");
}

function buscaProductoSalida(codigo) {
  var ruta = $("#rutaweb").val();
  var prod = $("#producto").val();
  $.ajax({
    url: ruta + "res/php/buscaProductos.php",
    type: "POST",
    dataType: "json",
    data: { codigo: codigo },
    success: function (x) {
      $("#codigo").val(x.id_producto);
      $("#unidadalm").val(x.unidad_almacena);
      $("#unidad").val(x.unidad_almacena);
      $("#descripcion").val(x.nombre_producto);
      $("#cantidad").val(1);
      $("#costo").attr("disabled", false);
      $("#cantidad").attr("disabled", false);
      $("#costo").val(number_format(x.valor_promedio, 2));
    },
  });
}

function actualizaSalida(codigo, regis) {
  document
    .getElementsByTagName("table")[0]
    .setAttribute("id", "tablaArticulos");
  document.getElementById("tablaArticulos").deleteRow(regis);
  borrar = regis - 1;
  salidaProductos.splice(borrar, 1);

  localStorage.setItem("salidaListaProductos", JSON.stringify(salidaProductos));
  resumenSalida();
}

function resumenSalida() {
  var total = 0.0;
  var sutot = 0.0;
  var impue = 0.0;
  var produ = 0.0;
  var totales = 0.0;
  var imptos = 0.0;
  var cantis = 0.0;
  $("#tablaArticulos > tbody > tr").each(function () {
    var impto = $(this).find("td").eq(4).html();
    var total = $(this).find("td").eq(5).html();
    var cantp = $(this).find("td").eq(3).html();
    total = parseFloat(total.replace(",", ""));
    cantp = parseFloat(cantp.replace(",", ""));
    totales = totales + total;
    imptos = imptos + impto;
    cantis = cantis + cantp;
  });
  $("#net").val("$ " + number_format(totales, 2));
  $("#imp").val("$ " + number_format(imptos, 2));
  $("#arts").val(number_format(cantis, 2));
  if (totales > 0) {
    $("#btn-procesa").prop("disabled", false);
    $("#btn-cancela").prop("disabled", false);
  } else {
    $("#btn-procesa").prop("disabled", true);
    $("#btn-cancela").prop("disabled", true);
  }
}

function listaSalidas() {
  var alma = localStorage.getItem("almacen");
  var tipo = localStorage.getItem("tipoMov");
  var prov = localStorage.getItem("centroCosto");
  var fech = localStorage.getItem("fecha");

  if (alma != null) {
    $("#almacen").val(alma);
  }
  if (tipo != null) {
    $("#tipoMov").val(tipo);
  }
  if (prov != null) {
    $("#centroCosto").val(prov);
  }
  if (fech != null) {
    $("#fecha").val(fech);
  }
  var storageList = localStorage.getItem("salidaListaProductos");
  if (storageList == null) {
    salidaProductos = [];
  } else {
    salidaProductos = JSON.parse(storageList);
  }

  for (x = 0; x < salidaProductos.length; x++) {
    $("#tablaArticulos > tbody").append(`
	  	<tr>
	  		<td class='paddingCelda'>${salidaProductos[x]["codigo"]}</td>
	  		<td class='paddingCelda'>${salidaProductos[x]["descripcion"]}</td>
	  		<td class='paddingCelda'>${salidaProductos[x]["desunid"]}</td>
	  		<td class='paddingCelda' align='right'>${number_format(
      salidaProductos[x]["cantidad"],
      2
    )}</td>
	  		<td class='paddingCelda' align='right'>${number_format(
      salidaProductos[x]["unit"],
      2
    )}</td>
	  		<td class='paddingCelda' align='right'>${number_format(
      salidaProductos[x]["total"],
      2
    )}</td>
	  		<td class='paddingCelda' align='center'>
	  			<button id='${salidaProductos[x]["codigo"]}' 
	  				class='btn btn-danger btn-xs elimina_articulo' 
	  				onclick='actualizaSalida(this.id,this.parentNode.parentNode.rowIndex);'>
  				<i class='fa fa-times'></i></button>
				</td>
			</tr>
	  	`);
  }
  resumenSalida();
}

function agregaListaSalida() {
  var alma = $("#almacen").val();
  var tipomovi = $("#Movimiento").val();
  var movi = $("#tipoMov").val();
  var prov = $("#proveedor").val();
  var fech = $("#fecha").val();

  if (movi == "") {
    swal(
      "Atencion",
      "Sin Tipo de Movimiento Asignado A Este Movimiento",
      "warning"
    );
    $("#tipoMov").focus();
    return;
  }
  if (alma == "") {
    swal("Atencion", "Sin Almacen Asignado A Este Movimiento", "warning");
    $("#proveedor").focus();
    return;
  }
  if (fech == "") {
    swal("Atencion", "Sin Fecha Asignada A Este Movimiento", "warning");
    $("#fecha").focus();
    return;
  }

  var prod = $("#codigo").val();
  var unid = $("#unidad").val();
  var unidalm = $("#unidadalm").val();
  var desunid = $("#unidad option:selected").text();
  var unit = $("#unitario").val();
  var valp = $("#costo").val().replace(",", "");
  var cant = $("#cantidad").val();
  var desc = $("#descripcion").val();
  var subtot = parseFloat(valp);
  valp = parseFloat(valp);
  cant = parseInt(cant);

  valu = subtot;
  valu = redondeo(valu, 2);
  cant = redondeo(cant, 2);
  valp = redondeo(valp, 2);
  total = valu * cant;

  $("#total").val(total);
  $("#unitario").val(valu);
  $("#unidad").val(unid);
  $("#unidadcom").val(desunid);
  $("#unidadalm").val(unidalm);

  $("#tablaArticulos > tbody").append(`
  	<tr>
  		<td class='paddingCelda'>${prod}</td>
  		<td class='paddingCelda'>${desc}</td>
  		<td class='paddingCelda'>${desunid}</td>
  		<td class='paddingCelda' align='right'>${number_format(cant, 2)}</td>
  		<td class='paddingCelda' align='right'>${number_format(valu, 2)}</td>
  		<td class='paddingCelda' align='right'>${number_format(total, 2)}</td>
  		<td class='paddingCelda' align='center'>
  			<button id='${prod}' 
  				class='btn btn-danger btn-xs elimina_articulo' 
  				onclick='actualizaSalida(this.id,this.parentNode.parentNode.rowIndex);'>
				<i class='fa fa-times'></i></button>
			</td>
		</tr>
  	`);
  var dataProd = {
    almacen: $("#almacen").val(),
    tipomovi: $("#Movimiento").val(),
    movimi: $("#tipoMov").val(),
    provee: $("#centroCosto").val(),
    fecham: $("#fecha").val(),
    codigo: $("#codigo").val(),
    descripcion: $("#descripcion").val(),
    subtotal: $("#subtotal").val(),
    unit: $("#unitario").val(),
    desunid: $("#unidad option:selected").text(),
    total: $("#total").val(),
    producto: $("#producto").val(),
    unidad: $("#unidad").val(),
    unidadalm: $("#unidadalm").val(),
    cantidad: $("#cantidad").val(),
    costo: $("#costo").val(),
  };

  salidaProductos.push(dataProd);
  localStorage.setItem("salidaListaProductos", JSON.stringify(salidaProductos));

  $("#producto").val("");
  resumenSalida();
  cancelaAdd();
  $("#producto").focus();
}

function cierraSesion() {
  let sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario, usuario_id },
  } = sesion;

  $.ajax({
    url: "../../res/shared/salir.php",
    type: "POST",
    data: {
      usuario_id,
      usuario,
    },
    success: function () {
      localStorage.removeItem("sesion");
      localStorage.removeItem("oPos");
      $(location).attr("href", "/");
    },
  });
}

async function procesaSalida(tipo) {
  let sesion = JSON.parse(localStorage.getItem("sesion"));
  let {
    user: { usuario },
  } = sesion;
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();

  let conce = await asignaConsecutivo(tipo);
  let guarda = await guardaMovimiento(conce, tipo);
  let imprie = await imprimeMovimiento(conce, tipo);
  let cierra = await limpiaMovimiento(conce, tipo);
}

async function asignaConsecutivo(tipo) {
  try {
    const resultado = await fetch("res/php/getNumeroMovimiento.php", {
      method: "POST",
      headers: {
        "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
      },
      body: `tipo=${tipo}`,
    });
    const datos = await resultado.text();
    return parseInt(datos);
  } catch (error) {
    console.log(error);
  }
}

async function procesaEntrada(tipo) {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  let conce = await asignaConsecutivo(tipo);
  let guarda = await guardaMovimiento(conce, tipo);
  let imprie = await imprimeMovimiento(conce, tipo);
  let cierra = await limpiaMovimiento(conce, tipo);
}

async function guardaMovimiento(numeroMov, tipo) {
  let sesion = JSON.parse(localStorage.getItem("sesion"));
  let { user: { usuario }, } = sesion;
  let storageList;
  if (tipo == 1) {
    storageList = localStorage.getItem("LocalProductList");
  } else {
    storageList = localStorage.getItem("salidaListaProductos");
  }
  movimientos = JSON.parse(storageList);
  datos = {
    usuario,
    numeroMov,
    tipo,
    movimientos,
  };
  $.ajax({
    url: "res/php/guardaProductoMov.php",
    type: "POST",
    data: datos,
    success: function (data) {
      return data;
    },
  });
}

async function limpiaTraslado() {
  localStorage.removeItem("trasladoListaProductos");
  localStorage.removeItem("almacenTras");
  localStorage.removeItem("tipoMovEntr");
  localStorage.removeItem("tipoMovSale");
  localStorage.removeItem("destinoTras");
  localStorage.removeItem("fechaTras");

  swal({
    title: 'Atencion',
    text: 'Traslado Realizado con Ecito',
    type: 'success',
  },
    function () {
      $(location).attr("href", "traslados")
    }
  );
}

async function limpiaMovimiento(conce, tipo) {
  let movitext;
  if (tipo == 1) {
    localStorage.removeItem("LocalProductList");
    localStorage.removeItem("proveedor");
    localStorage.removeItem("tipoMovSale");
    movitext = "Entrada";
  } else {
    localStorage.removeItem("salidaListaProductos");
    localStorage.removeItem("centroCosto");
    localStorage.removeItem("almacen");
    localStorage.removeItem("fecha");
    localStorage.removeItem("tipoMov");
    movitext = "Salida";
  }
  localStorage.removeItem("almacen");
  localStorage.removeItem("fecha");
  localStorage.removeItem("factura");
  localStorage.removeItem("tipoMov");
  if (conce == 0) {
    (title = "Precaucion"),
      (text = `Movimiento de ${movitext} Cancelado`),
      (type = "warning");
  } else {
    (title = "Atencion"),
      (text = `${movitext} Nro ${conce} Realizada con Exito`),
      (type = "success");
  }
  swal({
    title,
    text,
    type,
  },
    function () {
      tipo == 1
        ? $(location).attr("href", "entradas")
        : $(location).attr("href", "salidas");
    }
  );
}

function guardaRegistro() { }

function actualizaEntrada(codigo, regis) {
  document
    .getElementsByTagName("table")[0]
    .setAttribute("id", "tablaArticulos");
  document.getElementById("tablaArticulos").deleteRow(regis);
  borrar = regis - 1;
  productList.splice(borrar, 1);

  localStorage.setItem("LocalProductList", JSON.stringify(productList));
  resumen();
}

async function agregaLista() {
  /* 
  
    // let dataDoc= document.querySelector("#dataDocu");
    let dataDoc = document.querySelector("#dataDocu");
    let dataPrd = document.querySelector("#dataProd");
  
    console.log(dataDoc);
    console.log(dataPrd);
  
    let moviEntr = new FormData(dataDoc)
    let moviProd = new FormData(dataPrd)
  
  
   */


  var alma = $("#almacen").val();
  var tipomovi = $("#Movimiento").val();
  var movi = $("#tipoMov").val();
  var prov = $("#proveedor").val();
  var fech = $("#fecha").val();
  var fact = $("#factura").val();
  var impu = $("#impuesto").val();

  if (movi == "") {
    swal(
      "Precaucion",
      "Sin Tipo de Movimiento Asignado A Este Movimiento ",
      "warning"
    );
    $("#tipoMov").focus();
    return;
  }
  if (prov == "") {
    swal("Precaucion", "Sin Proveedor Asignado A Este Movimiento ", "warning");
    $("#proveedor").focus();
    return;
  }
  if (fech == "") {
    swal("Precaucion", "Sin Fecha Asignada A Este Movimiento ", "warning");
    $("#fecha").focus();
    return;
  }
  if (fact == "") {
    swal(
      "Precaucion",
      "Sin Nuevo de Documento Asignado A Este Movimiento ",
      "warning"
    );
    $("#factura").focus();
    return;
  }
  if (impu == "") {
    swal("Precaucion", "Sin Impuesto Asignado A Este Movimiento ", "warning");
    $("#factura").focus();
    return;
  }

  var prod = $("#codigo").val();
  var unid = $("#unidad").val();
  var unidalm = $("#unidadalm").val();
  var desunid = $("#unidad option:selected").text();
  var unit = $("#unitario").val();
  var valp = $("#costo").val();
  var cant = $("#cantidad").val();
  var desc = $("#descripcion").val();
  var desimpu = $("#impuesto option:selected").text();
  var pori = $("#porcentajeImpto").val();
  var subtot = parseFloat(valp);
  valp = parseFloat(valp);
  pori = parseInt(pori);
  incl = 0;



  if ($("#incluido").is(":checked")) {
    incl = 1;
    porce = (100 + pori) / 100;
    subtot = redondeo(valp / ((100 + pori) / 100), 0);
    vali = redondeo(valp - subtot, 0);
  } else {
    vali = valp * (pori / 100);
    subtot = valp;
  }

  total = subtot + vali;
  valu = subtot / cant;
  valu = redondeo(valu, 2);
  vali = redondeo(vali, 2);
  cant = redondeo(cant, 2);
  valp = redondeo(valp, 2);

  $("#subtotal").val(subtot);
  $("#impto").val(vali);
  $("#total").val(total);
  $("#unitario").val(valu);
  $("#unidad").val(unid);
  $("#unidadcom").val(desunid);
  $("#unidadalm").val(unidalm);
  $("#codimpto").val(impu);
  $("#desimpto").val();
  $("#impuesto").val();

  $("#tablaArticulos > tbody").append(`
	  	<tr>
	  		<td class='paddingCelda'>${prod}</td>
	  		<td class='paddingCelda'>${desc}</td>
	  		<td class='paddingCelda' align='left'>${desunid}</td>
	  		<td class='paddingCelda' align='right'>${number_format(cant, 2)}</td>
	  		<td class='paddingCelda' align='right'>${number_format(valu, 2)}</td>
	  		<td class='paddingCelda' align='right'>${number_format(subtot, 2)}</td>
	  		<td class='paddingCelda' align='left'>${desimpu}</td>
	  		<td class='paddingCelda' align='right'>${number_format(vali, 2)}</td>
	  		<td class='paddingCelda' align='right'>${number_format(total, 2)}</td>
	  		<td class='paddingCelda' align='center'>
	  			<button id='${prod}' class='btn btn-danger btn-xs elimina_articulo' onclick='actualizaEntrada(this.id,this.parentNode.parentNode.rowIndex);'>
	  			<i class='fa fa-times'></i></button>
  			</td>
			</tr>
  	`);

  var dataProd = {
    almacen: $("#almacen").val(),
    tipomovi: $("#Movimiento").val(),
    movimi: $("#tipoMov").val(),
    provee: $("#proveedor").val(),
    fecham: $("#fecha").val(),
    factur: $("#factura").val(),
    codigo: $("#codigo").val(),
    descripcion: $("#descripcion").val(),
    subtotal: $("#subtotal").val(),
    unit: $("#unitario").val(),
    desunid: $("#unidad option:selected").text(),
    impto: $("#impto").val(),
    desimpto: $("#impuesto option:selected").text(),
    total: $("#total").val(),
    producto: $("#producto").val(),
    porcentajeImpto: $("#porcentajeImpto").val(),
    impuesto: $("#impuesto").val(),
    incluido: incl,
    unidad: $("#unidad").val(),
    unidadalm: $("#unidadalm").val(),
    cantidad: $("#cantidad").val(),
    costo: $("#costo").val(),
  };

  productList.push(dataProd);
  localStorage.setItem("LocalProductList", JSON.stringify(productList));

  $("#codigo").val("");
  resumen();
  cancelaAdd();
  $("#producto").focus();
}

function resumen() {
  var total = 0.0;
  var sutot = 0.0;
  var impue = 0.0;
  var produ = 0.0;
  var totales = 0.0;
  var imptos = 0.0;
  var cantis = 0.0;
  $("#tablaArticulos > tbody > tr").each(function () {
    var impto = $(this).find("td").eq(7).html();
    var total = $(this).find("td").eq(8).html();
    var cantp = $(this).find("td").eq(3).html();
    impto = parseFloat(impto.replace(",", ""));
    total = parseFloat(total.replace(",", ""));
    cantp = parseFloat(cantp.replace(",", ""));
    totales = totales + total;
    imptos = imptos + impto;
    cantis = cantis + cantp;
  });
  $("#net").val("$ " + number_format(totales, 2));
  $("#imp").val("$ " + number_format(imptos, 2));
  $("#arts").val(number_format(cantis, 2));
  if (totales > 0) {
    $("#btn-procesa").prop("disabled", false);
    $("#btn-cancela").prop("disabled", false);
  } else {
    $("#btn-procesa").prop("disabled", true);
    $("#btn-cancela").prop("disabled", true);
  }
}

async function cancelaEntrada(tipo) {
  let movitext;
  if (tipo == 1) {
    movitext = "Entrada";
  } else {
    movitext = "Salida";
  }
  swal(
    {
      title: `Cancelar ${movitext}`,
      text: `Esta Seguro que quiere Cancelar la ${movitext}`,
      type: "warning",
      showCancelButton: true,
      cancelButtonClass: "btn-warning",
      cancelButtonText: "Continuar ",
      confirmButtonClass: "btn-danger",
      confirmButtonText: `Si, Cancela la ${movitext} !`,
      closeOnConfirm: false,
    },
    async function () {
      sale = await limpiaMovimiento(0, tipo);
    }
  );
}

function cancelaAdd() {
  $("#almacen").attr("disabled", false);
  $("#tipoMov").attr("disabled", false);
  $("#proveedor").attr("disabled", false);
  $("#fecha").attr("disabled", false);
  $("#factura").attr("disabled", false);

  $("#codigo").val("");
  $("#descripcion").val("");
  $("#producto").val("");
  $("#porc_impto").val("");
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

function listaEntradas() {
  var alma = localStorage.getItem("almacen");
  var tipo = localStorage.getItem("tipoMov");
  var prov = localStorage.getItem("proveedor");
  var fech = localStorage.getItem("fecha");
  var fact = localStorage.getItem("factura");

  if (alma != null) {
    $("#almacen").val(alma);
  }
  if (tipo != null) {
    $("#tipoMov").val(tipo);
  }
  if (prov != null) {
    $("#proveedor").val(prov);
  }
  if (fech != null) {
    $("#fecha").val(fech);
  }
  if (fact != null) {
    $("#factura").val(fact);
  }
  var storageList = localStorage.getItem("LocalProductList");
  if (storageList == null) {
    productList = [];
  } else {
    productList = JSON.parse(storageList);
  }

  for (x = 0; x < productList.length; x++) {
    $("#tablaArticulos > tbody").append(`
	  		<tr>
	  			<td class='paddingCelda'>${productList[x]["codigo"]}</td>
	  			<td class='paddingCelda'>${productList[x]["descripcion"]}</td>
	  			<td class='paddingCelda' align='left'>${productList[x]["desunid"]}</td>
	  			<td class='paddingCelda' align='right'>${number_format(
      productList[x]["cantidad"],
      2
    )}</td>
	  			<td class='paddingCelda' align='right'>${number_format(
      productList[x]["unit"],
      2
    )}</td>
	  			<td class='paddingCelda' align='right'>${number_format(
      productList[x]["subtotal"],
      2
    )}</td>
	  			<td class='paddingCelda'>${productList[x]["desimpto"]}</td>
	  			<td class='paddingCelda' align='right'>${number_format(
      productList[x]["impto"],
      2
    )}</td>
	  			<td class='paddingCelda' align='right'>${number_format(
      productList[x]["total"],
      2
    )}</td>
	  			<td class='paddingCelda' align='center'>
	  				<button id='${productList[x]["codigo"]
      }' class='btn btn-danger btn-xs elimina_articulo' onclick='actualizaEntrada(this.id,this.parentNode.parentNode.rowIndex);'>
	  				<i class='fa fa-times'></i></button>
  				</td>
				</tr>
	  	`);
  }
  resumen();
}

function asignaLocalStorage(code, valor) {
  localStorage.setItem(code, valor);
}

function activa_botones_mov() {
  $("#btn-add-article").attr("disabled", false);
  $("#btn-cancel-article").attr("disabled", false);
}

function buscaImpto() {
  var ruta = $("#rutaweb").val();
  var impto = $("#impuesto").val();
  $.ajax({
    url: ruta + "res/php/buscaImpto.php",
    type: "POST",
    data: { impto: impto },
    success: function (x) {
      $("#porcentajeImpto").val($.trim(x));
    },
  });
}

function buscaProducto(codigo) {
  var ruta = $("#rutaweb").val();
  var prod = $("#producto").val();
  $.ajax({
    url: ruta + "res/php/buscaProductos.php",
    type: "POST",
    dataType: "json",
    data: { codigo },
    success: function (x) {
      console.log(x);
      $("#codigo").val(x.id_producto);
      $("#unidadalm").val(x.unidad_almacena);
      $("#unidad").val(x.unidad_compra);
      $("#descripcion").val(x.nombre_producto);
      $("#cantidad").val(0);
      $("#impuesto").val();
      $("#costo").attr("disabled", false);
      $("#cantidad").attr("disabled", false);
      $("#costo").val(x.valor_promedio);
    },
  });
}

function buscaUnidad(prod) {
  var ruta = $("#rutaweb").val();
  $.ajax({
    url: ruta + "res/php/buscaUnidad.php",
    type: "POST",
    dataType: "json",
    data: { codigo: prod },
    success: function (dato) {
      $("#unidad").val(dato);
    },
  });
}

function listaProductos() {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  $.ajax({
    url: ruta + "res/php/getProductos.php",
    type: "POST",
    beforeSend: function (objeto) {
      $("#datos_ajax").html(`
				<div align="center" style="padding:5px" class="alert alert-info">
					<h4>Ingresando Producto</h4>
				</div>
				`);
    },
    success: function (dato) {
      $("#tablaProductos").html(dato);
    },
  });
}

$(function () {
  var pagina = $("#ubicacion").val();
  var ruta = $("#rutaweb").val();
  $("#familia").on("change", function () {
    var codigo = $("#familia").val();
    $.ajax({
      type: "POST",
      url: ruta + "res/php/getGrupos.php",
      data: "codigo=" + codigo,
      success: function (data) {
        $("#grupos option").remove();
        $("#grupos").append(data);
      },
    });
    return false;
  });

  $("#grupos").on("change", function () {
    var codigo = $("#grupos").val();
    var url = ruta + "res/php/getSubGrupos.php";
    $.ajax({
      type: "POST",
      url: url,
      data: "codigo=" + codigo,
      success: function (data) {
        $("#subgrupo option").remove();
        $("#subgrupo").append(data);
      },
    });
    return false;
  });

  $("#paices").on("change", function () {
    var codigo = $("#paices").val();
    $.ajax({
      type: "POST",
      url: ruta + "res/php/getCiudades.php",
      data: "codigo=" + codigo,
      success: function (data) {
        $("#ciudad option").remove();
        $("#ciudad").append(data);
      },
    });
    return false;
  });
});

$(document).ready(function () {
  $("#myModalEstadoHotel").on("show.bs.modal", function (event) {
    // var button = $(event.relatedTarget);
    // var id = button.data("id");
    // var descri = button.data("descri");
    // var respon = button.data("respon");
    var modal = $(this);

    modal.find(".modal-title").text("Fecha de Estadia hotel");

    // $("#idCentroEli").val(id);
    // $("#nombreEli").val(descri);
    // $("#respoEli").val(respon);
  });
});
