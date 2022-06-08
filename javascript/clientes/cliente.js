'use strict'

const sexo = [
    {
        "id": 1,
        "sigla": "F",
        "nome": "Feminino"
    },
    {
        "id": 2,
        "sigla": "M",
        "nome": "Masculino"
    },
    {
        "id": 3,
        "sigla": "O",
        "nome": "Outros"
    }
]

//Recebe a url da api

// Inserir Cliente
const url = 'http://10.107.134.63/fastParking/FastParking/api/cliente'

//ler clientes
const readCustomers = async (id='') => {
    const response = await fetch(`${url}`)
    const data = await response.json()
    return data
}

readCustomers()
// const pegarCliente = async (id = '') => {
//     const url = `http://10.107.134.63/fastParking/FastParking/api/cliente/${id}`
//     const response = await fetch(url)
//     const data = await response.json()
//     return data
// }

console.log( await readCustomers())

//ler sexo
const readSex = async () => {
    const urlSexo = 'http://10.107.134.63/fastParking/FastParking/api/sexo'
    const response = await fetch (urlSexo)
    const data = await response.json()

    return data
}

//criar cliente
const createClient = async (client) => {
    const options = {
        'method': 'POST',
        'body': JSON.stringify(client),
        'headers': {
            'content-type': 'application/json'
        }
    }

    const response = await fetch(url, options)
    console.log (response.ok)
}

//deletar cliente
const deleteClient = async (codigo) => {
    const options = {
        'method': 'DELETE'
    }

    const response = await fetch(`${url}/${codigo}`, options)
    console.log (response.ok)

}

//atualizar cliente
const updateClient = async (client) => {
    const options = {
        'method': 'PUT',
        'body': JSON.stringify(client),
        headers: {
            'content-type': 'application/json'
        }  
    }

    const response = await fetch(`${url}/${client.id}`, options)
    console.log ('UPDATE', response.ok)
}



export {
    readCustomers, createClient, deleteClient, updateClient, readSex
}