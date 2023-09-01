<?php 
session_start();
include("conexao.php");



    //----------------EVENTOS E PROJETOS-------------//
    
if(isset($_POST['acao']))
{
    $acao = $_POST['acao'];

    if ($acao === 'evento_concluido') {
        if (isset($_POST['evento_id'])) {
            $eventoId = $_POST['evento_id'];

            echo $eventoId;
            
            $query = "DELETE FROM eventos WHERE id = ?;";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param("i", $eventoId); 
            
            if ($stmt->execute()) {
                // Sucesso na atualização
            } else {
                // Erro na atualização
            }

            $stmt->close();
        }
    }elseif ($acao === 'projeto_concluido') {
        if (isset($_POST['projeto_id'])) {
            $tarefaId = $_POST['projeto_id'];
            
            $query = "DELETE FROM projetos WHERE id = ?";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param("i", $tarefaId); 
            
            if ($stmt->execute()) {
                // Sucesso na atualização
            } else {
                // Erro na atualização
            }

            $stmt->close();
        }
    }
    header('Location: adm.php');
    exit;
}



    // -----------------------MODIFICAR TAREFAS----------------//
    
if(isset($_POST['modificar_valor']))
{
    $modificarValor = $_POST['modificar_valor'];

    if ($modificarValor === 'Refazer') {
        if (isset($_POST['tarefa_id'])) {
            $tarefaId = $_POST['tarefa_id'];

            echo $tarefaId;
            
            $query = "UPDATE tarefas SET situacao = 'Refazer' WHERE id = ?";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param("i", $tarefaId); 
            
            if ($stmt->execute()) {
                // Sucesso na atualização
            } else {
                // Erro na atualização
            }

            $stmt->close();
        }
    } elseif ($modificarValor === 'Analise') {
        if (isset($_POST['tarefa_id'])) {
            $tarefaId = $_POST['tarefa_id'];

            echo $tarefaId;
            
            $query = "UPDATE tarefas SET situacao = 'Analise' WHERE id = ?";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param("i", $tarefaId); 
            
            if ($stmt->execute()) {
                // Sucesso na atualização
            } else {
                // Erro na atualização
            }

            $stmt->close();
        }
    } elseif ($modificarValor === 'Concluido') {
        if (isset($_POST['tarefa_id'])) {
            $tarefaId = $_POST['tarefa_id'];

            echo $tarefaId;
            
            $query = "UPDATE tarefas SET situacao = 'Concluido' WHERE id = ?";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param("i", $tarefaId); 
            
            if ($stmt->execute()) {
                // Sucesso na atualização
            } else {
                // Erro na atualização
            }

            $stmt->close();
        }
    }

    
    header('Location: tarefas.php');
    exit;
    
    

    
    // ---------------------CADASTRAR USUARIOS----------------- //
    
}
if (isset($_POST['nome']) && isset($_POST['usuario'])) {
    $nome = mysqli_real_escape_string($mysqli, trim($_POST['nome']));
    $usuario = mysqli_real_escape_string($mysqli, trim($_POST['usuario']));
    $profissao = mysqli_real_escape_string($mysqli, trim($_POST['profissao_selecionada']));
    $email = mysqli_real_escape_string($mysqli, trim($_POST['email']));
    $senha = mysqli_real_escape_string($mysqli, trim($_POST['senha']));
    
    $hash = password_hash($senha, PASSWORD_DEFAULT);
    
    $sql = "SELECT COUNT(*) AS total FROM usuarios WHERE usuario = '$usuario'";
    $result = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_assoc($result);
    
    if ($row['total'] > 0) {
        $_SESSION['usuario_existe'] = true;
        header('Location: cadastro.php?usuario_existe=true');
        exit;
    }
    
    $sql = "SELECT COUNT(*) AS total FROM usuarios WHERE email = '$email'";
    $result = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_assoc($result);
    
    if ($row['total'] > 0) {
        $_SESSION['email_existe'] = true;
        header('Location: cadastro.php?email_existe=true');
        exit;
    }
    $tipo = 'usuario';
    $sql = "INSERT INTO usuarios (nome, usuario, profissao, email, senha, tipo) VALUES ('$nome', '$usuario', '$profissao', '$email', '$hash', 'usuario')";
    
    if ($mysqli->query($sql) === TRUE) {
        $_SESSION['status_cadastro'] = true;
        header('Location: cadastrorealizado.php');
    } else {
        echo "Erro: " . $sql . "<br>" . $mysqli->error;
    }
    
    $mysqli->close();
}



    //--------------------ENVIAR MENSSAGEM----------------//
    
