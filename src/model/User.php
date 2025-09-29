<?php
namespace model;
use enum\TipoUsuario;

class User
{
    private string $username;
    private string $nomeCompleto;
    private string $senha;
    private ?string $caminhoFoto;
    private TipoUsuario $tipoUsuario;

    public function __construct($username, $nomeCompleto, $senha, $caminhoFoto, $tipoUsuario) {
        $this->username = $username;
        $this->nomeCompleto = $nomeCompleto;
        $this->senha = $senha;
        $this->caminhoFoto = $caminhoFoto;
        $this->tipoUsuario = $tipoUsuario;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function getNomeCompleto(): string {
        return $this->nomeCompleto;
    }

    public function getSenha(): string {
        return $this->senha;
    }

    public function getCaminhoFoto(): string {
        return $this->caminhoFoto;
    }

    public function getTipoUsuario(): TipoUsuario {
        return $this->tipoUsuario;
    }
}