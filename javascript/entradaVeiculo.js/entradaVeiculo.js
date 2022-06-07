'use strict'

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
 
const placa = document.getElementById('placa')

const carregarClientes = async() => {

    const container = document.getElementById('imagem-container')
    const raca = document.getElementById('raca').value
    const imagens = await pesquisarDog(raca)

    const tagImagens = imagens.message.map(criarImg)

    container.replaceChildren(...tagImagens)
}

const procurarPlaca = async(placa) => {

    // Colocanda o caminho da URL
    // const  url = `https://viacep.com.br/ws/${cep}/json`

    // Await: Espera vir o resultado do Fetch para dar a resposta
    // Fetch faz a requisição da url
    const response = await fetch(url)

    // Await: Espera vir o resultado do Fetch para dar a resposta
    // const data irá receber a resposta em Json()
    const data = await response.json()

    return data
} 

const preencherFormulario = async() => {

    // Enderco vai receber um método que recebe o valor do CEP
    const infoClientes = await procurarPlaca(placa.value)
    document.getElementById(`nomeCliente`).value = infoClientes.nomeCliente
    document.getElementById(`tamanhoVeiculo`).value = infoClientes.tamanhoVeiculo
}

placa.addEventListener('focusout', preencherFormulario)