if (isset($_POST['to-usuario']) && isset($_POST['menssagem'])) {
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
        
        // Redireciona o usuário de volta para a página de origem
        if (isset($_SESSION['pagina_anterior'])) {
            header("Location: ".$_SERVER['HTTP_REFERER']."");
        } else {
            header('Location: main.php'); // Página padrão se a origem for desconhecida
        }
    }
    $stmt->close();
    $mysqli->close();
}



    //-------------EXCLUIR NOTIFICACAO-----------//
    
if (isset($_POST['notificacao_id'])) {
    $notificacao_id = $_POST['notificacao_id'];
        
    include("conexao.php");
    
        $query = "DELETE FROM notificacoes WHERE id = $notificacao_id";
        
        if(mysqli_query($mysqli, $query))
        {
            header('Location: main.php');
        }

        mysqli_close($mysqli);
}





    //-------------------CADASTRAR TAREFAS----------------------//

if (isset($_POST['to-usuario']) && isset($_POST['tarefa'])) {
    $postUsuario = trim($_POST['to-usuario']);
    $tarefa = trim($_POST['tarefa']);

    // Consulta preparada para selecionar dados do usuário
    $sql_code = "SELECT * FROM usuarios WHERE usuario = ?";
    $stmt = $mysqli->prepare($sql_code);
    $stmt->bind_param('s', $postUsuario);
    $stmt->execute();

    $resultadoPesquisa = $stmt->get_result();
    $dados_usuarios = mysqli_fetch_assoc($resultadoPesquisa);

if ($dados_usuarios) {
    // Usuário encontrado, obter o nome e outros dados necessários
    $nome = $dados_usuarios['nome'];
    $usuario = mysqli_real_escape_string($mysqli, $postUsuario);
    $situacao = 'Aberto';

    // Consulta preparada para inserir dados na tabela de tarefas
    $sql = "INSERT INTO tarefas (nome, usuario, tarefa, situacao) VALUES (?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ssss', $nome, $usuario, $tarefa, $situacao);

    if ($stmt->execute()) {
        $_SESSION['status_cadastro'] = true;
        header('Location: tarefas.php');
    } else {
        // Trate os erros da consulta de inserção, se necessário
        echo "Erro ao inserir tarefa: " . $stmt->error;
    }
} else {
    // Usuário não encontrado, trate o cenário de usuário não existente
    echo "Usuário não encontrado.";
}

$stmt->close();
$mysqli->close();
}






if (isset($_POST['to-usuario']) && isset($_POST['nome_projeto'])) {
    $postUsuario = trim($_POST['to-usuario']);
    $nomeProjeto = trim($_POST['nome_projeto']);
    $nomeEmpresa = trim($_POST['nome_empresa']);
    $status = trim($_POST['status']);
    $dataConclusao = trim($_POST['data_conclusao']);

    $sql = "INSERT INTO projetos (usuario, nome_projeto, nome_empresa, andamento, data_conclusao) VALUES ('$postUsuario', '$nomeProjeto', '$nomeEmpresa', '$status', '$dataConclusao')";
    
    if ($mysqli->query($sql) === TRUE) {
        $_SESSION['status_cadastro'] = true;
        header('Location: adm.php');
    } else {
        echo "Erro: " . $sql . "<br>" . $mysqli->error;
    }
    
    $mysqli->close();
}





if (isset($_POST['nome_evento']) && isset($_POST['organizador'])) {
    $nomeEvento = trim($_POST['nome_evento']);
    $organizador = trim($_POST['organizador']);
    $tema = trim($_POST['tema']);
    $data = trim($_POST['data']);
    $local = trim($_POST['local']);

    $sql = "INSERT INTO eventos (nome_evento, organizador, tema, data_evento, local_evento) VALUES ('$nomeEvento', '$organizador', '$tema', '$data', '$local')";
    
    if ($mysqli->query($sql) === TRUE) {
        $_SESSION['status_cadastro'] = true;
        header('Location: adm.php');
    } else {
        echo "Erro: " . $sql . "<br>" . $mysqli->error;
    }
    
    $mysqli->close();
}
?>