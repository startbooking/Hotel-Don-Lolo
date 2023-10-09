/* import {
  traeProveedores,
} from "./API.js"; */


// console.log(traeProveedores);

$(document).ready(function () {
  let sesion = JSON.parse(localStorage.getItem("sesion"));
  
  let { user } = sesion;
  let { apellidos, nombres } = user;

/*   nombreUsuaro = document.querySelector('#nombreUsuario');
  nombreUsuaro.innerHTML = `${apellidos}  ${nombres}<span class="caret"></span>`;
 */
  

  $("#myModalAdicionarProveedor").on("show.bs.modal", function (event) {
    
    /* 
    $("#error").html("");
    if (localStorage.getItem("sesion")) {
      entro = JSON.parse(localStorage.getItem("sesion"));
      let { user } = entro;
      let { usuario, usuario_id } = user;
      $("#idUserPass").val(usuario_id);
      $("#userPass").val(usuario);
    }  
    swal('Abrio Modal')
    */
    document.querySelector('form')
    .addEventListener('submit', e => {
      const data = Object.fromEntries(new FormData(e.target))
      alert(JSON.stringify(data))
    })
  });


});



// facturasPorFecha 

function guardaProveedor(e){
  console.log(e)
  let dataProv = document.querySelector('#dataRegistrarProveedor')

  const data = Object.fromEntries(
    new FormData(e.target)
  )

  

  console.log(data);


}
