import { modalProv } from "selectores.js";
(function () {
  document.addEventListener("DOMContentLoaded", async () => {
    // dataTable.addEventListener("click", desactivaCliente);
    modalProv.addEventListener("show.bs.modal", async (event) => {
      swal('Abrio modal')
    });})
})();