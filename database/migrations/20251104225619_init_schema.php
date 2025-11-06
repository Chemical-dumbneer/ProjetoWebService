<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class InitSchema extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $this->execute(<<<SQL
        CREATE EXTENSION IF NOT EXISTS citext;
        CREATE EXTENSION IF NOT EXISTS pgcrypto;
        
        CREATE TABLE IF NOT EXISTS public.users
        (
            id BIGSERIAL PRIMARY KEY,
            username CITEXT NOT NULL UNIQUE,
            "nomeCompleto" TEXT NOT NULL,
            "pwdHash" TEXT NOT NULL,
            "tipoUsuario" SMALLINT NOT NULL,
            "caminhoFoto" TEXT
        );
        
        CREATE TABLE IF NOT EXISTS public.tickets
        (
            id BIGSERIAL PRIMARY KEY,
            id_requerent BIGINT NOT NULL REFERENCES public.users(id),
            titulo VARCHAR(255) NOT NULL,
            descricao TEXT NOT NULL,
            "dataCriacao" TIMESTAMP WITHOUT TIME ZONE NOT NULL,
            status SMALLINT NOT NULL
        );
        
        CREATE TABLE IF NOT EXISTS public."ticketInteractions"
        (
            id_ticket BIGINT NOT NULL REFERENCES public.tickets(id),
            "timelinePosition" BIGINT NOT NULL,
            id_author BIGINT NOT NULL REFERENCES public.users(id),
            "datetime" TIMESTAMP WITHOUT TIME ZONE NOT NULL,
            "interactionType" SMALLINT NOT NULL,
            descricao TEXT NOT NULL,
            PRIMARY KEY (id_ticket, "timelinePosition")
        );
        SQL);
    }
    public function up(): void
    {
        $this->execute(<<<SQL
        CREATE EXTENSION IF NOT EXISTS citext;
        CREATE EXTENSION IF NOT EXISTS pgcrypto;
        
        CREATE TABLE IF NOT EXISTS public.users
        (
            id BIGSERIAL PRIMARY KEY,
            username CITEXT NOT NULL UNIQUE,
            "nomeCompleto" TEXT NOT NULL,
            "pwdHash" TEXT NOT NULL,
            "tipoUsuario" SMALLINT NOT NULL,
            "caminhoFoto" TEXT
        );
        
        CREATE TABLE IF NOT EXISTS public.tickets
        (
            id BIGSERIAL PRIMARY KEY,
            id_requerent BIGINT NOT NULL REFERENCES public.users(id),
            titulo VARCHAR(255) NOT NULL,
            descricao TEXT NOT NULL,
            "dataCriacao" TIMESTAMP WITHOUT TIME ZONE NOT NULL,
            status SMALLINT NOT NULL
        );
        
        CREATE TABLE IF NOT EXISTS public."ticketInteractions"
        (
            id_ticket BIGINT NOT NULL REFERENCES public.tickets(id),
            "timelinePosition" BIGINT NOT NULL,
            id_author BIGINT NOT NULL REFERENCES public.users(id),
            "datetime" TIMESTAMP WITHOUT TIME ZONE NOT NULL,
            "interactionType" SMALLINT NOT NULL,
            descricao TEXT NOT NULL,
            PRIMARY KEY (id_ticket, "timelinePosition")
        );
        SQL);
    }

    public function down(): void
    {
        $this->execute('DROP TABLE IF EXISTS public."ticketInteractions";');
        $this->execute('DROP TABLE IF EXISTS public.tickets;');
        $this->execute('DROP TABLE IF EXISTS public.users;');
    }
}
