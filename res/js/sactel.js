function  calculaDV ()  {
  var myNit = $('#nitUpd').val();
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

  $('#dvUpd').val(dig)
}

function  calcularDV ()  {
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

function redondeo(numero, decimales){
  var flotante = parseFloat(numero);
  var resultado = Math.round(flotante*Math.pow(10,decimales))/Math.pow(10,decimales);
  return resultado;
}

function clickgaleria(){
  var button  = $(event.relatedTarget);
  var id      = button.data('id');
  var imagen  = button.data('imagen');
  var modal   = $(this)

  var modalGallery = '<div class="modalGallery" id="modalGallery"><img src="'+ img +'" class="img-thumbnail"><div class="modal_boton"><i style="font-size:16px" class="fa fa-times" aria-hidden="true"></i></div></div>';
  $('body').append(modalGallery);
  $('.modal_boton').click(function(){
    $('.modalGallery').remove();
  });  
}


function number_format(amount, decimals) {

    amount += ''; // por si pasan un numero en vez de un string
    amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto

    decimals = decimals || 0; // por si la variable no fue fue pasada

    // si no es un numero o es igual a cero retorno el mismo cero
    if (isNaN(amount) || amount === 0) 
        return parseFloat(0).toFixed(decimals);

    // si es mayor o menor que cero retorno el valor formateado como numero
    amount = '' + amount.toFixed(decimals);

    var amount_parts = amount.split('.'),
        regexp = /(\d+)(\d{3})/;

    while (regexp.test(amount_parts[0]))
        amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');

    return amount_parts.join('.');
}

function creaUUID(){
  alert('Entro ')
  return "10000000-1000-4000-8000-100000000000".replace(/[018]/g, c =>
    (+c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> +c / 4).toString(16)
  );
}

function generateUUID() { // Public Domain/MIT
  var d = new Date().getTime();//Timestamp
  var d2 = ((typeof performance !== 'undefined') && performance.now && (performance.now()*1000)) || 0;//Time in microseconds since page-load or 0 if unsupported
  return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
      var r = Math.random() * 16;//random number between 0 and 16
      if(d > 0){//Use timestamp until depleted
          r = (d + r)%16 | 0;
          d = Math.floor(d/16);
      } else {//Use microseconds since page-load if supported
          r = (d2 + r)%16 | 0;
          d2 = Math.floor(d2/16);
      }
      return (c === 'x' ? r : (r & 0x3 | 0x8)).toString(16);
  });
}

$('.images').click(function(e){
  var img = e.target.srcset;

  var modalGallery = '<div class="modalGallery" id="modalGallery"><img src="'+ img +'" class="img-thumbnail"><div class="modal_boton"><i style="font-size:16px" class="fa fa-times" aria-hidden="true"></i></div></div>';
  $('body').append(modalGallery);
  $('.modal_boton').click(function(){
    $('.modalGallery').remove();
  });
})

$(document).keyup(function(e){
  if(e.which==27){
    $('.modalGallery').remove();
  }
})


function validateEmail(){
	// Get our input reference.
	var emailField = document.getElementById('user-email');
	// Define our regular expression.
	var validEmail =  /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
	// Using test we can check if the text match the pattern
	if( validEmail.test(emailField.value) ){
		alert('Email is valid, continue with form submission');
		return true;
	}else{
		alert('Email is invalid, skip form submission');
		return false;
	}
} 