<?php
    session_start();
    $logado = $_SESSION['logado'];

     if($logado != true){
        header('Location: ../LOGIN/login.php');;
    }
?>