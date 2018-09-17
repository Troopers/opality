<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180912222129 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE goal (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, measurement VARCHAR(255) DEFAULT NULL, attainable TINYINT(1) NOT NULL, ambitious TINYINT(1) DEFAULT NULL, accomplished TINYINT(1) NOT NULL, planned_date DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE goal_core_value (goal_id INT NOT NULL, core_value_id INT NOT NULL, INDEX IDX_69A268D3667D1AFE (goal_id), INDEX IDX_69A268D346E2CD01 (core_value_id), PRIMARY KEY(goal_id, core_value_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE goal_core_value ADD CONSTRAINT FK_69A268D3667D1AFE FOREIGN KEY (goal_id) REFERENCES goal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE goal_core_value ADD CONSTRAINT FK_69A268D346E2CD01 FOREIGN KEY (core_value_id) REFERENCES core_value (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE goal_core_value DROP FOREIGN KEY FK_69A268D3667D1AFE');
        $this->addSql('DROP TABLE goal');
        $this->addSql('DROP TABLE goal_core_value');
    }
}
