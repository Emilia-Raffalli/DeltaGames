<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240416113027 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participation_answer DROP FOREIGN KEY FK_A0B8CC006ACE3B73');
        $this->addSql('ALTER TABLE participation_answer DROP FOREIGN KEY FK_A0B8CC00AA334807');
        $this->addSql('DROP TABLE participation_answer');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE participation_answer (participation_id INT NOT NULL, answer_id INT NOT NULL, INDEX IDX_A0B8CC006ACE3B73 (participation_id), INDEX IDX_A0B8CC00AA334807 (answer_id), PRIMARY KEY(participation_id, answer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE participation_answer ADD CONSTRAINT FK_A0B8CC006ACE3B73 FOREIGN KEY (participation_id) REFERENCES participation (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participation_answer ADD CONSTRAINT FK_A0B8CC00AA334807 FOREIGN KEY (answer_id) REFERENCES answer (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
