'use strict'

import {readVaga} from './veiculoCadastrado.js'

const createRow = ({ placa, idCor, idVaga, id }) => {
    const row = document.createElement('thread')
    row.innerHTML = `
            <tr>
                <th>Placa</th>
                <th>Cor</th>
                <th>Tipo</th>
                <th>Vaga</th>
                <th>Entrada</th>
            </tr>
    `
    const results = document.createElement('tbody')
    results.innerHTML = `
        <tr>
            <td id="placa">${placa}</td>
            <td id="cor">${idCor}</td>
            <td id="cliente">${idVaga}</td>
            <td>
            <button type="button" class="finalizar" onClick="finishClient(${id})">Finalizar</button>
            </td>
        </tr>
    
    `
    return row, results
}

createRow()

// Método para carregar os clientes quando carregar a página
const uptadeTable = async () => {

    const veiculoContainer = document.getElementById('veiculoCadastrado')
    // Ler a API e armazenar o resultado em uma variavel
    const veiculos = await readVaga()
    // Preencher a tabela com as informações
    const rows = veiculos.map(createRow)
    // Colocando elemento por elemento no id clientsContainer
    veiculoContainer.replaceChildren(...rows)

}

uptadeTable()

const fillForm = (vaga) => {
    document.getElementById('placa').value = vaga.placa
    document.getElementById('cor').value = vaga.idCor
    document.getElementById('cliente').value = vaga.idCliente
}

globalThis.delvaga = async (id) => {
    await deleteVaga(id)
    updateTable
}

globalThis.editvaga = async (id) => {
    //armazenar as informações do vagae selecionado
    const vaga = await readVaga(id)

    //preencher o formulario com as informações
    fillForm(vaga)

    //abrir o modal
    openModal()
}

const isEdit = () => document.getElementById('statusvaga').hasAttribute('data-id')

const savevaga = async () => {

    const form = document.getElementById('modal-form')
    
    const vaga = {
        "id": "",
        "placa": document.getElementById('placa').value,
        "idCor": document.getElementById('tipo').value,
        "idCliente": document.getElementById('cliente').value
    }

    console.log(vaga)

    if(form.reportValidity()) {
        if (isEdit()) {
            vaga.id = document.getElementById('statusvaga').dataset.id
            await uptadeVaga(vaga)
        } else {
             createVaga(vaga)
        }

        closeModal()

        updateTable()
    }
}

updateTable()

const pegarPlaca =  async ({key, target}) => {
    if(key === 'Enter'){
        await buscarGeneros(target.value)
    }
}

document.querySelector('#genero')
        .addEventListener('keypress', pegarPlaca);

document.getElementById('pesquisarPlaca').addEventListener('keypress', savevaga)


