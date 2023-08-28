<?php 
if(!isset($_SESSION)){
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/styles/style-main.css">
    <title>Document</title>
</head>
<body>
    <section class="container">
    <nav class="sidebar close" id="sidebar">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="user-bold.svg" alt="">
                </span>

                <div class="text header-text">
                    <span class="name"><?php echo $_SESSION['nome']; ?></span>
                    <span class="profession"><?php echo $_SESSION['profissao']; ?></span>
                </div>
            </div>
            <div class="div-botao">
                <button id="bttn"><img src="close-square.svg" alt=""></button>
            </div>
        </header>

        <div class="menu-bar">
            <div class="menu">
                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="#"><img src="src/img/home.svg" alt="">
                            <span class="text nav-text">Início</span></a>
                    </li>
                    <li class="nav-link">
                        <a href="#"><img src="src/img/user-outline.svg" alt="">
                            <span class="text nav-text">Perfil</span></a>
                    </li>
                    <li class="nav-link">
                        <a href="#"><img src="src/img/task.svg" alt="">
                            <span class="text nav-text">Tarefas</span></a>
                    </li>
                    <li class="nav-link">
                        <a href="#"><img src="src/img/setting-2.svg" alt="">
                            <span class="text nav-text">Configurações</span></a>
                    </li>
                </ul>
            </div>

            <div class="button-content">
                <li class="logout">
                    <a href="#"><img src="src/img/logout.svg" alt="">
                        <span class="text nav-text">Sair</span></a>
                </li>
            </div>
        </div>
    </nav>
        <div class="tarefas-projetos">
            <div class="section-tarefas close-section" id="section-tarefas">
                <h1>Tarefas semanais</h1>
                <div class="tarefas">
                    <div class="tarefa">
                        <h2>0</h2>
                        <h3>Refazer</h3>
                    </div>
                    <div class="tarefa">
                        <h2>0</h2>
                        <h3>Refazer</h3>
                    </div>
                    <div class="tarefa">
                        <h2>0</h2>
                        <h3>Refazer</h3>
                    </div>
                </div>
            </div>
            <div class="section-projetos close-section" id="section-projetos">
                <h1>Projetos</h1>
                <table cellspacing="20px">
                    <thead>
                        <tr>
                            <th>Projeto</th>
                            <th>Clientes</th>
                            <th>Status</th>
                            <th>Data de entrega</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Página web</td>
                            <td>SNKRS</td>
                            <td>Status</td>
                            <td>12/12</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="notificacoes">
            <h1>Notificações</h1>
            <div class="nova-notificacao">
                <img src="notification-bing.svg" alt="">
                <h1>Nova tarefa</h1>
            </div>
        </div>
    </section>
</body>
<script language='javascript'>
  const sideBar = document.getElementById('sidebar');
  const bttn = document.getElementById('bttn');
  const sectionTarefas = document.getElementById('section-tarefas');
  const sectionProjetos = document.getElementById('section-projetos');
  
  bttn.addEventListener('click', () => {
      sideBar.classList.toggle('close');
      sectionTarefas.classList.toggle("close-section");
      sectionProjetos.classList.toggle("close-section");
  })
</script>
</html>
