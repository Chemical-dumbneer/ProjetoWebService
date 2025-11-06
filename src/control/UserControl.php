<?php
namespace control;

use enum\TipoUsuario;
use model\User;
use Pecee\SimpleRouter\SimpleRouter;
use repository\UserRepository;

class UserControl {
    function __Construct() {
        
    }

    static function validarInfoLogin() {
        $usuario = $_POST["usuario"] ?? null;
        $senha = $_POST["senha"] ?? null;
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($usuario) || empty($senha)) {
                $error = "Por favor, preencha todos os campos!";
            } else {
                if (UserRepository::validarCredenciais($usuario, $senha)) {
                    $_SESSION['logado'] = "true";
                    $_SESSION['usuario'] = $usuario;
                    $_SESSION['tipoUsuario'] = UserRepository::getUserByUsername($usuario)->getTipoUsuario();
                    $_SESSION['fotoUsuario'] = UserRepository::getUserByUsername($usuario)->getCaminhoFoto();
                    SimpleRouter::response()->redirect('/home');
                    exit;
                } else {

                    $error = "Usuário ou senha inválidos!";
                }

                if (isset($_SESSION["logado"]) && $_SESSION["logado"] == "true") {
                    SimpleRouter::response()->redirect('/home');
                    exit;
                }
            }
        }
        require __DIR__ . '/../view/login.view.php';
    }

    static function cadastrarUser(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['username'] ?? '';
            $nomeCompleto = $_POST['nomeCompleto'] ?? '';
            $senha = $_POST['senha'] ?? '';
            $funcao = TipoUsuario::from($_POST['funcao']);

            if (empty($nome) || empty($nomeCompleto) || empty($senha)) {
                $error = "Por favor, preencha todos os campos!";
            } else {
                $fotoPath = '/img/users/defaultUserPic.png';
                $uploadDir = __DIR__ . '/../../public/img/users/';

                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
                    $foto = $_FILES['foto'];
                    $fileName = uniqid() . '-' . basename($foto['name']);
                    $destino = $uploadDir . $fileName;

                    if (move_uploaded_file($foto['tmp_name'], $destino)) {
                        $fotoPath = '/img/users/' . $fileName;
                    } else {
                        $fotoPath = '/img/users/defaultUserPic.png';
                    }
                } else {
                    $fotoPath = '/img/users/defaultUserPic.png';
                }
                $user = new User(
                    username: $nome,
                    nomeCompleto: $nomeCompleto,
                    caminhoFoto: $fotoPath,
                    tipoUsuario: $funcao
                );
                $user->setSenha($senha);
                UserRepository::addUser($user);
                $success = "Usuário cadastrado com sucesso!";
            }
        }

        require __DIR__ . '/../view/newUser.view.php';
    }

    static function listarUsers():void {
        $userRepo = new UserRepository();
        $users = UserRepository::getUsers();

        require __DIR__ . '/../view/users.view.php';
    }
}
?>