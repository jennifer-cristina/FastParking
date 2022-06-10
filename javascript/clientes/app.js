'use strict'

import {openModal, closeModal} from './modal-clientes.js'
import {readCustomers, createClient, deleteClient, updateClient, readSex} from './cliente.js'

const criarOptions = ({id}) => {
    const option = document.createElement('option')
    option.innerHTML = `
    <option>
         ${id}
    </option>
    
    `

    return option
}

const carregarSexo = async () =>{
    const container = document.getElementById('sexo')
    const sexos = await readSex()
    const option = sexos.map(criarOptions)
    container.replaceChildren(...option)
    // listaSexo.innerHTML = `
    // <option>Selecione o sexo</option>
    // <option>
    //     ${)}
    // </option>
    // `
     return option
}

carregarSexo()

const createRow = ({nome, cpf, rg, idSexo, id}) => {
    const row = document.createElement('tr')
    row.innerHTML = `
        <td>${nome}</td>
        <td>${cpf}</td>
        <td>${rg}</td>
        <td>${idSexo}</td>
        <td>
            <button type="button" class="button green" onClick="editClient(${id})">editar</button>
            <button type="button" class="button red" onClick="delClient(${id})">excluir</button>
        </td>
    `
    return row
   
}

const updateTable = async () => {

    const clienteContainer = document.getElementById('clientes-container')
    //Ler a API e armazenar o resultado em uma variavel
    const customers = await readCustomers()

    //Preencher a tabela com as informações
    const rows = customers.map(createRow)

    clienteContainer.replaceChildren(...rows)
}

const fillForm = (client) => {
    document.getElementById('nome').value = client.nome
    document.getElementById('cpf').value = client.cpf
    document.getElementById('rg').value = client.rg
    document.getElementById('sexo').value = client.idSexo
    document.getElementById('nome').dataset.id = client.id
}

globalThis.editClient = async (id) => {
    //armazenar as informações do cliente selecionado
    const client = await readCustomers(id)

    //preencher o formulario com as informações
    fillForm(client)

    //abrir o modal
    openModal()
}

globalThis.delClient = async (id) => {
    await deleteClient(id)
    updateTable
}

const isEdit = () => document.getElementById('nome').hasAttribute('data-id')

const saveClient = async () => {

    const form = document.getElementById('modal-form')

    // criar um json com as informações do cliente
    const client = 
    {
        "id": '',
        "nome": document.getElementById('nome').value,
        "cpf": document.getElementById('cpf').value,
        "rg": document.getElementById('rg').value,
        "idSexo": document.getElementById('sexo').value
    }
    
    if(form.reportValidity()) {
        if (isEdit()) {
            client.id = document.getElementById('nome').dataset.id
            await updateClient(client)
        } else {
             createClient(client)
        }

        closeModal()

        updateTable()
    }
}

updateTable()

document.getElementById('cadastrarCliente').addEventListener('click', openModal)
document.getElementById('salvar').addEventListener('click', saveClient)