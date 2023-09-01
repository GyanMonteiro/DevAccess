<?php 
session_start();
include("conexao.php");

if(isset($_POST['acao']))
{
    $acao = $_POST['acao'];

    if ($acao === 'Refazer') {
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
    } elseif ($acao === 'Analise') {
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
    } elseif ($acao === 'Concluido') {
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
}
?>