function pone_almacenes(page){ 
	var parametros = {"action":"ajax","page":page};
	$("#loader").fadeIn('slow');
	$.ajax({
		url:'../code/pone_almacen_movimientos_ajustes.php',
		data: parametros,
		beforeSend: function(objeto){
		},
		success:function(data){
			$("#pone_almacen").html(data).fadeIn('slow');
		}
	})
}
 
function pone_producto(page){ 
	var parametros = {"action":"ajax","page":page};
	$("#loaderp").fadeIn('slow');
	$.ajax({
		url:'../code/pone_producto_ajuste.php',
		data: parametros,
		beforeSend: function(objeto){
		},
		success:function(data){
			$("#pone_producto").html(data).fadeIn('slow');
		}
	})
}


function busca_producto(codigo){
  $(document).ready(function(){
    $.ajax({
      beforeSend: function(){
      },
      url: '../code/busca_productos.php',
      type: 'POST',
      dataType: 'json',
      data: 'codigo='+$("#producto").val(),
      success: function(x){
				$("#codigo").val(x.cod_prod);
				$("#descripcion").val(x.nom_prod);
				$("#exis_anterior").val(x.exi_prod);
				$("#val_prome").val(x.ppo_prod);
				$("#unidad").val(x.uco_prod);
        $("#saldo_act").attr('disabled',false);
        $("#saldo_act").focus();

      }
    })
  })
}

function pone_unidad(page){ 
	var parametros = {"action":"ajax","page":page};
	$("#loader").fadeIn('slow');
	$.ajax({
		url:'../code/pone_unidad.php',
		data: parametros,
		beforeSend: function(objeto){
		},
		success:function(data){
			$("#pone_unidad").html(data).fadeIn('slow');
		}
	})
}

function verifica_tabla_existencia(){
  $('#tabla_articulos > tbody > tr').each(function(){
    var cod = $(this).find('td').eq(0).html();
    if($("#codigo").val()==cod){
      $("#"+cod).remove();
    }
  });
}


function agrega_a_lista(){
	var fech = $("#fecha").val();
	var alma = $("#almacen").val();

	if(fech==""){
		alert("Sin Fecha Asignado A Este Movimiento ");
		$("#fecha").focus();
		return;
	}

	if(alma==""){
		alert("Sin Almacen Asignado A Este Movimiento ");
		$("#almacen").focus();
		return;
	}

	$("#fecha").attr('disabled',true);
	$("#almacen").attr('disabled',true);

	var codi = $("#codigo").val();
	var desc = $("#descripcion").val();
	var unid = $("#unidad").val();
	var ante = $("#exis_anterior").val();
	var prom = $("#val_prome").val();
	var nuev = $("#saldo_act").val();
	var tipm = $("#tipo_movi").val();
	var tipo = $("#tipo").val();

	dife = nuev - ante ;
	valo = (dife * prom) ;

  $("#tabla_articulos > tbody").append("<tr id="+codi+"><td>"+codi+"</td><td>"+desc+"</td><td align='right'>"+ante+"</td><td align='right'>"+nuev+"</td><td align='right'>"+dife+"</td><td align='right'>"+valo+"</td><td align='right'>"+tipm+"</td><td align='center'><button id='"+codi+"' class='btn btn-danger btn-xs elimina_articulo' onclick='actualiza_entrada_temp(this.id);'><i class='fa fa-times'></i></button></td></tr>");
  /*graba la entrada temporalmente*/
  $.ajax({
    beforeSend: function(){
    },
    url: '../code/guarda_movimiento_temp.php',
    type: 'POST',
    data: "tipo="+tipo+"&tipo_movi="+$("#tipm").val()+
    "&fecha="+$("#fecha").val()+"&producto="+codi+
    "&cantidad="+dife+"&unidad="+unid+"&valortot="+valo+
    "&nombre="+desc+"&almacen="+alma,
    success: function(z){
      if(z=="0"){
        alert("No fue posible guardar el registro temporalmente, por favor consulte a soporte de inmediato...");
      }// 
    },
    error: function(jqXHR,estado,error){
    }
  });
  /*******************************************/
  // $("#btn-add-article").attr("disabled", false);
  $("#btn-procesa").attr('disabled',false);
  $("#btn-cancela").attr('disabled',false);
  $("#producto").val("");
  $("#codigo").val("");
  $("#saldo_act").val("0");
  $("#exis_anterior").val("0");
  resumen();
  apagadatos();
  $("#producto").select();		
}



