let materialsList = [];

// Añadir material al array y renderizar tabla
function addMaterial() {
 const areaSelect = document.getElementById('area_id');
 const materialSelect = document.getElementById('material_id');
 const cantidadInput = document.getElementById('input_cantidad').value;
 const estado = document.getElementById('input_estado').value;

 const area_id = areaSelect.value;
 const area_text = areaSelect.options[areaSelect.selectedIndex]?.text || '';
 const material_id = materialSelect.value;
 const material_text = materialSelect.options[materialSelect.selectedIndex]?.text || '';
 const cantidad = parseInt(cantidadInput);

 if (!area_id || !material_id || cantidad <= 0 || !estado) {
  alert('Por favor, complete todos los campos correctamente.');
  return;
 }

 const index = materialsList.findIndex(item =>
  item.area_id === area_id && item.material_id === material_id
 );

 if (index !== -1) {
  materialsList[index].cantidad += cantidad;
 } else {
  materialsList.push({
      area_id,
      area_text,
      material_id,
      material_text,
      cantidad,
      estado
  });
 }

 renderMaterialsTable();
 updateMaterialsField();
}

function loadMaterials(sector) {
 const materialSelect = document.getElementById('material_id');
 materialSelect.innerHTML = '<option value="">Cargando...</option>';

 if (!sector) {
  materialSelect.innerHTML = '<option value="">Seleccione un aula primero</option>';
  return;
 }

 fetch(`/materialsByClassroom/${sector}`)
  .then(response => response.json())
  .then(data => {
    materialSelect.innerHTML = '';

    if (data.length === 0) {
      materialSelect.innerHTML = '<option value="">No hay materiales para esta aula</option>';
      return;
    }

    materialSelect.innerHTML = '<option value="">Seleccione un material</option>';
    data.forEach(material => {
     materialSelect.innerHTML += `<option value="${material.id}">${material.name}</option>`;
    });
  })
  .catch(error => {
    console.error('Error cargando materiales:', error);
    materialSelect.innerHTML = '<option value="">Error al cargar materiales</option>';
  });
}

// Renderizar la tabla de materiales
function renderMaterialsTable() {
 const tbody = document.getElementById('materialsBody');
 tbody.innerHTML = '';

 if (materialsList.length === 0) {
  tbody.innerHTML = `<tr class="text-center text-muted">
   <td colspan="5">No hay materiales añadidos.</td>
  </tr>`;
  return;
 }

 materialsList.forEach((material, index) => {
  const row = document.createElement('tr');

  row.innerHTML = `
   <td>${material.area_text}</td>
   <td>${material.material_text}</td>
   <td><span class="cantidad">${material.cantidad}</span></td>
   <td>${material.estado}</td>
   <td>
   <button class="btn btn-secondary mr-1" onclick="addQuantity(this)"><i class="fas fa-plus"></i></button>
   <button class="btn btn-secondary mr-3" onclick="minusQuantity(this)"><i class="fas fa-minus"></i></button>
   <button type="button" class="btn btn-danger btn-sm" onclick="removeMaterial(${index})">Eliminar</button>
   </td>
  `;

  tbody.appendChild(row);
 });
}

// Quitar material del array
function removeMaterial(index) {
 materialsList.splice(index, 1);
 renderMaterialsTable();
 updateMaterialsField();
}

// Actualizar el input hidden con los datos como JSON
function updateMaterialsField() {
 const hiddenField = document.getElementById('materials_json');
 const listToSend = materialsList.map(({ area_id, material_id, cantidad, estado }) => ({
  area_id,
  material_id,
  cantidad,
  estado
 }));
 hiddenField.value = JSON.stringify(listToSend);
}