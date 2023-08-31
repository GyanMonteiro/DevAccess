<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style-login-registro.css">
    <title>DevAccess - Cadastro</title>
    <link href="img/icon.png" rel="icon">
</head>
<body>
    <div class="main-div">
        <div class="left-login">
            <h1>Faça o registro<br>E decole conosco</h1>
            <img src="img/astronauta2.svg" class="left-login-img" alt="">
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
                    <span class="mensagem" id="mensagem-usuario"></span>
                </div>
                <div class="textfield">
                    <label for="profissao">Sua profissão</label>
                    <div class="dropdown">
                        <div class="select">
                            <span class="selected">Profissao</span>
                            <div class="caret"></div>
                        </div>
                        <ul class="menu">
                            <li class="active">Desenvolvedor Back-End</li>
                            <li>Desenvolvedor Front-End</li>
                            <li>UX Designer</li>
                        </ul>
                    </div>
                    <input type="hidden" name="profissao_selecionada" id="profissaoSelecionada" value="">
                </div>
                <div class="textfield">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Email">
                    <span class="mensagem" id="mensagem-email"></span>
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
                        const dropdowns = document.querySelectorAll('.dropdown');

                        dropdowns.forEach(dropdown => {
                            const select = dropdown.querySelector('.select');
                            const caret = dropdown.querySelector('.caret');
                            const menu = dropdown.querySelector('.menu');
                            const options = dropdown.querySelectorAll('.menu li');
                            const selected = dropdown.querySelector('.selected');

                            select.addEventListener('click', () => {
                                caret.classList.toggle('caret-rotate');
                                menu.classList.toggle('menu-open');
                            });

                            options.forEach(option => {
                                option.addEventListener('click', () => {
                                    selected.innerText = option.innerText;
                                    caret.classList.remove('caret-rotate');
                                    menu.classList.remove('menu-open');
                                    
                                    options.forEach(opt => {
                                        opt.classList.remove('active');
                                    });
                                    
                                    option.classList.add('active');

                                    document.getElementById('profissaoSelecionada').value = option.innerText;
                                });
                            });
                        });

    </script>
</body>
</html>
