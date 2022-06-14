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


const saveDados = () => {

    const placaPreenchida = document.getElementById('placa').value
    const data = document.getElementById('dataEntrada').value
    const horaEntrada = document.getElementById('horaEntrada').value



    placaPreenchida = document.getElementById('placaCadastro').text
    data= document.getElementById('horaCadastro').text
    horaEntrada= document.getElementById('dataCadastro').text



}

const saveControle = async () => {

    const form = document.getElementById('modal-form')

    const porteVeiculo = document.getElementById('dataEntrada').value

    const horaEntrada = document.getElementById('horaEntrada').value

    console.log(porteVeiculo)

    console.log(horaEntrada);

    function dateToEN(date) {   
        return date.split('/').reverse().join('-');
    }
    
    const dataEN = dateToEN(porteVeiculo)

   

    

    // criar um json com as informações do cliente
    const controle = 
    {
        "id": '',
        "horaEntrada": horaEntrada,
        "horaSaida": '',
        "dataEntrada": dataEN,
        "dataSaida": '',
        "idVeiculo": document.getElementById('placa').value,
        "idVaga": document.getElementById('vagaVeiculo').value
    }

    console.log(controle);
    
    if(form.reportValidity()) {
       createControle(controle)
       saveDados()
    }
}


document.getElementById('enviar').addEventListener('click', saveControle)



