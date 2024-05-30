function  () {
const btnActualizar = document.getElementById('btActualizar');
  const btnEliminar = document.getElementById('btnEliminar');

  btnActualizar.addEventListener('click', () => {
    if (.style.display === 'none') {
      btnEliminar.style.display = 'block';
    } else {
      miActualizar.style.display = 'none';
    }
  });
}