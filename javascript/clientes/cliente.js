'use strict'

//Recebe a url da api
// const url = ''

//ler clientes
const readCustomers = async (id='') => {
    const response = await fetch(`${url}/${id}`)
    return await response.json()
}

//ler clientes
const readSex = async (id='') => {
    const response = await fetch(`${url}/${id}`)
    return await response.json()
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
    readCustomers, createClient, deleteClient, updateClient
}