function lista_salidas(){
	var codigo = $('#mov_entradas').val();
	var parametros = {"almacen":codigo};
	if(codigo==""){
    var n = noty({
      text: "Sin Almacen Seleccionado ",
      theme: 'relax',
      layout: 'center',
      type: 'information',
      modal: 'true',
      buttons     : [
	      {
	      	addClass: 'btn btn-danger btn-md',
	        text    : 'Aceptar',
	        onClick : function ($noty){
	        	$('#mov_entradas').focus();
	          $noty.close();
        	}
      	}
      ]
    });
    return;		
	}

	$("#loader").fadeIn('slow');
	$.ajax({
		url:'../code/code_lista_salidas.php',
		type: 'post',
		data: parametros,
		 beforeSend: function(objeto){
		$("#loader2").html("<img src='../../img/loader.gif'>");
		},
		success:function(data){
			$(".almacen").html(data).fadeIn('slow');
      $("#nuevo_mov").attr("disabled", false);
			$("#loader2").html("");
		}
	})
}



$('#ModalDetalleMovimiento').on('show.bs.modal', function (event) {
	var button  = $(event.relatedTarget) // Botón que activó el modal
	var numero  = button.data('numero') // Extraer la información de atributos de datos
	var almacen = button.data('almacen') // Extraer la información de atributos de datos
	var tipomov = button.data('tipmov') // Extraer la información de atributos de datos
	var tipo    = button.data('tipo') // Extraer la información de atributos de datos
	var action  = "ajax"
	var modal   = $(this)
  modal.find('.modal-title').text('Detalle Movimiento Numero: '+numero)
  $('.alert').hide();//Oculto alert
	$("#cargador").fadeIn('slow');
	$.ajax({
		type:'POST',
		url:'../code/code_cargar_movimientos.php',
		data:"bodega="+almacen+"&numero="+numero+"&action="+action+"&tipo="+tipo+"&tipomov="+tipomov,
		beforeSend: function(objeto){
			$('#cargador').html('<img src="../../img/loader.gif"> Cargando ...');
	  },
		success:function(data){
			$(".outer_div1").html(data).fadeIn('slow');
			$('#cargador').html('');
		}
	})
})		  

$('#ModalAnulaMovimiento').on('show.bs.modal', function (event) {
	var button  = $(event.relatedTarget) // Botón que activó el modal
	var numero  = button.data('numero') // Extraer la información de atributos de datos
	var almacen = button.data('almacen') // Extraer la información de atributos de datos
	var tipomov = button.data('tipmov') // Extraer la información de atributos de datos
	var tipo    = button.data('tipo') // Extraer la información de atributos de datos
	var modal   = $(this)

  modal.find('#numero').val(numero)
  modal.find('#almacen').val(almacen)
  modal.find('#tipo').val(tipo)
  modal.find('#tipomov').val(tipomov)
})		  

$( "#AnulaDatosMovimiento" ).submit(function( event ) {
var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "../code/code_anula_movimiento.php",
			data: parametros,
			beforeSend: function(objeto){
				$(".datos_ajax_delete").html("Anulando Movimiento ...");
			},
			success: function(datos){
				$(".datos_ajax_delete").html(datos);
				$('#ModalAnulaMovimiento').modal('hide');
				lista_entradas()
		  }
	});
  event.preventDefault();
});

function pone_tipo_movimiento(page){ 
	var parametros = {"action":"ajax","page":page};
	$("#loader").fadeIn('slow');
	$.ajax({
		url:'../code/pone_tipo_movimiento_ajustes.php',
		data: parametros,
		beforeSend: function(objeto){
		},
		success:function(data){
			$("#pone_tipo_movi").html(data).fadeIn('slow');
			$("#pone_tipo_movi").attr('disabled',true);
		}
	})
}

function pone_proveedor(page){ 
	var parametros = {"action":"ajax","page":page};
	$("#loader").fadeIn('slow');
	$.ajax({
		url:'../code/pone_proveedor.php',
		data: parametros,
		beforeSend: function(objeto){
			$("#loader").html("<img src='../../img/loader.gif'>");
		},
		success:function(data){
			$("#pone_proveedor").html(data).fadeIn('slow');
			$("#loader").html("");
		}
	})
}

