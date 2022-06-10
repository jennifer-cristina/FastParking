'use strict'

import {openModal, closeModal} from './modal-veiculos.js'
import {readVeiculo, createVeiculo, deleteVeiculo, uptadeVeiculo, readCor, readCliente} from './veiculo.js'

const criarOptionsCor = ({id}) => {
    const option = document.createElement('option')
    option.innerHTML = `
    <option>
         ${id}
    </option>
    
    `

    return option
}

const carregarCor = async () =>{
    const container = document.getElementById('cor')
    const cores = await readCor()
    const option = cores.map(criarOptionsCor)
    container.replaceChildren(...option)
    // listaSexo.innerHTML = `
    // <option>Selecione o sexo</option>
    // <option>
    //     ${)}
    // </option>
    // `
     return option
}

carregarCor()

const criarOptionsCliente = ({id}) => {
    const option = document.createElement('option')
    option.innerHTML = `
    <option>
         ${id}
    </option>
    
    `

    return option
}

const carregarCliente = async () =>{
    const container = document.getElementById('responsavel')
    const clientes = await readCliente()
    const option = clientes.map(criarOptionsCliente)
    container.replaceChildren(...option)
    // listaSexo.innerHTML = `
    // <option>Selecione o sexo</option>
    // <option>
    //     ${)}
    // </option>
    // `
     return option
}

carregarCliente()

const createRow = ({placa, idCor, idCliente, id}) => {
    const row = document.createElement('tr')
    row.innerHTML = `
        <td>${placa}</td>
        <td>${idCor}</td>
        <td>${idCliente}</td>
        <td>
            <button type="button" class="button green" onClick="editVeiculo(${id})">editar</button>
            <button type="button" class="button red" onClick="delVeiculo(${id})">excluir</button>
        </td>
    `
    return row
}

const fillForm = (veiculo) => {
    document.getElementById('placa').value = veiculo.placa
    document.getElementById('cor').value = veiculo.idCor
    document.getElementById('responsavel').value = veiculo.idCliente
    document.getElementById('placa').dataset.id = veiculo.id
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
        "idCor": document.getElementById('cor').value,
        "idCliente": document.getElementById('responsavel').value
    }

    if(form.reportValidity()) {
        console.log(isEdit())
        if (isEdit()) {
            veiculo.id = document.getElementById('placa').dataset.id
            console.log("uptade",veiculo)
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