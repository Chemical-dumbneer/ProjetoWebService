<?php

require_once __DIR__ . '/../repository/UserRepository.php';
use enum\TipoUsuario;
use model\User;
use repository\UserRepository;

function validarInfoLogin(){
    $usuario = $_POST["usuario"] ?? null;
    $senha= $_POST["senha"] ?? null;
    $error = '';
    $userRepo = new UserRepository();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (empty($usuario) || empty($senha)) {
            $error = "Por favor, preencha todos os campos!";
        } else {
            if($userRepo->validarCredenciais($usuario, $senha)){
                $_SESSION['logado'] = "true";
                $_SESSION['usuario'] = $usuario;
                $_SESSION['tipoUsuario'] = $userRepo->getUserByUsername($usuario)->getTipoUsuario();

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
        $userRepo = new UserRepository();

        if (empty($nome) || empty($nomeCompleto) || empty($senha)) {
            $error = "Por favor, preencha todos os campos!";
        } else {
            $fotoPath = '/img/users/defaultUserPic.png';
            $uploadDir = __DIR__ . '/../../public/img/users/'; 

            if(!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            if(isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
                $foto = $_FILES['foto'];
                $fileName = uniqid() . '-' . basename($foto['name']);
                $destino = $uploadDir . $fileName;
                 if(move_uploaded_file($foto['tmp_name'], $destino)) {
                    $fotoPath = '/img/users/' . $fileName;
                 }else {
                     $fotoPath = '/img/users/defaultUserPic.png';
                 }
                move_uploaded_file($foto['tmp_name'], $fotoPath);
            } else {
                $fotoPath = '/img/users/defaultUserPic.png';
            }
            $userRepo->addUser(
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
    $userRepo = new UserRepository();
    $users = $userRepo->getUsers();

    require  __DIR__ .'/../view/users.view.php';
}
?>