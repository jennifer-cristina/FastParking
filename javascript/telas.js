// Criando o card com os jogos que buscamos 
const criarAside = () => {
    
    const card = document.querySelector('aside')
    card.classList.add('aside')
    card.innerHTML = `
    <div class="logo">
        <img src="../IMGs/image 12.png" alt="">
    </div>
        <div class="menu">
            <ul>
                <li>
                    <a href="../pages/cadastroClientes.html">
                    <img src="../IMGs/person.png" alt="">
                    </a>
                    <span>CLiente</span>
                </li>
                <li>
                    <a href="../pages/cadastroVeiculos.html">
                    <img src="../IMGs/car.png" alt="">
                    </a>
                    <span>Veículos</span>
                </li>
                <li>
                    <a href="./entradaVeiculos.html">
                    <img src="../IMGs/cadastrar.png" alt="">
                    </a>
                    <span>Entrada</span>
                </li>
                
                <li>
                    <a href="./pesquisarVeiculos.html">
                    <img src="../IMGs/pesquisar.png" alt="">
                    </a>
                    <span>Pesquisa</span>
                </li>
                
                <li>
                    <a href="../pages/cadastroVagas.html"">
                        <img src="../IMGs/vagas.png" alt="">
                    </a>
                    <span>Vagas</span>
                </li>
                
                <li>
                    <a href="../pages/relatorioDados.html">
                    <img src="../IMGs/relatórios.png" alt="">
                    </a>
                    <span>Relatórios</span>
                </li>
            </ul>
        </div>
        <a href="../login.html">
            <img src="../IMGs/sair (3) 1.png" alt="">
        </a>
    </div>
    
    `

    return card
}

const carregarAside = () => {
    const container = document.querySelector('aside')
    const card = criarAside()
    container.appendChild(card)
}

carregarAside()
