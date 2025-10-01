<?php
namespace enum;

enum TipoUsuario: int {
    case Usuario = 1;
    case Tecnico = 2;

    public function getDescricao():string {
        return match ($this) {
            self::Usuario => 'Usuário',
            self::Tecnico => 'Técnico'
        };
    }

    public static  function getFromText(string $desc):TipoUsuario {
        return match ($desc) {
            'Usuario' => TipoUsuario::Usuario,
            'Tecnico' => TipoUsuario::Tecnico,
            default => throw new \InvalidArgumentException("Tipo de usuário inválido")
        };
    }
}