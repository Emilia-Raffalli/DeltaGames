<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240416105122 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participation_question DROP FOREIGN KEY FK_5ADFC5D91E27F6BF');
        $this->addSql('ALTER TABLE participation_question DROP FOREIGN KEY FK_5ADFC5D96ACE3B73');
        $this->addSql('DROP TABLE participation_question');
        $this->addSql('ALTER TABLE participation ADD question_id INT NOT NULL');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24F1E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('CREATE INDEX IDX_AB55E24F1E27F6BF ON participation (question_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE participation_question (participation_id INT NOT NULL, question_id INT NOT NULL, INDEX IDX_5ADFC5D91E27F6BF (question_id), INDEX IDX_5ADFC5D96ACE3B73 (participation_id), PRIMARY KEY(participation_id, question_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE participation_question ADD CONSTRAINT FK_5ADFC5D91E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participation_question ADD CONSTRAINT FK_5ADFC5D96ACE3B73 FOREIGN KEY (participation_id) REFERENCES participation (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24F1E27F6BF');
        $this->addSql('DROP INDEX IDX_AB55E24F1E27F6BF ON participation');
        $this->addSql('ALTER TABLE participation DROP question_id');
    }
}
