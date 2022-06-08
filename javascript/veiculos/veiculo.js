'use strict'
//Recebe a url da api

// Inserir veiculoe
const url = 'http://10.107.134.63/fastParking/FastParking/api/veiculo'

//ler veiculoes
const readVeiculo = async (id='') => {
    const response = await fetch(`${url}/${id}`)
    return await response.json()
}

//ler veiculoes
const readCor = async (id='') => {
    const response = await fetch(`${url}/${id}`)
    return await response.json()
}

//criar veiculoe
const createVeiculo = async (veiculo) => {
    const options = {
        'method': 'POST',
        'body': JSON.stringify(veiculo),
        'headers': {
            'content-type': 'application/json'
        }
    }

    const response = await fetch(url, options)
    console.log (response.ok)
}

//deletar veiculoe
const deleteVeiculo = async (codigo) => {
    const options = {
        'method': 'DELETE'
    }

    const response = await fetch(`${url}/${codigo}`, options)
    console.log (response.ok)

}

//atualizar veiculo
const uptadeVeiculo = async (veiculo) => {
    const options = {
        'method': 'PUT',
        'body': JSON.stringify(veiculo),
        headers: {
            'content-type': 'application/json'
        }  
    }

    const response = await fetch(`${url}/${veiculo.id}`, options)
    console.log ('UPDATE', response.ok)
}



export {
    readVeiculo, createVeiculo, deleteVeiculo, uptadeVeiculo
}