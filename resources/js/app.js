import './bootstrap';
import.meta.glob(["../images/**", "../fonts/**"]);

// jQuery
import $ from 'jquery';
window.$ = window.jQuery = $;

// Bootstrap (usando ES modules — NÃO use o bundle)
import 'bootstrap';

// DataTables + Bootstrap 5
import 'datatables.net-bs5';
import 'datatables.net-bs5/css/dataTables.bootstrap5.css';

// Inicialização global
$(document).ready(function () {
    $('#minhaTabela').DataTable();
});

// script botão copiar para área de transferência //
document.addEventListener('DOMContentLoaded', function () {
    const copyButton = document.getElementById('copyButton');
    const feedbackElement = document.getElementById('copyFeedback');

    if (copyButton) {
        copyButton.addEventListener('click', function () {
            const targetId = this.getAttribute('data-clipboard-target').substring(1);
            const targetElement = document.getElementById(targetId);

            if (!targetElement) {
                console.error("Elemento alvo não encontrado.");
                return;
            }

            const textToCopy = targetElement.value || targetElement.textContent;

            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(textToCopy)
                    .then(() => {
                        feedbackElement.style.display = 'inline';
                        setTimeout(() => {
                            feedbackElement.style.display = 'none';
                        }, 2000);
                    })
                    .catch(err => {
                        console.error('Falha ao copiar usando API Clipboard: ', err);
                        fallbackCopyTextToClipboard(targetElement);
                    });
            } else {
                fallbackCopyTextToClipboard(targetElement);
            }
        });
    }

    function fallbackCopyTextToClipboard(targetElement) {
        let successful = false;
        try {
            targetElement.select();
            document.execCommand('copy');
            successful = true;
        } catch (err) {
            console.error('Falha ao usar execCommand: ', err);
        }

        if (successful) {
            feedbackElement.style.display = 'inline';
            setTimeout(() => {
                feedbackElement.style.display = 'none';
            }, 2000);
        } else {
            alert('Não foi possível copiar o texto. Tente novamente.');
        }
    }
});

// script para popular select equipamentos //
document.addEventListener('DOMContentLoaded', function() {

        const selectMarca = document.getElementById('marca');
        const selectEquipamento = document.getElementById('equipamento');

        selectMarca.addEventListener('change', function() {

            // Pega o ID da marca selecionada
            const marcaId = this.value;

            // Limpa a select de equipamento
            selectEquipamento.innerHTML = '<option value="">Carregando...</option>';

            if (marcaId) {

                // Constrói a URL para a requisição AJAX
                const url = `/equipaments/por-marca/${marcaId}`;

                // 1. Faz a requisição AJAX (usando Fetch API)
                fetch(url)
                .then(response => response.json()) // 2. Transforma a resposta em JSON
                .then(data => {

                    // 3. Limpa e popula a select Equipamento
                    selectEquipamento.innerHTML = '<option value="">Selecione o Equipamento</option>';

                    if (data.length > 0) {

                        data.forEach(equipamento => {
                            const option = document.createElement('option');
                            option.value = equipamento.id;
                            option.textContent = equipamento.nome; // Supondo que a coluna seja 'nome'
                            selectEquipamento.appendChild(option);
                        });
                    } else {
                        selectEquipamento.innerHTML = '<option value="">Nenhum equipamento encontrado</option>';
                    }
                })
                                    .catch(error => {
                                        console.error('Erro ao buscar equipamentos:', error);
                                        selectEquipamento.innerHTML = '<option value="">Erro ao carregar dados</option>';
                                    });
            } else {
                // Se nenhuma marca for selecionada, reseta a select de equipamento
                selectEquipamento.innerHTML = '<option value="">Selecione o Equipamento</option>';
            }
        });
    });

