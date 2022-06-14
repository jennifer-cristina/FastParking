'use strict'
//Recebe a url da api

// Inserir vagae
const url = 'https://fast-parking-senai.herokuapp.com/api/vaga'

//ler vagaes
const readVaga = async (id) => {
    const idvaga = id ? `/${id}` :  ''
    const response = await fetch(`${url}${idvaga}`)
    return await response.json()
}

//ler vagaes
const readBloco = async () => {
    const urlBloco = 'https://fast-parking-senai.herokuapp.com/api/bloco'
    const response = await fetch(urlBloco)
    return await response.json()
}

const readTipoVaga = async () => {
    const urlTipoVaga = 'https://fast-parking-senai.herokuapp.com/api/tipovaga'
    const response = await fetch(urlTipoVaga)
    return await response.json()
}

//criar vagae
const createVaga = async (vaga) => {
    const options = {
        'method': 'POST',
        'body': JSON.stringify(vaga),
        'headers': {
            'content-type': 'application/json'
        }
    }

    const response = await fetch(url, options)
    console.log (response.ok)
}

//deletar vagae
const deleteVaga = async (codigo) => {
    const options = {
        'method': 'DELETE'
    }

    const response = await fetch(`${url}/${codigo}`, options)
    console.log (response.ok)

}

//atualizar vaga
const uptadeVaga = async (vaga) => {

    console.log ("teste", vaga)
    const options = {
        'method': 'POST',
        'body': JSON.stringify(vaga),
        headers: {
            'content-type': 'application/json'
        }  
    }

    const response = await fetch(`${url}/${vaga.id}`, options)
    console.log ('UPDATE', response.ok)
}



export {
    readVaga, createVaga, deleteVaga, uptadeVaga, readBloco, readTipoVaga
}