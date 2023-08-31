<?php 
include("conexao.php");


if (!isset($_SESSION)) {
    session_start();
    
    if ($mysqli->connect_error) {
        die("Conexão falhou: " . $mysqli->connect_error);
    }

    $sql_code = "SELECT * FROM tarefas WHERE usuario = ? AND situacao = 'Aberto'";
    $stmt = $mysqli->prepare($sql_code);
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
    $stmt = $mysqli->prepare($sql_code);
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
    $stmt = $mysqli->prepare($sql_code);
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
    $stmt = $mysqli->prepare($sql_code);
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
    $stmt = $mysqli->prepare($sql_code);
    $stmt->bind_param('s', $_SESSION["usuario"]);
    $stmt->execute();
    
    $resultadoProjetos = $stmt->get_result();

    $stmt->close();
    $mysqli->close();
}if (!isset($_SESSION['ativa'])){
    header("location: index.php");
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DevAccess - Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/icon.png" rel="icon">

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
    <div class="container-fluid position-relative d-flex p-0 bg-body">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3 shadow">
            <nav class="navbar bg-secondary navbar-dark">
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img src="img/user-bold.svg" alt="" style="width: 40px; height: 40px;">
                        <div
                            class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                        </div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0"><?php echo $_SESSION['nome'];?></h6>
                        <span><?php echo $_SESSION['profissao']; ?></span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="main.php" class="nav-item nav-link"><i class="bi bi-house-door-fill me-2"></i>Dashboard</a>
                    <a href="tarefas.php" class="nav-item nav-link active"><i
                            class="bi bi-list-task me-2"></i>Tarefas</a>
                    <a href="#" class="nav-item nav-link"><i class="bi bi-gear-fill me-2"></i>Configurações</a>
                    <a href="#" class="nav-item nav-link"><i class="bi bi-file-earmark-fill me-2"></i>Documentação</a>
                    <a href="#" class="nav-item nav-link"><i class="bi bi-bar-chart-fill me-2"></i>Estatisticas</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <img src="img/close-square.svg" alt="">
                </a>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="img/user-bold.svg" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex"><?php echo $_SESSION['nome'];?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item"><i class="bi bi-person me-2"></i>Meu Perfil</a>
                            <a href="#" class="dropdown-item"><i class="bi bi-gear me-2"></i>Configurações</a>
                            <a href="logout.php" class="dropdown-item"><i class="bi bi-box-arrow-left me-2"></i>Sair</a>
                        </div>
                    </div>
                </div>
            </nav>


            <!-- Sales Chart End -->


            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary text-center rounded p-4 shadow">
                            <div class="d-flex align-items-center justify-content-between mb-0">
                                <h6 class="mb-3">Adicionar projetos</h6>

                            </div>
                            <div class="notificacoes mb-0">
                                <div class="table-responsive">
                                    <form action="">
                                        <div class="textfield">
                                            <input class="form-control-lg w-100 pt-3 pb-3 mb-3" type="text"
                                                name="usuario" id="" placeholder="Usuário">
                                        </div>
                                        <div class="textfield">
                                            <input class="form-control-lg w-100 pt-3 pb-3 mb-3" type="text"
                                                name="tarefa" id="" placeholder="Tarefa">
                                        </div>
                                        <input type="submit" name="registrar" value="registrar" class="btn-submit">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary text-center rounded p-4 shadow">
                            <div class="d-flex align-items-center justify-content-between mb-0">
                                <h6 class="mb-3">Gerenciar Tarefas</h6>
                            </div>
                            <table class="table text-start align-middle table-bordered table-hover mb-0"
                                cellspacing="10px">

                                <tbody>
                                    <?php 
                            while($dados_eventos = mysqli_fetch_assoc($resultadoProjetos))
                            {
                                echo "<tr>";
                                echo "<td>".$dados_eventos['nome_evento']."</td>";
                                echo "<td>".$dados_eventos['organizador']."</td>";
                                echo "<td>".$dados_eventos['tema']."</td>";
                                echo "<td>".$dados_eventos['data']."</td>";
                                echo "<td>".$dados_eventos['local']."</td>";
                                echo "</tr>";
                            }
                        ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-lg btn-primary btn-lg-square back-to-top btn-shadow" type="button"
                data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions"
                aria-controls="offcanvasWithBothOptions"><i class="bi bi-chat-left-dots"></i></button>

            <div class="offcanvas offcanvas-end bg-secondary rounded-start" data-bs-scroll="true" tabindex="-1"
                id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel" id="menu">
                <div class="offcanvas-header">
                    <h2 class="text-center">Menssagem</h2>
                </div>
                <div class="offcanvas-body">
                    <form class="enviar-menssagem h-75" action="enviar-menssagem.php" method="post">
                        <div class="textfield">
                            <input class="form-control-lg w-100 mb-3" type="text" placeholder="Usuário"
                                name="to-usuario" id="usuario">
                        </div>
                        <div class="textfield">
                            <input class="form-control-lg w-100 pt-5 pb-5 mb-3" type="text" placeholder="Menssagem"
                                name="menssagem" id="usuario">
                        </div>
                        <input class="w-100 mt-3 p-3 btn-submit" type="submit" value="ENVIAR MENSSAGEM">
                    </form>
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