// script botão voltar ao topo //
document.addEventListener('DOMContentLoaded', function() {
        const scrollBtn = document.getElementById('scrollToTopBtn');

        // 1. Mostrar/Esconder o botão ao rolar a página
        window.onscroll = function() {
            // Verifica se a rolagem vertical (scrollY) é maior que 200 pixels
            if (window.scrollY > 200) {
                scrollBtn.classList.add('show');
            } else {
                scrollBtn.classList.remove('show');
            }
        };

        // 2. Comportamento ao clicar no botão
        scrollBtn.onclick = function() {
            // Utiliza o método scrollTo com o objeto de opções
            window.scrollTo({
                top: 0, // Define o destino da rolagem para o topo (0px)
                behavior: 'smooth' // Faz a rolagem de forma suave (animada)
            });
        };
        });

        // script alternar modo claro/escuro //
        function getTheme(){
            return localStorage.getItem('theme') || (window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"
            );
        }
        document.getElementById("themeToggle").addEventListener("click", function(){
            const currentTheme = getTheme();
            const newTheme = currentTheme === "dark" ? "light" : "dark";
            document.documentElement.setAttribute("data-bs-theme", newTheme);
            localStorage.setItem("theme", newTheme);
        });
        document.documentElement.setAttribute("data-bs-theme", getTheme());

            document.getElementById('share-button').addEventListener('click', function() {

                const fileId = this.getAttribute('data-file-id');
                const url = `/file/${fileId}/share`;
                const token = document.querySelector('meta[name="csrf-token"]').content;

                // Requisição AJAX para gerar o link
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Exibe o link assinado no campo de texto
                        const input = document.getElementById('share-link-input');
                        input.value = data.share_url;
                        document.getElementById('share-link-container').style.display = 'block';
                        input.select(); // Seleciona o texto para fácil cópia
                        alert(data.message);
                    } else {
                        alert('Erro ao gerar link.');
                    }
                })
                .catch(error => {
                    console.error('Erro:', error);
                    alert('Ocorreu um erro ao processar a requisição.');
                });
            });

    document.addEventListener('DOMContentLoaded', function() {
        const followBtn = document.getElementById('follow-btn');
        const followersCountSpan = document.getElementById('followers-count');
        const messageBox = document.getElementById('status-message'); // O nosso "alert" estilizado

        if (followBtn) {
            followBtn.addEventListener('click', function() {
                const userIdToFollow = this.getAttribute('data-user-id');
                const url = `/user/${userIdToFollow}/follow`;
                const token = document.querySelector('meta[name="csrf-token"]').content;

                // Função para manipular a exibição da mensagem
                const displayMessage = (message, type) => {
                    messageBox.style.display = 'block';
                    messageBox.classList.remove('success', 'error', 'btn-primary', 'btn-secondary');
                    messageBox.classList.add(type); // Adiciona 'success' ou 'error' para estilização
                    messageBox.textContent = message;

                    // Esconde a mensagem após 5 segundos
                    setTimeout(() => {
                        messageBox.style.display = 'none';
                    }, 5000);
                };

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                })
                .then(response => {
                    if (!response.ok) {
                        // Trata respostas HTTP que não são 2xx (ex: 403, 500)
                        throw new Error('Ação não permitida ou erro no servidor.');
                    }
                    return response.json();
                })
                .then(data => {
                    // 1. Atualiza o texto do botão
                    if (data.status === 'following') {
                        followBtn.textContent = 'Parar de Seguir';
                        followBtn.classList.remove('btn-primary');
                        followBtn.classList.add('btn-secondary');
                    } else {
                        followBtn.textContent = 'Seguir';
                        followBtn.classList.remove('btn-secondary');
                        followBtn.classList.add('btn-primary');
                    }

                    // 2. Atualiza a contagem de seguidores
                    if (followersCountSpan && data.followers_count !== undefined) {
                        followersCountSpan.textContent = data.followers_count;
                    }

                    // 3. Exibe a mensagem de sucesso
                    displayMessage(data.message, 'success');

                })
                .catch(error => {
                    // Exibe a mensagem de erro (incluindo erros de rede/servidor)
                    displayMessage('Erro: ' + error.message, 'error');
                    console.error('Erro:', error);
                });
            });
        }
    });


// script curtir/descurtir comentário //
function updateIcons(commentId, userLike, userDislike) {
    const likeIcon = document.getElementById(`icon-like-${commentId}`);
    const dislikeIcon = document.getElementById(`icon-dislike-${commentId}`);

    if (userLike) {
        likeIcon.classList.remove("bi-hand-thumbs-up");
        likeIcon.classList.add("bi-hand-thumbs-up-fill");
    } else {
        likeIcon.classList.remove("bi-hand-thumbs-up-fill");
        likeIcon.classList.add("bi-hand-thumbs-up");
    }

    if (userDislike) {
        dislikeIcon.classList.remove("bi-hand-thumbs-down");
        dislikeIcon.classList.add("bi-hand-thumbs-down-fill");
    } else {
        dislikeIcon.classList.remove("bi-hand-thumbs-down-fill");
        dislikeIcon.classList.add("bi-hand-thumbs-down");
    }
}

document.addEventListener('DOMContentLoaded', () => {

    document.querySelectorAll('.btnLike').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const commentId = this.dataset.id;

            fetch('/comment/like', {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ comment_id: commentId })
            })
            .then(res => res.json())
            .then(data => {
                document.getElementById(`like-count-${commentId}`).innerText = data.likes;
                document.getElementById(`dislike-count-${commentId}`).innerText = data.dislikes;
                updateIcons(commentId, data.user_like, data.user_dislike);
            });
        });
    });

    document.querySelectorAll('.btnDislike').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const commentId = this.dataset.id;

            fetch('/comment/dislike', {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ comment_id: commentId })
            })
            .then(res => res.json())
            .then(data => {
                document.getElementById(`like-count-${commentId}`).innerText = data.likes;
                document.getElementById(`dislike-count-${commentId}`).innerText = data.dislikes;
                updateIcons(commentId, data.user_like, data.user_dislike);
            });
        });
    });
});
