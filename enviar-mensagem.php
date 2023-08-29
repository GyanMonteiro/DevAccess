<?php 
session_start();
include("conexao.php");

    $sql_code = "SELECT * FROM usuarios WHERE usuario = ?";
    $stmt = $conexao->prepare($sql_code);
    $postUsuario = trim($_POST['to-usuario']);
    $stmt->bind_param('s', $postUsuario);
    $stmt->execute();
    
    $resultadoPesquisa = $stmt->get_result();
    $dados_usuarios = mysqli_fetch_assoc($resultadoPesquisa);

    $nome = $dados_usuarios['nome'];
    $usuario = mysqli_real_escape_string($conexao, trim($_POST['to-usuario']));
    $remetente = $_SESSION['nome'];
    $menssagem = mysqli_real_escape_string($conexao, trim($_POST['menssagem']));

    $sql = "SELECT COUNT(*) AS total FROM usuarios WHERE usuario = '$usuario'";
    $result = mysqli_query($conexao, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row['total'] = 0) {
        $_SESSION['usuario_nao_existe'] = true;
        header('Location: cadastro.php?usuario_nao_existe=true');
        exit;
}

    $sql = "INSERT INTO notificacoes (nome, usuario, remetente, mensagem) VALUES ('$nome', '$usuario', '$remetente', '$menssagem')";


    if ($conexao->query($sql) === TRUE) {
        $_SESSION['status_cadastro'] = true;
        header('Location: main.php');
    } else {
        echo "Erro: " . $sql . "<br>" . $conexao->error;
    }
    $stmt->close();
    $conexao->close();

?>