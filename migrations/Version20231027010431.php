<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231027010431 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE label (id INT AUTO_INCREMENT NOT NULL, color VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task (id INT AUTO_INCREMENT NOT NULL, task_list_id_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, is_completed TINYINT(1) NOT NULL, position INT NOT NULL, start_on DATE DEFAULT NULL, due_on DATE DEFAULT NULL, open_subtasks INT NOT NULL, comments_count INT NOT NULL, is_important TINYINT(1) NOT NULL, completed_on DATE DEFAULT NULL, INDEX IDX_527EDB25BAC441FB (task_list_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task_label (task_id INT NOT NULL, label_id INT NOT NULL, INDEX IDX_C9034BC88DB60186 (task_id), INDEX IDX_C9034BC833B92F39 (label_id), PRIMARY KEY(task_id, label_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task_user (task_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_FE2042328DB60186 (task_id), INDEX IDX_FE204232A76ED395 (user_id), PRIMARY KEY(task_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task_list (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, open_tasks INT NOT NULL, completed_tasks INT NOT NULL, position INT NOT NULL, is_completed TINYINT(1) NOT NULL, is_trashed TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25BAC441FB FOREIGN KEY (task_list_id_id) REFERENCES task_list (id)');
        $this->addSql('ALTER TABLE task_label ADD CONSTRAINT FK_C9034BC88DB60186 FOREIGN KEY (task_id) REFERENCES task (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE task_label ADD CONSTRAINT FK_C9034BC833B92F39 FOREIGN KEY (label_id) REFERENCES label (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE task_user ADD CONSTRAINT FK_FE2042328DB60186 FOREIGN KEY (task_id) REFERENCES task (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE task_user ADD CONSTRAINT FK_FE204232A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB25BAC441FB');
        $this->addSql('ALTER TABLE task_label DROP FOREIGN KEY FK_C9034BC88DB60186');
        $this->addSql('ALTER TABLE task_label DROP FOREIGN KEY FK_C9034BC833B92F39');
        $this->addSql('ALTER TABLE task_user DROP FOREIGN KEY FK_FE2042328DB60186');
        $this->addSql('ALTER TABLE task_user DROP FOREIGN KEY FK_FE204232A76ED395');
        $this->addSql('DROP TABLE label');
        $this->addSql('DROP TABLE task');
        $this->addSql('DROP TABLE task_label');
        $this->addSql('DROP TABLE task_user');
        $this->addSql('DROP TABLE task_list');
    }
}
