'use strict'
//Recebe a url da api

// Inserir veiculoe
//  = 'http://10.107.134.63/fastParking/FastParking/api/veiculo'
const url = 'https://fast-parking-senai.herokuapp.com/api/veiculo'

//ler veiculoes
const readVeiculo = async (id='') => {
    const idveiculo = id ? `/${id}` :  ''
    const response = await fetch(`${url}${idveiculo}`)
    return await response.json()
}

console.log( await readVeiculo())

//ler veiculoes
const readCor = async () => {
    const urlCor = 'https://fast-parking-senai.herokuapp.com/api/cor'
    const response = await fetch(urlCor)
    return await response.json()
}


const readCliente = async (id='') => {
    const idCliente = id ? `/${id}` :  ''
    const urlCliente = 'https://fast-parking-senai.herokuapp.com/api/cliente'
    const response = await fetch(`${urlCliente}${idCliente}`)
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
        'method': 'POST',
        'body': JSON.stringify(veiculo),
        headers: {
            'content-type': 'application/json'
        }  
    }


    const response = await fetch(`${url}/${veiculo.id}`, options)
    console.log ('UPDATE', response.ok)
}



export {
    readVeiculo, createVeiculo, deleteVeiculo, uptadeVeiculo, readCor, readCliente
}