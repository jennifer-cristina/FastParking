const cliente = [
    {
        "id": 1,
        "nome": "Jennifer Cristina",
        "cpf": "564.656.545-56",
        "idSexo": 1
    },
    {
        "id": 2,
        "nome": "João",
        "cpf": "564.656.545-56",
        "idSexo": 1
    }
]

const telefone = [
    {
        "id": 1,
        "ddd": "(11)",
        "numero": "94575-6254",
        "idCliente": 1
    }
]

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

const cor = [
    {
        "id": 1,
        "nome": "Vermelho"
    },
    {
        "id": 2,
        "nome": "Marro"
    }
]

const tipoVaga = [
    {
        "id": 1,
        "nome": "Grande porte"
    },
    {
        "id": 2,
        "nome": "Médio porte"
    },
]

const bloco = [
    {
        "id": 1,
        "nome": "A2",
        "capacidadeMaxima": 20
    },
]

const Veiculo = [
    {
        "id": 1,
        "placa": "1254-ASGD",
        "idCor": 1,
        "idVaga": 1,
        "idCliente": 1,
    }
]

const vaga = [
    {
        "id": 1,
        "statusVaga": true,
        "preferencial": false,
        "idTipoVaga": 1,
        "idBloco": 1
    }
]

const controle = [
    {
        "id": 1,
        "horaEntrada": "16:05:00",
        "horaSaida": null,
        "dataEntrada": "2022-06-01",
        "dataSaida": null,
        "idVeiculo": 1
    }
]

export{
    sexo
}