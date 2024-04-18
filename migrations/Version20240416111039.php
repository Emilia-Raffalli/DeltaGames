<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240416111039 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE participation_question (participation_id INT NOT NULL, question_id INT NOT NULL, INDEX IDX_5ADFC5D96ACE3B73 (participation_id), INDEX IDX_5ADFC5D91E27F6BF (question_id), PRIMARY KEY(participation_id, question_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participation_answer (participation_id INT NOT NULL, answer_id INT NOT NULL, INDEX IDX_A0B8CC006ACE3B73 (participation_id), INDEX IDX_A0B8CC00AA334807 (answer_id), PRIMARY KEY(participation_id, answer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE participation_question ADD CONSTRAINT FK_5ADFC5D96ACE3B73 FOREIGN KEY (participation_id) REFERENCES participation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participation_question ADD CONSTRAINT FK_5ADFC5D91E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participation_answer ADD CONSTRAINT FK_A0B8CC006ACE3B73 FOREIGN KEY (participation_id) REFERENCES participation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participation_answer ADD CONSTRAINT FK_A0B8CC00AA334807 FOREIGN KEY (answer_id) REFERENCES answer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E6ACE3B73');
        $this->addSql('DROP INDEX IDX_B6F7494E6ACE3B73 ON question');
        $this->addSql('ALTER TABLE question CHANGE participation_id answer_choice_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494EA479B907 FOREIGN KEY (answer_choice_id) REFERENCES answer (id)');
        $this->addSql('CREATE INDEX IDX_B6F7494EA479B907 ON question (answer_choice_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participation_question DROP FOREIGN KEY FK_5ADFC5D96ACE3B73');
        $this->addSql('ALTER TABLE participation_question DROP FOREIGN KEY FK_5ADFC5D91E27F6BF');
        $this->addSql('ALTER TABLE participation_answer DROP FOREIGN KEY FK_A0B8CC006ACE3B73');
        $this->addSql('ALTER TABLE participation_answer DROP FOREIGN KEY FK_A0B8CC00AA334807');
        $this->addSql('DROP TABLE participation_question');
        $this->addSql('DROP TABLE participation_answer');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494EA479B907');
        $this->addSql('DROP INDEX IDX_B6F7494EA479B907 ON question');
        $this->addSql('ALTER TABLE question CHANGE answer_choice_id participation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E6ACE3B73 FOREIGN KEY (participation_id) REFERENCES participation (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_B6F7494E6ACE3B73 ON question (participation_id)');
    }
}
