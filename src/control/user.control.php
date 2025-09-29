<?php

use enum\TipoUsuario;
use model\User;
require __DIR__.'/../repository/user.repository.php';

function validarInfoLogin(){
    $usuario = $_POST["usuario"] ?? null;
    $senha= $_POST["senha"] ?? null;
    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (empty($usuario) || empty($senha)) {
            $error = "Por favor, preencha todos os campos!";
        } else {
            if(validarCredenciais($usuario, $senha)){
                $_SESSION['logado'] = "true";
                $_SESSION['usuario'] = $usuario;
                $_SESSION['tipoUsuario'] = getUserByUsername($usuario)->getTipoUsuario();

                header("Location: index.php");
                exit;
            }else {
                $error = "Usuário ou senha inválidos!";
            }
        
            if(isset($_SESSION["logado"]) && $_SESSION["logado"] == "true"){
                header("Location: index.php");
                exit;
            }
        }
    }
    require __DIR__ .'/../view/login.view.php';
}

function cadastrarUser(): void {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_POST['username'] ?? '';
        $nomeCompleto = $_POST['nomeCompleto'] ?? '';
        $senha = $_POST['senha'] ?? '';
        $funcao = TipoUsuario::from($_POST['funcao']);

        if (empty($nome) || empty($nomeCompleto) || empty($senha)) {
            $error = "Por favor, preencha todos os campos!";
        } else {
            $fotoPath = '';

            if(isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
                $foto = $_FILES['foto'];
                $fotoPath = '/img/users/' . uniqid() . '-' . $foto['name'];
                move_uploaded_file($foto['tmp_name'], $fotoPath);
            } else {
                $fotoPath = '/img/users/defaultUserPic.png';
            }
            addUser(
                new User(
                    username: $nome,
                    nomeCompleto: $nomeCompleto,
                    senha: $senha,
                    caminhoFoto: $fotoPath,
                    tipoUsuario: $funcao
                )
            );
            $success = "Usuário cadastrado com sucesso!";
        }
    }

    require __DIR__ . '/../view/newUser.view.php';
}

function listarUsers(){
     getUsers();

    require '../view/users.view.php';
}
?>