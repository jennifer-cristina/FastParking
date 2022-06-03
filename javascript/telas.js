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
                    <a href="">
                    <img src="../IMGs/person.png" alt="">
                    </a>
                    <span>CLiente</span>
                </li>
                
                <li>
                    <a href="">
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
                    <a href="">
                        <img src="../IMGs/vagas.png" alt="">
                    </a>
                    <span>Vagas</span>
                </li>
                
                <li>
                    <a href="./relatorioDados.html">
                    <img src="../IMGs/relatórios.png" alt="">
                    </a>
                    <span>Relatórios</span>
                </li>
            </ul>
        </div>
        <img src="../IMGs/sair (3) 1.png" alt="">
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

class card extends HTMLElement {
    constructor(){
        super();
        this.build()
    }

    build () {
        // Construindo o método e enviando para a constante shadow, para depois chamar no html
        const shadow = this.attachShadow({mode: 'open'})
        // Adicionando filhos que no futuro irá ser elementos
        shadow.appendChild(this.style())
        shadow.appendChild(this.createHeader())
    }

    style(){
        const style = document.createElement('style')
        // Criando uma tag e estilizando o conteúdo
        style.textContent = `
            .card{
                width: 300px;
                height: 300px;
                display: flex;
                flex-direction: column;
                justify-content: space-evenly;
                align-items: center;
                background-color: ${this.bgcolor()};
            }
            .card-turm{
                border-radius: 12px;
                width: 50%;
                padding: 4px;
                text-align: center;
                color: white;
                text-transform: uppercase;
                box-shadow: 0 0 2px #000;
            }
            .card-text{
                border-radius: 12px;
                width: 50%;
                padding: 4px;
                text-align: center;
                color: white;
                text-transform: uppercase;
                box-shadow: 0 0 2px #000;
            }
            .card-image{
                border-radius: 50%;
                width: 50%;
                height: 50%;
                background-image: ${this.bgimagem()};
                background-size: cover;
                box-shadow: inset 0 0 12px #000;
            }
        `
        return style
    }

    // Criando um elemento com a tag div
    createHeader(){
    // <div class="card">
    //     <div class="card-text">João Gabriel</div>
    //     <div class="card-image"></div>
    //     <div class="card-text">DS2T</div>
    // </div>
    const card = document.createElement('div')
    card.classList.add('card')
    card.innerHTML = `
        <div class="card-text">${this.titulo()}</div>
    `

    return card
    }

    // Criando uma função para mudar a cor do usuário pelo atributo DATA
    titulo() {
        const text = this.getAttribute('data-titulo') ?? "Entrada Veículos"
        return text
    }

}
// Definindo 
customElements.define('card-header', card)