function pone_almacen(page){ 
	var parametros = {"action":"ajax","page":page};
	$("#loader").fadeIn('slow');
	$.ajax({
		url:'../code/pone_almacenes.php',
		data: parametros,
		beforeSend: function(objeto){
		},
		success:function(data){
			$(".pone_almacen").html(data).fadeIn('slow');
		}
	})
}

function pone_impuesto(page){ 
	var parametros = {"action":"ajax","page":page};
	$("#loader").fadeIn('slow');
	$.ajax({
		url:'../code/pone_impuesto.php',
		data: parametros,
		beforeSend: function(objeto){
		$("#loader").html("<img src='../../img/loader.gif'>");
		},
		success:function(data){
			$("#pone_impuesto").html(data).fadeIn('slow');
			$("#porc_impto").val(0);
			$("#loader").html("");
		}
	})
}

function activa_botones_mov(){
  $("#btn-add-article").attr("disabled", false);
  $("#btn-cancel-article").attr("disabled", false);	
}

function pone_por_impto(){
	var imp = $("#impuesto").val();
  $(document).ready(function(){
    $.ajax({
      beforeSend: function(){
      },
      url: '../code/busca_porc_impto.php',
      type: 'POST',
      dataType: 'json',
      data: 'codigo='+$("#impuesto").val(),
      success: function(x){
      	if('x'==0){
					$("#porc_impto").val(0);
      	}else{
					$("#porc_impto").val(x.mpo_impu);
      	}
      }
    })
  })
}

///
function cancela_add(){
	$("#tipo_movi").attr('disabled', false);
	$("#proveedor").attr('disabled', false);
	$("#fecha").attr('disabled', false);
	$("#factura").attr('disabled', false);
	$("#almacen").attr('disabled', false);
	$("#tipo_movi").val("");
	$("#proveedor").val("");
	$("#fecha").val("");
	$("#factura").val("");
	$("#almacen").val("");
  $("#codigo").val("");
  $("#descripcion").val("");
  $("#producto").val("");
  $("#porc_impto").val(0);
	$("#incluido").attr('checked',false)
  $("#impuesto").val("");
  $("#unidad").val("");
  $("#costo").val(0);
  $("#cantidad").val(0);
  $("#costo").attr('disabled', true);
  $("#cantidad").attr('disabled', true);
  $("#btn-add-article").attr('disabled', true);
  $("#btn-cancel-article").attr('disabled', true);
  $('#tipo_movi').focus();
}

function apagadatos(){
	$("#fecha").attr('disabled', true);
	$("#almacen").attr('disabled', true);
  $("#codigo").val("");
  $("#descripcion").val("");
  $("#producto").val("");
  $("#unidad").val("");
  $("#saldo_act").val(0);
  $("#val_prome").val(0);
  $("#btn-add-article").attr('disabled', true);
  $("#btn-cancel-article").attr('disabled', true);
  $('#producto').focus();
}

function resumen(){
	var totcan = 0.00;
	var totval = 0.00;
	var totimp = 0.00;

  $('#tabla_articulos > tbody > tr').each(function(){
		var canti = parseFloat($(this).find("td").eq(2).html());
		var impto = parseFloat($(this).find('td').eq(4).html());
		var total = parseFloat($(this).find("td").eq(5).html());
		totcan = totcan+canti;
		totval = totval+total;
		totimp = totimp+impto;
  });
  $("#net").val(totval.toFixed(2));
  $("#imp").val(totimp.toFixed(2));
  $("#arts").val(totcan.toFixed(2));
  if(totval>0){
    $("#btn-procesa").prop('disabled', false);
    $("#btn-cancela").prop('disabled', false);
  }else{
    $("#btn-procesa").prop('disabled', true);
    $("#btn-cancela").prop('disabled', true);
  }
}


