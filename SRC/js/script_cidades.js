
// função que traduz o nome da cidade
async function traduzirCidadeParaIngles(cidade) {
    try {
        const url = `https://api.mymemory.translated.net/get?q=${encodeURIComponent(cidade)}&langpair=pt|en`;
        const response = await fetch(url);
        const data = await response.json();
        return data.responseData.translatedText;
    } catch (error) {
        console.error("Erro na tradução automática:", error);
        return cidade;
    }
}

document.addEventListener("DOMContentLoaded", async () => {           
    const cidadeNome = document.querySelector(".titulo h2")?.textContent.trim();  // pega o nome da cidade
    const climaContainer = document.getElementById("api-info"); // pega a div do html

    if (!cidadeNome) {
        console.error("Nome da cidade não encontrado na página.");
        return;
    }

    const apiKey = "2b4585e8860cf6f9e883458ae9faa19f"; // minha chave

    // traduz o nome da cidade
    const cidadeTraduzida = await traduzirCidadeParaIngles(cidadeNome);
    console.log(`Buscando clima para: ${cidadeTraduzida}`);

    const apiUrl = `https://api.openweathermap.org/data/2.5/weather?q=${encodeURIComponent(cidadeTraduzida)}&units=metric&lang=pt_br&appid=${apiKey}`;

    // Faz a requisição para a API OpenWeatherMap
    fetch(apiUrl)
        .then(response => {
            if (!response.ok) {
                throw new Error("Erro ao buscar dados do clima.");
            }
            return response.json();
        })
        .then(data => {
            // pega os dados da cidade
            const temperatura = data.main.temp.toFixed(1);
            const sensacao = data.main.feels_like.toFixed(1);
            const umidade = data.main.humidity;
            const condicao = data.weather[0].description;
            const icone = `https://openweathermap.org/img/wn/${data.weather[0].icon}@2x.png`;

            climaContainer.innerHTML = `
                <div class="api-card">
                    <img src="${icone}" alt="Ícone do clima" class="api-flag">
                    <ul>
                        <li><strong>Cidade:</strong> ${cidadeNome}</li>
                        <li><strong>Temperatura:</strong> ${temperatura} °C</li>
                        <li><strong>Sensação térmica:</strong> ${sensacao} °C</li>
                        <li><strong>Umidade:</strong> ${umidade}%</li>
                        <li><strong>Condição:</strong> ${condicao.charAt(0).toUpperCase() + condicao.slice(1)}</li>
                    </ul>
                </div>
            `;
        })
        .catch(error => {
            // caso aconteça algum erro
            console.error("Erro ao buscar dados do clima:", error);
            climaContainer.innerHTML = "<p>Não foi possível carregar as informações climáticas.</p>";
        });
});