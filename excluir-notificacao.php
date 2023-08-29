<?php
    if(isset($_POST['notificacao_id']))
    {
        $notificacao_id = $_POST['notificacao_id'];
        
        include("conexao.php");
        
            $query = "DELETE FROM notificacoes WHERE id = $notificacao_id";
            
            if(mysqli_query($conexao, $query))
            {
                header('Location: main.php');
            }

            mysqli_close($conexao);
        }
?>
