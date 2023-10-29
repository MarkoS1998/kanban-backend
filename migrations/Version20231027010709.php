<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231027010709 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB25BAC441FB');
        $this->addSql('DROP INDEX IDX_527EDB25BAC441FB ON task');
        $this->addSql('ALTER TABLE task CHANGE task_list_id_id task_list_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25224F3C61 FOREIGN KEY (task_list_id) REFERENCES task_list (id)');
        $this->addSql('CREATE INDEX IDX_527EDB25224F3C61 ON task (task_list_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB25224F3C61');
        $this->addSql('DROP INDEX IDX_527EDB25224F3C61 ON task');
        $this->addSql('ALTER TABLE task CHANGE task_list_id task_list_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25BAC441FB FOREIGN KEY (task_list_id_id) REFERENCES task_list (id)');
        $this->addSql('CREATE INDEX IDX_527EDB25BAC441FB ON task (task_list_id_id)');
    }
}
