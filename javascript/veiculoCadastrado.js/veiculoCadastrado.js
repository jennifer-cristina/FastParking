const url = 'https://fast-parking-senai.herokuapp.com/api/veiculo'

const readVaga = async(id) => {
    const idVeiculo = id ? `/${id}` :  ''
    const response = await fetch(`${url}${idVeiculo}`)
    return await response.json()
}

const trazerVeiculos = async () => {
    const url = ``
    const response = await fetch(url)
    const data = await response.json()
    // Retorna as chaves dos arrays de um objeto
    return data
}
console.log(await readVaga())
export {readVaga}

