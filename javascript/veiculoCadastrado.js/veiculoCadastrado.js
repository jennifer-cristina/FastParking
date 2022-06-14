const url = 'https://fast-parking-senai.herokuapp.com/api/controle'

const readVaga = async(placa) => {
    const placaVeiculo = placa ? `/${placa}` :  ''
    const response = await fetch(`${url}${placaVeiculo}`)
    return await response.json()
}

const updateControle = async (controle) => {
    
    const options = {
        'method': 'POST',
        'body': JSON.stringify(controle),
        'headers': {
            'content-type': 'application/json'
        }  
    }
    
    const response = await fetch(`${url}/${controle.id}`, options)
    console.log ('UPDATE', response.ok)
}

export {readVaga, updateControle}

