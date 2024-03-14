<?php
session_start();
// Incluir a conexão com banco de dados
include_once './config.php';

// Receber os dados do formulário
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);


// Validar o campo nome_usuario, acessa o IF quando o campo está vazio 
if (empty($dados['usuario'])) {
    // Criar o array com status e a mensagem de erro
    $retorna = ['status' => false, 'msg' => "Erro: Necessário preencher o campo nome!"];
} elseif (empty($dados['email'])) { // Validar o campo email_usuario, acessa o ELSEIF quando o campo está vazio 
    // Criar o array com status e a mensagem de erro
    $retorna = ['status' => false, 'msg' => "Erro: Necessário preencher o campo e-mail!"];
} elseif(empty($dados['telefone'])){
    $retorna = ['status' => false, 'msg' => "Erro: Necessário preencher o campo telefone!"];
}elseif(empty($dados['rifanumber'])){
    $retorna = ['status' => false, 'msg' => "Erro: Necessário preencher o campo email de confimaçao!"];
}else{ // Acessa o ELSE quando todos os campo estão preenchidos
    // Criar a QUERY para cadastrar usuário no banco de dados
    $query_usuario = "INSERT INTO usuarios (nome, email, telefone,rifanumeber,) VALUES (:nome, :email, :telefone, :rifanumber)";
    // Preparar a QUERY
    $cad_usuario = $conn->prepare($query_usuario);
    // Usar o bindParam para substituir o link da QUERY pelo valor que vem do formulário 
    $cad_usuario->bindParam(':nome', $dados['nome']);
    // Usar o bindParam para substituir o link da QUERY pelo valor que vem do formulário 
    $cad_usuario->bindParam('email:', $dados['email']);
     // Usar o bindParam para substituir o link da QUERY pelo valor que vem do formulário 

     $cad_usuario->bindParam(':telefone',$dados['telefone']);
     $cad_usuario->bindParam(':rifanumber',$dados['rifanumber']);
    // Executar a QUERY com PHP e PDO
    $cad_usuario->execute();
    // Acessa o IF quando cadastrar o registro no banco de dados
if ($cad_usuario->rowCount()) {
        // Criar o array com status e a mensagem de sucesso
        $retorna = ['status' => true, 'msg' => "Usuário cadastrado com sucesso!"];
    } else { // Acessa o ELSE quando não cadastrar o registro no banco de dados
        // Criar o array com status e a mensagem de erro
        $retorna = ['status' => false, 'msg' => "Erro: Usuário não cadastrado com sucesso!"];
    }
}
echo json_encode($retorna);