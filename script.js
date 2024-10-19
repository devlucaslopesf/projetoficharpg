// script.js

// Seleciona o botão de adicionar item e a lista de equipamentos
const addItemButton = document.getElementById('add-item');
const equipmentList = document.getElementById('equipment-list');

// Contador para os itens de equipamento (garante IDs únicos)
let itemCount = 0;

// Função para adicionar um novo campo de item de equipamento
function addEquipmentItem() {
    itemCount++;

    // Cria um novo div para o item
    const newItemDiv = document.createElement('div');
    newItemDiv.classList.add('equipment-item');
    newItemDiv.id = `item-${itemCount}`;

    // Cria o label e o input para o item
    const newLabel = document.createElement('label');
    newLabel.setAttribute('for', `equipment-${itemCount}`);
    newLabel.innerText = `Item ${itemCount}:`;

    const newInput = document.createElement('input');
    newInput.type = 'text';
    newInput.id = `equipment-${itemCount}`;
    newInput.name = `equipment[]`; // Para enviar como array
    newInput.placeholder = `Digite o nome do item ${itemCount}`;

    // Botão para remover o item
    const removeButton = document.createElement('button');
    removeButton.type = 'button';
    removeButton.innerText = 'Remover';
    removeButton.onclick = () => removeEquipmentItem(newItemDiv.id);

    // Adiciona o label, input e botão ao div
    newItemDiv.appendChild(newLabel);
    newItemDiv.appendChild(newInput);
    newItemDiv.appendChild(removeButton);

    // Adiciona o novo item à lista de equipamentos
    equipmentList.appendChild(newItemDiv);
}

// Função para remover um campo de equipamento
function removeEquipmentItem(itemId) {
    const itemToRemove = document.getElementById(itemId);
    equipmentList.removeChild(itemToRemove);
}

// Adiciona um ouvinte de evento ao botão "Adicionar Item"
addItemButton.addEventListener('click', addEquipmentItem);
