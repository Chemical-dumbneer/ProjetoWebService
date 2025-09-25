<?php
// exemplo: simulação de tickets vindos do banco
function getTickets()
{
    $tickets = [
        [
            'usuario' => 'Fulano da Silva',
            'titulo' => 'Meu PC não liga',
            'descricao' => 'Lorem ipsum depois que o encanador trocou o cano o pc desligou'
        ],
        [
            'usuario' => 'Maria Oliveira',
            'titulo' => 'Erro ao acessar sistema',
            'descricao' => 'Sistema retorna tela branca ao logar.'
        ]
    ];
    require '../view/ticket.view.php';
}