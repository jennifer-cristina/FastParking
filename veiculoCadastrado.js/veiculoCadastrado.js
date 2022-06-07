const url = 'https://testeleonid.herokuapp.com/clientes'

const createRow = ({ placa, cor, tipo, vaga, entrada, id }) => {
    const row = document.createElement('thread')
    row.id = 'veiculoCadastrado'
    row.innerHTML = `
            <tr>
                <th>Placa</th>
                <th>Cor</th>
                <th>Tipo</th>
                <th>Vaga</th>
                <th>Entrada</th>
            </tr>
    `
    const results = document.createElement('tbody')
    results.innerHTML = `
        <tr>
            <td>${placa}</td>
            <td>${cor}</td>
            <td>${tipo}</td>
            <td>${vaga}</td>
            <td>${entrada}</td>
            <td>
            <button type="button" class="finalizar" onClick="finishClient(${id})">Finalizar</button>
            </td>
        </tr>
    
    `
    return row, results
}

createRow()

// Método para carregar os clientes quando carregar a página
const uptadeTable = async () => {

    const clientsContainer = document.getElementById('tblVeiculos')
    // Ler a API e armazenar o resultado em uma variavel
    const clients = await readClients()
    // Preencher a tabela com as informações
    const rows = clients.map(createRow)
    // Colocando elemento por elemento no id clientsContainer
    clientsContainer.replaceChildren(...rows)
}

uptadeTable

const readClients = async(id='') => {
    const response = await fetch(`${url}/${id}`)
    return await response.json()
}

const trazerVeiculos = async () => {
    const url = `https://dog.ceo/api/breeds/list/all`
    const response = await fetch(url)
    const data = await response.json()
    // Retorna as chaves dos arrays de um objeto
    return Object.keys(data.message)
}

