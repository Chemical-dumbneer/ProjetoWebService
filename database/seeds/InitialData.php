<?php
declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

final class InitialData extends AbstractSeed
{
    public function run(): void
    {
        // ---------------------------
        // 1) USERS
        // ---------------------------
        $this->execute(<<<SQL
        INSERT INTO public.users (username, "nomeCompleto", "pwdHash", "tipoUsuario", "caminhoFoto")
        VALUES
        ('admin'       , 'Administrador'               , crypt('admin'     , gen_salt('bf',12)), 2, 'img/users/defaultUserPic.png'),
        ('jeancarlos'  , 'Jean Pires de Carlos'        , crypt('jean1234'  , gen_salt('bf',12)), 2, 'img/users/defaultUserPic.png'),
        ('andreemilio' , 'Andre Luiz Pereira Emilio'   , crypt('andre1234' , gen_salt('bf',12)), 2, 'img/users/defaultUserPic.png'),
        ('testuser'    , 'Usuário de Teste'            , crypt('test1234'  , gen_salt('bf',12)), 1, 'img/users/defaultUserPic.png')
        ON CONFLICT (username) DO NOTHING;
        SQL);

        // ---------------------------
        // 2) TICKETS
        // ---------------------------
        $this->execute(<<<SQL
        INSERT INTO public.tickets (id_requerent, titulo, descricao, "dataCriacao", status)
        VALUES
        ((SELECT id FROM public.users WHERE username='testuser'), 'Erro no login',                         'Não consigo fazer login com usuário e senha corretos.', '2025-09-10 08:00:00', 1),
        ((SELECT id FROM public.users WHERE username='testuser'), 'Solicitação de relatório de vendas',    'Preciso do relatório de vendas entre 01/09 e 30/09.',   '2025-09-11 09:15:00', 1),
        ((SELECT id FROM public.users WHERE username='testuser'), 'Bug no formulário de cadastro',         'O campo “telefone” trava o botão de enviar.',           '2025-09-12 10:30:00', 1),
        ((SELECT id FROM public.users WHERE username='testuser'), 'Sugestão de nova funcionalidade',       'Seria bom exportar tickets para PDF.',                  '2025-09-13 11:00:00', 1),
        ((SELECT id FROM public.users WHERE username='testuser'), 'Problema com upload de arquivos',       'Não consigo anexar imagens nos tickets.',               '2025-09-14 12:45:00', 1),
        ((SELECT id FROM public.users WHERE username='testuser'), 'Erro ao salvar configurações',          'As alterações de perfil não são salvas.',               '2025-09-15 14:20:00', 1),
        ((SELECT id FROM public.users WHERE username='testuser'), 'Timeout na consulta',                   'Consulta demora muito tempo e dá erro.',                '2025-09-16 15:55:00', 1),
        ((SELECT id FROM public.users WHERE username='testuser'), 'Mensagem de erro genérica',             'Quando algo falha, aparece “Erro desconhecido”.',       '2025-09-17 16:30:00', 1),
        ((SELECT id FROM public.users WHERE username='testuser'), 'Dúvida sobre permissões',               'Por que usuários não podem ver tickets dos outros?',    '2025-09-18 17:10:00', 3),
        ((SELECT id FROM public.users WHERE username='testuser'), 'Solicitação de reset de senha',         'Quero redefinir minha senha via e-mail.',               '2025-09-19 18:00:00', 3);
        SQL);

        // ---------------------------
        // 3) INTERAÇÕES
        // ---------------------------
        $this->execute(<<<SQL
        -- Ticket 1
        INSERT INTO public."ticketInteractions" (id_ticket, "timelinePosition", id_author, "datetime", "interactionType", descricao) VALUES
        ((SELECT id FROM public.tickets WHERE titulo='Erro no login'), 1, (SELECT id FROM public.users WHERE username='andreemilio'), '2025-09-10 08:30:00', 2, 'Você já tentou limpar cache do navegador?'),
        ((SELECT id FROM public.tickets WHERE titulo='Erro no login'), 2, (SELECT id FROM public.users WHERE username='testuser'),    '2025-09-10 08:35:00', 1, 'Sim, mas continua o mesmo erro.'),
        ((SELECT id FROM public.tickets WHERE titulo='Erro no login'), 3, (SELECT id FROM public.users WHERE username='jeancarlos'),  '2025-09-10 09:00:00', 1, 'Vou verificar logs e retorno em instantes.');

        -- Ticket 2
        INSERT INTO public."ticketInteractions" VALUES
        ((SELECT id FROM public.tickets WHERE titulo='Solicitação de relatório de vendas'), 1, (SELECT id FROM public.users WHERE username='jeancarlos'),  '2025-09-11 09:45:00', 2, 'Você quer relatório mensal ou diário?'),
        ((SELECT id FROM public.tickets WHERE titulo='Solicitação de relatório de vendas'), 2, (SELECT id FROM public.users WHERE username='testuser'),    '2025-09-11 09:50:00', 1, 'Mensal, por favor.');

        -- Ticket 3
        INSERT INTO public."ticketInteractions" VALUES
        ((SELECT id FROM public.tickets WHERE titulo='Bug no formulário de cadastro'), 1, (SELECT id FROM public.users WHERE username='andreemilio'), '2025-09-12 11:00:00', 2, 'Pode me dizer o navegador e versão?'),
        ((SELECT id FROM public.tickets WHERE titulo='Bug no formulário de cadastro'), 2, (SELECT id FROM public.users WHERE username='testuser'),    '2025-09-12 11:10:00', 1, 'Uso Chrome versão 115.');

        -- Ticket 4
        INSERT INTO public."ticketInteractions" VALUES
        ((SELECT id FROM public.tickets WHERE titulo='Sugestão de nova funcionalidade'), 1, (SELECT id FROM public.users WHERE username='jeancarlos'),  '2025-09-13 11:30:00', 1, 'Boa ideia — farei proposta ao time.');

        -- Ticket 5
        INSERT INTO public."ticketInteractions" VALUES
        ((SELECT id FROM public.tickets WHERE titulo='Problema com upload de arquivos'), 1, (SELECT id FROM public.users WHERE username='andreemilio'), '2025-09-14 13:00:00', 2, 'Que tipo de arquivo você tentou anexar?'),
        ((SELECT id FROM public.tickets WHERE titulo='Problema com upload de arquivos'), 2, (SELECT id FROM public.users WHERE username='testuser'),    '2025-09-14 13:05:00', 1, 'Imagem PNG de 500 KB.');

        -- Ticket 6
        INSERT INTO public."ticketInteractions" VALUES
        ((SELECT id FROM public.tickets WHERE titulo='Erro ao salvar configurações'), 1, (SELECT id FROM public.users WHERE username='jeancarlos'),  '2025-09-15 14:30:00', 2, 'Está chegando algum erro?');

        -- Ticket 7
        INSERT INTO public."ticketInteractions" VALUES
        ((SELECT id FROM public.tickets WHERE titulo='Timeout na consulta'), 1, (SELECT id FROM public.users WHERE username='jeancarlos'),  '2025-09-16 16:10:00', 2, 'Qual é a consulta que você executou?');

        -- Ticket 8
        INSERT INTO public."ticketInteractions" VALUES
        ((SELECT id FROM public.tickets WHERE titulo='Mensagem de erro genérica'), 1, (SELECT id FROM public.users WHERE username='andreemilio'), '2025-09-17 17:00:00', 2, 'Você consegue capturar o erro e mandar?'),
        ((SELECT id FROM public.tickets WHERE titulo='Mensagem de erro genérica'), 2, (SELECT id FROM public.users WHERE username='testuser'),    '2025-09-17 17:05:00', 1, 'Aqui está o print do console…');

        -- Ticket 9
        INSERT INTO public."ticketInteractions" VALUES
        ((SELECT id FROM public.tickets WHERE titulo='Dúvida sobre permissões'), 1, (SELECT id FROM public.users WHERE username='jeancarlos'),  '2025-09-18 18:00:00', 1, 'Boa pergunta — por enquanto, apenas seu próprio ticket é visível.');

        -- Ticket 10
        INSERT INTO public."ticketInteractions" VALUES
        ((SELECT id FROM public.tickets WHERE titulo='Solicitação de reset de senha'), 1, (SELECT id FROM public.users WHERE username='andreemilio'), '2025-09-19 18:30:00', 3, 'Enviei link para resetar a senha por e-mail.');
        SQL);
    }
}
