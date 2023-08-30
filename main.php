<?php 
include("conexao.php");

if (!isset($_SESSION)) {
    session_start();
    
    if ($conexao->connect_error) {
        die("Conexão falhou: " . $conexao->connect_error);
    }

    $sql_code = "SELECT * FROM tarefas WHERE usuario = ? AND situacao = 'Aberto'";
    $stmt = $conexao->prepare($sql_code);
    $stmt->bind_param('s', $_SESSION["usuario"]);
    $stmt->execute();
    
    $sql_query = $stmt->get_result();
    
    if ($sql_query) {
        $num_linhas_aberta = $sql_query->num_rows;
        

        while ($row = $sql_query->fetch_assoc()) {
        }
    } else {
        die("Falha na execução da consulta.");
    }

    $sql_code = "SELECT * FROM tarefas WHERE usuario = ? AND situacao = 'Concluido'";
    $stmt = $conexao->prepare($sql_code);
    $stmt->bind_param('s', $_SESSION["usuario"]);
    $stmt->execute();
    
    $sql_query = $stmt->get_result();
    
    if ($sql_query) {
        $num_linhas_concluido = $sql_query->num_rows;
        
        while ($row = $sql_query->fetch_assoc()) {
        }
    } else {
        die("Falha na execução da consulta.");
    }
    
    $sql_code = "SELECT * FROM tarefas WHERE usuario = ? AND situacao = 'Refazer'";
    $stmt = $conexao->prepare($sql_code);
    $stmt->bind_param('s', $_SESSION["usuario"]);
    $stmt->execute();
    
    $sql_query = $stmt->get_result();
    
    if ($sql_query) {
        $num_linhas_refazer = $sql_query->num_rows;
        
        while ($row = $sql_query->fetch_assoc()) {
        }
    } else {
        die("Falha na execução da consulta.");
    }

    $sql_code = "SELECT * FROM projetos WHERE usuario = ?";
    $stmt = $conexao->prepare($sql_code);
    $stmt->bind_param('s', $_SESSION["usuario"]);
    $stmt->execute();
    
    $resultadoProjetos = $stmt->get_result();

    $sql_code = "SELECT * FROM notificacoes WHERE usuario = ?";
    $stmt = $conexao->prepare($sql_code);
    $stmt->bind_param('s', $_SESSION["usuario"]);
    $stmt->execute();
    
    $resultadoNotificacoes = $stmt->get_result();

    $stmt->close();
    $conexao->close();
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
                    <img src="src/img/user-bold.svg" alt="">
                </span>

                <div class="text header-text">
                    <span class="name"><?php echo $_SESSION['nome'];?></span>
                    <span class="profession"><?php echo $_SESSION['profissao']; ?></span>
                </div>
            </div>
            <div class="div-botao">
                <button id="btn"><img src="src/img/close-square.svg" alt=""></button>
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
                        <h2><?php echo $num_linhas_aberta;?></h2>
                        <h3>Aberta</h3>
                    </div>
                    <div class="tarefa">
                        <h2><?php echo $num_linhas_concluido;?></h2>
                        <h3>Refazer</h3>
                    </div>
                    <div class="tarefa">
                        <h2><?php echo $num_linhas_refazer;?></h2>
                        <h3>Concluidas</h3>
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
                        <?php 
                            while($dados_projetos = mysqli_fetch_assoc($resultadoProjetos))
                            {
                                echo "<tr>";
                                echo "<td>".$dados_projetos['nome_projeto']."</td>";
                                echo "<td>".$dados_projetos['nome_empresa']."</td>";
                                echo "<td>".$dados_projetos['status']."</td>";
                                echo "<td>".$dados_projetos['data_conclusao']."</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="notificacoes">
            <h1>Notificações</h1>
            <?php 
                while($dados_notificacoes = mysqli_fetch_assoc($resultadoNotificacoes))
                {
                    echo "<div class='nova-notificacao'>";
                    echo "<img src='src/img/notification.svg' alt=''>";
                    echo "<div class='info-notificacao'>";
                    echo "<span style='display: none;'>".$dados_notificacoes['id']."</span>";
                    echo "<h1>".$dados_notificacoes['remetente']."</h1>";
                    echo "<span>".$dados_notificacoes['menssagem']."</span>";
                    echo "</div>";
                    echo "<form action='excluir-notificacao.php' method='post'>";
                    echo "<input type='hidden' name='notificacao_id' value='".$dados_notificacoes['id']."'>";
                    echo "<button class='botao-notificacao' type='submit' name='enviar'><img src='src/img/trash.svg' alt=''></button>";
                    echo "</form>";
                    echo "</div>";
                }
            ?>
        </div>
        <button class="btn-chat" id="btn-chat">
            <img class="chat-img" src="src/img/message.svg" alt="">
        </button>
            <div class="menssagem menssagem-close" id="menssagem">
                <h1>Menssagem</h1>
                <form class="form-menssagem" action="enviar-mensagem.php" method="post">
                    <div class="textfield">
                        <input type="text" name="to-usuario" id="usuario" placeholder="Usuário">
                    </div>
                    <div class="textfield">
                        <input class="menssagem-input" type="text" name="menssagem" id="menssagem" placeholder="Menssagem">
                    </div>
                    <input type="submit" name="registrar" value="enviar" class="btn">
                </form>
            </div>
    </section>
</body>
<script language='javascript'>
  const sideBar = document.getElementById('sidebar');
  const btnMenu = document.getElementById('btn');
  const btnChat = document.getElementById('btn-chat');
  const menssagem = document.getElementById('menssagem');
  const sectionTarefas = document.getElementById('section-tarefas');
  const sectionProjetos = document.getElementById('section-projetos');
  
  btnMenu.addEventListener('click', () => {
      sideBar.classList.toggle('close');
      sectionTarefas.classList.toggle("close-section");
      sectionProjetos.classList.toggle("close-section");
  })

  btnChat.addEventListener('click', () => {
      menssagem.classList.toggle('menssagem-close');
  })
</script>
</html>
