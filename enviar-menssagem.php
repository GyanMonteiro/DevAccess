<?php 
session_start();
include("conexao.php");

    $sql_code = "SELECT * FROM usuarios WHERE usuario = ?";
    $stmt = $mysqli->prepare($sql_code);
    $postUsuario = trim($_POST['to-usuario']);
    $stmt->bind_param('s', $postUsuario);
    $stmt->execute();
    
    $resultadoPesquisa = $stmt->get_result();
    $dados_usuarios = mysqli_fetch_assoc($resultadoPesquisa);

    $nome = $dados_usuarios['nome'];
    $usuario = mysqli_real_escape_string($mysqli, trim($_POST['to-usuario']));
    $remetente = $_SESSION['nome'];
    $menssagem = mysqli_real_escape_string($mysqli, trim($_POST['menssagem']));

    $sql = "SELECT COUNT(*) AS total FROM usuarios WHERE usuario = '$usuario'";
    $result = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_assoc($result);


    $sql = "INSERT INTO notificacoes (nome, usuario, remetente, menssagem) VALUES ('$nome', '$usuario', '$remetente', '$menssagem')";


    if ($mysqli->query($sql) === TRUE) {
        $_SESSION['status_cadastro'] = true;
        header('Location: main.php');
    }
    $stmt->close();
    $mysqli->close();

?>