'use strict'

import {openModal, closeModal} from './modal-vagas.js'
import {readVaga, createVaga, deleteVaga, uptadeVaga, readBloco, readTipoVaga} from './vagas.js'

const criarOptionsBloco = ({id}) => {
    const option = document.createElement('option')
    option.innerHTML = `
    <option>
        ${id}
    </option>
    
    `

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

const criarOptionsTipoVaga = ({id}) => {
    const option = document.createElement('option')
    option.innerHTML = `
    <option>
        ${id}
    </option>
    `

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

const fillForm = (vaga) => {
    
    // if(document.getElementById('statusvaga').value == 1){
    //     document.getElementById('statusvaga').checked = true 
    //     document.getElementById('statusvaga') = vaga.statusVaga
    // } else {
    //     document.getElementById('statusvaga').checked = false 
    //     document.getElementById('statusvaga') = vaga.statusVaga
    // }
    // if(document.getElementById('preferencial').value == 1){
    //     document.getElementById('preferencial').checked = true 
    //     document.getElementById('preferencial') = vaga.preferencial
    // } else {
    //     document.getElementById('preferencial').checked = false 
    //     document.getElementById('preferencial') = vaga.preferencial
    // }
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

const updateTable = async () => {

    const vagaContainer = document.getElementById('vagas-container')
    //Ler a API e armazenar o resultado em uma variavel
    const vagas = await readVaga()

    //Preencher a tabela com as informações
    const rows = vagas.map(createRow)
    vagaContainer.replaceChildren(...rows)
}


const isEdit = () => document.getElementById('statusvaga').hasAttribute('data-id')


const savevaga = async () => {

    const form = document.getElementById('modal-form')

    let checkboxStatus = document.getElementById('statusvaga')
    // 1 = Preenchido
    if(checkboxStatus.checked){
        checkboxStatus = 1
    } else {
        checkboxStatus = 0
    }

    console.log(checkboxStatus)

    let checkboxPreferencial = document.getElementById('preferencial')
    // 1 = Preenchido
    if(checkboxPreferencial.checked){
        checkboxPreferencial = 1
    } else {
        checkboxPreferencial = 0
    }

    console.log(checkboxPreferencial)

    // criar um json com as informações do vagae
    const vaga = {
        "id": "",
        "statusVaga": checkboxStatus,
        "preferencial": checkboxPreferencial,
        "idTipoVaga": document.getElementById('tipo').value,
        "idBloco": document.getElementById('bloco').value
    }

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

document.getElementById('cadastrarVaga').addEventListener('click', openModal)
document.getElementById('salvar').addEventListener('click', savevaga)
