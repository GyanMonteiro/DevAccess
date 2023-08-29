<?php 
    $mensagem = '';
    $mensagemUsuario = '';
    $mensagemSenha = '';

    session_start();
    include('conexao.php');
    if (isset($_POST['usuario']) && isset($_POST['senha'])){
        if(strlen($_POST['usuario']) == 0){
            $mensagemUsuario = 'Preencha o campo de usuário';
        } else if(strlen($_POST['senha']) == 0) {
            $mensagemSenha = 'Preencha o campo de senha';
        }
        else{
            $usuario = $conexao->real_escape_string($_POST['usuario']);
            $senha = $conexao->real_escape_string($_POST['senha']);

            $sql_code = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
            $sql_query = $conexao->query($sql_code) or die("FALHA");

            $quantidade = $sql_query->num_rows;

            if($quantidade == 1) {
                $usuarios = $sql_query->fetch_assoc();
                $hash_armazenado = $usuarios['senha'];

                if (password_verify($senha, $hash_armazenado)) {
                    if(!isset($_SESSION)){
                        session_start();
                    }

                    $_SESSION['id'] = $usuarios['id'];
                    $_SESSION['nome'] = $usuarios['nome'];
                    $_SESSION['usuario'] = $usuarios['usuario'];
                    $_SESSION['profissao'] = $usuarios['profissao'];

                    header("Location: main.php");
                } else {
                    $mensagem = 'Senha ou email incorretos!';
                }
            } else {
                    $mensagem = 'Senha ou email incorretos!';
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/styles/style.css">
    <title>Document</title>
</head>
<body>
    <div class="main-div">
        <div class="left-login">
            <h1>Faça login<br>E entre para o nosso time</h1>
            <img src="src/img/astronauta.svg" class="left-login-img" alt="">
        </div>
        <div class="right-login">
            <div class="card-login">
                <h1>LOGIN</h1>
                <form action="" method="post">
                    <span class="mensagem"><?php echo $mensagem;?></span>
                    <div class="textfield">
                    <label for="usuario">Usuário</label>
                    <input type="text" name="usuario" id="usuario" placeholder="Usuário">
                    <span class="mensagem"><?php echo $mensagemUsuario;?></span>
                </div>
                <div class="textfield">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" id="senha" placeholder="Senha">
                    <span class="mensagem"><?php echo $mensagemSenha;?></span>
                </div>
                <input type="submit" value="login" class="btn">
                <input type="submit" value="registre-se" class="btn regist" formaction="cadastro.php">
                </form>
            </div>
        </div>
    </div>
</body>
</html>