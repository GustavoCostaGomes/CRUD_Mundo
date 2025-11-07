document.addEventListener('DOMContentLoaded', () => {
    
    const botoesExcluir = document.querySelectorAll('.btn-excluir'); // Chama a classe do botão de excluir

    botoesExcluir.forEach(botao => {
        botao.addEventListener('click', event => {
            const confirmacao = confirm('Tem certeza de que deseja deletar este registro?');
            if (!confirmacao) {
                event.preventDefault(); // Caso o usuário cancele a exclusão
            }
        });
    });
});

document.addEventListener("DOMContentLoaded", () => {
    const searchPaises = document.getElementById("search-paises");   // pesquisa de país
    if (searchPaises) {
        searchPaises.addEventListener("input", () => {
            const termo = searchPaises.value.toLowerCase();
            document.querySelectorAll(".card").forEach(card => {
                const texto = card.textContent.toLowerCase();
                card.style.display = texto.includes(termo) ? "block" : "none";
            });
        });
    }

    const searchCidades = document.getElementById("search-cidades");    // pesquisa de cidade
    if (searchCidades) {
        searchCidades.addEventListener("input", () => {
            const termo = searchCidades.value.toLowerCase();
            document.querySelectorAll(".card").forEach(card => {
                const texto = card.textContent.toLowerCase();
                card.style.display = texto.includes(termo) ? "block" : "none";
            });
        });
    }
});


document.addEventListener("DOMContentLoaded", () => {           // aguarda o carregamento página
    const paisNome = document.querySelector(".titulo h2")?.textContent.trim();  // pega o nome do país
    const infoContainer = document.getElementById("api-info");  // pega a div do html

    if (!paisNome) {
        console.error("Nome do país não encontrado na página.");
        return;
    }

    // Faz a requisição para a API REST Countries
    fetch(`https://restcountries.com/v3.1/name/${encodeURIComponent(paisNome)}?fullText=true`) // encodeURIComponent() garante que o nome do país funcione mesmo com acentos ou espaços
        .then(response => response.json())
        .then(data => {
            if (!data || data.status === 404) {
                return fetch(`https://restcountries.com/v3.1/name/${encodeURIComponent(paisNome)}`)
                    .then(response => response.json());
            }
            return data;
        })
        .then(data => {
            if (!data || !Array.isArray(data) || !data[0]) {
                return; // impede erro caso o país não exista na API
            }

            // pega os dados do país
            const pais = data[0];
            const capital = pais.capital ? pais.capital[0] : "Não disponível";
            const regiao = pais.region || "Não disponível";
            const subregiao = pais.subregion || "Não disponível";
            const area = pais.area ? `${pais.area.toLocaleString()} km²` : "Não disponível";
            const moeda = pais.currencies ? Object.values(pais.currencies)[0].name : "Não disponível";

            // exibe no html
            infoContainer.innerHTML = `
                <div class="api-card">
                    <ul>
                        <li><strong>Capital:</strong> ${capital}</li>
                        <li><strong>Região:</strong> ${regiao}</li>
                        <li><strong>Sub-região:</strong> ${subregiao}</li>
                        <li><strong>Área:</strong> ${area}</li>
                        <li><strong>Moeda:</strong> ${moeda}</li>
                    </ul>
                </div>
            `;
        })
        .catch(error => {
            // caso de algum erro
            console.error("Erro ao buscar dados do país:", error);
        });
});

