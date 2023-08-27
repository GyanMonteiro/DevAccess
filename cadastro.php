<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div class="main-div">
        <div class="left-login">
            <h1>Faça o registro<br>E decole conosco</h1>
            <img src="astronauta2.svg" class="left-login-img" alt="">
        </div>
        <div class="right-login">
            <div class="card-login">
                <h1>REGISTRO</h1>
                <form action="cadastrar.php" method="post">
                <div class="textfield">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" id="nome" placeholder="Nome Completo">
                </div>
                <div class="textfield">
                    <label for="nome">Usuário</label>
                    <input type="text" name="usuario" id="usuario" placeholder="Usuário">
                    <span id="mensagem-usuario"></span>
                </div>
                <div class="textfield">
                    <label for="nome">Sua profissão</label>
                    <div class="custom-select" style="width:200px;">
                        <select>
                            <option value="0">Select car:</option>
                            <option value="1">Audi</option>
                            <option value="2">BMW</option>
                        </select>
                    </div>
                </div>
                <div class="textfield">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Email">
                    <span id="mensagem-email"></span>
                </div>
                <div class="textfield">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" id="senha" placeholder="Senha">
                </div>
                <input type="submit" name="registrar" value="registrar" class="btn">
                </form>
            </div>
        </div>
    </div>
    <script>

                        const urlParams = new URLSearchParams(window.location.search);

                        if (urlParams.has('usuario_existe')) {
                            document.getElementById('mensagem-usuario').textContent = 'Usuário já existe';
                        }if(urlParams.has('email_existe')) {
                            document.getElementById('mensagem-email').textContent = 'Email inválido';
                        }


    </script>
</body>
</html>
