<?php
use entities\user;
require '../model/user.php';

function validarUsuario(){
    $usuario = $_POST["usuario"] ?? null;
    $senha= $_POST["senha"] ?? null;
    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (empty($usuario) || empty($senha)) {
            $error = "Por favor, preencha todos os campos!";
        } else {
            $user = new user();
            if($user->validarLogin($usuario, $senha)){
                $_SESSION['logado'] = "true";
                $_SESSION['usuario'] = $usuario;

                header("Location: ../public/index.php");
                exit;
            }else {
                $error = "Usuário ou senha inválidos!";
            }
        
        if(isset($_SESSION["logado"]) && $_SESSION["logado"] == "true"){
            header("Location: ../public/index.php");
            exit;
        }
     }
    }
     
        require "../view/login.view.php";
    }

function cadastrarUser() {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_POST['nome'] ?? '';
        $cargo = $_POST['cargo'] ?? '';
        $funcao = $_POST['funcao'] ?? '';

        if (empty($nome) || empty($cargo)) {
            $error = "Por favor, preencha todos os campos!";
        } else {
            $user = new user();

            $fotoPath = '';

            if(isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
                $foto = $_FILES['foto'];
                $fotoPath = 'uploads/' . uniqid() . '-' . $foto['name'];
                move_uploaded_file($foto['tmp_name'], $fotoPath);
            }

            $user->addUser($nome, $cargo,$funcao, $fotoPath);
            $success = "Usuário cadastrado com sucesso!";
    }
    }

    require '../view/newUser.view.php';
}

function listarUsers(){
     $user = new user();
   $users = $user->getUsers();

    require '../view/users.view.php';
}
?>