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
    $sql_code = "SELECT * FROM tarefas WHERE usuario = ? AND situacao = 'Analise'";
    $stmt = $conexao->prepare($sql_code);
    $stmt->bind_param('s', $_SESSION["usuario"]);
    $stmt->execute();
    
    $sql_query = $stmt->get_result();
    
    if ($sql_query) {
        $num_linhas_analise = $sql_query->num_rows;
        
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

    $sql_code = "SELECT * FROM eventos";
    $stmt = $conexao->prepare($sql_code);
    $stmt->execute();
    
    $resultadoEventos = $stmt->get_result();

    $stmt->close();
    $conexao->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DarkPan - Bootstrap 5 Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/all.css">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img src="src/img/user-bold.svg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0"><?php echo $_SESSION['nome'];?></h6>
                        <span><?php echo $_SESSION['profissao']; ?></span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="index.html" class="nav-item nav-link active"><i class="bi bi-house-door-fill"></i>Dashboard</a>
                    <a href="widget.html" class="nav-item nav-link"><i class="bi bi-list-task"></i>Tarefas</a>
                    <a href="form.html" class="nav-item nav-link"><i class="bi bi-gear-fill"></i>Configurações</a>
                    <a href="table.html" class="nav-item nav-link"><i class="bi bi-file-earmark-fill"></i>Documentação</a>
                    <a href="chart.html" class="nav-item nav-link"><i class="bi bi-bar-chart-fill"></i>Estatisticas</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <img src="src/img/close-square.svg" alt="">
                </a>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="src/img/user-bold.svg" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex"><?php echo $_SESSION['nome'];?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Settings</a>
                            <a href="#" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->


            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <i class="bi bi-card-checklist text-primary" style="font-size: 4rem;"></i>
                            <div class="ms-3">
                                <p class="mb-2">Tarefas Abertas</p>
                                <h6 class="mb-0"><?php echo $num_linhas_aberta;?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="bi bi-arrow-clockwise text-primary" style="font-size: 4rem;"></i>
                            <div class="ms-3">
                                <p class="mb-2">Tarefas para Refazer</p>
                                <h6 class="mb-0"><?php echo $num_linhas_refazer;?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <i class="bi bi-hourglass-split text-primary" style="font-size: 4rem;"></i>
                            <div class="ms-3">
                                <p class="mb-2">Tarefas em analise</p>
                                <h6 class="mb-0"><?php echo $num_linhas_analise;?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <i class="bi bi-check text-primary" style="font-size: 4rem;"></i>
                            <div class="ms-3">
                                <p class="mb-2">Tarefas Concluidas</p>
                                <h6 class="mb-0"><?php echo $num_linhas_concluido;?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->


            <!-- Sales Chart Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Notificações</h6>
                                
                            </div>
                            <div class="notificacoes">
                                <?php 
                                    while($dados_notificacoes = mysqli_fetch_assoc($resultadoNotificacoes))
                                    {
                                        echo "<div class='d-flex w-90 h-75 p-3 border border-primary border-3 mb-2 rounded-3'>";
                                        echo "<div class='ms-5'>";
                                        echo "<span style='display: none;'>".$dados_notificacoes['id']."</span>";
                                        echo "<h4 class='m-0'>".$dados_notificacoes['remetente']."</h4>";
                                        echo "<span >".$dados_notificacoes['menssagem']."</span>";
                                        echo "</div>";
                                        echo "<form class='w-100 m-auto d-flex justify-content-end' action='excluir-notificacao.php' method='post'>";
                                        echo "<input type='hidden' name='notificacao_id' value='".$dados_notificacoes['id']."'>";
                                        echo "<button class='border-0 bg-primary rounded' type='submit' name='enviar'><i class='bi bi-trash-fill'></i></button>";
                                        echo "</form>";
                                        echo "</div>";
                                    }
                                ?>
                                </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Eventos</h6>
                            </div>
                            <table class="table text-start align-middle table-bordered table-hover mb-0" cellspacing="20px">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Organizador</th>
                            <th>Tema</th>
                            <th>Data do evento</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            while($dados_eventos = mysqli_fetch_assoc($resultadoEventos))
                            {
                                echo "<tr>";
                                echo "<td>".$dados_eventos['nome_evento']."</td>";
                                echo "<td>".$dados_eventos['organizador']."</td>";
                                echo "<td>".$dados_eventos['tema']."</td>";
                                echo "<td>".$dados_eventos['data']."</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sales Chart End -->


            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Projetos</h6>

                    </div>
                    <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0" cellspacing="20px">
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
            </div>
            <!-- Recent Sales End -->

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>