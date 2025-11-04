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