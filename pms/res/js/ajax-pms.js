
$('#myModalHistoricoFacturasCia').on('show.bs.modal', function (event) {
	var web     = $('#rutaweb').val();
	var pagina  = $('#ubicacion').val();
	var folio   = $("#folioActivo").val();
	var reserva = $("#reservaActual").val();
	var idcia   = $("#idcia").val();

	var button        = $(event.relatedTarget);
	var id            = button.data('id');
	var hues          = button.data('idhuesped');
	var apellidos     = button.data('apellidos');
	var nombres       = button.data('nombres');
	var nrohab        = button.data('nrohab');
	var modal         = $(this);

	var parametros = {
		'folio':folio, 
		'reserva':reserva, 
		'nrohab':nrohab 
	}

	if(folio==0){
		swal('Precaucion','Seleccione un Folio para realizar el Pago','warning');
		$('#myModalSalidaHuesped').modal('data-dismiss','modal');		
	}else{
		var saldo   = $("#total").val();
		var consumo = $("#consumo").val();
		var abonos  = $("#abonos").val();
		if(abonos=='0.00' && consumo == '0.00'){
			swal({
			  title: "Cuenta sin Consumos !",
			  text: "Esta Cuenta no Presenta Consumos, Desea Realizar la Salida ?",
			  type: "warning",
			  showCancelButton: true,
			  cancelButtonClass: "btn-warning",
			  cancelButtonText: "Cancelar Salida",
			  confirmButtonClass: "btn-danger",
			  confirmButtonText: "Si, Realizar Salida!",
			  closeOnConfirm: false
			},
			function(){
				$.ajax({
					type:"POST",
					url:web+'res/php/salidaSinPago.php',
					data: parametros,
					success:function(data){
						swal('Atencion','Salida del Huesped realizada con Exito','success',5000)
						$(location).attr('href','facturacion.php');  		
					}
				})  							
			});	
			$('#myModalSalidaHuesped').modal('data-dismiss','modal');		
			return 0 
		}

	  modal.find('.modal-title').text('Salida Huesped : '+apellidos+ " " +nombres)
	  modal.find('.modal-body #txtIdReservaSal').val(id)
	  modal.find('.modal-body #txtIdHuespedSal').val(hues)
	  modal.find('.modal-body #txtNumeroHabSal').val(nrohab)
	  modal.find('.modal-body #txtApellidosSal').val(apellidos)
	  modal.find('.modal-body #txtNombresSal').val(nombres)
	  modal.find('.modal-body #seleccionaCiaCon').val(idcia)

		$.ajax({
			type:"POST",
			url:web+'res/php/saldoCuenta.php',
			data: parametros,
			success:function(data){
				$("#estadoCuentaCon").html(data)	
			}
		})  	
	}
})


$('#myModalSalidaCongelada').on('show.bs.modal', function (event) {
	var web     = $('#rutaweb').val();
	var pagina  = $('#ubicacion').val();
	var folio   = $("#folioActivo").val();
	var reserva = $("#reservaActual").val();
	var idcia   = $("#idcia").val();

	var button        = $(event.relatedTarget);
	var id            = button.data('id');
	var hues          = button.data('idhuesped');
	var apellidos     = button.data('apellidos');
	var nombres       = button.data('nombres');
	var nrohab        = button.data('nrohab');
	var modal         = $(this);

	var parametros = {
		'folio':folio,
		'reserva':reserva, 
		'nrohab':nrohab 
	}

	if(folio==0){
		swal('Precaucion','Seleccione un Folio para realizar el Pago','warning');
		$('#myModalSalidaHuesped').modal('data-dismiss','modal');		
	}else{
		var saldo   = $("#total").val();
		var consumo = $("#consumo").val();
		var abonos  = $("#abonos").val();
		if(abonos=='0.00' && consumo == '0.00'){
			swal({
			  title: "Cuenta sin Consumos !",
			  text: "Esta Cuenta no Presenta Consumos, Desea Realizar la Salida ?",
			  type: "warning",
			  showCancelButton: true,
			  cancelButtonClass: "btn-warning",
			  cancelButtonText: "Cancelar Salida",
			  confirmButtonClass: "btn-danger",
			  confirmButtonText: "Si, Realizar Salida!",
			  closeOnConfirm: false
			},
			function(){
				$.ajax({
					type:"POST",
					url:web+'res/php/salidaSinPago.php',
					data: parametros,
					success:function(data){
						swal('Atencion','Salida del Huesped realizada con Exito','success',5000)
						$(location).attr('href','facturacion.php');  		
					}
				})  							
			});	
			$('#myModalSalidaHuesped').modal('data-dismiss','modal');		
			return 0 
		}

	  modal.find('.modal-title').text('Salida Huesped : '+apellidos+ " " +nombres)
	  modal.find('.modal-body #txtIdReservaSal').val(id)
	  modal.find('.modal-body #txtIdHuespedSal').val(hues)
	  modal.find('.modal-body #txtNumeroHabSal').val(nrohab)
	  modal.find('.modal-body #txtApellidosSal').val(apellidos)
	  modal.find('.modal-body #txtNombresSal').val(nombres)
	  modal.find('.modal-body #seleccionaCiaCon').val(idcia)

		$.ajax({
			type:"POST",
			url:web+'res/php/saldoCuenta.php',
			data: parametros,
			success:function(data){
				$("#estadoCuentaCon").html(data)	
			}
		})  	
	}
})

$('#myModalCongelarCuenta').on('show.bs.modal', function (event) {
	var web       = $('#rutaweb').val();
	var pagina    = $('#ubicacion').val();
	var folio     = $("#folioActivo").val();
	var reserva   = $("#reservaActual").val();
	var nrofolio1 = $("#nrofolio1").val();
	var nrofolio2 = $("#nrofolio2").val();
	var nrofolio3 = $("#nrofolio3").val();
	var nrofolio4 = $("#nrofolio4").val();
	var idcia     = $("#idcia").val()
	var empresa   = $("#empresa").val()
	var nit       = $("#nit").val()

	var button        = $(event.relatedTarget);
	var id            = button.data('id');
	var hues          = button.data('idhuesped');
	var apellidos     = button.data('apellidos');
	var nombres       = button.data('nombres');
	var nrohab        = button.data('nrohab');
	var modal         = $(this);

	var parametros = {
		'folio':folio,
		'reserva':reserva, 
		'nrohab':nrohab 
	}

	if(folio==0){
		swal('Precaucion','Seleccione un Folio para Realizar el Pago','warning');
		$('#myModalCongelarCuenta').modal('data-dismiss','modal');		
	}else{
		if(nrofolio2 != 0 || nrofolio3 != 0 || nrofolio4  != 0){
			swal('Precuacion','Otros Folios con Saldo, No Permitido Congelar la Presente Cuenta ','warning');
			$('#myModalCongelarCuenta').modal('data-dismiss','modal');		
		}else{			
			var saldo   = $("#total").val();
			var consumo = $("#consumo").val();
			var abonos  = $("#abonos").val();
			if(abonos=='0.00' && consumo == '0.00'){
				swal({
				  title: "Cuenta sin Consumos !",
				  text: "Esta Cuenta no Presenta Consumos, Desea Realizar la Salida ?",
				  type: "warning",
				  showCancelButton: true,
				  cancelButtonClass: "btn-warning",
				  cancelButtonText: "Cancelar Salida",
				  confirmButtonClass: "btn-danger",
				  confirmButtonText: "Si, Realizar Salida!",
				  closeOnConfirm: false
				},
				function(){
					$.ajax({
						type:"POST",
						url:web+'res/php/salidaSinPago.php',
						data: parametros,
						success:function(data){
							swal('Atencion','Salida del Huesped realizada con Exito','success',5000)
							$(location).attr('href','facturacion.php');  		
						}
					})  							
				});	
				$('#myModalSalidaHuesped').modal('data-dismiss','modal');		
				return 0 
			}

		  modal.find('.modal-title').text('Congelar Cuenta  : '+apellidos+ " " +nombres)
		  modal.find('.modal-body #txtIdCiaCong').val(idcia)
		  modal.find('.modal-body #txtEmpresaCong').val(empresa)
		  modal.find('.modal-body #txtNitCong').val(nit)
		  modal.find('.modal-body #txtIdReservaCong').val(id)
		  modal.find('.modal-body #txtIdHuespedCong').val(hues)
		  modal.find('.modal-body #txtNumeroHabCong').val(nrohab)
		  modal.find('.modal-body #txtApellidosCong').val(apellidos)
		  modal.find('.modal-body #txtNombresCong').val(nombres)
		  modal.find('.modal-body #valorSaldo').val(saldo)

			$.ajax({
				type:"POST",
				url:web+'res/php/saldoCuenta.php',
				data: parametros,
				success:function(data){
					$("#estadoCuenta").html(data)	
				}
			})  	
		}
	}
})


function activaCongelado(reserva,folio){
	var web        = $('#rutaweb').val();
	var pagina     = $('#ubicacion').val();
	if(folio==1){
		$("#folio1").hide().addClass("in active").slideDown('fast');
	}
	$("#folioActivo").val(folio);
	var parametros = {
		"reserva":reserva,
		"folio":folio
	}
	$.ajax({
    type: "POST", 
		url:web+'res/php/movimientoCongelado.php',
		data: parametros,
		success:function(data){
			$('.saldoFolioRoom'+folio).html(data);
		}
	})
}


function movimientosCongelada(reserva){
	var web        = $('#rutaweb').val();
	var pagina     = $('#ubicacion').val();
	var parametros = {"reserva":reserva}
	$.ajax({
    type: "POST",
		url:web+'res/php/saldoHabitacion.php',
		data: parametros,
		success:function(data){
			$(location).attr('href',web+'paginas/facturacionCongelada.php');  
		}
	})		
}

