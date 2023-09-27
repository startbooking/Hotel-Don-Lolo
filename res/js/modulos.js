$(document).ready(function () {
  sesion = JSON.parse(localStorage.getItem("sesion"));
  
  let { cia, user, moduloPms } = sesion;
  let { estado, ingreso, tipo, apellidos, nombres, inv, pos, pms, res, fe, con } = user;
  let { invMod, posMod, pmsMod, resMod, feMod , conMod} = cia;

  let { fecha_auditoria } = moduloPms;

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

 
  if(invMod==0 && inv == 0 ){
    moduloInv.classList.add('apagado')
  }
  if(posMod==0 && pos == 0){
    moduloPos.classList.add('apagado')
  }
  if(pmsMod==0 && pms == 0){
    moduloPms.classList.add('apagado')
  }
  if(resMod==0 && res == 0 ){
    moduloRes.classList.add('apagado')
  }
  if(feMod==0 && fe == 0){
    moduloFe.classList.add('apagado')
  }
  if(conMod==0 && con == 0){
    moduloCon.classList.add('apagado')
  }
  if(tipo==0){
    moduloPar.classList.add('apagado')
  }

  modulos.classList.remove('apagado')

});