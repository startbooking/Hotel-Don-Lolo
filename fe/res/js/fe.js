$(document).ready(function () {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  
  let { user } = sesion;
  let { apellidos, nombres } = user;

  nombreUsuaro = document.querySelector('#nombreUsuario');
  nombreUsuaro.innerHTML = `${apellidos}  ${nombres}<span class="caret"></span>`;

  document.querySelector('form')
  .addEventListener('submit', e => {
    const data = Object.fromEntries(new FormData(e.target))
    alert(JSON.stringify(data))
  })

  
});



// facturasPorFecha 

async function facturasPorFecha() {

  formFact = document.querySelector('form');

  console.log(formFact);

  var web = $("#rutaweb").val();
  desdeFe = $("#desdeFecha").val();
  hastaFe = $("#hastaFecha").val();
  desdeNu = $("#desdeNumero").val();
  hastaNu = $("#hastaNumero").val();
  huesped = $("#desdeHuesped").val();
  empresa = $("#desdeEmpresa").val();
  formaPa = $("#desdeFormaPago").val();
  parametros = {
    desdeFe,
    hastaFe,
    desdeNu,
    hastaNu,
    huesped,
    empresa,
    formaPa,
  };

  if (
    desdeFe == "" &&
    hastaFe == "" &&
    desdeNu == "" &&
    hastaNu == "" &&
    huesped == "" &&
    empresa == "" &&
    formaPa == ""
  ) {
    swal("Atencion", "Seleccione un Criterio de Busqueda", "warning");
  } else {



    /* $.ajax({
      url: web + "res/php/facturasPorRango.php",
      type: "POST",
      data: parametros,
      success: function (x) {
        $(".imprimeInforme").html(x);
      },
    }); */
  }
}