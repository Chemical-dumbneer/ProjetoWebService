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

    public function getId():int {
        return match ($this) {
            self::Usuario => 1,
            self::Tecnico => 2
        };
    }

    public static  function getFromText(string $desc):TipoUsuario {
        return match ($desc) {
            'Usuario' => TipoUsuario::Usuario,
            'Tecnico' => TipoUsuario::Tecnico,
            default => throw new \InvalidArgumentException("Tipo de usuário inválido")
        };
    }

    public static  function getFromValue(int $val):TipoUsuario {
        return match ($val) {
            1 => TipoUsuario::Usuario,
            2 => TipoUsuario::Tecnico,
        };
    }
}