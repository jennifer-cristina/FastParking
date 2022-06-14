'use strict'

import {readVaga, createVaga, deleteVaga, uptadeVaga, readBloco, readTipoVaga} from './vagas.js'

const criarOptionsBloco = ({id, nome}) => {
    const option = document.createElement('option')
    option.value = id
    option.textContent = nome
    
    return option
}

const carregarBloco = async () =>{
    const container = document.getElementById('bloco')
    const blocos = await readBloco()
    const option = blocos.map(criarOptionsBloco)
    container.replaceChildren(...option)
    // listaSexo.innerHTML = `
    // <option>Selecione o sexo</option>
    // <option>
    //     ${)}
    // </option>
    // `
     return option
}

carregarBloco()

const criarOptionsTipoVaga = ({id, nome}) => {
    const option = document.createElement('option')
    option.value = id
    option.textContent = nome

    return option
}

const carregarTipoVaga = async () =>{
    const container = document.getElementById('tipo')
    const tipoVaga = await readTipoVaga()
    const option = tipoVaga.map(criarOptionsTipoVaga)
    container.replaceChildren(...option)
    // listaSexo.innerHTML = `
    // <option>Selecione o sexo</option>
    // <option>
    //     ${)}
    // </option>
    // `
     return option
}

carregarTipoVaga()

const createRow = ({preferencial, statusVaga, idTipoVaga, idBloco, id}) => {
    const row = document.createElement('tr')
    row.innerHTML = `
        <td>${id}</td>
        <td>${statusVaga}</td>
        <td>${preferencial}</td>
        <td>${idTipoVaga}</td>
        <td>${idBloco}</td>
        <td>
            <button type="button" class="button green" onClick="editvaga(${id})">editar</button>
            <button type="button" class="button red" onClick="delvaga(${id})">excluir</button>
        </td>
    `
    return row
}

const updateTable = async () => {

    const vagaContainer = document.getElementById('vagas-container')
    //Ler a API e armazenar o resultado em uma variavel
    const vagas = await readVaga()

    //Preencher a tabela com as informações
    const rows = vagas.map(createRow)
    vagaContainer.replaceChildren(...rows)
}

const fillForm = (vaga) => {
    document.getElementById('statusvaga').value = vaga.statusVaga
    document.getElementById('preferencial').value = vaga.preferencial
    document.getElementById('tipo').value = vaga.idTipoVaga
    document.getElementById('bloco').value = vaga.idBloco
    document.getElementById('statusvaga').dataset.id = vaga.id
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

    let checkboxStatus = document.getElementById('statusvaga')

    let checkboxPreferencial = document.getElementById('preferencial')
    
    const vaga = {
        "id": "",
        "statusVaga": checkboxStatus.value,
        "preferencial": checkboxPreferencial.value,
        "idTipoVaga": document.getElementById('tipo').value,
        "idBloco": document.getElementById('bloco').value
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

document.getElementById('pesquisarPlaca').addEventListener('keypress', pegarPlaca)


