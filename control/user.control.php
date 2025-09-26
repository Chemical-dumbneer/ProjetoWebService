<?php
use entities\user;
require '../model/User.php';


function cadastrarUser() {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_POST['nome'] ?? '';
        $cargo = $_POST['cargo'] ?? '';
        $funcao = $_POST['funcao'] ?? '';

        $user = new user();

        $fotoPath = '';

        if(isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
            $foto = $_FILES['foto'];
            $fotoPath = 'uploads/' . uniqid() . '-' . $foto['name'];
            move_uploaded_file($foto['tmp_name'], $fotoPath);
        }

        $user->addUser($nome, $cargo,$funcao, $fotoPath);
        echo "Usuário cadastrado com sucesso!";
    }

    require '../view/newUser.view.php';
}

function listarUsers(){
     $user = new user();
   $users = $user->getUsers();

    require '../view/users.view.php';
}

?>