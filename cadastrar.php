<?php
session_start();
include("conexao.php");

$nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
$usuario = mysqli_real_escape_string($conexao, trim($_POST['usuario']));
$profissao = mysqli_real_escape_string($conexao, trim($_POST['profissao_selecionada']));
$email = mysqli_real_escape_string($conexao, trim($_POST['email']));
$senha = mysqli_real_escape_string($conexao, trim($_POST['senha']));

$hash = password_hash($senha, PASSWORD_DEFAULT);

$sql = "SELECT COUNT(*) AS total FROM usuarios WHERE usuario = '$usuario'";
$result = mysqli_query($conexao, $sql);
$row = mysqli_fetch_assoc($result);

if ($row['total'] > 0) {
    $_SESSION['usuario_existe'] = true;
    header('Location: cadastro.php?usuario_existe=true');
    exit;
}

$sql = "SELECT COUNT(*) AS total FROM usuarios WHERE email = '$email'";
$result = mysqli_query($conexao, $sql);
$row = mysqli_fetch_assoc($result);

if ($row['total'] > 0) {
    $_SESSION['email_existe'] = true;
    header('Location: cadastro.php?email_existe=true');
    exit;
}

$sql = "INSERT INTO usuarios (nome, usuario, profissao, email, senha) VALUES ('$nome', '$usuario', '$profissao', '$email', '$hash')";

if ($conexao->query($sql) === TRUE) {
    $_SESSION['status_cadastro'] = true;
    header('Location: cadastrorealizado.php');
} else {
    echo "Erro: " . $sql . "<br>" . $conexao->error;
}

$conexao->close();

?>
