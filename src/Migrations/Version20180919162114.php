<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180919162114 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE goal_evaluation ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE goal_evaluation ADD CONSTRAINT FK_F2066123A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_F2066123A76ED395 ON goal_evaluation (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE goal_evaluation DROP FOREIGN KEY FK_F2066123A76ED395');
        $this->addSql('DROP INDEX IDX_F2066123A76ED395 ON goal_evaluation');
        $this->addSql('ALTER TABLE goal_evaluation DROP user_id');
    }
}
