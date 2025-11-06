<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AjustesSchema extends AbstractMigration
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
        // Garantir unicidade de username (case-insensitive)
        $this->execute(<<<SQL
        DO $$
        BEGIN
            IF NOT EXISTS (SELECT 1 FROM pg_constraint WHERE conname = 'users_username_key') THEN
                ALTER TABLE public.users
                ADD CONSTRAINT users_username_key UNIQUE (username);
            END IF;
        END$$;
        SQL);

        // Ajustar tipo de users.tipoUsuario (varchar → smallint)
        $this->execute(<<<SQL
        ALTER TABLE public.users
            ALTER COLUMN "tipoUsuario" TYPE smallint
            USING CASE
                WHEN "tipoUsuario"::text ~ '^[0-9]+$' THEN "tipoUsuario"::smallint
                ELSE 1
            END;
        SQL);

        // Corrigir sequence da tabela tickets (caso use users_id_seq)
        $this->execute(<<<SQL
        DO $$
        BEGIN
            IF NOT EXISTS (SELECT 1 FROM pg_class WHERE relname = 'tickets_id_seq') THEN
                CREATE SEQUENCE public.tickets_id_seq START 1;
            END IF;
            ALTER TABLE public.tickets
              ALTER COLUMN id SET DEFAULT nextval('tickets_id_seq');
            ALTER SEQUENCE public.tickets_id_seq OWNED BY public.tickets.id;
        END$$;
        SQL);
    }
}
