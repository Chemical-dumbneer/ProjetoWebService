<?php
namespace enum;

enum TicketStatus: int {
    case Aberto = 1;
    case Pendente = 2;
    case Solucionado = 3;

    public function getDescricao():string {
        return match ($this) {
            self::Aberto => 'Aberto',
            self::Pendente => 'Pendente',
            self::Solucionado => 'Solucionado'
        };
    }
}