<?php
use entities\user;
require '../model/user.php';

function validarUsuario(){
    $usuario = $_POST["usuario"] ?? null;
    $senha= $_POST["senha"] ?? null;

    $user = new user();

    if($user->validarLogin($usuario, $senha)){
            $_SESSION['logado'] = "true";
            $_SESSION['usuario'] = $usuario;

            header("Location: ../public/index.php");
            exit;
    }else {
            $error = "Usuário ou senha inválidos!";
            require "../view/login.view.php";
            exit;
        }
        
    if(isset($_SESSION["logado"]) && $_SESSION["logado"] == "true"){
            header("Location: ../public/index.php");
            exit;
    }
     
        require "../view/login.view.php";
    }

    
?>