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
