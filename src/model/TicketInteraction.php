<?php
namespace model;

use DateTime;
use enum\TicketInteractionType;

class TicketInteraction
{
    private int $timelinePosition;
    private string $authorUsername;
    private DateTime $datetime;
    private TicketInteractionType $interactionType;
    private string $descricao;

    public function __construct(int $timelinePosition, string $author, DateTime $datetime, TicketInteractionType $interactionType, string $descricao)
    {
        $this->timelinePosition = $timelinePosition;
        $this->authorUsername = $author;
        $this->datetime = $datetime;
        $this->interactionType = $interactionType;
        $this->descricao = $descricao;
    }

    public function getTimelinePosition(): int
    {
        return $this->timelinePosition;
    }

    public function getAuthor(): string
    {
        return $this->authorUsername;
    }

    public function getDatetime(): datetime
    {
        return $this->datetime;
    }

    public function getInteractionType(): TicketInteractionType
    {
        return $this->interactionType;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }
}