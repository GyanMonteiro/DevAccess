<?php 
session_start();
include("conexao.php");

// Validar e limpar os dados do usuário e tarefa, se necessário
$postUsuario = trim($_POST['to-usuario']);
$tarefa = trim($_POST['tarefa']);

// Consulta preparada para selecionar dados do usuário
$sql_code = "SELECT * FROM usuarios WHERE usuario = ?";
$stmt = $mysqli->prepare($sql_code);
$stmt->bind_param('s', $postUsuario);
$stmt->execute();

$resultadoPesquisa = $stmt->get_result();
$dados_usuarios = mysqli_fetch_assoc($resultadoPesquisa);

if ($dados_usuarios) {
    // Usuário encontrado, obter o nome e outros dados necessários
    $nome = $dados_usuarios['nome'];
    $usuario = mysqli_real_escape_string($mysqli, $postUsuario);
    $situacao = 'Aberto';

    // Consulta preparada para inserir dados na tabela de tarefas
    $sql = "INSERT INTO tarefas (nome, usuario, tarefa, situacao) VALUES (?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ssss', $nome, $usuario, $tarefa, $situacao);

    if ($stmt->execute()) {
        $_SESSION['status_cadastro'] = true;
        header('Location: tarefas.php');
    } else {
        // Trate os erros da consulta de inserção, se necessário
        echo "Erro ao inserir tarefa: " . $stmt->error;
    }
} else {
    // Usuário não encontrado, trate o cenário de usuário não existente
    echo "Usuário não encontrado.";
}

$stmt->close();
$mysqli->close();
?>