	$(document).ready(function(){
		loadProductosMov(1);
	});

	function loadProductosMov(page){
		var parametros = {
			"action":"ajax",
			"page":page,
			"q": $("#q").val()
		};
		$("#loader").fadeIn('slow');
		$.ajax({
			data:parametros,
			url:'../code/code_productos_mov.php',
			type:'post',
			 beforeSend: function(objeto){
			 $('#loader').html('<img src="../../img/loader.gif"> Cargando...');
		  },
			success:function(data){
				$(".outer_div").html(data).fadeIn('slow');
				$('#loader').html('');
				
			}
		})
	}

  function agregar(id){
    var vcompra  = document.getElementById('vcompra_'+id).value;
    var cantidad = document.getElementById('cantidad_'+id).value;
    var producto = document.getElementById('producto_'+id).value;
    var codigo   = document.getElementById('codigo_'+id).value;

    //Inicia validacion
    if (isNaN(cantidad)){
      alert('Esto no es un numero');
      document.getElementById('cantidad_'+id).focus();
      return false;
    }
    if (isNaN(vcompra)){
      alert('Esto no es un numero');
      document.getElementById('vcompra_'+id).focus();
      return false;
    }
    //Fin validacion
    
    $.ajax({
      type: "POST",
      url: "../code/code_agregar_productos_mov.php",
      data: "id="+id+
      "&vcompra="+vcompra+
      "&producto="+producto+
      "&cantidad="+cantidad+
      "&codigo="+codigo,
      beforeSend: function(objeto){
        $("#resultados").html("Mensaje: Cargando...");
      },
      success: function(datos){
      $("#resultados").html(datos);
      }
    });
  }
		
	function eliminar(id){
		$.ajax({
      type: "GET",
      url: "../code/code_agregar_productos_mov.php",
      data: "id="+id,
			beforeSend: function(objeto){
				$("#resultados").html("Mensaje: Cargando...");
			  },
      success: function(datos){
				$("#resultados").html(datos);
				}
		});
	}

  function entradas(){
    $.ajax({
      type: "POST",
      url: "../code/code_agregar_productos_mov.php",
      data: "id="+id,
      beforeSend: function(objeto){
        $("#resultados").html("Mensaje: Cargando...");
        },
      success: function(datos){
        $("#resultados").html(datos);
        }
    });
  }

function GuardaEntrada(){
  //if ($('#TablaEntradas >tbody >tr').length == 0){
  //  alert ("Sin Productos en el Movimiento !!" );
  //  $("#proveedor").focus();
  //  return false;
  //}
  var tipomovi  = document.getElementById('tipomov').value;
  var fecha     = document.getElementById('fecha').value;
  var proveedor = document.getElementById('proveedor').value;
  var factura   = document.getElementById('factura').value;
  var bodega    = document.getElementById('bodega').value;
  var session   = document.getElementById('session').value;
  var tipo      = 1;

  if(bodega==""){
    alert ("Sin Bodega de Movimiento Asignada" );
     $("#bodega").focus();
     return false;
  }

  if(tipomovi==""){
    alert ("Tipo de Movimiento en Blanco" );
    $("#tipomovi").focus();
    return false;
  }

  if(fecha==""){
    alert ("Sin fecha Asignada al Movimiento" );
    $("#fecha").focus();
    return false;
  }

  if(proveedor==""){
    alert ("Sin Proveedor Asignado al Movimiento" );
    $("#proveedor").focus();
    return false;
  }

  if(factura==""){
    alert ("Sin Numero de Factura Asociado al Movimiento" );
    $("#factura").focus();
    return false;
  }


  $.ajax({
      type: "POST",
      url: "../code/code_nuevo_mov.php",
      data: "tipomovi="+tipomovi+
      "&fecha="+fecha+
      "&proveedor="+proveedor+
      "&bodega="+bodega+
      "&factura="+factura+
      "&tipo="+tipo+
      "&session="+session,
  });
  VentanaCentrada('factura_pdf.php?id_cliente='+id_cliente+'&id_vendedor='+id_vendedor+'&condiciones='+condiciones,'Factura','','1024','768','true');
}

function GuardaMovimiento(){
  var parametros = {
    "tipomovi":document.getElementById('tipomov').value,
    "fecha":document.getElementById('fecha').value,
    "proveedor":document.getElementById('proveedor').value,
    "factura":document.getElementById('factura').value,
    "bodega":document.getElementById('bodega').value,
    "session":document.getElementById('session').value,
    "productos":$('#TablaEntradas >tbody >tr').length,
    "tipo":1
      };
  $.ajax({
      data:parametros,
      url: "../code/code_nuevo_mov.php",
      type:'post',
      beforeSend: function(objeto){
        $("#resultados").html("Mensaje: Ingresando Movimientos ...");
        },
      success: function(datos){
        $("#resultados").html(datos);
        }
      });
  // VentanaCentrada('factura_pdf.php?id_cliente='+id_cliente+'&id_vendedor='+id_vendedor+'&condiciones='+condiciones,'Factura','','1024','768','true');
}

function AgregarEntradas(){

  var tipomovi  = document.getElementById('tipomovi').value;
  var fecha     = document.getElementById('fecha').value;
  var proveedor = document.getElementById('proveedor').value;
  var factura   = document.getElementById('factura').value;
  var bodega    = document.getElementById('bodega').value;
  var session   = document.getElementById('session').value;
  var productos = $('#TablaEntradas >tbody >tr').length;
  var tipo      = 1 ;

   $.ajax({
      data: "tipomovi="+tipomovi+"&fecha="+fecha+"&proveedor="+proveedor+"&factura="+factura+"&bodega="+bodega+"&session="+session+"&productos="+productos+"&tipo="+tipo,
      type: "POST",
      url: "../code/code_agregar_movimiento.php",
      data: parametros,
       beforeSend: function(objeto){
        $("#dresultados").html("Ingresando Movimiento ...");
        },
      success: function(datos){
      $("#resultados").html(datos);
      
      $('#dataRegisterProveedor').modal('hide');
      loadproveedor(1);
      }
  });
  event.preventDefault();
}


function VentanaCentrada(theURL,winName,features, myWidth, myHeight, isCenter) { //v3.0
  if(window.screen)if(isCenter)if(isCenter=="true"){
    var myLeft = (screen.width-myWidth)/2;
    var myTop = (screen.height-myHeight)/2;
    features+=(features!='')?',':'';
    features+=',left='+myLeft+',top='+myTop;
  }
  window.open(theURL,winName,features+((features!='')?',':'')+'width='+myWidth+',height='+myHeight);
}
