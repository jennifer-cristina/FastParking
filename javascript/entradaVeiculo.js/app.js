'use strict'

import {
    readVaga, readVeiculo, createControle
} from './entradaVeiculo.js'

const criarOptions = ({id}) => {
    const option = document.createElement('option')
    option.value = id
    option.textContent = id
    

    return option
    
}

const carregarVaga = async () =>{
    const container = document.getElementById('vagaVeiculo')
    const vagas = await readVaga()
    const option = vagas.map(criarOptions)
    container.replaceChildren(...option)
    
    return option
}

carregarVaga()

const criarOptionsVeiculo = ({id,placa}) => {
    const option = document.createElement('option')
    option.value = id
    option.textContent = placa
    
   
    return option
    
}

const carregarVeiculo = async () =>{
    const container = document.getElementById('placa')
    const vagas = await readVeiculo()
    const option = vagas.map(criarOptionsVeiculo)
    container.replaceChildren(...option)
    
     return option

}
carregarVeiculo()


const saveControle = async () => {

    const form = document.getElementById('modal-form')

    // criar um json com as informações do cliente
    const controle = 
    {
        "id": '',
        "horaEntrada": '22:10',
        "horaSaida": '',
        "dataEntrada": '2022/06/13',
        "dataSaida": '',
        "idVeiculo": document.getElementById('placa').value,
        "idVaga": document.getElementById('vagaVeiculo').value
    }
    
    if(form.reportValidity()) {
       createControle(controle)
    }
}

document.getElementById('enviar').addEventListener('click', saveControle)


