// Recuperar do HTML o SELETOR cad-usuario-form com JavaScript

const cadUsuarioForm = document.getElementById("cad-usuario-form");


// Verificar se a constante cadUsuarioForm é TRUE
if (cadUsuarioForm) {

    // Aguardar e identificar o clique do usuário no botão cadstrar com JavaScript
    cadUsuarioForm.addEventListener("submit", async (e) => {

        // Bloquear o recarregamento da página com JavaScript
        e.preventDefault();

        // Receber os dados do formulário com JavaScript
        const dadosForm = new FormData(cadUsuarioForm);

        // Enviar os dados do JavaScript para o PHP
        const dados = await fetch("../../src/api/cadastrorifa.php", {
            method: "POST", // Enviar os dados do JavaScript para o PHP através do método POST
            body: dadosForm, // Enviar os dados do JavaScript para o PHP
        });

        // Ler o retorno do PHP com JavaScript
        const resposta = await dados.json();

        // Verificar com JavaScript se cadastrou no banco de dados
        if (resposta['status']) {
            // Usar o SweetAlert para apresentar a mensagem após cadastrar no banco de dados com PHP
            swal({
                text: resposta['msg'],
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Fechar'
            });

            // Limpar o formulário com JavaScript
            cadUsuarioForm.reset();
        } else {
            // Usar o SweetAlert para apresentar a mensagem de erro após não cadastrar no banco de dados com PHP
            swal.fire({
                text: resposta['msg'],
                icon: 'error',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Fechar'
            });
        }
        if (resposta['status1']) {
            // Usar o SweetAlert para apresentar a mensagem após cadastrar no banco de dados com PHP
            swal({
                text: resposta['msg'],
                icon: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#E1A80E',
                confirmButtonText: 'Fechar'
            });

            // Limpar o formulário com JavaScript
            cadUsuarioForm.reset();
        } 
        
    });


}

// Exemplo basico de SweetAlert2
// Criar função com JavaScript
//function alert(){
    // Apresentar a mensagem com SweetAlert
 //   Swal.fire('Sucesso', 'Usuário cadastrado com sucesso!', 'success');
//}

// Chamar a função com JavaScript
//alert();