function actualiza_entrada_temp(codigo){
	var art=codigo;
  $(document).ready(function(){
    $.ajax({
      beforeSend: function(){
      },
      url: '../code/busca_porc_impto.php',
      type: 'POST',
      dataType: 'json',
      data: 'codigo='+$("#impuesto").val(),
      success: function(x){
      	if('x'==0){
					$("#porc_impto").val(0);
      	}else{
					$("#porc_impto").val(x.mpo_impu);
      	}
      }
    })
  })}


  function procesa_entrada(){
    $("#btn-procesa").prop('disabled', true);
    var n = noty({
      text: "Deseas procesar la entrada...?",
      theme: 'relax',
      layout: 'center',
      type: 'information',
      modal: 'true',
      buttons     : [
      	{addClass: 'btn btn-primary',
	        text    : 'Si',
	        onClick : function ($noty){
            $noty.close();
			      $.ajax({
			        beforeSend: function(){
			          $("#prefi").html("Buscando prox. entrada...");
			        },
			        url: '../code/busca_num_entrada.php',
			        type: 'POST',
				      dataType: 'json',
			        data: 'tipo='+'1',
	            timeout:4000,
			        success: function(x){
			          $("#prefi").html('<div class="alert alert-info"> Movimiento de Entrada Nro '+x.c_entradas+' Prefijo '+x.prefijo_ent+'</div>');
			          $("#prefijo_mov").val(x.prefijo_ent);
			          $("#nro_movi").val(x.c_entradas);
			          pref = x.prefijo_ent;
			          nume = x.c_entradas
			        },
			        error: function(jqXHR,estado,error){
			          $("#prefi").html('Hubo un error!!!'+' '+estado +' '+error);
			        }
			      });
            var pref = $("#prefijo_mov").val();
			      var nume = $("#nro_movi").val();

            $('#tabla_articulos > tbody > tr').each(function(){
							var codi = $(this).find('td').eq(0).html();
							var nomb = $(this).find('td').eq(1).html();
							var cant = $(this).find('td').eq(4).html();
							var valt = $(this).find('td').eq(5).html();
							var tmov = $(this).find('td').eq(6).html();
              $.ajax({
                beforeSend: function(){
                },
                url: '../code/guarda_movimiento.php',
                type: 'POST',
                data: "tipo="+'1'+"&tipo_movi="+$("#tipo_movi").val()+
                "&fecha="+$("#fecha").val()+"&producto="+codi+
                "&cantidad="+cant+"&valoruni="+valu+"&valortot="+valp+"&impuesto="+vali+"&numero="+$("#nro_movi").val()+"&prefijo="+$("#prefijo_mov").val(),
                success: function(x){
                  if(x=="0"){
                    var n = noty({
                      text: "Hubo un error al procesar el Articulo: "+nomb+'. Consulte a soporte inmediatamente...',
                      theme: 'relax',
                      layout: 'topLeft',
                      type: 'success',
                    })
                  }else{
                    var n = noty({
                      text: "Se Proceso el Articulo: "+nomb,
                      theme: 'relax',
                      layout: 'topLeft',
                      type: 'success',
                    })
                  }
                },
                error: function(jqXHR,estado,error){
                  }
              });
            });
				    var n = noty({
				      text: "Movimiento Creado con exito, Entrada Numero "+$("#nro_movi").val(),
				      theme: 'relax',
				      layout: 'center',
				      type: 'information',
				      modal: 'true',
				      buttons     : [
				      	{addClass: 'btn btn-info',
					        text    : 'Imprimir',
					        onClick : function ($noty){
				            $noty.close();
				          }
					      },
					      {addClass: 'btn btn-warning',
					        text    : 'Contiuar',
					        onClick : function ($noty){
					          $noty.close();
				        	}
				      	}
				      ]
				    });							
						//********************
            cancela_entrada_all();
						$('#ModalEntradaMovimientos').modal('hide');
						$(location).attr('href','entradas.php'); 
          }
	      },
	      {addClass: 'btn btn-danger',
	        text    : 'No',
	        onClick : function ($noty){
	          $("#btn-procesa").prop('disabled', false);
	          $noty.close();
        	}
      	}
      ]
    });
  }

function cancela_entrada_all(){
  $(document).ready(function(){
    $.ajax({
      beforeSend: function(){
      },
      url: '../code/cancela_temp_movimiento.php',
      type: 'POST',
      data: "tipo="+'1'+"&tipo_movi="+$("#tipo_movi").val(),
      success: function(t){
      },
      error: function(jqXHR,estado,error){
      }
    });
  })
  $("#tabla_articulos > tbody:last").children().remove();
  cancela_add();
  resumen();
    // alert("Se cancelo el proceso de Movimientos de Entrada");
    //$("#fecha").val("");
    //$("#factura").val("");
    //$("#impuesto").select2('val', 0);
    //$("#proveedor").focus();
}


