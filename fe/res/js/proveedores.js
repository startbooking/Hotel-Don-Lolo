document.querySelector('form')

$("#example1").DataTable({
  iDisplayLength: 25,
  paging: true,
  lengthChange: true,
  searching: true,
  ordering: true,
  info: true,
  autoWidth: true,
  language: {
    next: "Siguiente",
    search: "Buscar:",
    entries: "registros",
  },
});

.addEventListener('submit', e => {
  const data = Object.fromEntries(new FormData(e.target))
  // alert(JSON.stringify(data))
})
