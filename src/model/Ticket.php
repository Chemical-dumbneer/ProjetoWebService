<?php
namespace model;

use DateTime;
use enum\TicketStatus;

class Ticket
{
    private int $id;
    private string $requerentUsername;
    private string $titulo;
    private string $descricao;
    private DateTime $dataCriacao;
    private TicketStatus $status;
    /** @var TicketInteraction[]; */
    private array $interactions;

    public function __construct(int $id = 0, string $requerent = '',string $titulo = '',string $descricao,$dataCriacao = new \DateTime(),$status = TicketStatus::Aberto)
    {
        $this->id = $id;
        $this->requerentUsername = $requerent;
        $this->titulo = $titulo;
        $this->descricao = $descricao;
        $this->dataCriacao = $dataCriacao;
        $this->status = $status;
        $this->interactions = [];
    }


    public function addInteraction(TicketInteraction $interaction): void
    {
        $this->interactions[] = $interaction;
    }

    public function getInteractions(): array
    {
        return $this->interactions;
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getRequerentUsername(): string
    {
        return $this->requerentUsername;
    }
    public function getTitulo(): string
    {
        return $this->titulo;
    }
    public function getDescricao(): ?string
    {
        return $this->descricao;
    }
    public function getDataCriacao(): DateTime
    {
        return $this->dataCriacao;
    }
    public function getStatus(): TicketStatus
    {
        return $this->status;
    }
}