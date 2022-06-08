'use strict'

import {openModal, closeModal} from './modal-veiculos.js'
import {readVeiculo, createVeiculo, deleteVeiculo, uptadeVeiculo} from './veiculo.js'

const createRow = ({placa, cor, responsavel, id}) => {
    const row = document.createElement('tr')
    row.innerHTML = `
        <td>${placa}</td>
        <td>${cor}</td>
        <td>${responsavel}</td>
        <td>
            <button type="button" class="button green" onClick="editVeiculo(${id})">editar</button>
            <button type="button" class="button red" onClick="delVeiculo(${id})">excluir</button>
        </td>
    `
    return row
}

const fillForm = (veiculo) => {
    document.getElementById('placa').value = veiculo.placa
    document.getElementById('cor').options[document.getElementById('cor').selectedIndex].value = veiculo.cor
    document.getElementById('responsavel').options[document.getElementById('responsavel').selectedIndex].value = veiculo.responsavel
}

globalThis.delVeiculo = async (id) => {
    await deleteVeiculo(id)
    updateTable
}

globalThis.editVeiculo = async (id) => {
    //armazenar as informações do veiculoe selecionado
    const veiculo = await readVeiculo(id)

    //preencher o formulario com as informações
    fillForm(veiculo)

    //abrir o modal
    openModal()
}

const updateTable = async () => {

    const veiculoContainer = document.getElementById('veiculos-container')
    //Ler a API e armazenar o resultado em uma variavel
    const veiculos = await readVeiculo()

    //Preencher a tabela com as informações
    const rows = veiculos.map(createRow)

    veiculoContainer.replaceChildren(...rows)
}

const isEdit = () => document.getElementById('placa').hasAttribute('data-id')


const saveVeiculo = async () => {

    const form = document.getElementById('modal-form')

    // criar um json com as informações do veiculoe
    const veiculo = {
        "id": "",
        "placa": document.getElementById('placa').value,
        "cor": document.getElementById('cor').value,
        "responsavel": document.getElementById('responsavel').value
    }

    if(form.reportValidity()) {
        if (isEdit()) {
            veiculo.id = document.getElementById('placa').dataset.id
            await uptadeVeiculo(veiculo)
        } else {
             createVeiculo(veiculo)
        }

        closeModal()

        updateTable()
    }
}

updateTable()

document.getElementById('cadastrarVeiculo').addEventListener('click', openModal)
document.getElementById('salvar').addEventListener('click', saveVeiculo)