<?php
namespace enum;

enum TicketInteractionType: int{
    case FollowUp = 1;
    case Task = 2;
    case Solution = 3;

    public function getDescricao():string {
        return match ($this) {
            self::FollowUp => 'Acompanhamento',
            self::Task => 'Tarefa',
            self::Solution => 'Solução'
        };
    }

    public static function getFromText(string $desc): TicketInteractionType {
        return match($desc) {
            'FollowUp' => self::FollowUp,
            'Task' => self::Task,
            'Solution' => self::Solution,
            default => throw new \InvalidArgumentException("Tipo de interação inválido")
        };
    }
}