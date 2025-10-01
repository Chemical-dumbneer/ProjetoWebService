<?php
namespace repository;
use model\User;
use enum\TipoUsuario;

class UserRepository{
     public function __construct() {
    }

    function getUsers():array {
        return $_SESSION["temp_usuarios"];
    }

    function validarCredenciais(string $login, string $senha):bool {
        foreach ($this->getUsers() as $usuario) {
            if ($usuario->getUsername() === $login && $usuario->getSenha() === $senha) {
                return true;
            }
        }
        return false;
    }

    function addUser(User $novoUsuario):void {
        if (!$novoUsuario->getCaminhoFoto()) {
            $reflexao = new \ReflectionClass($novoUsuario);
            $prop = $reflexao->getProperty('caminhoFoto');
            $prop->setAccessible(true);
            $prop->setValue($novoUsuario, 'img/users/defaultUserPic.png');
        }
        $_SESSION['temp_usuarios'][]  = $novoUsuario;
    }

    function getUserByUsername(string $username) {
        /** @var User $u */
        foreach ($_SESSION['temp_usuarios'] as $u) {
            if ($u->getUsername() === $username) {
                return $u;
            }
        }
        return null;
    }   
}