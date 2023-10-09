export function usuarioActivo() {
  let sesion = JSON.parse(localStorage.getItem("sesion"));
  let { user } = sesion;
  
  return user;
}