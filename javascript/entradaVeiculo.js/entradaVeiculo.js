'use strict'



const readVaga = async () => {
    const urlVaga = 'https://fast-parking-senai.herokuapp.com/api/vaga'
    const response = await fetch (urlVaga)
    const data = await response.json()
    return data
}

const readVeiculo = async (id='') => {
    const idVeiculo = id ? `/${id}` :  ''
    const urlVeiculo = 'https://fast-parking-senai.herokuapp.com/api/veiculo'
    const response = await fetch (`${urlVeiculo}${idVeiculo}`)
    const data = await response.json()
    return data
}

const createControle = async (controle) => {

    //url
    const url = 'https://fast-parking-senai.herokuapp.com/api/controle'
    const options = {
        'method': 'POST',
        'body': JSON.stringify(controle),
        'headers': {
            'content-type': 'application/json'
        }
    }
    const response = await fetch(url, options)
    console.log (response.ok)
}


const dataAtual = () => {
    var data = new Date();

    var dia = String(data.getDate()).padStart(2, '0');
    var mes = String(data.getMonth() + 1).padStart(2, '0');
    var ano = data.getFullYear();
    var horas = data.getHours();
    var minutos = data.getMinutes();
    var dataAtual = dia + '/' + mes + '/' + ano + ' ás ' + horas + ':' + minutos ;

    return dataAtual
}


const horario = () => {
    const porteVeiculo = document.getElementById('dataEntrada')
    const horas = dataAtual


    porteVeiculo.innerHTML = `
        <option>Selecione a data</option>
        <option>
            ${horas(`</option>${horas}<option>`)}
        </option>
        `
    return porteVeiculo
}

horario()
 
// const placa = document.getElementById('placa')

// console.log(placa.value)

// // const carregarClientes = async() => {

// //     const container = document.getElementById('imagem-container')
// //     const raca = document.getElementById('raca').value
// //     const imagens = await pesquisarDog(raca)

// //     const tagImagens = imagens.message.map(criarImg)

// //     container.replaceChildren(...tagImagens)
// // }

// const procurarPlaca = async(placa) => {

//     // Colocanda o caminho da URL
//     const  url = `https://fast-parking-senai.herokuapp.com/api/veiculo/placa/${placa}`

//     // Await: Espera vir o resultado do Fetch para dar a resposta
//     // Fetch faz a requisição da url
//     const response = await fetch(url)

//     // Await: Espera vir o resultado do Fetch para dar a resposta
//     // const data irá receber a resposta em Json()
//     const data = await response.json()

//     return data
// } 

// const preencherFormulario = async() => {

//     // Enderco vai receber um método que recebe o valor do CEP
//     const infoClientes = await procurarPlaca(placa.textContent)
//     console.log(infoClientes)

//     return document.getElementById(`nomeCliente`).textContent = '4657-ajsh'

// }

// placa.addEventListener('change', preencherFormulario)

export {
    readVaga, readVeiculo,createControle
}