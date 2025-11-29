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