function congelaHuesped(){
	var web      = $('#rutaweb').val();
	var pagina   = $('#ubicacion').val();
	// var reserva  = $('#txtIdReservaCong').val();
	// var folioact = $('#folioActivo').val();
	var reserva   = $('#reservaActual').val();
	var idhues    = $('#idHuespedSal').val();
	var habi      = $('#nrohabitacion').val();
	var folio     = $('#folioActivo').val();
	var idcia     = $('#idcia').val();

	var parametros = {
		"room": habi,
		"folio":folio,
		"idhues": idhues,
		"reserva":reserva, 
		"idcia":idcia
	} 
	$.ajax({
		type:"POST",
		url:web+'res/php/ingresoCongela.php', 
		data: parametros,
		success:function(data){
			var ventana = window.open('../imprimir/imprimeCongelada.php', 'PRINT', 'height=600,width=600');
			swal('Atencion','Cuenta del Huesped Congelada con Exito','success',5000)
			$(location).attr('href','facturacion.php');  		
		}
	})  	
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
function verAuditoria(info){
	var fecha = $("#fechaaudi").val();
	var repo = info+fecha+'.pdf';
	$('#verFactura').attr('data','../imprimir/auditorias/'+repo);
}

function buscaAuditoriasFecha(){
	var web      = $('#rutaweb').val();
	var pagina   = $('#ubicacion').val();
	var fechaaudi = $("#buscarFecha").val();
	var parametros = {
		'fechaaudi':fechaaudi
	}
	$('#verFactura').attr('data','');
	$.ajax({
		url: web+'res/php/buscaAuditoriaFecha.php',
		type: 'POST',
		data: parametros,
		success: function(datos){
			$('#muestraResultado').html(datos)
		}
	});
}

function verfactura(fact){
	var factura = "Factura_"+fact+'.pdf';
	$('#verFactura').attr('data','../imprimir/facturas/'+factura);
}

function buscaFacturasFecha(){
	var web      = $('#rutaweb').val();
	var pagina   = $('#ubicacion').val();
	var fechafac = $("#buscarFecha").val();
	var parametros = {
		'fechafac':fechafac
	}
	$('#verFactura').attr('data','');
	$.ajax({
		url: web+'res/php/buscaFacturasFecha.php',
		type: 'POST',
		data: parametros, 
		success: function(datos){
			$('#muestraResultado').html(datos)
		}
	});
}

function guardaAcompanante(){
	var web      = $('#rutaweb').val();
	var idreser    = $('#idreservaAco').val();
	var parametros = $('#acompananteReserva').serialize();
 	$.ajax({
		type: "POST",
		data: parametros,
		url: web+'res/php/guardaAcompanante.php',
		success: function(datos){
			$('#mensajeEliAco').html(datos)			
			$('#myModalAdicionaAcompanante').modal('hide')
			$('#myModalAcompanantesReserva').modal('hide')
	  }
	});
}

$('#myModalAdicionaAcompanante').on('show.bs.modal', function (event) {
	$('#mensajeEli').html('')				
	var idrese = $("#idreservaAco").val()
	$("#nuevoPax").val(1)
	$("#identifica").val('')
	$("#tipodoc").val('')
	$("#apellidos").val('')
	$("#nombres").val('')
	$("#idReservaAdiAco").val(idrese)
  $('.alert').hide();
})

function buscaHuespedAcompanante(id){
	var web      = $('#rutaweb').val();
	var parametros = {
		'id':id
	}
	$.ajax({
		url: web+'res/php/buscaIdenAcompana.php', 
		type: 'POST',
		dataType: 'json',             
		data: parametros,
		success: function(datos){
			alert(datos)
			if(datos==0){
				$("#nuevoPax").val(1)
				$("#tipodoc").val('')
				$("#apellidos").val('')
				$("#nombres").val('')
				$('#fechanace').val('');
			}else{
				$("#nuevoPax").val(2)
				$("#idHuesAdi").val(datos[0]['id_huesped'])
				$("#tipodoc").val(datos[0]['tipo_identifica'])
				$("#apellidos").val(datos[0]['apellidos'])
				$("#nombres").val(datos[0]['nombres'])
				$("#sexOption").val(datos[0]['sexo'])
				$('#fechanace').val(datos[0]['fecha_nacimiento']);
				$('#paices').val(datos[0]['pais']);
				$('#ciudades').val(datos[0]['ciudad']);
			}
	  }		
	})
}

function eliminaAcompanante(id){
	var web      = $('#rutaweb').val();
	var parametros = {'id':id}
	$('#mensajeEli').css('display','none')	
	$.ajax({
		type: "POST",
		data: parametros,
		url: web+"res/php/eliminaAcompanante.php",
		success: function(datos){
			$('#mensajeEli').html(datos)
			$('#myModalAcompanantesReserva').modal('hide')
	  }		
	})
}

$('#myModalAcompanantesReserva').on('show.bs.modal', function (event) {
	$('#mensajeEli').html('');
	var button     = $(event.relatedTarget);
	var idres      = button.data('id');
	var apellidos  = button.data('apellidos');
	var nombres    = button.data('nombres');
	var modal      = $(this)
	var parametros = {
		'idres':idres
	}
  modal.find('.modal-title').text('Acompañantes : '+apellidos+ ' '+nombres)
  modal.find('.modal-body #idreservaAco').val(idres)
 	$.ajax({
		type: "POST",
		data: parametros,
		url: web+"res/php/dataBuscarAcompanantes.php",
		success: function(datos){
			$('#acompanantes').html(datos);
	  }
	});
  $('.alert').hide();
})

function trasladarConsumos(){
	var web      = $('#rutaweb').val();
	var idconsumo    =  $('#txtIdConsumoTras').val();
	var idreserva    =  $('#txtIdReservaTras').val();
	var idhuesped    =  $('#txtIdHuespedTras').val();
	var newreserva   =  $('#roomChange').val();
	var motivoTras   =  $('#txtMotivoTras').val();

	var parametros = {
		'idconsumo':idconsumo,
		'idreserva':idreserva,
		'idhuesped':idhuesped, 
		'motivotras':motivoTras, 
		'newreserva':newreserva
	}
	$.ajax({
		url: web+'res/php/trasladarCargo.php',
		type: 'POST',
		data: parametros,
		success: function(data){
			$('#mensajeAnu').html(data)
			$('#myModalMoverCargo').modal('hide')
			$(location).attr('href','facturacionHuesped.php');	
		}
	})
}

$('#myModalTrasladarCargo').on('show.bs.modal', function (event) {
	var button  = $(event.relatedTarget);
	var id      = button.data('id');
	var hues    = button.data('huesped');
	var descrip = button.data('descrip');
	var monto   = button.data('monto');
	var impto   = button.data('impto');
	var info    = button.data('info');
	var refer   = button.data('refer');
	var fecha   = button.data('fecha');
	var reserva = button.data('reserva');
	var huesped = button.data('huesped');
	var room    = button.data('room');
	var cant    = button.data('cant');
	var tipo    = button.data('tipo');
	var pagos   = button.data('pagos');

	if(tipo==3){
		$("#divPagos").css("display","block");
		$("#divCargos").css("display","none");
	}else{
		$("#divPagos").css("display","none");
		$("#divCargos").css("display","block");
	}

	var modal   = $(this)

	modal.find('.modal-title').text('Trasladar Cargo: '+descrip)
  modal.find('.modal-body #txtIdHuespedTras').val(huesped)
  modal.find('.modal-body #txtIdConsumoTras').val(id)
  modal.find('.modal-body #txtIdReservaTras').val(reserva)
  modal.find('.modal-body #txtNumeroHabTras').val(room)
  modal.find('.modal-body #txtDescripcionTras').val(descrip)
  modal.find('.modal-body #txtCantidadTras').val(cant)
  modal.find('.modal-body #txtValorConsumoTras').val(monto)
  modal.find('.modal-body #txtValorImptoTras').val(impto)
  modal.find('.modal-body #txtValorPagosTras').val(pagos)
  modal.find('.modal-body #txtReferenciaTras').val(refer)
  modal.find('.modal-body #txtDetalleCargoTras').val(info)
  $("#txtMotivoTras").focus();
});

function anulaSalida(){
	var web      = $('#rutaweb').val();
	var pagina = $('#ubicacion').val();
	var numero = $('#txtIdReservaAnu').val();
	var habita = $('#txtNumeroHabAnu').val();
	var parametros = {
		"numero":numero,
		"habita":habita,
	} 
	$.ajax({
		type:"POST",
		url:web+'res/php/anulaSalida.php',
		data: parametros,
		success:function(data){
			if(data==1){	
		    swal(
		      'Salida Anulada !',
		      'Su Estadia a sido activada de con Exito',
		      'success'
		    )
				$(location).attr('href',pagina); 
			}else if(data==-1){
	    	swal(
		      'Precaucion !',
		      'La Habitacion Presenta Saldo en la Cuenta no se pudo anular el Ingreso',
		      'warning'
		    )
			}else{
	    	swal(
		      'Precaucion !',
		      'Su Estadia no se pudo anular',
		      'warning'
		    )
			}
		}
	})  	
}

$('#myModalInformacionCompania').on('show.bs.modal', function (event) {
	var web       = $('#rutaweb').val();
	var button    = $(event.relatedTarget);
	var id        = button.data('idcia');
	var apellidos = button.data('apellidos');
	var nombres   = button.data('nombres');
	var modal     = $(this)
  modal.find('.modal-title').text('Informacion Huesped: '+apellidos+ " " +nombres)
  modal.find('.modal-body #txtApellidos').val(apellidos)
  modal.find('.modal-body #txtNombres').val(nombres)
  parametros = {
  	'idcia':id 
  }
  $.ajax({
  	url: web+'res/php/getDatosCia.php',
  	type: 'POST',
  	data: parametros,
		success:function(data){
			$('#datosCia').html(data);
		}
  })
})

function actualizaCiaRecepcion(){
	var web    = $('#rutaweb').val();
	var pagina = $('#ubicacion').val();
	var idhues = $("#txtIdHuespedCia").val();
	var idcia  = $("#seleccionaCia").val();
	var parametros = {
		'idcia':idcia,
		'idreserva':idhues
	}
	$.ajax({
		url: web+'res/php/updateCiaReserva.php',
		type: 'POST',
		data: parametros,
		success: function(datos){
			$(location).attr('href',web+'paginas/'+pagina);  							
		}
	})
}

function cierreCajero(user){
	var webPage = $("#webPage").val();
	var parametros = {
		'user': user,
		'page': webPage
	}
	$.ajax({
		url: webPage+'paginas/imprimeCierreCajero.php',
		type: 'POST',
		data: parametros,
		success: function(datos){
			$("#imprimeCierre").html(datos)
			swal('Atencion','Cajero Cerrado Con Exito','success');
			setTimeout($(location).attr('href','../../bases/salir.php/'), 5000);
	  }
	});
}

function apagaselecomp(tipo){
	if(tipo==2 ) {
		$('#selecomp').css('display','block')
	}else{
		$('#selecomp').css('display','none')
	}
}


$('#myModalAnularSalida').on('show.bs.modal', function (event) {
	var button        = $(event.relatedTarget);
	var id            = button.data('id');
	var hues          = button.data('idhuesped');
	var tipohab       = button.data('tipohab');
	var nrohab        = button.data('nrohab');
	var apellidos     = button.data('apellidos');
	var nombres       = button.data('nombres');
	var llegada       = button.data('llegada');
	var salida        = button.data('salida');
	var noches        = button.data('noches');
	var hombres       = button.data('hombres');
	var mujeres       = button.data('mujeres');
	var ninos         = button.data('ninos');
	var tarifa        = button.data('tarifa');
	var valor         = button.data('valor');
	var observaciones = button.data('observaciones');	
	var modal         = $(this)

  modal.find('.modal-title').text('Ingresar Huesped: '+apellidos+ " " +nombres)
  modal.find('.modal-body #txtIdReservaAnu').val(id)
  modal.find('.modal-body #txtIdHuespedAnu').val(hues)
  modal.find('.modal-body #txtTipoHabAnu').val(tipohab)
  modal.find('.modal-body #txtNumeroHabAnu').val(nrohab)
  modal.find('.modal-body #txtApellidosAnu').val(apellidos)
  modal.find('.modal-body #txtNombresAnu').val(nombres)
  modal.find('.modal-body #txtLlegadaAnu').val(llegada)
  modal.find('.modal-body #txtSalidaAnu').val(salida)
  modal.find('.modal-body #txtNochesAnu').val(noches)
  modal.find('.modal-body #txtHombresAnu').val(hombres)
  modal.find('.modal-body #txtMujeresAnu').val(mujeres)
  modal.find('.modal-body #txtNinosAnu').val(ninos)
  modal.find('.modal-body #areaComentariosAnu').val(observaciones)
  modal.find('.modal-body #txtTarifaAnu').val(tarifa)
  modal.find('.modal-body #txtValorTarifaAnu').val(valor)
  $('.alert').hide();
})

$('#myModalAnulaIngreso').on('show.bs.modal', function (event) {
	var button        = $(event.relatedTarget);
	var id            = button.data('id');
	var hues          = button.data('idhuesped');
	var tipohab       = button.data('tipohab');
	var nrohab        = button.data('nrohab');
	var apellidos     = button.data('apellidos');
	var nombres       = button.data('nombres');
	var llegada       = button.data('llegada');
	var salida        = button.data('salida');
	var noches        = button.data('noches');
	var hombres       = button.data('hombres');
	var mujeres       = button.data('mujeres');
	var ninos         = button.data('ninos');
	var tarifa        = button.data('tarifa');
	var valor         = button.data('valor');
	var observaciones = button.data('observaciones');	
	var modal         = $(this)

  modal.find('.modal-title').text('Ingresar Huesped: '+apellidos+ " " +nombres)
  modal.find('.modal-body #txtIdReservaAnu').val(id)
  modal.find('.modal-body #txtIdHuespedAnu').val(hues)
  modal.find('.modal-body #txtTipoHabAnu').val(tipohab)
  modal.find('.modal-body #txtNumeroHabAnu').val(nrohab)
  modal.find('.modal-body #txtApellidosAnu').val(apellidos)
  modal.find('.modal-body #txtNombresAnu').val(nombres)
  modal.find('.modal-body #txtLlegadaAnu').val(llegada)
  modal.find('.modal-body #txtSalidaAnu').val(salida)
  modal.find('.modal-body #txtNochesAnu').val(noches)
  modal.find('.modal-body #txtHombresAnu').val(hombres) 
  modal.find('.modal-body #txtMujeresAnu').val(mujeres)
  modal.find('.modal-body #txtNinosAnu').val(ninos)
  modal.find('.modal-body #areaComentariosAnu').val(observaciones)
  modal.find('.modal-body #txtTarifaAnu').val(tarifa)
  modal.find('.modal-body #txtValorTarifaAnu').val(valor)
  $('.alert').hide();
})

function anulaIngreso(){
	var pagina = $('#ubicacion').val();
	var numero = $('#txtIdReservaAnu').val();
	var habita = $('#txtNumeroHabAnu').val();
	var parametros = {
		"numero":numero,
		"habita":habita,
	} 
	$.ajax({
		type:"POST",
		url:'../res/php/anulaIngreso.php',
		data: parametros,
		success:function(data){
			if(data==1){	
		    swal(
		      'Estadia Anulada !',
		      'Su Estadia a Sido anulada con Exito',
		      'success'
		    )
				$(location).attr('href','../paginas/'+pagina); 
			}else if(data==-1){
	    	swal(
		      'Precaucion !',
		      'La Habitacion Presenta Saldo en la Cuenta no se pudo anular el Ingreso',
		      'warning'
		    )
			}else{
	    	swal(
		      'Precaucion !',
		      'Su Estadia no se pudo anular',
		      'warning'
		    )
			}
		}
	})  	
}

function seleccionaHuespedReserva(id){
	var web        = $('#rutaweb').val();
	var pagina     = $('#ubicacion').val();
	var parametros = {
		'id':id
	}
	$.ajax({
		url: web+'/res/php/seleccionaHuesped.php',
		type: 'POST',
		data: parametros,
		success:function(data){
			$('#datosHuesped').html(data);			
		}
	})
	$('#myModalBuscaHuesped').modal('hide');
}

$('#myModalBuscaHuesped').on('show.bs.modal', function (event) {
	var button     = $(event.relatedTarget);
	var modal      = $(this)
	var buscar     = $("#buscarHuesped").val();
	var parametros = {
		'buscar':buscar
	}
  modal.find('.modal-title').text('Buscar Huesped Por : '+buscar)
 	$.ajax({
		type: "POST",
		data: parametros,
		url: "../res/php/dataBuscarHuesped.php",
		success: function(datos){
			$('#huespedesEncontrados').html('');
			$('#huespedesEncontrados').html(datos);
	  }
	});
  $('.alert').hide();
})

function updateEstadia(){
	var web        = $('#rutaweb').val();
	var pagina     = $('#ubicacion').val();
	var parametros = $('#formUpdateEstadia').serialize();	

 	$.ajax({
		type: "POST",
		data: parametros,
		url: "../res/php/updateEstadia.php",
		success: function(datos){
			if(datos==1){
				$('#mensaje').html('<div class="alert alert-success"><h3 class="tituloPagina">Estadia Actualizada con Exito</h3></div>')
				$(location).attr('href','../paginas/'+pagina);  
			}else{
				$('#mensaje').html('<div class="alert alert-warning"><h3 class="tituloPagina">Precaucion <br> Estadia no Actualizada <br> Verifique los datos de la Estadia</h3></div>')
			}
	  }
	});
}

$('#myModalModificaEstadia').on('show.bs.modal', function (event) {
	var button     = $(event.relatedTarget);
	var id         = button.data('id');
	var apellidos  = button.data('apellidos');
	var nombres    = button.data('nombres');
	var modal         = $(this)
	var parametros = {
		'id':id
	}
  modal.find('.modal-title').text('Modifica Estadia : '+apellidos+' '+nombres)
 	$.ajax({
		type: "POST",
		data: parametros,
		url: "../res/php/dataUpdateEstadia.php",
		beforeSend: function(objeto){
		},
		success: function(datos){
			$('#modalReservasUpd').html('');
			$('#modalReservasUpd').html(datos);
	  }
	});
  $('.alert').hide();
})

function cierreDiario(){
	$("#botonCierre").attr('disabled','disabled');
	fecha      = $("#fechaAuditoria").html();
	parametros = {
		"fecha":fecha
	}
	$.ajax({
		url: '../auditoria/auditoriaNocturna.php',
		type: 'POST',
		data: parametros,
		beforeSend: function(){
			$('#aviso').html('<h4 class="bg-red" style="padding:10px"><img class="thumbnail" src="../../img/loader.gif" alt="" /><span style="font-size:24px;font-weight: 700;font-family: ubuntu">Procesando Informacion, No Interrumpa </span></h4>');
		},
		success: function(data){
			$('#aviso').html(data);
			// swal('Atencion','Auditoria Terminada con Exito','success');
			// $(location).attr('href','../index.php');	
		}
	})
} 

function moverConsumos(){
	var id    =  $('#txtIdConsumoMov').val();
	var folio = $('#txtFolioMov').val();
	var parametros = {
		'id':id,
		'folio':folio
	}
	$.ajax({
		url: '../res/php/moverCargo.php',
		type: 'POST',
		data: parametros,
		success: function(data){
			$('#mensajeAnu').html(data)
			$('#myModalMoverCargo').modal('hide')
			$(location).attr('href','facturacionHuesped.php');	
		}
	})
}

$('#myModalMoverCargo').on('show.bs.modal', function (event) {
	var button  = $(event.relatedTarget);
	var id      = button.data('id');
	var hues    = button.data('huesped');
	var descrip = button.data('descrip');
	var monto   = button.data('monto');
	var impto   = button.data('impto');
	var info    = button.data('info');
	var refer   = button.data('refer');
	var fecha   = button.data('fecha');
	var reserva = button.data('reserva');
	var huesped = button.data('huesped');
	var room    = button.data('room');
	var cant    = button.data('cant');
	
	var modal   = $(this)

	modal.find('.modal-title').text('Mover Cargo: '+descrip)
  modal.find('.modal-body #txtIdHuespedMov').val(huesped)
  modal.find('.modal-body #txtIdConsumoMov').val(id)
  modal.find('.modal-body #txtIdReservaMov').val(reserva)
  modal.find('.modal-body #txtNumeroHabMov').val(room)
  modal.find('.modal-body #txtDescripcionMov').val(descrip)
  modal.find('.modal-body #txtCantidadMov').val(cant)
  modal.find('.modal-body #txtValorConsumoMov').val(monto)
  modal.find('.modal-body #txtValorImptoMov').val(impto)
  modal.find('.modal-body #txtReferenciaMov').val(refer)
  modal.find('.modal-body #txtDetalleCargoMov').val(info)
  $("#txtMotivoAnula").focus();
});

$('#myModalEstadoCuenta').on('show.bs.modal', function (event) {
	var button        = $(event.relatedTarget);
	var id            = button.data('id');
	var hues          = button.data('idhuesped');
	var apellidos     = button.data('apellidos');
	var nombres       = button.data('nombres');
	var nrohab        = button.data('nrohab');
	var tipohab       = button.data('tipohab');
	var modal         = $(this)
	var parametros = {
		'reserva':id
	}

  modal.find('.modal-title').text('Estado de Cuenta : '+apellidos+ " " +nombres)
  modal.find('.modal-body #txtIdReservaEst').val(id)
  modal.find('.modal-body #txtIdHuespedEst').val(hues)
  modal.find('.modal-body #txtTipoHabEst').val(tipohab)
  modal.find('.modal-body #txtNumeroHabEst').val(nrohab)
  modal.find('.modal-body #txtApellidosEst').val(apellidos)
  modal.find('.modal-body #txtNombresEst').val(nombres)

	$.ajax({
		url: '../res/php/getEstadoCuentaReservaModal.php',
		type: 'POST',
		data: parametros,
		success:function(data){
			$("#divConsumos").html(data);
		}
	});		
})

$('#myModalSalidaHuesped').on('show.bs.modal', function (event) {
	var web     = $('#rutaweb').val();
	var pagina  = $('#ubicacion').val();
	var folio   = $("#folioActivo").val();
	var reserva = $("#reservaActual").val();

	var button        = $(event.relatedTarget);
	var id            = button.data('id');
	var hues          = button.data('idhuesped');
	var apellidos     = button.data('apellidos');
	var nombres       = button.data('nombres');
	var nrohab        = button.data('nrohab');
	var modal         = $(this);

	var parametros = {
		'folio':folio,
		'reserva':reserva, 
		'nrohab':nrohab 
	}

	if(folio==0){
		swal('Precaucion','Seleccione un Folio para realizar el Pago','warning');
		$('#myModalSalidaHuesped').modal('data-dismiss','modal');		
	}else{
		var saldo   = $("#total").val();
		var consumo = $("#consumo").val();
		var abonos  = $("#abonos").val();
		if(abonos=='0.00' && consumo == '0.00'){
			swal({
			  title: "Cuenta sin Consumos !",
			  text: "Esta Cuenta no Presenta Consumos, Desea Realizar la Salida ?",
			  type: "warning",
			  showCancelButton: true,
			  cancelButtonClass: "btn-warning",
			  cancelButtonText: "Cancelar Salida",
			  confirmButtonClass: "btn-danger",
			  confirmButtonText: "Si, Realizar Salida!",
			  closeOnConfirm: false
			},
			function(){
				$.ajax({
					type:"POST",
					url:web+'res/php/salidaSinPago.php',
					data: parametros,
					success:function(data){
						swal('Atencion','Salida del Huesped realizada con Exito','success',5000)
						$(location).attr('href','facturacion.php');  		
					}
				})  							
			});	
			$('#myModalSalidaHuesped').modal('data-dismiss','modal');		
			return 0 
		}

	  modal.find('.modal-title').text('Salida Huesped : '+apellidos+ " " +nombres)
	  modal.find('.modal-body #txtIdReservaSal').val(id)
	  modal.find('.modal-body #txtIdHuespedSal').val(hues)
	  modal.find('.modal-body #txtNumeroHabSal').val(nrohab)
	  modal.find('.modal-body #txtApellidosSal').val(apellidos)
	  modal.find('.modal-body #txtNombresSal').val(nombres)

		$.ajax({
			type:"POST",
			url:web+'res/php/saldoCuenta.php',
			data: parametros,
			success:function(data){
				$("#estadoCuenta").html(data)	
			}
		})  	
	}
})

function ingresaAjuste(){
	var web        = $('#rutaweb').val();
	var pagina     = $('#ubicacion').val();
	var codigo     = $('#codigoAjuste').val();
	var textcodigo = $('#codigoAjuste option:selected').text()
	var canti      = $('#txtCantidadAju').val();
	var valor      = $('#txtValorAjuste').val();
	var refer      = $('#txtReferenciaAju').val();
	var folio      = $('#txtFolioAju').val();
	var detalle    = $('#txtDetalleAjuste').val();
	var numero     = $('#txtIdReservaAju').val();
	var idhues     = $('#txtIdHuespedAju').val();
	var room       = $('#txtNumeroHabAju').val();
	var parametros = {
				"codigo": codigo,
				"textcodigo": textcodigo,
				"canti": canti,
				"valor": valor,
				"refer": refer,
				"folio": folio,
				"detalle": detalle,
				"numero": numero,
				"idhues": idhues,
				"room": room
			} 
	$.ajax({
		type:"POST",
		url:web+'res/php/ingresoConsumo.php',
		data: parametros,
		success:function(data){
			if(data==0){
				$("#mensaje").html('<div class="alert alert-warning"><h3>No se pudo ingresar el consumo</h3></div>')	
			}else{
				$("#mensaje").html('<div class="alert alert-warning"><h3>Ingreso Realizado con Exito</h3></div>')	
			}
			$(location).attr('href','../paginas/'+pagina); 
		}
	})  	
}

$('#myModalAjusteConsumo').on('show.bs.modal', function (event) {
	var button        = $(event.relatedTarget);
	var id            = button.data('id');
	var hues          = button.data('idhuesped');
	var apellidos     = button.data('apellidos');
	var nombres       = button.data('nombres');
	var nrohab        = button.data('nrohab');
	var modal         = $(this)

  modal.find('.modal-title').text('Ajustes : '+apellidos+ " " +nombres)
  modal.find('.modal-body #txtIdReservaAju').val(id)
  modal.find('.modal-body #txtIdHuespedAju').val(hues)
  modal.find('.modal-body #txtNumeroHabAju').val(nrohab)
  modal.find('.modal-body #txtApellidosAju').val(apellidos)
  modal.find('.modal-body #txtNombresAju').val(nombres)
  $("#codigoAjuste").focus();
  $('.alert').hide();
})

function cambiaTarifa(){
	var web       = $('#rutaweb').val();
	var pagina    = $('#ubicacion').val();
	var id        = $("#txtIdReservaTar").val()
	var tipoact   = $("#tarifaHabAct").val()
	var actualval = $("#valortarifaAct").val()
	var tiponue   = $("#tarifahab").val()
	var nuevoval  = $("#valortarifa").val()
	var motivo    = $("#motivoCambio").val()
	var mmto      = 0
	var motivo    = 0  
	var parametros = {
			"id":id,
			"tipoact":tipoact,
			"habiact":actualval,
			"tiponue":tiponue, 
			"habinue":nuevoval,
			"motivo":motivo,
			"mmto":mmto
	}
	$.ajax({
		url: '../res/php/cambiaTarifa.php',
		type: 'POST',
		data: parametros,
		success:function(data){
			$('#mensajeAct').html(data)
			// $(location).attr('href','../paginas/'+pagina);  			
		}
	});		
}

function valorHabitacionAct(tarifa){
	var tipo = $("#tipohabiAct").val();
	var hom  = $("#hombresAct").val();
	var muj  = $("#mujeresAct").val();
	var nin  = $("#ninosAct").val();
	var habi = $('#tipoocupacionAct').val();
	if((hom+muj)==0){
		$('#mensaje').html('<div class="alert alert-warning"><h3 class="tituloPagina">Sin Adultos Asignados a la Reserva</h3></div>')
		$("#hombres").focus();
	}else{
		$('#mensaje').html('')
		var parametros = {
			"tarifa":tarifa,
			"tipo": tipo,
			"hom": hom,
			"muj": muj,
			"nin": nin,
			"habi":habi
		};
		$.ajax({
			url: '../res/php/valorTarifa.php',
			type: 'POST',
			data: parametros,
			success:function(data){
				$("#valortarifas").html(data);
				$("#valortarifa").focus();
			}
		});		
	}
}

$('#myModalCambiaTarifa').on('show.bs.modal', function (event) {
	var button        = $(event.relatedTarget);
	var id            = button.data('id');
	var apellidos     = button.data('apellidos');
	var nombres       = button.data('nombres');
	var modal         = $(this)
	var parametros = {
		"id":id
	}

	modal.find('.modal-title').text('Informacion Estadia: '+apellidos+ " " +nombres)
  modal.find('.modal-body #txtIdReservaTar').val(id)
 	$.ajax({
		type: "POST",
		data: parametros,
		url: "../res/php/dataCambiarTarifa.php",
		beforeSend: function(objeto){
		},
		success: function(datos){
			$('#modalCambiarTarifa').html('');
			$('#modalCambiarTarifa').html(datos);

	  }
	});  $('.alert').hide();
})

function cambiaHabitacion(){
	var web        = $('#rutaweb').val();
	var pagina     = $('#ubicacion').val();
	$("input:radio:checked").each(function() {
    mmto = $(this).val();
  });
	var id      = $('#txtIdReservaCam').val();
	var tipoact = $('#txtTipoHabCam').val();
	var habiact = $('#txtNumeroHabCam').val();
	var tiponue = $('#tipohabi').val();
	var habinue = $('#nrohabitacion').val();
	var motivo  = $('#motivoCambio').val();

	var parametros = {
		"id":id,
		"tipoact":tipoact,
		"habiact":habiact,
		"tiponue":tiponue,
		"habinue":habinue,
		"motivo":motivo,
		"mmto":mmto
	}

	$.ajax({
		type:"POST",
		url:"../res/php/cambiaHabitacion.php",
		data:parametros,
		success:function(data){
			$('#mensaje').html(data)
			$(location).attr('href','../paginas/'+pagina);  			
		}
	})
}

$('#myModalCambiaHabitacion').on('show.bs.modal', function (event) {
	var button        = $(event.relatedTarget);
	var id            = button.data('id');
	var tipohab       = button.data('tipohab');
	var nrohab        = button.data('nrohab');
	var apellidos     = button.data('apellidos');
	var nombres       = button.data('nombres');
	var modal         = $(this)

	modal.find('.modal-title').text('Informacion Estadia: '+apellidos+ " " +nombres)
  modal.find('.modal-body #txtIdReservaCam').val(id)
  modal.find('.modal-body #txtTipoHabCam').val(tipohab)
  modal.find('.modal-body #txtNumeroHabCam').val(nrohab)
  modal.find('.modal-body #txtApellidosCam').val(apellidos)
  modal.find('.modal-body #txtNombresCam').val(nombres)
  $('.alert').hide();
})

function seleccionaTarifasUpd(){
	var tipo  = $("#tipohabi").val();
	var llega = $("#llegada").val();
	var sale  = $("#salida").val();
	var parametros = {"tipo":tipo,"llega":llega,"sale":sale};
	$.ajax({
    type: "POST",
		url:'../res/php/seleccionaTarifasUpd.php',
		data: parametros,
		beforeSend: function(objeto){
		},
		success:function(data){
			$("#tarifas").html(data);
		}
	})
}

function seleccionaHabitacionUpd(actual, anterior, numero){
	var parametros = {"tipo":actual,
										"anterior":anterior,
										"numero":numero
										};
	$.ajax({
    type: "POST",
		url:'../res/php/seleccionaHabitacionUpd.php',
		data: parametros,
		beforeSend: function(objeto){
		},
		success:function(data){
			$("#habitacionesUpd").html(data);
		}
	})
}

function updateReserva(){
	var web        = $('#rutaweb').val();
	var pagina     = $('#ubicacion').val();
	var parametros = $('#formUpdateReservas').serialize();	
 	$.ajax({
		type: "POST",
		data: parametros,
		url: "../res/php/updateReserva.php",
		success: function(datos){
			if(datos==1){
				$('#mensaje').html('<div class="alert alert-success" style="padding: 0 15px;"><h3 class="tituloPagina">Reserva Actualizada con Exito</h3></div>')
				$(location).attr('href','../paginas/'+pagina);  
			}else{
				$('#mensaje').html('<div class="alert alert-warning" style="padding: 0 15px;"><h3 class="tituloPagina">Precaucion <br> Reserva no Actualizada <br> Verifique los datos de la Reserva</h3></div>')
			}
	  }
	});
}

function valorHabitacionUpd(tarifa){
	var tipo = $("#tipohabi").val();
	var hom  = $("#hombres").val();
	var muj  = $("#mujeres").val();
	var nin  = $("#ninos").val();
	var habi = $('#tipoocupacion').val();
	var valtar  = $('#valortarifa').val();
	if((hom+muj)==0){
		$('#mensaje').html('<div class="alert alert-warning"><h3 class="tituloPagina">Sin Adultos Asignados a la Reserva</h3></div>')
		$("#hombres").focus();
	}else{
		$('#mensaje').html('')
		if(valtar=='0.00'){
			var parametros = {
				"tarifa":tarifa,
				"tipo": tipo,
				"hom": hom,
				"muj": muj,
				"nin": nin,
				"habi":habi
			};
			$.ajax({
				url: '../res/php/valorTarifa.php',
				type: 'POST',
				data: parametros,
				success:function(data){
					$("#valortarifas").html(data);
				}
			});		
		}
	}
}

$('#myModalModificaReserva').on('show.bs.modal', function (event) {
	var button     = $(event.relatedTarget);
	var id         = button.data('id');
	var apellidos  = button.data('apellidos');
	var nombres    = button.data('nombres');
	var modal         = $(this)
	var parametros = {
		'id':id
	}
  modal.find('.modal-title').text('Modifica Reserva Actual: '+apellidos+' '+nombres)
 	$.ajax({
		type: "POST",
		data: parametros,
		url: "../res/php/dataUpdateReserva.php",
		beforeSend: function(objeto){
		},
		success: function(datos){
			$('#modalReservasUpd').html('');
			$('#modalReservasUpd').html(datos);
	  }
	});
  $('.alert').hide();
})

$('#myModalHistoricoReservasCia').on('show.bs.modal', function (event) {
	var button     = $(event.relatedTarget);
	var id         = button.data('id');
	var empresa    = button.data('empresa');
	var nit        = button.data('nit');
	var parametros = {
		'id':id
	}
	var modal         = $(this)

  modal.find('.modal-title').text('Historico Reservas : '+empresa)
  modal.find('.modal-body #txtIdReservasCiaHis').val(id)

 	$.ajax({
		type: "POST",
		data: parametros,
		url: "../res/php/historicoReservasCia.php",
		beforeSend: function(objeto){
		},
		success: function(datos){
			$('#historicoReserva').html(datos);
	  }
	});
  $('.alert').hide();
})

$('#myModalReservasEsperadasCia').on('show.bs.modal', function (event) {
	var button     = $(event.relatedTarget);
	var id         = button.data('id');
	var empresa    = button.data('empresa');
	var nit        = button.data('nit');
	var parametros = {
		'id':id
	}
	var modal         = $(this)

  modal.find('.modal-title').text('Reservas Esperadas: '+empresa)
  modal.find('.modal-body #txtIdReservasCiaEsp').val(id)

 	$.ajax({
		type: "POST",
		data: parametros,
		url: "../res/php/reservasEsperadasCia.php",
		beforeSend: function(objeto){
		},
		success: function(datos){
			$('#reservasEsperadas').html(datos);
	  }
	});
  $('.alert').hide();
})

$('#myModalHuespedesCia').on('show.bs.modal', function (event) {
	var button     = $(event.relatedTarget);
	var id         = button.data('id');
	var empresa    = button.data('empresa');
	var nit        = button.data('nit');
	var parametros = {
		'id':id
	}
	var modal         = $(this)

  modal.find('.modal-title').text('Huespedes de la Compañia: '+empresa)
  modal.find('.modal-body #txtIdCiaUpd').val(id)

 	$.ajax({
		type: "POST",
		data: parametros,
		url: "../res/php/huespedesCia.php",
		beforeSend: function(objeto){
		},
		success: function(datos){
			$('#huespedesCia').html(datos);
	  }
	});
  $('.alert').hide();
})

$('#myModalContactosCia').on('show.bs.modal', function (event) {
	var button     = $(event.relatedTarget);
	var id         = button.data('id');
	var empresa    = button.data('empresa');
	var nit        = button.data('nit');
	var parametros = {
		'id':id
	}
	var modal         = $(this)

  modal.find('.modal-title').text('Contactos de la Compañia: '+empresa)
  modal.find('.modal-body #txtIdCiaUpd').val(id)

 	$.ajax({
		type: "POST",
		data: parametros,
		url: "../res/php/contactosCia.php",
		beforeSend: function(objeto){
		},
		success: function(datos){
			$('#contactosCia').html(datos);
	  }
	});
  $('.alert').hide();
})

function updateCompania(){
	var web        = $('#rutaweb').val();
	var pagina     = $('#ubicacion').val();
	var parametros = $("#formUpdateCompania").serialize();	
 	$.ajax({
		type: "POST",
		data: parametros,
		url: "../res/php/updateCompania.php",
		success: function(datos){
			$(location).attr('href',web+'paginas/'+pagina);  				
	  }
	});
}

$('#myModalModificaPerfilCia').on('show.bs.modal', function (event) {
	var button     = $(event.relatedTarget);
	var id         = button.data('id');
	var empresa    = button.data('empresa');
	var nit        = button.data('nit');
	var parametros = {
		'id':id
	}
	var modal         = $(this)

  modal.find('.modal-title').text('Modifica Perfil de la Compañia: '+empresa)
  modal.find('.modal-body #txtIdCiaUpd').val(id)

 	$.ajax({
		type: "POST",
		data: parametros,
		url: "../res/php/dataUpdateCia.php",
		beforeSend: function(objeto){
		},
		success: function(datos){
			$('#datosCia').html(datos);
	  }
	});
  $('.alert').hide();
})

function actualizaHuesped(){
	var web        = $('#rutaweb').val();
	var pagina     = $('#ubicacion').val();
	var parametros = $("#formUpdateHuesped").serialize();	
 	$.ajax({
		type: "POST",
		data: parametros,
		url: "../res/php/updateHuesped.php",
		success: function(datos){
			$(location).attr('href',web+'paginas/'+pagina);  				
	  }
	});
}

$('#myModalModificaPerfilHuesped').on('show.bs.modal', function (event) {
	var button        = $(event.relatedTarget);
	var id            = button.data('id');
	var apellido1     = button.data('apellido1');
	var apellido2     = button.data('apellido2');
	var nombre1       = button.data('nombre1');
	var nombre2       = button.data('nombre2');
	alert(id);
	var parametros = {
		'id':id
	}
	var modal         = $(this)

  modal.find('.modal-title').text('Modifica Perfil del Huesped: '+apellidos+ " " +nombres)
  modal.find('.modal-body #txtIdHuespedUpd').val(id)

 	$.ajax({
		type: "POST",
		data: parametros,
		url: "../res/php/dataUpdateHuesped.php",
		beforeSend: function(objeto){
		},
		success: function(datos){
			$('#datosHuesped').html(datos);
	  }
	});
  $('.alert').hide();
})

function actualizaCiaHuesped(){
	var web    = $('#rutaweb').val();
	var pagina = $('#ubicacion').val();
	var idhues = $("#txtIdHuespedCia").val();
	var idcia  = $("#seleccionaCia").val();
	var parametros = {
		'idcia':idcia,
		'idhues':idhues
	}
	$.ajax({
		url: '../res/php/updateCiaHuesped.php',
		type: 'POST',
		data: parametros,
		success: function(datos){
			$(location).attr('href',web+'paginas/'+pagina);  							
		}
	})
}

$('#myModalAsignarCompania').on('show.bs.modal', function (event) {
	var button     = $(event.relatedTarget);
	var id         = button.data('id');
	var idcia      = button.data('cia');
	var apellidos  = button.data('apellidos');
	var nombres    = button.data('nombres');
	var nombrecia  = button.data('nombrecia');
	var nitcia     = button.data('nitcia');
	var parametros = {
		'id':id
	}
	var modal      = $(this)
  modal.find('.modal-title').text('Asignar Compañia A: '+apellidos+ " " +nombres)
  modal.find('.modal-body #txtIdHuespedCia').val(id)
  modal.find('.modal-body #txtIdCia').val(idcia)

  if(idcia=='0'){
	  modal.find('.modal-body #txtNombreCia').val('Sin Compañia Asociada a la Estadia ')
	  modal.find('.modal-body #txtNitCia').val('2222.222')  	
  }else{	
	  modal.find('.modal-body #txtNombreCia').val(nombrecia)
	  modal.find('.modal-body #txtNitCia').val(nitcia)
  }

 	$.ajax({
		type: "POST",
		data: parametros,
		url: "../res/php/getSeleccionaCia.php",
		beforeSend: function(objeto){
		},
		success: function(datos){
			$('#nuevaCompania').html(datos);
	  }
	});
  $('.alert').hide();
})

$('#myModalReservasEsperadas').on('show.bs.modal', function (event) {
	var button        = $(event.relatedTarget);
	var id            = button.data('id');
	var apellidos     = button.data('apellidos');
	var nombres       = button.data('nombres');
	var parametros = {
		'id':id
	}
	var modal         = $(this)

  modal.find('.modal-title').text('Reservas Esperadas: '+apellidos+ " " +nombres)
  modal.find('.modal-body #txtIdHuespedAbo').val(id)

 	$.ajax({
		type: "POST",
		data: parametros,
		url: "../res/php/reservasEsperadas.php",
		beforeSend: function(objeto){
		},
		success: function(datos){
			$('#reservaEsperadas').html(datos);
	  }
	});
  $('.alert').hide();
})

$('#myModalHistoricoReservas').on('show.bs.modal', function (event) {
	var button        = $(event.relatedTarget);
	var id            = button.data('id');
	var apellidos     = button.data('apellidos');
	var nombres       = button.data('nombres');
	var parametros = {
		'id':id
	}
	var modal         = $(this)

  modal.find('.modal-title').text('Historico de Reservas: '+apellidos+ " " +nombres)
  modal.find('.modal-body #txtIdHuespedAbo').val(id)

 	$.ajax({
		type: "POST",
		data: parametros,
		url: "../res/php/historicoReservas.php",
		beforeSend: function(objeto){
		},
		success: function(datos){
			$('#historicoReserva').html(datos);
	  }
	});
  $('.alert').hide();
})

function imprimirRegistro(reserva){
	var web        = $('#rutaweb').val();
	var pagina     = $('#ubicacion').val();
	var parametros = {'reserva':reserva};
 	$.ajax({
		type: "POST",
		data: parametros,
		url: web+"paginas/imprimeRegistro.php",
		beforeSend: function(objeto){
	  },
		success: function(datos){
			$("#imprimeRegistroHotelero").html(datos)
			$(location).attr('href',web+'paginas/'+pagina);  						  
	  }
	});
}

function anulaConsumos(){
	var id      = $('#txtIdConsumoAnu').val();
	var motivo  = $('#txtMotivoAnula').val()
	var reserva = $('#txtIdReservaAnu').val()
	var parametros = {
		'id':id,
		'motivo':motivo
	}

	$.ajax({
		type: "POST",
		data: parametros,
		url: "../res/php/anulaConsumos.php",
		success: function(data){
			activaFolio(reserva,1);
			$('#mensajeCargo').html('<h3 style="font-weight:600;color:brown">Cargo Anulado Con Exito</h3>');
			$('#myModalAnulaCargo').modal('hide');
			$(location).attr('href',web+'facturacionHuesped.php');  				

		},
	});
};

function modificaReserva(reserva){
	var web        = $('#rutaweb').val();
	var pagina     = $('#ubicacion').val();
	var parametros = {"reserva":reserva}
 	$.ajax({
		type: "POST",
		data: parametros,
		url: web+"res/php/modificaReserva.php",
		beforeSend: function(objeto){
		},
		success: function(datos){
			$("#registroHotelero").html(datos)
			$(location).attr('href',web+pagina);  				
	  }
	});
}

$('#myModalAnulaCargo').on('show.bs.modal', function (event) {
	var button  = $(event.relatedTarget);
	var id      = button.data('id');
	var hues    = button.data('huesped');
	var descrip = button.data('descrip');
	var monto   = button.data('monto');
	var impto   = button.data('impto');
	var pagos   = button.data('pagos');
	var info    = button.data('info');
	var refer   = button.data('refer');
	var fecha   = button.data('fecha');
	var reserva = button.data('reserva');
	var huesped = button.data('huesped');
	var room    = button.data('room');
	var cant    = button.data('cant');
	var tipo    = button.data('tipo');
	var total   = monto + impto; 

	if(tipo==3){
		$("#divPagos").css("display","block")
		$("#divCargos").css("display","none")
	}else{
		$("#divPagos").css("display","none")
		$("#divCargos").css("display","block")
	}

	var modal   = $(this)

	modal.find('.modal-title').text('Anular Consumos: '+descrip)
  modal.find('.modal-body #txtIdHuespedAnu').val(huesped)
  modal.find('.modal-body #txtIdConsumoAnu').val(id)
  modal.find('.modal-body #txtIdReservaAnu').val(reserva)
  modal.find('.modal-body #txtNumeroHabAnu').val(room)
  modal.find('.modal-body #txtDescripcionAnu').val(descrip)
  modal.find('.modal-body #txtCantidadAnu').val(cant)
  modal.find('.modal-body #txtValorConsumoAnu').val(monto)
  modal.find('.modal-body #txtValorImptoAnu').val(impto)
  modal.find('.modal-body #txtValorTotalAnu').val(total)
  modal.find('.modal-body #txtPagoConsumoAnu').val(pagos)
  modal.find('.modal-body #txtReferenciaAnu').val(refer)
  modal.find('.modal-body #txtDetalleCargoAnu').val(info)
  modal.find('.modal-body #txtMotivoAnula').val('')

  $("#txtMotivoAnula").focus();
});

$("#formCargarHabitaciones").submit(function( event ) {
	var web        = $('#rutaweb').val();
	var pagina     = $('#ubicacion').val();
	$("input:radio:checked").each(function() {
    tipocargo = $(this).val();
  });
  var cargar     = $('#cargarHabitacion').val();
	var parametros = {
		'cargar':cargar,
		'cargo':tipocargo
	}
 	$.ajax({
		type: "POST", 
		data: parametros,
		url: "../res/php/cargarHabitaciones.php",
		beforeSend: function(objeto){
		},
		success: function(datos){
			if(datos==1){
				$('#aviso').html('<div class="alert alert-info" style="margin-bottom: 30px"><h4 align="center" style="color:brown;font-weight: 700">Habitaciones Cargadas con Exito</h4></div>');
			}else{
				$('#aviso').html(datos);
			}
	  }
	});
	event.preventDefault();
});	

function cambiaEstadoCargarHabitaciones(tipo){
	if(tipo==1){
		$('#habitacionesCasa').css('display','block');
	}else{
		$('#habitacionesCasa').css('display','none');
	}
}

function cargosHuesped(reserva){
	var web        = $('#rutaweb').val();
	var pagina     = $('#ubicacion').val();
	var parametros = {"reserva":reserva} 
	$.ajax({
    type: "POST",
		url:web+'res/php/movimientosCargosHuespedModal.php',
		data: parametros, 
		success:function(data){
			$('#myModalSaldoHuesped').modal('show');
			$('#saldoHuesped').html(data);
		}
	})	
}

function salidaHuesped(){
	var web      = $('#rutaweb').val();
	var pagina   = $('#ubicacion').val();
	/* var saldo = $('#saldoCuenta').val(); */
	var saldo    = $('#SaldoFolioActual').val();
	var pago     = $('#txtValorPago').val();
	var tipofac  = $('input[name=habitacionOption]:checked', '#guardarPagosRoom').val()
	if(pago < saldo){
		$('#mensajeSal').html('<h4 align="center" class="bg-red" style="padding:10px"><span style="font-size:24px;font-weight: 700;font-family: ubuntu">El Valor Ingresado es menor al Saldo<br>Ingrese este valor por Abonos a Cuenta</span></h4>');
		$("#cambio").css('display','hide');
		$("#cambio").html('');
	}else{
		$('#mensaje').html('');
		if(pago > saldo){
			cambio = pago-saldo
			pago   = saldo
			$("#cambio").css('display','block');
			$("#cambio").html('<label for="txtValorConsumo" class="col-sm-4 control-label">Cambio / Vueltas</label><div class="col-sm-6"><input style="font-size: 19px;font-weight: 600;color:brown" class="form-control padInput" type="number" readonly value="'+cambio+'"></div>');
		}
		var reserva   = $('#reservaActual').val();
		var idhues    = $('#idHuespedSal').val();
		var habi      = $('#txtNumeroHabSal').val();
		var formapago = $('#codigoPago').val();
		var textopago = $('#codigoPago option:selected').text()
		var refer     = $('#txtReferenciaPag').val();
		var folio     = $('#folioActivo').val();
		var idcia     = $('#seleccionaCia').val();

		var parametros = {
			"codigo": formapago,
			"textopago": textopago,
			"valor": pago,
			"refer": refer,
			"room": habi,
			"folio":folio,
			"idhues": idhues,
			"reserva":reserva, 
			"tipofac":tipofac,
			"idcia":idcia
		} 
		$.ajax({
			type:"POST",
			url:web+'res/php/ingresoPago.php', 
			data: parametros,
			success:function(data){
				var ventana = window.open('../imprimir/imprimeFactura.php', 'PRINT', 'height=600,width=600');
				if(data==-1){
					swal('Atencion','Salida del Huesped realizada con Exito','success',5000)
					$(location).attr('href','facturacion.php');  		
				}else{
					swal('Atencion','La Cuenta Actual Presenta Folios con Saldos','warning',5000);
					$('#myModalSalidaHuesped').modal('hide');
					$("#folios1").hide().removeClass("active").slideDown('fast');
					$("#folios2").hide().removeClass("active").slideDown('fast');
					$("#folios3").hide().removeClass("active").slideDown('fast');
					$("#folios4").hide().removeClass("active").slideDown('fast');
					$("#folio1").hide().removeClass("in active fade").slideDown('fast');
					$("#folio2").hide().removeClass("in active fade").slideDown('fast');
					$("#folio3").hide().removeClass("in active fade").slideDown('fast');
					$("#folio4").hide().removeClass("in active fade").slideDown('fast');
					$("#folio1").css("display","none")
					$("#folio2").css("display","none")
					$("#folio3").css("display","none")
					$("#folio4").css("display","none")
					$(data).hide().addClass("in active").slideDown('fast');
					if(data=='folios1'){
						$("#folio1").hide().addClass("in active").slideDown('fast')
						$("#folio1").css("display","block")
					}
					if(data=='folios2'){
						$("#folio2").hide().addClass("in active").slideDown('fast')
						$("#folio2").hide().css("display","block")
					}
					if(data=='folios3'){
						$("#folio3").hide().addClass("in active").slideDown('fast')
						$("#folio3").css("display","block")
					}
					if(data=='folios4'){
						$("#folio4").addClass("in active").slideDown('fast')
						$("#folio4").css("display","block")
					}
					$(data).click();
					$(location).attr('href','facturacionHuesped.php');  		
				}
			}
		})  	
	}
}

function saldoReserva(reserva){	
	parametros = {
		'reserva':reserva
	}
 	$.ajax({
		type: "POST",
		data: parametros,
		url: "../res/php/saldoReserva.php",
		success: function(saldo){
			$("#saldoActual").val(saldo)
	  }
	});	
}

function guardaAgencia(){
	var web        = $('#rutaweb').val();
	var pagina     = $('#ubicacion').val();
	var parametros = $("#formAgencia").serialize();	
 	$.ajax({
		type: "POST",
		data: parametros,
		url: "../res/php/ingresoAgencia.php",
		beforeSend: function(objeto){
		},
		success: function(datos){
			$(location).attr('href',web+'paginas/'+pagina);  				
	  }
	});
}

function buscaAgenciaActiva(iden){
	var parametros = {"iden":iden};
	$.ajax({
		type:"POST",
		url:'../res/php/buscaAgencia.php',
		data: parametros,
		success:function(data){
			if(data==1){
				swal("Identificacion ya registrada", "No Permitido Duplicar !", "warning");
				$('#nit').focus();
				$('#nit').val('');
			}
		}
	})
}

function ImprimeEstadoCuenta(reserva){
	var web        = $('#rutaweb').val();
	var pagina     = $('#ubicacion').val();
	var parametros = {'reserva':reserva};
 	$.ajax({
		type: "POST",
		data: parametros,
		url: web+"imprimir/imprimeEstadoCuenta.php",
		beforeSend: function(objeto){
			$("#factura").html("Mensaje: Cargando ...");
	  },
		success: function(datos){
	  }
	});
}

function estadoCuenta(reserva){
	var web        = $('#rutaweb').val();
	var pagina     = $('#ubicacion').val();
	var parametros = {"reserva":reserva}
	$.ajax({
    type: "POST",
		url:web+'res/php/saldoReserva.php',
		data: parametros,
		success:function(data){
			if(data==0){
				swal('Atencion','Sin Saldos en la Presente Cuenta','warning');
			}else{
				$(location).attr('href',web+'paginas/saldoHuesped.php');  
			}
		}
	})
}

function saldoTotal(reserva){
	var web        = $('#rutaweb').val();
	var pagina     = $('#ubicacion').val();
	var parametros = {"reserva":reserva}
	$.ajax({
    type: "POST",
		url:web+'res/php/movimientoReserva.php',
		data: parametros,
		success:function(data){
			$('#saldoReserva').html(data);
		}
	})	
}

function activaFolio(reserva,folio){
	var web        = $('#rutaweb').val();
	var pagina     = $('#ubicacion').val();
	if(folio==1){
		$("#folio1").hide().addClass("in active").slideDown('fast');
		$("#folio2").hide().removeClass("in active").slideDown('fast');
		$("#folio3").hide().removeClass("in active").slideDown('fast');
		$("#folio4").hide().removeClass("in active").slideDown('fast');
		$("#folio1").css('display','block');
		$("#folio2").css('display','none');
		$("#folio3").css('display','none');
		$("#folio4").css('display','none');
	}
	if(folio==2){
		$("#folio1").hide().removeClass("in active").slideDown('fast');
		$("#folio2").hide().addClass("in active").slideDown('fast');
		$("#folio3").hide().removeClass("in active").slideDown('fast');
		$("#folio4").hide().removeClass("in active").slideDown('fast');
		$("#folio1").css('display','none');
		$("#folio2").css('display','block');
		$("#folio3").css('display','none');
		$("#folio4").css('display','none');
	}
	if(folio==3){
		$("#folio1").hide().removeClass("in active").slideDown('fast');
		$("#folio2").hide().removeClass("in active").slideDown('fast');
		$("#folio3").hide().addClass("in active").slideDown('fast');
		$("#folio4").hide().removeClass("in active").slideDown('fast');
		$("#folio1").css('display','none');
		$("#folio2").css('display','none');
		$("#folio3").css('display','block');
		$("#folio4").css('display','none');
	}
	if(folio==4){
		$("#folio4").hide().addClass("in active").slideDown('fast');
		$("#folio1").hide().removeClass("in active").slideDown('fast');
		$("#folio2").hide().removeClass("in active").slideDown('fast');
		$("#folio3").hide().removeClass("in active").slideDown('fast');
		$("#folio1").css('display','none');
		$("#folio2").css('display','none');
		$("#folio3").css('display','none');
		$("#folio4").css('display','block');
	}
	$("#folioActivo").val(folio);
	var parametros = {
		"reserva":reserva,
		"folio":folio
	}
	$.ajax({
    type: "POST", 
		url:web+'res/php/movimientoFolio.php',
		data: parametros,
		success:function(data){
			$('.saldoFolioRoom'+folio).html(data);
		}
	})
}

function movimientosFactura(reserva){
	var web        = $('#rutaweb').val();
	var pagina     = $('#ubicacion').val();
	var parametros = {"reserva":reserva}
	$.ajax({
    type: "POST",
		url:web+'res/php/saldoHabitacion.php',
		data: parametros,
		success:function(data){
			$(location).attr('href',web+'paginas/facturacionHuesped.php');  
		}
	})		
}

function getCiudadesPais(pais) {
	var web        = $('#rutaweb').val();
	var pagina     = $('#ubicacion').val();
	var parametros = {"pais":pais};
	$("#loader").fadeIn('slow');
	$.ajax({
    type: "POST",
		url:web+'res/php/getCiudadesPais.php',
		data: parametros,
		success:function(data){
			if(data==0){
				swal('Precaucion','No existen Ciudades Creados para este Pais','warning');
			}else{
				$('#ciudad option').remove();
				$('#ciudad').append(data); 
			}
		}
	})
}

function guardasinReserva(){
	iden = $('#identifica').val();
	if(typeof iden == "undefined"){
		swal('Precaucion','Seleccione el Huesped a Reservar','warning');
		return ;
	}
	var web        = $('#rutaweb').val();
	var pagina     = $('#ubicacion').val();
	var parametros = $('#formReservas').serialize();	
 	$.ajax({
		type: "POST",
		data: parametros,
		url: "../res/php/ingresoSinReserva.php",
		beforeSend: function(objeto){
		},
		success: function(datos){
			swal('Atencion','Huesped Registrado Con Exito','success');
			$(location).attr('href',pagina);  
	  }
	});
}


function guardasinReservaxxx(){
	var web        = $('#rutaweb').val();
	var pagina     = $('#ubicacion').val();
	var parametros = $("#formReservas").serialize();	
 	$.ajax({
		type: "POST",
		data: parametros,
		url: "../res/php/ingresoSinReserva.php",
		beforeSend: function(objeto){
		},
		success: function(datos){
			$('#mensaje').html(datos);
			swal('Atencion','Huesped Registrado Con Exito','success');
			$(location).attr('href',pagina);  
	  }
	});
}

function restaFechas(){
	var web        = $('#rutaweb').val();
	var pagina     = $('#ubicacion').val();
	var fecha      = $('#llegada').val();
	var sale       = $('#salida').val();
	var parametros = {"fecha":fecha,"sale":sale}
	$.ajax({
    type: "POST",
		url:web+'res/php/restaFechas.php',
		data: parametros,
		success:function(data){
			$('#noches').val(data);
		}
	})	
}

function sumarDias(){
	var web        = $('#rutaweb').val();
	var pagina     = $('#ubicacion').val();
	var fecha      = $('#llegada').val();
	var dias       = $('#noches').val();
	var parametros = {"fecha":fecha,"dias":dias}
	$.ajax({
    type: "POST",
		url:web+'res/php/sumaFecha.php',
		data: parametros,
		success:function(data){
			$('#salida').val(data);
		}
	})	
}

function asignaHuesped(reserva){
	var web        = $('#rutaweb').val();
	var pagina     = $('#ubicacion').val();
	var textcodigo = $('#txtIdReservaCon option:selected').text()	;
	var parametros = {"reserva": reserva}
	$.ajax({
    type: "POST", 
		url:web+'res/php/buscaReservaHuespedCargos.php',
		data: parametros,
		success:function(data){
			$('#datosHuesped').html(data);
		}
	})
}

function ingresaAbonos(){
	var web        = $('#rutaweb').val();
	var pagina     = $('#ubicacion').val();
	var codigo     = $('#codigoAbono').val();
	var textcodigo = $('#codigoAbono option:selected').text()
	var valor      = $('#txtValorAbono').val();
	var refer      = $('#txtReferenciaAbo').val();
	var detalle    = $('#txtDetalleAbo').val();
	var numero     = $('#txtIdReservaAbo').val();
	var idhues     = $('#txtIdHuespedAbo').val();
	var room       = $('#txtNumeroHabAbo').val();
	var parametros = {
		"codigo": codigo,
		"textcodigo": textcodigo,
		"valor": valor,
		"refer": refer,
		"detalle": detalle,
		"numero": numero,
		"room": room,
		"idhues": idhues
	} 
	$.ajax({
		type:"POST",
		url:web+'res/php/ingresoAbonos.php',
		data: parametros,
		success:function(data){
			if(data==0){
		    swal(
		      'Precaucion !',
		      'No se pudo procesar el Abono',
		      'warning'
		    )
			}else {
				swal({
					title: "Abono Ingresado ",
					text: "Desea Imprimir el Comprobante",
					type: "info",
					showCancelButton: true,
					cancelButtonColor: "#A53333",
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Imprimir",
					cancelButtonText: "Salir",
					closeOnConfirm: false,
					closeOnCancel: false 
					},
					function(isConfirm){
						if (isConfirm) {
							swal("Imprimiendo",
							"Imprimiendo Comprobante de Consumo",
							"success",
							"15000");
							$(location).attr('href','../paginas/'+pagina);  
						} else {
							$(location).attr('href','../paginas/'+pagina);  
						}
					}
				);
			}
		}
	})  	
}

$('#myModalAbonosConsumos').on('show.bs.modal', function (event) {
	var button        = $(event.relatedTarget);
	var id            = button.data('id');
	var hues          = button.data('idhuesped');
	var apellidos     = button.data('apellidos');
	var nombres       = button.data('nombres');
	var nrohab        = button.data('nrohab');
	var modal         = $(this)

  modal.find('.modal-title').text('Abonos a Cuenta: '+apellidos+ " " +nombres)
  modal.find('.modal-body #txtIdReservaAbo').val(id)
  modal.find('.modal-body #txtIdHuespedAbo').val(hues)
  modal.find('.modal-body #txtNumeroHabAbo').val(nrohab)
  modal.find('.modal-body #txtApellidosAbo').val(apellidos)
  modal.find('.modal-body #txtNombresAbo').val(nombres)
  $("#codigoAbono").focus();
  $('.alert').hide();
}) 

function ingresaConsumos(){
	var web        = $('#rutaweb').val();
	var pagina     = $('#ubicacion').val();
	var codigo     = $('#codigoConsumo').val();
	var textcodigo = $('#codigoConsumo option:selected').text()
	var canti      = $('#txtCantidad').val();
	var valor      = $('#txtValorConsumo').val();
	var refer      = $('#txtReferencia').val();
	var folio      = $('#txtFolio').val();
	var detalle    = $('#txtDetalleCargo').val();
	var numero     = $('#txtIdReservaCon').val();
	var idhues     = $('#txtIdHuespedCon').val();
	var room       = $('#txtNumeroHabCon').val();
	var parametros = {
				"codigo": codigo,
				"textcodigo": textcodigo,
				"canti": canti,
				"valor": valor,
				"refer": refer,
				"folio": folio,
				"detalle": detalle,
				"numero": numero,
				"idhues": idhues,
				"room": room
			} 
	$.ajax({
		type:"POST",
		url:web+'res/php/ingresoConsumo.php',
		data: parametros,
		success:function(data){
			if(data==0){
				$("#mensaje").html('<div class="alert alert-warning"><h3>No se pudo ingresar el consumo</h3></div>')	
			}else{
				$("#mensaje").html('<div class="alert alert-warning"><h3>Ingreso Realizado con Exito</h3></div>')	
			}
			$(location).attr('href',web+'paginas/'+pagina); 
		}
	})  	
}

$('#myModalCargosConsumo').on('show.bs.modal', function (event) {
	var button        = $(event.relatedTarget);
	var id            = button.data('id');
	var hues          = button.data('idhuesped');
	var apellidos     = button.data('apellidos');
	var nombres       = button.data('nombres');
	var nrohab        = button.data('nrohab');
	var modal         = $(this)

  modal.find('.modal-title').text('Ingreso Consumos: '+apellidos+ " " +nombres)
  modal.find('.modal-body #txtIdReservaCon').val(id)
  modal.find('.modal-body #txtIdHuespedCon').val(hues)
  modal.find('.modal-body #txtNumeroHabCon').val(nrohab)
  modal.find('.modal-body #txtApellidosCon').val(apellidos)
  modal.find('.modal-body #txtNombresCon').val(nombres)
  $("#codigoConsumo").focus();
  $('.alert').hide();
})

function ingresaReserva(){
	var pagina = $('#ubicacion').val();
	var numero = $('#txtIdReservaIng').val();
	var habita = $('#txtNumeroHabIng').val();
	var parametros = {
		"numero":numero,
		"habita":habita
	}  
	$.ajax({
		type:"POST",
		url:'../res/php/ingresaReserva.php',
		data: parametros,
		success:function(data){
			if(data==1){	
		    swal(
		      'Reserva Ingresada !',
		      'Su Reserva a Sido ingresada con Exito',
		      'success'
		    )
			}else{
	    	swal(
		      'Precaucion !',
		      'Su Reserva no se pudo ingresar',
		      'warning'
		    )
			}
			$(location).attr('href','../paginas/'+pagina); 
		}
	})  	
}

function ingresaDeposito(){
	var web        = $('#rutaweb').val();
	var pagina     = $('#ubicacion').val();
	var forma      = $('#formadePago').val();
	var textforma  = $('#formadePago option:selected').text()
	var valor      = $('#txtValorDeposito').val();
	var detalle    = $('#txtDetalleDeposito').val();
	var numero     = $('#txtIdReservaDep').val();
	var idhues     = $('#txtIdHuespedDep').val();

	var parametros = {
		"forma": forma,
		"textforma": textforma,
		"valor": valor,
		"detalle": detalle,
		"numero": numero,
		"idhues": idhues,
		} 
	$.ajax({
		type:"POST",
		url:web+'res/php/ingresoDeposito.php',
		data: parametros,
		success:function(data){
			if(data==-1){
		    swal(
		      'Precaucion !',
		      'Su Deposito No Se Pudo Procesar, La Cuenta de Depositos No Se Encentra Activa en el Sistema',
		      'warning'
		    )
			}else {
				swal({
					title: "Deposito Nro "+data,
					text: "Desea Imprimir el Comprobante",
					type: "info",
					showCancelButton: true,
					cancelButtonColor: "#A53333",
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Imprimir",
					cancelButtonText: "Salir",
					closeOnConfirm: false,
					closeOnCancel: false 
					},
					function(isConfirm){
						if (isConfirm) {
							swal("Imprimiendo",
							"Imprimiendo Comprobante de Deposito",
							"success",
							"15000");
							$(location).attr('href','../paginas/'+pagina);  
						} else {
							$(location).attr('href','../paginas/'+pagina);  
						}
					}
				);
			}
		}
	})  	
}

$('#myModalDepositoReserva').on('show.bs.modal', function (event) {
	var button        = $(event.relatedTarget);
	var id            = button.data('id');
	var hues          = button.data('idhuesped');
	var tipohab       = button.data('tipohab');
	var nrohab        = button.data('nrohab');
	var apellidos     = button.data('apellidos');
	var nombres       = button.data('nombres');
	var llegada       = button.data('llegada');
	var salida        = button.data('salida');
	var noches        = button.data('noches');
	var hombres       = button.data('hombres');
	var mujeres       = button.data('mujeres');
	var ninos         = button.data('ninos');
	var tarifa        = button.data('tarifa');
	var valor         = button.data('valor');
	var modal         = $(this)

  modal.find('.modal-title').text('Deposito a Reserva: '+apellidos+ " " +nombres)
  modal.find('.modal-body #txtIdReservaDep').val(id)
  modal.find('.modal-body #txtIdHuespedDep').val(hues)
  modal.find('.modal-body #txtTipoHab').val(tipohab)
  modal.find('.modal-body #txtNumeroHab').val(nrohab)
  modal.find('.modal-body #txtApellidos').val(apellidos)
  modal.find('.modal-body #txtNombres').val(nombres)
  modal.find('.modal-body #txtLlegada').val(llegada)
  modal.find('.modal-body #txtSalida').val(salida)
  modal.find('.modal-body #txtNoches').val(noches)
  modal.find('.modal-body #txtHombres').val(hombres)
  modal.find('.modal-body #txtMujeres').val(mujeres)
  modal.find('.modal-body #txtNinos').val(ninos)
  modal.find('.modal-body #txtTarifa').val(tarifa)
  modal.find('.modal-body #txtValorTarifa').val(valor)
  $("#formadePago").focus();
  $('.alert').hide();
})

function cancelaReserva(){
	var pagina = $('#ubicacion').val();
	var motivo = $('#motivoCancela').val();
	var numero = $('#txtIdReservaCan').val();
	var parametros = {"motivo":motivo,"numero":numero} 
	$.ajax({
		type:"POST",
		url:'../res/php/cancelaReserva.php',
		data: parametros,
		success:function(data){
			if(data==1){	
		    swal(
		      'Reserva Cancelada !',
		      'Su Reserva a Sido cancelada con Exito',
		      'success'
		    )
			}else{
	    	swal(
		      'Precaucion !',
		      'Su Reserva no se pudo cancelar',
		      'warning'
		    )
			}
			$(location).attr('href','../paginas/'+pagina); 
		}
	})  	
}

$('#myModalCancelaReserva').on('show.bs.modal', function (event) {
	var button        = $(event.relatedTarget);
	var id            = button.data('id');
	var tipohab       = button.data('tipohab');
	var nrohab        = button.data('nrohab');
	var apellidos     = button.data('apellidos');
	var nombres       = button.data('nombres');
	var llegada       = button.data('llegada');
	var salida        = button.data('salida');
	var noches        = button.data('noches');
	var hombres       = button.data('hombres');
	var mujeres       = button.data('mujeres');
	var ninos         = button.data('ninos');
	var tarifa        = button.data('tarifa');
	var valor         = button.data('valor');
	var observaciones = button.data('observaciones');
	var modal         = $(this)

  modal.find('.modal-title').text('Cancelar Reserva: '+apellidos+ " " +nombres)
  modal.find('.modal-body #txtIdReservaCan').val(id)
  modal.find('.modal-body #txtTipoHab').val(tipohab)
  modal.find('.modal-body #txtNumeroHab').val(nrohab)
  modal.find('.modal-body #txtApellidos').val(apellidos)
  modal.find('.modal-body #txtNombres').val(nombres)
  modal.find('.modal-body #txtLlegada').val(llegada)
  modal.find('.modal-body #txtSalida').val(salida)
  modal.find('.modal-body #txtNoches').val(noches)
  modal.find('.modal-body #txtHombres').val(hombres)
  modal.find('.modal-body #txtMujeres').val(mujeres)
  modal.find('.modal-body #txtNinos').val(ninos)
  modal.find('.modal-body #areaComentariosCan').val(observaciones)
  modal.find('.modal-body #txtTarifa').val(tarifa)
  modal.find('.modal-body #txtValorTarifa').val(valor)
  $('.alert').hide();
})

$('#myModalInformacionReserva').on('show.bs.modal', function (event) {
	var button        = $(event.relatedTarget);
	var id            = button.data('id');
	var tipohab       = button.data('tipohab');
	var nrohab        = button.data('nrohab');
	var apellidos     = button.data('apellidos');
	var nombres       = button.data('nombres');
	var llegada       = button.data('llegada');
	var salida        = button.data('salida');
	var noches        = button.data('noches');
	var hombres       = button.data('hombres');
	var mujeres       = button.data('mujeres');
	var ninos         = button.data('ninos');
	var tarifa        = button.data('tarifa');
	var valor         = button.data('valor');
	var tipo          = button.data('tipo');
	var observaciones = button.data('observaciones');
	var modal         = $(this)

	if(tipo==1){
  	modal.find('.modal-title').text('Informacion Reserva: '+apellidos+ " " +nombres)
	}else{
  	modal.find('.modal-title').text('Informacion Estadia: '+apellidos+ " " +nombres)
	}
  modal.find('.modal-body #txtIdReservaInf').val(id)
  modal.find('.modal-body #txtTipoHabInf').val(tipohab)
  modal.find('.modal-body #txtNumeroHabInf').val(nrohab)
  modal.find('.modal-body #txtApellidosInf').val(apellidos)
  modal.find('.modal-body #txtNombresInf').val(nombres)
  modal.find('.modal-body #txtLlegadaInf').val(llegada)
  modal.find('.modal-body #txtSalidaInf').val(salida)
  modal.find('.modal-body #txtNochesInf').val(noches)
  modal.find('.modal-body #txtHombresInf').val(hombres)
  modal.find('.modal-body #txtMujeresInf').val(mujeres)
  modal.find('.modal-body #txtNinosInf').val(ninos)
  modal.find('.modal-body #areaComentariosInf').val(observaciones)
  modal.find('.modal-body #txtTarifaInf').val(tarifa)
  modal.find('.modal-body #txtValorTarifaInf').val(valor)
  $('.alert').hide();
})

$('#myModalInformacionHuesped').on('show.bs.modal', function (event) {
	var web       = $('#rutaweb').val();
	var button    = $(event.relatedTarget);
	var id        = button.data('id');
	var apellidos = button.data('apellidos');
	var nombres   = button.data('nombres');
	var modal     = $(this)

  modal.find('.modal-title').text('Informacion Huesped: '+apellidos+ " " +nombres)
  modal.find('.modal-body #txtApellidos').val(apellidos)
  modal.find('.modal-body #txtNombres').val(nombres)
  parametros = {
  	'id':id 
  }
  $.ajax({
  	url: web+'res/php/getHuespedReserva.php',
  	type: 'POST',
  	data: parametros,
		success:function(data){
			$('#datosHuesped').html(data);
		}
  })
})

$('#myModalIngresoReserva').on('show.bs.modal', function (event) {
	var button        = $(event.relatedTarget);
	var id            = button.data('id');
	var hues          = button.data('idhuesped');
	var tipohab       = button.data('tipohab');
	var nrohab        = button.data('nrohab');
	var apellidos     = button.data('apellidos');
	var nombres       = button.data('nombres');
	var llegada       = button.data('llegada');
	var salida        = button.data('salida');
	var noches        = button.data('noches');
	var hombres       = button.data('hombres');
	var mujeres       = button.data('mujeres');
	var ninos         = button.data('ninos');
	var tarifa        = button.data('tarifa');
	var valor         = button.data('valor');
	var observaciones = button.data('observaciones');	
	var modal         = $(this)

  modal.find('.modal-title').text('Ingresar Huesped: '+apellidos+ " " +nombres)
  modal.find('.modal-body #txtIdReservaIng').val(id)
  modal.find('.modal-body #txtIdHuesped').val(hues)
  modal.find('.modal-body #txtTipoHab').val(tipohab)
  modal.find('.modal-body #txtNumeroHabIng').val(nrohab)
  modal.find('.modal-body #txtApellidos').val(apellidos)
  modal.find('.modal-body #txtNombres').val(nombres)
  modal.find('.modal-body #txtLlegada').val(llegada)
  modal.find('.modal-body #txtSalida').val(salida)
  modal.find('.modal-body #txtNoches').val(noches)
  modal.find('.modal-body #txtHombres').val(hombres)
  modal.find('.modal-body #txtMujeres').val(mujeres)
  modal.find('.modal-body #txtNinos').val(ninos)
  modal.find('.modal-body #areaComentarios').val(observaciones)
  modal.find('.modal-body #txtTarifa').val(tarifa)
  modal.find('.modal-body #txtValorTarifa').val(valor)
  $('.alert').hide();
})

function buscaCompaniaActiva(iden){
	var parametros = {"iden":iden};
	$.ajax({
		type:"POST",
		url:'../res/php/buscaCompania.php',
		data: parametros,
		success:function(data){
			if(data==1){
				swal("Identificacion ya registrada", "No Permitido Duplicar !", "warning");
				$('#nit').focus();
				$('#nit').val('');
			}
		}
	})
}


function guardaCompania(){
	var web        = $('#rutaweb').val();
	var pagina     = $('#ubicacion').val();
	var parametros = $("#formCompania").serialize();	
 	$.ajax({
		type: "POST",
		data: parametros,
		url: "../res/php/ingresoCompania.php",
		beforeSend: function(objeto){
		},
		success: function(datos){
			$(location).attr('href','../paginas/'+pagina);  				
	  }
	});
}

function buscaHuespedActivo(iden){
	var parametros = {"iden":iden};
	$.ajax({
		type:"POST",
		url:'res/php/buscaHuesped.php',
		data: parametros,
		success:function(data){
			if(data==1){
				$('#identifica').val('');
				$('#identifica').focus();
				swal("Identificacion ya registrada", "No Permitido Duplicar !", "warning");
			}
		}
	})
}

function buscaHuesped(regis){
	var parametros = {"iden":regis};
	$.ajax({
    type: "POST",
		url:'../res/php/seleccionaHuesped.php',
		data: parametros,
		beforeSend: function(objeto){
		},
		success:function(data){
	    if(data==0){
				swal({
				  title: 'Error!',
				  text: 'Huesped No Encontrado',
				  type: 'error',
				  confirmButtonText: 'Aceptar'
				})
			}else{
				$("#datoshuesped").html(data);
			}
		} 
	})	
}

function seleccionaHabitacion(){
	var llega = $("#llegada").val();
	var sale  = $("#salida").val();
	var tipo  = $("#tipohabi").val();
	var parametros = {
		"llega":llega,
		"sale":sale,
		"tipo":tipo
	};
	$.ajax({
    type: "POST",
		url:'../res/php/seleccionaTipoHabitacion.php',
		data: parametros,
		beforeSend: function(objeto){
		},
		success:function(data){
			$("#habitaciones").html(data);
			$("#nrohabitacion").focus();
		}
	})
}

function seleccionaDormitorio(){
	var tipo = $("#tipohabi").val();
	var sexo = $("#sexo").val();
	var parametros = {"tipo":tipo};
	if(sexo== 1){
		hom = 1;
		muj = 0;
	}else{
		hom = 0;
		muj = 1;
	}
	$("#hombres").val(hom);
	$("#mujeres").val(muj);

	$.ajax({
    type: "POST",
		url:'../res/php/seleccionaDormitorio.php',
		data: parametros,
		beforeSend: function(objeto){
		},
		success:function(data){
			$("#habitaciones").html(data);
		}
	})
}

function selDormitorio(tipo){
	var sexo   = $("#sexo").val();
	var tarifa = $('tarifahab').val();
	if(tipo==2){
		$("#hombres").attr('readonly','readonly');
		$("#mujeres").attr('readonly','readonly');		
		$("#ninos").attr('readonly','readonly');		
	}else{
		$("#hombres").removeAttr('readonly','');
		$("#mujeres").removeAttr('readonly','');		
		$("#ninos").removeAttr('readonly','');		
	}
	if(sexo== 1){
		hom = 1;
		muj = 0;
	}else{
		hom = 0;
		muj = 1;
	}
	$("#hombres").val(hom);
	$("#mujeres").val(muj);
}

function selHabitacion(){
	hom = 0;
	muj = 0;
	$("#hombres").val(hom);
	$("#mujeres").val(muj);
}

function seleccionaTarifas(){
	var tipo  = $("#tipohabi").val();
	var llega = $("#llegada").val();
	var sale  = $("#salida").val();
	var parametros = {"tipo":tipo,"llega":llega,"sale":sale};
	$.ajax({
    type: "POST",
		url:'../res/php/seleccionaTarifas.php',
		data: parametros,
		beforeSend: function(objeto){
		},
		success:function(data){
			$("#tarifas").html(data);
			$("#tarifahab").focus();
			
		}
	})
}

function valorHabitacion(tarifa){
	var tipo = $("#tipohabi").val();
	var hom  = $("#hombres").val();
	var muj  = $("#mujeres").val();
	var nin  = $("#ninos").val();
	var habi = $('input[name=habitacionOption]:checked', '#formReservas').val()
	if(tipo=='CMA'){
		var parametros = {
			"tarifa":tarifa,
			"tipo": tipo,
			"hom": hom,
			"muj": muj,
			"nin": nin,
			"habi":habi
		};
		$.ajax({
			url: '../res/php/valorTarifa.php',
			type: 'POST',
			data: parametros,
			success:function(data){
				$("#valortarifas").html(data);
				$("#valortarifa").focus();
			}
		});		
	}else{
		if((hom+muj)==0){
			swal({
			  title: 'Error!',
			  text: 'Sin Adultos en esta Reserva',
			  type: 'error',
			  confirmButtonText: 'Aceptar'
			})
			$("#hombres").focus();
		}else{
			var parametros = {
				"tarifa":tarifa,
				"tipo": tipo,
				"hom": hom,
				"muj": muj,
				"nin": nin,
				"habi":habi
			};
			$.ajax({
				url: '../res/php/valorTarifa.php',
				type: 'POST',
				data: parametros,
				success:function(data){
					$("#valortarifas").html(data);
					$("#valortarifa").focus();
				}
			});		
		}		
	}
}

function guardaReserva(){
	iden = $('#identifica').val();
	if(typeof iden == "undefined"){
		swal('Precaucion','Seleccione el Huesped a Reservar','warning');
		return ;
	}
	var web        = $('#rutaweb').val();
	var pagina     = $('#ubicacion').val();
	var parametros = $('#formReservas').serialize();	
 	$.ajax({
		type: "POST",
		data: parametros,
		url: "../res/php/ingresoReserva.php",
		beforeSend: function(objeto){
		},
		success: function(datos){
			swal('Reserva Nro '+datos,'Reserva Creada con Exito','success')
			$(location).attr('href','../paginas/'+pagina);  
	  }
	});
}

function printMe(el){
	var objeto  = document.getElementById(el);  //obtenemos el objeto a imprimir
	var ventana = window.open('','_blank');  //abrimos una ventana vacía nueva
	objeto.style.marginRight  = "0";
	objeto.style.marginTop    = "0";
	objeto.style.marginLeft   = "0";
	objeto.style.marginBottom = "0";
	ventana.document.write(objeto.innerHTML);  //imprimimos el HTML del objeto en la nueva ventana

  ventana.document.close();  //cerramos el documento
  ventana.print();  //imprimimos la ventana
  ventana.close();  //cerramos la ventana
}

function imprimir_factura(id_factura){
	VentanaCentrada('./pdf/documentos/ver_factura.php?id_factura='+id_factura,'Factura','','1024','768','true');
}

function imprimirReserva(){
	VentanaCentrada('../../res/pdf/documentos/verReservas.php','Reservas Activas','','1024','768','true');
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

function cambiaEstadoCredito(id){
	if(id==1){
		$('#estadocredito').css('display','block')
	}else{
		$('#estadocredito').css('display','none')
	}
}

function  calcularDigitoVerificacion ()  {
	var myNit = $('#nit').val();
  var vpri, x, y, z;
  // Se limpia el Nit
  myNit = myNit.replace ( /\s/g, "" ) ; // Espacios
  myNit = myNit.replace ( /,/g,  "" ) ; // Comas
  myNit = myNit.replace ( /\./g, "" ) ; // Puntos
  myNit = myNit.replace ( /-/g,  "" ) ; // Guiones
  
  // Se valida el nit
  if  ( isNaN ( myNit ) )  {
    console.log ("El nit/cédula '" + myNit + "' no es válido(a).") ;
    return "" ;
  };
  
  // Procedimiento
  vpri = new Array(16) ; 
  z = myNit.length ;

  vpri[1]  =  3 ;
  vpri[2]  =  7 ;
  vpri[3]  = 13 ; 
  vpri[4]  = 17 ;
  vpri[5]  = 19 ;
  vpri[6]  = 23 ;
  vpri[7]  = 29 ;
  vpri[8]  = 37 ;
  vpri[9]  = 41 ;
  vpri[10] = 43 ;
  vpri[11] = 47 ;  
  vpri[12] = 53 ;  
  vpri[13] = 59 ; 
  vpri[14] = 67 ; 
  vpri[15] = 71 ;

  x = 0 ;
  y = 0 ;
  for  ( var i = 0; i < z; i++ )  { 
    y = ( myNit.substr (i, 1 ) ) ;
    // console.log ( y + "x" + vpri[z-i] + ":" ) ;

    x += ( y * vpri [z-i] ) ;
    // console.log ( x ) ;    
  }

  y = x % 11 ;
  // console.log ( y ) ;

  dig =  ( y > 1 ) ? 11 - y : y ;

  $('#dv').val(dig)
}
