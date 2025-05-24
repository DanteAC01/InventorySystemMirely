function loadMaterials(areaId) {
 const materialSelect = document.getElementById('material_id');
 materialSelect.innerHTML = '<option value="">Cargando...</option>';

 if (!areaId) {
  materialSelect.innerHTML = '<option value="">Seleccione un área primero</option>';
  return;
 }

 fetch(`materialsByClassroom/${areaId}`)
  .then(response => response.json())
  .then(data => {
    materialSelect.innerHTML = '';

    if (data.length === 0) {
        materialSelect.innerHTML = '<option value="">No hay materiales para esta área</option>';
        return;
    }

    materialSelect.innerHTML = '<option value="">Seleccione un material</option>';
    data.forEach(material => {
        materialSelect.innerHTML += `<option value="${material.id}">${material.nombre}</option>`;
    });
  })
  .catch(error => {
   console.error('Error cargando materiales:', error);
   materialSelect.innerHTML = '<option value="">Error al cargar materiales</option>';
  });
}