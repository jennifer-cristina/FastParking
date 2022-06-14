'use strict'

import {readVaga, updateControle} from './veiculoCadastrado.js'

// const pegarVeiculo = (target) => {

//     document.getElementById('pesquisarPlaca').value = target

//     return target
// }

// console.log(pegarVeiculo());


const createRow = ({id, horaEntrada, dataEntrada,idVeiculo, idVaga, preco }) => {
    const results = document.createElement('tr')
    results.innerHTML = `

            <td>${horaEntrada}</td>
            <td>${dataEntrada}</td>
            <td id="idVeiculo">${idVeiculo}</td>
            <td id="idVaga">${idVaga}</td>
            <td>${preco}</td>

            <td>
            <button type="button" class="finalizar" onClick="finishControle(${id})">Finalizar</button>
            </td>

    
    `
    return results
}
console.log(createRow)

globalThis.finishControle  =  async (id) => {
    const controle = 
    {
        "id": id,
        "idVeiculo": document.getElementById('idVeiculo').textContent,
        "idVaga": document.getElementById('idVaga').textContent
    }

    return await updateControle(controle)
}


// const updateTable = async () => {

//     const clienteContainer = document.getElementById('veiculoCadastrado')
//     //Ler a API e armazenar o resultado em uma variavel
//     const controle = await readCustomers()

//     //Preencher a tabela com as informações
//     const rows = controle.map(createRow)

//     clienteContainer.replaceChildren(...rows)
// }


const pegarPlaca = async ({key, target}) => {

    if(key === 'Enter'){
        const result = await readVaga(target.value)
        console.log(result)

        const rows = result.map(createRow)

        const controleContainer = document.getElementById('veiculoCadastrado')

        controleContainer.replaceChildren(...rows)






    }
}

document.querySelector('#pesquisarPlaca').addEventListener('keypress', pegarPlaca);







