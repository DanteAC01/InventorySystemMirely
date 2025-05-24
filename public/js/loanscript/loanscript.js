let materials = [];

function addMaterial() {
  const areaSelect = document.getElementById('area_id');
  const materialSelect = document.getElementById('material_id');
  const cantidadInput = document.getElementById('input_cantidad');
  const estadoSelect = document.getElementById('input_estado');

  const areaId = areaSelect.value;
  const areaText = areaSelect.options[areaSelect.selectedIndex]?.text;
  const materialId = materialSelect.value;
  const materialText = materialSelect.options[materialSelect.selectedIndex]?.text;
  const cantidad = parseInt(cantidadInput.value);
  const estado = estadoSelect.value;

  if (!areaId || !materialId || !cantidad || !estado) {
    alert("Por favor, complete todos los campos del material.");
    return;
  }

  // Verificar si ya existe
  const existingIndex = materials.findIndex(item =>
    item.area_id === areaId &&
    item.material_id === materialId &&
    item.estado === estado
  );

  if (existingIndex !== -1) {
    materials[existingIndex].cantidad += cantidad;
  } else {
    const newItem = {
      area_id: areaId,
      area_nombre: areaText,
      material_id: materialId,
      material_nombre: materialText,
      cantidad: cantidad,
      estado: estado
    };
    materials.push(newItem);
  }

  renderMaterialsTable();
  cantidadInput.value = '';
  estadoSelect.value = 'prestado';
}

function renderMaterialsTable() {
  const tbody = document.getElementById('materialsBody');
  tbody.innerHTML = '';

  if (materials.length === 0) {
    tbody.innerHTML = '<tr class="text-center text-muted"><td colspan="5">No hay materiales añadidos.</td></tr>';
    return;
  }

  materials.forEach((item, index) => {
    const row = document.createElement('tr');
    row.innerHTML = `
      <td>${item.area_nombre}</td>
      <td>${item.material_nombre}</td>
      <td class="text-center">
          <span class="mx-2">${item.cantidad}</span>
      </td>
      <td>${item.estado}</td>
      <td class="text-center">
        <div class="btn-group me-2" role="group" aria-label="Ajustar cantidad">
          <button type="button" class="btn btn-sm btn-outline-secondary" title="Restar" onclick="adjustQuantity(${index}, -1)">−</button>
          <button type="button" class="btn btn-sm btn-outline-secondary mr-4" title="Sumar" onclick="adjustQuantity(${index}, 1)">+</button>
        </div>
        <button type="button" class="btn btn-sm btn-outline-danger" title="Eliminar material" onclick="removeMaterial(${index})">🗑</button>
      </td>
    `;
    tbody.appendChild(row);
  });
}

function removeMaterial(index) {
  materials.splice(index, 1);
  renderMaterialsTable();
}

function adjustQuantity(index, change) {
  materials[index].cantidad += change;

  if (materials[index].cantidad <= 0) {
    if (confirm('¿Deseas eliminar este material de la lista?')) {
      removeMaterial(index);
      return;
    } else {
      materials[index].cantidad = 1;
    }
  }

  renderMaterialsTable();
}

function prepareMaterialsBeforeSubmit() {
  document.getElementById('materials_json').value = JSON.stringify(materials);
}

function loadMaterials(areaId) {
  const materialSelect = document.getElementById('material_id');
  materialSelect.innerHTML = '<option value="">Cargando...</option>';

  if (!areaId) {
      materialSelect.innerHTML = '<option value="">Seleccione un aula primero</option>';
      return;
  }

  fetch(`/materialsByClassroom/${areaId}`)
      .then(response => response.json())
      .then(data => {
          materialSelect.innerHTML = '';

          if (data.length === 0) {
              materialSelect.innerHTML = '<option value="">No hay materiales para esta aula</option>';
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

function renderMaterials() {
    const tableBody = document.getElementById('materialsBody');
    tableBody.innerHTML = '';

    if (materials.length === 0) {
      tableBody.innerHTML = '<tr class="text-center text-muted"><td colspan="5">No hay materiales añadidos.</td></tr>';
      return;
    }

    materials.forEach((item, index) => {
      const area = areasList.find(a => a.id == item.area_id);
      const material = materialsList.find(m => m.id == item.material_id);

      const row = document.createElement('tr');
      row.innerHTML = `
          <td>${area ? area.nombre : 'Desconocido'}</td>
          <td>${material ? material.nombre : 'Desconocido'}</td>
          <td>${item.cantidad}</td>
          <td>${item.estado}</td>
          <td><button type="button" class="btn btn-danger btn-sm" onclick="removeMaterial(${index})">Eliminar</button></td>
      `;
      tableBody.appendChild(row);
    });

    updateMaterialsJson();
}

function updateMaterialsJson() {
    document.getElementById('materials_json').value = JSON.stringify(materials);
}
