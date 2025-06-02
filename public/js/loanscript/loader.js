document.getElementById('formSaveID').addEventListener('submit', function () {
 mostrarLoader();
});

function mostrarLoader() {
 const loader = document.getElementById('loader');
 if (loader) {
  loader.style.display = 'flex';
 }

 const btnGuardar = document.getElementById('btnGuardar');
 if (btnGuardar) {
  btnGuardar.disabled = true;
 }
}