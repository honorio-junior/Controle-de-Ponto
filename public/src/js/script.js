// Seleciona o elemento onde o horário será exibido
const currentTimeElement = document.getElementById('currentTime');

// Função para atualizar o horário
function atualizarHorario() {
    // Faz uma requisição para o servidor para obter o horário atual
    fetch('getTime')
        .then(response => response.json()) // Espera a resposta em JSON
        .then(data => {
            // Atualiza o conteúdo do elemento com o horário recebido
            currentTimeElement.textContent = data.hora;
        })
        .catch(error => {
            console.error('Erro ao obter o horário do servidor:', error);
        });
}

// Atualiza o horário a cada 1 segundo (1000 milissegundos)
setInterval(atualizarHorario, 1000);

// Chama a função uma vez imediatamente para mostrar o horário ao carregar a página
atualizarHorario();