<?php
namespace model;
use enum\TipoUsuario;

class User
{
    private ?int $id;
    private string $username;
    private string $nomeCompleto;
    private ?string $senha;
    private ?string $caminhoFoto;
    private TipoUsuario $tipoUsuario;

    public function __construct(string $username, string $nomeCompleto, ?string $caminhoFoto, TipoUsuario $tipoUsuario) {
        $this->username = $username;
        $this->nomeCompleto = $nomeCompleto;
        $this->caminhoFoto = $caminhoFoto ?? 'img/users/defaultUserPic.png';
        $this->tipoUsuario = $tipoUsuario;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function setSenha(string $senha): void {
        $this->senha = $senha;
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

    public function getCaminhoFoto(): string | null{
        return $this->caminhoFoto;
    }

    public function getTipoUsuario(): TipoUsuario {
        return $this->tipoUsuario;
    }
}