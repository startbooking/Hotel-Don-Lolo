// $(document).ready(function () {
document.addEventListener("DOMContentLoaded", async () => {

  let sesion = JSON.parse(localStorage.getItem("sesion"));
  
  if(sesion == null){
    swal({
      title: 'Precaucion',
      text: 'Usuario NO identificado en el Sistema',
      type: "warning",
      confirmButtonText: "Aceptar",
      closeOnConfirm: true,  
    }, function(){
      window.location.href = "/";
      return 
    })
  }
  let { cia:{ invMod, posMod, pmsMod, resMod, feMod , conMod}, user:{ tipo, apellidos, nombres, inv, pos, pms, res, fe, con }, moduloPms: { fecha_auditoria } } = sesion;

  muestraFecha = document.querySelector('#fechaPms');
  nombreUsuaro = document.querySelector('#nombreUsuario');

  muestraFecha.innerHTML = `Fecha de Proceso [${fecha_auditoria}]`;
  nombreUsuaro.innerHTML = `${apellidos}  ${nombres}<span class="caret"></span>`;

  moduloInv = document.querySelector("#inv");
  moduloPos = document.querySelector("#pos");
  moduloPms = document.querySelector("#pms");
  moduloRes = document.querySelector("#res");
  moduloFe = document.querySelector("#fe");
  moduloPar = document.querySelector("#par");
  moduloCon = document.querySelector("#con");
  modulos  = document.querySelector("#modulos");

  if(invMod==1 && inv == 1 ){
    moduloInv.classList.remove('apagado')
  }
  if(posMod==1 && pos == 1){
    moduloPos.classList.remove('apagado')
  }
  if(pmsMod==1 && pms == 1){
    moduloPms.classList.remove('apagado')
  }
  if(resMod==1 && res == 1){
    moduloRes.classList.remove('apagado')
  }
  if(feMod==1 && fe == 1){
    moduloFe.classList.remove('apagado')
  }
  if(conMod==1 && con == 1){
    moduloCon.classList.remove('apagado')
  }
  if(tipo==1){
    moduloPar.classList.remove('apagado')
  }

  modulos.classList.remove('apagado')

});