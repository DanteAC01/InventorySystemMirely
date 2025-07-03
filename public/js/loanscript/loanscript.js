document.addEventListener('DOMContentLoaded', () => {
    showMaterials(materials);
});

function loadMaterials(sector) {
  const materialSelect = document.getElementById('material_id');
  materialSelect.innerHTML = '<option value="">Cargando...</option>';
  console.log('Sector seleccionado:', sector);

  if (!sector) {
    materialSelect.innerHTML = '<option value="">Seleccione un aula primero</option>';
    return;
  }

  fetch(`/materialsByClassroom/${sector}`)
    .then(response => response.json())
    .then(data => {
        console.log('Datos recibidos del backend:', data);
        materialSelect.innerHTML = '';

        if (data.length === 0) {
            materialSelect.innerHTML = '<option value="">No hay materiales para esta aula</option>';
            return;
        }

        materialSelect.innerHTML = '<option value="">Seleccione un material</option>';
        data.forEach(material => {
            console.log('Material:', material); 
            materialSelect.innerHTML += `<option value="${material.id}">${material.name}</option>`;
        });
    })
    .catch(error => {
        console.error('Error cargando materiales:', error);
        materialSelect.innerHTML = '<option value="">Error al cargar materiales</option>';
    });
}

function showMaterials(materials) {
    const tbody = document.querySelector('#materialsTable tbody');

    materials.forEach(material => {
        const fila = createAppendChild(material);
        tbody.appendChild(fila);
    });
}
/**
 * Crea una fila de tabla con los datos de un usuario
 * @param {Object} material 
 * @returns {HTMLElement}
**/

function addMaterial() {
    const areaSelect = document.getElementById('area_id');
    const materialSelect = document.getElementById('material_id');
    const cantidadInput = document.getElementById('input_cantidad').value;
    const status = document.getElementById('input_estado').value;

    const area_id = areaSelect.value;
    const area_nombre = areaSelect.options[areaSelect.selectedIndex].text;

    const material_id = materialSelect.value;
    const material_nombre = materialSelect.options[materialSelect.selectedIndex].text;

    if (!area_id || !material_id || !cantidadInput) {
        alert('Por favor, complete todos los campos.');
        return;
    }

    const quantity = parseInt(cantidadInput);
    if (quantity <= 0) {
        alert('La cantidad debe ser mayor que 0.');
        return;
    }

    const material = {
        material_id: material_id,
        material_nombre: material_nombre,
        area_id: area_id,
        area_nombre: area_nombre,
        quantity: quantity,
        status: status
    };

    const tabla = document.getElementById('materialsTable').getElementsByTagName('tbody')[0];
    const filas = tabla.getElementsByTagName('tr');

    for (let i = 0; i < filas.length; i++) {
        const fila = filas[i];
        const filaMaterialId = fila.querySelector('.material-id').textContent.trim();
        const filaAreaId = fila.querySelector('.area-id')?.textContent.trim();

        if (filaMaterialId === material.material_id && filaAreaId === material.area_id) {
            const cantidadSpan = fila.querySelector('.cantidad');
            let cantidadActual = parseInt(cantidadSpan.textContent);
            cantidadActual += material.quantity;
            cantidadSpan.textContent = cantidadActual;
            return;
        }
    }

    const fila = createAppendChild(material);
    tabla.appendChild(fila);
}

function createAppendChild(material) {
    const fila = document.createElement('tr');
    fila.innerHTML = `
        <td class="material-id">${material.material_id}</td>
        <td class="material-nombre">${material.material_nombre}</td>
        <td><span class="cantidad">${material.quantity}</span></td>
        <td>${material.status}</td>
        <td style="display:none;" class="area-id">${material.area_id}</td> <!-- oculto -->
        <td>
          <button type="button" class="btn btn-secondary mr-1" onclick="addQuantity(this)">
            <i class="fas fa-plus"></i>
          </button>
          <button type="button" class="btn btn-secondary mr-3" onclick="minusQuantity(this)">
            <i class="fas fa-minus"></i>
          </button>
          <button class="btn btn-danger" onclick="removeMaterial(this)"><i class="fas fa-trash"></i></button>
        </td>
    `;
    return fila;
}

function addQuantity(button){
  const fila = button.closest('tr');
  const cantidadSpan = fila.querySelector('.cantidad');
  let cantidad = parseInt(cantidadSpan.textContent);
  cantidad++;
  cantidadSpan.textContent = cantidad;
}

function minusQuantity(button) {
  const fila = button.closest('tr');
  const cantidadSpan = fila.querySelector('.cantidad');
  let cantidad = parseInt(cantidadSpan.textContent);
  if (cantidad > 1) {
    cantidad--;
    cantidadSpan.textContent = cantidad;
  }
}


function removeMaterial(button) {
    const fila = button.closest('tr');
    fila.remove();
}

function updateMaterialsField() {
    const tabla = document.getElementById('materialsTable').getElementsByTagName('tbody')[0];
    const filas = tabla.getElementsByTagName('tr');

    const materiales = [];

    for (let i = 0; i < filas.length; i++) {
        const celdas = filas[i].getElementsByTagName('td');

        materiales.push({
            material_id: celdas[0].textContent.trim(),
            area_id: celdas[1].textContent.trim(),
            quantity: parseInt(celdas[2].querySelector('.quantity').textContent.trim()),
            status: celdas[3].textContent.trim(),
        });
    }
    console.log('Materiales que se enviarán:', materiales); // debug
    document.getElementById('materials_json').value = JSON.stringify(materiales);
}
