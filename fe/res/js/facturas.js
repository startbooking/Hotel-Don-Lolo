document.querySelector('form')
.addEventListener('submit', e => {
  const data = Object.fromEntries(new FormData(e.target))
  // alert(JSON.stringify(data))
})