function pone_num_entrada(tipo){
	var tip = tipo;
  $(document).ready(function(){
    $.ajax({
      beforeSend: function(){
        $("#prefi").html("Buscando prox. entrada...");
      },
      url: '../code/busca_num_entrada.php',
      type: 'POST',
      dataType: 'json',
      data: 'tipo='+tip,
      success: function(x){
        $("#prefi").html('<div class="alert alert-info"> Movimiento de Entrada Nro '+x.c_entradas+' Prefijo '+x.prefijo_ent+'</div>');
        $("#prefijo_mov").val(x.prefijo_ent);
        $("#nro_movi").val(x.c_entradas);

      },
      error: function(jqXHR,estado,error){
        $("#prefi").html('Hubo un error!!!'+' '+estado +' '+error);
      }
    });
  });
}



  function busca_productoX(codigo){
  $(document).ready(function(){
    $.ajax({
      beforeSend: function(){
      },
      url: '../code/busca_productos.php',
      type: 'POST',
      dataType: 'json',
      data: 'codigo='+$("#producto").val(),
      success: function(x){
				$("#codigo").val(x.cod_prod);
				$("#costo").val(x.pco_prod);
				$("#unidad").val(x.uco_prod);
				$("#descripcion").val(x.nom_prod);
        $("#cantidad").val(0);
        $("#costo").attr("disabled", false);
        $("#cantidad").attr("disabled", false);
      }
    })
  })
}


function tipo_ajuste(valor){	
	var exis = $("#exis_anterior").val();
	var actu = $("#saldo_act").val();
	dife = actu - exis;
  $(document).ready(function(){
		$.ajax({
			url: '../code/busca_tipo_ajuste.php',
			type: 'POST',
			dataType: 'json',
			data: 'valor='+dife,
			success: function(x){
				$("#tipo_movi").val(x.codigo);
				$("#tipo").val(x.tipo);
				$("#tipo_movi").attr('disabled',true);
			}
		})
	})
}


  function cancela_todo(){
    var removes=$("#tabla_articulos > tbody:last").children().fadeOut(1000);
    removes.remove();
    cancela();

  }

  function procesa_lista_ajustes(){
    var cuantos=0;
    cuan = $('#lista_articulos_existencias >tbody >tr').length
    if(cuan>0){
      $("#btn_procesa").prop('disabled', true);
        var n = noty({
          text: "Desea procesar el ajuste en los articulos de la lista ?",
          theme: 'relax',
          layout: 'center',
          type: 'information',
          modal: 'true',
          buttons     : [{
            addClass: 'btn btn-primary',
            text    : 'Si',
            onClick : function ($noty){
              $noty.close();
              $('#lista_articulos_existencias > tbody > tr').each(function(){
                var cod  = $(this).find('td').eq(0).html();
                var can  = $(this).find('td').eq(3).html();
                var tipo = $(this).find('td').eq(5).html();
                var dif  = $(this).find('td').eq(4).html();
                if(tipo!='0'){
                  $.ajax({
                    beforeSend: function(){
                      },
                    url: 'procesa_ajuste.php',
                    type: 'POST',
                    data: 'codigo='+cod+'&cantidad='+can+'&tipo='+tipo+'&diferencia='+dif,
                    success: function(x){
                      var n = noty({
                        text: "Procesando articulo: "+cod,
                        theme: 'relax',
                        layout: 'topLeft',
                        type: 'success',
                        timeout: 1000,
                      });
                    },
                    error: function(jqXHR,estado,error){
                      }
                  });
                }
              });
              removes=$("#lista_articulos_existencias > tbody:last").children().fadeOut(1000);
              removes.remove();
              $("#btn_procesa").prop('disabled', false);
              pone_foco();
            }
          },
          {addClass: 'btn btn-danger',
            text    : 'No',
            onClick : function ($noty){
              $("#btn_procesa").prop('disabled', false);
              $noty.close();
            }
          }]
        });
      }else{
        alert("No hay articulos para procesar");
      }
    }