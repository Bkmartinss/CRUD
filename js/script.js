// js/script.js

$(document).ready(function() {//documento completamente carregado

    $('.toggle-status').click(function() {//clique 
        let userId = $(this).data('id');// ID no data-id 
        // requisição alternar o status do usuário
        $.ajax({
            url: 'toggle_status.php', 
            type: 'POST', // Método 
            data: { id: userId }, // enviado ID 
            success: function() {
                location.reload(); //recarrega a pagina
            }
        });
    });


    $('.delete').click(function() {
        
        if (confirm('Tem certeza que deseja remover este usuário?')) {// confirmação p usuário
            let userId = $(this).data('id');//ID removido
            
            $.ajax({
                url: 'delete.php', 
                type: 'POST', 
                data: { id: userId }, 
                success: function() {
                    location.reload(); //recarrega 

                }
            });
        }
    });
});
