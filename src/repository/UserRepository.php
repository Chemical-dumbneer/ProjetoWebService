<?php
namespace repository;
use Database;
use model\User;
use enum\TipoUsuario;
use PDO;

class UserRepository{
     public function __construct() {
    }

    static function getUsers():array {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('
            SELECT
                username,
                "nomeCompleto",
                "caminhoFoto",
                "tipoUsuario"
            FROM 
                users
        ');
        $stmt->execute();
        return $stmt->fetchAll(
            PDO::FETCH_FUNC,
            function ($username, $nomeCompleto, $senha, $caminhoFoto, $tipoUsuario) {
                return new User(
                    $username,
                    $nomeCompleto,
                    $caminhoFoto,
                    TipoUsuario::getFromText($tipoUsuario)
                );
            }
        );
    }

    static function validarCredenciais(string $login, string $senha):bool {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('
            SELECT
                COUNT(*)
            FROM
                users
            WHERE
                username = :login AND
                "pwdHash" = crypt(:senha, "pwdHash")
        ');
        $stmt->bindValue(':login', $login, PDO::PARAM_STR);
        $stmt->bindValue(':senha', $senha, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    static function addUser(User $novoUsuario): void {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('
            INSERT INTO
                users(
                      username, "nomeCompleto", "pwdHash", "caminhoFoto", "tipoUsuario"
                )
            VALUES(
                   :username, :nomeCompleto, crypt( :senha, gen_salt(\'bf\', 12)), :caminhoFoto, :tipoUsuario
            )
        ');
        $stmt->bindValue(':username', $novoUsuario->getUsername(), PDO::PARAM_STR);
        $stmt->bindvalue(":nomeCompleto", $novoUsuario->getNomeCompleto(), PDO::PARAM_STR);
        $stmt->bindvalue(":senha", $novoUsuario->getSenha(), PDO::PARAM_STR);
        $stmt->bindValue(":caminhoFoto", $novoUsuario->getCaminhoFoto(), PDO::PARAM_STR);
        $stmt->bindvalue(":tipoUsuario", $novoUsuario->getTipoUsuario(), PDO::PARAM_STR);
        $stmt->execute();
    }

    static function getUserByUsername(string $username):User | null {
         $pdo = Database::getConnection();
         $stmt = $pdo->prepare('
            SELECT
                username,
                "nomeCompleto",
                "caminhoFoto",
                "tipoUsuario"
            FROM
                users
            WHERE
                username = :username
         ');
        $stmt->execute();
        $arr = $stmt->fetchAll(
            PDO::FETCH_FUNC,
            function ($username, $nomeCompleto, $caminhoFoto, $tipoUsuario) {
                return new User(
                    $username,
                    $nomeCompleto,
                    $caminhoFoto,
                    TipoUsuario::getFromText($tipoUsuario)
                );
            }
        );
        if (count($arr) > 0){
            return $arr[0];
        }
        return null;
    }   
}