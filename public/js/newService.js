document.addEventListener('DOMContentLoaded', () => {
  const addBtn    = document.querySelector('.add-service-button');
  const container = document.querySelector('.services-grid-rows');

  function attachDelete(btn) {
    btn.addEventListener('click', () => {
      const row = btn.closest('.services-grid-row');
      if (row) row.remove();
    });
  }

  function attachFileListener(fileInput) {
    fileInput.addEventListener('change', () => {
      const row  = fileInput.closest('.services-grid-row');
      const cell = row.querySelector('.file-name-col');
      const file = fileInput.files && fileInput.files[0];
      cell.textContent = file ? file.name : 'No file chosen';
    });
  }

  function ensureDeleteCell(row) {
    let delCell = row.querySelector('.delete-col');
    if (!delCell) {
      delCell = document.createElement('div');
      delCell.className = 'grid-cell delete-col';
      row.appendChild(delCell);
    }
    delCell.innerHTML =
      '<button type="button" class="delete-service-button"><i class="fa-solid fa-trash-can"></i></button>';
    attachDelete(delCell.firstElementChild);
  }

  function prepareClone(clone, index) {
    clone.querySelectorAll('input[type="text"]').forEach(inp => { inp.value = ''; });

    const span = clone.querySelector('.price-col span');
    if (span) span.textContent = 'DA';

    clone.querySelectorAll('input[type="radio"]').forEach(radio => {
      const type = radio.value;                       // fixed | person
      const newName = `service_price_type_${index}`;
      const newId   = `price_type_${type}_${index}`;
      radio.name = newName;
      radio.id   = newId;
      radio.checked = (type === 'fixed');
      const lbl = clone.querySelector(`label[for^="price_type_${type}_"]`);
      if (lbl) lbl.htmlFor = newId;
    });

    const fileInput = clone.querySelector('input[type="file"]');
    if (fileInput) {
      const newFileId = `service_pic_${index}`;
      fileInput.id = newFileId;
      fileInput.value = '';               
      const lbl = clone.querySelector('label.button-secondary');
      if (lbl) lbl.htmlFor = newFileId;
      attachFileListener(fileInput);
    }

    const fileNameCell = clone.querySelector('.file-name-col');
    if (fileNameCell) fileNameCell.textContent = 'No file chosen';

    ensureDeleteCell(clone);
  }

  container.querySelectorAll('.delete-service-button').forEach(attachDelete);
  container.querySelectorAll('input[type="file"]').forEach(attachFileListener);

  addBtn.addEventListener('click', () => {
    const rows  = container.querySelectorAll('.services-grid-row');
    const index = rows.length + 1;              // رقم الصف الجديد
    const clone = rows[rows.length - 1].cloneNode(true);

    prepareClone(clone, index);
    container.appendChild(clone);
  });
});